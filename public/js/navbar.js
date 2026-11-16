/**
 * Cierra todos los submenús de escritorio y usuario
 */
function closeDesktopMenus() {
  document
    .querySelectorAll(".nav-item.open")
    .forEach((item) => item.classList.remove("open"));

  const userContainer = document.getElementById("user-menu-container");
  if (userContainer) {
    userContainer.classList.remove("open");
  }

  const btnUser = document.getElementById("btn-user-toggle");
  if (btnUser) {
    btnUser.setAttribute("aria-expanded", "false");
  }
}

/**
 * Controla el bloqueo de scroll del cuerpo
 */
function setBodyScrollLock(isLocked) {
  if (isLocked) {
    document.body.classList.add("menu-open");
  } else {
    document.body.classList.remove("menu-open");
  }
}

/**
 * Cierra el panel del menú móvil
 */
function closeMobileMenu() {
  const btnToggle = document.getElementById("btn-menu-toggle");
  const menuMovil = document.getElementById("menu-movil");
  const iconHamburger = document.getElementById("icon-hamburger");
  const iconClose = document.getElementById("icon-close");

  if (menuMovil) {
    menuMovil.classList.add("hidden");
  }

  if (iconHamburger) iconHamburger.classList.remove("hidden");
  if (iconClose) iconClose.classList.add("hidden");

  if (btnToggle) {
    btnToggle.setAttribute("aria-expanded", "false");
    btnToggle.setAttribute("aria-label", "Abrir menú");
  }

  setBodyScrollLock(false);
}

/**
 * Alterna la visibilidad del menú móvil hamburguesa
 */
function toggleMobileMenu(e) {
  if (e) {
    e.preventDefault();
    e.stopPropagation();
  }

  const btnToggle = document.getElementById("btn-menu-toggle");
  const menuMovil = document.getElementById("menu-movil");
  const iconHamburger = document.getElementById("icon-hamburger");
  const iconClose = document.getElementById("icon-close");

  if (!menuMovil) return;

  const isHidden = menuMovil.classList.contains("hidden");

  if (!isHidden) {
    closeMobileMenu();
    return;
  }

  closeDesktopMenus();
  menuMovil.classList.remove("hidden");

  if (iconHamburger) iconHamburger.classList.add("hidden");
  if (iconClose) iconClose.classList.remove("hidden");

  if (btnToggle) {
    btnToggle.setAttribute("aria-expanded", "true");
    btnToggle.setAttribute("aria-label", "Cerrar menú");
  }
  setBodyScrollLock(true);
}

/**
 * Alterna los submenús de escritorio (al hacer clic en pantallas grandes)
 */
function toggleNav(id) {
  if (window.innerWidth < 768) return;

  const el = document.getElementById(id);
  if (!el) return;

  const isOpen = el.classList.contains("open");
  closeDesktopMenus();

  if (!isOpen) {
    el.classList.add("open");
  }
}

/**
 * Alterna la visibilidad del menú desplegable del ícono de usuario
 */
function toggleUser(e) {
  if (e) {
    e.preventDefault();
    e.stopPropagation();
  }

  const container = document.getElementById("user-menu-container");
  const btnUser = document.getElementById("btn-user-toggle");
  if (!container) return;

  const isOpen = container.classList.contains("open");

  if (!isOpen) {
    closeMobileMenu();
    document.querySelectorAll(".nav-item.open").forEach((item) => item.classList.remove("open"));
    container.classList.add("open");
    if (btnUser) btnUser.setAttribute("aria-expanded", "true");
  } else {
    container.classList.remove("open");
    if (btnUser) btnUser.setAttribute("aria-expanded", "false");
  }
}

/**
 * Cierra todos los paneles activos
 */
function closeAll() {
  closeDesktopMenus();
  closeMobileMenu();
}

/**
 * Redirección de cierre de sesión
 */
function logoutUser(e) {
  if (e) {
    e.preventDefault();
    e.stopPropagation();
  }
  const baseUrl = window.BASE_URL || "/pagina-teleinformatica/";
  window.location.href = baseUrl + "logout";
}

// Inicialización de eventos al cargar el DOM
document.addEventListener("DOMContentLoaded", () => {
  // Manejo de hover en escritorio
  const navItems = document.querySelectorAll(".nav-item, .nav-right");
  navItems.forEach((item) => {
    item.addEventListener("mouseenter", () => {
      if (window.innerWidth >= 768) {
        closeDesktopMenus();
        item.classList.add("open");
      }
    });

    item.addEventListener("mouseleave", () => {
      if (window.innerWidth >= 768) {
        item.classList.remove("open");
      }
    });
  });

  // Listener para el menú móvil
  const btnMenuToggle = document.getElementById("btn-menu-toggle");
  if (btnMenuToggle) {
    btnMenuToggle.addEventListener("click", toggleMobileMenu);
  }

  // Listener para el botón de usuario
  const btnUser = document.getElementById("btn-user-toggle");
  if (btnUser) {
    btnUser.addEventListener("click", toggleUser);
  }
});

// Cierre al hacer clic fuera del menú
document.addEventListener("click", (e) => {
  if (
    !e.target.closest(".nav-item") &&
    !e.target.closest("#user-menu-container") &&
    !e.target.closest("#btn-menu-toggle") &&
    !e.target.closest("#menu-movil")
  ) {
    closeAll();
  }
});