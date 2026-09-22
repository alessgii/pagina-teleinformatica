<?php

class GalleryController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * GET /api/galeria
     * Devuelve las categorías y fotos de la galería en formato JSON.
     */
    public function getGaleria(): void
    {
        header('Access-Control-Allow-Origin: *');

        try {
            // 1. Obtener categorías reales de la base de datos
            $catStmt = $this->pdo->query("SELECT slug AS id, label FROM gallery_categories ORDER BY category_id ASC");
            $dbCategories = $catStmt->fetchAll(PDO::FETCH_ASSOC);

            // 2. Obtener fotos registradas unidas con su categoría
            $sql = "
               SELECT 
                 p.photo_id,
                 p.src,
                 p.title,
                 p.description AS `desc`,
                 c.slug AS category_slug
            FROM gallery_photos p
            INNER JOIN gallery_categories c ON p.category_id = c.category_id
            ORDER BY p.uploaded_at DESC, p.photo_id DESC
            ";

            $photoStmt = $this->pdo->query($sql);
            $rawPhotos = $photoStmt->fetchAll(PDO::FETCH_ASSOC);

            // Formatear arreglo para el JS
            $photos = array_map(function ($row) {
                return [
                    'src'   => $row['src'],
                    'title' => $row['title'],
                    'desc'  => $row['desc'] ?? '',
                    'cats'  => [$row['category_slug']]
                ];
            }, $rawPhotos);

            // Responder JSON agregando 'Todos' al inicio
            echo json_encode([
                'success'    => true,
                'categories' => array_merge([['id' => 'todos', 'label' => 'Todos']], $dbCategories),
                'photos'     => $photos
            ], JSON_UNESCAPED_UNICODE);

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error al consultar la galería: ' . $e->getMessage()
            ]);
        }
    }
}