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

// ---------------------------------------------------------------------
// Animated button/switch.

function toggle_switch( $type, $name, $text_on, $text_off, $size, $value = 0,
								$disabled = false, $attr = false, $id = false ) {

	if ( $size == 'large' ) {
		$size = 'style="width:150px;"';

	} elseif ( $size == 'small' ) {
		$size = 'style="width:80px"';

	} else {
		$size = 'style="width:'. (int) $size .'px"';
	}

	if ( $type == 'danger' ) {
		$type = 'tgl-danger';
	} elseif ( $type == 'warning' ) {
		$type = 'tgl-warning';
	} elseif ( $type == 'green' ) {
		$type = 'tgl-green';
	} else {
		$type = 'tgl-info';
	}

	$text_on = htmlspecialchars( $text_on );
	$text_off = htmlspecialchars( $text_off );

	if ( $id == false ) {
		$id = uniqid();
	}

	if ( $disabled == false ) {
		$disabled = '';
	} else {
		$disabled = ' disabled';
	}
	if ( $attr != false ) {
		$attr = ' '. $attr;
	}

	?>
	<div class="tg-list-item">
		<input class="tgl tgl-switch" name="<?php echo $name ?>"<?php checked( $value, 1 ) ?> id="<?php echo $id ?>" type="checkbox"<?php echo $disabled; ?><?php echo $attr ?> />
		<label class="tgl-btn <?php echo $type ?>" data-tg-on="<?php echo $text_on ?>" data-tg-off="<?php echo $text_off ?>" for="<?php echo $id ?>" <?php echo $size ?>></label>
	</div>
	<?php
}

// ---------------------------------------------------------------------
// EOF
