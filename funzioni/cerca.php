<?php 

$connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());
$libri = "";
$autori = "";
//controllo se sto cercando qualcosa (s contiene il valore della barra di ricerca)
if ((isset($_POST['s'])) and ($_POST['s']!= "")) {
	$key = "%{$_POST['s']}%";
    //prendo i titoli dei libri e i nomi deglli autori che combaciano con s
	$query1 = "SELECT * FROM Libro WHERE titolo ILIKE '$key' LIMIT 5;";

	$result1 = pg_query($connect,$query1);
        
    $query2 = "SELECT * FROM Autore WHERE nome ILIKE '$key' OR cognome ILIKE '$key' LIMIT 5;";

    $result2 = pg_query($connect,$query2);

    //inserisco tutti i valori all'interno di li separando autori e libri 
	while($line=pg_fetch_array($result1,null,PGSQL_ASSOC)){
            $titolo = $line['titolo'];
            $copertina = $line['copertina'];
            
            $libri .= "<li><img width=\"30\" src=\"$copertina\"><a class=\"ms-2\" href=\"/ReadingNook/books/book.php?titolo=$titolo\" class=\"text-decoration-none\">$titolo</a></li>";
    }
    while($line=pg_fetch_array($result2,null,PGSQL_ASSOC)){
            $nome = $line['nome'];
            $cognome = $line['cognome'];
            
            $autori .= "<li><a href=\"/author/author.php?nome=$nome&cognome=$cognome\">$nome $cognome</a></li>";
    }
    //controllo se ci sono risultati altrimenti ritorno un li da visualizzare
    $d = "<li><h6>Books: </h6></li>";
    if($libri == ""){
        $d .= "<li><a>Not Found!</a></li>";
    }else{
        $d .= $libri;
    }
    $d .= "<li><h6>Authors: </h6></li>";
    if($autori == ""){
        $d .= "<li><a>Not Found!</a></li>";
    }else{
        $d .= $autori;
    }
    echo $d;
		
	
}


pg_free_result($result1);
pg_free_result($result2);
pg_close($connect);

?>