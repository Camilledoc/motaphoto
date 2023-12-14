(function($){
//menu toggle 
    // hasClass
    function hasClass(elem, className) {
        return elem.hasClass(className);
    }

    // addClass
    function addClass(elem, className) {
        elem.addClass(className);
    }

    // removeClass
    function removeClass(elem, className) {
        elem.removeClass(className);
    }

    // toggleClass
    function toggleClass(elem, className) {
        elem.toggleClass(className);
    }

    let theToggle = $('#toggle');

    theToggle.on('click', function() {
        toggleClass($(this), 'on');
        return false;
    });

    //modale de contact

    // Clic sur le bouton contact dans le menu 
    $("#menu-item-26").on('click',function(event){
        event.preventDefault();
        $("#formRef").val($("#reference").text().toUpperCase());
        $(".popup-overlay").css('display','flex');
    });

    // Clic sur le bouton contact dans le menu responsive 
    $(".menu-item-26").on('click',function(event){
        event.preventDefault();
        $("#formRef").val($("#reference").text().toUpperCase());
        $(".popup-overlay").css('display','flex');
        $("#menu-toggle").hide();
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
    });

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
                if (response.length > 0){ 
                    response.forEach(function(photo){ 
                        $(".photo-catalogue").append(photo); 
                    })
                }
                $("#charger-plus").hide();
            },
        });
    });

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
        // Récupère la valeur sélectionnée dans le menu déroulant des catégories
        let selectedCategorie = $('.taxonomy-categorie_item').val();
        let selectedFormat = $('.taxonomy-format_item').val();
        let selectedOrder = $('.taxonomy-order_item').val();

        $.ajax({
            type:'POST', 
            url: motaphoto_js.ajax_url,
            data:{
                action:'request_photoCatalogue', 
                categorie: selectedCategorie, // Envoie la catégorie sélectionnée au serveur
                format : selectedFormat, // Envoie le format sélectionné au serveur
                order : selectedOrder, // Envoie l'ordre sélectionné au serveur
            }, 
            success:function(response){
                console.log(response);
                $('.photo-catalogue').html(response);
                $("#charger-plus").hide();
            },
        });
    }

})(jQuery);
