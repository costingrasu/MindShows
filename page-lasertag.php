<?php
/*
Template Name: Laser Tag
*/

get_header();

$theme_uri = get_stylesheet_directory_uri();

$hero_sec    = function_exists('get_field') ? get_field('lt_hero_section') : null;
$kp_sec      = function_exists('get_field') ? get_field('lt_keynotes_section') : null;
$about_sec   = function_exists('get_field') ? get_field('lt_about_section') : null;
$mission_sec = function_exists('get_field') ? get_field('lt_mission_section') : null;
$pkg_sec     = function_exists('get_field') ? get_field('lt_packages_section') : null;
$disc_sec    = function_exists('get_field') ? get_field('lt_discounts_section') : null;
$booking_sec = function_exists('get_field') ? get_field('lt_booking_section') : null;

$hero_bg_img = ($hero_sec && !empty($hero_sec['bg_image']['url'])) ? $hero_sec['bg_image']['url'] : $theme_uri . '/assets/images/Hero.webp';
$hero_eyebrow= ($hero_sec && !empty($hero_sec['eyebrow'])) ? $hero_sec['eyebrow'] : 'MIND SHOWS';
$hero_title  = ($hero_sec && !empty($hero_sec['title'])) ? $hero_sec['title'] : 'Laser Tag';
$hero_sub    = ($hero_sec && !empty($hero_sec['subtitle'])) ? $hero_sec['subtitle'] : 'Experiece out outdoor las tag arena in Costinești, where real-life gaming modes meets the pulse of summer, located in LUN.R camping right next to Nibiru.';
$hero_btn_1  = ($hero_sec && !empty($hero_sec['btn_primary_text'])) ? $hero_sec['btn_primary_text'] : 'Join the game now';
$hero_link_1 = ($hero_sec && !empty($hero_sec['btn_primary_link'])) ? $hero_sec['btn_primary_link'] : '#lt-booking';
$hero_btn_2  = ($hero_sec && !empty($hero_sec['btn_outline_text'])) ? $hero_sec['btn_outline_text'] : 'Discover game modes';
$hero_link_2 = ($hero_sec && !empty($hero_sec['btn_outline_link'])) ? $hero_sec['btn_outline_link'] : '#lt-mission';
$hero_notice = ($hero_sec && !empty($hero_sec['notice_text'])) ? $hero_sec['notice_text'] : 'Limited time slots available. Booking in advance is recommended for groups.';

$kp_defaults = array(
    1 => array('title' => 'Location',   'value' => 'Costinești'),
    2 => array('title' => 'Outdoor',    'value' => 'Open-air arena'),
    3 => array('title' => 'Arena size', 'value' => '1,000 sqm'),
    4 => array('title' => 'Players',    'value' => 'Up to 14 players'),
    5 => array('title' => 'Scenarios',  'value' => 'Multiple game modes'),
);
$kps = array();
for ($i = 1; $i <= 5; $i++) {
    $kp_data = ($kp_sec && isset($kp_sec['kp' . $i])) ? $kp_sec['kp' . $i] : null;
    $kps[$i] = array(
        'title' => ($kp_data && !empty($kp_data['title'])) ? $kp_data['title'] : $kp_defaults[$i]['title'],
        'value' => ($kp_data && !empty($kp_data['value'])) ? $kp_data['value'] : $kp_defaults[$i]['value'],
    );
}

$about_day_img   = ($about_sec && !empty($about_sec['img_day']['url'])) ? $about_sec['img_day']['url'] : $theme_uri . '/assets/images/day.webp';
$about_night_img = ($about_sec && !empty($about_sec['img_night']['url'])) ? $about_sec['img_night']['url'] : $theme_uri . '/assets/images/night.webp';
$about_eyebrow   = ($about_sec && !empty($about_sec['eyebrow'])) ? $about_sec['eyebrow'] : 'Real-life shooter';
$about_heading   = ($about_sec && !empty($about_sec['heading'])) ? $about_sec['heading'] : 'More than a<br>regular activity';
$about_desc_1    = ($about_sec && !empty($about_sec['desc_1'])) ? $about_sec['desc_1'] : 'Join our outdoor laser tag experience in Costinești, created by Mind Shows for people who want more than a regular summer activity.';
$about_desc_2    = ($about_sec && !empty($about_sec['desc_2'])) ? $about_sec['desc_2'] : "By day, it's fast, social and full of summer energy. By night, it's intense, cinematic and built for adventure.";
$about_badge     = ($about_sec && !empty($about_sec['badge_text'])) ? $about_sec['badge_text'] : 'BUILT FOR ADRENALINE. DESIGNED FOR TEAMWORK. MADE FOR SUMMER NIGHTS.';

