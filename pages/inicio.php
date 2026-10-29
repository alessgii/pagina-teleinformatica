<!-- HERO -->
<section class="pt-6 md:pt-15 pb-12 md:pb-24 bg-bg-main overflow-x-hidden" id="hero">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
    <div class="flex flex-col">
      <h1 class="font-poppins-bold text-4xl sm:text-4xl lg:text-5xl text-navy tracking-tight leading-tight">
        Diseña las redes que <span class="text-green">conectan</span> al mundo
      </h1>
      <p class="mt-4 text-base sm:text-lg text-text-mid leading-relaxed">
        Ingeniería en Teleinformática forma profesionistas capaces de diseñar, implementar y administrar
        redes de cómputo, sistemas de información y plataformas de comunicación de vanguardia.
      </p>
      
      <div class="mt-8 flex flex-col gap-5 w-full">
        <!-- Registro (ancho completo, arriba) -->
        <a href="https://escolar.udg.mx/" target="_blank"
          class="w-full inline-flex items-center justify-center px-6 py-3.5 border border-transparent text-base font-bold rounded-custom text-white-custom bg-green hover:bg-green-lt no-underline transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
          Inscribirse
          <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
            <path d="M5 12h14M13 6l6 6-6 6" />
          </svg>
        </a>

        <!-- 4 herramientas: Grid 2x2 en móvil, 4 columnas desde sm -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 w-full">
          <!-- Malla curricular -->
          <a href="<?php echo BASE_URL; ?>malla_curricular"
            class="group flex flex-col items-center justify-center text-center p-3 sm:p-4 border border-border-main rounded-2xl text-navy bg-bg-card hover:bg-turq-pale no-underline transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 box-border">
            <div class="w-10 h-10 rounded-full bg-bg-main group-hover:bg-white text-turq-acc flex items-center justify-center mb-2 transition-colors">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <path d="M3 9h18M9 21V9" />
              </svg>
            </div>
            <span class="text-xs sm:text-sm font-semibold leading-tight">Malla curricular</span>
          </a>
          
          <!-- Consultar horario -->
          <a href="<?php echo BASE_URL; ?>consulta_de_horarios"
            class="group flex flex-col items-center justify-center text-center p-3 sm:p-4 border border-border-main rounded-2xl text-navy bg-bg-card hover:bg-turq-pale no-underline transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 box-border">
            <div class="w-10 h-10 rounded-full bg-bg-main group-hover:bg-white text-turq-acc flex items-center justify-center mb-2 transition-colors">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 6v6l4 2" />
              </svg>
            </div>
            <span class="text-xs sm:text-sm font-semibold leading-tight">Consultar horario</span>
          </a>
          
          <!-- Becas -->
          <a href="<?php echo BASE_URL; ?>becas"
            class="group flex flex-col items-center justify-center text-center p-3 sm:p-4 border border-border-main rounded-2xl text-navy bg-bg-card hover:bg-turq-pale no-underline transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 box-border">
            <div class="w-10 h-10 rounded-full bg-bg-main group-hover:bg-white text-turq-acc flex items-center justify-center mb-2 transition-colors">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
              </svg>
            </div>
            <span class="text-xs sm:text-sm font-semibold leading-tight">Becas disponibles</span>
          </a>
          
          <!-- Foro -->
          <a href="<?php echo BASE_URL; ?>foro"
            class="group flex flex-col items-center justify-center text-center p-3 sm:p-4 border border-border-main rounded-2xl text-navy bg-bg-card hover:bg-turq-pale no-underline transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 box-border">
            <div class="w-10 h-10 rounded-full bg-bg-main group-hover:bg-white text-turq-acc flex items-center justify-center mb-2 transition-colors">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
              </svg>
            </div>
            <span class="text-xs sm:text-sm font-semibold leading-tight">Foro</span>
          </a>
        </div>
      </div>
    </div>
    
    <div class="w-full mt-4 lg:mt-0">
      <img src="public/img/inicio/Antena.webp" alt="Estudiantes de INTEL instalando antena" loading="lazy"
        class="w-full h-auto object-cover aspect-4/3 rounded-2xl shadow-lg">
    </div>
  </div>
</section>

