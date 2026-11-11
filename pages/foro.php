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
    padding: 2.25rem 1rem 4rem;
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

/* Barra superior de identidad heredada de feedback.php */
.fr-bar {
    width: 48px;
    height: 5px;
    border-radius: 99px;
    background: linear-gradient(90deg, var(--fr-accent), #10b981);
    margin-bottom: 1rem;
}

/* Cabecera principal */
.fr-header {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    margin-bottom: 2rem;
}
@media (min-width: 768px) {
    .fr-header {
        flex-direction: row;
        align-items: flex-end;
        justify-content: space-between;
    }
}
.fr-title {
    font-size: clamp(1.85rem, 4.2vw, 2.55rem);
    line-height: 1.1;
    font-weight: 800;
    letter-spacing: -0.02em;
    margin: 0;
    color: var(--fr-navy);
}
.fr-lead {
    margin: 0.75rem 0 0;
    font-size: 1.02rem;
    line-height: 1.55;
    color: var(--fr-slate);
    max-width: 640px;
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
        padding: 1.75rem;
    }
}

/* Títulos de bloque con acento lateral de feedback.php */
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
.fr-input-with-clear {
    padding-right: 2.6rem;
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
.fr-clear-btn {
    position: absolute;
    right: 0.55rem;
    width: 34px;
    height: 34px;
    border: 0;
    border-radius: 8px;
    background: transparent;
    color: var(--fr-muted);
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.fr-clear-btn:hover {
    background: var(--fr-soft);
    color: var(--fr-navy);
}

/* Radio chips de categoría en el modal (idénticos a .fb-opt de feedback.php) */
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
.fr-opt input:active + span {
    transform: scale(0.97);
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
.fr-btn-line:active:not(:disabled) {
    transform: scale(0.98);
}
.fr-btn-line[aria-pressed="true"] {
    background: var(--fr-navy);
    border-color: var(--fr-navy);
    color: #ffffff;
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

/* Chips de filtro */
.fr-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 0.45rem;
}
.fr-chip {
    font: inherit;
    min-height: 44px;
    padding: 0.5rem 0.9rem;
    border: 1.5px solid var(--fr-line);
    border-radius: 10px;
    background: #ffffff;
    font-size: 0.89rem;
    font-weight: 600;
    color: #1e3a5f;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    transition: background-color 0.15s, border-color 0.15s, color 0.15s, transform 0.1s;
}
.fr-chip:hover {
    border-color: var(--fr-navy);
    background: var(--fr-soft);
}
.fr-chip:active {
    transform: scale(0.97);
}
.fr-chip[aria-pressed="true"] {
    background: var(--fr-navy);
    border-color: var(--fr-navy);
    color: #ffffff;
    font-weight: 700;
}
.fr-chip-count {
    font-size: 0.76rem;
    padding: 0.1rem 0.42rem;
    border-radius: 6px;
    background: var(--fr-soft);
    color: var(--fr-navy);
    font-weight: 700;
}
.fr-chip[aria-pressed="true"] .fr-chip-count {
    background: rgba(255, 255, 255, 0.22);
    color: #ffffff;
}

/* Estructura principal de 2 columnas */
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

/* Barra de herramientas */
.fr-toolbar {
    margin-bottom: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
}
.fr-search-row {
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
}
@media (min-width: 640px) {
    .fr-search-row {
        flex-direction: row;
        align-items: stretch;
    }
}
.fr-filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.55rem;
    padding-top: 0.9rem;
    border-top: 1px solid var(--fr-line);
}
.fr-filter-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid var(--fr-line);
}
.fr-results-meta {
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--fr-muted);
}

/* Tarjetas escaneables del Feed */
.fr-feed {
    display: flex;
    flex-direction: column;
    gap: 1.15rem;
}
.fr-post {
    transition: border-color 0.15s;
}
.fr-post:hover {
    border-color: #b8c9de;
}
.fr-post-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
}
.fr-author {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    min-width: 0;
}
.fr-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: var(--fr-navy);
    color: #ffffff;
    font-weight: 800;
    font-size: 1rem;
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
    font-size: 0.95rem;
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
    font-size: 0.75rem;
    font-weight: 800;
    padding: 0.18rem 0.6rem;
    border-radius: 6px;
    background: #f0f9ff;
    color: #0369a1;
    border: 1px solid #bae6fd;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}
button.fr-cat-badge:hover {
    background: var(--fr-navy);
    color: #ffffff;
    border-color: var(--fr-navy);
}
.fr-date {
    display: block;
    font-size: 0.81rem;
    color: var(--fr-muted);
    margin-top: 0.1rem;
}

