<?php
/**
 * Group chat/invite feature - main page
 * 
 * @subpackage group
 * @since 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Group' ) ) :

class HT_CTC_Group {

    public function __construct() {
        // $this->group();
    }


    /**
     * Which features are enable - based on this call function .. 
     */
    public function group() {
        
        $options = get_option('ht_ctc_group');


        // show/hide ..
        include_once HT_CTC_PLUGIN_DIR .'new/inc/group/group-show-hide.php';

        if ( 'no' == $display ) {
            return;
        }

        // position
        include_once HT_CTC_PLUGIN_DIR .'new/inc/group/group-position.php';
        
        // is mobile to select styles
        $is_mobile = ht_ctc()->device_type->is_mobile();

        // style
        if ( 'yes' == $is_mobile ) {
            $style = esc_attr( $options['style_mobile'] );
        } else {
            $style = esc_attr( $options['style_desktop'] );
        }

        // call to action
        $call_to_action = esc_attr( $options['call_to_action'] );

        // class names
        $class_names = "ht-ctc-group style-$style";

        // call style
        $path = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style. '.php';

        if ( is_file( $path ) ) {
            include $path;
        }

        
    }

}

// new HT_CTC_Group();

$ht_ctc_group = new HT_CTC_Group();
add_action( 'wp_footer', array( $ht_ctc_group, 'group' ) );


endif; // END class_exists check