<?php
/*
Template Name: Development Page
*/
get_header();

$hero_bg_img      = function_exists('get_field') ? get_field('devpage_hero_bg_image') : null;
$hero_bg_img_url  = mindshows_dev_hero_url();
$hero_bg_img_alt  = ($hero_bg_img && !empty($hero_bg_img['alt'])) ? $hero_bg_img['alt'] : '';
$hero_title       = (function_exists('get_field') && get_field('devpage_hero_title')) ? get_field('devpage_hero_title') : 'DEVELOPMENT';
$hero_description = (function_exists('get_field') && get_field('devpage_hero_description')) ? get_field('devpage_hero_description') : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation';
$hero_btn_text    = (function_exists('get_field') && get_field('devpage_hero_button_text')) ? get_field('devpage_hero_button_text') : 'Start Now';

$show_learn = function_exists('get_field') ? get_field('devpage_show_learn') : null;
$show_dirs  = function_exists('get_field') ? get_field('devpage_show_dirs') : null;
$show_tree  = function_exists('get_field') ? get_field('devpage_show_tree') : null;
$show_book  = function_exists('get_field') ? get_field('devpage_show_book') : null;
$show_sq    = function_exists('get_field') ? get_field('devpage_show_sidequests') : null;

if ($show_learn === null) $show_learn = true;
if ($show_dirs === null)  $show_dirs = true;
if ($show_tree === null)  $show_tree = true;
if ($show_book === null)  $show_book = true;
if ($show_sq === null)    $show_sq = true;

$learn_bg_img      = function_exists('get_field') ? get_field('devpage_learn_bg_image') : null;
$learn_bg_img_url  = ($learn_bg_img && isset($learn_bg_img['url'])) ? $learn_bg_img['url'] : get_template_directory_uri() . '/assets/images/bg-development-learn.webp';
$learn_title       = (function_exists('get_field') && get_field('devpage_learn_title')) ? get_field('devpage_learn_title') : 'CHANGING THE WAY WE LEARN';
$learn_description = (function_exists('get_field') && get_field('devpage_learn_description')) ? get_field('devpage_learn_description') : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation';

$learn_cards_raw = function_exists('get_field') ? get_field('devpage_learn_cards') : null;
$learn_cards     = array();
if (!empty($learn_cards_raw) && is_array($learn_cards_raw)) {
    foreach ($learn_cards_raw as $card) {
        if (empty($card['title']) && empty($card['description'])) {
            continue;
        }
        $learn_cards[] = array(
            'title'       => !empty($card['title']) ? $card['title'] : '',
            'description' => !empty($card['description']) ? $card['description'] : '',
        );
    }
}
if (empty($learn_cards)) {
    for ($i = 0; $i < 4; $i++) {
        $learn_cards[] = array(
            'title'       => 'Sistem Cursuri',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna',
        );
    }
}
$learn_card_count = count($learn_cards);

$dir_cards_raw = function_exists('get_field') ? get_field('devpage_dir_cards') : null;
$dir_cards_raw = is_array($dir_cards_raw) ? array_values($dir_cards_raw) : array();
$dir_cards     = array();
for ($i = 0; $i < 3; $i++) {
    $card = (isset($dir_cards_raw[$i]) && is_array($dir_cards_raw[$i])) ? $dir_cards_raw[$i] : array();

    if (empty($card['title']) && empty($card['subtitle']) && empty($card['description'])) {
        $dir_cards[] = array(
            'title'       => 'Directie ' . ($i + 1),
            'subtitle'    => 'Changing the Way We Learn',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        );
        continue;
    }

    $dir_cards[] = array(
        'title'       => !empty($card['title']) ? $card['title'] : '',
        'subtitle'    => !empty($card['subtitle']) ? $card['subtitle'] : '',
        'description' => !empty($card['description']) ? $card['description'] : '',
    );
}

$tree_title       = (function_exists('get_field') && get_field('devpage_tree_title')) ? get_field('devpage_tree_title') : 'SISTEMUL MIND SHOWS';
$tree_description = (function_exists('get_field') && get_field('devpage_tree_description')) ? get_field('devpage_tree_description') : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation';

