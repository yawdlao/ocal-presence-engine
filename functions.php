<?php
/**
 * Local Presence Engine Theme Functions
 */

// Add theme support
function lpe_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'lpe_theme_setup');

// Enqueue styles and scripts
function lpe_enqueue_assets() {
    wp_enqueue_style('lpe-style', get_stylesheet_uri());
    wp_enqueue_script('lpe-main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'lpe_enqueue_assets');

// Register menus
function lpe_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'lpe-theme'),
    ));
}
add_action('init', 'lpe_register_menus');
