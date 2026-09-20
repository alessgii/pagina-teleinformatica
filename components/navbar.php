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
      display: block !important;
    }
  </style>

  <script>
    window.BASE_URL = <?php echo json_encode(BASE_URL); ?>;
  </script>
</head>

<!-- m-0 p-0: elimina el margen de 8px que el navegador aplica por defecto al <body> -->
<body class="m-0 p-0 bg-[var(--color-bg-main)]">

  <nav class="sticky top-0 z-50 flex items-center justify-between h-16 px-4 sm:px-10 bg-[var(--color-navy)] border-b border-[var(--color-border-main)] shadow-sm gap-1">

    <!-- Logo -->
    <a href="<?php echo BASE_URL; ?>inicio" class="flex items-center shrink-0" aria-label="Ir al inicio">
      <img src="<?php echo BASE_URL; ?>public/img/INTEL.png" class="w-24 sm:w-36 h-auto object-contain" alt="INTEL">
    </a>

    <!-- ===== Menú de escritorio (oculto en celular) ===== -->
    <ul class="hidden md:flex items-center justify-end gap-1 my-0 ml-auto p-0 list-none nav-links">

      <li class="relative group nav-item" id="ni-inicio">
        <button type="button" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-inicio')">
          Inicio
        </button>
        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-48 z-50 dropdown-panel">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="<?php echo BASE_URL; ?>noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Noticias</a>
            <a href="<?php echo BASE_URL; ?>galeria" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Galería</a>
            <a href="<?php echo BASE_URL; ?>inicio" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Sobre Nosotros</a>
            <a href="<?php echo BASE_URL; ?>showcase" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Showcase de Proyectos</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-foro">
        <button type="button" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-foro')">
          Foro
        </button>
        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-48 z-50 dropdown-panel">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Electrónica</a>
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Sistemas</a>
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Programación</a>
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Redes</a>
            <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>General</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-blogs">
        <button type="button" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-blogs')">
          Blogs
        </button>
        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-48 z-50 dropdown-panel">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="<?php echo BASE_URL; ?>noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Electrónica</a>
            <a href="<?php echo BASE_URL; ?>noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Sistemas</a>
            <a href="<?php echo BASE_URL; ?>noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Programación</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-academia">
        <button type="button" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-academia')">
          Academia
        </button>
        <div class="absolute right-0 top-full pt-2 hidden group-hover:block w-48 z-50 dropdown-panel">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="<?php echo BASE_URL; ?>malla_curricular" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Malla Curricular</a>
            <a href="<?php echo BASE_URL; ?>consulta_de_horarios" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Horarios</a>
            <a href="<?php echo BASE_URL; ?>academia" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Becas</a>
          </div>
        </div>
      </li>

    </ul>

    <!-- ===== Usuario + botón hamburguesa ===== -->
    <div class="flex items-center gap-2 ml-auto md:ml-2 shrink-0">

      <!-- Ícono / Avatar de usuario -->
      <div class="relative shrink-0 group nav-right" id="user-menu-container">
        <button type="button" class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white border border-[var(--color-border-main)] text-[var(--color-text-muted)] hover:border-[var(--color-green)] hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors user-btn shadow-sm cursor-pointer" onclick="toggleUser(event)" title="<?php echo $isLoggedIn ? htmlspecialchars($userName) : 'Mi cuenta'; ?>" aria-label="Mi cuenta">
          <?php if ($isLoggedIn): ?>
            <span class="text-xs sm:text-sm font-bold text-[var(--color-navy)]"><?php echo htmlspecialchars($userInitial); ?></span>
          <?php else: ?>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="8" r="4" />
              <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
            </svg>
          <?php endif; ?>
        </button>

        <!-- Dropdown de usuario -->
        <div class="absolute right-0 top-full pt-2 hidden group-hover:block w-64 z-50 user-dropdown-panel" id="user-dropdown-panel">
          <?php if ($isLoggedIn): ?>
            <!-- Estado: Sesión Iniciada -->
            <div class="bg-white border border-[var(--color-border-main)] rounded-xl p-3.5 shadow-xl user-dropdown" id="user-dd">
              <div class="flex items-center gap-3 pb-3 mb-2 border-b border-[var(--color-border-lt)]">
                <div class="flex items-center justify-center w-11 h-11 shrink-0 rounded-full bg-[var(--color-navy)] text-white font-bold text-base shadow-sm">
                  <?php echo htmlspecialchars($userInitial); ?>
                </div>
                <div class="min-w-0 flex-1">
                  <strong class="block text-sm font-bold text-[var(--color-text-main)] truncate" title="<?php echo htmlspecialchars($userName); ?>">
                    <?php echo htmlspecialchars($userName); ?>
                  </strong>
                  <p class="text-xs text-[var(--color-text-muted)] truncate mt-0.5" title="<?php echo htmlspecialchars($userEmail); ?>">
                    <?php echo htmlspecialchars($userEmail); ?>
                  </p>
                  <span class="inline-block mt-1.5 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider rounded-full bg-[var(--color-green-pale)] text-[var(--color-green-lt)]">
                    <?php echo htmlspecialchars($userRoleName); ?>
                  </span>
                </div>
              </div>

              <div class="flex flex-col gap-1 py-1">
                <a href="<?php echo BASE_URL; ?>inicio" class="flex items-center gap-2 px-2.5 py-1.5 text-xs font-medium text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                  </svg>
                  Inicio
                </a>
                <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2 px-2.5 py-1.5 text-xs font-medium text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                  </svg>
                  Comunidad & Foro
                </a>
              </div>

              <div class="pt-2 mt-1 border-t border-[var(--color-border-lt)]">
                <button type="button" onclick="logoutUser()" class="w-full flex items-center justify-center gap-2 py-2 px-3 rounded-lg text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 hover:text-red-700 border border-red-200/80 transition-all cursor-pointer">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                  </svg>
                  Cerrar sesión
                </button>
              </div>
            </div>
          <?php else: ?>
            <!-- Estado: No Autenticado / Invitado -->
            <div class="bg-white border border-[var(--color-border-main)] rounded-xl p-3 shadow-lg user-dropdown" id="user-dd">
              <div class="text-center pb-3 mb-2 border-b border-[var(--color-border-lt)] user-no-found">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-2 rounded-full bg-white border border-dashed border-[var(--color-border-main)] text-[var(--color-text-muted)] user-avatar-lg">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                  </svg>
                </div>
                <strong class="block text-sm font-bold text-[var(--color-text-main)] mb-1">Usuario no identificado</strong>
                <p class="text-xs text-[var(--color-text-muted)] mt-1">Inicia sesión para acceder a tu cuenta</p>
              </div>
              <div class="flex gap-2 py-1 auth-btns">
                <a href="<?php echo BASE_URL; ?>login" class="flex-1 text-center py-2 px-1 rounded-lg text-[13px] font-semibold text-[var(--color-text-mid)] bg-white border border-[var(--color-border-main)] hover:border-[var(--color-green)] hover:text-[var(--color-green)] hover:bg-[var(--color-green-pale)] transition-colors btn-login no-underline">Iniciar sesión</a>
                <a href="<?php echo BASE_URL; ?>register" class="flex-1 text-center py-2 px-1 rounded-lg text-[13px] font-semibold text-white bg-[var(--color-green)] hover:bg-[var(--color-green-lt)] transition-colors btn-register no-underline">Registrarse</a>
              </div>
              <a href="#" class="flex items-center gap-2 p-2 mt-1 border-t border-[var(--color-border-lt)] text-xs text-[var(--color-text-muted)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors support-link no-underline">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                ⓘ Ayuda y Soporte
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Botón hamburguesa (solo celular) -->
      <button
        type="button"
        class="group md:hidden flex items-center justify-center w-9 h-9 rounded-lg text-white bg-transparent border border-transparent hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors cursor-pointer"
        data-menu-toggle
        aria-label="Abrir menú"
        aria-controls="menu-movil"
        aria-expanded="false"
      >
        <!-- Ícono hamburguesa -->
        <svg class="w-6 h-6 group-aria-expanded:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
          <line x1="4" y1="7" x2="20" y2="7"></line>
          <line x1="4" y1="12" x2="20" y2="12"></line>
          <line x1="4" y1="17" x2="20" y2="17"></line>
        </svg>
        <!-- Ícono cerrar -->
        <svg class="w-6 h-6 hidden group-aria-expanded:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
          <line x1="6" y1="6" x2="18" y2="18"></line>
          <line x1="18" y1="6" x2="6" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- ===== Panel del menú móvil ===== -->
    <div
      id="menu-movil"
      class="hidden md:hidden absolute top-full inset-x-0 max-h-[calc(100vh-4rem)] overflow-y-auto bg-[var(--color-navy)] border-t border-white/10 shadow-lg"
      data-menu-panel
    >
      <ul class="my-0 p-0 list-none">

        <li class="border-b border-white/10">
          <button type="button" class="group flex w-full items-center justify-between px-5 py-4 text-left text-base font-medium text-white bg-transparent border-0 cursor-pointer hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors" data-accordion-btn aria-controls="mm-inicio" aria-expanded="false">
            Inicio
            <svg class="w-5 h-5 shrink-0 transition-transform group-aria-expanded:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div id="mm-inicio" class="hidden pb-2 bg-[var(--color-navy-mid)]">
            <a href="<?php echo BASE_URL; ?>noticias" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Noticias</a>
            <a href="<?php echo BASE_URL; ?>galeria" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Galería</a>
            <a href="<?php echo BASE_URL; ?>inicio" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Sobre Nosotros</a>
            <a href="<?php echo BASE_URL; ?>showcase" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Showcase de Proyectos</a>
          </div>
        </li>

        <li class="border-b border-white/10">
          <button type="button" class="group flex w-full items-center justify-between px-5 py-4 text-left text-base font-medium text-white bg-transparent border-0 cursor-pointer hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors" data-accordion-btn aria-controls="mm-foro" aria-expanded="false">
            Foro
            <svg class="w-5 h-5 shrink-0 transition-transform group-aria-expanded:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div id="mm-foro" class="hidden pb-2 bg-[var(--color-navy-mid)]">
            <a href="<?php echo BASE_URL; ?>foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Electrónica</a>
            <a href="<?php echo BASE_URL; ?>foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Sistemas</a>
            <a href="<?php echo BASE_URL; ?>foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Programación</a>
            <a href="<?php echo BASE_URL; ?>foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Redes</a>
            <a href="<?php echo BASE_URL; ?>foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">General</a>
          </div>
        </li>

        <li class="border-b border-white/10">
          <button type="button" class="group flex w-full items-center justify-between px-5 py-4 text-left text-base font-medium text-white bg-transparent border-0 cursor-pointer hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors" data-accordion-btn aria-controls="mm-blogs" aria-expanded="false">
            Blogs
            <svg class="w-5 h-5 shrink-0 transition-transform group-aria-expanded:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div id="mm-blogs" class="hidden pb-2 bg-[var(--color-navy-mid)]">
            <a href="<?php echo BASE_URL; ?>noticias" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Electrónica</a>
            <a href="<?php echo BASE_URL; ?>noticias" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Sistemas</a>
            <a href="<?php echo BASE_URL; ?>noticias" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Programación</a>
          </div>
        </li>

        <li class="border-b border-white/10">
          <button type="button" class="group flex w-full items-center justify-between px-5 py-4 text-left text-base font-medium text-white bg-transparent border-0 cursor-pointer hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors" data-accordion-btn aria-controls="mm-academia" aria-expanded="false">
            Academia
            <svg class="w-5 h-5 shrink-0 transition-transform group-aria-expanded:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div id="mm-academia" class="hidden pb-2 bg-[var(--color-navy-mid)]">
            <a href="<?php echo BASE_URL; ?>malla_curricular" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Malla Curricular</a>
            <a href="<?php echo BASE_URL; ?>consulta_de_horarios" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Horarios</a>
            <a href="<?php echo BASE_URL; ?>academia" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Becas</a>
          </div>
        </li>

        <!-- Mobile User Panel -->
        <li class="p-4 bg-[var(--color-navy-mid)]">
          <?php if ($isLoggedIn): ?>
            <div class="flex items-center gap-3 mb-3">
              <div class="flex items-center justify-center w-10 h-10 shrink-0 rounded-full bg-[var(--color-navy)] border border-white/20 text-white font-bold text-sm">
                <?php echo htmlspecialchars($userInitial); ?>
              </div>
              <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-white truncate"><?php echo htmlspecialchars($userName); ?></p>
                <p class="text-xs text-white/70 truncate"><?php echo htmlspecialchars($userEmail); ?></p>
                <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider rounded-full bg-[var(--color-green-pale)] text-[var(--color-green-lt)]">
                  <?php echo htmlspecialchars($userRoleName); ?>
                </span>
              </div>
            </div>
            <button type="button" onclick="logoutUser()" class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg text-sm font-semibold text-white bg-red-600/80 hover:bg-red-600 transition-colors cursor-pointer">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>
              Cerrar sesión
            </button>
          <?php else: ?>
            <div class="flex gap-2">
              <a href="<?php echo BASE_URL; ?>login" class="flex-1 text-center py-2.5 px-3 rounded-lg text-sm font-semibold text-white bg-white/10 hover:bg-white/20 transition-colors no-underline">Iniciar sesión</a>
              <a href="<?php echo BASE_URL; ?>register" class="flex-1 text-center py-2.5 px-3 rounded-lg text-sm font-semibold text-white bg-[var(--color-green)] hover:bg-[var(--color-green-lt)] transition-colors no-underline">Registrarse</a>
            </div>
          <?php endif; ?>
        </li>

      </ul>
    </div>

  </nav>