$mission_eyebrow = ($mission_sec && !empty($mission_sec['eyebrow'])) ? $mission_sec['eyebrow'] : 'Game modes';
$mission_title   = ($mission_sec && !empty($mission_sec['title'])) ? $mission_sec['title'] : 'Choose your mission';
$mission_summary = ($mission_sec && !empty($mission_sec['summary'])) ? $mission_sec['summary'] : 'Every game mode brings a different way to play, think and win with your squad. Change your strategy and try new game modes every round.';

$mode_defaults = array(
    1 => array('title' => 'Battle Royale',     'desc' => 'Play solo, in pairs or in squads. Stay inside the shrinking safe zone and outlive everyone else.'),
    2 => array('title' => 'Team vs Team',       'desc' => 'Work together, fight the enemy team and score more points before time runs out.'),
    3 => array('title' => 'Last One Standing',  'desc' => 'Play solo or in squads, stay and be the last player standing.'),
    4 => array('title' => 'Capture the Flag',   'desc' => 'Fight for the digital flag, protect your team and hold it longer than your opponents.'),
    5 => array('title' => 'VIP Escort',         'desc' => 'One player becomes the VIP. Escort them safely across the arena while the enemy team tries to stop you.'),
    6 => array('title' => 'And Many More',       'desc' => 'New scenarios and custom rules are added throughout the season, ask our game masters on the day.'),
);
$modes = array();
for ($i = 1; $i <= 6; $i++) {
    $m_data = ($mission_sec && isset($mission_sec['mode' . $i])) ? $mission_sec['mode' . $i] : null;
    $modes[$i] = array(
        'title' => ($m_data && !empty($m_data['title'])) ? $m_data['title'] : $mode_defaults[$i]['title'],
        'desc'  => ($m_data && !empty($m_data['desc']))  ? $m_data['desc']  : $mode_defaults[$i]['desc'],
    );
}

$pkg_eyebrow            = ($pkg_sec && !empty($pkg_sec['eyebrow'])) ? $pkg_sec['eyebrow'] : 'Packages';
$pkg_title              = ($pkg_sec && !empty($pkg_sec['title'])) ? $pkg_sec['title'] : 'Choose your game package';
$pkg_sub                = ($pkg_sec && !empty($pkg_sec['subtitle'])) ? $pkg_sec['subtitle'] : 'One round gets you into the game. More rounds unlock the full experience.';
$slot_duration_minutes  = ($pkg_sec && !empty($pkg_sec['slot_duration_minutes'])) ? intval($pkg_sec['slot_duration_minutes']) : 30;
$pkg_cta                = ($pkg_sec && !empty($pkg_sec['cta_text'])) ? $pkg_sec['cta_text'] : 'Join the game';

