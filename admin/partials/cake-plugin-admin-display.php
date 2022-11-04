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
if (isset($_POST['delete_product'])) {
    $result =  wp_remote_request(
        get_option('cake_api_host').'product/'.$_POST['delete_product'], 
        array(
            'method'      => 'DELETE',
            'headers'     => ["Authorization" => 'Bearer '.get_option('cake_api_key')],
        )
    );
}

if (isset($_POST['product_id'])) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => get_option('cake_api_host').'product/'.$_POST['product_id'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => http_build_query(array(
            'name' => $_POST['product_name'],
            'category_id' => $_POST['product_category'],
            'quantity' => $_POST['product_quantity'],
            'description' => $_POST['product_description'],
            'price' => $_POST['product_price'],
            'sku' => $_POST['product_sku'],
            'total_review' => $_POST['product_total_reviews'],
            'total_ratting' => $_POST['product_total_ratings']
        )),
        CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Authorization: Bearer '.get_option('cake_api_key')
        ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);
    curl_close($curl);
    $success = false;
    if (isset($response->status)) {
        if ($response->status == 1) {
            $success = true;
        }
    }

    if (! $success) {
        ?>
            <div class="alert alert-danger mt-2" role="alert">
                Something went wrong
            </div>
        <?php

    } else {
        ?>
            <div class="alert alert-success mt-2" role="alert">
                Product added successfully. </a>
            </div>
        <?php
    }

}

$get_products = wp_remote_get( get_option('cake_api_host').'product',
    array(
        'timeout' => 10,
        'headers' => array(
            'Authorization' => 'Bearer '.get_option('cake_api_key')
        )
    )
 );



if (! isset($get_products->errors)) {
    $get_products_array = json_decode($get_products['body']);
    $products = $get_products_array->data;
} else {
    echo '<div class="alert alert-danger" role="alert">
            Something went wront, please check plugin settings.
        </div>';
    $products = array();
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<?php if (isset($_POST['edit_product'])): ?>

    <?php 
        $get_the_product = wp_remote_get( get_option('cake_api_host').'product/'.$_POST['edit_product'],
            array(
                'timeout' => 10,
                'headers' => array(
                    'Authorization' => 'Bearer '.get_option('cake_api_key')
                )
            )
         );
        $response_array = json_decode($get_the_product['body']);
        $product = $response_array->data;

        $get_categories = wp_remote_get(get_option('cake_api_host').'category',
            array(
                'timeout' => 10,
                'headers' => array(
                    'Authorization' => 'Bearer '.get_option('cake_api_key')
                )
            )

         );
        $categories = json_decode($get_categories['body']);
     ?>
    <section>
        <div class="row">
            <div class="col-md-10 offset-md-1">

                <h2 class="mb-5 mt-5">Add Product</h2>
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $product->id ?>">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" required value="<?php echo $product->name ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price" required value="<?php echo $product->price ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_category">Product Category</label>
                        <select class="form-control" id="product_category" name="product_category" required>
                            <option hidden selected disabled>~ Choose Categories ~</option>
                            <?php foreach ($categories as $category): ?>
                                <option <?php echo ($category->id == $product->category_id->id) ? 'selected': "" ?> value="<?php echo $category->id ?>"><?php echo $category->category ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_quantity">Product Quantity</label>
                        <input type="number" class="form-control" id="product_quantity" name="product_quantity" placeholder="Enter Product Quantity" required value="<?php echo $product->quantity ?>"> 
                    </div>

                    <div class="form-group" id="sku">
                        <label for="product_sku">Product SKU</label>
                        <input type="text" class="form-control" id="product_sku" name="product_sku" placeholder="Enter Product SKU" required  value="<?php echo $product->sku ?>">
                    </div>
                    <div class="form-group" id="total_reviews">
                        <label for="product_total_reviews">Product Total Reviews</label>
                        <input type="number" class="form-control" id="product_total_reviews" name="product_total_reviews" placeholder="Enter Product Total Reviews"  value="<?php echo $product->reviews ?>">
                    </div>
                    <div class="form-group" id="total_ratings">
                        <label for="product_total_ratings">Product Total Ratings</label>
                        <input type="number" class="form-control" id="product_total_ratings" name="product_total_ratings" placeholder="Enter Product Total Ratings"  value="<?php echo $product->ratings ?>">
                    </div>

                    <div class="form-group" id="total_ratings">
                        <label for="product_description">Product Description</label>
                        <textarea type="number" rows="7" class="form-control" id="product_description" name="product_description" placeholder="Write product Description here"><?php echo $product->description ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
    
<?php endif ?>


<?php if (! isset($_POST['edit_product'])): ?>
    <section>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class=" mb-5 mt-5">Products</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Sku</th>
                        <th>Images</th>
                        <th>Actions</th>
                    </tr>

                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product->name ?></td>
                            <td><?php echo $product->price ?></td>
                            <td><?php echo $product->category_id->category ?? "" ?></td>
                            <td><?php echo $product->quantity ?></td>
                            <td><?php echo wp_trim_words($product->description, 20, '...') ?></td>
                            <td><?php echo $product->sku ?></td>
                            <td><?php echo $product->image ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="edit_product" value="<?php echo $product->id ?>">
                                    <button type="submit" class="btn btn-sm mt-1 btn-primary">Edit</button>
                                </form>
                                <form action="" method="post" onsubmit="return confirm('Are you sure to delete the product? you cannot undone this process.')">
                                    <input type="hidden" name="delete_product" value="<?php echo $product->id ?>">
                                    <button type="submit" class="btn btn-sm mt-1 btn-danger">Delete</button>
                                </form>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </section>
<?php endif ?>