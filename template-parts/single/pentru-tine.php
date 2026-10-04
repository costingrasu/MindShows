<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
    <section class="dev-pentru-tine" data-ms="pentru-tine">
        <h2 class="dev-pt-title" data-reveal><?php echo esc_html($args['title']); ?></h2>
        <div class="dev-pt-rule"></div>
        <ul class="dev-pt-copy" data-reveal>
            <?php foreach ($args['items'] as $item_text) : ?>
                <li class="dev-pt-item"><?php echo esc_html($item_text); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
