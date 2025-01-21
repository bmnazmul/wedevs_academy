<?php 

namespace ab_hasan;

class ab_admin{

    public function __construct(){
        add_action( 'admin_menu', array( $this, 'admin_menu'));
    }

    public function admin_menu(){
        add_menu_page(
            'admin settings',
            'admin settings',
            'manage_options',
            'admin_slug',
            array( $this, 'admin_callbaack'),
         'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="#fff"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 64c0-17.7 14.3-32 32-32l320 0 64 0c70.7 0 128 57.3 128 128s-57.3 128-128 128l-32 0c0 53-43 96-96 96l-192 0c-53 0-96-43-96-96L96 64zM480 224l32 0c35.3 0 64-28.7 64-64s-28.7-64-64-64l-32 0 0 128zM32 416l512 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 480c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg>'),
         3,
        );

        add_submenu_page(
            'admin_slug',
            'sub menu',
            'sub menu',
            'manage_options',
            'ab_sub_menu',
            array( $this, 'sub_menu_callback'),
        );
    }

    public function admin_callbaack(){
        $get_page = filter_input( INPUT_GET, 'page');
        // var_dump($get_page);
        //check the form submited.
        if( isset( $_POST['submit'] ) ){
            //nonce verify.
            if( ! wp_verify_nonce( $_POST['ns_nonce'], 'ab_three')){
                echo "you are not valid";
                return;
            }

            $ns_title = isset( $_POST['ns_title'] ) ? sanitize_text_field( $_POST['ns_title'] ):'';
            $ns_email = isset( $_POST['ns_email'] ) ? sanitize_text_field( $_POST['ns_email'] ):'';
            $ns_option = isset( $_POST['ns_option'] ) ? sanitize_text_field( $_POST['ns_option'] ):'';

            $post_array = array(
                'ns_title' =>  $ns_title,
                'ns_email' =>  $ns_email,
                'ns_option' =>  $ns_option,
            );

            update_option( 'ns_title',  $post_array );

        }
            $settings_data = get_option( 'ns_title', array() );

            $ns_option = isset( $settings_data['ns_option'] ) ? $settings_data['ns_option']: '1';
        ?>
            <div class="wrap">
                <h1>Admin Settings</h1>

                <form action=" <?php echo esc_url( admin_url() ); ?>admin.php?page=admin_slug" method="post">
                    <input type="hidden" name="ns_nonce" value="<?php echo wp_create_nonce( 'ab_three' ); ?>">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th>
                                    <label>Title</label>
                                </th>
                                <td>
                                    <input type="text" class="regular-text" name="ns_title" value=" <?php echo isset( $settings_data['ns_title'] ) ? esc_attr( wp_unslash($settings_data['ns_title'] ) ): '';  ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label>Email</label>
                                </th>
                                <td>
                                    <input type="text" class="regular-text" name="ns_email" value=" <?php echo isset( $settings_data['ns_email'] ) ? esc_attr( wp_unslash($settings_data['ns_email'] ) ): '';  ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label>Choose One</label>
                                </th>
                                <td>
                                    <select name="ns_option">
                                        <option value="1"<?php echo $ns_option =='1' ? 'selected': ''; ?>>1</option>
                                        <option value="2"<?php echo $ns_option =='2' ? 'selected': ''; ?>>2</option>
                                        <option value="3"<?php echo $ns_option =='3' ? 'selected': ''; ?>>3</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
                    </p>
                </form>
            </div>
        <?php
    }

    public function sub_menu_callback(){
        ?>
            this is sub menu
        <?php
    }
}