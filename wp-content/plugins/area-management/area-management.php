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
 * @package           Area_Management
 *
 * @wordpress-plugin
 * Plugin Name:       Area Management
 * Plugin URI:        arghya.d1990@gmail.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Arghya Dutta
 * Author URI:        arghya.d1990@gmail.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       area-management
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
define( 'AREA_MANAGEMENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-area-management-activator.php
 */
function activate_area_management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-area-management-activator.php';
	Area_Management_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-area-management-deactivator.php
 */
function deactivate_area_management() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-area-management-deactivator.php';
	Area_Management_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_area_management' );
register_deactivation_hook( __FILE__, 'deactivate_area_management' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-area-management.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_area_management() {

	$plugin = new Area_Management();
	$plugin->run();

}
run_area_management();

add_action('admin_menu', 'area_panel');
add_action( 'admin_footer', 'load_admin_script');

add_action('wp_ajax_area_delete', 'area_delete_fun');
add_action('wp_ajax_nopriv_area_delete', 'area_delete_fun');

function load_admin_script(){
	?>
	  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	  <script>
    jQuery(document).ready(function() {
		jQuery('#arealist').DataTable();
		
		jQuery("#areasubmit").on("click",function(event){
			event.preventDefault();
			var areaname = jQuery("#areaname").val();
			if(areaname==''){
				jQuery("#areaerror").html("Please enter area name");
				return false;
			}
			else{
				jQuery("#add_area").submit();
			}
		});
		jQuery(".deleteArea").on("click",function(){
			var position = jQuery(this).attr('areaposition');
			var data = {'action': 'area_delete',
			'position': position
			};
			if (confirm('Are you sure ?')) {
				jQuery.ajax({
					url:"<?php echo admin_url('admin-ajax.php'); ?>",
					type: 'POST',
					data: data,
					success:function(response){
						//alert(response);
						jQuery("#area_"+position).html("<span style='color:green;font-size:14px;text-align:center;'>Successfully Deleted.</span>");
						setTimeout(function(){ jQuery("#area_"+position).hide(); }, 3000);
					}
				});
			}
			else{
				return false;
			}
			});
	});
	</script>
	
	<?php
}
function area_panel(){
	add_menu_page('Area Management', 'Area Management', 'manage_options', 'area', 'area_fun');
}
function area_fun(){
	global $wpdb;
	if($_POST["areaname"]!='')
	{
		//print_r($_POST);
		$arealist = json_decode(get_option( 'area_data' ));
		$arealist[]=$_POST["areaname"];
		$new_area_list = json_encode($arealist);
		update_option( 'area_data', $new_area_list );
		//print_r($roomlist);
		//print_r($new_room_list);
		echo "Area Successfully Added";
	}
	$areaList = json_decode(get_option( 'area_data' ));
	//print_r($bookingList);
	?>
	<form method="post" action="" name="add_area" id="add_area">
		<table class="form-table">
			<tbody>
				<tr>
					<td><label for="roomname">Enter Area Name:  </label><input name="areaname" id="areaname" class="regular-text" type="text"> <input name="areasubmit" id="areasubmit" class="button button-primary" value="Add Area" type="submit"></td>
				</tr>
			</tbody>
		</table>
		<p style="color:red;font-weight:bold;font-size:12px;" id="areaerror"></p>
	</form>
	<h3>Area List</h3>
	<table id="arealist" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Area Name</th>
				<th>Action</th>
				
            </tr>
        </thead>
        <tbody>
		<?php if(count($areaList)>0){
				foreach($areaList as $key=>$area){
		?>
            <tr id="area_<?php echo $key; ?>">
                <td align="center"><?php echo $area; ?></td>
                <td align="center"><a href="javascript:void(0)" class="deleteArea" areaposition="<?php echo $key; ?>">Delete</a></td>
            </tr>
				<?php } } ?>
		</tbody>
	</table>
	<?php
}
function area_delete_fun(){
	$position = $_POST['position'];
	$arealist = json_decode(get_option( 'area_data' ));
	$new_area_array = array();
	if(count($arealist)>0){
		foreach($arealist as $key=>$area){
			if($position!=$key){
				$new_area_array[] = $area;
			}
		}
	}
	$areadata = json_encode($new_area_array);
	update_option( 'area_data', $areadata );
	exit;
}