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
 * @package           Manager_Panel
 *
 * @wordpress-plugin
 * Plugin Name:       Manager Panel
 * Plugin URI:        arghya.d1990@gmail.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Arghya Dutta
 * Author URI:        arghya.d1990@gmail.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       manager-panel
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
define( 'MANAGER_PANEL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-manager-panel-activator.php
 */
function activate_manager_panel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-manager-panel-activator.php';
	Manager_Panel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-manager-panel-deactivator.php
 */
function deactivate_manager_panel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-manager-panel-deactivator.php';
	Manager_Panel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_manager_panel' );
register_deactivation_hook( __FILE__, 'deactivate_manager_panel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-manager-panel.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_manager_panel() {

	$plugin = new Manager_Panel();
	$plugin->run();

}
run_manager_panel();

add_action('admin_menu', 'manage_manager');
add_shortcode( 'manager-registration', 'manager_registration_form' );
add_shortcode( 'manager-login', 'manager_login_form' );
add_shortcode( 'manager-profile', 'manager_edit_profile' );
add_action( 'wp_footer', 'managerscript' );
add_action('wp_ajax_manager_registration_form_data', 'manager_registration_form_data_fun');
add_action('wp_ajax_nopriv_manager_registration_form_data', 'manager_registration_form_data_fun');
add_action( 'admin_footer', 'manager_admin_script');
add_action('wp_ajax_manager_action', 'manager_action_fun');
add_action('wp_ajax_nopriv_manager_action', 'manager_action_fun');
add_action('wp_ajax_manager_login_form_data', 'manager_login_form_data_fun');
add_action('wp_ajax_nopriv_manager_login_form_data', 'manager_login_form_data_fun');
add_action('wp_ajax_manager_editprofile_form_data', 'manager_editprofile_form_data_fun');
add_action('wp_ajax_nopriv_manager_editprofile_form_data', 'manager_editprofile_form_data_fun');
add_action('wp_ajax_manager_changepass_form_data', 'manager_changepass_form_data_fun');
add_action('wp_ajax_nopriv_manager_changepass_form_data', 'manager_changepass_form_data_fun');

add_role('manager', 'Manager', array(
    'read' => true,
    'edit_posts' => false,
    'delete_posts' => false,
));

$managerRegisterpage = get_page_by_title( 'Manager Registration' );
if(count($managerRegisterpage)==0)
{
	wp_insert_post(array('post_title'=>'Manager Registration', 'post_name'=>'manager-registration', 'post_type'=>'page', 'post_status' => 'publish', 'post_content'=>'[manager-registration]'));
}
$managerProfilepage = get_page_by_title( 'Manager Edit Profile' );
if(count($managerProfilepage)==0)
{
	wp_insert_post(array('post_title'=>'Manager Edit Profile', 'post_name'=>'manager-edit-profile', 'post_type'=>'page', 'post_status' => 'publish', 'post_content'=>'[manager-profile]'));
}
$managerLoginpage = get_page_by_title( 'Manager Login' );
if(count($managerLoginpage)==0)
{
	wp_insert_post(array('post_title'=>'Manager Login', 'post_name'=>'manager-login', 'post_type'=>'page', 'post_status' => 'publish', 'post_content'=>'[manager-login]'));
}
function manage_manager(){
	$page_title="manager-registration";
	$menu_title="Manager Panel";
	$parent_slug=$menu_slug="manager-registration";
	$capability="manage_options";
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, 'manage_manager_registration_option', '');
}

