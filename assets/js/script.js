(function($){
//modale de contact
    //clic sur le menu contact 
    $("#menu-item-26").on('click',function(event){
         event.preventDefault();
         //remplissage automatique de la ref
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

})(jQuery);

function getRandomImage() {
    const numberOfImages = 16;
    const randomNumber = Math.floor(Math.random() * numberOfImages) ; 
    const imagePath = `../../assets/images/nathalie-${randomNumber}.webp`; // Génère le chemin de l'image en utilisant le numéro aléatoire
    return imagePath;
}

// Fonction pour changer dynamiquement l'image de fond
function changeBackgroundImage() {
    const randomImage = getRandomImage();
    document.documentElement.style.setProperty('--background-image', `url('${randomImage}')`);
}

// Utilisation de la fonction pour changer l'image de fond aléatoirement
changeBackgroundImage();