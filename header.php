
<!doctype html>
<html lang="fr">
<head>
	<meta charset="uft-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
	<script src="https://kit.fontawesome.com/4d354bce74.js" crossorigin="anonymous"></script>
</head>

<header>
<div class="header-motaphoto">
<a href="<?php echo get_home_url(); ?>">
<img src="<?php echo get_template_directory_uri() . '\assets\images\Logo.png'; ?> " alt="logo motaphoto">
</a>
<nav>
<?php /*affiche mon menu header */
 wp_nav_menu([
    'theme_location' => 'main-menu',
]); 
?>
</nav>
</div>
</header>

<body>