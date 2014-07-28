<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package wptheme-rg
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<div class="container_12">
					<div class="grid_12">
						<?php get_template_part( 'content', 'page' ); ?>
					</div>
				</div>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						echo '<div class="comment-container">';
						echo '<div class="container_12">';
						echo '<div class="grid_9">';
						comments_template();
						echo '</div>';
						echo '</div>';
						echo '</div>';
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<div class="footer-container">
		<div class="container_12">
			<?php get_sidebar(); ?>
			<?php get_footer(); ?>
		</div>
	</div>
