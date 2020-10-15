
<?php 

    require_once("navbar.php");
?> 

<body>
    <div class="container">
        <!-- Inicio Index -->
        <div id="box" class="row justify-content-center" style="background-color: rgba(255, 255, 255, 0.5);">
            <div class="col-md-10 text-center m-auto">
                <h1 class="mt-3" id="cinemaTitle"><i class="fas fa-id-badge"></i>&nbsp;Contacto</h1>
            </div>
            <!-- form     -->
            <div class="col-md-10">

                <form action="<?php echo FRONT_ROOT ?>Contact/Index" method="post" >
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputNombre"><i style="color: red;">&#42&nbsp</i>Nombre</label>
                            <input type="text" class="form-control" id="inputNombre" placeholder="Nombre" name ="Name">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputApellido"><i style="color: red;">&#42&nbsp</i>Apellido</label>
                            <input type="text" class="form-control" id="inputApellido" placeholder="Apellido" name = "LastName">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputEmail"><i style="color: red;">&#42&nbsp</i>Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email" name = "Email">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputAsunto"><i style="color: red;">&#42&nbsp</i>Asunto</label>
                            <input type="text" class="form-control" id="inputAsunto" placeholder="Asunto" name ="Subject">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputDescripcion"><i style="color: red;">&#42&nbsp</i>Descripción</label>
                            <textarea rows="4" cols="50" type="text" class="form-control" id="inputDescripcion"
                                placeholder="Descripcion" name="Description"></textarea>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success btn-block"><i
                                    class="fas fa-save"></i>&nbspEnviar</button>
                            <a href="<?php echo FRONT_ROOT. "Home/View"?>" type="button" class="btn btn-primary btn-block"><i
                                    class="fas fa-arrow-left"></i>&nbspVolver</a>
                        </div>
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

</style>