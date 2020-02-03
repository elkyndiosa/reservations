<div class="container mt-4 d-flex align-items-center justify-content-center">
    <div class="d-flex justify-content-center row w-100">
        <div class="card card-reserve m-4 col-11 col-md-8 col-lg-5 my-5">
            <div class="card-header">
                <h2><?=$title?></h2>
                <p><?=$text?> </p>
            </div>
            <div class="card-body">
                <form action="<?= $dir ?>" method="POST" class=" row d-flex justify-content-around" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id_user ?>">
                    <div class="form-group col-12">
                        <label for="name">Nombre completo:</label>
                        <input type="text" class="form-control" id="name" placeholder="Ingrese nombre" name="name" required
                               value="<?= isset($_SESSION['user']) && !isset($id) && !isset($_GET['new']) ? $_SESSION['user']->name : '' ?><?= isset($id) ? $user->name : '' ?>">
                    </div>

                    <div class="form-group  col-12">
                        <label for="email">Correo:</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingrese correo" name="email" required value="<?= isset($_SESSION['user']) && !isset($id) && !isset($_GET['new']) ? $_SESSION['user']->email : '' ?><?= isset($id) ? $user->email : '' ?>">
                    </div>
                    <div class="form-group col-sm-6 col-12">
                        <label for="phone">Telefono:</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Ingrese numero de telefono" name="phone" required value="<?= isset($_SESSION['user']) && !isset($id) && !isset($_GET['new']) ? $_SESSION['user']->phone : '' ?><?= isset($id) ? $user->phone : '' ?>">
                    </div>
                    <?php if (isset($_SESSION['admin']) || isset($id)): ?>
                        <?php if (isset($_SESSION['admin']) && !isset($id)&& !isset($_GET['new'])){
                            $user = $_SESSION['user'];
                        } ?>
                        <div class="form-group col-sm-6 col-12">
                            <label for="rol">Rol:</label>
                            <select name="rol"  class="form-control">
                                <option <?= $user->rol == 'user' ? 'selected' : '' ?> value="user">Usuario</option>
                                <option <?= $user->rol == 'employee' ? 'selected' : '' ?> value="employee">Empleado</option>
                                <option <?= $user->rol == 'admin' ? 'selected' : '' ?> value="admin">Administrador</option>
                            </select>
                        </div>
                    <?php endif; ?>
                    <?php if (!isset($_SESSION['user'])): ?>
                        <div class="form-group col-12">
                            <label for="password">COntraseña:</label>
                            <input type="password" class="form-control" id="password" placeholder="Ingrese contraseña" name="password" required value="">
                        </div>
                        <div class="form-group col-12">
                            <label for="photo">Subir foto aqui:</label>
                            <input type="file" class="form-control" id="password" placeholder="" name="photo" value="">
                        </div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-center col-12">
                        <?php if (isset($_SESSION['user']) && !isset($_SESSION['admin'])): ?>
                            <button type="submit" class="btn btn-warning col-8 col-md-4 text-center " >Editar</button>
                        <?php elseif (isset($_SESSION['admin'])): ?>
                            <button type="submit" class="btn btn-warning col-8 col-md-4 text-center " >Agregar</button>
                        <?php elseif (isset($id)): ?>
                            <button type="submit" class="btn btn-warning col-8 col-md-4 text-center " >Editar</button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-warning col-8 col-md-4 text-center " >Registrarse</button>

                        <?php endif; ?>

                    </div>
                </form>     
            </div>

        </div>
    </div>
    <?php echo Utils::showMessage('name') ?>
    <?php echo Utils::showMessage('email') ?>
    <?php echo Utils::showMessage('phone') ?>
    <?php echo Utils::showMessage('password') ?>
    <?php echo Utils::showMessage('photo') ?>
    <?php echo Utils::showMessage('email_used') ?>
</div>
<?php
Utils::DeleteSession('error')?>