<main>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div id="formBox" class="col-md-5">
                    <h1 id="mainTitle"><i class="fas fa-ticket-alt"></i>&nbspMoviePass</h1>
                    <form action="<?php echo FRONT_ROOT ?>Register/RegisterWithFacebookHandler" method="post">
                        <button id="facebook" type="submit" name="button" class="btn btn-bg btn-primary"><i class="fab fa-facebook-square"></i>&nbspRegistrarme con Facebook</button>
                    </form>
                    <hr>
                    <h2 class="subtitle">Registrarme con mi Email</h2>
                    <?php require_once("alertMessage.php")?>
                    <form action="<?php echo FRONT_ROOT ?>Register/Index" method="post">
                        <div class="RegisterBox">
                            <div class="textbox">
                                <i class="fas fa-user"></i>
                                <input type="email" placeholder="Email" name="email" required value="">
                            </div>
                            <div class="textbox">
                                <i class="fas fa-pen"></i>
                                <input type="text" placeholder="Nombre" name="userName" required value="">
                            </div>
                            <div class="textbox">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Contraseña" name="password" required value="">
                            </div>
                            <div class="textbox">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Confirme su constraseña" required name="passwordConfirmed" value="">
                            </div>
                            <div class="textbox">
                                <i class="fas fa-calendar-day"></i>
                                <input type="date" placeholder="Cumpleaños" required name="birthdate" value="">
                            </div>   
                            <h4>Género:</h4>     
                            <label class="label">
                                <input type="radio" name="gender" required value=<?php echo (1); ?>> Femenino
                                <span class="checkmark"></span>
                            </label>    
                            <label class="label">
                                <input type="radio" name="gender" required value=<?php echo (2); ?>> Masculino
                                <span class="checkmark"></span>
                            </label> 
                            <label class="label">
                                <input type="radio" name="gender" required value=<?php echo (3); ?>> Otro
                                <span class="checkmark"></span>
                            </label>                                                                            
                            <button id="registerBtn" type="submit" name="button" class="bg-light-alpha">Registrarme</button>
                            <br>
                        </div>
                    </form>

                    <form action="<?php echo FRONT_ROOT ?>Login/View" method="post">
                        <div>
                            <p>Ya tenes una cuenta?<button id="logInLink" type="submit" class="bg-light-alpha"> Iniciar Sesion</button></p>
                        </div>
                    </form>
                    <div>
                        <p id="condiciones">Al hacer click en Registrarme aceptas los terminos y condiciones de uso de MoviePass</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<style>

    input:focus, textarea:focus {
    background   : rgba(0,0,0,.0);
    border-radius: 5px;
    outline      : none;
    }

    hr {
        border: none;
        height: 2px;
        background: white;
        border-radius: 25px;
        width: 75%;
    }

    h4 {
        font-size: 1.3rem;
        font-weight: 500;
    }

    .container {
          color: white;
          font-family: 'Muli', sans-serif;
     }

     .login-box {
          margin-left: 14%;
     }

    .textbox {
          width: 70%;
          overflow: hidden;
          font-size: 15px;
          padding: 8px 0;
          margin: 8px 0;
          border-bottom: 1px solid white;
     }

     .textbox i {
          margin-top: 3%;
          width: 20px;
          float: left;
          text-align: center;
     }

     .textbox input {
          border: none;
          outline: none;
          background: none;
          color: white;
          font-size: 18px;
          width: 80%;
          float: left;
          margin: 0 10px 0 0.4rem;
     }

     .textbox input:focus {
        background: none;
        color: white;
     }

    .subtitle {
        font-family: 'Montserrat', sans-serif;
        margin-top: 5%;
        text-align: center;
        font-size: 150%;
        font-weight: 600;
        color: white;
    }

    .RegisterBox {
        margin-left: 14%;
    }

     #formBox {
          width: 80%;
          margin-top: 10%;
          color: white;
          background: rgba(255, 255, 255, 0.5);
          border-radius: 2%;
     }

     #mainTitle {
          font-family: 'Montserrat', sans-serif;
          margin-top: 5%;
          text-align: center;
          font-size: 240%;
          font-weight: 600;
     }

     #formBox h3 {
          text-align: left;
          font-size: 25px;
          margin-bottom: -1px;
     }

     #logInLink {
        background: none;
        border: none;
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

     #registerBtn {
          display: block;
          width: 80%;
          height: 50px;
          border-radius: 25px;
          margin: 1rem 0 0 0.4rem;
          font-size: 1.2rem;
          outline: none;
          border: none;
          color: white;
          background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
     }

     #registerBtn:hover {
          background-image: linear-gradient(to right, #27a37a, #32be8f, #27a37a);
          cursor: pointer;
     }

     #facebook {
          display: block;
          width: 80%;
          height: 50px;
          border-radius: 25px;
          margin: 1rem 0 1rem 3rem;
          font-size: 1.2rem;
          outline: none;
          border: none;
     }

     #condiciones {
          font-size: 62%;
          font-weight: 400;
     }

     #alertLogin {
          display: block;
          width: 80%;
          margin-top: 2%;
     }

</style>
