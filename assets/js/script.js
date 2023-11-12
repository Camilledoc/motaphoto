//s'assure que le dom est chargé 
document.addEventListener('DOMContentLoaded', function() {

    let ContactBtn = document.getElementById("menu-item-26");
    let PopupOverlay = document.querySelector(".popup-overlay");

    ContactBtn.addEventListener('click', function(){
        PopupOverlay.style.display ='flex';
    });

    window.onclick = function(event) {
        if(event.target == PopupOverlay) {
            PopupOverlay.style.display ='none';
        }
    };
});