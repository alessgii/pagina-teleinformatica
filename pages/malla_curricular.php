<section class="text-center z-50 bg-bg-main px-5 pt-12 pb-10 md:px-10 md:pt-[4.5rem] md:pb-12 max-w-6xl mx-auto">
  <h1 class="font-poppins-bold text-4xl sm:text-4xl lg:text-5xl text-navy tracking-tight leading-tight">
    Malla Curricular
  </h1>
  <p class="text-base sm:text-lg text-text-mid leading-relaxed mb-6 md:mb-8">
    Explora nuestro programa educativo especializado en redes, telecomunicaciones y programación.
  </p>

  <div class="relative inline-block z-[100]">
    <a href="#" id="sem-btn" role="button" aria-haspopup="true" aria-expanded="false" aria-controls="sem-dd"
      class="inline-flex items-center gap-3 bg-green text-white select-none rounded-xl py-3 px-6 font-poppins text-sm font-semibold cursor-pointer hover:bg-green-lt no-underline transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border"
      onclick="toggleSemDd(); return false;">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
        <circle cx="11" cy="11" r="8" />
        <path d="m21 21-4.35-4.35" />
      </svg>
      Buscar por semestre
      <svg id="sem-chev" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
        class="transition-transform duration-200 ml-1">
        <path d="m6 9 6 6 6-6" />
      </svg>
    </a>

    <div class="absolute top-full mt-2.5 left-0 w-60 bg-bg-card border border-border-main rounded-custom p-2 shadow-custom-lg opacity-0 pointer-events-none -translate-y-1.5 transition duration-200 z-[9999] [&.open]:opacity-100 [&.open]:pointer-events-auto [&.open]:translate-y-0 [&.open]:animate-slide-down"
      id="sem-dd">

      <a href="#sem1" onclick="goTo('sem1')"
        class="flex items-center justify-between py-2.5 px-4 rounded-lg no-underline text-text-mid text-sm transition duration-150 hover:bg-green-pale hover:text-green"><span>1er
          Semestre</span></a>

      <a href="#sem2" onclick="goTo('sem2')"
        class="flex items-center justify-between py-2.5 px-4 rounded-lg no-underline text-text-mid text-sm transition duration-150 hover:bg-green-pale hover:text-green"><span>2do
          Semestre</span></a>

      <a href="#sem3" onclick="goTo('sem3')"
        class="flex items-center justify-between py-2.5 px-4 rounded-lg no-underline text-text-mid text-sm transition duration-150 hover:bg-green-pale hover:text-green"><span>3er
          Semestre</span></a>

      <a href="#sem4" onclick="goTo('sem4')"
        class="flex items-center justify-between py-2.5 px-4 rounded-lg no-underline text-text-mid text-sm transition duration-150 hover:bg-green-pale hover:text-green"><span>4to
          Semestre</span></a>

      <a href="#sem5" onclick="goTo('sem5')"
        class="flex items-center justify-between py-2.5 px-4 rounded-lg no-underline text-text-mid text-sm transition duration-150 hover:bg-green-pale hover:text-green"><span>5to
          Semestre</span></a>

      <a href="#sem6" onclick="goTo('sem6')"
        class="flex items-center justify-between py-2.5 px-4 rounded-lg no-underline text-text-mid text-sm transition duration-150 hover:bg-green-pale hover:text-green"><span>6to
          Semestre</span></a>

      <a href="#sem7" onclick="goTo('sem7')"
        class="flex items-center justify-between py-2.5 px-4 rounded-lg no-underline text-text-mid text-sm transition duration-150 hover:bg-green-pale hover:text-green"><span>7mo
          Semestre</span></a>

      <a href="#sem8" onclick="goTo('sem8')"
        class="flex items-center justify-between py-2.5 px-4 rounded-lg no-underline text-text-mid text-sm transition duration-150 hover:bg-green-pale hover:text-green"><span>8vo
          Semestre</span></a>
    </div>
  </div>
