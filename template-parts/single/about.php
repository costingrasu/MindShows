<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
    <section class="dev-about" data-ms="about">
        <?php foreach ($args['rows'] as $i => $row) : ?>
        <div class="dev-concept-row<?php echo $i % 2 ? ' reverse' : ''; ?>">
            <div class="dev-concept-img" data-reveal>
                <img src="<?php echo esc_url($row['image']); ?>" alt="<?php echo esc_attr($row['title']); ?>" loading="lazy">
            </div>
            <div class="dev-concept-text" data-reveal>
                <h3 class="dev-concept-title"><?php echo esc_html($row['title']); ?></h3>
                <p class="dev-concept-copy"><?php echo wp_kses_post($row['desc']); ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
