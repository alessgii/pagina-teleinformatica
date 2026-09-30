// public/js/noticias.js

// Variable global para conservar los datos de la noticia activa
let noticiaActualDatos = null;

/**
 * Listener global para inicializar badges y eventos de teclado
 */
document.addEventListener('DOMContentLoaded', () => {
    aplicarEstilosInsignias();
    
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            cerrarVisorNoticia();
            toggleNewsModal(false);
        }
    });
});

/**
 * Previsualiza la imagen seleccionada en el formulario de creación/edición
 */
function previsualizarImagenNoticia(input) {
    const prompt = document.getElementById('dropzone-prompt');
    const previewContainer = document.getElementById('preview-container');
    const previewImg = document.getElementById('preview-img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            if (prompt) prompt.classList.add('hidden');
            if (previewContainer) {
                previewContainer.classList.remove('hidden');
                previewContainer.classList.add('flex');
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * Aplica colores dinámicos a los badges de categorías
 */
function aplicarEstilosInsignias() {
    const badges = document.querySelectorAll('.category-badge, .noticia-card__etiqueta');

    badges.forEach(badge => {
        const categoria = badge.textContent.trim().toUpperCase();

        badge.style.backgroundColor = '#ffffff';
        badge.style.fontWeight = '700';

        switch (categoria) {
            case 'LOGROS':
                badge.style.color = '#16a34a';
                badge.style.border = '1px solid rgba(22, 163, 74, 0.35)';
                break;
            case 'ALIANZAS':
                badge.style.color = '#0d9488';
                badge.style.border = '1px solid rgba(13, 148, 136, 0.35)';
                break;
            case 'AVISOS':
                badge.style.color = '#0f172a';
                badge.style.border = '1px solid rgba(15, 23, 42, 0.35)';
                break;
            case 'TORNEOS':
                badge.style.color = '#b45309';
                badge.style.border = '1px solid rgba(180, 83, 9, 0.35)';
                break;
            case 'TALLERES':
                badge.style.color = '#4338ca';
                badge.style.border = '1px solid rgba(67, 56, 202, 0.35)';
                break;
            case 'EVENTOS':
                badge.style.color = '#6b21a8';
                badge.style.border = '1px solid rgba(107, 33, 168, 0.35)';
                break;
            default:
                badge.style.color = '#0f172a';
                badge.style.border = '1px solid rgba(15, 23, 42, 0.35)';
                break;
        }
    });
}

/**
 * Abre el Visor Modal estilo Lightbox y carga sus datos y enlaces de administración
 */
function abrirVisorNoticia(cardElement) {
    if (!cardElement) return;

    const newsId = cardElement.dataset.id || cardElement.getAttribute('data-id');
    const title = cardElement.dataset.title || cardElement.getAttribute('data-title');
    const content = cardElement.dataset.content || cardElement.getAttribute('data-content');
    const img = cardElement.dataset.img || cardElement.getAttribute('data-img');
    const category = cardElement.dataset.category || cardElement.getAttribute('data-category');
    const categoryId = cardElement.dataset.categoryId || cardElement.getAttribute('data-category-id');
    const date = cardElement.dataset.date || cardElement.getAttribute('data-date');
    const status = cardElement.dataset.status || cardElement.getAttribute('data-status');

    // Guardar referencia en memoria para editar
    noticiaActualDatos = {
        id: newsId,
        title: title,
        content: content,
        img: img,
        category: category,
        categoryId: categoryId,
        date: date,
        status: status
    };

    // Asignar los valores al modal visor
    const visorImg = document.getElementById('visor-img');
    const visorTitle = document.getElementById('visor-title');
    const visorContent = document.getElementById('visor-content');
    const visorBadge = document.getElementById('visor-badge');
    const visorDate = document.getElementById('visor-date');

    if (visorImg) visorImg.src = img;
    if (visorTitle) visorTitle.textContent = title;
    if (visorContent) visorContent.textContent = content;
    if (visorBadge) visorBadge.textContent = category;
    if (visorDate) visorDate.textContent = date;

    // Configurar rutas de los botones de administración dentro del visor
    const btnEstado = document.getElementById('btn-visor-estado');
    const txtEstado = document.getElementById('txt-visor-estado');
    const btnEliminar = document.getElementById('btn-visor-eliminar');

    const baseUrl = typeof BASE_URL !== 'undefined' ? BASE_URL : '/pagina-teleinformatica/';

    if (btnEstado && txtEstado && btnEliminar) {
        btnEstado.href = baseUrl + 'public/api/noticias/cambiar-estado.php?news_id=' + newsId;
        btnEliminar.href = baseUrl + 'public/api/noticias/eliminar.php?news_id=' + newsId;
        
        if (status === 'publicado') {
            txtEstado.innerText = 'Mover a borrador';
        } else {
            txtEstado.innerText = 'Publicar noticia';
        }
    }

    const viewer = document.getElementById('news-viewer');
    if (viewer) {
        viewer.classList.remove('hidden');
        viewer.classList.add('flex');
    }
    document.body.style.overflow = 'hidden';

    // Incrementar contador de visitas
    if (newsId) {
        incrementarVista(newsId, baseUrl);
    }
}

/**
 * Cierra el Visor Modal de Noticias
 */
function cerrarVisorNoticia() {
    const viewer = document.getElementById('news-viewer');
    if (!viewer) return;

    viewer.classList.add('hidden');
    viewer.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Función para mostrar / ocultar el modal
function toggleNewsModal(show) {
    const modal = document.getElementById('news-modal');
    if (!modal) return;
    
    if (show) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    } else {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
}

// Función que ejecuta el botón "+ Nueva noticia"
function abrirModalCrearNoticia() {
    const form = document.getElementById('news-form');
    if (form) {
        form.reset();

        const baseUrl = typeof BASE_URL !== 'undefined' ? BASE_URL : '/pagina-teleinformatica/';
        form.action = baseUrl + 'public/api/noticias/crear.php';
    }

    // Limpiar ID para asegurarnos de que es una NUEVA noticia
    const inputId = document.getElementById('news_id');
    if (inputId) {
        inputId.value = '';
    }

    // Asegurar que el estado inicial sea 'publicado'
    const inputStatus = document.getElementById('news_status');
    if (inputStatus) {
        inputStatus.value = 'publicado';
    }

    // Restablecer el título del modal y texto de envío
    const modalTitle = document.getElementById('modal-form-title');
    if (modalTitle) {
        modalTitle.innerText = 'Agregar nueva noticia';
    }
    const submitBtn = document.getElementById('submit-btn');
    if (submitBtn) {
        submitBtn.innerText = 'Publicar noticia';
    }

    // Ocultar previsualización de imagen si existía
    const previewContainer = document.getElementById('preview-container');
    const dropzonePrompt = document.getElementById('dropzone-prompt');
    if (previewContainer) previewContainer.classList.add('hidden');
    if (dropzonePrompt) dropzonePrompt.classList.remove('hidden');

    // Mostrar el modal
    toggleNewsModal(true);
}

/**
 * Carga la información de la noticia actual en el formulario para editarla
 */
function ejecutarEdicionDesdeVisor() {
    if (!noticiaActualDatos) return;

    const baseUrl = typeof BASE_URL !== 'undefined' ? BASE_URL : '/pagina-teleinformatica/';

    // Asignación segura de campos
    const inputId = document.getElementById('news_id');
    const inputTitle = document.getElementById('title');
    const inputContent = document.getElementById('content');
    const inputCategory = document.getElementById('category_id');
    const inputStatus = document.getElementById('news_status');

    if (inputId) inputId.value = noticiaActualDatos.id || '';
    if (inputTitle) inputTitle.value = noticiaActualDatos.title || '';
    if (inputContent) inputContent.value = noticiaActualDatos.content || '';
    if (inputCategory) inputCategory.value = noticiaActualDatos.categoryId || '';
    if (inputStatus) inputStatus.value = noticiaActualDatos.status || 'publicado';

    // Ajustar textos de interfaz
    const modalTitle = document.getElementById('modal-form-title');
    if (modalTitle) modalTitle.innerText = 'Editar noticia';

    const submitBtn = document.getElementById('submit-btn');
    if (submitBtn) submitBtn.innerText = 'Guardar cambios';

    // Cambiar la ruta del formulario a editar.php
    const form = document.getElementById('news-form');
    if (form) {
        form.action = baseUrl + 'public/api/noticias/editar.php';
    }

    // Previsualización de imagen existente
    const previewContainer = document.getElementById('preview-container');
    const previewImg = document.getElementById('preview-img');
    const dropzonePrompt = document.getElementById('dropzone-prompt');

    if (noticiaActualDatos.img && previewContainer && previewImg) {
        previewImg.src = noticiaActualDatos.img;
        previewContainer.classList.remove('hidden');
        previewContainer.classList.add('flex');
        if (dropzonePrompt) dropzonePrompt.classList.add('hidden');
    }

    cerrarVisorNoticia();
    toggleNewsModal(true);
}

/**
 * Filtra las noticias en el cliente por la categoría seleccionada desde los botones
 */
function filtrarNoticiasPorCategoria(categoriaSeleccionada, botonActivo) {
    const botones = document.querySelectorAll('#newsFilterRow .filter-btn');
    botones.forEach(btn => {
        btn.classList.remove('active', 'text-white', 'bg-navy', 'border-navy');
        btn.classList.add('text-text-mid', 'bg-bg-main', 'border-border-main');
    });

    if (botonActivo) {
        botonActivo.classList.remove('text-text-mid', 'bg-bg-main', 'border-border-main');
        botonActivo.classList.add('active', 'text-white', 'bg-navy', 'border-navy');
    }

    const tarjetas = document.querySelectorAll('section[aria-label="Listado de noticias"] article');
    let visibles = 0;

    tarjetas.forEach(card => {
        const catCard = card.getAttribute('data-category');

        if (categoriaSeleccionada === 'todas' || (catCard && catCard.toLowerCase() === categoriaSeleccionada.toLowerCase())) {
            card.style.display = 'flex';
            visibles++;
        } else {
            card.style.display = 'none';
        }
    });

    gestionarEmptyState(visibles);
}

/**
 * Filtra las noticias visibles a partir del valor seleccionado en un ComboBox
 */
function filtrarNoticiasPorComboBox(categoriaSeleccionada) {
    const tarjetas = document.querySelectorAll('section[aria-label="Listado de noticias"] article');
    let visibles = 0;

    tarjetas.forEach(card => {
        const catCard = card.getAttribute('data-category');

        if (categoriaSeleccionada === 'todas' || (catCard && catCard.toLowerCase() === categoriaSeleccionada.toLowerCase())) {
            card.style.display = 'flex';
            visibles++;
        } else {
            card.style.display = 'none';
        }
    });

    gestionarEmptyState(visibles);
}

/**
 * Controla la aparición del mensaje si no hay resultados en la categoría
 */
function gestionarEmptyState(visibles) {
    let emptyState = document.getElementById('noticiasEmptyState');
    if (visibles === 0) {
        if (!emptyState) {
            const grid = document.querySelector('section[aria-label="Listado de noticias"]');
            emptyState = document.createElement('div');
            emptyState.id = 'noticiasEmptyState';
            emptyState.className = 'col-span-full py-16 text-center text-text-muted bg-bg-card border border-border-main rounded-[var(--radius-custom)]';
            emptyState.innerHTML = '<p class="text-[.9rem]">Aún no hay noticias publicadas en esta categoría.</p>';
            if (grid) grid.appendChild(emptyState);
        } else {
            emptyState.style.display = 'block';
        }
    } else if (emptyState) {
        emptyState.style.display = 'none';
    }
}

/**
 * Realiza la petición Fetch a la API para incrementar el contador de visitas
 */
function incrementarVista(newsId, baseUrl = '/pagina-teleinformatica/') {
    const targetUrl = `${baseUrl}public/api/noticias/incrementar-vista.php`;

    fetch(targetUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `news_id=${encodeURIComponent(newsId)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const contador = document.getElementById(`views-count-${newsId}`);
            if (contador && data.views !== undefined) {
                contador.textContent = `👁 ${formatearVistasJS(data.views)}`;
            }
        }
    })
    .catch(err => console.error('[Noticias] Error al registrar la vista:', err));
}

/**
 * Formatea valores numéricos grandes (Ejemplo: 1200 -> 1.2k)
 */
function formatearVistasJS(vistas) {
    vistas = parseInt(vistas, 10);
    if (isNaN(vistas)) return '0';
    if (vistas >= 1000000) return (vistas / 1000000).toFixed(1) + 'M';
    if (vistas >= 1000) return (vistas / 1000).toFixed(1) + 'k';
    return vistas.toString();
}