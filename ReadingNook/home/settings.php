<?php 
    session_start();
    $id = $_SESSION['userid'];
    $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());
    $query = "SELECT * FROM Utente WHERE id_utente = $id;";
    $result = pg_query($connect,$query);
    $utente = pg_fetch_array($result,null,PGSQL_ASSOC);
  
    $img = $utente['img_profilo'];

?>

<?php

    //Cambio immagine del profilo
    if(isset($_POST['invia'])){


        $photo = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $folder = "../images/users/" .$photo;
        $e = move_uploaded_file($tmp,$folder);
        
        $path = "/ReadingNook/images/users/" . $photo;
        $query = "UPDATE Utente SET img_profilo = '$path' WHERE id_utente = $id;";
        $result = pg_query($connect,$query);

       
        header("Refresh:0");
        
    }
    //Aggiorno dati del profilo
    if(isset($_POST['modifica'] )){
        $nome = $_POST['firstname'];
        $cognome = $_POST['lastname'];
        $birthday = $_POST['birthday'];
        $country = $_POST['country'];
        $city = $_POST['city'];

        $query = "UPDATE Utente SET nome = '$nome', cognome = '$cognome', ddn = '$birthday', country = '$country', city = '$city';";
        $result = pg_query($connect,$query);
        
        header("Refresh:0");
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
    <link rel="stylesheet" href="/css/profile.css">
    <!--Boostrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Per aggiungere effetto on hover al nav con jquery-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        function controllaPassword(){
        var confirm = document.pswd.new.value;
        var password = document.pswd.controlla.value;
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
        console.log('1');
      };
    </script>    

</head>

<body>
  <?php include '../../componenti/navbar.php'; ?>



     <div class="container-xl px-4 mt-4">
       
        
            
        
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                        <form action="settings.php" method="post" enctype="multipart/form-data">
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <img width="200" class="img-account-profile rounded-circle mb-2" src="<?php if($img != null){echo $img;}else{echo "/ReadingNook/images/user.png";}; ?>" alt="Submit">
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">Upload a photo for your profile</div>
                                <!-- Profile picture upload button-->
                                <input type="file" accept="image/*" name="image">
                                <input class="btn btn-primary mt-2" value="Submit" name="invia" type="submit">
                                
                            </div>    
                        </form>
                        
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">User informations</div>
                    <div class="card-body">
                        <form action="settings.php" method="post">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="firstname">First name</label>
                                    <input class="form-control" id="firstname" name="firstname" type="text" placeholder="Enter your first name" value="<?php echo $utente['nome'];?>">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="lastname">Last name</label>
                                    <input class="form-control" id="lastname" name="lastname" type="text" placeholder="Enter your last name" value="<?php echo $utente['cognome'];?>">
                                </div>
                            </div>
                            <!-- Form Row (country & city)-->
                            <div class="row gx-3 mb-3">
                                
                                <div class="col-md-6">
                                    <label class="small mb-1" for="country">Country</label>
                                    <input class="form-control" id="country" name="country" type="text" placeholder="Enter your country" value="<?php if($utente['country'] != null){echo $utente['country'];};?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="city">City</label>
                                    <input class="form-control" id="city" name="city" type="text" placeholder="Enter your city" value="<?php if($utente['city'] != null){echo $utente['city'];};?>" required>
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email" value="<?php echo $utente['email'];?>" readonly>                    
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="birthday">Birthday</label>
                                    <input class="form-control" id="birthday" type="date" name="birthday" value="<?php echo $utente['ddn'] ?>" required>
                                </div>
                            </div>
                            
                            <!-- Save changes button-->
                            <input type="submit" name="modifica" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-auto justify-content-center mt-2 mb-4">
            <div class="col-xl-8">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header text-center">Change Password</div>
                        <form id="a-form" action="settings.php" method="post" name="pswd">
                            <div class="card-body text-center">
                                <!-- PASSO TUTTI I DATI ALLA FUNZIONE JQUERY IN FONDO ALLA PAGINA $().SUBMIT()-->
                                <div class="row justify-content-center">
                                    <div class="col-md-3 col-sm-12">
                                        <label class="small mb-1" for="firstname">Current Password</label>
                                        <input class="form-control" id="pswd" name="pswd" type="password" placeholder="Enter current password" required>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label class="small mb-1" for="firstname">New Password</label>
                                        <input class="form-control" id="new" name="new" type="password" placeholder="Enter new password" required>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label class="small mb-1" for="firstname">Current Password</label>
                                        <input class="form-control" id="controlla" name="controlla" type="password" placeholder="Repeat new password" required>
                                    </div>
                                    
                                </div>
                                <input type="submit" name="pswd" class="btn btn-primary mt-3" value="Change Password">
                                <div id="messaggio"></div>
                            </div>    
                        </form>
                        
                </div>
            </div>
    </div>

    <?php
        pg_free_result($result);
        pg_close($connect);
    ?>
    <?php include '../../componenti/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/funzioni/cerca.js"></script>

    <script type="text/javascript">
      $("#a-form").submit(function() {
        //CONTROLLO SE LA PASSWORD RISPETTA IL FORMAT STABILITO E SE COINCIDE
        if(controllaPassword()){
              // passo i dati (via POST) al file PHP che effettua le verifiche 
            $.post("/funzioni/change-password.php", { old: $('#pswd').val() , new: $('#new').val()}, function(risposta) {
              // se i dati sono corretti...
              if (risposta == 1) {
                alert('Password Changed!');
                location.reload();
              // se, invece, i dati non sono corretti...
              
              }else{
                // stampo un messaggio di errore
                alert('Current Password Not Correct!');
              }
            });
            // evito il submit del form (che deve essere gestito solo dalla funzione Javascript)
            return false;
            }else{
                return false;
            }
            
      });
    </script>

</body>
</html>