.fr-post-title {
    font-size: clamp(1.16rem, 2.1vw, 1.38rem);
    line-height: 1.3;
    font-weight: 800;
    color: var(--fr-navy);
    margin: 0 0 0.5rem;
    word-break: break-word;
}
.fr-post-title-link {
    color: inherit;
    text-decoration: none;
}
.fr-post-title-link:hover {
    color: var(--fr-accent);
    text-decoration: underline;
}

/* Resumen truncado a máximo 3 líneas con puntos suspensivos (...) */
.fr-post-excerpt {
    font-size: 0.96rem;
    line-height: 1.6;
    color: var(--fr-slate);
    margin: 0 0 0.9rem;
    word-break: break-word;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Indicadores compactos de adjuntos en la tarjeta del feed */
.fr-attachment-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}
.fr-attach-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.82rem;
    font-weight: 700;
    padding: 0.32rem 0.7rem;
    border-radius: 8px;
    background: var(--fr-soft);
    border: 1px solid var(--fr-line);
    color: var(--fr-navy);
    text-decoration: none;
}

/* Pie de tarjeta de publicación */
.fr-post-footer {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    padding-top: 0.9rem;
    border-top: 1px solid var(--fr-line);
}
.fr-post-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.55rem;
}

/* Estados vacíos, carga y error (R-27) */
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

/* Skeletons de carga con altura reservada (R-40) */
.fr-skeleton-card {
    height: 185px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.fr-skel-line {
    background: #e2e8f0;
    border-radius: 8px;
    height: 16px;
}

/* Paginación */
.fr-pagination {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 0.45rem;
    margin-top: 1.75rem;
}
.fr-page-ellipsis {
    padding: 0 0.4rem;
    color: var(--fr-muted);
    font-weight: 700;
}

/* Barra lateral */
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
    margin-top: 0.05rem;
}

/* Modal de Creación */
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
.fr-count {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--fr-muted);
}

