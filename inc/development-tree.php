<?php

if (!defined('ABSPATH')) {
    exit;
}

function mindshows_get_development_page_id() {
    static $cached_id = null;
    if ($cached_id !== null) {
        return $cached_id;
    }

    $pages = get_pages(array(
        'meta_key'   => '_wp_page_template',
        'meta_value' => 'development.php',
        'number'     => 1,
    ));

    $cached_id = !empty($pages) ? (int) $pages[0]->ID : 0;
    if (!$cached_id) {
        $page = get_page_by_path('development');
        $cached_id = $page ? (int) $page->ID : 0;
    }

    return $cached_id;
}

function mindshows_get_tree_branch_defaults() {
    return array(
        array(
            'title' => 'DEZVOLTARE PERSONALĂ CONȘTIENTĂ',
            'nodes' => array(
                array( 'title' => 'Primul pas în dezvoltare', 'desc' => 'Autocunoaștere și principii de creștere' ),
                array( 'title' => 'Dincolo de gânduri', 'desc' => 'Ce se întamplă, de fapt, în mintea noastră' ),
                array( 'title' => 'Cu și despre emoții', 'desc' => 'Identificare și reglarea emoțională' ),
                array( 'title' => 'Principii și valori', 'desc' => 'Identificarea și ierarhizarea valorilor de viață' ),
            ),
        ),
        array(
            'title' => 'LEADERSHIP',
            'nodes' => array(
                array( 'title' => '', 'desc' => 'Ce este leadershipul și ce tip de lider vreau să devin?' ),
                array( 'title' => '', 'desc' => 'Cum mă comport și cum vorbesc ca un lider?' ),
                array( 'title' => '', 'desc' => 'Cum ajut și cum inspir oamenii ca un lider?' ),
                array( 'title' => '', 'desc' => 'Când sunt lider și când sunt team player?' ),
            ),
        ),
        array(
            'title' => 'COMUNICARE',
            'nodes' => array(
                array( 'title' => 'Bazele comunicării', 'desc' => 'Tipuri de comunicare, factori și mijloace de comunicare' ),
                array( 'title' => '', 'desc' => 'Tehnici pentru comunicarea eficientă' ),
                array( 'title' => '', 'desc' => 'Perspective, asertivitate și gestionarea conflictelor' ),
                array( 'title' => '', 'desc' => 'Comunicarea cu grupuri, public, audiență' ),
            ),
        ),
    );
}

function mindshows_tree_branch_nodes($branch) {
    $raw = array();

    if ($branch && !empty($branch['nodes']) && is_array($branch['nodes'])) {
        $raw = $branch['nodes'];
    } elseif ($branch) {
        for ($i = 1; $i <= 10; $i++) {
            if (isset($branch['node_' . $i]) && is_array($branch['node_' . $i])) {
                $raw[] = $branch['node_' . $i];
            }
        }
    }

    $nodes = array();
    foreach ($raw as $node) {
        $title = isset($node['title']) ? trim($node['title']) : '';
        $desc  = isset($node['desc']) ? trim($node['desc']) : '';
        if ($title === '' && $desc === '') {
            continue;
        }

        $url = (!empty($node['link']) && get_post_status($node['link']) === 'publish') ? get_permalink($node['link']) : '';

        $nodes[] = array(
            'title' => $title,
            'desc'  => $desc,
            'url'   => $url ? $url : '',
        );
    }

    return $nodes;
}

