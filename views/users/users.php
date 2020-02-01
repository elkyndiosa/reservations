<?php if (isset($employee)): ?>
    <h3 class="w-100 text-center text-dark">Empleados</h3>
<?php else: ?>
    <h3 class="w-100 text-center text-dark">Clientes</h3>
<?php endif; ?>
<div class="d-flex justify-content-around align-items-center flex-wrap mt-5 mb-3 ">
    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start flex-wrap">
        <a href="<?= base_url ?>user/allEmployee" class="btn btn-warning w-auto mx-1">Empleados</a>
        <a href="<?= base_url ?>user/allUser" class="btn btn-warning w-auto mx-1">Clientes</a>
        <a href="<?= base_url ?>user/signin&new" class="btn btn-warning w-auto  mx-1">Nuevo usuario </a>
    </div>
    <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-end mt-2 mt-md-0">
        
        <form action="<?=base_url?>user/searchUser" method="post" class="form-inline d-flex flex-nowrap">
            <input type="text" placeholder="Buscar por nombre" class="form-control mr-1 col-8" name="search">
            <button type="submit" class="btn btn-warning text-center col-4" >Buscar</button>
        </form>

    </div>
</div>
<div class="row w-100 d-flex justify-content-center m-0">
    <?php while ($user = $users->fetch_object()): ?>
        <div class="col-11 col-lg-5 d-flex justify-content-around bg-info rounded py-2 mx-4 my-1 w-100">
            <div class="col-2 d-flex justify-content-center align-items-center">
                <?php if ($user->photo == NULL): ?>
                    <img class="rounded-circle" src="<?= base_url ?>assets/img/avatar-man.jpg" alt="" width="50">
                <?php else : ?>
                    <img class="rounded-circle" src="<?= base_url ?>uploads/images/<?= $user->photo ?>" alt="" width="50">
                <?php endif; ?>
            </div>
            <div class="col-7">
                <div class="col-12">
                    <a href="<?= base_url ?>user/profile&id=<?= $user->id ?>" class="btn text-light card-text m-0 p-0 font-weight-bold"><?= substr($user->name, 0, 30) ?></a>
                </div>
                <div class="col-12">
                    <p class="m-0"><?= $user->email ?></p>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
                <?php if (!isset($employee)): ?>
                    <a href="<?= base_url ?>reservation/reserve&id=<?= $user->id ?>" class="btn btn-warning w-auto btn-sm mr-1">Reservar</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
    <?php echo Utils::showMessageSusscces(); ?>
    <?php echo Utils::showMessage('email_used') ?>

</div>
<?php Utils::DeleteSession('completed'); ?>
<?php Utils::DeleteSession('error'); ?>