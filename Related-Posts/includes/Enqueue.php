<?php
namespace RP_Post;

class Enqueue{

    public function __construct(){
        add_action( 'wp_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
        
    }

    public function admin_enqueue_scripts(){

        wp_enqueue_style( 'ns-post-control', NS_RELATED_URL . 'assets/css/style.css' );
    }
   

}