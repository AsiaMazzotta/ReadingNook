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

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap');
    </style>
</head>

<body>

  <?php include '../../componenti/navbar.php'; ?>
  

  

  <div class="container-fluid">
    <div class="row mt-3 mx-auto">

      
      <div class="col-lg-6 col-md-12 order-lg-2">
        <ul class="list-group border border-1 rounded mb-3">
          <li class="list-group-item"><h4 class="text-center mt-1">Recommended</h4></li>

            <?php
            
            //SCRIPT DI PHP CHE PRENDE 5 TITOLI DALLA VIEW RACCOMANDATI E SE RIMANE SPAZIO PRENDE ALTRI TITOLI CASUALI DA LIBRO CON LA FUNZIONE RANDOM()

            $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());
            $query = "SELECT DISTINCT titolo FROM Raccomandati;";
            $result = pg_query($connect,$query);
            if($result == false){
              echo pg_last_error($connect);
            }
            if(pg_num_rows($result) == 0){
              $q = "SELECT titolo from Libro ORDER BY RANDOM() LIMIT 5;";
              $result =  pg_query($connect,$q);
            }
            $d = "";
            $i = 0;
            while($r = pg_fetch_array($result,null,PGSQL_ASSOC)){
              $titolo = $r['titolo'];
              $d .= "<li class=\"list-group-item\"><a href=\"/ReadingNook/books/book.php?titolo=$titolo\" class=\"text-decoration-underline fst-italic\">$titolo</a></li>";
              $i++;
            }
            if($i<5){
              $e = 5-$i;
              $q = "SELECT titolo from Libro ORDER BY RANDOM() LIMIT $e;";
              $result =  pg_query($connect,$q);
              while($r = pg_fetch_array($result,null,PGSQL_ASSOC)){
                $titolo = $r['titolo'];
                $d .= "<li class=\"list-group-item\"><a href=\"/ReadingNook/books/book.php?titolo=$titolo\" class=\"text-decoration-underline fst-italic\">$titolo</a></li>";
              }
            }
            echo $d;
            pg_free_result($result);
            pg_close($connect);

          ?>
          
        </ul>

      </div>
      
    
      <div class="col-lg-6 col-md-12 border border-2 rounded order-lg-1">
        <div class="row">
          <h4 class="text-center mt-1">High Rating</h4>
        </div>
          
        <div id="high_rating" class="conteiner"></div>
            <!--  RIEMPIO IL DIV ATTRAVERSO UNA CHIAMATA AJAX PER FARE UNA PAGINAZIONE DI CARDS (/funzioni/high-rating.js)-->
      </div>

    </div>  
    
  
    <div class="row mx-auto mt-3" >

      <div class="col-lg-6 col-md-12 border border-2 rounded">
        <div class="row">
          <h4 class="text-center mt-1">New Release</h4>
        </div>
          
        <div id="recent_reviews"></div>
        <!--  RIEMPIO IL DIV CON AJAX (/funzioni/recent-add.js)-->

      </div>

      <div class="col-lg-6 col-md-12 d-lg-block frase">
            <!--  FRASE PER RIEMPIRE LO SPAZIO QUANDO LO SCHERMO È GRANDE (display diventa none quando lo schermo è piccolo attraverso una query in /css/style.css) -->
        
         <div class="row">
           <h4 class="text-center mt-1" style="font-family: cursive;">«There is no Frigate like a Book
                                        To take us Lands away,
                                        Nor any Coursers like a Page
                                        Of prancing Poetry -
                                        This Traverse may the poorest take
                                        Without oppress of Toll -
                                        How frugal is the Chariot
                                        That bears a Human soul.»</h4>
            <h4 class="text-end" style="font-family: cursive; font-weight:bolder;">- Emily Dickinson</h4>
         </div>
            
      </div>

      
      
          
      
          
        
        

    
      

      
    </div>
  </div>

  
  
  <?php include '../../componenti/footer.php'; ?>

  

    



    

    <!-- Per far apparire il menu a tendina, per la pagination-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- SCRIPT PER LA BARRA DI RICERCA DELLA NAVBAR-->
    <script src="/funzioni/cerca.js"></script>
    <!--  SCRIPT PER RIEMPIRE I DUE DIV CON CARDS -->
    <script src="/funzioni/high-rating.js"></script>
    <script src="/funzioni/recent-add.js"></script>
    <script src="/funzioni/reload.js"></script>


</body>

</html>
