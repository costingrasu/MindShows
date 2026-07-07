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

  wp_localize_script('journey-main-js', 'ltAjax', array(
      'url'   => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('lt_booking_nonce'),
  ));
}
add_action('wp_enqueue_scripts', 'journey_theme_scripts');

function lt_register_booking_cpt() {
    $args = array(
        'public'       => false,
        'show_ui'      => true,
        'label'        => 'LT Bookings',
        'menu_icon'    => 'dashicons-tickets-alt',
        'supports'     => array('title'),
        'show_in_rest' => false,
    );
    register_post_type('lasertag_booking', $args);
}
add_action('init', 'lt_register_booking_cpt');

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Lasertag Settings',
        'menu_title' => 'Lasertag Settings',
        'menu_slug'  => 'lasertag-settings',
        'capability' => 'edit_posts',
        'icon_url'   => 'dashicons-superhero',
        'redirect'   => false,
    ));
}

function lt_calculate_slots($date, $rounds) {
    if (!$date || !$rounds) {
        return array('slots' => array(), 'closed' => false);
    }
    $closed_dates = get_field('lt_closed_dates', 'option');
    if ($closed_dates && is_array($closed_dates)) {
        foreach ($closed_dates as $row) {
            if ($row['lt_closed_date'] === $date) {
                return array('slots' => array(), 'closed' => true);
            }
        }
    }

    $opening_time = get_field('lt_opening_time', 'option');
    $closing_time = get_field('lt_closing_time', 'option');

    if (!$opening_time) $opening_time = '10:00';
    if (!$closing_time) $closing_time = '21:00';

    $start = strtotime($opening_time);
    $end = strtotime($closing_time);
    $all_slots = array();
    while ($start < $end) {
        $all_slots[] = date('H:i', $start);
        $start = strtotime('+30 minutes', $start);
    }

    $args = array(
        'post_type'      => 'lasertag_booking',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => 'lt_book_date',
                'value'   => $date,
                'compare' => '=',
            ),
        ),
    );
    $query = new WP_Query($args);
    $booked_slots = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $slots_repeater = get_field('lt_book_slots');
            if ($slots_repeater && is_array($slots_repeater)) {
                foreach ($slots_repeater as $row) {
                    if (!empty($row['lt_slot_time'])) {
                        $booked_slots[] = $row['lt_slot_time'];
                    }
                }
            }
        }
        wp_reset_postdata();
    }

    $grid = array();
    foreach ($all_slots as $s) {
        $grid[] = array(
            't'    => $s,
            'open' => !in_array($s, $booked_slots),
        );
    }

    $valid_starts = array();
    $rounds = intval($rounds);
    $total_slots = count($grid);

    for ($i = 0; $i + $rounds <= $total_slots; $i++) {
        $ok = true;
        for ($k = 0; $k < $rounds; $k++) {
            if (!$grid[$i + $k]['open']) {
                $ok = false;
                break;
            }
        }
        if ($ok) {
            $valid_starts[] = $grid[$i]['t'];
        }
    }

    return array('slots' => $valid_starts, 'closed' => false);
}

function lt_get_slots_handler() {
    check_ajax_referer('lt_booking_nonce', 'nonce');
    $date = sanitize_text_field($_POST['date']);
    $rounds = intval($_POST['rounds']);

    $res = lt_calculate_slots($date, $rounds);
    wp_send_json($res);
}
add_action('wp_ajax_lt_get_slots', 'lt_get_slots_handler');
add_action('wp_ajax_nopriv_lt_get_slots', 'lt_get_slots_handler');

