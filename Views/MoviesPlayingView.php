<?php require_once("navbar.php"); ?>

<div id="box" class="container" style="background-color: rgba(255, 255, 255, 0.5);"> 		
  <div class="row" >   
        <div class="col-md-4">
            <form id ="searchBox" action="<?php echo FRONT_ROOT ?> Movies/ShowDataBaseMovies" method = "POST">
              <div class="form-row justify-content-center">
                <div class="form-group col-md-6">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="hidden" name="type" value="filterName" />
                        <input id ="inputSearch" type="search" name="movieName" class="form-control" placeholder="Buscar" aria-label="Buscar" aria-describedby="basic-addon1">
                      </div>
                </div>
              </div>
            </form>				 
        </div>
        <div class="col-md-4">
          <form id="selectGenre" action="<?php echo FRONT_ROOT ?>Movies/ShowDataBaseMovies" method="POST">
            <div class="form-row justify-content-center">
              <div class="form-group col-md-12">
                <input type="hidden" name="type" value="filterGenres" />
                <select id="selectGenre" name="selectGenres"  class="custom-select">
                      <option value="0">Selecciona el Género</option>
                      <?php foreach($genreList as $genre) { ?>
                      <option value="<?php echo $genre->getIdIMDB(); ?>"><?php echo $genre->getName(); ?></option>
                      <?php }?>
                </select>
                <input type="hidden" name="type" value="filterGenres" />
                <button type="submit" class="btn btn-succes" name="filtrar" id="submitGenre"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-4">
          <form id="dateMovie" action="<?php echo FRONT_ROOT ?>Movies/ShowDataBaseMovies" method="POST">
            <div class="form-row justify-content-center">
              <div class="form-group col-md-12">
              <input type="hidden" name="type" value="filterDate" />
                <input type="date" name="dateFilter" id="inputDate" value="<?php echo date('Y-m-d'); ?>" />
                <button type="submit" class="btn btn-success" id="submitDate" value="Filtrar"/><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        </div>
       <div class="row"> 
      <?php foreach($movieList as $movies) { ?>   
        <div class="col-md-3">
          <div class="flip-card movieBoxes">
            <div class="flip-card-inner">
              <div class="flip-card-front">
                <img src="<?php echo $movies->getPhoto()?>" alt="Avatar" style="width:100%;height:100%;">
              </div>
              <div class="flip-card-back">
                <h1> <?php echo $movies->getMovieName(); ?> </h1> 
                <p><?php echo $movies->getReleaseDate(); ?></p> 
                <p><a id="buyTicket" href = "#"></a><button class="button">Comprar</a><i class="fas fa-ticket-alt"></i></button></p>
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

h1{
  font-size: 20px;
  margin-top: 10%;
}

.flip-card {
    background-color: transparent;
    width: 200px;
    height: 250px;
    /* border: 1px solid #f1f1f1; */
     
    perspective: 1000px; /* Remove this if you don't want the 3D effect */
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
    border-color: linear-gradient(to right,#262b33,#707d91,#262b33);
    border-width: 10px;
    border-radius: 10px;  
  }
  
  /* Do an horizontal flip when you move the mouse over the flip box container */
  .flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
  }
  
  /* Position the front and back side */
  .flip-card-front, .flip-card-back {
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

/* // select {
  // border: none;
  // font-size: 16px;
  // height: 50%;
  // margin: 0;
  // margin-top: 3.5%;
  // margin-left: 10%;
  // outline: 0;
  // padding: 5px;
  // width: 17%;
  // background-color: #2c2c2cb2;
  // background: rgba(39, 39, 39, 0.596);
  // color: #8d9092;
  // box-shadow: 0 1px 0 rgba(5, 5, 5, 0.705) inset;
  // margin-bottom: 10px;
  // border-radius: 100px;
// }

//option{
  //background: rgba(0, 0, 0, 0.418);
//} */

#searchBox {
  margin-top: 5%;
}

#selectGenre {
  margin-top: 2.8%;
  width: 75%;
  float:left;
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

#dateMovie{
  margin-top: 5.3%;
}

#inputDate{
  font-size: 1rem;
  border-radius: 5px;
  border: none;
  font-size: 1rem;
  padding: 1.8%;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font: Monstserrat;
  float:left;
  
}

#submitDate{
  background-color: rgba(39, 116, 70, 1);
  border: none;
  padding: 2.2% 5%;
}

#icon{
  margin-right: 2%;
}

.button {
  background-color: rgba(39, 116, 70, 1);
  border: none;
  color: white;
  padding: 5% 30%;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 1rem;
  cursor: pointer;
}
.button .icon {
  width: 40px;
  height: 40px;
  margin-top: 5%;
  filter: invert(100%);
}  	 
 
</style>
</html>
