<?php

if (!defined('ABSPATH')) {
    exit;
}

function mindshows_register_development_cpts() {
    $dev_args = array(
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'label'              => 'Development',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-lightbulb',
        'rewrite'            => array('slug' => 'development', 'with_front' => false),
        'has_archive'        => false,
        'show_in_rest'       => true,
    );
    register_post_type('development', $dev_args);

    $enroll_args = array(
        'public'       => false,
        'show_ui'      => true,
        'label'        => 'Dev Enrollments',
        'menu_icon'    => 'dashicons-id',
        'supports'     => array('title'),
        'show_in_rest' => false,
    );
    register_post_type('dev_enrollment', $enroll_args);
}
add_action('init', 'mindshows_register_development_cpts', 5);

function mindshows_dev_check_flush_rewrites() {
    if (get_option('mindshows_dev_flushed_v2') !== '1') {
        flush_rewrite_rules(false);
        update_option('mindshows_dev_flushed_v2', '1');
    }
}
add_action('init', 'mindshows_dev_check_flush_rewrites', 99);

function mindshows_add_dev_sessions_meta_box() {
    add_meta_box('dev_sessions_meta_box', 'Development Schedule & Sessions', 'mindshows_render_dev_sessions_meta_box', 'development', 'normal', 'high');
    add_meta_box('dev_sessions_meta_box', 'Program jocuri publice', 'mindshows_render_dev_sessions_meta_box', 'irl_gaming', 'normal', 'high');
}
add_action('add_meta_boxes', 'mindshows_add_dev_sessions_meta_box');

function mindshows_render_dev_sessions_meta_box($post) {
    wp_nonce_field('dev_sessions_meta_nonce', 'dev_sessions_nonce');

    $is_irl = $post->post_type === 'irl_gaming';
    $default_title = get_the_title($post->ID) ?: ($is_irl ? '' : 'Modul 1 Dezvoltare');
    $sessions_data = get_post_meta($post->ID, '_dev_sessions', true);
    if ($is_irl && (!is_array($sessions_data) || empty($sessions_data))) {
        $sessions_data = array('locations' => array('Constanta'), 'sessions' => array('Constanta' => array()));
    }
    if (!is_array($sessions_data) || empty($sessions_data)) {
        $sessions_data = array(
            'locations' => array('Constanta', 'Bucuresti'),
            'sessions'  => array(
                'Constanta' => array(
                    array(
                        'year'  => intval(date('Y')),
                        'month' => intval(date('n')) - 1,
                        'days'  => array(10, 11),
                        'time'  => '9:00 - 17:00',
                        'title' => get_the_title($post->ID) ?: 'Modul 1 Dezvoltare',
                    ),
                ),
                'Bucuresti' => array(
                    array(
                        'year'  => intval(date('Y')),
                        'month' => intval(date('n')) - 1,
                        'days'  => array(17, 18),
                        'time'  => '9:00 - 17:00',
                        'title' => get_the_title($post->ID) ?: 'Modul 1 Dezvoltare',
                    ),
                ),
            ),
        );
    }
    ?>
    <div id="dev-sessions-meta-app" class="dev-meta-box-wrap" data-post-id="<?php echo esc_attr($post->ID); ?>">
        <div class="dev-locations-bar"></div>

        <div class="dev-admin-grid-layout">
            <div class="dev-cal-widget">
                <div class="dev-cal-header">
                    <button type="button" class="dev-cal-nav-btn dev-cal-prev-month">&lsaquo;</button>
                    <span class="dev-cal-month-title"></span>
                    <button type="button" class="dev-cal-nav-btn dev-cal-next-month">&rsaquo;</button>
                </div>
                <div class="dev-cal-weekdays">
                    <div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div><div>Su</div>
                </div>
                <div class="dev-cal-days-grid"></div>
            </div>

            <div class="dev-session-builder-panel">
                <h4 class="dev-panel-heading">Add Session for Selected Location</h4>
                
                <div class="dev-form-row">
                    <label>Module / Session Name</label>
                    <input type="text" id="dev-session-title" value="<?php echo esc_attr($default_title); ?>">
                </div>

                <div class="dev-form-row">
                    <label>Hours Interval</label>
                    <div class="dev-time-inputs">
                        <input type="text" id="dev-start-hour" value="09:00" placeholder="09:00">
                        <span>—</span>
                        <input type="text" id="dev-end-hour" value="17:00" placeholder="17:00">
                    </div>
                </div>

                <button type="button" class="button button-primary dev-add-session-btn">Save Session To Calendar</button>

                <div class="dev-sessions-list">
                    <h4 class="dev-panel-heading" style="margin-top:24px;">Configured Sessions</h4>
                    <div class="dev-sessions-list-items"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.devSessionsAdminData = <?php echo wp_json_encode($sessions_data); ?>;
    </script>
    <?php
}

