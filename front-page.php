<?php get_header(); ?> 

<div class="hero">
  <div class="hero__image">
  <?php
    $photoHero = motaphoto_request_photoHero();

    if ($photoHero && is_array($photoHero) && !empty($photoHero)) {
        foreach ($photoHero as $photo) {
            $image = $photo['img'][0]; // Récupère l'URL de l'image.
        
            echo '<img class="image_hero" src="' . esc_url($image) . '" alt="Photo" />'; 
         
        }

      } else {
        echo 'Aucune photo trouvée.';
    }
    ?>
  </div>
  
  <div class="hero__title">
    <h1> Photographe events</h1>
      <svg version="1.1" xmlns="//www.w3.org/2000/svg" xmlns:xlink="//www.w3.org/1999/xlink" style="display:none;">
        <defs>
          <filter id="stroke-text-svg-filter">
            <feMorphology operator="dilate" radius="2"></feMorphology>
            <feComposite operator="xor" in="SourceGraphic"/>
          </filter>
        </defs>
      </svg>
  </div>
</div>
  

<div class="photo-catalogue">
    <?php
        // Appelle la fonction motaphoto_request_photoCatalogue pour obtenir les détails des photos.
    $photoCatalogue = motaphoto_request_photoCatalogue();

        // Vérifie si $photoCatalogue contient des données valides pour afficher les photos.
    if ($photoCatalogue && is_array($photoCatalogue) && !empty($photoCatalogue)) {
              // Si des données de photos sont disponibles, itère à travers chaque élément du tableau.
        foreach ($photoCatalogue as $photo) {
            $image_url = $photo['img'][0]; // Récupère l'URL de l'image.
            $link_url = $photo['url']; // Récupère l'URL du lien vers le post.
            
            // Affiche le code HTML pour chaque photo avec son URL et son lien.
            echo '<div class="photo-item">';
            echo '<div class="overlay-catalogue">';
            echo '<a href="' . esc_url($link_url) . '">';
            echo '<i class="fa-regular fa-eye"></i>'; // Ajoute une icône pour visualiser la photo.
            echo '</a>';
            echo '<i class="fa-solid fa-expand"></i>'; // Ajoute une icône pour agrandir la photo
            echo '</div>';
            echo '<img class="image-catalogue" src="' . esc_url($image_url) . '" alt="Photo" />'; // Affiche l'image.
            echo '</div>';
        }
                // Si aucun élément n'est trouvé dans $photoCatalogue, affiche un message indiquant qu'aucune photo n'a été trouvée.
    } else {
        echo 'Aucune photo trouvée.';
    }
    ?>
</div>

<div class="photo-catalogue-boutton">
  <a href="">
    <button id="charger-plus" type="button">Charger plus</button>
  </a>
</div>

<?php get_footer(); ?>