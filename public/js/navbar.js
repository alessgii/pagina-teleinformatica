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
async function logoutUser() {
  const baseUrl = window.BASE_URL || '/pagina-teleinformatica/';
  try {
    await fetch(`${baseUrl}api/logout`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      }
    });
  } catch (err) {
    console.error('Error al cerrar sesión:', err);
  } finally {
    window.location.href = `${baseUrl}inicio`;
  }
}

