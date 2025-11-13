<?php
    class Database {
        private $host = "localhost";
        private $db_name = "desarrollo_web"; // nombre de la base de datos
        private $username = "angel"; // usuario de la bd
        private $password = "angel"; //contraseña
        public $conn;  

        public function conectar() {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,$this->username, $this->password);
                $this->conn->exec("set names utf8mb4");
            } catch (PDOException $exception) {
                echo "Error en conexión: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }// fin class database
?>