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
   $location = $event['superevents_location'][0];
   $eventdate = $event['superevents_eventdate'][0];
   $time = $event['superevents_time'][0];
   $agenda = $event['superevents_agenda'][0];
   $minutes = $event['superevents_minutes'][0];
   ?>
   <label for="superevents_location">Location :</label>
   <input type="text" name="superevents_location" value="<?php echo $location; ?>" id="superevents_location">
   <label for="superevents_eventdate">Date :</label>
   <input type="text" name="superevents_eventdate" value="<?php echo $eventdate; ?>" id="superevents_eventdate">
   <label for="superevents_time">Time :</label>
   <input type="text" name="superevents_time" value="<?php echo $time; ?>" id="superevents_time">
   <label for="superevents_agenda">Agenda :</label>
   <textarea name="superevents_agenda" id="superevents_agenda" rows="10" cols="60"><?php echo $agenda; ?></textarea>
   <label for="superevents_minutes">Minutes :</label>
   <textarea name="superevents_minutes" id="superevents_minutes" rows="10" cols="60"><?php echo $minutes; ?></textarea>
   <?php
}

add_action('save_post', 'superevents_save_post');

function superevents_save_post()
{
   global $post;
   $fields = array('location','eventdate','time','agenda','minutes');
   foreach($fields as $field)
   {
      if (isset($_POST['superevents_'. $field]))
         update_post_meta($post->ID, "superevents_". $field, $_POST["superevents_". $field]);         
   }
}

register_activation_hook( __FILE__, 'superevents_create_tables' );

add_action( 'admin_enqueue_scripts', 'superevents_add_admin_css' );

function superevents_add_admin_css()
{
   global $post_type;
			
	if ( ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'event' ) || ( isset( $post_type ) && $post_type == 'event' ) ) {

		wp_enqueue_style( 'superevents_admin', plugins_url('/css/superevents_admin.css', __FILE__), array(), '1.0' );

	}
}

function superevents_create_tables()
{
   global $wpdb;
      $table = $wpdb->prefix."events_rsvp";
      $structure = "CREATE TABLE IF NOT EXISTS $table (
         id INT(9) unsigned NOT NULL AUTO_INCREMENT,
         user_id BIGINT(20) NOT NULL,
         event_id BIGINT(20) NOT NULL,
         rsvp VARCHAR(9) DEFAULT 0,
   	   PRIMARY KEY id (id)
      );";
      $wpdb->query($structure);
}

function superevents_uninstall()
{
   //Write code for uninstall
   // Drop table events_rsvp
}

/**
* SuperEvents RSVP widget
*/
class superevents_rsvp_widget extends WP_Widget
{
   function superevents_rsvp_widget()
   {
      $widget_ops = array( 'classname' => 'superevents_rsvp_widget', 'description' => 'Add this to your sidebar to let users RSVP to your events.' );

      /* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'superevents_rsvp_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'superevents_rsvp_widget', 'Events RSVP Widget', $widget_ops, $control_ops );
      
   }
   
   function widget( $args, $instance ) 
   {
   	extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

      echo '</p>RSVP to this meeting. You should be logged in to RSVP</p>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}
}


?>