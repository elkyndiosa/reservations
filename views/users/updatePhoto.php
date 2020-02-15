<div class="container formulario mt-5 d-flex align-items-center justify-content-center">
    <div class="d-flex justify-content-center row w-100">
        <div class="card m-4 col-11 col-md-8 col-lg-5">
            <div class="card-header">
                <h3>Selecciona imagen</h3>
                
            </div>
            <div class="card-body">
                <form action="<?=base_url?>user/saveUpdatePhoto&id=<?=$_SESSION['user']->id?>" method="post" enctype="multipart/form-data">
                    <div class="form-group col-12">
                        <label for="photo">Subir foto aqui:</label>
                        <input type="file" class="form-control" id="password" placeholder="" name="photo" required value="">
                    </div>
                    <div class="form-group d-flex justify-content-center mt-4 ">
                        <input type="submit" value="Cambiar foto" class="btn btn-warning w-50">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>