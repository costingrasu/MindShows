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
                        <p class="slide-description">Dacă jocurile te-ar ajuta să te înțelegi mai bine? Și dacă abilitățiile pe care le dezvolți în jocuri ar fi utile în viața reală? Dezvoltare personală conștientă înseamnă exerciții, jocuri, sesiuni de debriefing, psihoeducație și activități practice menite să asigure un cadru ideal pentru autocunoaștere, conștientizare și dezvoltare.<br><strong>Potrivit pentru:</strong> școli, licee, tabere, organizații, grupuri de adolescenți, tineri și echipe.</p>
                        <div class="slide-action">
                            <span class="btn-start-now">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="home-carousel-slide" data-index="1" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg-irlGaming.png');">
                <div class="slide-content">
                    <h1 class="slide-title">IRL GAMING</h1>
                    <div class="slide-details">
                        <p class="slide-description">Jocuri în realitate, create cu scenarii originale, roluri, obiective, decor, atmosferă și mecanici de joc adaptabile. IRL Gaming aduce jocurile video în realitate. Intră într-o echipă, ia decizii, negociază, concurează, colaborează și trăiește o poveste pe care nici nu vei știi cum să o povestești.<br><strong>Potrivit pentru:</strong> adolescenți, adulți tineri, tabere, festivaluri, activări de brand, evenimente și comunități.</p>
                        <div class="slide-action">
                            <span class="btn-start-now">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="home-carousel-slide" data-index="2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg-journeys.png');">
                <div class="slide-content">
                    <h1 class="slide-title">JOURNEYS</h1>
                    <div class="slide-details">
                        <p class="slide-description">Concepte, povești și sisteme gamificate pentru tabere, excursii, trasee, aventuri și experiențe tematice. Journeys transformă o călătorie într-o poveste scrisă cu atenție. Creăm concepte, jocuri și programe care sunt unite de o viziune și un obiectiv adaptabile grupului țintă.<br><strong>Potrivit pentru:</strong> copii și adolescenți, tabere, agenții de turism, școli, organizatori de evenimente, proiecte educaționale și parteneri.</p>
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

    <section class="home-value-section">
        <div class="value-card-wrapper">
            <div class="value-card">
                <p class="value-text">Organizăm <span class="value-highlight">experiențe educaționale</span>, <span class="value-highlight">traininguri interactive</span>, <span class="value-highlight">jocuri imersive</span> și <span class="value-highlight">concepte gamificate</span> pentru adolescenți, tineri, școli, tabere, branduri și organizații.</p>
            </div>
        </div>
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
                        <p class="service-description">Dacă jocurile te-ar ajuta să te înțelegi mai bine? Și dacă abilitățiile pe care le dezvolți în jocuri ar fi utile în viața reală? Dezvoltare personală conștientă înseamnă exerciții, jocuri, sesiuni de debriefing, psihoeducație și activități practice menite să asigure un cadru ideal pentru autocunoaștere, conștientizare și dezvoltare.<br><strong>Potrivit pentru:</strong> școli, licee, tabere, organizații, grupuri de adolescenți, tineri și echipe.</p>
                        <span class="service-btn">Coming Soon</span>
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
                        <p class="service-description">Jocuri în realitate, create cu scenarii originale, roluri, obiective, decor, atmosferă și mecanici de joc adaptabile. IRL Gaming aduce jocurile video în realitate. Intră într-o echipă, ia decizii, negociază, concurează, colaborează și trăiește o poveste pe care nici nu vei știi cum să o povestești.<br><strong>Potrivit pentru:</strong> adolescenți, adulți tineri, tabere, festivaluri, activări de brand, evenimente și comunități.</p>
                        <span class="service-btn">Coming Soon</span>
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
                        <p class="service-description">Concepte, povești și sisteme gamificate pentru tabere, excursii, trasee, aventuri și experiențe tematice. Journeys transformă o călătorie într-o poveste scrisă cu atenție. Creăm concepte, jocuri și programe care sunt unite de o viziune și un obiectiv adaptabile grupului țintă.<br><strong>Potrivit pentru:</strong> copii și adolescenți, tabere, agenții de turism, școli, organizatori de evenimente, proiecte educaționale și parteneri.</p>
                        <a href="/journeys" class="service-btn">View More</a>
                    </div>
                </div>
            </article>

        </div>
    </section>

    <section class="home-development-section fade-up-element">
        <div class="development-left slide-right-element">
            <div class="development-bg-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bg-development1.svg" class="development-bg-image" alt="Development Graphic">
            </div>
            <div class="development-left-content">
                <h2 class="development-title">DEVELOPMENT</h2>
                <p class="development-subtitle">Reshaping the Way We Learn</p>
            </div>
        </div>
        <div class="development-right">
            <div class="dev-right-content fade-up-element">
                <div class="dev-right-header">
                    <h3 class="dev-right-title">Dă-ți upgrade la soft skills!</h3>
                    <p class="dev-right-description">Traninguri experiențiale, gamificate și livrate cu metode moderne potrivite pentru tineri și echipe care vor să treacă la următorul nivel.</p>
                </div>
                
                <div class="dev-cards-container">
                    <div class="dev-card">
                        <div class="dev-card-icon">
                            <svg class="desktop-icon" width="84" height="77" viewBox="0 0 84 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M60.4414 1C73.1172 1.0001 83 10.9827 83 25.3311C83 33.9716 79.3495 42.6184 72.6904 51.0156C66.0358 59.4071 56.4151 67.4989 44.582 75.0049C44.1485 75.2588 43.6459 75.5167 43.1611 75.708C42.6568 75.9071 42.2563 76 42 76C41.7439 76 41.3438 75.9068 40.8477 75.709C40.375 75.5205 39.8915 75.2684 39.4893 75.0225C27.6218 67.5114 17.9807 59.4138 11.3154 51.0156C4.65096 42.6184 1 33.9717 1 25.3311C1.00003 10.9828 10.8829 1.00018 23.5586 1C31.385 1 37.5058 5.32008 41.123 11.9297L41.9932 13.5195L42.874 11.9355C46.5784 5.27548 52.6177 1 60.4414 1Z" stroke="white" stroke-width="2"/>
                            </svg>
                            <svg class="mobile-icon" width="35" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24.7578 1C29.5788 1 33.4082 4.84522 33.4082 10.5391C33.4081 17.4176 27.6416 24.4625 17.9453 30.7109C17.7896 30.8029 17.6168 30.8924 17.458 30.9561C17.2754 31.0293 17.1953 31.0352 17.2041 31.0352C17.2129 31.0351 17.1332 31.0297 16.9561 30.958C16.8009 30.8952 16.6346 30.8076 16.4941 30.7207C6.77164 24.47 1.00015 17.4207 1 10.5391C1 4.84523 4.82946 1 9.65039 1C12.5994 1.00006 14.9255 2.6416 16.3242 5.2373L17.1973 6.8584L18.0811 5.24414C19.5168 2.62242 21.8116 1.00006 24.7578 1Z" stroke="white" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="dev-card-text">
                            <h4 class="dev-card-title">DEZVOLTARE PERSONALĂ CONȘTIENTĂ</h4>
                            <p class="dev-card-desc">Asigură un cadru ideal pentru autocunoaștere, conștientizare și dezvoltare, prin jocuri, sesiuni interactive, exerciții profunde și psiho-educație.</p>
                        </div>
                    </div>
                    <div class="dev-card">
                        <div class="dev-card-icon">
                            <svg class="desktop-icon" width="84" height="77" viewBox="0 0 84 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M60.4414 1C73.1172 1.0001 83 10.9827 83 25.3311C83 33.9716 79.3495 42.6184 72.6904 51.0156C66.0358 59.4071 56.4151 67.4989 44.582 75.0049C44.1485 75.2588 43.6459 75.5167 43.1611 75.708C42.6568 75.9071 42.2563 76 42 76C41.7439 76 41.3438 75.9068 40.8477 75.709C40.375 75.5205 39.8915 75.2684 39.4893 75.0225C27.6218 67.5114 17.9807 59.4138 11.3154 51.0156C4.65096 42.6184 1 33.9717 1 25.3311C1.00003 10.9828 10.8829 1.00018 23.5586 1C31.385 1 37.5058 5.32008 41.123 11.9297L41.9932 13.5195L42.874 11.9355C46.5784 5.27548 52.6177 1 60.4414 1Z" stroke="white" stroke-width="2"/>
                            </svg>
                            <svg class="mobile-icon" width="35" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24.7578 1C29.5788 1 33.4082 4.84522 33.4082 10.5391C33.4081 17.4176 27.6416 24.4625 17.9453 30.7109C17.7896 30.8029 17.6168 30.8924 17.458 30.9561C17.2754 31.0293 17.1953 31.0352 17.2041 31.0352C17.2129 31.0351 17.1332 31.0297 16.9561 30.958C16.8009 30.8952 16.6346 30.8076 16.4941 30.7207C6.77164 24.47 1.00015 17.4207 1 10.5391C1 4.84523 4.82946 1 9.65039 1C12.5994 1.00006 14.9255 2.6416 16.3242 5.2373L17.1973 6.8584L18.0811 5.24414C19.5168 2.62242 21.8116 1.00006 24.7578 1Z" stroke="white" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="dev-card-text">
                            <h4 class="dev-card-title">LEADERSHIP</h4>
                            <p class="dev-card-desc">Formarea abilităților de public speaking, people management, capacitate decizională, încredere în sine și teamwork.</p>
                        </div>
                    </div>
                    <div class="dev-card">
                        <div class="dev-card-icon">
                            <svg class="desktop-icon" width="84" height="77" viewBox="0 0 84 77" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M60.4414 1C73.1172 1.0001 83 10.9827 83 25.3311C83 33.9716 79.3495 42.6184 72.6904 51.0156C66.0358 59.4071 56.4151 67.4989 44.582 75.0049C44.1485 75.2588 43.6459 75.5167 43.1611 75.708C42.6568 75.9071 42.2563 76 42 76C41.7439 76 41.3438 75.9068 40.8477 75.709C40.375 75.5205 39.8915 75.2684 39.4893 75.0225C27.6218 67.5114 17.9807 59.4138 11.3154 51.0156C4.65096 42.6184 1 33.9717 1 25.3311C1.00003 10.9828 10.8829 1.00018 23.5586 1C31.385 1 37.5058 5.32008 41.123 11.9297L41.9932 13.5195L42.874 11.9355C46.5784 5.27548 52.6177 1 60.4414 1Z" stroke="white" stroke-width="2"/>
                            </svg>
                            <svg class="mobile-icon" width="35" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24.7578 1C29.5788 1 33.4082 4.84522 33.4082 10.5391C33.4081 17.4176 27.6416 24.4625 17.9453 30.7109C17.7896 30.8029 17.6168 30.8924 17.458 30.9561C17.2754 31.0293 17.1953 31.0352 17.2041 31.0352C17.2129 31.0351 17.1332 31.0297 16.9561 30.958C16.8009 30.8952 16.6346 30.8076 16.4941 30.7207C6.77164 24.47 1.00015 17.4207 1 10.5391C1 4.84523 4.82946 1 9.65039 1C12.5994 1.00006 14.9255 2.6416 16.3242 5.2373L17.1973 6.8584L18.0811 5.24414C19.5168 2.62242 21.8116 1.00006 24.7578 1Z" stroke="white" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="dev-card-text">
                            <h4 class="dev-card-title">COMUNICARE</h4>
                            <p class="dev-card-desc">Antrenează tehnici și abilități de comunicare, ca să te poți face auzit mai ușor, să negociezi mai bine, să aplanezi conflicte și să ai mai multă încredere.</p>
                        </div>
                    </div>
                </div>

                <span class="dev-btn">Coming Soon</span>
            </div>

            <div class="dev-tree-content fade-up-element">
                <div class="dev-right-header">
                    <h3 class="dev-right-title">MAIN QUEST</h3>
                    <p class="dev-right-description">Seria de traininguri principale, de o zi (8 ore) - un „must have” al abilităților și dezvoltării personale.</p>
                </div>
                
                <div class="dev-tree-container">
                    <svg class="dev-tree-lines" width="100%" height="80" viewBox="0 0 510 80" preserveAspectRatio="none">
                        <line x1="255" y1="0" x2="74" y2="80" stroke="#3A3A3A" stroke-width="3" stroke-dasharray="6 6"/>
                        <line x1="255" y1="0" x2="255" y2="80" stroke="#3A3A3A" stroke-width="3" stroke-dasharray="6 6"/>
                        <line x1="255" y1="0" x2="436" y2="80" stroke="#3A3A3A" stroke-width="3" stroke-dasharray="6 6"/>
                    </svg>
                    
                    <div class="dev-tree-root">
                        <span class="root-title">TRIAL</span>
                        <div class="root-hidden-content">
                            <span class="root-hidden-subtitle">TRIAL</span>
                            <span class="root-hidden-desc">Descoperă seria de MAIN QUESTS gratuit, fără niciun angajament.</span>
                        </div>
                    </div>
                    
                    <div class="dev-tree-branches">
                        <div class="dev-tree-branch">
                            <div class="branch-header">
                                DEZVOLTARE PERSONALĂ CONȘTIENTĂ
                            </div>
                            <div class="branch-nodes">
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">1</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-title">Primul pas în dezvoltare</span>
                                            <span class="node-hidden-desc">Autocunoaștere și principii de creștere</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">2</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-title">Dincolo de gânduri</span>
                                            <span class="node-hidden-desc">Ce se întamplă, de fapt, în mintea noastră</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">3</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-title">Cu și despre emoții</span>
                                            <span class="node-hidden-desc">Identificare și reglarea emoțională</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">4</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-title">Principii și valori</span>
                                            <span class="node-hidden-desc">Identificarea și ierarhizarea valorilor de viață</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dev-tree-branch">
                            <div class="branch-header">
                                LEADERSHIP
                            </div>
                            <div class="branch-nodes">
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">1</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-desc">Ce este leadershipul și ce tip de lider vreau să devin?</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">2</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-desc">Cum mă comport și cum vorbesc ca un lider?</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">3</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-desc">Cum ajut și cum inspir oamenii ca un lider?</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">4</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-desc">Când sunt lider și când sunt team player?</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dev-tree-branch">
                            <div class="branch-header">
                                COMUNICARE
                            </div>
                            <div class="branch-nodes">
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">1</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-title">Bazele comunicării</span>
                                            <span class="node-hidden-desc">Tipuri de comunicare, factori și mijloace de comunicare</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">2</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-desc">Tehnici pentru comunicarea eficientă</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">3</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-desc">Perspective, asertivitate și gestionarea conflictelor</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="branch-node-container">
                                    <div class="branch-node">
                                        <span class="node-number">4</span>
                                        <div class="node-hidden-content">
                                            <span class="node-hidden-desc">Comunicarea cu grupuri, public, audiență</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="dev-btn">Coming Soon</span>
            </div>
        </div>
    </section>

    <section class="home-irlgaming-section fade-up-element">
        <div class="irlgaming-container">
            <h2 class="irlgaming-title">IRL GAMING</h2>
            <h3 class="irlgaming-subtitle">Changing the Way We Play</h3>
            <p class="irlgaming-description">Imaginează-ți un joc video scos din ecran și adus în lumea reală. Aducem jocurile video și atmosfera de film în realitate prin experiențe imersive, roluri, obiective, strategie și competiție. Intră într-o lume construită de la 0, ia decizii, colaborează, concurează și trăiește o experiență construită cu reguli clare, atmosferă și miză.</p>
            <div class="irlgaming-placeholder"><span>Coming Soon</span></div>
        </div>
    </section>

    <section class="home-journeys-section fade-up-element">
        <div class="journeys-home-container">
            <h2 class="journeys-home-title">JOURNEYS</h2>
            <h3 class="journeys-home-subtitle">Reshaping the Way We Travel</h3>
            <p class="journeys-home-description">Creăm universuri narative pentru experiențe educaționale, tabere și călătorii tematice. Construim povești, echipe, misiuni, provocări, artefacte, indicii și sisteme de joc care fac o drumeție, un team building sau o tabără să pară scris ca o poveste, fiecare element fiind integrat într-o singură viziune.</p>

            <?php
            $home_journeys_args = array(
                'post_type'      => 'journey',
                'posts_per_page' => -1,
                'post_status'    => 'publish'
            );
            $home_journeys_query = new WP_Query($home_journeys_args);

            if ( $home_journeys_query->have_posts() ) :
                $home_journey_cards = array();
                while ( $home_journeys_query->have_posts() ) : $home_journeys_query->the_post();
                    $hj_post_id    = get_the_ID();
                    $hj_card_img   = function_exists('get_field') ? get_field('card_image', $hj_post_id) : null;
                    if (!$hj_card_img && function_exists('get_field')) {
                        $hj_card_img = get_field('hero_background_image', $hj_post_id);
                    }
                    $hj_card_img_url = $hj_card_img ? $hj_card_img['url'] : get_template_directory_uri() . '/assets/images/bg-journeys.png';
                    $hj_subtitle     = function_exists('get_field') ? get_field('hero_top_subtitle', $hj_post_id) : '';
                    $hj_description  = function_exists('get_field') ? get_field('hero_description', $hj_post_id) : '';
                    $hj_clean_desc   = $hj_description ? strip_tags($hj_description) : '';

                    $home_journey_cards[] = array(
                        'title'       => get_the_title(),
                        'permalink'   => get_permalink(),
                        'image_url'   => $hj_card_img_url,
                        'subtitle'    => $hj_subtitle,
                        'description' => $hj_clean_desc,
                    );
                endwhile;
                wp_reset_postdata();
            ?>

            <div class="journeys-home-slideshow">
                <div class="journeys-home-track">
                    <?php foreach ($home_journey_cards as $index => $card) : ?>
                    <article class="journeys-home-card" data-index="<?php echo $index; ?>">
                        <div class="jhc-bg" style="background-image: url('<?php echo esc_url($card['image_url']); ?>');"></div>
                        <div class="jhc-overlay"></div>
                        <div class="jhc-content">
                            <h3 class="jhc-title"><?php echo esc_html($card['title']); ?></h3>
                            <?php if ($card['subtitle']) : ?>
                            <span class="jhc-subtitle"><?php echo esc_html($card['subtitle']); ?></span>
                            <?php endif; ?>
                            <div class="jhc-hidden-content">
                                <p class="jhc-description"><?php echo esc_html($card['description']); ?></p>
                                <a href="<?php echo esc_url($card['permalink']); ?>" class="jhc-btn">View More</a>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>


            </div>

            <a href="<?php echo home_url('/journeys'); ?>" class="journeys-home-btn">Afla Mai Multe</a>

            <?php else : ?>
            <div class="journeys-home-placeholder"><span>Coming Soon</span></div>
            <?php endif; ?>

        </div>
    </section>

    <section class="home-team-section fade-up-element" style="display: none;">
        <div class="team-container">
            <h2 class="team-title">Meet the <br class="team-title-br">Team</h2>
            <p class="team-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
            <a href="/team" class="btn-team">Afla Mai Multe</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
