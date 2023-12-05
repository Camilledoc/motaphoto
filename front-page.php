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
  
<div class="filtres">
  <div class="filtres__categorie">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="post">
        <?php
        $terms = get_terms('categorie'); // Récupérer tous les termes de la taxonomie personnalisée

        if ($terms && !is_wp_error($terms)) {
            echo '<select class="taxonomy-categorie_item" name="taxonomy-categorie" id="taxonomy-categorie">';
            echo '<option taxonomy-categorie_hide value="">CATEGORIES</option>';
            foreach ($terms as $term) {
                echo '<option class="taxonomy-categorie_items" value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
            }
            echo '</select>';
        }
        ?>
    </form>
  </div>

  <div class="filtres__format">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="post">
        <?php
        $terms = get_terms('format'); // Récupérer tous les termes de la taxonomie personnalisée

        if ($terms && !is_wp_error($terms)) {
            echo '<select name="taxonomy-format" id="taxonomy-format">';
            echo '<option value="">FORMATS</option>';
            foreach ($terms as $term) {
                echo '<option value="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</option>';
            }
            echo '</select>';
        }
        ?>
    </form>
  </div> 
</div>


<div class="photo-catalogue">
    <?php
        // Appelle la fonction
     
    $photoCatalogue = motaphoto_request_photoCatalogue();
      if ($photoCatalogue){
      foreach ($photoCatalogue as $photo) {
        echo $photo;
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