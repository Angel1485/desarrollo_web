<?php
    require_once __DIR__ . '/../config/database.php';

    class Usuario {
        private $conn;
        private $table_name = "usuarios";

        public $id;
        public $nombre;
        public $correo;
        public $contrasena; 

        public function __construct() {
            $database = new Database();
            $this->conn = $database->conectar();
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        //Registrar usuario
        public function registrar() {
            $query = "INSERT INTO " . $this->table_name . " (nombre, correo, contrasena)
                    VALUES (:nombre, :correo, :contrasena)";
            $stmt = $this->conn->prepare($query);

            // Carga de datos 2
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->correo = htmlspecialchars(strip_tags($this->correo));
            $this->contrasena = md5($this->contrasena);

            // Enlazar parámetros o carga de datos 2
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":correo", $this->correo);
            $stmt->bindParam(":contrasena", $this->contrasena);

            return $stmt->execute();
        }

        // Iniciar sesión (login)
        public function login() {
            $query = "SELECT * FROM " . $this->table_name . "
                    WHERE correo = :correo AND contrasena = :contrasena";
            $stmt = $this->conn->prepare($query);

            // Validación de parámetros
            if (empty($this->correo) || empty($this->contrasena)) {
                throw new Exception("Correo o contraseña no definidos antes del login.");
            }

            $stmt->bindParam(":correo", $this->correo);
            $stmt->bindParam(":contrasena", $this->contrasena);

            $stmt->execute();
            return $stmt;
        }

        // Listar todos los usuarios
        public function listarUsuarios() {
            try {
                $query = "SELECT id, nombre, correo FROM usuarios";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                return $stmt; // debe devolver el statement
            } catch (PDOException $e) {
                echo "Error al listar usuarios: " . $e->getMessage();
                return null;
            }
        }

        // Eliminar usuario por ID
        public function eliminar($id) {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }

        // Obtener usuario por ID (para editar)
        public function obtenerPorId($id) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Actualizar usuario
        public function actualizar($id, $nombre, $correo) {
            $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, correo = :correo WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":correo", $correo);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }

    }// fin class usuario
?>