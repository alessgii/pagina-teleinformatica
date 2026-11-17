# Página institucional de la carrera de Teleinformática

Este proyecto es una aplicación web en PHP para la carrera de Teleinformática de la UDG CU Costa Sur. Su objetivo principal es ofrecer una presencia institucional dinámica con contenido académico, noticias, galería, horarios, login/registro, foro y mecanismos de retroalimentación UX.

La estructura del proyecto combina:

- PHP vanilla para la lógica servidor y enrutamiento
- HTML + CSS + JavaScript para la capa visual
- Tailwind para estilos
- MySQL como sistema de persistencia
- API REST interna para consumo por frontend

---

## Estado actual del proyecto

Este README refleja la estructura actual del repositorio y su funcionamiento real. El proyecto ya incluye:

- Enrutamiento central desde `index.php`
- Páginas principales bajo `pages/`
- Componentes reutilizables bajo `components/`
- API central bajo `public/api/index.php`
- Modelos y controladores bajo `src/`
- Base de datos MySQL con esquema en `database/intel-db.sql`
- Estilos generados con Tailwind

---

## Stack tecnológico

### Frontend
- PHP embebido en vistas
- HTML5
- CSS3
- JavaScript vanilla
- Tailwind CSS 4

### Backend
- PHP 8+
- MySQL / MariaDB
- PDO para acceso a bases de datos
- Sesiones PHP para autenticación

### Herramientas de desarrollo
- Node.js + npm
- `@tailwindcss/cli`
- Apache / XAMPP / LAMP

---

## Requisitos

### Requerimientos mínimos
- PHP 8.1 o superior
- MySQL 8.0 o MariaDB 10.x
- Apache con mod_rewrite o un virtual host funcional
- Node.js 18+ para Tailwind
- Git para control de versiones

### Requisitos de entorno local
Se recomienda usar la estructura de proyectos de Apache, por ejemplo:

```bash
C:\xampp\htdocs\pagina-teleinformatica
```

o en Linux/Mac:

```bash
/var/www/html/pagina-teleinformatica
```

El sitio se basa en la ruta base:

```php
define('BASE_URL', '/pagina-teleinformatica/');
```

Si se mueve a otra carpeta o dominio, debe actualizarse ese valor en `config/config.php`.

---

## Estructura del proyecto

```text
pagina-teleinformatica/
├── components/
│   ├── footer.php
│   ├── navbar.php
│   └── pagination.php
├── config/
│   ├── config.php
│   ├── config.php.example
│   ├── conn.php
│   └── conn.php.example
├── database/
│   └── intel-db.sql
├── pages/
│   ├── 404.php
│   ├── academia.php
│   ├── becas.php
│   ├── consulta_horarios.php
│   ├── feedback.php
│   ├── foro.php
│   ├── galeria.php
│   ├── inicio.php
│   ├── login.php
│   ├── malla_curricular.php
│   ├── noticias.php
│   ├── register.php
│   └── showcase.php
├── public/
│   ├── api/
│   │   ├── index.php
│   │   └── noticias/
│   │       ├── cambiar-estado.php
│   │       ├── crear.php
│   │       ├── editar.php
│   │       ├── eliminar.php
│   │       └── incrementar-vista.php
│   ├── css/
│   │   ├── fonts/
│   │   ├── pages/
│   │   └── tailwind/
│   ├── img/
│   └── js/
├── src/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── FeedbackController.php
│   │   ├── GalleryController.php
│   │   ├── NewsController.php
│   │   └── ScheduleController.php
│   ├── Middlewares/
│   │   └── AuthMiddleware.php
│   └── Models/
│       ├── Feedback.php
│       └── User.php
├── index.php
├── package.json
├── README.md
└── .gitignore
```

---

## Flujo de enrutamiento principal

La aplicación usa `index.php` como punto de entrada central. El archivo define una tabla de rutas y carga la vista correspondiente según el parámetro `page`:

```php
$raw_page = $_GET['page'] ?? 'inicio';
```

### Rutas principales

```php
$routes = [
    'inicio'               => 'pages/inicio.php',
    'consulta_de_horarios' => 'pages/consulta_horarios.php',
    'malla_curricular'     => 'pages/malla_curricular.php',
    'foro'                 => 'pages/foro.php',
    'galeria'              => 'pages/galeria.php',
    'noticias'             => 'pages/noticias.php',
    'academia'             => 'pages/academia.php',
    'becas'                => 'pages/becas.php',
    'blogs'                => 'pages/noticias.php',
    'showcase'             => 'pages/showcase.php',
    'login'                => 'pages/login.php',
    'register'             => 'pages/register.php',
    'feedback'             => 'pages/feedback.php',
];
```

### Comportamiento
- Las páginas regulares incluyen `navbar` y `footer` de forma centralizada.
- `login` y `register` se cargan como páginas autónomas.
- Si la ruta no existe, se muestra `pages/404.php`.

### Ejemplos de navegación

```text
http://localhost/pagina-teleinformatica/index.php?page=inicio
http://localhost/pagina-teleinformatica/index.php?page=noticias
http://localhost/pagina-teleinformatica/index.php?page=consulta_de_horarios
http://localhost/pagina-teleinformatica/index.php?page=login
```

---

## Configuración base

### `config/config.php`
Este archivo define la URL base del proyecto:

