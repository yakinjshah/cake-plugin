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

if (isset($_POST['product_name'])) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => get_option('cake_api_host').'product',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'name' => $_POST['product_name'],
            'category_id' => $_POST['product_category'],
            'quantity' => $_POST['product_quantity'],
            'image'=> curl_file_create($_FILES['product_image']['tmp_name']),
            'description' => $_POST['product_description'],
            'price' => $_POST['product_price'],
            'sku' => $_POST['product_sku'],
            'total_review' => $_POST['product_total_reviews'],
            'total_ratting' => $_POST['product_total_ratings']
        ),
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
                Product added successfully. <a href="<?php echo site_url('/wp-admin/admin.php?page=cake-plugin') ?>">See all products</a>
            </div>
        <?php
    }

}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<section>
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <h2 class="mb-5 mt-5">Add Product</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" required>
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price" required>
                </div>
                <div class="form-group">
                    <label for="product_category">Product Category</label>
                    <select class="form-control" id="product_category" name="product_category" required>
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                        <option value="3">Category 3</option>
                        <option value="4">Category 4</option>
                        <option value="5">Category 5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_quantity">Product Quantity</label>
                    <input type="number" class="form-control" id="product_quantity" name="product_quantity" placeholder="Enter Product Quantity" required>
                </div>
                <div class="form-group" id="images">
                    <label for="product_image">Featured Image</label>
                    <input type="file" class="form-control" id="product_image" name="product_image" placeholder="Enter Product Image" required>
                </div>
                <div class="form-group" id="sku">
                    <label for="product_sku">Product SKU</label>
                    <input type="text" class="form-control" id="product_sku" name="product_sku" placeholder="Enter Product SKU" required>
                </div>
                <div class="form-group" id="total_reviews">
                    <label for="product_total_reviews">Product Total Reviews</label>
                    <input type="number" class="form-control" id="product_total_reviews" name="product_total_reviews" placeholder="Enter Product Total Reviews">
                </div>
                <div class="form-group" id="total_ratings">
                    <label for="product_total_ratings">Product Total Ratings</label>
                    <input type="number" class="form-control" id="product_total_ratings" name="product_total_ratings" placeholder="Enter Product Total Ratings">
                </div>
                <div class="form-group" id="image_galary">
                    <label for="product_image_galary">Product Image Galary</label>
                    <input type="file" class="form-control" id="product_image_galary" name="product_image_galary[]" placeholder="Enter Product Image Galary">
                </div>
                <div class="form-group" id="total_ratings">
                    <label for="product_description">Product Description</label>
                    <textarea type="number" rows="7" class="form-control" id="product_description" name="product_description" placeholder="Write product Description here"></textarea>
                </div>

                <!-- submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>