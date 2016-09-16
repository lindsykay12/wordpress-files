<?php
/**
 * Temptation functions and definitions
 *
 * @package Temptation
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/**
 * Initialize Options Panel
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

if ( ! function_exists( 'temptation_setup' ) ) :

function temptation_setup() {

	load_theme_textdomain( 'temptation', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size('homepage-banner',725,400,true);
	add_image_size('carousel-thumb',390,240,true);
	add_image_size('gridt-thumb',400,250,true);
	add_image_size('showcase-thumb',195,125,true);


	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'temptation' )
	) );

	add_theme_support( 'custom-background', apply_filters( 'temptation_custom_background_args', array(
		'default-color' => '000000',
		'default-image' => '',
	) ) );
	
	add_theme_support( 'post-formats', array( 'image', 'video' ) );
}
endif; // temptation_setup
add_action( 'after_setup_theme', 'temptation_setup' );

function temptation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Home', 'temptation' ),
		'id'            => 'sidebar-home',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'temptation' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'preus' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Center', 'preus' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'preus' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'temptation_widgets_init' );

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
 
<?php
}

function temptation_scripts() {
	wp_enqueue_style( 'temptation-fonts', 'http://fonts.googleapis.com/css?family=Sintony' );
	wp_enqueue_style( 'temptation-basic-style', get_stylesheet_uri() );
	if ( (function_exists( 'of_get_option' )) && (of_get_option('sidebar-layout', true) != 1) ) {
		if (of_get_option('sidebar-layout', true) ==  'right') {
			wp_enqueue_style( 'temptation-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
		}
		else {
			wp_enqueue_style( 'temptation-layout', get_template_directory_uri()."/css/layouts/sidebar-content.css" );
		}	
	}
	else {
		wp_enqueue_style( 'temptation-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
	}
		
	wp_enqueue_style( 'temptation-bxslider-style', get_template_directory_uri()."/css/bxslider/jquery.bxslider.css" );

		
	wp_enqueue_style( 'temptation-bootstrap-style', get_template_directory_uri()."/css/bootstrap/bootstrap.min.css", array('temptation-layout') );
		
	wp_enqueue_style( 'temptation-main-style', get_template_directory_uri()."/css/skins/main.css", array('temptation-layout','temptation-bootstrap-style') );
	
	wp_enqueue_script( 'temptation-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'temptation-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
		
	wp_enqueue_script( 'temptation-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );
		
	wp_enqueue_script( 'temptation-bxslider', get_template_directory_uri() . '/js/bxslider.js', array('jquery') );
	
	
	wp_enqueue_script( 'temptation-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery','hoverIntent') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'temptation-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'temptation_scripts' );

function temptation_custom_head_codes() {

 if ( (function_exists( 'of_get_option' )) && (of_get_option('style2', true) != 1) ) {
	echo "<style>".of_get_option('style2', true)."</style>";
 }
	if ( ( ( of_get_option('slider_enabled') != 0 ) && (is_home() ) )
		|| ( (of_get_option('slider_enabled_front') != 0 ) && (is_front_page() ) ) ) 
		{ ?>
	<script>
 jQuery(document).ready(function(){
			jQuery('#slider').bxSlider( {
			mode: 'horizontal',
			captions: true,
			minSlides: 1,
			maxSlides: 1,
			auto: true,
			preloadImages: 'all',
			adaptiveHeight: true,
			pause: 3300,
			speed: 800,
			autoHover: true } );
			});			
	</script>
	<?php }	
	if ( ( ( of_get_option('carousel_enabled') != 0 ) && (is_home() ) ) ) { ?>
	<script>
		jQuery(document).ready(function() {
	//Set up the carousel 
			jQuery('.bxslider').bxSlider( {
				mode: 'horizontal',
				minSlides: 1,
				maxSlides: 3,
				adaptiveHeight: true,
				slideWidth: 390,
				captions: true,
				autoHover: true,
				slideMargin: 2,
				infiniteLoop: false,
				pager: true,
				controls: false,
				moveSlides: 2 } );
				});	
	</script>
	<?php }		
	
if ( get_header_image() ) : 
 	echo "<style>#parallax-bg { background: url('".get_header_image()."') center top repeat-x; }</style>";
 endif;
 if ( of_get_option('credit1', true) != 0 ) { 
	 echo "<style>#colophon .sep { display: none; }</style>";
	 }
 if ( of_get_option('pattern', true) != "" ) { 
	 echo "<style>#title-bar { background: url(".of_get_option('pattern',true).") }</style>";
	 }		 
}	
add_action('wp_head', 'temptation_custom_head_codes');

function temptation_nav_menu_args( $args = '' )
{
    $args['container'] = false;
    return $args;
} // function
add_filter( 'wp_page_menu_args', 'temptation_nav_menu_args' );

function temptation_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates. Import Widgets
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/widgets/recent-posts.php';
require get_template_directory() . '/inc/widgets/featured-posts.php';
require get_template_directory() . '/inc/widgets/comments.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
