<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
    <section class="dev-detalii" data-ms="detalii">
        <?php foreach ($args['items'] as $dt) : ?>
            <div class="dev-detaliu<?php echo $dt['wide'] ? ' wide' : ''; ?>" data-reveal>
                <div class="dev-detaliu-title"><?php echo esc_html($dt['title']); ?></div>
                <div class="dev-detaliu-val"><?php echo esc_html($dt['val']); ?></div>
            </div>
        <?php endforeach; ?>
    </section>
