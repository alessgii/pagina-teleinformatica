<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("config/config.php");

$raw_page = $_GET['page'] ?? 'inicio';
$page = trim($raw_page, '/'); 

if (empty($page)) {
    $page = 'inicio';
}

$routes = [
    'inicio'               => 'pages/inicio.php',
    'consulta_de_horarios' => 'pages/consulta_horarios.php',
    'malla_curricular'     => 'pages/malla_curricular.php',
    'foro'                 => 'pages/foro.php',
    'galeria'              => 'pages/galeria.php',
    'noticias'             => 'pages/noticias.php',
    'academia'             => 'pages/academia.php',
    'showcase'             => 'pages/showcase.php',
    'login'                => 'pages/login.php',
    'register'             => 'pages/register.php',
];

$is404 = !array_key_exists($page, $routes);

$standalone_pages = ['login', 'register'];

if (!$is404) {
    if (in_array($page, $standalone_pages)) {
        include $routes[$page];
    } else {
        include 'components/navbar.php';
        include $routes[$page];
        include 'components/footer.php';
    }
} else {
    include 'pages/404.php';
}