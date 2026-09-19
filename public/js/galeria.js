const CATEGORIES = [
  {id:'todos', label:'Todos'},
  {id:'eventos', label:'Eventos'},
  {id:'practicas', label:'Prácticas'},
  {id:'proyectos', label:'Proyectos'},
  {id:'aulas', label:'Aulas'},
  {id:'instalaciones', label:'Instalaciones'},
  {id:'vida-estudiantil', label:'Vida estudiantil'},
];

const PHOTOS = [
  {src:'public/img/inicio/ganminisumo.jpeg', cats:['eventos'], title:'Torneo de minisumo', desc:'El equipo de Teleinformática compite con un robot diseñado y programado en los laboratorios del centro.'},
  {src:'public/img/inicio/ingenierias.jpeg', cats:['eventos'], title:'INTEL y Mecatrónica', desc:'Colaboración entre ingenierías para integrar redes de sensores en sistemas automatizados.'},
  {src:'public/img/inicio/tallermantenimiento.jpeg', cats:['practicas'], title:'Taller de mantenimiento', desc:'Diagnóstico y reparación de equipo de cómputo en el taller del centro.'},
  {src:'public/img/galeria/img3.jpeg', cats:['practicas'], title:'Mantenimiento de equipos', desc:'Práctica de mantenimiento preventivo y correctivo sobre equipo de red.'},
  {src:'public/img/galeria/img9.jpeg', cats:['practicas'], title:'Reparación de celulares', desc:'Práctica de diagnóstico y reparación de dispositivos móviles.'},
  {src:'public/img/galeria/img1.jpeg', cats:['proyectos'], title:'Redes de cómputo', desc:'Proyecto de diseño e implementación de una red de cómputo.'},
  {src:'public/img/galeria/img2.jpeg', cats:['proyectos','aulas'], title:'Verilog', desc:'Práctica de diseño digital con lenguaje de descripción de hardware Verilog.'},
  {src:'public/img/galeria/img4.jpeg', cats:['proyectos'], title:'Reloj digital', desc:'Proyecto de electrónica digital: reloj construido sobre protoboard.'},
  {src:'public/img/galeria/img5.jpeg', cats:['proyectos'], title:'Kali Linux', desc:'Práctica de ciberseguridad y auditoría de redes con Kali Linux.'},
  {src:'public/img/galeria/img6.jpeg', cats:['proyectos'], title:'Proyectos de electrónica', desc:'Prototipo de electrónica desarrollado por estudiantes del programa.'},
  {src:'public/img/galeria/img7.jpeg', cats:['proyectos'], title:'Programación en Lua', desc:'Proyecto de programación aplicada usando el lenguaje Lua.'},
  {src:'public/img/galeria/img8.jpeg', cats:['proyectos'], title:'Redes de cómputo II', desc:'Segunda práctica de configuración y administración de redes.'},
  {src:'public/img/inicio/alumnosintel.jpeg', cats:['vida-estudiantil','aulas'], title:'Comunidad INTEL', desc:'Estudiantes del programa trabajando en equipo dentro del laboratorio.'},
];

const grid = document.getElementById('galGrid');
const filterRow = document.getElementById('filterRow');
const emptyState = document.getElementById('emptyState');
const resultCount = document.getElementById('resultCount');
let activeFilter = 'todos';

const STICKY_OFFSET = 150;

const BTN_BASE = 'inline-flex shrink-0 snap-start items-center gap-2 whitespace-nowrap text-[.85rem] font-semibold py-2.5 px-4 rounded-full border cursor-pointer transition-colors duration-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-turq-acc';
const BTN_INACTIVE = 'bg-bg-card border-border-main text-text-mid hover:border-turq-acc hover:text-navy';
const BTN_ACTIVE = 'bg-navy border-navy text-white shadow-[0_6px_16px_rgba(9,64,116,0.28)]';
const CNT_BASE = 'text-[.68rem] leading-none py-1 px-1.5 rounded-full transition-colors duration-200';
const CNT_INACTIVE = 'bg-bg-main text-text-muted';
const CNT_ACTIVE = 'bg-white/20 text-white';

const CARD_BASE = 'group relative flex flex-col w-full p-0 overflow-hidden text-left cursor-pointer aspect-[4/3] sm:aspect-[4/5] lg:aspect-auto rounded-2xl bg-bg-card border border-border-lt shadow-[var(--shadow-custom)] transition-[transform,box-shadow] duration-300 hover:shadow-[var(--shadow-custom-lg)] lg:hover:-translate-y-1 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-turq-acc';

const labelOf = id => (CATEGORIES.find(c => c.id === id) || {}).label || '';

function countFor(catId){
  if (catId === 'todos') return PHOTOS.length;
  return PHOTOS.filter(p => p.cats.includes(catId)).length;
}

/* Oculta las categorías que todavía no tienen fotos */
const VISIBLE_CATEGORIES = CATEGORIES.filter(c => c.id === 'todos' || countFor(c.id) > 0);

