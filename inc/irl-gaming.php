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
    foreach (array('galerie' => 'Galerie', 'about' => 'Concept Rows', 'detalii' => 'Detalii', 'pentru_tine' => 'Pentru Tine', 'booking' => 'Inscriere') as $slug => $label) {
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

    $defaults = mindshows_irl_booking_defaults();
    $text = function ($name, $label, $type = 'text', $extra = array()) use ($defaults) {
        return array_merge(array(
            'key' => "field_{$name}",
            'label' => $label,
            'name' => $name,
            'type' => $type,
            'default_value' => $defaults[$name],
        ), $extra);
    };

    acf_add_local_field_group(array(
        'key' => 'group_irl_booking',
        'title' => '09 Inscriere Section',
        'fields' => array(
            $text('irl_booking_title', 'Section Title'),
            $text('irl_public_title', 'Public Games: Title', 'text', array('wrapper' => array('width' => '50'))),
            $text('irl_public_subtitle', 'Public Games: Subtitle', 'text', array('wrapper' => array('width' => '50'))),
            $text('irl_public_desc', 'Public Games: Description', 'textarea', array('rows' => 3)),
            $text('irl_private_title', 'Private Games: Title', 'text', array('wrapper' => array('width' => '50'))),
            $text('irl_private_subtitle', 'Private Games: Subtitle', 'text', array('wrapper' => array('width' => '50'))),
            $text('irl_private_desc', 'Private Games: Description', 'textarea', array('rows' => 3)),
            $text('irl_public_intro', 'Public Games: Text deasupra formularului', 'textarea', array('rows' => 2, 'instructions' => 'Lasa gol pentru a nu afisa textul.')),
            $text('irl_private_intro', 'Private Games: Text deasupra formularului', 'textarea', array('rows' => 2, 'instructions' => 'Lasa gol pentru a nu afisa textul.')),
            $text('irl_signup_text', 'Buton calendar (Public Games)', 'text', array('wrapper' => array('width' => '50'))),
            $text('irl_submit_text', 'Buton trimitere formular', 'text', array('wrapper' => array('width' => '50'))),
            $text('irl_empty_title', 'Titlu cand nu sunt jocuri programate'),
            $text('irl_empty_text', 'Mesaj cand nu sunt jocuri programate', 'textarea', array('rows' => 2)),
            $text('irl_location_types', 'Private Games: Tipuri de locatie', 'textarea', array('rows' => 6, 'instructions' => 'O optiune pe linie.', 'wrapper' => array('width' => '50'))),
            $text('irl_objectives', 'Private Games: Obiectivul evenimentului', 'textarea', array('rows' => 6, 'instructions' => 'O optiune pe linie.', 'wrapper' => array('width' => '50'))),
        ),
        'location' => $location,
        'menu_order' => 9,
    ));
}
add_action('acf/init', 'mindshows_register_irl_gaming_acf_fields');

function mindshows_irl_booking_defaults() {
    $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis,';
    return array(
        'irl_booking_title'    => 'INSCRIERE',
        'irl_public_title'     => 'Public Games',
        'irl_public_subtitle'  => 'Join an Available Group',
        'irl_public_desc'      => $lorem,
        'irl_private_title'    => 'Private Games',
        'irl_private_subtitle' => 'Give your Team the Best Experience',
        'irl_private_desc'     => $lorem,
        'irl_public_intro'     => 'Rezerva-ti locul la unul dintre jocurile publice programate.',
        'irl_private_intro'    => 'Cere o oferta pentru un joc private pentru grupul tau de prieteni sau echipa ta',
        'irl_signup_text'      => 'Sign Up',
        'irl_submit_text'      => 'Trimite',
        'irl_empty_title'      => 'Nicio data disponibila momentan',
        'irl_empty_text'       => 'Momentan nu sunt jocuri programate. Alege Private Games pentru o rezervare privată.',
        'irl_location_types'   => "Clasa\nSala de sedinte\nAcasa\nCabana\nTeren de sport\nAlta varianta",
        'irl_objectives'       => "Divertisment\nTeam building\nSoft skills development\nAltul",
    );
}

