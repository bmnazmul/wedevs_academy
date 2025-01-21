<?php
namespace RP_Post;

class nh_post_control{

    public function __construct(){
        add_filter( 'the_content', array( $this, 'ns_the_content'));
        
    }

    public function ns_the_content( $contents ){
            global $post;

            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 5,
                'post__not_in' => array($post->ID),
                'orderby' => 'rand',
                'tax_query' => array(
                    array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => wp_get_post_categories( $post->ID ),   
                )),
            );

            $related_post = new \WP_Query( $args );

            if( $related_post->have_posts() ){
                ob_start();
                ?>
                <div class="related_posts">
                    <h3>Related Posts</h3>
                    <ul>
                        <?php while ($related_post->have_posts()) : $related_post->the_post(); ?>
                            <li>
                                <a href="<?php echo get_permalink(); ?>">
                                <?php echo get_the_post_thumbnail() .'<br />'; ?>
                                <?php echo get_the_title() .'<br />'; ?>
                                <p><?php echo wp_trim_words(get_the_content(), 10, '...'); ?></p>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <?php
                $contents .= ob_get_clean();
            }
        return $contents;
    }

}