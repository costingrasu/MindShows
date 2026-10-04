<?php

get_header();

while ( have_posts() ) : the_post();
    $post_id = get_the_ID();

    $sections = mindshows_single_sections_data($post_id, 'development');

    $show_obiective   = get_field('dev_show_obiective', $post_id);
    $show_galerie     = get_field('dev_show_galerie', $post_id);
    $show_about       = get_field('dev_show_about', $post_id);
    $show_principii   = get_field('dev_show_principii', $post_id);
    $show_traineri    = get_field('dev_show_traineri', $post_id);
    $show_pentru_tine = get_field('dev_show_pentru_tine', $post_id);
    $show_detalii     = get_field('dev_show_detalii', $post_id);
    $show_inscriere   = get_field('dev_show_inscriere', $post_id);

    if ($show_obiective === null)   $show_obiective = true;
    if ($show_galerie === null)     $show_galerie = true;
    if ($show_about === null)       $show_about = true;
    if ($show_principii === null)   $show_principii = true;
    if ($show_traineri === null)    $show_traineri = true;
    if ($show_pentru_tine === null) $show_pentru_tine = true;
    if ($show_detalii === null)     $show_detalii = true;
    if ($show_inscriere === null)   $show_inscriere = true;

    $obiective_title = get_field('dev_obiective_title', $post_id) ?: 'Obiective';
    $tiles = array();
    for ($i = 1; $i <= 4; $i++) {
        $ob_grp = get_field("dev_obiective_{$i}", $post_id);
        $tiles[] = array(
            'title' => (!empty($ob_grp['title'])) ? $ob_grp['title'] : 'Empty keypoint title',
            'desc'  => (!empty($ob_grp['description'])) ? $ob_grp['description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'icon'  => (!empty($ob_grp['icon']['url'])) ? $ob_grp['icon']['url'] : '',
        );
    }

    $principii_title = get_field('dev_principii_title', $post_id) ?: 'Principii';
    $principii = array();
    for ($i = 1; $i <= 5; $i++) {
        $pr_grp = get_field("dev_principiu_{$i}", $post_id);
        $principii[] = array(
            'title' => (!empty($pr_grp['title'])) ? $pr_grp['title'] : 'Empty title',
            'desc'  => (!empty($pr_grp['description'])) ? $pr_grp['description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
        );
    }

    $traineri_title = get_field('dev_traineri_title', $post_id) ?: 'Traineri';
    $trainers_raw = get_field('dev_trainers', $post_id);
    $trainers = array();
    if (!empty($trainers_raw) && is_array($trainers_raw)) {
        foreach ($trainers_raw as $tr) {
            $trainers[] = array(
                'name'  => (!empty($tr['name'])) ? $tr['name'] : 'Empty',
                'role'  => (!empty($tr['role'])) ? $tr['role'] : 'Development Trainer',
                'bio'   => (!empty($tr['description'])) ? $tr['description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin felis ac aliquam rhoncus. Ut in purus in orci faucibus porta. Cras sollicitudin,',
                'image' => (!empty($tr['image']['url'])) ? $tr['image']['url'] : ((is_string($tr['image']) && !empty($tr['image'])) ? $tr['image'] : ''),
            );
        }
    }
    if (empty($trainers)) {
        for ($i = 1; $i <= 3; $i++) {
            $tr_grp = get_field("dev_trainer_{$i}", $post_id);
            if (!empty($tr_grp['name']) || !empty($tr_grp['image'])) {
                $trainers[] = array(
                    'name'  => (!empty($tr_grp['name'])) ? $tr_grp['name'] : 'Empty',
                    'role'  => (!empty($tr_grp['role'])) ? $tr_grp['role'] : 'Development Trainer',
                    'bio'   => (!empty($tr_grp['description'])) ? $tr_grp['description'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'image' => (!empty($tr_grp['image']['url'])) ? $tr_grp['image']['url'] : '',
                );
            }
        }
    }
    if (empty($trainers)) {
        $trainers = array(
            array(
                'name'  => 'Empty',
                'role'  => 'Development Trainer',
                'bio'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin felis ac aliquam rhoncus. Ut in purus in orci faucibus porta. Cras sollicitudin,',
                'image' => '',
            ),
        );
    }
    $trainer_count = count($trainers);

    $inscriere_title = get_field('dev_inscriere_title', $post_id) ?: 'Inscriere';
    $has_dates       = function_exists('mindshows_dev_has_upcoming') ? mindshows_dev_has_upcoming($post_id) : true;
    $empty_title     = get_field('dev_inscriere_empty_title', $post_id) ?: 'Nicio data disponibila momentan';
    $empty_text      = get_field('dev_inscriere_empty_text', $post_id) ?: 'Programul pentru acest curs se actualizeaza in curand. Scrie-ne si te anuntam imediat ce apar date noi.';
    $session_short_title = $sections['hero']['badge'] ?: 'Empty';
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

    <?php get_template_part('template-parts/single/hero', null, $sections['hero']); ?>

    <?php if ($show_obiective) : ?>
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
    <?php endif; ?>

    <?php if ($show_galerie) : ?>
    <?php get_template_part('template-parts/single/galerie', null, $sections['galerie']); ?>
    <?php endif; ?>

    <?php if ($show_about) : ?>
    <?php get_template_part('template-parts/single/about', null, array('rows' => $sections['about'])); ?>
    <?php endif; ?>

    <?php if ($show_principii) : ?>
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
    <?php endif; ?>

    <?php if ($show_traineri) : ?>
    <section class="dev-traineri" data-ms="traineri">
        <h2 class="dev-traineri-title" data-reveal><?php echo esc_html($traineri_title); ?></h2>

        <div class="dev-traineri-row" data-count="<?php echo esc_attr($trainer_count); ?>">
            <?php foreach ($trainers as $idx => $trainer) : ?>
                <div class="dev-trainer" data-exp="0">
                    <div class="dev-tr-tribal">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/symbol-development.webp" alt="" loading="lazy">
                        <div class="dev-tr-glow"></div>
                    </div>

                    <?php if (!empty($trainer['image'])) : ?>
                    <div class="dev-tr-photo">
                        <img src="<?php echo esc_url($trainer['image']); ?>" alt="<?php echo esc_attr($trainer['name']); ?>" loading="lazy">
                    </div>
                    <?php endif; ?>

                    <div class="dev-tr-photo-fade"></div>

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
    <?php endif; ?>

    <?php if ($show_pentru_tine) : ?>
    <?php get_template_part('template-parts/single/pentru-tine', null, $sections['pentru_tine']); ?>

    <div class="dev-divider-rule mid-rule"></div>
    <?php endif; ?>

    <?php if ($show_detalii) : ?>
    <?php get_template_part('template-parts/single/detalii', null, array('items' => $sections['detalii'])); ?>

    <div class="dev-divider-rule"></div>
    <?php endif; ?>

    <?php if ($show_inscriere) : ?>
    <section class="dev-inscriere" id="dev-inscriere" data-ms="inscriere" data-empty="<?php echo $has_dates ? '0' : '1'; ?>">
        <h2 class="dev-inscriere-title" data-reveal><?php echo esc_html($inscriere_title); ?></h2>

        <div class="dev-inscriere-shell">
        <div class="dev-inscriere-row"<?php if (!$has_dates) : ?> inert aria-hidden="true"<?php endif; ?>>
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

                <div class="dev-cal-event-bars" style="display:none;"></div>

                <template class="dev-cal-event-tpl">
                    <div class="dev-cal-event-bar">
                        <div class="dev-cal-event-inner">
                            <div class="dev-cal-event-meta">
                                <div class="dev-cal-event-time">9:00 - 17:00</div>
                                <div class="dev-cal-event-title"><?php echo esc_html($session_short_title); ?></div>
                            </div>
                            <button type="button" class="dev-cal-signup-btn">Sign Up</button>
                        </div>
                    </div>
                </template>
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

                    <button type="button" class="dev-in-submit" disabled>Start Now</button>
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
        <?php if (!$has_dates) : ?>
        <div class="dev-inscriere-empty" role="status">
            <div class="dev-inscriere-empty-title"><?php echo esc_html($empty_title); ?></div>
            <p class="dev-inscriere-empty-text"><?php echo esc_html($empty_text); ?></p>
        </div>
        <?php endif; ?>
        </div>
    </section>

    <script type="application/json" id="dev-sessions-data">
        <?php echo wp_json_encode($sessions_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
    </script>
    <?php endif; ?>

</main>

<?php
endwhile;

get_footer();
