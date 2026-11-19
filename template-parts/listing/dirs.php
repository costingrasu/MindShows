<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
    <div class="devpage-divider" data-reveal aria-hidden="true"></div>
    <section class="devpage-dirs">
        <ul class="devpage-dirs-track">
            <?php foreach ($args['cards'] as $idx => $card) :
                $dir_desc_id = 'devpage-dir-desc-' . ($idx + 1);
            ?>
                <li class="devpage-dirs-item" data-reveal>
                    <article class="devpage-dir-card" data-expanded="false">
                        <img src="<?php echo esc_url($args['symbol']); ?>" alt="" class="devpage-dir-card-bg" loading="lazy" decoding="async" />
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
