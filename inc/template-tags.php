<?php
/**
 * Custom template tags for this theme.
 *
 *
 * @package F2
 * @since F2 2.0
 */

if ( ! function_exists( 'f2_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since F2 2.0
 */
function f2_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'f2' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'f2' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'f2' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '&laquo; Older Entries', 'f2' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'f2' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // f2_content_nav

if ( ! function_exists( 'f2_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since F2 2.0
 */
function f2_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'f2' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'f2' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'f2' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'f2' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'f2' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply to this comment', 'f2') ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for f2_comment()

if ( ! function_exists( 'f2_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since F2 2.0
 */
function f2_posted_on() {
	$output = '';
	if( f2_get_option( 'hide_author_info' ) != 'on' ) {
		$output .= __('Posted by', 'f2');
		$output .= ' <span class="author vcard"><a class="url fn n" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" title="'.esc_attr( sprintf( __( 'View all posts by %s', 'f2' ), get_the_author() ) ).'" rel="author">'.esc_html( get_the_author() ).'</a></span> ';
		$output .= __('on', 'f2').' ';
	}
	$output .= sprintf( '<a href="%1$s" title="" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		get_the_time(__('j F Y, g:i a', 'f2'))
	);
	echo $output;
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since F2 2.0
 */
function f2_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so f2_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so f2_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in f2_categorized_blog
 *
 * @since F2 2.0
 */
function f2_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'f2_category_transient_flusher' );
add_action( 'save_post', 'f2_category_transient_flusher' );


/**
 * Gets the option name as a string and returns the current value for the option
 *
 * @since F2 2.0
 */
function f2_get_option($option) {
	$options = f2_get_theme_options();
	if( is_array($options) )
		return $options[$option];
}


if ( ! function_exists( 'f2_header_image' ) ) :
/**
 * Renders the header image if a header image is specified in the options
 *
 * @since F2 2.0
 */
function f2_header_image() {
	if( ( $header_image = f2_get_option('header_image') ) && $header_image != 'remove-header' ) {
		echo '<div id="header-image"><a href="'. esc_url( home_url( '/' ) ) .'"><img src="' . $header_image . '" alt=""/></a></div>';
	}
}
endif; // ends check for f2_header_image()


if ( ! function_exists( 'f2_logo_image' ) ) :
/**
 * Renders the logo image if a header image is specified in the options
 *
 * @since F2 2.0
 */
function f2_logo_image() {
	if( $logo_image = f2_get_option('logo_image') ) {
		?><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $logo_image; ?>"/></a><?php
	}
}
endif; // ends check for f2_logo_image()


/**
 * Footer text
 *
 * @since F2 2.0
 */
function f2_footer_text() {
	if( $footer_text = stripslashes( f2_get_option( 'footer_text' ) ) )
		echo "<div>{$footer_text}</div>";
}


