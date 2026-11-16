(function () {
    const { baseUrl, categoriesMap, sessionUser } = window.FORO_CONFIG;

    const roleNamesMap = {
        1: 'Administración',
        2: 'Coordinación',
        3: 'Docente',
        4: 'Estudiante',
        ADMIN: 'Administración',
        COORDINATOR: 'Coordinación',
        TEACHER: 'Docente',
        STUDENT: 'Estudiante'
    };

    const state = {
        page: 1,
        limit: 10,
        search: '',
        category: '',
        filter: 'all',
        posts: [],
        categoryCounts: {},
        pagination: { page: 1, limit: 10, total: 0, total_pages: 1 },
        lastTriggerEl: null,
        preparedUploadFile: null
    };

    // Referencias del DOM
    const searchForm = document.getElementById('forum-search-form');
    const searchInput = document.getElementById('forum-search-input');
    const clearSearchBtn = document.getElementById('clear-search-btn');
    const catChips = Array.from(document.querySelectorAll('.js-cat-chip'));
    const scopeChips = Array.from(document.querySelectorAll('.js-scope-chip'));
    const feedSummary = document.getElementById('feed-summary');
    const feedLoading = document.getElementById('feed-loading');
    const feedError = document.getElementById('feed-error');
    const feedErrorMsg = document.getElementById('feed-error-msg');
    const retryFeedBtn = document.getElementById('retry-feed-btn');
    const feedEmpty = document.getElementById('feed-empty');
    const emptyTitle = document.getElementById('empty-title');
    const emptyDesc = document.getElementById('empty-desc');
    const emptyResetBtn = document.getElementById('empty-reset-btn');
    const feedList = document.getElementById('feed-list');
    const feedPagination = document.getElementById('feed-pagination');
    const toastEl = document.getElementById('forum-toast');

    let toastTimer = null;
    function showToast(message) {
        if (!toastEl) return;
        toastEl.textContent = message;
        toastEl.hidden = false;
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            toastEl.hidden = true;
        }, 3200);
    }

    function escapeHtml(str) {
        if (str === null || str === undefined) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function formatDate(dateStr) {
        if (!dateStr) return '';
        const normalized = String(dateStr).replace(' ', 'T');
        const date = new Date(normalized);
        if (isNaN(date.getTime())) return String(dateStr);

        const now = new Date();
        const diffSec = Math.floor((now - date) / 1000);
        if (diffSec >= 0 && diffSec < 60) return 'Hace unos segundos';
        if (diffSec >= 60 && diffSec < 3600) {
            const mins = Math.floor(diffSec / 60);
            return `Hace ${mins} ${mins === 1 ? 'minuto' : 'minutos'}`;
        }
        if (diffSec >= 3600 && diffSec < 86400) {
            const hrs = Math.floor(diffSec / 3600);
            return `Hace ${hrs} ${hrs === 1 ? 'hora' : 'horas'}`;
        }
        return date.toLocaleDateString('es-MX', {
            day: 'numeric',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function getRoleLabel(roleId, roleName) {
        if (roleId && roleNamesMap[roleId]) return roleNamesMap[roleId];
        if (roleName && roleNamesMap[roleName]) return roleNamesMap[roleName];
        return 'Estudiante';
    }

    function getCategoryLabel(catKey) {
        const clean = String(catKey || 'general').toLowerCase();
        return categoriesMap[clean] || 'General';
    }

    function getInitial(name) {
        const clean = String(name || 'Usuario').trim();
        return clean ? clean.charAt(0).toUpperCase() : 'U';
    }

    function getAvatarClass(roleId) {
        const id = Number(roleId);
        if (id === 1 || id === 2) return 'fr-avatar fr-avatar-mod';
        if (id === 3) return 'fr-avatar fr-avatar-teacher';
        return 'fr-avatar';
    }

    // Trunca el texto para la tarjeta del feed mostrando siempre '...' cuando es largo
    function makeExcerpt(rawText, maxChars = 210) {
        const singleLine = String(rawText || '').replace(/\s+/g, ' ').trim();
        if (singleLine.length <= maxChars) {
            return singleLine;
        }
        return singleLine.slice(0, maxChars).trimEnd() + '...';
    }

    function readStateFromUrl() {
        const params = new URLSearchParams(window.location.search);
        const searchParam = (params.get('search') || '').trim();
        const catParam = (params.get('categoria') || params.get('category') || '').toLowerCase().trim();
        const pageParam = parseInt(params.get('p') || '', 10);

        state.search = searchParam;
        searchInput.value = state.search;
        clearSearchBtn.hidden = !state.search;

        state.category = categoriesMap[catParam] ? catParam : '';
        state.page = (!isNaN(pageParam) && pageParam > 0) ? pageParam : 1;

        syncChipsVisualState();
    }

    function pushStateToUrl() {
        const params = new URLSearchParams();
        if (state.category) params.set('categoria', state.category);
        if (state.search) params.set('search', state.search);
        if (state.page > 1) params.set('p', String(state.page));
        const qs = params.toString();
        const nextUrl = `${window.location.pathname}${qs ? '?' + qs : ''}`;
        window.history.pushState({}, '', nextUrl);
    }

    function syncChipsVisualState() {
        catChips.forEach((chip) => {
            const cVal = chip.getAttribute('data-category') || '';
            chip.setAttribute('aria-pressed', cVal === state.category ? 'true' : 'false');
        });
        scopeChips.forEach((chip) => {
            const fVal = chip.getAttribute('data-filter') || 'all';
            chip.setAttribute('aria-pressed', fVal === state.filter ? 'true' : 'false');
        });
    }

    function updateCategoryBadges(countsObj) {
        if (!countsObj || typeof countsObj !== 'object') return;
        state.categoryCounts = countsObj;
        document.querySelectorAll('[data-cat-count]').forEach((el) => {
            const key = el.getAttribute('data-cat-count');
            el.textContent = String(countsObj[key] ?? 0);
        });
    }

    // Algoritmo iterativo de optimización de imágenes en cliente (< 3 MB)
    async function optimizeImageIterativelyClient(file, maxTargetBytes = 3 * 1024 * 1024) {
        const isImage = /^image\/(jpeg|png|webp)$/i.test(file.type);
        if (!isImage || file.size <= maxTargetBytes) {
            return { file, optimized: false, passes: 0, originalSize: file.size, finalSize: file.size };
        }

        const bitmapUrl = URL.createObjectURL(file);
        try {
            const img = await new Promise((resolve, reject) => {
                const imageEl = new Image();
                imageEl.onload = () => resolve(imageEl);
                imageEl.onerror = () => reject(new Error('No se pudo procesar la imagen para optimizarla.'));
                imageEl.src = bitmapUrl;
            });

            const qualities = [0.84, 0.70, 0.56, 0.42];
            const maxDimensions = [1920, 1536, 1228, 960];
            let currentBlob = null;
            let passes = 0;

            for (let i = 0; i < qualities.length; i++) {
                passes = i + 1;
                const maxDim = maxDimensions[i];
                const quality = qualities[i];

                let targetW = img.naturalWidth || img.width;
                let targetH = img.naturalHeight || img.height;

                if (targetW > maxDim || targetH > maxDim) {
                    const ratio = Math.min(maxDim / targetW, maxDim / targetH);
                    targetW = Math.max(320, Math.round(targetW * ratio));
                    targetH = Math.max(240, Math.round(targetH * ratio));
                }

                const canvas = document.createElement('canvas');
                canvas.width = targetW;
                canvas.height = targetH;
                const ctx = canvas.getContext('2d');
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, targetW, targetH);
                ctx.drawImage(img, 0, 0, targetW, targetH);

                currentBlob = await new Promise((resBlob) => canvas.toBlob(resBlob, 'image/jpeg', quality));
                if (currentBlob && currentBlob.size <= maxTargetBytes) {
                    break;
                }
            }

            if (!currentBlob || currentBlob.size > maxTargetBytes) {
                throw new Error('La imagen sigue superando los 3 MB tras 4 pasadas de optimización.');
            }

            const baseName = file.name.replace(/\.[^.]+$/, '') || 'imagen_optimizada';
            const optimizedFile = new File([currentBlob], `${baseName}.jpg`, {
                type: 'image/jpeg',
                lastModified: Date.now()
            });

            return {
                file: optimizedFile,
                optimized: true,
                passes,
                originalSize: file.size,
                finalSize: optimizedFile.size
            };
        } finally {
            URL.revokeObjectURL(bitmapUrl);
        }
    }

    async function loadPosts() {
        feedLoading.hidden = false;
        feedError.hidden = true;
        feedEmpty.hidden = true;
        feedList.hidden = true;
        feedPagination.hidden = true;
        feedSummary.textContent = 'Actualizando...';

        try {
            const params = new URLSearchParams();
            params.set('page', String(state.page));
            params.set('limit', String(state.limit));
            if (state.search) {
                params.set('search', state.search);
            }
            if (state.category) {
                params.set('category', state.category);
            }
            if (state.filter === 'mine' && sessionUser.userId) {
                params.set('user_id', String(sessionUser.userId));
            }
            if (state.filter === 'resources') {
                params.set('has_resources', '1');
            }

            const res = await fetch(`${baseUrl}api/posts?${params.toString()}`, {
                credentials: 'same-origin'
            });
            const json = await res.json();
            if (!res.ok || !json.success) {
                throw new Error(json.message || 'No fue posible obtener las publicaciones.');
            }

            state.posts = Array.isArray(json.data) ? json.data : [];
            state.pagination = json.pagination || { page: 1, limit: 10, total: state.posts.length, total_pages: 1 };
            if (json.category_counts) {
                updateCategoryBadges(json.category_counts);
            }

            renderFeed();
        } catch (err) {
            feedLoading.hidden = true;
            feedErrorMsg.textContent = err.message || 'Error de conexión con el servidor.';
            feedError.hidden = false;
            feedSummary.textContent = 'Error al cargar';
        }
    }

    function renderFeed() {
        feedLoading.hidden = true;

        const totalCount = Number(state.pagination.total ?? state.posts.length);
        const catSuffix = state.category ? ` en ${getCategoryLabel(state.category)}` : '';
        feedSummary.textContent = `${totalCount} ${totalCount === 1 ? 'publicación' : 'publicaciones'}${catSuffix}`;

        if (state.posts.length === 0) {
            feedList.hidden = true;
            feedPagination.hidden = true;

            const hasActiveFilter = Boolean(state.search || state.category || state.filter !== 'all');
            emptyResetBtn.hidden = !hasActiveFilter;

            if (state.search) {
                emptyTitle.textContent = 'Sin resultados para tu búsqueda';
                emptyDesc.textContent = `No encontramos publicaciones que coincidan con "${state.search}". Intenta con otros términos o limpia los filtros.`;
            } else if (state.filter === 'mine') {
                emptyTitle.textContent = 'Aún no tienes publicaciones en esta vista';
                emptyDesc.textContent = 'Cuando compartas una duda, apunte o proyecto con la comunidad, aparecerá listado aquí.';
            } else if (state.filter === 'resources') {
                emptyTitle.textContent = 'No hay publicaciones con archivos o enlaces';
                emptyDesc.textContent = 'Todavía no se han compartido documentos descargables ni enlaces externos en esta categoría.';
            } else if (state.category) {
                emptyTitle.textContent = `Sin publicaciones en ${getCategoryLabel(state.category)}`;
                emptyDesc.textContent = `Aún no hay hilos registrados en el área de ${getCategoryLabel(state.category)}. ¡Inicia el primero!`;
            } else {
                emptyTitle.textContent = 'Aún no hay publicaciones en el foro';
                emptyDesc.textContent = 'Sé la primera persona en iniciar una conversación académica, compartir apuntes o plantear una duda.';
            }

            feedEmpty.hidden = false;
            return;
        }

        feedEmpty.hidden = true;
        feedList.innerHTML = '';

        state.posts.forEach((post) => {
            const card = buildPostCard(post);
            feedList.appendChild(card);
        });

        feedList.hidden = false;
        renderPagination();
    }

    function buildAttachmentPills(post, threadUrl) {
        const pills = [];
        let imagePreview = '';
        if (post.file_url) {
            if (post.file_type === 'image') {
                const imgSrc = `${baseUrl}${String(post.file_url).replace(/^\/+/, '')}`;
                imagePreview = `
                    <a href="${escapeHtml(threadUrl)}" style="display:block;margin-bottom:0.65rem;border-radius:10px;overflow:hidden;border:1px solid var(--fr-line);background:var(--fr-soft);">
                        <img src="${escapeHtml(imgSrc)}" alt="Imagen adjunta" loading="lazy" style="display:block;width:100%;max-height:260px;object-fit:cover;">
                    </a>
                `;
            } else {
                const labels = {
                    pdf: 'Contiene documento PDF',
                    document: 'Contiene archivo adjunto',
                    other: 'Contiene archivo adjunto'
                };
                const text = labels[post.file_type] || 'Contiene archivo adjunto';
                pills.push(`
                    <a href="${escapeHtml(threadUrl)}" class="fr-attach-pill">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                        </svg>
                        <span>${escapeHtml(text)}</span>
                    </a>
                `);
            }
        }

        if (post.external_link) {
            let host = 'Enlace externo';
            try {
                host = new URL(post.external_link).hostname;
            } catch (e) {}
            pills.push(`
                <a href="${escapeHtml(threadUrl)}" class="fr-attach-pill">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                    <span>Enlace: ${escapeHtml(host)}</span>
                </a>
            `);
        }

        if (!imagePreview && pills.length === 0) return '';
        const pillsHtml = pills.length > 0 ? `<div class="fr-attachment-pills">${pills.join('')}</div>` : '';
        return `${imagePreview}${pillsHtml}`;
    }

    function buildPostCard(post) {
        const postId = Number(post.post_id);
        const threadUrl = `${baseUrl}foro/${postId}`;
        const article = document.createElement('article');
        article.className = 'fr-card fr-post';
        article.id = `post-${postId}`;

        const roleLabel = getRoleLabel(post.role_id, post.role_name);
        const catKey = String(post.category || 'general').toLowerCase();
        const catLabel = getCategoryLabel(catKey);
        const initial = getInitial(post.author_name);
        const avatarClass = getAvatarClass(post.role_id);

        const excerpt = makeExcerpt(post.content, 210);
        const commentsCount = Number(post.comments_count || 0);
        const likesCount = Number(post.likes_count || 0);
        const userLiked = Boolean(post.user_liked);

        article.innerHTML = `
            <div class="fr-post-top">
                <div class="fr-author">
                    <div class="${avatarClass}" aria-hidden="true">${escapeHtml(initial)}</div>
                    <div class="fr-author-meta">
                        <div class="fr-author-line">
                            <span class="fr-author-name">${escapeHtml(post.author_name || 'Usuario')}</span>
                            <span class="fr-role-badge" data-role="${escapeHtml(post.role_id)}">${escapeHtml(roleLabel)}</span>
                            <button type="button" class="fr-cat-badge js-post-cat-btn" data-category="${escapeHtml(catKey)}" title="Filtrar por ${escapeHtml(catLabel)}">
                                ${escapeHtml(catLabel)}
                            </button>
                        </div>
                        <time class="fr-date" datetime="${escapeHtml(post.publication_date)}">${escapeHtml(formatDate(post.publication_date))}</time>
                    </div>
                </div>
            </div>

            <h2 class="fr-post-title">
                <a href="${escapeHtml(threadUrl)}" class="fr-post-title-link">${escapeHtml(post.title)}</a>
            </h2>

            <p class="fr-post-excerpt">${escapeHtml(excerpt)}</p>

            ${buildAttachmentPills(post, threadUrl)}

            <div class="fr-post-footer">
                <div class="fr-post-actions">
                    <button
                        type="button"
                        class="fr-btn fr-btn-line js-like-post"
                        aria-pressed="${userLiked ? 'true' : 'false'}"
                        style="padding:0.5rem 0.95rem;font-size:0.9rem"
                    >
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                        </svg>
                        <span>Útil (<span class="js-like-count">${likesCount}</span>)</span>
                    </button>

                    <a
                        href="${escapeHtml(threadUrl)}"
                        class="fr-btn fr-btn-line"
                        style="padding:0.5rem 0.95rem;font-size:0.9rem"
                    >
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <span>${commentsCount} ${commentsCount === 1 ? 'comentario' : 'comentarios'} · Ver hilo</span>
                    </a>

                    <button
                        type="button"
                        class="fr-btn fr-btn-ghost js-share-post"
                        style="padding:0.5rem 0.9rem;font-size:0.9rem"
                    >
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                        <span class="js-share-label">Copiar enlace</span>
                    </button>
                </div>
            </div>
        `;

        const catBtn = article.querySelector('.js-post-cat-btn');
        if (catBtn) {
            catBtn.addEventListener('click', () => {
                state.category = catBtn.getAttribute('data-category') || '';
                state.page = 1;
                syncChipsVisualState();
                pushStateToUrl();
                loadPosts();
            });
        }

        const likeBtn = article.querySelector('.js-like-post');
        if (likeBtn) {
            likeBtn.addEventListener('click', async () => {
                if (!sessionUser.isLoggedIn) {
                    showToast('Inicia sesión para marcar publicaciones como útiles.');
                    return;
                }
                likeBtn.disabled = true;
                try {
                    const res = await fetch(`${baseUrl}api/posts/${postId}/like`, {
                        method: 'POST',
                        credentials: 'same-origin'
                    });
                    const json = await res.json();
                    if (!res.ok || !json.success || !json.data) {
                        throw new Error(json.message || 'No se pudo registrar tu voto.');
                    }
                    post.user_liked = Boolean(json.data.liked);
                    post.likes_count = Number(json.data.likes_count || 0);
                    likeBtn.setAttribute('aria-pressed', post.user_liked ? 'true' : 'false');
                    likeBtn.querySelector('.js-like-count').textContent = String(post.likes_count);
                } catch (err) {
                    showToast(err.message || 'Error al procesar voto.');
                } finally {
                    likeBtn.disabled = false;
                }
            });
        }

        const shareBtn = article.querySelector('.js-share-post');
        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                const shareUrl = `${window.location.origin}${threadUrl}`;
                const labelEl = shareBtn.querySelector('.js-share-label');
                try {
                    await navigator.clipboard.writeText(shareUrl);
                    labelEl.textContent = 'Enlace copiado';
                    showToast('Enlace directo copiado al portapapeles.');
                    setTimeout(() => { labelEl.textContent = 'Copiar enlace'; }, 2200);
                } catch (e) {
                    window.prompt('Copia este enlace:', shareUrl);
                }
            });
        }

        return article;
    }

    function getPaginationRange(current, total) {
        if (total <= 7) {
            return Array.from({ length: total }, (_, i) => i + 1);
        }
        const pages = [1];
        const left = Math.max(2, current - 1);
        const right = Math.min(total - 1, current + 1);

        if (left > 2) pages.push('...');
        for (let i = left; i <= right; i++) pages.push(i);
        if (right < total - 1) pages.push('...');
        pages.push(total);
        return pages;
    }

    function renderPagination() {
        const totalPages = Number(state.pagination.total_pages || 1);
        const currentPage = Number(state.pagination.page || 1);

        if (totalPages <= 1) {
            feedPagination.hidden = true;
            feedPagination.innerHTML = '';
            return;
        }

        feedPagination.innerHTML = '';

        const prevBtn = document.createElement('button');
        prevBtn.type = 'button';
        prevBtn.className = 'fr-btn fr-btn-line';
        prevBtn.textContent = 'Anterior';
        prevBtn.disabled = currentPage <= 1;
        prevBtn.addEventListener('click', () => {
            if (state.page > 1) {
                state.page--;
                pushStateToUrl();
                loadPosts();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
        feedPagination.appendChild(prevBtn);

        const items = getPaginationRange(currentPage, totalPages);
        items.forEach((item) => {
            if (item === '...') {
                const span = document.createElement('span');
                span.className = 'fr-page-ellipsis';
                span.textContent = '...';
                span.setAttribute('aria-hidden', 'true');
                feedPagination.appendChild(span);
                return;
            }
            const pageBtn = document.createElement('button');
            pageBtn.type = 'button';
            pageBtn.className = 'fr-chip';
            pageBtn.setAttribute('aria-pressed', item === currentPage ? 'true' : 'false');
            pageBtn.setAttribute('aria-label', `Ir a la página ${item}`);
            pageBtn.textContent = String(item);
            pageBtn.addEventListener('click', () => {
                if (state.page !== item) {
                    state.page = item;
                    pushStateToUrl();
                    loadPosts();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
            feedPagination.appendChild(pageBtn);
        });

        const nextBtn = document.createElement('button');
        nextBtn.type = 'button';
        nextBtn.className = 'fr-btn fr-btn-line';
        nextBtn.textContent = 'Siguiente';
        nextBtn.disabled = currentPage >= totalPages;
        nextBtn.addEventListener('click', () => {
            if (state.page < totalPages) {
                state.page++;
                pushStateToUrl();
                loadPosts();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
        feedPagination.appendChild(nextBtn);

        feedPagination.hidden = false;
    }

    // Eventos de Búsqueda y Filtros
    window.addEventListener('popstate', () => {
        readStateFromUrl();
        loadPosts();
    });

    searchInput.addEventListener('input', () => {
        clearSearchBtn.hidden = searchInput.value.trim().length === 0;
    });

    clearSearchBtn.addEventListener('click', () => {
        searchInput.value = '';
        clearSearchBtn.hidden = true;
        if (state.search !== '') {
            state.search = '';
            state.page = 1;
            pushStateToUrl();
            loadPosts();
        }
        searchInput.focus();
    });

    searchForm.addEventListener('submit', (e) => {
        e.preventDefault();
        state.search = searchInput.value.trim();
        state.page = 1;
        pushStateToUrl();
        loadPosts();
    });

    catChips.forEach((chip) => {
        chip.addEventListener('click', () => {
            state.category = chip.getAttribute('data-category') || '';
            state.page = 1;
            syncChipsVisualState();
            pushStateToUrl();
            loadPosts();
        });
    });

    scopeChips.forEach((chip) => {
        chip.addEventListener('click', () => {
            state.filter = chip.getAttribute('data-filter') || 'all';
            state.page = 1;
            syncChipsVisualState();
            pushStateToUrl();
            loadPosts();
        });
    });

    emptyResetBtn.addEventListener('click', () => {
        searchInput.value = '';
        clearSearchBtn.hidden = true;
        state.search = '';
        state.category = '';
        state.filter = 'all';
        state.page = 1;
        syncChipsVisualState();
        pushStateToUrl();
        loadPosts();
    });

    retryFeedBtn.addEventListener('click', () => loadPosts());

    const sidebarMineBtn = document.getElementById('sidebar-mine-btn');
    if (sidebarMineBtn) {
        sidebarMineBtn.addEventListener('click', () => {
            state.filter = 'mine';
            state.page = 1;
            syncChipsVisualState();
            pushStateToUrl();
            loadPosts();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Modal de Nueva Publicación
    const composerBackdrop = document.getElementById('composer-backdrop');
    const composerForm = document.getElementById('post-composer-form');
    const composerTitleInput = document.getElementById('composer-title-input');
    const composerTitleCount = document.getElementById('composer-title-count');
    const composerContentInput = document.getElementById('composer-content-input');
    const composerLinkInput = document.getElementById('composer-link-input');
    const composerFileInput = document.getElementById('composer-file-input');
    const composerFileName = document.getElementById('composer-file-name');
    const composerFileHint = document.getElementById('composer-file-hint');
    const composerRemoveFileBtn = document.getElementById('composer-remove-file-btn');
    const composerError = document.getElementById('composer-error');
    const submitComposerBtn = document.getElementById('submit-composer-btn');
    const submitComposerText = document.getElementById('submit-composer-text');

    function resetComposerForm() {
        state.preparedUploadFile = null;
        composerForm.reset();
        composerError.hidden = true;
        composerFileName.textContent = 'Ningún archivo seleccionado';
        composerFileHint.textContent = 'Si subes una imagen pesada (> 3 MB), se redimensionará y optimizará automáticamente.';
        composerRemoveFileBtn.hidden = true;

        const targetCat = state.category || 'general';
        const catRadio = composerForm.querySelector(`input[name="category"][value="${targetCat}"]`);
        if (catRadio) catRadio.checked = true;

        composerTitleCount.textContent = '0 / 200';
    }

    function openComposerModal(triggerEl = null) {
        if (!composerBackdrop) return;
        state.lastTriggerEl = triggerEl || document.activeElement;
        composerError.hidden = true;
        composerTitleCount.textContent = `${composerTitleInput.value.length} / 200`;
        composerBackdrop.hidden = false;
        setTimeout(() => composerTitleInput.focus(), 20);
    }

    function closeComposerModal() {
        if (!composerBackdrop || composerBackdrop.hidden) return;
        composerBackdrop.hidden = true;
        if (state.lastTriggerEl && typeof state.lastTriggerEl.focus === 'function') {
            state.lastTriggerEl.focus();
        }
    }

    if (composerBackdrop) {
        const openCreateBtn = document.getElementById('open-create-modal-btn');
        const emptyCreateBtn = document.getElementById('empty-create-btn');
        const sidebarCreateBtn = document.getElementById('sidebar-create-btn');
        const closeComposerBtn = document.getElementById('close-composer-btn');
        const cancelComposerBtn = document.getElementById('cancel-composer-btn');

        if (openCreateBtn) openCreateBtn.addEventListener('click', () => openComposerModal(openCreateBtn));
        if (emptyCreateBtn) emptyCreateBtn.addEventListener('click', () => openComposerModal(emptyCreateBtn));
        if (sidebarCreateBtn) sidebarCreateBtn.addEventListener('click', () => openComposerModal(sidebarCreateBtn));
        if (closeComposerBtn) closeComposerBtn.addEventListener('click', closeComposerModal);
        if (cancelComposerBtn) cancelComposerBtn.addEventListener('click', closeComposerModal);

        composerBackdrop.addEventListener('click', (e) => {
            if (e.target === composerBackdrop) closeComposerModal();
        });

        composerTitleInput.addEventListener('input', () => {
            composerTitleCount.textContent = `${composerTitleInput.value.length} / 200`;
            composerError.hidden = true;
        });

        composerContentInput.addEventListener('input', () => {
            composerError.hidden = true;
        });

        composerFileInput.addEventListener('change', async () => {
            composerError.hidden = true;
            const rawFile = composerFileInput.files && composerFileInput.files[0];
            if (!rawFile) {
                state.preparedUploadFile = null;
                composerFileName.textContent = 'Ningún archivo seleccionado';
                composerRemoveFileBtn.hidden = true;
                return;
            }

            const isImg = /^image\/(jpeg|png|webp)$/i.test(rawFile.type);
            if (!isImg && rawFile.size > 10 * 1024 * 1024) {
                composerFileInput.value = '';
                state.preparedUploadFile = null;
                composerError.textContent = 'El documento supera el tamaño máximo permitido de 10 MB.';
                composerError.hidden = false;
                return;
            }

            if (isImg && rawFile.size > 3 * 1024 * 1024) {
                composerFileName.textContent = `Optimizando imagen (${(rawFile.size / (1024 * 1024)).toFixed(2)} MB)...`;
                submitComposerBtn.disabled = true;
                try {
                    const result = await optimizeImageIterativelyClient(rawFile, 3 * 1024 * 1024);
                    state.preparedUploadFile = result.file;
                    const origMb = (result.originalSize / (1024 * 1024)).toFixed(2);
                    const finalMb = (result.finalSize / (1024 * 1024)).toFixed(2);
                    composerFileName.textContent = `${result.file.name} (${finalMb} MB)`;
                    composerFileHint.textContent = `Optimizada automáticamente de ${origMb} MB a ${finalMb} MB (${result.passes} ${result.passes === 1 ? 'pasada' : 'pasadas'}).`;
                    composerRemoveFileBtn.hidden = false;
                } catch (err) {
                    composerFileInput.value = '';
                    state.preparedUploadFile = null;
                    composerFileName.textContent = 'Ningún archivo seleccionado';
                    composerRemoveFileBtn.hidden = true;
                    composerError.textContent = err.message || 'No se pudo optimizar la imagen.';
                    composerError.hidden = false;
                } finally {
                    submitComposerBtn.disabled = false;
                }
            } else {
                state.preparedUploadFile = rawFile;
                const sizeMb = (rawFile.size / (1024 * 1024)).toFixed(2);
                composerFileName.textContent = `${rawFile.name} (${sizeMb} MB)`;
                composerFileHint.textContent = 'Archivo listo para adjuntarse.';
                composerRemoveFileBtn.hidden = false;
            }
        });

        composerRemoveFileBtn.addEventListener('click', () => {
            composerFileInput.value = '';
            state.preparedUploadFile = null;
            composerFileName.textContent = 'Ningún archivo seleccionado';
            composerFileHint.textContent = 'Si subes una imagen pesada (> 3 MB), se redimensionará y optimizará automáticamente.';
            composerRemoveFileBtn.hidden = true;
        });

        composerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            composerError.hidden = true;

            const checkedCat = composerForm.querySelector('input[name="category"]:checked');
            const category = checkedCat ? checkedCat.value : 'general';
            const title = composerTitleInput.value.trim();
            const content = composerContentInput.value.trim();
            const externalLink = composerLinkInput.value.trim();

            if (!title) {
                composerError.textContent = 'El título de la publicación es obligatorio.';
                composerError.hidden = false;
                composerTitleInput.focus();
                return;
            }
            if (!content) {
                composerError.textContent = 'El contenido de la publicación es obligatorio.';
                composerError.hidden = false;
                composerContentInput.focus();
                return;
            }

            submitComposerBtn.disabled = true;
            submitComposerText.textContent = 'Publicando...';

            try {
                const formData = new FormData();
                formData.append('category', category);
                formData.append('title', title);
                formData.append('content', content);
                formData.append('external_link', externalLink);
                if (state.preparedUploadFile) {
                    formData.append('file', state.preparedUploadFile);
                }

                const res = await fetch(`${baseUrl}api/posts`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                });
                const json = await res.json();
                if (!res.ok || !json.success || !json.data) {
                    throw new Error(json.message || 'No se pudo guardar la publicación.');
                }

                // Redirigir directamente a la nueva página foro/{id} de la publicación creada
                window.location.href = `${baseUrl}foro/${json.data.post_id}`;
            } catch (err) {
                composerError.textContent = err.message || 'Error de conexión con el servidor.';
                composerError.hidden = false;
                submitComposerBtn.disabled = false;
                submitComposerText.textContent = 'Publicar en el foro';
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && composerBackdrop && !composerBackdrop.hidden) {
            closeComposerModal();
        }
    });

    readStateFromUrl();
    loadPosts();
})();