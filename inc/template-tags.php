<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wptheme-rg
 */

if ( ! function_exists( 'wptheme_rg_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function wptheme_rg_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'wptheme-rg' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'wptheme-rg' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wptheme-rg' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'wptheme_rg_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function wptheme_rg_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'wptheme-rg' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'wptheme-rg' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'wptheme-rg' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'wptheme_rg_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function wptheme_rg_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '<i class="fa fa-bookmark-o"></i> %s', 'post date', 'wptheme-rg' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'wptheme-rg' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	//echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
	echo '<span class="posted-on">' . $posted_on . '</span>';

}
endif;

if ( ! function_exists( 'wptheme_rg_post_categories' ) ) :
function wptheme_rg_post_categories() {
	$categories_list = get_the_category_list( __( ', ', 'wptheme-rg' ) );
	if ( $categories_list && wptheme_rg_categorized_blog() ) :
		echo '<div class="cat-links">';
		printf( __( '<h2>Categor'.(sizeof($tags_list) > 1 ? 'y' : 'ies').'</h2> <div>%1$s</div>', 'wptheme-rg' ), $categories_list );
		echo '</div>';
	endif;
}
endif;

if ( ! function_exists( 'wptheme_rg_post_tags' ) ) :
function wptheme_rg_post_tags() {
	$tags_list = get_the_tag_list( '', __( ', ', 'wptheme-rg' ) );
	if ( $tags_list ) :
		echo '<div class="tags-links">';
		printf( __( '<h2>Tag'.(sizeof($tags_list) > 1 ? '' : 's').'</h2> <div>%1$s</div>', 'wptheme-rg' ), $tags_list );
		echo '</div>';
	endif;
}
endif;

if ( ! function_exists( 'wptheme_rg_post_author' ) ) :
function wptheme_rg_post_author() {
	echo '<div class="author">';
	echo __( '<div class="vcard">'.get_avatar( get_the_author_meta( 'ID' ), 50 ).'</div> <h2>Author</h2> <div class="author-name"><a class="url fn n" href="' .
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></div>', 'wptheme-rg' );
	echo '</div>';
}
endif;

if ( ! function_exists( 'wptheme_rg_post_comments' ) ) :
function wptheme_rg_post_comments() {
	if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
		echo '<div class="comments-link">';
		if (get_comments_number() == 0) {
			echo __( '<i class="fa fa-comment-o"></i> ', 'wptheme-rg' );
		}
		else if (get_comments_number() == 1) {
			echo __( '<i class="fa fa-comment"></i> ', 'wptheme-rg' );
		}
		else if (get_comments_number() > 1) {
			echo __( '<i class="fa fa-comments"></i> ', 'wptheme-rg' );
		}
		echo comments_popup_link( __( 'Leave a comment', 'wptheme-rg' ), __( '1 Comment', 'wptheme-rg' ), __( '% Comments', 'wptheme-rg' ) ).'</div>';
	endif;
}
endif;

if ( ! function_exists( 'wptheme_rg_post_permalink' ) ) :
function wptheme_rg_post_permalink() {
	printf( __( '<div class="permalink"><i class="fa fa-link"></i> <a href="%1$s" rel="bookmark">Permalink</a><div>', 'wptheme-rg'), get_permalink() );
}
endif;

if ( ! function_exists( 'wptheme_rg_post_edit' ) ) :
function wptheme_rg_post_edit() {
	edit_post_link( __( 'Edit', 'wptheme-rg' ), '<div class="edit-link"><i class="fa fa-pencil"></i> ', '</div>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function wptheme_rg_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'wptheme_rg_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wptheme_rg_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so wptheme_rg_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so wptheme_rg_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in wptheme_rg_categorized_blog.
 */
function wptheme_rg_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'wptheme_rg_categories' );
}
add_action( 'edit_category', 'wptheme_rg_category_transient_flusher' );
add_action( 'save_post',     'wptheme_rg_category_transient_flusher' );
