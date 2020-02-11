<?php
/**
 * new interface starter .. 
 * 
 * Include files - admin - front end 
 * add hooks
 * 
 * added variable to declare other instance if needed 
 * ( in some cases in this plugin, using static methods and calling with out creating instance )
 * 
 * @package CTC
 * @since 2.0
 */


if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC' ) ) :

class HT_CTC {


    /**
     * singleton instance
     *
     * @var HT_CTC 
     */
    private static $instance = null;
    

    /**
     * wp_is_mobile - if true then yes, else no
     *
     * @var if mobile, tab .. then yes, else no
     */
    public $device_type;


    /**
     * instance of HT_CTC_Values
     * 
     * database values , .. . options .. 
     *
     * @var HT_CTC_Values
     */
    public $values = null;


    /**
     * main instance - HT_CTC
     *
     * @return HT_CTC instance
     * @since 1.0
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function __clone() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'click-to-chat-for-whatsapp' ), '1.0' );
    }
    
    public function __wakeup() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'click-to-chat-for-whatsapp' ), '1.0' );
    }



    /**
     * constructor 
     * calling to - includes - which include files
     * calling to - hooks  - which run hooks 
     */
    public function __construct() {
        $this->define_constants();

        $this->basic();

        $this->includes();
        $this->hooks();
    }
    

    

    /**
     * Define Constants
     *
     * @return void
     */
    private function define_constants() {

        $this->define( 'HT_CTC_WP_MIN_VERSION', '4.6' );
        $this->define( 'HT_CTC_PLUGIN_DIR', plugin_dir_path( HT_CTC_PLUGIN_FILE ) );
        $this->define( 'HT_CTC_PLUGIN_BASENAME', plugin_basename( HT_CTC_PLUGIN_FILE ) );
    }




    /**
     * add the basic things
     * 
     * calling this before include, initilize other things
     * 
     * because this things may useful before initilize other things
     * 
     *  e.g. include, initialize files based on device, user settings
     */
    private function basic() {

        include_once HT_CTC_PLUGIN_DIR .'new/inc/commons/class-ht-ctc-ismobile.php';
        include_once HT_CTC_PLUGIN_DIR .'new/inc/commons/class-ht-ctc-values.php';
        
        $this->device_type = new HT_CTC_IsMobile();
        $this->values = new HT_CTC_Values();

    }




    /**
     * @uses this->define_constants
     *
     * @param string $name Constant name
     * @param string.. $value Constant value
     */
    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }



    
    /**
     * include plugin file
     */
    private function includes() {

        // include in admin and front pages
        include_once HT_CTC_PLUGIN_DIR .'new/inc/class-ht-ctc-register.php';

        //  is_admin ? include file to admin area : include files to non-admin area 
        if ( is_admin() ) {
            include_once HT_CTC_PLUGIN_DIR . 'new/admin/admin.php';
        } else {
            
            // main file
            include_once HT_CTC_PLUGIN_DIR . 'new/inc/class-ht-ctc-main.php';
            
            // scripts
            include_once HT_CTC_PLUGIN_DIR . 'new/inc/commons/class-ht-ctc-scripts.php';
            
        }
    }



    /**
     * Register hooks - when plugin activate, deactivate, uninstall
     * commented deactivation, uninstall hook - its not needed as now
     * 
     * plugins_loaded  - Check Diff - uses when plugin updates.
     */
    private function hooks() {

        register_activation_hook( __FILE__, array( 'HT_CTC_Register', 'activate' )  );
        register_deactivation_hook( __FILE__, array( 'HT_CTC_Register', 'deactivate' )  );
        register_uninstall_hook(__FILE__, array( 'HT_CTC_Register', 'uninstall' ) );

        // initilaze classes
        if ( ! is_admin() ) {
            add_action( 'init', array( $this, 'init' ), 0 );
        }

        // enable shortcodes in widget area.
        add_filter('widget_text', 'do_shortcode');
        
        // add_filter( 'the_excerpt', 'do_shortcode');

        // settings page link
        add_filter( 'plugin_action_links_' . HT_CTC_PLUGIN_BASENAME, array( 'HT_CTC_Register', 'plugin_action_links' ) );

        // when plugin updated - check version diff
        add_action('plugins_loaded', array( 'HT_CTC_Register', 'version_check' ) );

    }




    /**
     * create instance
     * @uses this->hooks() - using init hook - priority 0
     */
    public function init() {
        
        // $this->values = new HT_CTC_Values();

        // $this->device_type = new HT_CTC_IsMobile();

        // $this->floating_style = new HT_CTC_Floating_Style();
        // $this->floating_style = new HT_CTC_Chat();

    }



}

endif; // END class_exists check