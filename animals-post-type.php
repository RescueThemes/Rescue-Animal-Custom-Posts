<?php
/*
Plugin Name: Rescue Animal Custom Posts
Plugin URI: http://rescuethemes.com/
Description: Creates a custom post type for animals. Based on the work done by <a href="http://pinkishhue.com/">Jo Dixon</a>
Version: 1.0
Author: Rescue Themes
Author URI: http://rescuethemes.com/
License: GPLv2
*/

/**
 * Exit if accessed directly
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit;


add_action( 'init', 'create_rescue_animals' );
/**
 * Register an animals post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function create_rescue_animals() {
    $labels = array(
        'name'               => _x( 'Animals', 'post type general name', 'rescue-animals' ),
        'singular_name'      => _x( 'Animal', 'post type singular name', 'rescue-animals' ),
        'menu_name'          => _x( 'Animals', 'admin menu', 'rescue-animals' ),
        'name_admin_bar'     => _x( 'Animals', 'add new on admin bar', 'rescue-animals' ),
        'add_new'            => _x( 'Add New', 'animal', 'rescue-animals' ),
        'add_new_item'       => __( 'Add New Animal', 'rescue-animals' ),
        'new_item'           => __( 'New Animal', 'rescue-animals' ),
        'edit_item'          => __( 'Edit Animal', 'rescue-animals' ),
        'view_item'          => __( 'View Animal', 'rescue-animals' ),
        'all_items'          => __( 'All Animals', 'rescue-animals' ),
        'search_items'       => __( 'Search Animals', 'rescue-animals' ),
        'parent_item_colon'  => __( 'Parent Animals:', 'rescue-animals' ),
        'not_found'          => __( 'No animals found.', 'rescue-animals' ),
        'not_found_in_trash' => __( 'No animals found in Trash.', 'rescue-animals' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'animals' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'comments' ),
        //'taxonomies'         => array( 'post_tag' ) // support tags
    );

    register_post_type( 'rescue_animals', $args );

} // end function create_rescue_animals


/**
 * Make Archives.php Include Custom Post Types
 *
 * @link http://css-tricks.com/snippets/wordpress/make-archives-php-include-custom-post-types/
 */
function namespace_add_custom_types( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
        $post_types = get_post_types( '', 'names' ); 
        $query->set( 'post_type', $post_types);
        return $query;
    }
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types');

