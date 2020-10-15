<?php

require_once("navbar.php");
?>

<body>
  <div class="container">
    <!-- Inicio Index -->
    <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
      <div class="col-md-10 text-center m-auto">
        <h1 class="mt-3" id="RoomTitle"><i class="fas fa-id-badge"></i>&nbsp;Salas</h1>
      </div>
      <!-- form     -->
      <div class="col-md-10">

        <form action="<?php echo FRONT_ROOT ?>Room/Remove" method="">
              <?php
                if(sizeof($roomList) != 0) {
              ?>
              <table class="table table-dark text-align-center" style="text-align: center; border-radius: 25px;">
                <thead>
                  <tr>
                    <th style="width: 20%;">Sala</th>
                    <th style="width: 15%;">Capacidad</th>
                    <th style="width: 15%;">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($roomList as $room) {              
                  ?>
                  <tr>
                    <td><?php echo $room->getRoomNumber(); ?></td>
                    <td><?php echo $room->getCapacity() ?></td>
                    <td>
                      <button type="submit" name="idRoom" class="btn btn-danger" value="<?php echo $room->getIdRoom() ?>"><i class="fas fa-minus-circle"></i>&nbspEliminar</button>
                      <a id="edit" href = "<?php echo FRONT_ROOT ?>Room/ShowEditView ? idCinema =<?php echo $room->getIdCinema() ?>" type="button" name="idCinema" class="btn btn-warning"><i class="fas fa-edit"></i>&nbspEditar
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
                  echo '<h2 class="text-center display-4">No hay Salas disponibles para mostrar</h2>';
                }
              ?>
          <a href = "<?php echo FRONT_ROOT ?>Room/ShowAddView"  class="btn btn-success btn-block" ><i class="fas fa-plus-square"></i>&nbspAgregar nueva sala</a>
          <a type="button" href="<?php echo FRONT_ROOT ?>Cinema/ShowListView" class="btn btn-primary btn-block"><i class="fas fa-arrow-left"></i>&nbspVolver a lista de cines</a>
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