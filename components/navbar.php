<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['full_name'] ?? 'Usuario';
$userEmail = $_SESSION['institutional_email'] ?? '';
$userRoleId = $_SESSION['role_id'] ?? 4;

$rolesMap = [
    1 => 'Administrador',
    2 => 'Coordinador',
    3 => 'Profesor',
    4 => 'Estudiante'
];
$userRoleName = $rolesMap[$userRoleId] ?? 'Estudiante';
$userInitial = mb_strtoupper(mb_substr($userName, 0, 1, 'UTF-8'), 'UTF-8');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ing. Teleinformática</title>

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>public/img/favicon.ico">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/tailwind/output.css">

  <style>
    .nav-item.open > .dropdown-panel,
    .nav-right.open > .user-dropdown-panel {
      display: block;
    }

    #menu-movil {
      position: fixed;
      inset: 4rem 0 0;
      width: 100vw;
      max-width: 100vw;
      height: calc(100vh - 4rem);
      max-height: calc(100vh - 4rem);
      overflow-y: auto;
      overflow-x: hidden;
      background: var(--color-navy);
      z-index: 40;
    }

    #menu-movil,
    #menu-movil * {
      color: #ffffff;
      text-decoration: none;
    }

    #menu-movil a,
    #menu-movil span,
    #menu-movil div {
      color: inherit;
    }

    #menu-movil a:hover,
    #menu-movil a:focus,
    #menu-movil a:active {
      color: var(--color-green);
    }

    #menu-movil .mobile-section-title,
    #menu-movil .mobile-section-title * {
      color: var(--color-green);
    }

    body.menu-open {
      overflow: hidden;
      position: fixed;
      width: 100%;
    }
  </style>

  <script>
    window.BASE_URL = <?php echo json_encode(BASE_URL); ?>;
    function logoutUser(e) {
      if (e) {
        e.preventDefault();
        e.stopPropagation();
      }
      window.location.href = <?php echo json_encode(BASE_URL . 'logout'); ?>;
    }
  </script>
</head>