function mindshows_irl_lines($text) {
    return array_values(array_filter(array_map('sanitize_text_field', preg_split('/\R/', (string) $text))));
}

function mindshows_irl_booking_settings($post_id) {
    $defaults = mindshows_irl_booking_defaults();
    $settings = array();
    foreach ($defaults as $name => $default) {
        $value = get_field($name, $post_id);
        $settings[$name] = in_array($name, array('irl_public_intro', 'irl_private_intro'), true) ? trim((string) ($value ?? $default)) : ($value ?: $default);
    }
    foreach (array('irl_location_types', 'irl_objectives') as $name) {
        $settings[$name] = mindshows_irl_lines($settings[$name]) ?: mindshows_irl_lines($defaults[$name]);
    }
    return $settings;
}

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

function mindshows_register_irl_booking_cpt() {
    register_post_type('irl_booking', array(
        'public'       => false,
        'show_ui'      => true,
        'label'        => 'IRL Gaming Enrollments',
        'menu_icon'    => 'dashicons-groups',
        'supports'     => array('title'),
        'show_in_rest' => false,
    ));
}
add_action('init', 'mindshows_register_irl_booking_cpt', 5);

function mindshows_irl_submit_booking_handler() {
    $field = function ($key) {
        return isset($_POST[$key]) ? sanitize_text_field(wp_unslash($_POST[$key])) : '';
    };
    $fail = function ($message) {
        wp_send_json_error(array('message' => $message));
    };

    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    if (!$post_id || get_post_type($post_id) !== 'irl_gaming' || get_post_status($post_id) !== 'publish') {
        $fail('Jocul selectat nu mai este disponibil.');
    }

    $mode         = $field('mode') === 'private' ? 'private' : 'public';
    $name         = $field('name');
    $phone        = $field('phone');
    $email        = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $participants = isset($_POST['participants']) ? (int) $_POST['participants'] : 0;

    if (!mindshows_booking_contact_valid($name, $phone, $email) || $participants < 1 || $participants > 999) {
        $fail('Te rugăm să completezi corect toate câmpurile obligatorii.');
    }

    $game  = get_the_title($post_id);
    $today = current_time('Y-m-d');
    $data  = array();

    if ($mode === 'public') {
        $iso  = $field('date_iso');
        $time = $field('time');
        $city = $field('city');
        $slot = null;
        foreach (mindshows_dev_expand_sessions($post_id) as $candidate) {
            if ($candidate['date_start'] === $iso && $candidate['time'] === $time && $candidate['city'] === $city && $candidate['date_end'] >= $today) {
                $slot = $candidate;
                break;
            }
        }
        if (!$slot) {
            $fail('Data selectată nu mai este disponibilă. Te rugăm să alegi altă dată.');
        }
        $data['date']     = html_entity_decode(mindshows_dev_format_range($slot), ENT_QUOTES, 'UTF-8') . ' ' . substr($slot['date_start'], 0, 4);
        $data['time']     = $slot['time'];
        $data['location'] = $slot['city'];
    } else {
        $settings = mindshows_irl_booking_settings($post_id);
        $date     = $field('date');
        $parts    = explode('-', $date);
        $valid    = preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) && checkdate((int) $parts[1], (int) $parts[2], (int) $parts[0]);
        if (!$valid || $date < $today) {
            $fail('Te rugăm să alegi o dată validă, din viitor.');
        }
        $location      = $field('location');
        $location_type = $field('location_type');
        $objective     = $field('objective');
        if (mb_strlen($location) < 2 || !in_array($location_type, $settings['irl_location_types'], true) || !in_array($objective, $settings['irl_objectives'], true)) {
            $fail('Te rugăm să completezi corect toate câmpurile obligatorii.');
        }
        $data['date']          = date('d.m.Y', strtotime($date));
        $data['time']          = '';
        $data['location']      = $location;
        $data['location_type'] = $location_type;
        $data['objective']     = $objective;
    }

    $type_label = $mode === 'public' ? 'Public' : 'Privat';
    $booking_id = wp_insert_post(array(
        'post_type'   => 'irl_booking',
        'post_title'  => $name . ' – ' . $game . ' (' . $type_label . ')',
        'post_status' => 'publish',
    ));
    if (is_wp_error($booking_id) || !$booking_id) {
        $fail('A apărut o eroare la salvarea rezervării.');
    }

    $meta = array_merge(array(
        'type'          => $mode,
        'name'          => $name,
        'phone'         => $phone,
        'email'         => $email,
        'participants'  => $participants,
        'game'          => $game,
        'game_id'       => $post_id,
        'location_type' => '',
        'objective'     => '',
        'created'       => current_time('mysql'),
    ), $data);
    foreach ($meta as $key => $value) {
        update_post_meta($booking_id, 'irl_bk_' . $key, $value);
    }

    $rows = array(
        'Tip rezervare'     => $mode === 'public' ? 'Joc public' : 'Joc privat',
        'Joc'               => $game,
        'Data'              => $meta['date'],
        'Interval orar'     => $meta['time'],
        'Locatie'           => $meta['location'],
        'Tip locatie'       => $meta['location_type'],
        'Obiectiv'          => $meta['objective'],
        'Numar participanti' => (string) $participants,
    );

    mindshows_booking_respond(
        array(
            'message' => 'Rezervarea a fost trimisă cu succes!',
            'date'    => $meta['date'],
            'time'    => $meta['time'],
        ),
        array(
            array(
                get_option('admin_email'),
                'Rezervare noua IRL Gaming (' . $type_label . '): ' . $game . ' - ' . $name,
                'Rezervare noua IRL Gaming',
                'Trimis automat din platforma Mind Shows la ' . current_time('d.m.Y H:i') . '.',
                array_merge($rows, array('Nume' => $name, 'Telefon' => $phone, 'Email' => $email)),
            ),
            array(
                $email,
                'Am primit rezervarea ta - ' . $game,
                $mode === 'public' ? 'Am primit rezervarea ta' : 'Am primit cererea ta de ofertă',
                'Salut ' . $name . ', îți mulțumim! Te contactăm în cel mai scurt timp pentru confirmare și detalii.',
                $rows,
            ),
        )
    );
}
add_action('wp_ajax_irl_submit_booking', 'mindshows_irl_submit_booking_handler');
add_action('wp_ajax_nopriv_irl_submit_booking', 'mindshows_irl_submit_booking_handler');

