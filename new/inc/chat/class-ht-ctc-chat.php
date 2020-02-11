<?php
/**
 * WhatsApp Chat  - main page .. 
 * 
 * @subpackage chat
 */



if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Chat' ) ) :

class HT_CTC_Chat {


    /**
     * Which features are enable - based on this call function .. 
     */
    public function chat() {
        
        $options = get_option('ht_ctc_chat_options');
        

        // show/hide .. 
        include_once HT_CTC_PLUGIN_DIR .'new/inc/chat/chat-show-hide.php';

        if ( 'no' == $display ) {
            return;
        }

        // position
        include_once HT_CTC_PLUGIN_DIR .'new/inc/chat/chat-position.php';
        
        // is mobile to select styles
        $is_mobile = ht_ctc()->device_type->is_mobile();

        $device_class = '';

        // style
        if ( 'yes' == $is_mobile ) {
            $style = esc_attr( $options['style_mobile'] );
            $device_class = 'mobile';
        } else {
            $style = esc_attr( $options['style_desktop'] );
            $device_class = 'desktop';
        }

        // call to action
        // todo localization for number, .. ( at variables page ) - call to action for share, group
        $call_to_action_db = esc_attr( $options['call_to_action'] );
        $call_to_action = __( $call_to_action_db , 'click-to-chat-for-whatsapp' );


        // call to action - at page level
        $page_id = get_the_ID();
        $page_call_to_action = esc_attr( get_post_meta( $page_id, 'ht_ctc_page_call_to_action', true ) );

        if ( isset( $page_call_to_action ) && '' !== $page_call_to_action ){
            $call_to_action = $page_call_to_action;
        }

        // class names
        $class_names = "ht-ctc-chat style-$style $device_class";

        // call style
        $path = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style. '.php';

        if ( is_file( $path ) ) {
            include $path;
        }

        
    }

}

// new HT_CTC_Chat();

$ht_ctc_chat = new HT_CTC_Chat();
add_action( 'wp_footer', array( $ht_ctc_chat, 'chat' ) );


endif; // END class_exists check