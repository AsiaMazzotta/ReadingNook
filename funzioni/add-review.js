$(document).ready(function(){
    //appena faccio click sul tasto di modifica prendo i valori della form da passare al db con $.post e poi faccio il reload della pagina

    //evento on click
    $(".invia").on("click",function(){
        
        //prendo il tasto che ha chiamato la funzione
        var p = $(this);
        //prendo la form "più vicina" al tasto
        var e = p.closest('.form').attr('id');
        var div = document.getElementById(e);

        //valore dell'id utente (salvato all'interno di un input type hidden con classe utente)
        var utente = div.querySelector('[name=utente]').value;
        //valore dell'id del libro (salvato all'interno di un input type hidden con classe libro)
        var libro = div.querySelector('[name=libro]').value;
        //valore del rating inserito (input type radio)
        var rate = div.querySelector('input\[name=rating\]:checked').value;
        //valore del testo (textarea)
        var testo = div.querySelector('textarea\[name=testo\]').value;
        //chiamo la funzione per modificare
        $.post("/funzioni/add-review.php", {utente:utente,libro:libro,rate:rate,testo:testo});
        
        //ricarico la pagina
        location.reload();

        
    })
})