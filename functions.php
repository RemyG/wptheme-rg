<?php
/**
 * wptheme-rg functions and definitions
 *
 * @package wptheme-rg
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'wptheme_rg_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wptheme_rg_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wptheme-rg, use a find and replace
	 * to change 'wptheme-rg' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wptheme-rg', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wptheme-rg' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wptheme_rg_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // wptheme_rg_setup
add_action( 'after_setup_theme', 'wptheme_rg_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wptheme_rg_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wptheme-rg' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget grid_4 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'wptheme_rg_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wptheme_rg_scripts() {
	wp_enqueue_style( 'wptheme-rg-style', get_stylesheet_uri() );

	wp_enqueue_style( '960_reset', get_template_directory_uri() . '/css/reset.css' );

	wp_enqueue_style( '960_text', get_template_directory_uri() . '/css/text.css' );

	wp_enqueue_style( '960', get_template_directory_uri() . '/css/960.css' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

	wp_enqueue_style( 'wptheme-rg-custom-style', get_template_directory_uri() . '/css/style.css' );

	wp_enqueue_script( 'wptheme-rg-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'wptheme-rg-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wptheme_rg_scripts' );

if ( ! function_exists( 'wptheme_rg_comment' ) ):
function wptheme_rg_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
    // Display trackbacks differently than normal comments.
  ?>
  <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>" class="comment">
    	<main class="comment">
    <?php _e( 'Pingback:', 'wptheme_rg' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'wptheme_rg' ), '<span class="edit-link">', '</span>' ); ?>
    </main>
  <?php
      break;
    default :
    // Proceed with normal comments.
    global $post;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
    	<div class="vcard">
    		<?php echo get_avatar( $comment, 44 ); ?>
    	</div>
    	<main class="comment">
    		<header class="comment-meta comment-author">
    		<div class="reply">
	        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'wptheme_rg' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	      </div><!-- .reply -->
	        <?php
	        printf( '<div class="date"><a href="%1$s"><time datetime="%2$s">%3$s</time></a></div>',
	            esc_url( get_comment_link( $comment->comment_ID ) ),
	            get_comment_time( 'c' ),
	            /* translators: 1: date, 2: time */
	            sprintf( __( '%1$s at %2$s', 'wptheme_rg' ), get_comment_date(), get_comment_time() )
	          );
	          printf( '<div class="author">%1$s %2$s</div>',
	            get_comment_author_link(),
	            // If current post author is also comment author, make it known visually.
	            ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'wptheme_rg' ) . '</span>' : ''
	          );
	        ?>

	      </header><!-- .comment-meta -->

	      <?php if ( '0' == $comment->comment_approved ) : ?>
	        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wptheme_rg' ); ?></p>
	      <?php endif; ?>

	      <section class="comment-content comment">
	        <?php comment_text(); ?>
	        <?php edit_comment_link( __( 'Edit', 'wptheme_rg' ), '<p class="edit-link">', '</p>' ); ?>
	      </section><!-- .comment-content -->

	      
    	</main>
      
    </article><!-- #comment-## -->
  <?php
    break;
  endswitch; // end comment_type check
}
endif;

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
