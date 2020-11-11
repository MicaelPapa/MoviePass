<?php require_once("navbar.php"); 

?>

<div class="container">
  <!-- Inicio Index -->
  <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
    <div class="col-md-10 text-center m-auto">
      <h1 class="" id="cinemaTitle"><i class="fas fa-shopping-cart"></i>&nbsp;</i>Resumen de compra</h1>
    </div>
    <!-- form-->
    <div class="col-md-10">
      <form action="<?php echo FRONT_ROOT ?>Home/Index" method=""> 
        <div class="form-row">
          <div class="form-group col-md-12">
            <p class="titleData" style="font-size: 24px"><label for="inputPelicula"><br>Película: <?php echo $screening->getMovie()->getMovieName(); ?></label></p>
          </div>
          <div class="form-group col-md-12">
            <p class="titleData" style="font-size: 24px"><label for="inputPelicula">Cine: <?php echo $screening->getCinema()->getCinemaName(); ?></label></p>
          </div>
          <div class="form-group col-md-12">
            <p class="titleData" style="font-size: 24px"><label for="inputPelicula">Sala: <?php echo $screening->getRoom()->getRoomNumber(); ?></label></p>
          </div>
          <div class="form-group col-md-12">
            <p class="titleData" style="font-size: 24px"><label for="inputPelicula">Función: <?php echo date_format(date_create($screening->getStartDate()),"d/m/Y");?> <?php $date = date_create($screening->getStartHour()); echo date_format($date,'h:i:a'); ?></label></p>
          </div>
          <div class="form-group col-md-12">
            <p class="titleData" style="font-size: 24px"><label for="inputCantAsientos">Cantidad de entradas:</label><i style="color: red;"></i><?php echo $purchase->getCantTickets(); ?></p>
          </div>
          <div class="form-group col-md-12">
              <p class="titleData" style="font-size: 24px; display: inline;"><label for="inputCantAsientos">Total:</label><p class="titleData" name="precioTotal" style="font-size: 24px; display: inline;" id="precio"> <?php echo $purchase->getTotal(); ?></p></p>
            
           
         
          </div>
        </div>

        <button type="button" class="btn btn-danger"><i class="fas fa-arrow-left"></i>&nbspVolver</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbspContinuar</button>
      </form>
      <!-- form -->
    </div>
  </div>
  <!-- Fin Index -->
</div>




<style>
  #box {
    margin-top: 2%;
    min-height: 85vh !important;
    border-radius: 25px;
  }
</style>