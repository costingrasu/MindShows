<?php

if (!defined('ABSPATH')) {
    exit;
}

function mindshows_listing_variant_for($post_id = 0) {
    $post_id = $post_id ? (int) $post_id : get_queried_object_id();
    return get_page_template_slug($post_id) === 'page-irl-gaming.php' ? 'irl_gaming' : 'development';
}

function mindshows_listing_variant_texts($variant) {
    return $variant === 'irl_gaming' ? array(
        'hero_image'   => 'bg-irlGaming.webp',
        'hero_title'   => 'IRL GAMING',
        'btn_href'     => '#irlpage-booking',
        'symbol'       => 'symbol-irlGaming.webp',
        'dir_title'    => 'IRL Gaming',
        'dir_subtitle' => 'Changing the Way We Play',
        'book_image'   => 'bg-irlGaming.webp',
        'book_title'   => 'ORGANIZE A CUSTOM GAME',
        'book_btn'     => 'Start Now',
    ) : array(
        'hero_image'   => 'bg-development.webp',
        'hero_title'   => 'DEVELOPMENT',
        'btn_href'     => '#devpage-inscriere',
        'symbol'       => 'symbol-development.webp',
        'dir_title'    => 'Directie',
        'dir_subtitle' => 'Changing the Way We Learn',
        'book_image'   => 'bg-development1.webp',
        'book_title'   => 'BOOK A FREE DEMO TODAY',
        'book_btn'     => 'Book Now',
    );
}

function mindshows_listing_field_placeholder($field) {
    $map = array(
        'field_devpage_hero_title' => 'hero_title',
        'field_devpage_book_title' => 'book_title',
        'field_devpage_book_btn_t' => 'book_btn',
    );
    $texts = mindshows_listing_variant_texts(mindshows_listing_variant_for(get_the_ID()));
    $field['placeholder'] = $texts[$map[$field['key']]];
    return $field;
}
foreach (array('field_devpage_hero_title', 'field_devpage_book_title', 'field_devpage_book_btn_t') as $mindshows_listing_key) {
    add_filter("acf/prepare_field/key={$mindshows_listing_key}", 'mindshows_listing_field_placeholder');
}
unset($mindshows_listing_key);

function mindshows_listing_sections_data($variant = 'development') {
    $img_dir = get_template_directory_uri() . '/assets/images/';
    $lorem   = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation';
    $is_irl  = $variant === 'irl_gaming';
    $v       = mindshows_listing_variant_texts($variant);

    $hero_img = mindshows_field('devpage_hero_bg_image');
    $hero = array(
        'img_url'  => mindshows_acf_image_url($hero_img, $img_dir . $v['hero_image']),
        'img_alt'  => !empty($hero_img['alt']) ? $hero_img['alt'] : '',
        'title'    => mindshows_field('devpage_hero_title') ?: $v['hero_title'],
        'desc'     => mindshows_field('devpage_hero_description') ?: $lorem,
        'btn_text' => mindshows_field('devpage_hero_button_text') ?: 'Start Now',
        'btn_href' => $v['btn_href'],
    );

    $raw = mindshows_field('devpage_dir_cards');
    $raw = is_array($raw) ? array_values($raw) : array();
    $cards = array();
    for ($i = 0; $i < 3; $i++) {
        $card = (isset($raw[$i]) && is_array($raw[$i])) ? $raw[$i] : array();
        if (empty($card['title']) && empty($card['subtitle']) && empty($card['description'])) {
            $cards[] = array(
                'title'       => $is_irl ? $v['dir_title'] : $v['dir_title'] . ' ' . ($i + 1),
                'subtitle'    => $v['dir_subtitle'],
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            );
            continue;
        }
        $cards[] = array(
            'title'       => !empty($card['title']) ? $card['title'] : '',
            'subtitle'    => !empty($card['subtitle']) ? $card['subtitle'] : '',
            'description' => !empty($card['description']) ? $card['description'] : '',
        );
    }

    $book_img = mindshows_field('devpage_book_image');
    $book = array(
        'img_url'  => mindshows_acf_image_url($book_img, $img_dir . $v['book_image']),
        'img_alt'  => !empty($book_img['alt']) ? $book_img['alt'] : '',
        'title'    => mindshows_field('devpage_book_title') ?: $v['book_title'],
        'desc'     => mindshows_field('devpage_book_description') ?: $lorem,
        'btn_text' => mindshows_field('devpage_book_button_text') ?: $v['book_btn'],
        'btn_href' => $v['btn_href'],
    );

    return array(
        'hero' => $hero,
        'dirs' => array('cards' => $cards, 'symbol' => $img_dir . $v['symbol']),
        'book' => $book,
    );
}
