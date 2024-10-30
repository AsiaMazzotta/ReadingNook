$(document).ready(function(){  
    //FUNZIONE JQUERY CON AJAX (stesso funzionamento di /funzioni/high-rating.php)

    load_data();  
    function load_data(page)  
    {  
        $.ajax({  
              url:"/funzioni/recent-add.php",  
              method:"POST",  
              data:{page:page},  
              success:function(data){  
                  $('#recent_reviews').html(data);  
              }  
        })  
    }  
    $(document).on('click', '.pagination_link2', function(){  
        var page = $(this).attr("id");  
        load_data(page);  
    });  
});