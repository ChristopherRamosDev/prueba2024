<?php
require_once './config/database.php';
class AuthModel extends DB
{
    //FUNCION PRAA EL LOGIN DEL USUARIO MEDIANTE EL DNI Y LA CLAVE, HACIENDO ADEMAS UN VERIFY DE LA CLAVE CON PASSWORD_VERIFY
    public function logIn($dni, $pass)
    {
        $response['res'] = false;
        try {
            $conection = DB::connection();
            $sql = "SELECT users.password,p.correo,users.type_user_id,users.id_usuario FROM prueba2024.persona p join users on p.id_persona=users.persona_id WHERE p.dni=? ";
            $stmt = $conection->prepare($sql);
            $stmt->bindValue(1, $dni);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $password  = $resultados[0]["password"];
            if(password_verify($pass, $password)) {
                $response["res"] = true;
                $response["correo"] = $resultados[0]["correo"];
                $response["type_user_id"] = $resultados[0]["type_user_id"];
                $response["id_usuario"] = $resultados[0]["id_usuario"];
            }
           
        } catch (\Throwable $th) {
            return $th->getMessage();   
        }
        return $response;
    }
    //FUNCION PARA EL REGISTRO DEL USUARIO
    public function signUp($username, $password,$tipoUsuario,$nombres,$apellidos,$dni,$correo)
    {
        $response['res'] = false;
        $response['msg'] = '';
        try {
            $conection = DB::connection();
            $sql = "INSERT INTO persona set dni=?,nombres=?,apellidos=?,correo=?";
            $stmt = $conection->prepare($sql);
            $stmt->bindValue(1, $dni);
            $stmt->bindValue(2, $nombres);
            $stmt->bindValue(3, $apellidos);
            $stmt->bindValue(4, $correo);
            if($stmt->execute()){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $lastId = $conection->lastInsertId();
                $sql = "INSERT INTO users set type_user_id=?,persona_id=?,user=?,password=?";
                $stmt = $conection->prepare($sql);
                $stmt->bindValue(1, $tipoUsuario);
                $stmt->bindValue(2, $lastId);
                $stmt->bindValue(3, $username);
                $stmt->bindValue(4, $hash);
                if($stmt->execute()){
                    $response['res'] = true;
                }
            }
           
        }   catch (Exception $e) {
            if($e->getCode() == 23000){
                $response['msg'] = "El dni y el correo ya estan asociados a otra persona";
            } else{
                $response['msg'] = "Internal server error";
            }
        }
        return $response;
    }

}