$book_img       = function_exists('get_field') ? get_field('devpage_book_image') : null;
$book_img_url   = ($book_img && isset($book_img['url'])) ? $book_img['url'] : get_template_directory_uri() . '/assets/images/bg-development1.webp';
$book_img_alt   = ($book_img && !empty($book_img['alt'])) ? $book_img['alt'] : '';
$book_title     = (function_exists('get_field') && get_field('devpage_book_title')) ? get_field('devpage_book_title') : 'BOOK A FREE DEMO TODAY';
$book_desc      = (function_exists('get_field') && get_field('devpage_book_description')) ? get_field('devpage_book_description') : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation';
$book_btn_text  = (function_exists('get_field') && get_field('devpage_book_button_text')) ? get_field('devpage_book_button_text') : 'Book Now';

$sq_title       = (function_exists('get_field') && get_field('devpage_sq_title')) ? get_field('devpage_sq_title') : 'SIDE QUESTS';
$sq_description = (function_exists('get_field') && get_field('devpage_sq_description')) ? get_field('devpage_sq_description') : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation';
$sq_btn_text    = (function_exists('get_field') && get_field('devpage_sq_button_text')) ? get_field('devpage_sq_button_text') : 'View More';

$sq_cards = array();
if ($show_sq) {
    $sq_query = new WP_Query(array(
        'post_type'      => 'development',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array('key' => 'dev_quest_type', 'value' => 'side'),
        ),
    ));

    if ($sq_query->have_posts()) {
        while ($sq_query->have_posts()) {
            $sq_query->the_post();
            $sq_id  = get_the_ID();
            $sq_img = function_exists('get_field') ? get_field('dev_card_image', $sq_id) : null;
            $sq_sub = function_exists('get_field') ? get_field('dev_hero_subtitle', $sq_id) : '';
            $sq_dsc = function_exists('get_field') ? get_field('dev_hero_description', $sq_id) : '';

            $sq_cards[] = array(
                'title'       => get_the_title(),
                'permalink'   => get_permalink(),
                'image_url'   => ($sq_img && isset($sq_img['sizes']['large'])) ? $sq_img['sizes']['large'] : (($sq_img && isset($sq_img['url'])) ? $sq_img['url'] : ''),
                'subtitle'    => $sq_sub ? $sq_sub : '',
                'description' => $sq_dsc ? trim(strip_tags($sq_dsc)) : '',
            );
        }
    }
    wp_reset_postdata();
}

$show_ins = function_exists('get_field') ? get_field('devpage_show_inscriere') : null;
if ($show_ins === null) $show_ins = true;

$ins_title      = (function_exists('get_field') && get_field('devpage_ins_title')) ? get_field('devpage_ins_title') : 'INSCRIERE';
$ins_desc       = (function_exists('get_field') && get_field('devpage_ins_description')) ? get_field('devpage_ins_description') : 'Alege data si orasul care ti se potrivesc. Te ducem direct la cursul respectiv, cu data deja selectata.';
$ins_main_label = (function_exists('get_field') && get_field('devpage_ins_main_label')) ? get_field('devpage_ins_main_label') : 'Main Quest';
$ins_side_label = (function_exists('get_field') && get_field('devpage_ins_side_label')) ? get_field('devpage_ins_side_label') : 'Side Quests';
$ins_feat_id    = function_exists('get_field') ? (int) get_field('devpage_ins_featured_course') : 0;
$ins_feat_badge = (function_exists('get_field') && get_field('devpage_ins_featured_badge')) ? get_field('devpage_ins_featured_badge') : 'GRATUIT';
$ins_btn_text   = (function_exists('get_field') && get_field('devpage_ins_button_text')) ? get_field('devpage_ins_button_text') : 'Inscrie-te';
$ins_empty_ttl  = (function_exists('get_field') && get_field('devpage_ins_empty_title')) ? get_field('devpage_ins_empty_title') : 'Nicio sesiune programata';
$ins_empty_txt  = (function_exists('get_field') && get_field('devpage_ins_empty_text')) ? get_field('devpage_ins_empty_text') : 'Incearca alt oras sau alt tip de curs. Datele noi apar aici imediat ce sunt programate.';

