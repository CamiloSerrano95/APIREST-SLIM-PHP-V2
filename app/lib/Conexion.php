<?php
    namespace App\Lib;
    
    use PDO;

    class Conexion {
        public static function get_conexion(){
            $user = "root";
            $pass = "1067943114";
            $host = "localhost";
            $db = "ApiPhp";

            try {
                $connection = new PDO("mysql:host=$host; dbname=$db", $user, $pass);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (Exception $e) {
                print_r($e);
            }

            return $connection;
        }
    }
?>