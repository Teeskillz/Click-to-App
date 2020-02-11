<?php
/**
 * Variables
 * 
 * uses to call at javascript..
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$main_options = get_option('ht_ctc_main_options');

$page_id = get_the_ID();
$post_title = esc_html( get_the_title() );


// Analytics  -  to have to add another var .. and pass main options 
$is_ga_enable = 'no';
$is_fb_an_enable = 'no';

if ( isset( $main_options['google_analytics'] ) ) {
    $is_ga_enable = 'yes';
}

if ( isset( $main_options['fb_analytics'] ) ) {
    $is_fb_an_enable = 'yes';
}

$ht_ctc_options = ht_ctc();

// is_mobile
$is_mobile = $ht_ctc_options->device_type->is_mobile;


// variables .. 
$ht_ctc_var = array (
    'is_mobile' => $is_mobile,
    'post_title' => $post_title,
    'is_ga_enable' => $is_ga_enable,
    'is_fb_an_enable' => $is_fb_an_enable,
    );

wp_localize_script( 'ht_ctc_app_js', 'ht_ctc_var', $ht_ctc_var );


/**
 * if Chat enabled
 */
if ( isset( $main_options['enable_chat'] ) ) {

    // number
    $number = esc_attr( $ht_ctc_options->values->ctc_chat_options['number'] );

    // number - at page level
    $page_number = esc_attr( get_post_meta( $page_id, 'ht_ctc_page_number', true ) );

    if ( isset( $page_number ) && '' !== $page_number ){
        $number = $page_number;
    }

    $chat_show_or_hide = esc_attr( $ht_ctc_options->values->ctc_chat_options['show_or_hide'] );


    $page_url = get_permalink();

    // chat 
    $pre_filled = esc_attr( $ht_ctc_options->values->ctc_chat_options['pre_filled'] );
    $pre_filled = str_replace( '{{url}}', $page_url, $pre_filled );
    $pre_filled = str_replace( '{{title}}', $post_title, $pre_filled );

    $chat_webandapi = '';
    if ( isset( $ht_ctc_options->values->ctc_chat_options['webandapi'] ) ) {
        $chat_webandapi = '1';
    }

    // chat variables .. 
    $ht_ctc_var_chat = array (
                        'number' => $number,
                        'pre_filled' => $pre_filled,
                        'show_or_hide' => $chat_show_or_hide,
                        'webandapi' => $chat_webandapi
                        );


    wp_localize_script( 'ht_ctc_app_js', 'ht_ctc_var_chat', $ht_ctc_var_chat );

}


/**
 * if group enabled
 */
if ( isset( $main_options['enable_group'] ) ) {
    

    $ht_ctc_group = get_option('ht_ctc_group');

    $group_id = esc_attr( $ht_ctc_group['group_id'] );
    
    // group_id - at page level
    $page_group_id = esc_attr( get_post_meta( $page_id, 'ht_ctc_page_group_id', true ) );

    if ( isset( $page_group_id ) && '' !== $page_group_id ){
        $group_id = $page_group_id;
    }
    
    $group_show_or_hide = esc_attr( $ht_ctc_group['show_or_hide'] );

    // Group variables
    $ht_ctc_var_group = array (
        'group_id' => $group_id,
        'show_or_hide' => $group_show_or_hide
        );


    wp_localize_script( 'ht_ctc_app_js', 'ht_ctc_var_group', $ht_ctc_var_group );

}

/**
 * if share enabled
 */
if ( isset( $main_options['enable_share'] ) ) {
    
    $ht_ctc_share = get_option('ht_ctc_share');

    $share_text = esc_attr( $ht_ctc_share['share_text'] );

    // if ( is_home() || is_front_page() ) {
    if ( is_home() ) {
        $post_title = get_bloginfo('name');
        $page_url = get_bloginfo('url');
    }

    $share_text = str_replace( '{{url}}', $page_url, $share_text );
    $share_text = str_replace( '{{title}}', $post_title, $share_text );

    $share_show_or_hide = $ht_ctc_share['show_or_hide'];

    // Share variables
    $ht_ctc_var_share = array (
        'share_text' => $share_text,
        'show_or_hide' => $share_show_or_hide
        );


    wp_localize_script( 'ht_ctc_app_js', 'ht_ctc_var_share', $ht_ctc_var_share );

}