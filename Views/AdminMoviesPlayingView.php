<?php require_once("navbar.php"); ?>
<?php require_once("alertMessage.php"); ?>

<div id="box" class="container" style="background-color: rgba(255, 255, 255, 0.5);">
  <div class="row" class="form-inline">
    <div class="col-md-4">
      <form id="searchBox" action="<?php echo FRONT_ROOT ?> Movies/ShowApiMovies" method="POST">
        <div class="form-row justify-content-center">
          <div class="form-group col-md-6">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
              </div>
              <input type="hidden" name="alertMessage" value="" />
              <input type="hidden" name="alertType" value="" />
              <input type="hidden" name="filterName" value="filterName" />
              <input id="inputSearch" type="search" name="searchName" class="form-control" placeholder="Buscar" aria-label="Buscar" aria-describedby="basic-addon1">
              <input type="hidden" name="idCinema" value="<?php echo $idCinema ?>" />
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-4">
      <form id="selectGenre" action="<?php echo FRONT_ROOT ?>Movies/ShowApiMovies" method="POST">
        <div class="form-row justify-content-center">
          <div class="form-group col-md-12">

            <input type="hidden" name="alertMessage" value="" />
            <input type="hidden" name="alertType" value="" />
            <input type="hidden" name="filterGenres" value="filterGenres" />

            <select id="selectGenre" name="selectGenres" class="custom-select">
              <option value="0">Selecciona el Género</option>
              <?php foreach ($genreList as $genre) { ?>
                <option value="<?php echo $genre->getIdIMDB(); ?>"><?php echo $genre->getName(); ?></option>
              <?php } ?>
            </select>
            <input type="hidden" name="idCinema" value="<?php echo $idCinema ?>" />
            <button type="submit" class="btn btn-succes" name="filtrar" id="submitGenre"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <?php foreach ($movieList as $movie) { ?>
      <div class="col-md-3">
        <div class="flip-card movieBoxes">
          <div class="flip-card-inner">
            <div class="flip-card-front">
              <img src="<?php echo $movie->getPhoto() ?>" alt="Avatar" style="width:100%;height:100%;">
            </div>
            <div class="flip-card-back">
              <h1> <?php echo $movie->getMovieName(); ?> </h1>
              <p><?php echo $movie->getReleaseDate(); ?></p>
              <?php if ($movie->getIsPlaying() == false) { ?>
                <p><a id="addMovie" href="<?php echo FRONT_ROOT ?>Movies/AddMovieToDatabase?IdCinema=<?php echo $idCinema; ?> &IdMovieIMDB=<?php echo $movie->getIdMovieIMDB(); ?>"><button id="add" class="button">Agregar Pelicula</button></a></p>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
</div>


<style>
  body {
    height: 100%;
    max-height: 100vh;
    margin: 0;
  }


  #box {
    min-height: 100vh !important;
    height: auto !important;
    margin-bottom: 10%;
    margin-top: 5%;
    border-radius: 25px;

  }

  h1 {
    font-size: 20px;
    margin-top: 10%;
  }

  .flip-card {
    background-color: transparent;
    width: 200px;
    height: 250px;
    /* border: 1px solid #f1f1f1; */

    perspective: 1000px;
    /* Remove this if you don't want the 3D effect */
  }

  /* This container is needed to position the front and back side */
  .flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.8s;
    transform-style: preserve-3d;
    border-style: solid;
    border-color: linear-gradient(to right, #262b33, #707d91, #262b33);
    border-width: 10px;
    border-radius: 10px;
  }

  /* Do an horizontal flip when you move the mouse over the flip box container */
  .flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
  }

  /* Position the front and back side */
  .flip-card-front,
  .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
  }

  /* Style the front side (fallback if image is missing) */
  .flip-card-front {
    background-color: #bbb;
    color: black;
  }

  /* Style the back side */
  .flip-card-back {
    background-color: rgba(88, 88, 88, 0.534);
    color: white;
    font-size-adjust: small;
    transform: rotateY(180deg);
  }

  .container {
    min-height: 100vh;
    height: 100% !important;
    width: 100%;
  }

  .movieBoxes {
    margin-left: 7%;
    width: 85%;
    padding: 10px;
    margin-bottom: 10%;
  }

  .col-md-3 img {
    opacity: 0.8;
    cursor: pointer;
  }

  .col-md-3 img:hover {
    opacity: 1;
  }

  #searchBox {
    margin-top: 5%;
  }

  #selectGenre {
    margin-top: 3.5%;
    float: left;
    width: 75%;
  }

  #dateMovie {
    margin-top: 5.3%;
  }

  #submitGenre {
    background-color: rgba(39, 116, 70, 1);
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 1rem;
    cursor: pointer;
    margin-top: 3.5%;
    padding: 2.2% 5%;

  }

  #inputDate {
    font-size: 1rem;
    border-radius: 5px;
    border: none;
    font-size: 1rem;
    padding: 1.8%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font: Monstserrat;
    float: left;

  }

  #submitDate {
    background-color: rgba(39, 116, 70, 1);
    border: none;
    padding: 2.2% 5%;
  }

  .button {
    background-color: rgba(39, 116, 70, 1);
    border: none;
    color: white;
    padding: 5% 30%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    font-size: 1rem;
    cursor: pointer;
  }

  .custom-select {
    width: 100%;
  }

  #edit {
    background-color: #FF851B;
  }

  #remove {
    background-color: #FF4136;
  }
</style>

</html>