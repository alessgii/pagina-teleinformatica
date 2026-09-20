/* NavBar */

function toggleNav(id) {
  const el = document.getElementById(id);

  if (!el) return;

  const isOpen = el.classList.contains("open");
  closeAll();

  if (!isOpen) {
    el.classList.add("open");
  }
}

function toggleUser(e) {
  if (e) e.stopPropagation();
  const container = document.getElementById("user-menu-container");

  if (!container) return;

  const isOpen = container.classList.contains("open");
  closeAll();

  if (!isOpen) {
    container.classList.add("open");
  }
}

function closeAll() {
  document
    .querySelectorAll(".nav-item.open")
    .forEach((item) => item.classList.remove("open"));

  const userContainer = document.getElementById("user-menu-container");
  if (userContainer) {
    userContainer.classList.remove("open");
  }
}

/* cerrar al hacer click por fuera */
document.addEventListener("click", (e) => {
  if (!e.target.closest(".nav-item") && !e.target.closest(".nav-right")) {
    closeAll();
  }
});

/* Cerrar sesión y redirigir a inicio */
function logoutUser(e) {
  if (e) {
    e.preventDefault();
    e.stopPropagation();
  }
  const baseUrl = window.BASE_URL || '/pagina-teleinformatica/';
  window.location.href = baseUrl + 'logout';
}

