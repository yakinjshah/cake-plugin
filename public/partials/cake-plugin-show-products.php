<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://businesslabs.org
 * @since      1.0.0
 *
 * @package    Cake_Plugin
 * @subpackage Cake_Plugin/public/partials
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

$response_array = json_decode($response);
$products = $response_array->data;
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<h2>Products</h2>

<div class="row">
    <?php foreach($products as $product): ?>
        <div class="col-md-6 mt-3">
            <div class="card">
                <img class="card-img-top" src="<?php echo get_option('cake_asset_url')."166740727039.jpg" ?>" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title"><a href="product.html" title="View Product"><?php echo $product->name ?></a></h4>
                    <p class="card-text"><?php echo wp_trim_words($product->description, 20, '...') ?></p>
                    <div class="row">
                        <div class="col">
                            <h3>$<?php echo $product->price ?></h3>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-success btn-block">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<style>

    .bloc_left_price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 150%;
    }
    .category_block li:hover {
        background-color: #007bff;
    }
    .category_block li:hover a {
        color: #ffffff;
    }
    .category_block li a {
        color: #343a40;
    }
    .add_to_cart_block .price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 200%;
        margin-bottom: 0;
    }
    .add_to_cart_block .price_discounted {
        color: #343a40;
        text-align: center;
        text-decoration: line-through;
        font-size: 140%;
    }
    .product_rassurance {
        padding: 10px;
        margin-top: 15px;
        background: #ffffff;
        border: 1px solid #6c757d;
        color: #6c757d;
    }
    .product_rassurance .list-inline {
        margin-bottom: 0;
        text-transform: uppercase;
        text-align: center;
    }
    .product_rassurance .list-inline li:hover {
        color: #343a40;
    }
    .reviews_product .fa-star {
        color: gold;
    }
    .pagination {
        margin-top: 20px;
    }
    footer {
        background: #343a40;
        padding: 40px;
    }
    footer a {
        color: #f8f9fa!important
    }

</style>