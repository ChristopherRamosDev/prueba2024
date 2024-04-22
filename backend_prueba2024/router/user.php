<?php
//ROUTER DE USER
use Helpers\Utils;
require_once './app/controller/UserController.php';
$UserController = new UserController;
$params = explode('/', $_SERVER['REQUEST_URI']);
$datos = file_get_contents("php://input");
//RUTAS
$UserController->getDineroRestante('/user/get/monto/restante');
echo json_encode(Utils::status404());
//SE USA FUNCION () en caso de que no encuentre ninguna de las rutas
echo json_encode(Utils::status404());