function lt_submit_booking_handler() {
    check_ajax_referer('lt_booking_nonce', 'nonce');

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $city = sanitize_text_field($_POST['city']);
    $players = intval($_POST['players']);
    $game_mode = sanitize_text_field($_POST['gameMode']);
    $date = sanitize_text_field($_POST['date']);
    $rounds = intval($_POST['rounds']);
    $start_time = sanitize_text_field($_POST['startTime']);

    $avail = lt_calculate_slots($date, $rounds);
    if ($avail['closed'] || !in_array($start_time, $avail['slots'])) {
        wp_send_json(array('success' => false, 'message' => 'Selected time slot is no longer available. Please choose another date or time.'));
    }

    $post_title = sprintf('%s - %s @ %s (%d players)', $name, $date, $start_time, $players);
    $post_id = wp_insert_post(array(
        'post_title'  => $post_title,
        'post_status' => 'publish',
        'post_type'   => 'lasertag_booking',
    ));

    if (is_wp_error($post_id) || !$post_id) {
        wp_send_json(array('success' => false, 'message' => 'Database error: Could not save your booking. Please try again.'));
    }

    update_field('lt_book_name', $name, $post_id);
    update_field('lt_book_email', $email, $post_id);
    update_field('lt_book_phone', $phone, $post_id);
    update_field('lt_book_city', $city, $post_id);
    update_field('lt_book_players', $players, $post_id);
    update_field('lt_book_game_mode', $game_mode, $post_id);
    update_field('lt_book_date', $date, $post_id);
    update_field('lt_book_rounds', $rounds, $post_id);
    update_field('lt_book_start_time', $start_time, $post_id);

    $start_timestamp = strtotime($start_time);
    $slots_data = array();
    for ($k = 0; $k < $rounds; $k++) {
        $slot_time = date('H:i', strtotime('+' . ($k * 30) . ' minutes', $start_timestamp));
        $slots_data[] = array('lt_slot_time' => $slot_time);
    }
    update_field('lt_book_slots', $slots_data, $post_id);

    $admin_email = get_option('admin_email');
    $subject_admin = 'New Laser Tag Booking: ' . $post_title;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $end_time = date('H:i', strtotime('+' . ($rounds * 30) . ' minutes', $start_timestamp));
    $package_name = ($rounds === 1) ? '1 ROUND' : ($rounds === 2 ? '2 ROUNDS' : '3 ROUNDS');
    $city_display = !empty($city) ? $city : '—';

    $message_admin = "
    <h2>New Laser Tag Booking Received</h2>
    <p><strong>Package:</strong> {$package_name} ({$rounds} rounds)</p>
    <p><strong>Date:</strong> {$date}</p>
    <p><strong>Time:</strong> {$start_time} - {$end_time}</p>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Phone:</strong> {$phone}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>City:</strong> {$city_display}</p>
    <p><strong>Number of Players:</strong> {$players}</p>
    <p><strong>Game Mode:</strong> {$game_mode}</p>
    <p><a href='" . admin_url('post.php?post=' . $post_id . '&action=edit') . "'>View in WordPress Admin</a></p>
    ";

    $terms_ro_url = home_url('/termeni-conditii-regulament-lt/');
    $terms_en_url = home_url('/terms-conditions-regulations-lt/');

    $subject_customer = 'MindShows Laser Tag - Booking Confirmed!';
    $message_customer = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 8px;'>
        <h2 style='color: #ed1b68; text-align: center;'>Laser Tag Booking Confirmed</h2>
        <p>Hi {$name},</p>
        <p>Get ready for action! We've received your booking request for Laser Tag at Costinești.</p>
        <div style='background: #f9f9f9; padding: 15px; border-radius: 6px; margin: 20px 0;'>
            <h3 style='margin-top: 0; color: #333;'>Booking Details:</h3>
            <p style='margin: 5px 0;'><strong>Package:</strong> {$package_name}</p>
            <p style='margin: 5px 0;'><strong>Date:</strong> {$date}</p>
            <p style='margin: 5px 0;'><strong>Time:</strong> {$start_time} - {$end_time}</p>
            <p style='margin: 5px 0;'><strong>Players:</strong> {$players}</p>
            <p style='margin: 5px 0;'><strong>Game Mode:</strong> {$game_mode}</p>
            <hr style='border: 0; border-top: 1px solid #ddd; margin: 10px 0;' />
            <h3 style='margin-top: 0; color: #333;'>Your Contact Details:</h3>
            <p style='margin: 5px 0;'><strong>Name:</strong> {$name}</p>
            <p style='margin: 5px 0;'><strong>Phone:</strong> {$phone}</p>
            <p style='margin: 5px 0;'><strong>Email:</strong> {$email}</p>
            <p style='margin: 5px 0;'><strong>City:</strong> {$city_display}</p>
        </div>
        <p>If you need to reschedule or cancel, please contact us at least 24 hours in advance at <a href='mailto:hello@mindshows.ro' style='color: #ed1b68; text-decoration: underline;'>hello@mindshows.ro</a>.</p>
        
        <hr style='border: 0; border-top: 1px solid #ddd; margin: 20px 0;' />
        <div style='font-size: 13px; color: #555; line-height: 1.5;'>
            <p><strong>RO</strong><br/>
            Participarea la Mind Shows Laser Tag este permisă numai după citirea și acceptarea Termenilor, Condițiilor și Regulamentului de Participare. Prin transmiterea rezervării, confirmați că ați avut posibilitatea de a citi aceste documente, că le acceptați și că vă obligați să le respectați. În cazul rezervărilor de grup, persoana care a efectuat rezervarea are responsabilitatea de a transmite aceste informații tuturor participanților înainte de joc.</p>
            <p>Rezervarea confirmată și participarea la activitate reprezintă un acord contractual între participanți și MIND SHOWS SRL, în condițiile documentelor menționate.</p>
            
            <p style='margin-top: 15px;'><strong>EN</strong><br/>
            Participation in Mind Shows Laser Tag is allowed only after reading and accepting the Terms, Conditions and Participation Rules. By submitting the booking, you confirm that you had the opportunity to read these documents, that you accept them and that you agree to follow them. For group bookings, the person who made the booking is responsible for sharing this information with all participants before the game.</p>
            <p>The confirmed booking and participation in the activity represent a contractual agreement between the participants and MIND SHOWS SRL, under the conditions set out in the above-mentioned documents.</p>
            
            <p style='margin-top: 18px;'>
                &#187; <a href='{$terms_ro_url}' style='color: #ed1b68; text-decoration: underline;' target='_blank'>Termeni, Condiții și Regulament (RO)</a><br/>
                &#187; <a href='{$terms_en_url}' style='color: #ed1b68; text-decoration: underline;' target='_blank'>Terms, Conditions and Rules (EN)</a>
            </p>
        </div>
        
        <p style='text-align: center; margin-top: 30px; font-size: 12px; color: #888;'>MindShows &copy; " . date('Y') . "</p>
    </div>
    ";

    wp_mail($admin_email, $subject_admin, $message_admin, $headers);
    wp_mail($email, $subject_customer, $message_customer, $headers);

    wp_send_json(array('success' => true));
}
add_action('wp_ajax_lt_submit_booking', 'lt_submit_booking_handler');
add_action('wp_ajax_nopriv_lt_submit_booking', 'lt_submit_booking_handler');

