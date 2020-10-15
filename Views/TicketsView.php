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
                                <p class="card-text">Cliente: <?php echo($order['UserName']) ?> </p><br>
                                <p class="card-text">Complejo: <?php echo($order['cinemaname']) ?> </p><br>
                                <p class="card-text">Dirección: <?php echo($order['CinemaAddress'])?> </p><br>
                                <p class="card-text">Sala: <?php echo($order['roomnumber']) ?> </p><br>
                                <p class="card-text">Fecha: <?php echo($order['startdate']) ?> </p><br>
                            </div>
                            <div class="col-sm-6">
                                <p class="card-text">Pelicula: <?php echo($order['moviename'] . " " . $order['MovieLanguage']) ?> </p><br>
                                <p class="card-text">Butacas: <?php echo($order['seats']) ?> </p><br>
                                <p class="card-text">Descuento: <?php echo($order['Discount']) ?> </p><br>
                                <p class="card-text">SubTotal: <?php echo($order['Subtotal']) ?> </p><br>
                                <p class="card-text">Total: <?php echo($order['Total']) ?> </p><br>
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