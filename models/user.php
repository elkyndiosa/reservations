<?php

class user {

    private $id;
    private $name;
    private $email;
    private $phone;
    private $password;
    private $rol;
    private $photo;
    private $registration_date;
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

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getPassword() {
        return $this->password;
    }

    function getRol() {
        return $this->rol;
    }

    function getPhoto() {
        return $this->photo;
    }

    function getRegistration_date() {
        return $this->registration_date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $this->db->real_escape_string($name);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPhone($phone) {
        $this->phone = $this->db->real_escape_string($phone);
    }

    function setPassword($password) {
        $this->password = $this->db->real_escape_string($password);
    }

    function setRol($rol) {
        $this->rol = $this->db->real_escape_string($rol);
    }

    function setPhoto($photo) {
        $this->photo = $this->db->real_escape_string($photo);
    }

    function setRegistration_date($registration_date) {
        $this->registration_date = $registration_date;
    }

    function saveUser() {
        $sql = " INSERT INTO users values (NULL, '{$this->getName()}', '{$this->getEmail()}', '{$this->getPhone()}', '{$this->getPassword()}', '{$this->getRol()}', '{$this->getPhoto()}', CURDATE());";
        $guardar = $this->db->query($sql);
        $status = FALSE;
        if ($guardar) {
            $status = TRUE;
        }
        return $status;
    }

    function searchEmail() {
        $sql = " SELECT * FROM users WHERE '{$this->getEmail()}' = email; ";
        $search = $this->db->query($sql)->fetch_object();

        return $search;
    }
    function searchId() {
        $sql = " SELECT * FROM users WHERE '{$this->getId()}' = id; ";
        $search = $this->db->query($sql)->fetch_object();

        return $search;
    }

    function saveUpdate() {
        $sql = "UPDATE users SET name = '{$this->getName()}', email = '{$this->getEmail()} ', phone = '{$this->getPhone()}', rol = '{$this->getRol()}' WHERE id = '{$this->getId()}';";
    $update = $this->db->query($sql);
        $result = FALSE;
        if ($update) {
            $result = TRUE;
        }
        return $result;
    }

    function saveUpdatePhoto() {
        $sql = "UPDATE users SET photo = '{$this->getPhoto()}' WHERE id = '{$this->getId()}';";
        $update = $this->db->query($sql);
        $result = FALSE;
        if ($update) {
            $result = TRUE;
        }
        return $result;
    }

    function allUsers() {
        $sql = "SELECT * FROM users WHERE rol != 'employee' AND rol != 'admin'; ";
        $users = $this->db->query($sql);
        return $users;
    }
     function allEmplyee() {
        $sql = "SELECT * FROM users WHERE rol = 'employee'; ";
        $users = $this->db->query($sql);
        return $users;
    }
    function searchUserBySearch($search) {
        $sql = "SELECT * FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%';";
        $users = $this->db->query($sql);
        return $users;
    }

}
