<div class="photo-catalogue photo-catalogue-single">
    <div class="photo-block-photo photo-block-photo-single">
        <?php
        $post_id = get_the_ID(); // Récupère l'ID du post actuel
        
        if ($post_id) {
            $photoBlock = motaphoto_request_photoBlock($post_id); // Appel de la fonction avec l'ID du post
            if ($photoBlock) {
                foreach ($photoBlock as $photo) {
                    $image_url = $photo['img'][0];
                    $link_url = $photo['url'];
                    $category = wp_get_post_terms(get_the_ID(), 'categorie', ['fields'=>'names']);

// utilisé sur la page single photo
                    echo '<div class="photo-item" data-ref="'. get_field('reference') .'" data-cat="'. $category[0] .'">';
                    echo '<div class="overlay">';
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
        } else {
            echo 'ID du post introuvable.';
        }
        ?>
    </div>

    <div class="photo-block-boutton">
        <a href="<?php echo get_home_url()?>">
            <button id="plus-de-photo" type="button">Toutes les photos</button>
        </a>
    </div>
</div>
