<?php

if (!defined('ABSPATH')) {
  exit;
}

function journey_theme_register_cpt() {
  $args = array(
    'public'       => true,
    'label'        => 'Journeys',
    'supports'     => array('title', 'editor', 'thumbnail'),
    'menu_icon'    => 'dashicons-airplane',
    'rewrite'      => array('slug' => 'journey'),
    'show_in_rest' => true,
  );
  register_post_type('journey', $args);
}
add_action('init', 'journey_theme_register_cpt');

function journey_theme_setup() {
  add_theme_support('post-thumbnails');

  register_nav_menus(array(
    'header-menu'  => 'Header Menu',
    'footer-menu'  => 'Footer Menu',
    'footer_pages' => 'Footer - Meniu Pages',
    'footer_legal' => 'Footer - Meniu Legal'
  ));
}
add_action('after_setup_theme', 'journey_theme_setup');

function journey_theme_scripts() {
  wp_enqueue_style('journey-style', get_stylesheet_uri(), array(), '1.0.0');

  wp_enqueue_script('journey-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'journey_theme_scripts');