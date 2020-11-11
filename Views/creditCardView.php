<?php require_once("navbar.php"); ?>

<div class="container">
  <!-- Inicio Index -->
  <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
    <div class="col-md-10 text-center m-auto">
      <h1 class="" id="cinemaTitle"><i class="fas fa-shopping-cart"></i>&nbsp;</i>Complete la forma de pago</h1>
    </div>
    <!-- form-->
    <div class="col-md-10">
      <form action="<?php echo FRONT_ROOT ?>Purchase/ValidatePay" method="post">
        <div class="form-row">
            <?php require_once("alertMessage.php"); ?>
          <div class="form-group col-md-12">
            <label for="inputNomre"><i style="color: red;">&#42&nbsp</i>Nombre</label>
            <input type="text" id="nombre" pattern="[A-Za-z]+" class="form-control" name="nombreTarjeta" placeholder="Nombre del Titular" required>
          </div>
          <div class="form-group col-md-12">
            <label for="inputApellido"><i style="color: red;">&#42&nbsp</i>Apellido</label>
            <input type="text" id="apellido" pattern="[A-Za-z]+" class="form-control" name="apellidoTarjeta" placeholder="Apellido del Titular" required>
          </div>
          <div class="form-group col-md-12">
            <label for="inputNumero"><i style="color: red;">&#42&nbsp</i>Numero</label>
            <input type="number" min=10000000 id="numero" max=99999999 class="form-control" name="numeroTarjeta"  placeholder="Numero" required>
          </div>
          <div class="form-group col-md-12">
            <label for="inputCVC"><i style="color: red;">&#42&nbsp</i>Codigo de seguridad</label>
            <input type="number" id="cvc" min=100 max=999  class="form-control" name="codSeguridad" placeholder="Codigo de seguridad" required>
          </div>
          <div class="form-group col-md-12">
            <label for="inputDate"><i style="color: red;">&#42&nbsp</i>Vencimiento</label>
              <input type="number" id="month" name="month" placeholder="MM" max=12 min=01 /> /
              <input type="number" od="year" name="year" placeholder="YYYY" maxlength=2100 min=2020 />
          </div>
        </div>
        <input type="hidden" name="cantEntradas"  value="<?php echo $cantEntradas; ?>" >
        <input type="hidden" name="idScreening"  value="<?php echo $idScreening; ?>" >
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
    if(document.getElementById("vencimiento").value.length == 6){
      debugger;
      //document.getElementById("vencimiento").value = document.getElementById("vencimiento").value + "/";
      document.getElementById("vencimiento").value = [document.getElementById("vencimiento").value.slice(0, 2), "/", document.getElementById("vencimiento").value.slice(2)].join('');
      }
   }

      var nombre = document.getElementById("nombre");
        nombre.addEventListener("keyup", function (event) {
        if (nombre.validity.patternMismatch) {
          nombre.setCustomValidity("Ingrese un nombre válido.");
        } else {
          nombre.setCustomValidity("");
        }
      });

      var apellido = document.getElementById("apellido");
      apellido.addEventListener("keyup", function (event) {
      if (apellido.validity.patternMismatch) {
        apellido.setCustomValidity("Ingrese un apellido válido.");
      } else {
        apellido.setCustomValidity("");
      }
      });
   
      var numero = document.getElementById("numero");
      numero.addEventListener("keyup", function (event) {
      if (numero.validity.rangeOverflow) {
        numero.setCustomValidity("Ingrese un número de tarjeta válido (debe ser de 16 dígitos).");
      } else {
        numero.setCustomValidity("");
      }
      });

      var cvc = document.getElementById("cvc");
      cvc.addEventListener("keyup", function (event) {
      if (cvc.validity.rangeOverflow || cvc.validity.rangeUnderflow) {
        cvc.setCustomValidity("Ingrese un código de seguridad válido (debe ser de 3 dígitos).");
      } else {
        cvc.setCustomValidity("");
      }
      });

      var month = document.getElementById("month");
      month.addEventListener("keyup", function (event) {
      if (month.validity.rangeOverflow || month.validity.rangeUnderflow) {
        month.setCustomValidity("Ingrese un mes válido (entre 01 y 12).");
      } else {
        month.setCustomValidity("");
      }
      });

      var year = document.getElementById("year");
      year.addEventListener("keyup", function (event) {
      if (year.validity.rangeOverflow || year.validity.rangeUnderflow) {
        year.setCustomValidity("Ingrese un año válido.");
      } else {
        year.setCustomValidity("");
      }
      });
     
</script>

<style>
  #box {
    margin-top: 2%;
    min-height: 85vh !important;
    border-radius: 25px;
  }
</style>