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

html_header();

?>
<div class="col-sm-12 text-left">
	<h3><?php echo _('Firewall > Options') ?></h3>
	<br />
<?php

// Saved options ?
if (! empty( $_POST['post'] ) ) {
	$err_msg = save_firewall_options();

	if ( $err_msg ) {
		echo '<div class="alert alert-danger text-left"><a class="close" '.
		'data-dismiss="alert" aria-label="close">&times;</a>'. $err_msg .'</div>';
   } else {
		echo '<div class="alert alert-success text-left"><a class="close" data-dismiss="alert"'.
		' aria-label="close">&times;</a>'. _('Your changes were saved.') . '</div>';
	}
}
?>
<form method="post" name="option_form">
	<h4><?php echo _('General') ?></h4>
	<table width="100%" class="table table-nf">
		<tr>
		<?php
		if ( empty( $nfw_options['enabled'] ) ) {
			$nfw_options['enabled'] = 0;
		} else {
			$nfw_options['enabled'] = 1;
		}
		?>
			<td class="f-left"><?php echo _('Firewall protection') ?></td>
			<td class="f-center">&nbsp;</td>
			<td class="f-right">
				<?php toggle_switch( 'danger', 'nfw_options[enabled]', _('Enabled'), _('Disabled'), 'large', $nfw_options['enabled'] ) ?>
			</td>
		</tr>

		<tr>
		<?php
		if ( empty( $nfw_options['debug'] ) ) {
			$nfw_options['debug'] = 0;
		} else {
			$nfw_options['debug'] = 1;
		}
		?>
			<td class="f-left"><?php echo _('Debug mode') ?></td>
			<td class="f-center">&nbsp;</td>
			<td class="f-right">
				<?php toggle_switch( 'warning', 'nfw_options[debug]', _('Yes'), _('No'), 'small', $nfw_options['debug'] ) ?>
			</td>
		</tr>

		<?php
		// Get (if any) the HTTP error code to return :
		if (! @preg_match( '/^(?:4(?:0[0346]|18)|50[03])$/', $nfw_options['ret_code'] ) ) {
			$nfw_options['ret_code'] = '403';
		}
		?>
		<tr>
			<td class="f-left"><?php echo _('HTTP error code to return') ?></td>
			<td class="f-center">&nbsp;</td>
			<td class="f-right">
				<select name="nfw_options[ret_code]" class="form-control">
					<option value="400"<?php selected($nfw_options['ret_code'],400) ?>><?php echo _('400 Bad Request') ?></option>
					<option value="403"<?php selected($nfw_options['ret_code'],403) ?>><?php echo _('403 Forbidden (default)') ?></option>
					<option value="404"<?php selected($nfw_options['ret_code'],404) ?>><?php echo _('404 Not Found') ?></option>
					<option value="406"<?php selected($nfw_options['ret_code'],406) ?>><?php echo _('406 Not Acceptable') ?></option>
					<option value="418"<?php selected($nfw_options['ret_code'],418) ?>><?php echo _("418 I'm a teapot") ?></option>
					<option value="500"<?php selected($nfw_options['ret_code'],500) ?>><?php echo _('500 Internal Server Error') ?></option>
					<option value="503"<?php selected($nfw_options['ret_code'],503) ?>><?php echo _('503 Service Unavailable') ?></option>
				</select>
			</td>
		</tr>

		<?php
		if ( empty( $nfw_options['anon_ip'] ) ) {
			$nfw_options['anon_ip'] = 0;
			} else {
				$nfw_options['anon_ip'] = 1;
			}
		?>
		<tr>
			<td class="f-left"><?php echo _('Anonymize IP addresses') ?></td>
			<td class="f-center">
				<?php echo glyphicon( 'help', _('Anonymize IP addresses by removing the last 3 characters. This option does not apply to private IP addresses.') ) ?>
			</td>
			<td class="f-right">
				<?php toggle_switch( 'info', 'nfw_options[anon_ip]', _('Yes'), _('No'), 'small', $nfw_options['anon_ip'] ) ?>
			</td>
		</tr>

		<tr>
			<td class="f-left"><?php echo _('Blocked user message') ?></td>
			<td class="f-center">&nbsp;</td>
			<td class="f-right">
				<textarea name="nfw_options[blocked_msg]" id="blocked-msg" rows="8" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="form-control" style="resize: vertical;"><?php
				if (! empty( $nfw_options['blocked_msg'] ) ) {
					echo htmlentities( base64_decode( $nfw_options['blocked_msg'] ) );
				} else {
					echo NFW_DEFAULT_MSG;
				}
				?></textarea>
				<input type="hidden" id="default-msg" name="def_msg" value="<?php echo NFW_DEFAULT_MSG ?>" />
				<br />
				<input class="btn btn-default btn-sm btn-25" type="button" id="btn_msg" value="<?php echo _('Preview message') ?>" onclick="preview_msg('<?php echo NFW_REMOTE_ADDR ?>');" />&nbsp;&nbsp;<input class="btn btn-default btn-sm btn-25" type="button" id="btn_msg" value="<?php echo _('Default message') ?>" onclick="javascript:default_msg();" />
			</td>
		</tr>
	</table>
	<div id="td_msg" style="display:none">
		<div id="out_msg" style="border:1px solid #ccc;background-color:#ffffff;border-radius: 4px" width="100%"></div>
	</div>

	<br />
	<h4><?php echo _('Banned IP addresses') ?></h4>
	<table width="100%" class="table table-nf">
	<?php
	if ( empty( $nfw_options['ban_ip'] ) || ! preg_match( '/^[123]$/', $nfw_options['ban_ip'] ) ) {
		$nfw_options['ban_ip'] = 0;
	}
	if ( empty( $nfw_options['ban_time'] ) || ! preg_match( '/^\d{1,4}$/', $nfw_options['ban_time'] ) ) {
		$nfw_options['ban_time'] = 1;
	}
	$ban_disabled = '';
	?>
		<tr>
			<td class="f-left"><?php echo _('Ban offending IP addresses') ?></td>
			<td class="f-center">&nbsp;</td>
			<td class="f-right">
				<select name="nfw_options[ban_ip]" class="form-control" onChange="baninput(this.value);">
					<option value="0"<?php if (! $nfw_options['ban_ip'] ) {echo ' selected'; $ban_disabled = ' disabled';} ?>><?php echo _('Never ban IPs') .' '. _('(default)') ?></option>
					<option value="1"<?php selected($nfw_options['ban_ip'],1) ?>><?php echo _('Only if critical severity') ?></option>
					<option value="2"<?php selected($nfw_options['ban_ip'],2) ?>><?php echo _('If critical or high severity') ?></option>
					<option value="3"<?php selected($nfw_options['ban_ip'],3) ?>><?php echo _('Always ban offending IPs') ?></option>
				</select>

				<br />

				<?php	echo _('Banning period (from 1 to 9999 minutes)'); ?>
				<br />
				<input onkeyup="this.value=this.value.replace(/[^0-9]/,'')" type="text" class="form-control" style="padding-left:3px" name="nfw_options[ban_time]" id="ban-time" maxlength="4" size="2" value="<?php echo (int)$nfw_options['ban_time'] ?>"<?php echo $ban_disabled ?>>
				<?php

				// Check if we have some banned IPs :
				$glob = glob( dirname( __DIR__ ) .'/nfwlog/cache/ipbk*.php' );
				$banned_ips = array();
				if ( is_array( $glob ) ) {
					foreach ( $glob as $file ) {
						// Check if the banning period has expired :
						$stat = stat( $file );
						if ( time() - $stat['mtime'] > $nfw_options['ban_time'] * 60 ) {
							// Delete it :
							unlink( $file );
							continue;
						}
						// Save it:
						if ( preg_match( '`_-_(.+)\.php$`', $file, $match ) ) {
							$banned_ips[ $match[1] ] = 1;

						}
					}
				}
				ksort( $banned_ips );
				?>
				<br />
				<?php echo _('Currently banned IP addresses:') ?> <?php echo count($banned_ips) ?>&nbsp;<?php
				// translators: do not use double-quotes ["], use single quotes only [']
				echo glyphicon( 'help', sprintf( _('To unban IP addresses, select them in the list and click \'%s\'.'), _('Save Changes') ) );
				?>
				<br />
				<select multiple class="form-control" size="8" name="banned_list[]"<?php disabled( count( $banned_ips ), 0 ) ?>>
				<?php
				foreach ( $banned_ips as $ip => $x ) {
					echo '<option value="'. htmlentities( $ip ) .'">'. htmlentities( $ip ) .'</option>';
				}
				?>
				</select>
			</td>
		</tr>
	</table>

	<br />

	<input type="hidden" name="mid" value="<?php echo $GLOBALS['mid'] ?>">
	<input type="hidden" name="post" value="1">
	<center><input type="submit" name="Save" class="btn btn-md btn-success btn-25" value="<?php echo _('Save Changes') ?>"></center>
