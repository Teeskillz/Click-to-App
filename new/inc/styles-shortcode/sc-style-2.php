<?php
/**
 * 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s2_options = get_option( 'ht_ctc_s2' );

$s2_img_size = esc_attr( $s2_options['s2_img_size'] );

$s2_img_link = plugins_url( './new/inc/assets/img/whatsapp-icon-square.svg', HT_CTC_PLUGIN_FILE );

if ( !isset( $s2_options['cta_on_hover'] ) ) {
    $call_to_action = '';
}

$o .=  '
    <div onclick="ht_ctc_shortcode_click(this);" data-ctc-link="'.$link.'" data-ctc-type="'.$return_type.'" class="'.$class_names.' ht-ctc-inline" style="display: inline; cursor: pointer; z-index: 99999999; '.$css.'">
        <img class="img-icon" title="'.$call_to_action.'" style="height: '.$s2_img_size.';" src="'.$s2_img_link.'" alt="WhatsApp chat">
    </div>
';


?>
