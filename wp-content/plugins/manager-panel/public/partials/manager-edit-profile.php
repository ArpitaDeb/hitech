<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://slogx.com/
 * @since      1.0.0
 *
 * @package    Login_Registration
 * @subpackage Login_Registration/admin/partials
 */

//print_r($user);
if(!is_user_logged_in())
{
	wp_redirect(site_url());
}

$user_info = get_userdata($user->data->ID);
$roles = implode(', ', $user_info->roles);
if($roles!='manager'){
	wp_redirect(site_url());
}

$areaList = json_decode(get_option( 'area_data' ));
?>
<div class="booking_div">
	<h3>Edit Profile</h3>
     <form name="edit_frm" id="edit_frm" method="post" action="" >
     	
	   <div class="formfieldrow half">
		Name :<input type="text" value="<?php echo $user->data->display_name; ?>" name="fname" id="name" placeholder="Name" class="formtxtfield" required />
	   </div>
		<br>
	   <div class="formfieldrow half">
		Area :<input type="text" value="<?php echo get_user_meta($user->data->ID,'area', true); ?>" name="area" id="area" placeholder="Area" class="formtxtfield" required readonly /></div>
	   <br>
	   <div class="formfieldrow half">
	   Email :<input type="text" value="<?php echo $user->user_email; ?>" name="email" id="email" placeholder="Email" required class="formtxtfield" readonly />
	   </div>
	   <br>
	   <div class="formfieldrow half">
	   Phone :<input type="text" value="<?php echo get_user_meta($user->data->ID,'phone', true); ?>" name="phone" id="phone" placeholder="Phone" required class="formtxtfield"/></div>
	   
		<input type="hidden" name="user_id" id="manager_id" value="<?php echo $user->data->ID; ?>" />
	   <div id="msg"></div>
	    <div class="formfieldrow" style="text-align: center; margin-top:20px;"><label class="fieldTtl"></label><input type="submit" name="booking" class="booking_submit submitEditprofile" value="UPDATE"/></div>	
	</form>
	
	<h3>Change Password</h3>
	<form name="changepass_frm" id="changepass_frm" method="post" action="" >
		<input type="hidden" name="user_id" id="uid" value="<?php echo $user->data->ID; ?>" />
		<div class="formfieldrow half">
		Old Password :<input type="password" value="" name="oldpass" id="oldpass" placeholder="" class="formtxtfield" required />
	   </div>
		<br>
	   <div class="formfieldrow half">
		New Password :<input type="password" value="" name="newpass" id="newpass" placeholder="" class="formtxtfield" required /></div>
	   <br>
	   <div class="formfieldrow half">
	   Retype New Password :<input type="password" value="" name="retypenewpass" id="retypenewpass" placeholder="" required class="formtxtfield"/>
	   </div>
	    <div id="passmsg"></div>
	   <div class="formfieldrow" style="text-align: center; margin-top:20px;"><label class="fieldTtl"></label><input type="submit" name="booking" class="booking_submit submitchangepass" value="CHANGE PASSWORD"/></div>
	</form>
	</div>