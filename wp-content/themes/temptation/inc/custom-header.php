<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers

 * @package Temptation
 */

function temptation_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'temptation_custom_header_args', array(
		'default-image'          => get_template_directory_uri().'/images/headerbg.jpg',
		'width'                  => 1920,
		'height'                 => 700,
		'flex-height'            => true,
		'wp-head-callback'       => 'temptation_header_style',
		'admin-head-callback'    => 'temptation_admin_header_style',
		'admin-preview-callback' => 'temptation_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'temptation_custom_header_setup' );

if ( ! function_exists( 'temptation_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see temptation_custom_header_setup().
 */
function temptation_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;
}
endif; // temptation_header_style

if ( ! function_exists( 'temptation_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see temptation_custom_header_setup().
 */
function temptation_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
	</style>
<?php
}
endif; // temptation_admin_header_style

if ( ! function_exists( 'temptation_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see temptation_custom_header_setup().
 */
function temptation_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // temptation_admin_header_image
