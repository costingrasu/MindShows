<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
    <section class="dev-hero" data-ms="hero">
        <?php if (!empty($args['bg'])) : ?>
        <img class="dev-hero-bg" src="<?php echo esc_url($args['bg']); ?>" alt="" fetchpriority="high" decoding="async">
        <?php endif; ?>
        <h1 class="dev-hero-title"><?php echo esc_html($args['title']); ?></h1>

        <?php if (!empty($args['badge'])) : ?>
        <div class="dev-hero-badge">
            <span class="dev-hero-badge-text"><?php echo esc_html($args['badge']); ?></span>
        </div>
        <?php endif; ?>

        <p class="dev-hero-copy"><?php echo wp_kses_post($args['desc']); ?></p>

        <?php if (!empty($args['btn_href'])) : ?>
        <a href="<?php echo esc_attr($args['btn_href']); ?>" class="dev-hero-btn"><?php echo esc_html($args['btn_text']); ?></a>
        <?php endif; ?>
    </section>
