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

// ---------------------------------------------------------------------
// Generic

function nfw_switch_tabs( what, list ) {
	// Active tab:
	jQuery('#'+ what +'-options').show();
	jQuery('#tab-'+ what).addClass("active");
	jQuery('#tab-selected').val( what );
	// Inactive tabs:
	var tabs = list.split( ':' );
	var list_length = tabs.length;
	for ( var i = 0; i < list_length; i++ ) {
		if ( tabs[i] != what ) {
			jQuery('#'+ tabs[i] +'-options').hide();
			jQuery('#tab-'+ tabs[i]).removeClass("active");
		}
	}
}

// ---------------------------------------------------------------------
// Summary > Overview

function dellog() {
	if ( confirm( nfi18n.delete_admin_log ) ) {
		return true;
	} else {
		return false;
	}
}

// ---------------------------------------------------------------------
// Summary > Statistics

function stat_redir( where, token ) {
	if ( where == '' ) { return false; }
	document.location.href='?mid=11&token='+ token + '&xtr=' + where;
}

// ---------------------------------------------------------------------
// Account > Options

function preview_fonts( what, newvalue ) {

	if ( what == 'family' ) {
		if ( newvalue == '' ) {
			newvalue = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
		}
		jQuery('body').css('font-family', newvalue );
	}
	if ( what == 'size' ) {
		if ( newvalue > 8 ) {
			jQuery('body').css('font-size', newvalue +'px' );
		}
	}
}

function ssl_warn( is_ssl ) {

	// Obviously, if we are already in HTTPS mode, we don't send any warning
	if ( is_ssl == true ) {
		return true;

	} else {
		if (document.nf_options.admin_ssl.checked == false) { return true;}
		if (confirm( nfi18n.https_warning ) ) {
			return true;
		}
		return false;
	}
}

// ---------------------------------------------------------------------
// Account > License

function chkfld(){
	if (! document.lic_renew.new_lic.value ) {
		alert( nfi18n.enter_new_license );
		document.lic_renew.new_lic.focus();
		return false;
	}
}

// ---------------------------------------------------------------------
// Firewall > Options

function preview_msg( rem_addr ) {
	var t1 = jQuery('#blocked-msg').val().replace('%%REM_ADDRESS%%', rem_addr);
	var t2 = t1.replace('%%NUM_INCIDENT%%','1234567');
	if ( t2.match(/<script/i) ) {
		alert( nfi18n.js_preview );
		return false;
	}
	jQuery('#out_msg').html( t2 + '<br /><br /><br />' );
	jQuery('#td_msg').slideDown();
	jQuery('#btn_msg').val( nfi18n.refresh_preview );
}

function default_msg() {
	var msg = jQuery('#default-msg').val();
	jQuery('#blocked-msg').val( msg );

}

function baninput( what ) {
	if (what == 0) {
		jQuery('#ban-time').prop('disabled', true);
	} else {
		jQuery('#ban-time').prop('disabled', false);
		jQuery('#ban-time').select();
	}
}

// ---------------------------------------------------------------------
// Firewall Policies

function san_onoff( what ) {
	if (what == 0) {
		$('#sanid').prop('disabled', true);
		$('#sizeid').prop('disabled', true);
		$('#subs').prop('disabled', true);
	} else {
		$('#sanid').prop('disabled', false);
		$('#sizeid').prop('disabled', false);
		$('#subs').prop('disabled', false);
	}
}

function sanitise_warn( cbox ) {
	if ( cbox.checked ) {
		if ( confirm( nfi18n.sanitize_fname ) ) {
			return true;
		}
		return false;
	}
}

function csp_onoff() {
	if ( $('#csp_switch').prop('checked') == true ) {
		$('#csp').prop('readonly', false);
		$('#csp').focus();
	} else {
		$('#csp').prop('readonly', true);
	}
}

function referrer_onoff() {
	if ( $('#referrer_switch').prop('checked') == true ) {
		$('#rp_select').prop('disabled', false);
		$('#rp_select').focus();
	} else {
		$('#rp_select').prop('disabled', true);
	}
}

function restore_default( msg ) {
	if ( confirm( msg ) ) {
		return true;
	}
	return false;
}

// ---------------------------------------------------------------------
// Access Control

function slide_up_down( id ) {
	if ( $('#'+ id).css('display') == 'none' ) {
		$('#'+ id).slideDown();

	} else {
		$('#'+ id).slideUp();
	}
}

// ---------------------------------------------------------------------
// File Check.

