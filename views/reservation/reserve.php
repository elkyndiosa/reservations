<?php
if (isset($reserve)) {
    $url_form = 'reservation/saveUpdate';
    $title = 'Modificar reserva';
    $p = 'Por favor modifique sus datos. ';
    $submit = 'Modificar';
} else {
    $url_form = 'reservation/saveReserve';
    $title = 'Reservar';
    $p = 'Por favor ingrese datos para reservar.';
    $submit = 'Reservar';
}
?>
<div class="container mt-5 d-flex align-items-center justify-content-center">
    <div class="d-flex justify-content-center row w-100  mt-0" >
        <div class="card card-reserve m-4 col-11 col-md-8 col-lg-5 my-5">
            <div class="card-header">
                <h3><?= $title ?></h3>
                <p><?= $p ?> </p>
            </div>
            <div class="card-body">

                <form action="<?= base_url ?><?= $url_form ?>" method="POST" class="row d-flex justify-content-around">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group col-12  col-md-6 ">
                        <label for="people">Invitados:</label>
                        <select name="people"  class="form-control" required="">
                            <?php for ($i = 1; $i < 150; $i++): ?>
                                <option value="<?= $i ?>" <?= isset($reserve) && $reserve->people == $i ? 'selected' : '' ?>><?= $i ?> Comensal</option>
                            <?php endfor; ?>
                        </select>  
                    </div>
                    <div class="form-group col-12  col-md-6">
                        <label for="reason">Motivo:</label>
                        <select name="reason"  class="form-control">
                            <option value="birthday" <?= isset($reserve) && $reserve->reason == 'birthday' ? 'selected' : ''; ?> >Birthday</option>
                            <option value="Anniversary" <?= isset($reserve) && $reserve->reason == 'Anniversary' ? 'selected' : '' ?>>Anniversary</option>
                            <option value="Disfrutar" <?= isset($reserve) && $reserve->reason == 'Disfrutar' ? 'selected' : '' ?>>Solo disfrutar</option>
                            <option value="Comunion" <?= isset($reserve) && $reserve->reason == 'Comunion' ? 'selected' : '' ?>>Primera comunion</option>
                        </select>
                    </div>
                    <div class="form-group col-12  col-md-6">
                        <?php $sites = Utils::getSites(); ?>

                        <label for="site" >Restaurante:</label>
                        <select name="site"  class="form-control">

                            <?php while ($site = $sites->fetch_object()): ?>
                                <option  value="<?= $site->id ?>" <?= isset($reserve) && $reserve->id_site == $site->id ? 'selected' : '' ?>><?= $site->name ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group col-12 date  col-md-6 " id="box" data-date-format="dd-mm-yyyy">
                        <label for="datepicker">Dia de reserva:</label>
                        <input id="datepicker" type="text" class="form-control" value="<?= date('Y-m-d') ?>" name="datepicker" required>
                    </div>
                    <div class="form-group col-12  col-md-6">
                        <label for="time_reserve">Hora de reserva:</label>
                        <select name="time_reserve"  class="form-control" required="">
                            <option value="11:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>11:00 am</option>
                            <option value="11:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>11:30 am</option>
                            <option value="12:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>12:00 pm</option>
                            <option value="12:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>12:30 pm</option>
                            <option value="13:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>1:00 pm</option>
                            <option value="13:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>1:30 pm</option>
                            <option value="14:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>2:00 pm</option>
                            <option value="14:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>2:30 pm</option>
                            <option value="15:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>3:00 pm</option>
                            <option value="15:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>3:30 pm</option>
                            <option value="16:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>4:00 pm</option>
                            <option value="16:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>4:30 pm</option>
                            <option value="17:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>5:00 pm</option>
                            <option value="17:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>5:30 pm</option>
                            <option value="18:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>6:00 pm</option>
                            <option value="18:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>6:30 pm</option>
                            <option value="19:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>7:00 pm</option>
                            <option value="19:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>7:30 pm</option>
                            <option value="20:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>8:00 pm</option>
                            <option value="20:30" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>8:30 pm</option>
                            <option value="21:00" <?= isset($reserve) && $reserve->reservation_time == '11:00' ? 'selected' : '' ?>>9:00 pm</option>
                        </select>
                    </div>
                    <div class=" form-group col-12">
                        <label for="note">Agregar nota</label>
                        <input type="text" class="form-control" placeholder="Agregar comentario" name="note" id="note">
                    </div>

                    <div class="d-flex justify-content-center col-12">
                        <button type="submit" class="btn btn-warning col-4 text-center " ><?= $submit ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <?php echo Utils::showMessage('people'); ?>
    <?php echo Utils::showMessage('reason'); ?>
    <?php echo Utils::showMessage('date'); ?>
    <?php echo Utils::showMessage('time'); ?>
    <?php echo Utils::showMessage('general'); ?>
    <?php echo Utils::showMessageSusscces(); ?>
</div>
<?php Utils::DeleteSession('error'); ?>
<?php Utils::DeleteSession('completed'); ?>
<script>
    $('#datepicker').datepicker({
        format: 'dd \\ mm \\ yyyy',
        todayHighlight: true,
        autoclose: true,
        container: '#box',
        orientation: 'top right'

    }).datepicker('update', new Date());
</script>

