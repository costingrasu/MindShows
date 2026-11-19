<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
    <section class="devpage-hero">
        <div class="devpage-hero-bg">
            <img src="<?php echo esc_url($args['img_url']); ?>" alt="<?php echo esc_attr($args['img_alt']); ?>" class="devpage-hero-img" fetchpriority="high" decoding="async" />
            <div class="devpage-hero-scrim" aria-hidden="true"></div>
        </div>

        <div class="devpage-hero-content">
            <h1 class="devpage-hero-title"><?php echo esc_html($args['title']); ?></h1>
            <div class="devpage-hero-desc"><?php echo wp_kses_post($args['desc']); ?></div>

            <a href="<?php echo esc_attr($args['btn_href']); ?>" class="devpage-btn devpage-hero-btn"><?php echo esc_html($args['btn_text']); ?></a>
        </div>
    </section>
