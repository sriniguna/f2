<?php
/**
 * @package F2
 * @since F2 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permanent Link to %s', 'f2' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php f2_posted_on(); ?>
			<?php if(is_sticky()) : ?>
				<span class="poststicky"><?php _e('Sticky post', 'f2'); ?></span>
			<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() || ( is_archive() && f2_get_option('archive_posts') == 'excerpts' ) || ( is_home() && f2_get_option('home_page_posts') == 'excerpts' ) ) : // Only display Excerpts for Search or if 'show only excerpts' is selceted for home page or archives, whatever the case ?>

		<div class="entry-summary">
			<?php if ( has_post_thumbnail() ): ?>
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( 'echo=0' ); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
			<?php endif; ?>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php else : ?>
		
		<div class="entry-content">
			<?php if ( has_post_thumbnail() ): ?>
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( 'echo=0' ); ?>">
					<?php the_post_thumbnail('full-width'); ?>
				</a>
			</div>
			<?php endif; ?>
			<?php the_content( sprintf(__('Continue reading &lsquo;%s&rsquo; &raquo;', 'f2'), the_title('', '', false)) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'f2' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'f2' ) );
				if ( $categories_list && f2_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php echo __('Filed under', 'f2') .'&nbsp;'. $categories_list; ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'f2' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tag-links">
				<?php echo __('Tagged', 'f2').'&nbsp;'.$tags_list; ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="sep"> | </span>
		<span class="comments-link"><?php comments_popup_link(__('Comment', 'f2'), __('1 Comment', 'f2'), __('% Comments', 'f2')); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'f2' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
