=== Callback Form ===

Contributors: 
Tags: contact form, callback
Requires at least: 2.7
Tested up to: 3.3.1
Stable tag: trunk

Simple contact form for newsletter signups, quick contacts and callbacks. 

== Description ==

The callback form plugin was created for newsletter signups, quick contacts and callbacks. It has two fields and a submit button. The labels are displayed as text field values and disappear when the field is selected. The labels and submit button caption are editable and a target email can be entered on installation.

= Features =

*	User editable field names and submit caption
*	Labels display as field values
*	Compact and easy to use
*	Options retained on deactivation
*	Options deleted on uninstall

= Developers plugin page =

[callback form plugin](http://aerin.co.uk/contact-form-plugin/).

= Help advice and testing = 

*	Doug from [123simples.com](http://www.123simples.com/)
*	Rudi from [rudiv.se](http://rudiv.se/)

== Installation ==

1. Upload files to the `/wp-content/plugins/callback` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Use 'Settings' to set the recipient's email address and edit the field labels and submit button caption.
4. Use the shortcode [cbf] in your posts and pages.
5. To use the form in a text widget add the line `add_filter('widget_text', 'do_shortcode');` to your functions.php file. You can now use the shortcode [cbf].
6. To use the form in your theme files use the code `<?php echo do_shortcode('[cbf]'); ?>`.

== Frequently Asked Questions ==

= How do I change the labels and captions? =
Go to your plugin list and scroll down until you see the 'Callback Form' and click on 'Settings'. Change the labels and settings and click on 'Save Settings'.

= What's the shortcode? =
[cbf]

= How do I change the colours? =
Go to your plugin list and scroll down until you see the 'Callback Form' and click on 'Edit'. Click on the link ‘callback-styles.css’ over on the right. Make the changes and click on ‘Update Changes’ down the bottom.

= Can I add more fields? =
No.

= Why not? =
Well OK yes you can add more fields if you want but you are going to have to fiddle about with the php file which needs a bit of care an attention. Everything you need to know is in the [wordpress codex](http://codex.wordpress.org/Writing_a_Plugin).

= It's all gone wrong! =
If it all goes wrong, just reinstall the plugin and start again. If you need help then [contact me](http://aerin.co.uk/contact-me/).

== Changelog ==

= 1.3 = 
*	The thank-you and error messages now appear on the form (much neater and less clicks).

= 1.2 = 
*	Added option to change the width of the form fields
*	Fixed bug in code for theme inclusion
*	Fixed bug in 'setting' fuction

= 1.1 =
*	Changed the layout of the options page to highlight the need to enter an email address
*	Added sender URL and IP information to the email
*	Changed format of email form plain to HTML

= 1.0 =
*	Initial Issue