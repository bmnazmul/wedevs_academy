<div class="wrap">
    <h1> Query Post </h1>
    

    <table class="wp-list-table widefat fixed striped table-view-list posts ">
        <thead>
            <tr>
                <th> Title </th>
                <th> Athor </th>
                <th> Categories </th>
                <th> date </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $posts as $post ): ?>
            <tr data-postid=" <?php echo $post->ID; ?>">
                <td><?php echo $post->post_title; ?></td>
                <td>
                    <?php 
                        $user = get_user_by( 'id',$post->post_author);
                        echo $user->display_name;
                    ?>
                </td>
                <td>
                    <?php  
                    $terms = wp_get_post_terms($post->ID,'category');
                    $term_names = array_map( function( $term ){
                        return $term->name;
                    },$terms);
                    echo implode(', ' ,$term_names);
                    ?>
                </td>
                <td><?php echo wp_date('d,F,Y',strtotime($post ->post_date)); ?></td>
            </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>

</div>