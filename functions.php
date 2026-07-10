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

function lt_time_to_minutes($time_str) {
    $ts = strtotime($time_str);
    if ($ts === false) return 0;
    return intval(date('H', $ts)) * 60 + intval(date('i', $ts));
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

    $closures = get_field('lt_closures', 'option');
    $day_of_week = date('D', strtotime($date));
    $fully_closed = false;
    $closed_intervals = array();

    if ($closures && is_array($closures)) {
        foreach ($closures as $row) {
            $type = isset($row['lt_closure_type']) ? $row['lt_closure_type'] : '';
            $match = false;
            
            if ($type === 'specific') {
                if (!empty($row['lt_closed_date']) && $row['lt_closed_date'] === $date) {
                    $match = true;
                }
            } elseif ($type === 'weekly') {
                if (!empty($row['lt_closed_weekdays']) && is_array($row['lt_closed_weekdays'])) {
                    if (in_array($day_of_week, $row['lt_closed_weekdays'])) {
                        $match = true;
                    }
                }
            }
            
            if ($match) {
                $all_day = isset($row['lt_all_day']) ? (bool)$row['lt_all_day'] : true;
                if ($all_day) {
                    $fully_closed = true;
                    break;
                } else {
                    $intervals = isset($row['lt_closed_intervals']) ? $row['lt_closed_intervals'] : array();
                    if (is_array($intervals)) {
                        foreach ($intervals as $interval) {
                            if (!empty($interval['start_time']) && !empty($interval['end_time'])) {
                                $closed_intervals[] = array(
                                    'start' => lt_time_to_minutes($interval['start_time']),
                                    'end'   => lt_time_to_minutes($interval['end_time']),
                                );
                            }
                        }
                    }
                }
            }
        }
    }

    if ($fully_closed) {
        return array('slots' => array(), 'closed' => true);
    }

    $opening_time = get_field('lt_opening_time', 'option') ?: '10:00';
    $closing_time = get_field('lt_closing_time', 'option') ?: '21:00';

    $start = strtotime($opening_time);
    $end = strtotime($closing_time);
    $all_slots = array();
    while ($start < $end) {
        $all_slots[] = date('H:i', $start);
        $start = strtotime('+30 minutes', $start);
    }

    $date_no_dashes = str_replace('-', '', $date);
    $args = array(
        'post_type'      => 'lasertag_booking',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => 'lt_book_date',
                'value'   => array($date, $date_no_dashes),
                'compare' => 'IN',
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
                        $booked_slots[] = date('H:i', strtotime($row['lt_slot_time']));
                    }
                }
            }
        }
        wp_reset_postdata();
    }

    $tz = new DateTimeZone('Europe/Bucharest');
    $now = new DateTime('now', $tz);
    $current_date = $now->format('Y-m-d');
    $current_time_str = $now->format('H:i');

    $grid = array();
    $is_today = ($date === $current_date);
    $current_time_m = $is_today ? lt_time_to_minutes($current_time_str) : 0;

    foreach ($all_slots as $s) {
        $slot_start_m = lt_time_to_minutes($s);
        $slot_end_m = $slot_start_m + 30;
        
        $slot_open = !in_array($s, $booked_slots);
        
        if ($slot_open && $is_today && $slot_start_m <= $current_time_m) {
            $slot_open = false;
        }
        
        if ($slot_open && !empty($closed_intervals)) {
            foreach ($closed_intervals as $ci) {
                if ($slot_start_m < $ci['end'] && $slot_end_m > $ci['start']) {
                    $slot_open = false;
                    break;
                }
            }
        }
        
        $grid[] = array(
            't'    => $s,
            'open' => $slot_open,
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
    $date = sanitize_text_field($_POST['date']);
    $rounds = intval($_POST['rounds']);

    $res = lt_calculate_slots($date, $rounds);
    wp_send_json($res);
}
add_action('wp_ajax_lt_get_slots', 'lt_get_slots_handler');
add_action('wp_ajax_nopriv_lt_get_slots', 'lt_get_slots_handler');

function lt_submit_booking_handler() {
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
    $year = intval($_POST['year']);
    $month = intval($_POST['month']);
    $rounds = intval($_POST['rounds']);

    $start_date = sprintf('%04d-%02d-01', $year, $month);
    $days_in_month = intval(date('t', strtotime($start_date)));
    $end_date = sprintf('%04d-%02d-%02d', $year, $month, $days_in_month);

    $closures = get_field('lt_closures', 'option');

    $opening_time = get_field('lt_opening_time', 'option') ?: '10:00';
    $closing_time = get_field('lt_closing_time', 'option') ?: '21:00';
    
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
                'value'   => array($start_date, $end_date, str_replace('-', '', $start_date), str_replace('-', '', $end_date)),
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
            
            if ($b_date && strlen($b_date) === 8 && strpos($b_date, '-') === false) {
                $b_date = substr($b_date, 0, 4) . '-' . substr($b_date, 4, 2) . '-' . substr($b_date, 6, 2);
            }
            
            $slots_repeater = get_field('lt_book_slots');
            if ($b_date && $slots_repeater && is_array($slots_repeater)) {
                if (!isset($booked_by_date[$b_date])) {
                    $booked_by_date[$b_date] = array();
                }
                foreach ($slots_repeater as $row) {
                    if (!empty($row['lt_slot_time'])) {
                        $booked_by_date[$b_date][] = date('H:i', strtotime($row['lt_slot_time']));
                    }
                }
            }
        }
        wp_reset_postdata();
    }

    $results = array();

    for ($d = 1; $d <= $days_in_month; $d++) {
        $date_key = sprintf('%04d-%02d-%02d', $year, $month, $d);

        $day_of_week = date('D', strtotime($date_key));
        $fully_closed = false;
        $closed_intervals = array();

        if ($closures && is_array($closures)) {
            foreach ($closures as $row) {
                $type = isset($row['lt_closure_type']) ? $row['lt_closure_type'] : '';
                $match = false;
                
                if ($type === 'specific') {
                    if (!empty($row['lt_closed_date']) && $row['lt_closed_date'] === $date_key) {
                        $match = true;
                    }
                } elseif ($type === 'weekly') {
                    if (!empty($row['lt_closed_weekdays']) && is_array($row['lt_closed_weekdays'])) {
                        if (in_array($day_of_week, $row['lt_closed_weekdays'])) {
                            $match = true;
                        }
                    }
                }
                
                if ($match) {
                    $all_day = isset($row['lt_all_day']) ? (bool)$row['lt_all_day'] : true;
                    if ($all_day) {
                        $fully_closed = true;
                        break;
                    } else {
                        $intervals = isset($row['lt_closed_intervals']) ? $row['lt_closed_intervals'] : array();
                        if (is_array($intervals)) {
                            foreach ($intervals as $interval) {
                                if (!empty($interval['start_time']) && !empty($interval['end_time'])) {
                                    $closed_intervals[] = array(
                                        'start' => lt_time_to_minutes($interval['start_time']),
                                        'end'   => lt_time_to_minutes($interval['end_time']),
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($fully_closed) {
            $results[$date_key] = array('slots' => array(), 'closed' => true);
            continue;
        }

        $day_bookings = isset($booked_by_date[$date_key]) ? $booked_by_date[$date_key] : array();
        
        $tz = new DateTimeZone('Europe/Bucharest');
        $now = new DateTime('now', $tz);
        $current_date = $now->format('Y-m-d');
        $current_time_str = $now->format('H:i');

        $grid = array();
        $is_today = ($date_key === $current_date);
        $current_time_m = $is_today ? lt_time_to_minutes($current_time_str) : 0;

        foreach ($base_slots as $s) {
            $slot_open = !in_array($s, $day_bookings);
            
            if ($slot_open && $is_today && lt_time_to_minutes($s) <= $current_time_m) {
                $slot_open = false;
            }

            $grid[] = array(
                't'    => $s,
                'open' => $slot_open,
            );
        }

        if (!empty($closed_intervals)) {
            for ($i = 0; $i < $total_slots; $i++) {
                if ($grid[$i]['open']) {
                    $slot_start_m = lt_time_to_minutes($grid[$i]['t']);
                    $slot_end_m = $slot_start_m + 30;
                    foreach ($closed_intervals as $ci) {
                        if ($slot_start_m < $ci['end'] && $slot_end_m > $ci['start']) {
                            $grid[$i]['open'] = false;
                            break;
                        }
                    }
                }
            }
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

function lt_add_visual_calendar_submenu() {
    add_submenu_page(
        'edit.php?post_type=lasertag_booking',
        'Visual Calendar',
        'Visual Calendar',
        'edit_posts',
        'lt-visual-calendar',
        'lt_render_visual_calendar_page'
    );
}
add_action('admin_menu', 'lt_add_visual_calendar_submenu');

function lt_render_visual_calendar_page() {
    ?>
    <div class="wrap">
        <h1>Laser Tag Booking Calendar</h1>
        <div id="lt-admin-calendar" style="max-width: 1000px; margin: 20px 0; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);"></div>
    </div>
    <?php
}

function lt_enqueue_admin_calendar_assets($hook) {
    if (strpos($hook, 'lt-visual-calendar') === false) {
        return;
    }
    
    wp_enqueue_script('fullcalendar-js', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js', array(), '6.1.15', true);
    
    wp_enqueue_script('lt-admin-calendar-js', get_stylesheet_directory_uri() . '/assets/js/admin-calendar.js', array('fullcalendar-js'), '1.0.0', true);
    
    wp_localize_script('lt-admin-calendar-js', 'ltAdminCalendar', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('admin_enqueue_scripts', 'lt_enqueue_admin_calendar_assets');

function lt_get_calendar_bookings_handler() {
    if (!current_user_can('edit_posts')) {
        wp_send_json(array());
    }

    $args = array(
        'post_type'      => 'lasertag_booking',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    );
    $query = new WP_Query($args);
    $events = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            
            $name = get_field('lt_book_name', $post_id);
            if (empty($name)) {
                $name = get_the_title();
            }
            $date = get_field('lt_book_date', $post_id);
            $start_time = get_field('lt_book_start_time', $post_id);
            $rounds = intval(get_field('lt_book_rounds', $post_id));
            $players = get_field('lt_book_players', $post_id);

            if ($date && $start_time && $rounds) {
                $start_timestamp = strtotime($start_time);
                $end_time = date('H:i', strtotime('+' . ($rounds * 30) . ' minutes', $start_timestamp));
                
                $start_iso = $date . 'T' . $start_time . ':00';
                $end_iso = $date . 'T' . $end_time . ':00';

                $events[] = array(
                    'id'    => $post_id,
                    'title' => $name . ' (' . $players . ' players)',
                    'start' => $start_iso,
                    'end'   => $end_iso,
                    'url'   => admin_url('post.php?post=' . $post_id . '&action=edit'),
                    'color' => '#ed1b68',
                );
            }
        }
        wp_reset_postdata();
    }

    wp_send_json($events);
}
add_action('wp_ajax_lt_get_calendar_bookings', 'lt_get_calendar_bookings_handler');
