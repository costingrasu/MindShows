<?php

get_header();

while ( have_posts() ) : the_post();
    $post_id  = get_the_ID();
    $sections = mindshows_single_sections_data($post_id, 'irl_gaming');

    $show = array();
    foreach (array('galerie', 'about', 'detalii', 'pentru_tine', 'booking') as $slug) {
        $value = get_field("irl_show_{$slug}", $post_id);
        $show[$slug] = ($value === null) ? true : (bool) $value;
    }
?>

<main class="dev-single-main irl-single-main">

    <?php get_template_part('template-parts/single/hero', null, $sections['hero']); ?>

    <?php if ($show['galerie']) : ?>
    <?php get_template_part('template-parts/single/galerie', null, $sections['galerie']); ?>
    <?php endif; ?>

    <?php if ($show['about']) : ?>
    <?php get_template_part('template-parts/single/about', null, array('rows' => $sections['about'])); ?>

    <div class="dev-divider-rule"></div>
    <?php endif; ?>

    <?php if ($show['detalii']) : ?>
    <?php get_template_part('template-parts/single/detalii', null, array('items' => $sections['detalii'])); ?>

    <div class="dev-divider-rule"></div>
    <?php endif; ?>

    <?php if ($show['pentru_tine']) : ?>
    <?php get_template_part('template-parts/single/pentru-tine', null, $sections['pentru_tine']); ?>

    <div class="dev-divider-rule"></div>
    <?php endif; ?>

    <?php if ($show['booking']) :
        $bk = mindshows_irl_booking_settings($post_id);
        $game_title = get_the_title();
        $bk_sessions = array('locations' => array(), 'sessions' => array());
        foreach (mindshows_dev_expand_sessions($post_id) as $slot) {
            if ($slot['date_end'] < current_time('Y-m-d')) {
                continue;
            }
            $bk_sessions['sessions'][$slot['city']][] = array(
                'year'  => (int) substr($slot['date_start'], 0, 4),
                'month' => (int) substr($slot['date_start'], 5, 2) - 1,
                'days'  => $slot['days'],
                'time'  => $slot['time'],
                'title' => $slot['title'] ?: $game_title,
            );
        }
        $bk_sessions['locations'] = array_keys($bk_sessions['sessions']);
        $bk_has_dates = !empty($bk_sessions['locations']);
        $bk_multi_loc = count($bk_sessions['locations']) > 1;
        $bk_cards = array(
            'public'  => array($bk['irl_public_title'], $bk['irl_public_subtitle'], $bk['irl_public_desc']),
            'private' => array($bk['irl_private_title'], $bk['irl_private_subtitle'], $bk['irl_private_desc']),
        );
    ?>
    <section class="dev-inscriere irl-booking<?php echo $bk_multi_loc ? ' irl-bk-multi-loc' : ''; ?>" id="irl-booking" data-ms="inscriere" data-mode="public" data-step="cards" data-post-id="<?php echo esc_attr($post_id); ?>">
        <h2 class="dev-inscriere-title" data-reveal><?php echo esc_html($bk['irl_booking_title']); ?></h2>

        <div class="irl-bk-row">
            <div class="irl-bk-cards" data-reveal>
                <?php foreach ($bk_cards as $mode => $card) : ?>
                <button type="button" class="irl-bk-card" data-mode="<?php echo esc_attr($mode); ?>" aria-pressed="<?php echo $mode === 'public' ? 'true' : 'false'; ?>">
                    <span class="irl-bk-card-title"><?php echo esc_html($card[0]); ?></span>
                    <span class="irl-bk-card-sub"><?php echo esc_html($card[1]); ?></span>
                    <span class="irl-bk-card-desc"><?php echo esc_html($card[2]); ?></span>
                </button>
                <?php endforeach; ?>
            </div>

            <div class="irl-bk-panel" data-reveal>
                <div class="irl-bk-head">
                    <button type="button" class="irl-bk-back" aria-label="Inapoi"></button>
                    <span class="irl-bk-head-title" data-only-step="cal">Valabilitate</span>
                    <span class="irl-bk-head-title" data-only-step="form">Contact</span>
                </div>

                <div class="irl-bk-cal-wrap" data-empty="<?php echo $bk_has_dates ? '0' : '1'; ?>">
                    <div class="dev-cal"<?php if (!$bk_has_dates) : ?> inert aria-hidden="true"<?php endif; ?>>
                        <div class="dev-cal-cities"></div>
                        <div class="dev-cal-divider"></div>

                        <div class="dev-cal-month-bar">
                            <div class="dev-cal-month-label"></div>
                            <div class="dev-cal-arrows">
                                <button type="button" class="dev-cal-arrow-btn dev-cal-prev-btn" aria-label="Luna anterioara"<?php echo $bk_has_dates ? '' : ' tabindex="-1"'; ?>>
                                    <span class="dev-cal-arrow-left"></span>
                                </button>
                                <button type="button" class="dev-cal-arrow-btn dev-cal-next-btn" aria-label="Luna urmatoare"<?php echo $bk_has_dates ? '' : ' tabindex="-1"'; ?>>
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

                        <div class="dev-cal-divider"></div>

                        <div class="dev-cal-event-bars" style="display:none;"></div>

                        <template class="dev-cal-event-tpl">
                            <div class="dev-cal-event-bar">
                                <div class="dev-cal-event-inner">
                                    <div class="dev-cal-event-meta">
                                        <div class="dev-cal-event-time">9:00 - 17:00</div>
                                        <div class="dev-cal-event-title"><?php echo esc_html($game_title); ?></div>
                                    </div>
                                    <button type="button" class="dev-cal-signup-btn"><?php echo esc_html($bk['irl_signup_text']); ?></button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <?php if (!$bk_has_dates) : ?>
                    <div class="dev-inscriere-empty" role="status">
                        <div class="dev-inscriere-empty-title"><?php echo esc_html($bk['irl_empty_title']); ?></div>
                        <p class="dev-inscriere-empty-text"><?php echo esc_html($bk['irl_empty_text']); ?></p>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="irl-bk-form-wrap">
                    <form class="irl-bk-form" novalidate>
                        <?php if ($bk['irl_public_intro'] !== '') : ?>
                        <p class="irl-bk-intro" data-only="public"><?php echo esc_html($bk['irl_public_intro']); ?></p>
                        <?php endif; ?>
                        <?php if ($bk['irl_private_intro'] !== '') : ?>
                        <p class="irl-bk-intro" data-only="private"><?php echo esc_html($bk['irl_private_intro']); ?></p>
                        <?php endif; ?>

                        <div class="dev-in-field-group">
                            <label class="dev-in-label" for="irl-bk-name">Nume Complet</label>
                            <input type="text" id="irl-bk-name" name="name" class="dev-in-input" placeholder="Ionut Trambiceanu" autocomplete="name" maxlength="80">
                        </div>

                        <div class="dev-in-field-group">
                            <label class="dev-in-label" for="irl-bk-phone">Nr. Telefon</label>
                            <input type="tel" id="irl-bk-phone" name="phone" class="dev-in-input" placeholder="07..." autocomplete="tel" inputmode="tel" maxlength="20">
                        </div>

                        <div class="dev-in-field-group">
                            <label class="dev-in-label" for="irl-bk-email">E-mail</label>
                            <input type="email" id="irl-bk-email" name="email" class="dev-in-input" placeholder="JaneDoe@gmail.com" autocomplete="email" maxlength="100">
                        </div>

                        <div class="dev-in-field-group">
                            <label class="dev-in-label" for="irl-bk-participants">Numar Participanti</label>
                            <input type="number" id="irl-bk-participants" name="participants" class="dev-in-input" placeholder="4" min="1" max="999" step="1" inputmode="numeric">
                        </div>

                        <div class="dev-in-field-group" data-only="public">
                            <span class="dev-in-label">Data si Ora</span>
                            <div class="dev-in-date-display">Selecteaza o data din calendar</div>
                        </div>

                        <div class="dev-in-field-group" data-only="private">
                            <label class="dev-in-label" for="irl-bk-date">Data</label>
                            <input type="date" id="irl-bk-date" name="date" class="dev-in-input" min="<?php echo esc_attr(current_time('Y-m-d')); ?>">
                        </div>

                        <div class="dev-in-field-group" data-only="private">
                            <label class="dev-in-label" for="irl-bk-location">Locatie</label>
                            <input type="text" id="irl-bk-location" name="location" class="dev-in-input" placeholder="Constanta" maxlength="120">
                        </div>

                        <div class="dev-in-field-group" data-only="private">
                            <label class="dev-in-label" for="irl-bk-location-type">Tip Locatie</label>
                            <select id="irl-bk-location-type" name="location_type" class="dev-in-input">
                                <option value="">Alege tipul locatiei</option>
                                <?php foreach ($bk['irl_location_types'] as $opt) : ?>
                                <option value="<?php echo esc_attr($opt); ?>"><?php echo esc_html($opt); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="dev-in-field-group" data-only="private">
                            <label class="dev-in-label" for="irl-bk-objective">Obiectivul Evenimentului</label>
                            <select id="irl-bk-objective" name="objective" class="dev-in-input">
                                <option value="">Alege obiectivul</option>
                                <?php foreach ($bk['irl_objectives'] as $opt) : ?>
                                <option value="<?php echo esc_attr($opt); ?>"><?php echo esc_html($opt); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <p class="irl-bk-error" role="alert" hidden></p>

                        <button type="submit" class="dev-in-submit irl-bk-submit" disabled><?php echo esc_html($bk['irl_submit_text']); ?></button>
                    </form>

                    <div class="dev-in-done" data-visible="false">
                        <div class="dev-in-done-header">
                            <div class="dev-in-done-dot"></div>
                            <div class="dev-in-done-tag">Rezervare trimisa</div>
                        </div>
                        <div class="dev-in-done-title">Multumim!</div>
                        <p class="dev-in-done-msg">Te contactam in cel mai scurt timp pentru confirmare si detalii.</p>
                        <div class="dev-in-done-pills">
                            <div class="dev-in-done-pill date-pill"></div>
                            <div class="dev-in-done-pill time-pill"></div>
                        </div>
                        <button type="button" class="dev-in-reset-btn">Inca o rezervare</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="application/json" id="dev-sessions-data">
        <?php echo wp_json_encode($bk_sessions, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
    </script>
    <?php endif; ?>

</main>

<?php
endwhile;

get_footer();
