<?php 

/*

Plugin Name: React Admin Panel
Plugin URI:  https/www.relatedposts.com
Description: This plugin adds a related posts section to your WordPress site, displaying post thumbnails, titles, and short excerpts.
Version:     1.0.0
Author:      Nazmul Hasan
Author URI:  https/www.nazmulhasan.com
Text Domain: nh-Related-Post

*/

if( ! defined('ABSPATH')){
        exit;
}

class ns_react{

    private static $instance;

    private function __construct(){
        
        $this->define_path();
        $this->file_load();
    }

    public static function get_instance(){
        if( self::$instance){
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    public function define_path(){
        define( 'NS_REACT_PATH', plugin_dir_path( __FILE__));
        define( 'NS_REACT_URL', plugin_dir_url( __FILE__));
    }

    public function file_load(){
        require_once NS_REACT_PATH . 'includes/react.php';
        require_once NS_REACT_PATH . 'includes/enqueue.php';


        new ns_main\ns_react();
        new ns_main\ns_enqueue();
    }


}

ns_react::get_instance();