/* ---------- Filtros ---------- */
function buildFilters(){
  filterRow.innerHTML = VISIBLE_CATEGORIES.map(c => `
    <button type="button" data-cat="${c.id}" aria-pressed="false">
      ${c.label}
      <span class="${CNT_BASE}">${countFor(c.id)}</span>
    </button>
  `).join('');

  filterRow.querySelectorAll('button[data-cat]').forEach(btn => {
    btn.addEventListener('click', () => applyFilter(btn.dataset.cat));
  });
  updateFilters(false);
}

/* Solo cambia clases (no vuelve a crear los botones), así el scroll horizontal no se reinicia */
function updateFilters(centerActive){
  filterRow.querySelectorAll('button[data-cat]').forEach(btn => {
    const active = btn.dataset.cat === activeFilter;
    btn.className = BTN_BASE + ' ' + (active ? BTN_ACTIVE : BTN_INACTIVE);
    btn.setAttribute('aria-pressed', String(active));
    btn.querySelector('span').className = CNT_BASE + ' ' + (active ? CNT_ACTIVE : CNT_INACTIVE);

    if (active && centerActive) {
      const left = btn.offsetLeft - (filterRow.clientWidth - btn.offsetWidth) / 2;
      filterRow.scrollTo({ left: Math.max(0, left), behavior: 'smooth' });
    }
  });
}

function updateResults(n){
  const total = PHOTOS.length;
  const fotos = n === 1 ? 'foto' : 'fotos';
  resultCount.textContent = activeFilter === 'todos'
    ? `Mostrando ${total} ${total === 1 ? 'foto' : 'fotos'}`
    : `Mostrando ${n} de ${total} ${fotos} en «${labelOf(activeFilter)}»`;
}

/* ---------- Tarjetas ---------- */
function renderGrid(){
  /* animation-fill-mode:backwards -> al terminar la entrada se libera el transform y funciona el hover */
  grid.innerHTML = PHOTOS.map((p, i) => `
    <button type="button"
            class="${CARD_BASE} animate-fade-in-up"
            style="animation-delay:${Math.min(i * 40, 320)}ms;animation-fill-mode:backwards"
            data-cats="${p.cats.join(' ')}"
            data-index="${i}"
            aria-label="Ver foto: ${p.title}">

      <!-- Foto: cubre toda la tarjeta en celular/tablet; en escritorio queda arriba, enmarcada y redondeada -->
      <span class="absolute inset-0 block overflow-hidden lg:relative lg:inset-auto lg:m-2 lg:aspect-[16/10] lg:rounded-xl">
        <img src="${p.src}" alt="${p.title}" loading="lazy" decoding="async"
             class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-500 ease-out group-hover:scale-[1.06]">

        <span class="absolute inset-0 bg-gradient-to-t from-navy-mid/90 via-navy-mid/25 to-transparent pointer-events-none lg:hidden"></span>

        <span class="absolute top-3 left-3 z-[2] text-[.65rem] font-bold tracking-wide uppercase bg-white/95 text-navy py-1 px-2.5 rounded-full shadow-sm">
          ${labelOf(p.cats[0])}
        </span>

        <span class="absolute top-3 right-3 z-[2] flex items-center justify-center w-8 h-8 rounded-full bg-white/95 text-navy shadow-sm opacity-0 scale-75 transition-all duration-200 group-hover:opacity-100 group-hover:scale-100 group-focus-visible:opacity-100 group-focus-visible:scale-100" aria-hidden="true">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/><path d="M11 8v6M8 11h6"/></svg>
        </span>
      </span>

      <!-- Texto: sobre la foto en celular/tablet; debajo, en tarjeta blanca, en escritorio -->
      <span class="absolute inset-x-0 bottom-0 z-[2] block p-4 lg:static lg:flex lg:flex-col lg:flex-1 lg:px-5 lg:pt-2 lg:pb-5">
        <span class="block text-white text-base font-bold leading-tight mb-1 lg:text-navy lg:text-[1.05rem] lg:mb-1.5">${p.title}</span>
        <span class="text-white/80 text-[.8rem] leading-snug line-clamp-2 lg:text-text-mid lg:text-[.88rem] lg:leading-relaxed">${p.desc}</span>

        <span class="hidden lg:flex items-center justify-between gap-3 mt-auto pt-4">
          <span class="flex-1 min-w-0 truncate text-[.75rem] text-text-muted border-t-0">${p.cats.map(labelOf).join(' · ')}</span>
          <span class="inline-flex shrink-0 items-center gap-1.5 text-[.8rem] font-semibold text-turq-acc transition-all duration-200 group-hover:gap-2.5">
            Ver foto
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="13 6 19 12 13 18"/></svg>
          </span>
        </span>
      </span>
    </button>
  `).join('');

  grid.querySelectorAll('[data-index]').forEach(card => {
    card.addEventListener('click', () => openLightbox(parseInt(card.dataset.index, 10)));
  });
  updateResults(PHOTOS.length);
}

