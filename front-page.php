<?php get_header(); ?>

<main class="home-main">
    <section class="home-carousel-section">
        <div class="home-carousel-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/brandLogo.png" alt="MindShows Logo" class="brand-logo-img" />
            <div class="logo-delimiter"></div>
            <div class="logo-text">
                YOUR WAY TO<br>THE NEXT LEVEL
            </div>
        </div>
        <div class="home-carousel-track">
            
            <div class="home-carousel-slide active" data-index="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg-development.png');">
                <div class="slide-content">
                    <h1 class="slide-title">DEVELOPMENT</h1>
                    <div class="slide-details">
                        <p class="slide-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                        <div class="slide-action">
                            <a href="/development" class="btn-start-now">Start Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="home-carousel-slide" data-index="1" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg-irlGaming.png');">
                <div class="slide-content">
                    <h1 class="slide-title">IRL GAMING</h1>
                    <div class="slide-details">
                        <p class="slide-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                        <div class="slide-action">
                            <a href="/irl-gaming" class="btn-start-now">Start Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="home-carousel-slide" data-index="2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg-journeys.png');">
                <div class="slide-content">
                    <h1 class="slide-title">JOURNEYS</h1>
                    <div class="slide-details">
                        <p class="slide-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                        <div class="slide-action">
                            <a href="/journeys" class="btn-start-now">Start Now</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <button class="home-carousel-nav-next" aria-label="Next slide">
            <svg width="24" height="40" viewBox="0 0 24 40" fill="none" stroke="rgba(255, 255, 255, 0.4)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="4 4 20 20 4 36"></polyline>
            </svg>
        </button>
    </section>
    <section class="home-services-section fade-up-element">
        <div class="services-container">
            <article class="service-card">
                <button class="service-close-btn" aria-label="Close" type="button">X</button>
                <div class="service-card-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/symbol-development.png');"></div>
                <div class="service-card-overlay"></div>
                <div class="service-card-content">
                    <h2 class="service-title">Development</h2>
                    <h3 class="service-subtitle">Changing the Way We Learn</h3>
                    <div class="service-hidden-content">
                        <p class="service-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin felis ac aliquam rhoncus. Ut in purus in orci faucibus porta. Cras sollicitudin, eros ac tincidunt laoreet, felis eros egestas ante, at mattis lorem nulla sed enim. Praesent ut euismod nunc. Fusce mollis scelerisque mi nec sollicitudin.</p>
                        <a href="/development" class="service-btn">View More</a>
                    </div>
                </div>
            </article>

            <article class="service-card">
                <button class="service-close-btn" aria-label="Close" type="button">X</button>
                <div class="service-card-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/symbol-irlGaming.png');"></div>
                <div class="service-card-overlay"></div>
                <div class="service-card-content">
                    <h2 class="service-title">IRL Gaming</h2>
                    <h3 class="service-subtitle">Changing the Way We Play</h3>
                    <div class="service-hidden-content">
                        <p class="service-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin felis ac aliquam rhoncus. Ut in purus in orci faucibus porta. Cras sollicitudin, eros ac tincidunt laoreet, felis eros egestas ante, at mattis lorem nulla sed enim. Praesent ut euismod nunc. Fusce mollis scelerisque mi nec sollicitudin.</p>
                        <a href="/irl-gaming" class="service-btn">View More</a>
                    </div>
                </div>
            </article>

            <article class="service-card">
                <button class="service-close-btn" aria-label="Close" type="button">X</button>
                <div class="service-card-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/symbol-journeys.png');"></div>
                <div class="service-card-overlay"></div>
                <div class="service-card-content">
                    <h2 class="service-title">Journeys</h2>
                    <h3 class="service-subtitle">Changing the Way We Travel</h3>
                    <div class="service-hidden-content">
                        <p class="service-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin felis ac aliquam rhoncus. Ut in purus in orci faucibus porta. Cras sollicitudin, eros ac tincidunt laoreet, felis eros egestas ante, at mattis lorem nulla sed enim. Praesent ut euismod nunc. Fusce mollis scelerisque mi nec sollicitudin.</p>
                        <a href="/journeys" class="service-btn">View More</a>
                    </div>
                </div>
            </article>

        </div>
    </section>
</main>

<?php get_footer(); ?>
