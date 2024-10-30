<?php

    //CREO TUTTE LE PAGINE DEI GENERI PASSANDO UNA GET QUANDO CLICCO SUL LINK IN /home/generi.php

    if(!(isset($_GET['genere']))){
        header('Location: ' . '/ReadingNook/home/generi.php');
    }else{
        $genere = $_GET['genere'];
        $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());
        $query = "SELECT * FROM (Libri_genere JOIN Visualizza_libri on Libri_genere.titolo = Visualizza_libri.titolo) WHERE genere = '$genere' ";
        $result = pg_query($connect,$query);
  
        $output = "";
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
    <!--Boostrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Per aggiungere effetto on hover al nav con jquery-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    
</head>

<body>
  <?php include '../../componenti/navbar.php'; ?>

  

  <div class="conteiner-fluid">
    <div class="row" style="margin: auto;">
            <div class="col-md-8 col-sm-12 mx-auto mt-5">
              <div class="input-group">
                  <!-- BARRA DI RICERCA CHE UTILIZZA LA FUNZIONE IN /funzioni/cerca.js SU id #barra-->
                  <input type="text" class="form-control" id="barra">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                  </div>
                  
                  
              </div>
            </div>
              
      </div>
          
    <br>
    <hr>
    <hr>  
    <div id="genere" class="conteiner">
      <div class="row" style="margin: auto;" id="1">
        <?php
            $colonne = "";

            //CREO LE CARDS CON DATI DEL LIBRO + NOME,COGNOME AUTORE E LE POSIZIONO IN COLONNE
            while($row = pg_fetch_array($result,null,PGSQL_ASSOC)){
              //dati libro
              $copertina = $row["copertina"];
              $titolo = $row["titolo"];
              $valutazione = $row["valutazione"];
              $valutazione = round($valutazione,1);
              $val = ($valutazione / 5) * 100;
              $val = round($val/10)*10;
              $val = "$val%";
              //dati autore
              $nome =$row['nome'];
              $cognome = $row['cognome'];
              $lingua = $row['lingua'];
              
              $colonne .= "
              <div class=\"cerca col-md-4 mt-4 d-block\">
              
                <div class=\"card h-100\">
                  <div class=\"row\">
                    <div class=\"col-4\">
                      <img src=\"$copertina\" class=\"card-img img-fluid mt-lg-0 mt-md-4\">
                    </div>
                    <div class=\"col\">
                      <div class=\"card-body mt-2\">
                        <h5 class=\"card-title text-center\"><a href=\"/ReadingNook/books/book.php?titolo=$titolo\" class=\"text-dark\">$titolo</a></h5>
                        <h6 class=\"card-title\"><a class=\"text-secondary\" href=\"/ReadingNook/author/author.php?nome=$nome&cognome=$cognome\">$nome $cognome</a></h6>
                        <h6 class=\"fw-lighter\">$lingua</h6>
                        <div class=\"stelline\">
                            <div class=\"stars-outer\">
                                <div class=\"stars-inner\" style=\"width: $val;\"></div>
                            </div>
                            <span class=\"number-rating\">$valutazione</span>
                            
                        </div>
                        
                      </div>
                      
                    </div>
                  </div>



                  
                </div>
              
              </div>
              
              
              
              
              
              
              ";

            }
            echo $colonne;

            pg_free_result($result);
            pg_close($connect);
            
          ?>    
      </div>
    </div>
  </div>
  
  <?php include '../../componenti/footer.php'; ?>

  
    
  



    



    

    <!-- Per far apparire il menu a tendina, per la pagination-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/funzioni/cerca.js"></script>
   

</body>

</html>
