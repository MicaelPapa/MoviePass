<?php require_once("navbar.php"); ?>

<div class="container">
    <!-- Inicio Index -->
    <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
        <div id="colCarousel" class="col-md-10">
            <!-- Inicio carrusel -->
            <div id="carouselMovies" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselMovies" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselMovies" data-slide-to="1"></li>
                    <li data-target="#carouselMovies" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/banner1.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Mulán</h5>
                            <p>Una jóven doncella china se disfraza de hombre para evitar que el padre vaya al ejercito.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/banner2.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Hard Kill</h5>
                            <p>La tecnología multimillonaria que posee el CEO Donovan Chalmers (Willis) es tan valiosa que contrata a un grupo de mercenarios para protegerla. Mientras tanto un grupo terrorista secuestra a su hija para obtenerla.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/banner3.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Kimetsu no Yaiba: El Tren Infinito</h5>
                            <p>Continuación del exitoso anime "Kimetsu no Yaiba". Tanjiro y sus amigos deberán enfrentar a un poderoso demonio junto al pilar de fuego Rengoku para evitar que siga matando gente dentro del tren.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselMovies" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselMovies" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Fin Carrusel -->
        </div>
        <div id="colCards" class="col-md-12">
            <!-- Menues -->

            <!-- Primera Opcion -->
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div id="movieCard" class="card text-center bg-dark" style="width: 14rem;">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/moviesIcon.svg" class="card-img-top" alt="..." style="height: 11rem; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title">Peliculas</h5>
                            <p class="card-text">Vea la lista completa de películas en cartelera.</p>
                        </div>
                        <form action="<?php echo FRONT_ROOT ?>Movies/ShowDataBaseMovies" method="post">
                            <div class="card-body">
                                <input type="hidden" name="type" value = "" />
                                <input type="hidden" name="filter" value = "" />
                                <a><input type="submit" value="Ver Cartelera" class="btn btn-primary btn-block"></a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Segunda Opcion -->
                <div class="col-md-3">
                    <div id="shopCard" class="card text-center bg-dark" style="width: 14rem;">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/transactionIcon.svg" class="card-img-top" alt="..." style="height: 11rem; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title">Comprar</h5>
                            <p class="card-text">Compre entradas para las mejores películas.</p>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo FRONT_ROOT. 'Purchase/View'?>" class="btn btn-primary btn-block">Comprar Entradas</a>
                        </div>
                    </div>
                </div>

                <!-- Tercera Opcion -->
                <div class="col-md-3">
                    <div id="ticketCard" class="card text-center bg-dark" style="width: 14rem;">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/ticketsIcon.svg" class="card-img-top" alt="..." style="height: 11rem; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title">Mis Entradas</h5>
                            <p class="card-text">Vea sus entradas adquiridas.</p>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo FRONT_ROOT?>Tickets/View"  class="btn btn-primary btn-block">Ver mis Tickets</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Fin Menues -->
        </div>

    </div>
    <!-- Fin Index -->
</div>


<style>

.carousel img {
    max-height: 400px;
    margin: 0 auto;
    }

 .container {
    min-height: 100vh; 
    height: 100% !important;
}

.carousel-caption {
    background-color: rgba(47,47,47,0.8);
    border-radius: 25px;
}

#box {
    margin-top: 2%;
    margin-bottom: 2%;
    min-height: 100vh !important;
    border-radius: 10%;    
}

#carouselMovies {
    margin-top: 6%;    
    border-style: solid;
    border-color: linear-gradient(to right,#262b33,#707d91,#262b33);
    border-width: 20px;
    border-radius: 10px;    
}

#colCards {
    margin-top: 4%;
    margin-bottom: 4%;
}

#movieCard {
    background-color: #0169a4;
    color: white;
    border-radius: 15px;
    font-size: 0.95rem;
}

#shopCard {
    background-color: #0169a4;
    color: white;
    border-radius: 15px;
    font-size: 0.95rem;
}

#ticketCard {
    background-color: #0169a4;
    color: white;
    border-radius: 15px;
    font-size: 0.95rem;
}

</style>