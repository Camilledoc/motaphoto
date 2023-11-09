
<!doctype html>
<html lang="fr">
<head>
	<meta charset="uft-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
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
<div class="photo-hero">
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
</header>

<body>