(function($){
//modale de contact
    // Clic sur le bouton contact dans le menu 
    $("#menu-item-26").on('click',function(event){
         event.preventDefault();
        $("#formRef").val($("#reference").text().toUpperCase());
        $(".popup-overlay").css('display','flex');
    });

    //clic sur le bouton contact dans la page single
    $("#single-contact").on('click',function(event){
        event.preventDefault();
       $("#formRef").val($("#reference").text().toUpperCase());
       $(".popup-overlay").css('display','flex');
   });

    //fermeture modale quand clic en dehors de la fenêtre
    $(window).on('click', function(event){
        if(event.target == $(".popup-overlay")[0]) {
    $(".popup-overlay").css('display','none'); 
        }
    })

//navigation miniature avec les flèches    
$(".arrow-prev").hover( 
    function() {
        $(".miniature-prev").css('display','flex');
        },
        function(){
        $(".miniature-prev").css('display','none');
        }
   );

   $(".arrow-next").hover( 
    function() {
        $(".miniature-next").css('display','flex');
        }, 
        function(){
        $(".miniature-next").css('display','none');
       }
);

// bouton charger plus en AJAX 

$("#charger-plus").on('click', function(event){
    event.preventDefault();
    $.ajax({
        type:'POST',
        url: motaphoto_js.ajax_url,
        data:{ 
            action:'loadingAllPhotos', 
        }, 
        success:function(response){ 
            console.log(response); 
            if (response.length>0){ 
                response.forEach(function(photo){ 
                    $(".photo-catalogue").append(photo); 
                })
            }
            $("#charger-plus").hide();
        },

    });
}
);

// Filtres en AJAX 

$(".taxonomy-categorie_item").on('change', function(event){
    event.preventDefault();
    ajaxRequest();
});

$(".FORMAT").on('change', function(event){
    event.preventDefault();
    ajaxRequest();
});

$(".ORDER").on('change', function(event){
    event.preventDefault();
    ajaxRequest();
});

function ajaxRequest(){
    // Récupérer la valeur sélectionnée dans le menu déroulant des catégories
    let selectedCategorie = $('.taxonomy-categorie_item').val();
    let selectedFormat = $('.FORMAT').val();
    let selectedOrder = $('.ORDER').val();

    $.ajax({
        type:'POST', 
        url: motaphoto_js.ajax_url,
        data:{
            action:'request_photoCatalogue', 
            categorie: selectedCategorie, // Envoyer le format sélectionné au serveur
            format : selectedFormat, // Envoyer le format sélectionné au serveur
            order : selectedOrder, // Envoyer le format sélectionné au serveur
        }, 
        success:function(response){
            console.log(response);
            $('.photo-catalogue').html(response);

            $("#charger-plus").hide();
        },

    });
}

})(jQuery);