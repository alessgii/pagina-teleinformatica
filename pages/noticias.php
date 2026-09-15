<main class="max-w-[1180px] mx-auto px-5 md:px-8 pt-[clamp(28px,5vw,56px)] pb-16 animate-fade-in-up">

    <header class="mb-8">
        <p class="text-xs font-semibold tracking-widest uppercase text-turq-acc mb-2">
            Ingeniería en Teleinformática · CUCSUR-UDG
        </p>
        <h1 class="text-[clamp(1.7rem,3.6vw,2.3rem)] font-extrabold text-navy mb-2.5">
            Noticias
        </h1>
        <p class="text-text-mid text-base max-w-[560px] leading-relaxed mb-8">
            Entérate de los logros, alianzas y avisos más importantes de la carrera.
        </p>
    </header>

    <div class="flex flex-wrap items-center justify-between gap-4 bg-bg-card border border-border-main rounded-[var(--radius-custom)] px-[18px] py-[14px] shadow-[var(--shadow-custom)] mb-8 max-sm:flex-col max-sm:items-stretch">

        <label class="flex items-center gap-2.5 flex-[1_1_240px] max-w-[340px] max-sm:max-w-none bg-bg-main border border-border-main rounded-full px-4 py-2 transition-[border-color,box-shadow] duration-200 ease-out focus-within:border-turq-acc focus-within:shadow-[0_0_0_3px_var(--color-turq-pale)]">
            <svg class="w-[17px] h-[17px] shrink-0 fill-none stroke-text-muted stroke-2 [stroke-linecap:round]" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="11" cy="11" r="7"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input
                type="search"
                placeholder="Buscar noticias..."
                aria-label="Buscar noticias"
                class="border-none bg-transparent outline-none w-full font-[var(--font-poppins)] text-[.92rem] text-text-main placeholder:text-text-muted"
            >
        </label>

        <div class="flex items-center flex-wrap gap-2 max-sm:w-full" role="group" aria-label="Ordenar noticias">
            <span class="text-[.85rem] text-text-muted mr-1">Ordenar por:</span>
            <button
                type="button"
                class="font-[var(--font-poppins)] text-[.85rem] font-semibold text-white bg-navy border border-navy rounded-full px-4 py-[7px] cursor-pointer transition-[background,color,border-color] duration-200 ease-out max-sm:flex-1 max-sm:text-center"
                data-orden="recientes"
            >Más recientes</button>
            <button
                type="button"
                class="font-[var(--font-poppins)] text-[.85rem] font-semibold text-text-mid bg-bg-main border border-border-main rounded-full px-4 py-[7px] cursor-pointer transition-[background,color,border-color] duration-200 ease-out hover:border-turq-acc hover:text-navy max-sm:flex-1 max-sm:text-center"
                data-orden="relevantes"
            >Más relevantes</button>
        </div>

    </div>

    <section class="grid grid-cols-3 lg:grid-cols-3 md:grid-cols-2 gap-6 max-sm:grid-cols-1" aria-label="Listado de noticias">

        <article class="flex flex-col bg-bg-card border border-border-main rounded-[var(--radius-custom)] overflow-hidden shadow-[var(--shadow-custom)] transition-[transform,box-shadow] duration-[220ms] ease-out hover:-translate-y-[5px] hover:shadow-[var(--shadow-custom-lg)] md:last:col-span-2 max-sm:last:col-span-1">
            <div class="relative aspect-[16/10] overflow-hidden">
                <img
                    src="public/img/inicio/ganminisumo.jpeg"
                    alt="Equipo ganador del torneo de minisumo"
                    class="w-full h-full object-cover block transition-transform duration-[400ms] ease-out group-hover:scale-105"
                >
                <span class="absolute top-3 left-3 text-[.72rem] font-bold uppercase tracking-[.03em] px-3 py-[5px] rounded-full bg-green-pale text-green-lt">
                    Logros
                </span>
            </div>
            <div class="flex flex-col flex-1 px-5 pt-[18px] pb-5">
                <h2 class="text-[1.05rem] font-bold text-text-main leading-[1.35] mb-2.5">Se gana el torneo de minisumo</h2>
                <p class="text-[.88rem] text-text-mid leading-relaxed flex-1 mb-4">
                    El equipo representativo de la carrera obtuvo el primer lugar en la competencia
                    de robótica, destacando el trabajo en equipo y la preparación técnica del alumnado.
                </p>
                <div class="flex items-center justify-between text-[.8rem] text-text-muted pt-3 border-t border-border-lt">
                    <span>Hace 3 días</span>
                    <span>👁 1.2k</span>
                </div>
            </div>
        </article>

        <article class="flex flex-col bg-bg-card border border-border-main rounded-[var(--radius-custom)] overflow-hidden shadow-[var(--shadow-custom)] transition-[transform,box-shadow] duration-[220ms] ease-out hover:-translate-y-[5px] hover:shadow-[var(--shadow-custom-lg)] md:last:col-span-2 max-sm:last:col-span-1">
            <div class="relative aspect-[16/10] overflow-hidden">
                <img
                    src="public/img/inicio/ingenierias.jpeg"
                    alt="Alumnos de Teleinformática y Mecatrónica"
                    class="w-full h-full object-cover block transition-transform duration-[400ms] ease-out"
                >
                <span class="absolute top-3 left-3 text-[.72rem] font-bold uppercase tracking-[.03em] px-3 py-[5px] rounded-full bg-turq-pale text-turq-acc">
                    Alianzas
                </span>
            </div>
            <div class="flex flex-col flex-1 px-5 pt-[18px] pb-5">
                <h2 class="text-[1.05rem] font-bold text-text-main leading-[1.35] mb-2.5">INTEL y Mecatrónica juntos</h2>
                <p class="text-[.88rem] text-text-mid leading-relaxed flex-1 mb-4">
                    Ambas ingenierías se unen en un proyecto colaborativo que busca fortalecer
                    los conocimientos multidisciplinarios entre los estudiantes de CUCSUR.
                </p>
                <div class="flex items-center justify-between text-[.8rem] text-text-muted pt-3 border-t border-border-lt">
                    <span>Hace 1 semana</span>
                    <span>👁 860</span>
                </div>
            </div>
        </article>

        <article class="flex flex-col bg-bg-card border border-border-main rounded-[var(--radius-custom)] overflow-hidden shadow-[var(--shadow-custom)] transition-[transform,box-shadow] duration-[220ms] ease-out hover:-translate-y-[5px] hover:shadow-[var(--shadow-custom-lg)] md:last:col-span-2 max-sm:last:col-span-1">
            <div class="relative aspect-[16/10] overflow-hidden">
                <img
                    src="public/img/inicio/fechas_Calif.jpeg"
                    alt="Fechas de periodo ordinario y extraordinario"
                    class="w-full h-full object-cover block transition-transform duration-[400ms] ease-out"
                >
                <span class="absolute top-3 left-3 text-[.72rem] font-bold uppercase tracking-[.03em] px-3 py-[5px] rounded-full bg-navy text-white">
                    Avisos
                </span>
            </div>
            <div class="flex flex-col flex-1 px-5 pt-[18px] pb-5">
                <h2 class="text-[1.05rem] font-bold text-text-main leading-[1.35] mb-2.5">Se anuncia el periodo ordinario y el periodo extraordinario</h2>
                <p class="text-[.88rem] text-text-mid leading-relaxed flex-1 mb-4">
                    Ya están disponibles las fechas oficiales para la entrega de calificaciones
                    del periodo ordinario y extraordinario del semestre en curso.
                </p>
                <div class="flex items-center justify-between text-[.8rem] text-text-muted pt-3 border-t border-border-lt">
                    <span>Hace 2 semanas</span>
                    <span>👁 2.4k</span>
                </div>
            </div>
        </article>

    </section>

</main>
