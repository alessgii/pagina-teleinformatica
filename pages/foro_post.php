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
<style>
.fr {
    --fr-navy: var(--color-navy, #0a3d6b);
    --fr-navy-mid: #0f4f8a;
    --fr-navy-dark: #062847;
    --fr-slate: #243b53;
    --fr-muted: #475569;
    --fr-line: #d8e1ec;
    --fr-line-strong: #cbd5e1;
    --fr-soft: #eef3f9;
    --fr-accent: #0891b2;
    --fr-lime: #bef264;
    --fr-lime-border: #4d7c0f;
    --fr-lime-text: #1a2e05;
    max-width: 1180px;
    margin: 0 auto;
    padding: 2rem 1rem 4rem;
    color: var(--fr-navy);
}
.fr *, .fr *::before, .fr *::after {
    box-sizing: border-box;
}
.fr [hidden] {
    display: none !important;
}
.fr :where(fieldset) {
    border: 0;
    margin: 0;
    padding: 0;
    min-width: 0;
}
.fr :where(a[href], button, select, summary, label[for], .fr-opt, .fr-file-trigger) {
    cursor: pointer;
}
.fr :where(button:disabled, input:disabled, textarea:disabled) {
    cursor: not-allowed;
}
.fr :where(a, button, input, textarea, select, summary):focus-visible {
    outline: 3px solid var(--fr-accent);
    outline-offset: 2px;
}

/* Barra superior de navegación del hilo */
.fr-top-nav {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 0.85rem;
    margin-bottom: 1.5rem;
}
.fr-breadcrumb {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.45rem;
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--fr-muted);
}
.fr-breadcrumb a {
    color: var(--fr-navy);
    text-decoration: none;
}
.fr-breadcrumb a:hover {
    color: var(--fr-accent);
    text-decoration: underline;
}

/* Tarjetas base inspiradas en feedback.php */
.fr-card {
    background: #ffffff;
    border: 1px solid var(--fr-line);
    border-radius: 18px;
    padding: 1.5rem;
    box-shadow: 0 1px 2px rgba(10, 61, 107, 0.04), 0 8px 24px -12px rgba(10, 61, 107, 0.12);
}
@media (min-width: 640px) {
    .fr-card {
        padding: 1.85rem;
    }
}

.fr-q {
    font-size: 1.22rem;
    line-height: 1.25;
    font-weight: 800;
    letter-spacing: -0.015em;
    margin: 0 0 0.35rem;
    padding-left: 0.8rem;
    border-left: 4px solid var(--fr-accent);
    color: var(--fr-navy);
}
.fr-hint {
    font-size: 0.9rem;
    color: var(--fr-muted);
    margin: 0 0 1rem;
    line-height: 1.45;
}

/* Inputs táctiles heredados de login.php */
.fr-field {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}
.fr-label {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--fr-navy);
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.fr-input-wrap {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
}
.fr-input-icon {
    position: absolute;
    left: 0.9rem;
    pointer-events: none;
    color: var(--fr-muted);
    display: flex;
    align-items: center;
}
.fr-input,
.fr-textarea {
    width: 100%;
    min-width: 0;
    border: 2px solid var(--fr-line-strong);
    border-radius: 12px;
    background: #ffffff;
    color: var(--fr-navy);
    font: inherit;
    font-size: 0.96rem;
    font-weight: 500;
    padding: 0.72rem 0.95rem;
    box-shadow: 0 4px 0 var(--fr-line-strong);
    transition: background-color 0.15s, border-color 0.15s, box-shadow 0.15s;
}
.fr-input-with-icon {
    padding-left: 2.75rem;
}
.fr-textarea {
    line-height: 1.55;
    resize: vertical;
    min-height: 110px;
}
.fr-input::placeholder,
.fr-textarea::placeholder {
    color: #64748b;
    font-weight: 400;
}
.fr-input:focus,
.fr-textarea:focus {
    outline: none;
    background-color: #f0f9ff;
    border-color: var(--fr-accent);
    box-shadow: 0 4px 0 var(--fr-accent);
}

/* Radio chips de categoría */
.fr-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 0.45rem;
}
.fr-opt {
    position: relative;
    display: inline-block;
}
.fr-opt input {
    position: absolute;
    opacity: 0;
    width: 1px;
    height: 1px;
    margin: 0;
}
.fr-opt span {
    display: inline-flex;
    align-items: center;
    min-height: 44px;
    padding: 0.55rem 1rem;
    border: 1.5px solid var(--fr-line);
    border-radius: 10px;
    background: #ffffff;
    font-size: 0.92rem;
    font-weight: 600;
    color: #23415f;
    transition: background-color 0.15s, border-color 0.15s, color 0.15s, transform 0.1s;
}
.fr-opt:hover span {
    border-color: var(--fr-navy);
    background: var(--fr-soft);
}
.fr-opt input:checked + span {
    background: var(--fr-navy);
    border-color: var(--fr-navy);
    color: #ffffff;
    font-weight: 700;
}
.fr-opt input:focus-visible + span {
    outline: 3px solid var(--fr-accent);
    outline-offset: 2px;
}

