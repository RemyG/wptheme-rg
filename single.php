<?php
/**
 * The template for displaying all single posts.
 *
 * @package wptheme-rg
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php wptheme_rg_post_nav(); ?>

			<div class="container_12">

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					echo '<div class="grid_9">';
					comments_template();
					echo '</div>';
					echo '<div class="grid_3">';
				else:
					echo '<div class="prefix_9 grid_3 content-meta-container">';
				endif;

				get_template_part( 'content', 'meta' ); ?>

			</div>

			</div>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>