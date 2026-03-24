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

    <section class="journeys-about">
        <div class="journeys-about-container">
            
            <div class="journeys-about-image-wrapper">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/bg-journeys.png'); ?>" alt="Tabere Next Level" class="journeys-about-img" />
                <h2 class="journeys-about-title title-mobile">TABERE NEXT LEVEL</h2>
            </div>

            <div class="journeys-about-content">
                <h2 class="journeys-about-title title-desktop">TABERE NEXT LEVEL</h2>
                
                <div class="journeys-about-desc">
                    <p>În spatele fiecărei tabere reușite se află o idee puternică. Noi suntem cei care o construiesc.</p>
                    <p>Mind Shows transformă taberele organizate de agențiile de turism în experiențe educaționale memorabile, prin concepte originale, scenarii imersive și design atent gândit. Creăm tematici care captivează, activități care dezvoltă și povești care leagă emoțional participanții de tot ceea ce trăiesc.</p>
                </div>
            </div>

        </div>
    </section>

    <section id="lista-excursii" class="journeys-list">
        <div class="journeys-list-header">
            <h2 class="journeys-list-title">TABERE VALABILE</h2>
            <p class="journeys-list-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
        </div>
        
        <div class="journeys-cards-container"></div>
    </section>

</main>

<?php get_footer(); ?>