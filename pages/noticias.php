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
<header class="pt-6 pb-4 text-center">
    <div class="max-w-[1180px] mx-auto px-4 sm:px-6 lg:px-10">
        <h1 class="text-[clamp(1.75rem,3.5vw,2.5rem)] font-extrabold text-navy tracking-tight leading-tight mb-2">
            Noticias
        </h1>
        <p class="text-text-mid text-[.9rem] sm:text-base max-w-[540px] mx-auto leading-relaxed">
            Entérate de los logros, alianzas y avisos más importantes de la carrera.
        </p>
    </div>
</header>

<!-- ===== Filtros por Categoría (Visible para TODOS) ===== -->
<nav class="mb-6" aria-label="Categorías de noticias">
    <div class="max-w-[1180px] mx-auto px-4 sm:px-6 lg:px-10">
        <div
            id="newsFilterRow"
            role="group"
            aria-label="Filtrar noticias por categoría"
            class="flex items-center justify-center gap-2 overflow-x-auto pb-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden sm:flex-wrap"
        >
            <button 
                type="button" 
                onclick="filtrarNoticiasPorCategoria('todas', this)"
                class="filter-btn active text-[.85rem] font-semibold text-white bg-navy border border-navy rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 shrink-0 shadow-sm"
            >
                Todas
            </button>

            <?php foreach ($categorias as $cat): ?>
                <button 
                    type="button" 
                    onclick="filtrarNoticiasPorCategoria('<?php echo htmlspecialchars($cat['category_name']); ?>', this)"
                    class="filter-btn text-[.85rem] font-semibold text-text-mid bg-bg-main border border-border-main rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 hover:border-sky-500 hover:text-navy shrink-0"
                >
                    <?php echo htmlspecialchars($cat['category_name']); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<main class="max-w-[1180px] mx-auto px-5 md:px-8 pb-12 animate-fade-in-up">

    <!-- Card Contenedora de Controles -->
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between bg-bg-card border border-border-main rounded-[var(--radius-custom)] px-5 py-3.5 shadow-[var(--shadow-custom)] mb-8">
        
        <div class="flex flex-wrap items-center gap-4 w-full sm:w-auto">
            
            <!-- 1. Ordenar por (Visible para TODOS los usuarios) -->
            <div class="flex items-center gap-2 flex-wrap" role="group" aria-label="Ordenar noticias">
                <span class="text-[.85rem] font-medium text-text-muted shrink-0">Ordenar por:</span>
                <a
                    href="<?php echo BASE_URL; ?>index.php?page=noticias&orden=recientes&estado=<?php echo $filtroEstado; ?>"
                    class="text-[.82rem] font-semibold no-underline <?php echo ($orden === 'recientes') ? 'text-white bg-navy border border-navy' : 'text-text-mid bg-bg-main border border-border-main hover:border-sky-500 hover:text-navy'; ?> rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200"
                >Más recientes</a>
                <a
                    href="<?php echo BASE_URL; ?>index.php?page=noticias&orden=relevantes&estado=<?php echo $filtroEstado; ?>"
                    class="text-[.82rem] font-semibold no-underline <?php echo ($orden === 'relevantes') ? 'text-white bg-navy border border-navy' : 'text-text-mid bg-bg-main border border-border-main hover:border-sky-500 hover:text-navy'; ?> rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200"
                >Más relevantes</a>
            </div>

            <!-- 2. Filtro de Estado: SOLO visible para Administrador (Role ID = 1) -->
            <?php if ($isAdmin): ?>
                <div class="hidden sm:block h-4 w-[1px] bg-border-main"></div>
                <div class="flex items-center gap-2 flex-wrap" role="group" aria-label="Filtrar por estado">
                    <span class="text-[.85rem] font-medium text-text-muted shrink-0">Estado:</span>
                    <a
                        href="<?php echo BASE_URL; ?>index.php?page=noticias&orden=<?php echo $orden; ?>&estado=publicado"
                        class="text-[.82rem] font-semibold no-underline <?php echo ($filtroEstado === 'publicado') ? 'text-white bg-navy border border-navy' : 'text-text-mid bg-bg-main border border-border-main hover:border-sky-500 hover:text-navy'; ?> rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200"
                    >Publicados</a>
                    <a
                        href="<?php echo BASE_URL; ?>index.php?page=noticias&orden=<?php echo $orden; ?>&estado=borrador"
                        class="text-[.82rem] font-semibold no-underline <?php echo ($filtroEstado === 'borrador') ? 'text-white bg-navy border border-navy' : 'text-text-mid bg-bg-main border border-border-main hover:border-sky-500 hover:text-navy'; ?> rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200"
                    >Borradores</a>
                </div>
            <?php endif; ?>

        </div>

        <!-- 3. Botón Nueva Noticia: SOLO visible para Administrador (Role ID = 1) -->
        <?php if ($isAdmin): ?>
            <div class="flex justify-end w-full sm:w-auto pt-2 sm:pt-0 border-t sm:border-t-0 border-border-main/50">
                <button 
                    type="button" 
                    onclick="abrirModalCrearNoticia()"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 text-[.82rem] font-bold text-white bg-navy hover:bg-navy/90 border border-navy rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 shadow-sm"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Nueva noticia</span>
                </button>
            </div>
        <?php endif; ?>

    </div>

    <!-- Rejilla de Noticias -->
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
                    class="group flex flex-col bg-bg-card border border-border-main rounded-[var(--radius-custom)] overflow-hidden shadow-[var(--shadow-custom)] transition-[transform,box-shadow] duration-[220ms] ease-out hover:-translate-y-[5px] hover:shadow-[var(--shadow-custom-lg)] cursor-pointer"
                >
                    <div class="relative aspect-[16/10] overflow-hidden bg-navy-mid">
                        <img
                            src="<?php echo $imgSrc; ?>"
                            alt="<?php echo htmlspecialchars($noticia['title'] ?? 'Noticia'); ?>"
                            loading="lazy"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-[400ms] ease-out group-hover:scale-105"
                        >
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

