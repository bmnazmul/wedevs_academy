<?php 
namespace AB_Three;

class ab_query_post{

    public function __construct(){
        add_action( 'admin_menu', array( $this, 'admin_menu'));
    }

    public function admin_menu(){
        add_menu_page(
            'post control',
            'post control',
            'manage_options',
            'post_control',
            array( $this, 'post_control_callback')
        );
    }
    public function post_control_callback(){
            $Filter_cat = 0;

            if( isset( $_GET['Filter_cat'])){
                $Filter_cat = $_GET['Filter_cat'];
            }

            $args = array(
                 'post_type' => 'post',
                 'posts_per_page' => 10,
            );
            if( !empty( $Filter_cat)){
                $args ['cat'] =$Filter_cat;
            }

            $posts = get_posts( $args );

            $terms = get_terms( array(
                'taxonomy' => 'category',
            ));
           

        include_once POST_QUERY_CONTROL_PATH. 'includes/template/queryy.php';
    }

}