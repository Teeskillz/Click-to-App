<?php
/*
Plugin Name: Click to App
Plugin URI:  https://wordpress.org/plugins/click-to-app/
Description: Lets make your Web page visitor contact you through WhatsApp with a single click/tap
Version:     2.2
Author:      Teeskillz
Author URI:  https://teeskillz.emall.co.ke/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: Whatsapp
*/

if ( ! defined( 'WPINC' ) ) {
	die('dont try to call this directly');
}

// new interface - ctc - Version
if ( ! defined( 'HT_CTC_VERSION' ) ) {
	define( 'HT_CTC_VERSION', '2.2' );
}

// for previous interface - define HT_CCW_VERSION
if ( ! defined( 'HT_CCW_VERSION' ) ) {
	define( 'HT_CCW_VERSION', '1.7.4' );
}

// define HT_CTC_PLUGIN_FILE
if ( ! defined( 'HT_CTC_PLUGIN_FILE' ) ) {
	define( 'HT_CTC_PLUGIN_FILE', __FILE__ );
}

// prev compatibility - define HT_CCW_PLUGIN_FILE
if ( ! defined( 'HT_CCW_PLUGIN_FILE' ) ) {
	define( 'HT_CCW_PLUGIN_FILE', __FILE__ );
}

include_once 'class-ht-ctc-switch.php';