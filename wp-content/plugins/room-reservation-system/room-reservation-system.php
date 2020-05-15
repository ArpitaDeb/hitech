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
 * @package           Room_Reservation_System
 *
 * @wordpress-plugin
 * Plugin Name:       Room Reservation System
 * Plugin URI:        arghya.d1990@gmail.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Arghya Dutta
 * Author URI:        arghya.d1990@gmail.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       room-reservation-system
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
define( 'ROOM_RESERVATION_SYSTEM_VERSION', '1.0.0' );
define( '__6_PM_8_PM', 'SLOT1' );
define( '__6_PM_9_PM', 'SLOT2' );
define( '__6_PM_10_PM', 'SLOT3' );
define( '__7_PM_9_PM', 'SLOT4' );
define( '__7_PM_10_PM', 'SLOT5' );
define( '__7_PM_11_PM', 'SLOT6' );
define( '__8_PM_10_PM', 'SLOT7' );
define( '__8_PM_11_PM', 'SLOT8' );
define( '__8_PM_12_AM', 'SLOT9' );
define( '__9_PM_11_PM', 'SLOT10' );
define( '__9_PM_12_AM', 'SLOT11' );
define( '__9_PM_1_AM', 'SLOT12' );
define( '__10_PM_12_AM', 'SLOT13' );
define( '__10_PM_1_AM', 'SLOT14' );
define( '__10_PM_2_AM', 'SLOT15' );
define( '__11_PM_1_AM', 'SLOT16' );
define( '__11_PM_2_AM', 'SLOT17' );
define( '__11_PM_3_AM', 'SLOT18' );
define( '__12_AM_2_AM', 'SLOT19' );
define( '__12_AM_3_AM', 'SLOT20' );
define( '__12_AM_4_AM', 'SLOT21' );
define( '__1_AM_3_AM', 'SLOT22' );
define( '__1_AM_4_AM', 'SLOT23' );
define( '__1_AM_5_AM', 'SLOT24' );
define( '__2_AM_4_AM', 'SLOT25' );
define( '__2_AM_5_AM', 'SLOT26' );
define( '__2_AM_6_AM', 'SLOT27' );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-room-reservation-system-activator.php
 */
function activate_room_reservation_system() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-room-reservation-system-activator.php';
	Room_Reservation_System_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-room-reservation-system-deactivator.php
 */
function deactivate_room_reservation_system() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-room-reservation-system-deactivator.php';
	Room_Reservation_System_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_room_reservation_system' );
