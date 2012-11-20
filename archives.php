<?php
/**
 * Template Name: Archives
 *
 * @package F2
 * @since F2 2.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article class="post">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e('Archives', 'f2') ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<h1><?php _e('Archives by Month', 'f2') ?></h1>
					<ul>
					    <?php wp_get_archives('type=monthly'); ?>
					</ul>
					<p>&nbsp;</p>
					
					<h1><?php _e('Archives by Subject', 'f2') ?></h1>
					<ul>
					     <?php wp_list_categories(array('title_li' => '')); ?>
					</ul>

					<?php if( function_exists('wp_tag_cloud') ) { ?>
					<p>&nbsp;</p>
					<h1><?php _e('Tags', 'f2') ?></h1>
					<?php wp_tag_cloud(); ?>
					<?php } ?>

				</div><!-- .entry-content -->
			</article><!-- <div class="post"></div> -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
