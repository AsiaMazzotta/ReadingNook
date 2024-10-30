
//MESSA UNA FUNZIONE DI RELOAD QUANDO SI FA BACK CON IL TASTO DEL CLIENT (altrimenti non si ricaricano i valori)


window.addEventListener( "pageshow", function ( event ) {
    var historyTraversal = event.persisted || 
                           ( typeof window.performance != "undefined" && 
                                window.performance.navigation.type === 2 );
    if ( historyTraversal ) {
      // Handle page restore.
      window.location.reload();
    }
  });