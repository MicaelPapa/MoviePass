<?php require_once("navbar.php"); ?>

<body>
    <div class="container">
        <div class="overflow-auto">
            <?php foreach ($Orders as $order) { ?>
                <div class="card mb-3">
                    <div class="card-header">
                        Pedido
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="card-text">Cine: <?php echo $order->getScreening()->getCinema()->getCinemaName(); ?> </p><br>
                                <p class="card-text">Sala: <?php echo $order->getScreening()->getRoom()->getRoomNumber(); ?> </p><br>
                                <p class="card-text">Fecha: <?php echo date_format(date_create($order->getScreening()->getStartDate()),"d/m/Y");?> <?php $date = date_create($order->getScreening()->getStartHour()); echo date_format($date,'h:i:a'); ?> </p><br>
                            </div>
                            <div class="col-sm-6">
                                <p class="card-text">Pelicula: <?php echo $order->getScreening()->getMovie()->getMovieName(); ?> </p><br>
                                <p class="card-text">SubTotal: <?php echo $order->getSubTotal(); ?> </p><br>
                                <p class="card-text">Descuento: <?php echo $order->getDiscount(); ?>%</p><br>
                                <p class="card-text">Total: <?php echo $order->getTotal(); ?> </p><br>
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