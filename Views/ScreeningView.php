<?php require_once("navbar.php"); ?>

<div class="container">
    <!-- Inicio Index -->
    <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
        <div class="col-md-10 text-center m-auto">
            <h1 class="" id="cinemaTitle"><i class="fas fa-film"></i></i></i>Funciones</h1>
        </div>
        <!-- form     -->
        <div id="formBox" class="col-md-10 overflow-auto">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <img id="poster" src="<?php echo $movies->getPhoto();?>" alt="Avatar" width="160" height="160">
                    </div>
                    <div class="form-group col-md-5 align-self-center">
                        <p class="titleData"><i class="fas fa-file-signature">&nbsp</i>Titulo:&nbsp<span class="textData"><?php echo $movies->getMovieName();?></span>
                        </p>
                        <p class="titleData"><i class="fas fa-video">&nbsp</i>Fecha de Salida:&nbsp<span class="textData"><?php echo $movies->getReleaseDate();?>
                            </span></p>
                        <p class="titleData"><i class="fas fa-clock">&nbsp</i>Duracion:&nbsp<span class="textData"><?php echo $movies->getDuration() . " minutos";?>
                            </span></p>
                    </div>
                    <div class="form-group col-md-3 align-self-center">
                        <button id="addScreening" class="btn btn-success btn-block btn-lg" type="button" data-toggle="modal" data-target="#editFunctionModal"
                            title="Agregar una función">+</button>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <h1 id="titleLine">Funciones Actuales</h1>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                    <?php foreach($screenings as $screening) {?>
                        <div class="card bg-light text-black">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p class="ticketText">Fecha:&nbsp
                                            <span class="ticketData">
                                                <?php if($screening->getStartDate() != '-'){
                                                            $date = date_create($screening->getStartDate()); 
                                                            echo date_format($date, 'Y-m-d');
                                                        } else {
                                                            echo $screening->getStartDate();
                                                        }                                                
                                                ?>
                                            </span>
                                        </p>
                                        
                                        <p class="ticketText">Cinema:&nbsp<span class="ticketData"><?php echo $screening->getIdCinema();?></span></p>
                                        <p class="ticketText">Sala:&nbsp<span class="ticketData"><?php echo $screening->getIdRoom();?></span></p>
                                        <p class="ticketText">Dimension:&nbsp<span class="ticketData"><?php echo $screening->getDimension();?></span></p>

                                    </div>
                                    <div class="col-md-5">
                                        <p class="ticketText">Audio:&nbsp<span class="ticketData"><?php echo $screening->getAudio();?></span></p>
                                        <p class="ticketText">Subtitulos:&nbsp<span class="ticketData"><?php echo $screening->getSubtitles();?></span></p>
                                        <p class="ticketText">Horario de inicio:&nbsp<span class="ticketData"><?php echo $screening->getStartHour();?></span>
                                        </p>
                                        <p class="ticketText">Precio:&nbsp<span
                                                class="ticketData"><?php echo $screening->getPrice();?></span></p>
                                    </div>
                                    <div class="col-md-2 align-self-end">
                                        <a id="edit" href = "<?php echo FRONT_ROOT ?>Screening/EditScreening?IdMovieIMDB=<?php echo $movies->getIdMovieIMDB(); ?>" class="btn btn-primary" type="button" data-toggle="modal" data-target="#editFunctionModal"><i class="fas fa-edit"></i></a>
                                        <a id="remove" href = "<?php echo FRONT_ROOT ?>Screening/RemoveFromDataBase?IdScreening=<?php echo $screening->getIdScreening(); ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    </div>
                </div>
            </form>
        </div>
        <!-- form -->
    </div>
    <!-- Fin Index -->
</div>

<!-- Modal -->
<div class="modal fade" id="editFunctionModal" tabindex="-1" role="dialog" aria-labelledby="editFunctionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editFunctionModalLabel">Editar Función</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form action="<?php echo FRONT_ROOT ?>Screening/AddScreeningToDatabase" method="GET">
            <div class="modal-body">
                
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputFechaDesde"><i style="color: red;">&#42&nbsp</i>Fecha desde</label>
                            <input type="date" min = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")));?>" class="form-control" id="inputFechaDesde" name="inputFechaDesde" placeholder="Fecha desde">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputFechaHasta"><i style="color: red;">&#42&nbsp</i>Fecha hasta</label>
                            <input type="date" min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 1 days"));?>" class="form-control" id="inputFechaHasta" name="inputFechaHasta" placeholder="Fecha hasta">
                        </div>
                    </div>
                    <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputFechaDesde"><i style="color: red;">&#42&nbsp</i>Hora de Inicio</label>
                                <input type="time" class="form-control" id="inputHoraInicio" name="inputHoraInicio" placeholder="Hora de Inicio">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPrecio"><i style="color: red;">&#42&nbsp</i>Precio</label>
                                <input type="number" class="form-control" id="inputPrecio" placeholder="Precio" name="price">
                            </div>
                        </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-12">
                            <label for="inputCinema"><i style="color: red;">&#42&nbsp</i>Cinema</label>
                            <select id="inputCinema" name="inputCinema" class="form-control">
                            <option selected>Elije una</option>
                            <?php foreach ($cinemas as $cinema) {?>
                            <option value="<?php echo $cinema->getIdCinema();?>"   ><?php echo $cinema->getCinemaName();?></option>
                            <?php } ?>
                            </select>
                        </div>  
                        <div class="form-group col-md-12">
                            <label for="inputSala"><i style="color: red;">&#42&nbsp</i>Sala</label>
                            <select id="inputSala" name="inputSala" class="form-control">
                            <option selected>Elije una</option>
                            <?php foreach ($rooms as $room) {?>
                            <option value="<?php echo $room->getIdRoom();?>"  ><?php echo $room->getRoomNumber();?></option>
                            <?php } ?>
                            </select>
                        </div>                
                    </div>
                    <div class="form-group">      
                        <label for="inputDimension"><i style="color: red;">&#42&nbsp</i>Dimensión</label>
                        <br>        
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="Option2D" name="dimension" class="custom-control-input" value="2D">
                            <label class="custom-control-label" for="Option2D" value="2D">2D</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="Option3D" name="dimension" class="custom-control-input" value="3D">
                            <label class="custom-control-label" for="Option3D" value="3D">3D</label>
                        </div>
                    </div>
                    <div class="form-group">      
                        <label for="inputAudio"><i style="color: red;">&#42&nbsp</i>Audio</label>
                        <br>        
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="OptionAudioOriginal" name="audio" class="custom-control-input" value="Original">
                            <label class="custom-control-label" for="OptionAudioOriginal" value="Original">Original</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="OptionAudioDoblado" name="audio" class="custom-control-input" value="Doblado">
                            <label class="custom-control-label" for="OptionAudioDoblado" value="Doblado">Doblado</label>
                        </div>
                    </div>
                    <div class="form-group">      
                        <label for="inputSubtitulos"><i style="color: red;">&#42&nbsp</i>Subtitulos</label>
                        <br>        
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="OptionSubtitulosActivados" name="subtitulos" class="custom-control-input" value="Sí">
                            <label class="custom-control-label" for="OptionSubtitulosActivados" value="Sí">Si</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="OptionSubtitulosDesactivados" name="subtitulos" class="custom-control-input" value="No">
                            <label class="custom-control-label" for="OptionSubtitulosDesactivados" value="No">No</label>
                        </div>
                    </div>
                    <input type="hidden" name="idMovieIMDB" value="<?php echo $movies->getIdMovieIMDB(); ?>">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" value = "submit" class="btn btn-success">Guardar cambios</button>
            </div>
        </form>
        </div>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
</body>

</html>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<style>
    h1 {
        margin-top: 2%;
    }

    #formBox {
        min-height: 55vh !important;
        max-height: 55vh !important;
    }

    #box {
        margin-top: 2%;
        min-height: 80vh !important;
        max-height: 80vh !important;
        border-radius: 25px;
    }

    #poster {
        border-style: solid;
        border-color: linear-gradient(to right, #262b33, #707d91, #262b33);
        border-width: 10px;
        border-radius: 10px;
    }

    .titleData {
        font-size: 1.2rem;
        font-weight: 500;
    }

    .textData {
        font-size: 1rem;
        font-weight: 400;
    }

    #titleLine {
        position: relative;
        display: inline-block;
    }

    #titleLine::before,
    #titleLine::after {
        content: ' ';
        display: block;
        position: absolute;
        top: 50%;
        left: -220px;
        width: 200px;
        border-bottom: 1px solid #FFF;
    }

    #titleLine::after {
        left: auto;
        right: -220px;
    }

    .ticketText {
        font-weight: 600;
    }

    .ticketData {
        font-weight: 300;
    }

</style>