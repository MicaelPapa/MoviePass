<?php

require_once("navbar.php");
?>

<body>
    <div class="container">
        <!-- Inicio Index -->
        <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
            <div class="col-md-10 text-center m-auto">
                <h1 class="mt-3" id="cinemaTitle"><i class="fas fa-compact-disc"></i>&nbsp;Elige un cine </h1>
            </div>
            <!-- form     -->
            <div class="col-md-8">

                <form action="<?php echo FRONT_ROOT ?>Movies/ShowApiMovies" method="post">
                    <?php
                    if (sizeof($cinemaList) != 0) {
                    ?>
                        <table class="table table-dark text-align-center" style="text-align: center; border-radius: 25px;">

                            <tbody>
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="filterType" value="" />
                                    <input type="hidden" name="filter" value="" />
                                    <input type="hidden" name="alertMessage" value="" />
                                    <input type="hidden" name="alertType" value="" />

                                    <select id="inputSala" name="cinema" class="form-control">
                                        <option selected>Elige un cine</option>
                                        <?php foreach ($cinemaList as $cinema) { ?>
                                            <option value="<?php echo $cinema->getIdCinema(); ?>"> <?php echo $cinema->getCinemaName(); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo '<h2 class="text-center display-4">No hay Cines disponibles para mostrar</h2>';
                    }
                    ?>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success" value=""><i class="fas fa-save"></i>&nbspContinuar</button>

                        <a href="<?php echo FRONT_ROOT ?>Home/Index" class="btn btn-primary btn-block"><i class="fas fa-arrow-left"></i>&nbspVolver</a>
                    </div>

                </form>
                <!-- form -->
            </div>
        </div>
        <!-- Fin Index -->
    </div>

</body>



<style>
    #box {
        margin-top: 2%;
        min-height: 85vh !important;
        border-radius: 25px;
    }

    .fas fa-minus-circle {
        color: red;

    }
</style>