```php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/pagina-teleinformatica/');
}
```

Esto se usa para construir rutas absolutas de imágenes, CSS, JS y navegación sin romper al mover la aplicación.

### `config/conn.php`
Aquí se configura la conexión a MySQL usando PDO.

```php
$host     = 'localhost';
$db       = 'tu_db';
$user     = 'root';
$password = '';
```

---

## Base de datos

La estructura inicial del esquema se encuentra en:

- `database/intel-db.sql`

### Entidades principales
- `roles`
- `users`
- `careers`
- `semesters`
- `subjects`
- `student_groups`
- `teachers`
- `classrooms`
- `schedules`
- `posts`
- `comments`
- `categories`
- `news`
- `feedback`

---

## Autenticación y sesiones

La autenticación se implementa con sesiones PHP y `User` + `AuthController`.

### Modelo `User`
`src/Models/User.php`

Responsabilidades:
- buscar usuario por correo institucional
- crear usuarios nuevos

### Controlador `AuthController`
`src/Controllers/AuthController.php`

Responsabilidades:
- `login()`
- `register()`
- `logout()`

### Flujo de login
1. Se valida que lleguen email y contraseña.
2. Se busca el usuario por `institutional_email`.
3. Se verifica con `password_verify()`.
4. Si es correcto, se almacenan datos en sesión.
5. Se devuelve JSON con la respuesta del login.

### Middleware 
`src/Middlewares/AuthMiddleware.php`

Proporciona validación para:
- APIs protegidas (`requireApiAuth`)
- páginas web restringidas (`requirePageAuth`)

---

## API principal

La API central está en:

- `public/api/index.php`

Esta ruta recibe todas las peticiones al prefijo `/api` y despacha según el path solicitado.

### Endpoints implementados

#### Autenticación
- `POST /api/login`
- `POST /api/register`
- `GET|POST /api/logout`

#### Galería
- `GET /api/galeria`

#### Horarios
- `GET /api/horarios?semester=3&group=A`

#### Feedback UX
- `POST /api/feedback`

#### Noticias (acciones específicas)
- `public/api/noticias/crear.php`
- `public/api/noticias/editar.php`
- `public/api/noticias/eliminar.php`
- `public/api/noticias/cambiar-estado.php`
- `public/api/noticias/incrementar-vista.php`

### Patrón API actual
- Uso de `header('Content-Type: application/json; charset=utf-8');`
- Respuestas JSON con `success`, `message`, `data`
- Códigos HTTP estandarizados: 200, 201, 400, 401, 403, 404, 500

---

## Páginas y módulos del frontend

### `pages/`
Cada página corresponde a un módulo del sitio:

- `inicio.php` – landing institucional
- `noticias.php` – listado y gestión de noticias
- `galeria.php` – catálogo visual
- `malla_curricular.php` – plan de estudios
- `consulta_horarios.php` – vista de horarios escolares
- `academia.php` – información académica
- `becas.php` – becas y ayudas
- `foro.php` – comunidad / discusión
- `showcase.php` – proyectos estudiantiles
- `feedback.php` – encuesta UX
- `login.php` y `register.php` – acceso a usuarios
- `404.php` – error de ruta

### `components/`

- `navbar.php`: navegación global y menú móvil
- `footer.php`: pie de página global
- `pagination.php`: componente de paginación reutilizable

**Regla importante**: muchas vistas se montan con `index.php` y no deberían incluir etiquetas HTML completas (`html`, `head`, `body`) porque se integran dentro del layout global.

---

## Asset y estilos

### Tailwind
El proyecto usa Tailwind para el diseño visual. La compilación se realiza con:

```bash
npm install
npm run dev
```

El script definido en `package.json` es:

```json
"dev": "npx @tailwindcss/cli -i ./public/css/tailwind/input.css -o ./public/css/tailwind/output.css --watch"
```

### Carpetas de assets
- `public/css/pages/` – CSS específico por página
- `public/css/tailwind/` – entrada y salida de Tailwind
- `public/img/` – recursos visuales
- `public/js/` – scripts front-end por módulo

---

## Guía de instalación y ejecución local

### Opción 1: XAMPP / WAMP / LAMP
1. Clonar el repositorio dentro del directorio de proyectos web.
2. Iniciar Apache y MySQL.
3. Crear la base de datos y ejecutar el script SQL:

```bash
mysql -u root -p < database/intel-db.sql
```

4. Confirmar que la base de datos `intel` exista.
5. Ajustar la configuración de `config/config.php` y `config/conn.php`.
6. Abrir en navegador:

```text
http://localhost/pagina-teleinformatica/
```

### Opción 2: servidor Apache + virtual host

Ejemplo de vhost:

```apache
<VirtualHost *:80>
    ServerName pagina-teleinformatica.local
    DocumentRoot "/var/www/html/pagina-teleinformatica"
    <Directory "/var/www/html/pagina-teleinformatica">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Y agregar en hosts:

```text
127.0.0.1 pagina-teleinformatica.local
```

---

## Comandos útiles

### Instalar dependencias de Tailwind
```bash
npm install
```

### Ejecutar watcher de Tailwind
```bash
npm run dev
```

### Validar PHP sintáctico
```bash
php -l index.php
php -l config/config.php
php -l config/conn.php
```

### Revisar estructura de archivos importantes
```bash
find . -maxdepth 3 -type f | sort
```