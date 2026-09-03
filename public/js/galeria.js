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
  {src:'public/img/inicio/carrera.jpg', cats:['vida-estudiantil','instalaciones'], title:'Encuentro estudiantil', desc:'Comunidad de Ingeniería en Teleinformática en las instalaciones del CUCSur.'},
];

const grid = document.getElementById('galGrid');
const filterRow = document.getElementById('filterRow');
const emptyState = document.getElementById('emptyState');
let activeFilter = 'todos';

function countFor(catId){
  if(catId === 'todos') return PHOTOS.length;
  return PHOTOS.filter(p=> p.cats.includes(catId)).length;
}

function renderFilters(){
  filterRow.innerHTML = CATEGORIES.map(c => `
    <button class="filter-btn${c.id===activeFilter?' active':''}" data-cat="${c.id}">
      ${c.label} <span class="cnt">${countFor(c.id)}</span>
    </button>
  `).join('');
  filterRow.querySelectorAll('.filter-btn').forEach(btn=>{
    btn.addEventListener('click', ()=> applyFilter(btn.dataset.cat));
  });
}

function renderGrid(){
  grid.innerHTML = PHOTOS.map((p,i) => `
    <div class="gal-card entering" data-cats="${p.cats.join(' ')}" data-index="${i}">
      <span class="gal-tag">${CATEGORIES.find(c=>c.id===p.cats[0]).label}</span>
      <span class="gal-zoom"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/><path d="M11 8v6M8 11h6"/></svg></span>
      <img src="${p.src}" alt="${p.title}" loading="lazy">
      <div class="gal-info"><h3>${p.title}</h3><p>${p.desc}</p></div>
    </div>
  `).join('');
  grid.querySelectorAll('.gal-card').forEach(card=>{
    card.addEventListener('click', ()=> openLightbox(parseInt(card.dataset.index)));
  });
}

function applyFilter(catId){
  activeFilter = catId;
  renderFilters();
  const cards = grid.querySelectorAll('.gal-card');
  let anyVisible = false;
  cards.forEach(card=>{
    const cats = card.dataset.cats.split(' ');
    const matches = catId === 'todos' || cats.includes(catId);
    if(matches){
      anyVisible = true;
      if(card.classList.contains('hide')){
        card.classList.remove('hide');
        card.classList.add('entering');
        setTimeout(()=> card.classList.remove('entering'), 500);
      }
    } else {
      card.classList.add('leaving');
      setTimeout(()=>{ card.classList.add('hide'); card.classList.remove('leaving'); }, 420);
    }
  });
  emptyState.classList.toggle('show', !anyVisible);
}

const lightbox = document.getElementById('lightbox');
const lbImg = document.getElementById('lbImg');
const lbTag = document.getElementById('lbTag');
const lbTitle = document.getElementById('lbTitle');
const lbDesc = document.getElementById('lbDesc');
const lbCounter = document.getElementById('lbCounter');
let currentIndex = 0;

function visibleIndexes(){
  if(activeFilter === 'todos') return PHOTOS.map((_,i)=>i);
  return PHOTOS.map((p,i)=> p.cats.includes(activeFilter) ? i : -1).filter(i=> i>=0);
}

function openLightbox(index){
  currentIndex = index;
  updateLightbox();
  lightbox.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeLightbox(){
  lightbox.classList.remove('open');
  document.body.style.overflow = '';
}
function updateLightbox(){
  const p = PHOTOS[currentIndex];
  lbImg.src = p.src;
  lbImg.alt = p.title;
  lbTag.textContent = CATEGORIES.find(c=>c.id===p.cats[0]).label;
  lbTitle.textContent = p.title;
  lbDesc.textContent = p.desc;
  const vis = visibleIndexes();
  const pos = vis.indexOf(currentIndex) + 1;
  lbCounter.textContent = pos + ' / ' + vis.length;
}
function step(dir){
  const vis = visibleIndexes();
  let pos = vis.indexOf(currentIndex);
  pos = (pos + dir + vis.length) % vis.length;
  currentIndex = vis[pos];
  updateLightbox();
}
document.getElementById('lbClose').addEventListener('click', closeLightbox);
document.getElementById('lbPrev').addEventListener('click', ()=> step(-1));
document.getElementById('lbNext').addEventListener('click', ()=> step(1));
lightbox.addEventListener('click', (e)=>{ if(e.target === lightbox) closeLightbox(); });
document.addEventListener('keydown', (e)=>{
  if(!lightbox.classList.contains('open')) return;
  if(e.key === 'Escape') closeLightbox();
  if(e.key === 'ArrowLeft') step(-1);
  if(e.key === 'ArrowRight') step(1);
});

renderFilters();
renderGrid();