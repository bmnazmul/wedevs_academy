<?php 

/*

Plugin Name: Related-Posts
Plugin URI:  https/www.relatedposts.com
Description: This plugin adds a related posts section to your WordPress site, displaying post thumbnails, titles, and short excerpts.
Version:     1.0.0
Author:      Nazmul Hasan
Author URI:  https/www.nazmulhasan.com
Text Domain: nh-Related-Post

*/
class nh_related_posts{

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
        define( 'NS_RELATED_PATH', plugin_dir_path(__FILE__));
        define( 'NS_RELATED_URL', plugin_dir_url(__FILE__));
    }

    public function load_classes(){
        require_once NS_RELATED_PATH . 'includes/posts_control.php';
        require_once NS_RELATED_PATH . 'includes/Enqueue.php';

        new RP_Post\nh_post_control();
        new RP_Post\Enqueue();
    }

}
nh_related_posts::get_instance();