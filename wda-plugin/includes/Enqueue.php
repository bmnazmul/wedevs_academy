<?php 

namespace AB_Three;

class ns_enqueue{

    public function __construct(){

        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts'));
        add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts'));
        
    }

    public function admin_enqueue_scripts( $screen){
        $my_pages = array( 'options-writing.php', 'options-general.php');

        if( in_array( $screen, $my_pages ) ){
            
            $main_path = AB_THREE_ADMIN_MENU .'assets/admin/main.js';
            wp_enqueue_script( 'ab-three-admin', AB_THREE_ADMIN_URL .'assets/admin/main.js', array( 'jquery' ), filemtime( $main_path ), array( 'in_footer' => true, ) );

            $main_css_path = AB_THREE_ADMIN_MENU .'assets/admin/main.css';
            wp_enqueue_style( 'ab-three-admin', AB_THREE_ADMIN_URL .'assets/admin/main.css', array( ), filemtime( $main_css_path ) );
        }
        
    }

    public function wp_enqueue_scripts(){
        $slug = get_post_field( 'post_name', get_post() );

        if( is_page( 'contact' ) ){
        $main_css_path = AB_THREE_ADMIN_MENU .'assets/frontend/main.css';
        wp_enqueue_style( 'ab-three-admin', AB_THREE_ADMIN_URL .'assets/frontend/main.css', array( ), filemtime( $main_css_path ) );

        $main_path = AB_THREE_ADMIN_MENU .'assets/frontend/main.js';
        wp_enqueue_script( 'ab-three-admin', AB_THREE_ADMIN_URL .'assets/frontend/main.js', array( 'jquery' ), filemtime( $main_path ), array( 'in_footer' => true, ) );

        }
        $shortcode_css = AB_THREE_ADMIN_MENU .'assets/frontend/shortcode.css';
        wp_register_style( 'ab-three-shortcode', AB_THREE_ADMIN_URL .'assets/frontend/shortcode.css', array( ), filemtime( $shortcode_css ) );

        

    }

}