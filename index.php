<?php
/*
 * Plugin Name: Recipe
 * Description: A simple Wordpress plugin that allow user to create recipes and rate those recipes   
 * Version: 1.0
 * Author: Thinkiing
 * Author URI: https://thinkiing.com
 * Text Domain: recipe
 * 
 */

if (!function_exists('add_action')) {
    echo "Hi there! I'm just a plugin not much I can do when called directly";
    exit;
}

// Setup
define('RECIPE_PLUGIN_URL', __FILE__);

// Includes
include('includes/activate.php');
include('includes/init.php');
include('includes/front/enqueue.php');
include('includes/front/logout-link.php');
include('process/save-post.php');
include('process/rate-recipe.php');
include('process/filter-content.php');
include('process/submit-user-recipe.php');
include('process/create-account.php');
include('process/login.php');
include('includes/admin/init.php');
include('blocks/enqueue.php');
include(dirname(RECIPE_PLUGIN_URL) . '/includes/widgets.php');
include('includes/widgets/daily-recipe.php');
include('includes/cron.php');
include('includes/utility.php');
include('includes/deactivate.php');
include('includes/shortcodes/creator.php');
include('includes/shortcodes/auth-form.php');
include('includes/shortcodes/auth-form-alt.php');
include('includes/admin/dashboard-widgets.php');
include('includes/admin/menus.php');
include('includes/admin/options-page.php');
include('includes/admin/origin-field.php');
include('process/save-options.php');
include('process/save-origin.php');

 
// Hook
register_activation_hook(__FILE__, 'r_activate_plugin');
register_deactivation_hook(__FILE__, 'r_deactivate_plugin');
add_action('init', 'recipe_init');
add_action('save_post_recipe', 'r_save_post_admin', 10, 3);
add_filter('the_content', 'r_filter_recipe_content');
add_action('wp_enqueue_scripts', 'r_enqueue_scripts', 100);
add_action('wp_ajax_r_rate_recipe', 'r_rate_recipe');
add_action('wp_ajax_nopriv_r_rate_recipe', 'r_rate_recipe');
add_action('wp_ajax_r_submit_user_recipe', 'r_submit_user_recipe');
add_action('wp_ajax_nopriv_r_submit_user_recipe', 'r_submit_user_recipe');
add_action('admin_init', 'recipe_admin_init');
add_action('enqueue_block_editor_assets', 'r_enqueue_block_editor_assets');
add_action('enqueue_block_assets', 'r_enqueue_block_assets');
add_action('widgets_init', 'r_widgets_init');
add_action('r_daily_recipe_hook', 'r_generate_daily_recipe');
add_action('wp_ajax_nopriv_recipe_create_account', 'recipe_create_account');
add_action('wp_ajax_nopriv_recipe_user_login', 'recipe_user_login');
// add_filter('authenticate', 'wp_authenticate_username_password', 20, 3);
// add_filter('authenticate', 'wp_authenticate_spam_check', 99);
// add_filter('authenticate', 'r_alt_authenticate', 100, 3);
add_filter('wp_nav_menu_secondary_items', 'ju_new_nav_menu_items', 999);
add_action('wp_dashboard_setup', 'r_dashboard_widgets');
add_action('admin_menu', 'r_admin_menus');
add_action('origin_add_form_fields', 'r_origin_add_form_fields');
add_action('origin_edit_form_fields', 'r_origin_edit_form_fields');
add_action('create_origin', 'r_save_origin_meta');
add_action('edited_origin', 'r_save_origin_meta');
// Shortcodes
add_shortcode('recipe_creator', 'r_recipe_creator_shortcode');
add_shortcode('recipe_auth_form', 'r_recipe_auth_form_shortcode');
// add_shortcode('recipe_auth_alt_form', 'r_recipe_auth_alt_form_shortcode');