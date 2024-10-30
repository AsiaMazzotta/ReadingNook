<?php
  session_start();
  if(!empty($_SESSION['userid'])){
    header('Location: ' . '/ReadingNook//home/area_privata.php');
  }
  
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ReadingNook</title>
    <!--Per le stelline-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <!-- Per l'icona del titolo -->
    <link rel="icon" type="image/x-icon" href="/ReadingNook/images/favicon.ico">
    <!-- Nostre Modifiche-->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
    <!--Boostrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Per aggiungere effetto on hover al nav con jquery-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    
    <script>
      //funzione per controllare validità dell'email con un format
      function controllaEmail(){
        var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (document.formlogin.email.value.match(format)){
          return (true)
        }
        alert("You have entered an invalid email address!");
        document.formlogin.email-login.focus();
        return (false)
      };
      //funzione per toggle per visualizzare password
      function myFunction() {
        var x = document.getElementById("password-login");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>



</head>

<body>
    
    <?php include '../../componenti/navbar.php'; ?>

    <section class="form-02-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="_lk_de">
              <div class="form-03-main">
                
                <div class="logo">
                  <img src="/ReadingNook/images/user.png" class="ms-2">
                </div>
                
                <h2 class="form_title title" style="text-align:center;">Sign in to Website</h2>
                <form class="form" name="formlogin" id="b-form">
                
                
                  <input name="email" id="email-login" class="form__input" type="text" placeholder="Email" autocomplete="off" onchange="return controllaEmail();" required>
                  <input name="password" id="password-login" class="form__input" type="password" placeholder="Password" required>
                  <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" onclick="myFunction()">Show Password
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="rmb" id="rmb" value="1">Remember me
                  </div>
                  
                  <div id="messaggio"></div>
                  <div class="form-group">
                    <input type="submit" id="submit-login" value="Login" class="_btn_04">
                  </div> 

                </form>
                

               

                
  

                <div><p class="text-center fst-italic mt-1 mb-0">Don't have an account?</p></div>
                <div class="form-group" class="text-decoration-none" style="text-align:center;font-weight:bold;">
                  
                    <a id="registrazione"  href="./register.php" style="text-decoration:none;">Register</a>
                  
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div id="dom-target" style="display: none;">
      <?php
          
      ?>
  </div>

  <?php include '../../componenti/footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/funzioni/cerca.js"></script>


    <!--SCRIPT PER SIGN IN-->
    <script type="text/javascript">
      //salvo la pagina precedente se necessaria (ad esempio quando faccio il redirect per scrivere una recensione)
      var url = "";
      $(document).ready(function(){
        if(sessionStorage.getItem("url") != null){
          url = sessionStorage.getItem("url");
        }
      })


      $("#b-form").submit(function() {
        // passo i dati (via POST) al file PHP che effettua le verifiche 
        cond = $('#rmb').is(":checked");
        if(cond){
          check = 1;
        }else{
          check = 0;
        }
        $.post("/funzioni/process-login.php", { password: $('#password-login').val(), email: $("#email-login").val(), rmb: check }, function(risposta) {
          // se i dati sono corretti...
          if (risposta == 1) {
            // applico l'effetto allo span con id "messaggio"
            $("#messaggio").fadeTo(200, 0.1, function() {
              // per prima cosa mostro, con effetto fade, un messaggio di attesa
              $(this).removeClass().addClass('corretto').text('Login in corso...').css('color','black').fadeTo(900, 1, function() {
                // al termine effettuo il redirect alla pagina privata o alla pagina precedente se serve
                if(url!=""){
                  sessionStorage.removeItem('url');
                  document.location = url;
                }else{
                  document.location = '/ReadingNook//home/area_privata.php';
                }
                
              });
            });
          // se, invece, i dati non sono corretti...
          }else{
            // stampo un messaggio di errore
            $("#messaggio").fadeTo(200, 0.1, function() {
              $(this).removeClass().addClass('errore').text('Dati di login non corretti!').css('color','black').fadeTo(900,1);
            });
          }
        });
        // evito il submit del form (che deve essere gestito solo dalla funzione Javascript)
        return false;
      });
    </script>
  
    


</body>
</html>