function applyFilter(catId){
  if (catId === activeFilter) return;
  activeFilter = catId;
  updateFilters(true);

  let shown = 0;
  grid.querySelectorAll('[data-cats]').forEach(card => {
    const matches = catId === 'todos' || card.dataset.cats.split(' ').includes(catId);
    card.classList.toggle('hidden', !matches);

    if (matches) {
      /* Reinicia la animación de entrada con un pequeño escalonado */
      card.classList.remove('animate-fade-in-up');
      void card.offsetWidth;
      card.style.animationDelay = Math.min(shown * 40, 320) + 'ms';
      card.classList.add('animate-fade-in-up');
      shown++;
    }
  });

  emptyState.classList.toggle('hidden', shown > 0);
  updateResults(shown);

  /* Si el usuario había bajado mucho, regresa al inicio de la cuadrícula */
  const top = grid.getBoundingClientRect().top;
  if (top < STICKY_OFFSET) {
    window.scrollTo({ top: window.scrollY + top - STICKY_OFFSET, behavior: 'smooth' });
  }
}

/* ---------- Lightbox ---------- */
const lightbox = document.getElementById('lightbox');
const lbPanel = document.getElementById('lbPanel');
const lbImg = document.getElementById('lbImg');
const lbBackdrop = document.getElementById('lbBackdrop');
const lbTag = document.getElementById('lbTag');
const lbTitle = document.getElementById('lbTitle');
const lbDesc = document.getElementById('lbDesc');
const lbCounter = document.getElementById('lbCounter');
const lbClose = document.getElementById('lbClose');
const lbPrev = document.getElementById('lbPrev');
const lbNext = document.getElementById('lbNext');

let currentIndex = 0;
let lastFocused = null;
let closeTimer = null;

const isLightboxOpen = () => !lightbox.classList.contains('hidden');

function visibleIndexes(){
  if (activeFilter === 'todos') return PHOTOS.map((_, i) => i);
  return PHOTOS.map((p, i) => p.cats.includes(activeFilter) ? i : -1).filter(i => i >= 0);
}

function openLightbox(index){
  clearTimeout(closeTimer);
  lastFocused = document.activeElement;
  currentIndex = index;
  updateLightbox();

  lightbox.classList.remove('hidden');
  lightbox.classList.add('flex');
  requestAnimationFrame(() => {
    lightbox.classList.remove('opacity-0');
    lightbox.classList.add('opacity-100');
    lbPanel.classList.remove('scale-95');
    lbPanel.classList.add('scale-100');
  });
  document.body.style.overflow = 'hidden';
  lbClose.focus({ preventScroll: true });
}

function closeLightbox(){
  lightbox.classList.remove('opacity-100');
  lightbox.classList.add('opacity-0');
  lbPanel.classList.remove('scale-100');
  lbPanel.classList.add('scale-95');
  document.body.style.overflow = '';

  closeTimer = setTimeout(() => {
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
  }, 300);

  if (lastFocused && lastFocused.focus) lastFocused.focus({ preventScroll: true });
}

function updateLightbox(){
  const p = PHOTOS[currentIndex];
  lbImg.src = p.src;
  lbImg.alt = p.title;
  lbBackdrop.style.backgroundImage = `url('${p.src}')`;
  lbTag.textContent = labelOf(p.cats[0]);
  lbTitle.textContent = p.title;
  lbDesc.textContent = p.desc;

  const vis = visibleIndexes();
  const pos = vis.indexOf(currentIndex);
  lbCounter.textContent = (pos + 1) + ' / ' + vis.length;

  /* Precarga la foto anterior y la siguiente para que el cambio sea instantáneo */
  [pos - 1, pos + 1].forEach(n => {
    const idx = vis[(n + vis.length) % vis.length];
    if (idx !== undefined && idx !== currentIndex) new Image().src = PHOTOS[idx].src;
  });
}

function step(dir){
  const vis = visibleIndexes();
  let pos = vis.indexOf(currentIndex);
  pos = (pos + dir + vis.length) % vis.length;
  currentIndex = vis[pos];
  updateLightbox();
}

lbClose.addEventListener('click', closeLightbox);
lbPrev.addEventListener('click', () => step(-1));
lbNext.addEventListener('click', () => step(1));

/* Cerrar al tocar el fondo */
lightbox.addEventListener('click', e => {
  if (e.target === lightbox || e.target === lbPanel) closeLightbox();
});

/* Gesto de deslizar en celular */
let touchStartX = null;
lbPanel.addEventListener('touchstart', e => {
  touchStartX = e.changedTouches[0].clientX;
}, { passive: true });
lbPanel.addEventListener('touchend', e => {
  if (touchStartX === null) return;
  const dx = e.changedTouches[0].clientX - touchStartX;
  touchStartX = null;
  if (Math.abs(dx) > 50) step(dx < 0 ? 1 : -1);
}, { passive: true });

/* Teclado: flechas, Escape y foco atrapado dentro del visor */
document.addEventListener('keydown', e => {
  if (!isLightboxOpen()) return;

  if (e.key === 'Escape') closeLightbox();
  if (e.key === 'ArrowLeft') step(-1);
  if (e.key === 'ArrowRight') step(1);

  if (e.key === 'Tab') {
    const focusables = [lbClose, lbPrev, lbNext];
    const first = focusables[0];
    const last = focusables[focusables.length - 1];
    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault();
      last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault();
      first.focus();
    }
  }
});

buildFilters();
renderGrid();