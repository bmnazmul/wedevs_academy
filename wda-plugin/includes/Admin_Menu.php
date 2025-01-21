<?php 


class AB_Three_Admin_Menu{
    

        public function __construct(){
            add_action('admin_menu',array($this,'admin_menu'));
        }

        public function admin_menu(){

            add_menu_page(
                    
                    'Query post',
                    'Query post',
                    'administrator',
                    'ab_query_post',
                     array($this,'ab_query_callback')
            );

        }

        public function ab_query_callback(){

            $filter_cat = 0;

            if( isset($_GET['filter_cat'] ) ){
                $filter_cat = $_GET['filter_cat'];
            }

            $args = array(
                'post_type'=> 'post',
                'posts_per_page' => 10,
                'cat' => $filter_cat,
            );

             if ( ! empty( $filter_cat ) ) {
                 $args['cat'] = $filter_cat;
             }

           $posts = get_posts( $args );

           $terms = get_terms(array(
                'taxonomy' => 'category',
           ));

            include AB_THREE_ADMIN_MENU . 'includes/templates/query-post.php';

        }


}