/* Botones táctiles */
.fr-btn {
    font: inherit;
    font-weight: 700;
    font-size: 0.95rem;
    border-radius: 12px;
    min-height: 44px;
    padding: 0.65rem 1.25rem;
    border: 2px solid transparent;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: transform 0.08s, box-shadow 0.08s, background-color 0.15s, border-color 0.15s, color 0.15s;
    white-space: nowrap;
}
.fr-btn-cta {
    background: var(--fr-lime);
    color: var(--fr-lime-text);
    border-color: var(--fr-lime-border);
    box-shadow: 0 4px 0 var(--fr-lime-border);
    font-weight: 800;
}
.fr-btn-cta:hover:not(:disabled) {
    background: #d9f99d;
}
.fr-btn-cta:active:not(:disabled) {
    transform: translateY(3px);
    box-shadow: 0 1px 0 var(--fr-lime-border);
}
.fr-btn-primary {
    background: var(--fr-navy);
    color: #ffffff;
    border-color: var(--fr-navy-dark);
    box-shadow: 0 4px 0 var(--fr-navy-dark);
}
.fr-btn-primary:hover:not(:disabled) {
    background: var(--fr-navy-mid);
}
.fr-btn-primary:active:not(:disabled) {
    transform: translateY(3px);
    box-shadow: 0 1px 0 var(--fr-navy-dark);
}
.fr-btn-line {
    background: #ffffff;
    color: var(--fr-navy);
    border: 1.5px solid var(--fr-line);
    border-radius: 10px;
}
.fr-btn-line:hover:not(:disabled) {
    border-color: var(--fr-navy);
    background: var(--fr-soft);
}
.fr-btn-line[aria-pressed="true"] {
    background: var(--fr-navy);
    border-color: var(--fr-navy);
    color: #ffffff;
}
.fr-btn-danger {
    background: #fff1f2;
    color: #9f1239;
    border: 1.5px solid #fecdd3;
    border-radius: 10px;
}
.fr-btn-danger:hover:not(:disabled) {
    background: #ffe4e6;
    border-color: #e11d48;
}
.fr-btn-ghost {
    background: transparent;
    color: var(--fr-slate);
    border-radius: 10px;
}
.fr-btn-ghost:hover:not(:disabled) {
    background: var(--fr-soft);
    color: var(--fr-navy);
}
.fr-btn:disabled {
    opacity: 0.6;
}

/* Grid de 2 columnas */
.fr-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 1.75rem;
    align-items: start;
}
@media (min-width: 1024px) {
    .fr-grid {
        grid-template-columns: minmax(0, 1fr) 330px;
        gap: 2rem;
    }
}

/* Cabecera de autor y metadatos */
.fr-post-top {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 0.85rem;
    padding-bottom: 1.15rem;
    margin-bottom: 1.25rem;
    border-bottom: 1px solid var(--fr-line);
}
.fr-author {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    min-width: 0;
}
.fr-avatar {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: var(--fr-navy);
    color: #ffffff;
    font-weight: 800;
    font-size: 1.05rem;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.fr-avatar-mod {
    background: #0f4f8a;
}
.fr-avatar-teacher {
    background: #047857;
}
.fr-author-meta {
    min-width: 0;
}
.fr-author-line {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.45rem;
}
.fr-author-name {
    font-weight: 700;
    font-size: 1rem;
    color: var(--fr-navy);
}
.fr-role-badge {
    font-size: 0.75rem;
    font-weight: 700;
    padding: 0.15rem 0.55rem;
    border-radius: 6px;
    background: var(--fr-soft);
    color: var(--fr-navy);
    border: 1px solid var(--fr-line);
}
.fr-role-badge[data-role="1"],
.fr-role-badge[data-role="2"] {
    background: #e0f2fe;
    color: #075985;
    border-color: #bae6fd;
}
.fr-role-badge[data-role="3"] {
    background: #d1fae5;
    color: #065f46;
    border-color: #a7f3d0;
}
.fr-cat-badge {
    font-size: 0.76rem;
    font-weight: 800;
    padding: 0.2rem 0.65rem;
    border-radius: 6px;
    background: #f0f9ff;
    color: #0369a1;
    border: 1px solid #bae6fd;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}
.fr-cat-badge:hover {
    background: var(--fr-navy);
    color: #ffffff;
    border-color: var(--fr-navy);
}
.fr-date {
    display: block;
    font-size: 0.83rem;
    color: var(--fr-muted);
    margin-top: 0.15rem;
}

/* Cuerpo completo de la publicación */
.fr-detail-title {
    font-size: clamp(1.45rem, 2.8vw, 1.95rem);
    line-height: 1.25;
    font-weight: 800;
    letter-spacing: -0.015em;
    color: var(--fr-navy);
    margin: 0 0 1rem;
    word-break: break-word;
}
.fr-detail-body {
    font-size: 1.03rem;
    line-height: 1.72;
    color: var(--fr-slate);
    margin: 0 0 1.4rem;
    white-space: pre-line;
    word-break: break-word;
    max-width: 74ch;
}

/* Visor completo de adjuntos e imágenes (R-40) */
.fr-media-frame {
    margin: 1.25rem 0 1.5rem;
    border-radius: 14px;
    border: 1.5px solid var(--fr-line);
    background: var(--fr-soft);
    overflow: hidden;
}
.fr-media-img-wrap {
    width: 100%;
    max-height: 520px;
    background: #062847;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.fr-media-img-wrap img {
    width: 100%;
    height: auto;
    max-height: 520px;
    object-fit: contain;
    display: block;
}
.fr-media-bar {
    padding: 0.75rem 1rem;
    background: #ffffff;
    border-top: 1px solid var(--fr-line);
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--fr-slate);
}
.fr-resource-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 0.95rem 1.15rem;
    margin: 0.85rem 0 1.25rem;
    border-radius: 12px;
    border: 1.5px solid var(--fr-line-strong);
    background: var(--fr-soft);
    color: var(--fr-navy);
    text-decoration: none;
    transition: border-color 0.15s, background-color 0.15s;
}
.fr-resource-box:hover {
    border-color: var(--fr-navy);
    background: #e2edf8;
}
.fr-resource-meta {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    min-width: 0;
}
.fr-resource-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: #ffffff;
    border: 1px solid var(--fr-line);
    color: var(--fr-navy);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.fr-post-footer {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    padding-top: 1.15rem;
    border-top: 1px solid var(--fr-line);
}
.fr-post-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.55rem;
}

