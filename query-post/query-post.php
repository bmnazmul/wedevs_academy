<?php 

/*
 * Plugin Name:       My Query Post
 * Plugin URI:        https:querypost.com
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Nazmul Hasan
 * Author URI:        https://nazmulhasan.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       ns-query-post-plugin
 */


 class ns_query_post{

    private static $instance;

    private function __construct(){

        $this -> define_constance();
        $this -> load_classes();
        
    }
    public static function get_instance(){

        if(self::$instance ){
            return self::$instance;
        }
        self::$instance = new self();
            return self::$instance;
    }

    public function define_constance(){
        define( 'NS_QUERY_POST_MAIN_PATH', plugin_dir_path(__FILE__));
        define( 'NS_QUERY_POST_MAIN_URL', plugin_dir_url(__FILE__));

    }

    public function load_classes(){
        require_once NS_QUERY_POST_MAIN_PATH .'includes/book.php';

        new NS_Qiery\ns_book();
    }

 }

 ns_query_post::get_instance();