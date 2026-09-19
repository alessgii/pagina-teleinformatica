<!-- ===== Encabezado ===== -->
<header class="pt-10 pb-8 sm:pt-14 sm:pb-10 lg:pt-24 lg:pb-14 text-center">
  <div class="max-w-[1180px] mx-auto px-4 sm:px-6 lg:px-10">
    <h1 class="text-[clamp(1.75rem,4.4vw,2.9rem)] font-extrabold text-navy tracking-tight leading-tight mb-3 lg:mb-4">
      Proyectos, prácticas y vida INTEL
    </h1>
    <p class="text-text-mid text-[.95rem] sm:text-base max-w-[560px] mx-auto leading-[1.7]">
      Redes, robótica, programación y mantenimiento: un vistazo real a lo que se hace dentro y fuera del aula en Ingeniería en Teleinformática.
    </p>
  </div>
</header>

<!-- ===== Filtros (sticky debajo del navbar principal, que mide h-16) ===== -->
<nav class="sticky top-16 z-40 bg-bg-main/90 backdrop-blur-md border-b border-border-lt" aria-label="Categorías de la galería">
  <div class="max-w-[1180px] mx-auto px-4 sm:px-6 lg:px-10 py-3 sm:py-4">
  
    <div
      id="filterRow"
      role="group"
      aria-label="Filtrar fotos por categoría"
      class="relative flex gap-2 overflow-x-auto snap-x snap-proximity pr-10 -mx-4 px-4 pb-1
             [scrollbar-width:none] [&::-webkit-scrollbar]:hidden
             [mask-image:linear-gradient(to_right,#000_calc(100%-40px),transparent)]
             sm:mx-0 sm:px-0 sm:pr-0 sm:pb-0 sm:flex-wrap sm:justify-center sm:overflow-visible sm:[mask-image:none]"
    ></div>
  </div>
</nav>

<!-- ===== Galería ===== -->
<main class="pt-6 pb-16 sm:pt-10 sm:pb-20">
  <div class="max-w-[1180px] mx-auto px-4 sm:px-6 lg:px-10">

    <p id="resultCount" class="text-[.85rem] text-text-muted mb-4 sm:mb-5" aria-live="polite"></p>

    <!-- 1 col celular · 2 col tablet · 3 col escritorio (tarjetas 16:9) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 lg:gap-6" id="galGrid">
      <!-- generado por galeria.js -->
    </div>

    <div class="hidden text-center py-16 px-4 text-text-muted" id="emptyState">
      <svg class="mb-4 text-border-main mx-auto" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
        <circle cx="11" cy="11" r="8"/>
        <path d="M21 21l-4.35-4.35"/>
      </svg>
      <p class="text-[.9rem]">Aún no hay fotos en esta categoría.</p>
    </div>
  </div>
</main>

<!-- ===== Lightbox ===== -->
<div
  id="lightbox"
  class="fixed inset-0 z-[3000] hidden justify-center overflow-y-auto bg-navy-mid/95 backdrop-blur-sm p-4 sm:p-8 lg:p-10 opacity-0 transition-opacity duration-300"
  role="dialog"
  aria-modal="true"
  aria-label="Visor de fotos"
>
  <!-- Cerrar: círculo en celular · botón con texto "Cerrar" + Esc en escritorio -->
  <button
    id="lbClose"
    type="button"
    aria-label="Cerrar"
    class="fixed top-3 right-3 sm:top-5 sm:right-5 lg:top-6 lg:right-6 z-20 flex items-center justify-center gap-2.5 w-11 h-11 lg:w-auto lg:px-5 rounded-full bg-white text-navy shadow-lg cursor-pointer transition-[transform,background-color] duration-200 hover:rotate-90 lg:hover:rotate-0 lg:hover:bg-bg-main"
  >
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    <span class="hidden lg:inline text-sm font-semibold">Cerrar</span>
    <kbd class="hidden lg:inline text-[.65rem] font-semibold text-text-muted border border-border-main rounded-md px-1.5 py-0.5 font-[inherit]">Esc</kbd>
  </button>

 
  <div
    id="lbPanel"
    class="relative w-full max-w-[960px] my-auto flex flex-col items-center scale-95 transition-transform duration-300
           lg:max-w-[1080px] lg:grid lg:grid-cols-[minmax(0,1fr)_340px] lg:grid-rows-[minmax(0,1fr)] lg:items-stretch lg:h-[min(78vh,620px)] lg:overflow-hidden lg:rounded-[var(--radius-custom)] lg:bg-bg-card lg:shadow-[0_24px_70px_rgba(0,0,0,0.5)]"
  >

    <!-- Escenario de la imagen -->
    <div class="relative inline-flex max-w-full lg:flex lg:w-full lg:h-full lg:overflow-hidden lg:bg-navy-mid">

      <!-- Fondo desenfocado con la misma foto (solo escritorio): rellena los huecos de fotos que no son 16:9 -->
      <div id="lbBackdrop" aria-hidden="true" class="hidden lg:block absolute inset-0 bg-cover bg-center scale-125 blur-2xl opacity-50"></div>

      <img
        id="lbImg"
        src=""
        alt=""
        class="relative z-[1] block w-auto max-w-full max-h-[62vh] sm:max-h-[68vh] object-contain rounded-[var(--radius-custom)] shadow-[0_20px_60px_rgba(0,0,0,0.5)]
               lg:absolute lg:inset-0 lg:w-full lg:h-full lg:max-h-none lg:rounded-none lg:shadow-none"
      >

      <button
        id="lbPrev"
        type="button"
        aria-label="Anterior"
        class="absolute top-1/2 -translate-y-1/2 left-2 lg:left-4 z-10 flex items-center justify-center w-11 h-11 rounded-full bg-navy-mid/60 backdrop-blur-sm border border-white/30 text-white cursor-pointer transition-colors duration-200 hover:bg-navy-mid/90"
      >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
      </button>

      <button
        id="lbNext"
        type="button"
        aria-label="Siguiente"
        class="absolute top-1/2 -translate-y-1/2 right-2 lg:right-4 z-10 flex items-center justify-center w-11 h-11 rounded-full bg-navy-mid/60 backdrop-blur-sm border border-white/30 text-white cursor-pointer transition-colors duration-200 hover:bg-navy-mid/90"
      >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>

    <!-- Pie de foto / panel de información -->
    <div class="text-center text-white mt-5 max-w-[640px]
                lg:mt-0 lg:max-w-none lg:text-left lg:text-text-main lg:p-8 lg:flex lg:flex-col lg:justify-center lg:overflow-y-auto">
      <span id="lbTag" class="inline-flex self-start mb-2.5 text-[.65rem] font-bold tracking-wide uppercase bg-white/95 text-navy py-1 px-2.5 rounded-full lg:bg-turq-pale lg:mb-4"></span>
      <h3 id="lbTitle" class="text-[1.1rem] sm:text-[1.2rem] font-bold mb-1.5 lg:text-[1.5rem] lg:leading-tight lg:text-navy lg:mb-3"></h3>
      <p id="lbDesc" class="text-white/75 text-[.88rem] leading-[1.6] lg:text-text-mid lg:text-[.95rem] lg:leading-[1.7]"></p>
      <div id="lbCounter" class="text-[.75rem] text-white/60 mt-4 lg:text-text-muted lg:mt-8 lg:pt-4 lg:border-t lg:border-border-lt"></div>
    </div>
  </div>
</div>

<script src="<?php echo BASE_URL; ?>public/js/galeria.js"></script>