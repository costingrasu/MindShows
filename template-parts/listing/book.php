<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
    <div class="devpage-divider" data-reveal aria-hidden="true"></div>
    <section class="devpage-book">
        <div class="devpage-book-inner">
            <div class="devpage-book-media" data-reveal>
                <img src="<?php echo esc_url($args['img_url']); ?>" alt="<?php echo esc_attr($args['img_alt']); ?>" class="devpage-book-image" loading="lazy" decoding="async" />
            </div>

            <div class="devpage-book-content" data-reveal>
                <div class="devpage-book-text">
                    <h2 class="devpage-book-title"><?php echo esc_html($args['title']); ?></h2>
                    <div class="devpage-book-desc"><?php echo wp_kses_post($args['desc']); ?></div>
                </div>

                <a href="<?php echo esc_attr($args['btn_href']); ?>" class="devpage-btn devpage-book-btn"><?php echo esc_html($args['btn_text']); ?></a>
            </div>
        </div>
    </section>
