<?php 
/*

Plugin Name: Ajax
Plugin URI:  https/www.relatedposts.com
Description: This plugin adds a related posts section to your WordPress site, displaying post thumbnails, titles, and short excerpts.
Version:     1.0.0
Author:      Nazmul Hasan
Author URI:  https/www.nazmulhasan.com
Text Domain: nh-Related-Post

*/

if( ! defined ('ABSPATH') ){
    exit;
}

class ns_ajax{
    
    private static $instance;

    private function __construct(){
        
        $this->define_path();
        $this->load_classes();
    }

    public static function get_instance(){
        if( self::$instance){
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    private function define_path(){
        define('AB_THREE_AJAX_PATH', plugin_dir_path( __FILE__));
        define('AB_THREE_AJAX_URL', plugin_dir_url( __FILE__));
    }

    private function load_classes(){
        require_once AB_THREE_AJAX_PATH . 'includes/ajax_main.php';

        new ns_ajx\nb_ajax; 

    }

}
ns_ajax::get_instance();