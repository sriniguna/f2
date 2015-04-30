<?php
/**
 * F2 functions and definitions
 *
 * @package F2
 * @since F2 2.0
 */

/**
 * Setting the content width based on the theme's design and stylesheet.
 *
 * @since F2 2.0
 */
if ( ! isset( $content_width ) )
	$content_width = 730; /* pixels */

if ( ! function_exists( 'f2_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since F2 2.0
 */
function f2_setup() {

	/*
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/*
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/*
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on F2, use a find and replace
	 * to change 'f2' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'f2', get_template_directory() . '/languages' );

	/*
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );


	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails', array('post', 'page') );
	set_post_thumbnail_size( 150, 150, true ); // Post thumbnail size for excerpts and search results
	add_image_size( 'full-width', 730, 9999 ); // Post thumbnail size for full post displays

	/*
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'f2' ),
	) );

	/*
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // f2_setup
add_action( 'after_setup_theme', 'f2_setup' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since F2 1.0
 */
function f2_widgets_init() {

	$options = f2_get_theme_options();

	/* Sidebar 1, the default sidebar is not activated when 'Content Only (no sidebar)' option is selected. */
	if( $options['layout'] != 'no-sidebar') {
		register_sidebar( array(
			'name' => __( 'Sidebar 1', 'f2' ),
			'id' => 'sidebar-1',
			// 'description' => 'Sidebar displayed on the right hand side.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
	}

	/* Sidebar 2 is activated only when the 'Two Sidebars' option is selcted */
	if( $options['layout'] == 'two-sidebars') {
		register_sidebar( array(
			'name' => __( 'Sidebar 2', 'f2' ),
			'id' => 'sidebar-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
	}

}
add_action( 'widgets_init', 'f2_widgets_init' );


/**
 * Enqueue webfonts
 *
 * @since F2 2.2.1
 */
function f2_enqueue_webfonts() {
	$font_families[] = 'Bitter:700';
	$font_families[] = 'Gudea:400,700,400italic';

	$protocol = is_ssl() ? 'https' : 'http';
	$query_args = array(
		'family' => implode( '|', $font_families ),
	);
	wp_enqueue_style( 'webfonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
}


/**
 * Enqueue scripts and styles
 */
function f2_scripts() {

	$theme  = wp_get_theme();
	if( f2_get_option('disable_webfonts') != 'on' ) {
		f2_enqueue_webfonts();
	}

	wp_enqueue_style( 'style', get_stylesheet_uri(), false, $theme->Version, 'screen, projection' );

	/* Load the non-responsive stylesheet when the non_responsive option is turned on */
	if( f2_get_option('non_responsive') == 'on' ) {
		wp_enqueue_style( 'non-responsive', get_template_directory_uri() . '/non-responsive.css', false, $theme->Version, 'screen, projection'  );
	}

	wp_enqueue_style( 'print', get_template_directory_uri() . '/print.css', false, $theme->Version, 'print'  );

	wp_register_style( 'ie-style', get_template_directory_uri() . '/ie.css', false, $theme->Version, 'screen, projection' );
	$GLOBALS['wp_styles']->add_data( 'ie-style', 'conditional', 'lt IE 9' );
	wp_enqueue_style( 'ie-style' );

	wp_register_style( 'ie7-style', get_template_directory_uri() . '/ie7.css', false, $theme->Version, 'screen, projection' );
	$GLOBALS['wp_styles']->add_data( 'ie7-style', 'conditional', 'lt IE 8' );
	wp_enqueue_style( 'ie7-style' );

	/* Responsive videos */
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array( 'jquery' ), $theme->Version, true );

	/* Do not load small-menu script when the non_responsive option is turned on */
	if( f2_get_option('non_responsive') != 'on' ) {
		wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), $theme->Version, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'f2_scripts' );

/**
* Prints custom styles in the wp_head() area
*/
function f2_head() {

	if( $custom_css = stripslashes( f2_get_option('custom_css') ) ) {
?><!-- Customized F2 styles -->
<style type="text/css">
<?php echo $custom_css; ?>
</style>
<?php
	}
}
add_action( 'wp_head', 'f2_head');


/**
 * Adds custom classes to the array of body classes.
 *
 * @since F2 2.0
 */
function f2_body_class( $classes ) {
	$options = f2_get_theme_options();
	if($options['color_scheme'] && $options['color_scheme'] != 'blue') {
		$classes[] = 'color-scheme-'.$options['color_scheme'];
	}

	if($options['logo_image']) $classes[] = 'has-logo-image';

	if($options['header_image']) $classes[] = 'has-header-image';

	$classes[] = ( $options['layout'] )? $options['layout'] : 'one-sidebar-right';

	$classes[] = ( $options['sidebar_width'] )? $options['sidebar_width'].'-sidebar' : 'medium-sidebar';

	$classes[] = ( $options['sidebar_font_size'] )? $options['sidebar_font_size'].'-font-sidebar' : 'small-font-sidebar';

	$classes[] = ( $options['content_font_size'] )? $options['content_font_size'].'-font-content' : 'large-font-content';

	if( is_singular() && ! get_option('show_avatars') )
		$classes[] = 'no-comment-avatars';

	return $classes;
}
add_filter( 'body_class', 'f2_body_class' );


/**
 * Adds custom classes to the array of post classes.
 *
 * @since F2 2.0
 */
function f2_post_class( $classes ) {
	if( has_post_thumbnail() ) // Check if the current post has a post thumbnail
		$classes[] = 'has-post-thumbnail';
	return $classes;
}
add_filter( 'post_class', 'f2_post_class' );


/**
 * Adds a 'Continue reading...' link at the end of the excrept.
 *
 * @since F2 2.0
 */
if ( ! function_exists( 'f2_excerpt_more' ) ):
function f2_excerpt_more( $more ) {
	global $post;
	return ' ...</p><p><a href="'. get_permalink($post->ID) .'" class="more-link">'. sprintf(__('Continue reading &lsquo;%s&rsquo; &raquo;', 'f2'), the_title('', '', false)) .'</a>';
}
add_filter('excerpt_more', 'f2_excerpt_more');
endif; /* function f2_excerpt_more */