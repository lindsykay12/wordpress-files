<?php
/**
 * Temptation Theme Customizer
 *
 * @package Temptation
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function temptation_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control( 'header_textcolor');
	
	$wp_customize->add_setting( 'temptation_title_color', array (
			'default'	=> '#a7a7a7',
		) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'temptation_title_color', array(
			'label'    => __( 'Site Title Color', 'temptation' ),
			'section'  => 'colors',
			'settings' => 'temptation_title_color',
			'priority'    => 102,
	) ) );
	
	$wp_customize->add_setting( 'temptation_desc_color', array (
			'default'	=> '#ff8a00',
		) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'temptation_desc_color', array(
			'label'    => __( 'Site Description Color', 'temptation' ),
			'section'  => 'colors',
			'settings' => 'temptation_desc_color',
			'priority'    => 102,
	) ) );
		
}
add_action( 'customize_register', 'temptation_customize_register' );

if ( ! function_exists( 'temptation_apply_color' ) ) :
  function temptation_apply_color() { ?>
  		<style id="temptation-custom-style">
  		<?php if (get_theme_mod('temptation_desc_color') ) : ?>
  			.site-description { color: <?php echo get_theme_mod('temptation_desc_color') ?> }
  		<?php endif; ?>
  		<?php if (get_theme_mod('temptation_title_color') ) : ?>
  			.site-title a { color: <?php echo get_theme_mod('temptation_title_color') ?> }
  		<?php endif; ?>
  		
  		
  		</style>
  	
  <?php 	
  }
  endif;

add_action( 'wp_head', 'temptation_apply_color' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function temptation_customize_preview_js() {
	wp_enqueue_script( 'temptation_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'temptation_customize_preview_js' );
