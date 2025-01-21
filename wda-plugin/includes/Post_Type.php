<?php

namespace AB_Three;

class post_type{

    public function __construct(){
        add_action('init', array($this,'init'));

        add_filter('the_content',array($this,'the_content'));

        add_filter( 'manage_posts_columns',array( $this,'manage_posts_columns') );

        add_action('manage_book_posts_custom_column', array( $this , 'manage_book_posts_custom_column'), 10, 2);

        add_filter('manage_edit-book_sortable_columns', array( $this , 'book_sortable_columns'));

        add_action('add_meta_boxes', array( $this, 'add_meta_boxes'));

        add_action('save_post_book', array( $this , 'save_post_book' ));

         if ( file_exists( AB_THREE_ADMIN_MENU . 'lib/CMB2/init.php' ) ) {
            require_once AB_THREE_ADMIN_MENU . 'lib/CMB2/init.php';
        }

        add_action( 'cmb2_admin_init', array( $this, 'cmb2_admin_init' ) );

    }

    public function init(){
        register_post_type('Book', array(
            'labels' => array(
                'name'=> 'Books',
                'singular_name' => 'Book',
                'add_new_item' => 'Add New Book',
                'search_items' => 'Search Books',
                'view_item' => 'View Book',
                'not_found' => 'No Book Found',
            ),
            'public' => true,
            'show_in_rest' => true,
            'supports' => array('title','editor','thumbnail','page-attributes'),
            'hierarchical' => true,
            'menu_position' => 3,
        ));

        register_taxonomy('book_category','book',array(
            'labels' => array(
                'name' => 'Categories',
                'singular_name' => 'Category',
                'add_new_item' => 'Add New Category',
            ),
            'hierarchical' => true,
            'show_in_rest' => true,

        ));

        register_taxonomy('book_tags','book',array(
            'labels' => array(
                'name' => 'tags',
                'singular_name' => 'tag',
                'add_new_item' => 'Add New tag',
            ),
            'hierarchical' => false,
            'show_in_rest' => true,

        ));
    }

     public function the_content( $contents ){
        if(! is_singular( 'book' )){

            return $contents;
        }
        $terms = wp_get_post_terms(get_the_ID(),'book_category');

        $get_metaa = get_post_meta(get_the_ID(),'ns_another_title',true);
        // $get_group = get_post_meta( get_the_ID(), 'another_title_group', true );

        ob_start();
        ?>
            <ul>
                <?php foreach( $terms as $term): ?>
                <li><a href="<?php echo get_term_link($term, 'book_category');?>"><?php echo $term -> name; ?></a></li>
                <?php endforeach;?>
            </ul>
            <h3>This is title: <?php echo $get_metaa ; ?> </h3>

        <?php
        $html = ob_get_clean();

        return $contents . $html;
    }

    public function manage_posts_columns( $columns ){
       
         $new_columns = array();
        
        foreach( $columns as $key => $column){
             var_dump($key);
            if( 'date' == $key){
               $new_columns ['id'] = 'ID'; 
               $new_columns ['Categories'] = 'Categories'; 
               $new_columns ['image'] = 'Image'; 
            }

            $new_columns [ $key ] = $column;

        }

        return $new_columns;
        
    }

    public function manage_book_posts_custom_column($column_name, $post_id){
        if( 'id' === $column_name ){
            echo $post_id;
        }
        
        if( 'Categories' === $column_name ){

            $terms = wp_get_post_terms($post_id, 'book_category');
            
            if( !empty($terms) ){
                $terms_name = array_map(function($term){
                    return $term->name;
                }, $terms);

                echo implode(', ', $terms_name);
            } else {
                echo '—';
            }
        }
        if ( 'image' == $column_name){
            $url = get_the_post_thumbnail_url( $post_id,'thumbnail');

            if( $url ){
              echo ' <img src="'. $url .'"style = "height: 60px; width: 60px; border-radius:8px ">';
            }
        }
    }

    public function book_sortable_columns( $sortable_columns ){

        $sortable_columns ['id'] = 'id';
        $sortable_columns ['Categories'] = 'Categories';

        return $sortable_columns;

    }

// started metabox

    public function add_meta_boxes(){

        add_meta_box(
            'my-custom-metabox',
            'My Custom Metabox',
            array( $this,'my_custom_metabox_callback' ) ,
            'Book',

        );
    }
    
    public function my_custom_metabox_callback( $post ){
        $meta_subtitle = get_post_meta($post->ID, 'meta_subtitle',true );
        ?>
        <p>
            <label for="">add meta data</label>
            <input type="text" name="meta_subtitle" value="<?php echo $meta_subtitle;?>">
        </p>
        
        <?php
    }

    public function save_post_book( $post_id ){
        if( isset ($_POST [ 'meta_subtitle' ] )){
            update_post_meta($post_id, 'meta_subtitle',$_POST [ 'meta_subtitle' ] );
        }
        
    }

    //started cmb2

      public function cmb2_admin_init(){

       $box1 = new_cmb2_box(array(
            'id' => 'ns_custom-cmb2-box',
            'title' => 'custom cmb2 box',
            'object_types' => array( 'book' ),
        ));
        
        $box1->add_field(array(
            'id' => 'ns_another_title',
            'name' => 'another title',
            'desc' => 'enter another title',
            'type' => 'text',
        ));

        $group_field_id = $box1->add_field( array(
            'id' => 'another_title_group',
            'description' => 'Enter Another Title',
            'type' => 'group',
        ));

        $box1->add_group_field($group_field_id, array(
             'id' => 'another_title_second',
            'name' => 'Another Second Title',
            'desc' => 'Enter Second Another Title',
            'type' => 'text',
            'repeatable' => true,
        ));

    }

  


  

   
}


