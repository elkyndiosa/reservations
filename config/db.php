<<<<<<< HEAD
<?php 
class database{
    public static function connect(){
        $db = new mysqli('localhost', 'gustavo', '1234567', 'tienda');
        $db-> query("SET NAMES 'utf8'");
        return $db;
    }
}
=======
class database{
    public static function connect(){
        $db = new mysqli('160.153.129.220', 'gustavo', '1234567', 'reservations');
        $db-> query("SET NAMES 'utf8'");
        return $db;
    }
}
>>>>>>> b182c47a3cc28c2e36ebaf1bff11859397ddc290
