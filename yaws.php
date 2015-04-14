<?php
/*
 * Plugin Name: Yet Another Wordpress Slider
 * Plugin URI:
 * Description:
 * Author URI:
 * Author: Francisco Navarro Gonzalez
 * Version: 0.1-dev
 * Licence:
 *
*/
class Yaws {

    public $panelAdmin;

    function __construct(){
        add_action( 'admin_head', array(&$this, 'enqueue_scripts_admin' ) );
        add_action( 'wp_enqueue_scripts', array(&$this, 'enqueue_scripts'), 999);
        register_activation_hook(__FILE__, array( $this, 'activate' ) );
        register_uninstall_hook(__FILE__, array( __CLASS__, 'uninstall' ) );
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        require_once 'src/YawsAdmin.php';
        $this->panelAdmin = new YawsAdmin();
        add_action('admin_menu',array($this->panelAdmin,"main_page"));
        add_shortcode( 'yaws', array( $this, 'yaws_shortcode' ) );
    }

    public function enqueue_scripts(){
        wp_deregister_script( 'jquery' );
        wp_register_script('jquery',  plugins_url('', __FILE__) .'/js/jquery-2.1.1.min.js');
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'owl-carousel', plugins_url('', __FILE__) . '/js/owl.carousel.min.js', false );
        wp_enqueue_style( 'owlcarouselcss', plugins_url('', __FILE__) . '/css/owl.carousel.css', false );
        wp_enqueue_style( 'owlcarouseltheme', plugins_url('', __FILE__) . '/css/owl.theme.default.min.css', false );
    }
    public function enqueue_scripts_admin(){
        wp_enqueue_script('jquery');
        wp_enqueue_media();
    }

    public function activate(){
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix .'yaws_sliders';
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
          id integer NOT NULL AUTO_INCREMENT,
          name varchar(30) NOT NULL,
          autoplay tinyint(1) DEFAULT 0,
          slidespeed integer,
          items_small tinyint(1) DEFAULT 0,
          items_medium tinyint(1) DEFAULT 0,
          items_long tinyint(1) DEFAULT 0,
          nav_small tinyint(1) DEFAULT 0,
          nav_medium tinyint(1) DEFAULT 0,
          nav_long tinyint(1) DEFAULT 0,
          loopsliders tinyint(1) DEFAULT 0,
          width integer,
          height integer,
          UNIQUE KEY  id (id)
          ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        $table_name = $wpdb->prefix . 'yaws_images';
        $sql = "CREATE TABLE IF NOT EXISTS  $table_name (
          id integer NOT NULL AUTO_INCREMENT,
          slider_id integer NOT NULL,
          name varchar(30) NOT NULL,
          url varchar(255),
          description varchar(255),
        UNIQUE KEY id (id)
        ) $charset_collate;";

        dbDelta( $sql );
    }
    public function deactivate(){
       /* global $wpdb;
        $tables = array();
        $tables[] = $wpdb->prefix.'yaws_sliders';
        $tables[] = $wpdb->prefix.'yaws_images';
        foreach($tables as $table) {
            $wpdb->query("DROP TABLE IF EXISTS $table;");
        }*/
    }

    static public function uninstall(){
        global $wpdb;
        $tables = array();
        $tables[] = $wpdb->prefix.'yaws_sliders';
        $tables[] = $wpdb->prefix.'yaws_images';
        foreach($tables as $table) {
            $wpdb->query("DROP TABLE IF EXISTS $table;");
        }
    }

    public function yaws_shortcode($atts){
        include(plugin_dir_path(__FILE__) . 'views/shortcode.php');
    }


}

global $yaws;
$yaws = new Yaws();