function mindshows_get_development_tree($page_id = 0) {
    static $cache = array();

    $page_id = (int) $page_id;
    if (!$page_id) {
        $page_id = mindshows_get_development_page_id();
    }

    if (isset($cache[$page_id])) {
        return $cache[$page_id];
    }

    $has_acf = ($page_id && function_exists('get_field'));

    $root_title = $has_acf ? get_field('devpage_tree_root_title', $page_id) : '';
    $root_desc  = $has_acf ? get_field('devpage_tree_root_desc', $page_id) : '';

    $tree = array(
        'root_title' => !empty($root_title) ? $root_title : 'TRIAL',
        'root_desc'  => !empty($root_desc) ? $root_desc : 'Descoperă seria de MAIN QUESTS gratuit, fără niciun angajament.',
        'branches'   => array(),
    );

    $defaults = mindshows_get_tree_branch_defaults();
    foreach ($defaults as $b => $default) {
        $branch = $has_acf ? get_field('devpage_tree_branch' . $b, $page_id) : null;
        $branch = is_array($branch) ? $branch : null;

        $nodes = mindshows_tree_branch_nodes($branch);

        $tree['branches'][] = array(
            'title' => ($branch && !empty($branch['title'])) ? $branch['title'] : $default['title'],
            'nodes' => !empty($nodes) ? $nodes : mindshows_tree_branch_nodes($default),
        );
    }

    $cache[$page_id] = $tree;

    return $tree;
}

function mindshows_migrate_tree_to_development_page() {
    if (get_option('mindshows_tree_moved_v1')) {
        return;
    }

    if (!function_exists('get_field') || !function_exists('update_field')) {
        return;
    }

    $dev_id = mindshows_get_development_page_id();
    $fp_id  = (int) get_option('page_on_front');

    if (!$dev_id || !$fp_id) {
        return;
    }

    $root_keys = array(
        array('field_devpage_tree_root_t', 'development_section_root_title', 'devpage_tree_root_title'),
        array('field_devpage_tree_root_d', 'development_section_root_desc', 'devpage_tree_root_desc'),
    );

    foreach ($root_keys as $keys) {
        list($field_key, $old_meta_key, $new_meta_key) = $keys;

        $old = get_post_meta($fp_id, $old_meta_key, true);
        if (empty($old)) {
            continue;
        }
        if (!metadata_exists('post', $dev_id, $new_meta_key)) {
            update_field($field_key, $old, $dev_id);
        }
    }

    for ($b = 0; $b <= 2; $b++) {
        $prefix  = 'development_section_branch' . $b . '_';
        $title   = get_post_meta($fp_id, $prefix . 'title', true);
        $rows    = (int) get_post_meta($fp_id, $prefix . 'nodes', true);
        $nodes   = array();

        for ($i = 0; $i < $rows; $i++) {
            $nodes[] = array(
                'field_devpage_tree_b' . $b . '_node_t'    => get_post_meta($fp_id, $prefix . 'nodes_' . $i . '_title', true),
                'field_devpage_tree_b' . $b . '_node_d'    => get_post_meta($fp_id, $prefix . 'nodes_' . $i . '_desc', true),
                'field_devpage_tree_b' . $b . '_node_link' => get_post_meta($fp_id, $prefix . 'nodes_' . $i . '_link', true),
            );
        }

        if (empty($nodes)) {
            for ($i = 1; $i <= 10; $i++) {
                $legacy_title = get_post_meta($fp_id, $prefix . 'node_' . $i . '_title', true);
                $legacy_desc  = get_post_meta($fp_id, $prefix . 'node_' . $i . '_desc', true);
                if (empty($legacy_title) && empty($legacy_desc)) {
                    continue;
                }
                $nodes[] = array(
                    'field_devpage_tree_b' . $b . '_node_t' => $legacy_title,
                    'field_devpage_tree_b' . $b . '_node_d' => $legacy_desc,
                );
            }
        }

        if (empty($title) && empty($nodes)) {
            continue;
        }

        $new_prefix = 'devpage_tree_branch' . $b . '_';
        if (metadata_exists('post', $dev_id, $new_prefix . 'title') || metadata_exists('post', $dev_id, $new_prefix . 'nodes')) {
            continue;
        }

        update_field('field_devpage_tree_b' . $b, array(
            'title' => $title,
            'nodes' => $nodes,
        ), $dev_id);
    }

    update_option('mindshows_tree_moved_v1', 1);
}
add_action('init', 'mindshows_migrate_tree_to_development_page');
