<?php
require_once './config/database.php';
class UserModel extends DB
{
    //FUNCION PARA OBTENER EL DINERO ACTUAL CON EL QUE CUENTA EL USUARIO
    public function getDineroRestante($dni)
    {
        $response['saldo'] = 0;
        try {
            $conection = DB::connection();
            $sql = "SELECT users.saldo FROM prueba2024.persona p join users on p.id_persona=users.persona_id WHERE p.dni=?";
            $stmt = $conection->prepare($sql);
            $stmt->bindValue(1, $dni);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response["saldo"] = $resultados[0]["saldo"];
           
        } catch (\Throwable $th) {
            return $th->getMessage();   
        }
        return $response;
    }
 

}
