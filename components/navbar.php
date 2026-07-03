<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teleinformatica</title>

  <link rel="shorcut icon" type="image/x-icon" href="public/img/favicon.ico">
  <!-- <link rel="stylesheet" href="public/css/pages/navbar.css">
  <link rel="stylesheet" href="public/css/pages/global.css">
  <link rel="stylesheet" href="public/css/pages/footer.css"> -->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/global.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/footer.css">

</head>

<body>


  <nav>
    <a href="index.php?page=inicio" class="nav-logo">
      <img src="public/img/INTEL.png" class="nav-logo-img" alt="INTEL">
    </a>

    <ul class="nav-links">

      <li class="nav-item" id="ni-inicio">
        <button class="nav-btn" onclick="toggleNav('ni-inicio')">Inicio <span class="chev">▾</span></button>
        <div class="dropdown">
          <a href="#"><span class="dot"></span>Noticias</a>
          <a href="index.php?page=galeria"><span class="dot"></span>Galería</a>
          <a href="#"><span class="dot"></span>Sobre Nosotros</a>
          <a href="#"><span class="dot"></span>Showcase de Proyectos</a>
          <a href="#"><span class="dot"></span>Eventos</a>
        </div>
      </li>

      <li class="nav-item" id="ni-foro">
        <button class="nav-btn" onclick="toggleNav('ni-foro')">Foro <span class="chev">▾</span></button>
        <div class="dropdown">
          <a href="index.php?page=foro"><span class="dot"></span>Electrónica</a>
          <a href="index.php?page=foro"><span class="dot"></span>Sistemas</a>
          <a href="index.php?page=foro"><span class="dot"></span>Programación</a>
          <a href="index.php?page=foro"><span class="dot"></span>Redes</a>
          <a href="index.php?page=foro"><span class="dot"></span>General</a>
        </div>
      </li>

      <li class="nav-item" id="ni-blogs">
        <button class="nav-btn" onclick="toggleNav('ni-blogs')">Blogs <span class="chev">▾</span></button>
        <div class="dropdown">
          <a href="#"><span class="dot"></span>Electrónica</a>
          <a href="#"><span class="dot"></span>Sistemas</a>
          <a href="#"><span class="dot"></span>Programación</a>
        </div>
      </li>

      <li class="nav-item" id="ni-academia">
        <button class="nav-btn" onclick="toggleNav('ni-academia')">Academia <span class="chev">▾</span></button>
        <div class="dropdown">
          <a href="index.php?page=malla-curricular"><span class="dot"></span>Malla Curricular</a>
          <a href="index.php?page=consulta-de-horarios"><span class="dot"></span>Horarios</a>
          <a href="#"><span class="dot"></span>Becas</a>
        </div>
      </li>

    </ul>

    <div class="nav-right">
      <button class="user-btn" onclick="toggleUser()" title="Mi cuenta">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="8" r="4" />
          <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
        </svg>
      </button>
      <div class="user-dropdown" id="user-dd">
        <div class="user-no-found">
          <div class="user-avatar-lg">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <circle cx="12" cy="8" r="4" />
              <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
            </svg>
          </div>
          <strong>Usuario no encontrado</strong>
          <p>Inicia sesión para acceder a tu cuenta</p>
        </div>
        <div class="auth-btns">
          <a href="#" class="btn-login">Iniciar sesión</a>
          <a href="#" class="btn-register">Registrarse</a>
        </div>
        <a href="#" class="support-link">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"></svg>
          ⓘ Ayuda y Soporte
        </a>
      </div>
    </div>
  </nav>