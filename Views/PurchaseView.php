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
            <label for="inputPelicula"><i style="color: red;">&#42&nbsp</i>Pelicula</label>
            <select id="inputPelicula" name="inputPelicula" class="form-control" required>
            <?php if (isset($screening)) { echo '<option value="' . $screening->getMovie()->getIdMovie() . '">' . $screening->getMovie()->getMovieName() . '</option>';} 
            else{ echo("<option value=''>Elija una...</option>");}?>
            <?php if (isset($movies)) {
                foreach ($movies as $movie) {
                  echo '<option value="' . $movie->getIdMovie() . '">' . $movie->getMovieName() . '</option>';
                }
              } ?>
            </select>
          </div>
          <div class="form-group col-md-12">
          <p class="titleData" style="font-size: 32px">&nbsp</i><?php echo $movie->getMovieName();?>&nbsp</p>
            <label for="inputCine"><i style="color: red;">&#42&nbsp</i>Cine</label>
      
          </div>
          <div class="form-group col-md-12">
            <label for="inputFuncion"><i style="color: red;">&#42&nbsp</i>Funcion</label>
            <select id="inputFuncion" name="inputFuncion" class="form-control" required>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="inputCantAsientos"><i style="color: red;">&#42&nbsp</i>Cantidad de asientos</label>
            <input type="number" name="inputCantAsientos"  max="<?php echo $screening->getRemainTickets(); ?>" min="1" class="form-control" id="inputCantAsientos" placeholder="Cantidad de asientos" required>
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
 
 $(document).ready(function(){
  
  var idMovieFunc;

  $("#inputCine").prop('disabled', true);
  $("#inputFuncion").prop('disabled', true);

  function loadCinemas(pelicula, datos){

      var url = <?php echo FRONT_ROOT ?> + "Purchase/LoadCinemas";        
      var cines = $("#inputCine");

      if(pelicula.val() != '') {

        $.ajax({ 
          url: url,
          method: 'POST',
          data: datos,
          context: 'document.body',
          beforeSend: function () 
          {
              pelicula.prop('disabled', true);
          },
          success:  function (r) 
          {
              pelicula.prop('disabled', false);
              // Limpiamos el select
              cines.find('option').remove();
              cines.append("<option value=''>Elija uno...</option>");

              var jsonText = r.substring(r.indexOf('$')+1 ,r.indexOf('%'));
              var json = JSON.parse(jsonText);

              $(json).each(function(i, v){ 
                  cines.append('<option value="' + v.idcinema + '">' + v.cinemaname + '</option>');
              })

              cines.prop('disabled', false);
          },
          error: function(jqXHR, textStatus )
          {
              alert('Ocurrio un error en el servidor: ' + textStatus);
              pelicula.prop('disabled', false);
          }

        });
      }  
      else
      {
          cines.find('option').remove();
          cines.prop('disabled', true);
      }
  }

  function loadFunciones(cine, datos){

    var url = <?php echo FRONT_ROOT ?> + "Purchase/LoadFunciones";        
    var funciones = $("#inputFuncion");

    if(cine.val() != '') {

      $.ajax({ 
        url: url,
        method: 'POST',
        data: datos,
        context: 'document.body',
        beforeSend: function () 
        {
          cine.prop('disabled', true);
        },
        success:  function (r) 
        {
            cine.prop('disabled', false);
            // Limpiamos el select
            funciones.find('option').remove();
            funciones.append("<option value=''>Elija una...</option>");

            var jsonText = r.substring(r.indexOf('$')+1 ,r.indexOf('%'));
            var json = JSON.parse(jsonText);
            console.log(json);
            
            $(json).each(function(i, v){ 
                funciones.append('<option value="' + v.idscreening + '">' + 'Fecha: ' + v.StartDate + ' Hora: ' + v.starthour + '</option>');
            })

            funciones.prop('disabled', false);
        },
        error: function(jqXHR, textStatus )
        {
            alert('Ocurrio un error en el servidor: ' + textStatus);
            cine.prop('disabled', false);
        }

      });
    }  
    else
    {
        funciones.find('option').remove();
        funciones.prop('disabled', true);
    }
  }

  $('#inputPelicula').change(function() {

    var id = $(this).val();
    var datos = { idMovie: id };
    idMovieFunc = id;
    var pelicula = $("#inputPelicula");

    loadCinemas(pelicula, datos);

  });

  $('#inputCine').change(function() {

    var id = $(this).val();
    var datos = { idMovie: idMovieFunc, idCinema: id };
    var cine = $("#inputCine");

    loadFunciones(cine, datos);

  });

});

</script>

<style>
  #box {
    margin-top: 2%;
    min-height: 85vh !important;
    border-radius: 25px;
  }
</style>