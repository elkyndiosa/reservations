<?php 
class database{
    public static function connect(){
        $db = new mysqli('localhost', 'gustavo', '1234567', 'reservations');
        $db-> query("SET NAMES 'utf8'");
        return $db;
    }
}