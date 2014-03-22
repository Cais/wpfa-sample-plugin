=== WPFA Sample Widget ===
Contributors: cais
Donate link: http://buynowshop.com
Tags: widget-only
Requires at least: 3.6
Tested up to: 3.9
Stable tag: 0.4
License: GNU General Public License v2
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

Plugin with multi-widget functionality that displays stuff ...

== Description ==

Plugin with multi-widget functionality that displays stuff ... and a lot more things as well.

== Installation ==

This section describes how to install the plugin and get it working.

Read this article for further assistance: http://wpfirstaid.com/2009/12/plugin-installation/

----
= Shortcode: wpfa_sample =
Parameters are very similar to the plugin:

* 'title'           => '',
* 'choices'         => 'The Doctor',
* 'show_choices'    => true,
* 'optionals'       => 'right'

NB: Use the shortcode at your own risk!

== Frequently Asked Questions ==

= Can I use this in more than one widget area? =
A: Yes, this plugin has been made for multi-widget compatibility. Each instance of the widget will display, if wanted, differently than every other instance of the widget.

== Screenshots ==
1. The options panel as it appears in default.

== Other Notes ==
* Copyright 2010-2014  Edward Caissie  (email : edward.caissie@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 2,
  as published by the Free Software Foundation.

  You may NOT assume that you can use any other version of the GPL.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

  The license for this software can also likely be found here:
  http://www.gnu.org/licenses/gpl-2.0.html

* Please note, support may be available on the WordPress Support forums; but, it may be faster to visit my site instead and leave a comment with the issue you are experiencing.

== Upgrade Notice ==
Please stay current with your WordPress installation, your active theme, and your plugins.

== Changelog ==
= 0.5 =
* Add plugin meta row data via filter hook

= 0.4 =
* Added call to `plugin_data` method to make versions dynamic in the enqueue calls
* Moved widget load hook call into constructor class
* Moved all functions into class for better containment
* Updated required version to 3.6 to use `shortcode_atts` optional filter
* Minor documentation updates and code formatting to meet current WordPress Coding Standards

= 0.3.1 =
* Added additional comments to better indicate sections within the code

= 0.3 =
* First public GitHub release
* Code format clean-up and updated documentation
* Added better i18n support
* Added WordPress version testing
* Added stylesheet enqueue references

= 0.2 =
* Updates to this and that

= 0.1 =
* Initial release