<?php
// avvio la sessione
session_start();

// verifico che esista la sessione di autenticazione
if (empty($_SESSION['userid'])) {
  header('Location: '.' /ReadingNook/login/login.php');
}else{
  $id = $_SESSION['userid'];
  $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());
  $query = "SELECT * FROM Utente WHERE id_utente = $id;";
  $result = pg_query($connect,$query);
  $utente = pg_fetch_array($result,null,PGSQL_ASSOC);
  $query = "SELECT * FROM Recensioni WHERE id_utente = $id;";
  $recensioni = pg_query($connect,$query);
  $r = pg_num_rows($recensioni);
    
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
    <link rel="stylesheet" href="/css/stelle.css">
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
    
</head>

<body>
  <?php include '../../componenti/navbar.php'; ?>






  <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 400px; background-image: url(/ReadingNook/images/sfondo_profile.jpeg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container d-flex align-items-center">
          
          <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
              <h1 class="display-2 text-white text-center" style="text-align: center;">Hi user!</h1>
              <p class="text-white mt-0 mb-5 text-center" style="text-align: center;">This is your profile page. Here you can see here your profile's details and you can update them whenever you want! You can also see all your reviews and if needed modify or delete them.</p>
              
          </div>
            
            
            
              
        </div>
    </div>
  </div>





  

  <div class="container mt--7">
        <div class="row mt-4">
          <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
              <!-- CARD CHE CONTIENE LE INFO DELL'UTENTE ED IL TASTO PER IL LOGOUT CHE RICHIAMA LA FUNZIONE /login/logout.php-->
              <!-- rettangolo in alto con Message-->
              <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                  <h3 class="mb-0">Details</h3>
                  <a href="./settings.php" class="btn btn-sm btn-primary">Settings</a>
                </div>
              </div>
              <div class="text-center mt-5">
                <?php 
                  if ($utente['img_profilo'] == null){
                    $src = "/ReadingNook/images/user.png";
                  }else{
                    $src = $utente['img_profilo'];
                  }
                ?>
                <img id="fotoprofilo" src="<?php echo $src ?>" alt="" class="img-thumbnail rounded">
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center">
                      <div>
                        <span class="heading"><?php echo $r; ?></span>
                        <span class="description">Reviews</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h3>
                    <?php echo $utente['nome'] . " " . $utente['cognome']; ?>
                  </h3>
                  <?php if($utente['country'] == null){$d = 'd-none';}else{$d = 'd-block';}; ?>
                  <div class="h5 font-weight-300 <?php echo $d; ?>">
                    <i class="ni location_pin mr-2"></i> <?php echo $utente['city'] . "," . $utente['country'] ;?>
                  </div>
                  <?php
                    $data=$utente['ddn'] ; 
                    if($data != null){
                      echo date("M jS, Y", strtotime($data));
                    }
                      
                      
                    ?>
                  <div class="h5 font-weight-300 mt-3">
                    <i class="ni location_pin mr-2"></i> Registration Date:
                  </div>
                  <div class="mt-2">
                    <i class="ni education_hat mr-2"></i> <?php
                    $data = $utente['data_iscrizione'];
                    echo date("M jS, Y", strtotime($data)); 
                    ?>
                  </div>
                  
                  <!--riga tra profilo e show more-->
                  <hr class="my-4">
                  <a href="/ReadingNook/login/logout.php" class="btn btn-sm btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

          <!--rettangolo a sinistra-->
          <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
              <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">My reviews</h3>
                  </div>
                  
                </div>
              </div>
              <!--PARTE DOVE AGGIUNGERE RECENSIONI-->
              <?php
                $query = "SELECT titolo,copertina,testo,Recensioni.id_libro,Recensioni.valutazione FROM libro JOIN recensioni ON libro.id_libro = recensioni.id_libro WHERE id_utente = $id ;";
                $result = pg_query($connect,$query);
                
              ?>
              <div class="card-body" style="overflow-y:scroll; overflow-x:hidden; height:500px;line-height:5em;">
               
                  <?php
                  /*
                    DIV CHE CONTIENE TUTTE LE RECENSIONI FATTE DALL'UTENTE (SE NON CI SONO VISUALIZZO UNA FRASE)

                    OGNI RECENSIONI MOSTRA L'IMMAGINE (SE LO SCHERMO È GRANDE) E IL TITOLO DEL LIBRO, LA VALUTAZIONE E IL TESTO INSERITI DALL'UTENTE
                    E DUE TASTI: 
                    1) TASTO MODIFICA CHE APRE UN MODAL DI BOOTSTRAP E CHE CONTIENE 4 VALORI PASSATI CON LA FUNZIONE JQUERY /funzioni/chenage-review.js AL DB CON $.post
                      (passa VALUTAZIONE(radio), TESTO(textarea), ID_LIBRO (type hidden), ID_UTENTE (type hidden))
                    2) TASTO CANCELLA PRESO DALLA FUNZIONE /funzioni/delete-review.js CHE PASSA ID_LIBRO E ID_UTENTE AL DB PER CANCELLARE LA ROW NELLA TABELLA RECENSIONI

                    TUTTE E DUE LE FUNZIONI CHIAMANO UN UPDATE SU LIBRO PER AGGIORNARE LA MEDIA (grazie anche alla view Media)
                  */
                  $d = "";
                  $i = 0;
                  if(pg_num_rows($result) == 0){
                    echo "<p class=\"mt-4 text-white fs-2\">There are no reviews to show! ¯\_(ツ)_/¯ </p>";
                  }
                  while($singole = pg_fetch_array($result,null,PGSQL_ASSOC)){
                    $titolo = $singole['titolo'];
                    $copertina = $singole['copertina'];
                    $testo = $singole['testo'];
                    $valutazione = $singole['valutazione'];
                    $val = ($valutazione / 5) * 100;
                    $val = round($val/10)*10;
                    $val = "$val%";
                    
                    $modal = str_replace(" ","",strtolower($titolo));
                   
                    
                    $id_libro = $singole['id_libro'];
                    // la recensione con copertina titolo valutazione testo e i tasti per cancellare o modificare (se lo schermo è piccolo la copertina non si vede)
                    $d .= "
                    <div class=\"row\" style=\"margin:auto;\">
                      <div class=\"cerca mt-4 d-block\">
              
                        <div class=\"card h-100\">
                      
                          <div class=\"info position-absolute top-0 end-0 me-3 mb-4 mt-2\" id=\"$i\">
                            <button type=\"button\" class=\"btn btn-primary btn-lg\" data-bs-toggle=\"modal\" data-bs-target=\"#$modal\"><i class=\"bi bi-pencil-square\"></i></button>
                            <button class=\"btn btn-lg btn-danger elimina\"><i class=\"bi bi-trash\"></i></button>
                            <input type=\"hidden\" name=\"utente\" value=\"$id\" class=\"utente\">
                            <input type=\"hidden\" name=\"libro\" value=\"$id_libro\" class=\"libro\">
                          </div> 


                          <div class=\"row\">
                          
                          <div class=\"col-md-4 col-sm-12 d-lg-block d-none\">
                            <img src=\"$copertina\" height=\"100\" class=\"card-img img-fluid mt-lg-0 mt-md-4\">
                          </div>
                          <div class=\"col align-items-center my-auto mt-5\">
                           
                          <div class=\"card-body mt-4\">
                            <h5 class=\"card-title text-center\"><a href=\"/ReadingNook/books/book.php?titolo=$titolo\" class=\"text-dark\">$titolo</a></h5>
                            <h6 class=\"card-title\"><a class=\"text-secondary\" href=\"/ReadingNook/author/author.php?nome=$nome&cognome=$cognome\">$nome $cognome</a></h6>
                            <div class=\"stelline mt-3 mb-4\">
                                <div class=\"stars-outer\">
                                    <div class=\"stars-inner\" style=\"width: $val;\"></div>
                                </div>
                                <span class=\"number-rating\">$valutazione</span>
                        
                            </div>
                            <div>
                              <p>$testo</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
    
    
    
                      
                    </div>
                  
                    </div> ";

                  //un modal per ogni recensione scritta contenente la form per la modifica
                  $d .= "

                    <div class=\"modal fade\" id=\"$modal\" tabindex=\"-1\" aria-labelledby=\"$modal\" aria-hidden=\"true\">
                      <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                          <div class=\"modal-header\">
                            <h5 class=\"modal-title\" id=\"$modal\">Edit Review</h5>
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                          </div>
                          <div class=\"modal-body row justify-content-center form\" id=\"f$i\">
                            <form method=\"\" action=\"\">
                              <div class=\"rate mb-4\">
                                <input type=\"radio\" id=\"rating10\" name=\"rating\" value=\"10\" /><label for=\"rating10\" title=\"5 stars\"></label>
                                <input type=\"radio\" id=\"rating9\" name=\"rating\" value=\"9\" /><label class=\"half\" for=\"rating9\" title=\"4 1/2 stars\"></label>
                                <input type=\"radio\" id=\"rating8\" name=\"rating\" value=\"8\" /><label for=\"rating8\" title=\"4 stars\"></label>
                                <input type=\"radio\" id=\"rating7\" name=\"rating\" value=\"7\" /><label class=\"half\" for=\"rating7\" title=\"3 1/2 stars\"></label>
                                <input type=\"radio\" id=\"rating6\" name=\"rating\" value=\"6\" /><label for=\"rating6\" title=\"3 stars\"></label>
                                <input type=\"radio\" id=\"rating5\" name=\"rating\" value=\"5\" /><label class=\"half\" for=\"rating5\" title=\"2 1/2 stars\"></label>
                                <input type=\"radio\" id=\"rating4\" name=\"rating\" value=\"4\" /><label for=\"rating4\" title=\"2 stars\"></label>
                                <input type=\"radio\" id=\"rating3\" name=\"rating\" value=\"3\" /><label class=\"half\" for=\"rating3\" title=\"1 1/2 stars\"></label>
                                <input type=\"radio\" id=\"rating2\" name=\"rating\" value=\"2\" /><label for=\"rating2\" title=\"1 star\"></label>
                                <input type=\"radio\" id=\"rating1\" name=\"rating\" value=\"1\" /><label class=\"half\" for=\"rating1\" title=\"1/2 star\"></label>
                                <input type=\"radio\" id=\"rating0\" name=\"rating\" value=\"0\" checked required/><label for=\"rating0\" title=\"No star\"></label>

                                
                              </div>
                              <span class=\"\" style=\"font-size: .875rem;color: #adb5bd;\">Review must have max 300 characters</span>
                              <textarea class=\"form-control\" name=\"testo\" maxlength=\"300\" rows=\"4\"></textarea>
                              <label class=\"form-label\" for=\"textAreaExample6\"></label>
                              <input type=\"hidden\" name=\"utente\" value=\"$id\" class=\"utente\">
                              <input type=\"hidden\" name=\"libro\" value=\"$id_libro\" class=\"libro\">
                              <div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Close</button>
                                <button type=\"button\" class=\"btn btn-primary modifica\">Save changes</button>
                              </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>



                  
                    ";
                    $i++;
                  }
                  echo $d;


                  pg_free_result($result);
                  pg_free_result($recensioni);
                  pg_close($connect);
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include '../../componenti/footer.php'; ?>

                





    <!--per lasciare spazio alla fine pagina-->
    




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/funzioni/cerca.js"></script>
  <script src="/funzioni/delete_review.js"></script>
  <script src="/funzioni/change-review.js"></script>

</body>
</html>