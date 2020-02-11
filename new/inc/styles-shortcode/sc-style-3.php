<?php
/**
 * 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s3_options = get_option( 'ht_ctc_s3' );

$s3_img_size = esc_attr( $s3_options['s3_img_size'] );

$s3_img_link = plugins_url( './new/inc/assets/img/whatsapp-logo.svg', HT_CTC_PLUGIN_FILE );

if ( !isset( $s3_options['cta_on_hover'] ) ) {
    $call_to_action = '';
}

$o .=  '
<div onclick="ht_ctc_shortcode_click(this);" data-ctc-link="'.$link.'" data-ctc-type="'.$return_type.'" style="display: inline; cursor: pointer; '.$css.'" class="'.$class_names.' ht-ctc-inline z-index: 99999999;">
    <img class="img-icon" title="'.$call_to_action.'" style="height: '.$s3_img_size.';" src="'.$s3_img_link.'" alt="WhatsApp chat">
</div>
';


?>
