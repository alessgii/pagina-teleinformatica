<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ing. Teleinformática</title>

  <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.ico">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/tailwind/output.css">

</head>

<!-- m-0 p-0: elimina el margen de 8px que el navegador aplica por defecto al <body> -->
<body class="m-0 p-0 bg-[var(--color-bg-main)] ">

  <nav class="sticky top-0 z-50 flex items-center justify-between h-16 px-4 sm:px-10 bg-[var(--color-navy)] border-b border-[var(--color-border-main)] shadow-sm gap-1">

    <!-- Logo -->
    <a href="inicio" class="flex items-center shrink-0">
      <img src="public/img/INTEL.png" class="w-24 sm:w-36 h-auto object-contain" alt="INTEL">
    </a>

    <!-- ===== Menú de escritorio (oculto en celular) ===== -->
    <ul class="hidden md:flex items-center justify-end gap-1 my-0 ml-auto p-0 list-none nav-links">

      <li class="relative group nav-item" id="ni-inicio">
        <button class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-inicio')">
          Inicio
        </button>
        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-48 z-50">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="index.php?page=noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Noticias</a>
            <a href="index.php?page=galeria" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Galería</a>
            <a href="index.php?page=inicio" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Sobre Nosotros</a>
            <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Showcase de Proyectos</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-foro">
        <button class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-foro')">
          Foro
        </button>
        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-48 z-50">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="index.php?page=foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Electrónica</a>
            <a href="index.php?page=foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Sistemas</a>
            <a href="index.php?page=foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Programación</a>
            <a href="index.php?page=foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Redes</a>
            <a href="index.php?page=foro" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>General</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-blogs">
        <button class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-blogs')">
          Blogs
        </button>
        <div class="absolute left-0 top-full pt-2 hidden group-hover:block w-48 z-50">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="index.php?page=blogs&category=electronica" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Electrónica</a>
            <a href="index.php?page=blogs&category=sistemas" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Sistemas</a>
            <a href="index.php?page=blogs&category=programacion" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Programación</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-academia">
        <button class="flex items-center px-3 py-2 text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-academia')">
          Academia
        </button>
        <div class="absolute right-0 top-full pt-2 hidden group-hover:block w-48 z-50">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="index.php?page=malla_curricular" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Malla Curricular</a>
            <a href="index.php?page=consulta_de_horarios" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Horarios</a>
            <a href="index.php?page=becas" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Becas</a>
          </div>
        </div>
      </li>

    </ul>

    <!-- ===== Usuario + botón hamburguesa ===== -->
    <div class="flex items-center gap-2 ml-auto md:ml-2 shrink-0">

      <!-- Ícono de usuario -->
      <div class="relative shrink-0 group nav-right">
        <button class="flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white border border-[var(--color-border-main)] text-[var(--color-text-muted)] hover:border-[var(--color-green)] hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors user-btn" onclick="toggleUser()" title="Mi cuenta" aria-label="Mi cuenta">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="8" r="4" />
            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
          </svg>
        </button>
        <div class="absolute right-0 top-full pt-2 hidden group-hover:block w-60 z-50">
          <div class="bg-white border border-[var(--color-border-main)] rounded-xl p-3 shadow-lg user-dropdown" id="user-dd">
            <div class="text-center pb-3 mb-2 border-b border-[var(--color-border-lt)] user-no-found">
              <div class="flex items-center justify-center w-12 h-12 mx-auto mb-2 rounded-full bg-white border border-dashed border-[var(--color-border-main)] text-[var(--color-text-muted)] user-avatar-lg">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <circle cx="12" cy="8" r="4" />
                  <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
              </div>
              <strong class="block text-sm font-bold text-[var(--color-text-main)] mb-1">Usuario no encontrado</strong>
              <p class="text-xs text-[var(--color-text-muted)] mt-1">Inicia sesión para acceder a tu cuenta</p>
            </div>
            <div class="flex gap-2 py-1 auth-btns">
              <a href="#" class="flex-1 text-center py-2 px-1 rounded-lg text-[13px] font-semibold text-[var(--color-text-mid)] bg-white border border-[var(--color-border-main)] hover:border-[var(--color-green)] hover:text-[var(--color-green)] hover:bg-[var(--color-green-pale)] transition-colors btn-login">Iniciar sesión</a>
              <a href="#" class="flex-1 text-center py-2 px-1 rounded-lg text-[13px] font-semibold text-white bg-[var(--color-green)] hover:bg-[var(--color-green-lt)] transition-colors btn-register">Registrarse</a>
            </div>
            <a href="#" class="flex items-center gap-2 p-2 mt-1 border-t border-[var(--color-border-lt)] text-xs text-[var(--color-text-muted)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors support-link">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
              ⓘ Ayuda y Soporte
            </a>
          </div>
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
            <a href="index.php?page=noticias" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Noticias</a>
            <a href="index.php?page=galeria" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Galería</a>
            <a href="index.php?page=inicio" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Sobre Nosotros</a>
            <a href="#" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Showcase de Proyectos</a>
          </div>
        </li>

        <li class="border-b border-white/10">
          <button type="button" class="group flex w-full items-center justify-between px-5 py-4 text-left text-base font-medium text-white bg-transparent border-0 cursor-pointer hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors" data-accordion-btn aria-controls="mm-foro" aria-expanded="false">
            Foro
            <svg class="w-5 h-5 shrink-0 transition-transform group-aria-expanded:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div id="mm-foro" class="hidden pb-2 bg-[var(--color-navy-mid)]">
            <a href="index.php?page=foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Electrónica</a>
            <a href="index.php?page=foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Sistemas</a>
            <a href="index.php?page=foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Programación</a>
            <a href="index.php?page=foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Redes</a>
            <a href="index.php?page=foro" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">General</a>
          </div>
        </li>

        <li class="border-b border-white/10">
          <button type="button" class="group flex w-full items-center justify-between px-5 py-4 text-left text-base font-medium text-white bg-transparent border-0 cursor-pointer hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors" data-accordion-btn aria-controls="mm-blogs" aria-expanded="false">
            Blogs
            <svg class="w-5 h-5 shrink-0 transition-transform group-aria-expanded:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div id="mm-blogs" class="hidden pb-2 bg-[var(--color-navy-mid)]">
            <a href="index.php?page=blogs&category=electronica" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Electrónica</a>
            <a href="index.php?page=blogs&category=sistemas" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Sistemas</a>
            <a href="index.php?page=blogs&category=programacion" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Programación</a>
          </div>
        </li>

        <li>
          <button type="button" class="group flex w-full items-center justify-between px-5 py-4 text-left text-base font-medium text-white bg-transparent border-0 cursor-pointer hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors" data-accordion-btn aria-controls="mm-academia" aria-expanded="false">
            Academia
            <svg class="w-5 h-5 shrink-0 transition-transform group-aria-expanded:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div id="mm-academia" class="hidden pb-2 bg-[var(--color-navy-mid)]">
            <a href="index.php?page=malla_curricular" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Malla Curricular</a>
            <a href="index.php?page=consulta_de_horarios" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Horarios</a>
            <a href="index.php?page=becas" class="block px-8 py-3 text-sm text-white/80 no-underline hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors">Becas</a>
          </div>
        </li>

      </ul>
    </div>

  </nav>