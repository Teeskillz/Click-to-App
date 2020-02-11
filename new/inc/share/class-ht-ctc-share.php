<?php
/**
 * Share feature - main page
 * 
 * @subpackage share
 * @since 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Share' ) ) :

class HT_CTC_Share {

    public function __construct() {
        // $this->share();
    }


    /**
     * Which features are enable - based on this call function .. 
     */
    public function share() {
        
        $options = get_option('ht_ctc_share');


        // show/hide ..
        include_once HT_CTC_PLUGIN_DIR .'new/inc/share/share-show-hide.php';

        if ( 'no' == $display ) {
            return;
        }

        // position
        include_once HT_CTC_PLUGIN_DIR .'new/inc/share/share-position.php';
        
        // is mobile to select styles
        $is_mobile = ht_ctc()->device_type->is_mobile();

        // style
        if ( 'yes' == $is_mobile ) {
            $style = esc_html( $options['style_mobile'] );
        } else {
            $style = esc_html( $options['style_desktop'] );
        }

        // call to action
        $call_to_action = esc_html( $options['call_to_action'] );

        // class names
        $class_names = "ht-ctc-share style-$style";

        // call style
        $path = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style. '.php';

        if ( is_file( $path ) ) {
            include $path;
        }

        
    }

}

// new HT_CTC_Share();

$ht_ctc_share = new HT_CTC_Share();
add_action( 'wp_footer', array( $ht_ctc_share, 'share' ) );


endif; // END class_exists check