<?php
/*
Plugin Name: Super Events
Plugin URI: http://teraom.com/#
Description: A simple events management plugin with RSVP.
Author: Bharadwaj
Version: 0.1
Author URI: http://bharad.net/
License: GPL2
*/

add_action( 'init', 'superevents_register_events' );
add_action('init', 'superevents_updated_messages');
add_action( 'init', 'superevents_register_taxonomy');

// This function add the events post type
function superevents_register_events()
{
   $labels = array(

		'name'               => __( 'Events', 'superevents' ),
		'singular_name'      => __( 'Event', 'superevents' ),
		'add_new'            => __( 'Add New', 'superevents' ),
		'add_new_item'       => __( 'Add New Event', 'superevents' ),
		'edit_item'          => __( 'Edit Event', 'superevents' ),
		'new_item'           => __( 'New Event', 'superevents' ),
		'view_item'          => __( 'View Event', 'superevents' ),
		'search_items'       => __( 'Search Events', 'superevents' ),
		'not_found'          => __( 'No events found', 'superevents' ),
		'not_found_in_trash' => __( 'No events found in Trash', 'superevents' ), 
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Events', 'superevents' )

	);
	
	//Remember to add to below array
   // /		'menu_icon'           => ''. plugins_url( '/images/events-icon-20x20.png', __FILE__ ),
	
	$args = array(

		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => false,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'comments'),
		'taxonomies'          => array( 'type' ),
		'has_archive'         => true,
		'rewrite'             => false,
		'query_var'           => true,
		'can_export'          => true,
		'show_in_nav_menus'   => false
	
	);
		
   register_post_type( 'event', $args );

}

// Adds the taxonomy for event type
function superevents_register_taxonomy() 
{
   $labels = array(
			
		'name'              => __( 'Types', 'superevents' ),
		'singular_name'     => __( 'Type', 'superevents' ),
		'search_items'      => __( 'Search Types', 'superevents' ),
		'popular_items'     => __( 'Popular Types', 'superevents' ),
		'all_items'         => __( 'All Types', 'superevents' ),
		'parent_item'       => __( 'Parent Type', 'superevents' ),
		'parent_item_colon' => __( 'Parent Type:', 'superevents' ),
		'edit_item'         => __( 'Edit Type', 'superevents' ),
		'update_item'       => __( 'Update Type', 'superevents' ),
		'add_new_item'      => __( 'Add New Type', 'superevents' ),
		'new_item_name'     => __( 'New Type Name', 'superevents' ),
		'menu_name'         => __( 'Types', 'superevents' )
			
	);
	
	$args = array(

		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'type' )
	
	);

	register_taxonomy( 'type', 'event', $args );
}

//Adds messages for custom post type - event
function superevents_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages['event'] = array( 

		0  => '',
		1  => sprintf( __( 'Event updated. <a href="%s">View event</a>', 'superevents' ), esc_url( get_permalink($post_ID) ) ),
		2  => __( 'Custom field updated.', 'superevents' ),
		3  => __( 'Custom field deleted.', 'superevents' ),
		4  => __( 'Event updated.', 'superevents' ),
		5  => isset($_GET['revision']) ? sprintf( __( 'Event restored to revision from %s', 'superevents' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Event published. <a href="%s">View event</a>', 'superevents' ), esc_url( get_permalink($post_ID) ) ),
		7  => __( 'Event saved.', 'superevents' ),
		8  => sprintf( __( 'Event submitted. <a target="_blank" href="%s">Preview event</a>', 'superevents' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9  => sprintf( __( 'Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>', 'superevents' ), date_i18n( __( 'M j, Y @ G:i', 'superevents' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __( 'Event draft updated. <a target="_blank" href="%s">Preview event</a>', 'superevents' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),

	);

return $messages;

}

add_filter("manage_edit-event_columns", "superevents_edit_colums");

// Returns the columns for admin, View All Events page
function superevents_edit_colums()
{
   $columns = array(
	
		'cb'         => '<input type="checkbox" />',
		'title'      => __( 'Event Name', 'superevents' ),
		'type'      => __( 'Type', 'superevents' ),
		'head_count' => __( 'Head Count', 'superevents' ),
		'date'       => __( 'Date', 'superevents' )

	);

	return $columns;
}

add_action('manage_posts_custom_column', 'superevents_custom_columns');

function superevents_custom_columns($column)
{
   global $post;

	switch ( $column ) 
	{
	   case 'type' :
	      echo 'Monthly Meeting';
	      break;
	   case 'head_count' :
	      echo '10';
	      break;
   }
}

function superevents_show_event($event='')
{
   if ( file_exists( get_stylesheet_directory()."/superevents_show_event.php" ) ) 
   {
		include( STYLESHEETPATH . '/superevents_show_event.php' );
	}	
	elseif ( file_exists( get_template_directory()."/superevents_show_event.php" ) ) 
	{
		include( TEMPLATEPATH . '/superevents_show_event.php' );
	}
	else 
	{
		include( 'superevents_show_event.php' );
	}
}

add_action('do_meta_boxes', 'superevents_add_meta_box');

function superevents_add_meta_box()
{
   add_meta_box( 'superevents_event_details', 'Event Details', 'superevents_event_details', 'event', 'normal', 'high' );
}

function superevents_event_details()
{
   global $post;
   $event = get_post_custom($post->ID);
   $location = $event['location'][0];
   $date = $event['date'][0];
   $time = $event['time'][0];
   $agenda = $event['agenda'][0];
   $minutes = $event['minutes'][0];
   ?>
   <label for="superevents_location">Location :</label><br/>
   <input type="text" name="superevents_location" value="<?php echo $location; ?>" id="superevents_location">
   <label for="superevents_date">Date</label><br/>
   <input type="text" name="superevents_date" value="<?php echo $date; ?>" id="superevents_date">
   <label for="superevents_time">Time :</label><br/>
   <input type="text" name="superevents_time" value="<?php echo $time; ?>" id="superevents_time">
   <label for="superevents_agenda">Agenda :</label><br/>
   <textarea name="superevents_agenda" id="superevents_agenda" rows="20" cols="60"><?php echo $agenda; ?></textarea>
   <label for="superevents_minutes">Minutes :</label><br/>
   <textarea name="superevents_minutes" id="superevents_minutes" rows="20" cols="60"><?php echo $minutes; ?></textarea>
   <?php
}

add_action('save_post', 'superevents_save_post');

function superevents_save_post()
{
   global $post;
   $fields = array('location','date','time','agenda','minutes');
   
}

?>