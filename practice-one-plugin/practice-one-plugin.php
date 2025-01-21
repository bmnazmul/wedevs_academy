<?php
/*
Plugin Name: practice-one-plugin
Plugin URI:  https/www.facebook.com
Description: this is wda student plugin
Version:     1.0.0
Author:      Nazmul Hasan
Author URI:  https/youtube.com
Text Domain: nsl-plugin
*/


class practice_plugin{

    private static $instance;

    private function __construct(){

        $this -> define_constants();
        $this -> load_classes();
        
    }

    public static function get_instance(){
        if( self::$instance ){
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    public function define_constants(){
        define( 'AB_THREE_ADMIN_PATH', plugin_dir_path(__FILE__) );
        define( 'AB_THREE_ADMIN_URL', plugin_dir_url(__FILE__) );
    }

    public function load_classes(){
        require_once AB_THREE_ADMIN_PATH. 'includes\enqueue.php';


        new nh_practice\enqueue();
    }

}

practice_plugin::get_instance();