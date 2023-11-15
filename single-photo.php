<?php get_header(); ?>

<?php
// On récupère les champs ACF nécessaires
$reference = get_post_meta($post->ID,'reference', true);
$type = get_post_meta($post->ID,'type', true);
?>
<div class="single-photo"> 
    <div class="single-photo-container"> 
        <div class="single-photo__info">
        <?php if ( have_posts() ) : while( have_posts()  ) : the_post(); ?>
        <h2><?php the_title(); ?></h2>

        <?php if ($reference) {
        echo '<p class="description_photo"> Référence : <span id="reference">' . $reference . '</span></p>';
        } ?>

        <?php
        // Récupérer les termes de la taxonomie pour le CPT actuel
        $taxoCategorie = get_the_terms(get_the_ID(), 'categorie');
        // Vérifier si des termes ont été trouvés
        if ($taxoCategorie && !is_wp_error($taxoCategorie)) {
        echo '<p class="description_photo">Catégorie : ';
        foreach ($taxoCategorie as $taxoCategorie) {
        echo '<a href="' . get_term_link($taxoCategorie) . '">' . $taxoCategorie->name . '</a> ';
        }
        echo '</p>';
        }
        ?>

        <?php
        $taxoFormat = get_the_terms(get_the_ID(), 'format');
        if ($taxoFormat && !is_wp_error($taxoFormat)) {
            echo '<p class="description_photo">Format : ';
            foreach ($taxoFormat as $taxoFormat) {
                echo '<a href="' . get_term_link($taxoFormat) . '">' . $taxoFormat->name . '</a> ';
            }
            echo '</p>';
        }
        ?>


            <?php if ($type) {
                echo '<p class="description_photo"> Type : ' . $type . '</p>';
            } ?>

            <?php
            $year = get_the_date('Y');
            echo '<p class="description_photo"> Date : ' . $year . '</p>';
            ?>

            </div>

        <div class="single-photo__image"> <?php the_post_thumbnail( 'medium_large' ); ?> </div>
        <?php endwhile; endif; ?>
        </div>

    <div class="single-photo-interaction">
        <div class="interesse">
        <p> Cette photo vous intéresse?</p>
        <button id="single-contact" type="button">Contact</button>
        </div>
        <div class="navigation">
        </div>
        </div>
</div>


<?php get_footer();?>