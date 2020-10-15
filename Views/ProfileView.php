<?php require_once("navbar.php");?>

<body>
    <div class="container">
        <!-- Inicio Index -->
        <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
            <div class="col-md-10 text-center m-auto">
                <h1 class="" id="cinemaTitle"><i class="fas fa-user-alt"></i>&nbsp;</i>Mis Datos</h1>
            </div>
            <!-- form -->
            <div class="col-md-10">
                <form action="<?php echo FRONT_ROOT ?>Profile/Index" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <img id="imgProfile" src="<?php echo $_SESSION['User']['Photo']?>" alt="Avatar" height="120" width="120">
                        </div>
                        <div class="form-group col-md-12 text-center">
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#imageProfileModal"><i class="fas fa-upload"></i></i>&nbspCambiar Imagen</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" value=<?php echo ($_SESSION['User']['Email']) ?> id="inputEmail" placeholder="Email" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNombre"><i style="color: red;">&#42&nbsp</i>Nombre</label>
                            <input type="text" name="UserName" value=<?php echo ($_SESSION['User']['UserName']) ?> class="form-control" id="inputNombre" placeholder="Nombre" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputDate"><i style="color: red;">&#42&nbsp</i>Fecha de Nacimiento</label>
                            <input type="date" name="BirthDate" value=<?php echo ($_SESSION['User']['Birthdate']) ?> class="form-control" id="inputDate" placeholder="Fecha de Nacimiento" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputProvincia"><i style="color: red;">&#42&nbsp</i>Género</label>
                        <br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="gender" type="radio" <?php if ($_SESSION['User']['IdGender'] == 1) echo 'checked'; ?> value=<?php echo (1) ?> id="OptionFemenino" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="OptionFemenino">Femenino</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="gender" type="radio" <?php if ($_SESSION['User']['IdGender'] == 2) echo 'checked'; ?> value=<?php echo (2) ?> id="OptionMasculino" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="OptionMasculino">Masculino</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="gender" type="radio" <?php if ($_SESSION['User']['IdGender'] == 3) echo 'checked'; ?> value=<?php echo (3) ?> id="OptionOtros" name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="OptionOtros">Otros</label>
                        </div>
                    </div>
                    <?php require_once("alertMessage.php");?>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbspGuardar cambios</button>
                    <a type="submit" href="<?php echo FRONT_ROOT ?>Home/View" class="btn btn-primary"><i class="fas fa-arrow-left"></i>&nbspVolver</a>
                </form>
                <!-- form -->
            </div>
        </div>
        <!-- Fin Index -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageProfileModal" tabindex="-1" role="dialog" aria-labelledby="imageProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="imageProfileModalLabel">Seleccione una nueva imagen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo FRONT_ROOT ?>Profile/ChangeImageProfile" method="post">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-4 text-center">
                            <button class="imgButton" name="photo" type="submit" value="<?php echo FRONT_ROOT.VIEWS_PATH?>img/boy-1.png">
                                <img class="imgOption" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/boy-1.png" alt="Avatar" height="70" width="70">
                            </button>
                        </div>
                        <div class="col-md-4 text-center">
                            <button class="imgButton" name="photo" type="submit" value="<?php echo FRONT_ROOT.VIEWS_PATH?>img/boy-1.png">
                                <img class="imgOption" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/boy.png" alt="Avatar" height="70" width="70">
                            </button>                        
                        </div>
                        <div class="col-md-4 text-center">
                            <button class="imgButton" name="photo" type="submit" value="<?php echo FRONT_ROOT.VIEWS_PATH?>img/girl-1.png">
                                <img class="imgOption" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/girl-1.png" alt="Avatar" height="70" width="70">
                            </button>                        
                        </div>
                        <div class="col-md-4 text-center">
                            <button class="imgButton" name="photo" type="submit" value="<?php echo FRONT_ROOT.VIEWS_PATH?>img/girl.png">
                                <img class="imgOption" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/girl.png" alt="Avatar" height="70" width="70">
                            </button>                        
                        </div>
                        <div class="col-md-4 text-center">
                            <button class="imgButton" name="photo" type="submit" value="<?php echo FRONT_ROOT.VIEWS_PATH?>img/man-1.png">
                                <img class="imgOption" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/man-1.png" alt="Avatar" height="70" width="70">
                            </button>                        
                        </div>
                        <div class="col-md-4 text-center">
                            <button class="imgButton" name="photo" type="submit" value="<?php echo FRONT_ROOT.VIEWS_PATH?>img/man-2.png">
                                <img class="imgOption" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/man-2.png" alt="Avatar" height="70" width="70">
                            </button>                        
                        </div>
                        <div class="col-md-4 text-center">
                            <button class="imgButton" name="photo" type="submit" value="<?php echo FRONT_ROOT.VIEWS_PATH?>img/man-4.png">
                                <img class="imgOption" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/man-4.png" alt="Avatar" height="70" width="70">
                            </button>                        
                        </div>
                        <div class="col-md-4 text-center">
                            <button class="imgButton" name="photo" type="submit" value="<?php echo FRONT_ROOT.VIEWS_PATH?>img/man.png">
                                <img class="imgOption" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/man.png" alt="Avatar" height="70" width="70">
                            </button>                      
                        </div>
                        <div class="col-md-4 text-center">
                            <button class="imgButton" name="photo" type="submit" value="<?php echo FRONT_ROOT.VIEWS_PATH?>img/other.png">
                                <img class="imgOption" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/other.png" alt="Avatar" height="70" width="70">
                            </button>                        
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Fin Modal -->


</body>

</html>

<style>
    #box {
        margin-top: 2%;
        min-height: 85vh !important;
        border-radius: 25px;
    }

    #imgProfile {
        border-radius: 50%;
        border: 4px solid black;
        background-color: rgba(52, 57, 64, 0.5);
    }

    .imgOption {
        border-radius: 50%;
        border: 4px solid black;
        background-color: rgba(52, 57, 64, 0.5);
    }

    .imgButton{
        background-color: transparent;
        border: none;
        margin-bottom: 5%;
    }
</style>