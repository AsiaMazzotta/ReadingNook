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
    <link rel="stylesheet" href="/css/faq.css">
    <link rel="stylesheet" href="/css/style.css">
    
    <!--Boostrap Icons-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Per aggiungere effetto on hover al nav con jquery-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    

    <!--Profilo-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
   
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">

    
   



</head>


<body>
<a name="iniziopag"></a>
<?php include '../../componenti/navbar.php'; ?>


    <main>

        <h1 class="faq-heading">FAQ'S</h1>
        <section class="faq-container">
            <div class="faq-one">

                <!-- faq question -->
                <h3 class="faq-page">How do I search for books on ReadingNook?</h3>

                <!-- faq answer -->
                <div class="faq-body">
                    <p>For all books, you can use the Search Bar found at the top of all pages on the site,the search
                       results will be more accurate the more words you have entered to locate the product. 
                       The search function helps you find what you are looking for as you type, thanks to the suggestions
                       that appear in the drop-down list.</p>
                </div>
            </div>
            <hr class="hr-line">

            <div class="faq-two">

                <!-- domanda -->
                <h3 class="faq-page">How to navigate through the books featured?</h3>

                <!-- risposta -->

                <div class="faq-body">
                    <p>If you wish to search in a category (book genre) you can select the desired category 
                      on the bar available at the top. Once you have completed the search, browse freely among 
                      the books present, or click on any of the titles found and you will have access to the book's 
                      sheet containing all the useful information: author, plot and language of the edition.</p>
                </div>
            </div>
            <hr class="hr-line">


            <div class="faq-three">

                <!-- domanda -->
                <h3 class="faq-page">Do I need to register to use the site?</h3>

                <!-- risposta -->
                <div class="faq-body">
                    <p>The answer is yes, if you want to be able to write a review about a book you read.
                    Also so you will have access to your personal profile, from which you can monitor the reviews you write.
                    Otherwise you can browse freely among the books present. 

                    </p>
                </div>
            </div>
            <hr class="hr-line">


            <div class="faq-four">

                <!-- domanda-->
<h3 class="faq-page">Is there a quick way I can contact you?</h3>

                <!-- risposta -->
                <div class="faq-body">
                    <p>You can write to us directly at our email contacts or at the 
                      number at the bottom of the page. For more information about the site 
                      and about us you can click on the About us page.</p>
                </div>
            </div>
            <hr class="hr-line">


            <div class="faq-five">

                <!-- domanda -->
           <h3 class="faq-page">How can I write a review?</h3>

                <!-- risposta-->
                <div class="faq-body">
                    <p>You can easily go on the book's page you want to write a review about, and then you can publish it.
                      Once you've done that, you can easily access to all your reviews on you profile.
                    </p>
                </div>
            </div>
            <hr class="hr-line">

            <div class="faq-six">

                <!-- domanda -->
           <h3 class="faq-page">Can I delete or edit a review?</h3>

                <!-- risposta-->
                <div class="faq-body">
                    <p>Of course you can: if you go on your profile there is a button for this function that can be easily used. Otherwise you
                      can go to the book's page and there is the appropriate button.
                    </p>
                </div>
            </div>


            

        </section>
    </main>

    <script src="/funzioni/main.js"></script>

    <!-- ICONA PER TORNARE SU-->
    <?php include '../../componenti/footer.php';?>

<a href="#iniziopag">

<div id="tornasu">

<img src= "https://img.uxwing.com/wp-content/themes/uxwing/download/arrow-direction/filled-thin-chevron-round-top-icon.svg" class="tornasu"
 width="40px" height="40px"> </img>

</div>
</a>

<script>

window.addEventListener("scroll",function(){

if(window.pageYOffset > 300) {
document.getElementById("tornasu").style.display="block";
}

else {
document.getElementById("tornasu").style.display="none";
}

});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/funzioni/cerca.js"></script>




</body>


</html>