<?php
/**
 * Local Presence Engine Theme Functions
 * 
 * @package LocalPresenceEngine
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Set up theme defaults
 */
function lpe_setup() {
    // Add support for title tag
    add_theme_support('title-tag');
    
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 44,
        'width' => 44,
        'flex-width' => true,
        'flex-height' => true,
    ));
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'local-presence-engine'),
        'footer' => esc_html__('Footer Menu', 'local-presence-engine'),
    ));
}
add_action('after_setup_theme', 'lpe_setup');

/**
 * Enqueue styles
 */
function lpe_enqueue_styles() {
    wp_enqueue_style('lpe-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'lpe_enqueue_styles');

/**
 * Enqueue scripts
 */
function lpe_enqueue_scripts() {
    wp_enqueue_script('lpe-script', get_template_directory_uri() . '/js/main.js', array(), wp_get_theme()->get('Version'), true);
    
    // Localize script for admin AJAX
    wp_localize_script('lpe-script', 'lpeAjax', array(
        'ajaxUrl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'lpe_enqueue_scripts');

/**
 * Register widget areas
 */
function lpe_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'local-presence-engine'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Main sidebar', 'local-presence-engine'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'lpe_widgets_init');

/**
 * Add custom image sizes
 */
function lpe_add_image_sizes() {
    add_image_size('lpe-hero', 1200, 600, true);
    add_image_size('lpe-card', 400, 300, true);
    add_image_size('lpe-thumbnail', 300, 300, true);
}
add_action('after_setup_theme', 'lpe_add_image_sizes');

/**
 * Custom excerpt length
 */
function lpe_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'lpe_excerpt_length');

/**
 * Custom excerpt ellipsis
 */
function lpe_excerpt_more($more) {
    return ' ...';
}
add_filter('excerpt_more', 'lpe_excerpt_more');

/**
 * Remove default WordPress CSS
 */
function lpe_dequeue_styles() {
    wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'lpe_dequeue_styles', 100);

/**
 * Add custom post types for services
 */
function lpe_register_post_types() {
    register_post_type('lpe_service', array(
        'label' => 'Services',
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-briefcase',
        'has_archive' => true,
        'rewrite' => array('slug' => 'service'),
    ));
    
    register_post_type('lpe_testimonial', array(
        'label' => 'Testimonials',
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
        'has_archive' => false,
        'rewrite' => array('slug' => 'testimonial'),
    ));
    
    register_post_type('lpe_case_study', array(
        'label' => 'Case Studies',
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-chart-line',
        'has_archive' => true,
        'rewrite' => array('slug' => 'case-study'),
    ));
}
add_action('init', 'lpe_register_post_types');

/**
 * Register taxonomies
 */
function lpe_register_taxonomies() {
    register_taxonomy('service_type', 'lpe_service', array(
        'label' => 'Service Type',
        'public' => true,
        'hierarchical' => true,
    ));
    
    register_taxonomy('industry', 'lpe_case_study', array(
        'label' => 'Industry',
        'public' => true,
        'hierarchical' => true,
    ));
}
add_action('init', 'lpe_register_taxonomies');

/**
 * Add custom meta boxes
 */
function lpe_add_meta_boxes() {
    // Testimonial rating
    add_meta_box(
        'lpe_testimonial_rating',
        'Testimonial Rating',
        'lpe_render_rating_meta_box',
        'lpe_testimonial',
        'normal',
        'high'
    );
    
    // Case study metrics
    add_meta_box(
        'lpe_case_study_metrics',
        'Case Study Metrics',
        'lpe_render_metrics_meta_box',
        'lpe_case_study',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'lpe_add_meta_boxes');

/**
 * Render rating meta box
 */
function lpe_render_rating_meta_box($post) {
    $rating = get_post_meta($post->ID, '_lpe_rating', true);
    ?>
    <label for="lpe_rating">Rating (1-5):</label>
    <input type="number" id="lpe_rating" name="lpe_rating" min="1" max="5" value="<?php echo intval($rating); ?>" />
    <?php
}

/**
 * Render metrics meta box
 */
function lpe_render_metrics_meta_box($post) {
    $metric = get_post_meta($post->ID, '_lpe_metric', true);
    ?>
    <label for="lpe_metric">Key Metric:</label>
    <input type="text" id="lpe_metric" name="lpe_metric" value="<?php echo esc_attr($metric); ?>" />
    <?php
}

/**
 * Save meta box data
 */
function lpe_save_meta_box($post_id) {
    if (isset($_POST['lpe_rating'])) {
        update_post_meta($post_id, '_lpe_rating', intval($_POST['lpe_rating']));
    }
    if (isset($_POST['lpe_metric'])) {
        update_post_meta($post_id, '_lpe_metric', sanitize_text_field($_POST['lpe_metric']));
    }
}
add_action('save_post', 'lpe_save_meta_box');

/**
 * AJAX handler for contact form
 */
function lpe_handle_contact_form() {
    check_ajax_referer('lpe_contact_nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $company = sanitize_text_field($_POST['company']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Get admin email
    $admin_email = get_option('admin_email');
    
    // Prepare email
    $subject = "New Consultation Request from " . $name;
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Company: $company\n";
    $body .= "Message:\n$message";
    
    // Send email
    wp_mail($admin_email, $subject, $body);
    
    // Send confirmation to user
    wp_mail(
        $email,
        'We Received Your Consultation Request',
        "Hi $name,\n\nThank you for reaching out! We'll get back to you within 24 hours.\n\nBest,\nThe Local Presence Engine Team"
    );
    
    wp_send_json_success(array('message' => 'Thanks! We\'ll be in touch soon.'));
}
add_action('wp_ajax_lpe_contact_form', 'lpe_handle_contact_form');
add_action('wp_ajax_nopriv_lpe_contact_form', 'lpe_handle_contact_form');

/**
 * Add theme customizer options
 */
function lpe_customize_register($wp_customize) {
    // Add panel
    $wp_customize->add_panel('lpe_settings', array(
        'title' => 'Local Presence Engine Settings',
        'description' => 'Customize theme appearance and functionality',
    ));
    
    // Add section for contact info
    $wp_customize->add_section('lpe_contact', array(
        'title' => 'Contact Information',
        'panel' => 'lpe_settings',
    ));
    
    // Email setting
    $wp_customize->add_setting('lpe_contact_email');
    $wp_customize->add_control('lpe_contact_email', array(
        'label' => 'Contact Email',
        'section' => 'lpe_contact',
        'type' => 'email',
    ));
    
    // Phone setting
    $wp_customize->add_setting('lpe_contact_phone');
    $wp_customize->add_control('lpe_contact_phone', array(
        'label' => 'Phone Number',
        'section' => 'lpe_contact',
        'type' => 'text',
    ));
}
add_action('customize_register', 'lpe_customize_register');
