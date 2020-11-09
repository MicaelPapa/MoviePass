<?php require_once("navbar.php"); ?>
<div class="container">
    <!-- Inicio Index -->
    <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
        <div id="formBox" class="col-md-10 overflow-auto">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <img id="poster" src="<?php echo $movie->getPhoto();?>" alt="Avatar" width="160" height="160">
                </div>
                <div id="movie-info" class="form-group col-md-5 align-self-center">
                    <p class="titleData" style="font-size: 32px">&nbsp</i><?php echo $movie->getMovieName();?>&nbsp</p>
                    <p class="titleData"><i class="fas fa-video">&nbsp</i>Fecha de Salida:&nbsp<span class="textData"><?php echo $movie->getReleaseDate();?>
                    </span></p>
                    <p class="titleData"><i class="fas fa-clock">&nbsp</i>Duración:&nbsp<span class="textData"><?php echo $movie->getDuration() . " minutos";?>
                    </span></p>
                    <p class="titleData"><i class="fas fa-file-alt">&nbsp</i>Sinopsis:&nbsp<span class="textData"><?php echo $movie->getSynopsis();?>
                    </span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="boxTab" class="row justify-content-center">
<div class="container">
    <nav>
        <div class="nav nav-tabs" name="tabDate" id="nav-tab"  role="tablist">
            <a style="visibility: hidden" class="nav-item nav-link active" id="nav-home-tab" role="tab" data-toggle="tab" aria-controls="nav-home" aria-selected="true" href="#nav-home"></a>
            <?php foreach($screeningList as $screening){ 
                if($screening->getStartDate() !== $screeningCondition){ ?>  
            <a name="tabId" class="nav-item nav-link" id="nav-<?php echo $screening->getIdScreening();?>-tab" data-toggle="tab" role="tab" aria-controls="nav-<?php echo $screening->getIdScreening();?>" aria-selected="true" href="#nav-<?php echo $screening->getIdScreening();?>"><?php echo date_format(date_create($screening->getStartDate()),"d/m/Y");?></a>
            <?php $screeningCondition = $screening->getStartDate();
            } } ?>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div style="visibility: hidden" role="tabpanel" id="nav-home" class="tab-pane fade show active" aria-labelledby="nav-home-tab">
            <h1></h1>
        </div>
        
        <?php foreach($screeningList as $screening){ ?>  
        <div role="tabpanel" id="nav-<?php echo $screening->getIdScreening();?>" class="tab-pane fade" aria-labelledby="nav-<?php echo $screening->getIdScreening();?>-tab">
        <form action="" method="POST">
            <p class="titleData" style="margin-top: 1%" >Cine <?php echo ($this->screeningDAO->getCinemaByIdCinema($screening->getIdCinema()))->getCinemaName();?></p>
            <?php foreach($screeningListCopy as $screeningCopy){ 
                if($screening->getStartDate() === $screeningCopy->getStartDate()){ ?>
                    <p class="titleData"><input type="checkbox" name="chackScreening" class="radio" value="<?php echo $screeningCopy->getIdScreening();?>"><?php $date = date_create($screeningCopy->getStartHour()); echo date_format($date,'h:i:a');?></p>
                <?php }} ?>
            <p class="titleData"><label>Cantidad de Entradas<input class="quantity" id="inputCantidad" name="cantEntradas" type="number" min=1 max=10></input></label><p>
            <button type="submit" style="float:right; margin-bottom: 2%" class="btn btn-success" name="selectScreening" id="selectScreening">Ir a Compras </t></button>
        </form>
        <button class="btn btn-danger" onclick="goBack()">Regresar</button>
        </div>
        <?php } ?>
    </div>
</div>
</div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</body>

</html>

<script>
    // the selector will match all input controls of type :checkbox
    // and attach a click event handler 
    $("input:checkbox").on('click', function() {
    // in the handler, 'this' refers to the box clicked on
    var $box = $(this);
    if ($box.is(":checked")) {
        // the name of the box is retrieved using the .attr() method
        // as it is assumed and expected to be immutable
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        // the checked state of the group/box on the other hand will change
        // and the current value is retrieved using .prop() method
        $(group).prop("checked", false);
        $box.prop("checked", true);
    } else {
        $box.prop("checked", false);
    }
    });

    function goBack() {
        window.location.href='<?php echo FRONT_ROOT ?>Movies/ShowDataBaseMovies?type=null&filter=null';
    }

</script>

<style>
    h1 {
        margin-top: 2%;
        color: white;
    }


    #box {
        margin-top: 2%;
        border-radius: 25px;
    }
    #boxTab {
        
        margin-top: 1%;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 25px;
        width: 70%;
        margin-left: 15%;
        height: auto;
    }

    #poster {
        border-style: solid;
        border-color: linear-gradient(to right, #262b33, #707d91, #262b33);
        border-width: 10px;
        border-radius: 10px;
        width: 200px;
        height: 320px;
        margin-top: 20%;
    }

    #movie-info {
        margin-top: 4%;
    }

    .titleData {
        font-size: 1.2rem;
        font-weight: 500;
    }

    .textData {
        font-size: 1rem;
        font-weight: 400;
    }

    #titleLine {
        position: relative;
        display: inline-block;
    }

    #titleLine::before,
    #titleLine::after {
        content: ' ';
        display: block;
        position: absolute;
        top: 50%;
        left: -220px;
        width: 200px;
        border-bottom: 1px solid #FFF;
    }

    #titleLine::after {
        left: auto;
        right: -220px;
    }

    .ticketText {
        font-weight: 600;
    }

    .ticketData {
        font-weight: 300;
    }

    /* Style tab links */
    .tablink {
    background-color: #555;
    color: white;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 25%;
    }

    .tablink:hover {
    background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
    color: white;
    display: none;
    padding: 100px 20px;
    height: 100%;
    }
    a[name="tabId"] {
    color: #0d0d0d;
    font-size: 1.2rem;
    font-weight: 500;
    }

</style>