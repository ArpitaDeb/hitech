<?php

/**
 * Provide a frontend area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://slogx.com/
 * @since      1.0.0
 *
 * @package    Manager_Panel
 * @subpackage Manager_Panel/public/partials
 */
 if(is_user_logged_in())
{
	wp_redirect(site_url('manager-edit-profile'));
}
 ?>
<h3> Login Form</h3>
     <form name="login_frm" id="login_frm" >
     	
	   <div class="formfieldrow half">
		Email/Username :<input type="text" value="" name="loginuname" id="loginuname" placeholder="" class="formtxtfield" required />
	   </div>
		<br>
	  
	    <div class="formfieldrow half">
	   Password :<input type="password" value="" name="loginpassword" id="loginpassword" placeholder="" required class="formtxtfield"/>
	   </div> 
		 <div id="loginmsg"></div>
	    <div class="formfieldrow" style="text-align: center; margin-top:20px;"><label class="fieldTtl"></label><input type="submit" name="logingbooking" class="booking_submit submitLogin" value="LOGIN"/></div>	
	</form>