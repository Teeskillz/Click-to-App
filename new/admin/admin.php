<?php
/**
*  starting point for the admin side of this plugin.
*
*  include other file here .. which need in admin side. 
*
*  In click-to-chat.php this file will be loaded as is_admin
*
* @package ctc
* @subpackage Administration
* @since 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;


$ht_ctc_main_options = get_option('ht_ctc_main_options');


/*************** includes ***********/

// add scripts
include_once HT_CTC_PLUGIN_DIR .'new/admin/class-ht-ctc-admin-scripts.php';

// Main admin page - enable options ..
include_once HT_CTC_PLUGIN_DIR .'new/admin/class-ht-ctc-admin-main-page.php';

// Chat admin page
// if ( isset ( $ht_ctc_main_options['enable_chat'] ) ) { 
//     include_once HT_CTC_PLUGIN_DIR .'new/admin/class-ht-ctc-admin-chat-page.php';
// }

// group admin page
if ( isset ( $ht_ctc_main_options['enable_group'] ) ) { 
    include_once HT_CTC_PLUGIN_DIR .'new/admin/class-ht-ctc-admin-group-page.php';
}

// share admin page
if ( isset ( $ht_ctc_main_options['enable_share'] ) ) { 
    include_once HT_CTC_PLUGIN_DIR .'new/admin/class-ht-ctc-admin-share-page.php';
}

// customize styles
include_once HT_CTC_PLUGIN_DIR .'new/admin/class-ht-ctc-admin-customize-styles.php';

// meta boxes - change values at page level
include_once HT_CTC_PLUGIN_DIR .'new/admin/class-ht-ctc-metabox.php';