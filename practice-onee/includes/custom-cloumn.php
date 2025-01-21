<?php

namespace AB_Three;

class custom_coloumn{
    public function __construct(){
        add_filter( 'manage_page_posts_columns', array( $this, 'manage_page_posts_columns'));
        add_action( 'manage_page_posts_custom_column', array( $this, 'manage_page_posts_custom_column'),10,2 );

        add_filter( 'manage_edit-page_sortable_columns', array( $this, 'page_sortable_columns'));
        
    }

    public function manage_page_posts_columns( $columns ){

        $new_column = array( );
        foreach( $columns as $key=>$column ){

            if( 'title'==$key){
                $new_column['id'] = 'ID';
                $new_column['image'] = 'Image';
            }
            
            $new_column[ $key ] = $column;
        }
        return $new_column;

    }

    public function manage_page_posts_custom_column( $column_name, $post_id ){

        if( 'id' == $column_name ){
            echo $post_id;
        }

        if( 'image' == $column_name ){
            $url = get_the_post_thumbnail_url ( $post_id, 'thumbnail');
            if( $url ){
             echo '<img src="' . $url . '" style=" widht:70px; height:70px; border-radius:8px">';
            }
        }

        

    }

    public function page_sortable_columns( $sortable_columns ){

        $sortable_columns['id'] = 'id';

        return $sortable_columns;

    }

}