</form>
</div>
<?php

html_footer();

// ---------------------------------------------------------------------

function save_firewall_options() {

	global $nfw_options;

	// Clear selected IPs from the ban list :
	if (! empty( $_POST['banned_list'] ) ) {
		foreach ( $_POST['banned_list'] as $ip ) {
			$ip = trim( $ip );
			if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
				$glob = glob( dirname( __DIR__ ) ."/nfwlog/cache/ipbk*_-_{$ip}.php");
				if ( is_array( $glob ) ) {
					foreach ( $glob as $file ) {
						unlink( $file );
					}
				}
			}
		}
	}

	if ( empty( $_POST['nfw_options']['enabled'] ) ) {
		$nfw_options['enabled'] = 0;
	} else {
		$nfw_options['enabled'] = 1;
	}

	if ( empty( $_POST['nfw_options']['debug'] ) ) {
		$nfw_options['debug'] = 0;
	} else {
		$nfw_options['debug'] = 1;
	}

	if ( (isset( $_POST['nfw_options']['ret_code'] ) ) &&
		( preg_match( '/^(?:4(?:0[0346]|18)|50[03])$/', $_POST['nfw_options']['ret_code'] ) ) ) {
		$nfw_options['ret_code'] = (int) $_POST['nfw_options']['ret_code'];
	} else {
		$nfw_options['ret_code'] = '403';
	}

	if ( isset( $_POST['nfw_options']['anon_ip'] ) ) {
		$nfw_options['anon_ip'] = 1;
	} else {
		$nfw_options['anon_ip'] = 0;
	}

	if ( empty( $_POST['nfw_options']['blocked_msg'] ) ) {
		$nfw_options['blocked_msg'] = NFW_DEFAULT_MSG;
	} else {
		$nfw_options['blocked_msg'] = base64_encode( $_POST['nfw_options']['blocked_msg'] );
	}

	if ( empty( $_POST['nfw_options']['ban_ip'] ) || ! preg_match( '/^[1-3]$/', $_POST['nfw_options']['ban_ip'] ) ) {
		$nfw_options['ban_ip'] = 0;
		$nfw_options['ban_time'] = 0;
	} else {
		$nfw_options['ban_ip'] = (int) $_POST['nfw_options']['ban_ip'];
		if ( empty( $_POST['nfw_options']['ban_time'] ) || ! preg_match( '/^\d{1,4}$/', $_POST['nfw_options']['ban_time'] ) ) {
			$nfw_options['ban_time'] = 10;
		} else {
			$nfw_options['ban_time'] = (int) $_POST['nfw_options']['ban_time'];
		}
	}

	// Save options:
	$res = save_config( $nfw_options, 'options' );
	if (! empty( $res ) ) {
		return $res;
	}

	return;
}

// ---------------------------------------------------------------------
// EOF
