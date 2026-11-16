<?php
// pages/foro_post.php
// Vista Detallada de Publicación Individual (/foro/{id}) - Ingeniería en Teleinformática, CUCSur
if (!defined('BASE_URL')) {
    @include_once __DIR__ . '/../config/config.php';
}
$portalBaseUrl = defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/';
$postId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

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
<link rel="stylesheet" href="<?php echo htmlspecialchars($portalBaseUrl); ?>public/css/foro_post.css">

<main class="fr" id="forum-post-page">
    <!-- Barra superior de regreso al foro -->
    <div class="fr-top-nav">
        <nav class="fr-breadcrumb" aria-label="Ruta de navegación del foro">
            <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>foro">Foro de la Comunidad</a>
            <span aria-hidden="true">/</span>
            <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>foro" id="breadcrumb-cat-link">Publicación</a>
            <span aria-hidden="true">/</span>
            <span id="breadcrumb-post-id">#<?php echo (int) $postId; ?></span>
        </nav>

        <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>foro" class="fr-btn fr-btn-line">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Volver al listado del foro</span>
        </a>
    </div>

    <div class="fr-grid">
        <!-- Columna Principal: Publicación Completa + Hilo de Comentarios -->
        <section aria-label="Contenido completo de la publicación y respuestas">
            <!-- Estado 1: Cargando -->
            <div id="post-loading" class="fr-card" aria-live="polite">
                <p style="font-size:0.88rem;font-weight:700;color:var(--fr-muted);margin:0 0 1rem">Cargando publicación completa...</p>
                <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem">
                    <div style="width:46px;height:46px;border-radius:50%;background:#e2e8f0"></div>
                    <div style="flex:1;max-width:240px">
                        <div class="fr-skel-line" style="width:80%;margin-bottom:0.4rem"></div>
                        <div class="fr-skel-line" style="width:50%;height:12px"></div>
                    </div>
                </div>
                <div class="fr-skel-line" style="width:85%;height:26px;margin-bottom:1rem"></div>
                <div class="fr-skel-line" style="width:100%;margin-bottom:0.55rem"></div>
                <div class="fr-skel-line" style="width:96%;margin-bottom:0.55rem"></div>
                <div class="fr-skel-line" style="width:76%;margin-bottom:1.5rem"></div>
                <div class="fr-skel-line" style="width:180px;height:36px"></div>
            </div>

            <!-- Estado 2: Error o No encontrada -->
            <div id="post-error" class="fr-card fr-state-card" role="alert" hidden>
                <div class="fr-state-icon" style="background:#fff1f2;color:#9f1239">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <h1 id="post-error-title" style="font-size:1.4rem;font-weight:800;margin:0 0 0.5rem">No pudimos encontrar esta publicación</h1>
                <p id="post-error-msg" class="fr-hint" style="max-width:440px;margin:0 auto 1.35rem">Es posible que la publicación haya sido retirada o que el enlace no sea válido.</p>
                <div style="display:flex;justify-content:center;gap:0.75rem;flex-wrap:wrap">
                    <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>foro" class="fr-btn fr-btn-primary">Ir al listado del foro</a>
                    <button type="button" id="retry-post-btn" class="fr-btn fr-btn-line">Reintentar</button>
                </div>
            </div>

            <!-- Publicación Completa (sin truncar) -->
            <article id="post-detail-card" class="fr-card" hidden></article>

            <!-- Sección de Comentarios y Respuestas -->
            <section id="comments-section" class="fr-card fr-comments-card" aria-labelledby="comments-heading" hidden>
                <div class="fr-comments-head">
                    <h2 id="comments-heading" class="fr-q" style="margin:0">Comentarios y respuestas</h2>
                    <span id="comments-count-badge" class="fr-role-badge">0 comentarios</span>
                </div>

                <?php if ($isLoggedIn): ?>
                    <form id="comment-form" novalidate>
                        <div class="fr-field">
                            <label for="comment-content-input" class="fr-label">
                                <span>Responder a esta publicación</span>
                            </label>
                            <textarea
                                id="comment-content-input"
                                name="content"
                                rows="3"
                                maxlength="2000"
                                class="fr-textarea"
                                placeholder="Escribe una respuesta clara, aporta referencias o explica cómo resolviste una duda similar..."
                                required
                            ></textarea>
                        </div>
                        <p id="comment-error" class="fr-error-box" role="alert" hidden></p>
                        <div style="display:flex;justify-content:flex-end;margin-top:0.85rem">
                            <button type="submit" id="submit-comment-btn" class="fr-btn fr-btn-primary">
                                Publicar respuesta
                            </button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="fr-card" style="background:var(--fr-soft);padding:1.15rem;border-style:dashed">
                        <p style="margin:0 0 0.75rem;font-size:0.94rem;font-weight:600;color:var(--fr-slate)">
                            Inicia sesión con tu cuenta institucional para responder en este hilo o marcar la publicación como útil.
                        </p>
                        <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>login" class="fr-btn fr-btn-primary">Iniciar sesión</a>
                    </div>
                <?php endif; ?>

                <div id="comments-list" class="fr-comment-list"></div>
            </section>
        </section>

        <!-- Barra Lateral -->
        <aside class="fr-sidebar" aria-label="Navegación por áreas y normas del foro">
            <section class="fr-card" aria-labelledby="sidebar-cat-heading">
                <h2 id="sidebar-cat-heading" class="fr-q">Explorar por área</h2>
                <p class="fr-hint">Consulta otras publicaciones de la comunidad filtradas por categoría académica:</p>
                <div style="display:flex;flex-direction:column;gap:0.5rem">
                    <a href="<?php echo htmlspecialchars($portalBaseUrl); ?>foro" class="fr-btn fr-btn-line" style="justify-content:flex-start">
                        Todas las áreas del foro
                    </a>
                    <?php foreach ($forumCategories as $catKey => $catLabel): ?>
                        <a href="<?php echo htmlspecialchars($portalBaseUrl . 'foro?categoria=' . urlencode($catKey)); ?>"
                           class="fr-btn fr-btn-line"
                           style="justify-content:space-between">
                            <span><?php echo htmlspecialchars($catLabel); ?></span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="fr-card" aria-labelledby="sidebar-rules-heading">
                <h2 id="sidebar-rules-heading" class="fr-q">Normas del hilo</h2>
                <ol class="fr-rules-list">
                    <li>
                        <span class="fr-rule-num" aria-hidden="true">1</span>
                        <span>Aporta respuestas verificables, fragmentos de código claros o referencias bibliográficas.</span>
                    </li>
                    <li>
                        <span class="fr-rule-num" aria-hidden="true">2</span>
                        <span>Mantén un trato respetuoso con estudiantes, docentes y coordinación.</span>
                    </li>
                    <li>
                        <span class="fr-rule-num" aria-hidden="true">3</span>
                        <span>Marca como "Útil" la publicación si te ayudó a resolver un problema de laboratorio o materia.</span>
                    </li>
                </ol>
            </section>
        </aside>
    </div>

    <?php if ($isLoggedIn): ?>
    <!-- Modal para Editar Publicación -->
    <div id="edit-backdrop" class="fr-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="edit-modal-title" hidden>
        <div class="fr-modal">
            <div class="fr-modal-head">
                <div>
                    <h2 id="edit-modal-title" class="fr-q">Editar publicación</h2>
                    <p class="fr-hint" style="margin:0.25rem 0 0">Actualiza el título, área académica, desarrollo o archivo adjunto.</p>
                </div>
                <button type="button" id="close-edit-btn" class="fr-icon-btn" aria-label="Cerrar edición">
                    Cerrar
                </button>
            </div>

            <form id="edit-post-form" novalidate>
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
                                    />
                                    <span><?php echo htmlspecialchars($catLabel); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>

                    <div class="fr-field">
                        <label for="edit-title-input" class="fr-label">
                            <span>Título de la publicación*</span>
                        </label>
                        <input
                            type="text"
                            id="edit-title-input"
                            name="title"
                            maxlength="200"
                            class="fr-input"
                            required
                        />
                    </div>

                    <div class="fr-field">
                        <label for="edit-content-input" class="fr-label">
                            <span>Contenido completo*</span>
                        </label>
                        <textarea
                            id="edit-content-input"
                            name="content"
                            rows="6"
                            class="fr-textarea"
                            required
                        ></textarea>
                    </div>

                    <div class="fr-field">
                        <label for="edit-link-input" class="fr-label">
                            <span>Enlace externo (opcional)</span>
                        </label>
                        <input
                            type="url"
                            id="edit-link-input"
                            name="external_link"
                            class="fr-input"
                            placeholder="https://..."
                        />
                    </div>

                    <div class="fr-field">
                        <label for="edit-file-input" class="fr-label">
                            <span>Reemplazar archivo o imagen adjunta (imágenes &le; 3 MB auto-optimizadas)</span>
                        </label>
                        <div class="fr-file-zone">
                            <div style="min-width:0;flex:1">
                                <div id="edit-file-name" style="font-size:0.9rem;font-weight:700;color:var(--fr-navy);overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                    Conservar archivo actual
                                </div>
                                <div id="edit-file-hint" style="font-size:0.8rem;color:var(--fr-muted);margin-top:0.15rem">
                                    Si seleccionas una imagen mayor a 3 MB, se optimizará automáticamente.
                                </div>
                            </div>
                            <label for="edit-file-input" class="fr-btn fr-btn-line fr-file-trigger" style="margin:0">
                                Elegir archivo
                            </label>
                            <input
                                type="file"
                                id="edit-file-input"
                                name="file"
                                accept=".pdf,.png,.jpg,.jpeg,.webp,.gif,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar,.csv"
                                style="position:absolute;width:1px;height:1px;opacity:0;overflow:hidden"
                            />
                        </div>
                    </div>

                    <div id="remove-attachment-row" hidden>
                        <label style="display:inline-flex;align-items:center;gap:0.5rem;font-size:0.9rem;font-weight:700;color:#9f1239">
                            <input type="checkbox" id="remove-attachment-check" name="remove_attachment" value="1" style="width:18px;height:18px" />
                            <span>Eliminar el archivo o imagen adjunto actual</span>
                        </label>
                    </div>
                </div>

                <p id="edit-error" class="fr-error-box" role="alert" hidden></p>

                <div style="display:flex;align-items:center;justify-content:flex-end;gap:0.75rem;margin-top:1.5rem;flex-wrap:wrap">
                    <button type="button" id="cancel-edit-btn" class="fr-btn fr-btn-ghost">Cancelar</button>
                    <button type="submit" id="submit-edit-btn" class="fr-btn fr-btn-cta">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div id="delete-backdrop" class="fr-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="delete-modal-title" hidden>
        <div class="fr-modal" style="max-width:460px">
            <div class="fr-modal-head">
                <h2 id="delete-modal-title" class="fr-q">Confirmar eliminación</h2>
            </div>
            <p id="delete-modal-desc" style="font-size:0.95rem;color:var(--fr-slate);line-height:1.55;margin:0 0 1.25rem">
                Esta acción eliminará el contenido de forma permanente y no se puede deshacer.
            </p>
            <p id="delete-error" class="fr-error-box" role="alert" hidden></p>
            <div style="display:flex;align-items:center;justify-content:flex-end;gap:0.75rem;margin-top:1.25rem;flex-wrap:wrap">
                <button type="button" id="cancel-delete-btn" class="fr-btn fr-btn-ghost">Cancelar</button>
                <button type="button" id="confirm-delete-btn" class="fr-btn fr-btn-danger">Sí, eliminar</button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div id="forum-toast" class="fr-toast" role="status" aria-live="polite" hidden></div>
</main>

<script>
window.FORO_POST_CONFIG = {
    baseUrl: <?php echo json_encode($portalBaseUrl); ?>,
    postId: <?php echo (int) $postId; ?>,
    categoriesMap: <?php echo json_encode($forumCategories, JSON_UNESCAPED_UNICODE); ?>,
    sessionUser: {
        isLoggedIn: <?php echo !empty($isLoggedIn) ? 'true' : 'false'; ?>,
        userId: <?php echo isset($currentUserId) && $currentUserId !== null ? (int) $currentUserId : 'null'; ?>,
        role: <?php echo json_encode($currentUserRole ?? null); ?>,
        name: <?php echo json_encode($currentUserName ?? null); ?>
    }
};
</script>
<script src="<?php echo htmlspecialchars($portalBaseUrl); ?>public/js/foro_post.js"></script>
