<?php
    // Esta clase será incluida en todos los archivos para conectarnos a la base de datos
    class Conexion {
        private $host = "localhost";
        private $usuario = "root";
        private $contraseña = "nikita01C#";
        private $base_datos = "tiendaRelojes";

        // Hace la conexión con la base de datos
        public function conectar() {
            $con = new mysqli($this->host, $this->usuario, $this->contraseña, $this->base_datos);
            if ($con->connect_error) {
                die("Error de conexión: " . $con->connect_error);
            }
            return $con;
        }
    }
?>
