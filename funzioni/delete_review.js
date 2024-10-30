$(document).ready(function(){

    //quando faccio click sul button elimina passo i valori al DB con $.post per fare una DELETE
    $(".elimina").on("click",function(){
        //prendo il tasto 
        var p = $(this);
        //prendo il div che contiene le informazioni da passare
        var e = p.closest('.info').attr('id');
        var div = document.getElementById(e);

        //prendo il valore dell'id utente e dell'id libro
        var utente = div.getElementsByClassName('utente')[0].value;
        var libro = div.getElementsByClassName('libro')[0].value;
        //chiamo la funzione per cancellare la recensione
        $.post("/funzioni/delete-review.php", {utente:utente,libro:libro});
        //ricarico la pagina
        location.reload();
    })
})