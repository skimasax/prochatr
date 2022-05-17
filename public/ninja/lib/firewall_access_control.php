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

// Tab and div display:
if ( empty( $_REQUEST['tab'] ) ) { $_REQUEST['tab'] = 'general'; }

if ( $_REQUEST['tab'] == 'geolocation' ) {
	$geolocation_tab = ' class="active"'; $geolocation_div = '';

	$general_tab = ''; $general_div = ' style="display:none"';
	$ip_tab = ''; $ip_div = ' style="display:none"';
	$url_tab = ''; $url_div = ' style="display:none"';
	$bot_tab = ''; $bot_div = ' style="display:none"';

} elseif ( $_REQUEST['tab'] == 'ip' ) {
	$ip_tab = ' class="active"'; $ip_div = '';

	$general_tab = ''; $general_div = ' style="display:none"';
	$geolocation_tab = ''; $geolocation_div = ' style="display:none"';
	$url_tab = ''; $url_div = ' style="display:none"';
	$bot_tab = ''; $bot_div = ' style="display:none"';

} elseif ( $_REQUEST['tab'] == 'url' ) {
	$url_tab = ' class="active"'; $url_div = '';

	$general_tab = ''; $general_div = ' style="display:none"';
	$ip_tab = ''; $ip_div = ' style="display:none"';
	$geolocation_tab = ''; $geolocation_div = ' style="display:none"';
	$bot_tab = ''; $bot_div = ' style="display:none"';

} elseif ( $_REQUEST['tab'] == 'bot' ) {
	$bot_tab = ' class="active"'; $bot_div = '';

	$general_tab = ''; $general_div = ' style="display:none"';
	$geolocation_tab = ''; $geolocation_div = ' style="display:none"';
	$ip_tab = ''; $ip_div = ' style="display:none"';
	$url_tab = ''; $url_div = ' style="display:none"';

} else {
	$_REQUEST['tab'] = 'general';
	$general_tab = ' class="active"'; $general_div = '';

	$geolocation_tab = ''; $geolocation_div = ' style="display:none"';
	$ip_tab = ''; $ip_div = ' style="display:none"';
	$url_tab = ''; $url_div = ' style="display:none"';
	$bot_tab = ''; $bot_div = ' style="display:none"';
}

