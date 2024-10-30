<?php

    $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());

    //tutti i valori passati dalla form 
    $rate = $_POST['rate']/2;
    $testo = $_POST['testo'];
    $utente = $_POST['utente'];
    $libro = $_POST['libro'];
    //MODIFICO LA RECENSIONE ORIGINALE 
    $query = "UPDATE Recensioni SET testo = '$testo', valutazione = $rate WHERE id_libro = $libro AND id_utente = $utente;";
    pg_query($connect,$query);
    //AGGIORNO IL VALORE DELLA VALUTAZIONE DEL LIBRO (CON LA MEDIA)
    $query = "UPDATE Libro SET valutazione=(SELECT coalesce(avgscore,0) FROM Media WHERE Libro.id_libro = Media.id_libro) WHERE id_libro = $libro;  ";

    pg_query($connect,$query);


    pg_close($connect);
    
    














?>
