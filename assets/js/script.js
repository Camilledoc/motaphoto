(function($){

    $("#menu-item-26").on('click',function(event){
         event.preventDefault();
        $("#formRef").val($("#reference").text().toUpperCase());
        $(".popup-overlay").css('display','flex');
    });

    $(window).on('click', function(event){
        if(event.target == $(".popup-overlay")[0]) {
    $(".popup-overlay").css('display','none'); 
        }
    })
})(jQuery);