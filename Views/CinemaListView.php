<?php

require_once("navbar.php");
?>

<body>
  <div class="container">
    <!-- Inicio Index -->
    <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
      <div class="col-md-10 text-center m-auto">
        <h1 class="mt-3" id="cinemaTitle"><i class="fas fa-compact-disc"></i>&nbsp;Cines</h1>
      </div>
      <!-- form     -->
      <div class="col-md-10">

        <form action="<?php echo FRONT_ROOT ?>Cinema/Remove" method="">
          <?php
              if(sizeof($cinemaList) != 0) {
          ?>
          <table class="table table-dark text-align-center" style="text-align: center; border-radius: 25px;">
            <thead>
              <tr>
                <th style="width: 20%;">Id Del Cine</th>
                <th style="width: 20%;">Nombre del Cine</th>
                <th style="width: 20%;">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($cinemaList as $cinema) {
                ?>
                <tr>
                  <td><?php echo $cinema->getIdCinema(); ?></td>
                  <td><?php echo $cinema->getCinemaName(); ?></td>
                  <td>
                    <button type="submit" name="idCinema" class="btn btn-danger" value="<?php echo $cinema->getIdCinema() ?>"><i class="fas fa-minus-circle"></i>&nbspEliminar </button>
                    <a id="edit" href = "<?php echo FRONT_ROOT ?>Cinema/ShowEditView ? idCinema =<?php echo $cinema->getIdCinema() ?>" type="button" name="idCinema" class="btn btn-warning"><i class="fas fa-edit"></i>&nbspEditar
                    </a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
          <?php
            } else {
              echo '<h2 class="text-center display-4">No hay Cines disponibles para mostrar</h2>';
            }
          ?>
          <a href = "<?php echo FRONT_ROOT ?>Cinema/ShowAddView"  class="btn btn-success btn-block" ><i class="fas fa-plus-square"></i>&nbspAgregar nuevo cine</a>
          <a href = "<?php echo FRONT_ROOT ?>Home/Index"  class="btn btn-primary btn-block" ><i class="fas fa-arrow-left"></i>&nbspVolver</a>
        </form>
        <!-- form -->
      </div>
    </div>
    <!-- Fin Index -->
  </div>

</body>



<style>
  #box {
    margin-top: 2%;
    min-height: 85vh !important;
    border-radius: 25px;
  }

  .fas fa-minus-circle {
    color: red;

  }
</style>
