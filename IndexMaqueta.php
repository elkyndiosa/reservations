<!doctype html>
<html lang="es">
    <head>

        <link rel="stylesheet" href="assets/css/style2.css">
        <meta charset="UTF-8">
        <title>Reservation</title>
        <link rel="stylesheet" href="assets/css/style2.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="js/efectos.js"></script>
    </head> 
    <body>
        <?php if (isset($_SESSION['usuario'])) : ?>
            <nav class="navbar navbar-expand-sm bg-transparent navbar-dark fixed-top ">
                <a class="navbar-brand" href="#">Resrvations</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end mr-4" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="editar.php">Hola, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'] ?></a>
                        </li> 
                        <?php if ($_SESSION['usuario']['tipo'] == 'admin' || $_SESSION['usuario']['tipo'] == 'empleado'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="reservas.php">Reservas</a>
                            </li>
                        <?php endif; ?>
                        <?php if ($_SESSION['usuario']['tipo'] == 'cliente') : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="historial.php">Historial</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="reservar.php">Reservar</a>
                        </li> 

                        <li class="nav-item">
                            <a class="nav-link" href="editar.php">Editar perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="includes/cerrarsesion.php">Salir</a>
                        </li>
                    </ul>
                    <?php if ($_SESSION['usuario']['tipo'] == 'admin' || $_SESSION['usuario']['tipo'] == 'empleado'): ?>

                        <form class="form-inline" action="buscar.php" method="post">
                            <input class="form-control mr-sm-2" type="date" name="buscar">
                            <button class="btn btn-success" type="submit">Buscar</button>
                        </form>
                    <?php endif; ?>
                </div>

            </nav>
        <?php endif; ?>
        <div class="container login">
            <div class="mb-5 d-flex justify-content-center h-100 row">
                <div class="card mt-4 col-4">
                    <div class="card-header">
                        <h3>Registrase</h3>
                        <div class="d-flex justify-content-end social_icon">
                            <span><i class="fab fa-facebook-square ico"></i></span>
                            <span><i class="fab fa-google-plus-square ico"></i></span>
                            <span><i class="fab fa-twitter-square ico"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <div class="input-group form-group">
                                <div class="input-group-prepend btn-warning rounded-left">
                                    <span class="input-group-text"><i class="fas fa-user ico"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Correo de usuario" name="email" id="email">

                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend btn-warning rounded-left">
                                    <span class="input-group-text"><i class="fas fa-key ico"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Contraseña" name="contraseña">
                            </div>
                            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'contraseña') : ''; ?>
                            <div class="row align-items-center remember">
                                <input type="checkbox">Recordarme
                            </div>
                            <div class="form-group d-flex justify-content-center mt-4 ">
                                <input type="submit" value="Entrar" class="btn btn-warning w-50">
                            </div>
                            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'general') : ''; ?>
                            <?php // borrarErrores(); ?>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center links">
                            ¿No tienes cuenta? <a href="registrarse.php"> Registrate</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="#">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('[data-toggle="popover"]').popover();
            });
        </script>
        <footer class="container-fluid bg-dark mb-0 py-2 fixed-bottom">
            <p class="mb-0 text-center text-light">Copyright 2019 - Desarrollado por Gustavo Diosa</p>
        </footer>
    </body>
</html>