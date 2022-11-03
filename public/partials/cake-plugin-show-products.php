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


<h2>Products</h2>

<div class="row">
    <?php foreach($products as $product): ?>
        <div class="col-md-6 mt-3">
            <div class="card">
                <img class="card-img-top" src="<?php echo get_option('cake_asset_url').$product->image ?>" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title"><a href="" title="View Product"><?php echo $product->name ?></a></h4>
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