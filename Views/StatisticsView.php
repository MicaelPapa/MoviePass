<?php require_once("navbar.php"); ?>

<body>
    <div class="container">
        <div class="overflow-auto">
            <h1>Estadisticas</h1><br>
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Más tickets vendidos</div>
                <form id="dateStatistic" action="<?php echo FRONT_ROOT ?>Statistics/View" method="POST">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-12">
                            <p style="padding-left:20px; margin-top:1%"> Filtrar entre fechas:
                            <input type="date" id="inputDate1" name="inputDate1" value="<?php echo date('Y-m-d'); ?>" />
                            <input type="date" id="inputDate2" name="inputDate2" value="<?php echo date('Y-m-d'); ?>" />
                            <button type="submit" class="btn btn-success" style="padding: 0.35% 1%" id="submitDate"><i class="fas fa-search"></i></button>
                            <a type="submit" href="<?php echo FRONT_ROOT ?>Statistics/View?filter=null" style="padding: 0.35% 1%" class="btn btn-info">Ver datos pasados</a></p>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                <?php require_once("alertMessage.php");
                if(sizeof($bestMovies,COUNT_NORMAL)>0){
                foreach ($bestMovies as $movie) { ?>    
                <h2><?php echo $movie['MovieName'] . " (" . $movie['topMovies'] . ")"?></h2>
                <?php }} ?>
                </div>
            </div>
            <br>
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Las Mayores Ganancias</div>
                <div class="card-body">
                <?php require_once("alertMessage.php");
                if(sizeof($boxOfficeMovies,COUNT_NORMAL)>0){
                foreach ($boxOfficeMovies as $movie) { ?>    
                <h2><?php echo $movie['MovieName'] . " ($" . $movie['boxOffice'] . ")"?></h2>
                <?php }} ?>
                </div>
            </div>
            <br>
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Menos tickets vendidos</div>
                <div class="card-body">
                <?php require_once("alertMessage.php");
                if(sizeof($worstMovies,COUNT_NORMAL)>0){
                foreach ($worstMovies as $movie) { ?>    
                <h2><?php echo $movie['MovieName'] . " (" . $movie['lowMovies'] . ")"?></h2>
                <?php }} ?>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    .container {
        padding: 3%;
        height: 85%;
        background-color: white;
        opacity: .9;
        background-size: cover;
        margin-top: 1%;
        width: 70%;
        border-radius: 1%;
    }

    .overflow-auto {
        height: 95%;
        padding: 1%;
    }
</style>