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

require_once __DIR__ . '/misc.php';

html_header();

// Tab and div display:
if ( empty( $_REQUEST['tab'] ) ) { $_REQUEST['tab'] = 'basic'; }

if ( $_REQUEST['tab'] == 'intermediate' ) {
	$basic_tab = ''; $basic_div = ' style="display:none"';
	$intermediate_tab = ' class="active"'; $intermediate_div = '';
	$advanced_tab = ''; $advanced_div = ' style="display:none"';

} elseif ( $_REQUEST['tab'] == 'advanced' ) {
	$basic_tab = ''; $basic_div = ' style="display:none"';
	$intermediate_tab = ''; $intermediate_div = ' style="display:none"';
	$advanced_tab = ' class="active"'; $advanced_div = '';

} else {
	$_REQUEST['tab'] = 'basic';
	$basic_tab = ' class="active"'; $basic_div = '';
	$intermediate_tab = ''; $intermediate_div = ' style="display:none"';
	$advanced_tab = ''; $advanced_div = ' style="display:none"';
}

?>
<div class="col-sm-12 text-left">
	<h3><?php echo _('Firewall > Policies') ?></h3>
	<br />
<?php

// Saved options
if (! empty( $_POST['post'] ) ) {

	if (! empty( $_POST['restore-policies'] ) ) {
		// Restore default values:
		$err_msg = restore_firewall_policies();

	} else {
		// Save new configuration:
		$err_msg = save_firewall_policies();
	}
	if (! empty( $err_msg ) ) {
		echo '<div class="alert alert-danger text-left"><a class="close" '.
		'data-dismiss="alert" aria-label="close">&times;</a>'. $err_msg .'</div>';
	} else {
		echo '<div class="alert alert-success text-left"><a class="close" data-dismiss="alert"'.
		' aria-label="close">&times;</a>'. _('Your changes were saved.') . '</div>';
	}
}

