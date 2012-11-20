<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package F2
 * @since F2 2.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="aside">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permanent Link to %s', 'f2' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<div class="entry-content">
				<?php the_content(  sprintf(__('Continue reading &lsquo;%s&rsquo; &raquo;', 'f2'), the_title('', '', false)) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .aside -->

		<footer class="entry-meta">
			<?php f2_posted_on(); ?>
			<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link(__('Comment', 'f2'), __('1 Comment', 'f2'), __('% Comments', 'f2')); ?>
			</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'f2' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
