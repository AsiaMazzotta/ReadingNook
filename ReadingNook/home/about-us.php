<!DOCTYPE html>
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
    <link rel="stylesheet" href="/css/about-us.css">
    <link rel="stylesheet" href="/css/style.css">
    
    <!--Boostrap Icons-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Per aggiungere effetto on hover al nav con jquery-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    
    <!--Profilo-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
   
    <style>
      h1,p{
        text-align: center;
      }
    </style>


    
    

   
    <!-- risorse per slide ecc-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
    

 
</head>
<body>

  <a name="iniziopag"></a>
    
  <?php include '../../componenti/navbar.php'; ?>

  
      <!-- Carousel -->
    <div id="prova" class="carousel slide" data-bs-ride="carousel">

      <!-- Indicators/dots -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#prova" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#prova" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#prova" data-bs-slide-to="2"></button>
      </div>

      <!-- The slideshow/carousel -->
      <div class="carousel-inner">
        <div class="carousel-item active" style="background-repeat: no-repeat;background-size: cover;">
          <img src="/ReadingNook/images/3.jpeg" alt="libreria">
          <div class="container">
            <div class="carousel-caption text-start">
              <h1>A place where you can exchange book recommendations.</h1>
              <p>On this site you can easily write e publish a review.</p>
              
            </div>
          </div>
        </div>
        <div class="carousel-item" style="background-repeat: no-repeat;background-size: cover;">
          <img src="/ReadingNook/images/2.jpeg" alt="libri e tè">
          <div class="container">
            <div class="carousel-caption">
              <h1>A website where you can discover new authors.</h1>
              <p>Learn more about authors from the past and the present!</p>
             
            </div>
          </div>
        </div>
        <div class="carousel-item" style="background-repeat: no-repeat;background-size: cover;">
          <img src="/ReadingNook/images/4.jpeg" alt="libri">
          <div class="container">
            <div class="carousel-caption text-end">
              <h1>Reading and sharing points of view with others is what makes you grow. </h1>
              
              
            </div>
          </div>
        </div>
      </div>

      <!-- Left and right controls/icons -->
      <button class="carousel-control-prev" type="button" data-bs-target="#prova" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#prova" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    
    <!-- nuovo container per il resto della pagina -->

    <div class="container marketing">

      <div style="text-align: center;">
        <h1>The creators</h1>
      </div>
      
      <div class="row">
        <div class="col-md col-sm-12 text-center" style="text-align: left;">

          <img class="bd-placeholder-img rounded-circle border border-rounded" width="140" height="140" src="/ReadingNook/images/3.jpeg" ></img>
          <h2 class="mt-1 mb-1">Asia Mazzotta</h2>
          <p>Studentessa Sapienza Università di Roma.</p>

        </div>

        <div class="col-md-5 mt-5"></div>
        
        <div class="col-md col-sm-12 text-center" style="text-align: righ;">

          <img class="bd-placeholder-img rounded-circle border border-2" width="140" height="140" src="/ReadingNook/images/3.jpeg" ></img>
          <h2 class="mt-1 mb-1">Sabrina Natili</h2>
          <p>Studentessa Sapienza Università di Roma.</p>

        </div>
      </div>


      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Start a new adventure with us. <span class="text-muted">It'll be fun!</span></h2>
          <p class="lead">Discover new books from around the world.</p>
        </div>
        <div class="col-md-5">
          <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="https://www.napolidavivere.it/wp-content/uploads/2017/02/BookMob-a-Fuorigrotta-Flash-mob-per-scambiarsi-i-libri.jpg"> </img>

        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading">Life with a book is always better. <span class="text-muted">Look at our site for inspiration.</span></h2>
          
        </div>
        <div class="col-md-5 order-md-1">
          <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="https://i.pinimg.com/564x/e0/8f/9e/e08f9e1fe259d3dfa25cb884e6844bdd.jpg"></img>

        </div>
      </div>


      <hr class="featurette-divider">

      <div class="row featurette">
        
          <h2 class="featurette-heading" style="text-align:center;">If you need anything contact us! </h2>
          <h2 style="text-align:center;"> <span class="text-muted"> We can solve all of your problems!</span> </h2>
          <p class="lead">Our emails:</p>
        </div>
        <div class="col-md-12">
        <p>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
         <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
        </svg>  natili.1947934@studenti.uniroma1.it </p>  
        <p>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
         <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
        </svg>  mazzotta.1933858@studenti.uniroma1.it</p> 
        </div>
      </div>

      <!-- /END THE FEATURETTES -->

    </div>
    <hr class="featurette-divider">


    <!-- FOOTER -->
  
    
    
    
    <!-- ICONA PER TORNARE SU-->

<a href="#iniziopag">

<div id="tornasu">

<img src= "https://img.uxwing.com/wp-content/themes/uxwing/download/arrow-direction/filled-thin-chevron-round-top-icon.svg" class="tornasu"
 width="40px" height="40px"> </img>

</div>
</a>

<?php include '../../componenti/footer.php'; ?>


<script>

    window.addEventListener("scroll",function(){

      if(window.pageYOffset > 300) {
        document.getElementById("tornasu").style.display="block";
      }else {
        document.getElementById("tornasu").style.display="none";
      };

    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/funzioni/cerca.js"></script>
  

</body>

</html>
