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
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/banner1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Malefica</h5>
                            <p>Angelina Jolie interpreta a la hada de grandes cuernos, quien es traicionada por su gran amor y que actúa movida por el dolor.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/banner2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Joker</h5>
                            <p>La pasión de Arthur Fleck, un hombre ignorado por la sociedad, es hacer reír a la gente. Una serie de trágicos sucesos lo convertiran en un brillante criminal.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/banner3.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Avengers: EndGame</h5>
                            <p>Los Vengadores restantes deben encontrar una manera de recuperar a sus aliados para un enfrentamiento épico con Thanos.</p>
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
                        <div class="card-body">
                            <a href=<?php echo FRONT_ROOT. "Movies/ShowDataBaseMovies"?> class="btn btn-primary btn-block">Ver Cartelera</a>
                        </div>
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