<!-- SOBRE LA CARRERA -->
<section class="py-12 sm:py-16 bg-bg-card reveal" id="carrera">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">¿Por qué ser un ingeniero en teleinformatica?</h2>
    </div>
    <div class=" text-text-mid leading-relaxed grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
      <p>
        La tecnología día con día crece y se innova, junto a ella, el campo laboral en IT también lo hace,
        las redes que todos utilizamos para nuestro día a día requieren a personas que se encarguen de administrarlas y
        arreglarlas; cada día hay más necesidades en el apartado de software y campos como la ciberseguridad.
        <br><br>
        En estos casos, <strong class="text-text-main font-semibold">un Ingeniero en Teleinformática</strong>
        es el perfil perfecto para campos tan exigentes como estos, ya que es capaz de diseñar, implementar y
        administrar redes de cómputo, sistemas de información y plataformas de comunicación de vanguardia.
      </p>
      <img src="public/img/inicio/carrera.jpeg" alt="Estudiantes de Ingeniería en Teleinformática" loading="lazy"
        class="w-full h-64 sm:h-80 object-cover rounded-2xl shadow-custom">
    </div>
  </div>
</section>

<!-- NOTICIAS -->
<section class="py-12 sm:py-16 bg-bg-main" id="noticias">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">Noticias del programa</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">
        Descubre todo lo nuevo e interesante que sucede en el programa y su plantel.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 items-stretch">
      <div
        class="cursor-pointer bg-bg-card border border-border-main rounded-custom overflow-hidden shadow-custom flex flex-col transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 no-underline">
        <div class="h-44 sm:h-48 overflow-hidden shrink-0">
          <img src="public/img/inicio/ganminisumo.jpeg" alt="Torneo de minisumo" loading="lazy"
            class="w-full h-full object-cover">
        </div>
        <div class="p-5 flex flex-col flex-1 justify-between gap-3">
          <div>
            <div class="mb-3">
              <span
                class="font-poppins text-[12px] bg-green-pale text-green border border-green/25 py-1 px-2.5 rounded-full whitespace-nowrap inline-block">
                Competencias
              </span>
            </div>
            <h3 class="text-base sm:text-lg font-bold text-navy mb-2">
              Se gana el torneo de minisumo
            </h3>
            <p class="text-xs text-text-muted leading-relaxed mb-0">
              Estudiantes del programa se llevan el primer lugar con un robot diseñado y programado íntegramente en los
              laboratorios del centro universitario.
            </p>
          </div>
        </div>
      </div>

      <div
        class="cursor-pointer bg-bg-card border border-border-main rounded-custom overflow-hidden shadow-custom flex flex-col transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 no-underline">
        <div class="h-44 sm:h-48 overflow-hidden shrink-0">
          <img src="public/img/inicio/ingenierias.jpeg" alt="Colaboración en ingenierías" loading="lazy"
            class="w-full h-full object-cover">
        </div>
        <div class="p-5 flex flex-col flex-1 justify-between gap-3">
          <div>
            <div class="mb-3">
              <span
                class="font-poppins text-[12px] bg-purple-200 text-purple-500 border border-purple-300 py-1 px-2.5 rounded-full whitespace-nowrap inline-block">
                Vinculación
              </span>
            </div>
            <h3 class="text-base sm:text-lg font-bold text-navy mb-2">
              INTEL y Mecatrónica juntos
            </h3>
            <p class="text-xs text-text-muted leading-relaxed mb-0">
              Proyecto conjunto entre ambas ingenierías para integrar redes de sensores en sistemas automatizados.
            </p>
          </div>
        </div>
      </div>

      <div
        class="cursor-pointer bg-bg-card border border-border-main rounded-custom overflow-hidden shadow-custom flex flex-col transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 no-underline">
        <div class="h-44 sm:h-48 overflow-hidden shrink-0">
          <img src="public/img/inicio/fechas_Calif.jpeg" alt="Fechas de calificaciónes" loading="lazy"
            class="w-full h-full object-cover">
        </div>
        <div class="p-5 flex flex-col flex-1 justify-between gap-3">
          <div>
            <div class="mb-3">
              <span
                class="font-poppins text-[12px] bg-turq-pale text-turq-acc border border-turq-acc/25 py-1 px-2.5 rounded-full whitespace-nowrap inline-block">
                Aviso escolar
              </span>
            </div>
            <h3 class="text-base sm:text-lg font-bold text-navy mb-2">
              Periodo ordinario y extraordinario
            </h3>
            <p class="text-xs text-text-muted leading-relaxed mb-0">
              Ya están publicadas las fechas de calificación del ciclo. Consulta el calendario para no perder ningún
              trámite.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-8 sm:mt-12 text-center">
      <a href="<?php echo BASE_URL; ?>noticias"
        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-custom text-white-custom bg-green hover:bg-green-lt no-underline transition-all duration-300 shadow-md hover:shadow-xl  hover:-translate-y-0.5 box-border">
        Explorar las noticias más recientes
        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
          <path d="M5 12h14M13 6l6 6-6 6" />
        </svg>
      </a>
    </div>

  </div>
