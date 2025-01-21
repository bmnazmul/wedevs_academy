<?php 

namespace AB_Three;

class Book_Reader{

    public function __construct(){
        add_action('init', array( $this, 'init'));

        if ( file_exists( AB_THREE_ADMIN_MENU . 'lib/CMB2/init.php' ) ) {
        require_once AB_THREE_ADMIN_MENU . 'lib/CMB2/init.php';
        }

        add_action( 'cmb2_admin_init', array( $this, 'cmb2_admin_init' ) );
        add_filter( 'the_content', array( $this, 'movie_the_content' ) );
        add_filter( 'the_content', array( $this, 'chapter_the_content' ) );
    }

    public function init(){
         register_post_type('movie', array(
            'labels' => array(
                'name'=> 'movies',
                'singular_name' => 'Movie',
            ),
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => true,
        ));

         register_post_type('chapter', array(
            'labels' => array(
                'name'=> 'chapters',
                'singular_name' => 'chapter',
            ),
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => true,
        ));
    }

    public function cmb2_admin_init(){
        $movie_metabox = new_cmb2_box( array(
            'id' => 'movie-setting-box',
            'title' => 'Movie Settings',
            'object_types' => array( 'chapter' ),
        ));

        $movie_query = get_posts( array(
            'post_type' => 'movie',
            'posts_per_page' => -1,
        ));

        $movies_option = array();

        foreach( $movie_query as $movie_data){
            $movies_option[ $movie_data ->ID ] = $movie_data->post_title;
        }

         $movie_metabox -> add_field( array(
            'id' => '_movie_id',
            'name' => 'Select Movie',
            'desc' => 'Choose The Movie',
            'type' => 'select',
            'options' => $movies_option,
         ));
    }

    public function movie_the_content( $contents ){

        global $post;
        if( $post->post_type !='movie' ){

            return $contents;
        }

        $chapters = get_posts( array(
            'post_type' => 'chapter',
            'posts_per_page' => -1,
            'meta_key' => '_movie_id',
            'meta_value' => $post->ID,
        ));

        ob_start();
        ?>
        <ul>
            <?php foreach( $chapters as $chapter ) : ?>
            <li><a href="<?php the_permalink($chapter->ID) ;  ?>"><?php echo $chapter->post_title;  ?></a></li>
            <?php endforeach; ?>
        </ul>    

        <?php
        $contents .= ob_get_clean();

        return $contents;
    }

      public function chapter_the_content( $contents ) {
        global $post;

        if ( $post->post_type != 'chapter' ) {
            return $contents;
        }

        $book_id = get_post_meta( $post->ID, '_movie_id', true );

        $book = get_post( $book_id );

        $contents .= '<p>Book Name: <a href="' . get_the_permalink( $book ) . '">' . $book->post_title . '</a></p>';

        return $contents;
    }

}