function manage_manager_registration_option(){
	require plugin_dir_path( __FILE__ ) .'admin/partials/manager-panel-admin-display.php';

}
function manager_registration_form(){
	require plugin_dir_path( __FILE__ ) . 'public/partials/manager-registration-form.php';
}
function manager_login_form(){
	require plugin_dir_path( __FILE__ ) . 'public/partials/manager-login-form.php';
}
function manager_edit_profile(){
	$user = wp_get_current_user();
	require plugin_dir_path( __FILE__ ) . 'public/partials/manager-edit-profile.php';
}
function managerscript(){
	?>
	<script>
		jQuery( document ).ready(function() {
			jQuery( "#registration_frm" ).submit(function( event ) {
				//alert();
				event.preventDefault();
				var name = jQuery("#name").val();
				var uname = jQuery("#uname").val();
				var email = jQuery("#email").val();
				var phone = jQuery("#phone").val();
				var area = jQuery("#manager_area").val();
				var pass = jQuery("#managerpass").val();
				var retypepassword = jQuery("#retypepass").val();
				
				var data = {
					'action': 'manager_registration_form_data',
					'name': name,
					'uname':uname,
					'email': email,
					'phone': phone,
					'area': area,
					'password': pass,
					'retypepassword': retypepassword
				};
				
				jQuery.ajax({
					url:"<?php echo admin_url('admin-ajax.php'); ?>",
					type: 'POST',
					data: data,
					success:function(response){
						//alert(response);
						jQuery("#registration_frm")[0].reset();
						jQuery("#msg").show();
						jQuery("#msg").text(response);
						setTimeout(function(){ jQuery("#msg").hide(); }, 4000);
					}
				});
			});	
			
			jQuery( "#login_frm" ).submit(function( event ) {
				event.preventDefault();
				var username= jQuery("#loginuname").val();
				var password= jQuery("#loginpassword").val();
				//alert(username);
				//alert(password);
				var data = {'action': 'manager_login_form_data',
					'username': username,
					'password': password
					}
				jQuery.ajax({
					url:"<?php echo admin_url('admin-ajax.php'); ?>",
					type: 'POST',
					data: data,
					success:function(response){
						//alert(response);
						if(response=='Ok'){
							window.location.replace("<?php echo site_url().'/manager-edit-profile' ?>");
						}else{
							//jQuery("#registration_frm")[0].reset();
							jQuery("#loginmsg").show();
							jQuery("#loginmsg").text(response);
							//setTimeout(function(){ jQuery("#loginmsg").hide(); }, 4000);
						}
						
						
					}
				});	
			});
			jQuery( "#edit_frm" ).submit(function( event ) {
				//alert();
				event.preventDefault();
				var name = jQuery("#name").val();
				var phone = jQuery("#phone").val();
				var uid =jQuery("#manager_id").val();
				
				var data = {
					'action': 'manager_editprofile_form_data',
					'name': name,
					'phone': phone,
					'uid': uid
				};
				
				jQuery.ajax({
					url:"<?php echo admin_url('admin-ajax.php'); ?>",
					type: 'POST',
					data: data,
					success:function(response){
						//alert(response);
						jQuery("#msg").show(); 
						jQuery("#msg").text(response);
						setTimeout(function(){ jQuery("#msg").hide(); }, 4000);
					}
				});
			});	
			
			jQuery( "#changepass_frm" ).submit(function( event ) {
				event.preventDefault();
				var oldpass= jQuery("#oldpass").val();
				var newpass= jQuery("#newpass").val();
				var retypenew= jQuery("#retypenewpass").val();
				var user_id= jQuery("#uid").val();
				
				var data = {
					'action': 'manager_changepass_form_data',
					'user_id': user_id,
					'oldpass': oldpass,
					'newpass': newpass,
					'retypenew': retypenew
					}
				jQuery.ajax({
					url:"<?php echo admin_url('admin-ajax.php'); ?>",
					type: 'POST',
					data: data,
					success:function(response){
						//alert(response);
						jQuery("#passmsg").show();
						jQuery("#passmsg").text(response);
						jQuery("#changepass_frm")[0].reset();
						setTimeout(function(){ jQuery("#passmsg").hide(); }, 4000);
					}
				});	
			});
		});
	</script>
	<?php
}

