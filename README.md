# Web de la Carrera - Estructura Base de Desarrollo

Este es el repositorio central con la arquitectura del proyecto unificada. Ya está todo automatizado con un sistema de rutas dinámicas en PHP para que **no tengan que preocuparse por pegar el Navbar ni el Footer** en cada página; el servidor lo hace solo.

---

## Cómo ejecutar el proyecto en tu computadora (Localhost)

Para poder ver los cambios de tus diseños en tiempo real junto con el Navbar y Footer globales, **es obligatorio correr el proyecto a través de Apache**. Si solo abres el archivo PHP arrastrándolo al navegador, no va a funcionar.

### Pasos para configurar en Windows (XAMPP):
1. **Descarga/Clona este repositorio** dentro de tu carpeta de proyectos de XAMPP (normalmente en `C:\xampp\htdocs\`).
2. Asegúrate de que la carpeta del proyecto tenga un nombre limpio en minúsculas (ejemplo: `web-carrera`).
3. Abre el **XAMPP Control Panel** y enciende el módulo de **Apache** (botón *Start*).
4. Abre tu navegador web e ingresa a: `http://localhost/nombre-de-tu-carpeta/` (ejemplo: `http://localhost/web-carrera/`).

*Nota: No se preocupen por configurar bases de datos ni MariaDB, la conexión está desactivada temporalmente para la fase de diseño estático. Les va a cargar a la primera.*

---

## 🛠️ Reglas estrictas para subir tu sección (Frontend)

Para evitar que tu código rompa el diseño global de la página, debes seguir estas 3 reglas de integración al crear tus archivos:

### 1. 📂 Organización de tus archivos
* Tu archivo de diseño va dentro de la carpeta `/pages/`.
* Tu archivo CSS va dentro de `/public/css/pages/`.
* Tus imágenes locales van dentro de `/public/img/[nombre_de_tu_seccion]/`.

### 2. Todo en MINÚSCULAS
El servidor final corre en Linux. **Está estrictamente prohibido usar mayúsculas o espacios** en los nombres de archivos, carpetas o extensiones.
* ❌ `Malla-Curricular.html` | `mi foto.JPG`
* `malla-curricular.php` | `mifoto.jpg`

### 3. Código Modular
Dado que el `index.php` principal ya envuelve tu página con el `<head>`, `<body>`, `Navbar` y `Footer` globales, **TU ARCHIVO NO DEBE LLEVAR ESTAS ETIQUETAS**.
* Tu archivo en `pages/` debe empezar directamente en tu etiqueta `<main>` o `<section>`.
* Si tu archivo tiene etiquetas `<html>`, `<head>` o `<body>`, se duplicarán en pantalla y romperán los estilos de los demás.

## 4. Enlazar estilos
De manera temporal, la primera linea de tu archivo HTML o PHP (usando solo HTML) debe ser el enlace al archivo CSS especifico de esa pagina. 

---

## 🔗 Cómo usar las imágenes y enlaces locales

Como ahora el sitio corre de forma centralizada, las rutas relativas normales (`../../img/`) se rompen. Para solucionarlo, en la raíz del proyecto existe la variable `BASE_URL`.

Cada vez que pongas una imagen o un enlace a otra página del sitio, debes poner la etiqueta de PHP al principio del `src` o `href`:

```html
<img src="<?php echo BASE_URL; ?>public/img/galeria/foto1.jpg" alt="Foto">

<a href="<?php echo BASE_URL; ?>index.php?page=contacto">Contacto</a>