<body class="m-0 p-0 bg-bg-main">

  <nav class="sticky top-0 z-50 flex items-center justify-between h-16 px-4 sm:px-10 bg-navy border-b border-border-main shadow-sm gap-1">

    <!-- Logo -->
    <a href="<?php echo BASE_URL; ?>" class="flex items-center shrink-0" aria-label="Ir al inicio">
      <img src="<?php echo BASE_URL; ?>public/img/INTEL_White.png" class="w-24 sm:w-auto h-10 object-contain" alt="INTEL">
    </a>

    <!-- ===== Menú de escritorio ===== -->
    <ul class="hidden md:flex items-center justify-end gap-1 my-0 ml-auto p-0 list-none nav-links">

      <li class="relative group nav-item" id="ni-inicio">
        <button type="button" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-green-pale hover:text-green transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-inicio')">
          Inicio
        </button>
        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-48 z-50 dropdown-panel">
          <div class="flex flex-col p-2 bg-white border border-border-main rounded-xl shadow-lg dropdown">
            <a href="<?php echo BASE_URL; ?>noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Noticias</a>
            <a href="<?php echo BASE_URL; ?>galeria" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Galería</a>
            <a href="<?php echo BASE_URL; ?>inicio" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Sobre Nosotros</a>
            <a href="<?php echo BASE_URL; ?>showcase" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Showcase de Proyectos</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-foro">
        <button type="button" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-green-pale hover:text-green transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-foro')">
          Foro
        </button>
        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-48 z-50 dropdown-panel">
          <div class="flex flex-col p-2 bg-white border border-border-main rounded-xl shadow-lg dropdown">
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Electrónica</a>
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Sistemas</a>
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Programación</a>
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Redes</a>
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>General</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-blogs">
        <button type="button" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-green-pale hover:text-green transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-blogs')">
          Blogs
        </button>
        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-48 z-50 dropdown-panel">
          <div class="flex flex-col p-2 bg-white border border-border-main rounded-xl shadow-lg dropdown">
            <a href="<?php echo BASE_URL; ?>noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Electrónica</a>
            <a href="<?php echo BASE_URL; ?>noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Sistemas</a>
            <a href="<?php echo BASE_URL; ?>noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Programación</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-academia">
        <button type="button" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-green-pale hover:text-green transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-academia')">
          Academia
        </button>
        <div class="absolute right-0 top-full pt-2 hidden group-hover:block w-48 z-50 dropdown-panel">
          <div class="flex flex-col p-2 bg-white border border-border-main rounded-xl shadow-lg dropdown">
            <a href="<?php echo BASE_URL; ?>malla_curricular" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Malla Curricular</a>
            <a href="<?php echo BASE_URL; ?>consulta_de_horarios" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Horarios</a>
            <a href="<?php echo BASE_URL; ?>becas" class="flex items-center gap-2 px-3 py-2 text-sm text-text-mid rounded-lg hover:bg-green-pale hover:text-green transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-green opacity-0 dot"></span>Becas</a>
          </div>
        </div>
      </li>

    </ul>

    <!-- ===== Usuario + botón hamburguesa ===== -->
    <div class="flex items-center gap-2 ml-auto md:ml-2 shrink-0">

      <!-- Ícono / Avatar de usuario -->
      <div class="relative shrink-0 group nav-right" id="user-menu-container">
        <button type="button" id="btn-user-toggle" class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white border border-border-main text-text-muted hover:border-green hover:bg-green-pale hover:text-green transition-colors user-btn shadow-sm cursor-pointer" title="<?php echo $isLoggedIn ? htmlspecialchars($userName) : 'Mi cuenta'; ?>" aria-label="Mi cuenta" aria-expanded="false">
          <?php if ($isLoggedIn): ?>
            <span class="text-xs sm:text-sm font-bold text-navy"><?php echo htmlspecialchars($userInitial); ?></span>
          <?php else: ?>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="8" r="4" />
              <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
            </svg>
          <?php endif; ?>
        </button>

        <!-- Dropdown de usuario -->
        <div class="absolute right-0 top-full pt-2 hidden group-hover:block z-50 user-dropdown-panel" id="user-dropdown-panel" style="width: 310px; min-width: 290px; max-width: calc(100vw - 20px);">
          <?php if ($isLoggedIn): ?>
            <!-- Estado: Sesión Iniciada -->
            <div class="w-full overflow-hidden rounded-2xl border border-[#d5e2ef] bg-white shadow-[0_10px_30px_rgba(9,64,116,0.12)]" id="user-dd">
              <div class="border-b border-[#e8f0f9] bg-gradient-to-b from-white to-[#f9fafb] px-4 py-3.5">
                <div class="flex items-center gap-3">
                  <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-navy text-base font-bold text-white shadow-[0_2px_6px_rgba(9,64,116,0.25)]">
                    <?php echo htmlspecialchars($userInitial); ?>
                  </div>
                  <div class="min-w-0 flex-1 overflow-hidden">
                    <div class="truncate text-sm font-bold leading-5 text-navy" title="<?php echo htmlspecialchars($userName); ?>">
                      <?php echo htmlspecialchars($userName); ?>
                    </div>
                    <div class="mt-0.5 truncate text-[12px] text-text-muted" title="<?php echo htmlspecialchars($userEmail); ?>">
                      <?php echo htmlspecialchars($userEmail); ?>
                    </div>
                    <div class="mt-1.5">
                      <span class="inline-block rounded-full border border-[#c3edd9] bg-[#e6f7f3] px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-[0.05em] text-[#2e9e02]">
                        <?php echo htmlspecialchars($userRoleName); ?>
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Enlaces rápidos -->
              <div class="flex flex-col gap-1 px-2 py-1.5">
                <a href="<?php echo BASE_URL; ?>inicio" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-xs font-medium text-text-mid transition-colors no-underline hover:bg-green-pale hover:text-green">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                  </svg>
                  <span>Inicio</span>
                </a>
                <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-xs font-medium text-text-mid transition-colors no-underline hover:bg-green-pale hover:text-green">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                  </svg>
                  <span>Comunidad & Foro</span>
                </a>
                <a href="<?php echo BASE_URL; ?>feedback" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-xs font-medium text-text-mid transition-colors no-underline hover:bg-green-pale hover:text-green">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                  </svg>
                  <span>Encuesta UX</span>
                </a>
              </div>

              <!-- Botón de Cerrar Sesión -->
              <div class="border-t border-[#e8f0f9] bg-white px-3.5 py-2.5">
                <a href="<?php echo BASE_URL; ?>logout" onclick="logoutUser(event)" class="flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-3 py-2.5 text-[13px] font-bold text-red-600 no-underline transition-colors hover:bg-red-100 hover:text-red-700">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                  </svg>
                  <span>Cerrar sesión</span>
                </a>
              </div>
            </div>
          <?php else: ?>
            <!-- Estado: No Autenticado -->
            <div class="w-full rounded-2xl border border-border-main bg-white p-4 shadow-xl" id="user-dd">
              <div class="mb-2 border-b border-border-lt pb-3 text-center user-no-found">
                <div class="mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-full border border-dashed border-border-main bg-white text-text-muted user-avatar-lg">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                  </svg>
                </div>
                <strong class="mb-1 block text-sm font-bold text-text-main">Usuario no identificado</strong>
                <p class="mt-1 text-xs text-text-muted">Inicia sesión para acceder a tu cuenta</p>
              </div>
              <div class="auth-btns flex gap-2 py-1">
                <a href="<?php echo BASE_URL; ?>login" class="btn-login flex-1 rounded-lg border border-border-main bg-white px-1 py-2 text-center text-[13px] font-semibold text-text-mid no-underline transition-colors hover:border-green hover:text-green hover:bg-green-pale">Iniciar sesión</a>
                <a href="<?php echo BASE_URL; ?>register" class="btn-register flex-1 rounded-lg bg-green px-1 py-2 text-center text-[13px] font-semibold text-white no-underline transition-colors hover:bg-green-lt">Registrarse</a>
              </div>
              <a href="<?php echo BASE_URL; ?>feedback" class="support-link mt-1 flex items-center gap-2 rounded-lg border-t border-border-lt p-2 text-xs text-text-muted no-underline transition-colors hover:bg-green-pale hover:text-green">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                Diagnóstico & Encuesta UX
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Botón hamburguesa (celular) -->
      <button
        type="button"
        id="btn-menu-toggle"
        class="group md:hidden flex items-center justify-center w-9 h-9 rounded-lg text-white bg-transparent border border-transparent hover:bg-green-pale hover:text-green transition-colors cursor-pointer"
        data-menu-toggle
        aria-label="Abrir menú"
        aria-controls="menu-movil"
        aria-expanded="false"
      >
        <!-- Ícono hamburguesa -->
        <svg id="icon-hamburger" class="w-6 h-6 group-aria-expanded:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
          <line x1="4" y1="7" x2="20" y2="7"></line>
          <line x1="4" y1="12" x2="20" y2="12"></line>
          <line x1="4" y1="17" x2="20" y2="17"></line>
        </svg>
        <!-- Ícono cerrar -->
        <svg id="icon-close" class="w-6 h-6 hidden group-aria-expanded:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
          <line x1="6" y1="6" x2="18" y2="18"></line>
          <line x1="18" y1="6" x2="6" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- ===== Panel del menú móvil ===== -->
    <div
      id="menu-movil"
      class="hidden md:hidden bg-navy border-t border-white/10 shadow-lg"
      data-menu-panel
    >
      <div class="p-4 space-y-4">

        <?php if ($isLoggedIn): ?>
          <div class="border-b border-white/10 pb-3">
            <div class="flex items-center gap-3 rounded-xl border border-white/10 bg-white/5 px-3 py-3">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green text-sm font-bold text-navy">
                <?php echo htmlspecialchars($userInitial); ?>
              </div>
              <div class="min-w-0 flex-1">
                <div class="truncate text-sm font-semibold text-white" title="<?php echo htmlspecialchars($userName); ?>"><?php echo htmlspecialchars($userName); ?></div>
                <div class="text-[11px] font-medium uppercase tracking-wide text-green"><?php echo htmlspecialchars($userRoleName); ?></div>
              </div>
            </div>
            <a href="<?php echo BASE_URL; ?>logout" onclick="logoutUser(event)" class="mt-3 flex items-center justify-center gap-2 rounded-lg border border-red-400/40 bg-red-500/10 px-3 py-2 text-sm font-semibold text-red-200 no-underline transition-colors hover:bg-red-500/20 hover:text-white">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>
              <span>Cerrar sesión</span>
            </a>
          </div>
        <?php else: ?>
          <div class="border-b border-white/10 pb-3">
            <div class="grid grid-cols-2 gap-2">
              <a href="<?php echo BASE_URL; ?>login" class="flex items-center justify-center rounded-lg border border-white/15 bg-white/5 px-3 py-2.5 text-sm font-semibold text-white no-underline transition-colors hover:border-green hover:bg-white/10">Iniciar sesión</a>
              <a href="<?php echo BASE_URL; ?>register" class="flex items-center justify-center rounded-lg bg-green px-3 py-2.5 text-sm font-semibold text-navy no-underline transition-colors hover:bg-green-lt hover:text-white">Registrarse</a>
            </div>
          </div>
        <?php endif; ?>

        <!-- Sección: Inicio -->
        <div class="border-b border-white/10 pb-3">
          <span class="mobile-section-title block px-3 py-1 text-xs font-bold uppercase tracking-wider text-green">Inicio</span>
          <div class="mt-1 flex flex-col space-y-0.5">
            <a href="<?php echo BASE_URL; ?>noticias" class="block px-3 py-2 text-sm text-white hover:text-green hover:bg-white/5 rounded-lg no-underline transition-colors">Noticias</a>
            <a href="<?php echo BASE_URL; ?>galeria" class="block px-3 py-2 text-sm text-white hover:text-green hover:bg-white/5 rounded-lg no-underline transition-colors">Galería</a>
            <a href="<?php echo BASE_URL; ?>inicio" class="block px-3 py-2 text-sm text-white hover:text-green hover:bg-white/5 rounded-lg no-underline transition-colors">Sobre Nosotros</a>
            <a href="<?php echo BASE_URL; ?>showcase" class="block px-3 py-2 text-sm text-white hover:text-green hover:bg-white/5 rounded-lg no-underline transition-colors">Showcase de Proyectos</a>
          </div>
        </div>

        <!-- Sección: Foro -->
        <div class="border-b border-white/10 pb-3">
          <span class="mobile-section-title block px-3 py-1 text-xs font-bold uppercase tracking-wider text-green">Foro</span>
          <div class="mt-1">
            <a href="<?php echo BASE_URL; ?>foro" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white hover:text-green hover:bg-white/5 rounded-lg no-underline transition-colors">
              <span>Ir al foro</span>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>

        <!-- Sección: Blogs -->
        <div class="border-b border-white/10 pb-3">
          <span class="mobile-section-title block px-3 py-1 text-xs font-bold uppercase tracking-wider text-green">Blogs</span>
          <div class="mt-1">
            <a href="<?php echo BASE_URL; ?>noticias" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-white hover:text-green hover:bg-white/5 rounded-lg no-underline transition-colors">
              <span>Ir al blog</span>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>

        <!-- Sección: Academia -->
        <div class="border-b border-white/10 pb-1">
          <span class="mobile-section-title block px-3 py-1 text-xs font-bold uppercase tracking-wider text-green">Academia</span>
          <div class="mt-1 flex flex-col space-y-0.5">
            <a href="<?php echo BASE_URL; ?>malla_curricular" class="block px-3 py-2 text-sm text-white hover:text-green hover:bg-white/5 rounded-lg no-underline transition-colors">Malla Curricular</a>
            <a href="<?php echo BASE_URL; ?>consulta_de_horarios" class="block px-3 py-2 text-sm text-white hover:text-green hover:bg-white/5 rounded-lg no-underline transition-colors">Horarios</a>
            <a href="<?php echo BASE_URL; ?>becas" class="block px-3 py-2 text-sm text-white hover:text-green hover:bg-white/5 rounded-lg no-underline transition-colors">Becas</a>
          </div>
        </div>

      </div>
    </div>

  </nav>