<?php

function httpGet($url) {
    $context = stream_context_create([
        'http' => [
            'ignore_errors' => true,
            'method'        => 'GET'
        ]
    ]);
    $res = file_get_contents($url, false, $context);
    return [$http_response_header[0] ?? '', $res];
}

function httpPost($url, $data = []) {
    $context = stream_context_create([
        'http' => [
            'ignore_errors' => true,
            'method'        => 'POST',
            'header'        => "Content-Type: application/json\r\n",
            'content'       => json_encode($data)
        ]
    ]);
    $res = file_get_contents($url, false, $context);
    return [$http_response_header[0] ?? '', $res];
}

echo "=== TEST HTTP EN VIVO EN APACHE ===\n";

// 1. Detalle del post 1
list($status, $body) = httpGet('http://localhost/pagina-teleinformatica/api/posts/1');
echo "1. GET /api/posts/1: $status\n";
echo "   Respuesta: " . substr($body, 0, 120) . "...\n";

// 2. Comentarios del post 1
list($status, $body) = httpGet('http://localhost/pagina-teleinformatica/api/posts/1/comments');
echo "2. GET /api/posts/1/comments: $status\n";
echo "   Respuesta: " . substr($body, 0, 120) . "...\n";

// 3. Post no existente (404)
list($status, $body) = httpGet('http://localhost/pagina-teleinformatica/api/posts/999999');
echo "3. GET /api/posts/999999: $status\n";
echo "   Respuesta: $body\n";

// 4. Crear post sin sesión (401)
list($status, $body) = httpPost('http://localhost/pagina-teleinformatica/api/posts', ['title' => 'Test']);
echo "4. POST /api/posts (sin auth): $status\n";
echo "   Respuesta: $body\n";

// 5. Posts por usuario específico /api/users/5/posts
list($status, $body) = httpGet('http://localhost/pagina-teleinformatica/api/users/5/posts');
echo "5. GET /api/users/5/posts: $status\n";
echo "   Respuesta: " . substr($body, 0, 120) . "...\n";

// 6. Mis posts sin sesión (401)
list($status, $body) = httpGet('http://localhost/pagina-teleinformatica/api/me/posts');
echo "6. GET /api/me/posts (sin auth): $status\n";
echo "   Respuesta: $body\n";

echo "=== FIN DE PRUEBAS HTTP ===\n";
