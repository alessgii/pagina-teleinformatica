<?php
// pages/noticias.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../src/Controllers/NewsController.php';

// 1. Verificación ESTRICTA de Administrador (Role ID = 1)
$userRoleId = $_SESSION['role_id'] ?? null;
$isAdmin    = ($userRoleId !== null && (int)$userRoleId === 1);

// 2. Parámetros de ordenamiento y estado
$orden        = $_GET['orden'] ?? 'recientes';
$filtroEstado = $_GET['estado'] ?? 'publicado';
?>

<!-- ===== Encabezado ===== -->
<header class="pt-6 pb-4 sm:pt-10 sm:pb-6 text-center">
    <div class="max-w-[1180px] mx-auto px-4 sm:px-6 lg:px-10">
        <h1 class="text-[clamp(1.75rem,3.5vw,2.5rem)] font-extrabold text-navy tracking-tight leading-tight mb-2">
            Noticias
        </h1>
        <p class="text-text-mid text-[.9rem] sm:text-base max-w-[540px] mx-auto leading-relaxed">
            Entérate de los logros, alianzas y avisos más importantes de la carrera.
        </p>
    </div>
</header>

<!-- ===== Filtros por Categoría (Estilo unificado con galeria.php) ===== -->
<nav class="sticky top-16 z-40 bg-bg-main/90 backdrop-blur-md border-b border-border-lt mb-8" aria-label="Categorías de noticias">
    <div class="max-w-[1180px] mx-auto px-4 sm:px-6 lg:px-10 py-3 sm:py-4">
        <div
            id="newsFilterRow"
            role="group"
            aria-label="Filtrar noticias por categoría"
            class="relative flex gap-2 overflow-x-auto snap-x snap-proximity pr-10 -mx-4 px-4 pb-1
                   [scrollbar-width:none] [&::-webkit-scrollbar]:hidden
                   [mask-image:linear-gradient(to_right,#000_calc(100%-40px),transparent)]
                   sm:mx-0 sm:px-0 sm:pr-0 sm:pb-0 sm:flex-wrap sm:justify-center sm:overflow-visible sm:[mask-image:none]">
            <button
                type="button"
                onclick="filtrarNoticiasPorCategoria('todas', this)"
                class="filter-btn active inline-flex shrink-0 snap-start items-center gap-2 whitespace-nowrap text-[.85rem] font-semibold py-2.5 px-4 rounded-full border cursor-pointer transition-colors duration-200 bg-navy border-navy text-white shadow-[0_6px_16px_rgba(9,64,116,0.28)] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-turq-acc">
                Todas
            </button>

            <?php foreach ($categorias as $cat): ?>
                <?php $nombreFormateado = mb_convert_case($cat['category_name'], MB_CASE_TITLE, "UTF-8"); ?>
                <button
                    type="button"
                    onclick="filtrarNoticiasPorCategoria('<?php echo htmlspecialchars($cat['category_name']); ?>', this)"
                    class="filter-btn inline-flex shrink-0 snap-start items-center gap-2 whitespace-nowrap text-[.85rem] font-semibold py-2.5 px-4 rounded-full border cursor-pointer transition-colors duration-200 bg-bg-card border-border-main text-text-mid hover:border-turq-acc hover:text-navy">
                    <?php echo htmlspecialchars($nombreFormateado); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<main class="max-w-[1180px] mx-auto px-5 md:px-8 pb-12 animate-fade-in-up">

    <!-- Card Contenedora de Controles -->
    <div class="flex flex-col gap-3.5 sm:flex-row sm:items-center sm:justify-between bg-bg-card border border-border-main rounded-[var(--radius-custom)] px-4 sm:px-5 py-3 sm:py-3.5 shadow-[var(--shadow-custom)] mb-8">

        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 w-full sm:w-auto">

            <!-- 1. Ordenar por:-->
            <div class="flex items-center gap-2 flex-nowrap overflow-x-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden w-full sm:w-auto py-0.5" role="group" aria-label="Ordenar noticias">
                <span class="text-[.7rem] sm:text-[.78rem] font-bold uppercase tracking-wider text-text-muted shrink-0">Ordenar por:</span>
                <a
                    href="<?php echo BASE_URL; ?>index.php?page=noticias&orden=recientes&estado=<?php echo $filtroEstado; ?>"
                    class="whitespace-nowrap shrink-0 text-[.78rem] sm:text-[.82rem] font-semibold no-underline <?php echo ($orden === 'recientes') ? 'text-white bg-navy border border-navy' : 'text-text-mid bg-bg-main border border-border-main hover:border-turq-acc hover:text-navy'; ?> rounded-full px-3.5 sm:px-4 py-[5px] sm:py-[6px] cursor-pointer transition-all duration-200">Más recientes</a>
                <a
                    href="<?php echo BASE_URL; ?>index.php?page=noticias&orden=relevantes&estado=<?php echo $filtroEstado; ?>"
                    class="whitespace-nowrap shrink-0 text-[.78rem] sm:text-[.82rem] font-semibold no-underline <?php echo ($orden === 'relevantes') ? 'text-white bg-navy border border-navy' : 'text-text-mid bg-bg-main border border-border-main hover:border-turq-acc hover:text-navy'; ?> rounded-full px-3.5 sm:px-4 py-[5px] sm:py-[6px] cursor-pointer transition-all duration-200">Más relevantes</a>
            </div>

            <!-- 2. Filtro de Estado: SOLO visible para Administrador (Role ID = 1) -->
            <?php if ($isAdmin): ?>
                <div class="hidden sm:block h-4 w-[1px] bg-border-main"></div>
                <div class="flex items-center gap-2 flex-nowrap overflow-x-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden w-full sm:w-auto py-0.5" role="group" aria-label="Filtrar por estado">
                    <span class="text-[.7rem] sm:text-[.78rem] font-bold uppercase tracking-wider text-text-muted shrink-0">Estado:</span>
                    <a
                        href="<?php echo BASE_URL; ?>index.php?page=noticias&orden=<?php echo $orden; ?>&estado=publicado"
                        class="whitespace-nowrap shrink-0 text-[.78rem] sm:text-[.82rem] font-semibold no-underline <?php echo ($filtroEstado === 'publicado') ? 'text-white bg-navy border border-navy' : 'text-text-mid bg-bg-main border border-border-main hover:border-turq-acc hover:text-navy'; ?> rounded-full px-3.5 sm:px-4 py-[5px] sm:py-[6px] cursor-pointer transition-all duration-200">Publicados</a>
                    <a
                        href="<?php echo BASE_URL; ?>index.php?page=noticias&orden=<?php echo $orden; ?>&estado=borrador"
                        class="whitespace-nowrap shrink-0 text-[.78rem] sm:text-[.82rem] font-semibold no-underline <?php echo ($filtroEstado === 'borrador') ? 'text-white bg-navy border border-navy' : 'text-text-mid bg-bg-main border border-border-main hover:border-turq-acc hover:text-navy'; ?> rounded-full px-3.5 sm:px-4 py-[5px] sm:py-[6px] cursor-pointer transition-all duration-200">Borradores</a>
                </div>
            <?php endif; ?>

        </div>

        <!-- 3. Botón Nueva Noticia: SOLO visible para Administrador (Role ID = 1) -->
        <?php if ($isAdmin): ?>
            <div class="flex justify-end w-full sm:w-auto pt-2 sm:pt-0 border-t sm:border-t-0 border-border-main/50">
                <button
                    type="button"
                    onclick="abrirModalCrearNoticia()"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 text-[.82rem] font-bold text-white bg-navy hover:bg-navy/90 border border-navy rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Nueva noticia</span>
                </button>
            </div>
        <?php endif; ?>

    </div>

    <!-- Rejilla de Noticias (Vista móvil y tarjetas intactas) -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" aria-label="Listado de noticias">
        <?php if (empty($noticias)): ?>
            <div class="col-span-full py-16 text-center bg-bg-card border border-border-main rounded-[var(--radius-custom)]">
                <p class="text-text-muted text-[.95rem]">No hay noticias en esta sección por el momento.</p>
            </div>
        <?php else: ?>
            <?php foreach ($noticias as $noticia): ?>
                <?php
                $baseUrl = defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/';
                $imgSrc = !empty($noticia['image_url'])
                    ? (str_contains($noticia['image_url'], 'public/') ? $baseUrl . htmlspecialchars($noticia['image_url']) : $baseUrl . 'public/img/uploads/noticias/' . htmlspecialchars($noticia['image_url']))
                    : $baseUrl . 'public/img/inicio/carrera.jpeg';

                $haceTiempo = tiempoTranscurrido($noticia['publication_date'] ?? null);
                $vistasFormateadas = formatearVistas($noticia['views'] ?? 0);
                $categoriaNombre = !empty($noticia['category_name']) ? $noticia['category_name'] : 'General';
                $estadoActual = $noticia['status'] ?? 'publicado';
                ?>

                <!-- Card de Noticia -->
                <article
                    onclick="abrirVisorNoticia(this)"
                    data-id="<?php echo intval($noticia['news_id']); ?>"
                    data-title="<?php echo htmlspecialchars($noticia['title'] ?? '', ENT_QUOTES); ?>"
                    data-content="<?php echo htmlspecialchars($noticia['content'] ?? '', ENT_QUOTES); ?>"
                    data-img="<?php echo $imgSrc; ?>"
                    data-category-id="<?php echo intval($noticia['category_id'] ?? 1); ?>"
                    data-category="<?php echo htmlspecialchars($categoriaNombre, ENT_QUOTES); ?>"
                    data-date="<?php echo $haceTiempo; ?>"
                    data-status="<?php echo $estadoActual; ?>"
                    class="group flex flex-col bg-bg-card border border-border-main rounded-[var(--radius-custom)] overflow-hidden shadow-[var(--shadow-custom)] transition-[transform,box-shadow] duration-[220ms] ease-out hover:-translate-y-[5px] hover:shadow-[var(--shadow-custom-lg)] cursor-pointer">
                    <div class="relative aspect-[16/10] overflow-hidden bg-navy-mid">
                        <img
                            src="<?php echo $imgSrc; ?>"
                            alt="<?php echo htmlspecialchars($noticia['title'] ?? 'Noticia'); ?>"
                            loading="lazy"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-[400ms] ease-out group-hover:scale-105">
                        <span class="category-badge absolute top-3 left-3 text-[.72rem] font-bold uppercase tracking-[.03em] px-3 py-[5px] rounded-full bg-white/95 text-navy shadow-sm backdrop-blur-sm">
                            <?php echo htmlspecialchars($categoriaNombre); ?>
                        </span>

                        <?php if ($isAdmin && $estadoActual === 'borrador'): ?>
                            <span class="absolute top-3 right-3 text-[.7rem] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-navy text-white shadow-sm">
                                Borrador
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col flex-1 px-5 pt-[18px] pb-5">
                        <h2 class="text-[1.05rem] font-bold text-text-main leading-[1.35] mb-2.5 group-hover:text-sky-600 transition-colors line-clamp-2">
                            <?php echo htmlspecialchars($noticia['title'] ?? ''); ?>
                        </h2>

                        <p class="text-[.88rem] text-text-mid leading-relaxed flex-1 mb-4 line-clamp-2">
                            <?php echo htmlspecialchars($noticia['content'] ?? ''); ?>
                        </p>

                        <div class="flex items-center justify-between text-[.8rem] text-text-muted pt-3 border-t border-border-lt mt-auto">
                            <span><?php echo $haceTiempo; ?></span>
                            <span id="views-count-<?php echo $noticia['news_id']; ?>">👁 <?php echo $vistasFormateadas; ?></span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>

    <!-- Componente de Paginación -->
    <?php
    $baseUrl = BASE_URL;
    include __DIR__ . '/../components/pagination.php';
    ?>

</main>

<!-- ===== VISOR LIGHTBOX DE NOTICIAS (Unificado con galeria.php en PC) ===== -->
<div id="news-viewer" class="fixed inset-0 z-[3000] hidden items-center justify-center p-3 sm:p-6 lg:p-10 bg-navy-mid/95 backdrop-blur-sm opacity-0 transition-opacity duration-300" role="dialog" aria-modal="true" aria-label="Visor de noticias">

    <!-- Botón Cerrar idéntico a galeria.php -->
    <button
        onclick="cerrarVisorNoticia()"
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

    <!-- Panel del Visor: móvil mantiene estructura vertical de tarjeta; PC adopta grid y backdrop de galería -->
    <div id="visor-panel" class="relative w-full max-w-[960px] lg:max-w-[1080px] my-auto flex flex-col bg-bg-card rounded-2xl lg:rounded-[var(--radius-custom)] shadow-[0_24px_70px_rgba(0,0,0,0.5)] border border-border-lt overflow-hidden max-h-[90vh] lg:max-h-none lg:h-[min(80vh,640px)] lg:grid lg:grid-cols-[minmax(0,1fr)_380px] lg:grid-rows-[minmax(0,1fr)] lg:items-stretch scale-95 transition-transform duration-300">

        <!-- Escenario de Imagen (En PC: fondo navy + backdrop desenfocado) -->
        <div class="relative w-full flex items-center justify-center bg-navy-mid overflow-hidden shrink-0 min-h-[220px] max-h-[35vh] sm:max-h-[42vh] lg:max-h-none lg:h-full lg:w-full">

            <!-- Backdrop desenfocado idéntico a galería para rellenar marcos en PC -->
            <div id="visor-backdrop" aria-hidden="true" class="hidden lg:block absolute inset-0 bg-cover bg-center scale-125 blur-2xl opacity-40"></div>

            <img id="visor-img" src="" alt="Noticia" class="relative z-[1] block w-auto max-w-full h-full object-contain max-h-[35vh] sm:max-h-[42vh] lg:absolute lg:inset-0 lg:w-full lg:h-full lg:max-h-none lg:object-contain">
        </div>

        <!-- Columna de Contenido / Panel lateral -->
        <div class="flex flex-col flex-1 p-5 sm:p-7 lg:p-8 overflow-y-auto bg-bg-card justify-between lg:h-full border-t lg:border-t-0 lg:border-l border-border-lt">
            <div class="space-y-3">
                <div class="flex items-center justify-between gap-2 mb-2">
                    <span id="visor-badge" class="inline-flex text-[.68rem] font-bold tracking-wide uppercase bg-turq-pale text-navy py-1 px-3 rounded-full">
                        CATEGORÍA
                    </span>
                    <span id="visor-date" class="text-xs text-text-muted">Hace un momento</span>
                </div>

                <h2 id="visor-title" class="text-lg sm:text-xl lg:text-[1.35rem] font-bold text-navy leading-snug tracking-tight">
                    Título de la Noticia
                </h2>

                <p id="visor-content" class="text-text-mid text-[.88rem] lg:text-[.92rem] leading-relaxed whitespace-pre-line pt-1">
                    Contenido detallado...
                </p>
            </div>

            <div class="pt-4 mt-6 border-t border-border-lt flex flex-col gap-3 shrink-0">
                <!-- Botones de Acción SOLO para Administrador -->
                <?php if ($isAdmin): ?>
                    <div class="flex items-center justify-start lg:justify-center gap-2 flex-wrap">
                        <button
                            type="button"
                            onclick="ejecutarEdicionDesdeVisor()"
                            class="filter-btn text-[.8rem] font-semibold text-white bg-navy border border-navy rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 hover:bg-navy/90 shrink-0 shadow-sm">
                            Editar
                        </button>

                        <a
                            id="btn-visor-estado"
                            href="#"
                            class="filter-btn text-[.8rem] font-semibold text-white bg-navy border border-navy rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 hover:bg-navy/90 shrink-0 shadow-sm no-underline">
                            <span id="txt-visor-estado">Mover a borrador</span>
                        </a>

                        <a
                            id="btn-visor-eliminar"
                            href="#"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar permanentemente esta noticia?');"
                            class="filter-btn text-[.8rem] font-semibold text-white bg-rose-600 border border-rose-600 rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 hover:bg-rose-700 shrink-0 shadow-sm no-underline">
                            Eliminar
                        </a>
                    </div>
                <?php endif; ?>

                <div class="text-[.75rem] text-text-muted text-center pt-1">
                    Ingeniería en Teleinformática · CUCSUR
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Formulario para Agregar / Editar Noticias (SOLO Admin) -->
<?php if ($isAdmin): ?>
    <div id="news-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-navy/60 backdrop-blur-md animate-fade-in">
        <div class="relative w-full max-w-2xl max-h-[92vh] bg-white border border-border-main/60 rounded-2xl shadow-2xl overflow-hidden flex flex-col animate-scale-in">
            <div class="h-1.5 w-full shrink-0 bg-gradient-to-r from-navy via-sky-500 to-navy"></div>

            <div class="flex items-start justify-between gap-4 px-6 sm:px-8 pt-6 pb-4 border-b border-gray-100 shrink-0 bg-slate-50/50">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-[.7rem] font-extrabold uppercase tracking-widest text-sky-600 bg-sky-50 px-2.5 py-0.5 rounded-full border border-sky-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                        Panel de Administración
                    </span>
                    <h2 id="modal-form-title" class="text-xl sm:text-2xl font-extrabold text-navy mt-1.5 tracking-tight">
                        Agregar nueva noticia
                    </h2>
                    <p class="text-[.82rem] text-gray-500 mt-0.5">Completa los campos marcados con * para guardar o actualizar la publicación.</p>
                </div>
                <button type="button" onclick="toggleNewsModal(false)"
                    class="shrink-0 w-9 h-9 inline-flex items-center justify-center rounded-xl border border-gray-200/80 text-gray-400 hover:text-navy hover:bg-white hover:border-gray-300 transition-all cursor-pointer shadow-sm"
                    aria-label="Cerrar modal">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="news-form" action="<?php echo defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/'; ?>public/api/noticias/crear.php"
                method="POST" enctype="multipart/form-data"
                class="w-full px-6 sm:px-8 py-5 space-y-5 overflow-y-auto flex-1 custom-scrollbar box-border">

                <input type="hidden" id="news_id" name="news_id" value="">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? 1; ?>">
                <input type="hidden" id="news_status" name="status" value="publicado">

                <div class="w-full">
                    <label for="title" class="block text-[.82rem] font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                        Título de la noticia <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text" id="title" name="title" required
                        placeholder="Ej. Torneo internacional de robótica 2026"
                        class="block w-full text-[.9rem] px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all shadow-sm box-border">
                </div>

                <div class="w-full">
                    <label for="category_id" class="block text-[.82rem] font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                        Categoría <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative w-full">
                        <select
                            id="category_id" name="category_id" required
                            class="block w-full text-[.9rem] px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50/50 text-gray-800 focus:outline-none focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all cursor-pointer shadow-sm appearance-none box-border pr-10">
                            <option value="" disabled selected>Seleccionar categoría...</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?php echo $cat['category_id']; ?>">
                                    <?php echo htmlspecialchars($cat['category_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <label class="block text-[.82rem] font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                        Imagen de portada
                    </label>
                    <div class="relative w-full group">
                        <label for="image" class="relative flex flex-col items-center justify-center w-full min-h-[110px] p-4 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer bg-gray-50/50 hover:bg-sky-50/40 hover:border-sky-400 transition-all duration-200 text-center shadow-sm box-border">
                            <div id="dropzone-prompt" class="flex items-center justify-center gap-3 w-full">
                                <div class="w-9 h-9 rounded-full bg-white border border-gray-200 flex items-center justify-center text-sky-600 shadow-sm shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="text-[.85rem] font-semibold text-gray-700 text-left">
                                    <span class="text-sky-600 font-bold hover:underline">Haz clic para subir</span> o arrastra tu archivo
                                    <p class="text-[.73rem] text-gray-400 font-normal">Formatos: PNG, JPG o WEBP (16:9 o 16:10)</p>
                                </div>
                            </div>
                            <div id="preview-container" class="hidden relative w-full aspect-[16/8] max-h-44 rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                <img id="preview-img" src="" alt="Previsualización" class="w-full h-full object-cover">
                            </div>
                            <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/webp" onchange="previsualizarImagenNoticia(this)" class="hidden">
                        </label>
                    </div>
                </div>

                <div class="w-full">
                    <label for="content" class="block text-[.82rem] font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                        Contenido / Redacción <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="6" required placeholder="Escribe la información detallada de la noticia..." class="block w-full text-[.9rem] px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all resize-y shadow-sm leading-relaxed box-border"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-gray-100 shrink-0 w-full">
                    <button type="button" onclick="toggleNewsModal(false)" class="text-[.85rem] font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-full transition-colors cursor-pointer">
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        onclick="document.getElementById('news_status').value = 'borrador';"
                        class="text-[.85rem] font-bold text-gray-700 bg-white hover:bg-slate-100 border border-gray-300 px-5 py-2.5 rounded-full transition-all cursor-pointer shadow-sm">
                        Borrador
                    </button>

                    <button
                        type="submit"
                        onclick="document.getElementById('news_status').value = 'publicado';"
                        class="inline-flex items-center gap-1.5 text-[.85rem] font-bold text-white bg-navy hover:bg-navy/90 px-6 py-2.5 rounded-full transition-all shadow-md hover:shadow-lg cursor-pointer">
                        <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Publicar Noticia</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
<script src="<?php echo BASE_URL; ?>public/js/noticias.js"></script>