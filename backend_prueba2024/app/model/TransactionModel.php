<?php
require_once './config/database.php';
class TransactionModel extends DB
{
    //FUNCION PARA EJECUTAR LA TRANSFERENCIA MEDIANTE EL PAGADOR, EL PAGADO Y EL MONTO
    public function generarTransaccion($pagador,$pagado,$monto)
    {
        $response = false;
        try {
            $conection = DB::connection();
            $sql = "UPDATE users SET saldo = saldo - ? WHERE id_usuario = ?";
            $stmt = $conection->prepare($sql);
            $stmt->bindValue(1, $monto);
            $stmt->bindValue(2, $pagador);
           if( $stmt->execute()){
            $sql = "SELECT id_persona FROM persona WHERE dni=?";
            $stmt = $conection->prepare($sql);
            $stmt->bindValue(1, $pagado);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $id_persona = $resultados[0]["id_persona"];
            $sql = "UPDATE users SET saldo = saldo + ? WHERE persona_id = ?";
            $stmt = $conection->prepare($sql);
            $stmt->bindValue(1, $monto);
            $stmt->bindValue(2, $id_persona);
            if( $stmt->execute()){
                $response = true;
           }}
        } catch (\Throwable $th) {
            return $th->getMessage();   
        }
        return $response;
    }
 

}
