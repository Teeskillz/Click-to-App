<?php
/**
 * materialize button
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s8_options = get_option( 'ht_ctc_s8' );

?>
<style>
.ht-ctc-sc-style-8 {
  display: none;
}
</style>
<?php

wp_enqueue_style('ht_ctc_mdstyle8_css');

$s8_txt_color = esc_attr( $s8_options['s8_txt_color'] );
$s8_icon_color = esc_attr( $s8_options['s8_icon_color'] );
$s8_txt_color_on_hover = esc_attr( $s8_options['s8_txt_color_on_hover'] );
$s8_bg_color = esc_attr( $s8_options['s8_bg_color'] );
$s8_bg_color_on_hover = esc_attr( $s8_options['s8_bg_color_on_hover'] );
$s8_icon_color_on_hover = esc_attr( $s8_options['s8_icon_color_on_hover'] );
$s8_icon_position = esc_attr( $s8_options['s8_icon_position'] );

// shortcode attributes 
$s8_width_sc   = $a["s8_width"];
// left/right/hide or any thing to display icon just before the text
$s8_icon_position_sc   = $a["s8_icon_position"];

if ( '' !== $s8_width_sc ) {
  $s8_width_css = "width: $s8_width_sc";
}

if ( '' !== $s8_icon_position_sc ) {
  $s8_icon_position = $s8_icon_position_sc;
}


$input_onhover = "this.style.backgroundColor= '$s8_bg_color_on_hover', this.childNodes[1].style.color= '$s8_icon_color_on_hover', this.childNodes[3].style.color= '$s8_txt_color_on_hover'; ";
$input_onhover_out = "this.style.backgroundColor= '$s8_bg_color', this.childNodes[1].style.color= '$s8_icon_color', this.childNodes[3].style.color= '$s8_txt_color'; ";


$o .=  '
<div onclick="ht_ctc_shortcode_click(this);" data-ctc-link="'.$link.'" data-ctc-type="'.$return_type.'" style="cursor: pointer; z-index: 99999999; '.$css.'" class="'.$class_names.' ht-ctc-sc-style-8 ht-ctc-inline mdstyle8">
    
    <span class="waves-effect waves-light btn" style="background-color: '.$s8_bg_color.'; '.$s8_width_css.'"
    onmouseover= "'.$input_onhover.'"
    onmouseout= "'.$input_onhover_out.'">
        <i class="material-icons '.$s8_icon_position.' icon icon-whatsapp2" style="color: '.$s8_icon_color.';"></i>
        <span style="color: '.$s8_txt_color.';">'.$call_to_action.'</span>
    </span>

</div>
';