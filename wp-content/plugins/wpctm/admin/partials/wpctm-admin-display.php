<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       arghya.d1990@gmail.com
 * @since      1.0.0
 *
 * @package    Wpctm
 * @subpackage Wpctm/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php 
 global $wpdb;
	 if($_POST['img_insert']=="Insert")
	{
		update_option( 'sitephone', $_POST['sitephone'] );
		update_option( 'sitephonealt', $_POST['sitephonealt'] );
		update_option( 'caddress', $_POST['caddress'] );
		update_option( 'cemail', $_POST['cemail'] );
		update_option( 'copyright', $_POST['copyright'] );
		update_option( 'fblink', $_POST['fblink'] );
		update_option( 'tlink', $_POST['tlink'] );
		update_option( 'glink', $_POST['glink'] );
		update_option( 'inlink', $_POST['inlink'] );
	}

?>

<div class="wrap">
	<h2>Welcome To Custom Theme Manager</h2>
    <div id="dashboard-widgets-wrap">
<div id="dashboard-widgets" class="metabox-holder">
<div id="postbox-container-1" class="postbox-container">
<div id="normal-sortables" class="meta-box-sortables ui-sortable">
<div id="dashboard_right_now" class="postbox ">
<h3 class="hndle ui-sortable-handle">

</h3>
<div class="inside">
	<div class="main">
<form method="post" action="admin.php?page=hitech-panel" name="youtube_frm" />
	<div class="frminput"><span><strong>Site Phone Number:</strong></span>	
	<input type="text" class="ctmtext" name="sitephone" id="site_phone" value="<?php echo get_option( 'sitephone' ); ?>" />
</div>	
	<hr>
	<div class="frminput"><span><strong>Site Phone Number Alternative:</strong></span>	
	<input type="text" class="ctmtext" name="sitephonealt" id="site_phone_alt" value="<?php echo get_option( 'sitephonealt' ); ?>" />
</div>	
	<hr>
	<div class="frminput"><span><strong>Contact Address:</strong></span>	
	<input type="text" class="ctmtext" name="caddress" id="caddress" value="<?php echo get_option( 'caddress' ); ?>" />
</div>	
	<hr>
	<div class="frminput"><span><strong>Contact Email:</strong></span>	
	<input type="text" class="ctmtext" name="cemail" id="cemail" value="<?php echo get_option( 'cemail' ); ?>" />
</div>	
	<hr>
	<div class="frminput"><span><strong>Copyright Text:</strong></span>	
	<input type="text" class="ctmtext" name="copyright" id="copyright" value="<?php echo get_option( 'copyright' ); ?>" />
</div>	
	<hr>
	<div class="frminput"><span><strong>Facebook Link:</strong></span>	
	<input type="text" class="ctmtext" name="fblink" id="fblink" value="<?php echo get_option( 'fblink' ); ?>" />
</div>	
	<hr>
	<div class="frminput"><span><strong>Twitter Link:</strong></span>	
	<input type="text" class="ctmtext" name="tlink" id="tblink" value="<?php echo get_option( 'tlink' ); ?>" />
</div>	
	<hr>
	<div class="frminput"><span><strong>G+ Link:</strong></span>	
	<input type="text" class="ctmtext" name="glink" id="glink" value="<?php echo get_option( 'glink' ); ?>" />
</div>	
	<hr>
	<div class="frminput"><span><strong>LinkedIn Link:</strong></span>	
	<input type="text" class="ctmtext" name="inlink" id="inlink" value="<?php echo get_option( 'inlink' ); ?>" />
</div>	
	<hr>
	<div align="center"><input type="submit" name="img_insert" value="Insert" class="button button-primary insertyoutubeData"></div>
	</div>
	</div>
	
	</form>

	
</div>
</div>
</div>


</div>
</div>
</div>