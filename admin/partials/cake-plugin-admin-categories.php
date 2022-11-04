<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://businesslabs.org
 * @since      1.0.0
 *
 * @package    Cake_Plugin
 * @subpackage Cake_Plugin/admin/partials
 */

if (isset($_POST['category_name'])) {
    $result = wp_remote_post(get_option('cake_api_host').'category', array(
      'method' => 'POST',
      'headers' => array('Authorization' => 'Bearer '.get_option('cake_api_key')),
      'body' => array(
        'category' => $_POST['category_name']
      )
    ));
}

if (isset($_POST['delete_category'])) {
    $result =  wp_remote_request(
        get_option('cake_api_host').'category/'.$_POST['delete_category'], 
        array(
            'method'      => 'DELETE',
            'headers'     => ["Authorization" => 'Bearer '.get_option('cake_api_key')],
        )
    );
}

$get_categories = wp_remote_get( get_option('cake_api_host').'category',
    array(
        'timeout' => 10,
        'headers' => array(
            'Authorization' => 'Bearer '.get_option('cake_api_key')
        )
    )
 );


if (! isset($get_categories->errors)) {
    $categories = json_decode($get_categories['body']);
} else {
    echo '<div class="alert alert-danger" role="alert">
            Something went wront, please check plugin settings.
        </div>';
    $categories = array();
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->



<section>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-5 ">
                    <h2 class=" mb-5 mt-5">Add Categories</h2>
                    <form method="post" action="">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name </label>
                            <input type="text" class="form-control" id="category_name" aria-describedby="category" placeholder="Category" name="category_name">
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
                <div class="col-md-5 offset-md-1">
                    <h2 class=" mb-5 mt-5">All Categories</h2>
                    <table class="table table-bordered">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?php echo $category->id ?></td>
                                <td><?php echo $category->category ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="delete_category" value="<?php echo $category->id ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>