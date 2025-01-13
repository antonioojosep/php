<?php
class Connection
{
    public static function connect(){
        try {
            $connect = new mysqli("localhost","root","","examen");
            $connect->query("SET NAMES 'utf8'");
            return $connect;
        } catch (Exception $e) {
            return false;
        }
    }
}