</section>

<!-- GALERIA -->
<section class="py-12 sm:py-16 bg-bg-card" id="galeria">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">Así se vive la carrera</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">
        Laboratorios, proyectos, torneos y trabajo en equipo dentro y fuera del aula.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 items-stretch">
      <div
        class="relative sm:col-span-2 sm:row-span-2 rounded-custom overflow-hidden group shadow-custom h-64 sm:h-auto">
        <img src="public/img/inicio/alumnosintel.jpeg" alt="Comunidad INTEL" loading="lazy"
          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        <span
          class="absolute bottom-3 left-3 bg-navy/80 text-white-custom text-xs px-3 py-1 rounded-full backdrop-blur-sm">Comunidad
          INTEL</span>
      </div>
      <div class="relative rounded-custom overflow-hidden group shadow-custom h-48">
        <img src="public/img/galeria/img1.jpeg" alt="Laboratorio" loading="lazy"
          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        <span
          class="absolute bottom-3 left-3 bg-navy/80 text-white-custom text-xs px-3 py-1 rounded-full backdrop-blur-sm">Laboratorio</span>
      </div>
      <div class="relative rounded-custom overflow-hidden group shadow-custom h-48">
        <img src="public/img/galeria/img3.jpeg" alt="Robótica" loading="lazy"
          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        <span
          class="absolute bottom-3 left-3 bg-navy/80 text-white-custom text-xs px-3 py-1 rounded-full backdrop-blur-sm">Taller</span>
      </div>
      <div class="relative rounded-custom overflow-hidden group shadow-custom h-48">
        <img src="public/img/inicio/tallermantenimiento.jpeg" alt="Taller" loading="lazy"
          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        <span
          class="absolute bottom-3 left-3 bg-navy/80 text-white-custom text-xs px-3 py-1 rounded-full backdrop-blur-sm">Taller</span>
      </div>
      <div class="relative rounded-custom overflow-hidden group shadow-custom h-48">
        <img src="public/img/galeria/img5.jpeg" alt="Trabajo en equipo" loading="lazy"
          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        <span
          class="absolute bottom-3 left-3 bg-navy/80 text-white-custom text-xs px-3 py-1 rounded-full backdrop-blur-sm">Programación</span>
      </div>
    </div>

    <div class="mt-8 sm:mt-12 text-center">
      <a href="<?php echo BASE_URL; ?>galeria"
        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-custom text-white-custom bg-green hover:bg-green-lt no-underline transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        Descubre más en nuestra galería
        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
          <path d="M5 12h14M13 6l6 6-6 6" />
        </svg>
      </a>
    </div>

  </div>
</section>