$ins_schedule = function_exists('mindshows_get_development_schedule') ? mindshows_get_development_schedule() : array('rows' => array(), 'cities' => array());
$ins_rows     = isset($ins_schedule['rows']) ? $ins_schedule['rows'] : array();
$ins_cities   = isset($ins_schedule['cities']) ? $ins_schedule['cities'] : array();
$ins_courses  = function_exists('mindshows_dev_all_courses') ? mindshows_dev_all_courses() : array();

$ins_featured = null;
if ($ins_feat_id) {
    foreach ($ins_rows as $r) {
        if ($r['post_id'] === $ins_feat_id) {
            $ins_featured = $r;
            break;
        }
    }
    if ($ins_featured === null && get_post_status($ins_feat_id) === 'publish') {
        $ins_featured = array(
            'post_id'    => $ins_feat_id,
            'post_title' => get_the_title($ins_feat_id),
            'permalink'  => get_permalink($ins_feat_id),
            'city'       => '',
            'label'      => '',
            'time'       => '',
            'date_start' => '',
        );
    }
}

$tree            = mindshows_get_development_tree(get_the_ID());
$tree_root_title = $tree['root_title'];
$tree_root_desc  = $tree['root_desc'];
$tree_branches   = $tree['branches'];
?>

<main class="page-development">
    <section class="devpage-hero">
        <div class="devpage-hero-bg">
            <img src="<?php echo esc_url($hero_bg_img_url); ?>" alt="<?php echo esc_attr($hero_bg_img_alt); ?>" class="devpage-hero-img" fetchpriority="high" decoding="async" />
            <div class="devpage-hero-scrim" aria-hidden="true"></div>
        </div>

        <div class="devpage-hero-content">
            <h1 class="devpage-hero-title"><?php echo esc_html($hero_title); ?></h1>
            <div class="devpage-hero-desc"><?php echo wp_kses_post($hero_description); ?></div>

            <a href="#devpage-inscriere" class="devpage-btn devpage-hero-btn"><?php echo esc_html($hero_btn_text); ?></a>
        </div>
    </section>

    <?php if ($show_learn) : ?>
    <div class="devpage-divider" data-reveal aria-hidden="true"></div>
    <section class="devpage-learn">
        <div class="devpage-learn-bg" aria-hidden="true">
            <img src="<?php echo esc_url($learn_bg_img_url); ?>" alt="" class="devpage-learn-photo" loading="lazy" decoding="async" />
            <div class="devpage-learn-photo-fade"></div>
        </div>

        <div class="devpage-learn-inner">
            <header class="devpage-heading">
                <h2 class="devpage-heading-title"><?php echo esc_html($learn_title); ?></h2>
                <div class="devpage-heading-desc"><?php echo wp_kses_post($learn_description); ?></div>
            </header>

            <ol class="devpage-learn-path" data-count="<?php echo esc_attr($learn_card_count); ?>">
                <?php foreach ($learn_cards as $idx => $card) :
                    $desc_id = 'devpage-learn-desc-' . ($idx + 1);
                ?>
                    <li class="devpage-learn-step" data-reveal>
                        <div class="devpage-learn-card" data-state="closed">
                            <div class="devpage-learn-card-bg" aria-hidden="true"></div>
                            <?php if ($card['title'] !== '') : ?>
                                <h3 class="devpage-learn-card-title"><?php echo esc_html($card['title']); ?></h3>
                            <?php endif; ?>
                            <p class="devpage-learn-card-desc" id="<?php echo esc_attr($desc_id); ?>"><?php echo esc_html($card['description']); ?></p>
                            <button type="button" class="devpage-learn-card-toggle" aria-expanded="false" aria-controls="<?php echo esc_attr($desc_id); ?>" aria-label="<?php echo esc_attr($card['title'] !== '' ? 'Detalii: ' . $card['title'] : 'Detalii'); ?>">
                                <span class="devpage-learn-card-icon"></span>
                            </button>
                        </div>
                        <?php if ($idx < $learn_card_count - 1) : ?>
                            <span class="devpage-learn-connector" aria-hidden="true">
                                <svg class="devpage-learn-chevron" width="20" height="11" viewBox="0 0 20 11" fill="none"><path d="M2 2l8 7 8-7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($show_dirs) : ?>
    <div class="devpage-divider" data-reveal aria-hidden="true"></div>
    <section class="devpage-dirs">
        <ul class="devpage-dirs-track">
            <?php foreach ($dir_cards as $idx => $card) :
                $dir_desc_id = 'devpage-dir-desc-' . ($idx + 1);
            ?>
                <li class="devpage-dirs-item" data-reveal>
                    <article class="devpage-dir-card" data-expanded="false">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/symbol-development.webp'); ?>" alt="" class="devpage-dir-card-bg" loading="lazy" decoding="async" />
                        <div class="devpage-dir-card-overlay" aria-hidden="true"></div>
                        <button type="button" class="devpage-dir-card-close" aria-label="Închide">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 3l10 10M13 3L3 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </button>
                        <div class="devpage-dir-card-content">
                            <?php if ($card['title'] !== '') : ?>
                                <h3 class="devpage-dir-card-title"><?php echo esc_html($card['title']); ?></h3>
                            <?php endif; ?>
                            <?php if ($card['subtitle'] !== '') : ?>
                                <p class="devpage-dir-card-subtitle"><?php echo esc_html($card['subtitle']); ?></p>
                            <?php endif; ?>
                            <?php if ($card['description'] !== '') : ?>
                                <div class="devpage-dir-card-reveal">
                                    <div class="devpage-dir-card-reveal-inner">
                                        <div class="devpage-dir-card-desc" id="<?php echo esc_attr($dir_desc_id); ?>"><?php echo wp_kses_post($card['description']); ?></div>
                                    </div>
                                </div>
                                <button type="button" class="devpage-dir-card-more" aria-expanded="false" aria-controls="<?php echo esc_attr($dir_desc_id); ?>">View More</button>
                            <?php endif; ?>
                        </div>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <?php endif; ?>

    <?php if ($show_tree) : ?>
    <div class="devpage-divider" data-reveal aria-hidden="true"></div>
    <section class="devpage-tree">
        <div class="devpage-tree-inner">
            <header class="devpage-heading">
                <h2 class="devpage-heading-title"><?php echo esc_html($tree_title); ?></h2>
                <div class="devpage-heading-desc"><?php echo wp_kses_post($tree_description); ?></div>
            </header>

            <div class="devpage-tree-diagram">
                <svg class="devpage-tree-lines" aria-hidden="true" focusable="false">
                    <?php foreach ($tree_branches as $branch) : ?>
                        <line x1="0" y1="0" x2="0" y2="0" />
                    <?php endforeach; ?>
                </svg>

                <div class="devpage-tree-root" data-reveal>
                    <p class="devpage-tree-root-title"><?php echo esc_html($tree_root_title); ?></p>
                    <p class="devpage-tree-root-desc"><?php echo esc_html($tree_root_desc); ?></p>
                </div>

                <ol class="devpage-tree-branches">
                    <?php foreach ($tree_branches as $branch) : ?>
                        <li class="devpage-tree-branch" data-reveal>
                            <h3 class="devpage-tree-branch-title"><?php echo esc_html($branch['title']); ?></h3>
                            <ul class="devpage-tree-nodes">
                                <?php foreach ($branch['nodes'] as $node) :
                                    $node_url = !empty($node['url']) ? $node['url'] : '';
                                ?>
                                    <li class="devpage-tree-node">
                                        <?php if ($node_url !== '') : ?>
                                            <a href="<?php echo esc_url($node_url); ?>" class="devpage-tree-node-card">
                                        <?php else : ?>
                                            <div class="devpage-tree-node-card">
                                        <?php endif; ?>
                                            <?php if ($node['title'] !== '') : ?>
                                                <p class="devpage-tree-node-title"><?php echo esc_html($node['title']); ?></p>
                                            <?php endif; ?>
                                            <?php if ($node['desc'] !== '') : ?>
                                                <p class="devpage-tree-node-desc"><?php echo esc_html($node['desc']); ?></p>
                                            <?php endif; ?>
                                        <?php if ($node_url !== '') : ?>
                                            </a>
                                        <?php else : ?>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($show_book) : ?>
    <div class="devpage-divider" data-reveal aria-hidden="true"></div>
    <section class="devpage-book">
        <div class="devpage-book-inner">
            <div class="devpage-book-media" data-reveal>
                <img src="<?php echo esc_url($book_img_url); ?>" alt="<?php echo esc_attr($book_img_alt); ?>" class="devpage-book-image" loading="lazy" decoding="async" />
            </div>

            <div class="devpage-book-content" data-reveal>
                <div class="devpage-book-text">
                    <h2 class="devpage-book-title"><?php echo esc_html($book_title); ?></h2>
                    <div class="devpage-book-desc"><?php echo wp_kses_post($book_desc); ?></div>
                </div>

                <a href="#devpage-inscriere" class="devpage-btn devpage-book-btn"><?php echo esc_html($book_btn_text); ?></a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($show_sq && !empty($sq_cards)) : ?>
    <div class="devpage-divider" data-reveal aria-hidden="true"></div>
    <section class="devpage-sidequests">
        <div class="devpage-sq-symbol" aria-hidden="true">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/symbol-development.webp'); ?>" alt="" loading="lazy" decoding="async" />
            <div class="devpage-sq-symbol-fade"></div>
        </div>

        <div class="devpage-sq-inner">
            <header class="devpage-sq-head">
                <h2 class="devpage-sq-title"><?php echo esc_html($sq_title); ?></h2>
                <div class="devpage-sq-desc"><?php echo wp_kses_post($sq_description); ?></div>
            </header>

            <div class="devpage-sq-track">
                <?php foreach ($sq_cards as $card) : ?>
                    <div class="devpage-sq-item" data-reveal>
                    <article class="devpage-sq-card">
                        <?php if ($card['image_url'] !== '') : ?>
                            <img src="<?php echo esc_url($card['image_url']); ?>" alt="" class="devpage-sq-card-photo" loading="lazy" decoding="async" />
                        <?php endif; ?>
                        <div class="devpage-sq-card-scrim" aria-hidden="true"></div>
                        <div class="devpage-sq-card-symbol" aria-hidden="true"></div>

                        <div class="devpage-sq-card-content">
                            <h3 class="devpage-sq-card-title"><?php echo esc_html($card['title']); ?></h3>
                            <?php if ($card['subtitle'] !== '') : ?>
                                <span class="devpage-sq-card-subtitle"><?php echo esc_html($card['subtitle']); ?></span>
                            <?php endif; ?>

                            <div class="devpage-sq-card-reveal">
                                <?php if ($card['description'] !== '') : ?>
                                    <p class="devpage-sq-card-desc"><?php echo esc_html($card['description']); ?></p>
                                <?php endif; ?>
                                <a href="<?php echo esc_url($card['permalink']); ?>" class="devpage-btn devpage-sq-card-btn"<?php if ($card['title'] !== '') : ?> aria-label="<?php echo esc_attr($sq_btn_text . ': ' . $card['title']); ?>"<?php endif; ?>><?php echo esc_html($sq_btn_text); ?></a>
                            </div>
                        </div>
                    </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($show_ins) : ?>
    <div class="devpage-divider" data-reveal aria-hidden="true"></div>
    <section class="devpage-inscriere" id="devpage-inscriere">
        <div class="devpage-ins-inner">

            <header class="devpage-ins-head" data-reveal>
                <h2 class="devpage-ins-title"><?php echo esc_html($ins_title); ?></h2>
                <div class="devpage-ins-desc"><?php echo esc_html($ins_desc); ?></div>
            </header>

            <div class="devpage-ins-controls" data-reveal>
                <div class="devpage-ins-quests" role="group" aria-label="Filtreaza dupa tip">
                    <button type="button" class="devpage-ins-quest" data-quest-filter="all" aria-pressed="true">Toate</button>
                    <button type="button" class="devpage-ins-quest" data-quest-filter="main" aria-pressed="false"><?php echo esc_html($ins_main_label); ?></button>
                    <button type="button" class="devpage-ins-quest" data-quest-filter="side" aria-pressed="false"><?php echo esc_html($ins_side_label); ?></button>
                </div>

                <div class="devpage-ins-loc">
                    <label class="devpage-ins-loc-label" for="devpage-ins-city">Locatie</label>
                    <select id="devpage-ins-city" class="devpage-ins-select">
                        <option value="all">Toate locatiile</option>
                        <?php foreach ($ins_cities as $ins_city) : ?>
                        <option value="<?php echo esc_attr($ins_city); ?>"><?php echo esc_html($ins_city); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <?php if ($ins_featured) : ?>
            <div class="devpage-ins-featured-wrap" data-reveal>
                <a class="devpage-ins-featured" href="<?php echo esc_url(mindshows_dev_slot_link($ins_featured)); ?>">
                    <span class="devpage-ins-symbol" aria-hidden="true"></span>
                    <span class="devpage-ins-featured-body">
                        <span class="devpage-ins-featured-top">
                            <span class="devpage-ins-featured-title"><?php echo esc_html($ins_featured['post_title']); ?></span>
                            <?php if ($ins_feat_badge) : ?>
                            <span class="devpage-ins-badge"><?php echo esc_html($ins_feat_badge); ?></span>
                            <?php endif; ?>
                        </span>
                        <?php if (!empty($ins_featured['label'])) : ?>
                        <span class="devpage-ins-featured-meta"><?php echo wp_kses($ins_featured['label'], array()); ?> &middot; <?php echo esc_html($ins_featured['city']); ?> &middot; <?php echo esc_html($ins_featured['time']); ?></span>
                        <?php endif; ?>
                    </span>
                    <span class="devpage-ins-featured-cta"><?php echo esc_html($ins_btn_text); ?></span>
                </a>
            </div>
            <?php endif; ?>

            <?php if (!empty($ins_rows)) : ?>
            <div class="devpage-ins-meta" data-reveal>
                <span class="devpage-ins-count"><?php echo count($ins_rows) === 1 ? '1 SESIUNE' : esc_html(count($ins_rows)) . ' SESIUNI'; ?></span>
                <span class="devpage-ins-sorted">sortate dupa data</span>
            </div>

            <ul class="devpage-ins-list">
                <?php foreach ($ins_rows as $ins_row) : ?>
                <li class="devpage-ins-item" data-reveal data-quest="<?php echo esc_attr($ins_row['quest']); ?>" data-city="<?php echo esc_attr($ins_row['city']); ?>">
                    <a class="devpage-ins-row" href="<?php echo esc_url(mindshows_dev_slot_link($ins_row)); ?>" aria-label="<?php echo esc_attr($ins_btn_text . ': ' . $ins_row['post_title'] . ', ' . wp_strip_all_tags(html_entity_decode($ins_row['label'])) . ', ' . $ins_row['city']); ?>">
                        <span class="devpage-ins-symbol" aria-hidden="true"></span>
                        <span class="devpage-ins-when">
                            <span class="devpage-ins-date"><?php echo wp_kses($ins_row['label'], array()); ?></span>
                            <span class="devpage-ins-city"><?php echo esc_html($ins_row['city']); ?></span>
                        </span>
                        <span class="devpage-ins-main">
                            <span class="devpage-ins-row-title"><?php echo esc_html($ins_row['post_title']); ?></span>
                            <span class="devpage-ins-time"><?php echo esc_html($ins_row['time']); ?></span>
                        </span>
                        <span class="devpage-ins-cta"><?php echo esc_html($ins_btn_text); ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <div class="devpage-ins-empty"<?php if (!empty($ins_rows)) : ?> hidden<?php endif; ?>>
                <div class="devpage-ins-empty-title"><?php echo esc_html($ins_empty_ttl); ?></div>
                <p class="devpage-ins-empty-text"><?php echo esc_html($ins_empty_txt); ?></p>
                <?php if (!empty($ins_rows)) : ?>
                <button type="button" class="devpage-ins-reset">Reseteaza filtrele</button>
                <?php endif; ?>

                <?php if (!empty($ins_courses)) : ?>
                <div class="devpage-ins-chips-label">TOATE CURSURILE</div>
                <ul class="devpage-ins-chips">
                    <?php foreach ($ins_courses as $ins_course) : ?>
                    <li><a class="devpage-ins-chip" href="<?php echo esc_url($ins_course['permalink']); ?>"><?php echo esc_html($ins_course['title']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
