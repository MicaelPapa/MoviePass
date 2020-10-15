<main>
     <section>
          <div class="container">
               <div class="row justify-content-center">
                    <div id="formBox" class="col-md-5">
                         <h1 id="mainTitle"><i class="fas fa-ticket-alt"></i>&nbspMoviePass</h1>
                         <hr>
                         <br>
                         <form action="<?php echo FRONT_ROOT ?>Login/Index" method="post">
                              <div class="login-box">
                                   <div class="textbox">
                                        <i class="fas fa-user"></i>
                                        <input type="text" required placeholder="E-mail" name="email" value="">
                                   </div>

                                   <div class="textbox">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" required placeholder="Contraseña" name="pass" value="">
                                   </div>
                                   <?php require_once("alertMessage.php")?>
                                   <button id="loginBtn" type="submit" name="button">Entrar</button>                                   
                              </div>
                         </form>
                         <hr />
                         <form action="<?php echo FRONT_ROOT ?>Login/LogInWithFacebookHandler" method="post">
                              <button id="facebook" type="submit" name="button" class="btn btn-bg btn-primary"><i class="fab fa-facebook-square"></i>&nbspIniciar Sesion con Facebook</button>
                         </form>
                         <a id="forgotPassword" href="<?php echo FRONT_ROOT ?>Login/ShowForgotPasswordView"> Olvidaste tu contraseña?</a>
                         <p>No tenes una cuenta?<a id="registerLink" href="<?php echo FRONT_ROOT ?>Register/View"> Registrarme en MoviePass</a></p>
                         <small id="condiciones">Si haces click en "Registrarme con Facebook" y no sos usuario de MoviePass, automaticamente<br>vas a
                              estar aceptando los terminos y condiciones de la politica de privacidad de MoviePass
                         </small>
                    </div>
               </div>
          </div>
     </section>
</main>

<style>
     hr {
          border: none;
          height: 2px;
          background: white;
          border-radius: 25px;
          width: 75%;
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

     #forgotPassword {
          text-align: right;
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

     #loginBtn {
          display: block;
          width: 80%;
          height: 50px;
          border-radius: 25px;
          margin: 1rem 0 0 0.4rem;
          font-size: 1.2rem;
          outline: none;
          border: none;
          background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
     }

     #loginBtn:hover {
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

     #registerLink,
     #registerLink:hover,
     #registerLink:visited {
          background: none;
          border: none;
          color: black;
          text-decoration: none;
          cursor: pointer;
          margin-bottom: 30%;
          padding-bottom: 30%;
     }

     #condiciones {
          font-size: 62%;
          font-weight: 400;
     }
</style>