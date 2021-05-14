<?php

function r_filter_recipe_content($content)
{
    if (!is_singular('recipe')) {
        return $content;
    }

    global $post, $wpdb;
    $recipe_data        =   get_post_meta($post->ID, 'recipe_data', true);
    $recipe_tpl_res     =   wp_remote_get(
        plugins_url('process/recipe-template.php', RECIPE_PLUGIN_URL),
        array(
            'timeout'     => 60
        )
    );

    $recipe_html        =   file_get_contents('recipe-template.php', true);
    // $recipe_html        =   wp_remote_retrieve_body($recipe_tpl_res);
    print_r($recipe_tpl_res);
    // return plugins_url('process/recipe-template.php', RECIPE_PLUGIN_URL);

    $origin             =   wp_get_post_terms($post->ID, 'origin');
    $more_info_url      =   isset($origin[0]) ? get_term_meta($origin[0]->term_id, 'more_info_url', true) : '';


    $recipe_html        =   str_replace('RATE_I18N', __("Rating", 'recipe'), $recipe_html);
    $recipe_html        =   str_replace('RECIPE_ID', $post->ID, $recipe_html);
    $recipe_html        =   str_replace('RECIPE_RATING', $recipe_data['rating'], $recipe_html);
    $recipe_html        =   str_replace('ORIGIN_I18N', __("Origin", "recipe"), $recipe_html);
    $recipe_html        =   str_replace(
        'ORIGIN_PH',
        isset($origin[0]) ? $origin[0]->name : 'None',
        $recipe_html
    );

    $recipe_html        =   str_replace(
        'MORE_INFO_URL_PH',
        empty($more_info_url) ? '' : '<a href="' . $more_info_url . '" target="_blank">More Info</a>',
        $recipe_html
    );


    $user_IP             =   $_SERVER['REMOTE_ADDR'];

    $rating_count        =  $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM `" . $wpdb->prefix . "recipe_rating` 
        WHERE recipe_id=%d AND user_ip=%s",
        $post->ID,
        $user_IP
    ));

    if ($rating_count > 0) {
        $recipe_html        =   str_replace('READONLY_PLACEHOLDER', 'data-rateit-READONLY="true"', $recipe_html);
    } else {
        $recipe_html        =   str_replace('READONLY_PLACEHOLDER', '', $recipe_html);
    }

    return $recipe_html . $content;
}
