<?php

if (!defined('ABSPATH')) {
    exit;
}

function mindshows_register_irl_gaming_cpt() {
    register_post_type('irl_gaming', array(
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'label'              => 'IRL Gaming',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-games',
        'rewrite'            => array('slug' => 'irl-gaming', 'with_front' => false),
        'has_archive'        => false,
        'show_in_rest'       => true,
    ));
}
add_action('init', 'mindshows_register_irl_gaming_cpt', 5);

function mindshows_irl_check_flush_rewrites() {
    if (get_option('mindshows_irl_flushed_v1') !== '1') {
        flush_rewrite_rules(false);
        update_option('mindshows_irl_flushed_v1', '1');
    }
}
add_action('init', 'mindshows_irl_check_flush_rewrites', 99);

function mindshows_irl_hero_url($post_id = 0) {
    $post_id = $post_id ?: get_queried_object_id();
    $image = function_exists('get_field') ? get_field('irl_hero_bg_image', $post_id) : null;
    return mindshows_acf_image_url($image, get_template_directory_uri() . '/assets/images/bg-irlGaming.webp');
}

function mindshows_register_irl_gaming_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $location = array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'irl_gaming',
            ),
        ),
    );

    $toggles = array();
    foreach (array('galerie' => 'Galerie', 'about' => 'Concept Rows', 'detalii' => 'Detalii', 'pentru_tine' => 'Pentru Tine') as $slug => $label) {
        $toggles[] = array(
            'key' => "field_irl_show_{$slug}",
            'label' => "Show {$label}?",
            'name' => "irl_show_{$slug}",
            'type' => 'true_false',
            'default_value' => 1,
            'ui' => 0,
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_irl_visibility',
        'title' => 'IRL Gaming: 00 Section Visibility',
        'fields' => $toggles,
        'location' => $location,
        'menu_order' => 0,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_irl_hero_bg',
        'title' => '01 Hero Background',
        'fields' => array(
            array(
                'key' => 'field_irl_hero_bg_image',
                'label' => 'Hero Background Image',
                'name' => 'irl_hero_bg_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
        ),
        'location' => $location,
        'menu_order' => 2,
    ));
}
add_action('acf/init', 'mindshows_register_irl_gaming_acf_fields');

function mindshows_irl_is_irl_post($post_id) {
    if (!is_numeric($post_id)) {
        return false;
    }
    $post_id = (int) $post_id;
    $parent = wp_is_post_revision($post_id);
    return get_post_type($parent ? $parent : $post_id) === 'irl_gaming';
}

function mindshows_irl_field_defaults() {
    return array(
        'field_dev_hero_title'    => '',
        'field_dev_hero_subtitle' => '',
        'field_dev_galerie_title' => 'POVESTE',
        'field_dev_pt_title'      => 'EXPERIENTA ESTE PENTRU TINE',
        'field_dev_dt3_title'     => 'Durata',
        'field_dev_dt3_val'       => '5 Ore',
    );
}

function mindshows_irl_default_value($value, $post_id, $field) {
    if (!mindshows_irl_is_irl_post($post_id) || metadata_exists('post', (int) $post_id, $field['name'])) {
        return $value;
    }
    $defaults = mindshows_irl_field_defaults();
    return $defaults[$field['key']];
}
foreach (array_keys(mindshows_irl_field_defaults()) as $mindshows_irl_key) {
    add_filter("acf/load_value/key={$mindshows_irl_key}", 'mindshows_irl_default_value', 10, 3);
}
unset($mindshows_irl_key);

function mindshows_irl_hide_badge_field($field) {
    global $post;
    return ($post && $post->post_type === 'irl_gaming') ? false : $field;
}
add_filter('acf/prepare_field/key=field_dev_hero_subtitle', 'mindshows_irl_hide_badge_field');
