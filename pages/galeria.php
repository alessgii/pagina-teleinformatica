<!--Ya no es necesario el css -->

<header class="pt-[3.4rem] pb-[2.6rem] text-center"><!-- en talwind utilizamos el css pero de manera mas practica y resumida dandole clases a cada componente-->
  <div class="max-w-[1180px] mx-auto px-5 md:px-10">
    <h1 class="text-[clamp(2rem,4.4vw,2.9rem)] font-extrabold text-[var(--navy)] -tracking-tight mb-[0.8rem]">
      Proyectos, prácticas y vida INTEL
    </h1>
    <p class="text-[var(--text-mid)] text-base max-w-[560px] mx-auto leading-[1.7]">
      Redes, robótica, programación y mantenimiento: un vistazo real a lo que se hace dentro y fuera del aula en Ingeniería en Teleinformática.
    </p>
  </div>
</header>

<nav class="sticky top-0 z-[200] bg-[rgba(244,247,251,0.92)] backdrop-blur-md border-b border-[var(--border-lt)] py-[1.1rem]">
  <div class="max-w-[1180px] mx-auto px-5 md:px-10 flex gap-[0.6rem] flex-wrap items-center" id="filterRow">
    <!-- generado por el javascript -->
  </div>
</nav>

<main class="pt-[2.8rem] pb-20">
  <div class="max-w-[1180px] mx-auto px-5 md:px-10">
    <div class="grid grid-cols-1 min-[461px]:grid-cols-2 min-[721px]:grid-cols-3 min-[1025px]:grid-cols-4 gap-[1.1rem]" id="galGrid">
      <!-- generado por el javascript -->
    </div>

    <div class="hidden [&.show]:block text-center py-16 px-4 text-[var(--text-muted)]" id="emptyState">
      <svg class="mb-4 text-[var(--border)] mx-auto" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <circle cx="11" cy="11" r="8"/>
        <path d="M21 21l-4.35-4.35"/>
      </svg>
      <p class="text-[0.9rem]">Aún no hay fotos en esta categoría.</p>
    </div>
  </div>
</main>

<!-- LIGHTBOX -->
<div class="fixed inset-0 z-[3000] bg-[#031120]/92 backdrop-blur-[6px] hidden [&.open]:flex items-center justify-center p-8 opacity-0 [&.open]:opacity-100 transition-opacity duration-300" id="lightbox">
  <div class="relative max-w-[960px] w-full max-h-[88vh] flex flex-col items-center scale-95 transition-transform duration-300 [.lightbox.open_&]:scale-100">
    
    <!-- Botón Cerrar -->
    <button class="absolute -top-2 -right-2 max-[900px]:top-2 max-[900px]:right-2 w-[42px] h-[42px] rounded-full bg-white border-0 text-[var(--navy)] flex items-center justify-center cursor-pointer shadow-lg transition-transform duration-200 hover:rotate-90 z-20" id="lbClose" aria-label="Cerrar">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    
    <!-- Navegación Anterior / Siguiente -->
    <button class="absolute top-1/2 -translate-y-1/2 -left-[70px] max-[900px]:left-2 w-[46px] h-[46px] rounded-full bg-white/14 border [border-width:1.5px] border-white/30 text-white flex items-center justify-center cursor-pointer transition-colors duration-200 hover:bg-white/28 z-20" id="lbPrev" aria-label="Anterior">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    
    <button class="absolute top-1/2 -translate-y-1/2 -right-[70px] max-[900px]:right-2 w-[46px] h-[46px] rounded-full bg-white/14 border [border-width:1.5px] border-white/30 text-white flex items-center justify-center cursor-pointer transition-colors duration-200 hover:bg-white/28 z-20" id="lbNext" aria-label="Siguiente">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M9 18l6-6-6-6"/></svg>
    </button>

    <!-- Imagen del Lightbox -->
    <div class="relative max-h-[70vh] rounded-2xl overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.5)]">
      <img id="lbImg" src="" alt="" class="max-h-[70vh] w-auto max-w-full object-contain block">
    </div>

    <!-- Pie de Foto -->
    <div class="text-center text-white mt-[1.2rem] max-w-[640px]">
      <span class="static inline-flex mb-[0.6rem] text-[0.62rem] font-bold tracking-[0.4px] uppercase bg-white/92 text-[var(--turq)] py-[0.3rem] px-[0.55rem] rounded-full" id="lbTag"></span>
      <h3 class="text-[1.15rem] font-bold mb-[0.35rem]" id="lbTitle"></h3>
      <p class="text-[#a9c2dc] text-[0.85rem] leading-[1.6]" id="lbDesc"></p>
      <div class="text-[0.72rem] text-[#8ba6c4] mt-[0.9rem]" id="lbCounter"></div>
    </div>

  </div>
</div>

<script src="<?php echo BASE_URL; ?>public/js/galeria.js"></script>