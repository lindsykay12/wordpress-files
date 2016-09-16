<?php
/**
 * The template for displaying search forms in Temptation
 *
 * @package Temptation
 */
?>
<form role="search" method="get" class="row search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<button type="submit" class="btn btn-default search-submit"><i class="fa fa-search"> </i></button>
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'temptation' ); ?></span>
		<input type="text" class="search-field" placeholder="<?php echo esc_attr_e( 'Search for anything on this site...', 'temptation' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
</form>