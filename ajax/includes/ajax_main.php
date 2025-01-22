<?php 

namespace ns_ajx;

class nb_ajax{

    public function __construct(){

        add_shortcode( 'simple-path', array( $this, 'render_shortcode'));

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts'));

        //login and profile update
        add_action( 'wp_ajax_simple-auth-profile-form', array( $this, 'update_profile'));
        add_action( 'wp_ajax_nopriv_simple-auth-login-form', [$this, 'handle_login'] );
        
    }

    public function enqueue_scripts(){
        wp_enqueue_style( 'simple-auth-style', AB_THREE_AJAX_URL. 'assets/css/auth.css');

        wp_enqueue_script( 'simple-auth-js', AB_THREE_AJAX_URL. 'assets/js/auth.js', array( 'jquery', 'wp-util') );

        wp_localize_script( 'simple-auth-js','simpleAuthAjax', array(
            'ajax_url' => admin_url( 'admin-ajax.php'),
            'nonce' => wp_create_nonce( 'simple-auth-profile'),

        ) );
    }

    public function render_shortcode(){
        if( is_user_logged_in() ){
            return $this->render_profile_page();
        }else{
            return $this->render_auth_page();
        }
    }

    public function update_profile(){
        if( ! wp_verify_nonce( $_POST['_wpnonce'],'simple-auth-profile') ){
            return wp_send_json_error(
                array(
                    'mesaage' => 'Nonce Varification Faild'
                )
                );
        }

        $display_name = sanitize_text_field( $_POST['display_name']);
        $email = sanitize_email( $_POST['email']);

        wp_update_user( array(
            'ID' => get_current_user_id(),
            'display_name' => $display_name,
            'user_email' => $email

        ));


        wp_send_json_success( array(
            'message' => 'profile update',
        ));
    }

    public function render_profile_page(){
        $user = wp_get_current_user();
        
        ob_start();
        ?>
        <div id="simple-auth-profile">
            <h2> Update Profile</h2>
            <div id="profile-update-mesasage" class="success-message hidden"> </div>
            <form method="post" id="profile-form">
                <label>
                    Display Name
                    <input type="text" name="display_name" required value="<?php echo esc_attr( $user->display_name ); ?>" />
                </label>

                <label>
                    Email
                    <input type="email" name="email" required value="<?php echo esc_attr( $user->user_email ); ?>" />
                </label>
                <input type="hidden" name="action" value="simple-auth-profile-form">
                <button type="submit">Update Profile</button>
            </form>
        </div>

        <?php
        return ob_get_clean();
    }

    public function handle_login(){

        check_ajax_referer('simple-auth-login');

        $username = sanitize_text_field( $_POST['username']);
        $password = sanitize_text_field( $_POST['password']);

        $user = wp_signon( array(
            'user_login' => $username,
            'user_password' => $password,
            'remember' => true,
        ));
        
        if( is_wp_error($user)){
            wp_send_json_error( array(
                'message' =>$user->get_error_message(),
            ));
        }

        wp_send_json_success( array(
            'message' => 'login success.Redirecting',
        ));
    }

    public function render_auth_page(){
         $user = wp_get_current_user();
        
        ob_start();
        ?>
        <div id="simple-auth-profile">
            <h2>Login</h2>

            <div id="login-message" class="hidden"></div>

            <form method="post" id="simple-auth-login-form">
                <label>
                    Username
                    <input type="text" name="username" required value="" placeholder="Username" />
                </label>

                <label>
                    Password
                    <input type="password" name="password" required value="" placeholder="Password" />
                </label>

                <input type="hidden" name="action" value="simple-auth-login-form" />

                <?php wp_nonce_field( 'simple-auth-login' ); ?>

                <button type="submit">Login</button>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }


}
