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

// Includes
include('includes/activate.php');
include('includes/init.php');
include('process/save-post.php');

// Hook
register_activation_hook(__FILE__, 'r_activate_plugin');
add_action('init', 'recipe_init');
add_action('save_post_recipe', 'r_save_post_admin', 10, 3);

// Shortcodes