@media (max-width: 520px) {
    .fr-card {
        padding: 1.25rem;
    }
    .fr-header .fr-btn {
        width: 100%;
    }
}
@media (prefers-reduced-motion: reduce) {
    .fr *, .fr *::before, .fr *::after {
        transition: none !important;
        animation: none !important;
    }
}
</style>

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
(function () {
    const baseUrl = <?php echo json_encode($portalBaseUrl); ?>;
    const sessionUser = {
        isLoggedIn: <?php echo json_encode($isLoggedIn); ?>,
        userId: <?php echo json_encode($currentUserId); ?>,
        roleId: <?php echo json_encode($currentRoleId); ?>,
        isModerator: <?php echo json_encode($isModerator); ?>,
        fullName: <?php echo json_encode($currentUserName); ?>
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

    const state = {
        page: 1,
        limit: 10,
        search: '',
        category: '',
        filter: 'all',
        posts: [],
        categoryCounts: {},
        pagination: { page: 1, limit: 10, total: 0, total_pages: 1 },
        lastTriggerEl: null,
        preparedUploadFile: null
    };

    // Referencias del DOM
    const searchForm = document.getElementById('forum-search-form');
    const searchInput = document.getElementById('forum-search-input');
    const clearSearchBtn = document.getElementById('clear-search-btn');
    const catChips = Array.from(document.querySelectorAll('.js-cat-chip'));
    const scopeChips = Array.from(document.querySelectorAll('.js-scope-chip'));
    const feedSummary = document.getElementById('feed-summary');
    const feedLoading = document.getElementById('feed-loading');
    const feedError = document.getElementById('feed-error');
    const feedErrorMsg = document.getElementById('feed-error-msg');
    const retryFeedBtn = document.getElementById('retry-feed-btn');
    const feedEmpty = document.getElementById('feed-empty');
    const emptyTitle = document.getElementById('empty-title');
    const emptyDesc = document.getElementById('empty-desc');
    const emptyResetBtn = document.getElementById('empty-reset-btn');
    const feedList = document.getElementById('feed-list');
    const feedPagination = document.getElementById('feed-pagination');
    const toastEl = document.getElementById('forum-toast');

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

        const now = new Date();
        const diffSec = Math.floor((now - date) / 1000);
        if (diffSec >= 0 && diffSec < 60) return 'Hace unos segundos';
        if (diffSec >= 60 && diffSec < 3600) {
            const mins = Math.floor(diffSec / 60);
            return `Hace ${mins} ${mins === 1 ? 'minuto' : 'minutos'}`;
        }
        if (diffSec >= 3600 && diffSec < 86400) {
            const hrs = Math.floor(diffSec / 3600);
            return `Hace ${hrs} ${hrs === 1 ? 'hora' : 'horas'}`;
        }
        return date.toLocaleDateString('es-MX', {
            day: 'numeric',
            month: 'short',
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

    // Trunca el texto para la tarjeta del feed mostrando siempre '...' cuando es largo
    function makeExcerpt(rawText, maxChars = 210) {
        const singleLine = String(rawText || '').replace(/\s+/g, ' ').trim();
        if (singleLine.length <= maxChars) {
            return singleLine;
        }
        return singleLine.slice(0, maxChars).trimEnd() + '...';
    }

    function readStateFromUrl() {
        const params = new URLSearchParams(window.location.search);
        const searchParam = (params.get('search') || '').trim();
        const catParam = (params.get('categoria') || params.get('category') || '').toLowerCase().trim();
        const pageParam = parseInt(params.get('p') || '', 10);

        state.search = searchParam;
        searchInput.value = state.search;
        clearSearchBtn.hidden = !state.search;

        state.category = categoriesMap[catParam] ? catParam : '';
        state.page = (!isNaN(pageParam) && pageParam > 0) ? pageParam : 1;

        syncChipsVisualState();
    }

    function pushStateToUrl() {
        const params = new URLSearchParams();
        if (state.category) params.set('categoria', state.category);
        if (state.search) params.set('search', state.search);
        if (state.page > 1) params.set('p', String(state.page));
        const qs = params.toString();
        const nextUrl = `${window.location.pathname}${qs ? '?' + qs : ''}`;
        window.history.pushState({}, '', nextUrl);
    }

    function syncChipsVisualState() {
        catChips.forEach((chip) => {
            const cVal = chip.getAttribute('data-category') || '';
            chip.setAttribute('aria-pressed', cVal === state.category ? 'true' : 'false');
        });
        scopeChips.forEach((chip) => {
            const fVal = chip.getAttribute('data-filter') || 'all';
            chip.setAttribute('aria-pressed', fVal === state.filter ? 'true' : 'false');
        });
    }

    function updateCategoryBadges(countsObj) {
        if (!countsObj || typeof countsObj !== 'object') return;
        state.categoryCounts = countsObj;
        document.querySelectorAll('[data-cat-count]').forEach((el) => {
            const key = el.getAttribute('data-cat-count');
            el.textContent = String(countsObj[key] ?? 0);
        });
    }

    // Algoritmo iterativo de optimización de imágenes en cliente (< 3 MB)
    async function optimizeImageIterativelyClient(file, maxTargetBytes = 3 * 1024 * 1024) {
        const isImage = /^image\/(jpeg|png|webp)$/i.test(file.type);
        if (!isImage || file.size <= maxTargetBytes) {
            return { file, optimized: false, passes: 0, originalSize: file.size, finalSize: file.size };
        }

        const bitmapUrl = URL.createObjectURL(file);
        try {
            const img = await new Promise((resolve, reject) => {
                const imageEl = new Image();
                imageEl.onload = () => resolve(imageEl);
                imageEl.onerror = () => reject(new Error('No se pudo procesar la imagen para optimizarla.'));
                imageEl.src = bitmapUrl;
            });

            const qualities = [0.84, 0.70, 0.56, 0.42];
            const maxDimensions = [1920, 1536, 1228, 960];
            let currentBlob = null;
            let passes = 0;

            for (let i = 0; i < qualities.length; i++) {
                passes = i + 1;
                const maxDim = maxDimensions[i];
                const quality = qualities[i];

                let targetW = img.naturalWidth || img.width;
                let targetH = img.naturalHeight || img.height;

                if (targetW > maxDim || targetH > maxDim) {
                    const ratio = Math.min(maxDim / targetW, maxDim / targetH);
                    targetW = Math.max(320, Math.round(targetW * ratio));
                    targetH = Math.max(240, Math.round(targetH * ratio));
                }

                const canvas = document.createElement('canvas');
                canvas.width = targetW;
                canvas.height = targetH;
                const ctx = canvas.getContext('2d');
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, targetW, targetH);
                ctx.drawImage(img, 0, 0, targetW, targetH);

                currentBlob = await new Promise((resBlob) => canvas.toBlob(resBlob, 'image/jpeg', quality));
                if (currentBlob && currentBlob.size <= maxTargetBytes) {
                    break;
                }
            }

            if (!currentBlob || currentBlob.size > maxTargetBytes) {
                throw new Error('La imagen sigue superando los 3 MB tras 4 pasadas de optimización.');
            }

            const baseName = file.name.replace(/\.[^.]+$/, '') || 'imagen_optimizada';
            const optimizedFile = new File([currentBlob], `${baseName}.jpg`, {
                type: 'image/jpeg',
                lastModified: Date.now()
            });

            return {
                file: optimizedFile,
                optimized: true,
                passes,
                originalSize: file.size,
                finalSize: optimizedFile.size
            };
        } finally {
            URL.revokeObjectURL(bitmapUrl);
        }
    }

    async function loadPosts() {
        feedLoading.hidden = false;
        feedError.hidden = true;
        feedEmpty.hidden = true;
        feedList.hidden = true;
        feedPagination.hidden = true;
        feedSummary.textContent = 'Actualizando...';

        try {
            const params = new URLSearchParams();
            params.set('page', String(state.page));
            params.set('limit', String(state.limit));
            if (state.search) {
                params.set('search', state.search);
            }
            if (state.category) {
                params.set('category', state.category);
            }
            if (state.filter === 'mine' && sessionUser.userId) {
                params.set('user_id', String(sessionUser.userId));
            }
            if (state.filter === 'resources') {
                params.set('has_resources', '1');
            }

            const res = await fetch(`${baseUrl}api/posts?${params.toString()}`, {
                credentials: 'same-origin'
            });
            const json = await res.json();
            if (!res.ok || !json.success) {
                throw new Error(json.message || 'No fue posible obtener las publicaciones.');
            }

            state.posts = Array.isArray(json.data) ? json.data : [];
            state.pagination = json.pagination || { page: 1, limit: 10, total: state.posts.length, total_pages: 1 };
            if (json.category_counts) {
                updateCategoryBadges(json.category_counts);
            }

            renderFeed();
        } catch (err) {
            feedLoading.hidden = true;
            feedErrorMsg.textContent = err.message || 'Error de conexión con el servidor.';
            feedError.hidden = false;
            feedSummary.textContent = 'Error al cargar';
        }
    }

    function renderFeed() {
        feedLoading.hidden = true;

        const totalCount = Number(state.pagination.total ?? state.posts.length);
        const catSuffix = state.category ? ` en ${getCategoryLabel(state.category)}` : '';
        feedSummary.textContent = `${totalCount} ${totalCount === 1 ? 'publicación' : 'publicaciones'}${catSuffix}`;

        if (state.posts.length === 0) {
            feedList.hidden = true;
            feedPagination.hidden = true;

            const hasActiveFilter = Boolean(state.search || state.category || state.filter !== 'all');
            emptyResetBtn.hidden = !hasActiveFilter;

            if (state.search) {
                emptyTitle.textContent = 'Sin resultados para tu búsqueda';
                emptyDesc.textContent = `No encontramos publicaciones que coincidan con "${state.search}". Intenta con otros términos o limpia los filtros.`;
            } else if (state.filter === 'mine') {
                emptyTitle.textContent = 'Aún no tienes publicaciones en esta vista';
                emptyDesc.textContent = 'Cuando compartas una duda, apunte o proyecto con la comunidad, aparecerá listado aquí.';
            } else if (state.filter === 'resources') {
                emptyTitle.textContent = 'No hay publicaciones con archivos o enlaces';
                emptyDesc.textContent = 'Todavía no se han compartido documentos descargables ni enlaces externos en esta categoría.';
            } else if (state.category) {
                emptyTitle.textContent = `Sin publicaciones en ${getCategoryLabel(state.category)}`;
                emptyDesc.textContent = `Aún no hay hilos registrados en el área de ${getCategoryLabel(state.category)}. ¡Inicia el primero!`;
            } else {
                emptyTitle.textContent = 'Aún no hay publicaciones en el foro';
                emptyDesc.textContent = 'Sé la primera persona en iniciar una conversación académica, compartir apuntes o plantear una duda.';
            }

            feedEmpty.hidden = false;
            return;
        }

        feedEmpty.hidden = true;
        feedList.innerHTML = '';

        state.posts.forEach((post) => {
            const card = buildPostCard(post);
            feedList.appendChild(card);
        });

        feedList.hidden = false;
        renderPagination();
    }

    function buildAttachmentPills(post, threadUrl) {
        const pills = [];
        if (post.file_url) {
            const labels = {
                image: 'Contiene imagen adjunta',
                pdf: 'Contiene documento PDF',
                document: 'Contiene archivo adjunto',
                other: 'Contiene archivo adjunto'
            };
            const text = labels[post.file_type] || 'Contiene archivo adjunto';
            pills.push(`
                <a href="${escapeHtml(threadUrl)}" class="fr-attach-pill">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                    </svg>
                    <span>${escapeHtml(text)}</span>
                </a>
            `);
        }

        if (post.external_link) {
            let host = 'Enlace externo';
            try {
                host = new URL(post.external_link).hostname;
            } catch (e) {}
            pills.push(`
                <a href="${escapeHtml(threadUrl)}" class="fr-attach-pill">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                    <span>Enlace: ${escapeHtml(host)}</span>
                </a>
            `);
        }

        if (pills.length === 0) return '';
        return `<div class="fr-attachment-pills">${pills.join('')}</div>`;
    }

    function buildPostCard(post) {
        const postId = Number(post.post_id);
        const threadUrl = `${baseUrl}foro/${postId}`;
        const article = document.createElement('article');
        article.className = 'fr-card fr-post';
        article.id = `post-${postId}`;

        const roleLabel = getRoleLabel(post.role_id, post.role_name);
        const catKey = String(post.category || 'general').toLowerCase();
        const catLabel = getCategoryLabel(catKey);
        const initial = getInitial(post.author_name);
        const avatarClass = getAvatarClass(post.role_id);

        const excerpt = makeExcerpt(post.content, 210);
        const commentsCount = Number(post.comments_count || 0);
        const likesCount = Number(post.likes_count || 0);
        const userLiked = Boolean(post.user_liked);

        article.innerHTML = `
            <div class="fr-post-top">
                <div class="fr-author">
                    <div class="${avatarClass}" aria-hidden="true">${escapeHtml(initial)}</div>
                    <div class="fr-author-meta">
                        <div class="fr-author-line">
                            <span class="fr-author-name">${escapeHtml(post.author_name || 'Usuario')}</span>
                            <span class="fr-role-badge" data-role="${escapeHtml(post.role_id)}">${escapeHtml(roleLabel)}</span>
                            <button type="button" class="fr-cat-badge js-post-cat-btn" data-category="${escapeHtml(catKey)}" title="Filtrar por ${escapeHtml(catLabel)}">
                                ${escapeHtml(catLabel)}
                            </button>
                        </div>
                        <time class="fr-date" datetime="${escapeHtml(post.publication_date)}">${escapeHtml(formatDate(post.publication_date))}</time>
                    </div>
                </div>
            </div>

            <h2 class="fr-post-title">
                <a href="${escapeHtml(threadUrl)}" class="fr-post-title-link">${escapeHtml(post.title)}</a>
            </h2>

            <p class="fr-post-excerpt">${escapeHtml(excerpt)}</p>

            ${buildAttachmentPills(post, threadUrl)}

            <div class="fr-post-footer">
                <div class="fr-post-actions">
                    <button
                        type="button"
                        class="fr-btn fr-btn-line js-like-post"
                        aria-pressed="${userLiked ? 'true' : 'false'}"
                        style="padding:0.5rem 0.95rem;font-size:0.9rem"
                    >
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                        </svg>
                        <span>Útil (<span class="js-like-count">${likesCount}</span>)</span>
                    </button>

                    <a
                        href="${escapeHtml(threadUrl)}"
                        class="fr-btn fr-btn-line"
                        style="padding:0.5rem 0.95rem;font-size:0.9rem"
                    >
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <span>${commentsCount} ${commentsCount === 1 ? 'comentario' : 'comentarios'} · Ver hilo</span>
                    </a>

                    <button
                        type="button"
                        class="fr-btn fr-btn-ghost js-share-post"
                        style="padding:0.5rem 0.9rem;font-size:0.9rem"
                    >
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                        <span class="js-share-label">Copiar enlace</span>
                    </button>
                </div>
            </div>
        `;

        const catBtn = article.querySelector('.js-post-cat-btn');
        if (catBtn) {
            catBtn.addEventListener('click', () => {
                state.category = catBtn.getAttribute('data-category') || '';
                state.page = 1;
                syncChipsVisualState();
                pushStateToUrl();
                loadPosts();
            });
        }

        const likeBtn = article.querySelector('.js-like-post');
        if (likeBtn) {
            likeBtn.addEventListener('click', async () => {
                if (!sessionUser.isLoggedIn) {
                    showToast('Inicia sesión para marcar publicaciones como útiles.');
                    return;
                }
                likeBtn.disabled = true;
                try {
                    const res = await fetch(`${baseUrl}api/posts/${postId}/like`, {
                        method: 'POST',
                        credentials: 'same-origin'
                    });
                    const json = await res.json();
                    if (!res.ok || !json.success || !json.data) {
                        throw new Error(json.message || 'No se pudo registrar tu voto.');
                    }
                    post.user_liked = Boolean(json.data.liked);
                    post.likes_count = Number(json.data.likes_count || 0);
                    likeBtn.setAttribute('aria-pressed', post.user_liked ? 'true' : 'false');
                    likeBtn.querySelector('.js-like-count').textContent = String(post.likes_count);
                } catch (err) {
                    showToast(err.message || 'Error al procesar voto.');
                } finally {
                    likeBtn.disabled = false;
                }
            });
        }

        const shareBtn = article.querySelector('.js-share-post');
        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                const shareUrl = `${window.location.origin}${threadUrl}`;
                const labelEl = shareBtn.querySelector('.js-share-label');
                try {
                    await navigator.clipboard.writeText(shareUrl);
                    labelEl.textContent = 'Enlace copiado';
                    showToast('Enlace directo copiado al portapapeles.');
                    setTimeout(() => { labelEl.textContent = 'Copiar enlace'; }, 2200);
                } catch (e) {
                    window.prompt('Copia este enlace:', shareUrl);
                }
            });
        }

        return article;
    }

    function getPaginationRange(current, total) {
        if (total <= 7) {
            return Array.from({ length: total }, (_, i) => i + 1);
        }
        const pages = [1];
        const left = Math.max(2, current - 1);
        const right = Math.min(total - 1, current + 1);

        if (left > 2) pages.push('...');
        for (let i = left; i <= right; i++) pages.push(i);
        if (right < total - 1) pages.push('...');
        pages.push(total);
        return pages;
    }

    function renderPagination() {
        const totalPages = Number(state.pagination.total_pages || 1);
        const currentPage = Number(state.pagination.page || 1);

        if (totalPages <= 1) {
            feedPagination.hidden = true;
            feedPagination.innerHTML = '';
            return;
        }

        feedPagination.innerHTML = '';

        const prevBtn = document.createElement('button');
        prevBtn.type = 'button';
        prevBtn.className = 'fr-btn fr-btn-line';
        prevBtn.textContent = 'Anterior';
        prevBtn.disabled = currentPage <= 1;
        prevBtn.addEventListener('click', () => {
            if (state.page > 1) {
                state.page--;
                pushStateToUrl();
                loadPosts();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
        feedPagination.appendChild(prevBtn);

        const items = getPaginationRange(currentPage, totalPages);
        items.forEach((item) => {
            if (item === '...') {
                const span = document.createElement('span');
                span.className = 'fr-page-ellipsis';
                span.textContent = '...';
                span.setAttribute('aria-hidden', 'true');
                feedPagination.appendChild(span);
                return;
            }
            const pageBtn = document.createElement('button');
            pageBtn.type = 'button';
            pageBtn.className = 'fr-chip';
            pageBtn.setAttribute('aria-pressed', item === currentPage ? 'true' : 'false');
            pageBtn.setAttribute('aria-label', `Ir a la página ${item}`);
            pageBtn.textContent = String(item);
            pageBtn.addEventListener('click', () => {
                if (state.page !== item) {
                    state.page = item;
                    pushStateToUrl();
                    loadPosts();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
            feedPagination.appendChild(pageBtn);
        });

        const nextBtn = document.createElement('button');
        nextBtn.type = 'button';
        nextBtn.className = 'fr-btn fr-btn-line';
        nextBtn.textContent = 'Siguiente';
        nextBtn.disabled = currentPage >= totalPages;
        nextBtn.addEventListener('click', () => {
            if (state.page < totalPages) {
                state.page++;
                pushStateToUrl();
                loadPosts();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
        feedPagination.appendChild(nextBtn);

        feedPagination.hidden = false;
    }

    // Eventos de Búsqueda y Filtros
    window.addEventListener('popstate', () => {
        readStateFromUrl();
        loadPosts();
    });

    searchInput.addEventListener('input', () => {
        clearSearchBtn.hidden = searchInput.value.trim().length === 0;
    });

    clearSearchBtn.addEventListener('click', () => {
        searchInput.value = '';
        clearSearchBtn.hidden = true;
        if (state.search !== '') {
            state.search = '';
            state.page = 1;
            pushStateToUrl();
            loadPosts();
        }
        searchInput.focus();
    });

    searchForm.addEventListener('submit', (e) => {
        e.preventDefault();
        state.search = searchInput.value.trim();
        state.page = 1;
        pushStateToUrl();
        loadPosts();
    });

    catChips.forEach((chip) => {
        chip.addEventListener('click', () => {
            state.category = chip.getAttribute('data-category') || '';
            state.page = 1;
            syncChipsVisualState();
            pushStateToUrl();
            loadPosts();
        });
    });

    scopeChips.forEach((chip) => {
        chip.addEventListener('click', () => {
            state.filter = chip.getAttribute('data-filter') || 'all';
            state.page = 1;
            syncChipsVisualState();
            pushStateToUrl();
            loadPosts();
        });
    });

    emptyResetBtn.addEventListener('click', () => {
        searchInput.value = '';
        clearSearchBtn.hidden = true;
        state.search = '';
        state.category = '';
        state.filter = 'all';
        state.page = 1;
        syncChipsVisualState();
        pushStateToUrl();
        loadPosts();
    });

    retryFeedBtn.addEventListener('click', () => loadPosts());

    const sidebarMineBtn = document.getElementById('sidebar-mine-btn');
    if (sidebarMineBtn) {
        sidebarMineBtn.addEventListener('click', () => {
            state.filter = 'mine';
            state.page = 1;
            syncChipsVisualState();
            pushStateToUrl();
            loadPosts();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Modal de Nueva Publicación
    const composerBackdrop = document.getElementById('composer-backdrop');
    const composerForm = document.getElementById('post-composer-form');
    const composerTitleInput = document.getElementById('composer-title-input');
    const composerTitleCount = document.getElementById('composer-title-count');
    const composerContentInput = document.getElementById('composer-content-input');
    const composerLinkInput = document.getElementById('composer-link-input');
    const composerFileInput = document.getElementById('composer-file-input');
    const composerFileName = document.getElementById('composer-file-name');
    const composerFileHint = document.getElementById('composer-file-hint');
    const composerRemoveFileBtn = document.getElementById('composer-remove-file-btn');
    const composerError = document.getElementById('composer-error');
    const submitComposerBtn = document.getElementById('submit-composer-btn');
    const submitComposerText = document.getElementById('submit-composer-text');

    function openComposerModal(triggerEl = null) {
        if (!composerBackdrop) return;
        state.lastTriggerEl = triggerEl || document.activeElement;
        state.preparedUploadFile = null;
        composerForm.reset();
        composerError.hidden = true;
        composerFileName.textContent = 'Ningún archivo seleccionado';
        composerFileHint.textContent = 'Si subes una imagen pesada (> 3 MB), se redimensionará y optimizará automáticamente.';
        composerRemoveFileBtn.hidden = true;

        const targetCat = state.category || 'general';
        const catRadio = composerForm.querySelector(`input[name="category"][value="${targetCat}"]`);
        if (catRadio) catRadio.checked = true;

        composerTitleCount.textContent = '0 / 200';
        composerBackdrop.hidden = false;
        setTimeout(() => composerTitleInput.focus(), 20);
    }

    function closeComposerModal() {
        if (!composerBackdrop || composerBackdrop.hidden) return;
        composerBackdrop.hidden = true;
        if (state.lastTriggerEl && typeof state.lastTriggerEl.focus === 'function') {
            state.lastTriggerEl.focus();
        }
    }

    if (composerBackdrop) {
        const openCreateBtn = document.getElementById('open-create-modal-btn');
        const emptyCreateBtn = document.getElementById('empty-create-btn');
        const sidebarCreateBtn = document.getElementById('sidebar-create-btn');
        const closeComposerBtn = document.getElementById('close-composer-btn');
        const cancelComposerBtn = document.getElementById('cancel-composer-btn');

        if (openCreateBtn) openCreateBtn.addEventListener('click', () => openComposerModal(openCreateBtn));
        if (emptyCreateBtn) emptyCreateBtn.addEventListener('click', () => openComposerModal(emptyCreateBtn));
        if (sidebarCreateBtn) sidebarCreateBtn.addEventListener('click', () => openComposerModal(sidebarCreateBtn));
        if (closeComposerBtn) closeComposerBtn.addEventListener('click', closeComposerModal);
        if (cancelComposerBtn) cancelComposerBtn.addEventListener('click', closeComposerModal);

        composerBackdrop.addEventListener('click', (e) => {
            if (e.target === composerBackdrop) closeComposerModal();
        });

        composerTitleInput.addEventListener('input', () => {
            composerTitleCount.textContent = `${composerTitleInput.value.length} / 200`;
            composerError.hidden = true;
        });

        composerContentInput.addEventListener('input', () => {
            composerError.hidden = true;
        });

        composerFileInput.addEventListener('change', async () => {
            composerError.hidden = true;
            const rawFile = composerFileInput.files && composerFileInput.files[0];
            if (!rawFile) {
                state.preparedUploadFile = null;
                composerFileName.textContent = 'Ningún archivo seleccionado';
                composerRemoveFileBtn.hidden = true;
                return;
            }

            const isImg = /^image\/(jpeg|png|webp)$/i.test(rawFile.type);
            if (!isImg && rawFile.size > 10 * 1024 * 1024) {
                composerFileInput.value = '';
                state.preparedUploadFile = null;
                composerError.textContent = 'El documento supera el tamaño máximo permitido de 10 MB.';
                composerError.hidden = false;
                return;
            }

            if (isImg && rawFile.size > 3 * 1024 * 1024) {
                composerFileName.textContent = `Optimizando imagen (${(rawFile.size / (1024 * 1024)).toFixed(2)} MB)...`;
                submitComposerBtn.disabled = true;
                try {
                    const result = await optimizeImageIterativelyClient(rawFile, 3 * 1024 * 1024);
                    state.preparedUploadFile = result.file;
                    const origMb = (result.originalSize / (1024 * 1024)).toFixed(2);
                    const finalMb = (result.finalSize / (1024 * 1024)).toFixed(2);
                    composerFileName.textContent = `${result.file.name} (${finalMb} MB)`;
                    composerFileHint.textContent = `Optimizada automáticamente de ${origMb} MB a ${finalMb} MB (${result.passes} ${result.passes === 1 ? 'pasada' : 'pasadas'}).`;
                    composerRemoveFileBtn.hidden = false;
                } catch (err) {
                    composerFileInput.value = '';
                    state.preparedUploadFile = null;
                    composerFileName.textContent = 'Ningún archivo seleccionado';
                    composerRemoveFileBtn.hidden = true;
                    composerError.textContent = err.message || 'No se pudo optimizar la imagen.';
                    composerError.hidden = false;
                } finally {
                    submitComposerBtn.disabled = false;
                }
            } else {
                state.preparedUploadFile = rawFile;
                const sizeMb = (rawFile.size / (1024 * 1024)).toFixed(2);
                composerFileName.textContent = `${rawFile.name} (${sizeMb} MB)`;
                composerFileHint.textContent = 'Archivo listo para adjuntarse.';
                composerRemoveFileBtn.hidden = false;
            }
        });

        composerRemoveFileBtn.addEventListener('click', () => {
            composerFileInput.value = '';
            state.preparedUploadFile = null;
            composerFileName.textContent = 'Ningún archivo seleccionado';
            composerFileHint.textContent = 'Si subes una imagen pesada (> 3 MB), se redimensionará y optimizará automáticamente.';
            composerRemoveFileBtn.hidden = true;
        });

        composerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            composerError.hidden = true;

            const checkedCat = composerForm.querySelector('input[name="category"]:checked');
            const category = checkedCat ? checkedCat.value : 'general';
            const title = composerTitleInput.value.trim();
            const content = composerContentInput.value.trim();
            const externalLink = composerLinkInput.value.trim();

            if (!title) {
                composerError.textContent = 'El título de la publicación es obligatorio.';
                composerError.hidden = false;
                composerTitleInput.focus();
                return;
            }
            if (!content) {
                composerError.textContent = 'El contenido de la publicación es obligatorio.';
                composerError.hidden = false;
                composerContentInput.focus();
                return;
            }

            submitComposerBtn.disabled = true;
            submitComposerText.textContent = 'Publicando...';

            try {
                const formData = new FormData();
                formData.append('category', category);
                formData.append('title', title);
                formData.append('content', content);
                formData.append('external_link', externalLink);
                if (state.preparedUploadFile) {
                    formData.append('file', state.preparedUploadFile);
                }

                const res = await fetch(`${baseUrl}api/posts`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                });
                const json = await res.json();
                if (!res.ok || !json.success || !json.data) {
                    throw new Error(json.message || 'No se pudo guardar la publicación.');
                }

                // Redirigir directamente a la nueva página foro/{id} de la publicación creada
                window.location.href = `${baseUrl}foro/${json.data.post_id}`;
            } catch (err) {
                composerError.textContent = err.message || 'Error de conexión con el servidor.';
                composerError.hidden = false;
                submitComposerBtn.disabled = false;
                submitComposerText.textContent = 'Publicar en el foro';
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && composerBackdrop && !composerBackdrop.hidden) {
            closeComposerModal();
        }
    });

    readStateFromUrl();
    loadPosts();
})();
</script>