<!-- VISOR LIGHTBOX DE NOTICIAS -->
<div id="news-viewer" class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-6 lg:p-10 bg-[#0072CE]/20 backdrop-blur-sm animate-fade-in">
    <button 
        type="button" 
        onclick="cerrarVisorNoticia()"
        class="fixed top-3 right-3 sm:top-5 sm:right-5 z-20 flex items-center justify-center gap-2 px-4 py-2 rounded-full bg-navy text-white shadow-xl cursor-pointer transition-all duration-200 hover:bg-navy/90 text-xs font-bold"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
        <span>Cerrar</span>
    </button>

    <div class="relative w-full max-w-[1080px] bg-white rounded-2xl shadow-[0_24px_70px_rgba(0,0,0,0.18)] border border-gray-200/80 overflow-hidden grid grid-cols-1 lg:grid-cols-12 max-h-[90vh] my-auto">
        <!-- Columna Imagen -->
        <div class="lg:col-span-7 bg-slate-100 flex items-center justify-center overflow-hidden relative min-h-[220px] sm:min-h-[360px] lg:min-h-[480px]">
            <img id="visor-img" src="" alt="Noticia" class="relative z-10 w-full h-full object-contain max-h-[35vh] lg:max-h-[75vh]">
        </div>

        <!-- Columna Contenido -->
        <div class="lg:col-span-5 p-5 sm:p-8 flex flex-col justify-between overflow-y-auto max-h-[55vh] lg:max-h-[90vh] bg-white">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span id="visor-badge" class="inline-flex text-[.68rem] font-bold tracking-widest uppercase bg-sky-50 text-sky-700 py-1 px-3 rounded-full border border-sky-100">
                        CATEGORÍA
                    </span>
                    <span id="visor-date" class="text-xs text-gray-400">Hace un momento</span>
                </div>
                
                <h2 id="visor-title" class="text-lg sm:text-2xl font-extrabold text-navy leading-tight tracking-tight">
                    Título de la Noticia
                </h2>

                <p id="visor-content" class="text-gray-600 text-[.85rem] sm:text-sm leading-relaxed whitespace-pre-line">
                    Contenido detallado...
                </p>
            </div>

            <div class="pt-4 mt-6 border-t border-gray-100 flex flex-col gap-3 shrink-0">
                <!-- Botones de Acción SOLO para Administrador -->
                <?php if ($isAdmin): ?>
                    <div class="flex items-center justify-center gap-2 flex-wrap">
                        <button 
                            type="button" 
                            onclick="ejecutarEdicionDesdeVisor()"
                            class="filter-btn text-[.82rem] font-semibold text-white bg-navy border border-navy rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 hover:bg-navy/90 shrink-0 shadow-sm"
                        >
                            Editar
                        </button>

                        <a 
                            id="btn-visor-estado"
                            href="#"
                            class="filter-btn text-[.82rem] font-semibold text-white bg-navy border border-navy rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 hover:bg-navy/90 shrink-0 shadow-sm no-underline"
                        >
                            <span id="txt-visor-estado">Mover a borrador</span>
                        </a>

                        <a 
                            id="btn-visor-eliminar"
                            href="#"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar permanentemente esta noticia?');"
                            class="filter-btn text-[.82rem] font-semibold text-white bg-navy border border-navy rounded-full px-4 py-[6px] cursor-pointer transition-all duration-200 hover:bg-navy/90 shrink-0 shadow-sm no-underline"
                        >
                            Eliminar
                        </a>
                    </div>
                <?php endif; ?>

                <div class="text-[.75rem] text-gray-400 text-center pt-1">
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
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="news-form" action="<?php echo defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/'; ?>public/api/noticias/crear.php"
            method="POST" enctype="multipart/form-data"
            class="w-full px-6 sm:px-8 py-5 space-y-5 overflow-y-auto flex-1 custom-scrollbar box-border">

            <input type="hidden" id="news_id" name="news_id" value="">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? 1; ?>">
            
            <!-- 1. CAMPO OCULTO AGREGADO (Sostiene el estado: 'publicado' o 'borrador') -->
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
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
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
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
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

            <!-- 2. BOTONES DEL PIE DE PÁGINA (Se añade el botón "Borrador") -->
            <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-gray-100 shrink-0 w-full">
                <button type="button" onclick="toggleNewsModal(false)" class="text-[.85rem] font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-full transition-colors cursor-pointer">
                    Cancelar
                </button>

                <!-- Botón Borrador -->
                <button 
                    type="submit" 
                    onclick="document.getElementById('news_status').value = 'borrador';" 
                    class="text-[.85rem] font-bold text-gray-700 bg-white hover:bg-slate-100 border border-gray-300 px-5 py-2.5 rounded-full transition-all cursor-pointer shadow-sm"
                >
                    Borrador
                </button>

                <!-- Botón Publicar -->
                <button 
                    type="submit" 
                    onclick="document.getElementById('news_status').value = 'publicado';" 
                    class="inline-flex items-center gap-1.5 text-[.85rem] font-bold text-white bg-navy hover:bg-navy/90 px-6 py-2.5 rounded-full transition-all shadow-md hover:shadow-lg cursor-pointer"
                >
                    <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>Publicar Noticia</span>
                </button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
<script src="<?php echo BASE_URL; ?>public/js/noticias.js"></script>