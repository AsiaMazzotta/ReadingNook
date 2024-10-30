<?php


   

    $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());
    // numero di card per "pagina"
    $record_per_page = 3;
    $page = '';
    $output = '';


    //controllo che pagina devo visualizzare
    if(isset($_POST["page"]))
    {
        $page = $_POST["page"];
    }else{
        $page = 1;
    }
    //carico il valore di partenza da cui devo prendere i dati dal db
    $startfrom = ($page - 1)*$record_per_page;
   
    $query = "SELECT titolo,copertina,valutazione,lingua FROM Libri_recenti LIMIT $record_per_page OFFSET $startfrom;";
    $result = pg_query($connect,$query);
    
    $output .= "
    
        <div class=\"row\">
    
    ";

    

    while($row = pg_fetch_array($result,null,PGSQL_ASSOC)){
        
        $copertina = $row["copertina"];
        $titolo = $row["titolo"];
        $valutazione = $row["valutazione"];
        $valutazione = round($valutazione,1);
        $val = ($valutazione / 5) * 100;
        $val = round($val/10)*10;
        $val = "$val%";
        $lingua = $row['lingua'];

        // salvo tutte le informazioni del libro e le inserisco in una col contente la card del libro
        $output .= "
        <div class=\"col-md\">
            <a href=\"/ReadingNook/books/book.php?titolo=$titolo\" class=\"text-decoration-none\">
                <div class=\"card h-100\">
                    <img src=\"$copertina\" class=\"card-img-top mt-1 copertina\">
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
    //creo la barra per la navigazione delle pagine che modifico con la classe 'pallini'
    $output .= "</div><div id=\"pallini\" class=\"mt-3\">";

    $page_query = "SELECT titolo,copertina FROM Libri_recenti;";
    $page_result = pg_query($connect,$page_query);
    //numero totale delle pagine da visualizzare
    $total_records = pg_num_rows($page_result);
    $total_pages = ceil($total_records/$record_per_page);

    //scorro il numero di pagine totali che si devono creare e per ogni valori creo un "tasto" (span) che rappresenta la pagina
    for($i=1; $i<=$total_pages; $i++){
        $active_class="";
        if($i==$page){
            $active_class="active";
        }
        $output .= " <span class='pagination_link2 dot $active_class' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'></span>";  

    }
    $output .= '</div>';  
    echo $output; 
    pg_free_result($result);
    pg_free_result($page_result);
    pg_close($connect);
    

?>