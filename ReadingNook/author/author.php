<?php

    $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());
    $nome = $_GET['nome'];
    $cognome = $_GET['cognome'];
    $query1= "SELECT * FROM Autore WHERE nome = '$nome' AND cognome = '$cognome';" ;
    $query2 = "SELECT titolo,copertina,valutazione,lingua FROM Visualizza_libri WHERE nome = '$nome' AND cognome = '$cognome'";
    //informazioni dell'autore
    $autore = pg_query($connect,$query1);
    //tutti i libri scritti dall'autore
    $libri = pg_query($connect,$query2);
    
    $a = pg_fetch_array($autore,null,PGSQL_ASSOC);
    $output = "";


    
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
    <!--Boostrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Per aggiungere effetto on hover al nav con jquery-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    
</head>

<body>
  <?php include '../../componenti/navbar.php'; ?>

  
  <!--  DIV CHE CONTIENE TUTTE LE INFORMAZIONI DEL AUTORE NEL DB-->
  <div class="container-fluid pt-4">
    <div class="border border-2 rounded pb-4 px-1">
      <div class="row mt-4">
        <div class="col-md-3 col-sm mt-lg-0 mt-md-4">
          <!-- immagine dell'autore-->
          <img width="300" height="300" id="autore" src="<?php echo $a['foto']; ?>" class="rounded img-fluid">
        </div>
        <div class="col-md">
          <!-- dati dell'autore-->
          <h4 id="nome"> <?php echo $a['nome'] ." ". $a['cognome']; ?>  </h4>
          <p class="mt-4"> <?php echo $a['bio'] ?> </p>
        </div>
        
      </div>
    </div>
    
    <hr class="mt-4">
    <hr>

    <div class="container-fluid">
      <h4 class="text-center">Author's Book:</h4>
      <div class="row mt-4">
        <div class="container" id="libri">
            <?php 
              //DIV CHE CONTIENE DELLE COL IN CUI CI SONO LE CARDS DEI LIBRI DELL'AUTORE CON IL LINK ALLA PAGINA DEL LIBRO

              $output .= "
              
                  <div id=\"foto\" class=\"row mt-4 mb-4\">
              
              ";
          
              while($row = pg_fetch_array($libri,null,PGSQL_ASSOC)){
                  
                $copertina = $row["copertina"];
                $titolo = $row["titolo"];
                $valutazione = $row["valutazione"];
                $valutazione = round($valutazione,1);
                $val = ($valutazione / 5) * 100;
                $val = round($val/10)*10;
                $val = "$val%";
                $lingua = $row['lingua'];
                $output .= "
                
                <div class=\"col-md-4 p-3 mt-1\">
                  <a href=\"/ReadingNook/books/book.php?titolo=$titolo\" class=\"text-decoration-none\">
                    <div class=\"card\">
                        <img src=\"$copertina\" class=\"card-img-top mt-2 copertina\">
                        <div class=\"card-body\">
                            <h6 class=\"card-title titolo\">$titolo</h6>
                            <h6 class=\"fw-lighter\">$lingua</h6>
                            <div class=\"stelline\">
                                <div class=\"stars-outer\">
                                    <div class=\"stars-inner\" style=\"width: $val;\"></div>
                                </div>
                                <span class=\"number-rating\">$valutazione</span>
                            
                            </div>
                        </div>
                    </div>
                  </a>
                </div>
                
                ";
        
        
              }
              $output .= "</div>";  
              echo $output; 
              pg_free_result($autore);
              pg_free_result($libri);
              pg_close($connect);
              
              
            ?>
        </div>
      </div>
    </div>


  </div>
  <?php include '../../componenti/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/funzioni/cerca.js"></script>
  



</body>

</html>
