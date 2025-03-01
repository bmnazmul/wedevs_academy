<?php 

namespace AB_Three;

class custom_column{

    public function __construct(){

        add_filter( 'manage_page_posts_columns',array( $this,'manage_page_posts_columns') );

        add_action('manage_page_posts_custom_column', array( $this , 'manage_page_posts_custom_column'), 10, 2);

        add_filter('manage_edit-page_sortable_columns', array( $this , 'page_sortable_columns'));

    }

    public function manage_page_posts_columns( $columns ){
       
        $new_columns = array();
        
        foreach( $columns as $key => $column){
             var_dump($key);
            if( 'author' == $key){
               $new_columns ['id'] = 'ID'; 
               $new_columns ['image'] = 'Image'; 
            }
            
            $new_columns [ $key ] = $column;
        }

        return $new_columns;
    }
    
    public function manage_page_posts_custom_column( $column_name , $post_id ){
        if( 'id' ==$column_name ){
            echo $post_id;
        }

        if ( 'image' == $column_name){
            $url = get_the_post_thumbnail_url( $post_id,'thumbnail');

            if( $url ){
              echo ' <img src="'. $url .'"style = "height: 60px; width: 60px; border-radius:8px ">';
            }
        }
      


    }

    public function page_sortable_columns( $sortable_columns ){

        $sortable_columns ['id'] = 'id';

        return $sortable_columns;

    }
 
}