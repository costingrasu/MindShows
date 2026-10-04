<?php

get_header();

while ( have_posts() ) : the_post();
    $post_id  = get_the_ID();
    $sections = mindshows_single_sections_data($post_id, 'irl_gaming');

    $show = array();
    foreach (array('galerie', 'about', 'detalii', 'pentru_tine') as $slug) {
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

</main>

<?php
endwhile;

get_footer();
