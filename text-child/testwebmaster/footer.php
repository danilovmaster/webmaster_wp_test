<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->
	</div><!-- .site-content-contain -->
	<footer class="row align-items-center m-0">
		<div class="container">
			<div class="row">
			<div class="col-xs-3">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
			<?php				

			if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
						) );
					?>
				</nav><!-- .social-navigation -->
			<?php endif;?>
			</div>
		</div><!-- .wrap -->
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
