<?php require_once("navbar.php"); ?>

<div class="container">
  <!-- Inicio Index -->
  <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
    <div class="col-md-10 text-center m-auto">
      <h1 class="" id="cinemaTitle"><i class="fas fa-shopping-cart"></i>&nbsp;</i>Complete la forma de pago</h1>
    </div>
    <!-- form-->
    <div class="col-md-10">
      <form action="<?php echo FRONT_ROOT ?>Purchase/VerifyCreditCard" method="post">
        <div class="form-row">
            <?php require_once("alertMessage.php"); ?>
          <div class="form-group col-md-12">
            <label for="inputPelicula"><i style="color: red;">&#42&nbsp</i>Numero</label>
            <input type="number"  class="form-control" name="numeroTarjeta"  placeholder="Numero" required>
          </div>
          <div class="form-group col-md-12">
            <label for="inputCine"><i style="color: red;">&#42&nbsp</i>Codigo de seguridad</label>
            <input type="text" minlength=3 maxlength= 3  class="form-control" name="codSeguridad" placeholder="Codigo de seguridad" required>
          </div>
          <div class="form-group col-md-12">
            <label for="inputFuncion"><i style="color: red;">&#42&nbsp</i>Vencimiento</label>
            <input type="tel" onchange="formatDate()" id="vencimiento" minlength="5" maxlength="9" pattern="^(0[1-9]|1[0-2])( )?\/( )?([2][0]\d{2}|\d{2})$"  class="form-control" name="vencimiento" placeholder="Fecha de vencimiento" required>
          </div>
          <div class="form-group col-md-12">
            <label for="inputCantAsientos"><i style="color: red;">&#42&nbsp</i>Nombre</label>
            <input type="text"  class="form-control" name="nombreTarjeta" placeholder="Nombre del Titular" required>
          </div>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbspContinuar</button>
        <button type="button" class="btn btn-danger"><i class="fas fa-arrow-left"></i>&nbspVolver</button>
      </form>
      <!-- form -->
    </div>
  </div>
  <!-- Fin Index -->
</div>

<script>
   function formatDate() {
    debugger;
    if(document.getElementById("vencimiento").value.length == 2){
      debugger;
      document.getElementById("vencimiento").value = document.getElementById("vencimiento").value + "/";
    }
    
}
</script>

<style>
  #box {
    margin-top: 2%;
    min-height: 85vh !important;
    border-radius: 25px;
  }
</style>