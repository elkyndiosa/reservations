<div class="row d-flex justify-content-center mt-5 w-100">
    <div class="card col-10 col-sm-6 col-lg-4 d-flex justify-content-around pt-3 mt-5">
        <?php if (!isset($id)): ?>
            <a href="<?= base_url ?>user/updatePhoto" class="position-relative text-right text-light ">Cambiar foto</a>
        <?php endif; ?>

        <?php if (empty($photo)): ?>
            <img class="rounded-circle m-auto " src="<?= base_url ?>assets/img/avatar-man.jpg?>" alt="" width="200">
        <?php else: ?>
            <img class="rounded-circle m-auto " src="<?= base_url ?>uploads/images/<?= $photo ?>" alt="" width="200">
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title w-100 text-center"><?= $user->name ?></h5>
            <p class="card-text w-100 text-center"> <span class="font-weight-bold">Correo: </span><?= $user->email ?></p>
            <p class="card-text w-100 text-center"><span class="font-weight-bold">Celular: </span> <?= $user->phone ?></p>
            <p class="card-text w-100 text-center "><span class="font-weight-bold">Tipo:  </span><?= Utils::showTypeUser($user->rol) ?></p>
            <p class="card-text w-100 text-center"><span class="font-weight-bold">Regitrado en:</span> <?= $user->registration_date ?></p>
        </div>
        <?php if (isset($_SESSION['admin']) || $user->id == $_SESSION['user']->id): ?>
            <div class="card-footer d-flex justify-content-around">
                <a href="<?= base_url ?>user/update<?= $getid ?>" class="btn btn-warning w-50 mx-1"> Editar perfil</a>
            </div>
        <?php endif; ?>
    </div>
    <?php
    echo Utils::showMessage('photo');
    echo Utils::showMessageSusscces();
    Utils::DeleteSession('error');
    Utils::DeleteSession('completed');
    ?>

</div>
