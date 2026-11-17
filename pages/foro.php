<?php
// pages/foro.php
// Vista Principal (Feed) del Foro de la Comunidad - Ingeniería en Teleinformática, CUCSur
if (!defined('BASE_URL')) {
    @include_once __DIR__ . '/../config/config.php';
}
$portalBaseUrl = defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/';

// Si alguien entra con el parámetro antiguo ?post=ID, redirigir limpiamente a /foro/ID
if (!empty($_GET['post']) && ctype_digit((string) $_GET['post'])) {
    header('Location: ' . $portalBaseUrl . 'foro/' . (int) $_GET['post']);
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentUserId   = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
$currentRoleId   = isset($_SESSION['role_id']) ? (int) $_SESSION['role_id'] : null;
$currentUserName = $_SESSION['full_name'] ?? null;
$isLoggedIn      = $currentUserId !== null;
$isModerator     = $currentRoleId !== null && in_array($currentRoleId, [1, 2], true);

$rolesLabels = [
    1 => 'Administración',
    2 => 'Coordinación',
    3 => 'Docente',
    4 => 'Estudiante',
];
$currentRoleLabel   = $currentRoleId ? ($rolesLabels[$currentRoleId] ?? 'Estudiante') : null;
$currentUserInitial = $currentUserName ? mb_strtoupper(mb_substr(trim($currentUserName), 0, 1, 'UTF-8'), 'UTF-8') : 'U';

$forumCategories = [
    'general'      => 'General',
    'electronica'  => 'Electrónica',
    'sistemas'     => 'Sistemas',
    'programacion' => 'Programación',
    'redes'        => 'Redes',
];
?>
<link rel="stylesheet" href="<?php echo htmlspecialchars($portalBaseUrl); ?>public/css/foro.css">

<main class="fr" id="forum-app">
    <!-- Cabecera Editorial -->
    <header class="fr-header">
        <div>
            <div class="fr-bar" aria-hidden="true"></div>
            <h1 class="fr-title">Foro de la Comunidad</h1>
            <p class="fr-lead">Comparte apuntes, resuelve dudas por área académica y colabora con estudiantes y docentes de Ingeniería en Teleinformática.</p>
        </div>

        <div>
            <?php if ($isLoggedIn): ?>
                <button type="button" id="open-create-modal-btn" class="fr-btn fr-btn-cta">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Nueva publicación</span>
                </button>
            <?php else: ?>
                <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>login" class="fr-btn fr-btn-primary">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                    <span>Inicia sesión para publicar</span>
                </a>
            <?php endif; ?>
        </div>
    </header>

    <div class="fr-grid">
        <!-- Columna Principal: Buscador, Filtros y Listado Escaneable -->
        <section aria-label="Listado de publicaciones del foro">
            <div class="fr-card fr-toolbar">
                <form id="forum-search-form" role="search" novalidate>
                    <div class="fr-field">
                        <label for="forum-search-input" class="fr-label">
                            <span>Buscar por tema, materia o autor</span>
                        </label>
                        <div class="fr-search-row">
                            <div class="fr-input-wrap">
                                <span class="fr-input-icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="7"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </span>
                                <input
                                    type="search"
                                    id="forum-search-input"
                                    name="search"
                                    class="fr-input fr-input-with-icon fr-input-with-clear"
                                    placeholder="Ej. VLSM, cálculo, microcontroladores o nombre del autor"
                                    autocomplete="off"
                                />
                                <button type="button" id="clear-search-btn" class="fr-clear-btn" aria-label="Limpiar texto de búsqueda" hidden>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            <button type="submit" class="fr-btn fr-btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>

                <!-- Filtro por Área / Categoría -->
                <div class="fr-filter-group">
                    <span class="fr-label" style="font-size:0.84rem;color:var(--fr-muted)">Área académica</span>
                    <div class="fr-chips" role="group" aria-label="Filtrar por categoría académica">
                        <button type="button" class="fr-chip js-cat-chip" data-category="" aria-pressed="true">
                            <span>Todas las áreas</span>
                        </button>
                        <?php foreach ($forumCategories as $catKey => $catLabel): ?>
                            <button type="button" class="fr-chip js-cat-chip" data-category="<?php echo htmlspecialchars($catKey); ?>" aria-pressed="false">
                                <span><?php echo htmlspecialchars($catLabel); ?></span>
                                <span class="fr-chip-count" data-cat-count="<?php echo htmlspecialchars($catKey); ?>">0</span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Filtro por Alcance -->
                <div class="fr-filter-bar">
                    <div class="fr-chips" role="group" aria-label="Filtrar alcance de publicaciones">
                        <button type="button" class="fr-chip js-scope-chip" data-filter="all" aria-pressed="true">
                            Todas
                        </button>
                        <?php if ($isLoggedIn): ?>
                            <button type="button" class="fr-chip js-scope-chip" data-filter="mine" aria-pressed="false">
                                Mis publicaciones
                            </button>
                        <?php endif; ?>
                        <button type="button" class="fr-chip js-scope-chip" data-filter="resources" aria-pressed="false">
                            Con archivos o enlaces
                        </button>
                    </div>

                    <div id="feed-summary" class="fr-results-meta" aria-live="polite">Cargando...</div>
                </div>
            </div>

            <!-- Estado 1: Cargando -->
            <div id="feed-loading" class="fr-feed" aria-live="polite">
                <p class="fr-results-meta" style="margin:0 0 0.25rem">Cargando publicaciones del foro...</p>
                <?php for ($s = 0; $s < 3; $s++): ?>
                    <div class="fr-card fr-skeleton-card" aria-hidden="true">
                        <div style="display:flex;align-items:center;gap:0.75rem">
                            <div style="width:42px;height:42px;border-radius:50%;background:#e2e8f0"></div>
                            <div style="flex:1;max-width:220px">
                                <div class="fr-skel-line" style="width:75%;margin-bottom:0.4rem"></div>
                                <div class="fr-skel-line" style="width:45%;height:12px"></div>
                            </div>
                        </div>
                        <div>
                            <div class="fr-skel-line" style="width:85%;height:20px;margin-bottom:0.6rem"></div>
                            <div class="fr-skel-line" style="width:100%;margin-bottom:0.4rem"></div>
                            <div class="fr-skel-line" style="width:65%"></div>
                        </div>
                        <div class="fr-skel-line" style="width:140px;height:28px"></div>
                    </div>
                <?php endfor; ?>
            </div>

            <!-- Estado 2: Error -->
            <div id="feed-error" class="fr-card fr-state-card" role="alert" hidden>
                <div class="fr-state-icon" style="background:#fff1f2;color:#9f1239">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <h2 style="font-size:1.35rem;font-weight:800;margin:0 0 0.5rem">No pudimos cargar las publicaciones</h2>
                <p id="feed-error-msg" class="fr-hint" style="max-width:440px;margin:0 auto 1.25rem">Ocurrió un problema al conectar con el servidor. Verifica tu conexión e inténtalo de nuevo.</p>
                <button type="button" id="retry-feed-btn" class="fr-btn fr-btn-primary">Reintentar carga</button>
            </div>

            <!-- Estado 3: Vacío -->
            <div id="feed-empty" class="fr-card fr-state-card" hidden>
                <div class="fr-state-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <h2 id="empty-title" style="font-size:1.35rem;font-weight:800;margin:0 0 0.5rem">Aún no hay publicaciones</h2>
                <p id="empty-desc" class="fr-hint" style="max-width:460px;margin:0 auto 1.35rem">Sé la primera persona en iniciar una conversación, compartir material de estudio o plantear una duda académica.</p>
                <div style="display:flex;justify-content:center;gap:0.75rem;flex-wrap:wrap">
                    <button type="button" id="empty-reset-btn" class="fr-btn fr-btn-line" hidden>Ver todas las publicaciones</button>
                    <?php if ($isLoggedIn): ?>
                        <button type="button" id="empty-create-btn" class="fr-btn fr-btn-cta">Crear primera publicación</button>
                    <?php else: ?>
                        <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>login" class="fr-btn fr-btn-primary">Iniciar sesión para publicar</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Contenedor de Tarjetas del Feed -->
            <div id="feed-list" class="fr-feed" hidden></div>

            <!-- Paginación -->
            <nav id="feed-pagination" class="fr-pagination" aria-label="Paginación de publicaciones" hidden></nav>
        </section>

        <!-- Barra Lateral -->
        <aside class="fr-sidebar" aria-label="Información de cuenta y normas de participación">
            <section class="fr-card" aria-labelledby="sidebar-user-heading">
                <h2 id="sidebar-user-heading" class="fr-q">Tu participación</h2>
                <?php if ($isLoggedIn): ?>
                    <div style="display:flex;align-items:center;gap:0.75rem;margin:1rem 0">
                        <div class="fr-avatar"><?php echo htmlspecialchars($currentUserInitial); ?></div>
                        <div style="min-width:0">
                            <div class="fr-author-name"><?php echo htmlspecialchars((string) $currentUserName); ?></div>
                            <span class="fr-role-badge" data-role="<?php echo (int) $currentRoleId; ?>">
                                <?php echo htmlspecialchars((string) $currentRoleLabel); ?>
                            </span>
                        </div>
                    </div>
                    <p class="fr-hint" style="margin-bottom:1rem">Publica dudas por área académica, marca aportes útiles y adjunta documentos o imágenes.</p>
                    <div style="display:flex;flex-direction:column;gap:0.6rem">
                        <button type="button" id="sidebar-create-btn" class="fr-btn fr-btn-primary" style="width:100%">Redactar publicación</button>
                        <button type="button" id="sidebar-mine-btn" class="fr-btn fr-btn-line" style="width:100%">Ver mis publicaciones</button>
                    </div>
                <?php else: ?>
                    <p class="fr-hint" style="margin-top:0.6rem">Para publicar preguntas, votar aportes útiles o comentar necesitas ingresar con tu correo institucional.</p>
                    <div style="display:flex;flex-direction:column;gap:0.6rem;margin-top:1rem">
                        <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>login" class="fr-btn fr-btn-primary" style="width:100%">Iniciar sesión</a>
                        <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>register" class="fr-btn fr-btn-line" style="width:100%">Crear cuenta estudiantil</a>
                    </div>
                <?php endif; ?>
            </section>

            <section class="fr-card" aria-labelledby="sidebar-files-heading">
                <h2 id="sidebar-files-heading" class="fr-q">Archivos e imágenes</h2>
                <p class="fr-hint">Documentos de hasta 10 MB. Las fotografías mayores a 3 MB se optimizan automáticamente antes de subirse:</p>
                <div class="fr-chips" style="gap:0.4rem">
                    <span class="fr-role-badge">PDF (máx. 10 MB)</span>
                    <span class="fr-role-badge">Imágenes (&le; 3 MB auto)</span>
                    <span class="fr-role-badge">DOCX / XLSX / PPTX</span>
                    <span class="fr-role-badge">ZIP / RAR / TXT</span>
                </div>
            </section>

            <section class="fr-card" aria-labelledby="sidebar-rules-heading">
                <h2 id="sidebar-rules-heading" class="fr-q">Normas del foro</h2>
                <ol class="fr-rules-list">
                    <li>
                        <span class="fr-rule-num" aria-hidden="true">1</span>
                        <span>Elige el área académica adecuada (Electrónica, Sistemas, Programación, Redes o General).</span>
                    </li>
                    <li>
                        <span class="fr-rule-num" aria-hidden="true">2</span>
                        <span>Mantén un trato respetuoso con estudiantes, docentes y coordinación.</span>
                    </li>
                    <li>
                        <span class="fr-rule-num" aria-hidden="true">3</span>
                        <span>Verifica que los archivos y enlaces compartidos sean seguros y de uso académico.</span>
                    </li>
                    <li>
                        <span class="fr-rule-num" aria-hidden="true">4</span>
                        <span>Marca como "Útil" las publicaciones que realmente resuelvan dudas o aporten material valioso.</span>
                    </li>
                </ol>
            </section>
        </aside>
    </div>

    <?php if ($isLoggedIn): ?>
    <!-- Modal para Crear Nueva Publicación -->
    <div id="composer-backdrop" class="fr-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="composer-modal-title" hidden>
        <div class="fr-modal">
            <div class="fr-modal-head">
                <div>
                    <h2 id="composer-modal-title" class="fr-q">Nueva publicación</h2>
                    <p class="fr-hint" style="margin:0.25rem 0 0">Selecciona el área académica y comparte tu consulta o recurso con la comunidad.</p>
                </div>
                <button type="button" id="close-composer-btn" class="fr-icon-btn" aria-label="Cerrar ventana de publicación">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <form id="post-composer-form" novalidate>
                <div style="display:flex;flex-direction:column;gap:1.15rem">
                    <fieldset class="fr-field">
                        <legend class="fr-label" style="margin-bottom:0.35rem">Área académica*</legend>
                        <div class="fr-chips">
                            <?php foreach ($forumCategories as $catKey => $catLabel): ?>
                                <label class="fr-opt">
                                    <input
                                        type="radio"
                                        name="category"
                                        value="<?php echo htmlspecialchars($catKey); ?>"
                                        <?php echo $catKey === 'general' ? 'checked' : ''; ?>
                                    />
                                    <span><?php echo htmlspecialchars($catLabel); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>

                    <div class="fr-field">
                        <label for="composer-title-input" class="fr-label">
                            <span>Título de la publicación*</span>
                            <span id="composer-title-count" class="fr-count">0 / 200</span>
                        </label>
                        <div class="fr-input-wrap">
                            <span class="fr-input-icon" aria-hidden="true">
                                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>
                            </span>
                            <input
                                type="text"
                                id="composer-title-input"
                                name="title"
                                maxlength="200"
                                class="fr-input fr-input-with-icon"
                                placeholder="Ej. Apuntes de Redes de Computadoras para el segundo parcial"
                                required
                            />
                        </div>
                    </div>

                    <div class="fr-field">
                        <label for="composer-content-input" class="fr-label">
                            <span>Contenido o descripción*</span>
                        </label>
                        <textarea
                            id="composer-content-input"
                            name="content"
                            rows="5"
                            class="fr-textarea"
                            placeholder="Explica tu duda con detalle, menciona el semestre o describe el material que estás compartiendo..."
                            required
                        ></textarea>
                    </div>

                    <div class="fr-field">
                        <label for="composer-link-input" class="fr-label">
                            <span>Enlace externo (opcional)</span>
                        </label>
                        <div class="fr-input-wrap">
                            <span class="fr-input-icon" aria-hidden="true">
                                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg>
                            </span>
                            <input
                                type="url"
                                id="composer-link-input"
                                name="external_link"
                                class="fr-input fr-input-with-icon"
                                placeholder="https://github.com/usuario/proyecto"
                            />
                        </div>
                    </div>

                    <div class="fr-field">
                        <label for="composer-file-input" class="fr-label">
                            <span>Archivo o imagen adjunta (documentos máx. 10 MB, imágenes &le; 3 MB)</span>
                        </label>
                        <div class="fr-file-zone">
                            <div style="min-width:0;flex:1">
                                <div id="composer-file-name" style="font-size:0.9rem;font-weight:700;color:var(--fr-navy);overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                    Ningún archivo seleccionado
                                </div>
                                <div id="composer-file-hint" style="font-size:0.8rem;color:var(--fr-muted);margin-top:0.15rem">
                                    Si subes una imagen pesada (&gt; 3 MB), se redimensionará y optimizará automáticamente.
                                </div>
                            </div>
                            <div style="display:flex;gap:0.5rem;align-items:center">
                                <label for="composer-file-input" class="fr-btn fr-btn-line fr-file-trigger" style="margin:0">
                                    Seleccionar archivo
                                </label>
                                <input
                                    type="file"
                                    id="composer-file-input"
                                    name="file"
                                    accept=".pdf,.png,.jpg,.jpeg,.webp,.gif,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar,.csv"
                                    style="position:absolute;width:1px;height:1px;opacity:0;overflow:hidden"
                                />
                                <button type="button" id="composer-remove-file-btn" class="fr-icon-btn fr-icon-btn-del" hidden>
                                    Quitar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <p id="composer-error" class="fr-error-box" role="alert" hidden></p>

                <div style="display:flex;align-items:center;justify-content:flex-end;gap:0.75rem;margin-top:1.5rem;flex-wrap:wrap">
                    <button type="button" id="cancel-composer-btn" class="fr-btn fr-btn-ghost">Cancelar</button>
                    <button type="submit" id="submit-composer-btn" class="fr-btn fr-btn-cta">
                        <span id="submit-composer-text">Publicar en el foro</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <div id="forum-toast" class="fr-toast" role="status" aria-live="polite" hidden></div>
</main>

<script>
window.FORO_CONFIG = {
    baseUrl: <?php echo json_encode($portalBaseUrl); ?>,
    categoriesMap: <?php echo json_encode($forumCategories, JSON_UNESCAPED_UNICODE); ?>,
    sessionUser: {
        isLoggedIn: <?php echo !empty($isLoggedIn) ? 'true' : 'false'; ?>,
        userId: <?php echo isset($currentUserId) && $currentUserId !== null ? (int) $currentUserId : 'null'; ?>,
        role: <?php echo json_encode($currentUserRole ?? null); ?>,
        name: <?php echo json_encode($currentUserName ?? null); ?>
    }
};
</script>
<script src="<?php echo htmlspecialchars($portalBaseUrl); ?>public/js/foro.js"></script>
