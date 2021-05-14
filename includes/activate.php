<?php

function r_activate_plugin()
{
    if (version_compare(get_bloginfo('version'), '5.0', '<')) {
        wp_die(__('You must update WordPress to use this plugin', 'recipe'));
    }

    global $wpdb;
    $createSQL      = "
    CREATE TABLE `" . $wpdb->prefix . "recipe_rating` (
        `ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `recipe_id` BIGINT(20) UNSIGNED NOT NULL,
        `rating` FLOAT(3,2) UNSIGNED NOT NULL,
        `user_ip` VARCHAR(50) NOT NULL,
        PRIMARY KEY (`ID`)
    ) ENGINE=InnoDB " . $wpdb->get_charset_collate() . ";";


    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($createSQL);

    wp_schedule_event(time(), 'daily', 'r_daily_recipe_hook');

    $recipe_opts            =   get_option('r_opts');

    if (!$recipe_opts) {
        $opts                                           =   [
            'rating_login_required'                     =>  1,
            'rating_submission_login_required'          =>  1,
        ];

        add_option('r_opts', $opts);
    }

    global $wp_roles;

    add_role('recipe_author', __('Recipe Author', 'recipe'), [
        'read'          =>  true,
        'edit_posts'    =>  true,
        'upload_files'  =>  true
    ]);
}
