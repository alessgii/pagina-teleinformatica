/* cascada en boton de semestres */

function toggleSemDd() {
  const dd = document.getElementById("sem-dd");
  const chev = document.getElementById("sem-chev");

  if (!dd) return;

  const isOpen = dd.classList.toggle("open");

  if (chev) {
    chev.style.transform = isOpen ? "rotate(180deg)" : "";
  }
}

/* scroll en semestres */

function goTo(id) {
  const semDd = document.getElementById("sem-dd");
  const chev = document.getElementById("sem-chev");

  if (semDd) semDd.classList.remove("open");
  if (chev) chev.style.transform = "";

  const section = document.getElementById(id);

  if (section) {
    section.scrollIntoView({
      behavior: "smooth",
      block: "start",
    });
  }

  return false; 
  
}

