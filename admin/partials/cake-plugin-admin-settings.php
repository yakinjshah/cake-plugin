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

    

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->



<section>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h2 class=" mb-5 mt-5">Cake Products Settings</h2>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'cake-plugin-settings-group' );
                do_settings_sections( 'cake-plugin-settings-group' );
                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">API key </label>
                    <input type="text" class="form-control" id="api_key" aria-describedby="api_key" placeholder="Enter API key" name="cake_api_key" value="<?php echo get_option("cake_api_key") ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">API Host </label>
                    <input type="text" class="form-control" id="api_host" aria-describedby="api_key" placeholder="Enter API Host" name="cake_api_host" value="<?php echo get_option("cake_api_host") ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Asset Url </label>
                    <input type="text" class="form-control" id="cake_asset_url" aria-describedby="api_key" placeholder="Enter Asset Url" name="cake_asset_url" value="<?php echo get_option("cake_asset_url") ?>">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</section>