//s'assure que le dom est chargé 
document.addEventListener('DOMContentLoaded', function() {

    let ContactBtn = document.getElementById("menu-item-26");
    let PopupOverlay = document.querySelector(".popup-overlay");

    ContactBtn.addEventListener('click', function(){
        PopupOverlay.style.display ='flex';
    });

    document.addEventListener('click', function(event) {
        // Vérifiez si le clic est en dehors du popup-overlay
        if (event.target === PopupOverlay) {
            // Masquez le popup-overlay
            PopupOverlay.style.display = 'none';
        }
    });
});