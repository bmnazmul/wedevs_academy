<?php

/*

Plugin Name: practice oneee
Plugin URI:  https/www.facebook.com
Description: this is wda student plugin
Version:     1.0.0
Author:      Nazmul Hasan
Author URI:  https/youtube.com
Text Domain: nswda-plugin

*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


class practice_onee{

    private static $instance;

    private function __construct(){

        $this->define_constance();
        $this->load_classes();
        
    }

    public static function get_instance(){
        if( self::$instance ){
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    private function define_constance(){
        define( 'AB_THREE_PRACTICE_MAIN_PATH', plugin_dir_path(__FILE__));
        define( 'AB_THREE_PRACTICE_MAIN_URL', plugin_dir_url(__FILE__));
    }

    private function load_classes(){
        require_once AB_THREE_PRACTICE_MAIN_PATH . 'includes/custom-book.php';
        require_once AB_THREE_PRACTICE_MAIN_PATH . 'includes/custom-cloumn.php';

        new AB_Three_Plugin\ns_book_query();
        new AB_Three\custom_coloumn();
    }


}
practice_onee::get_instance();