function manager_admin_script(){
	?>
	<script>
	jQuery(document).ready(function() {
		jQuery('#managerlist').DataTable();
	});
	jQuery("#applyAction").on("click", function(){
       var selectedAction = jQuery("#agentaction").val();
       var agentList = jQuery(".agentactionID:checked").length;
       var agentselectedid = jQuery(".agentactionID:checked").val();
       var agentidarray= [];
       jQuery('.agentactionID:checked').each(function(i){
          agentidarray[i] = jQuery(this).val();
        });
       //alert(agentidarray);
       //alert(agentList);
       jQuery(".actionError").html("");
       if(selectedAction==''){
           jQuery(".actionError").html("Please select an action");
       }
       else if(agentList==0){
           jQuery(".actionError").html("");
           jQuery(".actionError").html("Please select at least one manager");
       }
       else{
           var data = {'action': 'manager_action',
        			'selectedAction': selectedAction,
        			'agentidarray': agentidarray
                };
           	jQuery.ajax({
    			url:"<?php echo admin_url('admin-ajax.php'); ?>",
    			type: 'POST',
    			data: data,
    			success:function(response){
    			    //alert(response);
    			    location.reload();
    			}
           	});
       }
    });
	</script>
	<?php
}
function manager_registration_form_data_fun(){
	$exists = email_exists( $_POST['email'] );
	$username = sanitize_text_field( $_POST['uname'] ); 
	//print_r($_POST);
	if($_POST['password']!=$_POST['retypepassword'])
	{
		$msg = "Password and Retype password are not same";
	}
	elseif($exists){
		$msg = "This email already exists! Try with another";
	}
	elseif(username_exists( $username ) ){
		$msg = "This Username already exists";
	}
	else{
		$name=explode(' ',$_POST['name']);
	
		$userdata = array(
			'user_login'  =>  $_POST['uname'],
			'user_email'    =>  $_POST['email'],
			'user_pass'   =>  $_POST['password'],
			'display_name' => $_POST['name'],
			'first_name' =>	$name[0],
			'last_name' => $name[1],
		);
		$user_id = wp_insert_user( $userdata ) ;
		wp_update_user( array ('ID' => $user_id, 'role' => 'manager') ) ;
		add_user_meta( $user_id, 'account_status', 'N');
		add_user_meta( $user_id, 'phone', $_POST['phone']);
		add_user_meta( $user_id, 'area', $_POST['area']);
		
		$body = "Welcome! Your registration is now pending for admin approval";
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$subject = 'Registration Confirmation';
		$to = $_POST['email'];
		wp_mail( $to, $subject, $body, $headers );
		$msg="Thank You for registering here. You can login after admin verification";
	}
	echo $msg;
	exit();
}
function manager_action_fun(){
	 global $wpdb;
    if($_POST['selectedAction']=='authorize'){
        if(count($_POST['agentidarray'])>0){
            foreach($_POST['agentidarray'] as $agid){
                $agentID = $agid;
                update_user_meta($agentID, 'account_status', 'on');
            }
        }
    }
    if($_POST['selectedAction']=='delete'){
        if(count($_POST['agentidarray'])>0){
            foreach($_POST['agentidarray'] as $agid){
                $agentID = $agid;
                wp_delete_user( $agentID );
            }
            
        }
    }
    exit();
}
function manager_login_form_data_fun(){
	global $wpdb;
	$uname = $_POST['username'];
	$pass = $_POST['password'];
	$user = $wpdb->get_row( "SELECT * FROM $wpdb->users WHERE user_login='$uname' OR user_email='$uname'");
	if(count($user)>0)
	{
		if(wp_check_password( $pass, $user->user_pass, $user->ID ))
		{
		    $user_info = get_userdata($user->ID);
	        $roles = implode(', ', $user_info->roles);
	    
			$check_account_activate_status = get_user_meta( $user->ID, 'account_status', true ); 
			if($check_account_activate_status=='N')
			{
				$msg="Pending for admin approval. ";
			}
			else if($roles!='manager'){
			    $msg="You are not a manager.";
			}
			else{
				$creds['user_login'] = $user->user_login;
				$creds['user_password'] = $pass;
				$user = wp_signon( $creds, false );
				$msg = "Ok";
			}
		}else{
			$msg = "Password not correct";
		}
	}
	else{
		$msg ="Wrong email or username";
	}
	//print_r($user);
	echo $msg;
	exit();
}
function manager_editprofile_form_data_fun(){
	$name = explode(' ',$_POST['name']);
	wp_update_user( array( 'ID' => $_POST['uid'], 'display_name' => $_POST['name'], 'first_name' =>$name[0], 'last_name'=>$name[1] ) );
	update_user_meta( $_POST['uid'], 'phone', $_POST['phone']);
	$msg = "Successfully Updated";
	echo $msg;
	exit();
}
function manager_changepass_form_data_fun(){
	global $wpdb;
	$id = $_POST['user_id'];
	$pass= $_POST['oldpass'];
	$user = $wpdb->get_row( "SELECT * FROM $wpdb->users WHERE ID='$id'");
	if(wp_check_password( $pass, $user->user_pass, $user->ID ))
	{
		if($_POST['newpass']!=$_POST['retypenew'])
		{
			$msg = "New Password and retype new password are not same";
		}
		else{
			wp_set_password( $_POST['newpass'], $id );
			$msg="Password successfully changed";
		}
	}
	else{
		$msg = "Old password not match with your account";
	}
	echo $msg;
	exit();
}