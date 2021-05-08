<?php

function r_enqueue_block_editor_assets()
{
    $ver            = JU_DEV_MODE ? time() : false;
    wp_register_script(
        'r_blocks_bundle',
        plugins_url('/blocks/dist/bundle.js', RECIPE_PLUGIN_URL),
        ['wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor', 'wp-api'],
        $ver
    );

    wp_enqueue_script('r_blocks_bundle');
}

function r_enqueue_block_assets()
{
    $ver            = JU_DEV_MODE ? time() : false;
    wp_register_style(
        'r_blocks',
        plugins_url('/blocks/dist/block-main.css', RECIPE_PLUGIN_URL),
        [],
        $ver
    );

    wp_enqueue_style('r_blocks');
}
