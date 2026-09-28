/**
 Gestión de Modales JS
 */

// Abrir modal
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;


    modal.classList.remove('invisible', 'opacity-0');
    modal.classList.add('opacity-100');


    const container = modal.querySelector('.modal-container');
    if (container) {
        container.classList.remove('scale-95');
        container.classList.add('scale-100');
    }

    // Bloquear el scroll del fondo
    document.body.classList.add('overflow-hidden');
}

// Cerrar modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    // Ocultar modal
    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0', 'invisible');


    const container = modal.querySelector('.modal-container');
    if (container) {
        container.classList.remove('scale-100');
        container.classList.add('scale-95');
    }


    const openModals = document.querySelectorAll('.modal-overlay:not(.invisible)');
    if (openModals.length === 0) {
        document.body.classList.remove('overflow-hidden');
    }
}

// Cerrar modal al hacer clic fuera del contenedor
function closeModalOutside(event, modalId) {
    if (event.target === event.currentTarget) {
        closeModal(modalId);
    }
}

// Cerrar cualquier modal al presionar la tecla Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const activeModals = document.querySelectorAll('.modal-overlay:not(.invisible)');
        activeModals.forEach(modal => {
            closeModal(modal.id);
        });
    }
});