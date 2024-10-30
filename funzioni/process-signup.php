<?php

    session_start();

    $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());
    //SALVO I DATI DEL NUOVO UTENTE CONTROLLANDO SE LA EMAIL NON È STATA GIÀ USATA ALTRIMENTI RITORNO ERRORE
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $data = date('Y-m-d');
    
    $controllo = "SELECT * FROM Utente WHERE email = '$email'";
    $result = pg_query($connect,$controllo);
    $line = pg_fetch_array($result,null,PGSQL_ASSOC);
    //se l'email non è utilizzata da nessuno 
    if($line == null){
        //inserisco il nuovo utente nel db
        $query1 = "INSERT INTO Utente (nome,cognome,email,pswd,data_iscrizione,img_profilo) VALUES ('$nome','$cognome','$email','$password','$data','/ReadingNook/images/user.png');";
        pg_query($connect,$query1);

        //e creo la sessione con l'id appena creato 
        $query2 ="SELECT id_utente FROM Utente WHERE email = '$email'";
        $result1 = pg_query($connect,$query2);
        $utente = pg_fetch_array($result1,null,PGSQL_ASSOC);

        $id = $utente['id_utente'];
        $_SESSION['userid'] = $id;


       
        
        echo 1;
        
    }else{
        //se esiste un utente con quella email ritorno 0
        echo 0;
    }
    pg_free_result($result);
    pg_free_result($result1);
    pg_close($connect);
    



?>