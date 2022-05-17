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
// +-------------------------------------------------------------------+
$changelog = <<<'EOT'

= 4.0.3 =

* Fixed all links (documentation and posts) pointing to our new website.
* Updated Chart.js to the latest version 2.9.3
* Updated security rules.
* Pro+ Edition (Premium): Updated IPv4/IPv6/ASN GeoIP databases.
* Small fixes and enhancements.

= 4.0.2 =

* Improved firewall engine:
    -Fixed a bug in the HTML entities decoder.
    -Added ES6 unicode detection and decoding.
* Pro+ Edition (Premium): Fixed a bug in the "Web Filter" where it could not be disabled if the textarea element was empty.
* Fixed a potential "Undefined index: size" PHP notice.
* Updated security rules.
* Pro+ Edition (Premium): Updated IPv4/IPv6/ASN GeoIP databases.

= 4.0.1 =

* Updated security rules.
* Pro+ Edition (Premium): Updated IPv4/IPv6/ASN GeoIP databases.

= 4.0 =

This is a major update.

* Improved NinjaFirewall overall interface and pages layout; added some simple toggle switches to replace radio buttons, better handling of error messages, cleaned up useless code etc.
* Most JavaScript code was rewritten from scratch, including all features that rely on it (e.g., "Live Log" etc).
* Pro+ Edition (Premium): The "Access Control" pages interface was simplified: it now uses simple textarea elements where you can copy/paste your data (URL, IP, Bot) very easily. The "Geolocation" page was simplified too.
* Pro+ Edition (Premium): In addition to an IP address or CIDR, you can now also enter an AS number (Autonomous System number) in the "IP Access Control". This new feature is very helpful if you want to allow or block all IPs from an ISP or hosting company: just enter their AS number instead of hundreds of IP addresses. Syntax is "AS" + the number, e.g. "AS12345". See "Access Control > IP Access Control".
* The admin interface will not use remote fonts from fonts.googleapis.com anymore, but your own ones instead. In addition, you can change the fonts family and size very easily from the "Account > Options > Appearance" menu, without having to upload your own CSS file.
* The maximum banning period for IP addresses has been increased from 999 to 9,999 minutes (Firewall > Options > Banned IP addresses).
* Pro+ Edition (Premium): The maximum banning period for rate-limiting has been increased from 999 to 9,999 seconds (Firewall > Access Control > IP Access Control > Rate limiting).
* The "Block the DOCUMENT_ROOT server variable in HTTP request" policy will not be enabled by default with new installations of NinjaFirewall.
* Fixed a bug in the firewall engine sanitizing function: when dealing with an empty string, the function was returning NULL rather than returning the empty value.
* Fixed a potential "Undefined index: size" PHP notice that could occur during uploads.
* Pro+ Edition (Premium): Fixed a bug where the ISO 3166 country code was not found when using an external PHP Variable instead of the built-in GeoIP database.
* Updated security rules.
* Many small fixes and enhancements.
* Pro+ Edition (Premium): Updated IPv4/IPv6/ASN GeoIP databases.

EOT;
// ---------------------------------------------------------------------
// EOF
