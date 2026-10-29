<?php

$base = BASE_URL;

$icons = [
  'grid'     => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/>',
  'clock'    => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
  'award'    => '<circle cx="12" cy="8" r="6"/><path d="M15.48 12.89 17 22l-5-3-5 3 1.52-9.11"/>',
  'chat'     => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
  'software' => '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>',
  'wifi'     => '<path d="M5 12.55a11 11 0 0 1 14.08 0M1.42 9a16 16 0 0 1 21.16 0M8.53 16.11a6 6 0 0 1 6.95 0"/><circle cx="12" cy="20" r="1" fill="currentColor"/>',
  'db'       => '<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>',
  'wrench'   => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>',
  'cpu'      => '<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><path d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"/>',
  'shield'   => '<path d="M12 22s8-4.5 8-11V5l-8-3-8 3v6c0 6.5 8 11 8 11z"/>',
  'building' => '<path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/>',
  'briefcase'=> '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>',
  'target'   => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
  'eye'      => '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>',
  'check'    => '<path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>',
  'x'        => '<path d="M18 6 6 18M6 6l12 12"/>',
  'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
];

if (!function_exists('ico')) {
  function ico(string $name, string $cls = 'w-5 h-5'): string {
    global $icons;
    return '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="2" '
         . 'stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">'
         . ($icons[$name] ?? '') . '</svg>';
  }
}

/* Accesos rápidos del hero */
$tools = [
  ['malla_curricular',      'grid',  'Malla curricular',  'Tu plan de estudios'],
  ['consulta_de_horarios',  'clock', 'Consultar horario', 'Clases y grupos'],
  ['becas',                 'award', 'Becas',             'Apoyos disponibles'],
  ['foro',                  'chat',  'Foro',              'Pregunta y comparte'],
];

/* Perfil de egreso */
$perfil = [
  ['software', 'Desarrollo de software',  'Aplicaciones de escritorio, móviles y web en distintos lenguajes de programación.'],
  ['wifi',     'Redes de cómputo',        'Diseño, configuración y administración de redes y equipos de comunicación.'],
  ['db',       'Sistemas de información', 'Diseño y administración de plataformas para el manejo de información a distancia.'],
  ['wrench',   'Mantenimiento técnico',   'Mantenimiento preventivo y correctivo de equipos de cómputo y comunicación.'],
];

/* Campo laboral */
$campo = [
  ['wifi',      'Telecomunicaciones',        'Creación y mantenimiento de redes inalámbricas y administración de redes de comunicación de datos.'],
  ['software',  'Desarrollo de software',    'Herramientas de software para distintos fines, desde aplicaciones móviles hasta sistemas de información.'],
  ['cpu',       'Industria y automatización','Redes industriales, control y monitoreo de procesos productivos.'],
  ['db',        'Centros de datos',          'Infraestructura de red, servidores y administración de sistemas de datos a gran escala.'],
  ['shield',    'Ciberseguridad',            'Protección de redes e información, y cumplimiento de la normativa digital.'],
  ['chat',      'Consultoría en TI',         'Asesoría tecnológica independiente para negocios y organismos.'],
  ['building',  'Sector público',            'Instituciones y dependencias que operan o necesitan infraestructura tecnológica.'],
  ['briefcase', 'Emprendimiento y freelance','Proyectos propios, desde el trabajo independiente hasta soluciones de amplia cobertura.'],
];

/* Noticias (las clases de color van completas para que Tailwind las detecte) */
$noticias = [
  [
    'img' => 'ganminisumo.jpeg', 'alt' => 'Robot ganador del torneo de minisumo',
    'tag' => 'Competencias', 'tagClass' => 'bg-green-pale text-navy border-green/40',
    'title' => 'Se gana el torneo de minisumo',
    'text' => 'Estudiantes del programa se llevan el primer lugar con un robot diseñado y programado íntegramente en los laboratorios del centro universitario.',
  ],
  [
    'img' => 'ingenierias.jpeg', 'alt' => 'Colaboración entre ingenierías',
    'tag' => 'Vinculación', 'tagClass' => 'bg-purple-100 text-purple-700 border-purple-200',
    'title' => 'INTEL y Mecatrónica juntos',
    'text' => 'Proyecto conjunto entre ambas ingenierías para integrar redes de sensores en sistemas automatizados.',
  ],
  [
    'img' => 'fechas_Calif.jpeg', 'alt' => 'Calendario de fechas de calificación',
    'tag' => 'Aviso escolar', 'tagClass' => 'bg-turq-pale text-navy border-turq-acc/30',
    'title' => 'Periodo ordinario y extraordinario',
    'text' => 'Ya están publicadas las fechas de calificación del ciclo. Consulta el calendario para no perder ningún trámite.',
  ],
];
?>

