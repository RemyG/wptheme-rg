<?php
/**
 * @package wptheme-rg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php wptheme_rg_posted_on(); ?>
			<?php wptheme_rg_post_comments(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'wptheme-rg' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
			<?php wptheme_rg_post_permalink(); ?>
			<?php wptheme_rg_post_edit(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
