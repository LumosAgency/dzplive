<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title(''); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>
		<?php get_template_part('partials/user', 'bar'); ?>
		<div id="top">
			<div class="container">
				<?php get_template_part('partials/logo'); ?>
				<div class="toggle">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<nav id="main-menu">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'menu_class'     => 'main-menu nav nav-pills',
					));
					?>
				</nav>

			</div>
		</div>
	</header>
	<main class="site-main" role="main">