$pkg_defaults = array(
    1 => array('rounds' => 1, 'tag' => 'A quick first mission.', 'price' => 39, 'unit' => 'LEI / player'),
    2 => array('rounds' => 2, 'tag' => 'More action. More strategy. More fun.', 'price' => 69, 'unit' => 'LEI / player', 'badge' => 'MOST POPULAR'),
    3 => array('rounds' => 3, 'tag' => 'The full mission experience.', 'price' => 99, 'unit' => 'LEI / player')
);
$pkgs = array();
for ($i = 1; $i <= 3; $i++) {
    $p_data = ($pkg_sec && isset($pkg_sec['pkg' . $i])) ? $pkg_sec['pkg' . $i] : null;
    $rounds = ($p_data && isset($p_data['rounds']) && intval($p_data['rounds']) > 0) ? intval($p_data['rounds']) : $pkg_defaults[$i]['rounds'];
    $name   = $rounds . ' ROUND' . ($rounds > 1 ? 'S' : '');
    $tot_min= $rounds * $slot_duration_minutes;

    $pkgs[$i] = array(
        'rounds'    => $rounds,
        'name'      => $name,
        'tot_min'   => $tot_min,
        'tag'       => ($p_data && !empty($p_data['tag'])) ? $p_data['tag'] : $pkg_defaults[$i]['tag'],
        'price'     => ($p_data && isset($p_data['price']) && $p_data['price'] !== '') ? $p_data['price'] : $pkg_defaults[$i]['price'],
        'unit'      => ($p_data && !empty($p_data['unit'])) ? $p_data['unit'] : $pkg_defaults[$i]['unit'],
        'badge'     => ($p_data && !empty($p_data['badge'])) ? $p_data['badge'] : (isset($pkg_defaults[$i]['badge']) ? $pkg_defaults[$i]['badge'] : ''),
        'benefits'  => ($p_data && !empty($p_data['benefits'])) ? $p_data['benefits'] : null
    );
}

$pkg_benefits_defaults = array(
    1 => array('1 laser tag round', 'Performance Paper included', 'Briefing included', 'Access to the LUN.R Camping bar & lounge', 'Water included', 'Rent or buy spare T-Shirt'),
    2 => array('2 laser tag rounds', '10-minute break between rounds', 'Performance Paper included', 'Briefing included', 'Access to the LUN.R Camping bar & lounge', 'Water included', 'Rent or buy spare T-Shirt'),
    3 => array('3 laser tag rounds', '10-minute break between rounds', 'Performance Paper included', 'Briefing included', 'Access to the LUN.R Camping bar & lounge', 'Water included', 'Rent or buy spare T-Shirt'),
);

$disc_eyebrow    = ($disc_sec && !empty($disc_sec['eyebrow'])) ? $disc_sec['eyebrow'] : 'Discounts';
$disc_title      = ($disc_sec && !empty($disc_sec['title'])) ? $disc_sec['title'] : 'Stack your savings';
$disc_sub_heading= ($disc_sec && !empty($disc_sec['sub_heading'])) ? $disc_sec['sub_heading'] : 'Yep, the discounts stack!';

$disc_panel_defaults = array(
    1 => array('num' => '13%', 'title' => 'For LUN.R Campers', 'note' => 'Camping access bracelet required.'),
    2 => array('num' => '13%', 'title' => 'Monday to Friday, 12-6 PM', 'note' => 'Every Monday to Friday afternoon.'),
);
$disc_panels = array();
for ($i = 1; $i <= 2; $i++) {
    $dp_data = ($disc_sec && isset($disc_sec['panel' . $i])) ? $disc_sec['panel' . $i] : null;
    $disc_panels[$i] = array(
        'num'   => ($dp_data && !empty($dp_data['num']))   ? $dp_data['num']   : $disc_panel_defaults[$i]['num'],
        'title' => ($dp_data && !empty($dp_data['title'])) ? $dp_data['title'] : $disc_panel_defaults[$i]['title'],
        'note'  => ($dp_data && !empty($dp_data['note']))  ? $dp_data['note']  : $disc_panel_defaults[$i]['note'],
    );
}

$book_eyebrow  = ($booking_sec && !empty($booking_sec['eyebrow'])) ? $booking_sec['eyebrow'] : 'Book your session';
$book_title    = ($booking_sec && !empty($booking_sec['title'])) ? $booking_sec['title'] : 'Reserve your spot';
$book_sub_1    = ($booking_sec && !empty($booking_sec['sub_1'])) ? $booking_sec['sub_1'] : 'Choose your package, pick a date with open slots, select a time and tell us who\'s coming.';
$book_sub_2    = ($booking_sec && !empty($booking_sec['sub_2'])) ? $booking_sec['sub_2'] : 'You can find us inside LUN.R Camping, the official camping of Beach, Please! and Nibiru, at Strada Emil Costinescu 67, Costinești.';
$book_dir_text = ($booking_sec && !empty($booking_sec['directions_text'])) ? $booking_sec['directions_text'] : 'Get directions';
$book_dir_link = ($booking_sec && !empty($booking_sec['directions_link'])) ? $booking_sec['directions_link'] : 'https://maps.app.goo.gl/8oh4P3cJqsfUxjD7A';

