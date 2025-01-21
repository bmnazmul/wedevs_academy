<?php

/*

Plugin Name: admin menu
Plugin URI:  https/www.relatedposts.com
Description: This plugin adds a related posts section to your WordPress site, displaying post thumbnails, titles, and short excerpts.
Version:     1.0.0
Author:      Nazmul Hasan
Author URI:  https/www.nazmulhasan.com
Text Domain: nh-Related-Post

*/

class admin_menu{

    private static $instance;

    private function __construct(){

        $this->define_path();
        $this->loaded_classes();
    }

    public static function get_instance(){
        if( self::$instance){
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    private function define_path(){
        define( 'AB_ADMIN_PATH', plugin_dir_path( __FILE__ ));
        define( 'AB_ADMIN_URL', plugin_dir_url( __FILE__ ));
    }

    private function loaded_classes(){
        require_once AB_ADMIN_PATH . 'inclueds/admin.php';

        new ab_hasan\ab_admin();
    }

}

admin_menu::get_instance();