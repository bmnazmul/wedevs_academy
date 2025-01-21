<?php

/*

Plugin Name: wda plugin
Plugin URI:  https/www.facebook.com
Description: this is wda student plugin
Version:     1.0.0
Author:      Nazmul Hasan
Author URI:  https/youtube.com
Text Domain: nswda-plugin

*/

class Academy_class_three{

    private static $instance;

    private function __construct(){
        // add_filter('the_content',array($this,'ns_content_call_b_fuc'));
        // add_action('wp_footer',array($this,'wp_footer'));


        $this -> define_constants();
        $this -> load_classes();

    }

    public static function get_instance(){

        if(self::$instance){
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    
    private function define_constants(){

        define('AB_THREE_ADMIN_MENU', plugin_dir_path( __FILE__ ));
        define('AB_THREE_ADMIN_URL', plugin_dir_url( __FILE__ ));
    }


    private function load_classes(){

        require_once AB_THREE_ADMIN_MENU . 'includes/Admin_Menu.php';
        require_once AB_THREE_ADMIN_MENU . 'includes/Custom_Column.php';
        require_once AB_THREE_ADMIN_MENU . 'includes/Post_Type.php';
        require_once AB_THREE_ADMIN_MENU . 'includes/Book_Reader.php';
        require_once AB_THREE_ADMIN_MENU . 'includes/Islamic_Book.php';
        require_once AB_THREE_ADMIN_MENU . 'includes/Enqueue.php';
        require_once AB_THREE_ADMIN_MENU . 'includes/Shortcode.php';

        // new AB_Three_Admin_Menu();
        // new AB_Three\custom_column();
        // new AB_Three\Post_Type();
        new AB_Three\Book_Reader();    
        new AB_Three\ns_islamic();    
        new AB_Three\ns_enqueue();    
        new AB_Three\ns_shortcode();    
    }


}

Academy_class_three::get_instance( );




