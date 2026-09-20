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
    function logoutUser(e) {
      if (e) {
        e.preventDefault();
        e.stopPropagation();
      }
      window.location.href = <?php echo json_encode(BASE_URL . 'logout'); ?>;
    }
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
        <div class="absolute right-0 top-full pt-2 hidden group-hover:block z-50 user-dropdown-panel" id="user-dropdown-panel" style="width: 310px; min-width: 290px; max-width: calc(100vw - 20px);">
          <?php if ($isLoggedIn): ?>
            <!-- Estado: Sesión Iniciada -->
            <div class="bg-white border border-[#d5e2ef] rounded-2xl shadow-2xl overflow-hidden" id="user-dd" style="width: 100%; box-sizing: border-box; box-shadow: 0 10px 30px rgba(9, 64, 116, 0.12);">
              <!-- Cabecera con datos del usuario -->
              <div style="padding: 14px 16px; border-bottom: 1px solid #e8f0f9; background: linear-gradient(to bottom, #ffffff, #f9fafb); box-sizing: border-box;">
                <div style="display: flex; align-items: center; gap: 12px;">
                  <!-- Avatar redondo garantizado sin desbordes -->
                  <div style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 50%; background-color: #094074; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.05rem; flex-shrink: 0; box-shadow: 0 2px 6px rgba(9, 64, 116, 0.25);">
                    <?php echo htmlspecialchars($userInitial); ?>
                  </div>
                  <!-- Nombre, correo y rol con overflow controlado y sin wrap forzado -->
                  <div style="min-width: 0; flex: 1; overflow: hidden;">
                    <div style="font-weight: 700; font-size: 14px; color: #094074; line-height: 1.3; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo htmlspecialchars($userName); ?>">
                      <?php echo htmlspecialchars($userName); ?>
                    </div>
                    <div style="font-size: 12px; color: #7a94b0; margin-top: 2px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo htmlspecialchars($userEmail); ?>">
                      <?php echo htmlspecialchars($userEmail); ?>
                    </div>
                    <div style="margin-top: 6px;">
                      <span style="display: inline-block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 2px 9px; border-radius: 9999px; background-color: #e6f7f3; color: #2e9e02; border: 1px solid #c3edd9;">
                        <?php echo htmlspecialchars($userRoleName); ?>
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Enlaces rápidos -->
              <div style="padding: 6px 8px; display: flex; flex-direction: column; gap: 2px; box-sizing: border-box;">
                <a href="<?php echo BASE_URL; ?>inicio" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-[#3a567a] rounded-lg hover:bg-[#e6f7f3] hover:text-[#2e9e02] transition-colors no-underline" style="box-sizing: border-box;">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                  </svg>
                  <span>Inicio</span>
                </a>
                <a href="<?php echo BASE_URL; ?>foro" class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-[#3a567a] rounded-lg hover:bg-[#e6f7f3] hover:text-[#2e9e02] transition-colors no-underline" style="box-sizing: border-box;">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                  </svg>
                  <span>Comunidad & Foro</span>
                </a>
              </div>

              <!-- Botón de Cerrar Sesión con box-sizing para evitar desborde -->
              <div style="padding: 10px 14px; border-top: 1px solid #e8f0f9; background-color: #ffffff; box-sizing: border-box;">
                <a href="<?php echo BASE_URL; ?>logout" onclick="logoutUser(event)" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; box-sizing: border-box; padding: 9px 12px; border-radius: 10px; font-size: 13px; font-weight: 700; color: #dc2626; background-color: #fef2f2; border: 1px solid #fecaca; text-decoration: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#fee2e2'; this.style.color='#b91c1c';" onmouseout="this.style.backgroundColor='#fef2f2'; this.style.color='#dc2626';">
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
            <!-- Estado: No Autenticado / Invitado -->
            <div class="bg-white border border-[var(--color-border-main)] rounded-2xl p-4 shadow-xl" id="user-dd" style="width: 100%; box-sizing: border-box;">
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
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
              <div style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; border-radius: 50%; background-color: #094074; border: 1px solid rgba(255,255,255,0.2); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; flex-shrink: 0;">
                <?php echo htmlspecialchars($userInitial); ?>
              </div>
              <div style="min-width: 0; flex: 1; overflow: hidden;">
                <p style="font-size: 14px; font-weight: 600; color: #ffffff; margin: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo htmlspecialchars($userName); ?></p>
                <p style="font-size: 12px; color: rgba(255,255,255,0.7); margin: 2px 0 0 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo htmlspecialchars($userEmail); ?></p>
                <div style="margin-top: 4px;">
                  <span style="display: inline-block; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 2px 8px; border-radius: 9999px; background-color: rgba(255,255,255,0.15); color: #e6f7f3;">
                    <?php echo htmlspecialchars($userRoleName); ?>
                  </span>
                </div>
              </div>
            </div>
            <a href="<?php echo BASE_URL; ?>logout" onclick="logoutUser(event)" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 10px 16px; border-radius: 8px; font-size: 14px; font-weight: 600; color: #ffffff; background-color: rgba(220, 38, 38, 0.9); text-decoration: none; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#dc2626';" onmouseout="this.style.backgroundColor='rgba(220, 38, 38, 0.9)';">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>
              <span>Cerrar sesión</span>
            </a>
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