$kp_svgs = array(
    1 => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 3 L37 20 L20 37 L3 20 Z" stroke="#ed1b68" stroke-width="1.4"/><circle cx="20" cy="20" r="5" fill="#ed1b68"/></svg>',
    2 => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="16" stroke="#ed1b68" stroke-width="1.4"/><circle cx="20" cy="20" r="6" fill="#ed1b68"/></svg>',
    3 => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><rect x="6" y="6" width="28" height="28" rx="3" stroke="#ed1b68" stroke-width="1.4"/><rect x="15" y="15" width="10" height="10" fill="#ed1b68"/></svg>',
    4 => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><circle cx="14" cy="15" r="6" stroke="#ed1b68" stroke-width="1.4"/><circle cx="26" cy="15" r="6" stroke="#ed1b68" stroke-width="1.4"/><path d="M6 33c0-5 4-8 8-8s8 3 8 8M18 33c0-5 4-8 8-8s8 3 8 8" stroke="#ed1b68" stroke-width="1.4"/></svg>',
    5 => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 4 L24 16 L37 16 L26 24 L30 36 L20 28 L10 36 L14 24 L3 16 L16 16 Z" stroke="#ed1b68" stroke-width="1.4"/></svg>',
);

$mode_svgs = array(
    1 => '<svg width="46" height="46" viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="15" stroke="#ed1b68" stroke-width="1.4"/><circle cx="20" cy="20" r="8" stroke="#ed1b68" stroke-width="1.4"/><circle cx="20" cy="20" r="2.5" fill="#ed1b68"/></svg>',
    2 => '<svg width="46" height="46" viewBox="0 0 40 40" fill="none"><circle cx="14" cy="20" r="8" stroke="#ed1b68" stroke-width="1.4"/><circle cx="26" cy="20" r="8" stroke="#ed1b68" stroke-width="1.4"/></svg>',
    3 => '<svg width="46" height="46" viewBox="0 0 40 40" fill="none"><path d="M20 4 L24 16 L37 16 L26 24 L30 36 L20 28 L10 36 L14 24 L3 16 L16 16 Z" stroke="#ed1b68" stroke-width="1.4"/></svg>',
    4 => '<svg width="46" height="46" viewBox="0 0 40 40" fill="none"><path d="M12 5 V35" stroke="#ed1b68" stroke-width="1.6"/><path d="M12 7 H31 L27 13 L31 19 H12 Z" stroke="#ed1b68" stroke-width="1.4"/></svg>',
    5 => '<svg width="46" height="46" viewBox="0 0 40 40" fill="none"><path d="M6 30 L9 14 L16 23 L20 11 L24 23 L31 14 L34 30 Z" stroke="#ed1b68" stroke-width="1.4"/></svg>',
    6 => '<svg width="46" height="46" viewBox="0 0 40 40" fill="none"><circle cx="10" cy="20" r="3" fill="#ed1b68"/><circle cx="20" cy="20" r="3" fill="#ed1b68"/><circle cx="30" cy="20" r="3" fill="#ed1b68"/></svg>',
);

$check_svg = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg>';
?>

