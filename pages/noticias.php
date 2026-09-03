<link rel="stylesheet" href="public/css/pages/noticias.css">

<main class="noticias-page anim-fadeinup">

    <header class="noticias-page__header">
        <p class="noticias-page__eyebrow">Ingeniería en Teleinformática · CUCSUR-UDG</p>
        <h1 class="noticias-page__titulo">Noticias</h1>
        <p class="noticias-page__desc">
            Entérate de los logros, alianzas y avisos más importantes de la carrera.
        </p>
    </header>

    <div class="noticias-page__toolbar">

        <label class="buscador">
            <svg class="buscador__icono" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="11" cy="11" r="7"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="search" placeholder="Buscar noticias..." aria-label="Buscar noticias">
        </label>

        <div class="filtros" role="group" aria-label="Ordenar noticias">
            <span class="filtros__etiqueta">Ordenar por:</span>
            <button type="button" class="filtro filtro--activo" data-orden="recientes">Más recientes</button>
            <button type="button" class="filtro" data-orden="relevantes">Más relevantes</button>
        </div>

    </div>

    <section class="noticias-page__grid" aria-label="Listado de noticias">

        <article class="noticia-card">
            <div class="noticia-card__img">
                <img src="public/img/inicio/ganminisumo.jpeg" alt="Equipo ganador del torneo de minisumo">
                <span class="noticia-card__etiqueta noticia-card__etiqueta--logro">Logros</span>
            </div>
            <div class="noticia-card__body">
                <h2 class="noticia-card__titulo">Se gana el torneo de minisumo</h2>
                <p class="noticia-card__resumen">
                    El equipo representativo de la carrera obtuvo el primer lugar en la competencia
                    de robótica, destacando el trabajo en equipo y la preparación técnica del alumnado.
                </p>
                <div class="noticia-card__meta">
                    <span class="noticia-card__fecha">Hace 3 días</span>
                    <span class="noticia-card__vistas">👁 1.2k</span>
                </div>
            </div>
        </article>

        <article class="noticia-card">
            <div class="noticia-card__img">
                <img src="public/img/inicio/ingenierias.jpeg" alt="Alumnos de Teleinformática y Mecatrónica">
                <span class="noticia-card__etiqueta noticia-card__etiqueta--alianza">Alianzas</span>
            </div>
            <div class="noticia-card__body">
                <h2 class="noticia-card__titulo">INTEL y Mecatrónica juntos</h2>
                <p class="noticia-card__resumen">
                    Ambas ingenierías se unen en un proyecto colaborativo que busca fortalecer
                    los conocimientos multidisciplinarios entre los estudiantes de CUCSUR.
                </p>
                <div class="noticia-card__meta">
                    <span class="noticia-card__fecha">Hace 1 semana</span>
                    <span class="noticia-card__vistas">👁 860</span>
                </div>
            </div>
        </article>

        <article class="noticia-card">
            <div class="noticia-card__img">
                <img src="public/img/inicio/fechas_Calif.jpeg" alt="Fechas de periodo ordinario y extraordinario">
                <span class="noticia-card__etiqueta noticia-card__etiqueta--aviso">Avisos</span>
            </div>
            <div class="noticia-card__body">
                <h2 class="noticia-card__titulo">Se anuncia el periodo ordinario y el periodo extraordinario</h2>
                <p class="noticia-card__resumen">
                    Ya están disponibles las fechas oficiales para la entrega de calificaciones
                    del periodo ordinario y extraordinario del semestre en curso.
                </p>
                <div class="noticia-card__meta">
                    <span class="noticia-card__fecha">Hace 2 semanas</span>
                    <span class="noticia-card__vistas">👁 2.4k</span>
                </div>
            </div>
        </article>

    </section>

</main>