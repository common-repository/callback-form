<?php

/*
Plugin Name: Callback Form
Plugin URI: http://www.aerin.co.uk/contact-form-plugin
Description: A simple and very compact contact form ideal for newsletter signups, quick contacts and callbacks.
Version: 1.3
Author: fisicx
Author URI: http://www.aerin.co.uk
*/

/*
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

add_shortcode('cbf', 'cbf_form');

$myStyleUrl = plugins_url('callback-style.css', __FILE__);
wp_register_style('callback_style', $myStyleUrl);
wp_enqueue_style( 'callback_style');

$myScriptUrl = plugins_url('callback-javascript.js', __FILE__);
wp_register_script('callback_script', $myScriptUrl);
wp_enqueue_script( 'callback_script');

register_activation_hook(__FILE__, 'cbf_add_defaults');
register_deactivation_hook( __FILE__, 'cbf_delete_options' );
register_uninstall_hook(__FILE__, 'cbf_delete_options');

add_action('admin_init', 'cbf_init');
add_action('admin_init', 'cbf_add_defaults');
add_action('admin_menu', 'cbf_add_options_page');

add_filter( 'plugin_action_links', 'cbf_plugin_action_links', 10, 2 );

function cbf_add_defaults()
	{
	add_option('cbf_option1', "Your Name");
	add_option('cbf_option2', "Email Address");
	add_option('cbf_option3', "Send It!");
	add_option('cbf_option4', "");
	add_option('cbf_option5', "250");
	}

function cbf_delete_options()
	{
	delete_option('cbf_option1');
	delete_option('cbf_option2');
	delete_option('cbf_option3');
	delete_option('cbf_option4');
	delete_option('cbf_option5');
	}

function cbf_init()
	{
	register_setting('my_cbf_options', 'cbf_option1');
	register_setting('my_cbf_options', 'cbf_option2');
	register_setting('my_cbf_options', 'cbf_option3');
	register_setting('my_cbf_options', 'cbf_option4');
	register_setting('my_cbf_options', 'cbf_option5');
	}

function cbf_add_options_page()
	{
	add_options_page('Callback Form Options Page', 'Callback Form', 'manage_options', __FILE__, 'cbf_render_form');
	}

function cbf_render_form()
	{
	?>
	<h1>Callback Form</h1>
	<p>The callback form plugin was created for newsletter signups, quick contacts and callbacks.<br />It has two fields and a submit button and looks pretty much like the one below.<br />The labels are displayed as text field values and disappear when the field is selected making the form very compact.  The current field settings are shown in the options form below.<br />You can change them to anything you like but I suggest you keep the top field as a name and the lower field as the contact info.<br />Make sure you include your email address before saving the changes.</p>
	<h2>How to use the plugin</h2>
	<p>To add the callback form your posts or pages use the short code: <code>[cbf]</code>.<br />
	To use the form in a text widget add the line <code>add_filter('widget_text', 'do_shortcode');</code> to your functions.php file. You can now use the shortcode <code>[cbf]</code>.<br />
	To add it to your theme files use <code>&lt;?php echo do_shortcode('[cbf]'); ?&gt;</code><<br />
	To change the styles use the plugin editor to fiddle with callback-styles.css<br />
	Not much else to add really. Enjoy using the plugin</p>
	<div id="callback"> 
		<h2>Callback Form Options</h2>
		<form method="post" action="options.php">
		<?php settings_fields('my_cbf_options');
		get_option('cbf_option1');
		get_option('cbf_option2');
		get_option('cbf_option3');
		get_option('cbf_option4');
		get_option('cbf_option5'); 
		$width = preg_replace("/[^0-9]/", "", get_option('cbf_option5'));
		$input =  $width.'px';
		$width = $width+14;
		$submit = $width.'px';
		?>
	<div class="options">
	<h3>Form fields and caption</h3>
	<p>Click in any of the fields to change the labels and captions.</p>
	<div><input type="text"  style="width:<?php echo $input; ?>;" label="Callback" name="cbf_option1" value="<?php echo get_option('cbf_option1'); ?>" onfocus="clickclear(this, '<?php echo get_option('cbf_option1'); ?>')" onblur="clickrecall(this,'<?php echo get_option('cbf_option1'); ?>')"/></div>
	<div><input type="text"  style="width:<?php echo $input; ?>;" label="Callback" name="cbf_option2" value="<?php echo get_option('cbf_option2'); ?>" onfocus="clickclear(this, '<?php echo get_option('cbf_option2'); ?>')" onblur="clickrecall(this,'<?php echo get_option('cbf_option2'); ?>')"/></div>
	<div><input type="text" id="submit" style="width:<?php echo $input; ?>; font-size: 130%;cursor:auto; color: #FFF" name="cbf_option3" value="<?php echo get_option('cbf_option3'); ?>" onfocus="clickclear(this, '<?php echo get_option('cbf_option3'); ?>')" onblur="clickrecall(this,'<?php echo get_option('cbf_option3'); ?>')"/></div>
	</div>

	<div class="options">
	<h3>Recipient's email address</h3>	
	<p><span style="color:red; font-weight: bold;">Important!</span> Enter YOUR email address below.  This won't display, it's just so the plugin knows where to send the message.</p>
	<div><input type="text"  style="width:<?php echo $input; ?>;" label="Email" name="cbf_option4" value="<?php echo get_option('cbf_option4'); ?>" onfocus="clickclear(this, '<?php echo get_option('cbf_option4'); ?>')" onblur="clickrecall(this,'<?php echo get_option('cbf_option4'); ?>')"/></div>
	</div>

	<div class="options">
	<p>Enter the width of the form in pixels. Just enter the value, no need to add 'px'. The current width is as you see it here.</p>
	<div><input type="text" style="width:<?php echo $input; ?>;" label="width" name="cbf_option5" value="<?php echo get_option('cbf_option5'); ?>" onfocus="clickclear(this, '<?php echo get_option('option5'); ?>')" onblur="clickrecall(this,'<?php echo get_option('option5'); ?>')"/></div>
	</div>
	</div>

	<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>
	</form>

	<?php	
	}

function cbf_plugin_action_links( $links, $file )
	{
	if ( $file == plugin_basename( __FILE__ ) )
		{
		$cbf_links = '<a href="'.get_admin_url().'options-general.php?page=callback-form/callback.php">'.__('Settings').'</a>';
		array_unshift( $links, $cbf_links );
		}
	return $links;
	}

function theform($errors)
	{
	get_option('cbf_option1');
	get_option('cbf_option2');
	get_option('cbf_option3');
	get_option('cbf_option4');
	get_option('cbf_option5'); 
	if ($errors == 'error') $error = "<p style='color:red'>Please fill in both fields</p>";
	$width = preg_replace("/[^0-9]/", "", get_option('cbf_option5'));
	$input =  $width.'px';
	$width = $width+14;
	$submit = $width.'px';
	?>
	<div id="callback"> 
		<form action="" method="POST">
		<?php echo $error; ?>
		<div>
		<input type="text" style="width:<?php echo $input; ?>;" label="Name" name="callbackname" value="<?php echo get_option('cbf_option1'); ?>" onfocus="clickclear(this, '<?php echo get_option('cbf_option1'); ?>')" onblur="clickrecall(this,'<?php echo get_option('cbf_option1'); ?>')"></div>
		<div>
		<input type="text" style="width:<?php echo $input; ?>;" label="Callback" name="callbackcontact"  value="<?php echo get_option('cbf_option2'); ?>" onfocus="clickclear(this, '<?php echo get_option('cbf_option2'); ?>')" onblur="clickrecall(this,'<?php echo get_option('cbf_option2'); ?>')"></div>
		<div>
		<input type="submit" id="submit" style="width:<?php echo $submit; ?>;" name="submit" value="<?php echo get_option('cbf_option3'); ?>">	</div>
		</form>
	</div>
	<?php
	}

function cbf_verify(&$errors)
	{
	$form_valid = true;
	$cbf_name = preg_replace("/[^a-zA-Z0-9@.\+\-_\s]/", "", $_REQUEST['callbackname']);
	$cbf_contact = preg_replace("/[^a-zA-Z0-9@.\+\-_\s]/", "", $_REQUEST['callbackcontact']);
	$cbf_sendmail = get_option('cbf_option4');
	$ip=$_SERVER['REMOTE_ADDR'];
	$url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
   	if (empty($cbf_name) || $cbf_name == get_option('cbf_option1')) { $error = strtolower($cbf_name); $form_valid = false; }
	if (empty($cbf_contact) || $cbf_contact== get_option('cbf_option2')) { $error = strtolower($cbf_contact); $form_valid = false; }
	if ($form_valid)
		{
		$subject = "Enquiry from $cbf_name";
		$headers = "From: $callback_name <$cbf_contact>\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
   		$headers .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
		$message = "<html><p>Enquiry from: <b>$cbf_name</b></p>";
		$message .= "<p>Contact: <b>$cbf_contact</b></p>";
		$message .= "<p>The message was sent from this page: <b>$url</b></p>";
		$message .= "<p>This is the senders IP address: <b>$ip</b></p></html>";
		mail( $cbf_sendmail, $subject, $message, $headers);
		echo '<h2>Message Received</h2><p>Thanky your for or your enquiry '.$cbf_name.' We will be in contact soon</p></div>';	
		}
	else
		{
		$errors = 'true';
		}
	return $errors;
	}

function cbf_form()
	{
	ob_start();
	if (isset($_POST['submit']))
		{
		if (cbf_verify($formerrors)) theform('error');
		}
		else
		{
		theform(null);
		}
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
	}
