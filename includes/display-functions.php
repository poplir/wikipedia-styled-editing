<?php

// If this file is called directly, abort
if(!defined('ABSPATH'))  {
	exit;
}

/**
 * Only the subscriber should be able to see the form
 */
function wse_render_admin($content) {
    global $wpdb;
    
    // Check if current user is a subscriber
    $current_user = wp_get_current_user();

    if(user_can($current_user, 'subscriber')) {    
        if(is_single()) {
            
            // Display form field below the content
            $extra_content = '
            <div class="wrap">                
                <fieldset>
                <legend><h2>Edit this blog post</h2></legend>
                <form name="wse_form" action="" method="post">
                    <div id="add_stuff">                        
                        <label for="wse_form">Start editing in the field below:</label>

                        <input type="text" name="field1" id="field1" value="'.sanitize_text_field($content).'" /><br><br>

                        <input type="submit" name="wse-submit" id="wse_submit" class="button-primary" value="Submit" />
                        
                    </div>
                </form>
                </fieldset>
            </div>            
            ';
        } 
    }
    
    else {        
        echo "User is not an subscriber.";
    }
    
    $content = $content.$extra_content;
    
    $blog_content = $_POST['field1'];
    
    // After submit button is clicked
    if($_POST['wse-submit']) {
        $extra_content2 = '
            <div class="wrap">                
                <fieldset>
                <legend><h2>Edit this blog post</h2></legend>
                <form name="wse_form" action="" method="post">
                    <div id="add_stuff">                        
                        <label for="wse_form">Start editing in the field below:</label>

                        <input type="text" name="field1" id="field1" value="'.sanitize_text_field($blog_content).'" /><br><br>

                        <input type="submit" name="wse-submit" id="wse_submit" class="button-primary" value="Submit" />
                        
                    </div>
                </form>
                </fieldset>
            </div>            
            ';

        $content = $blog_content.$extra_content2;
        
        $id = get_the_id();

        // Sanitize and save updated content        
        $up_cont = $wpdb->update('wp_posts',
            array('post_content' => sanitize_text_field($blog_content)), 
            array('id' => sanitize_text_field($id))
        );
        
    }
        
    return $content;
    
}

add_filter('the_content', 'wse_render_admin');