register_deactivation_hook( __FILE__, 'deactivate_room_reservation_system' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-room-reservation-system.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_room_reservation_system() {

	$plugin = new Room_Reservation_System();
	$plugin->run();

}
run_room_reservation_system();

add_action('admin_menu', 'booking_panel');
add_action( 'admin_footer', 'load_booking_script');

add_action('wp_ajax_room_delete', 'room_delete_fun');
add_action('wp_ajax_nopriv_room_delete', 'room_delete_fun');

add_action('wp_ajax_holiday_delete', 'holiday_delete_fun');
add_action('wp_ajax_nopriv_holiday_delete', 'holiday_delete_fun');

add_action('wp_ajax_booking_delete', 'booking_delete_fun');
add_action('wp_ajax_nopriv_booking_delete', 'booking_delete_fun');

add_action('wp_ajax_booking_submit', 'booking_submit_fun');
add_action('wp_ajax_nopriv_booking_submit', 'booking_submit_fun');

add_action('wp_ajax_booking_final_submit', 'booking_final_submit_fun');
add_action('wp_ajax_nopriv_booking_final_submit', 'booking_final_submit_fun');

add_shortcode( 'reservation', 'reservation_form' );
add_action( 'wp_footer', 'myreservationscript' );


function myreservationscript(){
	$holidayList = json_decode(get_option('holidaydate'));
	$holidayString = '';
	if(count($holidayList)>0){
		foreach($holidayList as $days){
			if($holidayString!=''){
				$holidayString = $holidayString.';'.$days;
			}
			else{
				$holidayString = $days;
			}
		}
	}
	?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		jQuery(document).ready(function() {
			jQuery( '#rev_date' ).datepicker({
				 beforeShowDay: DisableSundayToMonday,
				 minDate: 0
			 });
			 
			jQuery('#rev_date').on("change",function(){
				var selected_date = new Date(jQuery('#rev_date').val());
				var weekDay = selected_date.getDay();
				//alert(weekDay);
				var fromOptionHtml='';
				if(weekDay==2 || weekDay==3){
					 fromOptionHtml='<option value="">From</option><option value="6 PM">6 PM</option><option value="7 PM">7 PM</option><option value="8 PM">8 PM</option><option value="9 PM">9 PM</option><option value="10 PM">10 PM</option><option value="11 PM">11 PM</option><option value="12 AM">12 AM</option>';
				}
				else{
					fromOptionHtml='<option value="">From</option><option value="6 PM">6 PM</option><option value="7 PM">7 PM</option><option value="8 PM">8 PM</option><option value="9 PM">9 PM</option><option value="10 PM">10 PM</option><option value="11 PM">11 PM</option><option value="12 AM">12 AM</option><option value="1 AM">1 AM</option><option value="2 AM">2 AM</option>';
				}
				jQuery("#rev_from").html(fromOptionHtml);
				jQuery("#rev_to").html('<option value="">To</option>');
				//jQuery("#rev_room").html('<option value="">Select Room</option>');
			}); 
			
			jQuery('#rev_from').on("change",function(){
				var fromVal = jQuery('#rev_from').val();
				var fromnum = fromVal.split(' '); 
				//alert(fromnum[0]);
				var toTimeStart = parseInt(fromnum)+2;
				var toOptionHtml ='';
				if(toTimeStart==8){
					toOptionHtml='<option value="">To</option><option value="8 PM">8 PM</option><option value="9 PM">9 PM</option><option value="10 PM">10 PM</option>';
				}
				else if(toTimeStart==9){
					toOptionHtml='<option value="">To</option><option value="9 PM">9 PM</option><option value="10 PM">10 PM</option><option value="11 PM">11 PM</option>';
				}
				else if(toTimeStart==10){
					toOptionHtml='<option value="">To</option><option value="10 PM">10 PM</option><option value="11 PM">11 PM</option><option value="12 AM">12 AM</option>';
				}
				else if(toTimeStart==11){
					toOptionHtml='<option value="">To</option><option value="11 PM">11 PM</option><option value="12 AM">12 AM</option><option value="1 AM">1 AM</option>';
				}
				else if(toTimeStart==12){
					toOptionHtml='<option value="">To</option><option value="12 AM">12 AM</option><option value="1 AM">1 AM</option><option value="2 AM">2 AM</option>';
				}
				else if(toTimeStart==13){
					toOptionHtml='<option value="">To</option><option value="1 AM">1 AM</option><option value="2 AM">2 AM</option><option value="3 AM">3 AM</option>';
				}
				else if(toTimeStart==14){
					toOptionHtml='<option value="">To</option><option value="2 AM">2 AM</option><option value="3 AM">3 AM</option><option value="4 AM">4 AM</option>';
				}
				else if(toTimeStart==3){
					toOptionHtml='<option value="">To</option><option value="3 AM">3 AM</option><option value="4 AM">4 AM</option><option value="5 AM">5 AM</option>';
				}
				else if(toTimeStart==4){
					toOptionHtml='<option value="">To</option><option value="4 AM">4 AM</option><option value="5 AM">5 AM</option><option value="6 AM">6 AM</option>';
				}
				jQuery("#rev_to").html(toOptionHtml);
				//jQuery("#rev_room").html('<option value="">Select Room</option>');
			});
			
			jQuery(".submitBooking").on("click",function(){
				var location = jQuery("#location").val();
				var bookdate = jQuery("#rev_date").val();
				var bookfrom = jQuery("#rev_from").val();
				var bookto = jQuery("#rev_to").val();
				var bookroom = jQuery("#rev_room").val();
				if(location==''){
					jQuery("#bookingError").html("Please select location");
				}
				else if(bookdate==''){
					jQuery("#bookingError").html("Please select date");
				}
				else if(bookfrom==''){
					jQuery("#bookingError").html("Please select From time");
				}
				else if(bookto==''){
					jQuery("#bookingError").html("Please select To time");
				}
				else if(bookroom==''){
					jQuery("#bookingError").html("Please select room");
				}
				else{
					var data = {'action': 'booking_submit',
						'location': location,
						'bookdate': bookdate,
						'bookfrom': bookfrom,
						'bookto': bookto,
						'bookroom': bookroom
						};
				jQuery.ajax({
					url:"<?php echo admin_url('admin-ajax.php'); ?>",
					type: 'POST',
					data: data,
					success:function(response){
						//alert(response);
						if(response=='OK'){
							jQuery("#selectedLocation").html(location);
							jQuery("#selectedDate").html(bookdate);
							jQuery("#selectedTime").html(bookfrom+' To '+bookto);
							jQuery("#selectedRoom").html(bookroom);
							jQuery("#selectForm").val(bookfrom);
							jQuery("#selectTo").val(bookto);
							jQuery("#info_frm").show();
							jQuery(".rev_frm").hide();
						}
						else{
							jQuery("#bookingError").html("Room not available");
						}
					}
				});	
				}
				
			});
			
			jQuery(".finalSubmit").on("click",function(){
				var name=jQuery("#contact_name").val();
				var email=jQuery("#contact_email").val();
				var phone=jQuery("#contact_phone").val();
				var observations=jQuery("#observations").val();
				
				var location = jQuery("#selectedLocation").html();
				var bookdate = jQuery("#selectedDate").html();
				var bookfrom = jQuery("#selectForm").val();
				var bookto = jQuery("#selectTo").val();
				var bookroom = jQuery("#selectedRoom").html(); 
				
				if(name==''){
					jQuery("#contactError").html("Please Enter Name");
				}
				else if(email==''){
					jQuery("#contactError").html("Please Enter Email");
				}
				else if(IsEmail(email)==false){
					jQuery("#contactError").html("This is not a valid email");
				}
				else if(phone==''){
					jQuery("#contactError").html("Please Enter Phone no");
				}
				else if(jQuery("#tc").prop("checked") == false){
					jQuery("#contactError").html("Please accept the terms ");
				}
				else{
					var data = {'action': 'booking_final_submit',
						'location': location,
						'bookdate': bookdate,
						'bookfrom': bookfrom,
						'bookto': bookto,
						'bookroom': bookroom,
						'name': name,
						'email': email,
						'phone': phone,
						'observations': observations
						};
				jQuery.ajax({
					url:"<?php echo admin_url('admin-ajax.php'); ?>",
					type: 'POST',
					data: data,
					success:function(response){
						//alert(response);
						jquery("#cinfo").hide();
						jQuery("#bookingSuccess").html('Booking Successfully done');
					}
				});	
				}
			});
		});
		
		function IsEmail(email) {
		  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  if(!regex.test(email)) {
			return false;
		  }else{
			return true;
		  }
		}
		
		function DisableSundayToMonday(date) {
			//alert(date);
		 var disableddates ='<?php echo $holidayString; ?>';
		 var holidayArray = disableddates.split(';'); 
		 var string = jQuery.datepicker.formatDate('mm/dd/yy', date);
		 //alert(current_date);		 
		 //alert( jQuery.trim(holidayArray[0]));
		 
		  var day = date.getDay();
		 // If day == 1 then it is MOnday
			 if (day == 1) {
				 
				return [false] ; 
			 
			 }else if(day == 0){
				 
				return [false] ;
				
			 }else if(holidayArray.length>0){
				 
				return [ holidayArray.indexOf(string) == -1 ];
				
			 }		 
			 else { 
			 
				return [true] ;
				
			 }
			 
		}
	</script>
	<?php
}
function load_booking_script(){
	?>
	  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    jQuery(document).ready(function() {
		jQuery('#roomlist').DataTable();
		jQuery('#holidaylist').DataTable();
		jQuery('#bookinglist').DataTable();
		jQuery( "#holiday" ).datepicker();
		jQuery("#roomsubmit").on("click",function(event){
			event.preventDefault();
			var roomname = jQuery("#roomname").val();
			if(roomname==''){
				jQuery("#roomerror").html("Please enter room name");
				return false;
			}
			else{
				jQuery("#add_room").submit();
			}
		});
		jQuery(".deleteRoom").on("click",function(){
			var position = jQuery(this).attr('roomposition');
			var data = {'action': 'room_delete',
			'position': position
			};
			if (confirm('Are you sure ?')) {
				jQuery.ajax({
					url:"<?php echo admin_url('admin-ajax.php'); ?>",
					type: 'POST',
					data: data,
					success:function(response){
						//alert(response);
						jQuery("#room_"+position).html("<span style='color:green;font-size:14px;text-align:center;'>Successfully Deleted.</span>");
						setTimeout(function(){ jQuery("#room_"+position).hide(); }, 3000);
					}
				});
			}
			else{
				return false;
			}
			});
			
			jQuery("#holidaysubmit").on("click",function(event){
				event.preventDefault();
				var holiday = jQuery("#holiday").val();
				if(holiday==''){
					jQuery("#holidayerror").html("Please enter holiday date");
					return false;
				}
				else{
					jQuery("#add_holiday").submit();
				}
			});
			
			jQuery(".deleteHoliday").on("click",function(){
				var position = jQuery(this).attr('holidayposition');
				var data = {'action': 'holiday_delete',
				'position': position
				};
				if (confirm('Are you sure ?')) {
					jQuery.ajax({
						url:"<?php echo admin_url('admin-ajax.php'); ?>",
						type: 'POST',
						data: data,
						success:function(response){
							//alert(response);
							jQuery("#holiday_"+position).html("<span style='color:green;font-size:14px;text-align:center;'>Successfully Deleted.</span>");
							setTimeout(function(){ jQuery("#holiday_"+position).hide(); }, 3000);
						}
					});
				}
				else{
					return false;
				}
			});
		jQuery(".deleteBooking").on("click",function(){
				var position = jQuery(this).attr('bookingposition');
				var data = {'action': 'booking_delete',
				'position': position
				};
				if (confirm('Are you sure ?')) {
					jQuery.ajax({
						url:"<?php echo admin_url('admin-ajax.php'); ?>",
						type: 'POST',
						data: data,
						success:function(response){
							//alert(response);
							jQuery("#book_"+position).html("<span style='color:green;font-size:14px;text-align:center;'>Successfully Deleted.</span>");
							setTimeout(function(){ jQuery("#book_"+position).hide(); }, 3000);
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
function booking_panel(){
	add_menu_page('Booking Management', 'Booking Management', 'manage_options', 'booking', 'booking_settings_fun');
	add_submenu_page( 'booking', 'Rooms Type', 'Rooms Type',
    'manage_options', 'room-manage', 'room_page_fun');
	add_submenu_page( 'booking', 'Add Holidays', 'Add Holidays',
    'manage_options', 'holiday-list', 'holiday_page_fun');
}
function booking_settings_fun(){
	$bookingList = json_decode(get_option( 'booking_data' ));
	//print_r($bookingList);
	?>
	<h3>Booking List</h3>
	<table id="bookinglist" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Person Info</th>
                <th>Observations</th>
				<th>Booking Date</th>
                <th>Time</th>
				<th>Room</th>
                <th>Location</th>
				<th>Action</th>
				
            </tr>
        </thead>
        <tbody>
		<?php if(count($bookingList)>0){
				foreach($bookingList as $key=>$book){
		?>
            <tr id="book_<?php echo $key; ?>">
                <td align="center"><?php echo $book->name; ?><br><?php echo $book->email; ?><br><?php echo $book->phone; ?></td>
				<td><?php echo $book->observations; ?></td>
				<td><?php echo $book->bookdate; ?></td>
				<td><?php echo $book->bookfrom.' - '.$book->bookto; ?></td>
				<td><?php echo $book->bookroom; ?></td>
				<td><?php echo $book->location; ?></td>
                <td align="center"><a href="javascript:void(0)" class="deleteBooking" bookingposition="<?php echo $key; ?>">Delete</a></td>
            </tr>
				<?php } } ?>
		</tbody>
	</table>
	<?php
}
function room_page_fun(){
	global $wpdb;
	if($_POST["roomname"]!='')
	{
		//print_r($_POST);
		$roomlist = json_decode(get_option( 'roomname' ));
		$roomlist[]=$_POST["roomname"];
		$new_room_list = json_encode($roomlist);
		update_option( 'roomname', $new_room_list );
		//print_r($roomlist);
		//print_r($new_room_list);
		echo "Room Successfully Added";
	}
	$roomList = json_decode(get_option( 'roomname' ));
	?>
	<form method="post" action="" name="add_room" id="add_room">
		<table class="form-table">
			<tbody>
				<tr>
					<td><label for="roomname">Enter Room Name:  </label><input name="roomname" id="roomname" class="regular-text" type="text"> <input name="roomsubmit" id="roomsubmit" class="button button-primary" value="Add Room" type="submit"></td>
				</tr>
			</tbody>
		</table>
		<p style="color:red;font-weight:bold;font-size:12px;" id="roomerror"></p>
	</form>
	
	<h3>Room List</h3>
	<table id="roomlist" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
		<?php if(count($roomList)>0){
				foreach($roomList as $key=>$room){
		?>
            <tr id="room_<?php echo $key; ?>">
                <td align="center"><?php echo $room; ?></td>
                <td align="center"><a href="javascript:void(0)" class="deleteRoom" roomposition="<?php echo $key; ?>">Delete</a></td>
            </tr>
				<?php } } ?>
		</tbody>
	</table>
	<?php
}
function holiday_page_fun(){
	global $wpdb;
	if($_POST["holiday"]!='')
	{
		//print_r($_POST);
		$holidaylist = json_decode(get_option( 'holidaydate' ));
		$holidaylist[]=$_POST["holiday"];
		$new_holiday_list = json_encode($holidaylist);
		update_option( 'holidaydate', $new_holiday_list );
		//print_r($roomlist);
		//print_r($new_room_list);
		echo "Date Successfully Added";
	}
	$holidayList = json_decode(get_option( 'holidaydate' ));
	?>
	<form method="post" action="" name="add_holiday" id="add_holiday">
		<table class="form-table">
			<tbody>
				<tr>
					<td><label for="holidayname">Holiday List:  </label><input name="holiday" id="holiday" class="regular-text" type="text"> <input name="holidaysubmit" id="holidaysubmit" class="button button-primary" value="Add Holiday" type="submit"></td>
				</tr>
			</tbody>
		</table>
		<p style="color:red;font-weight:bold;font-size:12px;" id="holidayerror"></p>
	</form>
	
	<h3>Holiday List</h3>
	<table id="holidaylist" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
		<?php if(count($holidayList)>0){
				foreach($holidayList as $key=>$holiday){
		?>
            <tr id="holiday_<?php echo $key; ?>">
                <td align="center"><?php echo $holiday; ?></td>
                <td align="center"><a href="javascript:void(0)" class="deleteHoliday" holidayposition="<?php echo $key; ?>">Delete</a></td>
            </tr>
				<?php } } ?>
		</tbody>
	</table>
	<?php
	//echo __6_PM_8_PM;
}
function room_delete_fun(){
	$position = $_POST['position'];
	$roomlist = json_decode(get_option( 'roomname' ));
	$new_room_array = array();
	if(count($roomlist)>0){
		foreach($roomlist as $key=>$room){
			if($position!=$key){
				$new_room_array[] = $room;
			}
		}
	}
	$roomdata = json_encode($new_room_array);
	update_option( 'roomname', $roomdata );
	exit;
}

function holiday_delete_fun(){
	$position = $_POST['position'];
	$holidaylist = json_decode(get_option( 'holidaydate' ));
	$new_holiday_array = array();
	if(count($holidaylist)>0){
		foreach($holidaylist as $key=>$holiday){
			if($position!=$key){
				$new_holiday_array[] = $holiday;
			}
		}
	}
	$holidaydata = json_encode($new_holiday_array);
	update_option( 'holidaydate', $holidaydata );
	update_option( 'holidaydate', $holidaydata );
	exit;
}

function booking_delete_fun(){
	$position = $_POST['position'];
	$bookingData = json_decode(get_option( 'booking_data' ));
	$new_book_array = array();
	if(count($bookingData)>0){
		foreach($bookingData as $key=>$books){
			if($position!=$key){
				$new_book_array[] = $books;
			}
		}
	}
	$bdata = json_encode($new_book_array);
	update_option( 'booking_data', $bdata );
	exit;
}

function reservation_form(){
	$rooms = json_decode(get_option('roomname'));
	$roomOption = '<option value="">Select Room</option>';
	if(count($rooms)>0){
		foreach($rooms as $room){
			$roomOption .='<option value="'.$room.'">'.$room.'</option>';
		}		
	}
	$form_output = '';
	$form_output = '<div class="rev_frm"><select class="frm_ctrl" name="location" id="location"><option value="">Select Location</option><option value="Buenos Aires">Buenos Aires</option></select><input type="text" id="rev_date" placeholder="Date" /><select name="rev_from" id="rev_from"><option value="">From</option></select><select name="rev_to" id="rev_to"><option value="">To</option></select><select name="rev_room" id="rev_room">'.$roomOption.'</select><a href="javascript:void(0)" class="submitBooking">GO</a></div><p id="bookingError" style="color:red;font-size:14px;font-weight:bold;"></p><br><div class="info_frm" id="info_frm" style="display:none;"><div class="entered_data">Location: <span id="selectedLocation"></span><br>Date:<span id="selectedDate"></span><br>Time:<span id="selectedTime"></span><br>Room:<span id="selectedRoom"></span></div><div id="cinfo"><input type="text" placeholder="Name" name="contact_name" id="contact_name" /><br><input type="text" placeholder="Email" name="contact_email" id="contact_email" /><br><input type="text" placeholder="Phone" name="contact_phone" id="contact_phone" /><br><textarea name="observations" placeholder="Observations" id="observations"></textarea><br><input type="checkbox" name="tc" id="tc" />Accept Terms & Condition<br><input type="hidden" id="selectForm"><input type="hidden" id="selectTo"><a href="javascript:void(0)" class="finalSubmit">Send</a></div><p  id="contactError" style="color:red;font-size:14px;font-weight:bold;"></p></div><div id="bookingSuccess" style="color:green;font-size:14px;"></div>';
	return $form_output;
}
function booking_submit_fun(){
	$location = $_POST['location'];
	$date = $_POST['bookdate'];
	$from = $_POST['bookfrom'];
	$to = $_POST['bookto'];
	$room = $_POST['bookroom'];
	//$startTimestamp = strtotime('m/d/Y A',$from);
	//$endTimestamp = strtotime('m/d/Y A',$to);
	$booking_data = json_decode(get_option('booking_data'));
	$timeSlot = array(0=>'6 PM',1=>'7 PM',2=>'8 PM',3=>'9 PM',4=>'10 PM',5=>'11 PM',6=>'12 AM',7=>'1 AM',8=>'2 AM',9=>'3 AM',10=>'4 AM',11=>'5 AM',12=>'6 AM');
	
	if(count($booking_data)>0){
		foreach($booking_data as $booking){
			if($date==$booking->bookdate && $room==$booking->bookroom){
				$bookingstartTime = $booking->bookfrom;
				$bookingendTime = $booking->bookto;
				$bookstartposition = array_search($bookingstartTime, $timeSlot);
				$bookendposition = array_search($bookingendTime, $timeSlot);
				$bookinbetweentiming = array_slice($timeSlot, $bookstartposition, $bookendposition, false);
				if(in_array($from,$bookinbetweentiming) || in_array($to,$bookinbetweentiming)){
					$response ='NOTOK';
				}
				else{
					$response ='OK';
				}
			}
			else{
				$response ='OK';
			}
		}
		//$response ='OK';
	}
	else{
		$response ='OK';
	}
	echo $response;
	exit;
}
function booking_final_submit_fun(){
	//print_r($_POST);
	$old_data = array();
	$rev_data = json_decode(get_option('booking_data'));
	if(count($rev_data)>0){
		$old_data = $rev_data;
	}
	$_POST['slot']='__'.str_replace(' ','_',$_POST['bookfrom']).'_'.str_replace(' ','_',$_POST['bookto']);
	$old_data[] = $_POST;
	$updated_data = json_encode($old_data);
	update_option( 'booking_data', $updated_data );
	//print_r($updated_data);
	
	$body = "New Booking Created <br> Date:".$_POST['bookdate']."<br>Time:".$_POST['bookfrom']." - ".$_POST['bookto']."<br> Room:".$_POST['bookroom']."Name:".$_POST['name'];
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$subject = 'New Reservation';
	$to = get_option( 'admin_email' );
	wp_mail( $to, $subject, $body, $headers );
	
	exit;
}
