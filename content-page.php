<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package F2
 * @since F2 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="featured-image"><?php the_post_thumbnail('full-post'); ?></div>
		<? endif; ?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'f2' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'f2' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
