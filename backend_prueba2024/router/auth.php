<?php
//ROUTER DE AUTH
use Helpers\Utils;
require_once './app/controller/AuthController.php';
$AuthController = new AuthController;
$params = explode('/', $_SERVER['REQUEST_URI']);
$datos = file_get_contents("php://input");
//RUTAS
$AuthController->login('/auth/logIn', $datos);
$AuthController->validateSession('/auth/validate/session/');
$AuthController->signUp('/auth/signUp', $datos);
//SE USA FUNCION () en caso de que no encuentre ninguna de las rutas
echo json_encode(Utils::status404());