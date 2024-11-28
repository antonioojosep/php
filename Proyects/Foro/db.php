<?php
class Connection {
    public static function connect() {
        try {
            $connect = new mysqli("localhost","root","","foro");
            $connect->query("SET NAMES 'utf8'");
            return $connect;
        } catch (Exception $e) {
            echo "Error al conectar con la base de datos";
        }
    }
}