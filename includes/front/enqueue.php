<?php

function r_enqueue_scripts()
{
    $ver            = JU_DEV_MODE ? time() : false;

    wp_register_style('r_rateit', plugins_url('/assets/rateit/rateit.css', RECIPE_PLUGIN_URL), [], $ver);
    wp_enqueue_style('r_rateit');
    wp_enqueue_media();

    wp_register_script(
        'r_rateit',
        plugins_url('/assets/rateit/jquery.rateit.min.js', RECIPE_PLUGIN_URL),
        ['jquery'],
        $ver,
        true
    );

    wp_register_script('r_main', plugins_url('/assets/js/main.js', RECIPE_PLUGIN_URL), ['jquery'], $ver, true);

    wp_localize_script('r_main', 'recipe_obj', [
        'ajax_url'      =>  admin_url('admin-ajax.php'),
        'home_url'      =>  home_url('/')
    ]);

    wp_enqueue_script('r_rateit');
    wp_enqueue_script('r_main');
}
