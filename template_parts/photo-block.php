<div class="photo-block">
    <div class="photo-block-photo">
        <?php
        $post_id = get_the_ID(); // Récupère l'ID du post actuel
        
        if ($post_id) {
            $photoBlock = motaphoto_request_photoBlock($post_id); // Appel de la fonction avec l'ID du post
            if ($photoBlock) {
                foreach ($photoBlock as $photo) {
                    $image_url = $photo['img'][0];
                    $link_url = $photo['url'];
// utiliser sur la page single photo
                    echo '<div class="photo-item">';
                    echo '<div class="overlay">';
                    echo '<a href="' . esc_url($link_url) . '">';
                    echo '<i class="fa-regular fa-eye"></i>'; 
                    echo '</a>';
                    echo '<a href="">';
                    echo '<i class="fa-solid fa-expand"></i>';
                    echo '</a>';
                    echo '</div>';
                    echo '<img class="image-block" src="' . esc_url($image_url) . '" alt="Photo" />';
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
