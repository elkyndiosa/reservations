<?php
class site{
    private $id;
    private $name;
    private $db;
    function __construct() {
        $this->db = database::connect();
    }
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }
    function getSites(){
        $sql = "SELECT * FROM site ;";
        $sites = $this->db->query($sql);
        return $sites;
    }
     function getSitessForId() {
        $sql = "SELECT name FROM site WHERE id = '{$this->getId()}'; ";
        $sites = $this->db->query($sql);
        return $sites;
    }

}