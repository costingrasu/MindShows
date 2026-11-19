<?php
/*
Template Name: IRL Gaming Page
*/
get_header();

$sections = mindshows_listing_sections_data('irl_gaming');

$show = array();
foreach (array('dirs', 'games', 'book') as $slug) {
    $value = mindshows_field("irlpage_show_{$slug}");
    $show[$slug] = ($value === null) ? true : (bool) $value;
}

$games_title = mindshows_field('irlpage_games_title') ?: 'JOCURI VALABILE';
$games_desc  = mindshows_field('irlpage_games_description') ?: '';
$games_btn   = mindshows_field('irlpage_games_button_text') ?: 'Descopera';
$games_empty = mindshows_field('irlpage_games_empty_text') ?: 'Momentan nu sunt jocuri disponibile.';
$games       = $show['games'] ? mindshows_irl_game_cards() : array();
?>

<main class="page-development page-irl-gaming">
    <?php get_template_part('template-parts/listing/hero', null, $sections['hero']); ?>

    <?php if ($show['dirs']) : ?>
    <?php get_template_part('template-parts/listing/dirs', null, $sections['dirs']); ?>
    <?php endif; ?>

    <?php if ($show['games']) : ?>
    <div class="devpage-divider" data-reveal aria-hidden="true"></div>
    <section class="irlpage-games" id="irlpage-jocuri">
        <header class="devpage-heading irlpage-games-head" data-reveal>
            <h2 class="devpage-heading-title"><?php echo esc_html($games_title); ?></h2>
            <?php if ($games_desc !== '') : ?>
            <div class="devpage-heading-desc"><?php echo wp_kses_post($games_desc); ?></div>
            <?php endif; ?>
        </header>

        <?php if (empty($games)) : ?>
        <p class="irlpage-games-empty" data-reveal><?php echo esc_html($games_empty); ?></p>
        <?php else : ?>
        <ul class="irlpage-games-list">
            <?php foreach ($games as $game) : ?>
            <li class="irlpage-games-item" data-reveal>
                <article class="irlpage-game">
                    <?php if ($game['image_id'] && wp_attachment_is_image($game['image_id'])) : ?>
                    <?php echo wp_get_attachment_image($game['image_id'], 'full', false, array('class' => 'irlpage-game-photo', 'alt' => '', 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => '(max-width: 1024px) calc(100vw - 20px), 1180px')); ?>
                    <?php else : ?>
                    <img src="<?php echo esc_url($game['image']); ?>" alt="" class="irlpage-game-photo" loading="lazy" decoding="async" />
                    <?php endif; ?>
                    <div class="irlpage-game-shade" aria-hidden="true"></div>
                    <div class="irlpage-game-symbol" aria-hidden="true"></div>

                    <div class="irlpage-game-content">
                        <div class="irlpage-game-head">
                            <?php if ($game['title'] !== '') : ?>
                            <h3 class="irlpage-game-title"><?php echo esc_html($game['title']); ?></h3>
                            <?php endif; ?>
                            <?php if ($game['location'] !== '') : ?>
                            <div class="irlpage-game-loc-wrap">
                                <p class="irlpage-game-location">
                                    <svg class="irlpage-game-pin" width="28" height="28" viewBox="0 0 24 24" aria-hidden="true"><path fill="#FFFFFF" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.6"/></svg>
                                    <span><?php echo esc_html($game['location']); ?></span>
                                </p>
                            </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($game['desc'] !== '') : ?>
                        <p class="irlpage-game-desc"><?php echo esc_html($game['desc']); ?></p>
                        <?php endif; ?>

                        <div class="irlpage-game-row">
                            <?php if ($game['age'] !== '' || $game['places'] !== '') : ?>
                            <p class="irlpage-game-badge">
                                <?php if ($game['age'] !== '') : ?><span><?php echo esc_html($game['age']); ?></span><?php endif; ?>
                                <?php if ($game['places'] !== '') : ?><span><?php echo esc_html($game['places']); ?></span><?php endif; ?>
                            </p>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($game['url']); ?>" class="devpage-btn irlpage-game-btn"<?php if ($game['title'] !== '') : ?> aria-label="<?php echo esc_attr($games_btn . ' - ' . $game['title']); ?>"<?php endif; ?>><?php echo esc_html($games_btn); ?></a>
                        </div>
                    </div>
                </article>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php if ($show['book']) : ?>
    <?php get_template_part('template-parts/listing/book', null, $sections['book']); ?>
    <?php endif; ?>
</main>

<?php
get_footer();
