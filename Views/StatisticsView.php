<?php require_once("navbar.php"); ?>

<body>
    <div class="container">
        <div class="overflow-auto">
            <h1>Estadisticas</h1><br>
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Aclamadas por la Crítica</div>
                <div class="card-body">
                <?php require_once("alertMessage.php");
                if(sizeof($bestMovies,COUNT_NORMAL)>0){
                foreach ($bestMovies as $movie) { ?>    
                <h2><?php echo $movie['moviename'] . " (" . round($movie['Popularity']) . "%)"?></h2>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: <?php echo $movie['Popularity']?>%" aria-valuenow="<?php echo $movie['Popularity']?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div><br>
                <?php }} ?>
                </div>
            </div>
            <br>
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Las Mayores Ganancias</div>
                <div class="card-body">
                <?php require_once("alertMessage.php");
                if(sizeof($bestMovies,COUNT_NORMAL)>0){
                foreach ($bestMovies as $movie) { ?>    
                <h2><?php echo $movie['moviename'] . " ($" . round($movie['moneyCollection']) . ")"?></h2>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: <?php echo $movie['Popularity']?>%" aria-valuenow="<?php echo $movie['Popularity']?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div><br>
                <?php }} ?>
                </div>
            </div>
            <br>
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Menos Populares</div>
                <div class="card-body">
                <?php require_once("alertMessage.php");
                if(sizeof($worstMovies,COUNT_NORMAL)>0){
                foreach ($worstMovies as $movie) { ?>    
                <h2><?php echo $movie['moviename'] . " (" . round($movie['Popularity']) . "%)"?></h2>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo $movie['Popularity']?>%" aria-valuenow="<?php echo $movie['Popularity']?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div><br>
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