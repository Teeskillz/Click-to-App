<?php
/**
* Register css styles, javascript files front end
*
* @package ctc
* @since 2.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Scripts' ) ) :

class HT_CTC_Scripts {


    /**
	 * Register styles - front end ( non admin )
	 *
	 * @since 1.0
	 */
    function register_scripts() {

        // css
        wp_enqueue_style('ht_ctc_main_css', plugins_url( 'new/inc/assets/css/main.css', HT_CTC_PLUGIN_FILE ), '', HT_CTC_VERSION );

        // style-8 - enqueue at page level
        wp_register_style('ht_ctc_mdstyle8_css', plugins_url( 'new/inc/assets/css/mdstyle8.css', HT_CTC_PLUGIN_FILE ) , '', HT_CTC_VERSION );

        
        // js
        wp_enqueue_script( 'ht_ctc_app_js', plugins_url( 'new/inc/assets/js/app.js', HT_CTC_PLUGIN_FILE ), array ( 'jquery' ), HT_CTC_VERSION, true );

        
    }

}

$ht_ctc_scripts =  new HT_CTC_Scripts();

add_action('wp_enqueue_scripts', array( $ht_ctc_scripts, 'register_scripts' ) );

endif; // END class_exists check