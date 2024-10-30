$(document).ready(function(){

  //FUNZIONE DI RICERCA PER LA BARRA DELLA NAVBAR CON JQUERY (VISUALIZZAZIONE CON CSS IN /css/style.css SEZ PER IL NAV)
    fetchData();       
    function fetchData(){
      //salvo il valore della barra di ricerca della navbar
      var s = $("#search").val();
      //se ancora non si sta cercando niente allora la sezione in cui si mostrano i risultati non è visibile
      if (s == '') {
        $('#dropdown').css('display', 'none');
      }else{
        //se sto cercando qualcosa invece prendo i valori dal db e li inserisco nella sezione #dropdown con display visibile (block)
        $.post("/funzioni/cerca.php", 
            {
              s:s
            },
            function(data, status){
                if (data != "") {
                  $('#dropdown').css('display', 'block');
                  $('#dropdown').html(data);
                }
            });
      }
      
    }
    $("#search").on("input",fetchData);
   
    $("body").on("click",function(){
      $("#dropdown").css('display','none');
    });
});


//FUNZIONE DI RICERCA PER LA BARRA SITUATA IN /genres/genre (pagina che mostra tutti i libri che hanno un certo genere)
$('#barra').on("input",function(){
  //valore cercato nella barra
  var str = document.getElementById('barra').value;
  //in r ci sono tutte le colonne che contengono le cards
  var r = document.getElementById('1').getElementsByClassName('cerca');
  
  //scorro tutte le colonne
  for(var i = 0; i < r.length; i++){
    //prendo il titolo del libro nella colonna (si trova all'interno del tag a)
    var a = r.item(i).getElementsByTagName('a');
    var titolo = a[0].innerHTML.toLowerCase();
    

    /*controllo se il titolo contiene il valore inserito nella barra:
        -se si allora mantengono la classe d-block
        -se no allora sostituisco d-block con d-none  */
        
    if(titolo.includes(str)){
      r.item(i).classList.remove('d-none');
      r.item(i).classList.add('d-block');
    }else{
      r.item(i).classList.add('d-none');
      r.item(i).classList.remove('d-block');
    }
  }
});