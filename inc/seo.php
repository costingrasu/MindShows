<?php

if (!defined('ABSPATH')) {
    exit;
}

function mindshows_is_fallback_view() {
    if (is_404()) {
        return true;
    }
    if (is_front_page()) {
        return false;
    }
    $fallback_archive = is_archive() && !is_post_type_archive(array('journey', 'development'));
    return is_search() || $fallback_archive || is_attachment() || is_home() || is_singular('post');
}

function mindshows_is_home_view() {
    return is_front_page() || is_404();
}

function mindshows_rm_robots($robots) {
    if (mindshows_is_fallback_view()) {
        $robots['index']  = 'noindex';
        $robots['follow'] = 'follow';
    }
    return $robots;
}
add_filter('rank_math/frontend/robots', 'mindshows_rm_robots', 20);

function mindshows_core_robots($robots) {
    if (mindshows_is_fallback_view()) {
        $robots['noindex'] = true;
        $robots['follow']  = true;
        unset($robots['index']);
    }
    return $robots;
}
add_filter('wp_robots', 'mindshows_core_robots', 20);

function mindshows_img_alt($image, $fallback = '') {
    if (is_array($image) && !empty($image['alt'])) {
        return $image['alt'];
    }
    if (is_numeric($image)) {
        $alt = get_post_meta((int) $image, '_wp_attachment_image_alt', true);
        if ($alt) {
            return $alt;
        }
    }
    return $fallback;
}

function mindshows_lasertag_hero_url($hero_sec = null) {
    if ($hero_sec === null && function_exists('get_field')) {
        $hero_sec = get_field('lt_hero_section');
    }
    return (is_array($hero_sec) && !empty($hero_sec['bg_image']['url'])) ? $hero_sec['bg_image']['url'] : get_template_directory_uri() . '/assets/images/Hero.webp';
}

function mindshows_preload_lasertag_hero() {
    if (!is_page_template('page-lasertag.php')) {
        return;
    }
    echo '<link rel="preload" as="image" href="' . esc_url(mindshows_lasertag_hero_url()) . '" fetchpriority="high">' . "\n";
}
add_action('wp_head', 'mindshows_preload_lasertag_hero', 2);

function mindshows_dev_is_seo_context() {
    return is_page_template('development.php') || is_singular('development');
}

function mindshows_dev_seo_is_placeholder($text) {
    $text = trim((string) $text);
    if ($text === '') {
        return true;
    }
    if (stripos($text, 'lorem ipsum') === 0) {
        return true;
    }
    return in_array(strtolower($text), array('empty subtitle', 'empty'), true);
}

function mindshows_dev_seo_clean($text, $max = 155) {
    $text = wp_strip_all_tags((string) $text);
    $text = trim(preg_replace('/\s+/u', ' ', $text));

    if (mb_strlen($text) <= $max) {
        return $text;
    }

    $cut = mb_substr($text, 0, $max);
    $space = mb_strrpos($cut, ' ');
    if ($space !== false && $space > $max * 0.6) {
        $cut = mb_substr($cut, 0, $space);
    }

    return rtrim($cut, " ,;:-–") . '…';
}

function mindshows_dev_seo_description($post_id = 0) {
    static $cache = array();
    $post_id = $post_id ? (int) $post_id : get_queried_object_id();
    if (isset($cache[$post_id])) {
        return $cache[$post_id];
    }
    $candidates = array();

    if (function_exists('get_field')) {
        if (get_post_type($post_id) === 'development') {
            $candidates[] = get_field('dev_hero_description', $post_id);
            $candidates[] = get_field('dev_hero_subtitle', $post_id);
        } else {
            $candidates[] = get_field('devpage_hero_description', $post_id);
        }
    }
    $candidates[] = get_post_field('post_excerpt', $post_id);

    foreach ($candidates as $candidate) {
        if (!mindshows_dev_seo_is_placeholder(wp_strip_all_tags((string) $candidate))) {
            return $cache[$post_id] = mindshows_dev_seo_clean($candidate);
        }
    }

    $title = get_the_title($post_id);
    $tagline = get_bloginfo('description');

    return $cache[$post_id] = mindshows_dev_seo_clean($tagline ? $title . ' – ' . $tagline : $title);
}

function mindshows_dev_hero_url($post_id = 0) {
    $hero = null;
    if (function_exists('get_field')) {
        $hero = $post_id ? get_field('devpage_hero_bg_image', $post_id) : get_field('devpage_hero_bg_image');
    }
    return (is_array($hero) && !empty($hero['url'])) ? $hero['url'] : get_template_directory_uri() . '/assets/images/bg-development.webp';
}

function mindshows_dev_seo_image($post_id = 0) {
    static $cache = array();
    $post_id = $post_id ? (int) $post_id : get_queried_object_id();
    if (!isset($cache[$post_id])) {
        $cache[$post_id] = mindshows_dev_seo_image_uncached($post_id);
    }
    return $cache[$post_id];
}

function mindshows_dev_seo_image_uncached($post_id) {
    $fallback = get_template_directory_uri() . '/assets/images/bg-development.webp';

    if (!function_exists('get_field')) {
        return $fallback;
    }

    if (get_post_type($post_id) === 'development') {
        $card = get_field('dev_card_image', $post_id);
        if (is_array($card)) {
            if (!empty($card['sizes']['large'])) {
                return $card['sizes']['large'];
            }
            if (!empty($card['url'])) {
                return $card['url'];
            }
        }
        if (has_post_thumbnail($post_id)) {
            return get_the_post_thumbnail_url($post_id, 'large');
        }
        return $fallback;
    }

    return mindshows_dev_hero_url($post_id);
}

