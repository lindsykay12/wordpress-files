<?php
/**
 * The template for displaying search forms in Temptation
 *
 * @package Temptation
 */
?>
<form role="search" method="get" class="row search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'temptation' ); ?></span>
<!-- 		<span class="close-button"><i class="fa fa-times-circle"></i></span> -->
		<input type="text" class="search-field" placeholder="<?php echo esc_attr_e( 'Search...', 'temptation' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<span class="show-fake"><i class="fa fa-search"> </i></span>
</form>