<?php

namespace AB_Three;

class ns_islamic{

    public function __construct(){
        add_action( 'init', array( $this, 'init'));

        if ( file_exists( AB_THREE_ADMIN_MENU . 'lib/CMB2/init.php' ) ) {
        require_once AB_THREE_ADMIN_MENU . 'lib/CMB2/init.php';}

        add_action( 'cmb2_admin_init', array( $this, 'cmb2_admin_init' ) );
        add_filter( 'the_content', array( $this, 'quran_the_content' ) );
        add_filter( 'the_content', array( $this, 'surah_the_content' ) );
        
    }

    public function init(){
        register_post_type('quran', array(
            'labels' => array(
                'name'=> 'quran',
                'singular_name' => 'quran',
            ),
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => true,
        ));

        register_post_type('surah', array(
            'labels' => array(
                'name'=> 'surahs',
                'singular_name' => 'surah',
            ),
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => true,
        ));
    }

    public function cmb2_admin_init(){
        $Quran_metabox = new_cmb2_box( array(
            'id' => 'quran-setting-box',
            'title' => 'quran Settings',
            'object_types' => array( 'surah' ),
        ));

        $quran_query = get_posts( array(
            'post_type' => 'quran',
            'post_per_page' => -1,
        ));

        $quran_option = array();

        foreach( $quran_query as $quran_data){
            $quran_option[ $quran_data->ID] = $quran_data->post_title;
        }

         $Quran_metabox -> add_field( array(
            'id' => '_quran_id',
            'name' => 'Select Surah',
            'desc' => 'Choose The Surah',
            'type' => 'select',
            'options' => $quran_option,
         ));
    }

    public function quran_the_content( $contents ){
        global $post;
        if( $post->post_type =!'quran'){
            return $contents;
        }

        $surahs = get_posts( array(
            'post_type' => 'surah',
            'post_per_page' => -1,
            'meta_key' => '_quran_id',
            'meta_value' => $post->ID,
        ));

        ob_start();
        ?>
        <ul>
            <?php foreach($surahs as $surah ) :?>
            <li><a href="<?php the_permalink($surah->ID);?>"><?php echo $surah->post_title;?></a></li>
            <?php endforeach; ?>
        </ul>

        <?php 
        $contents .= ob_get_clean();

        return $contents;
    }

    public function surah_the_content( $contents ){

        global $post;
        if( $post->post_type =!'surha'){
            return $contents;
        }
        $quran_id = get_post_meta( $post->ID, '_quran_id', true );

        $quran = get_post( $quran_id );

        $contents .= '<p> Surah Name:<a href="' . get_the_permalink( $quran ) . '">' . $quran->post_title . '</a></p>';

        return $contents;
    }


}