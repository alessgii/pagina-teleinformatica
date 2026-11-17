(function () {
    const { baseUrl, postId, categoriesMap, sessionUser } = window.FORO_POST_CONFIG;
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

    let currentPost = null;
    let pendingDelete = null; // { type: 'post' | 'comment', id: number }
    let preparedEditFile = null;

    const breadcrumbCatLink = document.getElementById('breadcrumb-cat-link');
    const postLoading = document.getElementById('post-loading');
    const postError = document.getElementById('post-error');
    const postErrorTitle = document.getElementById('post-error-title');
    const postErrorMsg = document.getElementById('post-error-msg');
    const retryPostBtn = document.getElementById('retry-post-btn');
    const postDetailCard = document.getElementById('post-detail-card');
    const commentsSection = document.getElementById('comments-section');
    const commentsCountBadge = document.getElementById('comments-count-badge');
    const commentsList = document.getElementById('comments-list');
    const commentForm = document.getElementById('comment-form');
    const commentContentInput = document.getElementById('comment-content-input');
    const commentError = document.getElementById('comment-error');
    const submitCommentBtn = document.getElementById('submit-comment-btn');
    const toastEl = document.getElementById('forum-toast');

    // Edit & Delete Modal refs
    const editBackdrop = document.getElementById('edit-backdrop');
    const closeEditBtn = document.getElementById('close-edit-btn');
    const cancelEditBtn = document.getElementById('cancel-edit-btn');
    const editPostForm = document.getElementById('edit-post-form');
    const editTitleInput = document.getElementById('edit-title-input');
    const editContentInput = document.getElementById('edit-content-input');
    const editLinkInput = document.getElementById('edit-link-input');
    const editFileInput = document.getElementById('edit-file-input');
    const editFileName = document.getElementById('edit-file-name');
    const editFileHint = document.getElementById('edit-file-hint');
    const removeAttachmentRow = document.getElementById('remove-attachment-row');
    const removeAttachmentCheck = document.getElementById('remove-attachment-check');
    const editError = document.getElementById('edit-error');
    const submitEditBtn = document.getElementById('submit-edit-btn');

    const deleteBackdrop = document.getElementById('delete-backdrop');
    const deleteModalDesc = document.getElementById('delete-modal-desc');
    const deleteError = document.getElementById('delete-error');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');

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
        return date.toLocaleDateString('es-MX', {
            day: 'numeric',
            month: 'long',
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

    function canManage(ownerUserId) {
        if (!sessionUser.isLoggedIn) return false;
        if (sessionUser.isModerator) return true;
        return Number(ownerUserId) === Number(sessionUser.userId);
    }

    function resolveFileUrl(rawPath) {
        if (!rawPath) return '';
        if (/^https?:\/\//i.test(rawPath)) return rawPath;
        return baseUrl + String(rawPath).replace(/^\/+/, '');
    }

    // Optimización iterativa de imágenes en cliente (<= 3 MB)
    async function optimizeImageIterativelyClient(file, maxTargetBytes = 3 * 1024 * 1024) {
        const isImage = /^image\/(jpeg|png|webp)$/i.test(file.type);
        if (!isImage || file.size <= maxTargetBytes) {
            return { file, optimized: false, finalSize: file.size };
        }
        const bitmapUrl = URL.createObjectURL(file);
        try {
            const img = await new Promise((resolve, reject) => {
                const imageEl = new Image();
                imageEl.onload = () => resolve(imageEl);
                imageEl.onerror = () => reject(new Error('No se pudo procesar la imagen.'));
                imageEl.src = bitmapUrl;
            });

            const qualities = [0.84, 0.70, 0.56, 0.42];
            const maxDimensions = [1920, 1536, 1228, 960];
            let currentBlob = null;

            for (let i = 0; i < qualities.length; i++) {
                const maxDim = maxDimensions[i];
                let width = img.naturalWidth || img.width;
                let height = img.naturalHeight || img.height;
                if (width > maxDim || height > maxDim) {
                    const ratio = Math.min(maxDim / width, maxDim / height);
                    width = Math.max(1, Math.round(width * ratio));
                    height = Math.max(1, Math.round(height * ratio));
                }
                const canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;
                const ctx = canvas.getContext('2d');
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, width, height);
                ctx.drawImage(img, 0, 0, width, height);

                currentBlob = await new Promise((resolve) => canvas.toBlob(resolve, 'image/jpeg', qualities[i]));
                if (currentBlob && currentBlob.size <= maxTargetBytes) break;
            }

            if (!currentBlob) return { file, optimized: false, finalSize: file.size };
            const cleanName = file.name.replace(/\.[^.]+$/, '') + '-opt.jpg';
            const optimizedFile = new File([currentBlob], cleanName, { type: 'image/jpeg' });
            return { file: optimizedFile, optimized: true, finalSize: optimizedFile.size };
        } finally {
            URL.revokeObjectURL(bitmapUrl);
        }
    }

    function renderFullAttachments(post) {
        let html = '';
        const fileUrl = resolveFileUrl(post.file_url);
        const fileType = String(post.file_type || '').toLowerCase();

        if (fileUrl) {
            const isImg = fileType === 'image' || /\.(png|jpe?g|webp|gif)$/i.test(fileUrl);
            if (isImg) {
                html += `
                    <div class="fr-media-frame">
                        <div class="fr-media-img-wrap">
                            <img src="${escapeHtml(fileUrl)}"
                                 alt="Imagen adjunta a ${escapeHtml(post.title)}"
                                 width="800"
                                 height="450"
                                 loading="lazy" />
                        </div>
                        <div class="fr-media-bar">
                            <span>Imagen adjunta a la publicación</span>
                            <a href="${escapeHtml(fileUrl)}" target="_blank" rel="noopener noreferrer" style="color:var(--fr-navy);font-weight:800;text-decoration:none">
                                Abrir imagen en tamaño completo &nearr;
                            </a>
                        </div>
                    </div>
                `;
            } else {
                const fileName = String(post.file_url).split('/').pop() || 'Documento adjunto';
                html += `
                    <a href="${escapeHtml(fileUrl)}" target="_blank" rel="noopener noreferrer" class="fr-resource-box" download>
                        <div class="fr-resource-meta">
                            <span class="fr-resource-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                            </span>
                            <div style="min-width:0">
                                <div style="font-size:0.76rem;font-weight:800;text-transform:uppercase;color:var(--fr-accent)">Archivo adjunto para descarga</div>
                                <div style="font-size:0.95rem;font-weight:700;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${escapeHtml(fileName)}</div>
                            </div>
                        </div>
                        <span style="font-size:0.88rem;font-weight:800;white-space:nowrap">Descargar &darr;</span>
                    </a>
                `;
            }
        }

        if (post.external_link) {
            html += `
                <a href="${escapeHtml(post.external_link)}" target="_blank" rel="noopener noreferrer" class="fr-resource-box">
                    <div class="fr-resource-meta">
                        <span class="fr-resource-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                        </span>
                        <div style="min-width:0">
                            <div style="font-size:0.76rem;font-weight:800;text-transform:uppercase;color:var(--fr-accent)">Enlace externo de referencia</div>
                            <div style="font-size:0.95rem;font-weight:700;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${escapeHtml(post.external_link)}</div>
                        </div>
                    </div>
                    <span style="font-size:0.88rem;font-weight:800;white-space:nowrap">Abrir enlace &nearr;</span>
                </a>
            `;
        }

        return html;
    }

    function renderPostDetail(post) {
        currentPost = post;
        const catKey = String(post.category || 'general').toLowerCase();
        const catLabel = getCategoryLabel(catKey);
        const roleLabel = getRoleLabel(post.role_id, post.role_name);
        const likesCount = Number(post.likes_count || 0);
        const userLiked = Boolean(post.user_liked);
        const editable = canManage(post.user_id);

        document.title = `${post.title} - Foro de la Comunidad`;
        breadcrumbCatLink.textContent = catLabel;
        breadcrumbCatLink.href = `${baseUrl}foro?categoria=${encodeURIComponent(catKey)}`;

        postDetailCard.innerHTML = `
            <div class="fr-post-top">
                <div class="fr-author">
                    <div class="${getAvatarClass(post.role_id)}" aria-hidden="true">${escapeHtml(getInitial(post.author_name))}</div>
                    <div class="fr-author-meta">
                        <div class="fr-author-line">
                            <span class="fr-author-name">${escapeHtml(post.author_name || 'Estudiante')}</span>
                            <span class="fr-role-badge" data-role="${Number(post.role_id || 4)}">${escapeHtml(roleLabel)}</span>
                            <a href="${escapeHtml(baseUrl)}foro?categoria=${encodeURIComponent(catKey)}" class="fr-cat-badge">
                                ${escapeHtml(catLabel)}
                            </a>
                        </div>
                        <time class="fr-date" datetime="${escapeHtml(post.publication_date)}">
                            Publicado el ${escapeHtml(formatDate(post.publication_date))}
                        </time>
                    </div>
                </div>

                ${editable ? `
                    <div class="fr-post-actions">
                        <button type="button" id="open-edit-post-btn" class="fr-icon-btn">
                            Editar publicación
                        </button>
                        <button type="button" id="open-delete-post-btn" class="fr-icon-btn fr-icon-btn-del">
                            Eliminar
                        </button>
                    </div>
                ` : ''}
            </div>

            <h1 class="fr-detail-title">${escapeHtml(post.title)}</h1>
            <div class="fr-detail-body">${escapeHtml(post.content)}</div>

            ${renderFullAttachments(post)}

            <div class="fr-post-footer">
                <div class="fr-post-actions">
                    <button type="button"
                            id="like-post-btn"
                            class="fr-btn fr-btn-line"
                            aria-pressed="${userLiked ? 'true' : 'false'}">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="${userLiked ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                        </svg>
                        <span>Útil (${likesCount})</span>
                    </button>

                    <button type="button" id="copy-link-btn" class="fr-btn fr-btn-ghost">
                        Copiar enlace
                    </button>
                </div>

                <a href="${escapeHtml(baseUrl)}foro?categoria=${encodeURIComponent(catKey)}" class="fr-btn fr-btn-line">
                    Ver más de ${escapeHtml(catLabel)}
                </a>
            </div>
        `;

        const likeBtn = document.getElementById('like-post-btn');
        if (likeBtn) {
            likeBtn.addEventListener('click', handleToggleLike);
        }

        const copyBtn = document.getElementById('copy-link-btn');
        if (copyBtn) {
            copyBtn.addEventListener('click', async () => {
                try {
                    await navigator.clipboard.writeText(window.location.href);
                    showToast('Enlace de la publicación copiado al portapapeles.');
                } catch (_) {
                    showToast('No se pudo copiar automáticamente.');
                }
            });
        }

        const editBtn = document.getElementById('open-edit-post-btn');
        if (editBtn) {
            editBtn.addEventListener('click', openEditModal);
        }

        const delBtn = document.getElementById('open-delete-post-btn');
        if (delBtn) {
            delBtn.addEventListener('click', () => {
                openDeleteModal('post', post.post_id, '¿Estás seguro de que deseas eliminar esta publicación completa y sus comentarios?');
            });
        }
    }

    function renderComments(comments) {
        const list = Array.isArray(comments) ? comments : [];
        commentsCountBadge.textContent = `${list.length} ${list.length === 1 ? 'comentario' : 'comentarios'}`;

        if (list.length === 0) {
            commentsList.innerHTML = `
                <div class="fr-card fr-state-card" style="padding:1.85rem 1.25rem;background:var(--fr-soft)">
                    <p style="font-size:1.02rem;font-weight:800;margin:0 0 0.35rem;color:var(--fr-navy)">Aún no hay respuestas en este hilo</p>
                    <p class="fr-hint" style="margin:0">Sé la primera persona en compartir una orientación, solución o referencia académica.</p>
                </div>
            `;
            return;
        }

        commentsList.innerHTML = list.map((c) => {
            const cId = Number(c.comment_id || c.id);
            const roleLabel = getRoleLabel(c.role_id, c.role_name);
            const removable = canManage(c.user_id);
            return `
                <div class="fr-comment-item" data-comment-id="${cId}">
                    <div class="fr-comment-top">
                        <div class="fr-author-line">
                            <span class="fr-author-name" style="font-size:0.93rem">${escapeHtml(c.author_name || 'Estudiante')}</span>
                            <span class="fr-role-badge" data-role="${Number(c.role_id || 4)}">${escapeHtml(roleLabel)}</span>
                            <span class="fr-date" style="margin:0">${escapeHtml(formatDate(c.comment_date || c.created_at))}</span>
                        </div>
                        ${removable ? `
                            <button type="button"
                                    class="fr-icon-btn fr-icon-btn-del js-delete-comment"
                                    data-comment-id="${cId}"
                                    style="min-height:36px;padding:0.25rem 0.65rem;font-size:0.78rem">
                                Eliminar
                            </button>
                        ` : ''}
                    </div>
                    <p class="fr-comment-body">${escapeHtml(c.comment_text || c.content)}</p>
                </div>
            `;
        }).join('');

        commentsList.querySelectorAll('.js-delete-comment').forEach((btn) => {
            btn.addEventListener('click', () => {
                const cId = Number(btn.getAttribute('data-comment-id'));
                openDeleteModal('comment', cId, '¿Deseas eliminar este comentario de forma permanente?');
            });
        });
    }

    async function loadPostAndComments() {
        if (!postId || postId <= 0) {
            postLoading.hidden = true;
            postError.hidden = false;
            return;
        }

        postLoading.hidden = false;
        postError.hidden = true;
        postDetailCard.hidden = true;
        commentsSection.hidden = true;

        try {
            const [postRes, commentsRes] = await Promise.all([
                fetch(`${baseUrl}api/posts/${postId}`, { credentials: 'same-origin' }),
                fetch(`${baseUrl}api/posts/${postId}/comments`, { credentials: 'same-origin' })
            ]);

            const postJson = await postRes.json();
            if (!postRes.ok || !postJson.success || !postJson.data) {
                throw new Error(postJson.message || 'No se encontró la publicación solicitada.');
            }

            const commentsJson = await commentsRes.json();
            const comments = (commentsRes.ok && commentsJson.success && Array.isArray(commentsJson.data))
                ? commentsJson.data
                : [];

            renderPostDetail(postJson.data);
            renderComments(comments);

            postLoading.hidden = true;
            postDetailCard.hidden = false;
            commentsSection.hidden = false;
        } catch (err) {
            postLoading.hidden = true;
            postErrorTitle.textContent = 'No pudimos cargar esta publicación';
            postErrorMsg.textContent = err.message || 'Verifica el enlace o intenta nuevamente.';
            postError.hidden = false;
        }
    }

    async function handleToggleLike() {
        if (!sessionUser.isLoggedIn) {
            window.location.href = `${baseUrl}login`;
            return;
        }
        const btn = document.getElementById('like-post-btn');
        if (!btn) return;
        btn.disabled = true;

        try {
            const res = await fetch(`${baseUrl}api/posts/${postId}/like`, {
                method: 'POST',
                credentials: 'same-origin'
            });
            const json = await res.json();
            if (!res.ok || !json.success || !json.data) {
                throw new Error(json.message || 'No se pudo registrar el voto.');
            }
            currentPost.user_liked = Boolean(json.data.liked);
            currentPost.likes_count = Number(json.data.likes_count || 0);
            renderPostDetail(currentPost);
        } catch (err) {
            showToast(err.message || 'Error al actualizar el voto.');
        } finally {
            btn.disabled = false;
        }
    }

    if (commentForm) {
        commentForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            commentError.hidden = true;
            const content = commentContentInput.value.trim();

            if (content.length < 2) {
                commentError.textContent = 'Escribe una respuesta de al menos 2 caracteres.';
                commentError.hidden = false;
                return;
            }

            submitCommentBtn.disabled = true;
            submitCommentBtn.textContent = 'Publicando...';

            try {
                const res = await fetch(`${baseUrl}api/posts/${postId}/comments`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ content })
                });
                const json = await res.json();
                if (!res.ok || !json.success) {
                    throw new Error(json.message || 'No se pudo publicar tu comentario.');
                }

                commentContentInput.value = '';
                const commentsRes = await fetch(`${baseUrl}api/posts/${postId}/comments`, { credentials: 'same-origin' });
                const commentsJson = await commentsRes.json();
                renderComments(commentsJson.data || []);
                showToast('Tu respuesta fue publicada.');
            } catch (err) {
                commentError.textContent = err.message || 'Error al publicar el comentario.';
                commentError.hidden = false;
            } finally {
                submitCommentBtn.disabled = false;
                submitCommentBtn.textContent = 'Publicar respuesta';
            }
        });
    }

    // Edición de publicación
    function openEditModal() {
        if (!currentPost || !editBackdrop) return;
        editError.hidden = true;
        preparedEditFile = null;
        editTitleInput.value = currentPost.title || '';
        editContentInput.value = currentPost.content || '';
        editLinkInput.value = currentPost.external_link || '';
        if (editFileInput) editFileInput.value = '';
        if (editFileName) editFileName.textContent = currentPost.file_url ? 'Conservar archivo actual' : 'Ningún archivo seleccionado';
        if (removeAttachmentCheck) removeAttachmentCheck.checked = false;
        if (removeAttachmentRow) removeAttachmentRow.hidden = !currentPost.file_url;

        const catVal = String(currentPost.category || 'general').toLowerCase();
        editPostForm.querySelectorAll('input[name="category"]').forEach((radio) => {
            radio.checked = radio.value === catVal;
        });

        editBackdrop.hidden = false;
        editTitleInput.focus();
    }

    function closeEditModal() {
        if (editBackdrop) editBackdrop.hidden = true;
    }

    if (closeEditBtn) closeEditBtn.addEventListener('click', closeEditModal);
    if (cancelEditBtn) cancelEditBtn.addEventListener('click', closeEditModal);

    if (editFileInput) {
        editFileInput.addEventListener('change', async () => {
            const rawFile = editFileInput.files && editFileInput.files[0];
            if (!rawFile) {
                preparedEditFile = null;
                editFileName.textContent = 'Conservar archivo actual';
                return;
            }
            editFileName.textContent = `Procesando ${rawFile.name}...`;
            try {
                const res = await optimizeImageIterativelyClient(rawFile);
                preparedEditFile = res.file;
                const mb = (res.finalSize / (1024 * 1024)).toFixed(2);
                editFileName.textContent = `${res.file.name} (${mb} MB)`;
                editFileHint.textContent = res.optimized
                    ? 'Imagen optimizada automáticamente a menos de 3 MB.'
                    : 'Archivo listo para adjuntar.';
            } catch (err) {
                preparedEditFile = rawFile;
                editFileName.textContent = rawFile.name;
            }
        });
    }

    if (editPostForm) {
        editPostForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            editError.hidden = true;

            const title = editTitleInput.value.trim();
            const content = editContentInput.value.trim();
            const externalLink = editLinkInput.value.trim();
            const checkedCat = editPostForm.querySelector('input[name="category"]:checked');
            const category = checkedCat ? checkedCat.value : 'general';

            if (!title || !content) {
                editError.textContent = 'El título y el contenido son obligatorios.';
                editError.hidden = false;
                return;
            }

            submitEditBtn.disabled = true;
            submitEditBtn.textContent = 'Guardando...';

            try {
                const fd = new FormData();
                fd.append('title', title);
                fd.append('content', content);
                fd.append('category', category);
                fd.append('external_link', externalLink);
                if (removeAttachmentCheck && removeAttachmentCheck.checked) {
                    fd.append('remove_file', '1');
                }
                if (preparedEditFile) {
                    fd.append('file', preparedEditFile, preparedEditFile.name);
                }

                const res = await fetch(`${baseUrl}api/posts/${postId}`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: fd
                });
                const json = await res.json();
                if (!res.ok || !json.success) {
                    throw new Error(json.message || 'No se pudieron guardar los cambios.');
                }

                closeEditModal();
                await loadPostAndComments();
                showToast('Publicación actualizada correctamente.');
            } catch (err) {
                editError.textContent = err.message || 'Error al guardar los cambios.';
                editError.hidden = false;
            } finally {
                submitEditBtn.disabled = false;
                submitEditBtn.textContent = 'Guardar cambios';
            }
        });
    }

    // Eliminación de publicación o comentario
    function openDeleteModal(type, id, message) {
        if (!deleteBackdrop) return;
        pendingDelete = { type, id };
        deleteModalDesc.textContent = message;
        deleteError.hidden = true;
        deleteBackdrop.hidden = false;
    }

    function closeDeleteModal() {
        pendingDelete = null;
        if (deleteBackdrop) deleteBackdrop.hidden = true;
    }

    if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', closeDeleteModal);

    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', async () => {
            if (!pendingDelete) return;
            deleteError.hidden = true;
            confirmDeleteBtn.disabled = true;
            confirmDeleteBtn.textContent = 'Eliminando...';

            try {
                const url = pendingDelete.type === 'post'
                    ? `${baseUrl}api/posts/${pendingDelete.id}`
                    : `${baseUrl}api/comments/${pendingDelete.id}`;

                const res = await fetch(url, {
                    method: 'DELETE',
                    credentials: 'same-origin'
                });
                const json = await res.json();
                if (!res.ok || !json.success) {
                    throw new Error(json.message || 'No se pudo eliminar.');
                }

                if (pendingDelete.type === 'post') {
                    window.location.href = `${baseUrl}foro`;
                    return;
                }

                closeDeleteModal();
                const commentsRes = await fetch(`${baseUrl}api/posts/${postId}/comments`, { credentials: 'same-origin' });
                const commentsJson = await commentsRes.json();
                renderComments(commentsJson.data || []);
                showToast('Comentario eliminado.');
            } catch (err) {
                deleteError.textContent = err.message || 'Error al eliminar.';
                deleteError.hidden = false;
            } finally {
                confirmDeleteBtn.disabled = false;
                confirmDeleteBtn.textContent = 'Sí, eliminar';
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (editBackdrop && !editBackdrop.hidden) closeEditModal();
            if (deleteBackdrop && !deleteBackdrop.hidden) closeDeleteModal();
        }
    });

    if (retryPostBtn) retryPostBtn.addEventListener('click', loadPostAndComments);

    loadPostAndComments();
})();