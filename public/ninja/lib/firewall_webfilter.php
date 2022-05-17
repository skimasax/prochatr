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
	<h3><?php echo _('Monitoring > Web Filter') ?></h3>
	<br />
	<div class="alert alert-warning text-left"><?php
		printf(
			_('This feature is only available in the <a href="%s">Pro+ Edition</a> of NinjaFirewall.'),
			'https://nintechnet.com/ninjafirewall/pro-edition/'
		);
	?></div>

	<table width="100%" class="table table-nf">
		<tr>
			<td width="45%" align="left"><?php echo _('Enable Web Filter') ?></td>
			<td width="55%">
				<?php toggle_switch( 'green', 'disabled', _('Enabled'), _('Disabled'), 'large', 1, true ) ?>
			</td>
		</tr>
	</table>

	<div id="wf_table" style="border:1px #ddd solid;">
		<table width="100%" class="table table-borderless">
			<tr>
				<td class="f-left">
					<?php echo _('Search HTML page for the following keywords') ?>
					<br />
						<br />
						<font class="description2">
							<span><a href="javascript:" onClick="slide_up_down('view-wf');">[+] <?php echo _('View allowed syntax') ?></a></span>
							<div id="view-wf" style="display:none">
								<ul class="view">
									<li><?php echo _('A full or partial string.') ?></li>
									<li><?php echo _('From 4 to maximum 150 characters.') ?></li>
									<li><?php echo _('Any character, except the vertical bar <code>|</code>') ?></li>
								</ul>
							</div>
						</font>
				</td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php echo _('Keywords to search:') ?>
					<textarea disabled class="form-control" rows="10" style="resize:vertical;" placeholder="<?php echo _('Enter one item per line.') ?>"></textarea>
				</td>
			</tr>
			<tr>
				<td class="f-left">
					<?php echo _('Case-sensitive search') ?>
				</td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 1, true ) ?>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Email alert') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php
					$select = '<select class="form-control" style="width:150px;display:inline">
					<option value="5">'. _('5-minute') .'</option>
					<option value="15">'. _('15-minute') .'</option>
					<option value="30" selected>'. _('30-minute') .'</option>
					<option value="60">'. _('1-hour') .'</option>
					<option value="180">'. _('3-hour') .'</option>
					<option value="360">'. _('6-hour') .'</option>
					<option value="720">'. _('12-hour') .'</option>
					<option value="1440">'. _('24-hour') .'</option>
					</select>';
					printf( _('Do not send me more than one email alert in a %s interval.'), $select );
					?>
					<br />
					<i class="description"><?php echo _('Clicking the "Save Changes" button below will reset the current timer.') ?></i>
				</td>
			</tr>
			<tr>
				<td class="f-left"><?php echo _('Attach the HTML page output to the email alert') ?></td>
				<td class="f-center">&nbsp;</td>
				<td class="f-right">
					<?php toggle_switch( 'info', 'disabled', _('Yes'), _('No'), 'small', 1, true ) ?>
				</td>
			</tr>
		</table>
	</div>

	<br />

	<center><input type="submit" disabled class="btn btn-md btn-success btn-25" value="<?php echo _('Save Changes') ?>"></center>

</div>
<?php

html_footer();

// ---------------------------------------------------------------------
// EOF
