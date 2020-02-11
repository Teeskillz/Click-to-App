<?php
/**
 * share settings page - admin 
 * 
 * share options .. 
 * 
 * @package ctc
 * @subpackage admin
 * @since 2.0 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Admin_Share_Page' ) ) :

class HT_CTC_Admin_Share_Page {

    public function menu() {

        add_submenu_page(
            'click-to-chat',
            'Share Invite',
            'Share',
            'manage_options',
            'click-to-chat-share-feature',
            array( $this, 'settings_page' )
        );
    }

    public function settings_page() {

        if ( ! current_user_can('manage_options') ) {
            return;
        }

        ?>

        <div class="wrap">

            <?php settings_errors(); ?>

            <div class="row">
                <div class="col s12 m12 xl8 options">
                    <form action="options.php" method="post" class="">
                        <?php settings_fields( 'ht_ctc_share_page_settings_fields' ); ?>
                        <?php do_settings_sections( 'ht_ctc_share_page_settings_sections_do' ) ?>
                        <?php submit_button() ?>
                    </form>
                </div>
                <!-- <div class="col s12 m12 xl6 ht-cc-admin-sidebar">
                </div> -->
            </div>

        </div>

        <?php

    }


    public function settings() {

        // main settings - options enable .. share, share .. 
        // chat options 
        register_setting( 'ht_ctc_share_page_settings_fields', 'ht_ctc_share' , array( $this, 'options_sanitize' ) );
        
        add_settings_section( 'ht_ctc_main_page_settings_sections_add', '', array( $this, 'main_settings_section_cb' ), 'ht_ctc_share_page_settings_sections_do' );
        
        add_settings_field( 'share_text', 'Share Text', array( $this, 'share_text_cb' ), 'ht_ctc_share_page_settings_sections_do', 'ht_ctc_main_page_settings_sections_add' );
        add_settings_field( 'share_cta', 'Call to Action', array( $this, 'share_cta_cb' ), 'ht_ctc_share_page_settings_sections_do', 'ht_ctc_main_page_settings_sections_add' );
        
        add_settings_field( 'share_ctc_desktop_style', 'Style for Desktop', array( $this, 'share_ctc_desktop_style_cb' ), 'ht_ctc_share_page_settings_sections_do', 'ht_ctc_main_page_settings_sections_add' );
        add_settings_field( 'share_ctc_mobile_style', 'Style for Mobile', array( $this, 'share_ctc_mobile_style_cb' ), 'ht_ctc_share_page_settings_sections_do', 'ht_ctc_main_page_settings_sections_add' );
        add_settings_field( 'share_ctc_position', 'Position to place', array( $this, 'share_ctc_position_cb' ), 'ht_ctc_share_page_settings_sections_do', 'ht_ctc_main_page_settings_sections_add' );
        add_settings_field( 'share_show_hide', 'Show/Hide', array( $this, 'share_show_hide_cb' ), 'ht_ctc_share_page_settings_sections_do', 'ht_ctc_main_page_settings_sections_add' );
        add_settings_field( 'share_shortcode', '', array( $this, 'share_shortcode_cb' ), 'ht_ctc_share_page_settings_sections_do', 'ht_ctc_main_page_settings_sections_add' );
        
        
    }

    public function main_settings_section_cb() {
        ?>
        <h1>Share</h1>
        <?php
    }


    // WhatsApp share ID.
    function share_text_cb() {
        $options = get_option('ht_ctc_share');
        ?>
        <div class="row">
            <div class="input-field col s12">
                <input name="ht_ctc_share[share_text]" value="<?php echo esc_attr( $options['share_text'] ) ?>" id="whatsapp_share_text" type="text" class="input-margin">
                <label for="whatsapp_share_text">Share Text</label>
                <p class="description">Placeholder {{url}} returns current webpage URL - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/share-text/">more info</a> ) </p>
            </div>
        </div>
        <?php
    }

    // call to action 
    function share_cta_cb() {
        $options = get_option('ht_ctc_share');
        ?>
        <div class="row">
            <div class="input-field col s12">
                <input name="ht_ctc_share[call_to_action]" value="<?php echo esc_attr( $options['call_to_action'] ) ?>" id="call_to_action" type="text" class="input-margin">
                <label for="call_to_action">Call to Action</label>
                <p class="description">Text that appears along with WhatsApp icon/button - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/call-to-action/">more info</a> </p>
            </div>
        </div>
        <?php
    }
    


    // Desktop - select style 
    function share_ctc_desktop_style_cb() {
        $options = get_option('ht_ctc_share');
        $style_value = esc_attr( $options['style_desktop'] );
        ?>
        <div class="row">
            <div class="input-field col s12" style="margin-bottom: 0px;">
                <select name="ht_ctc_share[style_desktop]" class="select-2">
                    <option value="1" <?php echo $style_value == 1 ? 'SELECTED' : ''; ?> >Style-1</option>
                    <option value="2" <?php echo $style_value == 2 ? 'SELECTED' : ''; ?> >Style-2</option>
                    <option value="3" <?php echo $style_value == 3 ? 'SELECTED' : ''; ?> >Style-3</option>
                    <option value="4" <?php echo $style_value == 4 ? 'SELECTED' : ''; ?> >Style-4</option>
                    <option value="5" <?php echo $style_value == 5 ? 'SELECTED' : ''; ?> >Style-5</option>
                    <option value="6" <?php echo $style_value == 6 ? 'SELECTED' : ''; ?> >Style-6</option>
                    <option value="7" <?php echo $style_value == 7 ? 'SELECTED' : ''; ?> >Style-7</option>
                    <option value="8" <?php echo $style_value == 8 ? 'SELECTED' : ''; ?> >Style-8</option>
                    <option value="99" <?php echo $style_value == 99 ? 'SELECTED' : ''; ?> >Style-99 (Add your own image / GIF)</option>
                </select>
                <label>Select Style for Desktop</label>
            </div>
        </div>

        <p class="description"> - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/list-of-styles/">List of syles</a> </p>
        <p class="description">Can customize each style  - <a target="_blank" href="<?php echo admin_url( 'admin.php?page=click-to-chat-customize-styles' ); ?>"><?php _e( 'Customize Styles' , 'click-to-chat-for-whatsapp' ) ?></a> </p>

        <?php
    }


    // Mobile - select style 
    function share_ctc_mobile_style_cb() {
        $options = get_option('ht_ctc_share');
        $style_value = esc_attr( $options['style_mobile'] );
        ?>
        <div class="row" style="margin-bottom: 0px;">
            <div class="input-field col s12">
                <select name="ht_ctc_share[style_mobile]" class="select-2">
                    <option value="1" <?php echo $style_value == 1 ? 'SELECTED' : ''; ?> >Style-1</option>
                    <option value="2" <?php echo $style_value == 2 ? 'SELECTED' : ''; ?> >Style-2</option>
                    <option value="3" <?php echo $style_value == 3 ? 'SELECTED' : ''; ?> >Style-3</option>
                    <option value="4" <?php echo $style_value == 4 ? 'SELECTED' : ''; ?> >Style-4</option>
                    <option value="5" <?php echo $style_value == 5 ? 'SELECTED' : ''; ?> >Style-5</option>
                    <option value="6" <?php echo $style_value == 6 ? 'SELECTED' : ''; ?> >Style-6</option>
                    <option value="7" <?php echo $style_value == 7 ? 'SELECTED' : ''; ?> >Style-7</option>
                    <option value="8" <?php echo $style_value == 8 ? 'SELECTED' : ''; ?> >Style-8</option>
                    <option value="99" <?php echo $style_value == 99 ? 'SELECTED' : ''; ?> >Style-99 (Add your own image / GIF)</option>
                </select>
                <label>Select Style for Mobile</label>
            </div>
        </div>
        
        <?php
    }


    // position to place 
    function share_ctc_position_cb() {
        $options = get_option('ht_ctc_share');

        $side_1 = esc_attr( $options['side_1'] );
        $side_2 = esc_attr( $options['side_2'] );
        ?>
        <!-- side - 1 -->
        <div class="row">
            <div class="input-field col s6">
                <select name="ht_ctc_share[side_1]" class="select-2">
                    <option value="bottom" <?php echo $side_1 == 'bottom' ? 'SELECTED' : ''; ?> >bottom</option>
                    <option value="top" <?php echo $side_1 == 'top' ? 'SELECTED' : ''; ?> >top</option>
                </select>
                <label>top / bottom </label>
            </div>

            <div class="input-field col s6">
                <input name="ht_ctc_share[side_1_value]" value="<?php echo esc_attr( $options['side_1_value'] ) ?>" id="side_1_value" type="text" class="input-margin">
                <label for="side_1_value">e.g. 10px</label>
            </div>
        </div>

        <!-- side - 2 -->
        <div class="row">
            <div class="input-field col s6">
                <select name="ht_ctc_share[side_2]" class="select-2">
                    <option value="right" <?php echo $side_2 == 'right' ? 'SELECTED' : ''; ?> >right</option>
                    <option value="left" <?php echo $side_2 == 'left' ? 'SELECTED' : ''; ?> >left</option>
                </select>
                <label>right / left </label>
            </div>

            <div class="input-field col s6">
                <input name="ht_ctc_share[side_2_value]" value="<?php echo esc_attr( $options['side_2_value'] ) ?>" id="side_2_value" type="text" class="input-margin">
                <label for="side_2_value">e.g. 10px</label>
            </div>
        </div>

        <p class="description">Add css units as suffix - e.g. 10px, 50% - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/position-to-place/">more info</a> </p>
        <?php
    }




    // show/hide 
    function share_show_hide_cb() {

        
        $options = get_option('ht_ctc_share');

        $show_or_hide = esc_attr( $options['show_or_hide'] );
        ?>

        <ul class="collapsible">
        <li>
        <div class="collapsible-header">Show/Hide</div>
        <div class="collapsible-body">
        
        <?php


        // Hide on Mobile Devices
        if ( isset( $options['hideon_mobile'] ) ) {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_share[hideon_mobile]" type="checkbox" value="1" <?php checked( $options['hideon_mobile'], 1 ); ?> id="hideon_mobile" />
                    <span>Hide on - Mobile Devices</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_share[hideon_mobile]" type="checkbox" value="1" id="hideon_mobile" />
                    <span>Hide on - Mobile Devices</span>
                </label>
            </p>
            <?php
        }

        // Hide on Desktop Devices
        if ( isset( $options['hideon_desktop'] ) ) {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_share[hideon_desktop]" type="checkbox" value="1" <?php checked( $options['hideon_desktop'], 1 ); ?> id="hideon_desktop" />
                    <span>Hide on - Desktop Devices</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_share[hideon_desktop]" type="checkbox" value="1" id="hideon_desktop" />
                    <span>Hide on - Desktop Devices</span>
                </label>
            </p>
            <?php
        }
        ?>
        <!-- <p class="description">plugin detects device based on HTTP User agent </p> -->
        <p class="description">If working in reverse it might be the cache plugin not detecting the devices - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/hide-based-on-device/">more info</a> </p>
        

        <div class="row" style="margin-bottom: 0px;">
            <div class="input-field col s12">
                <select name="ht_ctc_share[show_or_hide]" class="select_show_or_hide">
                    <option value="hide" <?php echo $show_or_hide == "hide" ? 'SELECTED' : ''; ?> >Hide on selected pages</option>
                    <option value="show" <?php echo $show_or_hide == "show" ? 'SELECTED' : ''; ?> >Show on selected pages</option>
                </select>
                <!-- <label><?php _e( 'enable' , 'click-to-chat-for-whatsapp' ) ?></label> -->
            </div>
        </div>
        <?php

        //  ######### Hide #########

        ?>
        <p class="description ctc_show_hide_display show-hide_display-none hidebased" style="margin-bottom: 15px">
            <?php echo 'Select pages to Hide styles <span style="color: green;"> ( Default Shows on all page ) ' ?> 
        </p>
        <!-- <br><br> -->
        <?php

        // checkboxes - Hide based on Type of posts

        // Single Posts
        if ( isset( $options['hideon_posts'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_posts]" type="checkbox" value="1" <?php checked( $options['hideon_posts'], 1 ); ?> id="filled-in-box1" />
                    <span>Hide on - Posts</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_posts]" type="checkbox" value="1" id="filled-in-box1" />
                    <span>Hide on - Posts</span>
                </label>
            </p>
            <?php
        }


        // Page
        if ( isset( $options['hideon_page'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_page]" type="checkbox" value="1" <?php checked( $options['hideon_page'], 1 ); ?> id="filled-in-box2" />
                    <span>Hide on - Pages</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_page]" type="checkbox" value="1" id="filled-in-box2" />
                    <span>Hide on - Pages</span>
                </label>
            </p>
            <?php
        }




        // Home Page
        // is_home and is_front_page - combined. calling as home/front page
        if ( isset( $options['hideon_homepage'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_homepage]" type="checkbox" value="1" <?php checked( $options['hideon_homepage'], 1 ); ?> id="filled-in-box3" />
                    <span>Hide on - Home/Front Page</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_homepage]" type="checkbox" value="1" id="filled-in-box3" />
                    <span>Hide on - Home/Front Page</span>
                </label>
            </p>
            <?php
        }


        // Category
        if ( isset( $options['hideon_category'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_category]" type="checkbox" value="1" <?php checked( $options['hideon_category'], 1 ); ?> id="filled-in-box5" />
                    <span>Hide on - Category</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_category]" type="checkbox" value="1" id="filled-in-box5" />
                    <span>Hide on - Category</span>
                </label>
            </p>
            <?php
        }



        // Archive
        if ( isset( $options['hideon_archive'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_archive]" type="checkbox" value="1" <?php checked( $options['hideon_archive'], 1 ); ?> id="filled-in-box6" />
                    <span>Hide on - Archive</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
            <label>
                    <input name="ht_ctc_share[hideon_archive]" type="checkbox" value="1" id="filled-in-box6" />
                    <span>Hide on - Archive</span>
                </label>
            </p>
            <?php
        }


        // 404 Page
        if ( isset( $options['hideon_404'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
            <label>
                    <input name="ht_ctc_share[hideon_404]" type="checkbox" value="1" <?php checked( $options['hideon_404'], 1 ); ?> id="hideon_404" />
                    <span>Hide on - 404 Page</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_404]" type="checkbox" value="1" id="hideon_404" />
                    <span>Hide on - 404 Page</span>
                </label>
            </p>
            <?php
        }


        // WooCommerce single product pages
        if ( isset( $options['hideon_wooproduct'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
            <label>
                    <input name="ht_ctc_share[hideon_wooproduct]" type="checkbox" value="1" <?php checked( $options['hideon_wooproduct'], 1 ); ?> id="hideon_wooproduct" />
                    <span>Hide on - WooCommerce single product pages</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_share[hideon_wooproduct]" type="checkbox" value="1" id="hideon_wooproduct" />
                    <span>Hide on - WooCommerce single product pages</span>
                </label>
            </p>
            <?php
        }


        ?>
        <p class="description ctc_show_hide_display show-hide_display-none hidebased">Check to hide Styles based on the type of pages</p>
        <?php


        

        // ID's list to hide styles 

        ?>
        <div class="row ctc_show_hide_display show-hide_display-none hidebased">
            <div class="input-field col s12">
                <input name="ht_ctc_share[list_hideon_pages]" value="<?php echo esc_attr( $options['list_hideon_pages'] ) ?>" id="ccw_list_id_tohide" type="text" class="input-margin">
                <label for="ccw_list_id_tohide">Id's list to Hide - add ',' after each id </label>
                <p class="description">Add Post, Page, Media - ID's to hide, can add multiple id's by separating with a comma ( , )</p>
            </div>
        </div>
        <?php


        //  Categorys list - to hide

        ?>
        <div class="row ctc_show_hide_display show-hide_display-none hidebased">
            <div class="input-field col s12">
                <input name="ht_ctc_share[list_hideon_cat]" value="<?php echo esc_attr( $options['list_hideon_cat'] ) ?>" id="ccw_list_cat_tohide" type="text" class="input-margin">
                <label for="ccw_list_cat_tohide"><?php _e( 'Category name\'s to Hide - add \',\' after each category name' , 'click-to-chat-for-whatsapp' ) ?> </label>
                <p class="description">Add Categories name to hide, can add multiple Categories by separating with a comma ( , )</p>
            </div>
        </div>
        <?php


        // ######### Show #########
        
        
        ?>
        <p class="description ctc_show_hide_display show-hide_display-none showbased" style="margin-bottom: 15px">
            <?php echo 'Select pages to display styles <span style="background-color: #dddddd; color: red;"> ( Default hides on all page ) ' ?> 
        </p>
        <?php
        
        // checkboxes - Show based on Type of posts

        // Single Posts
        if ( isset( $options['showon_posts'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_posts]" type="checkbox" value="1" <?php checked( $options['showon_posts'], 1 ); ?> id="show_filled-in-box1" />
                    <span>Show on - Posts</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_posts]" type="checkbox" value="1" id="show_filled-in-box1" />
                    <span>Show on - Posts</span>
                </label>
            </p>
            <?php
        }


        // Page
        if ( isset( $options['showon_page'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_page]" type="checkbox" value="1" <?php checked( $options['showon_page'], 1 ); ?> id="show_filled-in-box2" />
                    <span>Show on - Pages</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_page]" type="checkbox" value="1" id="show_filled-in-box2" />
                    <span>Show on - Pages</span>
                </label>
            </p>
            <?php
        }


        // Home Page
        // is_home and is_front_page - combined. calling as home/front page
        if ( isset( $options['showon_homepage'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_homepage]" type="checkbox" value="1" <?php checked( $options['showon_homepage'], 1 ); ?> id="show_filled-in-box3" />
                    <span>Show on - Home/Front Page</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_homepage]" type="checkbox" value="1" id="show_filled-in-box3" />
                    <span>Show on - Home/Front Page</span>
                </label>
            </p>
            <?php
        }
        

        // Category
        if ( isset( $options['showon_category'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_category]" type="checkbox" value="1" <?php checked( $options['showon_category'], 1 ); ?> id="show_filled-in-box5" />
                    <span>Show on - Category</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_category]" type="checkbox" value="1" id="show_filled-in-box5" />
                    <span>Show on - Category</span>
                </label>
            </p>
            <?php
        }

        // Archive
        if ( isset( $options['showon_archive'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_archive]" type="checkbox" value="1" <?php checked( $options['showon_archive'], 1 ); ?> id="show_filled-in-box6" />
                    <span>Show on - Archive</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_archive]" type="checkbox" value="1" id="show_filled-in-box6" />
                    <span>Show on - Archive</span>
                </label>
            </p>
            <?php
        }

        
        // 404 Page
        if ( isset( $options['showon_404'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_404]" type="checkbox" value="1" <?php checked( $options['showon_404'], 1 ); ?> id="showon_404" />
                    <span>Show on - 404 Page</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_404]" type="checkbox" value="1" id="showon_404" />
                    <span>Show on - 404 Page</span>
                </label>
            </p>
            <?php
        }

        
        // WooCommerce single product pages
        if ( isset( $options['showon_wooproduct'] ) ) {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_wooproduct]" type="checkbox" value="1" <?php checked( $options['showon_wooproduct'], 1 ); ?> id="showon_wooproduct" />
                    <span>Show on - WooCommerce Single product pages</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_share[showon_wooproduct]" type="checkbox" value="1" id="showon_wooproduct" />
                    <span>Show on - WooCommerce Single product pages</span>
                </label>
            </p>
            <?php
        }


        ?>
        <p class="description ctc_show_hide_display show-hide_display-none showbased"><?php _e( 'Check to display Styles based on type of the page' , 'click-to-chat-for-whatsapp' ) ?></p>
        <?php


        // ID's list to show styles

        ?>
        <div class="row ctc_show_hide_display show-hide_display-none showbased">
            <div class="input-field col s12">
                <input name="ht_ctc_share[list_showon_pages]" value="<?php echo esc_attr( $options['list_showon_pages'] ) ?>" id="ccw_list_id_toshow" type="text" class="input-margin">
                <label for="ccw_list_id_toshow">Id's list to show - add ',' after each id </label>
                <p class="description"> Add Post, Pages, Media - ID's to show styles, can add multiple id's separate with a comma ( , ) </p>
            </div>
        </div>
        <?php


        //  Categorys list - to show

        // $ccw_list_cat_toshow = get_option('ht_ctc_share');

        ?>
        <div class="row ctc_show_hide_display show-hide_display-none showbased">
            <div class="input-field col s12">
                <input name="ht_ctc_share[list_showon_cat]" value="<?php echo esc_attr( $options['list_showon_cat'] ) ?>" id="ccw_list_cat_toshow" type="text" class="input-margin">
                <label for="ccw_list_cat_toshow"><?php _e( 'Category name\'s to Show - add \',\' after each category name' , 'click-to-chat-for-whatsapp' ) ?> </label>
                <p class="description"><?php _e( 'Category name\'s to show styles, can add multiple Categories separate with a comma ( , )' , 'click-to-chat-for-whatsapp' ) ?> </p>
            </div>
        </div>

        
        <p class="description"><a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/show-hide-styles/">more info</a> </p>


        </div>
        </li>
        <ul>
        

        <?php

    }


    function share_shortcode_cb() {
        ?>
        <p class="description">Shorcodes for Share: [ht-ctc-share] - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/shortcodes-share">more info</a></p>
        <?php
    }






    /**
     * Sanitize each setting field as needed
     *
     * @since 2.0
     * @param array $input Contains all settings fields as array keys
     */
    public function options_sanitize( $input ) {

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'not allowed to modify - please contact admin ' );
        }

        $new_input = array();

        foreach ($input as $key => $value) {
            if( isset( $input[$key] ) ) {
                $new_input[$key] = sanitize_text_field( $input[$key] );
            }
        }


        return $new_input;
    }


}

$ht_ctc_admin_share_page = new HT_CTC_Admin_Share_Page();

add_action('admin_menu', array($ht_ctc_admin_share_page, 'menu') );
add_action('admin_init', array($ht_ctc_admin_share_page, 'settings') );

endif; // END class_exists check