<!-- MISION, VISION Y OBJETIVOS -->
<section class="py-12 sm:py-16 bg-bg-main" id="mision-vision">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">Misión, visión y objetivos del programa</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">
        Lo que buscamos para que tu formación sea de alta calidad y te lleve a donde quieres llegar.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
      <button type="button"
        onclick="abrirMisionVision(this)"
        data-contenido="contenido-mision-vision"
        data-title="Misión y visión"
        data-subtitle="Lo que busca el programa y hacia dónde quiere llegar"
        class="group text-left p-6 sm:p-8 bg-bg-card rounded-custom border border-border-lt shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 cursor-pointer box-border">
        <div data-icon-slot class="flex items-center gap-3 mb-6">
          <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" />
              <circle cx="12" cy="12" r="6" />
              <circle cx="12" cy="12" r="2" />
            </svg>
          </div>
          <div class="w-12 h-12 rounded-full bg-green-pale text-green flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
              <circle cx="12" cy="12" r="3" />
            </svg>
          </div>
        </div>
        <h3 class="text-lg sm:text-xl font-bold text-navy mb-2 group-hover:text-sky-600 transition-colors">Misión y visión</h3>
        <p class="text-sm text-text-mid mb-4">Conoce el compromiso del programa y hacia dónde quiere llegar.</p>
        <span class="text-sm font-semibold text-turq-acc">Ver más →</span>
      </button>

      <!-- BOTÓN OBJETIVOS -->
      <button type="button"
        onclick="abrirMisionVision(this)"
        data-contenido="contenido-objetivos"
        data-title="Objetivos educacionales"
        data-subtitle="Las metas que el programa persigue de forma permanente"
        class="group text-left p-6 sm:p-8 bg-bg-card rounded-custom border border-border-lt shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 cursor-pointer box-border">
        <div data-icon-slot class="flex items-center gap-3 mb-6">
          <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <path d="M9 11l3 3L22 4" />
              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
            </svg>
          </div>
        </div>
        <h3 class="text-lg sm:text-xl font-bold text-navy mb-2 group-hover:text-sky-600 transition-colors">Objetivos educacionales</h3>
        <p class="text-sm text-text-mid mb-4">Las metas que garantizan la calidad de tu formación (OE1 a OE4).</p>
        <span class="text-sm font-semibold text-turq-acc">Ver más →</span>
      </button>

    </div>
  </div>
</section>

<!-- VISOR EMERGENTE -->
<div id="mv-viewer"
  onclick="cerrarMisionVision()"
  class="fixed inset-0 z-50 hidden items-center justify-center pt-16 pb-4 px-4 sm:pt-20 bg-black/70 backdrop-blur-sm opacity-0 transition-opacity duration-300">

  <button
    onclick="cerrarMisionVision()"
    type="button"
    aria-label="Cerrar"
    class="fixed top-3 right-3 sm:top-5 sm:right-5 lg:top-6 lg:right-6 z-20 flex items-center justify-center gap-2.5 w-11 h-11 lg:w-auto lg:px-5 rounded-full bg-white text-navy shadow-lg cursor-pointer transition-[transform,background-color] duration-200 hover:rotate-90 lg:hover:rotate-0 lg:hover:bg-bg-main">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true">
      <line x1="18" y1="6" x2="6" y2="18" />
      <line x1="6" y1="6" x2="18" y2="18" />
    </svg>
    <span class="hidden lg:inline text-sm font-semibold">Cerrar</span>
    <kbd class="hidden lg:inline text-[.65rem] font-semibold text-text-muted border border-border-main rounded-md px-1.5 py-0.5 font-[inherit]">Esc</kbd>
  </button>

  <div id="mv-panel"
    onclick="event.stopPropagation()"
    class="relative w-full max-w-[920px] max-h-[calc(100vh-6rem)] flex flex-col bg-bg-card rounded-2xl lg:rounded-[var(--radius-custom)] shadow-[0_24px_70px_rgba(0,0,0,0.5)] border border-border-lt overflow-hidden scale-95 transition-transform duration-300">

    <div class="shrink-0 flex items-center gap-4 bg-navy-mid px-5 py-5 sm:px-8 sm:py-6">
      <div id="mv-icons" class="flex items-center gap-3 shrink-0"></div>
      <div class="min-w-0">
        <h2 id="mv-title" class="text-xl sm:text-2xl font-bold text-white leading-snug tracking-tight"></h2>
        <p id="mv-subtitle" class="mt-1 text-xs sm:text-sm text-white/70"></p>
      </div>
    </div>

    <div id="mv-body" class="flex-1 overflow-y-auto p-5 sm:p-8">

      <!-- CONTENIDO: MISIÓN Y VISIÓN -->
      <div id="contenido-mision-vision" data-bloque class="hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
          <div class="p-5 sm:p-6 bg-bg-main rounded-custom border border-border-lt border-t-4 border-t-turq-acc">
            <h3 class="text-lg sm:text-xl font-bold text-navy mb-3">Misión</h3>
            <p class="text-sm sm:text-base text-text-mid leading-relaxed">
              El programa educativo tiene el compromiso social de formar Ingenieros en Teleinformática
              para aplicar conocimientos científicos y tecnológicos bajo estándares de calidad, con responsabilidad
              y pertinencia cultural, social y ambiental en beneficio de la prosperidad colectiva.
            </p>
          </div>
          <div class="p-5 sm:p-6 bg-bg-main rounded-custom border border-border-lt border-t-4 border-t-green">
            <h3 class="text-lg sm:text-xl font-bold text-navy mb-3">Visión</h3>
            <p class="text-sm sm:text-base text-text-mid leading-relaxed">
              Ser la mejor opción de estudios en la región y del estado de Jalisco en el mediano
              y largo plazo, formando profesionistas líderes y competentes en el uso y administración
              de las tecnologías de redes y sistemas de información mediante el uso de tecnología de vanguardia.
            </p>
          </div>
        </div>
      </div>

      <!-- CONTENIDO: OBJETIVOS -->
      <div id="contenido-objetivos" data-bloque class="hidden">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
          <div class="p-5 bg-bg-main rounded-custom border border-border-lt">
            <span class="inline-block px-3 py-1 bg-navy text-white font-bold text-xs rounded-full mb-3">OE1</span>
            <p class="text-sm text-text-mid leading-relaxed">
              Los egresados participan en el diseño, gestión y/o evaluación de proyectos de
              ingeniería para desarrollo de software o de infraestructura y servicios de telecomunicaciones
              en los sectores público y privado.
            </p>
          </div>
          <div class="p-5 bg-bg-main rounded-custom border border-border-lt">
            <span class="inline-block px-3 py-1 bg-navy text-white font-bold text-xs rounded-full mb-3">OE2</span>
            <p class="text-sm text-text-mid leading-relaxed">
              Los egresados se integran en grupos multidisciplinarios en las organizaciones del
              sector público o privado con ética y responsabilidad social.
            </p>
          </div>
          <div class="p-5 bg-bg-main rounded-custom border border-border-lt">
            <span class="inline-block px-3 py-1 bg-navy text-white font-bold text-xs rounded-full mb-3">OE3</span>
            <p class="text-sm text-text-mid leading-relaxed">
              Los egresados se incorporan al sector productivo y/o de servicios o son capaces
              de crear su propia empresa relacionada con la Ingeniería en Teleinformática.
            </p>
          </div>
          <div class="p-5 bg-bg-main rounded-custom border border-border-lt">
            <span class="inline-block px-3 py-1 bg-navy text-white font-bold text-xs rounded-full mb-3">OE4</span>
            <p class="text-sm text-text-mid leading-relaxed">
              Los egresados mantienen un permanente interés en el desarrollo y mejoramiento de sus
              competencias profesionales a través de cursos, diplomados o posgrados.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- PERFIL DE EGRESO -->
