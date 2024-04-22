<?php
use Helpers\Utils;

require_once './app/model/TransactionModel.php';
class TransactionController
{
    private $conn;
    public function __construct()
    {
        $this->conn = new TransactionModel();
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
    public function generarTransaccion($endpoint, $data)
    {
        $respuesta['Codigo'] = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $endpoint == $_SERVER['REQUEST_URI']) {
            $dataDecoded = json_decode($data, true);
            $insert = $this->conn->generarTransaccion($dataDecoded['pagador'], $dataDecoded['pagado'],$dataDecoded['monto']);
            if($insert){
                $respuesta['Codigo'] =1;
            }
            echo json_encode($respuesta);
            exit();
        }
    }

}
