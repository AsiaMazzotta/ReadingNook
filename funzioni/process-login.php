<?php
    session_start();
    
    $password =$_POST['password'];
    $email = $_POST['email'];
    

    $connect = pg_connect("host=localhost port=5432 dbname=readingnook user=postgres password=24082001") or die('Could not connect: ' . pg_last_error());

    $query = "SELECT * FROM Utente where email = '$email';";
    $result = pg_query($connect,$query);
    $line = pg_fetch_array($result);
    
    if ($line != null){
        // effettuo la comparazione della password digitata con quella salvata nel DB
        if (password_verify($password,$line['pswd'])) {
            // in caso di successo creo la sessione
            $_SESSION['userid'] = $line['id_utente'];
            $id = $line['id_utente'];
            if($_POST['rmb'] == 1){
                setcookie('id', $id, time() + 3600, "/");
            }
            // e stampo 1 (che identifica il successo)
            echo 1;
        }else{
            // in caso di comparazione non riuscita stampo zero
            echo 0;
        }
    }else{
        // se non ci sono risultati stampo zero
        echo 0;
    }

    pg_free_result($result);
    pg_close();
    
?>
