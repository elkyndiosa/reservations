<div class="container formulario mt-5 d-flex align-items-center justify-content-center">
    <div class="d-flex justify-content-center row w-100">
        <div class="card m-4 col-11 col-md-8 col-lg-5">
            <div class="card-header">
                <h3>Registrase</h3>

            </div>
            <div class="card-body">
                <form action="<?= base_url ?>user/login" method="post">
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
                        <input type="password" class="form-control" placeholder="Contraseña" name="password">
                    </div>
                    <!--                            <div class="row align-items-center remember">
                                                    <input type="checkbox">Recordarme
                                                </div>-->
                    <div class="form-group d-flex justify-content-center mt-4 ">
                        <input type="submit" value="Entrar" class="btn btn-warning w-50">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    ¿No tienes cuenta? <a href="<?= base_url ?>user/signin"> Registrate</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
    <?php echo Utils::showMessage('pass');?>
    <?php echo Utils::showMessage('email'); ?>

</div



<?php Utils::DeleteSession('error'); ?>