<?php
require_once("config/config.php");
// conexion a la base de datos
// require_once("config/conn.php");

// Pendiente: mostrar error 404 en pagina personalizada.

include 'components/navbar.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'inicio';

switch ($page) {
    case 'inicio':
        include 'pages/inicio.php';
        break;
    case 'consulta-de-horarios':
        include 'pages/consulta_horarios.php';
        break;
    case 'malla-curricular':
        include 'pages/malla_curricular.php';
        break;
    case 'foro':
        include 'pages/foro.php';
        break;
    case 'galeria':
        include 'pages/galeria.php';
}


include 'components/footer.php';

?>