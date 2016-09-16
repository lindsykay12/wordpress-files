<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_options() {

	$options = array();
	$imagepath =  get_template_directory_uri() . '/images/';
	$true_false = array(
		'true' => __('true', 'temptation'),
		'false' => __('false', 'temptation')
	);	
	
	$home_layout = array(
		'gridt' => __('Grid++', 'temptation'),	
		'dyn' => __('Dynamic', 'temptation')		
	);	
	// Get all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	$carousel_count = array(
		'4' => __('4', 'temptation'),
		'5' => __('5', 'temptation'),
		'6' => __('6', 'temptation'),
		'7' => __('7', 'temptation'),
		'8' => __('8', 'temptation'),
		'9' => __('9', 'temptation'),
		'10' => __('10', 'temptation'),
		'11' => __('11', 'temptation'),
		'12' => __('12', 'temptation'),
	);
	
	//Basic Settings
	
	$options[] = array(
		'name' => __('Basic', 'temptation'),
		'type' => 'heading');
			
	$options[] = array(
		'name' => __('Site Logo', 'temptation'),
		'desc' => __('Leave Blank to use text Heading.', 'temptation'),
		'id' => 'logo',
		'class' => '',
		'type' => 'upload');	
		
	$options[] = array(
		'name' => __('Homepage Title For Posts Area', 'temptation'),
		'desc' => __('The title of the Posts Area', 'temptation'),
		'id' => 'hp-post-title',
		'std' => 'Recent Articles',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Pattern or Image', 'temptation'),
		'desc' => __('This is the image which shall be displayed as a Background for Posts and Page Titles. Leave blank to use default.', 'temptation'),
		'id' => 'pattern',
		'class' => '',
		'type' => 'upload');		
		
	
	$options[] = array(
		'name' => __('Copyright Text', 'temptation'),
		'desc' => __('Some Text regarding copyright of your site, you would like to display in the footer.', 'temptation'),
		'id' => 'footertext2',
		'std' => '',
		'type' => 'textarea');

	//Layout Settings
		
	$options[] = array(
		'name' => __('Layout', 'temptation'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => "Sidebar Layout",
		'desc' => "Select Layout for Posts & Pages.",
		'id' => "sidebar-layout",
		'std' => "right",
		'type' => "images",
		'options' => array(
			'left' => $imagepath . '2cl.png',
			'right' => $imagepath . '2cr.png')
	);
	
	$options[] = array(
		'name' => __('Custom CSS', 'temptation'),
		'desc' => __('Some Custom Styling for your site. Place any css codes here instead of the style.css file.', 'temptation'),
		'id' => 'style2',
		'std' => '',
		'type' => 'textarea');
	
	//CAROUSEL SETTINGS
	$options[] = array(
		'name' => __('Carousel', 'temptation'),
		'type' => 'heading');	

	$options[] = array(
		'name' => __('Enable Carousel', 'temptation'),
		'desc' => __('Check this to Enable Carousel on HomePage', 'temptation'),
		'id' => 'carousel_enabled',
		'type' => 'checkbox',
		'std' => '0' );					
		
	if ( $options_categories ) {
	$options[] = array(
		'name' => __('Select Featured Category', 'temptation'),
		'desc' => __('The category from which posts will be fetched', 'temptation'),
		'id' => 'carousel_category',
		'type' => 'select',
		'options' => $options_categories);
	}
	
	$options[] = array(
		'name' => __('Select No of Posts', 'temptation'),
		'desc' => __('The no. of posts you want to display in the carousel.', 'temptation'),
		'id' => 'carousel_count',
		'std' => '6',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $carousel_count);		

	//SHOWCASE SETTINGS

	$options[] = array(
		'name' => __('ShowCase', 'temptation'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Enable Showcase', 'temptation'),
		'desc' => __('Enable Showcase on HomePage', 'temptation'),
		'id' => 'showcase_enabled',
		'type' => 'checkbox',
		'std' => '0' );	
		
	$options[] = array(
		'name' => __('Showcase 1 Title', 'temptation'),
		'desc' => __('Title of the first Showcase Block.', 'temptation'),
		'id' => 'cat1_title',
		'std' => 'Category 1',
		'class' => 'mini',
		'type' => 'text');
	
	if ( $options_categories ) {
	$options[] = array(
		'name' => __('Select Category 1', 'temptation'),
		'desc' => __('The category from which posts will be fetched.', 'temptation'),
		'id' => 'cat1',		
		'class' => 'mini',
		'type' => 'select',
		'options' => $options_categories);
	}
		
	$options[] = array(
		'name' => __('Showcase 2 Title', 'temptation'),
		'desc' => __('Title of the second Showcase Block.', 'temptation'),
		'id' => 'cat2_title',
		'std' => 'Category 2',
		'class' => 'mini',
		'type' => 'text');
	
	if ( $options_categories ) {
	$options[] = array(
		'name' => __('Select Category 2', 'temptation'),
		'desc' => __('The category from which posts will be fetched.', 'temptation'),
		'id' => 'cat2',
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_categories);
	}
				

	//Slider Settings
	
	$options[] = array(
		'name' => __('Slider(Nivo)', 'temptation'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Enable Slider', 'temptation'),
		'desc' => __('Check this to Enable Slider on Welcome Page', 'temptation'),
		'id' => 'slider_enabled',
		'type' => 'checkbox',
		'std' => '0' );	
		
	$options[] = array(
		'name' => __('Using the Slider', 'temptation'),
		'desc' => __('This Slider supports upto 5 Images. To show only 3 Slides in the slider, upload only 3 images. Leave the rest Blank. For best results, upload images of size 1180x500px.', 'temptation'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Slider Image 1', 'temptation'),
		'desc' => __('First Slide', 'temptation'),
		'id' => 'slide1',
		'class' => '',
		'type' => 'upload');
	
	$options[] = array(
		'desc' => __('Title', 'temptation'),
		'id' => 'slidetitle1',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'temptation'),
		'id' => 'slidedesc1',
		'std' => '',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Url', 'temptation'),
		'id' => 'slideurl1',
		'std' => '',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Slider Image 2', 'temptation'),
		'desc' => __('Second Slide', 'temptation'),
		'class' => '',
		'id' => 'slide2',
		'type' => 'upload');
	
	$options[] = array(
		'desc' => __('Title', 'temptation'),
		'id' => 'slidetitle2',
		'std' => '',
		'type' => 'text');	
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'temptation'),
		'id' => 'slidedesc2',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'desc' => __('Url', 'temptation'),
		'id' => 'slideurl2',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Slider Image 3', 'temptation'),
		'desc' => __('Third Slide', 'temptation'),
		'id' => 'slide3',
		'class' => '',
		'type' => 'upload');	
	
	$options[] = array(
		'desc' => __('Title', 'temptation'),
		'id' => 'slidetitle3',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'temptation'),
		'id' => 'slidedesc3',
		'std' => '',
		'type' => 'textarea');	
			
	$options[] = array(
		'desc' => __('Url', 'temptation'),
		'id' => 'slideurl3',
		'std' => '',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Slider Image 4', 'temptation'),
		'desc' => __('Fourth Slide', 'temptation'),
		'id' => 'slide4',
		'class' => '',
		'type' => 'upload');	
		
	$options[] = array(
		'desc' => __('Title', 'temptation'),
		'id' => 'slidetitle4',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'temptation'),
		'id' => 'slidedesc4',
		'std' => '',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Url', 'temptation'),
		'id' => 'slideurl4',
		'std' => '',
		'type' => 'text');		
	
	$options[] = array(
		'name' => __('Slider Image 5', 'temptation'),
		'desc' => __('Fifth Slide', 'temptation'),
		'id' => 'slide5',
		'class' => '',
		'type' => 'upload');	
		
	$options[] = array(
		'desc' => __('Title', 'temptation'),
		'id' => 'slidetitle5',
		'std' => '',
		'type' => 'text');	
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'temptation'),
		'id' => 'slidedesc5',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'desc' => __('Url', 'temptation'),
		'id' => 'slideurl5',
		'std' => '',
		'type' => 'text');
			
	//Social Settings
	
	$options[] = array(
	'name' => __('Social', 'temptation'),
	'type' => 'heading');

	$options[] = array(
		'name' => __('Facebook', 'temptation'),
		'desc' => __('Facebook Profile or Page URL i.e. http://facebook.com/username/ ', 'temptation'),
		'id' => 'facebook',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter', 'temptation'),
		'desc' => __('Twitter Username', 'temptation'),
		'id' => 'twitter',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Google Plus', 'temptation'),
		'desc' => __('Google Plus profile url, including "http://"', 'temptation'),
		'id' => 'google',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Feeburner', 'temptation'),
		'desc' => __('URL for your RSS Feeds', 'temptation'),
		'id' => 'feedburner',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Pinterest', 'temptation'),
		'desc' => __('Your Pinterest Profile URL', 'temptation'),
		'id' => 'pinterest',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Instagram', 'temptation'),
		'desc' => __('Your Instagram Profile URL', 'temptation'),
		'id' => 'instagram',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Linked In', 'temptation'),
		'desc' => __('Your Linked In Profile URL', 'temptation'),
		'id' => 'linkedin',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Youtube', 'temptation'),
		'desc' => __('Your Youtube Channel URL', 'temptation'),
		'id' => 'youtube',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Tumblr', 'temptation'),
		'desc' => __('Your Tumblr Blog URL', 'temptation'),
		'id' => 'tumblr',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Flickr', 'temptation'),
		'desc' => __('Your Flickr Profile URL', 'temptation'),
		'id' => 'flickr',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');						
		
	$options[] = array(
	'name' => __('Support', 'temptation'),
	'type' => 'heading');
	
	$options[] = array(
		'desc' => __('Thank You For Using Temptation WordPress Theme. For Support Visit the <a target="_blank" href="http://inkhive.com/forums/">Support Forums.</a>', 'temptation'),
		'type' => 'info');	
		
	 $options[] = array(
		'desc' => __('<a href="http://twitter.com/rohitinked" target="_blank">Follow Me on Twitter</a> to know about my upcoming themes.', 'temptation'),
		'type' => 'info');		
	
	$options[] = array(
		'name' => __('Regenerating Post Thumbnails', 'temptation'),
		'desc' => __('If you are using temptation Theme on a New Wordpress Installation, then you can skip this section.<br />But if you have just switched to this theme from some other theme, then you are requested regenerate all the post thumbnails. It will fix all the issues you are facing with distorted & ugly homepage thumbnail Images. ', 'temptation'),
		'type' => 'info');	
		
	$options[] = array(
		'desc' => __('To Regenerate all Thumbnail images, Install and Activate the <a href="http://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> WP Plugin. Then from <strong>Tools &gt; Regen. Thumbnails</strong>, re-create thumbnails for all your existing images. And your blog will look even more stylish with Temptation theme.<br /> ', 'temptation'),
		'type' => 'info');	
		
			
	$options[] = array(
		'desc' => __('<strong>Note:</strong> Regenerating the thumbnails, will not affect your original images. It will just generate a separate image file for those images.', 'temptation'),
		'type' => 'info');	
		
	
	$options[] = array(
		'name' => __('Theme Credits', 'temptation'),
		'desc' => __('Check this if you want to you do not want to give us credit in your site footer.', 'temptation'),
		'id' => 'credit1',
		'std' => '0',
		'type' => 'checkbox');



	return $options;
}