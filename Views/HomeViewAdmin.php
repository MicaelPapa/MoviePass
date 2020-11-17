<?php require_once("navbar.php"); ?>

<div class="container">
    <!-- Inicio Index -->
    <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
        
        <div id="colCards" class="col-md-12">
            <!-- Menues -->

            <!-- Primera Opcion -->
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div id="movieCard" class="card text-center bg-dark" style="width: 14rem;">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/moviesIcon.svg" class="card-img-top" alt="..." style="height: 11rem; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title">Peliculas</h5>
                            <p class="card-text">Vea la lista completa de películas.</p>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo FRONT_ROOT ?> Cinema/SelectCinema?Type=null" class="btn btn-primary btn-block">Ver Cartelera</a>
                        </div>
                    </div>
                </div>

                <!-- Segunda Opcion -->
                <div class="col-md-3">
                    <div id="shopCard" class="card text-center bg-dark" style="width: 14rem;">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/transactionIcon.svg" class="card-img-top" alt="..." style="height: 11rem; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title">Estadisticas</h5>
                            <p class="card-text">Observe las estadisticas de los cines y peliculas.</p>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo FRONT_ROOT. 'Statistics/View?date1=null&&date2=null'?>" class="btn btn-primary btn-block">Vea sus Estadisticas</a>
                        </div>
                    </div>
                </div>

                <!-- Tercera Opcion -->
                <div class="col-md-3">
                    <div id="ticketCard" class="card text-center bg-dark" style="width: 14rem;">
                        <img src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/ticketsIcon.svg" class="card-img-top" alt="..." style="height: 11rem; margin-top: 5%;">
                        <div class="card-body">
                            <h5 class="card-title">Cines</h5>
                            <p class="card-text">Vea los cines disponibles.</p>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo FRONT_ROOT?>Cinema/ShowListView"  class="btn btn-primary btn-block">Ver Cines</a>
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

 .container {
    min-height: 100vh; 
    height: 100% !important;
}


#box {
    margin-top: 2%;
    margin-bottom: 2%;
    min-height: 70vh !important;
    border-radius: 25px;    
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