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
      function controllaEmail(){
        var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (document.formsignup.email.value.match(format)){
          return (true)
        }
        alert("You have entered an invalid email address!");
        document.formlogin.email-login.focus();
        return (false)
      };
      function controllaPassword(){
        var confirm = document.formsignup.confirm.value;
        var password = document.formsignup.password.value;
        if(password != confirm){
          alert("The passwords must match!");
          return false;
        }
        var regularExpression = /^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$/;
        if(password.match(regularExpression)) {
          alert("Password must have more than eight characters, at least one number, one uppercase letter, one lowercase letter and one special characters.");
          return false;
        }
        return true;
      };
      function myFunction() {
        var x = document.getElementById("password-signup");
        var y = document.getElementById("password-confirmation");
        if (x.type === "password") {
          x.type = "text";
          y.type = "text";
        } else {
          x.type = "password";
          y.type = "password";
        }
      }
    </script>


</head>

<body>
  
  <?php include '../../componenti/navbar.php'; ?>
  
  <div class="conteiner-fluid">
  <section class="form-02-main">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="_lk_de">
                <div class="form-03-main">
                  
                  <div class="logo">
                    <img src="/ReadingNook/images/user.png" class="ms-2">
                  </div>

                  <form name='formsignup' class="form" id="a-form" method="post" action="">

                    <h2 class="form_title title" style="text-align:center;">Sign up here</h2>
                    
                    <input name="nome" id="name" class="form__input" type="text" placeholder="First Name" maxlength="30" size="30" required>
                    <input name="cognome" id="surname" class="form__input" type="text" placeholder="Surname" maxlength="30" size="30" required>
                    <input name="email" id="email-signup" class="form__input" type="text" placeholder="Email" onchange="return controllaEmail();" required>
                    <input name="password" id="password-signup" class="form__input" type="password" placeholder="Password">
                    <input name="confirm" id="password-confirmation" class="form__input" type="password" placeholder="Confirm Password">
                    <div class="form-check form-switch">
                      <input type="checkbox" class="form-check-input" onclick="myFunction()">Show Password
                    </div>
                    <div id="messaggio"></div>
                    <div class="form-group">
                        <input type="submit" id="submit-register" value="Register" class="_btn_04">
                        
                      </div>
                    
                  </form>

                  <div><p class="text-center fst-italic mt-1 mb-0">If you already have an account?</p></div>
                    <div class="form-group" style="text-align:center;">
                    
                        <a id="login" class="text-decoration-none fw-bold"  href="./login.php">Login</a>
                
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     </section>
  </div>
  <?php include '../../componenti/footer.php'; ?>
  

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/funzioni/cerca.js"></script>

    <script type="text/javascript">
      //PER COMODITÀ CONTROLLO SE L'ACCESSO È STATO RICHIESTO PER UNA RECENSIONE IN CASO FACCIO IL REDIRECT
      var url = "";
      $(document).ready(function(){
        if(sessionStorage.getItem("url") != null){
          url = sessionStorage.getItem("url");
        }
      })
     
      $("#a-form").submit(function() {
        //controllo la password
        if(controllaPassword()){
              // passo i dati (via POST) al file PHP che effettua le verifiche 
            $.post("/funzioni/process-signup.php", { nome: $('#name').val() , cognome: $('#surname').val() , email: $('#email-signup').val() , password: $('#password-signup').val() }, function(risposta) {
              // se i dati sono corretti...
              if (risposta == 1) {
                if(url == ""){
                  document.location = '/ReadingNook//home/area_privata.php';
                }else{
                  sessionStorage.removeItem('url');
                  document.location = url;
                }
                
              // se, invece, i dati non sono corretti...
              }else{
                // stampo un messaggio di errore
                $("#messaggio").fadeTo(200, 0.1, function() {
                  $(this).removeClass().addClass('errore').text('User already registered with this email!').css('color','black').fadeTo(900,1);
                });
              }
            });
            // evito il submit del form (che deve essere gestito solo dalla funzione Javascript)
            return false;
            }else{
              //se password è sbagliata non invio la form
              return false;
            }
        
      });
    </script>


</body>
</html>