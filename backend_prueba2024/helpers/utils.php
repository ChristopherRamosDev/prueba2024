<?php

namespace Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

class Utils
{
    public static function loadEnv()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '../..');
        try {
            $dotenv->load();
        } catch (\Dotenv\Exception\InvalidPathException $e) {
            echo "Error al cargar el archivo .env: " . $e->getMessage();
        }
    }

    //FUNCION DE STATUS 404 EN CASO DE RUTAS NO ENCONTRADAS
    public static function status404(string $res = 'Parece que estás perdido, por favor verifica la documentación')
    {
        http_response_code(404);
        $respuesta['Codigo'] = 0;
        $respuesta['Mensaje'] = $res;
        return $respuesta;
    }

    //FUNCION PARA LA CREACION DE TOKEN MEDIANTE JWT Y USANDO VARIABLES DE ENTORNO
    public static function createToken($dni,$correo,$type_user_id,$id_usuario)
    {
        self::loadEnv();
        $privateKey = $_ENV['PRIVATE_KEY'];
        $userData = array(
            'dni' => $dni,
            'correo' => $correo,
            'type_user_id' => $type_user_id,
            'id_usuario' => $id_usuario,
            "exp" => time() + 1000000,
        );
        // Generar el token JWT
        $token = JWT::encode($userData, $privateKey, 'HS256');
        return $token;
    }
     //FUNCION PARA LA VERIFICACION DEL TOKEN CREADO PREVIAMENTE
    public static function validateToken($token)
    {
       $respuesta = false;
        try {
            self::loadEnv();
            $privateKey = $_ENV['PRIVATE_KEY'];
            $decoded = JWT::decode($token, new Key($privateKey, 'HS256')); // Decode the JWT with the secret key and algorithm
            $expired = ($decoded->exp < time());
            if (!$expired) { // Check if the token has expired
                $respuesta = true;
            }
        } catch (Exception $e) {
            
        }
        return $respuesta;
    }
     //FUNCION PARA LA DECODIFICACION DE TOKEN MEDIANTE JWT
    public static function decodeToken($token)
    {
       $respuesta = "";
        try {
            self::loadEnv();
            $privateKey = $_ENV['PRIVATE_KEY'];
            $decoded = JWT::decode($token, new Key($privateKey, 'HS256')); // Decode the JWT with the secret key and algorithm
            $expired = ($decoded->exp < time());
            if (!$expired) { // Check if the token has expired
                $respuesta = $decoded;
            }
        } catch (Exception $e) {
            
        }
        return $respuesta;
    }
}