/* Sección de comentarios */
.fr-comments-card {
    margin-top: 1.5rem;
}
.fr-comments-head {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
    padding-bottom: 0.9rem;
    border-bottom: 1px solid var(--fr-line);
}
.fr-comment-list {
    display: flex;
    flex-direction: column;
    gap: 0.9rem;
    margin-top: 1.35rem;
}
.fr-comment-item {
    background: var(--fr-soft);
    border: 1px solid var(--fr-line);
    border-radius: 14px;
    padding: 1rem 1.15rem;
}
.fr-comment-top {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}
.fr-comment-body {
    margin: 0;
    font-size: 0.95rem;
    line-height: 1.6;
    color: var(--fr-slate);
    white-space: pre-line;
    word-break: break-word;
}

/* Estados y modales */
.fr-state-card {
    text-align: center;
    padding: 2.75rem 1.5rem;
}
.fr-state-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: var(--fr-soft);
    color: var(--fr-navy);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}
.fr-error-box {
    margin-top: 0.85rem;
    padding: 0.8rem 1rem;
    border-radius: 10px;
    background: #fff1f2;
    border: 1px solid #fecdd3;
    color: #9f1239;
    font-size: 0.92rem;
    font-weight: 600;
}
.fr-toast {
    position: fixed;
    bottom: 1.5rem;
    right: 1.5rem;
    z-index: 80;
    background: var(--fr-navy);
    color: #ffffff;
    padding: 0.85rem 1.25rem;
    border-radius: 12px;
    border: 2px solid var(--fr-navy-dark);
    box-shadow: 0 8px 24px rgba(10, 61, 107, 0.25);
    font-size: 0.92rem;
    font-weight: 700;
}
.fr-skel-line {
    background: #e2e8f0;
    border-radius: 8px;
    height: 16px;
}

.fr-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}
.fr-rules-list {
    margin: 0.75rem 0 0;
    padding: 0;
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}
.fr-rules-list li {
    display: flex;
    align-items: flex-start;
    gap: 0.65rem;
    font-size: 0.9rem;
    line-height: 1.45;
    color: var(--fr-slate);
}
.fr-rule-num {
    width: 24px;
    height: 24px;
    border-radius: 6px;
    background: var(--fr-soft);
    color: var(--fr-navy);
    font-weight: 800;
    font-size: 0.8rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.fr-modal-backdrop {
    position: fixed;
    inset: 0;
    z-index: 70;
    background: rgba(6, 40, 71, 0.55);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    overflow-y: auto;
}
.fr-modal {
    background: #ffffff;
    border: 2px solid var(--fr-line);
    border-radius: 20px;
    width: 100%;
    max-width: 640px;
    padding: 1.5rem;
    box-shadow: 0 20px 45px rgba(6, 40, 71, 0.25);
    max-height: calc(100vh - 2rem);
    overflow-y: auto;
}
@media (min-width: 640px) {
    .fr-modal {
        padding: 2rem;
    }
}
.fr-modal-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.25rem;
}
.fr-icon-btn {
    min-height: 44px;
    padding: 0.4rem 0.75rem;
    border-radius: 8px;
    border: 1px solid var(--fr-line);
    background: #ffffff;
    color: var(--fr-slate);
    font: inherit;
    font-size: 0.83rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}
