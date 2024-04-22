<?php
require __DIR__ . '/vendor/autoload.php';
use Helpers\Utils;

// Habilitar CORS
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, Access-Control-Allow-Headers, access_token");

// Manejar solicitudes de verificación previa
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Analizar el URI de solicitud para determinar la ruta
$param = explode('/', $_SERVER['REQUEST_URI']);
$AllowRoutes = ['auth', 'users', 'products'];
$folder = "./router/" . $param[1] . ".php";

// Requerir el archivo de ruta apropiado si existe, o devolver una respuesta 404
if (file_exists($folder)) {
    require_once $folder;
} else {
    echo json_encode(Utils::status404());
}
