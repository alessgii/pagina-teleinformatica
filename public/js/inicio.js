function abrirMisionVision(cardElement) {
    if (!cardElement) return;

    const title = cardElement.dataset.title;
    const content = cardElement.dataset.content;
    const iconClass = cardElement.dataset.iconClass || '';
    const iconHtml = cardElement.querySelector('[data-icon-slot] svg')?.outerHTML || '';

    const viewer = document.getElementById('mv-viewer');
    const panel = document.getElementById('mv-panel');
    const mvTitle = document.getElementById('mv-title');
    const mvContent = document.getElementById('mv-content');
    const mvCircle = document.getElementById('mv-icon-circle');

    if (mvTitle) mvTitle.textContent = title;
    if (mvContent) mvContent.textContent = content;

    if (mvCircle) {
        mvCircle.innerHTML = iconHtml;
        // El círculo toma los colores de la tarjeta (turquesa o verde)
        mvCircle.className = 'w-24 h-24 lg:w-28 lg:h-28 rounded-full flex items-center justify-center shadow-lg ' + iconClass;
        // Agrandar el SVG que se copió
        mvCircle.querySelector('svg')?.setAttribute('class', 'w-12 h-12 lg:w-14 lg:h-14');
    }

    if (viewer) {
        viewer.classList.remove('hidden');
        viewer.classList.add('flex');
        requestAnimationFrame(() => {
            viewer.classList.remove('opacity-0');
            viewer.classList.add('opacity-100');
            if (panel) {
                panel.classList.remove('scale-95');
                panel.classList.add('scale-100');
            }
        });
    }
    document.body.style.overflow = 'hidden';
}

function cerrarMisionVision() {
    const viewer = document.getElementById('mv-viewer');
    const panel = document.getElementById('mv-panel');
    if (!viewer || viewer.classList.contains('hidden')) return;

    viewer.classList.remove('opacity-100');
    viewer.classList.add('opacity-0');
    if (panel) {
        panel.classList.remove('scale-100');
        panel.classList.add('scale-95');
    }

    setTimeout(() => {
        viewer.classList.remove('flex');
        viewer.classList.add('hidden');
        document.body.style.overflow = '';
    }, 300);
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') cerrarMisionVision();
});