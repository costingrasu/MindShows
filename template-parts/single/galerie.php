<?php
if (!defined('ABSPATH')) {
    exit;
}
$pos_names = array('c', 'mr', 'fr', 'fl', 'ml');
?>
    <section class="dev-galerie" data-ms="galerie">
        <div class="dev-galerie-head">
            <h2 class="dev-galerie-title" data-reveal><?php echo esc_html($args['title']); ?></h2>
            <p class="dev-galerie-copy" data-reveal><?php echo wp_kses_post($args['desc']); ?></p>

            <div class="dev-carousel">
                <div class="dev-slides-box">
                    <div class="dev-slide-list">
                        <?php foreach ($args['images'] as $idx => $img) :
                            $pos = isset($pos_names[$idx]) ? $pos_names[$idx] : 'fr';
                        ?>
                            <div class="dev-slide" data-pos="<?php echo esc_attr($pos); ?>">
                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" loading="lazy">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (count($args['images']) > 1) : ?>
                <div class="dev-slides-nav">
                    <button type="button" class="dev-arrow dev-arrow-prev" aria-label="Previous slide">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M15 3L7.5 12L15 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="dev-dots-wrap">
                        <?php foreach ($args['images'] as $idx => $img) : ?>
                            <button type="button" class="dev-dot" data-state="<?php echo $idx === 0 ? 'on' : 'off'; ?>" aria-label="Go to slide <?php echo $idx + 1; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="dev-arrow dev-arrow-next" aria-label="Next slide">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M9 3L16.5 12L9 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="dev-galerie-rule"></div>
    </section>
