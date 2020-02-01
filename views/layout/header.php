<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reservation</title>
        <link rel="stylesheet" href="<?= base_url ?>assets/css/style2.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type ="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

        <link rel="stylesheet" type="text/css" href="<?= base_url ?>assets/css/overhang.min.css"/>
    </head> 
    <body class="bg-dark">

        <nav class="navbar navbar-expand-lg bg-info navbar-dark ">
            <?php if (isset($_SESSION['user'])): ?>
            <p class="navbar-brand text-left" ><?=  substr($_SESSION['user']->name, 0, 20)?></p>
            <?php else: ?>
                <h3 class="navbar-brand" >Ingresa tus datos</h3>
            <?php endif; ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end mr-4" id="collapsibleNavbar">
                <?php if (isset($_SESSION['user'])): ?>
                    <ul class="navbar-nav ">
                        <!--MENU FOR USERS - EMPLOYEE - ADMIN-->
                        <li class="nav-item">
                            <a class="nav-link mx-4 mx-lg-0" href="<?= base_url ?>reservation/reserve">Reservar</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link mx-4 mx-lg-0" href="<?= base_url ?>reservation/myreservations">Mis reservas</a>
                        </li>
                        <!--MENU FOR EMPLOYEE AND ADMIN-->
                        <?php if (isset($_SESSION['employee']) || isset($_SESSION['admin'])): ?>
                            <li class="nav-item">
                                <a class="nav-link mx-4 mx-lg-0" href="<?= base_url ?>reservation/reservation">Gestionar reservas</a>
                            </li>
                        <?php endif; ?>
                        <!--MENU FOR ADMIN-->
                        <?php if (isset($_SESSION['admin'])): ?>
                            <li class="nav-item">
                                <a class="nav-link mx-4 mx-lg-0" href="<?= base_url ?>user/allUser">Gestionar Usuarios</a>
                            </li> 
                            <!--                            <li class="nav-item">
                                                            <a class="nav-link mx-4 mx-lg-0" href="reservar.php">Gestion de usuarios</a>
                                                        </li> -->
                            <!--                            <li class="nav-item">
                                                            <a class="nav-link mx-4 mx-lg-0" href="reservar.php">Subir publicidad</a>
                                                        </li> -->
                        <?php endif; ?>
                        <!--MENU FOR ALL-->
                        <li class="nav-item">
                            <a class="nav-link mx-4 mx-lg-0" href="<?= base_url ?>user/profile">Mi perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-4 mx-lg-0" href="<?= base_url ?>user/closeSession">Salir</a>
                        </li>
                        <!--                        <li class="nav-item">
                                                    <form class="form-inline d-flex justify-content-around mt-3 mt-md-0" action="buscar.php" method="post">
                                                        <input class="form-control mr-sm-2   col-6" type="text" name="buscar">
                                                        <button class="btn btn-success text-center  col-5" type="submit">Buscar</button>
                                                    </form>
                                                </li>-->
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
