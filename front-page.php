<?php get_header(); ?> 

<div class="photo-hero">
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

<div class="photo-catalogue">
    <?php
    $photoCatalogue = motaphoto_request_photoCatalogue();

    if ($photoCatalogue && is_array($photoCatalogue) && !empty($photoCatalogue)) {
        foreach ($photoCatalogue as $photo) {
            $image_url = $photo['img'][0];
            $link_url = $photo['url'];
            
            echo '<div class="photo-item">';
            echo '<div class="overlay-catalogue">';
            echo '<a href="' . esc_url($link_url) . '">';
            echo '<i class="fa-regular fa-eye"></i>';
            echo '</a>';
            echo '<i class="fa-solid fa-expand"></i>';
            echo '</div>';
            echo '<img class="image-catalogue" src="' . esc_url($image_url) . '" alt="Photo" />';
            echo '</div>';
        }
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