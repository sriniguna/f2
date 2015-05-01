<?php
/**
 * F2 Theme Options
 *
 * @package F2
 * @since F2 2.0
 */

/**
 * Register the form setting for our f2_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, f2_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since F2 2.0
 */


function f2_theme_options_init() {
	register_setting(
		'f2_options', // Options group, see settings_fields() call in f2_theme_options_render_page()
		'f2_theme_options', // Database option, see f2_get_theme_options()
		'f2_theme_options_validate' // The sanitization callback, see f2_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'color_scheme', // Unique identifier for the settings section
		__('Color Scheme', 'f2'), // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see f2_theme_options_add_page()
	);

	add_settings_section( 'header', __('Header', 'f2'), '__return_false', 'theme_options');
	add_settings_section( 'sidebar', __('Sidebar', 'f2'), '__return_false', 'theme_options');
	add_settings_section( 'content', __('Content', 'f2'), '__return_false', 'theme_options');
	add_settings_section( 'footer', __('Footer', 'f2'), '__return_false', 'theme_options');
	add_settings_section( 'other', __('Other Options', 'f2'), '__return_false', 'theme_options');


	add_settings_field( 'color_scheme', __('Color Scheme', 'f2'), 'f2_settings_field_color_scheme', 'theme_options', 'color_scheme' );

	add_settings_field( 'logo_image', __('Site Logo', 'f2'), 'f2_settings_field_logo_image', 'theme_options', 'header' );
	add_settings_field( 'header_image', __('Header Image', 'f2'), 'f2_settings_field_header_image', 'theme_options', 'header' );
	add_settings_field( 'hide_header_nav', __('Hide Header Navigation Menu', 'f2'), 'f2_settings_field_hide_header_nav', 'theme_options', 'header' );

	add_settings_field( 'layout', __('Site Layout', 'f2'), 'f2_settings_field_layout', 'theme_options', 'sidebar' );
	add_settings_field( 'sidebar_width', __('Sidebar Width', 'f2'), 'f2_settings_field_sidebar_width', 'theme_options', 'sidebar' );
	add_settings_field( 'sidebar_font_size', __('Sidebar Font Size', 'f2'), 'f2_settings_field_sidebar_font_size', 'theme_options', 'sidebar' );
	
	add_settings_field( 'content_font_size', __('Content Font Size', 'f2'), 'f2_settings_field_content_font_size', 'theme_options', 'content' );
	add_settings_field( 'hide_author_info', __('Hide Author Info', 'f2'), 'f2_settings_field_hide_author_info', 'theme_options', 'content' );
	add_settings_field( 'home_page_posts', __('Home Page Posts', 'f2'), 'f2_settings_field_home_page_posts', 'theme_options', 'content' );
	add_settings_field( 'archive_posts', __('Archive Posts', 'f2'), 'f2_settings_field_archive_posts', 'theme_options', 'content' );


	add_settings_field( 'footer_text', __('Footer Text', 'f2'), 'f2_settings_field_footer_text', 'theme_options', 'footer' );
	add_settings_field( 'hide_footer_credits', __('Hide Footer Credits', 'f2'), 'f2_settings_field_hide_footer_credits', 'theme_options', 'footer' );

	add_settings_field( 'disable_webfonts', __('Disable Google Webfonts', 'f2'), 'f2_settings_field_disable_webfonts', 'theme_options', 'other' );
	add_settings_field( 'non_responsive', __('Disable Responsiveness', 'f2'), 'f2_settings_field_non_responsive', 'theme_options', 'other' );
	add_settings_field( 'custom_css', __('Custom CSS', 'f2'), 'f2_settings_field_custom_css', 'theme_options', 'other' );

}
add_action( 'admin_init', 'f2_theme_options_init' );




/**
 * Change the capability required to save the 'f2_options' options group.
 *
 * @see f2_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see f2_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function f2_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_f2_options', 'f2_option_page_capability' );




/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since F2 2.0
 */