function mindshows_irl_booking_columns($columns) {
    return array(
        'cb'              => '<input type="checkbox" />',
        'title'           => 'Rezervare',
        'bk_type'         => 'Tip',
        'bk_name'         => 'Nume',
        'bk_phone'        => 'Telefon',
        'bk_email'        => 'Email',
        'bk_game'         => 'Joc',
        'bk_date'         => 'Data / Ora',
        'bk_participants' => 'Participanti',
        'bk_location'     => 'Locatie',
        'date'            => 'Data Trimisă',
    );
}
add_filter('manage_irl_booking_posts_columns', 'mindshows_irl_booking_columns');

function mindshows_irl_booking_column_data($column, $post_id) {
    $meta = function ($key) use ($post_id) {
        return (string) get_post_meta($post_id, 'irl_bk_' . $key, true);
    };
    switch ($column) {
        case 'bk_type':
            echo $meta('type') === 'private' ? 'Privat' : 'Public';
            break;
        case 'bk_name':
        case 'bk_game':
        case 'bk_participants':
            echo esc_html($meta(substr($column, 3)) ?: '—');
            break;
        case 'bk_phone':
            $phone = $meta('phone');
            echo $phone ? '<a href="tel:' . esc_attr($phone) . '">' . esc_html($phone) . '</a>' : '—';
            break;
        case 'bk_email':
            $email = $meta('email');
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
            break;
        case 'bk_date':
            echo esc_html(trim($meta('date') . ($meta('time') ? ' (' . $meta('time') . ')' : '')) ?: '—');
            break;
        case 'bk_location':
            echo esc_html(implode(' · ', array_filter(array($meta('location'), $meta('location_type'), $meta('objective')))) ?: '—');
            break;
    }
}
add_action('manage_irl_booking_posts_custom_column', 'mindshows_irl_booking_column_data', 10, 2);
