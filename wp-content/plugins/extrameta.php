<?php
/*
Plugin Name: Extra Post Metadata
Description: adds extra meta fields to posts and pages, like the full titles of pages. Don't deactivate this!
Author: Sam Galison
Author URI: http://samgalison.com
License: Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License
*/

/* Define the custom box */

add_action( 'add_meta_boxes', 'extrameta_add_custom_box' );

// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'extrameta_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'extrameta_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function extrameta_add_custom_box() {
    add_meta_box(
    	'fulltitle',
        __( 'Extended Page Title:', 'ft_textdomain' ),
        'ft_box',
        'page'
    );
 }

function ft_box( $post ) {
	if (get_the_title($post->ID) !== 'Auto Draft')
		$fake_ft = get_the_title($post->ID);
	else $fake_ft = 'enter full title here';
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'extrameta_noncename' );

	// The actual fields for data entry

	if (get_post_meta($post->ID, 'ft', true)) $ft_filler = get_post_meta($post->ID, 'ft', true); // show what's already set
	else $ft_filler = $fake_ft;

	echo
		'<label for="ft">
			e.g. "filmmaker biographies"</br>
			- enter "REMOVE" in all caps to clear -</br></br>
		</label>';
	echo '<input type="text" id="ft" name="ft" value="' . $ft_filler . '"size="70" maxlength="200" /><br/>';



}




/* When the post is saved, saves our custom data */
function extrameta_save_postdata( $post_id ) {
	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	  return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !wp_verify_nonce( $_POST['extrameta_noncename'], plugin_basename( __FILE__ ) ) )
	  return;


	// Check permissions
	if ( 'page' == $_POST['post_type'] )
	{
	if ( !current_user_can( 'edit_page', $post_id ) )
	    return;
	}
	else
	{
	if ( !current_user_can( 'edit_post', $post_id ) )
	    return;
	}

	// OK, we're authenticated: we need to find and save the data
		
/* 		update_post_meta($) */

		$ft = $_POST['ft'];
		if ($ft === 'enter full title here') {
			$ft = get_the_title($post_id);
		}
		
		if ($ft) {
			if ($ft === 'REMOVE') {
		  		delete_post_meta($post_id, 'ft');
			}
			else update_post_meta($post_id, 'ft', $ft);
		}

}
?>