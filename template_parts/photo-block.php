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

                    echo '<a href="' . esc_url($link_url) . '">';
                    echo '<img class="image-block" src="' . esc_url($image_url) . '" alt="Photo" />';
                    echo '</a>';
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
        <a href="https://www.votrelien.com">
            <button id="plus-de-photo" type="button">Toutes les photos</button>
        </a>
    </div>

</div>
