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

$(".taxonomy-format_item").on('change', function(event){
    event.preventDefault();
    ajaxRequest();
});

$(".taxonomy-order_item").on('change', function(event){
    event.preventDefault();
    ajaxRequest();
});

function ajaxRequest(){
    // Récupérer la valeur sélectionnée dans le menu déroulant des catégories
    let selectedCategorie = $('.taxonomy-categorie_item').val();
    let selectedFormat = $('.taxonomy-format_item').val();
    let selectedOrder = $('.taxonomy-order_item').val();

    $.ajax({
        type:'POST', 
        url: motaphoto_js.ajax_url,
        data:{
            action:'request_photoCatalogue', 
            categorie: selectedCategorie, // Envoyer la catégorie sélectionné au serveur
            format : selectedFormat, // Envoyer le format sélectionné au serveur
            order : selectedOrder, // Envoyer l'ordre sélectionné au serveur
        }, 
        success:function(response){
            console.log(response);
            $('.photo-catalogue').html(response);

            $("#charger-plus").hide();
        },

    });
}


//modale lightbox
      
    // Récupération dynamique des données pour construire photosData 
let LightboxData = [];
let currentIndex = 0; 


$('.photo-item').each(function(index) {
    let $this = $(this);
    let imageData = {};
    console.log($this);

     // Récupération des données de l'image
     imageData.id = index + 1; // Un identifiant unique pour chaque image
     imageData.url = $this.find('.image-catalogue').attr('src'); // Récupère l'URL de l'image
     imageData.ref = $this.data("ref");
     imageData.cat = $this.data("cat");

     // Ajout des données au tableau LightboxData
     LightboxData.push(imageData);
    });

    // Clic sur le bouton agrandissement
    $('.photo-catalogue').on('click', '.fa-expand', function(event){
        event.preventDefault();
        
        // Positionnement et affichage de la modale à l'emplacement du clic
        $('.lightbox-overlay').css({
        display: 'flex', 
    });

        // Récupérer l'index de l'image dans le tableau LightboxData
        let  index = $(this).closest('.photo-item').index();

        // Récupérer les données de l'image à partir du tableau
        let imageData = LightboxData[index];

    // Afficher l'image dans la lightbox
    if (imageData && imageData.url) {
    let imageHTML = '<img src="' + imageData.url + '" alt="Photo en grand" />';
    $(".lightbox-photo").html(imageHTML);
    $(".lightbox-details_ref").html(LightboxData[currentIndex].ref);
    $(".lightbox-details_cat").html(LightboxData[currentIndex].cat);
        } else {
            console.error("Les données de l'image sont incorrectes.");
        }
});
//Gestion de la navigation vers la photo précédente
$('.lightbox-arrow-precedent').click(function(event) {
    event.preventDefault();
    currentIndex--;
    if (currentIndex < 0) {
        currentIndex=LightboxData.length-1;}
        $(".lightbox-photo img").attr("src", LightboxData[currentIndex].url);
        $(".lightbox-details_ref").html(LightboxData[currentIndex].ref);
        $(".lightbox-details_cat").html(LightboxData[currentIndex].cat);
    });

//Gestion de la navigation vers la photo suivante
$('.lightbox-arrow-suivant').click(function(event) {
    event.preventDefault();
    currentIndex++;
    if (currentIndex > LightboxData.length-1) {
        currentIndex=0;}
        $(".lightbox-photo img").attr("src", LightboxData[currentIndex].url);
        $(".lightbox-details_ref").html(LightboxData[currentIndex].ref);
        $(".lightbox-details_cat").html(LightboxData[currentIndex].cat);
    
});

   //fermeture modale quand clic sur la croix 
   $(".lightbox-close").on('click',function(event){
    event.preventDefault();
   $(".lightbox-overlay").css('display','none');
});

   //fermeture modale quand clic en dehors de la fenêtre
   $(window).on('click', function(event){
       if(event.target == $(".lightbox-overlay")[0]) {
   $(".lightbox-overlay").css('display','none'); 
       }
   });

})(jQuery);