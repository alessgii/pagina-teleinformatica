<section class="text-center z-50 bg-bg-main px-5 pt-12 pb-7 md:px-10 md:pt-[4.5rem] md:pb-3 max-w-6xl mx-auto">
  <h1 class="font-poppins-bold text-4xl sm:text-4xl lg:text-5xl text-navy tracking-tight leading-tight">
    Proyectos
  </h1>
  <p class="mx-auto max-w-xl text-base sm:text-lg text-text-mid leading-relaxed mt-2 mb-6 md:mb-8">
    Explora lo que construyen alumnos y maestros: robótica, código, redes y mucho más.
  </p>
</section>


<!-- Busqueda y filtros (Necesita la parte logica y la reaccion puede ser con js)-->
<section class="max-w-6xl mx-auto px-5 pt-2 pb-28 md:px-10 md:pb-16">


  <div
    class="barra-busqueda-filtros flex flex-col gap-4 mb-6 md:mb-8 p-4 bg-bg-card border border-border-main rounded-custom shadow-custom">

    <div class="flex flex-col gap-3 md:flex-row md:items-center md:gap-4">
      <div class="busqueda relative flex-1">
        <svg class="icono-busqueda pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted"
          width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
          <circle cx="11" cy="11" r="8" />
          <path d="m21 21-4.35-4.35" />
        </svg>
        <input type="search" id="campo-busqueda" placeholder="Buscar por título, tecnología o autor"
          class="campo-busqueda w-full rounded-full border border-border-main bg-bg-main py-3 pl-10 pr-4 text-base text-text-mid placeholder:text-text-muted focus:border-navy focus:bg-bg-card focus:outline-none focus:ring-2 focus:ring-navy/20 md:py-2.5 md:text-sm">
      </div>

      <div class="filtros-secundarios flex flex-col gap-3 sm:flex-row sm:items-center">
        <label
          class="filtro-autor flex items-center gap-3 text-xs font-semibold uppercase tracking-wide text-text-muted">
          Autor
          <select id="filtro-autor"
            class="selector-autor flex-1 rounded-full border border-border-main bg-bg-card px-3 py-2.5 text-base font-medium normal-case tracking-normal text-navy focus:outline-none focus:ring-2 focus:ring-navy/20 md:flex-none md:py-2 md:text-sm">
            <option value="">Todos</option>
            <option value="Alumno">Alumnos</option>
            <option value="Maestro">Maestros</option>
          </select>
        </label>

        <label
          class="filtro-fecha flex items-center gap-3 text-xs font-semibold uppercase tracking-wide text-text-muted">
          Fecha
          <select id="filtro-fecha"
            class="selector-fecha flex-1 rounded-full border border-border-main bg-bg-card px-3 py-2.5 text-base font-medium normal-case tracking-normal text-navy focus:outline-none focus:ring-2 focus:ring-navy/20 md:flex-none md:py-2 md:text-sm">
            <option value="recientes">Todos</option>
            <option value="recientes">Más Recientes</option>
            <option value="antiguos">Más Antiguos</option>
          </select>
        </label>
      </div>
    </div>

    <nav
      class="filtros-categoria w-full flex flex-wrap items-center justify-center gap-2 pt-3 border-t border-border-lt md:gap-3"
      aria-label="Categorías">
      <button type="button" data-categoria="Todos"
        class="categoria categoria-activa bg-navy text-white border-navy shadow-md rounded-full border px-3.5 py-1.5 text-[13px] font-semibold transition-all duration-300 sm:px-4 sm:py-2 sm:text-sm">
        Todos
      </button>

      <button type="button" data-categoria="Robótica"
        class="categoria bg-bg-card text-navy border-border-main hover:bg-turq-pale rounded-full border px-3.5 py-1.5 text-[13px] font-semibold transition-all duration-300 sm:px-4 sm:py-2 sm:text-sm">
        Robótica
      </button>

      <button type="button" data-categoria="Programación"
        class="categoria bg-bg-card text-navy border-border-main hover:bg-turq-pale rounded-full border px-3.5 py-1.5 text-[13px] font-semibold transition-all duration-300 sm:px-4 sm:py-2 sm:text-sm">
        Programación
      </button>

      <button type="button" data-categoria="Redes"
        class="categoria bg-bg-card text-navy border-border-main hover:bg-turq-pale rounded-full border px-3.5 py-1.5 text-[13px] font-semibold transition-all duration-300 sm:px-4 sm:py-2 sm:text-sm">
        Redes
      </button>

      <button type="button" data-categoria="Inteligencia Artificial"
        class="categoria bg-bg-card text-navy border-border-main hover:bg-turq-pale rounded-full border px-3.5 py-1.5 text-[13px] font-semibold transition-all duration-300 sm:px-4 sm:py-2 sm:text-sm">
        Inteligencia Artificial
      </button>
  </div>


  <!-- Feed (Es necesario agregar la vista de como se ve la publicacion al darle click)-->
  <section>
    <p class="contador-resultados mb-4 text-sm text-text-muted">
      Mostrando <span class="font-semibold text-navy"> 1 </span> proyecto
    </p>

    <div class="feed-proyectos grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">


      <!-- Tarjetas del feed -->
      <article
        class="tarjeta-proyecto flex flex-col overflow-hidden bg-bg-card border border-border-main rounded-custom shadow-custom transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">

        <a href="#ManoRobotica" style="height: 180px; min-height: 180px; max-height: 180px;"
          class="tarjeta-imagen relative block w-full shrink-0 overflow-hidden bg-bg-main">
          <img src="https://saberesyciencias.com.mx/wp-content/uploads/2015/04/p-10.jpg"
            alt="Brazo robótico automatizado" loading="lazy" style="height: 180px; width: 100%; object-fit: cover;"
            class="block">
          <span
            class="etiqueta-categoria absolute left-3 top-3 inline-flex items-center py-1 px-2.5 rounded-full text-[11px] font-bold uppercase tracking-wide whitespace-nowrap bg-turq-pale text-navy shadow-sm">
            Robótica
          </span>
        </a>

        <div class="tarjeta-contenido flex flex-1 flex-col justify-between p-4">

          <div class="flex flex-col gap-2">
            <h2 class="tarjeta-titulo m-0 font-poppins text-base font-bold text-navy leading-snug">
              Brazo robótico controlado por visión artificial
            </h2>
            <p class="tarjeta-descripcion m-0 line-clamp-2 text-xs md:text-sm text-text-mid leading-relaxed">
              Prototipo de brazo de 4 ejes capaz de clasificar objetos por color y tamaño utilizando una cámara y
              procesamiento en tiempo real.
            </p>
            <ul class="tarjeta-tecnologias m-0 mt-1 list-none pl-0 flex flex-wrap gap-1.5">
              <li
                class="tecnologia m-0 font-poppins text-[11px] font-medium text-text-muted bg-bg-main border border-border-main py-0.5 px-2 rounded-md whitespace-nowrap">
                Arduino
              </li>
              <li
                class="tecnologia m-0 font-poppins text-[11px] font-medium text-text-muted bg-bg-main border border-border-main py-0.5 px-2 rounded-md whitespace-nowrap">
                Python
              </li>
              <li
                class="tecnologia m-0 font-poppins text-[11px] font-medium text-text-muted bg-bg-main border border-border-main py-0.5 px-2 rounded-md whitespace-nowrap">
                OpenCV
              </li>
            </ul>
          </div>

          <div class="tarjeta-pie mt-4 flex items-center justify-between gap-2 pt-3 border-t border-border-lt">
            <div class="autor flex min-w-0 items-center gap-2.5">
              <div
                class="autor-avatar grid h-8 w-8 shrink-0 place-items-center rounded-full bg-turq-pale text-xs font-bold text-navy">
                AM
              </div>
              <div class="flex min-w-0 flex-col justify-center">
                <p class="autor-nombre m-0 truncate text-sm font-semibold text-navy leading-tight">
                  Ana Martínez
                </p>
                <p class="autor-rol m-0 mt-0.5 truncate text-xs text-text-muted leading-tight">
                  Alumna
                </p>
              </div>
            </div>

            <div class="estadisticas flex shrink-0 items-center gap-2.5 text-xs font-medium text-text-muted">
              <span class="estadistica-vistas inline-flex items-center gap-1">👁️ 318</span>
            </div>
          </div>

        </div>
      </article>
    </div>
  </section>

  <!-- Boton mostrar mas... (Logica para solo mostrar unas cuantas publicaciones y mostrar mas despues)-->
  <div class="paginacion mt-10 flex justify-center">
    <button type="button" id="boton-cargar-mas"
      class="boton-cargar-mas w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border-transparent text-base font-medium rounded-custom text-white-custom bg-green hover:bg-green-lt no-underline transition-all duration-300 shadow-md hover:shadow-xl  hover:-translate-y-0.5 box-border">
      Cargar más proyectos
    </button>
  </div>
</section>

<!-- Boton para subir (Necesario la vista para suubir archivo y hacer que salga en el feed)-->
<a href="#modal-publicar" aria-label="Publicar un proyecto"
  class="boton-publicar fixed bottom-5 right-5 z-40 inline-flex h-14 w-14 items-center justify-center gap-2 rounded-full bg-green text-white no-underline shadow-xl transition-all duration-300 hover:bg-green-lt hover:-translate-y-0.5 focus:outline-none focus-visible:ring-4 focus-visible:ring-green/30 sm:bottom-8 sm:right-8 sm:h-auto sm:w-auto sm:px-5 sm:py-3.5">
  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
    <path stroke-linecap="round" d="M12 5v14M5 12h14" />
  </svg>
  <span class="boton-publicar-texto hidden text-sm font-semibold sm:inline">Publicar</span>
</a>