function lt_get_month_availability_handler() {
    check_ajax_referer('lt_booking_nonce', 'nonce');
    $year = intval($_POST['year']);
    $month = intval($_POST['month']);
    $rounds = intval($_POST['rounds']);

    $start_date = sprintf('%04d-%02d-01', $year, $month);
    $days_in_month = intval(date('t', strtotime($start_date)));
    $end_date = sprintf('%04d-%02d-%02d', $year, $month, $days_in_month);

    $closed_lookup = array();
    $closed_dates = get_field('lt_closed_dates', 'option');
    if ($closed_dates && is_array($closed_dates)) {
        foreach ($closed_dates as $row) {
            if (!empty($row['lt_closed_date'])) {
                $closed_lookup[$row['lt_closed_date']] = true;
            }
        }
    }

    $opening_time = get_field('lt_opening_time', 'option');
    $closing_time = get_field('lt_closing_time', 'option');
    if (!$opening_time) $opening_time = '10:00';
    if (!$closing_time) $closing_time = '21:00';
    $start_ts = strtotime($opening_time);
    $end_ts = strtotime($closing_time);
    $base_slots = array();
    while ($start_ts < $end_ts) {
        $base_slots[] = date('H:i', $start_ts);
        $start_ts = strtotime('+30 minutes', $start_ts);
    }
    $total_slots = count($base_slots);

    $args = array(
        'post_type'      => 'lasertag_booking',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'     => 'lt_book_date',
                'value'   => array($start_date, $end_date),
                'compare' => 'BETWEEN',
                'type'    => 'DATE',
            ),
        ),
    );
    
    $query = new WP_Query($args);
    $booked_by_date = array();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $b_date = get_post_meta(get_the_ID(), 'lt_book_date', true);
            $slots_repeater = get_field('lt_book_slots');
            if ($b_date && $slots_repeater && is_array($slots_repeater)) {
                if (!isset($booked_by_date[$b_date])) {
                    $booked_by_date[$b_date] = array();
                }
                foreach ($slots_repeater as $row) {
                    if (!empty($row['lt_slot_time'])) {
                        $booked_by_date[$b_date][] = $row['lt_slot_time'];
                    }
                }
            }
        }
        wp_reset_postdata();
    }

    $results = array();

    for ($d = 1; $d <= $days_in_month; $d++) {
        $date_key = sprintf('%04d-%02d-%02d', $year, $month, $d);

        if (isset($closed_lookup[$date_key])) {
            $results[$date_key] = array('slots' => array(), 'closed' => true);
            continue;
        }
        $day_bookings = isset($booked_by_date[$date_key]) ? $booked_by_date[$date_key] : array();
        
        $grid = array();
        foreach ($base_slots as $s) {
            $grid[] = array(
                't'    => $s,
                'open' => !in_array($s, $day_bookings),
            );
        }

        $valid_starts = array();
        for ($i = 0; $i + $rounds <= $total_slots; $i++) {
            $ok = true;
            for ($k = 0; $k < $rounds; $k++) {
                if (!$grid[$i + $k]['open']) {
                    $ok = false;
                    break;
                }
            }
            if ($ok) {
                $valid_starts[] = $grid[$i]['t'];
            }
        }

        $results[$date_key] = array(
            'slots'  => $valid_starts,
            'closed' => false
        );
    }

    wp_send_json($results);
}
add_action('wp_ajax_lt_get_month_availability', 'lt_get_month_availability_handler');
add_action('wp_ajax_nopriv_lt_get_month_availability', 'lt_get_month_availability_handler');

add_filter('wp_mail_from_name', function($original_from_name) {
    return 'MindShows';
});
add_filter('wp_mail_from', function($original_from_email) {
    $domain = wp_parse_url(home_url(), PHP_URL_HOST);
    if ($domain) {
        $clean_domain = preg_replace('/^www\./', '', $domain);
        return 'no-reply@' . $clean_domain;
    }
    return $original_from_email;
});