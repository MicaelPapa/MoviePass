<?php require_once("navbar.php"); ?>

<body>
    <div class="container">
    <div><h1>Tickets Adquiridos</h1></div>
    <a href="<?php echo FRONT_ROOT?>Tickets/View?orderType=name" type="submit" class="btn btn-primary"><i class="fas fa-sort"></i>Ordenar por nombre</a>
    <a href="<?php echo FRONT_ROOT?>Tickets/View?orderType=date" type="submit" class="btn btn-info"><i class="fas fa-sort"></i>Ordenar por fecha de compra</a>
        <div class="overflow-auto">
            <?php foreach ($tickets as $ticket) { ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                             <p class="card-text">Pelicula: <?php echo $ticket->getScreening()->getMovie()->getMovieName(); ?> </p><br>
                                <p class="card-text">Cine: <?php echo $ticket->getScreening()->getCinema()->getCinemaName(); ?> </p><br>
                                <p class="card-text">Sala: <?php echo $ticket->getScreening()->getRoom()->getRoomNumber(); ?> </p><br>
                                <p class="card-text">Fecha: <?php echo date_format(date_create($ticket->getScreening()->getStartDate()),"d/m/Y");?> <?php $date = date_create($ticket->getScreening()->getStartHour()); echo date_format($date,'h:i:a'); ?> </p><br>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
<style>
    .SearchField {
        width: 20%;
    }

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
        height: 85%;
    }

    .card-text {
        margin: -2%;
    }

    .card {
        background-color: black;
        color: white;
        opacity: 1;
        margin: 5%;
        padding: 1%;
        width: 75%;
    }
</style>