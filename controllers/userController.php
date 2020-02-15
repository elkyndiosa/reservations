<?php

require_once 'models/user.php';

class userController {

    function signin() {
        $dir = base_url.'user/save';
        require_once 'views/users/signin.php';
    }

    function save() {
        //recibimos datos por post
        if (isset($_POST)) {
            $name = isset($_POST['name']) ? ucwords($_POST['name']) : FALSE;
            $email = isset($_POST['email']) ? $_POST['email'] : FALSE;
            $phone = isset($_POST['phone']) ? $_POST['phone'] : FALSE;
            $password = isset($_POST['password']) ? $_POST['password'] : FALSE;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';
    //        var_dump($_post); die();

//            var_dump($_FILES, $_POST); die();s
            //validamos datos
            $errors = array();
            if (!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name) && strlen($name) < 50) {
                $name_validate = TRUE;
            } else {
                $name_validate = FALSE;
                $errors['name'] = "Nombre incorrecto";
            }
            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) < 30) {
                $email_validate = TRUE;
            } else {
                $email_validate = FALSE;
                $errors['email'] = "Email incorrecto";
            }
            if (!empty($phone) && !preg_match("/[a-z]/", $phone) && strlen($phone) < 18) {
                $phone_validate = TRUE;
            } else {
                $phone_validate = FALSE;
                $errors['phone'] = "Telefono incorrecto";
            }
            if (!empty($password) && strlen($password) > 4) {
                $password_validate = TRUE;
            } else {
                $password_validate = FALSE;
//                $errors['password'] = "Password muy corto";
            }
            $user_email = new user();
            $user_email->setEmail($email);
            $user_email = $user_email->searchEmail();

            if (is_object($user_email)) {
                $errors['email_used'] = 'Correo usado por otro usuario';
            }
            // hacemos password segura
            if (count($errors) == 0) {
                if (!empty($password)) {
                    $password_safe = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
                } else {
                    $password_safe = "";
                }
                $user = new user();
                $user->setName($name);
                $user->setEmail($email);
                $user->setPhone($phone);
                $user->setPassword($password_safe);
                $user->setRol($rol);
                if ($_FILES['photo']['size'] != 0) {
                    
                    $file = $_FILES['photo'];
                    $name_file = $file['name'];
                    $type_file = $file['type'];
                    $tmp_name_file = $file['tmp_name'];
                 
                    if ($type_file == 'image/png' || $type_file == 'image/jpg' || $type_file == 'image/jpeg' || $type_file == "image/tiff" || $type_file == "image/gif") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        move_uploaded_file($tmp_name_file, 'uploads/images/' . $name_file);
                        $user->setPhoto($name_file);
                    }
                }
                $user->saveUser();
                $_SESSION['completed'] = 'Su registro ha sido completado';
                header('location: ' . base_url);
            } else {
                $_SESSION['error'] = $errors;
                header('location: ' . base_url . 'user/update&new');
            }
        } else {
            $_SESSION['error']['general'] = 'Error al enviar datos';
            header('location: ' . base_url . 'user/signin');
        }
    }

    function login() {
        if (isset($_POST)) {

            $email = isset($_POST['email']) ? $_POST['email'] : FALSE;
            $password = isset($_POST['password']) ? $_POST['password'] : "";

            $user = new user();
            $user->setEmail($email);
            $user = $user->searchEmail();
            if (isset($user)) {
                $rol = $user->rol;
                $password_user = $user->password;
                if (!empty($password)) {
                    $verify = password_verify($password, $password_user);
                } elseif ($password_user === $password) {
                    $verify = TRUE;
                }
                if ($verify) {
                    $_SESSION['user'] = $user;
                    $_SESSION['completed'] = 'Bienvenido ' . $user->name;

                    if ($rol == 'employee') {
                        $_SESSION['employee'] = TRUE;
                        header('location: ' . base_url . 'reservation/reservation');
                        exit();
                    } elseif ($rol == 'admin') {
                        $_SESSION['admin'] = TRUE;
                        header('location: ' . base_url . 'reservation/reservation');
                        exit();
                    } else {
                        header('location: ' . base_url . 'reservation/reserve');
                        exit();
                    }
                } else {
                    $_SESSION['error']['pass'] = 'Contraseña incorrecta';
                    header('location: ' . base_url);
                    exit();
                }
            } else {
                $_SESSION['error']['email'] = 'Correo no registrado';
                header('location: ' . base_url);
                exit();
            }
        }
    }

    function profile() {
        Utils::notIssetSession();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = Utils::getUser($id);
            $getid = '&id='.$id;
        } else {
            $user = $_SESSION['user'];
            $getid = '';
        }
