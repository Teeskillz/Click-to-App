<?php
/**
 * Style - 2
 * 
 * Andriod like - WhatsApp icon
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s2_options = get_option( 'ht_ctc_s2' );

$s2_img_size = esc_attr( $s2_options['s2_img_size'] );


if ( !isset( $s2_options['cta_on_hover'] ) ) {
    $call_to_action = '';
}

?>

<div class="<?php echo $class_names ?>" style="position: fixed; <?php echo $position ?> cursor: pointer; z-index: 99999999;">
    <!-- <a href="<?php echo $link ?>" target="_blank" rel="noopener"> -->
        <img class="img-icon" title="<?php echo $call_to_action ?>" style="height: <?php echo $s2_img_size ?>;" src="<?php echo plugins_url( './new/inc/assets/img/whatsapp-icon-square.svg', HT_CTC_PLUGIN_FILE ) ?>" alt="WhatsApp chat">
    <!-- </a> -->
</div>