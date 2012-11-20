<?php
/**
 * The Sidebars containing widget areas.
 *
 * @package F2
 * @since F2 2.0
 */

$options = f2_get_theme_options();
?>
	<div id="secondary" class="widget-area">
		<?php if ( $options['layout'] != 'no-sidebar' ) : ?>
			<div id="sidebar-1" class="sidebar" role="complementary">
				<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

					<aside id="search" class="widget widget_search">
						<?php get_search_form(); ?>
					</aside>

					<aside id="archives" class="widget">
						<h1 class="widget-title"><?php _e( 'Archives', 'f2' ); ?></h1>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</aside>

					<aside id="meta" class="widget">
						<h1 class="widget-title"><?php _e( 'Meta', 'f2' ); ?></h1>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</aside>

				<?php endif; // end sidebar-1 widget area ?>
			</div><!-- #sidebar-right -->
		<?php endif; ?>

		<?php if( $options['layout'] == 'two-sidebars' ): ?>
			<div id="sidebar-2" class="sidebar" role="complementary">
				<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
				<aside>
					<p><?php echo __('This is the second sidebar. You can add widgets to this sidebar from "Appearance&nbsp;>&nbsp;Widgets" in your wp-admin.', 'f2'); ?></p>
				</aside>
				<?php endif; // end sidebar-2 widget area ?>
			</div><!-- #sidebar-left -->
		<?php endif; ?>
	</div>
