<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("config/config.php");

$page = isset($_GET['page']) ? $_GET['page'] : 'inicio';

$valid_pages = [
    'inicio',
    'consulta_de_horarios',
    'malla_curricular',
    'foro',
    'galeria'
];

$is404 = !in_array($page, $valid_pages);

if (!$is404) {
    include 'components/navbar.php';
}

switch ($page) {

    case 'inicio':
        include 'pages/inicio.php';
        break;

    case 'consulta_de_horarios':
        include 'pages/consulta_horarios.php';
        break;

    case 'malla_curricular':
        include 'pages/malla_curricular.php';
        break;

    case 'foro':
        include 'pages/foro.php';
        break;

    case 'galeria':
        include 'pages/galeria.php';
        break;

    default:
        include 'pages/404.php';
        break;
}

if (!$is404) {
    include 'components/footer.php';
}
?>