/**
 * hook into the init action and call create_book_taxonomies when it fires
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
add_action( 'init', 'create_animal_taxonomies', 0 );

// create taxonomies for the post type "animals"
function create_animal_taxonomies() {

    // Species taxonomy
    $labels = array( 
        'name' => _x( 'Species', 'rescue-animals' ),
        'singular_name' => _x( 'Species', 'rescue-animals' ),
        'search_items' => _x( 'Search Species', 'rescue-animals' ),
        'popular_items' => _x( 'Popular Species', 'rescue-animals' ),
        'all_items' => _x( 'All Species', 'rescue-animals' ),
        'parent_item' => _x( 'Parent Species', 'rescue-animals' ),
        'parent_item_colon' => _x( 'Parent Species:', 'rescue-animals' ),
        'edit_item' => _x( 'Edit Species', 'rescue-animals' ),
        'update_item' => _x( 'Update Species', 'rescue-animals' ),
        'add_new_item' => _x( 'Add New Species', 'rescue-animals' ),
        'new_item_name' => _x( 'New Species', 'rescue-animals' ),
        'separate_items_with_commas' => _x( 'Separate species with commas', 'rescue-animals' ),
        'add_or_remove_items' => _x( 'Add or remove species', 'rescue-animals' ),
        'choose_from_most_used' => _x( 'Choose from the most used species', 'rescue-animals' ),
        'menu_name' => _x( 'Species', 'rescue-animals' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'animal_species', array('rescue_animals'), $args );

    // Gender taxonomy
    $labels = array( 
        'name' => _x( 'Genders', 'rescue-animals' ),
        'singular_name' => _x( 'Gender', 'rescue-animals' ),
        'search_items' => _x( 'Search Genders', 'rescue-animals' ),
        'popular_items' => _x( 'Popular Genders', 'rescue-animals' ),
        'all_items' => _x( 'All Genders', 'rescue-animals' ),
        'parent_item' => _x( 'Parent Gender', 'rescue-animals' ),
        'parent_item_colon' => _x( 'Parent Gender:', 'rescue-animals' ),
        'edit_item' => _x( 'Edit Gender', 'rescue-animals' ),
        'update_item' => _x( 'Update Gender', 'rescue-animals' ),
        'add_new_item' => _x( 'Add New Gender', 'rescue-animals' ),
        'new_item_name' => _x( 'New Gender', 'rescue-animals' ),
        'separate_items_with_commas' => _x( 'Separate genders with commas', 'rescue-animals' ),
        'add_or_remove_items' => _x( 'Add or remove genders', 'rescue-animals' ),
        'choose_from_most_used' => _x( 'Choose from the most used genders', 'rescue-animals' ),
        'menu_name' => _x( 'Gender', 'rescue-animals' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'animal_gender', array('rescue_animals'), $args );

    // Breed taxonomy
    $labels = array( 
        'name' => _x( 'Breed', 'rescue-animals' ),
        'singular_name' => _x( 'Breed', 'rescue-animals' ),
        'search_items' => _x( 'Search Breeds', 'rescue-animals' ),
        'popular_items' => _x( 'Popular Breeds', 'rescue-animals' ),
        'all_items' => _x( 'All Breeds', 'rescue-animals' ),
        'parent_item' => _x( 'Parent Breed', 'rescue-animals' ),
        'parent_item_colon' => _x( 'Parent Breed:', 'rescue-animals' ),
        'edit_item' => _x( 'Edit Breeds', 'rescue-animals' ),
        'update_item' => _x( 'Update Breed', 'rescue-animals' ),
        'add_new_item' => _x( 'Add New Breed', 'rescue-animals' ),
        'new_item_name' => _x( 'New Breed', 'rescue-animals' ),
        'separate_items_with_commas' => _x( 'Separate Breeds with commas', 'rescue-animals' ),
        'add_or_remove_items' => _x( 'Add or remove Breeds', 'rescue-animals' ),
        'choose_from_most_used' => _x( 'Choose from the most used Breeds', 'rescue-animals' ),
        'menu_name' => _x( 'Breed', 'rescue-animals' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'breed_options', array('rescue_animals'), $args );

    // Specific Age taxonomy
    $labels = array( 
        'name' => _x( 'Age', 'rescue-animals' ),
        'singular_name' => _x( 'Age', 'rescue-animals' ),
        'search_items' => _x( 'Search Ages', 'rescue-animals' ),
        'popular_items' => _x( 'Popular Ages', 'rescue-animals' ),
        'all_items' => _x( 'All Ages', 'rescue-animals' ),
        'parent_item' => _x( 'Parent Age', 'rescue-animals' ),
        'parent_item_colon' => _x( 'Parent Age:', 'rescue-animals' ),
        'edit_item' => _x( 'Edit Age', 'rescue-animals' ),
        'update_item' => _x( 'Update Age', 'rescue-animals' ),
        'add_new_item' => _x( 'Add New Age', 'rescue-animals' ),
        'new_item_name' => _x( 'New Age', 'rescue-animals' ),
        'separate_items_with_commas' => _x( 'Separate Ages with commas', 'rescue-animals' ),
        'add_or_remove_items' => _x( 'Add or remove Ages', 'rescue-animals' ),
        'choose_from_most_used' => _x( 'Choose from the most used Ages', 'rescue-animals' ),
        'menu_name' => _x( 'Age', 'rescue-animals' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'animal_age', array('rescue_animals'), $args );

    // Rehoming Status taxonomy
    $labels = array( 
        'name' => _x( 'Rehoming Status', 'rescue-animals' ),
        'singular_name' => _x( 'Rehoming Status', 'rescue-animals' ),
        'search_items' => _x( 'Search Rehoming Status', 'rescue-animals' ),
        'popular_items' => _x( 'Popular Rehoming Status', 'rescue-animals' ),
        'all_items' => _x( 'All Rehoming Status', 'rescue-animals' ),
        'parent_item' => _x( 'Parent Rehoming Status', 'rescue-animals' ),
        'parent_item_colon' => _x( 'Parent Rehoming Status:', 'rescue-animals' ),
        'edit_item' => _x( 'Edit Rehoming Status', 'rescue-animals' ),
        'update_item' => _x( 'Update Rehoming Status', 'rescue-animals' ),
        'add_new_item' => _x( 'Add New Rehoming Status', 'rescue-animals' ),
        'new_item_name' => _x( 'New Rehoming Status', 'rescue-animals' ),
        'separate_items_with_commas' => _x( 'Separate rehoming status with commas', 'rescue-animals' ),
        'add_or_remove_items' => _x( 'Add or remove rehoming status', 'rescue-animals' ),
        'choose_from_most_used' => _x( 'Choose from the most used rehoming status', 'rescue-animals' ),
        'menu_name' => _x( 'Rehoming Status', 'rescue-animals' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'rehoming_status', array('rescue_animals'), $args );

    // Special Needs taxonomy
    $labels = array( 
        'name' => _x( 'Special Needs', 'rescue-animals' ),
        'singular_name' => _x( 'Special Needs', 'rescue-animals' ),
        'search_items' => _x( 'Search Special Needs', 'rescue-animals' ),
        'popular_items' => _x( 'Popular Special Needs', 'rescue-animals' ),
        'all_items' => _x( 'All Special Needs', 'rescue-animals' ),
        'parent_item' => _x( 'Parent Special Needs', 'rescue-animals' ),
        'parent_item_colon' => _x( 'Parent Special Needs:', 'rescue-animals' ),
        'edit_item' => _x( 'Edit Special Needs', 'rescue-animals' ),
        'update_item' => _x( 'Update Special Needs', 'rescue-animals' ),
        'add_new_item' => _x( 'Add New Special Needs', 'rescue-animals' ),
        'new_item_name' => _x( 'New Special Needs', 'rescue-animals' ),
        'separate_items_with_commas' => _x( 'Separate Special Needs options with commas', 'rescue-animals' ),
        'add_or_remove_items' => _x( 'Add or remove Special Needs', 'rescue-animals' ),
        'choose_from_most_used' => _x( 'Choose from the most used Special Needs', 'rescue-animals' ),
        'menu_name' => _x( 'Special Needs', 'rescue-animals' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'special_needs', array('rescue_animals'), $args );

} // end function create_animal_taxonomies

/**
 * Include multi post thumbnails 
 *
 * @link https://wordpress.org/plugins/multiple-post-thumbnails/
 */
require_once( dirname(__FILE__) . '/multi-post-thumbnails.php' );

/**
 * Include scripts and styles
 *
 */
require_once( dirname(__FILE__) . '/scripts.php' );

// Define additional "post thumbnails". Relies on MultiPostThumbnails
if ( class_exists( 'MultiPostThumbnails' ) ) {
    new MultiPostThumbnails( array(
        'label' => '2nd Feature Image',
        'id' => 'feature-image-2',
        'post_type' => 'rescue_animals'
        )
    );
    new MultiPostThumbnails( array(
        'label' => '3rd Feature Image',
        'id' => 'feature-image-3',
        'post_type' => 'rescue_animals'
        )
    );
    new MultiPostThumbnails( array(
        'label' => '4th Feature Image',
        'id' => 'feature-image-4',
        'post_type' => 'rescue_animals'
        )
    );
    new MultiPostThumbnails( array(
        'label' => '5th Feature Image',
        'id' => 'feature-image-5',
        'post_type' => 'rescue_animals'
        )
    );      
 
}; // End multipost thumbnails class check