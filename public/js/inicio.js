(() => {
    const dialog = document.getElementById('mv-dialog');
    if (!dialog) return;

    const body = document.getElementById('mv-body');
    const title = document.getElementById('mv-title');
    const subtitle = document.getElementById('mv-subtitle');
    const tabs = [...dialog.querySelectorAll('[data-mv-tab]')];
    const bloques = [...dialog.querySelectorAll('[data-bloque]')];
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    function mostrar(id) {
        bloques.forEach((b) => {
            const activo = b.id === id;
            b.hidden = !activo;
            if (activo) {
                title.textContent = b.dataset.title || '';
                subtitle.textContent = b.dataset.subtitle || '';
            }
        });
        tabs.forEach((t) => {
            const activo = t.dataset.mvTab === id;
            t.setAttribute('aria-selected', String(activo));
            t.tabIndex = activo ? 0 : -1;
        });
        body.scrollTop = 0;
    }

    function abrir(id) {
        mostrar(id);
        if (!dialog.open) {
            dialog.classList.remove('is-closing');
            document.documentElement.classList.add('mv-open');
            dialog.showModal();
        }
    }

    function cerrar() {
        if (!dialog.open || dialog.classList.contains('is-closing')) return;

        const terminar = () => {
            dialog.classList.remove('is-closing');
            dialog.close();
        };

        if (reduceMotion.matches) return terminar();

        dialog.classList.add('is-closing');
        dialog.addEventListener('animationend', terminar, { once: true });
        setTimeout(() => dialog.classList.contains('is-closing') && terminar(), 350); // respaldo
    }

    // Abrir / cerrar por delegación de eventos (sin onclick inline)
    document.addEventListener('click', (e) => {
        const abrirBtn = e.target.closest('[data-mv-open]');
        if (abrirBtn) return abrir(abrirBtn.dataset.mvOpen);

        if (e.target.closest('[data-mv-close]')) return cerrar();
        if (e.target === dialog) return cerrar(); // clic en el fondo oscuro
    });

    // Pestañas
    tabs.forEach((tab, i) => {
        tab.addEventListener('click', () => mostrar(tab.dataset.mvTab));
        tab.addEventListener('keydown', (e) => {
            if (e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') return;
            const sig = tabs[(i + (e.key === 'ArrowRight' ? 1 : -1) + tabs.length) % tabs.length];
            sig.focus();
            mostrar(sig.dataset.mvTab);
        });
    });

    // Esc: usar la misma animación de cierre
    dialog.addEventListener('cancel', (e) => {
        e.preventDefault();
        cerrar();
    });

    // Al cerrarse (por cualquier vía) se libera el scroll de la página
    dialog.addEventListener('close', () => {
        document.documentElement.classList.remove('mv-open');
    });
})();