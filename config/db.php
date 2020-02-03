
<?php 
class database{
    public static function connect(){
        $db = new mysqli('160.153.153.136', 'gustavo', 'vieja321', 'reservas');
        $db-> query("SET NAMES 'utf8'");
        return $db;
    }
}




//class database{
//    public static function connect(){
//        $db = new mysqli('localhost', 'root', '', 'reservation');
//        $db-> query("SET NAMES 'utf8'");
//        return $db;
//    }
