<?php
/**
 * Main settings page - admin 
 * 
 * this main settings page contains .. 
 * 
 * enable options .. like chat default enabled, group, share, woocommerce
 * 
 * switch option
 * 
 * @package ctc
 * @subpackage admin
 * @since 2.0 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Admin_Main_Page' ) ) :

class HT_CTC_Admin_Main_Page {

    public function menu() {

        add_menu_page(
            'Click to Chat - New Interface - Plugin Option Page',
            'Click to Chat',
            'manage_options',
            'click-to-chat',
            array( $this, 'settings_page' ),
            'dashicons-format-chat'
        );
    }

    public function settings_page() {

        if ( ! current_user_can('manage_options') ) {
            return;
        }

        ?>

        <div class="wrap">

            <?php settings_errors(); ?>

            <!-- full row -->
            <div class="row">

                <div class="col s12 m12 xl7 options">
                    <form action="options.php" method="post" class="">
                        <?php settings_fields( 'ht_ctc_main_page_settings_fields' ); ?>
                        <?php do_settings_sections( 'ht_ctc_main_page_settings_sections_do' ) ?>
                        <?php submit_button() ?>
                    </form>
                </div>

                <!-- sidebar content -->
                <div class="col s12 m12 xl4 ht-cc-admin-sidebar sticky-sidebar">
                    <div class="sidebar-content">
                        <p>
                        Please let us know if you have any suggestions or feedback!! <br>
                        <a href="http://api.whatsapp.com/send?phone=919494429789&text=Hi HoliThemes, I have a Suggestion/Feedback:" target="_blank">WhatsApp</a> <br>
                        mail: wp@holithemes.com
                        </p>

                        <div class="col s12 m8">
                            <div class="collection with-header">
                            <div class="collection-header"><bold>HoliThemes On</bold></div>
                            <a target="_blank" href="https://www.facebook.com/holithemes/" class="collection-item">Facebook</a>
                            <a target="_blank" href="https://twitter.com/holithemes" class="collection-item">Twitter</a>
                            <a target="_blank" href="https://www.instagram.com/holithemes/" class="collection-item">Instagram</a>
                            <a target="_blank" href="https://www.youtube.com/channel/UC2Tf_WB9PWffO2B3tswWCGw" class="collection-item">YouTube</a>
                            <a target="_blank" href="https://www.linkedin.com/company/holithemes" class="collection-item">LinkedIn</a>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>

            <!-- new row -->
            <!-- social links -->
            <!-- <div class="row">
                <div class="col s12 m12 l12 xl9">
                    <div class="row">
                
                        <div class="col s12 m6">
                            <div class="collection with-header">
                            <div class="collection-header"><bold>HoliThemes On</bold></div>
                            <a target="_blank" href="https://www.facebook.com/holithemes/" class="collection-item">Facebook</a>
                            <a target="_blank" href="https://twitter.com/holithemes" class="collection-item">Twitter</a>
                            <a target="_blank" href="https://www.instagram.com/holithemes/" class="collection-item">Instagram</a>
                            <a target="_blank" href="https://www.youtube.com/channel/UC2Tf_WB9PWffO2B3tswWCGw" class="collection-item">YouTube</a>
                            <a target="_blank" href="https://www.linkedin.com/company/holithemes" class="collection-item">LinkedIn</a>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div> -->

        </div>

        <?php

    }


    public function settings() {


        
        // chat feautes
        $is_chat_enabled = get_option('ht_ctc_main_options');
		if ( isset( $is_chat_enabled['enable_chat'] ) ) {

            register_setting( 'ht_ctc_main_page_settings_fields', 'ht_ctc_chat_options' , array( $this, 'options_sanitize' ) );
        
            add_settings_section( 'ht_ctc_chat_page_settings_sections_add', '', array( $this, 'chat_settings_section_cb' ), 'ht_ctc_main_page_settings_sections_do' );

            add_settings_field( 'number', 'WhatsApp Number', array( $this, 'number_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_chat_page_settings_sections_add' );
            add_settings_field( 'prefilled', 'Pre-Filled Message', array( $this, 'prefilled_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_chat_page_settings_sections_add' );
            add_settings_field( 'cta', 'Call to Action', array( $this, 'cta_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_chat_page_settings_sections_add' );
            add_settings_field( 'ctc_desktop_style', 'Style for Desktop', array( $this, 'ctc_desktop_style_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_chat_page_settings_sections_add' );
            add_settings_field( 'ctc_mobile_style', 'Style for Mobile', array( $this, 'ctc_mobile_style_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_chat_page_settings_sections_add' );
            add_settings_field( 'ctc_position', 'Position to place', array( $this, 'ctc_position_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_chat_page_settings_sections_add' );
            add_settings_field( 'ctc_webandapi', 'Web WhatsApp', array( $this, 'ctc_webandapi_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_chat_page_settings_sections_add' );
            add_settings_field( 'ctc_show_hide', 'Show/Hide', array( $this, 'ctc_show_hide_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_chat_page_settings_sections_add' );
            add_settings_field( 'chat_shortcode', '', array( $this, 'chat_shortcode_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_chat_page_settings_sections_add' );

        }
        


        // main settings - options enable .. chat, group, share
        // switch options 
        register_setting( 'ht_ctc_main_page_settings_fields', 'ht_ctc_main_options' , array( $this, 'options_sanitize' ) );
        add_settings_section( 'ht_ctc_main_page_settings_sections_add', '', array( $this, 'main_settings_section_cb' ), 'ht_ctc_main_page_settings_sections_do' );
        
        add_settings_field( 'ctc_enable_features', 'Enable Features', array( $this, 'ctc_enable_features_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_main_page_settings_sections_add' );
        
        $ccw_options = get_option('ccw_options');
		if ( isset( $ccw_options['number'] ) ) {
            // display this setting page only if user switched from previous interface.. ( for new users no switch option )
            register_setting( 'ht_ctc_main_page_settings_fields', 'ht_ctc_switch' , array( $this, 'options_sanitize' ) );
            add_settings_field( 'ht_ctc_switch', '', array( $this, 'ht_ctc_switch_cb' ), 'ht_ctc_main_page_settings_sections_do', 'ht_ctc_main_page_settings_sections_add' );
		}
        
    }



    public function chat_settings_section_cb() {
        ?>
        <h1>Click to Chat ( New Interface )</h1>
        <br>
        <h1>Chat Settings</h1>
        <?php
    }


    // WhatsApp number
    function number_cb() {
        $options = get_option('ht_ctc_chat_options');
        ?>
        <div class="row">
            <div class="input-field col s12">
                <input name="ht_ctc_chat_options[number]" value="<?php echo esc_attr( $options['number'] ) ?>" id="whatsapp_number" type="text" class="input-margin">
                <label for="whatsapp_number">Enter WhatsApp number </label>
                <p class="description">Enter 'WhatsApp' or 'WhatsApp business' number with country code ( No need to add any prefix "+" )
                <br> ( e.g. 916123456789 - herein e.g. 91 is country code, 6123456789 is the mobile number ) - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/whatsapp-number/">more info</a> ) </p>
            </div>
        </div>
        <?php
    }

    // pre-filled - message
    function prefilled_cb() {
        $options = get_option('ht_ctc_chat_options');
        ?>
        <div class="row">
            <div class="input-field col s12">
                <input name="ht_ctc_chat_options[pre_filled]" value="<?php echo esc_attr( $options['pre_filled'] ) ?>" id="pre_filled" type="text" class="input-margin">
                <label for="pre_filled">Pre-filled message</label>
                <p class="description">Text that appears in the WhatsApp Chat window. Add placeholders {{url}}, {{title}} to replace current webpage URL, Post title - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/pre-filled-message/">more info</a> </p>
            </div>
        </div>
        <?php
    }

    // call to action 
    function cta_cb() {
        $options = get_option('ht_ctc_chat_options');
        ?>
        <div class="row">
            <div class="input-field col s12">
                <input name="ht_ctc_chat_options[call_to_action]" value="<?php echo esc_attr( $options['call_to_action'] ) ?>" id="call_to_action" type="text" class="input-margin">
                <label for="call_to_action">Call to Action</label>
                <p class="description"> Text that appears along with WhatsApp icon/button - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/call-to-action/">more info</a> </p>
            </div>
        </div>
        <?php
    }


    // Desktop - select style 
    function ctc_desktop_style_cb() {
        $options = get_option('ht_ctc_chat_options');
        $style_value = esc_attr( $options['style_desktop'] );
        ?>
        <div class="row">
            <div class="input-field col s12" style="margin-bottom: 0px;">
                <select name="ht_ctc_chat_options[style_desktop]" class="select-2">
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
        <p class="description"> Can customize each style - <a target="_blank" href="<?php echo admin_url( 'admin.php?page=click-to-chat-customize-styles' ); ?>">Customize Styles</a> </p>
        <?php
    }   


    // Mobile - select style 
    function ctc_mobile_style_cb() {
        $options = get_option('ht_ctc_chat_options');
        $style_value = esc_attr( $options['style_mobile'] );
        ?>
        <div class="row" style="margin-bottom: 0px;">
            <div class="input-field col s12">
                <select name="ht_ctc_chat_options[style_mobile]" class="select-2">
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
        
        <!-- <p class="description"> - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/list-of-styles/">List of syles</a> </p>
        <p class="description"> Can customize each style - <a target="_blank" href="<?php echo admin_url( 'admin.php?page=click-to-chat-customize-styles' ); ?>">Customize Styles</a> </p> -->
        <?php
    }


    // position to place 
    function ctc_position_cb() {
        $options = get_option('ht_ctc_chat_options');

        $side_1 = esc_attr( $options['side_1'] );
        $side_1_value = esc_attr( $options['side_1_value'] );
        $side_2 = esc_attr( $options['side_2'] );
        ?>
        <!-- side - 1 -->
        <div class="row">
            <div class="input-field col s6">
                <select name="ht_ctc_chat_options[side_1]" class="select-2">
                    <option value="bottom" <?php echo $side_1 == 'bottom' ? 'SELECTED' : ''; ?> >bottom</option>
                    <option value="top" <?php echo $side_1 == 'top' ? 'SELECTED' : ''; ?> >top</option>
                </select>
                <label>top / bottom </label>
            </div>
            <div class="input-field col s6">
                <input name="ht_ctc_chat_options[side_1_value]" value="<?php echo esc_attr( $options['side_1_value'] ) ?>" id="side_1_value" type="text" class="input-margin">
                <label for="side_1_value">e.g. 10px</label>
            </div>
        </div>


        <!-- side - 2 -->
        <div class="row">
            <div class="input-field col s6">
                <select name="ht_ctc_chat_options[side_2]" class="select-2">
                    <option value="right" <?php echo $side_2 == 'right' ? 'SELECTED' : ''; ?> >right</option>
                    <option value="left" <?php echo $side_2 == 'left' ? 'SELECTED' : ''; ?> >left</option>
                </select>
                <label>right / left</label>
            </div>

            <div class="input-field col s6">
                <input name="ht_ctc_chat_options[side_2_value]" value="<?php echo esc_attr( $options['side_2_value'] ) ?>" id="side_2_value" type="text" class="input-margin">
                <label for="side_2_value">e.g. 10px</label>
            </div>
        </div>

        <p class="description">Add css units as suffix - e.g. 10px, 50% - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/position-to-place/">more info</a> </p>
        <?php
    }


    // If checked web / api whatsapp link. If unchecked wa.me links
    function ctc_webandapi_cb() {
        $options = get_option('ht_ctc_chat_options');


        if ( isset( $options['webandapi'] ) ) {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_chat_options[webandapi]" type="checkbox" value="1" <?php checked( $options['webandapi'], 1 ); ?> id="webandapi"   />
                    <span>Web WhatsApp on Desktop</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_chat_options[webandapi]" type="checkbox" value="1" id="webandapi"   />
                    <span>Web WhatsApp on Desktop</span>
                </label>
            </p>
            <?php
        }
        ?>
        <p class="description">Open Web.WhatsApp directly on Desktop - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/web-whatsapp/">more info</a> </p>
        <p class="description">if cache plugins, not detecting the device uncheck this option</p>
        <p class="description"></p>
        <?php
    }
    

    // show/hide 
    function ctc_show_hide_cb() {

        
        $options = get_option('ht_ctc_chat_options');

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
                    <input name="ht_ctc_chat_options[hideon_mobile]" type="checkbox" value="1" <?php checked( $options['hideon_mobile'], 1 ); ?> id="hideon_mobile" />
                    <span>Hide on - Mobile Devices</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_chat_options[hideon_mobile]" type="checkbox" value="1" id="hideon_mobile" />
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
                    <input name="ht_ctc_chat_options[hideon_desktop]" type="checkbox" value="1" <?php checked( $options['hideon_desktop'], 1 ); ?> id="hideon_desktop" />
                    <span>Hide on - Desktop Devices</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_chat_options[hideon_desktop]" type="checkbox" value="1" id="hideon_desktop" />
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
                <select name="ht_ctc_chat_options[show_or_hide]" class="select_show_or_hide">
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
                    <input name="ht_ctc_chat_options[hideon_posts]" type="checkbox" value="1" <?php checked( $options['hideon_posts'], 1 ); ?> id="filled-in-box1" />
                    <span>Hide on - Posts</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_chat_options[hideon_posts]" type="checkbox" value="1" id="filled-in-box1" />
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
                    <input name="ht_ctc_chat_options[hideon_page]" type="checkbox" value="1" <?php checked( $options['hideon_page'], 1 ); ?> id="filled-in-box2" />
                    <span>Hide on - Pages</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_chat_options[hideon_page]" type="checkbox" value="1" id="filled-in-box2" />
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
                    <input name="ht_ctc_chat_options[hideon_homepage]" type="checkbox" value="1" <?php checked( $options['hideon_homepage'], 1 ); ?> id="filled-in-box3" />
                    <span>Hide on - Home/Front Page</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_chat_options[hideon_homepage]" type="checkbox" value="1" id="filled-in-box3" />
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
                    <input name="ht_ctc_chat_options[hideon_category]" type="checkbox" value="1" <?php checked( $options['hideon_category'], 1 ); ?> id="filled-in-box5" />
                    <span>Hide on - Category</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_chat_options[hideon_category]" type="checkbox" value="1" id="filled-in-box5" />
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
                    <input name="ht_ctc_chat_options[hideon_archive]" type="checkbox" value="1" <?php checked( $options['hideon_archive'], 1 ); ?> id="filled-in-box6" />
                    <span>Hide on - Archive</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
            <label>
                    <input name="ht_ctc_chat_options[hideon_archive]" type="checkbox" value="1" id="filled-in-box6" />
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
                    <input name="ht_ctc_chat_options[hideon_404]" type="checkbox" value="1" <?php checked( $options['hideon_404'], 1 ); ?> id="hideon_404" />
                    <span>Hide on - 404 Page</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_chat_options[hideon_404]" type="checkbox" value="1" id="hideon_404" />
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
                    <input name="ht_ctc_chat_options[hideon_wooproduct]" type="checkbox" value="1" <?php checked( $options['hideon_wooproduct'], 1 ); ?> id="hideon_wooproduct" />
                    <span>Hide on - WooCommerce single product pages</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none hidebased">
                <label>
                    <input name="ht_ctc_chat_options[hideon_wooproduct]" type="checkbox" value="1" id="hideon_wooproduct" />
                    <span>Hide on - WooCommerce single product pages</span>
                </label>
            </p>
            <?php
        }


        ?>
        <p class="description ctc_show_hide_display show-hide_display-none hidebased">Check to hide Styles based on the type of pages</p>
        <?php


        

        // ID's list to hide styles 

        ?>
        <div class="row ctc_show_hide_display show-hide_display-none hidebased">
            <div class="input-field col s12">
                <input name="ht_ctc_chat_options[list_hideon_pages]" value="<?php echo esc_attr( $options['list_hideon_pages'] ) ?>" id="ccw_list_id_tohide" type="text" class="input-margin">
                <label for="ccw_list_id_tohide">Id's list to Hide - add ',' after each id </label>
                <p class="description"> Add Post, Page, Media - ID's to hide, can add multiple id's by separating with a comma ( , ) </p>
            </div>
        </div>
        <?php


        //  Categorys list - to hide

        ?>
        <div class="row ctc_show_hide_display show-hide_display-none hidebased">
            <div class="input-field col s12">
                <input name="ht_ctc_chat_options[list_hideon_cat]" value="<?php echo esc_attr( $options['list_hideon_cat'] ) ?>" id="ccw_list_cat_tohide" type="text" class="input-margin">
                <label for="ccw_list_cat_tohide"><?php _e( 'Category name\'s to Hide - add \',\' after each category name' , 'click-to-chat-for-whatsapp' ) ?> </label>
                <p class="description">Add Categories name to hide, can add multiple Categories by separating with a comma ( , ) </p>
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
                    <input name="ht_ctc_chat_options[showon_posts]" type="checkbox" value="1" <?php checked( $options['showon_posts'], 1 ); ?> id="show_filled-in-box1" />
                    <span>Show on - Posts</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_chat_options[showon_posts]" type="checkbox" value="1" id="show_filled-in-box1" />
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
                    <input name="ht_ctc_chat_options[showon_page]" type="checkbox" value="1" <?php checked( $options['showon_page'], 1 ); ?> id="show_filled-in-box2" />
                    <span>Show on - Pages</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_chat_options[showon_page]" type="checkbox" value="1" id="show_filled-in-box2" />
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
                    <input name="ht_ctc_chat_options[showon_homepage]" type="checkbox" value="1" <?php checked( $options['showon_homepage'], 1 ); ?> id="show_filled-in-box3" />
                    <span>Show on - Home/Front Page</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_chat_options[showon_homepage]" type="checkbox" value="1" id="show_filled-in-box3" />
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
                    <input name="ht_ctc_chat_options[showon_category]" type="checkbox" value="1" <?php checked( $options['showon_category'], 1 ); ?> id="show_filled-in-box5" />
                    <span>Show on - Category</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_chat_options[showon_category]" type="checkbox" value="1" id="show_filled-in-box5" />
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
                    <input name="ht_ctc_chat_options[showon_archive]" type="checkbox" value="1" <?php checked( $options['showon_archive'], 1 ); ?> id="show_filled-in-box6" />
                    <span>Show on - Archive</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_chat_options[showon_archive]" type="checkbox" value="1" id="show_filled-in-box6" />
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
                    <input name="ht_ctc_chat_options[showon_404]" type="checkbox" value="1" <?php checked( $options['showon_404'], 1 ); ?> id="showon_404" />
                    <span>Show on - 404 Page</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_chat_options[showon_404]" type="checkbox" value="1" id="showon_404" />
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
                    <input name="ht_ctc_chat_options[showon_wooproduct]" type="checkbox" value="1" <?php checked( $options['showon_wooproduct'], 1 ); ?> id="showon_wooproduct" />
                    <span>Show on - WooCommerce Single product pages</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p class="ctc_show_hide_display show-hide_display-none showbased">
                <label>
                    <input name="ht_ctc_chat_options[showon_wooproduct]" type="checkbox" value="1" id="showon_wooproduct" />
                    <span>Show on - WooCommerce Single product pages</span>
                </label>
            </p>
            <?php
        }


        ?>
        <p class="description ctc_show_hide_display show-hide_display-none showbased">Check to display Styles based on type of the page</p>
        <?php


        // ID's list to show styles

        ?>
        <div class="row ctc_show_hide_display show-hide_display-none showbased">
            <div class="input-field col s12">
                <input name="ht_ctc_chat_options[list_showon_pages]" value="<?php echo esc_attr( $options['list_showon_pages'] ) ?>" id="ccw_list_id_toshow" type="text" class="input-margin">
                <label for="ccw_list_id_toshow">Id's list to show - add ',' after each id </label>
                <p class="description"> Add Post, Page, Media - ID's to show styles, can add multiple id's by separating with a comma ( , ) </p>
            </div>
        </div>
        <?php


        //  Categorys list - to show

        // $ccw_list_cat_toshow = get_option('ht_ctc_chat_options');

        ?>
        <div class="row ctc_show_hide_display show-hide_display-none showbased">
            <div class="input-field col s12">
                <input name="ht_ctc_chat_options[list_showon_cat]" value="<?php echo esc_attr( $options['list_showon_cat'] ) ?>" id="ccw_list_cat_toshow" type="text" class="input-margin">
                <label for="ccw_list_cat_toshow"><?php _e( 'Category name\'s to Show - add \',\' after each category name' , 'click-to-chat-for-whatsapp' ) ?> </label>
                <p class="description">Add Categories name to show styles, can add multiple Categories by separating with a comma ( , ) </p>
            </div>
        </div>


        <p class="description"><a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/show-hide-styles/">more info</a> </p>
        


        </div>
        </li>
        <ul>
        

        <?php

    }



    function chat_shortcode_cb() {
        ?>
        <p class="description">Shorcodes for Chat: [ht-ctc-chat] - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/shortcodes-chat">more info</a></p>
        <?php
    }





    /**
     * Enable featues .. 
     * 
     */



    public function main_settings_section_cb() {
        ?>
        <!-- <h1>Click to Chat</h1> -->
        <!-- <br> -->
        <h1>Enable features</h1>
        <?php
    }




    // Enable Features
    function ctc_enable_features_cb() {

        $options = get_option('ht_ctc_main_options');

        ?>

        <ul class="collapsible">
        <li>
        <div class="collapsible-header">Enable features ( Chat, Share, Group, others )</div>
        <div class="collapsible-body">

        <?php

        // enable chat
        if ( isset( $options['enable_chat'] ) ) {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_main_options[enable_chat]" type="checkbox" value="1" <?php checked( $options['enable_chat'], 1 ); ?> id="enable_chat" />
                    <span>Enable WhatsApp Chat Features</span>
                </label>
                <!-- <p class="description">  - <a href="<?php echo admin_url( 'admin.php?page=click-to-chat-chat-feature' ); ?>">Chat Settings page</a> </p> -->
            </p>
            <?php
            } else {
                ?>
                <p>
                    <label>
                        <input name="ht_ctc_main_options[enable_chat]" type="checkbox" value="1" id="enable_chat" />
                        <span>Enable WhatsApp Chat Features</span>
                    </label>
                </p>
                <?php
            }
            ?>
            <p class="description">  - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/enable-chat">more info</a> </p>
            <br>
            <?php
    
    
            // enable group
            if ( isset( $options['enable_group'] ) ) {
                ?>
                <p>
                    <label>
                        <input name="ht_ctc_main_options[enable_group]" type="checkbox" value="1" <?php checked( $options['enable_group'], 1 ); ?> id="enable_group" />
                        <span>Enable Group Features</span>
                    </label>
                    <p class="description">  - <a href="<?php echo admin_url( 'admin.php?page=click-to-chat-group-feature' ); ?>">Group Settings page</a> </p>
                </p>
                <?php
                } else {
                    ?>
                    <p>
                        <label>
                            <input name="ht_ctc_main_options[enable_group]" type="checkbox" value="1" id="enable_group" />
                            <span>Enable Group Features</span>
                        </label>
                    </p>
                    <?php
                }
                ?>
                <p class="description">  - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/enable-group">more info</a> </p>
                <br>
                <?php
    
    
                // enable share
                if ( isset( $options['enable_share'] ) ) {
                ?>
                <p>
                    <label>
                        <input name="ht_ctc_main_options[enable_share]" type="checkbox" value="1" <?php checked( $options['enable_share'], 1 ); ?> id="enable_share" />
                        <span>Enable Share Features</span>
                    </label>
                    <p class="description">  - <a href="<?php echo admin_url( 'admin.php?page=click-to-chat-share-feature' ); ?>">Share Settings page</a> </p>
                </p>
                <?php
                } else {
                    ?>
                    <p>
                        <label>
                            <input name="ht_ctc_main_options[enable_share]" type="checkbox" value="1" id="enable_share" />
                            <span>Enable Share Features</span>
                        </label>
                    </p>
                    <?php
                }
                ?>
                <p class="description">  - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/enable-share">more info</a> </p>
                <br>
        <?php

        // Google Analytics
        if ( isset( $options['google_analytics'] ) ) {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_main_options[google_analytics]" type="checkbox" value="1" <?php checked( $options['google_analytics'], 1 ); ?> id="google_analytics" />
                    <span>Google Analytics</span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_main_options[google_analytics]" type="checkbox" value="1" id="google_analytics" />
                    <span>Google Analytics</span>
                </label>
            </p>
            <?php
            }
            ?>
            <p class="description">If Google Analytics installed creates an Event there - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/google-analytics/">more info</a> </p>
            <br>
        <?php



        // Facebook Analytics
        if ( isset( $options['fb_analytics'] ) ) {
            ?>
            <p>
                <label>
                    <input name="ht_ctc_main_options[fb_analytics]" type="checkbox" value="1" <?php checked( $options['fb_analytics'], 1 ); ?> id="fb_analytics" />
                    <span>Facebook Analytics</span>
                </label>
            </p>
            <?php
            } else {
                ?>
                <p>
                    <label>
                        <input name="ht_ctc_main_options[fb_analytics]" type="checkbox" value="1" id="fb_analytics" />
                        <span>Facebook Analytics</span>
                    </label>
                </p>
                <?php
            }
            ?>
            <p class="description"> If Facebook Analytics installed - creates an Event there - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/facebook-analytics/">more info</a> </p>
            <!-- <p class="description"> If Facebook Analytics is depreacted - <a target="_blank" href="https://www.holithemes.com/plugins/click-to-chat/facebook-analytics/">more info</a> </p> -->

            </div>
            </div>
            </li>
            <ul>

            <?php
    }



    // switch interface
    function ht_ctc_switch_cb() {
        $options = get_option('ht_ctc_switch');
        $interface_value = esc_attr( $options['interface'] );
        ?>
        <!-- <br><br><br><br><br><br><br><br> -->
        <ul class="collapsible">
        <li>
        <div class="collapsible-header">Switch Interface</div>
        <div class="collapsible-body">

        <p class="description">If you are convenient with the previous interface in comparison to the new one, please switch to previous interface</p>
        <br><br>
        <div class="row">
            <div class="input-field col s12" style="margin-bottom: 0px;">
                <select name="ht_ctc_switch[interface]" class="select-2">
                    <option value="no" <?php echo $interface_value == 'no' ? 'SELECTED' : ''; ?> >Previous Interface</option>
                    <option value="yes" <?php echo $interface_value == 'yes' ? 'SELECTED' : ''; ?> >New Interface</option>
                </select>
                <label>Switch Interface</label>
            </div>
        <!-- <p class="description">If you are convenient with the previous interface in comparison to the new one, please switch to previous interface</p> -->
        </div>

        </div>
        </div>
        </li>
        <ul>

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

$ht_ctc_admin_main_page = new HT_CTC_Admin_Main_Page();

add_action('admin_menu', array($ht_ctc_admin_main_page, 'menu') );
add_action('admin_init', array($ht_ctc_admin_main_page, 'settings') );

endif; // END class_exists check
