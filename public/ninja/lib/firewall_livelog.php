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
	<h3><?php echo _('Logs > Live Log') ?></h3>
	<br />
	<div class="alert alert-warning text-left"><?php
		printf(
			_('This feature is only available in the <a href="%s">Pro+ Edition</a> of NinjaFirewall.'),
			'https://nintechnet.com/ninjafirewall/pro-edition/'
		);
	?></div>

		<table width="100%" class="table table-nf">
			<tr>
				<td style="width:100%;">
					<i>&nbsp;</i>
					<br />
					<textarea disabled class="form-control" style="background-color:#ffffff;width:95%;height:450px;font-family:monospace;font-size:14px;" wrap="off" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?php echo _('No traffic yet, please wait...'); echo "\n"; ?></textarea>
					<br />
					<div style="float:left;width:35%;padding-top:10px;" class="nfw-right">
						<?php toggle_switch( 'danger', 'disabled', _('Enabled'), _('Disabled'), 'large', 0, true, '', '', 'right' ) ?>
					</div>
					<div style="float:right;width:65%;text-align:left;padding-top:10px;" class="nfw-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo _('Refresh rate:') ?>
						<select disabled class="form-control" style="width:150px;display:inline;height:35px;">
							<option><?php echo _('5 seconds') ?></option>
							<option><?php echo _('10 seconds') ?></option>
							<option><?php echo _('20 seconds') ?></option>
							<option><?php echo _('45 seconds') ?></option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" class="btn btn-md btn-default btn-25" style="height:30px;" value="<?php echo _('Clear screen') ?>" disabled />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label><input type="checkbox" value="1" disabled checked /> <?php echo _('Autoscrolling') ?></label>
					</div>
				</td>
			</tr>
		</table>
	<div align="right"><i class="description"><?php echo _('Live Log will not show connections from the administrator.') ?></i></div>

	<br />

	<h4><?php echo _('Options') ?></h4>
	<table width="100%" class="table table-nf">
		<tr>
			<td class="f-left"><?php echo _('Log format') ?></td>
			<td class="f-center">&nbsp;</td>
				<td class="f-right">
				<p>
					<label><input type="radio" disabled checked />&nbsp;<?php echo _('Default') ?>&nbsp;</label><input type="text" class="form-control" value="<?php echo '[%time] %name %client &quot;%method %uri&quot; &quot;%referrer&quot; &quot;%ua&quot; &quot;%forward&quot; &quot;%host&quot;' ?>" readonly disabled autocomplete="off">
				</p>
				<p>
					<label><input type="radio" disabled >&nbsp;<?php echo _('Custom') ?>&nbsp;</label><input type="text" class="form-control" disabled autocomplete="off" />
				</p>
				<i class="description"><?php echo _('See contextual help for available log format.') ?></i>
			</td>
		</tr>
		<tr>
			<td class="f-left"><?php echo _('Display') ?></td>
			<td class="f-center">&nbsp;</td>
				<td class="f-right">
				<select disabled class="form-control">
					<option value="0"><?php echo _('HTTP and HTTPS traffic (default)') ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="f-left"><?php echo _('Inclusion and exclusion filters (REQUEST_URI)') ?></td>
			<td class="f-center">&nbsp;</td>
				<td class="f-right">
				<select class="form-control">
					<option><?php echo _('None') ?></option>
					<option><?php echo _('Must include') ?></option>
					<option><?php echo _('Must not include') ?></option>
				</select>&nbsp;<input disabled type="text" class="form-control" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="<?php echo _('e.g.,') ?> /blog <?php echo _('or') ?> admin.php <?php echo _('or') ?> index.php,/blog" />
				<br />
				<i class="description"><?php echo _('Full or partial case-sensitive REQUEST_URI string. Multiple values must be comma-separated.') ?></i>
			</td>
		</tr>
	</table>
	<center><p><input type="submit" disabled class="btn btn-md btn-success btn-25" value="<?php echo _('Save Options') ?>" /></p></center>
</div>
<?php

html_footer();

// ---------------------------------------------------------------------
// EOF
