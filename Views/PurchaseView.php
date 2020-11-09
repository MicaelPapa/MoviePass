<?php require_once("navbar.php"); 

?>

<div class="container">
  <!-- Inicio Index -->
  <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
    <div class="col-md-10 text-center m-auto">
      <h1 class="" id="cinemaTitle"><i class="fas fa-shopping-cart"></i>&nbsp;</i>Comprar Entradas</h1>
    </div>
    <!-- form-->
    <div class="col-md-10">
      <form action="<?php echo FRONT_ROOT ?>Purchase/ViewCreditCard" method="post">
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
            <p class="titleData" style="font-size: 24px"><label for="inputCantAsientos">Cantidad de asientos</label><i style="color: red;">&#42&nbsp</i>: <input type="number" style="width: 7%; display: inline;" id="cantidadDeAsientos" onchange="onSum(<?php echo $screening->getPrice(); ?>)" name="inputCantAsientos"  max="<?php echo $screening->getRemainTickets(); ?>" min="1" class="form-control" value="1" required></p>
          </div>
          <div class="form-group col-md-12">
              <p class="titleData" style="font-size: 24px; display: inline;"><label for="inputCantAsientos">Precio Total:</label><p class="titleData" name="precioTotal" style="font-size: 24px; display: inline;" id="precio"> <?php echo $screening->getPrice(); ?></p></p>
              <input type="hidden" name="precioTotal" id="precioTotal" value="<?php echo $screening->getPrice(); ?>" >
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


<script>
 
   function onSum($precio) {
    document.getElementById("precio").textContent =" " + $precio * document.getElementById("cantidadDeAsientos").value;
    document.getElementById("precioTotal").value = $precio * document.getElementById("cantidadDeAsientos").value;
}


</script>

<style>
  #box {
    margin-top: 2%;
    min-height: 85vh !important;
    border-radius: 25px;
  }
</style>