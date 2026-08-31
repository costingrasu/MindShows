<?php

get_header();

while ( have_posts() ) : the_post();
    $post_id = get_the_ID();

    $hero_title = get_field('dev_hero_title', $post_id) ?: get_the_title();
    $hero_subtitle = get_field('dev_hero_subtitle', $post_id) ?: 'Modul 1: Dragoste si Frica';
    $hero_desc = get_field('dev_hero_description', $post_id) ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis, finibus maximus enim. Suspendisse neque augue, rutrum eu sollicitudin cursus, maximus in velit.';
    $hero_btn_text = get_field('dev_hero_button_text', $post_id) ?: 'Inscriere';

    $obiective_title = get_field('dev_obiective_title', $post_id) ?: 'Obiective';
    $tiles = array();
    for ($i = 1; $i <= 4; $i++) {
        $ob_grp = get_field("dev_obiective_{$i}", $post_id);
        $tiles[] = array(
            'title' => (!empty($ob_grp['title'])) ? $ob_grp['title'] : 'Dezvoltare Gandire Strategica',
            'desc'  => (!empty($ob_grp['description'])) ? $ob_grp['description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'icon'  => (!empty($ob_grp['icon']['url'])) ? $ob_grp['icon']['url'] : '',
        );
    }

    $galerie_title = get_field('dev_galerie_title', $post_id) ?: 'Galerie';
    $galerie_desc = get_field('dev_galerie_description', $post_id) ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis, finibus maximus enim. Suspendisse neque augue, rutrum eu sollicitudin cursus, maximus in velit.';
    $galerie_images = get_field('dev_galerie_images', $post_id);
    if (empty($galerie_images) || !is_array($galerie_images)) {
        $galerie_images = array(
            array('url' => get_template_directory_uri() . '/assets/images/bg-development.webp', 'alt' => 'Galerie Slide 1'),
            array('url' => get_template_directory_uri() . '/assets/images/bg-development1.webp', 'alt' => 'Galerie Slide 2'),
            array('url' => get_template_directory_uri() . '/assets/images/bg-irlGaming.webp', 'alt' => 'Galerie Slide 3'),
            array('url' => get_template_directory_uri() . '/assets/images/bg-journeys.webp', 'alt' => 'Galerie Slide 4'),
            array('url' => get_template_directory_uri() . '/assets/images/bg-team.webp', 'alt' => 'Galerie Slide 5'),
        );
    }

    $ab1 = get_field('dev_about_1', $post_id);
    $about_1 = array(
        'title' => (!empty($ab1['title'])) ? $ab1['title'] : 'Concept',
        'desc'  => (!empty($ab1['description'])) ? $ab1['description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis, finibus maximus enim. Suspendisse neque augue, rutrum eu sollicitudin cursus, maximus in velit.',
        'image' => (!empty($ab1['image']['url'])) ? $ab1['image']['url'] : get_template_directory_uri() . '/assets/images/bg-development.webp',
    );

    $ab2 = get_field('dev_about_2', $post_id);
    $about_2 = array(
        'title' => (!empty($ab2['title'])) ? $ab2['title'] : 'Concept',
        'desc'  => (!empty($ab2['description'])) ? $ab2['description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis, finibus maximus enim. Suspendisse neque augue, rutrum eu sollicitudin cursus, maximus in velit.',
        'image' => (!empty($ab2['image']['url'])) ? $ab2['image']['url'] : get_template_directory_uri() . '/assets/images/bg-development1.webp',
    );

    $principii_title = get_field('dev_principii_title', $post_id) ?: 'Principii';
    $principii = array();
    for ($i = 1; $i <= 5; $i++) {
        $pr_grp = get_field("dev_principiu_{$i}", $post_id);
        $principii[] = array(
            'title' => (!empty($pr_grp['title'])) ? $pr_grp['title'] : 'Respect Reciproc',
            'desc'  => (!empty($pr_grp['description'])) ? $pr_grp['description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
        );
    }

    $traineri_title = get_field('dev_traineri_title', $post_id) ?: 'Traineri';
    $trainers = array();
    for ($i = 1; $i <= 3; $i++) {
        $tr_grp = get_field("dev_trainer_{$i}", $post_id);
        $trainers[] = array(
            'name'  => (!empty($tr_grp['name'])) ? $tr_grp['name'] : 'Christina Abrams',
            'role'  => (!empty($tr_grp['role'])) ? $tr_grp['role'] : 'Development Trainer',
            'bio'   => (!empty($tr_grp['description'])) ? $tr_grp['description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin felis ac aliquam rhoncus. Ut in purus in orci faucibus porta. Cras sollicitudin,',
            'image' => (!empty($tr_grp['image']['url'])) ? $tr_grp['image']['url'] : get_template_directory_uri() . '/assets/images/Hero.webp',
        );
    }

    $pt_title = get_field('dev_pt_title', $post_id) ?: 'CURSUL ESTE PENTRU TINE';
    $pt_items = get_field('dev_pt_items', $post_id);
    if (empty($pt_items) || !is_array($pt_items)) {
        $pt_items = array(
            array('item_text' => 'Daca Esti Dispus sa Aloci un Weekend Pentru Tine'),
            array('item_text' => 'Daca Esti Dispus sa Aloci un Weekend Pentru Tine'),
            array('item_text' => 'Daca Esti Dispus sa Aloci un Weekend Pentru Tine'),
            array('item_text' => 'Daca Esti Dispus sa Aloci un Weekend Pentru Tine'),
        );
    }

    $dt1 = get_field('dev_detaliu_1', $post_id);
    $dt2 = get_field('dev_detaliu_2', $post_id);
    $dt3 = get_field('dev_detaliu_3', $post_id);
    $detalii = array(
        array(
            'title' => (!empty($dt1['title'])) ? $dt1['title'] : 'Investitie',
            'val'   => (!empty($dt1['value'])) ? $dt1['value'] : '250 RON',
            'wide'  => false,
        ),
        array(
            'title' => (!empty($dt2['title'])) ? $dt2['title'] : 'Locatie',
            'val'   => (!empty($dt2['value'])) ? $dt2['value'] : 'Constanta',
            'wide'  => false,
        ),
        array(
            'title' => (!empty($dt3['title'])) ? $dt3['title'] : 'Program',
            'val'   => (!empty($dt3['value'])) ? $dt3['value'] : 'Sambata si Duminica',
            'wide'  => true,
        ),
    );

    $inscriere_title = get_field('dev_inscriere_title', $post_id) ?: 'Inscriere';
    $session_short_title = $hero_subtitle ?: 'Modul 1 Dezvoltare';
    $sessions_data = get_post_meta($post_id, '_dev_sessions', true);
    if (empty($sessions_data) || !is_array($sessions_data)) {
        $sessions_data = array(
            'locations' => array('Constanta', 'Bucuresti'),
            'sessions'  => array(
                'Constanta' => array(
                    array(
                        'year'  => intval(date('Y')),
                        'month' => intval(date('n')) - 1,
                        'days'  => array(10, 11),
                        'time'  => '9:00 - 17:00',
                        'title' => $session_short_title,
                    ),
                    array(
                        'year'  => intval(date('Y')),
                        'month' => intval(date('n')) - 1,
                        'days'  => array(17, 18),
                        'time'  => '9:00 - 17:00',
                        'title' => $session_short_title,
                    ),
                ),
                'Bucuresti' => array(
                    array(
                        'year'  => intval(date('Y')),
                        'month' => intval(date('n')) - 1,
                        'days'  => array(3, 4),
                        'time'  => '9:00 - 17:00',
                        'title' => $session_short_title,
                    ),
                    array(
                        'year'  => intval(date('Y')),
                        'month' => intval(date('n')) - 1,
                        'days'  => array(10, 11),
                        'time'  => '9:00 - 17:00',
                        'title' => $session_short_title,
                    ),
                ),
            ),
        );
    }
?>

<main class="dev-single-main">

    <section class="dev-hero" data-ms="hero">
        <h1 class="dev-hero-title"><?php echo esc_html($hero_title); ?></h1>

        <div class="dev-hero-badge">
            <span class="dev-hero-badge-text"><?php echo esc_html($hero_subtitle); ?></span>
        </div>

        <p class="dev-hero-copy"><?php echo wp_kses_post($hero_desc); ?></p>

        <a href="#dev-inscriere" class="dev-hero-btn"><?php echo esc_html($hero_btn_text); ?></a>
    </section>

    <section class="dev-obiective" data-ms="obiective">
        <h2 class="dev-obiective-title" data-reveal><?php echo esc_html($obiective_title); ?></h2>

        <div class="dev-tiles">
            <?php foreach ($tiles as $idx => $tile) : ?>
                <div class="dev-tile-wrap" data-reveal>
                    <div class="dev-tile" data-open="false">
                        <div class="dev-tile-inner">
                            <div class="dev-tile-icon-box">
                                <?php if (!empty($tile['icon'])) : ?>
                                    <img class="dev-tile-diamond" src="<?php echo esc_url($tile['icon']); ?>" alt="" loading="lazy">
                                <?php else : ?>
                                    <svg class="dev-tile-diamond" width="43.7" height="43.7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M12 2L2 12L12 22L22 12L12 2Z" fill="#00FFBB"/>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="dev-tile-title"><?php echo esc_html($tile['title']); ?></div>
                            <div class="dev-tile-desc"><?php echo wp_kses_post($tile['desc']); ?></div>
                            <div class="dev-tile-chevron">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M8 12L16 20L24 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="dev-galerie" data-ms="galerie">
        <div class="dev-galerie-head">
            <h2 class="dev-galerie-title" data-reveal><?php echo esc_html($galerie_title); ?></h2>
            <p class="dev-galerie-copy" data-reveal><?php echo wp_kses_post($galerie_desc); ?></p>

            <div class="dev-carousel">
                <div class="dev-slides-box">
                    <div class="dev-slide-list">
                        <?php 
                        $pos_names = array('c', 'mr', 'fr', 'fl', 'ml');
                        foreach ($galerie_images as $idx => $img) : 
                            $pos = isset($pos_names[$idx]) ? $pos_names[$idx] : 'fr';
                            $img_url = is_array($img) ? $img['url'] : $img;
                            $img_alt = (is_array($img) && !empty($img['alt'])) ? $img['alt'] : 'Galerie Slide ' . ($idx + 1);
                        ?>
                            <div class="dev-slide" data-pos="<?php echo esc_attr($pos); ?>">
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" loading="lazy">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="dev-slides-nav">
                    <button type="button" class="dev-arrow dev-arrow-prev" aria-label="Previous slide">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M15 3L7.5 12L15 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="dev-dots-wrap">
                        <?php foreach ($galerie_images as $idx => $img) : ?>
                            <button type="button" class="dev-dot" data-state="<?php echo $idx === 0 ? 'on' : 'off'; ?>" aria-label="Go to slide <?php echo $idx + 1; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="dev-arrow dev-arrow-next" aria-label="Next slide">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M9 3L16.5 12L9 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="dev-galerie-rule"></div>

        <div class="dev-concept-row">
            <div class="dev-concept-img" data-reveal>
                <img src="<?php echo esc_url($about_1['image']); ?>" alt="<?php echo esc_attr($about_1['title']); ?>" loading="lazy">
            </div>
            <div class="dev-concept-text" data-reveal>
                <h3 class="dev-concept-title"><?php echo esc_html($about_1['title']); ?></h3>
                <p class="dev-concept-copy"><?php echo wp_kses_post($about_1['desc']); ?></p>
            </div>
        </div>

        <div class="dev-concept-row reverse">
            <div class="dev-concept-img" data-reveal>
                <img src="<?php echo esc_url($about_2['image']); ?>" alt="<?php echo esc_attr($about_2['title']); ?>" loading="lazy">
            </div>
            <div class="dev-concept-text" data-reveal>
                <h3 class="dev-concept-title"><?php echo esc_html($about_2['title']); ?></h3>
                <p class="dev-concept-copy"><?php echo wp_kses_post($about_2['desc']); ?></p>
            </div>
        </div>
    </section>

    <section class="dev-principii" data-ms="principii">
        <div class="dev-principii-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/symbol-development.webp" alt="" loading="lazy">
            <div class="dev-principii-bg-fade"></div>
        </div>

        <h2 class="dev-principii-title" data-reveal><?php echo esc_html($principii_title); ?></h2>

        <div class="dev-principii-grid">
            <div class="dev-principii-row">
                <?php for ($i = 0; $i < 2; $i++) : if (isset($principii[$i])) : ?>
                    <div class="dev-principiu" data-reveal>
                        <div class="dev-principiu-content">
                            <div class="dev-principiu-title"><?php echo esc_html($principii[$i]['title']); ?></div>
                            <div class="dev-principiu-copy"><?php echo wp_kses_post($principii[$i]['desc']); ?></div>
                        </div>
                    </div>
                <?php endif; endfor; ?>
            </div>

            <div class="dev-principii-row">
                <?php for ($i = 2; $i < 5; $i++) : if (isset($principii[$i])) : ?>
                    <div class="dev-principiu" data-reveal>
                        <div class="dev-principiu-content">
                            <div class="dev-principiu-title"><?php echo esc_html($principii[$i]['title']); ?></div>
                            <div class="dev-principiu-copy"><?php echo wp_kses_post($principii[$i]['desc']); ?></div>
                        </div>
                    </div>
                <?php endif; endfor; ?>
            </div>
        </div>
    </section>

    <section class="dev-traineri" data-ms="traineri">
        <h2 class="dev-traineri-title" data-reveal><?php echo esc_html($traineri_title); ?></h2>

        <div class="dev-traineri-row">
            <?php foreach ($trainers as $idx => $trainer) : ?>
                <div class="dev-trainer" data-exp="0">
                    <div class="dev-tr-tribal">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/symbol-development.webp" alt="" loading="lazy">
                        <div class="dev-tr-glow"></div>
                    </div>

                    <div class="dev-tr-photo">
                        <img src="<?php echo esc_url($trainer['image']); ?>" alt="<?php echo esc_attr($trainer['name']); ?>" loading="lazy">
                        <div class="dev-tr-photo-fade"></div>
                    </div>

                    <div class="dev-tr-text">
                        <div class="dev-tr-head">
                            <div class="dev-tr-name"><?php echo esc_html($trainer['name']); ?></div>
                            <div class="dev-tr-role"><?php echo esc_html($trainer['role']); ?></div>
                        </div>
                        <div class="dev-tr-para">
                            <p class="dev-tr-bio"><?php echo wp_kses_post($trainer['bio']); ?></p>
                        </div>
                        <div class="dev-tr-btn">
                            <span>View More</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <div class="dev-divider-rule"></div>

    <section class="dev-pentru-tine" data-ms="pentru-tine">
        <h2 class="dev-pt-title" data-reveal><?php echo esc_html($pt_title); ?></h2>
        <div class="dev-pt-rule"></div>
        <ul class="dev-pt-copy" data-reveal>
            <?php foreach ($pt_items as $item) : 
                $item_text = is_array($item) ? $item['item_text'] : $item;
            ?>
                <li class="dev-pt-item"><?php echo esc_html($item_text); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <div class="dev-divider-rule mid-rule"></div>

    <section class="dev-detalii" data-ms="detalii">
        <?php foreach ($detalii as $dt) : ?>
            <div class="dev-detaliu<?php echo $dt['wide'] ? ' wide' : ''; ?>" data-reveal>
                <div class="dev-detaliu-title"><?php echo esc_html($dt['title']); ?></div>
                <div class="dev-detaliu-val"><?php echo esc_html($dt['val']); ?></div>
            </div>
        <?php endforeach; ?>
    </section>

    <div class="dev-divider-rule"></div>

    <section class="dev-inscriere" id="dev-inscriere" data-ms="inscriere">
        <h2 class="dev-inscriere-title" data-reveal><?php echo esc_html($inscriere_title); ?></h2>

        <div class="dev-inscriere-row">
            <div class="dev-cal" data-reveal>
                <div class="dev-cal-cities"></div>
                <div class="dev-cal-divider"></div>

                <div class="dev-cal-month-bar">
                    <div class="dev-cal-month-label"></div>
                    <div class="dev-cal-arrows">
                        <button type="button" class="dev-cal-arrow-btn dev-cal-prev-btn" aria-label="Luna anterioara">
                            <span class="dev-cal-arrow-left"></span>
                        </button>
                        <button type="button" class="dev-cal-arrow-btn dev-cal-next-btn" aria-label="Luna urmatoare">
                            <span class="dev-cal-arrow-right"></span>
                        </button>
                    </div>
                </div>

                <div class="dev-cal-divider"></div>

                <div class="dev-cal-body">
                    <div class="dev-cal-weekdays">
                        <div class="dev-cal-wd">Mo</div>
                        <div class="dev-cal-wd">Tu</div>
                        <div class="dev-cal-wd">We</div>
                        <div class="dev-cal-wd">Th</div>
                        <div class="dev-cal-wd">Fr</div>
                        <div class="dev-cal-wd">Sa</div>
                        <div class="dev-cal-wd">Su</div>
                    </div>

                    <div class="dev-cal-days-grid"></div>
                </div>

                <div class="dev-cal-divider" style="margin-top:13px;"></div>

                <div class="dev-cal-event-bar" style="display:none;">
                    <div class="dev-cal-event-inner">
                        <div class="dev-cal-event-meta">
                            <div class="dev-cal-event-time">9:00 - 17:00</div>
                            <div class="dev-cal-event-title"><?php echo esc_html($session_short_title); ?></div>
                        </div>
                        <button type="button" class="dev-cal-signup-btn">Sign Up</button>
                    </div>
                </div>
            </div>

            <div class="dev-in-col" id="dev-inscriere-form">
                <form class="dev-in-form" data-reveal data-post-id="<?php echo esc_attr($post_id); ?>">
                    <div class="dev-in-field-group">
                        <label class="dev-in-label" for="dev-in-name">Nume Complet</label>
                        <input type="text" id="dev-in-name" class="dev-in-input" placeholder="Ionut Trambiceanu" required>
                    </div>

                    <div class="dev-in-field-group">
                        <label class="dev-in-label" for="dev-in-phone">Nr. Telefon</label>
                        <input type="tel" id="dev-in-phone" class="dev-in-input" placeholder="07..." required>
                    </div>

                    <div class="dev-in-field-group">
                        <label class="dev-in-label" for="dev-in-email">E-mail</label>
                        <input type="email" id="dev-in-email" class="dev-in-input" placeholder="JaneDoe@gmail.com" required>
                    </div>

                    <div class="dev-in-field-group">
                        <label class="dev-in-label">Data</label>
                        <div class="dev-in-date-display">Selecteaza o data din calendar</div>
                    </div>

                    <div class="dev-in-field-group">
                        <label class="dev-in-label" for="dev-in-city">Oras Domiciliu</label>
                        <input type="text" id="dev-in-city" class="dev-in-input" placeholder="Constanta">
                    </div>

                    <button type="button" class="dev-in-submit">Start Now</button>
                </form>

                <div class="dev-in-done" data-visible="false">
                    <div class="dev-in-done-header">
                        <div class="dev-in-done-dot"></div>
                        <div class="dev-in-done-tag">Inscriere trimisa</div>
                    </div>
                    <div class="dev-in-done-title">Ne vedem la curs</div>
                    <p class="dev-in-done-msg">Te contactam in cel mai scurt timp pentru confirmare si detalii de plata.</p>
                    <div class="dev-in-done-pills">
                        <div class="dev-in-done-pill date-pill">Data Curs</div>
                        <div class="dev-in-done-pill time-pill">9:00 - 17:00</div>
                    </div>
                    <button type="button" class="dev-in-reset-btn">Inca o inscriere</button>
                </div>
            </div>
        </div>
    </section>

    <script type="application/json" id="dev-sessions-data">
        <?php echo wp_json_encode($sessions_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
    </script>

</main>

<?php
endwhile;

get_footer();