function mindshows_enqueue_dev_admin_assets($hook) {
    global $post_type;
    if (('post.php' === $hook || 'post-new.php' === $hook) && in_array($post_type, array('development', 'irl_gaming'), true)) {
        wp_enqueue_style('dev-admin-cal-css', get_template_directory_uri() . '/assets/css/admin-dev-calendar.css', array(), '1.0.0');
        wp_enqueue_script('dev-admin-cal-js', get_template_directory_uri() . '/assets/js/admin-dev-calendar.js', array('jquery'), '1.0.1', true);

        wp_localize_script('dev-admin-cal-js', 'devAdminAjax', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('dev_admin_sessions_nonce'),
        ));
    }
}
add_action('admin_enqueue_scripts', 'mindshows_enqueue_dev_admin_assets');

function mindshows_dev_save_all_sessions_handler() {
    check_ajax_referer('dev_admin_sessions_nonce', 'nonce');

    if (!current_user_can('edit_posts')) {
        wp_send_json_error('Unauthorized');
    }

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    if (!$post_id) {
        wp_send_json_error('Invalid post ID');
    }

    $locations = isset($_POST['locations']) && is_array($_POST['locations']) ? array_map('sanitize_text_field', $_POST['locations']) : array('Constanta');
    $sessions_raw = isset($_POST['sessions']) ? stripslashes($_POST['sessions']) : '{}';
    $sessions = json_decode($sessions_raw, true);

    if (!is_array($sessions)) {
        $sessions = array();
    }

    $cleaned_sessions = array();
    foreach ($sessions as $loc => $items) {
        $loc_clean = sanitize_text_field($loc);
        $cleaned_sessions[$loc_clean] = array();
        if (is_array($items)) {
            foreach ($items as $item) {
                $days = isset($item['days']) && is_array($item['days']) ? array_map('intval', $item['days']) : array();
                $cleaned_sessions[$loc_clean][] = array(
                    'year'  => isset($item['year']) ? intval($item['year']) : intval(date('Y')),
                    'month' => isset($item['month']) ? intval($item['month']) : intval(date('n')) - 1,
                    'days'  => $days,
                    'time'  => isset($item['time']) ? sanitize_text_field($item['time']) : '9:00 - 17:00',
                    'title' => isset($item['title']) ? sanitize_text_field($item['title']) : 'Session',
                );
            }
        }
    }

    $data = array(
        'locations' => $locations,
        'sessions'  => $cleaned_sessions,
    );

    update_post_meta($post_id, '_dev_sessions', $data);

    if (function_exists('mindshows_dev_flush_schedule_cache')) {
        mindshows_dev_flush_schedule_cache($post_id);
    }

    wp_send_json_success(array('message' => 'Sessions saved successfully'));
}
add_action('wp_ajax_dev_save_all_sessions', 'mindshows_dev_save_all_sessions_handler');

function mindshows_booking_email($to, $subject, $heading, $intro, $rows) {
    $table = '';
    foreach ($rows as $label => $value) {
        if ($value === '' || $value === null) {
            continue;
        }
        $table .= '<tr><td style="padding:8px 12px;color:#6b6b6b;white-space:nowrap;vertical-align:top;">' . esc_html($label) . '</td>'
                . '<td style="padding:8px 12px;color:#111;font-weight:600;">' . esc_html($value) . '</td></tr>';
    }

    $body = '<div style="background:#f4f4f4;padding:24px 12px;font-family:Arial,Helvetica,sans-serif;">'
          . '<div style="max-width:600px;margin:0 auto;background:#fff;border-radius:10px;overflow:hidden;">'
          . '<div style="background:#0E0E0E;padding:20px 24px;color:#fff;font-size:20px;font-weight:700;">Mind Shows</div>'
          . '<div style="padding:24px;">'
          . '<h2 style="margin:0 0 12px;font-size:20px;color:#111;">' . esc_html($heading) . '</h2>'
          . ($intro !== '' ? '<p style="margin:0 0 16px;font-size:15px;line-height:1.5;color:#333;">' . esc_html($intro) . '</p>' : '')
          . '<table style="width:100%;border-collapse:collapse;font-size:14px;border-top:1px solid #eee;">' . $table . '</table>'
          . '</div>'
          . '<div style="padding:16px 24px;background:#fafafa;font-size:12px;color:#888;">Pentru orice întrebare ne poți scrie la hello@mindshows.ro.</div>'
          . '</div></div>';

    return wp_mail($to, $subject, $body, array('Content-Type: text/html; charset=UTF-8'));
}

function mindshows_booking_respond($data, $emails) {
    if (function_exists('fastcgi_finish_request')) {
        @header('Content-Type: application/json; charset=' . get_option('blog_charset'));
        echo wp_json_encode(array('success' => true, 'data' => $data));
        fastcgi_finish_request();
        foreach ($emails as $email_args) {
            mindshows_booking_email(...$email_args);
        }
        exit;
    }
    foreach ($emails as $email_args) {
        mindshows_booking_email(...$email_args);
    }
    wp_send_json_success($data);
}