<section class="py-12 sm:py-16 bg-bg-card" id="objetivos">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">Perfil de egreso</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">
        Nuestros egresados son capaces de crear...
      </p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
      <div
        class="p-5 sm:p-6 bg-bg-main rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="2" y="3" width="20" height="14" rx="2" />
            <line x1="8" y1="21" x2="16" y2="21" />
            <line x1="12" y1="17" x2="12" y2="21" />
          </svg>
        </div>
        <h4 class="text-xs sm:text-sm font-bold text-navy mb-1">Desarrollo de software</h4>
        <p class="text-xs text-text-muted">Aplicaciones de escritorio, móviles y web en distintos lenguajes de
          programación.</p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-main rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="1" fill="currentColor" />
            <path d="M12 12v8" />
            <path d="M8 20h8" />
            <path d="M8.5 8.5a5 5 0 0 0 0 7" />
            <path d="M15.5 8.5a5 5 0 0 1 0 7" />
            <path d="M12 5v2" />
          </svg>
        </div>
        <h4 class="text-xs sm:text-sm font-bold text-navy mb-1">Redes de cómputo</h4>
        <p class="text-xs text-text-muted">Diseño, configuración y administración de redes y equipos de
          comunicación.</p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-main rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <ellipse cx="12" cy="5" rx="9" ry="3" />
            <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3" />
          </svg>
        </div>
        <h4 class="text-xs sm:text-sm font-bold text-navy mb-1">Sistemas de información</h4>
        <p class="text-xs text-text-muted">Diseño y administración de plataformas para el manejo de información a
          distancia.</p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-main rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
          </svg>
        </div>
        <h4 class="text-xs sm:text-sm font-bold text-navy mb-1">Mantenimiento técnico</h4>
        <p class="text-xs text-text-muted">Mantenimiento preventivo y correctivo de equipos de cómputo y
          comunicación.</p>
      </div>
    </div>
  </div>