<!-- ============================ HERO ============================ -->
<section id="hero" class="relative bg-bg-main overflow-x-clip">
  <!-- Fondo decorativo suave -->
  <div class="pointer-events-none absolute -top-24 -right-24 w-72 h-72 sm:w-96 sm:h-96 rounded-full bg-turq-pale blur-3xl opacity-80" aria-hidden="true"></div>

  <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-5 pb-10 md:pt-14 md:pb-20 grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 items-center">

    <div class="flex flex-col">
      <p class="inline-flex items-center gap-2 self-start rounded-full bg-bg-card border border-border-main px-3 py-1 text-xs font-semibold text-navy shadow-sm">
        <span class="w-2 h-2 rounded-full bg-green" aria-hidden="true"></span>
        CUCSur · Universidad de Guadalajara
      </p>

      <h1 class="mt-3 text-[1.9rem] leading-[1.15] sm:text-4xl lg:text-5xl font-bold text-navy tracking-tight">
        Diseña las redes que
        <span class="text-green">conectan</span>
        al mundo
      </h1>

      <p class="mt-3 text-[0.95rem] sm:text-lg text-text-mid leading-relaxed">
        Ingeniería en Teleinformática: aprende a diseñar, implementar y administrar redes de cómputo,
        sistemas de información y plataformas de comunicación de vanguardia.
      </p>

      <div class="mt-5 flex flex-col gap-5 w-full">
        <!-- Herramientas: lo primero que se ve -->
        <div>
          <p class="mb-2 text-xs font-bold uppercase tracking-wider text-text-mid">Herramientas para estudiantes</p>
          <nav aria-label="Herramientas para estudiantes" class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-4 w-full">
            <?php foreach ($tools as [$route, $icon, $label, $hint]): ?>
              <a href="<?= $base . $route ?>"
                class="group flex items-center gap-3 sm:flex-col sm:justify-center sm:text-center p-3 sm:p-4 rounded-2xl border border-border-main bg-bg-card text-navy no-underline shadow-sm transition-all duration-300 hover:bg-turq-pale hover:shadow-md hover:-translate-y-0.5 active:scale-[0.98] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-turq-acc box-border">
                <span class="w-10 h-10 shrink-0 rounded-full bg-turq-pale group-hover:bg-white text-navy flex items-center justify-center transition-colors">
                  <?= ico($icon, 'w-5 h-5') ?>
                </span>
                <span class="min-w-0">
                  <span class="block text-[13px] sm:text-sm font-bold leading-tight"><?= $label ?></span>
                  <span class="block mt-0.5 text-[11px] sm:text-xs leading-tight text-text-mid"><?= $hint ?></span>
                </span>
              </a>
            <?php endforeach; ?>
          </nav>
        </div>

        <a href="https://escolar.udg.mx/" target="_blank" rel="noopener noreferrer"
          class="w-full sm:w-auto sm:self-start inline-flex items-center justify-center gap-2 px-7 py-3.5 text-base font-bold rounded-custom text-white bg-green hover:bg-green-lt no-underline shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:scale-[0.98] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-navy box-border">
          Inscribirse
          <?= ico('arrow', 'w-5 h-5') ?>
        </a>
      </div>
    </div>

    <figure class="relative w-full m-0">
      <img src="<?= $base ?>public/img/inicio/Antena.webp"
        alt="Estudiantes de Ingeniería en Teleinformática instalando una antena"
        fetchpriority="high" decoding="async"
        class="w-full h-auto object-cover aspect-[16/10] sm:aspect-4/3 rounded-2xl shadow-lg">
      <figcaption class="absolute bottom-3 left-3 right-3 sm:right-auto inline-flex items-center gap-2 rounded-xl bg-navy-mid/85 backdrop-blur-sm px-3 py-2 text-xs text-white">
        <?= ico('wifi', 'w-4 h-4 shrink-0') ?>
        Aprende construyendo redes reales
      </figcaption>
    </figure>
  </div>
</section>