.fr-icon-btn:hover {
    background: var(--fr-soft);
    border-color: var(--fr-navy);
    color: var(--fr-navy);
}
.fr-icon-btn-del:hover {
    background: #fff1f2;
    border-color: #e11d48;
    color: #9f1239;
}
.fr-file-zone {
    border: 2px dashed var(--fr-line-strong);
    border-radius: 12px;
    padding: 1rem;
    background: var(--fr-soft);
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
}
</style>

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
(function () {
    const baseUrl = <?php echo json_encode($portalBaseUrl); ?>;
    const postId = <?php echo (int) $postId; ?>;
    const sessionUser = {
        isLoggedIn: <?php echo json_encode($isLoggedIn); ?>,
        userId: <?php echo json_encode($currentUserId); ?>,
        roleId: <?php echo json_encode($currentRoleId); ?>,
        isModerator: <?php echo json_encode($isModerator); ?>
    };

    const categoriesMap = <?php echo json_encode($forumCategories, JSON_UNESCAPED_UNICODE); ?>;
    const roleNamesMap = {
        1: 'Administración',
        2: 'Coordinación',
        3: 'Docente',
        4: 'Estudiante',
        ADMIN: 'Administración',
        COORDINATOR: 'Coordinación',
        TEACHER: 'Docente',
        STUDENT: 'Estudiante'
    };

    let currentPost = null;
    let pendingDelete = null; // { type: 'post' | 'comment', id: number }
    let preparedEditFile = null;

    const breadcrumbCatLink = document.getElementById('breadcrumb-cat-link');
    const postLoading = document.getElementById('post-loading');
    const postError = document.getElementById('post-error');
    const postErrorTitle = document.getElementById('post-error-title');
    const postErrorMsg = document.getElementById('post-error-msg');
    const retryPostBtn = document.getElementById('retry-post-btn');
    const postDetailCard = document.getElementById('post-detail-card');
    const commentsSection = document.getElementById('comments-section');
    const commentsCountBadge = document.getElementById('comments-count-badge');
    const commentsList = document.getElementById('comments-list');
    const commentForm = document.getElementById('comment-form');
    const commentContentInput = document.getElementById('comment-content-input');
    const commentError = document.getElementById('comment-error');
    const submitCommentBtn = document.getElementById('submit-comment-btn');
    const toastEl = document.getElementById('forum-toast');

    // Edit & Delete Modal refs
    const editBackdrop = document.getElementById('edit-backdrop');
    const closeEditBtn = document.getElementById('close-edit-btn');
    const cancelEditBtn = document.getElementById('cancel-edit-btn');
    const editPostForm = document.getElementById('edit-post-form');
    const editTitleInput = document.getElementById('edit-title-input');
    const editContentInput = document.getElementById('edit-content-input');
    const editLinkInput = document.getElementById('edit-link-input');
    const editFileInput = document.getElementById('edit-file-input');
    const editFileName = document.getElementById('edit-file-name');
    const editFileHint = document.getElementById('edit-file-hint');
    const removeAttachmentRow = document.getElementById('remove-attachment-row');
    const removeAttachmentCheck = document.getElementById('remove-attachment-check');
    const editError = document.getElementById('edit-error');
    const submitEditBtn = document.getElementById('submit-edit-btn');

    const deleteBackdrop = document.getElementById('delete-backdrop');
    const deleteModalDesc = document.getElementById('delete-modal-desc');
    const deleteError = document.getElementById('delete-error');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');

    let toastTimer = null;
    function showToast(message) {
        if (!toastEl) return;
        toastEl.textContent = message;
        toastEl.hidden = false;
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            toastEl.hidden = true;
        }, 3200);
    }

    function escapeHtml(str) {
        if (str === null || str === undefined) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function formatDate(dateStr) {
        if (!dateStr) return '';
        const normalized = String(dateStr).replace(' ', 'T');
        const date = new Date(normalized);
        if (isNaN(date.getTime())) return String(dateStr);
        return date.toLocaleDateString('es-MX', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function getRoleLabel(roleId, roleName) {
        if (roleId && roleNamesMap[roleId]) return roleNamesMap[roleId];
        if (roleName && roleNamesMap[roleName]) return roleNamesMap[roleName];
        return 'Estudiante';
    }

    function getCategoryLabel(catKey) {
        const clean = String(catKey || 'general').toLowerCase();
        return categoriesMap[clean] || 'General';
    }

    function getInitial(name) {
        const clean = String(name || 'Usuario').trim();
        return clean ? clean.charAt(0).toUpperCase() : 'U';
    }

    function getAvatarClass(roleId) {
        const id = Number(roleId);
        if (id === 1 || id === 2) return 'fr-avatar fr-avatar-mod';
        if (id === 3) return 'fr-avatar fr-avatar-teacher';
        return 'fr-avatar';
    }

    function canManage(ownerUserId) {
        if (!sessionUser.isLoggedIn) return false;
        if (sessionUser.isModerator) return true;
        return Number(ownerUserId) === Number(sessionUser.userId);
    }

    function resolveFileUrl(rawPath) {
        if (!rawPath) return '';
        if (/^https?:\/\//i.test(rawPath)) return rawPath;
        return baseUrl + String(rawPath).replace(/^\/+/, '');
    }

    // Optimización iterativa de imágenes en cliente (<= 3 MB)
    async function optimizeImageIterativelyClient(file, maxTargetBytes = 3 * 1024 * 1024) {
        const isImage = /^image\/(jpeg|png|webp)$/i.test(file.type);
        if (!isImage || file.size <= maxTargetBytes) {
            return { file, optimized: false, finalSize: file.size };
        }
        const bitmapUrl = URL.createObjectURL(file);
        try {
            const img = await new Promise((resolve, reject) => {
                const imageEl = new Image();
                imageEl.onload = () => resolve(imageEl);
                imageEl.onerror = () => reject(new Error('No se pudo procesar la imagen.'));
                imageEl.src = bitmapUrl;
            });

            const qualities = [0.84, 0.70, 0.56, 0.42];
            const maxDimensions = [1920, 1536, 1228, 960];
            let currentBlob = null;

            for (let i = 0; i < qualities.length; i++) {
                const maxDim = maxDimensions[i];
                let width = img.naturalWidth || img.width;
                let height = img.naturalHeight || img.height;
                if (width > maxDim || height > maxDim) {
                    const ratio = Math.min(maxDim / width, maxDim / height);
                    width = Math.max(1, Math.round(width * ratio));
                    height = Math.max(1, Math.round(height * ratio));
                }
                const canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;
                const ctx = canvas.getContext('2d');
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, width, height);
                ctx.drawImage(img, 0, 0, width, height);

                currentBlob = await new Promise((resolve) => canvas.toBlob(resolve, 'image/jpeg', qualities[i]));
                if (currentBlob && currentBlob.size <= maxTargetBytes) break;
            }

            if (!currentBlob) return { file, optimized: false, finalSize: file.size };
            const cleanName = file.name.replace(/\.[^.]+$/, '') + '-opt.jpg';
            const optimizedFile = new File([currentBlob], cleanName, { type: 'image/jpeg' });
            return { file: optimizedFile, optimized: true, finalSize: optimizedFile.size };
        } finally {
            URL.revokeObjectURL(bitmapUrl);
        }
    }

    function renderFullAttachments(post) {
        let html = '';
        const fileUrl = resolveFileUrl(post.file_url);
        const fileType = String(post.file_type || '').toLowerCase();

        if (fileUrl) {
            const isImg = fileType === 'image' || /\.(png|jpe?g|webp|gif)$/i.test(fileUrl);
            if (isImg) {
                html += `
                    <div class="fr-media-frame">
                        <div class="fr-media-img-wrap">
                            <img src="${escapeHtml(fileUrl)}"
                                 alt="Imagen adjunta a ${escapeHtml(post.title)}"
                                 width="800"
                                 height="450"
                                 loading="lazy" />
                        </div>
                        <div class="fr-media-bar">
                            <span>Imagen adjunta a la publicación</span>
                            <a href="${escapeHtml(fileUrl)}" target="_blank" rel="noopener noreferrer" style="color:var(--fr-navy);font-weight:800;text-decoration:none">
                                Abrir imagen en tamaño completo &nearr;
                            </a>
                        </div>
                    </div>
                `;
            } else {
                const fileName = String(post.file_url).split('/').pop() || 'Documento adjunto';
                html += `
                    <a href="${escapeHtml(fileUrl)}" target="_blank" rel="noopener noreferrer" class="fr-resource-box" download>
                        <div class="fr-resource-meta">
                            <span class="fr-resource-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                            </span>
                            <div style="min-width:0">
                                <div style="font-size:0.76rem;font-weight:800;text-transform:uppercase;color:var(--fr-accent)">Archivo adjunto para descarga</div>
                                <div style="font-size:0.95rem;font-weight:700;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${escapeHtml(fileName)}</div>
                            </div>
                        </div>
                        <span style="font-size:0.88rem;font-weight:800;white-space:nowrap">Descargar &darr;</span>
                    </a>
                `;
            }
        }

        if (post.external_link) {
            html += `
                <a href="${escapeHtml(post.external_link)}" target="_blank" rel="noopener noreferrer" class="fr-resource-box">
                    <div class="fr-resource-meta">
                        <span class="fr-resource-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                        </span>
                        <div style="min-width:0">
                            <div style="font-size:0.76rem;font-weight:800;text-transform:uppercase;color:var(--fr-accent)">Enlace externo de referencia</div>
                            <div style="font-size:0.95rem;font-weight:700;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${escapeHtml(post.external_link)}</div>
                        </div>
                    </div>
                    <span style="font-size:0.88rem;font-weight:800;white-space:nowrap">Abrir enlace &nearr;</span>
                </a>
            `;
        }

        return html;
    }

    function renderPostDetail(post) {
        currentPost = post;
        const catKey = String(post.category || 'general').toLowerCase();
        const catLabel = getCategoryLabel(catKey);
        const roleLabel = getRoleLabel(post.role_id, post.role_name);
        const likesCount = Number(post.likes_count || 0);
        const userLiked = Boolean(post.user_liked);
        const editable = canManage(post.user_id);

        document.title = `${post.title} - Foro de la Comunidad`;
        breadcrumbCatLink.textContent = catLabel;
        breadcrumbCatLink.href = `${baseUrl}foro?categoria=${encodeURIComponent(catKey)}`;

        postDetailCard.innerHTML = `
            <div class="fr-post-top">
                <div class="fr-author">
                    <div class="${getAvatarClass(post.role_id)}" aria-hidden="true">${escapeHtml(getInitial(post.author_name))}</div>
                    <div class="fr-author-meta">
                        <div class="fr-author-line">
                            <span class="fr-author-name">${escapeHtml(post.author_name || 'Estudiante')}</span>
                            <span class="fr-role-badge" data-role="${Number(post.role_id || 4)}">${escapeHtml(roleLabel)}</span>
                            <a href="${escapeHtml(baseUrl)}foro?categoria=${encodeURIComponent(catKey)}" class="fr-cat-badge">
                                ${escapeHtml(catLabel)}
                            </a>
                        </div>
                        <time class="fr-date" datetime="${escapeHtml(post.publication_date)}">
                            Publicado el ${escapeHtml(formatDate(post.publication_date))}
                        </time>
                    </div>
                </div>

                ${editable ? `
                    <div class="fr-post-actions">
                        <button type="button" id="open-edit-post-btn" class="fr-icon-btn">
                            Editar publicación
                        </button>
                        <button type="button" id="open-delete-post-btn" class="fr-icon-btn fr-icon-btn-del">
                            Eliminar
                        </button>
                    </div>
                ` : ''}
            </div>

            <h1 class="fr-detail-title">${escapeHtml(post.title)}</h1>
            <div class="fr-detail-body">${escapeHtml(post.content)}</div>

            ${renderFullAttachments(post)}

            <div class="fr-post-footer">
                <div class="fr-post-actions">
                    <button type="button"
                            id="like-post-btn"
                            class="fr-btn fr-btn-line"
                            aria-pressed="${userLiked ? 'true' : 'false'}">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="${userLiked ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                        </svg>
                        <span>Útil (${likesCount})</span>
                    </button>

                    <button type="button" id="copy-link-btn" class="fr-btn fr-btn-ghost">
                        Copiar enlace
                    </button>
                </div>

                <a href="${escapeHtml(baseUrl)}foro?categoria=${encodeURIComponent(catKey)}" class="fr-btn fr-btn-line">
                    Ver más de ${escapeHtml(catLabel)}
                </a>
            </div>
        `;

        const likeBtn = document.getElementById('like-post-btn');
        if (likeBtn) {
            likeBtn.addEventListener('click', handleToggleLike);
        }

        const copyBtn = document.getElementById('copy-link-btn');
        if (copyBtn) {
            copyBtn.addEventListener('click', async () => {
                try {
                    await navigator.clipboard.writeText(window.location.href);
                    showToast('Enlace de la publicación copiado al portapapeles.');
                } catch (_) {
                    showToast('No se pudo copiar automáticamente.');
                }
            });
        }

        const editBtn = document.getElementById('open-edit-post-btn');
        if (editBtn) {
            editBtn.addEventListener('click', openEditModal);
        }

        const delBtn = document.getElementById('open-delete-post-btn');
        if (delBtn) {
            delBtn.addEventListener('click', () => {
                openDeleteModal('post', post.post_id, '¿Estás seguro de que deseas eliminar esta publicación completa y sus comentarios?');
            });
        }
    }

    function renderComments(comments) {
        const list = Array.isArray(comments) ? comments : [];
        commentsCountBadge.textContent = `${list.length} ${list.length === 1 ? 'comentario' : 'comentarios'}`;

        if (list.length === 0) {
            commentsList.innerHTML = `
                <div class="fr-card fr-state-card" style="padding:1.85rem 1.25rem;background:var(--fr-soft)">
                    <p style="font-size:1.02rem;font-weight:800;margin:0 0 0.35rem;color:var(--fr-navy)">Aún no hay respuestas en este hilo</p>
                    <p class="fr-hint" style="margin:0">Sé la primera persona en compartir una orientación, solución o referencia académica.</p>
                </div>
            `;
            return;
        }

        commentsList.innerHTML = list.map((c) => {
            const cId = Number(c.comment_id || c.id);
            const roleLabel = getRoleLabel(c.role_id, c.role_name);
            const removable = canManage(c.user_id);
            return `
                <div class="fr-comment-item" data-comment-id="${cId}">
                    <div class="fr-comment-top">
                        <div class="fr-author-line">
                            <span class="fr-author-name" style="font-size:0.93rem">${escapeHtml(c.author_name || 'Estudiante')}</span>
                            <span class="fr-role-badge" data-role="${Number(c.role_id || 4)}">${escapeHtml(roleLabel)}</span>
                            <span class="fr-date" style="margin:0">${escapeHtml(formatDate(c.comment_date || c.created_at))}</span>
                        </div>
                        ${removable ? `
                            <button type="button"
                                    class="fr-icon-btn fr-icon-btn-del js-delete-comment"
                                    data-comment-id="${cId}"
                                    style="min-height:36px;padding:0.25rem 0.65rem;font-size:0.78rem">
                                Eliminar
                            </button>
                        ` : ''}
                    </div>
                    <p class="fr-comment-body">${escapeHtml(c.comment_text || c.content)}</p>
                </div>
            `;
        }).join('');

        commentsList.querySelectorAll('.js-delete-comment').forEach((btn) => {
            btn.addEventListener('click', () => {
                const cId = Number(btn.getAttribute('data-comment-id'));
                openDeleteModal('comment', cId, '¿Deseas eliminar este comentario de forma permanente?');
            });
        });
    }

    async function loadPostAndComments() {
        if (!postId || postId <= 0) {
            postLoading.hidden = true;
            postError.hidden = false;
            return;
        }

        postLoading.hidden = false;
        postError.hidden = true;
        postDetailCard.hidden = true;
        commentsSection.hidden = true;

        try {
            const [postRes, commentsRes] = await Promise.all([
                fetch(`${baseUrl}api/posts/${postId}`, { credentials: 'same-origin' }),
                fetch(`${baseUrl}api/posts/${postId}/comments`, { credentials: 'same-origin' })
            ]);

            const postJson = await postRes.json();
            if (!postRes.ok || !postJson.success || !postJson.data) {
                throw new Error(postJson.message || 'No se encontró la publicación solicitada.');
            }

            const commentsJson = await commentsRes.json();
            const comments = (commentsRes.ok && commentsJson.success && Array.isArray(commentsJson.data))
                ? commentsJson.data
                : [];

            renderPostDetail(postJson.data);
            renderComments(comments);

            postLoading.hidden = true;
            postDetailCard.hidden = false;
            commentsSection.hidden = false;
        } catch (err) {
            postLoading.hidden = true;
            postErrorTitle.textContent = 'No pudimos cargar esta publicación';
            postErrorMsg.textContent = err.message || 'Verifica el enlace o intenta nuevamente.';
            postError.hidden = false;
        }
    }

    async function handleToggleLike() {
        if (!sessionUser.isLoggedIn) {
            window.location.href = `${baseUrl}login`;
            return;
        }
        const btn = document.getElementById('like-post-btn');
        if (!btn) return;
        btn.disabled = true;

        try {
            const res = await fetch(`${baseUrl}api/posts/${postId}/like`, {
                method: 'POST',
                credentials: 'same-origin'
            });
            const json = await res.json();
            if (!res.ok || !json.success) {
                throw new Error(json.message || 'No se pudo registrar el voto.');
            }
            currentPost.user_liked = Boolean(json.liked);
            currentPost.likes_count = Number(json.likes_count || 0);
            renderPostDetail(currentPost);
        } catch (err) {
            showToast(err.message || 'Error al actualizar el voto.');
        } finally {
            btn.disabled = false;
        }
    }

    if (commentForm) {
        commentForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            commentError.hidden = true;
            const content = commentContentInput.value.trim();

            if (content.length < 2) {
                commentError.textContent = 'Escribe una respuesta de al menos 2 caracteres.';
                commentError.hidden = false;
                return;
            }

            submitCommentBtn.disabled = true;
            submitCommentBtn.textContent = 'Publicando...';

            try {
                const res = await fetch(`${baseUrl}api/posts/${postId}/comments`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ content })
                });
                const json = await res.json();
                if (!res.ok || !json.success) {
                    throw new Error(json.message || 'No se pudo publicar tu comentario.');
                }

                commentContentInput.value = '';
                const commentsRes = await fetch(`${baseUrl}api/posts/${postId}/comments`, { credentials: 'same-origin' });
                const commentsJson = await commentsRes.json();
                renderComments(commentsJson.data || []);
                showToast('Tu respuesta fue publicada.');
            } catch (err) {
                commentError.textContent = err.message || 'Error al publicar el comentario.';
                commentError.hidden = false;
            } finally {
                submitCommentBtn.disabled = false;
                submitCommentBtn.textContent = 'Publicar respuesta';
            }
        });
    }

    // Edición de publicación
    function openEditModal() {
        if (!currentPost || !editBackdrop) return;
        editError.hidden = true;
        preparedEditFile = null;
        editTitleInput.value = currentPost.title || '';
        editContentInput.value = currentPost.content || '';
        editLinkInput.value = currentPost.external_link || '';
        if (editFileInput) editFileInput.value = '';
        if (editFileName) editFileName.textContent = currentPost.file_url ? 'Conservar archivo actual' : 'Ningún archivo seleccionado';
        if (removeAttachmentCheck) removeAttachmentCheck.checked = false;
        if (removeAttachmentRow) removeAttachmentRow.hidden = !currentPost.file_url;

        const catVal = String(currentPost.category || 'general').toLowerCase();
        editPostForm.querySelectorAll('input[name="category"]').forEach((radio) => {
            radio.checked = radio.value === catVal;
        });

        editBackdrop.hidden = false;
        editTitleInput.focus();
    }

    function closeEditModal() {
        if (editBackdrop) editBackdrop.hidden = true;
    }

    if (closeEditBtn) closeEditBtn.addEventListener('click', closeEditModal);
    if (cancelEditBtn) cancelEditBtn.addEventListener('click', closeEditModal);

    if (editFileInput) {
        editFileInput.addEventListener('change', async () => {
            const rawFile = editFileInput.files && editFileInput.files[0];
            if (!rawFile) {
                preparedEditFile = null;
                editFileName.textContent = 'Conservar archivo actual';
                return;
            }
            editFileName.textContent = `Procesando ${rawFile.name}...`;
            try {
                const res = await optimizeImageIterativelyClient(rawFile);
                preparedEditFile = res.file;
                const mb = (res.finalSize / (1024 * 1024)).toFixed(2);
                editFileName.textContent = `${res.file.name} (${mb} MB)`;
                editFileHint.textContent = res.optimized
                    ? 'Imagen optimizada automáticamente a menos de 3 MB.'
                    : 'Archivo listo para adjuntar.';
            } catch (err) {
                preparedEditFile = rawFile;
                editFileName.textContent = rawFile.name;
            }
        });
    }

    if (editPostForm) {
        editPostForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            editError.hidden = true;

            const title = editTitleInput.value.trim();
            const content = editContentInput.value.trim();
            const externalLink = editLinkInput.value.trim();
            const checkedCat = editPostForm.querySelector('input[name="category"]:checked');
            const category = checkedCat ? checkedCat.value : 'general';

            if (!title || !content) {
                editError.textContent = 'El título y el contenido son obligatorios.';
                editError.hidden = false;
                return;
            }

            submitEditBtn.disabled = true;
            submitEditBtn.textContent = 'Guardando...';

            try {
                const fd = new FormData();
                fd.append('title', title);
                fd.append('content', content);
                fd.append('category', category);
                fd.append('external_link', externalLink);
                if (removeAttachmentCheck && removeAttachmentCheck.checked) {
                    fd.append('remove_file', '1');
                }
                if (preparedEditFile) {
                    fd.append('file', preparedEditFile, preparedEditFile.name);
                }

                const res = await fetch(`${baseUrl}api/posts/${postId}`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: fd
                });
                const json = await res.json();
                if (!res.ok || !json.success) {
                    throw new Error(json.message || 'No se pudieron guardar los cambios.');
                }

                closeEditModal();
                await loadPostAndComments();
                showToast('Publicación actualizada correctamente.');
            } catch (err) {
                editError.textContent = err.message || 'Error al guardar los cambios.';
                editError.hidden = false;
            } finally {
                submitEditBtn.disabled = false;
                submitEditBtn.textContent = 'Guardar cambios';
            }
        });
    }

    // Eliminación de publicación o comentario
    function openDeleteModal(type, id, message) {
        if (!deleteBackdrop) return;
        pendingDelete = { type, id };
        deleteModalDesc.textContent = message;
        deleteError.hidden = true;
        deleteBackdrop.hidden = false;
    }

    function closeDeleteModal() {
        pendingDelete = null;
        if (deleteBackdrop) deleteBackdrop.hidden = true;
    }

    if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', closeDeleteModal);

    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', async () => {
            if (!pendingDelete) return;
            deleteError.hidden = true;
            confirmDeleteBtn.disabled = true;
            confirmDeleteBtn.textContent = 'Eliminando...';

            try {
                const url = pendingDelete.type === 'post'
                    ? `${baseUrl}api/posts/${pendingDelete.id}`
                    : `${baseUrl}api/comments/${pendingDelete.id}`;

                const res = await fetch(url, {
                    method: 'DELETE',
                    credentials: 'same-origin'
                });
                const json = await res.json();
                if (!res.ok || !json.success) {
                    throw new Error(json.message || 'No se pudo eliminar.');
                }

                if (pendingDelete.type === 'post') {
                    window.location.href = `${baseUrl}foro`;
                    return;
                }

                closeDeleteModal();
                const commentsRes = await fetch(`${baseUrl}api/posts/${postId}/comments`, { credentials: 'same-origin' });
                const commentsJson = await commentsRes.json();
                renderComments(commentsJson.data || []);
                showToast('Comentario eliminado.');
            } catch (err) {
                deleteError.textContent = err.message || 'Error al eliminar.';
                deleteError.hidden = false;
            } finally {
                confirmDeleteBtn.disabled = false;
                confirmDeleteBtn.textContent = 'Sí, eliminar';
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (editBackdrop && !editBackdrop.hidden) closeEditModal();
            if (deleteBackdrop && !deleteBackdrop.hidden) closeDeleteModal();
        }
    });

    if (retryPostBtn) retryPostBtn.addEventListener('click', loadPostAndComments);

    loadPostAndComments();
})();
</script>
