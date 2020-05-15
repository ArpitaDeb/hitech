<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              arghya.d1990@gmail.com
 * @since             1.0.0
 * @package           Wpctm
 *
 * @wordpress-plugin
 * Plugin Name:       WPCTM
 * Plugin URI:        arghya.d1990@gmail.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Arghya Dutta
 * Author URI:        arghya.d1990@gmail.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpctm
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpctm-activator.php
 */
function activate_wpctm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpctm-activator.php';
	Wpctm_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpctm-deactivator.php
 */
function deactivate_wpctm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpctm-deactivator.php';
	Wpctm_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpctm' );
register_deactivation_hook( __FILE__, 'deactivate_wpctm' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpctm.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpctm() {

	$plugin = new Wpctm();
	$plugin->run();

}
run_wpctm();

add_action('admin_menu', 'manage_wpctm_adminpage');
add_action( 'init', 'create_slider_post_type' );
add_action( 'init', 'create_service_post_type' );
add_action( 'init', 'create_home_service_box_post_type' );

function manage_wpctm_adminpage(){
	
	global $_registered_pages;

	$page_title="hitech-panel";

	$menu_title="Hi-Tech Panel";

	$parent_slug=$menu_slug="hitech-panel";

	$capability="manage_options";

	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, 'manage_wpctm_option', '');
}
	
function manage_wpctm_option(){
	require_once 'admin/partials/wpctm-admin-display.php';
}
function create_slider_post_type() {
    $args = array(
                  'description' => 'Slider Post Type',
                  'show_ui' => true,
                  'menu_position' => 10,
                  'exclude_from_search' => true,
                  'labels' => array(
                                    'name'=> 'Slider',
                                    'singular_name' => 'All Slider',
                                    'add_new' => 'Add New Slider',
                                    'add_new_item' => 'Add New Slider',
                                    'edit' => 'Edit Slider',
                                    'edit_item' => 'Edit Slider',
                                    'new-item' => 'New Slider',
                                    'view' => 'View Slider',
                                    'view_item' => 'View Slider',
                                    'search_items' => 'Search Slider',
                                    'not_found' => 'No Slider Found',
                                    'not_found_in_trash' => 'No Slider Found in Trash',
                                    'parent' => 'Parent Slider'
                                   ),
                  			'hierarchical' =>false,
							'publicly_queryable' => true,
							'query_var' => true,
                           'rewrite' => array( 'slug' => 'slider', 'with_front' => false ),
						   'supports' => array( 'title','thumbnail','editor','excerpt'), 
						   
					'public'=>true
                
                 );
    register_post_type( 'slider' , $args );
		
}

function create_service_post_type() {
    $args = array(
                  'description' => 'Service Post Type',
                  'show_ui' => true,
                  'menu_position' => 10,
                  'exclude_from_search' => true,
                  'labels' => array(
                                    'name'=> 'Our Service',
                                    'singular_name' => 'All Service',
                                    'add_new' => 'Add New Service',
                                    'add_new_item' => 'Add New Service',
                                    'edit' => 'Edit Service',
                                    'edit_item' => 'Edit Service',
                                    'new-item' => 'New Service',
                                    'view' => 'View Service',
                                    'view_item' => 'View Service',
                                    'search_items' => 'Search Service',
                                    'not_found' => 'No Service Found',
                                    'not_found_in_trash' => 'No Service Found in Trash',
                                    'parent' => 'Parent Service'
                                   ),
                  			'hierarchical' =>false,
							'publicly_queryable' => true,
							'query_var' => true,
                           'rewrite' => array( 'slug' => 'service', 'with_front' => false ),
						   'supports' => array( 'title','thumbnail','editor','excerpt'), 
						   
					'public'=>true
                
                 );
    register_post_type( 'service' , $args );	
}

function create_home_service_box_post_type() {
    $args = array(
                  'description' => 'Service Box Post Type',
                  'show_ui' => true,
                  'menu_position' => 10,
                  'exclude_from_search' => true,
                  'labels' => array(
                                    'name'=> 'Home Service Box',
                                    'singular_name' => 'All Service Box',
                                    'add_new' => 'Add New Service Box',
                                    'add_new_item' => 'Add New Service Box',
                                    'edit' => 'Edit Service Box',
                                    'edit_item' => 'Edit Service Box',
                                    'new-item' => 'New Service Box',
                                    'view' => 'View Service Box',
                                    'view_item' => 'View Service Box',
                                    'search_items' => 'Search Service Box',
                                    'not_found' => 'No Service Box Found',
                                    'not_found_in_trash' => 'No Service Box Found in Trash',
                                    'parent' => 'Parent Service Box'
                                   ),
                  			'hierarchical' =>false,
							'publicly_queryable' => true,
							'query_var' => true,
                           'rewrite' => array( 'slug' => 'service-box', 'with_front' => false ),
						   'supports' => array( 'title','thumbnail','editor','excerpt'), 
						   
					'public'=>true
                
                 );
    register_post_type( 'service-box' , $args );
		
}