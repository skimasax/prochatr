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

if (! defined( 'NFW_ENGINE_VERSION' ) && ! defined( 'NFW_INSTALLER' ) ) { die( 'Forbidden' ); }

$http_err_code = array(
	  0 => "Unknown Error",
	100 => "Continue",
	101 => "Switching Protocols",
	200 => "OK",
	201 => "Created",
	202 => "Accepted",
	203 => "Non-Authoritative Information",
	204 => "No Content",
	205 => "Reset Content",
	206 => "Partial Content",
	300 => "Multiple Choices",
	301 => "Moved Permanently",
	302 => "Moved Temporarily",
	303 => "See Other",
	304 => "Not Modified",
	305 => "Use Proxy",
	306 => "(Unused)",
	307 => "Temporary Redirect",
	400 => "Bad Request",
	401 => "Unauthorized",
	402 => "Payment Required",
	403 => "Forbidden",
	404 => "Not Found",
	405 => "Method Not Allowed",
	406 => "Not Acceptable",
	407 => "Proxy Authentication Required",
	408 => "Request Timeout",
	409 => "Conflict",
	410 => "Gone",
	411 => "Length Required",
	412 => "Precondition Failed",
	413 => "Request Entity Too Large",
	414 => "Request-URI Too Long",
	415 => "Unsupported Media Type",
	416 => "Requested Range Not Satisfiable",
	417 => "Expectation Failed",
	500 => "Internal Server Error",
	501 => "Not Implemented",
	502 => "Bad Gateway",
	503 => "Service Unavailable",
	504 => "Gateway Timeout",
	505 => "HTTP Version Not Supported",
	// Misc :
	520 => "Proxy Publisher Failure",
	521 => "Web Server is down",
	522 => "Connection Time Out",
	523 => "Origin is unreachable",
	524 => "A Timeout occured",
);

// ---------------------------------------------------------------------
// Check for HTTPS. This function is also available in firewall.php
// and is declared here only if the firewall is not loaded.

