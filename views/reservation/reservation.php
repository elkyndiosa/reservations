<div class="container-fluid my-5 pt-3 px-1 w-100">
<<<<<<< HEAD
    <div class="row w-100 mt-4 mx-0 d-flex justify-content-center">
        <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
=======
    <div class="row mt-4">
        <div class="col-6 d-flex justify-content-start">
>>>>>>> b182c47a3cc28c2e36ebaf1bff11859397ddc290
            <?php if (isset($day)): ?>
                <?php
                if ($day == date('Y-m-d')) {
                    $dateshow = 'hoy';
                } else {
                    $dateshow = $day;
                }
                ?>
                <h2 >Reservas de <?= $dateshow ?></h2>
            <?php else: ?>
                <h2 >Mis reservas</h2>
            <?php endif; ?>
        </div>
        <?php if (isset($_SESSION['admin']) || isset($_SESSION['employee'])): ?>
            <div class="col-11 col-md-6 d-flex justify-content-center justify-content-md-end">
                <form action="<?= base_url ?>reservation/reservation" method="post" class="form-inline d-flex justify-content-around justify-content-md-end">
                    <div class="form-group mr-1">
                        <?php $sites = Utils::getSites(); ?>
                        <select name="site"  class="form-control" >
                            <option value="" selected="">Elige sitio</option>
                            <?php while ($site = $sites->fetch_object()): ?>
                                <option  value="<?= $site->id ?>"><?= $site->name ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group mr-1 " id="box" >
                        <input id="datepicker" type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="search" required>
                    </div>

                    <input type="submit" value="Buscar" class="btn btn-info">
                </form>
                <!--            <a class="btn btn-info m-2 w-25">Prev</a>
                            <a href="<?= $_SERVER['REQUEST_URI'] ?>&daynext" class="btn btn-info m-2 w-25">Next</a>-->
            </div>
        <?php endif; ?>
    </div>

    <div class="row justify-content-around w-100 m-0 border-top my-4 ">
        <?php if ($reservations->num_rows == 0): ?>
            <h1>No hay datos para mostrar </h1>

        <?php endif; ?>
        <?php while ($reserve = $reservations->fetch_object()): ?>
            <?php
            $site = Utils::getSitesForId($reserve->id_site);
            $user = Utils::getUser($reserve->id_users);
            $dis = '';
            if ($reserve->status == 'canceled') {
                $dis = 'disabled';
            }
            ?>
            <div class="card col-11 col-md-5 col-xl-4 rounded w-100 m-1 mt-3" >
                <div class="card-body p-0 py-1 w-100">
                    <div class="row ">
                        <div class="col-3 border-right p-0 d-flex align-items-center flex-wrap text-wrap">
                            <p class="card-text text-wrap m-0"> <?= substr($reserve->reservation_time, 0, 7) ?> </p>
                            <p class="card-text m-0 text-wrap"><?= $site->name ?> </p>
                        </div>
                        <div class="col-9 pr-0">
                            <a href="<?= base_url ?>user/profile&id=<?= $user->id ?>" class="btn text-light card-text m-0 p-0 font-weight-bold text-left"><?= $user->name ?></a> 
                            <p class="card-text m-0">tel: <?= $user->phone ?></p>
                            <p class="card-text m-0"> <?= $user->email ?></p>
                            <p class="card-text m-0"><?= $reserve->people ?> personas | <?= $reserve->reason ?></p>
                            <p class="card-text m-0"><?= $reserve->note ?></p>
                            <a href="<?= base_url ?>user/profile&id=<?= $reserve->id_author ?>" class="btn card-text m-0 text-success p-0">Autor</a>

                            <div class="d-flex justify-content-end col-12 w-100 p-0">
                                <a href="<?= base_url ?>reservation/update&id=<?= $reserve->id ?>" class="btn btn-info btn-sm w-50 m-2 px-1 <?= $dis ?>">Editar</a>
                                <a href="<?= base_url ?>reservation/canceled&id=<?= $reserve->id ?>" class="btn btn-danger btn-sm w-50 m-2 px-1 <?= $dis ?>">Cancelar</a>             
                            </div>
                        </div>
                        <?php if ($reserve->status !== 'active'): ?>
                            <div class="position-absolute rounded" style= "right:5px;top:10px;">
                                <span class="bg-danger p-1 rounded " style="opacity: .7"><?= $reserve->status ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php echo Utils::showMessageSusscces(); ?>
</div>
<?php
Utils::DeleteSession('completed');
?>
<<<<<<< HEAD
=======
<script>
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        container: '#box',
        orientation: 'top right'

    }).datepicker('update', new Date());
</script>
>>>>>>> b182c47a3cc28c2e36ebaf1bff11859397ddc290