function file_info(what, where) {
	if ( what == '' ) { return false; }

	// Because we use a "multiple" select for aesthetic purposes
	// but don't want the user to select multiple files, we focus
	// only on the currently selected one:
	var current_item = jQuery('#select-'+ where ).prop('selectedIndex');
	jQuery('#select-'+ where ).prop('selectedIndex',current_item);

	// New file
	if (where == 1) {
		var nfo = what.split(':');
		jQuery('#new_size').html( nfo[3] );
		jQuery('#new_chmod').html( nfo[0] );
		jQuery('#new_uidgid').html( nfo[1] + ' / ' + nfo[2] );
		jQuery('#new_mtime').html( nfo[4].replace(/~/g, ':') );
		jQuery('#new_ctime').html( nfo[5].replace(/~/g, ':') );
		jQuery('#table_new').show();

	// Modified file
	} else if (where == 2) {
		var all = what.split('::');
		var nfo = all[0].split(':');
		var nfo2 = all[1].split(':');
		jQuery('#mod_size').html( nfo[3] );
		if (nfo[3] != nfo2[3]) {
			jQuery('#mod_size2').html( '<font color="red">'+ nfo2[3] +'</font>' );
		} else {
			jQuery('#mod_size2').html( nfo2[3] );
		}
		jQuery('#mod_chmod').html( nfo[0] );
		if (nfo[0] != nfo2[0]) {
			jQuery('#mod_chmod2').html( '<font color="red">'+ nfo2[0] +'</font>' );
		} else {
			jQuery('#mod_chmod2').html( nfo2[0] );
		}
		jQuery('#mod_uidgid').html( nfo[1] + ' / ' + nfo[2] );
		if ( (nfo[1] != nfo2[1]) || (nfo[2] != nfo2[2]) ) {
			jQuery('#mod_uidgid2').html( '<font color="red">'+ nfo2[1] + '/' + nfo2[2] +'</font>' );
		} else {
			jQuery('#mod_uidgid2').html( nfo2[1] + ' / ' + nfo2[2] );
		}
		jQuery('#mod_mtime').html( nfo[4].replace(/~/g, ':') );
		if (nfo[4] != nfo2[4]) {
			jQuery('#mod_mtime2').html( '<font color="red">'+ nfo2[4].replace(/~/g, ':') +'</font>' );
		} else {
			jQuery('#mod_mtime2').html( nfo2[4].replace(/~/g, ':') );
		}
		jQuery('#mod_ctime').html( nfo[5].replace(/~/g, ':') );
		if (nfo[5] != nfo2[5]) {
			jQuery('#mod_ctime2').html( '<font color="red">'+ nfo2[5].replace(/~/g, ':') +'</font>' );
		} else {
			jQuery('#mod_ctime2').html( nfo2[5].replace(/~/g, ':') );
		}
		jQuery('#table_mod').show();
	}
}

function del_snapshot() {
	if ( confirm( nfi18n.del_snapshot ) ) {
		return true;
	}
	return false;
}

function show_changes() {
	jQuery('#changes_table').slideDown();
	jQuery('#vcbtn').prop('disabled', true);
}

// ---------------------------------------------------------------------
// Firewall Log

function filter_log() {
	// Clear the log
	document.frmlog.txtlog.value = '       DATE         INCIDENT  LEVEL'+
											'     RULE     IP            REQUEST\n';
	// Prepare the regex
	var nf_tmp = '';
	if ( document.frmlog.nf_crit.checked == true ) { nf_tmp += 'CRITICAL|'; }
	if ( document.frmlog.nf_high.checked == true ) { nf_tmp += 'HIGH|'; }
	if ( document.frmlog.nf_med.checked == true )  { nf_tmp += 'MEDIUM|'; }
	if ( document.frmlog.nf_upl.checked == true )  { nf_tmp += 'UPLOAD|'; }
	if ( document.frmlog.nf_nfo.checked == true )  { nf_tmp += 'INFO|'; }
	if ( document.frmlog.nf_dbg.checked == true )  { nf_tmp += 'DEBUG_ON|'; }
	// Return if empty
	if ( nf_tmp == '' ) {
		document.frmlog.txtlog.value = '\n > '+ nfi18n.no_record;
		return true;
	}
	// Put it all together
	var nf_reg = new RegExp('^\\S+\\s+\\S+\\s+\\S+\\s+' + '(' + nf_tmp.slice(0, - 1) + ')' + '\\s');
	var nb = 0;
	var decodearray;
	for ( i = 0; i < myArray.length; ++i ) {
		decodearray = decodeURIComponent(myArray[i]);
		if ( document.frmlog.nf_today.checked == true ) {
			if (! decodearray.match(myToday) ) { continue;}
		}
		if ( decodearray.match(nf_reg) ) {
			// Display it :
			document.frmlog.txtlog.value += decodearray + '\n';
			++nb;
		}
	}
	if ( nb == 0 ) {
		document.frmlog.txtlog.value = '\n > '+ nfi18n.no_record;
	}
}

function check_key() {

	var pubkey = jQuery('#clogs-pubkey').val();
	if ( pubkey == '' ) {
		return false;
	}
	if (! pubkey.match( /^[a-f0-9]{40}:(?:[a-f0-9:.]{3,39}|\*)$/) ) {
		jQuery('#clogs-pubkey').focus();
		alert( nfi18n.invalid_key );
		return false;
	}
}

// ---------------------------------------------------------------------
// EOF
