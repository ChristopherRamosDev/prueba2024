<?php
use Helpers\Utils;

require_once './app/model/UserModel.php';
class UserController
{
    private $conn;
    public function __construct()
    {
        $this->conn = new UserModel();
    }
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
    public function getDineroRestante($endpoint)
    {
        $respuesta['Codigo'] = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $endpoint == $_SERVER['REQUEST_URI']) {
            if (isset(getallheaders()["access_token"]) && !empty(getallheaders()["access_token"])) {
                $token = getallheaders()["access_token"];
                if (!empty($token)) {
                   $validate = Utils::decodeToken($token);
                   $monto = $this->conn->getDineroRestante($validate->dni);
                  $respuesta['Codigo'] = 1;
                  $respuesta['saldo'] = $monto['saldo'];
                } else {
                    $respuesta['Mensaje'] = "Token no válido";
                }
        } else {
            $respuesta['Mensaje'] = "No se envió el token";
        }
            echo json_encode($respuesta);
            exit();
        }
    }

}
