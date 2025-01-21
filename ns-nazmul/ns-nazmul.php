<?php 
/*
Plugin Name: ns nazmul
Plugin URI:  https/www.facebook.com
Description: this is wda student plugin
Version:     1.0.0
Author:      Nazmul Hasan
Author URI:  https/youtube.com
Text Domain: nswda-plugin

*/

class ns_nazmul{

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

    public function define_constance(){
        define('NS_NAZMUL_MAIN_PATH', plugin_dir_path(__FILE__));
        define('NS_NAZMUL_MAIN_URL', plugin_dir_url(__FILE__));
    }

    public function load_classes(){
        require_once NS_NAZMUL_MAIN_PATH . 'includes/query_post.php';

        new ns_plugin\ns_query_post();
    }




}
ns_nazmul::get_instance();