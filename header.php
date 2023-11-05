
<!doctype html>
<html lang="fr">
<head>
	<meta charset="uft-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>MotaPhoto</title>
	<?php wp_head(); ?>
</head>

<header>
<div class="menu-motaphoto">
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
<div class="header">
<h1> Photographe events</h1>
<img class="header__text" src="<?php echo get_template_directory_uri() . '\assets\images\Titre-header.png'; ?> " alt="titre photographe events">
</div>
</header>

<body>