<!-- ======================== POR QUÉ INTEL ======================== -->
<section id="carrera" class="py-12 sm:py-16 bg-bg-card reveal">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">¿Por qué estudiar Ingeniería en Teleinformática?</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
      <div class="text-text-mid leading-relaxed space-y-4">
        <p>
          Cada día dependemos más de las redes y los sistemas digitales, y alguien tiene que diseñarlos,
          mantenerlos y protegerlos. Por eso crece la demanda de profesionales de TI en áreas como
          redes, desarrollo de software y ciberseguridad.
        </p>
        <p>
          <strong class="text-text-main font-semibold">Un ingeniero en Teleinformática</strong> tiene el perfil
          para ese reto: diseña, implementa y administra redes de cómputo, sistemas de información y
          plataformas de comunicación de vanguardia.
        </p>
        <ul class="grid grid-cols-3 gap-2 sm:gap-3 pt-2 list-none p-0 m-0" aria-label="Áreas de especialidad">
          <?php foreach ([['wifi', 'Redes'], ['software', 'Software'], ['shield', 'Ciberseguridad']] as [$ic, $chip]): ?>
            <li class="flex flex-col items-center justify-center gap-2 rounded-2xl bg-turq-pale text-navy px-1 py-3 sm:py-4 text-center">
              <span class="w-9 h-9 rounded-full bg-white flex items-center justify-center"><?= ico($ic, 'w-5 h-5') ?></span>
              <span class="text-[11px] sm:text-sm font-semibold leading-tight"><?= $chip ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <img src="<?= $base ?>public/img/inicio/carrera.jpeg" alt="Estudiantes de Ingeniería en Teleinformática"
        loading="lazy" decoding="async"
        class="w-full h-56 sm:h-80 object-cover rounded-2xl shadow-custom">
    </div>
  </div>
</section>

<!-- ======================== GALERÍA ======================== -->
<section id="galeria" class="py-12 sm:py-16 bg-bg-main">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">Así se vive la carrera</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">
        Laboratorios, proyectos, torneos y trabajo en equipo dentro y fuera del aula.
      </p>
    </div>

    <?php
      $galeria = [
        ['inicio/alumnosintel.jpeg',          'Comunidad INTEL',        'Comunidad INTEL'],
        ['galeria/img1.jpeg',                 'Laboratorio',            'Laboratorio'],
        ['galeria/img3.jpeg',                 'Proyecto de robótica',   'Robótica'],
        ['inicio/tallermantenimiento.jpeg',   'Taller de mantenimiento','Taller'],
        ['galeria/img5.jpeg',                 'Trabajo en equipo',      'Programación'],
      ];
    ?>
    <!-- Móvil: 2 columnas, la primera foto a todo el ancho -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6">
      <?php foreach ($galeria as $i => [$src, $alt, $label]): ?>
        <figure class="relative m-0 rounded-custom overflow-hidden group shadow-custom <?= $i === 0 ? 'col-span-2 h-56 sm:h-72 md:h-auto md:row-span-2' : 'h-36 sm:h-48' ?>">
          <img src="<?= $base ?>public/img/<?= $src ?>" alt="<?= $alt ?>" loading="lazy" decoding="async"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
          <figcaption class="absolute bottom-2 left-2 sm:bottom-3 sm:left-3 bg-navy-mid/80 text-white text-xs px-3 py-1 rounded-full backdrop-blur-sm"><?= $label ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>

    <div class="mt-8 sm:mt-12 text-center">
      <a href="<?= $base ?>galeria"
        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 text-base font-semibold rounded-custom text-white bg-green hover:bg-green-lt no-underline shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 box-border">
        Ver la galería completa
        <?= ico('arrow', 'w-4 h-4') ?>
      </a>
    </div>
  </div>
</section>

<!-- ======================== PERFIL DE EGRESO ======================== -->
<section id="perfil" class="py-12 sm:py-16 bg-bg-card">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">Perfil de egreso</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">Al terminar la carrera serás capaz de diseñar y administrar:</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
      <?php foreach ($perfil as [$icon, $title, $text]): ?>
        <article class="flex sm:block gap-4 p-4 sm:p-6 bg-bg-main rounded-custom border border-border-lt shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 box-border">
          <div class="w-12 h-12 shrink-0 rounded-full bg-turq-pale text-navy flex items-center justify-center sm:mb-5">
            <?= ico($icon, 'w-6 h-6') ?>
          </div>
          <div>
            <h3 class="text-sm sm:text-base font-bold text-navy mb-1"><?= $title ?></h3>
            <p class="text-sm text-text-mid leading-relaxed"><?= $text ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ======================== NOTICIAS ======================== -->
