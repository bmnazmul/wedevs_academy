<?php
/*

Plugin Name: post query control
Plugin URI:  https/www.facebook.com
Description: this is wda student plugin
Version:     1.0.0
Author:      Nazmul Hasan
Author URI:  https/youtube.com
Text Domain: nswda-plugin

*/


class post_query_control{

    private static $instance;

    private function __construct(){
        $this->define_constants();
        $this->load_classes();
        
    }

    public static function get_instance(){
        if(self::$instance){
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    public function define_constants(){
        define('POST_QUERY_CONTROL_PATH', plugin_dir_path( __FILE__ ));
        define('POST_QUERY_CONTROL_URl', plugin_dir_url( __FILE__ ));
    }

    public function load_classes(){
        require_once POST_QUERY_CONTROL_PATH .'includes/query_post.php';

        new AB_Three\ab_query_post;
    }

}
post_query_control::get_instance();