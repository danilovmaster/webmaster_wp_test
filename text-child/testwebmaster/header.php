<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>
		<div class="container">
			<div class="row py-3">
				<div class="col-6 col-md-3">					
						<?php the_custom_logo(); ?>
				</div>
				<div class="col-md-6 d-none d-md-block"></div>
				<div class="col-6 col-md-3 text-right">
					<?php dynamic_sidebar( 'sidebar-4' ); ?>
				</div>
			</div>
		</div>	
		<div class="navigation_top">		
			<div class="container">
				<div class="row align-items-center py-3">			
					<div class="col-6 col-md-9">		
					<?php if ( has_nav_menu( 'top' ) ) : ?>		
					
						<nav class="main-navigation">
							<button class="menu btn btn-secondary d-lg-none d-xs-block ml-2" data-toggle="collapse" data-target="#top-menu">				
							</button>
							
							<?php wp_nav_menu( array(
								'theme_location' => 'top',
								'menu_id'        => 'top-menu',
								'menu_class'      => 'd-lg-flex collapse justify-content-between align-items-center p-4 p-lg-0 my-lg-auto mx-lg-0',    
							) ); ?>
							
						</nav>		
						
					<?php endif; ?>
					</div>
					<div class="col-6 col-md-3">
						<?php dynamic_sidebar( 'sidebar-5' ); ?>
					</div>
				</div>
			</div>
		</div><!-- .navigation-top -->		
	</header><!-- #masthead -->

	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		echo '<div class="single-featured-image-header">';
		echo get_the_post_thumbnail( get_queried_object_id(), 'twentyseventeen-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