<section id="noticias" class="py-12 sm:py-16 bg-bg-main">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">Noticias de la carrera</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">
        Descubre todo lo nuevo e interesante que sucede en el programa y su plantel.
      </p>
    </div>

    <!-- Móvil: carrusel con snap. md+: cuadrícula de 3 -->
    <div class="no-scrollbar -mx-4 px-4 sm:mx-0 sm:px-0 flex md:grid md:grid-cols-3 gap-4 sm:gap-8 overflow-x-auto md:overflow-visible snap-x snap-mandatory pb-3 md:pb-0">
      <?php foreach ($noticias as $n): ?>
        <a href="<?= $base ?>noticias"
          class="snap-start shrink-0 w-[82%] sm:w-[60%] md:w-auto bg-bg-card border border-border-main rounded-custom overflow-hidden shadow-custom flex flex-col no-underline transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-turq-acc">
          <img src="<?= $base ?>public/img/inicio/<?= $n['img'] ?>" alt="<?= $n['alt'] ?>" loading="lazy" decoding="async"
            class="w-full h-40 sm:h-48 object-cover shrink-0">
          <div class="p-5 flex flex-col gap-2">
            <span class="self-start text-xs font-semibold border py-1 px-2.5 rounded-full <?= $n['tagClass'] ?>"><?= $n['tag'] ?></span>
            <h3 class="text-base sm:text-lg font-bold text-navy"><?= $n['title'] ?></h3>
            <p class="text-sm text-text-mid leading-relaxed"><?= $n['text'] ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <div class="mt-8 sm:mt-12 text-center">
      <a href="<?= $base ?>noticias"
        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 text-base font-semibold rounded-custom text-white bg-green hover:bg-green-lt no-underline shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 box-border">
        Ver más noticias
        <?= ico('arrow', 'w-4 h-4') ?>
      </a>
    </div>
  </div>
</section>

<!-- ======================== CAMPO LABORAL ======================== -->
<section id="campo-laboral" class="py-12 sm:py-16 bg-bg-card">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">Campo laboral</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">
        Un ingeniero en Teleinformática resuelve problemas tecnológicos concretos. Estos son algunos de los
        sectores donde puede ejercer.
      </p>
    </div>

    <!-- 2 columnas compactas en móvil para no alargar la página -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
      <?php foreach ($campo as [$icon, $title, $text]): ?>
        <article class="p-4 sm:p-6 bg-bg-main rounded-custom border border-border-lt shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 box-border">
          <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-turq-pale text-navy flex items-center justify-center mb-3 sm:mb-5">
            <?= ico($icon, 'w-5 h-5 sm:w-6 sm:h-6') ?>
          </div>
          <h3 class="text-[13px] sm:text-base font-bold text-navy mb-1 leading-snug"><?= $title ?></h3>
          <p class="text-xs sm:text-sm text-text-mid leading-relaxed"><?= $text ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================= MISIÓN, VISIÓN Y OBJETIVOS ================= -->
