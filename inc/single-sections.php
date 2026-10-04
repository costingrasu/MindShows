<?php

if (!defined('ABSPATH')) {
    exit;
}

function mindshows_acf_image_url($image, $fallback = '') {
    $url = '';
    if (is_array($image)) {
        $url = !empty($image['url']) ? $image['url'] : '';
    } elseif (is_numeric($image)) {
        $url = wp_get_attachment_image_url((int) $image, 'full');
    } elseif (is_string($image)) {
        $url = $image;
    }
    return $url ?: $fallback;
}

function mindshows_single_sections_data($post_id, $type = 'development') {
    $img_dir = get_template_directory_uri() . '/assets/images/';
    $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis, finibus maximus enim. Suspendisse neque augue, rutrum eu sollicitudin cursus, maximus in velit.';
    $is_irl = $type === 'irl_gaming';

    $variant = $is_irl ? array(
        'galerie_title'  => 'POVESTE',
        'galerie_images' => array('bg-irlGaming.webp', 'bg-team.webp', 'bg-journeys.webp', 'bg-development.webp', 'bg-development1.webp'),
        'about_images'   => array('bg-irlGaming.webp', 'bg-team.webp'),
        'pt_title'       => 'EXPERIENTA ESTE PENTRU TINE',
        'detalii_wide'   => array(false, false, false),
        'btn_href'       => '#irl-booking',
    ) : array(
        'galerie_title'  => 'Galerie',
        'galerie_images' => array('bg-development.webp', 'bg-development1.webp', 'bg-irlGaming.webp', 'bg-journeys.webp', 'bg-team.webp'),
        'about_images'   => array('bg-development.webp', 'bg-development1.webp'),
        'pt_title'       => 'LOREM IPSUM DOLOR SIT AMET',
        'detalii_wide'   => array(false, false, true),
        'btn_href'       => '#dev-inscriere',
    );

    $hero = array(
        'title'    => get_field('dev_hero_title', $post_id) ?: get_the_title($post_id),
        'badge'    => $is_irl ? '' : (get_field('dev_hero_subtitle', $post_id) ?: 'Empty subtitle'),
        'desc'     => get_field('dev_hero_description', $post_id) ?: $lorem,
        'btn_text' => get_field('dev_hero_button_text', $post_id) ?: 'Inscriere',
        'btn_href' => $variant['btn_href'],
        'bg'       => ($is_irl && function_exists('mindshows_irl_hero_url')) ? mindshows_irl_hero_url($post_id) : '',
    );

    $raw_images = get_field('dev_galerie_images', $post_id);
    if (empty($raw_images) || !is_array($raw_images)) {
        $raw_images = array();
        foreach ($variant['galerie_images'] as $i => $file) {
            $raw_images[] = array('url' => $img_dir . $file, 'alt' => 'Galerie Slide ' . ($i + 1));
        }
    }
    $images = array();
    foreach (array_values($raw_images) as $idx => $img) {
        $images[] = array(
            'url' => is_array($img) ? $img['url'] : $img,
            'alt' => (is_array($img) && !empty($img['alt'])) ? $img['alt'] : 'Galerie Slide ' . ($idx + 1),
        );
    }
    $galerie = array(
        'title'  => get_field('dev_galerie_title', $post_id) ?: $variant['galerie_title'],
        'desc'   => get_field('dev_galerie_description', $post_id) ?: $lorem,
        'images' => $images,
    );

    $about = array();
    foreach (array(1, 2) as $n) {
        $row = get_field("dev_about_{$n}", $post_id);
        $about[] = array(
            'title' => !empty($row['title']) ? $row['title'] : 'Concept',
            'desc'  => !empty($row['description']) ? $row['description'] : $lorem,
            'image' => mindshows_acf_image_url($row['image'] ?? '', $img_dir . $variant['about_images'][$n - 1]),
        );
    }

    $pt_items = get_field('dev_pt_items', $post_id);
    if (empty($pt_items) || !is_array($pt_items)) {
        $pt_items = array_fill(0, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit');
    }
    $pentru_tine = array(
        'title' => get_field('dev_pt_title', $post_id) ?: $variant['pt_title'],
        'items' => array_map(function ($item) {
            return is_array($item) ? $item['item_text'] : $item;
        }, $pt_items),
    );

    $detalii = array();
    foreach (array(1, 2, 3) as $n) {
        $dt = get_field("dev_detaliu_{$n}", $post_id);
        $detalii[] = array(
            'title' => !empty($dt['title']) ? $dt['title'] : 'Empty',
            'val'   => !empty($dt['value']) ? $dt['value'] : 'Empty',
            'wide'  => $variant['detalii_wide'][$n - 1],
        );
    }

    return array(
        'hero'        => $hero,
        'galerie'     => $galerie,
        'about'       => $about,
        'pentru_tine' => $pentru_tine,
        'detalii'     => $detalii,
    );
}
