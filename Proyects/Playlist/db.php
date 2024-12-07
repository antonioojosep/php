<?php
class Connection
{
    public static function connect()
    {
        try {
            $connect = new mysqli("localhost","root","","playlist");
            return $connect;
        } catch (Exception $e) {
            echo "Error al conectar con la base de datos" . $e;
        }
    }
}