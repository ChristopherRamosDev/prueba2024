<?php
//ROUTER DE TRANSACTION
use Helpers\Utils;
require_once './app/controller/TransactionController.php';
$TransactionController = new TransactionController;
$params = explode('/', $_SERVER['REQUEST_URI']);
$datos = file_get_contents("php://input");
//RUTAS
$TransactionController->generarTransaccion('/transaction/generate' , $datos);
//SE USA FUNCION () en caso de que no encuentre ninguna de las rutas
echo json_encode(Utils::status404());