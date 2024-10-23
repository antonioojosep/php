<?php
class Connection {
    public static function connect() {
        $connect = new mysqli("localhost","root","","shop");
        $connect->query("SET NAMES utf-8");
        return $connect;
    }
}