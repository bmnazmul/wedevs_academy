<?php
namespace nh_practice;

class enqueue{
    
    public function __construct(){

        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts'));
        add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts'));
        
    }

    public function admin_enqueue_scripts( $screen ){
        $my_page = array('options-discussion.php', 'options-reading.php');
        if( in_array( $screen, $my_page)){
            $main_js = AB_THREE_ADMIN_PATH. 'assets/admin/main.js';

            wp_enqueue_script( 'ab_practice', AB_THREE_ADMIN_URL. 'assets/admin/main.js', array( 'jquery' ), filemtime( $main_js ));
            
            $mian_css = AB_THREE_ADMIN_PATH. 'assets/admin/main.css';
            wp_enqueue_style( 'ab-practice', AB_THREE_ADMIN_URL. 'assets/admin/main.css', array( ), filemtime( $mian_css ) );
        }
    }

    public function wp_enqueue_scripts(){
        $slug = get_post_field( 'post_name', get_post() );
        if( 'contact'==$slug){
            $main_js = AB_THREE_ADMIN_PATH. 'assets/frontend/main.js';
            wp_enqueue_script( 'ab_practice', AB_THREE_ADMIN_URL. 'assets/frontend/main.js', array( 'jquery'), filemtime($main_js),  );

            $main_css = AB_THREE_ADMIN_PATH. 'assets/frontend/main.css';
            wp_enqueue_style( 'ab_practice', AB_THREE_ADMIN_URL. 'assets/frontend/main.css', array( ), filemtime($main_css));

        }

        
    }

}