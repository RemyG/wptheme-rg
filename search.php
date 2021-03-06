<?php
/**
 * The template for displaying search results pages.
 *
 * @package wptheme-rg
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container_12">
				<div class="grid_12">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wptheme-rg' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'content', 'search' );
						?>

					<?php endwhile; ?>

					<?php wptheme_rg_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				</div><!-- .grid_12 -->
			</div><!-- .container_12 -->
		</main><!-- #main -->
	</section><!-- #primary -->

	<div class="footer-container">
		<div class="container_12">
			<?php get_sidebar(); ?>
			<?php get_footer(); ?>
		</div>
	</div>
