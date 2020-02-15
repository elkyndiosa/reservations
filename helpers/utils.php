<?php

class Utils {

    public static function DeleteSession($session) {
        if (isset($_SESSION[$session])) {
            $_SESSION[$session] = NULL;
            unset($_SESSION[$session]);
        }
    }

    public static function isAdmin() {
        if (!isset($_SESSION['admin'])) {
            header("location: " . base_url . 'reservation/reserve');
        } else {
            return TRUE;
        }
    }

    public static function isAdminOrEmployee() {
        if (isset($_SESSION['admin']) || isset($_SESSION['employee'])) {
            return TRUE;
        } else {
            header("location: " . base_url . 'reservation/reserve');
        }
    }
    public static function isAdminOrUseroOne($user_id) {
        if (isset($_SESSION['admin']) || $user_id == $_SESSION['user']->id) {
            return TRUE;
        } else {
            header("location: " . base_url . 'reservation/reserve');
        }
    }
    public static function notIssetSession() {
            if (!isset($_SESSION['user'])) {
                header("location: " . base_url);
            } else {
                return TRUE;
            }
        }
    public static function issetSession() {
        if (isset($_SESSION['user'])) {
            header('location: ' . base_url . 'reservation/reserve');
        } else {
            return TRUE;
        }
    }

    public static function showTypeUser($rol) {
        $typeUser = '';
        if ($rol == 'admin') {
            $typeUser = 'Administrador';
        } elseif ($rol == 'employee') {
            $typeUser = 'Empleado';
        } else {
            $typeUser = 'Cliente';
        }
        return $typeUser;
    }

    public static function showMessage($error) {
        $sError = '';
        if (isset($_SESSION['error'][$error])) {
            $message = $_SESSION['error'][$error];
            $sError = '<script>
                        $(document).ready(function () {
                            $("body").overhang({
                            type: "error",
                            message: "' . $message . '",
                            duration: 2,
                            upper: true
                            });
                        });
                    </script>';
        }
        return $sError;
    }

    public static function showMessageSusscces() {
        $query = '';
        if (isset($_SESSION['completed'])) {
            $message = $_SESSION['completed'];
            $query = '<script>
                        $(document).ready(function () {
                            $("body").overhang({
                            type: "success",
                            message: "' . $message . '",
                            duration: 2,
                            upper: true
                            });
                        });
                    </script>';
        }
        return $query;
    }

    public static function getSites() {
        require_once 'models/site.php';
        $sites = new site();
        $sites = $sites->getSites();
        return $sites;
    }

    public static function getSitesForId($id) {
        require_once 'models/site.php';
        $id = $id;
        $sites = new site();
        $sites->setId($id);
        $sites = $sites->getSitessForId();
        $sites = $sites->fetch_object();
        return $sites;
    }

    public static function getReserveForId($id) {
        require_once 'models/reserve.php';
    }

    public static function getUser($id) {
        require_once 'models/user.php';
        $user = new user();
        $user->setId($id);
        $user = $user->searchId();
        return $user;
    }

}