function f2_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'f2' ),   // Name of page
		__( 'Theme Options', 'f2' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme_options',               // Menu slug, used to uniquely identify the page
		'f2_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'f2_theme_options_add_page' );



/**
 * Returns an array of color schemes for F2.
 *
 * @since F2 2.0
 */
function f2_color_scheme_options() {
	$color_scheme_options = array(
		'blue' => __( 'Blue', 'f2' ),
		'brown' => __( 'Brown', 'f2' ),
		'green' => __( 'Green', 'f2' ),
		'dark' => __( 'Dark', 'f2' )
	);

	return apply_filters( 'f2_color_scheme_options', $color_scheme_options );
}



/**
 * Returns an array of layouts for F2.
 *
 * @since F2 2.0
 */
function f2_layout_options() {
	$layout_options = array(
		'one-sidebar-right' => __( 'One Sidebar (Right)', 'f2' ),
		'one-sidebar-left' => __( 'One Sidebar (Left)', 'f2' ),
		'two-sidebars' => __( 'Two Sidebars', 'f2' ),
		'no-sidebar' => __( 'Content Only (no sidebar)', 'f2' )
	);

	return apply_filters( 'f2_layout_options', $layout_options );
}



/**
 * Returns an array of sidebar widths for F2.
 *
 * @since F2 2.0
 */
function f2_sidebar_width_options() {
	$sidebar_width_options = array(
		'narrow' => __( 'Narrow', 'f2' ),
		'medium' => __( 'Medium', 'f2' ),
		'wide' => __( 'Wide', 'f2' )
	);

	return apply_filters( 'f2_sidebar_width_options', $sidebar_width_options );
}



/**
 * Returns an array of font sizes for F2.
 *
 * @since F2 2.0
 */
function f2_font_size_options() {
	$font_size_options = array(
		'smaller' => __( 'Smaller', 'f2' ),
		'small' => __( 'Small', 'f2' ),
		'medium' => __( 'Medium', 'f2' ),
		'large' => __( 'Large', 'f2' ),
		'larger' => __( 'Larger', 'f2' ),
	);

	return apply_filters( 'f2_font_size_options', $font_size_options );
}



/**
 * Returns the default theme options as array.
 * If the parameter `$option` (string) is passed, the return value will be the corresponding default value
 * If no parameter is passed, the return value is an array containing default values for all options
 *
 * @since F2 2.0
 */
function f2_default_theme_options($option = '') {
	$defaults = array(
		'color_scheme'          => 'blue',
		'logo_image'             => '',
		'header_image'          => '',
		'hide_header_nav'       => 'off',
		'layout'                => 'one-sidebar-right',
		'sidebar_width'         => 'medium',
		'sidebar_font_size'     => 'small',
		'content_font_size'     => 'large',
		'hide_author_info'      => 'off',
		'home_page_posts'       => 'full_posts',
		'archive_posts'         => 'excerpts',
		'footer_text'           => '&copy; '. date('Y') .' '. get_bloginfo('name'),
		'hide_footer_credits'   => 'off',
		'disable_webfonts'      => 'off',
		'non_responsive'        => 'off',
		'custom_css'            => '',
	);

	$defaults = apply_filters( 'f2_default_theme_options', $defaults );

	if($option) return $defaults[$option];
	else return $defaults;
}


/**
 * Returns the options array for F2.
 *
 * @since F2 2.0
 */
function f2_get_theme_options() {
	$saved = (array) get_option( 'f2_theme_options' );
	$defaults = f2_default_theme_options();
	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}



/**
 * Renders the color scheme option.
 *
 * @since F2 2.0
 */
function f2_settings_field_color_scheme() {
	$options = f2_get_theme_options();

	foreach ( f2_color_scheme_options() as $value => $label ) {
	?>
	<div class="color_scheme">
		<label>
			<img src="<?php echo get_template_directory_uri() ?>/images/color-schemes/<?php echo $value; ?>.png" alt="<?php echo $label; ?>" width="200" height="150" /><br />
			<input type="radio" name="f2_theme_options[color_scheme]" value="<?php echo esc_attr( $value ); ?>" <?php checked( $options['color_scheme'], $value ); ?> />
			<?php echo $label; ?>
		</label>
	</div>
	<?php
	}

}

/**
 * Renders the site logo image upload form.
 *
 * @since F2 2.0
 */
function f2_settings_field_logo_image() {
	$options = f2_get_theme_options();
	?>
	<input type="url" name="f2_theme_options[logo_image]" id="logo-image" class="image-url" size="36" value="<?php echo esc_url( $options['logo_image'] ); ?>" />
	<input id="logo-image-upload-button" class="image-upload-button button-secondary" type="button" value="Upload Image" />
	<label class="description" for="logo-image"><?php _e( 'Enter an URL or upload an image.', 'f2' ); ?></label>
	<div class="description" style="font-style: italic;"><?php _e('This image will replace the site title and tagline in header.', 'f2'); ?></div>
	<?php
}




/**
 * Renders the header image upload form.
 *
 * @since F2 2.0
 */
function f2_settings_field_header_image() {
	$options = f2_get_theme_options();
	?>
	<input type="url" name="f2_theme_options[header_image]" id="header-image" class="image-url" size="36" value="<?php echo esc_url( $options['header_image'] ); ?>" />
	<input id="header-image-upload-button" class="image-upload-button button-secondary" type="button" value="Upload Image" />
	<label class="description" for="header-image"><?php _e( 'Enter an URL or upload an image.', 'f2' ); ?></label>
	<div class="description" style="font-style: italic;"><?php _e('This image will stretch or shrink if necessary and fill the entire page width.', 'f2'); ?></div>
	<?php
}

/**
 * Renders the 'hide header nav' setting field.
 */
function f2_settings_field_hide_header_nav() {
	$options = f2_get_theme_options();
	?>
	<label for="hide-header-nav">
		<input type="checkbox" name="f2_theme_options[hide_header_nav]" id="hide-header-nav" <?php checked( 'on', $options['hide_header_nav'] ); ?> />
	</label>
	<?php
}


/**
 * Renders the layout options setting field.
 *
 * @since F2 2.0
 */
function f2_settings_field_layout() {
	$options = f2_get_theme_options();

	foreach ( f2_layout_options() as $value => $label ) {
	?>
	<div class="layout">
		<label>
			<img src="<?php echo get_template_directory_uri() ?>/images/layouts/<?php echo $value; ?>.png" alt="<?php echo $label; ?>" width="136" height="122" /><br />
			<input type="radio" name="f2_theme_options[layout]" value="<?php echo esc_attr( $value ); ?>" <?php checked( $options['layout'], $value ); ?> />
			<?php echo $label; ?>
		</label>
	</div>
	<?php
	}
}


/**
 * Renders the sidebar width setting field.
 *
 * @since F2 2.0
 */
function f2_settings_field_sidebar_width() {
	$options = f2_get_theme_options();

	foreach ( f2_sidebar_width_options() as $value => $label ) {
	?>
	<div class="sidebar_width">
		<label>
			<input type="radio" name="f2_theme_options[sidebar_width]" value="<?php echo esc_attr( $value ); ?>" <?php checked( $options['sidebar_width'], $value ); ?> />
			<?php echo $label; ?>
		</label>
	</div>
	<?php
	}

}


/**
 * Renders the sidebar font size setting field.
 *
 * @since F2 2.0
 */
function f2_settings_field_sidebar_font_size() {
	$options = f2_get_theme_options();
	?>
	<select name="f2_theme_options[sidebar_font_size]" id="sidebar-font-size">
		<?php
			foreach ( f2_font_size_options() as $value => $label ) {
				$selected = ($value == $options['sidebar_font_size'])? ' selected="selected"' : '';
				echo "\n\t<option style=\"padding-right: 10px;\"{$selected} value='" . esc_attr( $value ) . "'>".$label."</option>";
			}
		?>
	</select>
	<?php
}


/**
 * Renders the content font size setting field.
 *
 * @since F2 2.0
 */
function f2_settings_field_content_font_size() {
	$options = f2_get_theme_options();
	?>
	<select name="f2_theme_options[content_font_size]" id="content-font-size">
		<?php
			foreach ( f2_font_size_options() as $value => $label ) {
				$selected = ($value == $options['content_font_size'])? ' selected="selected"' : '';
				echo "\n\t<option style=\"padding-right: 10px;\"{$selected} value='" . esc_attr( $value ) . "'>".$label."</option>";
			}
		?>
	</select>
	<?php
}



/**
 * Renders the 'hide author info' field.
 */
function f2_settings_field_hide_author_info() {
	$options = f2_get_theme_options();
	?>
	<label for="hide-author-info">
		<input type="checkbox" name="f2_theme_options[hide_author_info]" id="hide-author-info" <?php checked( 'on', $options['hide_author_info'] ); ?> />
		<?php _e( 'Hide author information in post meta', 'f2' ); ?>
	</label>
	<?php
}


/**
 * Renders the 'home_page_posts' setting field.
 */
function f2_settings_field_home_page_posts() {
	$options = f2_get_theme_options();
	if($options['home_page_posts'] == 'excerpts')
		$selected = array( 'full_posts' => '', 'excerpts' => ' selected="selected"' );
	else
		$selected = array( 'full_posts' => ' selected="selected"', 'excerpts' => '' );
	?>
		<select name="f2_theme_options[home_page_posts]" id="home-page-posts">
			<option value="full_posts"<?php echo $selected['full_posts']; ?>><?php echo __('Show full posts', 'f2'); ?></option>
			<option value="excerpts"<?php echo $selected['excerpts']; ?>><?php echo __('Show only excerpts', 'f2'); ?></option>
		</select>
	<?php
}



/**
 * Renders the 'archive_posts' setting field.
 */
function f2_settings_field_archive_posts() {
	$options = f2_get_theme_options();
	if($options['archive_posts'] == 'excerpts')
		$selected = array( 'full_posts' => '', 'excerpts' => ' selected="selected"' );
	else
		$selected = array( 'full_posts' => ' selected="selected"', 'excerpts' => '' );
	?>
		<select name="f2_theme_options[archive_posts]" id="archive-posts">
			<option value="full_posts"<?php echo $selected['full_posts']; ?>><?php echo __('Show full posts', 'f2'); ?></option>
			<option value="excerpts"<?php echo $selected['excerpts']; ?>><?php echo __('Show only excerpts', 'f2'); ?></option>
		</select>
	<?php
}


/**
 * Renders the 'footer-text' setting field.
 */
function f2_settings_field_footer_text() {
	$options = f2_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="f2_theme_options[footer_text]" id="footer-text" cols="50" rows="5" /><?php echo esc_textarea( stripslashes( $options['footer_text'] ) ); ?></textarea>
	<?php
}


/**
 * Renders the 'disable-webfonts' setting field.
 *
 * @since F2 2.1
 */

function f2_settings_field_disable_webfonts() {
	$options = f2_get_theme_options();
	?>
	<label for="disable-webfonts">
		<input type="checkbox" name="f2_theme_options[disable_webfonts]" id="disable-webfonts" <?php checked( 'on', $options['disable_webfonts'] ); ?> />
	</label>
	<?php

}

/**
 * Renders the 'non-responsive' setting field.
 *
 * @since F2 2.2
 */

function f2_settings_field_non_responsive() {
	$options = f2_get_theme_options();
	?>
	<label for="non-responsive">
		<input type="checkbox" name="f2_theme_options[non_responsive]" id="non-responsive" <?php checked( 'on', $options['non_responsive'] ); ?> />
	</label>
	<?php

}



/**
 * Renders the 'custom-css' setting field.
 */
function f2_settings_field_custom_css() {
	$options = f2_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="f2_theme_options[custom_css]" id="custom-css" cols="50" rows="10" /><?php echo esc_textarea( stripslashes( $options['custom_css'] ) ); ?></textarea>
	<?php
}


function f2_settings_field_hide_footer_credits() {
	$options = f2_get_theme_options();
	?>
	<label for="hide-footer-credits">
		<input type="checkbox" name="f2_theme_options[hide_footer_credits]" id="hide-footer-credits" <?php checked( 'on', $options['hide_footer_credits'] ); ?> />
		<?php _e( 'Hide links to WordPress and F2 in footer', 'f2' ); ?>
	</label>
	<?php

}




/**
 * Renders the Theme Options administration screen.
 *
 * @since F2 2.0
 */
function f2_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php $theme_name = wp_get_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'f2' ), $theme_name ); ?></h2>
		<div class="theme-links">
			<a href="<?php echo esc_url( 'http://srinig.com/wordpress/themes/f2/' ); ?>" class="button"><?php _e('Visit Theme Home Page', 'f2'); ?></a>
			<a href="<?php echo esc_url( 'http://wordpress.org/support/theme/f2' ); ?>" class="button"><?php _e('Get Support', 'f2'); ?></a>
			<a href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/f2' ); ?>" class="button"><?php _e('Provide Feedback', 'f2'); ?></a>
			<a href="<?php echo esc_url( 'http://srinig.com/wordpress/themes/f2/#donate' ); ?>" class="button"><?php _e('Make a Donation', 'f2'); ?></a>
		</div>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'f2_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>

	</div>
	<?php
}

