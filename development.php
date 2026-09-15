<?php
/*
Template Name: Development Page
*/
get_header();

$hero_bg_img      = function_exists('get_field') ? get_field('devpage_hero_bg_image') : null;
$hero_bg_img_url  = ($hero_bg_img && isset($hero_bg_img['url'])) ? $hero_bg_img['url'] : get_template_directory_uri() . '/assets/images/bg-development.webp';
$hero_bg_img_alt  = ($hero_bg_img && !empty($hero_bg_img['alt'])) ? $hero_bg_img['alt'] : '';
$hero_title       = (function_exists('get_field') && get_field('devpage_hero_title')) ? get_field('devpage_hero_title') : 'DEVELOPMENT';
$hero_description = (function_exists('get_field') && get_field('devpage_hero_description')) ? get_field('devpage_hero_description') : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation';
$hero_btn_text    = (function_exists('get_field') && get_field('devpage_hero_button_text')) ? get_field('devpage_hero_button_text') : 'Start Now';
?>

<main class="page-development">
    <section class="devpage-hero">
        <div class="devpage-hero-bg">
            <img src="<?php echo esc_url($hero_bg_img_url); ?>" alt="<?php echo esc_attr($hero_bg_img_alt); ?>" class="devpage-hero-img" fetchpriority="high" decoding="async" />
            <div class="devpage-hero-scrim" aria-hidden="true"></div>
        </div>

        <div class="devpage-hero-content">
            <h1 class="devpage-hero-title"><?php echo esc_html($hero_title); ?></h1>
            <div class="devpage-hero-desc"><?php echo wp_kses_post($hero_description); ?></div>

            <a href="#devpage-inscriere" class="devpage-hero-btn"><?php echo esc_html($hero_btn_text); ?></a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
