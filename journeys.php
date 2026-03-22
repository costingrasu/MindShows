<?php
get_header(); ?>

<main class="page-journeys">
    
    <section class="journeys-hero hero-fade-up">
        
        <div class="journeys-hero-bg">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/bg-journeys.png'); ?>" alt="Fundal Excursii" class="journeys-bg-img" />
        </div>

        <div class="journeys-hero-content">
            <h1 class="journeys-title">JOURNEYS</h1>
            <p class="journeys-desc">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation </p>
            
            <a href="#lista-excursii" class="journeys-hero-btn">Start Now</a>
        </div>
        
    </section>

    <section id="lista-excursii" class="journeys-list-placeholder">
        </section>

</main>

<?php get_footer(); ?>