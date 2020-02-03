
<?php 
//-----------DATOS PARA SERVIDOR LOCAL----------------------
//class database{
//    public static function connect(){
//        $db = new mysqli('localhost', 'root', '', 'reservation');
//        $db-> query("SET NAMES 'utf8'");
//        return $db;
//    }
//-----------DATOS PARA SERVIDOR WEB----------------------

class database{ 
    public static function connect(){
        $db = new mysqli ('160.153.129.220', 'gustavo', 'vieja321','reservas');
        $db-> query("SET NAMES 'utf8'");
        return $db;
    }
}