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
include('process/save-post.php');
include('process/rate-recipe.php');
include('process/filter-content.php');
include('includes/admin/init.php');
include('blocks/enqueue.php');

// Hook
register_activation_hook(__FILE__, 'r_activate_plugin');
add_action('init', 'recipe_init');
add_action('save_post_recipe', 'r_save_post_admin', 10, 3);
add_filter('the_content', 'r_filter_recipe_content');
add_action('wp_enqueue_scripts', 'r_enqueue_scripts', 100);
add_action('wp_ajax_r_rate_recipe', 'r_rate_recipe');
add_action('wp_ajax_nopriv_r_rate_recipe', 'r_rate_recipe');
add_action('admin_init', 'recipe_admin_init');
add_action('enqueue_block_editor_assets', 'r_enqueue_block_editor_assets');
// Shortcodes