<?php
    if ( ( ( of_get_option('slider_enabled') != 0 ) && (is_home() ) )
		|| ( (of_get_option('slider_enabled_front') != 0 ) && (is_front_page() ) ) ) 
		{ ?>
    <div class="slider-wrapper">
    <ul id="slider">
    	<?php
		  		$slider_flag = false;
		  		for ($i=1;$i<6;$i++) {
					if ( of_get_option('slide'.$i, true) != "" ) {
						echo "<li><a href='".of_get_option('slideurl'.$i, true)."' title='".of_get_option('slidetitle'.$i, true)."'><img src='".of_get_option('slide'.$i, true)."'></a>";
						?>
						
						<?php if ( ( of_get_option('slidetitle'.$i, true) != "") || ( of_get_option('slidedesc'.$i, true) != "") ) { ?>
						<div class='slider-caption'>
						<?php
						if ( of_get_option('slidetitle'.$i, true) != "") { ?>
						<div class='slider-title'><?php echo of_get_option('slidetitle'.$i, true) ?></div>
						<?php } 
						if ( of_get_option('slidedesc'.$i, true) != "") { ?>
						<div class='slider-desc'><?php echo of_get_option('slidedesc'.$i, true) ?></div></div></li>
						<?php }
						}   
						$slider_flag = true;
					}
				}
           ?>
     </ul>   
	</div>
    
    <?php } 
	?>