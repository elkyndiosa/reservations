<?php

class reserve {

    private $id;
    private $id_user;
    private $id_site;
    private $people;
    private $reason;
    private $reservation_date;
    private $reservation_time;
    private $note;
    private $status;
    private $date_realization;
    private $time_realization;
    private $modification_date;
    private $id_author;
    private $db;
    
    function __construct() {
        $this->db = database::connect();
    }
    function getId() {
        return $this->id;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getId_site() {
        return $this->id_site;
    }

    function getPeople() {
        return $this->people;
    }

    function getReason() {
        return $this->reason;
    }

    function getReservation_date() {
        return $this->reservation_date;
    }

    function getReservation_time() {
        return $this->reservation_time;
    }

    function getNote() {
        return $this->note;
    }

    function getStatus() {
        return $this->status;
    }

    function getDate_realization() {
        return $this->date_realization;
    }

    function getTime_realization() {
        return $this->time_realization;
    }

    function getId_author() {
        return $this->id_author;
    }

        function getModification_date() {
        return $this->modification_date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setId_site($id_site) {
        $this->id_site = $id_site;
    }

    function setPeople($people) {
        $this->people = htmlspecialchars($this->db->real_escape_string($people));
    }

    function setReason($reason) {
        $this->reason =  htmlspecialchars($this->db->real_escape_string($reason));
    }

    function setReservation_date($reservation_date) {
        $this->reservation_date =  htmlspecialchars($this->db->real_escape_string($reservation_date));
    }

    function setReservation_time($reservation_time) {
        $this->reservation_time =   htmlspecialchars($this->db->real_escape_string($reservation_time));
    }

    function setNote($note) {
        $this->note =   trim(htmlspecialchars($this->db->real_escape_string($note)));
    }

    function setStatus($status) {
        $this->status =  $this->db->real_escape_string($status);
    }

    function setDate_realization($date_realization) {
        $this->date_realization =  $this->db->real_escape_string($date_realization);
    }
    function setTime_realization($time_realization) {
        $this->time_realization = $time_realization;
    }

    function setId_author($id_author) {
        $this->id_author = $id_author;
    }

        
    function setModification_date($modification_date) {
        $this->modification_date =  $this->db->real_escape_string($modification_date);
    }

    function save() {
        $sql = "INSERT INTO reservations VALUES (NULL, '{$this->getId_user()}', '{$this->getId_site()}', '{$this->getPeople()}', '{$this->getReason()}', '{$this->getReservation_date()}', '{$this->getReservation_time()}', '{$this->getNote()}', 'Active', CURDATE(), CURTIME(), '{$this->getId_author()}', NULL);";
        $save = $this->db->query($sql);
//        var_dump($this->db->error);die();
        $result = FALSE;
        if($save){
            $result = TRUE;
        }
        return $result;
    }
    function getAllReservationsForDay($site_id) {
        $sql = " SELECT * FROM reservations WHERE reservation_date = '{$this->getReservation_date()}'  ";
        if($site_id != NULL){
            $sql .= " AND id_site = '{$site_id} '";
        }
        $sql .= " ORDER BY id DESC ;";
//        var_dump($sql);die();
        $reservations = $this->db->query($sql);
        return $reservations;
    }
    function cancel() {
        $sql = " UPDATE reservations SET status = 'canceled' WHERE id = '{$this->getId()}';";
        $canceled = $this->db->query($sql);
        $result = FALSE;
        if($canceled){
            $result = TRUE;
        }
        return $result;
    }
    function getReserveForId() {
        $sql = " SELECT * FROM reservations WHERE id = '{$this->getId()}';";
        $reserve = $this->db->query($sql)->fetch_object();
        return $reserve;
    }
    function update() {
        $sql = " UPDATE reservations SET id_site = '{$this->getId_site()}', people = '{$this->getPeople()}', reason = '{$this->getReason()}', reservation_date = '{$this->getReservation_date()}', reservation_time = '{$this->getReservation_time()}', note = '{$this->getNote()}', status = 'Modified', modification_date = CURDATE() WHERE id = '{$this->getId()}';";
        $update = $this->db->query($sql);
        $result = FALSE;
        if($update){
            $result = TRUE;
        }
        return $result;
    }
    function getByUser() {
        $sql = " SELECT * FROM reservations WHERE id_users = '{$this->getId_user()}';";
        $reservations = $this->db->query($sql);
        return $reservations;
    }
}