function mindshows_dev_rm_description($description) {
    if (!mindshows_dev_is_seo_context()) {
        return $description;
    }
    if (!mindshows_dev_seo_is_placeholder(wp_strip_all_tags((string) $description))) {
        return $description;
    }
    return mindshows_dev_seo_description();
}
add_filter('rank_math/frontend/description', 'mindshows_dev_rm_description', 20);
add_filter('rank_math/opengraph/facebook/og_description', 'mindshows_dev_rm_description', 20);
add_filter('rank_math/opengraph/twitter/twitter_description', 'mindshows_dev_rm_description', 20);

function mindshows_dev_rm_image($image) {
    if (!mindshows_dev_is_seo_context()) {
        return $image;
    }
    if (get_post_meta(get_queried_object_id(), 'rank_math_facebook_image', true)) {
        return $image;
    }
    return mindshows_dev_seo_image();
}
add_filter('rank_math/opengraph/facebook/image', 'mindshows_dev_rm_image', 20);
add_filter('rank_math/opengraph/twitter/image', 'mindshows_dev_rm_image', 20);

function mindshows_dev_seo_workload($time, $days) {
    if (!preg_match('/(\d{1,2})[:.](\d{2})\s*[-–]\s*(\d{1,2})[:.](\d{2})/u', (string) $time, $m)) {
        return null;
    }
    $minutes = ((int) $m[3] * 60 + (int) $m[4]) - ((int) $m[1] * 60 + (int) $m[2]);
    if ($minutes <= 0) {
        return null;
    }
    $minutes *= max(1, (int) $days);

    $hours = intdiv($minutes, 60);
    $rest = $minutes % 60;

    return 'PT' . ($hours ? $hours . 'H' : '') . ($rest ? $rest . 'M' : '');
}

function mindshows_dev_course_schema($post_id) {
    $post_id = (int) $post_id;
    $today = current_time('Y-m-d');

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Course',
        'name'        => get_the_title($post_id),
        'description' => mindshows_dev_seo_description($post_id),
        'url'         => get_permalink($post_id),
        'image'       => mindshows_dev_seo_image($post_id),
        'provider'    => array(
            '@type' => 'Organization',
            'name'  => 'Mind Shows',
            'url'   => home_url('/'),
        ),
    );

    $offer = array(
        '@type'         => 'Offer',
        'category'      => 'Paid',
        'priceCurrency' => 'RON',
        'url'           => get_permalink($post_id),
    );
    $price_field = function_exists('get_field') ? get_field('dev_detaliu_1', $post_id) : null;
    $price_value = is_array($price_field) && isset($price_field['value']) ? (string) $price_field['value'] : '';
    if (preg_match('/\d+(?:[.,]\d+)?/', $price_value, $pm)) {
        $price = str_replace(',', '.', $pm[0]);
        $offer['price'] = $price;
        if ((float) $price === 0.0) {
            $offer['category'] = 'Free';
        }
    } elseif (stripos($price_value, 'gratuit') !== false || stripos($price_value, 'free') !== false) {
        $offer['category'] = 'Free';
        $offer['price'] = '0';
    }

    $instances = array();
    if (function_exists('mindshows_dev_expand_sessions')) {
        foreach (mindshows_dev_expand_sessions($post_id) as $slot) {
            if ($slot['date_end'] < $today) {
                continue;
            }
            $instance = array(
                '@type'      => 'CourseInstance',
                'courseMode' => 'Onsite',
                'startDate'  => $slot['date_start'],
                'endDate'    => $slot['date_end'],
                'location'   => array(
                    '@type'   => 'Place',
                    'name'    => $slot['city'],
                    'address' => array(
                        '@type'           => 'PostalAddress',
                        'addressLocality' => $slot['city'],
                        'addressCountry'  => 'RO',
                    ),
                ),
            );
            $workload = mindshows_dev_seo_workload($slot['time'], count($slot['days']));
            if ($workload) {
                $instance['courseWorkload'] = $workload;
            }
            $instances[] = $instance;
        }
    }

    if (!empty($instances)) {
        $offer['availability'] = 'https://schema.org/InStock';
        $schema['hasCourseInstance'] = $instances;
    }
    $schema['offers'] = $offer;

    return $schema;
}

function mindshows_dev_course_list_schema() {
    $courses = function_exists('mindshows_dev_all_courses') ? mindshows_dev_all_courses() : array();
    if (empty($courses)) {
        return null;
    }

    $items = array();
    foreach (array_values($courses) as $i => $course) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'url'      => $course['permalink'],
        );
    }

    return array(
        '@context'        => 'https://schema.org',
        '@type'           => 'ItemList',
        'itemListElement' => $items,
    );
}

function mindshows_dev_print_jsonld($schema) {
    if (empty($schema)) {
        return;
    }
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

function mindshows_dev_structured_data() {
    if (is_singular('development')) {
        mindshows_dev_print_jsonld(mindshows_dev_course_schema(get_queried_object_id()));
    } elseif (is_page_template('development.php')) {
        mindshows_dev_print_jsonld(mindshows_dev_course_list_schema());
    }
}
add_action('wp_head', 'mindshows_dev_structured_data', 5);

function mindshows_dev_preload_hero() {
    if (!is_page_template('development.php')) {
        return;
    }
    echo '<link rel="preload" as="image" href="' . esc_url(mindshows_dev_hero_url()) . '" fetchpriority="high">' . "\n";
}
add_action('wp_head', 'mindshows_dev_preload_hero', 2);