<section id="mision-vision" class="py-12 sm:py-16 bg-bg-main">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
      <h2 class="text-2xl sm:text-3xl font-bold text-navy">Misión, visión y objetivos</h2>
      <p class="mt-2 text-sm sm:text-base text-text-muted">
        Lo que buscamos para que tu formación sea de alta calidad y te lleve a donde quieres llegar.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-8">
      <button type="button" data-mv-open="contenido-mision-vision" aria-haspopup="dialog"
        class="group w-full text-left flex items-center gap-4 p-5 sm:p-8 sm:block bg-bg-card rounded-custom border border-border-lt shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:scale-[0.99] cursor-pointer box-border focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-turq-acc">
        <span class="flex items-center gap-2 sm:mb-6 shrink-0">
          <span class="w-12 h-12 rounded-full bg-turq-pale text-navy flex items-center justify-center"><?= ico('target', 'w-6 h-6') ?></span>
          <span class="hidden sm:flex w-12 h-12 rounded-full bg-green-pale text-navy items-center justify-center"><?= ico('eye', 'w-6 h-6') ?></span>
        </span>
        <span class="block min-w-0">
          <span class="block text-lg sm:text-xl font-bold text-navy mb-1 group-hover:text-sky-700 transition-colors">Misión y visión</span>
          <span class="block text-sm text-text-mid mb-2">El compromiso del programa y hacia dónde quiere llegar.</span>
          <span class="inline-flex items-center gap-1 text-sm font-semibold text-navy">Leer <?= ico('arrow', 'w-4 h-4') ?></span>
        </span>
      </button>

      <button type="button" data-mv-open="contenido-objetivos" aria-haspopup="dialog"
        class="group w-full text-left flex items-center gap-4 p-5 sm:p-8 sm:block bg-bg-card rounded-custom border border-border-lt shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:scale-[0.99] cursor-pointer box-border focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-turq-acc">
        <span class="flex items-center gap-2 sm:mb-6 shrink-0">
          <span class="w-12 h-12 rounded-full bg-turq-pale text-navy flex items-center justify-center"><?= ico('check', 'w-6 h-6') ?></span>
        </span>
        <span class="block min-w-0">
          <span class="block text-lg sm:text-xl font-bold text-navy mb-1 group-hover:text-sky-700 transition-colors">Objetivos educacionales</span>
          <span class="block text-sm text-text-mid mb-2">Las metas que garantizan la calidad de tu formación (OE1 a OE4).</span>
          <span class="inline-flex items-center gap-1 text-sm font-semibold text-navy">Leer <?= ico('arrow', 'w-4 h-4') ?></span>
        </span>
      </button>
    </div>
  </div>
</section>

<!-- ================= CTA FINAL ================= -->
<section class="py-12 sm:py-16 bg-navy-mid">
  <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-2xl sm:text-3xl font-bold text-white">¿Listo para diseñar las redes del futuro?</h2>
    <p class="mt-3 text-sm sm:text-base text-white/75">Revisa el plan de estudios o da el primer paso e inscríbete.</p>
    <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
      <a href="https://escolar.udg.mx/" target="_blank" rel="noopener noreferrer"
        class="inline-flex items-center justify-center gap-2 px-7 py-3.5 text-base font-bold rounded-custom bg-green text-navy-mid no-underline shadow-md transition-all duration-300 hover:bg-green-lt hover:-translate-y-0.5">
        Inscribirse <?= ico('arrow', 'w-5 h-5') ?>
      </a>
      <a href="<?= $base ?>malla_curricular"
        class="inline-flex items-center justify-center px-7 py-3.5 text-base font-semibold rounded-custom border border-white/40 text-white no-underline transition-all duration-300 hover:bg-white/10">
        Ver malla curricular
      </a>
    </div>
  </div>
</section>

<!-- ================= VISOR (dialog nativo) =================
     Móvil: hoja que sube desde abajo casi a pantalla completa.
     md+: diálogo centrado. Foco, Esc y fondo inerte los maneja el navegador. -->
