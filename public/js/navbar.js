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

function toggleUser() {
  const dd = document.getElementById("user-dd");

  if (!dd) return;

  const isOpen = dd.classList.contains("open");
  closeAll();

  if (!isOpen) {
    dd.classList.add("open");
  }
}

function closeAll() {
  document
    .querySelectorAll(".nav-item.open")
    .forEach((item) => item.classList.remove("open"));

  const userDd = document.getElementById("user-dd");

  if (userDd) {
    userDd.classList.remove("open");
  }
}

/* cerrar al hacer click por fuera */
document.addEventListener("click", (e) => {
  if (!e.target.closest(".nav-item") && !e.target.closest(".nav-right")) {
    closeAll();
  }
});
