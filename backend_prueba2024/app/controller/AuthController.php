<?php
use Helpers\Utils;

require_once './app/model/AuthModel.php';
class AuthController
{
    private $conn;
    public function __construct()
    {
        $this->conn = new AuthModel();
    }
    //FUNION PARA INICIO DE SESION
    /*

    NOMENCLATURA DE LAS FUNCIONES DEL CONTROLADOR

     public function someFuncion($endpoint, $data)
    {
        $respuesta['Codigo'] = 0;
        ESTA FUNCION RECIBE SOLO PARAMETRO POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $endpoint == $_SERVER['REQUEST_URI']) {
            $dataDecoded = json_decode($data, true);
            $res = $this->conn->logIn($dataDecoded['dni'], $dataDecoded['password']);
            EN CASO DE QUE LA FUNCION RES SEA TRUE SE CAMBIA EL $respuesta['Codigo'] =1
            if(($res['res'])){
                $respuesta['Codigo'] =1;
                $respuesta['token'] = Utils::createToken($dataDecoded['dni'],$res['correo'],$res['type_user_id'],$res['id_usuario']);
            }

            SE DEVUELVE LA RESPUESTA
            echo json_encode($respuesta);
            exit();
        }
    }
    */
    public function login($endpoint, $data)
    {
        $respuesta['Codigo'] = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $endpoint == $_SERVER['REQUEST_URI']) {
            $dataDecoded = json_decode($data, true);
            $res = $this->conn->logIn($dataDecoded['dni'], $dataDecoded['password']);
            if(($res['res'])){
                $respuesta['Codigo'] =1;
                $respuesta['token'] = Utils::createToken($dataDecoded['dni'],$res['correo'],$res['type_user_id'],$res['id_usuario']);
            }

            echo json_encode($respuesta);
            exit();
        }
    }
    public function signUp($endpoint, $data)
    {
        $respuesta['Codigo'] = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $endpoint == $_SERVER['REQUEST_URI']) {
            $dataDecoded = json_decode($data, true);
            if (isset($dataDecoded['username']) && isset($dataDecoded['password']) && isset($dataDecoded['tipoUsuario']) 
            && isset($dataDecoded['nombres']) && isset($dataDecoded['dni']) && isset($dataDecoded['correo']) && isset($dataDecoded['apellidos'])) {
                $username= $dataDecoded['username'];
                $password= $dataDecoded['password'];
                $tipoUsuario= $dataDecoded['tipoUsuario'];
                $nombres= $dataDecoded['nombres'];
                $apellidos= $dataDecoded['apellidos'];
                $dni= $dataDecoded['dni'];
                $correo= $dataDecoded['correo'];
                $insert = $this->conn->signUp($username, $password,$tipoUsuario,$nombres,$apellidos,$dni,$correo);
                if ($insert['res']) {
                    $respuesta['Codigo'] = 1;
                }else{
                    $respuesta['msg'] = $insert['msg'];
                }
            }
            echo json_encode($respuesta);
            exit();
        }
    }
    public function validateSession($endpoint)
    {
        $respuesta['Codigo'] = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $endpoint == $_SERVER['REQUEST_URI']) {
            if (isset(getallheaders()["access_token"]) && !empty(getallheaders()["access_token"])) {
                $token = getallheaders()["access_token"];
                if (!empty($token)) {
                   $validate = Utils::validateToken($token);
                   if($validate){
                    $respuesta["Codigo"] = 1;
                   }
                } else {
                    $respuesta['Mensaje'] = "Token no válido";
                }
            } else {
                $respuesta['Mensaje'] = "No se envió el token";
            }
            echo json_encode($respuesta);
            exit;
        }
    }
}
