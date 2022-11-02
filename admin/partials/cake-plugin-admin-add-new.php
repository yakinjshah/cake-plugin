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
print_r($_POST);

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<section>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h2 class="mb-5 mt-5">Add Product</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name">
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price">
                </div>
                <div class="form-group">
                    <label for="product_category">Product Category</label>
                    <select class="form-control" id="product_category" name="product_category">
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                        <option value="3">Category 3</option>
                        <option value="4">Category 4</option>
                        <option value="5">Category 5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_quantity">Product Quantity</label>
                    <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="Enter Product Quantity">
                </div>
                <div class="form-group" id="images">
                    <label for="product_image">Featured Image</label>
                    <input type="file" class="form-control" id="product_image" name="product_image[]" placeholder="Enter Product Image">
                </div>
                <div class="form-group" id="sku">
                    <label for="product_sku">Product SKU</label>
                    <input type="text" class="form-control" id="product_sku" name="product_sku" placeholder="Enter Product SKU">
                </div>
                <div class="form-group" id="total_reviews">
                    <label for="product_total_reviews">Product Total Reviews</label>
                    <input type="text" class="form-control" id="product_total_reviews" name="product_total_reviews" placeholder="Enter Product Total Reviews">
                </div>
                <div class="form-group" id="total_ratings">
                    <label for="product_total_ratings">Product Total Ratings</label>
                    <input type="text" class="form-control" id="product_total_ratings" name="product_total_ratings" placeholder="Enter Product Total Ratings">
                </div>
                <div class="form-group" id="image_galary">
                    <label for="product_image_galary">Product Image Galary</label>
                    <input type="file" class="form-control" id="product_image_galary" name="product_image_galary[]" placeholder="Enter Product Image Galary">
                </div>

                <!-- submit -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>