</section>

<section class="max-w-6xl mx-auto px-5 pt-2 pb-12 md:px-10 md:pb-16">

  <div class="justify-center flex flex-wrap gap-2 md:gap-3 mb-6 md:mb-10 py-3 px-4 md:py-4 md:px-5 bg-bg-card border border-border-main rounded-custom">
    <span>Tipos de materia:</span>
    <span class="flex items-center gap-2 text-xs text-text-mid"><span
        class="inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">EO</span>
      Especializante Obligatoria</span>
    <span class="flex items-center gap-2 text-xs text-text-mid"><span
        class="inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">OA</span>
      Optativa Abierta</span>
    <span class="flex items-center gap-2 text-xs text-text-mid"><span
        class="inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-amber-200 text-amber-500 border border-amber-300">BPO</span>
      Basica Particular Obligatoria</span>
    <span class="flex items-center gap-2 text-xs text-text-mid"><span
        class="inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">BCO</span>
      Basica Comun Obligatoria</span>
  </div>

  <!-- PRIMER SEMESTRE -->
  <div class="mb-10 md:mb-14 scroll-mt-20" id="sem1">
  <div class="flex items-center md:items-end gap-3 md:gap-5 mb-5 md:mb-7 pb-3 md:pb-4 border-b-2 border-border-lt">
    <div class="font-poppins text-[2.5rem] md:text-7xl font-extrabold text-border-main leading-none tracking-tight shrink-0">
      01
    </div>
    <div>
      <h2 class="font-poppins text-xl md:text-2xl font-bold text-navy mb-1">Primer Semestre</h2>
      <p class="text-sm text-text-muted">
        Introducción a la teleinformática y tecnologías básicas · 9 materias
      </p>
    </div>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">

    <!-- Tarjeta 1 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col justify-between sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div>
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            TU173
          </span>
        </div>
        <h3 class="mt-6 sm:mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Seminario de Comunicación Oral y Escrita
        </h3>
        <p class="mt-4 sm:mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug">
          Seminario para fortalecer expresión oral, redacción académica y comunicación profesional.
        </p>
      </div>

      <div class="mt-5 sm:mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 3 créditos
        </span>
      </div>
    </div>

      <!-- Tarjeta 2 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-amber-200 text-amber-500 border border-amber-300">
          BPO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN245
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Fundamentos de Creatividad y Desarrollo
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos de código limpio, ordenado y eficiente aplicando buenas prácticas.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 5 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 3 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          TU169
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Inglés Técnico I
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Desarrolla lectura, escritura y comunicación oral mediante textos técnicos en inglés.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 7 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 4 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
          OA
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN250
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Taller de Instrumentación
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce componentes electrónicos básicos y su funcionamiento en circuitos analógicos y digitales.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 3 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 5 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
          OA
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN281
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Manejo de Programación de Multimedia
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos de programación aplicados al desarrollo de proyectos multimedia.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 6 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN227
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Fundamentos de Computación
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce historia, arquitectura y funcionamiento de los sistemas computacionales modernos.
        </p>

      <div class="mt-6 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 9 créditos
        </span>
        </div>
    </div>

    <!-- Tarjeta 7 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN222
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Álgebra y Geometría
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Refuerza álgebra y geometría mediante fundamentos aplicados a problemas matemáticos.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 9 créditos
        </span>
        </div>
    </div>

    <!-- Tarjeta 8 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN253
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Seminario de APTO I
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Refuerza conocimientos y habilidades de teleinformática para mejorar tu desempeño académico.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 4 créditos
        </span>
        </div>
    </div>

    <!-- Tarjeta 9 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
          OA
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN252
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Taller de Redes
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos de redes mediante configuración y administración de sistemas conectados.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 3 créditos
        </span>
        </div>
    </div>

    </div>
  </div>

  <!-- SEGUNDO SEMESTRE -->
  <div class="mb-10 md:mb-14 scroll-mt-20" id="sem2">
    <div class="flex items-end gap-3 md:gap-5 mb-5 md:mb-7 pb-3 md:pb-4 border-b-2 border-border-lt">
      <div class="font-poppins text-[2.5rem] md:text-7xl font-extrabold text-border-main leading-none tracking-tight shrink-0">
        02
      </div>
      <div>
        <h2 class="font-poppins text-xl md:text-2xl font-bold text-navy mb-1">Segundo Semestre</h2>
        <p class="text-sm text-text-muted">
          Redes y programación básicas · 8 materias
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">

      <!-- Tarjeta 1 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          TU170
        </span>
      </div>
      <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Inglés Técnico II
      </h3>
      <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Desarrolla lectura, documentación y comunicación oral enfocadas en inglés técnico.
        </p>
      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg>Requiere Inglés Técnico I
        </div>
      <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 7 créditos
        </span>
        </div>
    </div>


      <!-- Tarjeta 2 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
          OA
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN248
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Curso de Internet
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende creación de páginas web mediante tecnologías y herramientas fundamentales.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 5 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 3 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-amber-200 text-amber-500 border border-amber-300">
          BPO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN238
        </span>
      </div>

      <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Programación Imperativa
      </h3>
      <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende programación imperativa usando estructuras de control, funciones y algoritmos.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Fundamentos de C.
        </div>
      <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 4 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN252
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Teleinformática
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce fundamentos de teleinformática, redes, protocolos y servicios de comunicación.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 3 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 5 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN228
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Electrónica Analógica
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce componentes y fundamentos de electrónica analógica para desarrollar circuitos funcionales.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 6 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN236
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Redes de Computo I
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos, protocolos y servicios para implementar y administrar redes de cómputo.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

    <!-- Tarjeta 7 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN223
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Teoría del Cálculo I
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Refuerza cálculo diferencial mediante conceptos de derivación aplicados a problemas matemáticos.
        </p>

      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Álgebra y Geometría
        </div>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 13 créditos
        </span>
        </div>
    </div>

    <!-- Tarjeta 8 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN254
        </span>
      </div>

      <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Seminario de APTO II
      </h3>
      <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Refuerza conocimientos de teleinformática para mejorar tus habilidades y desempeño académico.
        </p>

      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Seminario de APTO I
        </div>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 4 créditos
        </span>
        </div>
    </div>

    </div> 
  </div>

    <!-- TERCER SEMESTRE -->
  <div class="mb-10 md:mb-14 scroll-mt-20" id="sem3">
    <div class="flex items-end gap-3 md:gap-5 mb-5 md:mb-7 pb-3 md:pb-4 border-b-2 border-border-lt">
      <div class="font-poppins text-[2.5rem] md:text-7xl font-extrabold text-border-main leading-none tracking-tight shrink-0">
        03
      </div>
      <div>
        <h2 class="font-poppins text-xl md:text-2xl font-bold text-navy mb-1">Tercer Semestre</h2>
        <p class="text-sm text-text-muted">
          Redes, programación y electrónica digital · 8 materias
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">

      <!-- Tarjeta 1 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          TU172
        </span>
      </div>
      <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Cultura Deportiva
      </h3>
      <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Comprende la importancia del deporte y actividad física para mantener hábitos saludables.
        </p>
      <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 3 créditos
        </span>
        </div>
    </div>


      <!-- Tarjeta 2 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN279
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Ciencia y Tecnología
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce avances científicos y tecnológicos que han influido en el desarrollo social.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 5 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 3 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-amber-200 text-amber-500 border border-amber-300">
          BPO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN265
        </span>
      </div>

      <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Fundamentos de Programación Orientada a Objetos
      </h3>
      <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende conceptos y principios fundamentales de programación orientada a objetos.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Programación I.
        </div>
      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 4 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN265
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Tecnologías de la Información
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Utiliza herramientas tecnológicas para desarrollar proyectos audiovisuales atractivos y funcionales.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 3 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 5 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN229
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Electrónica Digital
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Fortalece conocimientos de electrónica para desarrollar y comprender circuitos digitales.
        </p>
      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Electrónica A.
        </div>
      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 6 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN237
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Redes de Cómputo II
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos, protocolos y servicios necesarios para desarrollar redes de cómputo.
        </p>
      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Redes de C. I
        </div>
      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

    <!-- Tarjeta 7 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN224
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Teoría del Cálculo II
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Refuerza cálculo integral mediante conceptos de integración aplicados a problemas matemáticos.
        </p>

      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Teoría del C. I
        </div>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 13 créditos
        </span>
        </div>
    </div>

    <!-- Tarjeta 8 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN255
        </span>
      </div>

      <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Seminario de APTO III
      </h3>
      <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Refuerza conocimientos de teleinformática para mejorar tus habilidades y desempeño académico.
        </p>

      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Seminario de APTO II
        </div>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 4 créditos
        </span>
        </div>
    </div>

    </div> 
  </div>

  <!-- CUARTO SEMESTRE -->
  <div class="mb-10 md:mb-14 scroll-mt-20" id="sem4">
    <div class="flex items-end gap-3 md:gap-5 mb-5 md:mb-7 pb-3 md:pb-4 border-b-2 border-border-lt">
      <div class="font-poppins text-[2.5rem] md:text-7xl font-extrabold text-border-main leading-none tracking-tight shrink-0">
        04
      </div>
      <div>
        <h2 class="font-poppins text-xl md:text-2xl font-bold text-navy mb-1">Cuarto Semestre</h2>
        <p class="text-sm text-text-muted">
          Redes, programación y electrónica digital · 8 materias
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">

      <!-- Tarjeta 1 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          TU171
        </span>
      </div>
      <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Arte y Cultura
      </h3> 
      <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Comprende cómo arte y cultura contribuyen al desarrollo de la sociedad.
        </p>
      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 3 créditos
        </span>
        </div>
    </div>


      <!-- Tarjeta 2 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-amber-200 text-amber-500 border border-amber-300">
          BPO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN226
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Administración General I
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende principios básicos para administrar recursos y procesos de forma correcta.
        </p>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 5 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 3 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN226
        </span>
      </div>

      <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Fundamentos de Estructura de Datos
      </h3>
      <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos para diseñar, desarrollar y organizar bases de datos correctamente.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Programación I.
        </div>
      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 4 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-amber-200 text-amber-500 border border-amber-300">
          BPO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN287
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Teleinformática II
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce fundamentos de teleinformática, redes, protocolos y servicios de comunicación.
        </p>

      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Teleinformática I
        </div>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 11 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 5 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN230
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Electrónica Digital II
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Fortalece conocimientos de electrónica para desarrollar y comprender circuitos digitales.
        </p>
      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Electrónica D. I
        </div>
      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

      <!-- Tarjeta 6 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN285
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Redes de Cómputo III
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos, protocolos y servicios necesarios para desarrollar redes de cómputo.
        </p>
      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Redes de C. II
        </div>
      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 8 créditos
        </span>
        </div>
    </div>

    <!-- Tarjeta 7 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
          BCO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN225
        </span>
      </div>

      <h3 class="mt-6 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Teoría del Cálculo III
      </h3>
      <p class="mt-4 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Refuerza cálculo integral mediante conceptos de integración aplicados a problemas matemáticos.
        </p>

      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Teoría del C. II
        </div>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 13 créditos
        </span>
        </div>
    </div>

    <!-- Tarjeta 8 -->
    <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
      <div class="flex items-start justify-between gap-2">
        <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
          EO
        </span>
        <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
          IN256
        </span>
      </div>

      <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
        Seminario de APTO IV
      </h3>
      <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Refuerza conocimientos de teleinformática para mejorar tus habilidades y desempeño académico.
        </p>

      <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Seminario de APTO III
        </div>

      <div class="mt-5 flex items-center pt-2 border-t border-border-lt">
        <span class="flex items-center gap-1 text-xs text-text-muted">
          ◴ 4 créditos
        </span>
        </div>
    </div>

    </div> 
  </div>

  



  <!-- QUINTO SEMESTRE -->
  <div class="mb-10 md:mb-14 scroll-mt-20" id="sem5">
    <div class="flex items-end gap-3 md:gap-5 mb-5 md:mb-7 pb-3 md:pb-4 border-b-2 border-border-lt">
      <div class="font-poppins text-[2.5rem] md:text-7xl font-extrabold text-border-main leading-none tracking-tight shrink-0">
        05
      </div>
      <div>
        <h2 class="font-poppins text-xl md:text-2xl font-bold text-navy mb-1">Quinto Semestre</h2>
        <p class="text-sm text-text-muted">
          Sistemas, redes y fundamentos tecnológicos · 8 materias
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">

      <!-- Tarjeta 1 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
            OA
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN235
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Fundamentos de Sistemas Operativos
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Comprende conceptos esenciales de sistemas operativos, procesos, memoria, archivos y administración de recursos.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 2 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-amber-200 text-amber-500 border border-amber-300">
            BPO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            CA103
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Administración General II
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende principios administrativos para planear, organizar y controlar recursos dentro de una organización.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Administración G. I
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 5 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 3 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN234
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Fundamentos de Sistemas de Información
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce los fundamentos de sistemas de información y su aplicación en organizaciones y procesos.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Fundamentos de E.D.
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 11 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 4 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN271
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Redes Inalámbricas y Emergentes
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende tecnologías inalámbricas y emergentes para diseñar, configurar y administrar redes modernas.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 5 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN251
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Arquitectura de Computadoras
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Comprende componentes, organización y funcionamiento interno de las computadoras y sus sistemas.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Electronica D. II
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 6 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
            BCO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN244
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Aprendizaje de Proyectos Básicos
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Desarrolla habilidades para buscar, analizar y presentar información mediante procesos de investigación.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 5 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 7 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
            BCO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN261
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Matemática Avanzada
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aplica conceptos matemáticos avanzados para resolver problemas relacionados con la teleinformática.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Teoria del C. III
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 8 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN257
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Seminario de APTO V
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Fortalece conocimientos y habilidades de teleinformática mediante actividades prácticas y académicas.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Seminario de APTO IV
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 4 créditos
          </span>
        </div>
      </div>

    </div>
  </div>

  <!-- SEXTO SEMESTRE -->
  <div class="mb-10 md:mb-14 scroll-mt-20" id="sem6">
    <div class="flex items-end gap-3 md:gap-5 mb-5 md:mb-7 pb-3 md:pb-4 border-b-2 border-border-lt">
      <div class="font-poppins text-[2.5rem] md:text-7xl font-extrabold text-border-main leading-none tracking-tight shrink-0">
        06
      </div>
      <div>
        <h2 class="font-poppins text-xl md:text-2xl font-bold text-navy mb-1">Sexto Semestre</h2>
        <p class="text-sm text-text-muted">
          Programación, comunicación y sistemas distribuidos · 9 materias
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">

      <!-- Tarjeta 1 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN269
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Tecnología Cliente Servidor
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Comprende la comunicación entre clientes y servidores mediante tecnologías utilizadas en aplicaciones distribuidas.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 2 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-amber-200 text-amber-500 border border-amber-300">
            BPO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN273
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Curso Programación Avanzada en Internet
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Desarrolla aplicaciones avanzadas para internet utilizando programación, servicios y tecnologías web.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 3 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN233
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Introducción a la Ingeniería Económica
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce principios económicos para evaluar costos, beneficios y alternativas en proyectos tecnológicos.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 5 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 4 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN270
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Tecnología de la Comunicación I
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos de tecnologías de comunicación y su aplicación en sistemas teleinformáticos.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 5 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN264
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Fundamentos de Programación de Sistemas
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Desarrolla fundamentos de programación orientados a sistemas, procesos y recursos computacionales.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Arquitectura de C.
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 6 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
            OA
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN244
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Aprendizaje de Proyectos Básicos
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Desarrolla habilidades mediante proyectos básicos que integran conocimientos técnicos y prácticos.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 13 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 7 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN267
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Sistemas Operativos Abiertos
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce características, administración y funcionamiento de sistemas operativos abiertos y sus herramientas.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 11 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 8 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN258
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Seminario de APTO VI
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Fortalece conocimientos y habilidades de teleinformática mediante actividades prácticas y académicas.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Seminario de APTO V
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 4 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 9 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN263
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Diseño de Sistemas Distribuidos
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende principios para diseñar sistemas distribuidos eficientes, escalables y capaces de trabajar colaborativamente.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

    </div>
  </div>

  <!-- SÉPTIMO SEMESTRE -->
  <div class="mb-10 md:mb-14 scroll-mt-20" id="sem7">
    <div class="flex items-end gap-3 md:gap-5 mb-5 md:mb-7 pb-3 md:pb-4 border-b-2 border-border-lt">
      <div class="font-poppins text-[2.5rem] md:text-7xl font-extrabold text-border-main leading-none tracking-tight shrink-0">
        07
      </div>
      <div>
        <h2 class="font-poppins text-xl md:text-2xl font-bold text-navy mb-1">Séptimo Semestre</h2>
        <p class="text-sm text-text-muted">
          Software, redes y gestión tecnológica · 9 materias
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">

      <!-- Tarjeta 1 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN268
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Ingeniería de Software
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende procesos y herramientas para planear, desarrollar, probar y mantener software de calidad.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 2 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
            OA
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            CP179
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Planeación de Proyectos de Inversión
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce técnicas para planear, evaluar y organizar proyectos de inversión tecnológica.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 5 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 3 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
            BCO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            EJ200
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Ética Profesional
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Reflexiona sobre principios éticos y responsabilidades profesionales dentro del ámbito tecnológico.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 4 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN280
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Tecnología de la Comunicación II
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Profundiza en tecnologías de comunicación aplicadas a sistemas y redes teleinformáticas.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Tecnologías de la C. I
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 5 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN247
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Teoría y Tecnología de Rutas
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Comprende fundamentos de enrutamiento y tecnologías utilizadas para conectar diferentes redes.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 6 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
            OA
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN244
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Introducción a los Lenguajes Visuales
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce fundamentos de lenguajes visuales para desarrollar interfaces y aplicaciones interactivas.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 7 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
            BCO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN278
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Probabilidad y Estadística
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aplica conceptos de probabilidad y estadística para analizar datos y resolver problemas.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Algebra y Geometria
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 8 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN259
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Seminario de APTO VII
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Fortalece conocimientos y habilidades de teleinformática mediante actividades prácticas y académicas.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Seminario de APTO VI
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 4 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 9 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
            OA
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN284
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Bases de Datos Distribuidas
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos para diseñar, administrar y utilizar bases de datos distribuidas.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

    </div>
  </div>

  <!-- OCTAVO SEMESTRE -->
  <div class="mb-10 md:mb-14 scroll-mt-20" id="sem8">
    <div class="flex items-end gap-3 md:gap-5 mb-5 md:mb-7 pb-3 md:pb-4 border-b-2 border-border-lt">
      <div class="font-poppins text-[2.5rem] md:text-7xl font-extrabold text-border-main leading-none tracking-tight shrink-0">
        08
      </div>
      <div>
        <h2 class="font-poppins text-xl md:text-2xl font-bold text-navy mb-1">Octavo Semestre</h2>
        <p class="text-sm text-text-muted">
          Proyecto terminal, auditoría y tecnologías avanzadas · 8 materias
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">

      <!-- Tarjeta 1 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
            BCO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN276
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Seminario de Proyecto Terminal
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Integra conocimientos adquiridos para planear, desarrollar y presentar un proyecto terminal.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 11 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 2 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-purple-200 text-purple-500 border border-purple-300">
            BCO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            EJ199
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Seminario de Propiedad Intelectual
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce principios de propiedad intelectual aplicados a proyectos, desarrollos e innovaciones tecnológicas.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 5 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 3 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
            OA
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN262
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Fundamentos de Auditoría Informática
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aprende fundamentos para evaluar controles, seguridad y cumplimiento dentro de sistemas informáticos.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 4 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN283
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Tecnología de la Comunicación III
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Profundiza en tecnologías avanzadas de comunicación aplicadas a redes y sistemas teleinformáticos.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Tecnología de la C. II
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 5 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
            OA
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN274
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Fundamentos de Internet II
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Amplía conocimientos sobre servicios, tecnologías y funcionamiento de internet y sus aplicaciones.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 5 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 6 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
            OA
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN282
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Matemáticas Discretas para Teleinformática
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Aplica estructuras discretas para resolver problemas relacionados con computación y teleinformática.
        </p>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 11 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 7 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-turq-acc border border-turq-acc/25">
            OA
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN286
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Sistemas de Control
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Conoce principios de sistemas de control para analizar, modelar y automatizar procesos.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Matematica Avanzada
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 8 créditos
          </span>
        </div>
      </div>

      <!-- Tarjeta 8 -->
      <div class="bg-bg-card border border-border-main rounded-custom p-4 flex flex-col sm:aspect-square shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
        <div class="flex items-start justify-between gap-2">
          <span class="text-[12px] inline-flex items-center py-1 px-2.5 rounded-full text-2xs font-bold uppercase tracking-wide whitespace-nowrap bg-green-pale text-green border border-green/25">
            EO
          </span>
          <span class="font-poppins text-[12px] text-text-muted bg-bg-main border border-border-main py-1 px-2 rounded-md whitespace-nowrap">
            IN260
          </span>
        </div>
        <h3 class="mt-5 mb-0 font-poppins text-sm md:text-base font-bold text-navy leading-tight">
          Seminario de APTO VIII
        </h3>
        <p class="mt-3 mb-0 text-xs md:text-sm text-text-mid leading-snug flex-1">
          Fortalece conocimientos y habilidades de teleinformática mediante actividades prácticas y académicas.
        </p>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-500 bg-amber-200 border border-amber-300 rounded-lg py-1.5 px-2.5">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            <line x1="12" y1="9" x2="12" y2="13" />
            <line x1="12" y1="17" x2="12.01" y2="17" />
          </svg> Requiere Seminario de APTO VII
        </div>
        <div class="mt-3 flex items-center pt-2 border-t border-border-lt">
          <span class="flex items-center gap-1 text-xs text-text-muted">
            ◴ 4 créditos
          </span>
        </div>
      </div>

    </div>
  </div>

  <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full">
  <a href="https://cucsur.udg.mx/sites/default/files/adjuntos/manual-de-titulacion-teleinformatica-25.pdf" target="_blank"
     class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-custom text-white-custom bg-green hover:bg-green-lt no-underline transition-all duration-300 shadow-md hover:shadow-xl  hover:-translate-y-0.5 box-border">
    Manual de Titulación
  </a>
  <a href="https://cucsur.udg.mx/sites/default/files/adjuntos/plan-de-estudios-intel-2025.pdf" target="_blank"
     class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-border-main text-base font-medium rounded-custom text-navy bg-bg-card hover:bg-turq-pale no-underline transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
    Plan de Estudios
  </a>
</div>

</section>

<script src="<?php echo BASE_URL; ?>public/js/malla_curricular.js"></script>