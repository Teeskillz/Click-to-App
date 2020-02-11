<?php
/**
 * 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// $s1_options = get_option( 'ht_ctc_s1' );
// $s1_img_size = esc_attr( $s1_options['s1_img_size'] );


$o .=  '
<div onclick="ht_ctc_shortcode_click(this);" data-ctc-link="'.$link.'" data-ctc-type="'.$return_type.'" style="display: inline; cursor: pointer; z-index: 99999999; '.$css.'" class="'.$class_names.' ht-ctc-inline '.$css.'">
    <button>'.$call_to_action.'</button>
</div>
';


?>
