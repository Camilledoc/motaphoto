<footer>
    <div class="menu-footer">
        <nav>
            <?php /*affiche mon menu footer */
            wp_nav_menu([
                'theme_location' => 'footer',
            ]); 
            ?>
            <p>Tous droits réservés</p>
        </nav>
    </div>

    <!-- Modale contact -->
    <?php get_template_part('template_parts/modale-contact'); ?>
    <!-- Modale lightbox -->
    <?php get_template_part('template_parts/modale-lightbox'); ?>
</footer>

<?php wp_footer() ?>
</body>
</html>