<dialog id="mv-dialog" class="mv-dialog" aria-labelledby="mv-title">
  <div class="mv-panel bg-bg-card">

    <header class="shrink-0 bg-navy-mid text-white px-4 pt-4 pb-3 sm:px-8 sm:pt-6 sm:pb-4">
      <div class="flex items-start justify-between gap-3">
        <div class="min-w-0">
          <p class="text-[11px] uppercase tracking-wider text-white/60">Ingeniería en Teleinformática</p>
          <h2 id="mv-title" class="mt-0.5 text-xl sm:text-2xl font-bold leading-snug"></h2>
          <p id="mv-subtitle" class="hidden sm:block mt-1 text-sm text-white/70"></p>
        </div>
        <button type="button" data-mv-close aria-label="Cerrar"
          class="shrink-0 w-11 h-11 -mt-1 -mr-1 rounded-full flex items-center justify-center text-white hover:bg-white/15 transition-colors cursor-pointer focus-visible:outline-2 focus-visible:outline-white">
          <?= ico('x', 'w-6 h-6') ?>
        </button>
      </div>

      <div role="tablist" aria-label="Contenido del programa" class="mt-4 grid grid-cols-2 gap-1 p-1 rounded-xl bg-white/10">
        <button type="button" role="tab" id="tab-contenido-mision-vision" data-mv-tab="contenido-mision-vision" aria-controls="contenido-mision-vision"
          class="min-h-11 rounded-lg px-2 text-sm font-semibold text-white/80 transition-colors cursor-pointer aria-selected:bg-white aria-selected:text-navy">
          Misión y visión
        </button>
        <button type="button" role="tab" id="tab-contenido-objetivos" data-mv-tab="contenido-objetivos" aria-controls="contenido-objetivos"
          class="min-h-11 rounded-lg px-2 text-sm font-semibold text-white/80 transition-colors cursor-pointer aria-selected:bg-white aria-selected:text-navy">
          Objetivos
        </button>
      </div>
    </header>

    <div id="mv-body" class="mv-body p-4 sm:p-8">

      <!-- Misión y visión -->
      <div id="contenido-mision-vision" role="tabpanel" aria-labelledby="tab-contenido-mision-vision" tabindex="0" hidden
        data-bloque data-title="Misión y visión" data-subtitle="Lo que busca el programa y hacia dónde quiere llegar">
        <div class="grid gap-4 md:grid-cols-2">
          <section class="rounded-2xl border border-border-lt border-l-4 border-l-turq-acc bg-bg-main p-5">
            <div class="flex items-center gap-3 mb-3">
              <span class="w-10 h-10 rounded-full bg-turq-pale text-navy flex items-center justify-center"><?= ico('target', 'w-5 h-5') ?></span>
              <h3 class="text-lg font-bold text-navy">Misión</h3>
            </div>
            <p class="text-base leading-7 text-text-mid">
              El programa educativo tiene el compromiso social de formar Ingenieros en Teleinformática
              para aplicar conocimientos científicos y tecnológicos bajo estándares de calidad, con
              responsabilidad y pertinencia cultural, social y ambiental en beneficio de la prosperidad colectiva.
            </p>
          </section>
          <section class="rounded-2xl border border-border-lt border-l-4 border-l-green bg-bg-main p-5">
            <div class="flex items-center gap-3 mb-3">
              <span class="w-10 h-10 rounded-full bg-green-pale text-navy flex items-center justify-center"><?= ico('eye', 'w-5 h-5') ?></span>
              <h3 class="text-lg font-bold text-navy">Visión</h3>
            </div>
            <p class="text-base leading-7 text-text-mid">
              Ser la mejor opción de estudios en la región y del estado de Jalisco en el mediano y largo plazo,
              formando profesionistas líderes y competentes en el uso y administración de las tecnologías de
              redes y sistemas de información mediante el uso de tecnología de vanguardia.
            </p>
          </section>
        </div>
      </div>

      <!-- Objetivos -->
      <div id="contenido-objetivos" role="tabpanel" aria-labelledby="tab-contenido-objetivos" tabindex="0" hidden
        data-bloque data-title="Objetivos educacionales" data-subtitle="Lo que se espera de los egresados en su desarrollo profesional">
        <ol class="grid gap-3 sm:grid-cols-2 list-none p-0 m-0">
          <?php
            $oes = [
              'Los egresados participan en el diseño, gestión y/o evaluación de proyectos de ingeniería para desarrollo de software o de infraestructura y servicios de telecomunicaciones en los sectores público y privado.',
              'Los egresados se integran en grupos multidisciplinarios en las organizaciones del sector público o privado con ética y responsabilidad social.',
              'Los egresados se incorporan al sector productivo y/o de servicios o son capaces de crear su propia empresa relacionada con la Ingeniería en Teleinformática.',
              'Los egresados mantienen un permanente interés en el desarrollo y mejoramiento de sus competencias profesionales a través de cursos, diplomados o posgrados.',
            ];
          ?>
          <?php foreach ($oes as $i => $oe): ?>
            <li class="flex gap-4 rounded-2xl border border-border-lt bg-bg-main p-4 sm:p-5">
              <span class="shrink-0 w-11 h-11 rounded-xl bg-navy text-white text-sm font-bold flex items-center justify-center">OE<?= $i + 1 ?></span>
              <p class="text-base leading-7 text-text-mid"><?= $oe ?></p>
            </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </div>

    <!-- Solo móvil: botón de cierre al alcance del pulgar -->
    <footer class="sm:hidden shrink-0 border-t border-border-main bg-bg-card p-3 pb-[max(0.75rem,env(safe-area-inset-bottom))]">
      <button type="button" data-mv-close
        class="w-full min-h-12 rounded-custom bg-navy text-white font-semibold cursor-pointer active:scale-[0.99] transition-transform">
        Cerrar
      </button>
    </footer>
  </div>
</dialog>

<script src="<?= $base ?>public/js/inicio.js" defer></script>