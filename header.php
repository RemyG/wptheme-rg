<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package wptheme-rg
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wptheme-rg' ); ?></a>

	<div class="container_12">
		<header id="masthead" class="site-header" role="banner">
			<div class="cell">
				<div class="site-branding grid_2">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<!--<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>-->
					</div>
			</div>

			<div class="cell">
				<div class="grid_10">
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle"><?php _e( 'Primary Menu', 'wptheme-rg' ); ?></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</header><!-- #masthead -->
	</div>

	<div id="content" class="site-content">
