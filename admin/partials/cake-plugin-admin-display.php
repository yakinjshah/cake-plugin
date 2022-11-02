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

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => get_option('cake_api_host').'product',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Authorization: Bearer '.get_option('cake_api_key'),
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$resource_array = json_decode($response);
$products = $resource_array->data;
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

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
                        <td><a href="" class="btn btn-primary">Manage</a></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</section>