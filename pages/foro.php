<main class="max-w-[1440px] mx-auto px-4 pt-5 pb-14 sm:px-6 sm:pt-6 lg:px-[55px] lg:pt-[18px] lg:pb-16 animate-fade-in-up">

    <!-- ===== Aviso de vista conceptual ===== -->
    <div role="status" class="flex items-start gap-3 bg-turq-pale border border-turq-acc rounded-[var(--radius-custom)] px-4 py-3.5 mb-5 animate-slide-down">
        <svg class="w-5 h-5 shrink-0 mt-0.5 fill-none stroke-turq-acc stroke-2 [stroke-linecap:round] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>
        <p class="text-[.85rem] sm:text-sm text-navy-mid leading-relaxed">
            <strong class="font-bold">Actualmente esta es una vista conceptual.</strong>
            El proyecto aún está en desarrollo, por lo que ningún elemento de esta página funciona todavía.
        </p>
    </div>

    <!-- ===== Encabezado del foro ===== -->
    <header class="flex flex-col gap-6 bg-bg-card border border-border-lt rounded-[var(--radius-custom)] shadow-[var(--shadow-custom)] p-5 mb-5 sm:px-[26px] sm:py-[30px] sm:mb-6 md:flex-row md:items-center">

        <div class="flex items-start gap-4 flex-1 min-w-0 sm:items-center sm:gap-5">
            <div class="grid place-items-center shrink-0 w-14 h-14 rounded-full bg-navy sm:w-[88px] sm:h-[88px]">
                <svg class="w-7 h-7 fill-white sm:w-11 sm:h-11" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="7" r="3.2"></circle>
                    <path d="M12 11.5c-3 0-5.2 1.6-5.2 3.6V17h10.4v-1.9c0-2-2.2-3.6-5.2-3.6z"></path>
                    <circle cx="5" cy="9.5" r="2.3"></circle>
                    <path d="M5 12.6c-2.1 0-3.7 1.2-3.7 2.7V17h3.6v-1.9c0-.9.4-1.7 1-2.4-.2-.1-.5-.1-.9-.1z"></path>
                    <circle cx="19" cy="9.5" r="2.3"></circle>
                    <path d="M19 12.6c2.1 0 3.7 1.2 3.7 2.7V17h-3.6v-1.9c0-.9-.4-1.7-1-2.4.2-.1.5-.1.9-.1z"></path>
                </svg>
            </div>
            <div class="min-w-0">
                <h1 class="text-[clamp(1.35rem,3vw,2.3rem)] font-extrabold text-navy-mid leading-tight tracking-tight">
                    Foro de la Comunidad Universitaria
                </h1>
                <p class="text-text-mid text-[.9rem] leading-relaxed mt-2 sm:text-base sm:mt-1.5">
                    Comparte ideas, resuelve dudas y conecta con estudiantes de toda la universidad.
                </p>
            </div>
        </div>

        <!-- Ilustración del campus (decorativa, solo escritorio) -->
        <svg class="hidden shrink-0 w-[300px] h-[120px] fill-none stroke-[#9db8e8] stroke-[1.5] [stroke-linejoin:round] [stroke-linecap:round] xl:block" viewBox="0 0 300 120" aria-hidden="true">
            <path d="M30 40c0-8 8-12 15-10 3-9 16-10 20-2 6-3 12 1 12 7z"></path>
            <path d="M190 22c0-8 9-13 17-10 4-9 18-9 22-1 7-3 14 2 13 9z"></path>
            <path d="M70 108V70h160v38"></path>
            <path d="M110 70V50h80v20"></path>
            <path d="M130 50V34h40v16"></path>
            <path d="M138 34l12-16 12 16"></path>
            <circle cx="150" cy="42" r="4"></circle>
            <path d="M84 84h12M108 84h12M132 84h12M156 84h12M180 84h12M204 84h12"></path>
            <path d="M84 98h12M108 98h12M132 98h12M156 98h12M180 98h12M204 98h12"></path>
            <path d="M146 108V92h8v16"></path>
            <path d="M20 108h260"></path>
            <path d="M40 108V80m0 0c-10-6-12-16-6-24 4-6 14-6 18 0 6 8 4 18-6 24z"></path>
            <path d="M262 108V78m0 0c-10-6-12-16-6-24 4-6 14-6 18 0 6 8 4 18-6 24z"></path>
        </svg>

        <button type="button" class="inline-flex items-center justify-center gap-2.5 w-full shrink-0 text-base font-semibold text-white bg-green-lt rounded-[10px] px-6 py-3.5 shadow-[var(--shadow-custom)] cursor-pointer md:w-auto">
            <svg class="w-5 h-5 fill-none stroke-white stroke-2 [stroke-linecap:round]" viewBox="0 0 24 24" aria-hidden="true">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Crear Nueva Publicación
        </button>
    </header>

    <!-- ===== Contenido: feed + barra lateral ===== -->
    <div class="grid grid-cols-1 gap-8 items-start lg:grid-cols-[minmax(0,1fr)_370px] lg:gap-6">

        <!-- ---------- Columna principal ---------- -->
        <div class="flex flex-col gap-4 min-w-0">

            <!-- Buscador + filtro -->
            <div class="flex flex-col gap-3 sm:flex-row sm:gap-4">
                <label class="flex items-center gap-3 flex-1 min-w-0 bg-bg-card border border-border-lt rounded-[var(--radius-custom)] shadow-[var(--shadow-custom)] px-4 h-[54px] sm:px-5">
                    <svg class="w-[22px] h-[22px] shrink-0 fill-none stroke-text-mid stroke-2 [stroke-linecap:round]" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input
                        type="search"
                        placeholder="Buscar palabras clave o usuarios..."
                        aria-label="Buscar palabras clave o usuarios"
                        class="flex-1 min-w-0 appearance-none border-0 bg-transparent p-0 outline-none focus:outline-none focus:ring-0 text-base text-text-main placeholder:text-text-muted"
                    >
                </label>

                <button type="button" class="flex items-center gap-3 w-full bg-bg-card border border-border-lt rounded-[var(--radius-custom)] shadow-[var(--shadow-custom)] px-4 h-[54px] text-base text-text-main cursor-pointer text-left sm:w-[325px] sm:px-5">
                    <svg class="w-[22px] h-[22px] shrink-0 fill-none stroke-text-mid stroke-2 [stroke-linecap:round]" viewBox="0 0 24 24" aria-hidden="true">
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                        <circle cx="9" cy="6" r="2" fill="#fff"></circle>
                        <circle cx="15" cy="12" r="2" fill="#fff"></circle>
                        <circle cx="8" cy="18" r="2" fill="#fff"></circle>
                    </svg>
                    <span class="flex-1 truncate">Filtrar por Tema: <strong class="font-semibold">Todos</strong></span>
                    <svg class="w-5 h-5 shrink-0 fill-none stroke-text-mid stroke-2 [stroke-linecap:round] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </div>

            <!-- Publicación 1 -->
            <article class="bg-bg-card border border-border-lt rounded-[var(--radius-custom)] shadow-[var(--shadow-custom)] p-5 sm:px-[30px]">
                <div class="flex items-start gap-3 text-text-mid sm:items-center">
                    <span class="grid place-items-center shrink-0 w-9 h-9 rounded-full bg-[#dfe6f0] sm:w-8 sm:h-8">
                        <svg class="w-5 h-5 fill-navy-mid sm:w-[18px] sm:h-[18px]" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7z"></path></svg>
                    </span>
                    <p class="flex-1 min-w-0 text-[.8rem] leading-relaxed sm:text-[.85rem]">
                        Posteado por <a href="#" class="text-[#0b5bd3]">u/EstudianteAnonimo</a> en <a href="#" class="text-[#0b5bd3]">r/Ingeniería</a>
                        <span class="hidden sm:inline mx-2">•</span><span class="block text-text-muted sm:inline sm:text-text-mid sm:whitespace-nowrap">Hace 2 horas</span>
                    </p>
                    <button type="button" aria-label="Más opciones" class="shrink-0 text-text-mid cursor-pointer -mr-1 p-1">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1.6"></circle><circle cx="12" cy="12" r="1.6"></circle><circle cx="19" cy="12" r="1.6"></circle></svg>
                    </button>
                </div>

                <h2 class="text-[1.15rem] font-bold text-navy-mid leading-snug mt-4 mb-3 sm:text-[1.5rem] sm:mt-3 sm:mb-2.5">
                    Consejos para el examen final de Cálculo III - ¿Alguien tiene apuntes?
                </h2>
                <p class="text-[.92rem] text-text-mid leading-[1.65] mb-6 sm:text-[.95rem] sm:max-w-[600px] sm:mb-5">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque posuere semper sapien, sed feugiat neque interdum nec. Integer tincidunt, nisl nec ultrices luctus, nunc nisl aliquet nunc, vitae aliquet nisl nisl non tortor.
                </p>

                <div class="grid grid-cols-2 gap-x-4 gap-y-4 text-[.9rem] text-text-mid sm:flex sm:flex-wrap sm:items-center sm:gap-x-8 sm:gap-y-3 sm:text-[.95rem]">
                    <span class="inline-flex items-center gap-2.5 font-semibold text-navy">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-navy stroke-[1.8] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-8-5.2-8-11a4.6 4.6 0 0 1 8-3 4.6 4.6 0 0 1 8 3c0 5.8-8 11-8 11z"></path></svg>
                        128
                    </span>
                    <span class="inline-flex items-center gap-2.5">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-text-mid stroke-[1.8] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12a8.5 8.5 0 0 1-12.4 7.5L3 21l1.6-5.2A8.5 8.5 0 1 1 21 12z"></path></svg>
                        45 Comentarios
                    </span>
                    <span class="inline-flex items-center gap-2.5 text-turq-acc font-medium">
                        <svg class="w-6 h-6 shrink-0 fill-turq-acc stroke-turq-acc stroke-2 [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h12v18l-6-4-6 4z"></path></svg>
                        Guardado
                    </span>
                    <span class="inline-flex items-center gap-2.5">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-text-mid stroke-[1.8] [stroke-linecap:round] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 4l-7 16-3-7-7-3z"></path><path d="M11 13l10-9"></path></svg>
                        Compartir
                    </span>
                </div>
            </article>

            <!-- Publicación 2 -->
            <article class="bg-bg-card border border-border-lt rounded-[var(--radius-custom)] shadow-[var(--shadow-custom)] p-5 sm:px-[30px]">
                <div class="flex items-start gap-3 text-text-mid sm:items-center">
                    <span class="grid place-items-center shrink-0 w-9 h-9 rounded-full bg-[#8a3fd1] sm:w-8 sm:h-8">
                        <svg class="w-5 h-5 fill-white sm:w-[18px] sm:h-[18px]" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7z"></path></svg>
                    </span>
                    <p class="flex-1 min-w-0 text-[.8rem] leading-relaxed sm:text-[.85rem]">
                        Posteado por <a href="#" class="text-[#0b5bd3]">u/DesignEnLaRed</a> en <a href="#" class="text-[#0b5bd3]">r/CampusLife</a>
                        <span class="hidden sm:inline mx-2">•</span><span class="block text-text-muted sm:inline sm:text-text-mid sm:whitespace-nowrap">Hace 5 horas</span>
                    </p>
                    <button type="button" aria-label="Más opciones" class="shrink-0 text-text-mid cursor-pointer -mr-1 p-1">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1.6"></circle><circle cx="12" cy="12" r="1.6"></circle><circle cx="19" cy="12" r="1.6"></circle></svg>
                    </button>
                </div>

                <h2 class="text-[1.15rem] font-bold text-navy-mid leading-snug mt-4 mb-3 sm:text-[1.45rem] sm:mt-3 sm:mb-2.5">
                    ¿Alguien sabe de grupos para jugar fútbol los fines de semana?
                </h2>
                <p class="text-[.92rem] text-text-mid leading-[1.65] mb-6 sm:text-[.95rem] sm:max-w-[600px] sm:mb-5">
                    Estoy buscando un grupo o equipo para unirme los sábados o domingos en la tarde. No importa el nivel, lo importante es pasarla bien y hacer ejercicio. 🙌
                </p>

                <div class="grid grid-cols-2 gap-x-4 gap-y-4 text-[.9rem] text-text-mid sm:flex sm:flex-wrap sm:items-center sm:gap-x-8 sm:gap-y-3 sm:text-[.95rem]">
                    <span class="inline-flex items-center gap-2.5 font-semibold text-navy">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-navy stroke-[1.8] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-8-5.2-8-11a4.6 4.6 0 0 1 8-3 4.6 4.6 0 0 1 8 3c0 5.8-8 11-8 11z"></path></svg>
                        96
                    </span>
                    <span class="inline-flex items-center gap-2.5">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-text-mid stroke-[1.8] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12a8.5 8.5 0 0 1-12.4 7.5L3 21l1.6-5.2A8.5 8.5 0 1 1 21 12z"></path></svg>
                        23 Comentarios
                    </span>
                    <span class="inline-flex items-center gap-2.5">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-text-mid stroke-[1.8] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h12v18l-6-4-6 4z"></path></svg>
                        Guardar
                    </span>
                    <span class="inline-flex items-center gap-2.5">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-text-mid stroke-[1.8] [stroke-linecap:round] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 4l-7 16-3-7-7-3z"></path><path d="M11 13l10-9"></path></svg>
                        Compartir
                    </span>
                </div>
            </article>

            <!-- Publicación 3 -->
            <article class="bg-bg-card border border-border-lt rounded-[var(--radius-custom)] shadow-[var(--shadow-custom)] p-5 sm:px-[30px]">
                <div class="flex items-start gap-3 text-text-mid sm:items-center">
                    <span class="grid place-items-center shrink-0 w-9 h-9 rounded-full bg-[#4cbf3a] sm:w-8 sm:h-8">
                        <svg class="w-5 h-5 fill-white sm:w-[18px] sm:h-[18px]" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7z"></path></svg>
                    </span>
                    <p class="flex-1 min-w-0 text-[.8rem] leading-relaxed sm:text-[.85rem]">
                        Posteado por <a href="#" class="text-[#0b5bd3]">u/ArteYDiseno</a> en <a href="#" class="text-[#0b5bd3]">r/Artes</a>
                        <span class="hidden sm:inline mx-2">•</span><span class="block text-text-muted sm:inline sm:text-text-mid sm:whitespace-nowrap">Hace 1 día</span>
                    </p>
                    <button type="button" aria-label="Más opciones" class="shrink-0 text-text-mid cursor-pointer -mr-1 p-1">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="1.6"></circle><circle cx="12" cy="12" r="1.6"></circle><circle cx="19" cy="12" r="1.6"></circle></svg>
                    </button>
                </div>

                <h2 class="text-[1.15rem] font-bold text-navy-mid leading-snug mt-4 mb-3 sm:text-[1.45rem] sm:mt-3 sm:mb-2.5">
                    Exposición de arte estudiantil - Próximo viernes en el CCU
                </h2>
                <p class="text-[.92rem] text-text-mid leading-[1.65] mb-6 sm:text-[.95rem] sm:max-w-[600px] sm:mb-5">
                    Les comparto que este viernes habrá una exposición con trabajos de estudiantes de distintas carreras de arte y diseño. ¡No se lo pierdan!
                </p>

                <div class="grid grid-cols-2 gap-x-4 gap-y-4 text-[.9rem] text-text-mid sm:flex sm:flex-wrap sm:items-center sm:gap-x-8 sm:gap-y-3 sm:text-[.95rem]">
                    <span class="inline-flex items-center gap-2.5 font-semibold text-navy">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-navy stroke-[1.8] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-8-5.2-8-11a4.6 4.6 0 0 1 8-3 4.6 4.6 0 0 1 8 3c0 5.8-8 11-8 11z"></path></svg>
                        72
                    </span>
                    <span class="inline-flex items-center gap-2.5">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-text-mid stroke-[1.8] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12a8.5 8.5 0 0 1-12.4 7.5L3 21l1.6-5.2A8.5 8.5 0 1 1 21 12z"></path></svg>
                        12 Comentarios
                    </span>
                    <span class="inline-flex items-center gap-2.5">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-text-mid stroke-[1.8] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h12v18l-6-4-6 4z"></path></svg>
                        Guardar
                    </span>
                    <span class="inline-flex items-center gap-2.5">
                        <svg class="w-6 h-6 shrink-0 fill-none stroke-text-mid stroke-[1.8] [stroke-linecap:round] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 4l-7 16-3-7-7-3z"></path><path d="M11 13l10-9"></path></svg>
                        Compartir
                    </span>
                </div>
            </article>

        </div>

        <!-- ---------- Barra lateral ---------- -->
        <aside class="flex flex-col gap-5 min-w-0 lg:gap-6">

            <!-- Temas populares -->
            <section class="bg-bg-card border border-border-lt rounded-[var(--radius-custom)] shadow-[var(--shadow-custom)] p-5 sm:px-7 sm:pt-8 sm:pb-7" aria-labelledby="temas-titulo">
                <h2 id="temas-titulo" class="text-[1.25rem] font-bold text-navy-mid mb-5 sm:text-[1.4rem] sm:-mt-1">Temas Populares</h2>

                <ul class="flex flex-col gap-5 sm:gap-4">
                    <li class="flex items-center gap-4 sm:gap-3.5">
                        <span class="grid place-items-center shrink-0 w-[42px] h-[42px] rounded-full bg-[#0b5bd3] text-white text-xl font-bold">#</span>
                        <div><p class="text-[.98rem] text-text-main leading-tight">Ciencia</p><p class="text-[.8rem] text-text-muted mt-0.5">1.2k publicaciones</p></div>
                    </li>
                    <li class="flex items-center gap-4 sm:gap-3.5">
                        <span class="grid place-items-center shrink-0 w-[42px] h-[42px] rounded-full bg-[#4cbf3a] text-white text-xl font-bold">#</span>
                        <div><p class="text-[.98rem] text-text-main leading-tight">Eventos</p><p class="text-[.8rem] text-text-muted mt-0.5">842 publicaciones</p></div>
                    </li>
                    <li class="flex items-center gap-4 sm:gap-3.5">
                        <span class="grid place-items-center shrink-0 w-[42px] h-[42px] rounded-full bg-[#f5921e] text-white text-xl font-bold">#</span>
                        <div><p class="text-[.98rem] text-text-main leading-tight">Avisos</p><p class="text-[.8rem] text-text-muted mt-0.5">634 publicaciones</p></div>
                    </li>
                    <li class="flex items-center gap-4 sm:gap-3.5">
                        <span class="grid place-items-center shrink-0 w-[42px] h-[42px] rounded-full bg-[#7b3fc4] text-white text-xl font-bold">#</span>
                        <div><p class="text-[.98rem] text-text-main leading-tight">Ingeniería</p><p class="text-[.8rem] text-text-muted mt-0.5">2.1k publicaciones</p></div>
                    </li>
                    <li class="flex items-center gap-4 sm:gap-3.5">
                        <span class="grid place-items-center shrink-0 w-[42px] h-[42px] rounded-full bg-turq-acc text-white text-xl font-bold">#</span>
                        <div><p class="text-[.98rem] text-text-main leading-tight">Campus Life</p><p class="text-[.8rem] text-text-muted mt-0.5">1.5k publicaciones</p></div>
                    </li>
                </ul>

                <a href="#" class="inline-flex items-center gap-2.5 mt-6 text-[.95rem] font-medium text-[#0b5bd3]">
                    Ver todos los temas
                    <svg class="w-5 h-5 fill-none stroke-[#0b5bd3] stroke-2 [stroke-linecap:round] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="13 6 19 12 13 18"></polyline></svg>
                </a>
            </section>

            <!-- Reglas del foro -->
            <section class="bg-bg-card border border-border-lt rounded-[var(--radius-custom)] shadow-[var(--shadow-custom)] p-5 sm:px-7 sm:pt-8 sm:pb-7" aria-labelledby="reglas-titulo">
                <h2 id="reglas-titulo" class="text-[1.25rem] font-bold text-navy-mid mb-5 sm:text-[1.4rem] sm:-mt-1">Reglas del Foro</h2>

                <ol class="flex flex-col gap-4 text-[.9rem] text-text-mid leading-relaxed sm:gap-3.5 sm:text-[.88rem] sm:leading-snug">
                    <li class="flex gap-4"><span class="w-3 shrink-0 font-bold text-navy-mid">1</span><span>Sé respetuoso y amable con los demás.</span></li>
                    <li class="flex gap-4"><span class="w-3 shrink-0 font-bold text-navy-mid">2</span><span>No publiques contenido ofensivo o discriminatorio.</span></li>
                    <li class="flex gap-4"><span class="w-3 shrink-0 font-bold text-navy-mid">3</span><span>No hagas spam ni autopromoción.</span></li>
                    <li class="flex gap-4"><span class="w-3 shrink-0 font-bold text-navy-mid">4</span><span>Usa los flairs y filtros adecuados para cada tema.</span></li>
                    <li class="flex gap-4"><span class="w-3 shrink-0 font-bold text-navy-mid">5</span><span>Respeta la privacidad de la comunidad.</span></li>
                </ol>

                <a href="#" class="inline-flex items-center gap-2.5 mt-6 text-[.95rem] font-medium text-[#0b5bd3] sm:mt-7">
                    Ver todas las reglas
                    <svg class="w-5 h-5 fill-none stroke-[#0b5bd3] stroke-2 [stroke-linecap:round] [stroke-linejoin:round]" viewBox="0 0 24 24" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="13 6 19 12 13 18"></polyline></svg>
                </a>
            </section>

        </aside>
    </div>
</main>