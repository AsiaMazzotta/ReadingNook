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

  <h4 class="text-center mt-4  fst-italic text-decoration-underline">All Authors</h4>
  
  <!-- PRENDO TUTTI I NOMI DEGLI AUTORI DAL DB E LI INSERISCO IN UNA TABELLA-->
  <div class="conteiner-fluid">
    <div class="row g-0">
    <?php
          $output = "";
          $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());

          $lista = array(
            "a" => "",
            "b" => "",
            "c" => "",
            "d" => "",
            "e" => "",
            "f" => "",
            "g" => "",
            "h" => "",
            "i" => "",
            "j" => "",
            "k" => "",
            "l" => "",
            "m" => "",
            "n" => "",
            "o" => "",
            "p" => "",
            "q" => "",
            "r" => "",
            "s" => "",
            "t" => "",
            "u" => "",
            "v" => "",
            "w" => "",
            "x" => "",
            "y" => "",
            "z" => "",
          );


          $query = "SELECT nome,cognome FROM Autore ORDER BY nome;";
          $result = pg_query($connect,$query);
          
          while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
            $nome = $line['nome'];
            $cognome = $line['cognome'];
            //$path = "/ReadingNook/authors/".$nome ."-". str_replace(" ","",$cognome) . ".php";
            $i = strtolower(substr($nome,0,1));
            //A OGNI AUTORE ASSOCIO UN LINK PER LA GET CON CUI PRENDO LA PAGINA SPECIFICA IN /author/author.php
            $lista[$i] .= "
            
              <li class=\"list-group-item fs-5\" style=\"background-color:rgba(149, 221, 250, 0.15);\"><a href=\"/ReadingNook/author/author.php?nome=$nome&cognome=$cognome\">$nome $cognome</a></li>

            ";
          }

          foreach($lista as $lettera => $valore ){
            $lettera = strtoupper($lettera);
            $output .= "
            <div class=\"col-md-4\">
              <ul class=\"list-group border-2 ms-1 me-1 mt-5 lista\">
                <li class=\"list-group-item\"><h4 class=\"text-center fw-bolder\">$lettera</h4></li>
                $valore
              </ul>
            </div>
            ";
            
          }
          echo $output;
          
          
          
          pg_free_result($result);
          pg_close($connect);
          
      ?>    
    </div>
  </div>
  <?php include '../../componenti/footer.php'; ?>
  


    



    

    <!-- Per far apparire il menu a tendina, per la pagination-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/funzioni/cerca.js"></script>
  
  

  


</body>
</html>

