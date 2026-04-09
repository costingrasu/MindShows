<?php
/*
Template Name: Journeys Page
*/
?>

<?php
get_header(); ?>

<main class="page-journeys">
    
    <section class="journeys-hero hero-fade-up">
        
        <div class="journeys-hero-bg">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/bg-journeys.png'); ?>" alt="Fundal Excursii" class="journeys-bg-img" />
        </div>

        <div class="journeys-hero-content">
            <h1 class="journeys-title">JOURNEYS</h1>
            <p class="journeys-subtitle">Redefinim felul in care calatorim</p>
            <p class="journeys-desc">Prin excursii, taberele, retreaturi sau o escapadă la munte dedicate tinerilor. Construim experiențe gamificate, atent gândite și antrenante care facilitează atât explorarea, cât și descoperirea de sine și dezvoltarea personală. Nu doar ne plimbăm, ci trăim povești care ne cresc.</p>
            
            <a href="#lista-excursii" class="journeys-hero-btn">Start Now</a>
        </div>
        
    </section>

    <section class="journeys-about">
        <div class="journeys-about-container">
            
            <div class="journeys-about-image-wrapper">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/bg-journeys.png'); ?>" alt="Tabere Next Level" class="journeys-about-img" />
                <h2 class="journeys-about-title title-mobile">TABERE DE VARA</h2>
            </div>

            <div class="journeys-about-content">
                <h2 class="journeys-about-title title-desktop">TABERE DE VARA</h2>
                
                <div class="journeys-about-desc">
                    <p>În spatele fiecărei tabere reușite se află o idee puternică. Noi suntem cei care o construiesc.</p>
                    <p>Mind Shows transformă taberele organizate de agențiile de turism în experiențe educaționale memorabile, prin concepte originale, scenarii imersive și design atent gândit. Creăm tematici care captivează, activități care dezvoltă și povești care leagă emoțional participanții de tot ceea ce trăiesc.</p>
                </div>
            </div>

        </div>
    </section>

    <section id="lista-excursii" class="journeys-list">
        <div class="journeys-list-header">
            <h2 class="journeys-list-title">TABERE DE VARA 2026</h2>
            <p class="journeys-list-desc">Povești unice create cu atenție de o echipă cu peste 10 ani de experiență în conceptualizarea și facilitarea de programe educaționale pentru tineri</p>
        </div>
        
        <div class="journeys-cards-container">
            <?php
            $journeys_args = array(
                'post_type'      => 'journey',
                'posts_per_page' => -1, 
                'post_status'    => 'publish'
            );
            $journeys_query = new WP_Query($journeys_args);

            if ( $journeys_query->have_posts() ) :
                while ( $journeys_query->have_posts() ) : $journeys_query->the_post();
                    
                    $post_id = get_the_ID();
                    
                    $title_font = function_exists('get_field') && get_field('hero_title_font', $post_id) ? get_field('hero_title_font', $post_id) : "'Brother 1816', 'Outfit', sans-serif";
                    $c4_color   = function_exists('get_field') && get_field('custom_color_4', $post_id) ? get_field('custom_color_4', $post_id) : '#FFFFFF';
                    
                    $card_img = function_exists('get_field') ? get_field('card_image', $post_id) : null;
                    if (!$card_img && function_exists('get_field')) {
                        $card_img = get_field('hero_background_image', $post_id);
                    }
                    $card_img_url = $card_img ? $card_img['url'] : get_template_directory_uri() . '/assets/images/bg-journeys.png';
                    
                    $description = function_exists('get_field') ? get_field('hero_description', $post_id) : '';
                    $clean_desc  = $description ? strip_tags($description) : '';
                    
                    $kp_2 = function_exists('get_field') ? get_field('kp_2', $post_id) : null;
                    $kp2_title = ($kp_2 && !empty($kp_2['title'])) ? $kp_2['title'] : '';
                    $kp2_desc  = ($kp_2 && !empty($kp_2['description'])) ? $kp_2['description'] : '';
                    $location_text = trim($kp2_title . ($kp2_title && $kp2_desc ? ', ' : '') . $kp2_desc);
                    
                   // --- Extragere Info (Keypoint 3 + Capacitate) ---
                    $kp_3 = function_exists('get_field') ? get_field('kp_3', $post_id) : null;
                    $age_text = ($kp_3 && !empty($kp_3['title'])) ? $kp_3['title'] : '';
                    
                    $raw_series_text = function_exists('get_field') ? get_field('camp_series_list', $post_id) : '';
                    $first_total = '';
                    if($raw_series_text) {
                        $lines = explode("\n", $raw_series_text);
                        foreach($lines as $line) {
                            $line = trim($line);
                            if(empty($line)) continue;
                            $parts = explode('|', $line);
                            if(count($parts) > 1) {
                                $capacity_str = trim($parts[1]);
                                $cap_parts = explode('/', $capacity_str);
                                if(count($cap_parts) == 2) {
                                    $first_total = intval(trim($cap_parts[1]));
                                    break;
                                }
                            }
                        }
                    }
                    $capacity_text = $first_total ? $first_total . ' Locuri' : '';
                    ?>

                    <article class="journey-card fade-up-element" style="--card-font: <?php echo esc_attr($title_font); ?>; --card-color: <?php echo esc_attr($c4_color); ?>;">
                        
                        <div class="journey-card-bg" style="background-image: url('<?php echo esc_url($card_img_url); ?>');"></div>
                        <div class="journey-card-overlay"></div>

                        <div class="journey-card-content">
                            <h3 class="journey-card-title"><?php the_title(); ?></h3>
                            
                            <?php if($location_text) : ?>
                            <div class="journey-card-location">
                                <svg class="icon-location" width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M35.8143 10.5569C34.5367 9.25023 33.007 8.21666 31.318 7.51881C29.629 6.82096 27.8159 6.47337 25.9886 6.49711C22.1573 6.49711 18.8745 7.86814 16.1858 10.5569C14.8622 11.8217 13.8175 13.349 13.1184 15.041C12.4193 16.733 12.0813 18.5524 12.126 20.3826C12.126 22.9494 12.743 25.2573 13.9464 27.3291L14.2054 27.7176L25.722 45.4952L37.9546 27.4967C39.2349 25.3494 39.8965 22.89 39.8664 20.3902C39.8664 16.5285 38.503 13.2456 35.8143 10.5569Z" fill="white"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.9809 14.1597C25.1031 14.1288 24.2289 14.2861 23.417 14.6212C22.6051 14.9562 21.8743 15.4611 21.2737 16.102C20.6446 16.7116 20.1476 17.444 19.8135 18.2538C19.4793 19.0635 19.3152 19.9333 19.3314 20.8092C19.3314 22.6601 19.9788 24.2139 21.2737 25.5468C21.8836 26.1755 22.616 26.6723 23.4257 27.0064C24.2354 27.3405 25.1051 27.5048 25.9809 27.4891C26.8608 27.5018 27.7341 27.3363 28.5484 27.0025C29.3626 26.6687 30.1008 26.1735 30.7185 25.5468C31.3466 24.9297 31.8432 24.1918 32.1783 23.3775C32.5135 22.5633 32.6802 21.6896 32.6685 20.8092C32.6832 19.9328 32.5177 19.0628 32.1823 18.2531C31.8469 17.4434 31.3486 16.7112 30.7185 16.102C30.1103 15.4627 29.3738 14.9591 28.5573 14.6244C27.7409 14.2897 26.8629 14.1313 25.9809 14.1597Z" fill="#1D1D1D"/>
                                </svg>
                                <span class="location-text"><?php echo esc_html($location_text); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <p class="journey-card-desc"><?php echo esc_html($clean_desc); ?></p>
                            
                            <div class="journey-card-footer">
                                <div class="journey-card-info">
                                    <?php if($age_text): ?><span><?php echo esc_html($age_text); ?></span><?php endif; ?>
                                    <?php if($capacity_text): ?><span><?php echo esc_html($capacity_text); ?></span><?php endif; ?>
                                </div>
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="journey-card-btn">Descopera</a>
                            </div>
                        </div>

                    </article>

                <?php 
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p style="color:white; text-align:center; width: 100%;">No Journeys available.</p>';
            endif;
            ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>