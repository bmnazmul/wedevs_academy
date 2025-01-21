

function ns_content_call_b_fuc( $content ){

       $qr_show = apply_filters('ns_content_qr_show',true);

       if( ! $qr_show){
        return $content;
       }


    $url = get_the_permalink();

    $image=' <p><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='. $url .'"> </p>' ;

    $content .= $image;

    return $content;
}

    public function wp_footer(){

        $url = home_url();

        $image=' <p><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='. $url .'"> </p>' ;

        echo  $image;

        do_action('foooter_before');

    }
