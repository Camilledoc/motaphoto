<?php get_header(); ?>

<h2> Mon template </h2> 

<?php
if (have_posts()) {
    while (have_posts()) :
        the_post();
        the_title();
        the_content();
        the_category();
    endwhile;
} else {
    echo 'Aucun contenu trouvé';
}
?>

<?php get_footer();?>