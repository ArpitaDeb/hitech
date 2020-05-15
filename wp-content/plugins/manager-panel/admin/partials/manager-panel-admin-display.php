<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       arghya.d1990@gmail.com
 * @since      1.0.0
 *
 * @package    Manager_Panel
 * @subpackage Manager_Panel/admin/partials
 */
?>
<h2>Welcome To Manager Panel</h2>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<select name="agentaction" id="agentaction">
<option value="">-Select-</option>
<option value="delete">Delete</option>
<option value="authorize">Authorise</option>
</select>
<a href="javascript:void(0);" class="button button-primary" id="applyAction">Apply</a><br>
<div class="actionError" style="color:red;font-size:14px;"></div>
<br><hr>
<?php
$manager = get_users( array( 'role__in' => 'manager' ) );

//print_r($agents);
?>
<table class="manager-list" id="managerlist">
 <thead>
<th>Select</th>
<th>ID</th>
<th>Status</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Area</th>
 </thead>
        <tbody>
<?php 
if(count($manager)>0)
{
    foreach($manager as $new_manager){
      
				$check_account_activate_status = get_user_meta( $new_manager->ID, 'account_status', true ); 
       
        ?>
        <tr>
            <td  align="center"><input type="checkbox" name="managerID[]" value="<?php echo $new_manager->ID; ?>" class="agentactionID"></td>
        <td align="center"><?php echo $new_manager->ID; ?></td> 
        <td align="center"><?php if($check_account_activate_status=='on'){ echo "Authorised"; } else { echo "Pending"; } ?></td>
        <td align="center"><?php echo $new_manager->data->display_name; ?></td>
        <td align="center"><?php echo $new_manager->data->user_email; ?></td>
        <td align="center"><?php echo get_user_meta( $new_manager->ID, 'phone', true ); ?></td>
		<td align="center"><?php echo get_user_meta( $new_manager->ID, 'area', true ); ?></td>
		
        </tr>
        <?php
    }
}
?>
</tbody>
</table>
