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
];

$is404 = !array_key_exists($page, $routes);

if (!$is404) {
    include 'components/navbar.php';
    include $routes[$page];
    include 'components/footer.php';
} else {
    include 'pages/404.php';
}