// Saved options ?
if (! empty( $_POST['post'] ) ) {

	if (! empty( $_POST['restore-changes'] ) ) {
		// Restore default values:
		$err_msg = restore_firewall_access_control();
	} else {
		// Save new configuration:
		$err_msg = save_firewall_access_control();
	}
}
// Display headers after the above two functions
// because they can set a cookie to whitelist the admin:
html_header();
?>
<div class="col-sm-12 text-left">
	<h3><?php echo _('Firewall > Access Control') ?></h3>
	<br />

	<div class="alert alert-warning text-left"><?php
		printf(
			_('This feature is only available in the <a href="%s">Pro+ Edition</a> of NinjaFirewall.'),
			'https://nintechnet.com/ninjafirewall/pro-edition/'
		);
	?></div>

	<ul class="nav nav-tabs">
		<li id="tab-general"<?php echo $general_tab ?> onClick="nfw_switch_tabs('general', 'general:geolocation:ip:url:bot')"><a class="dropdown-toggle"><?php echo _('General') ?></a></li>
		<li id="tab-geolocation"<?php echo $geolocation_tab ?>><a onClick="nfw_switch_tabs('geolocation', 'general:geolocation:ip:url:bot')"><?php echo _('Geolocation') ?></a></li>
		<li id="tab-ip"<?php echo $ip_tab ?>><a onClick="nfw_switch_tabs('ip', 'general:geolocation:ip:url:bot')"><?php echo _('IP Access Control') ?></a></li>
		<li id="tab-url"<?php echo $url_tab ?>><a onClick="nfw_switch_tabs('url', 'general:geolocation:ip:url:bot')"><?php echo _('URL Access Control') ?></a></li>
		<li id="tab-bot"<?php echo $bot_tab ?>><a onClick="nfw_switch_tabs('bot', 'general:geolocation:ip:url:bot')"><?php echo _('Bot Access Control') ?></a></li>
	</ul>
	<br />

	<!-- General Access Control -->

	<div id="general-options"<?php echo $general_div ?>>


	<h4><?php echo _('Administrator') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Whitelist the Administrator') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'danger', 'disabled', _('Yes'), _('No'), 'small', 0, true ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php printf( _('Current status for user %s'), '<code>' . $nfw_options['admin_name'] . '</code>') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right"><?php
					echo '<font color="red">'. _('You are not whitelisted.') .'</font>';
				?></td>
			</tr>
		</table>

	<a name="source-ip"></a>
	<br />

	<h4><?php echo _('Source IP') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Retrieve visitors IP address from') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<label><input type="radio" disabled checked />&nbsp;REMOTE_ADDR (<?php echo htmlspecialchars($_SERVER['REMOTE_ADDR']) ?>)</label>
					<br />
					<label><input type="radio" disabled />&nbsp;<?php echo _('Other') ?></label>&nbsp;<input class="form-control" type="text" style="display:inline;" placeholder="<?php echo _('e.g.') ?> HTTP_CLIENT_IP" disabled />
				</td>
			</tr>

			<tr>
				<td class="f-left"><?php echo _('Scan traffic coming from localhost and private IP address spaces') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 1, true ) ?>
				</td>
			</tr>
		</table>

	<br />

	<h4><?php echo _('HTTP Methods') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('All Access Control directives should apply to the following HTTP methods') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<table style="width:100%">
						<tr>
							<td style="width:120px">
								<label><input type="checkbox" checked disabled />&nbsp;GET</label>
								<br />
								<label><input type="checkbox" checked disabled />&nbsp;POST</label>
								<br />
								<label><input type="checkbox" checked disabled />&nbsp;HEAD</label>
							</td>
							<td>
								<label><input type="checkbox" checked disabled />&nbsp;PUT</label>
								<br />
								<label><input type="checkbox" checked disabled />&nbsp;DELETE</label>
								<br />
								<label><input type="checkbox" checked disabled />&nbsp;PATCH</label>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

	</div>

	<!-- GeoIP Access Control -->

	<div id="geolocation-options"<?php echo $geolocation_div ?>>

		<h4><?php echo _('Geolocation Access Control') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Enable Geolocation') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'green', 'disabled', _('Enabled'), _('Disabled'), 'large', 1, true ) ?>
				</td>
			</tr>
		</table>

		<div id="geotable" style="border:1px #ddd solid;">

			<table width="100%" class="table table-borderless">
				<tr>
					<td width="40%" align="left"><?php echo _('Retrieve ISO 3166 country code from') ?></td>
					<td width="5%" align="center"><?php
					if (! empty( $no_db) || ! empty( $no_var ) ) {
						echo glyphicon('error');
					}
					?></td>
					<td width="55%" style="vertical-align:top;">
						<label><input type="radio" checked disabled />&nbsp;NinjaFirewall <?php echo _('(default)') ?></label>
						<br />
						<label><input type="radio" disabled />&nbsp;<?php echo _('PHP variable') ?></label> <input type="text"  placeholder="<?php echo _('e.g.') ?> GEOIP_COUNTRY_CODE" class="form-control" style="display:inline" disabled />
					</td>
				</tr>

				<tr>
					<td class="f-left"><?php echo _('Block the following countries') ?></td>
					<td class="f-center">&nbsp;</td>
					<td class="f-right" id="td-countries">
						<?php
						$count = 0;
						$row = 0;
						$buffer = '';
						$csv_array = file( __DIR__ .'/share/iso3166.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
						foreach ($csv_array as $line) {
							if ( preg_match( '/^(\w\w),"(.+?)"$/', $line, $match ) ) {
								++$row;
								if ( $row % 2 == 0 ) {
									$r_color = 'f-white';
								} else {
									$r_color = 'f-grey';
								}
								$buffer .= '<tr class="'. $r_color .'"><td class="f-country"><label class="geo"><input type="checkbox" onClick="update_counter(this)" disabled name="disabled" /> '. htmlspecialchars( $match[1] ) .' - '. htmlspecialchars( $match[2] ) .'</label></td></tr>';
							}
						}
						?>
						<?php printf( _('Total blocked countries: %s'), '<label id="total-items">'. (int) $count .'</label>' ) ?>
						<div class="f-sub">
							<table style="width:100%">
								<?php echo $buffer; ?>
							</table>
						</div>
						<p class="aligncenter description2"><?php echo _('Check all') ?> - <?php echo _('Uncheck all') ?></p>
					</td>
				</tr>

				<tr>
					<td class="f-left">
						<?php echo _('Geolocation should apply to the whole site or to specific URLs only?') .' (SCRIPT_NAME)' ?>
						<br />
						<br />
						<font class="description2">
							<span><a href="javascript:" onClick="slide_up_down('view-geo-url');">[+] <?php echo _('View allowed syntax') ?></a></span>
							<div id="view-geo-url" style="display:none">
								<ul class="view">
									<li><?php printf( _('Full or partial case-sensitive URL (e.g., %s).'), '<code>/login.php</code>' ) ?></li>
									<li><?php echo _('One item per line.') ?></li>
								</ul>
							</div>
						</font>
					</td>
					<td class="f-center">&nbsp;</td>
					<td class="f-right">
						<textarea autocomplete="off" disabled autocorrect="off" autocapitalize="off" spellcheck="false" name="disabled" class="form-control" rows="10" style="resize:vertical;" placeholder="<?php echo _('Leave this field empty if you want geolocation to apply to all your PHP scripts.') ?>"></textarea>
					</td>
				</tr>

				<tr>
					<td class="f-left"><?php echo _('Add NINJA_COUNTRY_CODE to PHP headers') ?></td>
					<td class="f-center">&nbsp;</td>
					<td class="f-right">
						<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 0, true ) ?>
					</td>
				</tr>

				<tr>
					<td class="f-left"><?php echo _('Write event to the firewall log') ?></td>
					<td class="f-center">&nbsp;</td>
					<td class="f-right">
						<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 0, true ) ?>
					</td>
				</tr>
			</table>

		</div>
		<br />

	</div>

	<!-- IP Access Control -->

	<div id="ip-options"<?php echo $ip_div ?>>

		<h4><?php echo _('IP Access Control') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Allow the following IP, CIDR or AS number') ?>
					<br />
					<br />
					<span class="description2" id="allowed-ip-span"><a href="javascript:" onClick="slide_up_down('allowed-ip');">[+] <?php echo _('View allowed syntax') ?></a></span>
					<div id="allowed-ip" style="display:none">
						<ul>
							<li><?php printf( _('IPv4 address: %s') , '<span class="code">66.155.10.20</span>' ) ?></li>
							<li><?php printf( _('IPv4 CIDR: %s') , '<span class="code">66.155.0.0/17</span>' ) ?></li>
							<li><?php printf( _('IPv6 address: %s') , '<span class="code">2001:db8:85a3::8a2e</span>' ) ?></li>
							<li><?php printf( _('IPv6 CIDR: %s') , '<span class="code">2c0f:f248::/32</span>' ) ?></li>
							<li><?php printf( _('Autonomous System number: %s') , '<span class="code">AS15169</span>' ) ?></li>
						</ul>
					</div>
				</td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php echo _('Whitelist:') ?>
					<textarea autocomplete="off" disabled autocorrect="off" autocapitalize="off" spellcheck="false" class="form-control" rows="12" style="resize: vertical;" placeholder="<?php echo _('Enter one item per line.') ?>"></textarea>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Write event to the firewall log') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 0, true ) ?>
				</td>
			</tr>
		</table>

		<br />

		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left">
					<?php echo _('Block the following IP, CIDR or AS number') ?>
					<br />
					<br />
					<span class="description2" id="blocked-ip-span"><a href="javascript:" onClick="slide_up_down('blocked-ip');">[+] <?php echo _('View allowed syntax') ?></a></span>
					<div id="blocked-ip" style="display:none">
						<ul>
							<li><?php printf( _('IPv4 address: %s') , '<span class="code">66.155.10.20</span>' ) ?></li>
							<li><?php printf( _('IPv4 CIDR: %s') , '<span class="code">66.155.0.0/17</span>' ) ?></li>
							<li><?php printf( _('IPv6 address: %s') , '<span class="code">2001:db8:85a3::8a2e</span>' ) ?></li>
							<li><?php printf( _('IPv6 CIDR: %s') , '<span class="code">2c0f:f248::/32</span>' ) ?></li>
							<li><?php printf( _('Autonomous System number: %s') , '<span class="code">AS15169</span>' ) ?></li>
						</ul>
					</div>
				</td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php echo _('Blacklist:') ?>
					<textarea autocomplete="off" autocorrect="off" disabled autocapitalize="off" spellcheck="false" class="form-control" rows="12" style="resize: vertical;" placeholder="<?php echo _('Enter one item per line.') ?>"></textarea>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Write event to the firewall log') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 1, true ) ?>
				</td>
			</tr>
		</table>

		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left"><?php echo _('Rate limiting') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Enabled'), _('Disabled'), 'large', 1, true ) ?>
					<div id="rate-limit">
						<br />
						<p style="line-height:45px;">
						<?php
						$string = 'Block for %s seconds any IP with more than %s connections within a %s interval.';
						$a = '<input type="number" min="1" class="form-control" style="width:90px;display:inline" disabled value="30" size="2" maxlength="4" max="9999" />';
						$b = '<input type="number" min="1" class="form-control" style="width:90px;display:inline" disabled value="10" size="2" maxlength="4" max="9999" />';
						$c = '<select class="form-control" style="width:150px;display:inline" disabled>
						<option value="5" selected>'. _('5-second') .'</option><option value="10">'. _('10-second') .'</option><option value="15">'. _('15-second') .'</option><option value="30">'. _('30-second') .'</option></select>';
						printf( $string, $a, $b, $c );
						?>
						</p>
						<i class="description"><?php echo _('The maximum value for seconds and connections is 9999.') ?></i>
					</div>
				</td>
			</tr>
			<tr id="rate-limit-log">
				<td class="f-left"><?php echo _('Write event to the firewall log') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 0, true ) ?>
				</td>
			</tr>
		</table>

	</div>

	<!-- URL Access Control -->

	<div id="url-options"<?php echo $url_div ?>>

		<h4><?php echo _('URL Access Control') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left">
					<?php echo _('Allow access to the following URL' ) ?> (<code>SCRIPT_NAME</code>)
					<br />
					<br />
					<font class="description2">
						<span><a href="javascript:" onClick="slide_up_down('view-allow-url');">[+] <?php echo _('View allowed syntax') ?></a></span>
						<div id="view-allow-url" style="display:none">
							<ul class="view">
								<li><?php printf( _('Full or partial case-sensitive URLs (e.g., %s).'), '<code>/script.php</code>' ) ?></li>
								<li><?php echo _('One item per line.') ?></li>
							</ul>
						</div>
					</font>
				</td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php echo _('Whitelist:') ?>
					<textarea autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" disabled class="form-control" rows="12" style="resize:vertical;" placeholder="<?php echo _('Enter one item per line.') ?>"></textarea>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Write event to the firewall log') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 0, true ) ?>
				</td>
			</tr>
		</table>

		<br />
		<br />

		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left">
					<?php echo _('Block access to the following URL') ?> (<code>SCRIPT_NAME</code>)
					<br />
					<br />
					<font class="description2">
						<span><a href="javascript:" onClick="slide_up_down('view-block-url');">[+] <?php echo _('View allowed syntax') ?></a></span>
						<div id="view-block-url" style="display:none">
							<ul class="view">
								<li><?php printf( _('Full or partial case-sensitive URLs (e.g., %s).'), '<code>/script.php</code>' ) ?></li>
								<li><?php echo _('One item per line.') ?></li>
							</ul>
						</div>
					</font>
				</td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php echo _('Blacklist:') ?>
					<textarea autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" disabled class="form-control" rows="12" style="resize:vertical;" placeholder="<?php echo _('Enter one item per line.') ?>"></textarea>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Write event to the firewall log') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 0, true ) ?>
				</td>
			</tr>
		</table>

	</div>

	<!-- Bot Access Control -->

	<div id="bot-options"<?php echo $bot_div ?>>

		<?php
		$bot_list = str_replace( '|', "\n", NFW_BOT_LIST );
		?>
		<h4><?php echo _('Bot Access Control') ?></h4>
		<table width="100%" class="table table-nf">
			<tr>
				<td class="f-left">
					<?php echo _('Reject the following bots (HTTP_USER_AGENT)') ?>
					<br />
					<br />
					<span class="description2" id="blocked-bot-span"><a href="javascript:" onClick="slide_up_down('blocked-bot');">[+] <?php echo _('View allowed syntax') ?></a></span>
					<div id="blocked-bot" style="display:none">
						<ul>
							<li><?php echo _('A full or partial case-insensitive string.') ?></li>
							<li><?php echo _('Allowed characters are: <code>a-zA-Z</code> <code>0-9</code> <code>.</code> <code>-</code> <code>_</code> <code>:</code> <code>/</code> and <code>space</code>.' ) ?></li>
						</ul>
					</div>
				</td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php echo _('Blocked bots:') ?>
					<textarea id="bot-blocked" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" disabled class="form-control" rows="12" style="resize: vertical;" placeholder="<?php echo _('Enter one item per line.') ?>"><?php echo htmlspecialchars( $bot_list ); ?></textarea>
					<p class="aligncenter description2"><a id="check-code" href="javascript:"><?php echo _('Clear list') ?></a>  -  <a id="check-code" href="javascript:"><?php echo _('Restore default bots list') ?></a></p>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Write event to the firewall log') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 1, true ) ?>
				</td>
			</tr>
		</table>

	</div>

	<br />

	<center>
		<input type="submit" name="disabled" class="btn btn-md btn-success btn-25" value="<?php echo _('Save Changes') ?>" disabled />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="disabled" class="btn btn-md btn-default btn-25" value="<?php echo _('Restore Default Values') ?>" disabled />
	</center>

</div>

<?php

html_footer();

// ---------------------------------------------------------------------
// EOF