//        var_dump($user); die();
        $photo = $user->photo;
        require_once 'views/users/profile.php';
    }

    function update() {
        Utils::notIssetSession();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (isset($_SESSION['user']) && !isset($id) && !isset($_GET['new'])) {
            $title = 'Editar mi perfil';
            $text = 'Por favor ingrese datos nuevos para modificarlos';
            $dir = base_url . 'user/saveUpdate';
            $id_user = $_SESSION['user']->id;
        } 
        if (isset($_SESSION['admin']) || isset($_SESSION['employee'])) {
            if (isset($_GET['new'])) {
                $title = 'Registrar nuevo usuario';
                $text = 'Por favor ingrese datos para Regsitrar';
                $dir = base_url . 'user/save';
                $id_user = NULL;
            }
        } 
        if (isset($id)) {
            $title = 'Editar usuario';
            $text = 'Por favor cambie datos a modificar';
            $user = Utils::getUser($id);
            $dir = base_url . 'user/saveUpdate';
            $id_user = $user->id;
        } 
        if(!isset($_SESSION['user'])) {
            $title = 'Registrarse';
            $text = 'Por favor ingrese datos para Regsitrarse';
            $dir = base_url . 'user/save';
        }
        require_once 'views/users/signin.php';
    }

    function saveUpdate() {
        Utils::notIssetSession();
        if (isset($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
            $name = isset($_POST['name']) ? ucwords($_POST['name']) : FALSE;
            $email = isset($_POST['email']) ? $_POST['email'] : FALSE;
            $phone = isset($_POST['phone']) ? $_POST['phone'] : FALSE;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : NULL;

//            var_dump($_FILES, $_POST); die();s
            //validamos datos
            $errors = array();
            if (!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name) && strlen($name) < 50) {
                $name_validate = TRUE;
            } else {
                $name_validate = FALSE;
                $errors['name'] = "Nombre incorrecto";
            }
            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) < 30) {
                $email_validate = TRUE;
            } else {
                $email_validate = FALSE;
                $errors['email'] = "Email incorrecto";
            }
            if (!empty($phone) && !preg_match("/[a-z]/", $phone) && strlen($phone) < 18) {
                $phone_validate = TRUE;
            } else {
                $phone_validate = FALSE;
                $errors['phone'] = "Telefono incorrecto";
            }

            if (count($errors) == 0) {
                $user = new user();
                $user->setId($id);
                $user->setName($name);
                $user->setEmail($email);
                $user->setPhone($phone);
                $user->setRol($rol);
                $save = $user->saveUpdate();
                if ($save) {
                    if ($_SESSION['user']->id == $id) {
                        $_SESSION['user']->name = $name;
                        $_SESSION['user']->email = $email;
                        $_SESSION['user']->phone = $phone;
                        $_SESSION['user']->rol = $rol;
                        $_SESSION['completed'] = 'Sus datos se han modificado correctamente';
                        header('location: ' . base_url . 'user/profile');
                    } else {
                        $_SESSION['completed'] = 'Modficado exitosamente';
                        header('location: ' . base_url . 'user/allUser');
                    }
                } else {
                    $_SESSION['error']['general'] = 'No se pudo modificar datos';
                    header('location: ' . base_url . 'user/profile');
                }
            } else {
                $_SESSION['error'] = $errors;
                header('location: ' . base_url . 'user/update');
            }
        } else {
            $_SESSION['error']['general'] = 'Error al enviar datos';
            header('location: ' . base_url . 'user/update');
        }
    }

    function updatePhoto() {
        Utils::notIssetSession();
        require_once 'views/users/updatePhoto.php';
    }

    function saveUpdatePhoto() {
        Utils::notIssetSession();
        if (isset($_FILES)) {
            $id = $_GET['id'];
            $file = $_FILES['photo'];
            $name_file = $file['name'];
            $type_file = $file['type'];
            $tmp_name_file = $file['tmp_name'];
            if ($type_file == 'image/png' || $type_file == 'image/jpg' || $type_file == 'image/jpeg' || $type_file == "image/tiff" || $type_file == "image/gif") {
                if (!is_dir('uploads/images')) {
                    mkdir('uploads/images', 0777, true);
                }
                move_uploaded_file($tmp_name_file, 'uploads/images/' . $name_file);
                $user = new user();
                $user->setId($id);
                $user->setPhoto($name_file);
                $user->saveUpdatePhoto();
                $_SESSION['user']->photo = $name_file;
                $_SESSION['completed'] = 'Su foto se modifico exitosamente';
                header('location: ' . base_url . 'user/profile');
            } else {
                $_SESSION['error']['photo'] = 'Archivo incorrecto';
                header('location: ' . base_url . 'user/profile');
            }
        } else {
            $_SESSION['error']['photo'] = 'NO se pudo enviar arcrhivo a base de datos';
            header('location: ' . base_url . 'user/profile');
        }
    }

    function allUser() {
        Utils::isAdminOrEmployee();
        $users = TRUE;
        $users = new user();
        $users = $users->allUsers();
        $actUsers = true;
        require_once 'views/users/users.php';
    }

    function searchUser() {
        Utils::isAdminOrEmployee();
        $search = $_POST['search'];
        if (isset($_POST['search'])) {
            $users = new user();
            $users = $users->searchUserBySearch($search);
            require_once 'views/users/users.php';
        }
    }

    function allEmployee() {
        Utils::isAdminOrEmployee();
        $employee = TRUE;
        $users = new user();
        $users = $users->allEmplyee();
        $actEmpl = true;
        require_once 'views/users/users.php';
    }

    function closeSession() {
        Utils::DeleteSession('user');
        Utils::DeleteSession('employee');
        Utils::DeleteSession('admin');
        header("location: " . base_url);
    }

}
