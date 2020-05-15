<?php

/**
 * Provide a frontend view for the plugin
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
 $areaList = json_decode(get_option( 'area_data' ));
?>
<div class="reg_div">
	<h3>Manager Registration Form</h3>
     <form name="registration_frm" id="registration_frm" method="post" action="" >
     	
	   <div class="formfieldrow half">
		Name :<input type="text" value="" name="fname" id="name" class="formtxtfield" required />
	   </div>
	   <br>
	   <div class="formfieldrow half">
	   Username :<input type="text" value="" name="uname" id="uname" required class="formtxtfield"/>
	   </div> 
		<br>
	    <div class="formfieldrow half">
	   Email :<input type="email" value="" name="email" id="email" required class="formtxtfield"/>
	   </div> 
	   <br>
	   <div class="formfieldrow half">
	   Phone :<input type="text" value="" name="phone" id="phone" required class="formtxtfield"/>
	   </div> 
	   <br>
	    <div class="formfieldrow half">
		Area :<select name="manager_area" id="manager_area"><option value="">Select Area</option><?php if(count($areaList)>0){ foreach($areaList as $area) { ?> <option value="<?php echo $area; ?>"><?php echo $area; ?></option> <?php } } ?></select></div>
		<br>
	    <div class="formfieldrow half">
	   Password :<input type="password" value="" name="managerpass" id="managerpass" required class="formtxtfield"/>
	   </div> 
	   <br>
	    <div class="formfieldrow half">
	   Retype Password :<input type="password" value="" name="retypepass" id="retypepass" required class="formtxtfield"/>
	   </div> 
	   <div id="msg"></div>
	    <div class="formfieldrow" style="text-align: center; margin-top:20px;"><label class="fieldTtl"></label><input type="submit" name="managerRegistration" class="manager_submit submitRegistration" value="SUBMIT"/></div>	
	</form>
	</div>
	