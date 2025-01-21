<?php 
namespace ns_plugin;

class ns_query_post{

    public function __construct(){
        add_action( 'admin_menu', array( $this, 'admin_menu'));
    }

    public function admin_menu(){
        add_menu_page(
            'book',
            'book',
            'manage_options',
            'book_slug',
            array( $this, 'book_callback'),
        );
    }

    public function book_callback(){
        $filter_cat = 0;

        if( isset($_GET['filter_cat'])){
            $filter_cat =$_GET['filter_cat'];
        }

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
        );
        
        if( !empty( $filter_cat )){
            $args['cat'] = $filter_cat;
        }

        $posts = get_posts( $args );

        $terms = get_terms( array(
            'taxonomy' => 'category',
        ));

        include_once NS_NAZMUL_MAIN_PATH . 'includes/template/book.php';
    }

}