/**
 * Sanitize color scheme value
 *
 * @since F2 2.2.3
 */
function f2_sanitize_color_scheme( $value ) {
	if( array_key_exists( $value, f2_color_scheme_options() ) ) {
		return $value;
	} else {
		return null;
	}
}


/**
 * Sanitize layout value
 *
 * @since F2 2.2.3
 */
function f2_sanitize_layout( $value ) {
	if( array_key_exists( $value, f2_layout_options() ) ) {
		return $value;
	} else {
		return null;
	}
}


/**
 * Sanitize sidebar width value
 *
 * @since F2 2.2.3
 */
function f2_sanitize_sidebar_width( $value ) {
	if( array_key_exists( $value, f2_sidebar_width_options() ) ) {
		return $value;
	} else {
		return null;
	}
}


/**
 * Sanitize font size value
 *
 * @since F2 2.2.3
 */
function f2_sanitize_font_size( $value ) {
	if( array_key_exists( $value, f2_font_size_options() ) ) {
		return $value;
	} else {
		return null;
	}
}


/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see f2_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since F2 2.0
 */
function f2_theme_options_validate( $input ) {
	$output = array();

	// The color scheme value must be in our array of color scheme options
	if ( isset( $input['color_scheme'] ) ) {
		$output['color_scheme'] = f2_sanitize_color_scheme( $input['color_scheme'] );
	}

	// The site logo url must be safe text with no HTML tags
	if ( isset( $input['logo_image'] ) && ! empty( $input['logo_image'] ) )
		$output['logo_image'] = esc_url_raw( $input['logo_image'] );


	// The header image url must be safe text with no HTML tags
	if ( isset( $input['header_image'] ) && ! empty( $input['header_image'] ) )
		$output['header_image'] = esc_url_raw( $input['header_image'] );

	// Checkboxes will only be present if checked.
	if( isset( $input['hide_header_nav'] ) )
		$output['hide_header_nav'] = 'on';

	// The layout value must be in our array of layout option values
	if ( isset( $input['layout'] ) )
		$output['layout'] = f2_sanitize_layout( $input['layout'] );

	// The sidebar width value must be in our array of sidebar width values
	if ( isset( $input['sidebar_width'] ) )
		$output['sidebar_width'] = f2_sanitize_sidebar_width( $input['sidebar_width'] );


	// The sidebar_font_size value must be in our array of sidebar_font_size option values
	if ( isset( $input['sidebar_font_size'] ) )
		$output['sidebar_font_size'] = f2_sanitize_font_size( $input['sidebar_font_size'] );

	// The sidebar_font_size value must be in our array of content_font_size option values
	if ( isset( $input['content_font_size'] ) )
		$output['content_font_size'] = f2_sanitize_font_size( $input['content_font_size'] );

	// Checkboxes will only be present if checked.
	if ( isset( $input['hide_author_info'] ) )
		$output['hide_author_info'] = 'on';

	// `home_page_posts` value must be either `full_posts` or `excerpts`
	if ( isset( $input['home_page_posts'] ) && in_array( $input['home_page_posts'], array('full_posts', 'excerpts') ) )
		$output['home_page_posts'] = $input['home_page_posts'];

	// `archive_posts` value must be either `full_posts` or `excerpts`
	if ( isset( $input['archive_posts'] ) && in_array( $input['archive_posts'], array('full_posts', 'excerpts') ) )
		$output['archive_posts'] = $input['archive_posts'];

	// The textarea must be safe text with the allowed tags for posts
	if ( isset( $input['footer_text'] ) )
		$output['footer_text'] = wp_filter_post_kses( stripslashes( $input['footer_text'] ) );

	// Checkboxes will only be present if checked.
	if ( isset( $input['hide_footer_credits'] ) )
		$output['hide_footer_credits'] = 'on';

	// Checkboxes will only be present if checked.
	if ( isset( $input['disable_webfonts'] ) )
		$output['disable_webfonts'] = 'on';

	// Checkboxes will only be present if checked.
	if ( isset( $input['non_responsive'] ) )
		$output['non_responsive'] = 'on';


	// The textarea must be safe text with the allowed tags for posts
	if ( isset( $input['custom_css'] ) )
		$output['custom_css'] = wp_filter_post_kses( stripslashes( $input['custom_css'] ) ) ;

	return apply_filters( 'f2_theme_options_validate', $output, $input );
}


