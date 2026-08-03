<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/galeria.css">

<header class="gal-header">
  <div class="wrap">
    <h1>Proyectos, prácticas y vida INTEL</h1>
    <p>Redes, robótica, programación y mantenimiento: un vistazo real a lo que se hace dentro y fuera del aula en Ingeniería en Teleinformática.</p>
  </div>
</header>

<nav class="filters">
  <div class="wrap filter-row" id="filterRow">
    <!-- generado por el javascript -->
  </div>
</nav>

<main class="gal-main">
  <div class="wrap">
    <div class="gal-grid" id="galGrid"><!-- generado por el javascript --></div>
    <div class="empty-state" id="emptyState">
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
      <p>Aún no hay fotos en esta categoría.</p>
    </div>
  </div>
</main>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
  <div class="lb-inner">
    <button class="lb-close" id="lbClose" aria-label="Cerrar"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    <button class="lb-nav lb-prev" id="lbPrev" aria-label="Anterior"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M15 18l-6-6 6-6"/></svg></button>
    <button class="lb-nav lb-next" id="lbNext" aria-label="Siguiente"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M9 18l6-6-6-6"/></svg></button>
    <div class="lb-img-wrap"><img id="lbImg" src="" alt=""></div>
    <div class="lb-caption">
      <span class="gal-tag" id="lbTag"></span>
      <h3 id="lbTitle"></h3>
      <p id="lbDesc"></p>
      <div class="lb-counter" id="lbCounter"></div>
    </div>
  </div>
</div>

<script src="<?php echo BASE_URL; ?>public/js/galeria.js"></script>