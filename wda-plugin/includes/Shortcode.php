<?php

namespace AB_Three;

class ns_shortcode{
    public function __construct(){
        add_shortcode( 'enqueue_learn', array( $this, 'enqueue_learn'));
        
    }

    public function enqueue_learn(){
        wp_enqueue_style( 'ab-three-shortcode' );
        ob_start();
        ?>

        <h3 class="ab_three_css"> happy new year 2025</h3>
        <p>
            <img src="<?php echo AB_THREE_ADMIN_URL?>assets/frontend/images/shorcode-imges.jpg" alt="">
        </p>
        <?php
        return ob_get_clean();
    }


}