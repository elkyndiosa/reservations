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
                    <div class="form-group col-12 date  col-md-6 " id="box" >
                        <label for="datepicker">Dia de reserva:</label>
                        <input id="datepicker" type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date_reserve" required>
                    </div>
                    <div class="form-group col-12  col-md-6">
                        <label for="time_reserve">Hora de reserva:</label>
                        <select name="time_reserve"  class="form-control" required="">
                            <option value="11:00am" <?= isset($reserve) && $reserve->reservation_time == '11:00am' ? 'selected' : '' ?>>11:00 am</option>
                            <option value="11:30am" <?= isset($reserve) && $reserve->reservation_time == '11:30a,' ? 'selected' : '' ?>>11:30 am</option>
                            <option value="12:00pm" <?= isset($reserve) && $reserve->reservation_time == '12:00pm' ? 'selected' : '' ?>>12:00 pm</option>
                            <option value="12:30pm" <?= isset($reserve) && $reserve->reservation_time == '12:30pm' ? 'selected' : '' ?>>12:30 pm</option>
                            <option value="1:00pm" <?= isset($reserve) && $reserve->reservation_time == '1:00pm' ? 'selected' : '' ?>>1:00 pm</option>
                            <option value="1:30pm" <?= isset($reserve) && $reserve->reservation_time == '1:30pm' ? 'selected' : '' ?>>1:30 pm</option>
                            <option value="2:00pm" <?= isset($reserve) && $reserve->reservation_time == '2:00pm' ? 'selected' : '' ?>>2:00 pm</option>
                            <option value="2:30pm" <?= isset($reserve) && $reserve->reservation_time == '2:30pm' ? 'selected' : '' ?>>2:30 pm</option>
                            <option value="3:00pm" <?= isset($reserve) && $reserve->reservation_time == '3:00pm' ? 'selected' : '' ?>>3:00 pm</option>
                            <option value="3:30pm" <?= isset($reserve) && $reserve->reservation_time == '3:30pm' ? 'selected' : '' ?>>3:30 pm</option>
                            <option value="4:00pm" <?= isset($reserve) && $reserve->reservation_time == '4:00pm' ? 'selected' : '' ?>>4:00 pm</option>
                            <option value="4:30pm" <?= isset($reserve) && $reserve->reservation_time == '4:30pm' ? 'selected' : '' ?>>4:30 pm</option>
                            <option value="5:00pm" <?= isset($reserve) && $reserve->reservation_time == '5:00pm' ? 'selected' : '' ?>>5:00 pm</option>
                            <option value="5:30pm" <?= isset($reserve) && $reserve->reservation_time == '5:30pm' ? 'selected' : '' ?>>5:30 pm</option>
                            <option value="6:00pm" <?= isset($reserve) && $reserve->reservation_time == '6:00pm' ? 'selected' : '' ?>>6:00 pm</option>
                            <option value="6:30pm" <?= isset($reserve) && $reserve->reservation_time == '6:30pm' ? 'selected' : '' ?>>6:30 pm</option>
                            <option value="7:00pm" <?= isset($reserve) && $reserve->reservation_time == '7:00pm' ? 'selected' : '' ?>>7:00 pm</option>
                            <option value="7:30pm" <?= isset($reserve) && $reserve->reservation_time == '7:30pm' ? 'selected' : '' ?>>7:30 pm</option>
                            <option value="8:00pm" <?= isset($reserve) && $reserve->reservation_time == '8:00pm' ? 'selected' : '' ?>>8:00 pm</option>
                            <option value="8:30pm" <?= isset($reserve) && $reserve->reservation_time == '8:30pm' ? 'selected' : '' ?>>8:30 pm</option>
                            <option value="9:00pm" <?= isset($reserve) && $reserve->reservation_time == '9:00pm' ? 'selected' : '' ?>>9:00 pm</option>
                        </select>
                    </div>
                    <div class=" form-group col-12">
                        <label for="note">Agregar nota</label>
                        <input type="text" class="form-control" placeholder="Agregar comentario" name="note" id="note">
                    </div>

                    <div class="d-flex justify-content-center col-12">
                        <button type="submit" class="btn btn-warning col-8 col-sm-4 text-center " ><?= $submit ?></button>
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
