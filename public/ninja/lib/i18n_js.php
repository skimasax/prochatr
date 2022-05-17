<?php
// +-------------------------------------------------------------------+
// | NinjaFirewall (Pro Edition)                                       |
// |                                                                   |
// | (c) NinTechNet - https://nintechnet.com/                          |
// |                                                                   |
// +-------------------------------------------------------------------+
// | This program is free software: you can redistribute it and/or     |
// | modify it under the terms of the GNU General Public License as    |
// | published by the Free Software Foundation, either version 3 of    |
// | the License, or (at your option) any later version.               |
// |                                                                   |
// | This program is distributed in the hope that it will be useful,   |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of    |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the     |
// | GNU General Public License for more details.                      |
// +-------------------------------------------------------------------+ / sa4

if (! defined( 'NFW_ENGINE_VERSION' ) ) { die( 'Forbidden' ); }

$nfi18n = array(
	'delete_admin_log' 		=> _('Delete log?'),
	'https_warning'			=> _('Warning: ensure that you can access your admin console over HTTPS '.
										'before enabling this option, otherwise you will lock yourself out of '.
										'your site. Continue?'),
	'enter_new_license'		=>	_('Enter your new license and click on the save button'),
	'refresh_preview'			=>	_('Refresh preview'),
	'js_preview'				=>	_('Your message seems to contain Javascript code. For security reason, it '.
										'cannot be previewed from the admin dashboard.'),
	'sanitize_fname'			=>	_('Any character that is not a letter [a-zA-Z], a digit [0-9], a dot [.], '.
										'a hyphen [-] or an underscore [_] will be removed from the filename and '.
										'replaced with the substitution character. Continue?'),
	'allcnblocked'				=>	_('Warning: you have selected to block all available countries in the Geolocation '.
										'Access Control. Are you sure you want to continue?'),
	'del_snapshot'				=>	_('Delete the current snapshot?'),
	// Web Filter
	'empty_fields'				=>	_('Enter at least one keyword or disable the Web Filter.'),
	'wrong_length'				=>	_('Keywords must be from 4 to maximum 150 characters.'),
	'disallow_char'			=>	_('The vertical bar "|" character is not allowed.'),
	// Firewall Log
	'no_record' 				=>	_('No records were found that match the specified search criteria.'),
	'invalid_key' 				=>	_('Your public key is not valid.'),
	'missing_address' 		=>	_('Please enter an IP address.'),
	// Live Log
	'no_traffic' 				=>	_('No traffic yet, please wait'),
	'seconds' 					=>	' '. _('seconds...'),
	'err_unexpected' 			=>	_('Error: Live Log did not receive the expected response from your server:'),
	'error_404' 				=>	_('Error: URL does not seem to exist (404 Not Found):'),
	'log_not_found' 			=>	_('Error: Cannot find your log file. Try to reload this page.'),
	'http_error' 				=>	_('Error: The HTTP server returned the following error code:'),
	// Centralized Logging
	'pukey_1' 					=>	_('Click the "Save Options" button to generate your new public key.'),
	'pukey_2' 					=>	_('You will need to upload that new key to the remote server(s).'),
	'missing_key' 				=>	_('Please enter a secret key, from 30 to 100 ASCII printable characters. '.
										'It will be used to generate your public key.'),
	'missing_ip'			 	=>	_('Please enter this server IP address.'),
	'missing_url' 				=>	_('Please enter the remote websites URL.'),
);

$i18js = 'var nfi18n = {';
foreach ( $nfi18n as $label => $text ) {
	$i18js .= '"'. $label .'":"'. addslashes( $text ) .'",';
}
$i18js = rtrim( $i18js, ',' ) .'};';
echo "<script type='text/javascript'>\n/* <![CDATA[ */\n{$i18js}\n/* ]]> */\n</script>\n";

// ---------------------------------------------------------------------
// EOF
