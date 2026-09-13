<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teleinformatica</title>

  <link rel="shorcut icon" type="image/x-icon" href="public/img/favicon.ico">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/output.css">

</head>

<body>

  <!-- Regresamos a h-16 y quitamos el flex-wrap para forzar una sola línea -->
  <nav class="sticky top-0 z-50 flex items-center justify-between h-16 px-2 sm:px-10 bg-[var(--color-navy)] border-b border-[var(--color-border-main)] shadow-sm gap-1">
    
    <!-- Logo más pequeño en celular (w-24) y normal en PC (sm:w-36) -->
    <a href="index.php?page=inicio" class="flex items-center shrink-0">
      <img src="public/img/INTEL.png" class="w-24 sm:w-36 h-auto object-contain" alt="INTEL">
    </a>

    <!-- Lista alineada a la derecha, con márgenes mínimos en celular (gap-0.5) -->
    <ul class="flex items-center justify-end gap-0.5 sm:gap-1 ml-auto list-none nav-links">

      <li class="relative group nav-item" id="ni-inicio">
        <!-- Texto a 11px en celular, normal en PC. whitespace-nowrap evita que las palabras se partan -->
        <button class="flex items-center px-1.5 sm:px-3 py-2 text-[11px] sm:text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-inicio')">
          Inicio
        </button>
        <div class="absolute right-0 sm:left-0 sm:right-auto top-full pt-2 hidden group-hover:block w-48 z-50">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="index.php?page=noticias" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Noticias</a>
            <a href="index.php?page=galeria" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Galería</a>
            <a href="index.php?page=inicio" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Sobre Nosotros</a>
            <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Showcase de Proyectos</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-foro"> 
        <button class="flex items-center px-1.5 sm:px-3 py-2 text-[11px] sm:text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-foro')">
          Foro
        </button>
        <div class="absolute right-0 sm:left-0 sm:right-auto top-full pt-2 hidden group-hover:block w-48 z-50">
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
        <button class="flex items-center px-1.5 sm:px-3 py-2 text-[11px] sm:text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-blogs')">
          Blogs
        </button>
        <div class="absolute right-0 sm:left-0 sm:right-auto top-full pt-2 hidden group-hover:block w-48 z-50">
          <div class="flex flex-col p-2 bg-white border border-[var(--color-border-main)] rounded-xl shadow-lg dropdown">
            <a href="index.php?page=blogs&category=electronica" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Electrónica</a>
            <a href="index.php?page=blogs&category=sistemas" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Sistemas</a>
            <a href="index.php?page=blogs&category=programacion" class="flex items-center gap-2 px-3 py-2 text-sm text-[var(--color-text-mid)] rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors no-underline"><span class="w-1.5 h-1.5 rounded-full bg-[var(--color-green)] opacity-0 dot"></span>Programación</a>
          </div>
        </div>
      </li>

      <li class="relative group nav-item" id="ni-academia">
        <button class="flex items-center px-1.5 sm:px-3 py-2 text-[11px] sm:text-sm font-medium text-white bg-transparent border border-transparent rounded-lg hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors whitespace-nowrap nav-btn" onclick="toggleNav('ni-academia')">
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

    <!-- Ícono de usuario más pequeño en celular (w-8 h-8) -->
    <div class="relative ml-1 sm:ml-2 shrink-0 group nav-right"> 
      <button class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white border border-[var(--color-border-main)] text-[var(--color-text-muted)] hover:border-[var(--color-green)] hover:bg-[var(--color-green-pale)] hover:text-[var(--color-green)] transition-colors user-btn" onclick="toggleUser()" title="Mi cuenta">
        <svg width="16" height="16" class="sm:w-[18px] sm:h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
  </nav>

</body>
</html>