<main class="lt-main">

    <section class="lt-hero">
        <div class="lt-hero-bg" style="background-image: url('<?php echo esc_url($hero_bg_img); ?>');"></div>
        <div class="lt-hero-gradient"></div>
        <div class="lt-hero-radial"></div>
        
        <div class="lt-hero-content">
            <span class="lt-hero-eyebrow"><?php echo esc_html($hero_eyebrow); ?></span>
            <h1 class="lt-hero-title"><?php echo esc_html($hero_title); ?></h1>
            <p class="lt-hero-subtitle"><?php echo esc_html($hero_sub); ?></p>
            <div class="lt-cta-row">
                <a href="<?php echo esc_url($hero_link_1); ?>" class="lt-btn-primary"><?php echo esc_html($hero_btn_1); ?></a>
                <a href="<?php echo esc_url($hero_link_2); ?>" class="lt-btn-outline"><?php echo esc_html($hero_btn_2); ?></a>
            </div>
            <p class="lt-hero-notice"><?php echo esc_html($hero_notice); ?></p>
        </div>
    </section>

    <section class="lt-keynotes">
        <div class="lt-keynotes-row">
            <?php foreach ($kps as $idx => $kp) : ?>
                <?php if ($idx > 1) : ?><span class="lt-keynote-div"></span><?php endif; ?>
                <div class="lt-keynote">
                    <?php echo $kp_svgs[$idx]; ?>
                    <span class="lt-keynote-title"><?php echo esc_html($kp['title']); ?></span>
                    <p class="lt-keynote-value"><?php echo esc_html($kp['value']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="lt-about lt-section-pad">
        <div class="lt-about-grid">
            <div class="lt-about-text">
                <div class="lt-eyebrow-row">
                    <span class="lt-eyebrow"><?php echo esc_html($about_eyebrow); ?></span>
                    <span class="lt-eyebrow-line"></span>
                </div>
                <h2 class="lt-section-heading"><?php echo wp_kses_post($about_heading); ?></h2>
                <p class="lt-about-desc"><?php echo esc_html($about_desc_1); ?></p>
                <p class="lt-about-desc"><?php echo esc_html($about_desc_2); ?></p>
                <div class="lt-about-badge">
                    <svg width="22" height="22" viewBox="0 0 40 40" fill="none"><path d="M20 4 L24 16 L37 16 L26 24 L30 36 L20 28 L10 36 L14 24 L3 16 L16 16 Z" fill="#ed1b68"/></svg>
                    <span><?php echo esc_html($about_badge); ?></span>
                </div>
            </div>
            <div class="lt-about-imgs">
                <div class="lt-about-img" style="background-image: url('<?php echo esc_url($about_day_img); ?>');"></div>
                <div class="lt-about-img lt-about-img-offset" style="background-image: url('<?php echo esc_url($about_night_img); ?>');"></div>
            </div>
        </div>
    </section>

    <section id="lt-mission" class="lt-mission lt-section-pad">
        <div class="lt-mission-inner">
            <div class="lt-section-center">
                <span class="lt-eyebrow"><?php echo esc_html($mission_eyebrow); ?></span>
                <h2 class="lt-section-heading"><?php echo esc_html($mission_title); ?></h2>
            </div>
            <div class="lt-mission-grid">
                <?php foreach ($modes as $idx => $mode) : ?>
                <div class="lt-mode-card">
                    <span class="lt-mode-icon"><?php echo $mode_svgs[$idx]; ?></span>
                    <h3 class="lt-mode-title"><?php echo esc_html($mode['title']); ?></h3>
                    <p class="lt-mode-desc"><?php echo esc_html($mode['desc']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <p class="lt-mission-summary"><?php echo esc_html($mission_summary); ?></p>
        </div>
    </section>

    <section id="lt-packages" class="lt-packages lt-section-pad">
        <div class="lt-packages-inner">
            <div class="lt-section-center">
                <span class="lt-eyebrow"><?php echo esc_html($pkg_eyebrow); ?></span>
                <h2 class="lt-section-heading"><?php echo esc_html($pkg_title); ?></h2>
                <p class="lt-section-sub"><?php echo esc_html($pkg_sub); ?></p>
            </div>
            <div class="lt-packages-grid">
                <?php foreach ($pkgs as $pkg_idx => $pkg) : 
                    $is_featured = !empty($pkg['badge']);
                    $card_class  = 'lt-pkg-card' . ($is_featured ? ' lt-pkg-featured' : '');
                    
                    $benefits_list = array();
                    if (!empty($pkg['benefits'])) {
                        $benefits_list = array_filter(array_map('trim', explode("\n", $pkg['benefits'])));
                    } else {
                        $benefits_list = $pkg_benefits_defaults[$pkg_idx];
                    }
                ?>
                <div class="<?php echo esc_attr($card_class); ?>">
                    <?php if ($is_featured) : ?>
                        <div class="lt-pkg-badge"><?php echo esc_html($pkg['badge']); ?></div>
                    <?php endif; ?>
                    <h3 class="lt-pkg-name"><?php echo esc_html($pkg['name']); ?></h3>
                    <p class="lt-pkg-tag"><?php echo esc_html($pkg['tag']); ?></p>
                    <div class="lt-pkg-price"><span class="lt-pkg-amount"><?php echo esc_html($pkg['price']); ?></span><span class="lt-pkg-unit"><?php echo esc_html($pkg['unit']); ?></span></div>
                    <div class="lt-pkg-divider"></div>
                    <div class="lt-pkg-benefits">
                        <?php foreach ($benefits_list as $benefit) : ?>
                        <div class="lt-pkg-benefit"><?php echo $check_svg; ?><span><?php echo esc_html($benefit); ?></span></div>
                        <?php endforeach; ?>
                    </div>
                    <a href="#lt-booking" class="lt-pkg-cta"><?php echo esc_html($pkg_cta); ?></a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="lt-discounts" class="lt-discounts lt-section-pad">
        <div class="lt-discount-inner">
            <div class="lt-section-center">
                <span class="lt-eyebrow"><?php echo esc_html($disc_eyebrow); ?></span>
                <h2 class="lt-section-heading"><?php echo esc_html($disc_title); ?></h2>
                <p style="font-family:'Aerospace','Brother 1816 Bold',sans-serif;text-transform:uppercase;letter-spacing:1px;font-size:clamp(16px,1.8vw,20px);color:#ed1b68;margin:14px 0 0;"><?php echo esc_html($disc_sub_heading); ?></p>
            </div>

            <div class="lt-discount-box">
                <div class="lt-discount-divider"></div>

                <?php foreach ($disc_panels as $panel) : ?>
                <div class="lt-discount-panel">
                    <span class="lt-discount-num"><?php echo esc_html($panel['num']); ?><span style="font-size:0.42em;letter-spacing:1px;margin-left:6px;">OFF</span></span>
                    <h3 class="lt-discount-sub"><?php echo esc_html($panel['title']); ?></h3>
                    <p class="lt-discount-note"><?php echo esc_html($panel['note']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="lt-booking" class="lt-booking lt-section-pad">
        <div class="lt-booking-inner">
            <div class="lt-section-center">
                <span class="lt-eyebrow"><?php echo esc_html($book_eyebrow); ?></span>
                <h2 class="lt-section-heading"><?php echo esc_html($book_title); ?></h2>
                <p class="lt-section-sub"><?php echo esc_html($book_sub_1); ?></p>
                <p class="lt-section-sub"><?php echo esc_html($book_sub_2); ?></p>
                <a href="<?php echo esc_url($book_dir_link); ?>" target="_blank" rel="noopener noreferrer" class="lt-directions-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.7"/></svg>
                    <?php echo esc_html($book_dir_text); ?>
                </a>
            </div>

            <div id="lt-stage-build"
                 data-slot-duration="<?php echo esc_attr($slot_duration_minutes); ?>"
                 data-pkg1-rounds="<?php echo esc_attr($pkgs[1]['rounds']); ?>"
                 data-pkg1-name="<?php echo esc_attr($pkgs[1]['name']); ?>"
                 data-pkg1-price="<?php echo esc_attr($pkgs[1]['price']); ?>"
                 data-pkg1-dur="<?php echo esc_attr($pkgs[1]['tot_min'] . ' min total'); ?>"
                 data-pkg2-rounds="<?php echo esc_attr($pkgs[2]['rounds']); ?>"
                 data-pkg2-name="<?php echo esc_attr($pkgs[2]['name']); ?>"
                 data-pkg2-price="<?php echo esc_attr($pkgs[2]['price']); ?>"
                 data-pkg2-dur="<?php echo esc_attr($pkgs[2]['tot_min'] . ' min total'); ?>"
                 data-pkg3-rounds="<?php echo esc_attr($pkgs[3]['rounds']); ?>"
                 data-pkg3-name="<?php echo esc_attr($pkgs[3]['name']); ?>"
                 data-pkg3-price="<?php echo esc_attr($pkgs[3]['price']); ?>"
                 data-pkg3-dur="<?php echo esc_attr($pkgs[3]['tot_min'] . ' min total'); ?>">
                <div data-lt-step="1" class="lt-step-pkg">
                    <div class="lt-step-header">
                        <span class="lt-step-num">1</span>
                        <span class="lt-step-label">Choose your package</span>
                    </div>
                    <div id="lt-pkg-choices" class="lt-pkg-choices"></div>
                </div>
                
                <div id="lt-pkg-summary" class="lt-summary-bar" style="display:none;"></div>

                <div class="lt-booking-grid">
                    <div class="lt-booking-card" id="lt-cal-card">
                        <div data-lt-step="2">
                            <div class="lt-step-header">
                                <span class="lt-step-num">2</span>
                                <span class="lt-step-label">Pick a date</span>
                            </div>
                        </div>
                        <div id="lt-date-summary" class="lt-summary-bar" style="display:none;"></div>
                        
                        <div id="lt-calendar-body">
                            <div id="lt-date-lock" class="lt-lock-overlay">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="16" rx="2" stroke="#ed1b68" stroke-width="1.6"/><path d="M3 9h18M8 3v4M16 3v4" stroke="#ed1b68" stroke-width="1.6"/></svg>
                                <span>Choose a package above to unlock the available dates.</span>
                            </div>
                            
                            <div class="lt-cal-nav">
                                <div id="lt-month-label" class="lt-month-label"></div>
                                <div class="lt-cal-arrows">
                                    <button id="lt-prev-month" class="lt-cal-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M15 4l-8 8 8 8" stroke="currentColor" stroke-width="2"/></svg></button>
                                    <button id="lt-next-month" class="lt-cal-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 4l8 8-8 8" stroke="currentColor" stroke-width="2"/></svg></button>
                                </div>
                            </div>
                            
                            <div class="lt-cal-weekdays">
                                <div>MON</div><div>TUE</div><div>WED</div><div>THU</div><div>FRI</div><div>SAT</div><div>SUN</div>
                            </div>
                            <div id="lt-calendar-grid" class="lt-cal-grid"></div>
                            
                            <div class="lt-cal-legend">
                                <div class="lt-legend-item"><span class="lt-legend-swatch lt-legend-available"></span>Available</div>
                                <div class="lt-legend-item"><span class="lt-legend-swatch lt-legend-selected"></span>Selected</div>
                                <div class="lt-legend-item"><span class="lt-legend-swatch lt-legend-unavail"></span>Unavailable</div>
                            </div>
                        </div>

                        <div id="lt-time-divider" class="lt-time-divider" style="display:none;"></div>

                        <div data-lt-step="3" id="lt-time-section">
                            <div class="lt-step-header">
                                <span class="lt-step-num">3</span>
                                <span class="lt-step-label">Choose a time</span>
                            </div>
                        </div>
                        <div id="lt-time-summary" class="lt-summary-bar" style="display:none;"></div>
                        <p id="lt-no-date-msg" class="lt-no-date-msg">Pick a date to see available time slots.</p>
                        <div id="lt-slots-container"></div>
                    </div>

                    <div class="lt-booking-card" id="lt-form-card">
                        <div data-lt-step="4">
                            <div class="lt-step-header">
                                <span class="lt-step-num">4</span>
                                <span class="lt-step-label">Your details</span>
                            </div>
                        </div>
                        
                        <div class="lt-form-grid">
                            <div class="lt-form-field">
                                <label class="lt-label" for="lt-name">Full name</label>
                                <div class="lt-input-wrap">
                                    <input type="text" id="lt-name" placeholder="Your name" class="lt-input"/>
                                </div>
                            </div>
                            <div class="lt-form-field">
                                <label class="lt-label" for="lt-phone">Phone</label>
                                <div class="lt-input-wrap">
                                    <input type="tel" id="lt-phone" placeholder="07xx xxx xxx" class="lt-input"/>
                                </div>
                            </div>
                            <div class="lt-form-field">
                                <label class="lt-label" for="lt-email">Email</label>
                                <div class="lt-input-wrap">
                                    <input type="email" id="lt-email" placeholder="you@email.com" class="lt-input"/>
                                </div>
                            </div>
                            <div class="lt-form-field">
                                <label class="lt-label" for="lt-city">City <span class="lt-optional">(optional)</span></label>
                                <div class="lt-input-wrap">
                                    <input type="text" id="lt-city" placeholder="Your city" class="lt-input"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="lt-form-grid">
                            <div class="lt-form-field">
                                <label class="lt-label" for="lt-players">Nr of players</label>
                                <div class="lt-input-wrap lt-stepper-wrap">
                                    <button id="lt-dec-players" class="lt-stepper-btn" type="button" aria-label="Decrease number of players">-</button>
                                    <input type="number" id="lt-players" min="4" max="14" value="4" class="lt-stepper-input" />
                                    <button id="lt-inc-players" class="lt-stepper-btn" type="button" aria-label="Increase number of players">+</button>
                                </div>
                            </div>
                            <div class="lt-form-field">
                                <label class="lt-label" for="lt-gamemode">Game mode</label>
                                <div class="lt-input-wrap">
                                    <select id="lt-gamemode" class="lt-select">
                                        <option value="Battle Royale">Battle Royale</option>
                                        <option value="Team vs Team">Team vs Team</option>
                                        <option value="Last One Standing">Last One Standing</option>
                                        <option value="Capture the Flag">Capture the Flag</option>
                                        <option value="VIP Escort">VIP Escort</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="lt-form-field lt-terms-field">
                            <div class="lt-terms-wrapper">
                                <label class="lt-terms-label">
                                    <input type="checkbox" id="lt-terms-1" class="lt-checkbox legal-check" />
                                    <span class="lt-terms-text">
                                        <span class="lt-terms-ro">Am citit și accept <a href="/termeni-conditii-regulament-lt/" target="_blank">Termenii, Condițiile și Regulamentul de Participare Mind Shows Laser Tag</a>. Confirm că le voi transmite tuturor participanților incluși în rezervare.</span>
                                        <span class="lt-terms-en">I have read and accept the <a href="/terms-conditions-regulations-lt/" target="_blank">Mind Shows Laser Tag Terms, Conditions and Participation Rules</a>. I confirm that I will share them with all participants included in the booking.</span>
                                    </span>
                                </label>
                                <label class="lt-terms-label">
                                    <input type="checkbox" id="lt-terms-2" class="lt-checkbox legal-check" />
                                    <span class="lt-terms-text">
                                        <span class="lt-terms-ro">Înțeleg că accesul la Mind Shows Laser Tag se face prin LUN.R Camping și este supus regulilor de acces și securitate ale campingului, inclusiv verificărilor la intrare.</span>
                                        <span class="lt-terms-en">I understand that access to Mind Shows Laser Tag is through LUN.R Camping and is subject to the camping access and security rules, including entry checks.</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="lt-form-footer">
                            <div id="lt-form-status" class="lt-form-status">Complete the steps to review</div>
                            <button id="lt-review-btn" class="lt-btn-primary lt-btn-review" disabled>Review booking</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="lt-stage-review" class="lt-review-card" style="display:none;">
                <div class="lt-step-header">
                    <span class="lt-step-num">5</span>
                    <span class="lt-step-label">Review your booking</span>
                </div>
                <p class="lt-review-sub">Check everything looks right before you confirm.</p>
                <div class="lt-review-table" id="lt-review-table"></div>
                <div id="lt-error-container" class="lt-error-container" style="display:none; color:#ed1b68; font-family:'Outfit',sans-serif; font-size:14px; margin-bottom:15px; text-align:center;"></div>
                <div class="lt-review-actions">
                    <button id="lt-back-btn" class="lt-btn-outline">Back</button>
                    <button id="lt-confirm-btn" class="lt-btn-primary">Confirm booking</button>
                </div>
            </div>

            <div id="lt-stage-success" class="lt-success-card" style="display:none;">
                <div class="lt-success-icon">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2.4"/></svg>
                </div>
                <h3 class="lt-success-title" id="lt-success-title">You're in!</h3>
                <p class="lt-success-msg">Your slot request has been received. We'll confirm your booking by email shortly.</p>
                <button id="lt-reset-btn" class="lt-btn-outline">Book another session</button>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