/**
 * Registers the settings available for wp_customizer
 *
 * @since F2 2.0
 */

function f2_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'color_scheme', array(
		'title' => __( 'Color Scheme', 'f2'),
		'priority' => 10
		)
	);

	$wp_customize->add_section( 'header_image', array(
		'title' => __( 'Header Image', 'f2'),
		'priority' => 108
		)
	);


	$wp_customize->add_section( 'sidebar_settings', array(
		'title' => __( 'Sidebar', 'f2'),
		'priority' => 109
		)
	);

	$wp_customize->add_section( 'content_settings', array(
		'title' => __( 'Content', 'f2'),
		'priority' => 111
		)
	);




	/* Color Schemes */

	$wp_customize->add_setting( 'f2_theme_options[color_scheme]', array(
		'default'	        => f2_default_theme_options('color_scheme'),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'f2_sanitize_color_scheme',
	) );

	$wp_customize->add_control( 'f2_color_scheme', array(
		'label'   => __('Color Scheme', 'f2' ),
		'section' => 'color_scheme',
		'settings' => 'f2_theme_options[color_scheme]',
		'type' => 'select',
		'choices' => f2_color_scheme_options(),
	 ) );




	/* Site Logo Image */

	$wp_customize->add_setting( 'f2_theme_options[logo_image]', array(
		'default'        => f2_default_theme_options('logo_image'),
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'f2_logo_image', array(
		'label'   => __( 'Site Logo (replaces site title and tagline)', 'f2' ),
		'section' => 'title_tagline',
		'settings' => 'f2_theme_options[logo_image]',
	) ) );


	/* Header Background Image */

	$wp_customize->add_setting( 'f2_theme_options[header_image]', array(
		'default'        => f2_default_theme_options('header_image'),
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'f2_header_image', array(
		'label'   => __( 'Header Image', 'f2' ),
		'section' => 'header_image',
		'settings' => 'f2_theme_options[header_image]',
		'priority' => 20
	) ) );


	/* Number of sidebars */

	$wp_customize->add_setting( 'f2_theme_options[layout]', array(
		'default'        => f2_default_theme_options('layout'),
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'f2_sanitize_layout',
	) );

	$wp_customize->add_control( 'f2_layout', array(
		'label'      => __( 'Layout', 'f2' ),
		'section'    => 'sidebar_settings',
		'settings'   => 'f2_theme_options[layout]',
		'type'       => 'select',
		'choices'    => f2_layout_options(),
	) );

	/* Sidebar width */

	$wp_customize->add_setting( 'f2_theme_options[sidebar_width]', array(
		'default'        => f2_default_theme_options('sidebar_width'),
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'f2_sanitize_sidebar_width',
	) );

	$wp_customize->add_control( 'f2_sidebar_width', array(
		'label'      => __( 'Sidebar Width', 'f2' ),
		'section'    => 'sidebar_settings',
		'settings'   => 'f2_theme_options[sidebar_width]',
		'type'       => 'radio',
		'choices'    => f2_sidebar_width_options(),
	) );



	/* Sidebar font size */

	$wp_customize->add_setting( 'f2_theme_options[sidebar_font_size]', array(
		'default'        => f2_default_theme_options('sidebar_font_size'),
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'f2_sanitize_font_size',
	) );

	$wp_customize->add_control( 'f2_sidebar_font_size', array(
		'label'      => __( 'Sidebar Font Size', 'f2' ),
		'section'    => 'sidebar_settings',
		'settings'   => 'f2_theme_options[sidebar_font_size]',
		'type'       => 'select',
		'choices'    => f2_font_size_options(),
	) );


	/* Content font size */

	$wp_customize->add_setting( 'f2_theme_options[content_font_size]', array(
		'default'        => f2_default_theme_options('content_font_size'),
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'transport'      => 'postMessage',
		'sanitize_callback' => 'f2_sanitize_font_size',
	) );

	$wp_customize->add_control( 'f2_content_font_size', array(
		'label'      => __( 'Content Font Size', 'f2' ),
		'section'    => 'content_settings',
		'settings'   => 'f2_theme_options[content_font_size]',
		'type'       => 'select',
		'choices'    => f2_font_size_options(),
	) );
}
add_action( 'customize_register', 'f2_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
*/
function f2_customize_preview_js() {
	wp_enqueue_script( 'f2_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), wp_get_theme()->Version, true );
}
add_action( 'customize_preview_init', 'f2_customize_preview_js' );


function f2_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('theme-options-scripts', get_template_directory_uri() . '/js/theme-options.js', array('jquery','media-upload','thickbox') );
}
 
function f2_admin_styles() {
	wp_enqueue_style('thickbox');
	wp_enqueue_style('theme-options-styles', get_template_directory_uri() . '/inc/theme-options/theme-options.css' );
}

if (isset($_GET['page']) && $_GET['page'] == 'theme_options') {
	add_action('admin_print_scripts', 'f2_admin_scripts');
	add_action('admin_print_styles', 'f2_admin_styles');
}


/**
 * Add Theme Options menu item to Admin Bar.
 * @since F2 2.2
 */
function f2_adminbar() {
	
	global $wp_admin_bar;
	
	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id' => 'theme_options',
		'title' => __( 'Theme Options', 'f2' ),
		'href' => admin_url( 'themes.php?page=theme_options' )
  ));
}
add_action( 'wp_before_admin_bar_render', 'f2_adminbar' );
