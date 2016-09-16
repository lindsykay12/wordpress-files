<?php
/*
Plugin Name: Comments
*/
?>
<?php
$comments_defaults = array(
    'title' => 'Recent Comments',
    'comments_number' => '5',
    'display_author' => 'true',
    'display_comment' => 'true',
    'display_avatar' => 'true',
    'read_more_text' => '&raquo;',
    'comment_length' => '50',
    'avatar_size' => '32',
    'avatar_align' => 'alignleft'
);

class ihComments extends WP_Widget {
    function __construct() {
        $widget_options = array('description' => 'Advanced widget for displaying the Latest Comments with Author Avatar.' );
        $control_options = array( 'width' => 400);
		$this->WP_Widget('ihComments', 'IH Recent Comments with Avatars', $widget_options, $control_options);
    }

   function widget($args, $instance){
        global $wpdb;
        $title = apply_filters('widget_title', $instance['title']);
        
    	$comments_number = $instance['comments_number'];
        
		$query = 'SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, 
    			SUBSTRING(comment_content,1,50) AS com_excerpt 
    		FROM '.$wpdb->comments .'
    		LEFT OUTER JOIN '.$wpdb->posts.' ON ('.$wpdb->comments.'.comment_post_ID = '.$wpdb->posts.'.ID) 
    		WHERE comment_approved = \'1\' AND comment_type = \'\' AND post_password = \'\' 
    		ORDER BY comment_date_gmt DESC 
    		LIMIT '.$comments_number;
    	$comments = $wpdb->get_results($query);
        ?>
        <?php echo $args['before_widget']?>
        <?php if ( $title ) { ?><?php echo $args['before_title']?><?php echo $title?><?php echo $args['after_title']?><?php } ?>
                <?php
                    foreach ($comments as $comment) {
					$com_link = get_permalink($comment->ID)  . '#comment-' . $comment->comment_ID;
                    ?>
                        <div class="ih-sidebar-comment">
                            <?php 
                                $permalink = get_permalink($comment->ID)  . '#comment-' . $comment->comment_ID;
                                
                                if( $instance['display_avatar']) { ?>
                                    <div class='avatar-container'><?php echo get_avatar( $comment, $instance['avatar_size'] )?></div><div class="com-container"><?php 
                                } 
                              
                                if($instance['display_comment'] || $instance['display_read_more'] || $instance['display_avatar']) {
									if($instance['display_author']) { echo '<strong>&nbsp;'.$comment->comment_author.'</strong>'; }
								
								if($instance['display_comment']) { 
											echo '<p class="comment">'.mb_substr(strip_tags($comment->com_excerpt),0,$instance['comment_length']).'...';
                                 }
                                 if($instance['read_more_text']) { ?>
	                                 <a href='<?php echo $com_link; ?>'><?php echo $instance['read_more_text']; ?></a> </p><?php
                                 } 
                                 else {
                                     echo "</p>";
                                  
                                      }
                                 }    	
                                
                            ?>
                                    </div> 
						<div class="clear"></div>
                        </div>
                    <?php
                	}
                ?>
        <?php echo $args['after_widget']?>
     <?php
    }

    function update($new_instance, $old_instance) {				
    	$instance = $old_instance;
    	$instance['title'] = strip_tags($new_instance['title']);
        $instance['comments_number'] = strip_tags($new_instance['comments_number']);
        $instance['display_author'] = strip_tags($new_instance['display_author']);
        $instance['display_comment'] = strip_tags($new_instance['display_comment']);
        $instance['display_avatar'] = strip_tags($new_instance['display_avatar']);
        $instance['read_more_text'] = strip_tags($new_instance['read_more_text']);
        $instance['comment_length'] = strip_tags($new_instance['comment_length']);
        $instance['avatar_size'] = strip_tags($new_instance['avatar_size']);
        $instance['avatar_align'] = strip_tags($new_instance['avatar_align']);
        return $instance;
    }
    
    function form($instance){
        global $comments_defaults;
		$instance = wp_parse_args( (array) $instance, $comments_defaults );
        
        ?>
        
            <div class="tt-widget">
                <table width="100%">
                    <tr>
                        <td class="tt-widget-label" width="40%"><label for="<?php echo $this->get_field_id('title')?>">Title:</label></td>
                        <td class="tt-widget-content" width="60%"><input class="widefat" id="<?php echo $this->get_field_id('title')?>" name="<?php echo $this->get_field_name('title')?>" type="text" value="<?php echo esc_attr($instance['title'])?>" /></td>
                    </tr>
                    
                    <tr>
                        <td class="tt-widget-label"><label for="<?php echo $this->get_field_id('comments_number')?>">Number of comments:</label></td>
                        <td class="tt-widget-content"><input class="widefat" id="<?php echo $this->get_field_id('comments_number')?>" name="<?php echo $this->get_field_name('comments_number')?>" type="text" value="<?php echo esc_attr($instance['comments_number'])?>" /></td>
                    </tr>
                    
                    <tr>
                        <td class="tt-widget-label"><label for="<?php echo $this->get_field_id('comment_length')?>">Comment length:</label></td>
                        <td class="tt-widget-content">
                            <input class="widefat" id="<?php echo $this->get_field_id('comment_length')?>" name="<?php echo $this->get_field_name('comment_length') ?>" type="text" value="<?php echo esc_attr($instance['comment_length']) ?>" />
                            
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="tt-widget-label"><label for="<?php echo $this->get_field_id('read_more_text')?>">"Read more" text:</label></td>
                        <td class="tt-widget-content"><input class="widefat" id="<?php echo $this->get_field_id('read_more_text')?>" name="<?php echo $this->get_field_name('read_more_text')?>" type="text" value="<?php echo esc_attr($instance['read_more_text'])?>" /></td>
                    </tr>
                    
                    <tr>
                        <td class="tt-widget-label">Display elements:</td>
                        <td class="tt-widget-content">
                            <input type="checkbox" name="<?php echo $this->get_field_name('display_author')?>"  <?php checked('true', $instance['display_author']); ?> value="true" />  Author
                            <br /><input type="checkbox" name="<?php echo $this->get_field_name('display_comment')?>"  <?php checked('true', $instance['display_comment']); ?> value="true" />  Comment
                            <br /><input type="checkbox" name="<?php echo $this->get_field_name('display_avatar')?>"  <?php checked('true', $instance['display_avatar']); ?> value="true" />  Avatar
                        </td>
                    </tr>
                    
                </table>
            </div>
            
        <?php 
    }
} 
add_action('widgets_init', create_function('', 'return register_widget("ihComments");'));
?>