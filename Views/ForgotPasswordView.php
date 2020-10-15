<main>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div id="formBox" class="col-md-5">
                    <h1 id="mainTitle"><i class="fas fa-ticket-alt"></i>&nbspMoviePass</h1>
                    <hr>
                    <br>
                    <form action="<?php echo FRONT_ROOT ?>Login/RecoverPassword" method="post">
                        <div class="forgotPassword-box">
                            <div class="textbox">
                                <i class="fas fa-user"></i>
                                <input type="text" required placeholder="E-mail" name="email" value="">
                            </div>
                            <?php require_once("alertMessage.php")?>
                            <button id="forgotPasswordBtn" type="submit" name="button">Recuperar contraseña</button><br>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row justify-content-center">
                <div id="backBox" class="col-md-5">                
                    <button  onclick="window.location.href='<?php echo FRONT_ROOT ?>Login/View';" id="backBtn" type="submit" name="button" class="btn"> 
                        <i class="fas fa-arrow-left" style="font-size: 2rem;"></i>&nbsp&nbsp&nbsp&nbsp<span style="font-size: 1.8rem; font-weight: 600;">Volver Atrás</span>
                    </button>
                    <br>                    
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

    .forgotPassword-box {
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

    #forgotPasswordBtn:hover {
          background-image: linear-gradient(to right, #27a37a, #32be8f, #27a37a);
          cursor: pointer;
     }

    #formBox {
        width: 80%;
        margin-top: 10%;
        color: white;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 2%;
    }

    #forgotPasswordBtn {
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

    #backBox {
        width: 80%;      
        margin-top: 2%;  
        color: white;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 25px;
    }

    #backBox i{
        padding-top: 3%;
        padding-left: 10%;
    }

    #backBtn, #backBtn:hover {
          display: block;
          width: 80%;
          height: 50px;
          color: white;
          border-radius: 25px;
          margin: 0.7rem 0 0 1.8rem;
          font-size: 1.6rem;
          cursor: pointer;
          outline: none;
          border: none;
          background-color: rgba(255, 255, 255, 0);
     }


    #mainTitle {
        font-family: 'Montserrat', sans-serif;
        margin-top: 5%;
        text-align: center;
        font-size: 240%;
        font-weight: 600;
    }
    
</style>