</section>

<!-- CAMPO LABORAL -->
<section class="py-12 sm:py-16 bg-bg-main" id="campo-laboral">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy ">Campo Laboral</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">
        Un ingeniero en Teleinformática logra resolver problemas tecnológicos concretos. Estos son algunos de los
        sectores donde puede ejerce su
        profesión:
      </p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
      <div
        class="p-5 sm:p-6 bg-bg-card rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="1" fill="currentColor" />
            <path d="M12 12v8" />
            <path d="M8 20h8" />
            <path d="M8.5 8.5a5 5 0 0 0 0 7" />
            <path d="M15.5 8.5a5 5 0 0 1 0 7" />
            <path d="M12 5v2" />
          </svg>
        </div>
        <h4 class="text-sm sm:text-base font-bold text-navy mb-1">Telecomunicaciones</h4>
        <p class="text-xs text-text-muted leading-relaxed">
          Creación y manterimiento de redes inalambricas de alto y bajo nivel, así como la administración
          de redes de comunicación de datos.
        </p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-card rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="12" rx="2" />
            <line x1="8" y1="20" x2="16" y2="20" />
            <line x1="12" y1="16" x2="12" y2="20" />
          </svg>
        </div>
        <h4 class="text-sm sm:text-base font-bold text-navy mb-1">Desarrollo de software</h4>
        <p class="text-xs text-text-muted leading-relaxed">
          Diseño y desarrollo de herramientas de software para distintos fines, desde aplicaciones
          móviles hasta sistemas de información.
        </p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-card rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
          </svg>
        </div>
        <div class="text-navy mb-3"></div>
        <h4 class="text-sm sm:text-base font-bold text-navy mb-1">Industria y automatización</h4>
        <p class="text-xs text-text-muted leading-relaxed">
          Redes industriales, control y monitoreo de procesos productivos.
        </p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-card rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <ellipse cx="12" cy="5" rx="9" ry="3" />
            <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3" />
          </svg>
        </div>
        <h4 class="text-sm sm:text-base font-bold text-navy mb-1">Centros de datos</h4>
        <p class="text-xs text-text-muted leading-relaxed">
          Infraestructura de red, servidores y administración de sistemas de datos en masa.
        </p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-card rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 22s8-4.5 8-11V5l-8-3-8 3v6c0 6.5 8 11 8 11z" />
          </svg>
        </div>
        <h4 class="text-sm sm:text-base font-bold text-navy mb-1">Ciberseguridad</h4>
        <p class="text-xs text-text-muted leading-relaxed">
          Protección de redes, información y legislación en materia digital.
        </p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-card rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
          </svg>
        </div>
        <h4 class="text-sm sm:text-base font-bold text-navy mb-1">Consultoría en TI</h4>
        <p class="text-xs text-text-muted leading-relaxed">
          Asesoría tecnológica independiente para negocios y organismos.
        </p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-card rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4" />
          </svg>
        </div>
        <h4 class="text-sm sm:text-base font-bold text-navy mb-1">Sector público</h4>
        <p class="text-xs text-text-muted leading-relaxed">
          Instituciones y dependencias que operan y/o necesitan infraestructura tecnológica.
        </p>
      </div>
      <div
        class="p-5 sm:p-6 bg-bg-card rounded-custom border border-border-lt transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 box-border">
        <div class="w-12 h-12 rounded-full bg-turq-pale text-turq-acc flex items-center justify-center mb-6">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="12" rx="2" />
            <line x1="8" y1="20" x2="16" y2="20" />
            <line x1="12" y1="16" x2="12" y2="20" />
          </svg>
        </div>
        <h4 class="text-sm sm:text-base font-bold text-navy mb-1">Emprendimiento y/o Freelance</h4>
        <p class="text-xs text-text-muted leading-relaxed">
          Proyectos propios desde el trabajo independiente hasta creación de proyectos de amplia cobertura.
        </p>
      </div>
    </div>
  </div>
</section>
<script src="public/js/inicio.js"></script>