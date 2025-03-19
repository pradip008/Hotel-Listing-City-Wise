<?php
/**
 * Plugin Name: Hotel Book by Tim Leisure
 * Description: A custom plugin for managing hotel bookings with custom post type and taxonomy. City List Shortcode [tim_cities_list]
 * Version: 1.0.0
 * Author: Pradip Prajapati
 * Text Domain: hotel-book-tim
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

include(plugin_dir_path( __FILE__ ) . 'include/shortcode-frontend.php');




function tim_hotel_booking_single_template($template) {
    global $post;

    if ($post->post_type == 'tim_hotel_booking') {
        return plugin_dir_path(__FILE__) . 'templates/single-tim-hotel-booking.php';
    }

    return $template;
}
add_filter('template_include', 'tim_hotel_booking_single_template');

function tim_override_taxonomy_template($template) {
    if (is_tax('tim_cities')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/taxonomy-tim_cities.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    return $template;
}
add_filter('template_include', 'tim_override_taxonomy_template');



function tim_enqueue_swiper_assets() {
    // Enqueue Swiper CSS
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', array(), null);

    // Enqueue Swiper JS
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'tim_enqueue_swiper_assets');



// Register Custom Post Type: TIM Hotel Booking
function tim_register_hotel_booking_post_type() {
    $labels = array(
        'name'               => 'TIM Hotel Bookings',
        'singular_name'      => 'TIM Hotel Booking',
        'menu_name'          => 'Hotel Bookings',
        'name_admin_bar'     => 'Hotel Booking',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Hotel Booking',
        'new_item'           => 'New Hotel Booking',
        'edit_item'          => 'Edit Hotel Booking',
        'view_item'          => 'View Hotel Booking',
        'all_items'          => 'All Hotel Bookings',
        'search_items'       => 'Search Hotel Bookings',
        'not_found'          => 'No hotel bookings found.',
        'not_found_in_trash' => 'No hotel bookings found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-building',
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'taxonomies'         => array('tim_cities'),
        'rewrite'            => array('slug' => 'tim-hotel-booking'),
    );

    register_post_type('tim_hotel_booking', $args);
}
add_action('init', 'tim_register_hotel_booking_post_type');

// Register Custom Taxonomy: TIM Cities
function tim_register_hotel_cities_taxonomy() {
    $labels = array(
        'name'              => 'TIM Cities',
        'singular_name'     => 'TIM City',
        'search_items'      => 'Search Cities',
        'all_items'         => 'All Cities',
        'parent_item'       => 'Parent City',
        'parent_item_colon' => 'Parent City:',
        'edit_item'         => 'Edit City',
        'update_item'       => 'Update City',
        'add_new_item'      => 'Add New City',
        'new_item_name'     => 'New City Name',
        'menu_name'         => 'TIM Cities',
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
        'rewrite'           => array('slug' => 'tim-cities'),
    );

    register_taxonomy('tim_cities', array('tim_hotel_booking'), $args);
}
add_action('init', 'tim_register_hotel_cities_taxonomy');

// Add Image Upload to TIM Cities Taxonomy
function tim_cities_add_image_field() {
    ?>
    <div class="form-field">
        <label for="tim_cities_image">City Image</label>
        <input type="hidden" name="tim_cities_image" id="tim_cities_image" value="" />
        <img id="tim_cities_image_preview" src="" style="max-width: 200px; display: none;" />
        <button class="upload_image_button button">Upload Image</button>
    </div>
    <?php
}
add_action('tim_cities_add_form_fields', 'tim_cities_add_image_field', 10, 2);

function tim_cities_edit_image_field($term) {
    $image = get_term_meta($term->term_id, 'tim_cities_image', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="tim_cities_image">City Image</label></th>
        <td>
            <input type="hidden" name="tim_cities_image" id="tim_cities_image" value="<?php echo esc_attr($image); ?>" />
            <img id="tim_cities_image_preview" src="<?php echo esc_url($image); ?>" style="max-width: 200px; <?php echo empty($image) ? 'display:none;' : ''; ?>" />
            <button class="upload_image_button button">Upload Image</button>
        </td>
    </tr>
    <?php
}
add_action('tim_cities_edit_form_fields', 'tim_cities_edit_image_field', 10, 2);

function tim_cities_save_image_field($term_id) {
    if (isset($_POST['tim_cities_image'])) {
        update_term_meta($term_id, 'tim_cities_image', esc_url($_POST['tim_cities_image']));
    }
}
add_action('edited_tim_cities', 'tim_cities_save_image_field', 10, 2);
add_action('created_tim_cities', 'tim_cities_save_image_field', 10, 2);

function tim_cities_enqueue_admin_scripts($hook) {
    if ('edit-tags.php' === $hook || 'term.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('tim-cities-admin-js', plugin_dir_url(__FILE__) . 'admin.js', array('jquery'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'tim_cities_enqueue_admin_scripts');








