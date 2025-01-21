<?php 
namespace NS_Qiery;

class ns_book{


    public function __construct(){

        add_action( 'admin_menu', array( $this, 'admin_menu'));
        
    }

    public function admin_menu(){
        add_menu_page(
            'book',
            'book',
            'administrator',
            'book_slug',
            array( $this, 'book_callback'),
        );
    }

    public function book_callback(){

        $posts = get_posts( array(
            'post_type' => 'post',
            'posts_per_page' => 10,
        ));
        include NS_QUERY_POST_MAIN_PATH . 'includes/template/book-query.php';
    }

}