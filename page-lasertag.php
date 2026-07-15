<?php
/*
Template Name: Laser Tag
*/

get_header();

$theme_uri = get_stylesheet_directory_uri();
$hero_img = $theme_uri . '/assets/images/Hero.png';
$about_day_img = $theme_uri . '/assets/images/day.png';
$about_night_img = $theme_uri . '/assets/images/night.png';
?>

<main class="lt-main">

    <section class="lt-hero">
        <div class="lt-hero-bg" style="background-image: url('<?php echo esc_url($hero_img); ?>');"></div>
        <div class="lt-hero-gradient"></div>
        <div class="lt-hero-radial"></div>
        
        <div class="lt-hero-content">
            <span class="lt-hero-eyebrow">MIND SHOWS</span>
            <h1 class="lt-hero-title">Laser Tag</h1>
            <p class="lt-hero-subtitle">Experiece out outdoor las tag arena in Costinești, where real-life gaming modes meets the pulse of summer, located in LUN.R camping right next to Nibiru.</p>
            <div class="lt-cta-row">
                <a href="#lt-booking" class="lt-btn-primary">Join the game now</a>
                <a href="#lt-mission" class="lt-btn-outline">Discover game modes</a>
            </div>
            <p class="lt-hero-notice">Limited time slots available. Booking in advance is recommended for groups.</p>
        </div>
    </section>

    <section class="lt-keynotes">
        <div class="lt-keynotes-row">
            <div class="lt-keynote">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 3 L37 20 L20 37 L3 20 Z" stroke="#ed1b68" stroke-width="1.4"/><circle cx="20" cy="20" r="5" fill="#ed1b68"/></svg>
                <h3 class="lt-keynote-title">Location</h3>
                <p class="lt-keynote-value">Costinești</p>
            </div>
            <span class="lt-keynote-div"></span>
            <div class="lt-keynote">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="16" stroke="#ed1b68" stroke-width="1.4"/><circle cx="20" cy="20" r="6" fill="#ed1b68"/></svg>
                <h3 class="lt-keynote-title">Outdoor</h3>
                <p class="lt-keynote-value">Open-air arena</p>
            </div>
            <span class="lt-keynote-div"></span>
            <div class="lt-keynote">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><rect x="6" y="6" width="28" height="28" rx="3" stroke="#ed1b68" stroke-width="1.4"/><rect x="15" y="15" width="10" height="10" fill="#ed1b68"/></svg>
                <h3 class="lt-keynote-title">Arena size</h3>
                <p class="lt-keynote-value">1,000 sqm</p>
            </div>
            <span class="lt-keynote-div"></span>
            <div class="lt-keynote">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><circle cx="14" cy="15" r="6" stroke="#ed1b68" stroke-width="1.4"/><circle cx="26" cy="15" r="6" stroke="#ed1b68" stroke-width="1.4"/><path d="M6 33c0-5 4-8 8-8s8 3 8 8M18 33c0-5 4-8 8-8s8 3 8 8" stroke="#ed1b68" stroke-width="1.4"/></svg>
                <h3 class="lt-keynote-title">Players</h3>
                <p class="lt-keynote-value">Up to 14 players</p>
            </div>
            <span class="lt-keynote-div"></span>
            <div class="lt-keynote">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 4 L24 16 L37 16 L26 24 L30 36 L20 28 L10 36 L14 24 L3 16 L16 16 Z" stroke="#ed1b68" stroke-width="1.4"/></svg>
                <h3 class="lt-keynote-title">Scenarios</h3>
                <p class="lt-keynote-value">Multiple game modes</p>
            </div>
        </div>
    </section>

    <section class="lt-about lt-section-pad">
        <div class="lt-about-grid">
            <div class="lt-about-text">
                <div class="lt-eyebrow-row">
                    <span class="lt-eyebrow">Real-life shooter</span>
                    <span class="lt-eyebrow-line"></span>
                </div>
                <h2 class="lt-section-heading">More than a<br>regular activity</h2>
                <p class="lt-about-desc">Join our outdoor laser tag experience in Costinești, created by Mind Shows for people who want more than a regular summer activity.</p>
                <p class="lt-about-desc">By day, it's fast, social and full of summer energy. By night, it's intense, cinematic and built for adventure.</p>
                <div class="lt-about-badge">
                    <svg width="22" height="22" viewBox="0 0 40 40" fill="none"><path d="M20 4 L24 16 L37 16 L26 24 L30 36 L20 28 L10 36 L14 24 L3 16 L16 16 Z" fill="#ed1b68"/></svg>
                    <span>BUILT FOR ADRENALINE. DESIGNED FOR TEAMWORK. MADE FOR SUMMER NIGHTS.</span>
                </div>
            </div>
            <div class="lt-about-imgs">
                <div class="lt-about-img" style="background-image: url('<?php echo esc_url($about_day_img); ?>');"></div>
                <div class="lt-about-img lt-about-img-offset" style="background-image: url('<?php echo esc_url($about_night_img); ?>');"></div>
            </div>
        </div>
    </section>

    <section id="lt-mission" class="lt-mission lt-section-pad">
        <div class="lt-mission-inner">
            <div class="lt-section-center">
                <span class="lt-eyebrow">Game modes</span>
                <h2 class="lt-section-heading">Choose your mission</h2>
            </div>
            <div class="lt-mission-grid">
                <div class="lt-mode-card">
                    <span class="lt-mode-icon"><svg width="46" height="46" viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="15" stroke="#ed1b68" stroke-width="1.4"/><circle cx="20" cy="20" r="8" stroke="#ed1b68" stroke-width="1.4"/><circle cx="20" cy="20" r="2.5" fill="#ed1b68"/></svg></span>
                    <h3 class="lt-mode-title">Battle Royale</h3>
                    <p class="lt-mode-desc">Play solo, in pairs or in squads. Stay inside the shrinking safe zone and outlive everyone else.</p>
                </div>
                <div class="lt-mode-card">
                    <span class="lt-mode-icon"><svg width="46" height="46" viewBox="0 0 40 40" fill="none"><circle cx="14" cy="20" r="8" stroke="#ed1b68" stroke-width="1.4"/><circle cx="26" cy="20" r="8" stroke="#ed1b68" stroke-width="1.4"/></svg></span>
                    <h3 class="lt-mode-title">Team vs Team</h3>
                    <p class="lt-mode-desc">Work together, fight the enemy team and score more points before time runs out.</p>
                </div>
                <div class="lt-mode-card">
                    <span class="lt-mode-icon"><svg width="46" height="46" viewBox="0 0 40 40" fill="none"><path d="M20 4 L24 16 L37 16 L26 24 L30 36 L20 28 L10 36 L14 24 L3 16 L16 16 Z" stroke="#ed1b68" stroke-width="1.4"/></svg></span>
                    <h3 class="lt-mode-title">Last One Standing</h3>
                    <p class="lt-mode-desc">Play solo or in squads, stay and be the last player standing.</p>
                </div>
                <div class="lt-mode-card">
                    <span class="lt-mode-icon"><svg width="46" height="46" viewBox="0 0 40 40" fill="none"><path d="M12 5 V35" stroke="#ed1b68" stroke-width="1.6"/><path d="M12 7 H31 L27 13 L31 19 H12 Z" stroke="#ed1b68" stroke-width="1.4"/></svg></span>
                    <h3 class="lt-mode-title">Capture the Flag</h3>
                    <p class="lt-mode-desc">Fight for the digital flag, protect your team and hold it longer than your opponents.</p>
                </div>
                <div class="lt-mode-card">
                    <span class="lt-mode-icon"><svg width="46" height="46" viewBox="0 0 40 40" fill="none"><path d="M6 30 L9 14 L16 23 L20 11 L24 23 L31 14 L34 30 Z" stroke="#ed1b68" stroke-width="1.4"/></svg></span>
                    <h3 class="lt-mode-title">VIP Escort</h3>
                    <p class="lt-mode-desc">One player becomes the VIP. Escort them safely across the arena while the enemy team tries to stop you.</p>
                </div>
                <div class="lt-mode-card">
                    <span class="lt-mode-icon"><svg width="46" height="46" viewBox="0 0 40 40" fill="none"><circle cx="10" cy="20" r="3" fill="#ed1b68"/><circle cx="20" cy="20" r="3" fill="#ed1b68"/><circle cx="30" cy="20" r="3" fill="#ed1b68"/></svg></span>
                    <h3 class="lt-mode-title">And Many More</h3>
                    <p class="lt-mode-desc">New scenarios and custom rules are added throughout the season, ask our game masters on the day.</p>
                </div>
            </div>
            <p class="lt-mission-summary">Every game mode brings a different way to play, think and win with your squad. Change your strategy and try new game modes every round.</p>
        </div>
    </section>

    <section id="lt-packages" class="lt-packages lt-section-pad">
        <div class="lt-packages-inner">
            <div class="lt-section-center">
                <span class="lt-eyebrow">Packages</span>
                <h2 class="lt-section-heading">Choose your game package</h2>
                <p class="lt-section-sub">One round gets you into the game. More rounds unlock the full experience.</p>
            </div>
            <div class="lt-packages-grid">
                <div class="lt-pkg-card">
                    <h3 class="lt-pkg-name">1 ROUND</h3>
                    <p class="lt-pkg-tag">A quick first mission.</p>
                    <div class="lt-pkg-price"><span class="lt-pkg-amount">39</span><span class="lt-pkg-unit">LEI / player</span></div>
                    <div class="lt-pkg-divider"></div>
                    <div class="lt-pkg-benefits">
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>1 laser tag round</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Performance Paper included</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Briefing included</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Access to the LUN.R Camping bar & lounge</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Water included</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Rent or buy spare T-Shirt</span></div>
                    </div>
                    <a href="#lt-booking" class="lt-pkg-cta">Join the game</a>
                </div>
                
                <div class="lt-pkg-card lt-pkg-featured">
                    <div class="lt-pkg-badge">MOST POPULAR</div>
                    <h3 class="lt-pkg-name">2 ROUNDS</h3>
                    <p class="lt-pkg-tag">More action. More strategy. More fun.</p>
                    <div class="lt-pkg-price"><span class="lt-pkg-amount">69</span><span class="lt-pkg-unit">LEI / player</span></div>
                    <div class="lt-pkg-divider"></div>
                    <div class="lt-pkg-benefits">
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>2 laser tag rounds</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>10-minute break between rounds</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Performance Paper included</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Briefing included</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Access to the LUN.R Camping bar & lounge</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Water included</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Rent or buy spare T-Shirt</span></div>
                    </div>
                    <a href="#lt-booking" class="lt-pkg-cta">Join the game</a>
                </div>

                <div class="lt-pkg-card">
                    <h3 class="lt-pkg-name">3 ROUNDS</h3>
                    <p class="lt-pkg-tag">The full mission experience.</p>
                    <div class="lt-pkg-price"><span class="lt-pkg-amount">99</span><span class="lt-pkg-unit">LEI / player</span></div>
                    <div class="lt-pkg-divider"></div>
                    <div class="lt-pkg-benefits">
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>3 laser tag rounds</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>10-minute break between rounds</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Performance Paper included</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Briefing included</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Access to the LUN.R Camping bar & lounge</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Water included</span></div>
                        <div class="lt-pkg-benefit"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2"/></svg><span>Rent or buy spare T-Shirt</span></div>
                    </div>
                    <a href="#lt-booking" class="lt-pkg-cta">Join the game</a>
                </div>
            </div>
        </div>
    </section>

    <section id="lt-discounts" class="lt-discounts lt-section-pad">
        <div class="lt-discount-inner">
            <div class="lt-section-center">
                <span class="lt-eyebrow">Discounts</span>
                <h2 class="lt-section-heading">Stack your savings</h2>
                <p style="font-family:'Aerospace','Brother 1816 Bold',sans-serif;text-transform:uppercase;letter-spacing:1px;font-size:clamp(16px,1.8vw,20px);color:#ed1b68;margin:14px 0 0;">Yep, the discounts stack!</p>
            </div>

            <div class="lt-discount-box">
                <div class="lt-discount-divider"></div>

                <div class="lt-discount-panel">
                    <span class="lt-discount-num">13%<span style="font-size:0.42em;letter-spacing:1px;margin-left:6px;">OFF</span></span>
                    <h3 class="lt-discount-sub">For LUN.R Campers</h3>
                    <p class="lt-discount-note">Camping access bracelet required.</p>
                </div>

                <div class="lt-discount-panel">
                    <span class="lt-discount-num">13%<span style="font-size:0.42em;letter-spacing:1px;margin-left:6px;">OFF</span></span>
                    <h3 class="lt-discount-sub">Monday to Friday, 12-6 PM</h3>
                    <p class="lt-discount-note">Every Monday to Friday afternoon.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="lt-booking" class="lt-booking lt-section-pad">
        <div class="lt-booking-inner">
            <div class="lt-section-center">
                <span class="lt-eyebrow">Book your session</span>
                <h2 class="lt-section-heading">Reserve your spot</h2>
                <p class="lt-section-sub">Choose your package, pick a date with open slots, select a time and tell us who's coming.</p>
                <p class="lt-section-sub">You can find us inside LUN.R Camping, the official camping of Beach, Please! and Nibiru, at Strada Emil Costinescu 67, Costinești.</p>
                <a href="https://maps.app.goo.gl/8oh4P3cJqsfUxjD7A" target="_blank" rel="noopener noreferrer" class="lt-directions-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.7"/></svg>
                    Get directions
                </a>
            </div>

            <div id="lt-stage-build">
                <div data-lt-step="1" class="lt-step-pkg">
                    <div class="lt-step-header">
                        <span class="lt-step-num">1</span>
                        <span class="lt-step-label">Choose your package</span>
                    </div>
                    <div id="lt-pkg-choices" class="lt-pkg-choices"></div>
                </div>
                
                <div id="lt-pkg-summary" class="lt-summary-bar" style="display:none;"></div>

                <div class="lt-booking-grid">
                    <div class="lt-booking-card" id="lt-cal-card">
                        <div data-lt-step="2">
                            <div class="lt-step-header">
                                <span class="lt-step-num">2</span>
                                <span class="lt-step-label">Pick a date</span>
                            </div>
                        </div>
                        <div id="lt-date-summary" class="lt-summary-bar" style="display:none;"></div>
                        
                        <div id="lt-calendar-body">
                            <div id="lt-date-lock" class="lt-lock-overlay">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="16" rx="2" stroke="#ed1b68" stroke-width="1.6"/><path d="M3 9h18M8 3v4M16 3v4" stroke="#ed1b68" stroke-width="1.6"/></svg>
                                <span>Choose a package above to unlock the available dates.</span>
                            </div>
                            
                            <div class="lt-cal-nav">
                                <div id="lt-month-label" class="lt-month-label"></div>
                                <div class="lt-cal-arrows">
                                    <button id="lt-prev-month" class="lt-cal-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M15 4l-8 8 8 8" stroke="currentColor" stroke-width="2"/></svg></button>
                                    <button id="lt-next-month" class="lt-cal-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 4l8 8-8 8" stroke="currentColor" stroke-width="2"/></svg></button>
                                </div>
                            </div>
                            
                            <div class="lt-cal-weekdays">
                                <div>MON</div><div>TUE</div><div>WED</div><div>THU</div><div>FRI</div><div>SAT</div><div>SUN</div>
                            </div>
                            <div id="lt-calendar-grid" class="lt-cal-grid"></div>
                            
                            <div class="lt-cal-legend">
                                <div class="lt-legend-item"><span class="lt-legend-swatch lt-legend-available"></span>Available</div>
                                <div class="lt-legend-item"><span class="lt-legend-swatch lt-legend-selected"></span>Selected</div>
                                <div class="lt-legend-item"><span class="lt-legend-swatch lt-legend-unavail"></span>Unavailable</div>
                            </div>
                        </div>

                        <div id="lt-time-divider" class="lt-time-divider" style="display:none;"></div>

                        <div data-lt-step="3" id="lt-time-section">
                            <div class="lt-step-header">
                                <span class="lt-step-num">3</span>
                                <span class="lt-step-label">Choose a time</span>
                            </div>
                        </div>
                        <div id="lt-time-summary" class="lt-summary-bar" style="display:none;"></div>
                        <p id="lt-no-date-msg" class="lt-no-date-msg">Pick a date to see available time slots.</p>
                        <div id="lt-slots-container"></div>
                    </div>

                    <div class="lt-booking-card" id="lt-form-card">
                        <div data-lt-step="4">
                            <div class="lt-step-header">
                                <span class="lt-step-num">4</span>
                                <span class="lt-step-label">Your details</span>
                            </div>
                        </div>
                        
                        <div class="lt-form-grid">
                            <div class="lt-form-field">
                                <label class="lt-label">Full name</label>
                                <div class="lt-input-wrap">
                                    <input type="text" id="lt-name" placeholder="Your name" class="lt-input"/>
                                </div>
                            </div>
                            <div class="lt-form-field">
                                <label class="lt-label">Phone</label>
                                <div class="lt-input-wrap">
                                    <input type="tel" id="lt-phone" placeholder="07xx xxx xxx" class="lt-input"/>
                                </div>
                            </div>
                            <div class="lt-form-field">
                                <label class="lt-label">Email</label>
                                <div class="lt-input-wrap">
                                    <input type="email" id="lt-email" placeholder="you@email.com" class="lt-input"/>
                                </div>
                            </div>
                            <div class="lt-form-field">
                                <label class="lt-label">City <span class="lt-optional">(optional)</span></label>
                                <div class="lt-input-wrap">
                                    <input type="text" id="lt-city" placeholder="Your city" class="lt-input"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="lt-form-grid">
                            <div class="lt-form-field">
                                <label class="lt-label">Nr of players</label>
                                <div class="lt-input-wrap lt-stepper-wrap">
                                    <button id="lt-dec-players" class="lt-stepper-btn" type="button">−</button>
                                    <input type="number" id="lt-players" min="4" max="14" value="4" class="lt-stepper-input" />
                                    <button id="lt-inc-players" class="lt-stepper-btn" type="button">+</button>
                                </div>
                            </div>
                            <div class="lt-form-field">
                                <label class="lt-label">Game mode</label>
                                <div class="lt-input-wrap">
                                    <select id="lt-gamemode" class="lt-select">
                                        <option value="Battle Royale">Battle Royale</option>
                                        <option value="Team vs Team">Team vs Team</option>
                                        <option value="Last One Standing">Last One Standing</option>
                                        <option value="Capture the Flag">Capture the Flag</option>
                                        <option value="VIP Escort">VIP Escort</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="lt-form-field lt-terms-field">
                            <div class="lt-terms-wrapper">
                                <label class="lt-terms-label">
                                    <input type="checkbox" id="lt-terms-1" class="lt-checkbox legal-check" />
                                    <span class="lt-terms-text">
                                        <span class="lt-terms-ro">Am citit și accept <a href="/termeni-conditii-regulament-lt/" target="_blank">Termenii, Condițiile și Regulamentul de Participare Mind Shows Laser Tag</a>. Confirm că le voi transmite tuturor participanților incluși în rezervare.</span>
                                        <span class="lt-terms-en">I have read and accept the <a href="/terms-conditions-regulations-lt/" target="_blank">Mind Shows Laser Tag Terms, Conditions and Participation Rules</a>. I confirm that I will share them with all participants included in the booking.</span>
                                    </span>
                                </label>
                                <label class="lt-terms-label">
                                    <input type="checkbox" id="lt-terms-2" class="lt-checkbox legal-check" />
                                    <span class="lt-terms-text">
                                        <span class="lt-terms-ro">Înțeleg că accesul la Mind Shows Laser Tag se face prin LUN.R Camping și este supus regulilor de acces și securitate ale campingului, inclusiv verificărilor la intrare.</span>
                                        <span class="lt-terms-en">I understand that access to Mind Shows Laser Tag is through LUN.R Camping and is subject to the camping access and security rules, including entry checks.</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="lt-form-footer">
                            <div id="lt-form-status" class="lt-form-status">Complete the steps to review</div>
                            <button id="lt-review-btn" class="lt-btn-primary lt-btn-review" disabled>Review booking</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="lt-stage-review" class="lt-review-card" style="display:none;">
                <div class="lt-step-header">
                    <span class="lt-step-num">5</span>
                    <span class="lt-step-label">Review your booking</span>
                </div>
                <p class="lt-review-sub">Check everything looks right before you confirm.</p>
                <div class="lt-review-table" id="lt-review-table"></div>
                <div id="lt-error-container" class="lt-error-container" style="display:none; color:#ed1b68; font-family:'Outfit',sans-serif; font-size:14px; margin-bottom:15px; text-align:center;"></div>
                <div class="lt-review-actions">
                    <button id="lt-back-btn" class="lt-btn-outline">Back</button>
                    <button id="lt-confirm-btn" class="lt-btn-primary">Confirm booking</button>
                </div>
            </div>

            <div id="lt-stage-success" class="lt-success-card" style="display:none;">
                <div class="lt-success-icon">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5 11-13" stroke="#ed1b68" stroke-width="2.4"/></svg>
                </div>
                <h3 class="lt-success-title" id="lt-success-title">You're in!</h3>
                <p class="lt-success-msg">Your slot request has been received. We'll confirm your booking by email shortly.</p>
                <button id="lt-reset-btn" class="lt-btn-outline">Book another session</button>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
