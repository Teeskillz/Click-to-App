<?php
/**
 * 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s99_options = get_option( 'ht_ctc_s99' );



$s99_desktop_img_height = esc_attr( $s99_options['s99_desktop_img_height'] );
$s99_desktop_img_width = esc_attr( $s99_options['s99_desktop_img_width'] );
$s99_mobile_img_height = esc_attr( $s99_options['s99_mobile_img_height'] );
$s99_mobile_img_width = esc_attr( $s99_options['s99_mobile_img_width'] );

// $icon_size = esc_attr( $s1_options['icon_size'] );
// $icon_size = '50px';


// img url
// image - width, height based on device
$s99_img_css = "";


if( 'yes' == $is_mobile ) {

    $s99_own_image = esc_html( $s99_options['s99_mobile_img_url'] );

    if ( '' == $s99_own_image ) {
        $s99_own_image = plugins_url( './new/inc/assets/img/whatsapp-icon-square.svg', HT_CTC_PLUGIN_FILE );
    }

    if ( '' !== $s99_mobile_img_height ) {
        $s99_img_css .= "height: $s99_mobile_img_height; ";
    }
    if ( '' !== $s99_mobile_img_width ) {
        $s99_img_css .= "width: $s99_mobile_img_width; ";
    }
} else {
    $s99_own_image = esc_html( $s99_options['s99_dekstop_img_url'] );

    if ( '' == $s99_own_image ) {
        $s99_own_image = plugins_url( './new/inc/assets/img/whatsapp-icon-square.svg', HT_CTC_PLUGIN_FILE );
    }

    if ( '' !== $s99_desktop_img_height ) {
        $s99_img_css .= "height: $s99_desktop_img_height; ";
    }
    
    if ( '' !== $s99_desktop_img_width ) {
        $s99_img_css .= "width: $s99_desktop_img_width; ";
    }
}

if ( !isset( $s99_options['cta_on_hover'] ) ) {
    $call_to_action = '';
}

$o .=  '
<div onclick="ht_ctc_shortcode_click(this);" data-ctc-link="'.$link.'" data-ctc-type="'.$return_type.'" style="display: inline; cursor: pointer; z-index: 99999999; '.$css.'" class="'.$class_names.' ht-ctc-inline">
    <img class="own-img" title="'.$call_to_action.'" id="style-99" src="'.$s99_own_image.'" style="'.$s99_img_css.'" alt="WhatsApp chat">
</div>
';


?>