if (! function_exists( 'nfw_is_https' ) ) {

	function nfw_is_https() {
		// Can be defined in the .htninja:
		if ( defined('NFW_IS_HTTPS') ) { return; }

		if ( ( isset( $_SERVER['SERVER_PORT'] ) && $_SERVER['SERVER_PORT'] == 443 ) ||
			( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ||
			( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ) ) {
			define('NFW_IS_HTTPS', true);
		} else {
			define('NFW_IS_HTTPS', false);
		}
	}
	nfw_is_https();
}

// ---------------------------------------------------------------------

function nfw_select_ip() {
	// Ensure we have a proper and single IP (a user may use the .htninja file
	// to redirect HTTP_X_FORWARDED_FOR, which may contain more than one IP,
	// to REMOTE_ADDR):
	if (strpos($_SERVER['REMOTE_ADDR'], ',') !== false) {
		$nfw_match = array_map('trim', @explode(',', $_SERVER['REMOTE_ADDR']));
		foreach($nfw_match as $nfw_m) {
			if ( filter_var($nfw_m, FILTER_VALIDATE_IP) )  {
				define( 'NFW_REMOTE_ADDR', $nfw_m);
				break;
			}
		}
	}
	if (! defined('NFW_REMOTE_ADDR') ) {
		define('NFW_REMOTE_ADDR', htmlspecialchars($_SERVER['REMOTE_ADDR']) );
	}
}

// ---------------------------------------------------------------------

// http://www.php.net/manual/en/function.ini-get.php
function return_bytes( $val ) {

	$val = trim( $val );
	$last = strtolower( $val[strlen( $val )-1] );
	// Turn it into an integer
	$val = (int) $val;
	switch( $last ) {
		case 'g': $val *= 1024;
		case 'm': $val *= 1024;
		case 'k': $val *= 1024;
	}
	return $val;
}

// ---------------------------------------------------------------------
// Save the firewall options or rules.

function save_config( $data, $type ) {

	if ( $type == 'options' ) {
		$file = dirname( __DIR__ ) .'/conf/options.php';
	} elseif ( $type == 'rules' ) {
		$file = dirname( __DIR__ ) .'/conf/rules.php';
	} else {
		return sprintf( _('Unknown file type %s'), htmlspecialchars( $type ) );
	}

	// Make sure the file exists (unless we are running the installer):
	if (! file_exists( $file ) && ! defined('NFW_INSTALLER') ) {
		return sprintf(
			_('Cannot find the "%s" file. Please review your NinjaFirewall installation.'),
			$file
		);
	}

	// Make sure it is writable (unless we are running the installer):
	if (! is_writable( $file ) && ! defined('NFW_INSTALLER') ) {
		return sprintf(
			_('The "%s" is not writable. Please change its permissions.'),
			$file
		);
	}

	// Save options:
	if ( @file_put_contents(
			$file,
			'<?php'."\n\$nfw_{$type} = <<<'EOT'\n". serialize( $data ) ."\nEOT;\n",
			LOCK_EX
		) === false ) {

		return sprintf(
			_('An error occurred while writing to the "%s" file.'),
			$file
		);
	}

	// Clear this file from the opcode cache:
	if ( function_exists( 'opcache_invalidate' ) ) {
		@opcache_invalidate( $file, true );
	}

}

// ---------------------------------------------------------------------

function glyphicon( $type, $msg = null ) {

	if ( $type == 'success' ) {
		$icon_class = 'glyphicon glyphicon-ok-sign cgreen';
	} elseif ( $type == 'error' ) {
		$icon_class = 'glyphicon glyphicon-remove-sign cred';
	} elseif ( $type == 'warning' ) {
		$icon_class = 'glyphicon glyphicon-exclamation-sign corange';
	} elseif ( $type == 'help' ) {
		$icon_class = 'glyphicon glyphicon-question-sign cblue';
	// info
	} else {
		$icon_class = 'glyphicon glyphicon-exclamation-sign cblue';
	}
	if (! empty( $msg ) ) {
		return '<i data-toggle="popover" data-content="'. $msg .'"><span class="'. $icon_class .'" style="cursor:help"></span></i>';
	} else {
		return '<span class="'. $icon_class .'"></span>';
	}
}

// ---------------------------------------------------------------------

function proplus_string() {

	_('Your list is empty.');
	_('Select one or more value to delete.');
	_('Field is empty.');
	_('is already in your list.');
	_('Allowed characters are: a-z  0-9  . - _ : / and space.');
	_('Allowed characters are: a-z  0-9  . - _ / and space.');
	_('IPs must contain:' . '\n' .
		'-at least the first 3 characters.' . '\n' .
		'-IPv4: digits [0-9] and dot [.] only.' . '\n' .
		'-IPv6: digit [0-9], hex chars [a-f] and colon [:] only.' . '\n\n' .
		'See contextual Help for more info.');
	_('The default list of bots will be restored. Continue?');
	_('Your list is empty.');
	_('Select a country to block.');
	_('Select a country to unblock.');
	_('Error: you must select at least one HTTP method.');
	_('Please enter a value for \'General > Source IP\'.');
	_('Your server does not seem to support the %s variable. Save changes anyway?');
	_('Please enter a value for the \'Geolocation Access Control > PHP variable\' field.');
	_('Please enter the number of connections allowed for the \'IP Access Control > Rate limiting\' directive.');
	_('Please enter a number from 1 to 999.');
	_('Please enter a number from 1 to 99.');
	_('All fields will be restored to their default values. Continue?');
	_('Enter a value.');
	_('The length of the string must be between 4 to 150 characters.');
	_('The \'|\' character is not allowed.');
	_('Enter at least one keyword or disable the Web Filter.');
	_('Invalid character.');
	_('Loading...');
	_('No traffic yet, please wait...');
	_('Error: Live Log did not receive the expected response from your server.');
	_('Error: URL does not seem to exist:');
	_('Error: cannot find your log file. Try to reload this page.');
	_('Error: the HTTP server returned the following error code:');
	_('Sleeping');
	_('seconds');
	_('Click the <i>Save Options</i> button to generate your new public key.');
	_('You will need to upload that new key to the remote server(s).');
	_('Please enter a secret key, from 30 to 100 ASCII printable characters. It will be used to generate your public key.');
	_('Please enter this server IP address.');
	_('Please enter the remote websites URL.');
	_('1-hour');
	_('10-second');
	_('12-hour');
	_('15-minute');
	_('15-second');
	_('24-hour');
	_('3-hour');
	_('30-second');
	_('5-minute');
	_('6-hour');
	_('An unknown error occured while connecting to NinjaFirewall servers. Please try again in a few minutes.');
	_('Click here to get a license');
	_('Click here to renew it.');
	_('Enter your new license and click on the save button');
	_('GeoIP database not found.');
	_('License renewal');
	_('NinjaFirewall must be enabled and working in order to use the Live Log feature.');
	_('Please enter the custom log format.');
	_('Save New License');
	_('The URL is invalid.');
	_('The remote server rejected your request. Make sure that you uploaded the correct public key.');
	_('The remote server returned a redirection code: %s.');
	_('The remote server returned the following HTTP error: %s.');
	_('The remote website did not return the expected response.');
	_('The requested log does not exist on the remote website.');
	_('The server returned the following HTTP code: %s %s');
	_('This is already your current license.');
	_('Unable to connect to NinjaFirewall server (%s).');
	_('Unable to connect to the remote website: %s.');
	_('Unable to open the log for read operation.');
	_('Unknown expiration date. Use the "%s" button to attempt to fix this error.');
	_('Warning: Your previous secret key was either corrupted or missing. A new one, as well as a new public key, were created.');
	_('You do not have any license.');
	_('You have a valid license.');
	_('You must be whitelisted in order to use that feature. Click on "Firewall > Access Control" and ensure that the "Whitelist the Administrator" option is enabled.');
	_('Your license has expired.');
	_('Your license is not valid.');
	_('Your license will expire soon.');
	_("Your list is empty. Disable geolocation if you don't use it.");
	_('Your new license has been accepted and saved.');
	_('Your server does not seem to support the %s variable.');

}
// ---------------------------------------------------------------------
// EOF
