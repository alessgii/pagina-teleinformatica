<?php
// src/Controllers/NewsController.php
date_default_timezone_set('America/Mexico_City');

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/conn.php';

$isAdmin = ($userRoleId !== null && in_array((int)$userRoleId, [1, 2])); // Lógica de sesión para administrador

// Paginación
$noticiasPorPagina = 6;
$paginaActual = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
$offset = ($paginaActual - 1) * $noticiasPorPagina;

function tiempoTranscurrido($fecha) {
    if (empty($fecha)) return "Reciente";
    $timestamp = strtotime($fecha);
    $diferencia = time() - $timestamp;

    if ($diferencia < 60) return "Hace un momento";
    $minutos = round($diferencia / 60);
    if ($minutos < 60) return "Hace $minutos min";
    $horas = round($diferencia / 3600);
    if ($horas < 24) return "Hace $horas hr" . ($horas > 1 ? "s" : "");
    $dias = round($diferencia / 86400);
    if ($dias < 7) return "Hace $dias día" . ($dias > 1 ? "s" : "");
    $semanas = round($diferencia / 604800);
    if ($semanas < 4) return "Hace $semanas sem" . ($semanas > 1 ? "s" : "");
    $meses = round($diferencia / 2419200);
    if ($meses < 12) return "Hace $meses mes" . ($meses > 1 ? "es" : "");
    
    return "Hace " . round($diferencia / 31536000) . " año(s)";
}

function formatearVistas($vistas) {
    $vistas = intval($vistas);
    if ($vistas >= 1000000) {
        return number_format($vistas / 1000000, 1) . 'M';
    } elseif ($vistas >= 1000) {
        return number_format($vistas / 1000, 1) . 'k';
    }
    return $vistas;
}

$orden = $_GET['orden'] ?? 'recientes';
$estadoFiltro = $_GET['estado'] ?? 'publicado';

// Asegurar que usuarios no administradores solo vean 'publicado'
if (!$isAdmin) {
    $estadoFiltro = 'publicado';
}

$orderBy = ($orden === 'relevantes') ? 'n.views DESC' : 'n.publication_date DESC';

$noticias = [];
$totalNoticias = 0;
$totalPaginas = 1;

if (isset($pdo) && $pdo instanceof PDO) {
    try {
        // Conteo total filtrado por el estado
        $sqlTotal = "SELECT COUNT(*) FROM news WHERE status = :status";
        $stmtTotal = $pdo->prepare($sqlTotal);
        $stmtTotal->execute([':status' => $estadoFiltro]);
        $totalNoticias = $stmtTotal->fetchColumn();
        $totalPaginas = max(1, ceil($totalNoticias / $noticiasPorPagina));

        // Consulta de noticias
        $sql = "SELECT n.*, c.category_name 
                FROM news n 
                LEFT JOIN categories c ON n.category_id = c.category_id 
                WHERE n.status = :status
                ORDER BY $orderBy 
                LIMIT :limit OFFSET :offset";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':status', $estadoFiltro, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $noticiasPorPagina, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $noticias = $stmt->fetchAll();
    } catch (PDOException $e) {
        $noticias = [];
    }
}

$categorias = [];
if (isset($pdo) && $pdo instanceof PDO) {
    try {
        $stmtCat = $pdo->query("SELECT * FROM categories ORDER BY category_name ASC");
        $categorias = $stmtCat->fetchAll();
    } catch (PDOException $e) {
        $categorias = [];
    }
}