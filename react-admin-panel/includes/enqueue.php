<?php 
namespace ns_main;

class ns_enqueue{

    public function __construct(){

        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts'));
        
    }

    public function admin_enqueue_scripts( $screen ){
        if( 'toplevel_page_react_admin_settings' == $screen ){

            $main_asset = require NS_REACT_PATH . 'assets/build/main.asset.php';

            wp_enqueue_script( 'react-setting', NS_REACT_URL. 'assets/build/main.js', $main_asset['dependencies'], $main_asset['version'],array('in_footer' => true,) );

        }
    }

}