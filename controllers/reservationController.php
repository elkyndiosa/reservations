<?php

require_once 'models/reserve.php';

class reservationController {

    public function index() {
        Utils::issetSession();
        require_once 'views/users/login.php';
    }

    public function reserve() {
        $id = NULL;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if ( empty($id) && (isset($_SESSION['admin']) || isset($_SESSION['employee']))) {
            header('location: ' . base_url . 'user/allUSer');
        }elseif (empty($id) && !isset($_SESSION['admin']) && !isset($_SESSION['employee']) ){
            $id = $_SESSION['user']->id;
        }
        require_once 'views/reservation/reserve.php';
    }

    public function reservation() {
        Utils::isAdminOrEmployee();
        $day = date('Y-m-d');
        $site_id = NULL;
        if (isset($_POST)) {
            if (!empty($_POST['search'])) {
                $daym = $_POST['search'];
                $day = date('Y-m-d', strtotime($daym));
            }
            if (!empty($_POST['site'])) {
                $site_id = $_POST['site'];
            }
        }
        $reserve = new reserve();
        $reserve->setReservation_date($day);
        $reservations = $reserve->getAllReservationsForDay($site_id);


        require_once 'views/reservation/reservation.php';
    }

    public function saveReserve() {
        if (isset($_POST)) {
            $id_user = isset($_POST['id']) ? $_POST['id'] : FALSE;
            $id_site = isset($_POST['site']) ? $_POST['site'] : FALSE;
            $people = isset($_POST['people']) ? $_POST['people'] : FALSE;
            $reason = isset($_POST['reason']) ? $_POST['reason'] : FALSE;
            $date_reserve = !empty($_POST['date_reserve']) ? date('Y-m-d', strtotime($_POST['date_reserve'])) : FALSE;
            $time_reserve = isset($_POST['time_reserve']) ? date('g:ia', strtotime($_POST['time_reserve'])) : FALSE;
            $note = !empty($_POST['note']) ?  ucfirst($_POST['note']) : "";
            $id_author = $_SESSION['user']->id;
            //VALIDAMOS LOS DATOS RECIBIDOS 
            $errors = array();
           
            if (!empty($people)) {
                $people_validado = true;
            } else {
                $people_validado = false;
                $errors['people'] = "Invitados no esta definido";
            }
            if (!empty($reason)) {
                $reason_validado = true;
            } else {
                $reason_validado = false;
                $errors['reason'] = "Motivo no seleccionado";
            }
//            var_dump($date_reserve, date('d/m/Y '), date('g:ia'));
//            die();
//             var_dump( $date_reserve, date('Y-m-d'));die();
            if ($date_reserve >= date('Y-m-d')) {
                $date_validado = true;
            } else {
                $date_validado = false;
                $errors['date'] = "Elige una fecha valida";
            }

            if (!empty($time_reserve)) {
                $time_validado = true;
            } else {
                $time_validado = false;
                $errors['time'] = "Hora incorrecta";
            }


            if (count($errors) == 0) {
                //guardamos reserva
                $reserve = new reserve();
                $reserve->setId_user($id_user);
                $reserve->setId_site($id_site);
                $reserve->setPeople($people);
                $reserve->setReason($reason);
                $reserve->setReservation_date($date_reserve);
                $reserve->setReservation_time($time_reserve);
                $reserve->setNote($note);
                $reserve->setStatus($reason);
                $reserve->setId_author($id_author);
                $save = $reserve->save();
                if ($save) {
                    $_SESSION['completed'] = 'Reserva realizada con exito';
                    $isadmin = Utils::isAdminOrEmployee();
                    if($isadmin){
                    header('location: ' . base_url . 'user/allUser');
                    }else{
                         header('location: ' . base_url . 'reservation/myreservations');
                    }
                } else {
                    $_SESSION['error']['general'] = 'Error al registrar reserva';
                    header('location: ' . base_url . 'reservation/reserve');
                }
            } else {
                $_SESSION['error'] = $errors;
                header('location: ' . base_url . 'reservation/reserve&id=' . $id_user);
            }
        } else {
            header('location: ' . base_url . 'reservation/reserve&id=' . $id_user);
        }
    }

    public function canceled() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $reserve = new reserve();
            $reserve->setId($id);
            $cancel = $reserve->cancel();
            $_SESSION['completed'] = 'Reserva cancelada exitosamente';
            header('location: ' . base_url . 'reservation/reservation');
        }
    }

    public function update() {
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $reserve = new reserve();
            $reserve->setId($id);
            $reserve = $reserve->getReserveForId();
        }
        require_once 'views/reservation/reserve.php';
    }

    public function saveUpdate() {
        if (isset($_POST)) {
            $id_reservations = isset($_POST['id']) ? $_POST['id'] : FALSE;
            $id_site = isset($_POST['site']) ? $_POST['site'] : FALSE;
            $people = isset($_POST['people']) ? $_POST['people'] : FALSE;
            $reason = isset($_POST['reason']) ? $_POST['reason'] : FALSE;
            $date_reserve = !empty($_POST['date_reserve']) ? date("d/m/Y", strtotime($_POST['date_reserve'])) : FALSE;
            $time_reserve = isset($_POST['time_reserve']) ? date('g:ia', strtotime($_POST['time_reserve'])) : FALSE;
            $note = !empty($_POST['note']) ? $_POST['note'] : "";

            //VALIDAMOS LOS DATOS RECIBIDOS
            $errors = array();
            if (!empty($people)) {
                $people_validado = true;
            } else {
                $people_validado = false;
                $errors['people'] = "Invitados no esta definido";
            }
            if (!empty($reason)) {
                $reason_validado = true;
            } else {
                $reason_validado = false;
                $errors['reason'] = "Motivo no seleccionado";
            }
//            var_dump($date_reserve, date('d/m/Y '), date('g:ia'));
//            die();
            if ($date_reserve >= date('d/m/Y')) {
                $date_validado = true;
            } else {
                $date_validado = false;
                $errors['date'] = "Elige una fecha valida";
            }

            if (!empty($time_reserve)) {
                $time_validado = true;
            } else {
                $time_validado = false;
                $errors['time'] = "Hora incorrecta";
            }


            if (count($errors) == 0) {
                //guardamos reserva
                $reserve = new reserve();
                $reserve->setId($id_reservations);
                $reserve->setId_site($id_site);
                $reserve->setPeople($people);
                $reserve->setReason($reason);
                $reserve->setReservation_date($date_reserve);
                $reserve->setReservation_time($time_reserve);
                $reserve->setNote($note);
                $reserve->setStatus($reason);
                $update = $reserve->update();
                if ($update) {
                    $_SESSION['completed'] = 'Se modifico exitosamente';
                    header('location: ' . base_url . 'reservation/myreservations');
                } else {
                    $_SESSION['error']['general'] = 'Error al registrar reserva';
                    header('location: ' . base_url . 'reservation/update&id='.$id_reservations);
                }
            } else {
                $_SESSION['error'] = $errors;
                header('location: ' . base_url . 'reservation/update&id='.$id_reservations);
            }
        } else {
            header('location: ' . base_url . 'reservation/update&id='.$id_reservations);
        }
    }
    function myreservations() {
        $id_user = $_SESSION['user']->id;
        $reserve = new reserve();
        $reserve->setId_user($id_user);
        $reservations = $reserve->getByUser();
        require_once 'views/reservation/reservation.php';
    }
}
