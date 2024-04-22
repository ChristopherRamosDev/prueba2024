<?php
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '../..');
$dotenv->load();
class DB
{
    public static function connection()
    {
        $host = $_ENV['DATABASE_HOST']; // dirección del servidor de la base de datos
        $dbname = $_ENV['DATABASE_NAME']; // nombre de la base de datos a la que te quieres conectar
        $username = $_ENV['DATABASE_USER']; // usuario de la base de datos
        $password = $_ENV['DATABASE_PASSWORD']; // contraseña del usuario de la base de datos

        try {
            // creando una instancia de la clase PDO para conectarse a la base de datos
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            // configurando algunas opciones de PDO para hacer la conexión más segura
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8mb4");

            return $pdo;
        } catch (PDOException $e) {
            // manejo de errores
            echo "Error al conectarse a la base de datos: " . $e->getMessage();
        }
    }
}
