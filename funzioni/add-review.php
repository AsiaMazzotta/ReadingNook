<?php

$id_libro = $_POST['libro'];
$id_utente = $_POST['utente'];
$testo = $_POST['testo'];
$valutazione = ($_POST['rating'])/2;

//per evitare errori dal pg_query
$testo = str_replace("'","''",$testo);


$ehi = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());
//inserisco la nuova recensione 
$query = "INSERT INTO Recensioni(id_utente,id_libro,testo,orario,valutazione) VALUES
          ($id_utente,$id_libro,'$testo',current_timestamp,$valutazione);";

pg_query($ehi,$query);

//aggiorno la valutazione del libro
$query = "UPDATE Libro SET valutazione=(SELECT avgscore FROM Media WHERE Libro.id_libro = Media.id_libro) WHERE id_libro = $id_libro; ";
pg_query($ehi,$query);

pg_close($ehi);


?>