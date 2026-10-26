function abrirMisionVision(btn) {
    if (!btn) return;

    const viewer = document.getElementById('mv-viewer');
    const panel = document.getElementById('mv-panel');
    const body = document.getElementById('mv-body');
    const contenido = document.getElementById(btn.dataset.contenido);
    if (!viewer || !body || !contenido) return;

    document.getElementById('mv-title').textContent = btn.dataset.title || '';
    document.getElementById('mv-subtitle').textContent = btn.dataset.subtitle || '';
    document.getElementById('mv-icons').innerHTML =
        btn.querySelector('[data-icon-slot]')?.innerHTML || '';

    // Oculta todos los bloques y muestra solo el que corresponde al botón
    body.querySelectorAll('[data-bloque]').forEach(b => b.classList.add('hidden'));
    contenido.classList.remove('hidden');
    body.scrollTop = 0;

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

    // Espera a que termine la animación (300 ms) antes de ocultarlo
    setTimeout(() => {
        viewer.classList.remove('flex');
        viewer.classList.add('hidden');
        document.body.style.overflow = '';
    }, 300);
}

// Cerrar con la tecla Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') cerrarMisionVision();
});