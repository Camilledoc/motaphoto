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
        <h1>Photographe events</h1>
    </div>
</div>

<div class="filtres">
    <div class="filtres-taxo">
        <div class="filtres__categorie">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="post">
                <?php
                $terms = get_terms('categorie'); // Récupérer tous les termes de la taxonomie personnalisée

                if ($terms && !is_wp_error($terms)) {
                    echo '<select class="taxonomy-categorie_item" name="taxonomy-categorie" id="taxonomy-categorie">';
                    echo '<option value="">CATEGORIES</option>';
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
                    echo '<select class="taxonomy-format_item" name="taxonomy-format" id="taxonomy-format">';
                    echo '<option value="">FORMATS</option>';
                    foreach ($terms as $term) {
                        echo '<option class="taxonomy-format_items" value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                    }
                    echo '</select>';
                }
                ?>
            </form>
        </div>
    </div>

    <div class="filtres__date">
        <form action="<?php echo esc_url(home_url('/')); ?>" method="post">
            <?php
            echo '<select class="taxonomy-order_item" name="order" id="order">';
            echo '<option>TRIER PAR</option>';
            if ($selectedOrder && !is_wp_error($selectedOrder)) {
                echo '<option class="taxonomy-order_items" value="DESC">Du plus récent au plus ancien</option>';
                echo '<option class="taxonomy-order_items" value="ASC">Du plus ancien au plus récent</option>';
            } else {
                echo '<option class="taxonomy-order_items" value="DESC">Du plus récent au plus ancien</option>';
                echo '<option class="taxonomy-order_items" value="ASC">Du plus ancien au plus récent</option>';
            }
            echo '</select>';
            ?>
        </form>
    </div>
</div>

<div class="photo-catalogue">
    <?php
    // Appelle la fonction
    $photoCatalogue = motaphoto_request_photoCatalogue();
    if ($photoCatalogue) {
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