if ( empty( $nfw_options['scan_protocol'] ) || ! preg_match( '/^[123]$/', $nfw_options['scan_protocol'] ) ) {
	$nfw_options['scan_protocol'] = 3;
}
?>
<form method="post" name="fwrules">

	<ul class="nav nav-tabs">
		<li id="tab-basic"<?php echo $basic_tab ?> onClick="nfw_switch_tabs('basic', 'basic:intermediate:advanced')"><a class="dropdown-toggle"><?php echo _('Basic Policies') ?></a></li>
		<li id="tab-intermediate"<?php echo $intermediate_tab ?>><a onClick="nfw_switch_tabs('intermediate', 'basic:intermediate:advanced')"><?php echo _('Intermediate Policies') ?></a></li>
		<li id="tab-advanced"<?php echo $advanced_tab ?>><a onClick="nfw_switch_tabs('advanced', 'basic:intermediate:advanced')"><?php echo _('Advanced Policies') ?></a></li>
	</ul>
	<br />

	<!-- Basic policies -->

	<div id="basic-options"<?php echo $basic_div ?>>
		<h4><?php echo _('HTTP / HTTPS') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Enable NinjaFirewall for') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<label><input type="radio" name="scan_protocol" value="3"<?php checked($nfw_options['scan_protocol'], 3 ) ?>>&nbsp;<?php echo _('HTTP and HTTPS traffic') ?></label>
					<br />
					<label><input type="radio" name="scan_protocol" value="1"<?php checked($nfw_options['scan_protocol'], 1 ) ?>>&nbsp;<?php echo _('HTTP traffic only') ?></label>
					<br />
					<label><input type="radio" name="scan_protocol" value="2"<?php checked($nfw_options['scan_protocol'], 2 ) ?>>&nbsp;<?php echo _('HTTPS traffic only') ?></label>
				</td>
			</tr>
		</table>

		<?php
		if ( empty( $nfw_options['sanitise_fn'] ) ) {
			$nfw_options['sanitise_fn'] = 0;
		} else {
			$nfw_options['sanitise_fn'] = 1;
		}
		if ( empty( $nfw_options['substitute'] ) || strlen( $nfw_options['substitute'] ) > 1 ||
			$nfw_options['substitute'] == '/' ) {

			$substitute = 'X';
		} else {
			$substitute = htmlspecialchars( $nfw_options['substitute'] );
		}
		if ( empty($nfw_options['uploads'] ) || ! preg_match( '/^[12]$/', $nfw_options['uploads'] ) ) {
			$nfw_options['uploads'] = 0;
		}
		if ( empty( $nfw_options['upload_maxsize'] ) ) {
			// Try to get the current PHP configuration value:
			$upload_maxsize = return_bytes( ini_get('upload_max_filesize') );
			if ( empty( $upload_maxsize ) ) {
				// Set it to 10MB (10240 KB):
				$upload_maxsize = 10240;
			}
		} else {
			$upload_maxsize = $nfw_options['upload_maxsize'] / 1024;
		}
		?>
		<h4><?php echo _('Uploads') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Allow uploads') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
				<label><input type="radio" name="uploads"<?php checked( $nfw_options['uploads'], 0 ) ?> value="0" id="uf1" onClick="san_onoff(0);">&nbsp;<?php echo _('Disallow uploads') ?></label>
				<br />
				<label><input type="radio" name="uploads"<?php checked( $nfw_options['uploads'], 1 ) ?> value="1" id="uf1" onClick="san_onoff(1);">&nbsp;<?php echo _('Allow uploads') ?></label>
				<br />
				<label><input type="radio" name="uploads"<?php checked( $nfw_options['uploads'], 2 ) ?> value="2" id="uf2" onClick="san_onoff(1);">&nbsp;<?php echo _('Allow, but block dangerous files'); ?></label>
				<br />
				<i class="description"><?php echo _('See contextual help for the list of blocked files.') ?></i>
				<br />
				<br />
				<p>
					<label><input id="sanid" onclick='return sanitise_warn(this);' type="checkbox" name="sanitise_fn"<?php checked( $nfw_options['sanitise_fn'], 1 ); disabled( $nfw_options['uploads'], 0 ) ?> />&nbsp;<?php echo _('Sanitise filenames') ?></label>&nbsp;(<?php echo _('substitution character:') ?>&nbsp;<input id="subs" class="form-control" maxlength="1" size="1" value="<?php echo $substitute ?>" name="substitute" type="text" <?php disabled( $nfw_options['uploads'], 0 ) ?> style="width:40px;display:inline" />&nbsp;)
				</p>
				<p>&nbsp;<?php echo _('Maximum allowed file size (in KB)') ?> <input class="form-control" id="sizeid" type="number" min="1" name="upload_maxsize"<?php disabled( $nfw_options['uploads'], 0 ) ?> size="5" value="<?php echo $upload_maxsize ?>" /></p>
				</td>
			</tr>
		</table>
	</div>


	<!-- Intermediate policies -->

	<div id="intermediate-options"<?php echo $intermediate_div ?>>
	<?php

		if ( empty( $nfw_options['get_scan'] ) ) {
			$nfw_options['get_scan'] = 0;
		} else {
			$nfw_options['get_scan'] = 1;
		}
		if ( empty( $nfw_options['get_sanitise'] ) ) {
			$nfw_options['get_sanitise'] = 0;
		} else {
			$nfw_options['get_sanitise'] = 1;
		}
		?>
		<h4><?php echo _('HTTP GET variable') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php printf( _('Scan %s variable'), 'GET' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'get_scan', _('Yes'), _('No'), 'small', $nfw_options['get_scan'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php printf( _('Sanitise %s variable'), 'GET' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'get_sanitise', _('Yes'), _('No'), 'small', $nfw_options['get_sanitise'] ) ?>
				</td>
			</tr>
		</table>

		<?php
		if ( empty( $nfw_options['post_scan'] ) ) {
			$nfw_options['post_scan'] = 0;
		} else {
			$nfw_options['post_scan'] = 1;
		}
		if ( empty( $nfw_options['post_sanitise'] ) ) {
			$nfw_options['post_sanitise'] = 0;
		} else {
			$nfw_options['post_sanitise'] = 1;
		}
		if ( empty( $nfw_options['post_b64'] ) ) {
			$nfw_options['post_b64'] = 0;
		} else {
			$nfw_options['post_b64'] = 1;
		}
		?>
		<h4><?php echo _('HTTP POST variable') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php printf( _('Scan %s variable'), 'POST' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'post_scan', _('Yes'), _('No'), 'small', $nfw_options['post_scan'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php printf( _('Sanitise %s variable'), 'POST' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'warning', 'post_sanitise', _('Yes'), _('No'), 'small', $nfw_options['post_sanitise'] ) ?>
					<i class="description"><?php echo _('Do not enable this option unless you know what you are doing!') ?></i>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Decode base64-encoded POST variable') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'post_b64', _('Yes'), _('No'), 'small', $nfw_options['post_b64'] ) ?>
				</td>
			</tr>
		</table>


		<?php
		if ( empty( $nfw_options['request_sanitise'] ) ) {
			$nfw_options['request_sanitise'] = 0;
		} else {
			$nfw_options['request_sanitise'] = 1;
		}
		?>
		<h4><?php echo _('HTTP REQUEST variable') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php printf( _('Sanitise %s variable'), 'REQUEST' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'warning', 'request_sanitise', _('Yes'), _('No'), 'small', $nfw_options['request_sanitise'] ) ?>
					<i class="description"><?php echo _('Do not enable this option unless you know what you are doing!') ?></i>
				</td>
			</tr>
		</table>


		<?php
		if ( empty( $nfw_options['cookies_scan'] ) ) {
			$nfw_options['cookies_scan'] = 0;
		} else {
			$nfw_options['cookies_scan'] = 1;
		}
		if ( empty( $nfw_options['cookies_sanitise'] ) ) {
			$nfw_options['cookies_sanitise'] = 0;
		} else {
			$nfw_options['cookies_sanitise'] = 1;
		}
		?>
		<h4><?php echo _('Cookies') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php printf( _('Scan %s variable'), 'COOKIE' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'cookies_scan', _('Yes'), _('No'), 'small', $nfw_options['cookies_scan'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php printf( _('Sanitise %s variable'), 'COOKIE' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'cookies_sanitise', _('Yes'), _('No'), 'small', $nfw_options['cookies_sanitise'] ) ?>
				</td>
			</tr>
		</table>

		<?php
		if ( empty( $nfw_options['ua_scan'] ) ) {
			$nfw_options['ua_scan'] = 0;
		} else {
			$nfw_options['ua_scan'] = 1;
		}
		if ( empty( $nfw_options['ua_sanitise'] ) ) {
			$nfw_options['ua_sanitise'] = 0;
		} else {
			$nfw_options['ua_sanitise'] = 1;
		}
		if ( empty( $nfw_options['ua_mozilla'] ) ) {
			$nfw_options['ua_mozilla'] = 0;
		} else {
			$nfw_options['ua_mozilla'] = 1;
		}
		if ( empty( $nfw_options['ua_accept'] ) ) {
			$nfw_options['ua_accept'] = 0;
		} else {
			$nfw_options['ua_accept'] = 1;
		}
		if ( empty( $nfw_options['ua_accept_lang'] ) ) {
			$nfw_options['ua_accept_lang'] = 0;
		} else {
			$nfw_options['ua_accept_lang'] = 1;
		}
		if ( NFW_EDN == 1 ) {
			// Pro Edn only, as this is managed by the
			// Access Control page in the Pro+ Edn. :
			if ( empty( $nfw_rules[NFW_SCAN_BOTS]['ena']) ) {
				$block_bots = 0;
			} else {
				$block_bots = 1;
			}
		}
		?>
		<h4><?php echo _('HTTP_USER_AGENT server variable') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php printf( _('Scan %s variable'), 'HTTP_USER_AGENT' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'ua_scan', _('Yes'), _('No'), 'small', $nfw_options['ua_scan'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php printf( _('Sanitise %s variable'), 'HTTP_USER_AGENT' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'ua_sanitise', _('Yes'), _('No'), 'small', $nfw_options['ua_sanitise'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Block POST requests from User-Agents that do not have') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<label><input type="checkbox" name="ua_mozilla" value="1"<?php checked( $nfw_options['ua_mozilla'], 1 ) ?>>&nbsp;<?php echo _('A Mozilla-compatible signature') ?></label>
					<br />
					<label><input type="checkbox" name="ua_accept" value="1"<?php checked( $nfw_options['ua_accept'], 1 ) ?>>&nbsp;<?php echo _('A HTTP_ACCEPT header') ?></label>
					<br />
					<label><input type="checkbox" name="ua_accept_lang" value="1"<?php checked( $nfw_options['ua_accept_lang'], 1 ) ?>>&nbsp;<?php echo _('A HTTP_ACCEPT_LANGUAGE header') ?></label>
					<p><i class="description"><?php echo _('Keep these 3 options disabled if you are using scripts like Paypal IPN (unless you added them to your IP or URL Access Control whitelist).') ?></i></p>
				</td>
			</tr>

			<?php if ( NFW_EDN == 1 ) { ?>
			<tr>
				<td class="f-left"><?php echo _('Block suspicious bots/scanners') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'block_bots', _('Yes'), _('No'), 'small', $block_bots ) ?>
				</td>
			</tr>
			<?php } ?>
		</table>

		<?php
		if ( empty( $nfw_options['referer_scan'] ) ) {
			$referer_scan = 0;
		} else {
			$referer_scan = 1;
		}
		if ( empty( $nfw_options['referer_sanitise'] ) ) {
			$referer_sanitise = 0;
		} else {
			$referer_sanitise = 1;
		}
		if ( empty( $nfw_options['referer_post'] ) ) {
			$referer_post = 0;
		} else {
			$referer_post = 1;
		}
		?>
		<h4><?php echo _('HTTP_REFERER server variable') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php printf( _('Scan %s variable'), 'HTTP_REFERER' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'referer_scan', _('Yes'), _('No'), 'small', $nfw_options['referer_scan'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php printf( _('Sanitise %s variable'), 'HTTP_REFERER' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'referer_sanitise', _('Yes'), _('No'), 'small', $nfw_options['referer_sanitise'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Block POST requests that do not have an HTTP_REFERER header') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'referer_post', _('Yes'), _('No'), 'small', $nfw_options['referer_post'] ) ?>
					<p><i class="description"><?php echo _('Keep this option disabled if you are using scripts like Paypal IPN (unless you added them to your IP or URL Access Control whitelist).') ?></i></p>
				</td>
			</tr>
		</table>
	</div>


	<!-- Advanced policies -->

	<div id="advanced-options"<?php echo $advanced_div ?>>

	<?php
		// Some compatibility checks:
		// 1. header_register_callback(): requires PHP >=5.4
		// 2. headers_list() and header_remove(): some hosts may disable them.
		$err_msg = ''; $err = '';
		$err_img = glyphicon( 'help', '%s' );

		if (! function_exists('header_register_callback') ) {
			$err_msg = sprintf( $err_img, sprintf( _('This option is disabled because the %s PHP function is not available on your server.'), 'header_register_callback()') );
			$err = 1;
		} elseif (! function_exists('headers_list') ) {
			$err_msg = sprintf( $err_img, sprintf( _('This option is disabled because the %s PHP function is not available on your server.'), 'headers_list()') );
			$err = 1;
		} elseif (! function_exists('header_remove') ) {
			$err_msg = sprintf( $err_img, sprintf( _('This option is disabled because the %s PHP function is not available on your server.'), 'header_remove()') );
			$err = 1;
		}
		if ( empty($nfw_options['response_headers']) || ! preg_match( '/^\d+$/', $nfw_options['response_headers'] ) || $err_msg ) {
			$nfw_options['response_headers'] = '000000000';
		}
		?>
		<h4><?php echo _('HTTP response headers') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Set X-Content-Type-Options to protect against MIME type confusion attacks') ?></td>
				<td class="f-center"><?php echo $err_msg ?></td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'x_content_type_options', _('Yes'), _('No'), 'small', $nfw_options['response_headers'][1], $err ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Set X-Frame-Options to protect against clickjacking attempts') ?></td>
				<td class="f-center"><?php echo $err_msg ?></td>
				<td class="f-right">
					<select name="x_frame_options" class="form-control" <?php disabled( $err, 1 ) ?>>
						<option value="0"<?php selected( $nfw_options['response_headers'][2], 0 ) ?>><?php echo _('No') ?></option>
						<option value="1"<?php selected( $nfw_options['response_headers'][2], 1 ) ?>>SAMEORIGIN</option>
						<option value="2"<?php selected( $nfw_options['response_headers'][2], 2 ) ?>>DENY</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Set X-XSS-Protection (IE/Edge, Chrome, Opera and Safari browsers)') ?></td>
				<td class="f-center"><?php echo $err_msg ?></td>
				<td class="f-right">
					<select name="x_xss_protection" class="form-control" <?php disabled( $err, 1 ) ?>>
						<option value="3"<?php selected( $nfw_options['response_headers'][3], 3 ) ?>><?php echo _('No') ?></option>
						<option value="0"<?php selected( $nfw_options['response_headers'][3], 0 ) ?>><?php printf( _('Set to %s'), '"0"'); ?></option>
						<option value="2"<?php selected( $nfw_options['response_headers'][3], 2 ) ?>><?php printf( _('Set to %s'), '"1"'); ?></option>
						<option value="1"<?php selected( $nfw_options['response_headers'][3], 1 ) ?>><?php printf( _('Set to %s'), '"1; mode=block"') ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Force HttpOnly flag on all cookies to mitigate XSS attacks') ?></td>
				<td class="f-center"><?php
					if (! empty( $err_msg ) ) {
						echo $err_msg;
					} else {
						echo glyphicon('help', _('If your PHP scripts send cookies that need to be accessed from JavaScript, you should keep this option disabled.') );
					}

				?></td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'cookies_httponly', _('Yes'), _('No'), 'small', $nfw_options['response_headers'][0], $err ) ?>
				</td>
			</tr>
			<?php
			// We don't send HSTS headers over HTTP (only display this message if there
			// is no other warning to display, $err==0 ):
			if ( NFW_IS_HTTPS == false && ! $err ) {
				$hsts_err = 1;
				$hsts_msg = sprintf( $err_img, _('HSTS headers can only be set when you are accessing your site over HTTPS.') );
			} else {
				$hsts_msg = '';
				$hsts_err = 0;
			}
			if ( $err == 1 ) { $hsts_err = 1; }
			?>
			<tr>
				<td class="f-left"><?php echo _('Set Strict-Transport-Security (HSTS) to enforce secure connections to the server') ?></td>
				<td class="f-center aligntop"><?php
					if ( empty( $hsts_msg ) ) {
						echo $err_msg;
					} else {
						echo $hsts_msg;
					}
				?>
				</td>
				<td class="f-right">
					<select name="strict_transport" class="form-control" <?php disabled( $hsts_err, 1 ) ?>>
						<option value="0"<?php selected( $nfw_options['response_headers'][4], 0 ) ?>><?php echo _('No'); ?></option>
						<option value="4"<?php selected( $nfw_options['response_headers'][4], 4 ) ?>><?php echo _('Set "max-age" to 0') ?></option>
						<option value="1"<?php selected( $nfw_options['response_headers'][4], 1 ) ?>><?php echo _('1 month') ?></option>
						<option value="2"<?php selected( $nfw_options['response_headers'][4], 2 ) ?>><?php echo _('6 months') ?></option>
						<option value="3"<?php selected( $nfw_options['response_headers'][4], 3 ) ?>><?php echo _('1 year') ?></option>
					</select>
					<label><input type="checkbox" name="strict_transport_sub" value="1"<?php checked( $nfw_options['response_headers'][5], 1 );disabled($hsts_err, 1) ?>>&nbsp;<?php echo _('Apply to all subdomains') ?></label>
				</td>
			</tr>

			<?php
				if (! isset( $nfw_options['csp_frontend_data'] ) ) {
					$nfw_options['csp_frontend_data'] = '';
				}
				if (! isset( $nfw_options['response_headers'][6] ) ) {
					$nfw_options['response_headers'][6] = 0;
				}
			?>
			<tr>
				<td class="f-left"><?php echo _('Set Content-Security-Policy') ?></td>
				<td class="f-center"><?php echo $err_msg ?></td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'csp_frontend', _('Yes'), _('No'), 'small', $nfw_options['response_headers'][6], $err, 'onclick="csp_onoff();"', 'csp_switch' ) ?>
					<textarea autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" name="csp_frontend_data" id="csp" class="form-control" rows="4"<?php readonly( $err, 1 ); readonly( $nfw_options['response_headers'][6], 0 ) ?> style="resize: vertical;"><?php echo htmlspecialchars( $nfw_options['csp_frontend_data'] ) ?></textarea>
				</td>
			</tr>

			<?php
			if (! isset( $nfw_options['response_headers'][8] ) ) {
				$nfw_options['response_headers'][8] = 0;
			}
			if ( empty( $nfw_options['referrer_policy_enabled'] ) ) {
				$nfw_options['referrer_policy_enabled'] = 0;
			} else {
				$nfw_options['referrer_policy_enabled'] = 1;
			}
			?>
			<tr>
				<td class="f-left"><?php echo _('Set Referrer-Policy (Chrome, Opera and Firefox browsers)') ?></td>
				<td class="f-center"><?php echo $err_msg ?></td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'referrer_policy_enabled', _('Yes'), _('No'), 'small', $nfw_options['referrer_policy_enabled'], false, 'onclick="referrer_onoff();"', 'referrer_switch' ) ?>
					<select class="form-control" id="rp_select" name="referrer_policy"<?php disabled( $nfw_options['referrer_policy_enabled'], 0) ?>>
						<option value="1"<?php selected( $nfw_options['response_headers'][8], 1 ) ?>>no-referrer</option>
						<option value="2"<?php selected( $nfw_options['response_headers'][8], 2 ) ?>>no-referrer-when-downgrade</option>
						<option value="3"<?php selected( $nfw_options['response_headers'][8], 3 ) ?>>origin</option>
						<option value="4"<?php selected( $nfw_options['response_headers'][8], 4 ) ?>>origin-when-cross-origin</option>
						<option value="5"<?php selected( $nfw_options['response_headers'][8], 5 ) ?>>strict-origin</option>
						<option value="6"<?php selected( $nfw_options['response_headers'][8], 6 ) ?>>strict-origin-when-cross-origin</option>
						<option value="7"<?php selected( $nfw_options['response_headers'][8], 7 ) ?>>same-origin</option>
						<option value="8"<?php selected( $nfw_options['response_headers'][8], 8 ) ?>>unsafe-url</option>
					</select>
				</td>
			</tr>
		</table>


		<?php
		if ( empty( $nfw_rules[NFW_WRAPPERS]['ena'] ) ) {
			$nfw_rules[NFW_WRAPPERS]['ena'] = 0;
		} else {
			$nfw_rules[NFW_WRAPPERS]['ena'] = 1;
		}

		if (! empty( $nfw_rules[NFW_OBJECTS]['ena'] ) ) {
			if ( strpos( $nfw_rules[NFW_OBJECTS]['cha'][1]['whe'], 'GET' )  !== FALSE) {
				$NFW_OBJECTS_GET = ' checked="checked"';
			} else {
				$NFW_OBJECTS_GET = '';
			}
			if ( strpos( $nfw_rules[NFW_OBJECTS]['cha'][1]['whe'], 'POST' )  !== FALSE) {
				$NFW_OBJECTS_POST = ' checked="checked"';
			} else {
				$NFW_OBJECTS_POST = '';
			}
			if ( strpos( $nfw_rules[NFW_OBJECTS]['cha'][1]['whe'], 'COOKIE' )  !== FALSE) {
				$NFW_OBJECTS_COOKIE = ' checked="checked"';
			} else {
				$NFW_OBJECTS_COOKIE = '';
			}
			if ( strpos( $nfw_rules[NFW_OBJECTS]['cha'][1]['whe'], 'HTTP_USER_AGENT' )  !== FALSE) {
				$NFW_OBJECTS_HTTP_USER_AGENT = ' checked="checked"';
			} else {
				$NFW_OBJECTS_HTTP_USER_AGENT = '';
			}
			if ( strpos( $nfw_rules[NFW_OBJECTS]['cha'][1]['whe'], 'HTTP_REFERER' )  !== FALSE) {
				$NFW_OBJECTS_HTTP_REFERER = ' checked="checked"';
			} else {
				$NFW_OBJECTS_HTTP_REFERER = '';
			}
		} else {
			$NFW_OBJECTS_GET = ''; $NFW_OBJECTS_POST = ''; $NFW_OBJECTS_COOKIE = '';
			$NFW_OBJECTS_HTTP_USER_AGENT = ''; $NFW_OBJECTS_HTTP_REFERER = '';
		}

		if ( empty( $nfw_options['php_errors'] ) ) {
			$nfw_options['php_errors'] = 0;
		} else {
			$nfw_options['php_errors'] = 1;
		}
		if ( empty( $nfw_options['php_self'] ) ) {
			$nfw_options['php_self'] = 0;
		} else {
			$nfw_options['php_self'] = 1;
		}
		if ( empty( $nfw_options['php_path_t'] ) ) {
			$nfw_options['php_path_t'] = 0;
		} else {
			$nfw_options['php_path_t'] = 1;
		}
		if ( empty( $nfw_options['php_path_i'] ) ) {
			$nfw_options['php_path_i'] = 0;
		} else {
			$nfw_options['php_path_i'] = 1;
		}
		?>
		<h4><?php echo _('PHP') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Block PHP built-in wrappers in GET, POST, HTTP_USER_AGENT, HTTP_REFERER and cookies') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'php_wrappers', _('Yes'), _('No'), 'small', $nfw_rules[NFW_WRAPPERS]['ena'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Block serialized PHP objects in the following global variables') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<label><input type="checkbox" name="nfw_rules[php_objects_get]" value="1"<?php echo $NFW_OBJECTS_GET ?>>&nbsp;GET</label>
					<br />
					<label><input type="checkbox" name="nfw_rules[php_objects_post]" value="1"<?php echo $NFW_OBJECTS_POST ?>>&nbsp;POST</label>
					<br />
					<label><input type="checkbox" name="nfw_rules[php_objects_http_user_agent]" value="1"<?php echo $NFW_OBJECTS_HTTP_USER_AGENT ?>>&nbsp;HTTP_USER_AGENT</label>
					<br />
					<label><input type="checkbox" name="nfw_rules[php_objects_http_referer]" value="1"<?php echo $NFW_OBJECTS_HTTP_REFERER ?>>&nbsp;HTTP_REFERER</label>
					<br />
					<label><input type="checkbox" name="nfw_rules[php_objects_cookie]" value="1"<?php echo $NFW_OBJECTS_COOKIE ?>>&nbsp;COOKIE</label>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Hide PHP notice and error messages') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'php_errors', _('Yes'), _('No'), 'small', $nfw_options['php_errors'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php printf( _('Sanitise %s variable'), 'PHP_SELF' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'php_self', _('Yes'), _('No'), 'small', $nfw_options['php_self'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php printf( _('Sanitise %s variable'), 'PATH_TRANSLATED' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'php_path_t', _('Yes'), _('No'), 'small', $nfw_options['php_path_t'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php printf( _('Sanitise %s variable'), 'PATH_INFO' ) ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'php_path_i', _('Yes'), _('No'), 'small', $nfw_options['php_path_i'] ) ?>
				</td>
			</tr>
		</table>

		<?php
		// If the document root is < 5 characters, disable that option:
		if ( empty( $nfw_rules[NFW_DOC_ROOT]['ena'] ) || strlen( $_SERVER['DOCUMENT_ROOT'] ) < 5 ) {
			$nfw_rules[NFW_DOC_ROOT]['ena'] = 0;
		} else {
			$nfw_rules[NFW_DOC_ROOT]['ena'] = 1;
		}
		if ( empty( $nfw_rules[NFW_NULL_BYTE]['ena'] ) ) {
			$nfw_rules[NFW_NULL_BYTE]['ena'] = 0;
		} else {
			$nfw_rules[NFW_NULL_BYTE]['ena'] = 1;
		}
		if ( empty( $nfw_rules[NFW_ASCII_CTRL]['ena'] ) ) {
			$nfw_rules[NFW_ASCII_CTRL]['ena'] = 0;
		} else {
			$nfw_rules[NFW_ASCII_CTRL]['ena'] = 1;
		}
		if ( empty( $nfw_rules[NFW_LOOPBACK]['ena'] ) ) {
			$nfw_rules[NFW_LOOPBACK]['ena'] = 0;
		} else {
			$nfw_rules[NFW_LOOPBACK]['ena'] = 1;
		}
		if ( empty( $nfw_options['no_host_ip'] ) ) {
			$nfw_options['no_host_ip'] = 0;
		} else {
			$nfw_options['no_host_ip'] = 1;
		}
		if ( empty( $nfw_options['request_method'] ) ) {
			$nfw_options['request_method'] = 0;
		} else {
			$nfw_options['request_method'] = 1;
		}
		?>
		<h4><?php echo _('Various') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Block the DOCUMENT_ROOT server variable in HTTP request') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'block_doc_root', _('Yes'), _('No'), 'small', $nfw_rules[NFW_DOC_ROOT]['ena'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Block ASCII character 0x00 (NULL byte)') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'block_null_byte', _('Yes'), _('No'), 'small', $nfw_rules[NFW_NULL_BYTE]['ena'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Block ASCII control characters 1 to 8 and 14 to 31') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'block_ctrl_chars', _('Yes'), _('No'), 'small', $nfw_rules[NFW_ASCII_CTRL]['ena'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Block localhost IP in GET/POST request') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'no_localhost_ip', _('Yes'), _('No'), 'small', $nfw_rules[NFW_LOOPBACK]['ena'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Block HTTP requests with an IP in the HTTP_HOST header') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'no_host_ip', _('Yes'), _('No'), 'small', $nfw_options['no_host_ip'] ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Accept the following HTTP methods') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'request_method', _('GET, POST and HEAD only'), _('Any HTTP method'), 300, $nfw_options['request_method'] ) ?>
				</td>
			</tr>
		</table>
	</div>

	<input type="hidden" name="mid" value="<?php echo $GLOBALS['mid'] ?>">
	<input type="hidden" name="post" value="1">
	<center>
		<input type="hidden" name="tab" id="tab-selected" value="<?php echo htmlspecialchars( $_REQUEST['tab']  ) ?>" />
		<input type="submit" name="save-policies" class="btn btn-md btn-success btn-25" value="<?php echo _('Save Changes') ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="restore-policies" class="btn btn-md btn-default btn-25" value="<?php echo _('Restore Default Values') ?>" onclick="return restore_default('<?php echo _('All fields will be restored to their default values and any changes you made will be lost. Continue?') ?>');" />
	</center>

</form>
</div>
<?php

html_footer();

// ---------------------------------------------------------------------

function restore_firewall_policies() {

	global $nfw_options;
	global $nfw_rules;

	$nfw_options['scan_protocol'] = 3;
	$nfw_options['uploads'] = 2;
	$nfw_options['sanitise_fn'] = 0;
	$nfw_options['substitute'] = 'X';

	// Try to get the current PHP configuration value:
	$nfw_options['upload_maxsize'] = return_bytes( ini_get('upload_max_filesize') );
	if ( empty( $nfw_options['upload_maxsize'] ) ) {
		// Set it to 10MB (10240 KB):
		$nfw_options['upload_maxsize'] = 10240;
	}

	$nfw_options['get_scan'] = 1;
	$nfw_options['get_sanitise'] = 0;
	$nfw_options['post_scan'] = 1;
	$nfw_options['post_sanitise'] = 0;
	$nfw_options['post_b64'] = 1;
	$nfw_options['request_sanitise'] = 0;
	$nfw_options['cookies_scan'] = 1;
	$nfw_options['cookies_sanitise'] = 0;
	$nfw_options['ua_scan'] = 1;
	$nfw_options['ua_sanitise'] = 1;
	$nfw_options['ua_mozilla'] = 0;
	$nfw_options['ua_accept'] = 0;
	$nfw_options['ua_accept_lang'] = 0;
	if ( NFW_EDN == 1 ) {
		$nfw_rules[NFW_SCAN_BOTS]['ena'] = 1;
	}
	$nfw_options['referer_scan'] = 0;
	if ( function_exists('header_register_callback') &&
		function_exists('headers_list') && function_exists('header_remove') ) {

		// Security headers:
		$nfw_options['response_headers'] = '000300000';
		$nfw_options['referrer_policy_enabled'] = 0;
		$nfw_options['csp_frontend_data'] = '';
	}
	$nfw_options['referer_sanitise'] = 1;
	$nfw_options['referer_post'] = 0;
	$nfw_rules[NFW_WRAPPERS]['ena'] = 1;

	$nfw_rules[NFW_OBJECTS]['ena'] = 1;
	$nfw_rules[NFW_OBJECTS]['cha'][1]['whe'] = 'GET|POST|SERVER:HTTP_USER_AGENT|SERVER:HTTP_REFERER';

	$nfw_options['php_errors'] = 1;
	$nfw_options['php_self'] = 1;
	$nfw_options['php_path_t'] = 1;
	$nfw_options['php_path_i'] = 1;

	if ( strlen( $_SERVER['DOCUMENT_ROOT'] ) > 5 ) {
		$nfw_rules[NFW_DOC_ROOT]['cha'][1]['wha'] = str_replace( '/', '/[./]*', $_SERVER['DOCUMENT_ROOT'] );
	} elseif ( strlen( getenv( 'DOCUMENT_ROOT' ) ) > 5 ) {
		$nfw_rules[NFW_DOC_ROOT]['cha'][1]['wha'] = str_replace( '/', '/[./]*', getenv( 'DOCUMENT_ROOT' ) );
	}
	$nfw_rules[NFW_DOC_ROOT]['ena']	= 0;

	$nfw_rules[NFW_NULL_BYTE]['ena'] = 1;
	$nfw_rules[NFW_ASCII_CTRL]['ena'] = 0;
	$nfw_rules[NFW_LOOPBACK]['ena'] = 0;
	$nfw_options['no_host_ip'] = 0;
	$nfw_options['request_method'] = 0;

	// Save options:
	$res = save_config( $nfw_options, 'options' );
	if (! empty( $res ) ) {
		return $res;
	}
	// And rules:
	$res = save_config( $nfw_rules, 'rules' );
	if (! empty( $res ) ) {
		return $res;
	}

	return;
}

// ---------------------------------------------------------------------

function save_firewall_policies() {

	global $nfw_options;
	global $nfw_rules;

	// HTTP/S traffic to scan :
	if ( isset( $_POST['scan_protocol'] ) &&
		preg_match( '/^[123]$/', $_POST['scan_protocol'] ) ) {

			$nfw_options['scan_protocol'] = $_POST['scan_protocol'];
	} else {
		// Default : HTTP + HTTPS
		$nfw_options['scan_protocol'] = 3;
	}

	// Allow uploads ?
	if ( isset( $_POST['uploads'] ) && preg_match( '/^[12]$/', $_POST['uploads'] ) ) {
			$nfw_options['uploads'] = $_POST['uploads'];
	} else {
		$nfw_options['uploads'] = 0;
	}
	// Sanitise filenames (if uploads are allowed) ?
	if ( isset( $_POST['sanitise_fn']) ) {
		$nfw_options['sanitise_fn'] = 1;
	} else {
		$nfw_options['sanitise_fn'] = 0;
	}
	// Substitution character:
	// Don't allow the '/' character:
	if ( empty( $_POST['substitute'] ) || strlen( $_POST['substitute'] ) > 1 || @$nfw_options['substitute'] == '/' ) {
		$nfw_options['substitute'] = 'X';
	} else {
		$nfw_options['substitute'] = $_POST['substitute'];
	}

	// Max file size :
	if ( isset($_POST['upload_maxsize'] ) && preg_match( '/^\d+$/', $_POST['upload_maxsize'] ) ) {
		$nfw_options['upload_maxsize'] = $_POST['upload_maxsize'] * 1024;
	} else {
		// Default : 10,485,760 bytes (10MB)
		$nfw_options['upload_maxsize'] = 10485760;
	}

	// Scan GET requests ?
	if ( empty( $_POST['get_scan'] ) ) {
		$nfw_options['get_scan'] = 0;
	} else {
		// Default: yes
		$nfw_options['get_scan'] = 1;
	}
	// Sanitise GET requests ?
	if ( empty( $_POST['get_sanitise'] ) ) {
		// Default: no
		$nfw_options['get_sanitise'] = 0;
	} else {
		$nfw_options['get_sanitise'] = 1;
	}

	// Scan POST requests ?
	if ( empty( $_POST['post_scan'] ) ) {
		$nfw_options['post_scan'] = 0;
	} else {
		// Default: yes
		$nfw_options['post_scan'] = 1;
	}
	// Sanitise POST requests ?
	if ( empty( $_POST['post_sanitise'] ) ) {
		// Default: no
		$nfw_options['post_sanitise'] = 0;
	} else {
		$nfw_options['post_sanitise'] = 1;
	}
	// Decode base64 values in POST requests ?
	if ( empty( $_POST['post_b64'] ) ) {
		$nfw_options['post_b64'] = 0;
	} else {
		// Default: yes
		$nfw_options['post_b64'] = 1;
	}

	// HTTP response headers:
	if ( function_exists('header_register_callback') &&
		function_exists('headers_list') && function_exists('header_remove') ) {

		$nfw_options['response_headers'] = '000000000';
		$nfw_options['csp_frontend_data'] = '';
		// X-Content-Type-Options
		if ( empty( $_POST['x_content_type_options'] ) ) {
			$nfw_options['response_headers'][1] = 0;
		} else {
			$nfw_options['response_headers'][1] = 1;
		}
		// X-Frame-Options
		if ( empty( $_POST['x_frame_options'] ) ) {
			$nfw_options['response_headers'][2] = 0;
		} elseif ( $_POST['x_frame_options'] == 1) {
			$nfw_options['response_headers'][2] = 1;
		} else {
			$nfw_options['response_headers'][2] = 2;
		}
		// XSS filter:
		// 	0 = 0
		// 	1 = 1; mode=block
		// 	2 = 1
		// 	3 = unset
		if ( empty( $_POST['x_xss_protection'] ) ) {
			$nfw_options['response_headers'][3] = 0;
		} elseif ( $_POST['x_xss_protection'] == 1 ) {
			$nfw_options['response_headers'][3] = 1;
		} elseif ( $_POST['x_xss_protection'] == 2 ) {
			$nfw_options['response_headers'][3] = 2;
		} else {
			$nfw_options['response_headers'][3] = 3;
		}
		// HttpOnly cookies ?
		if ( empty( $_POST['cookies_httponly'] ) ) {
			$nfw_options['response_headers'][0] = 0;
		} else {
			$nfw_options['response_headers'][0] = 1;
		}
		// Strict-Transport-Security ?
		if (! isset( $_POST['strict_transport_sub'] ) ) {
			$nfw_options['response_headers'][5] = 0;
		} else {
			$nfw_options['response_headers'][5] = 1;
		}
		if ( empty( $_POST['strict_transport'] ) ) {
			$nfw_options['response_headers'][4] = 0;
			$nfw_options['response_headers'][5] = 0;
		} elseif ( $_POST['strict_transport'] == 1) {
			$nfw_options['response_headers'][4] = 1;
		} elseif ( $_POST['strict_transport'] == 2) {
			$nfw_options['response_headers'][4] = 2;
		} elseif ( $_POST['strict_transport'] == 3) {
			$nfw_options['response_headers'][4] = 3;
		} else {
			$nfw_options['response_headers'][4] = 4;
		}
		// Content-Security-Policy ?
		$nfw_options['csp_frontend_data'] = stripslashes(
			str_replace( array( '<', '>', "\x0a", "\x0d", '%', '$', '&') ,
			'',
			$_POST['csp_frontend_data'] )
		);
		if ( empty( $_POST['csp_frontend'] ) || empty( $nfw_options['csp_frontend_data'] ) ) {
			$nfw_options['response_headers'][6] = 0;
		} else {
			$nfw_options['response_headers'][6] = 1;
		}

		if ( empty( $_POST['referrer_policy_enabled'] ) ) {
			$nfw_options['referrer_policy_enabled'] = 0;
			$_POST['referrer_policy'] = 0;
		} else {
			$nfw_options['referrer_policy_enabled'] = 1;
		}

		if ( empty( $_POST['referrer_policy'] ) || ! preg_match('/^[1-8]$/', $_POST['referrer_policy'] ) ) {
			$nfw_options['response_headers'][8] = 0;
			$nfw_options['referrer_policy_enabled'] = 0;
		} else {
			$nfw_options['response_headers'][8] = (int)$_POST['referrer_policy'];
		}

	}

	// Sanitise REQUEST requests ?
	if ( empty( $_POST['request_sanitise'] ) ) {
		// Default: yes
		$nfw_options['request_sanitise'] = 0;
	} else {
		$nfw_options['request_sanitise'] = 1;
	}

	// Scan COOKIE requests ?
	if ( empty( $_POST['cookies_scan'] ) ) {
		$nfw_options['cookies_scan'] = 0;
	} else {
		// Default: yes
		$nfw_options['cookies_scan'] = 1;
	}
	// Sanitise COOKIE requests ?
	if ( empty( $_POST['cookies_sanitise'] ) ) {
		// Default: no
		$nfw_options['cookies_sanitise'] = 0;
	} else {
		$nfw_options['cookies_sanitise'] = 1;
	}

	// Scan HTTP_USER_AGENT requests ?
	if ( empty( $_POST['ua_scan'] ) ) {
		$nfw_options['ua_scan'] = 0;
	} else {
		// Default: yes
		$nfw_options['ua_scan'] = 1;
	}
	// Sanitise HTTP_USER_AGENT requests ?
	if ( empty( $_POST['ua_sanitise'] ) ) {
		$nfw_options['ua_sanitise'] = 0;
	} else {
		// Default: yes
		$nfw_options['ua_sanitise'] = 1;
	}

	// Mozilla-compatible signature ?
	if ( isset( $_POST['ua_mozilla'] ) ) {
		$nfw_options['ua_mozilla'] = 1;
	} else {
		$nfw_options['ua_mozilla'] = 0;
	}
	// HTTP_ACCEPT header ?
	if ( isset( $_POST['ua_accept'] ) ) {
		$nfw_options['ua_accept'] = 1;
	} else {
		$nfw_options['ua_accept'] = 0;
	}
	// HTTP_ACCEPT_LANGUAGE header  ?
	if ( isset( $_POST['ua_accept_lang'] ) ) {
		$nfw_options['ua_accept_lang'] = 1;
	} else {
		$nfw_options['ua_accept_lang'] = 0;
	}

	if ( NFW_EDN == 1 ) {
		// Block suspicious bots/scanners ?
		if ( empty( $_POST['block_bots']) ) {
			$nfw_rules[NFW_SCAN_BOTS]['ena'] = 0;
		} else {
			// Default: yes
			$nfw_rules[NFW_SCAN_BOTS]['ena'] = 1;
		}
	}
	// Scan HTTP_REFERER requests ?
	if ( empty( $_POST['referer_scan'] ) ) {
		// Default: no
		$nfw_options['referer_scan'] = 0;
	} else {
		$nfw_options['referer_scan'] = 1;
	}
	// Sanitise HTTP_REFERER requests ?
	if ( empty( $_POST['referer_sanitise'] ) ) {
		$nfw_options['referer_sanitise'] = 0;
	} else {
		// Default: yes
		$nfw_options['referer_sanitise'] = 1;
	}
	// Block POST requests without HTTP_REFERER ?
	if ( empty( $_POST['referer_post'] ) ) {
		// Default: NO
		$nfw_options['referer_post'] = 0;
	} else {
		$nfw_options['referer_post'] = 1;
	}

	// Block HTTP requests with an IP in the Host header ?
	if ( empty( $_POST['no_host_ip'] ) ) {
		// Default: NO
		$nfw_options['no_host_ip'] = 0;
	} else {
		$nfw_options['no_host_ip'] = 1;
	}

	// Hide PHP notice & error messages :
	if ( empty( $_POST['php_errors'] ) ) {
		$nfw_options['php_errors'] = 0;
	} else {
		// Default: yes
		$nfw_options['php_errors'] = 1;
	}

	// Sanitise PHP_SELF ?
	if ( empty( $_POST['php_self'] ) ) {
		$nfw_options['php_self'] = 0;
	} else {
		// Default: yes
		$nfw_options['php_self'] = 1;
	}
	// Sanitise PATH_TRANSLATED ?
	if ( empty( $_POST['php_path_t'] ) ) {
		$nfw_options['php_path_t'] = 0;
	} else {
		// Default: yes
		$nfw_options['php_path_t'] = 1;
	}
	// Sanitise PATH_INFO ?
	if ( empty( $_POST['php_path_i'] ) ) {
		$nfw_options['php_path_i'] = 0;
	} else {
		// Default: yes
		$nfw_options['php_path_i'] = 1;
	}
	// HTTP methods ?
	if ( empty( $_POST['request_method'] ) ) {
		// Default: no
		$nfw_options['request_method'] = 0;
	} else {
		$nfw_options['request_method'] = 1;
	}

	// Rules

	// Block the DOCUMENT_ROOT server variable in GET/POST requests (#ID 510) :
	if ( empty( $_POST['block_doc_root'] ) ) {
		$nfw_rules[NFW_DOC_ROOT]['ena'] = 0;
	} else {
		// Default: yes
		// We need to ensure that the document root is at least
		// 5 characters, otherwise this option could block a lot
		// of legitimate requests:
		if ( strlen( $_SERVER['DOCUMENT_ROOT'] ) > 5 ) {
			$nfw_rules[NFW_DOC_ROOT]['cha'][1]['wha'] = str_replace( '/', '/[./]*', $_SERVER['DOCUMENT_ROOT'] );
			$nfw_rules[NFW_DOC_ROOT]['ena']	= 1;
		} elseif ( strlen( getenv( 'DOCUMENT_ROOT' ) ) > 5 ) {
			$nfw_rules[NFW_DOC_ROOT]['cha'][1]['wha'] = str_replace( '/', '/[./]*', getenv( 'DOCUMENT_ROOT' ) );
			$nfw_rules[NFW_DOC_ROOT]['ena']	= 1;
		// we must disable that option:
		} else {
			$nfw_rules[NFW_DOC_ROOT]['ena']	= 0;
		}
	}

	// Block NULL byte 0x00 (#ID 2) :
	if ( empty( $_POST['block_null_byte'] ) ) {
		$nfw_rules[NFW_NULL_BYTE]['ena'] = 0;
	} else {
		// Default: yes
		$nfw_rules[NFW_NULL_BYTE]['ena'] = 1;
	}

	// Block ASCII control characters 1 to 8 and 14 to 31 (#ID 500) :
	if ( empty( $_POST['block_ctrl_chars'] ) ) {
		// Default: no
		$nfw_rules[NFW_ASCII_CTRL]['ena'] = 0;
	} else {
		$nfw_rules[NFW_ASCII_CTRL]['ena'] = 1;
	}

	// Block localhost IP in GET/POST requests (#ID 540) :
	if ( empty( $_POST['no_localhost_ip'] ) ) {
		// Default: no
		$nfw_rules[NFW_LOOPBACK]['ena'] = 0;
	} else {
		$nfw_rules[NFW_LOOPBACK]['ena'] = 1;
	}

	// Block PHP built-in wrappers (#ID 520) :
	if ( empty( $_POST['php_wrappers'] ) ) {
		$nfw_rules[NFW_WRAPPERS]['ena'] = 0;
	} else {
		// Default: yes
		$nfw_rules[NFW_WRAPPERS]['ena'] = 1;
	}

	// Block serialized PHP objects (#ID 525) :
	$nfw_objects = '';
	if (! empty( $_POST['nfw_rules']['php_objects_get'] ) ) {
		$nfw_objects .= "GET|";
	}
	if (! empty( $_POST['nfw_rules']['php_objects_post'] ) ) {
		$nfw_objects .= "POST|";
	}
	if (! empty( $_POST['nfw_rules']['php_objects_cookie'] ) ) {
		$nfw_objects .= "COOKIE|";
	}
	if (! empty( $_POST['nfw_rules']['php_objects_http_user_agent'] ) ) {
		$nfw_objects .= "SERVER:HTTP_USER_AGENT|";
	}
	if (! empty( $_POST['nfw_rules']['php_objects_http_referer'] ) ) {
		$nfw_objects .= "SERVER:HTTP_REFERER|";
	}
	if (! empty( $nfw_objects ) ) {
		$nfw_objects = rtrim( $nfw_objects, '|' );
		$nfw_rules[NFW_OBJECTS]['ena'] = 1;
	} else {
		// Disable rule:
		$nfw_rules[NFW_OBJECTS]['ena'] = 0;
	}
	$nfw_rules[NFW_OBJECTS]['cha'][1]['whe'] = $nfw_objects;

	// Save options:
	$res = save_config( $nfw_options, 'options' );
	if (! empty( $res ) ) {
		return $res;
	}
	// And rules:
	$res = save_config( $nfw_rules, 'rules' );
	if (! empty( $res ) ) {
		return $res;
	}

	return;
}

// ---------------------------------------------------------------------
// EOF
