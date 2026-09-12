document.addEventListener("DOMContentLoaded", () => {

  const btn = document.getElementById("sem-btn");
  const dd = document.getElementById("sem-dd");
  const chev = document.getElementById("sem-chev");

  if (!btn || !dd) return;

  function openDd() {
    dd.classList.add("open");
    btn.setAttribute("aria-expanded", "true");

    if (chev) {
      chev.style.transform = "rotate(180deg)";
    }
  }

  function closeDd() {
    dd.classList.remove("open");
    btn.setAttribute("aria-expanded", "false");

    if (chev) {
      chev.style.transform = "rotate(0deg)";
    }
  }

  function isOpen() {
    return dd.classList.contains("open");
  }

  window.toggleSemDd = function () {
    isOpen() ? closeDd() : openDd();
  };

  window.goTo = function (id) {
    closeDd();

    const section = document.getElementById(id);

    if (section) {
      section.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  };

});