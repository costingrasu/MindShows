<?php

if (!defined('ABSPATH')) {
    exit;
}

function mindshows_dev_expand_sessions($post_id) {
    $raw = get_post_meta($post_id, '_dev_sessions', true);
    if (!is_array($raw) || empty($raw['sessions']) || !is_array($raw['sessions'])) {
        return array();
    }

    $out = array();

    foreach ($raw['sessions'] as $city => $items) {
        if (!is_array($items)) {
            continue;
        }

        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            $days = (isset($item['days']) && is_array($item['days'])) ? array_map('intval', $item['days']) : array();
            $days = array_values(array_unique(array_filter($days, function ($d) {
                return $d >= 1 && $d <= 31;
            })));
            sort($days);

            if (empty($days)) {
                continue;
            }

            $year  = isset($item['year']) ? (int) $item['year'] : 0;
            $month = isset($item['month']) ? (int) $item['month'] : -1;

            if ($year < 1970 || $month < 0 || $month > 11) {
                continue;
            }

            $first = $days[0];
            $last  = $days[count($days) - 1];

            if (!checkdate($month + 1, $first, $year) || !checkdate($month + 1, $last, $year)) {
                continue;
            }

            $out[] = array(
                'city'       => (string) $city,
                'days'       => $days,
                'date_start' => sprintf('%04d-%02d-%02d', $year, $month + 1, $first),
                'date_end'   => sprintf('%04d-%02d-%02d', $year, $month + 1, $last),
                'time'       => !empty($item['time']) ? (string) $item['time'] : '9:00 - 17:00',
                'title'      => isset($item['title']) ? (string) $item['title'] : '',
            );
        }
    }

    return $out;
}

function mindshows_dev_has_upcoming($post_id) {
    $today = current_time('Y-m-d');

    foreach (mindshows_dev_expand_sessions($post_id) as $slot) {
        if ($slot['date_end'] >= $today) {
            return true;
        }
    }

    return false;
}

function mindshows_dev_format_range($slot) {
    $months = array('IAN', 'FEB', 'MAR', 'APR', 'MAI', 'IUN', 'IUL', 'AUG', 'SEP', 'OCT', 'NOI', 'DEC');

    $m     = (int) substr($slot['date_start'], 5, 2) - 1;
    $mon   = isset($months[$m]) ? $months[$m] : '';
    $first = $slot['days'][0];
    $last  = $slot['days'][count($slot['days']) - 1];

    if ($first === $last) {
        return sprintf('%02d %s', $first, $mon);
    }

    return sprintf('%02d&ndash;%02d %s', $first, $last, $mon);
}

function mindshows_get_development_schedule() {
    $cached = get_transient('mindshows_dev_schedule_v1');
    if (is_array($cached)) {
        return $cached;
    }

    $today = current_time('Y-m-d');

    $ids = get_posts(array(
        'post_type'      => 'development',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
    ));

    $rows   = array();
    $cities = array();

    foreach ($ids as $pid) {
        $quest = get_post_meta($pid, 'dev_quest_type', true);
        if ($quest !== 'side') {
            $quest = 'main';
        }

        foreach (mindshows_dev_expand_sessions($pid) as $slot) {
            if ($slot['date_end'] < $today) {
                continue;
            }

            $cities[$slot['city']] = true;

            $rows[] = array(
                'post_id'    => (int) $pid,
                'post_title' => get_the_title($pid),
                'permalink'  => get_permalink($pid),
                'quest'      => $quest,
                'city'       => $slot['city'],
                'date_start' => $slot['date_start'],
                'date_end'   => $slot['date_end'],
                'label'      => mindshows_dev_format_range($slot),
                'time'       => $slot['time'],
            );
        }
    }

    usort($rows, function ($a, $b) {
        if ($a['date_start'] === $b['date_start']) {
            return strcmp($a['time'], $b['time']);
        }
        return strcmp($a['date_start'], $b['date_start']);
    });

    $cities = array_keys($cities);
    sort($cities);

    $out = array('rows' => $rows, 'cities' => $cities);
    set_transient('mindshows_dev_schedule_v1', $out, 12 * HOUR_IN_SECONDS);

    return $out;
}

function mindshows_dev_slot_link($row) {
    if (empty($row['date_start'])) {
        return $row['permalink'];
    }
    return add_query_arg(array(
        'ms_city' => rawurlencode($row['city']),
        'ms_date' => $row['date_start'],
        'ms_time' => rawurlencode($row['time']),
    ), $row['permalink']) . '#dev-inscriere';
}

function mindshows_dev_all_courses() {
    $cached = get_transient('mindshows_dev_all_courses_v1');
    if (is_array($cached)) {
        return $cached;
    }

    $ids = get_posts(array(
        'post_type'      => 'development',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));

    $out = array();
    foreach ($ids as $pid) {
        $out[] = array(
            'id'        => (int) $pid,
            'title'     => get_the_title($pid),
            'permalink' => get_permalink($pid),
        );
    }

    set_transient('mindshows_dev_all_courses_v1', $out, 12 * HOUR_IN_SECONDS);

    return $out;
}

function mindshows_dev_flush_schedule_cache($post_id = 0) {
    if (!$post_id || get_post_type($post_id) === 'development') {
        delete_transient('mindshows_dev_schedule_v1');
        delete_transient('mindshows_dev_all_courses_v1');
    }
}
add_action('save_post', 'mindshows_dev_flush_schedule_cache');
add_action('before_delete_post', 'mindshows_dev_flush_schedule_cache');