function mindshows_booking_contact_valid($name, $phone, $email, $city = '') {
    $digits = strlen(preg_replace('/\D/', '', $phone));
    return mb_strlen(trim($name)) >= 2
        && preg_match('/^[+\d\s().\/-]+$/', trim($phone))
        && $digits >= 10 && $digits <= 15
        && is_email($email)
        && (trim($city) === '' || mb_strlen(trim($city)) >= 2);
}

function mindshows_dev_submit_enrollment_handler() {

    $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $phone   = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $email   = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $date    = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : '';
    $time    = isset($_POST['time']) ? sanitize_text_field($_POST['time']) : '';
    $city    = isset($_POST['city']) ? sanitize_text_field($_POST['city']) : '';
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $module  = $post_id ? get_the_title($post_id) : 'Development Module';

    if (!mindshows_booking_contact_valid($name, $phone, $email, $city)) {
        wp_send_json_error(array('message' => 'Te rugăm să completezi corect toate câmpurile obligatorii.'));
    }

    $post_title = $name . ' - ' . $module . ' (' . ($date ?: date('d.m.Y')) . ')';
    $enroll_post_id = wp_insert_post(array(
        'post_type'   => 'dev_enrollment',
        'post_title'  => $post_title,
        'post_status' => 'publish',
    ));

    if (is_wp_error($enroll_post_id)) {
        wp_send_json_error(array('message' => 'A apărut o eroare la salvarea înscrierii.'));
    }

    update_post_meta($enroll_post_id, 'dev_enr_name', $name);
    update_post_meta($enroll_post_id, 'dev_enr_phone', $phone);
    update_post_meta($enroll_post_id, 'dev_enr_email', $email);
    update_post_meta($enroll_post_id, 'dev_enr_date', $date);
    update_post_meta($enroll_post_id, 'dev_enr_time', $time);
    update_post_meta($enroll_post_id, 'dev_enr_city', $city);
    update_post_meta($enroll_post_id, 'dev_enr_module', $module);
    update_post_meta($enroll_post_id, 'dev_enr_created', current_time('mysql'));

    $emails = array(
        array(
            get_option('admin_email'),
            'Înscriere Nouă Curs: ' . $module . ' - ' . $name,
            'Înscriere Nouă Curs Development',
            'Trimis automat din platforma Mind Shows la ' . current_time('d.m.Y H:i') . '.',
            array(
                'Nume'            => $name,
                'Telefon'         => $phone,
                'Email'           => $email,
                'Modul'           => $module,
                'Data Selectată'  => $date,
                'Interval Orar'   => $time,
                'Oraș Domiciliu'  => $city,
            ),
        ),
    );
    if (is_email($email)) {
        $emails[] = array(
            $email,
            'Am primit înscrierea ta - ' . $module,
            'Am primit înscrierea ta',
            'Salut ' . $name . ', îți mulțumim! Te contactăm în cel mai scurt timp pentru confirmare și detalii de plată.',
            array(
                'Curs'          => $module,
                'Data'          => $date,
                'Interval Orar' => $time,
            ),
        );
    }

    mindshows_booking_respond(array(
        'message' => 'Înscrierea a fost trimisă cu succes!',
        'date'    => $date,
        'time'    => $time,
    ), $emails);
}
add_action('wp_ajax_dev_submit_enrollment', 'mindshows_dev_submit_enrollment_handler');
add_action('wp_ajax_nopriv_dev_submit_enrollment', 'mindshows_dev_submit_enrollment_handler');

function mindshows_dev_enrollment_columns($columns) {
    return array(
        'cb'         => '<input type="checkbox" />',
        'title'      => 'Titlu Înscriere',
        'enr_name'   => 'Nume',
        'enr_phone'  => 'Telefon',
        'enr_email'  => 'Email',
        'enr_module' => 'Modul',
        'enr_date'   => 'Data Curs',
        'date'       => 'Data Trimisă',
    );
}
add_filter('manage_dev_enrollment_posts_columns', 'mindshows_dev_enrollment_columns');

function mindshows_dev_enrollment_column_data($column, $post_id) {
    switch ($column) {
        case 'enr_name':
            echo esc_html(get_post_meta($post_id, 'dev_enr_name', true) ?: '—');
            break;
        case 'enr_phone':
            $phone = get_post_meta($post_id, 'dev_enr_phone', true);
            echo $phone ? '<a href="tel:' . esc_attr($phone) . '">' . esc_html($phone) . '</a>' : '—';
            break;
        case 'enr_email':
            $email = get_post_meta($post_id, 'dev_enr_email', true);
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
            break;
        case 'enr_module':
            echo esc_html(get_post_meta($post_id, 'dev_enr_module', true) ?: '—');
            break;
        case 'enr_date':
            $d = get_post_meta($post_id, 'dev_enr_date', true);
            $t = get_post_meta($post_id, 'dev_enr_time', true);
            echo esc_html($d ? ($d . ($t ? ' (' . $t . ')' : '')) : '—');
            break;
    }
}
add_action('manage_dev_enrollment_posts_custom_column', 'mindshows_dev_enrollment_column_data', 10, 2);
