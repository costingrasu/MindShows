<?php
/*
Template Name: Homepage
*/
get_header();

if ( ! function_exists( 'render_activity_element' ) ) {
    function render_activity_element( $mode, $text, $link, $css_class, $default_text, $default_link ) {
        $final_mode = ( $mode === 'button' || $mode === 'span' ) ? $mode : 'span';
        $final_text = ! empty( $text ) ? $text : $default_text;
        $final_link = ! empty( $link ) ? $link : $default_link;

        if ( $final_mode === 'button' ) {
            echo '<a href="' . esc_url( $final_link ) . '" class="' . esc_attr( $css_class ) . '">' . esc_html( $final_text ) . '</a>';
        } else {
            echo '<span class="' . esc_attr( $css_class ) . '">' . esc_html( $final_text ) . '</span>';
        }
    }
}

$act_buttons = function_exists('get_field') ? get_field('activity_buttons') : null;
$dev_grp  = ($act_buttons && isset($act_buttons['development'])) ? $act_buttons['development'] : (function_exists('get_field') ? get_field('development') : null);
$dev_mode = ($dev_grp && isset($dev_grp['dev_button_mode'])) ? $dev_grp['dev_button_mode'] : (function_exists('get_field') ? get_field('dev_button_mode') : 'span');
$dev_text = ($dev_grp && isset($dev_grp['dev_button_text']) && $dev_grp['dev_button_text'] !== '') ? $dev_grp['dev_button_text'] : (function_exists('get_field') ? get_field('dev_button_text') : 'Coming Soon');
$dev_link = ($dev_grp && isset($dev_grp['dev_button_link']) && $dev_grp['dev_button_link'] !== '') ? $dev_grp['dev_button_link'] : (function_exists('get_field') ? get_field('dev_button_link') : home_url('/development'));

$irl_grp  = ($act_buttons && isset($act_buttons['irl_gaming'])) ? $act_buttons['irl_gaming'] : (function_exists('get_field') ? get_field('irl_gaming') : null);
$irl_mode = ($irl_grp && isset($irl_grp['irl_button_mode'])) ? $irl_grp['irl_button_mode'] : (function_exists('get_field') ? get_field('irl_button_mode') : 'span');
$irl_text = ($irl_grp && isset($irl_grp['irl_button_text']) && $irl_grp['irl_button_text'] !== '') ? $irl_grp['irl_button_text'] : (function_exists('get_field') ? get_field('irl_button_text') : 'Coming Soon');
$irl_link = ($irl_grp && isset($irl_grp['irl_button_link']) && $irl_grp['irl_button_link'] !== '') ? $irl_grp['irl_button_link'] : (function_exists('get_field') ? get_field('irl_button_link') : home_url('/irl-gaming'));

$jrn_grp       = ($act_buttons && isset($act_buttons['journeys'])) ? $act_buttons['journeys'] : (function_exists('get_field') ? get_field('journeys') : null);
$journeys_mode = ($jrn_grp && isset($jrn_grp['journeys_button_mode'])) ? $jrn_grp['journeys_button_mode'] : (function_exists('get_field') ? get_field('journeys_button_mode') : 'button');
$journeys_text = ($jrn_grp && isset($jrn_grp['journeys_button_text']) && $jrn_grp['journeys_button_text'] !== '') ? $jrn_grp['journeys_button_text'] : (function_exists('get_field') ? get_field('journeys_button_text') : 'View More');
$journeys_link = ($jrn_grp && isset($jrn_grp['journeys_button_link']) && $jrn_grp['journeys_button_link'] !== '') ? $jrn_grp['journeys_button_link'] : (function_exists('get_field') ? get_field('journeys_button_link') : home_url('/journeys'));

$hero_sec      = function_exists('get_field') ? get_field('hero_section') : null;
$value_sec     = function_exists('get_field') ? get_field('value_section') : null;
$services_sec  = function_exists('get_field') ? get_field('services_section') : null;
$lasertag_sec  = function_exists('get_field') ? get_field('lasertag_section') : null;
$dev_sec       = function_exists('get_field') ? get_field('development_section') : null;
$irl_sec       = function_exists('get_field') ? get_field('irl_gaming_section') : null;
$journeys_sec  = function_exists('get_field') ? get_field('journeys_section') : null;

$hero_desc_0 = ($hero_sec && isset($hero_sec['slide_0_desc']) && $hero_sec['slide_0_desc'] !== '') ? $hero_sec['slide_0_desc'] : (function_exists('get_field') ? get_field('hero_slide_0_desc') : 'Dacă jocurile te-ar ajuta să te înțelegi mai bine? Și dacă abilitățiile pe care le dezvolți în jocuri ar fi utile în viața reală? Dezvoltare personală conștientă înseamnă exerciții, jocuri, sesiuni de debriefing, psihoeducație și activități practice menite să asigure un cadru ideal pentru autocunoaștere, conștientizare și dezvoltare.<br><strong>Potrivit pentru:</strong> școli, licee, tabere, organizații, grupuri de adolescenți, tineri și echipe.');
$hero_desc_1 = ($hero_sec && isset($hero_sec['slide_1_desc']) && $hero_sec['slide_1_desc'] !== '') ? $hero_sec['slide_1_desc'] : (function_exists('get_field') ? get_field('hero_slide_1_desc') : 'Jocuri în realitate, create cu scenarii originale, roluri, obiective, decor, atmosferă și mecanici de joc adaptabile. IRL Gaming aduce jocurile video în realitate. Intră într-o echipă, ia decizii, negociază, concurează, colaborează și trăiește o poveste pe care nici nu vei știi cum să o povestești.<br><strong>Potrivit pentru:</strong> adolescenți, adulți tineri, tabere, festivaluri, activări de brand, evenimente și comunități.');
$hero_desc_2 = ($hero_sec && isset($hero_sec['slide_2_desc']) && $hero_sec['slide_2_desc'] !== '') ? $hero_sec['slide_2_desc'] : (function_exists('get_field') ? get_field('hero_slide_2_desc') : 'Concepte, povești și sisteme gamificate pentru tabere, excursii, trasee, aventuri și experiențe tematice. Journeys transformă o călătorie într-o poveste scrisă cu atenție. Creăm concepte, jocuri și programe care sunt unite de o viziune și un obiectiv adaptabile grupului țintă.<br><strong>Potrivit pentru:</strong> copii și adolescenți, tabere, agenții de turism, școli, organizatori de evenimente, proiecte educaționale și parteneri.');

$value_text  = ($value_sec && isset($value_sec['value_text']) && $value_sec['value_text'] !== '') ? $value_sec['value_text'] : (function_exists('get_field') ? get_field('value_section_text') : 'Organizăm <span class="value-highlight">experiențe educaționale</span>, <span class="value-highlight">traininguri interactive</span>, <span class="value-highlight">jocuri imersive</span> și <span class="value-highlight">concepte gamificate</span> pentru adolescenți, tineri, școli, tabere, branduri și organizații.');

$svc_dev_sub  = ($services_sec && isset($services_sec['dev_subtitle']) && $services_sec['dev_subtitle'] !== '') ? $services_sec['dev_subtitle'] : 'Changing the Way We Learn';
$svc_dev_desc = ($services_sec && isset($services_sec['dev_desc']) && $services_sec['dev_desc'] !== '') ? $services_sec['dev_desc'] : 'Dacă jocurile te-ar ajuta să te înțelegi mai bine? Și dacă abilitățiile pe care le dezvolți în jocuri ar fi utile în viața reală? Dezvoltare personală conștientă înseamnă exerciții, jocuri, sesiuni de debriefing, psihoeducație și activități practice menite să asigure un cadru ideal pentru autocunoaștere, conștientizare și dezvoltare.<br><strong>Potrivit pentru:</strong> școli, licee, tabere, organizații, grupuri de adolescenți, tineri și echipe.';
$svc_irl_sub  = ($services_sec && isset($services_sec['irl_subtitle']) && $services_sec['irl_subtitle'] !== '') ? $services_sec['irl_subtitle'] : 'Changing the Way We Play';
$svc_irl_desc = ($services_sec && isset($services_sec['irl_desc']) && $services_sec['irl_desc'] !== '') ? $services_sec['irl_desc'] : 'Jocuri în realitate, create cu scenarii originale, roluri, obiective, decor, atmosferă și mecanici de joc adaptabile. IRL Gaming aduce jocurile video în realitate. Intră într-o echipă, ia decizii, negociază, concurează, colaborează și trăiește o poveste pe care nici nu vei știi cum să o povestești.<br><strong>Potrivit pentru:</strong> adolescenți, adulți tineri, tabere, festivaluri, activări de brand, evenimente și comunități.';
$svc_jrn_sub  = ($services_sec && isset($services_sec['journeys_subtitle']) && $services_sec['journeys_subtitle'] !== '') ? $services_sec['journeys_subtitle'] : 'Changing the Way We Travel';
$svc_jrn_desc = ($services_sec && isset($services_sec['journeys_desc']) && $services_sec['journeys_desc'] !== '') ? $services_sec['journeys_desc'] : 'Concepte, povești și sisteme gamificate pentru tabere, excursii, trasee, aventuri și experiențe tematice. Journeys transformă o călătorie într-o poveste scrisă cu atenție. Creăm concepte, jocuri și programe care sunt unite de o viziune și un obiectiv adaptabile grupului țintă.<br><strong>Potrivit pentru:</strong> copii și adolescenți, tabere, agenții de turism, școli, organizatori de evenimente, proiecte educaționale și parteneri.';

$lt_desc    = ($lasertag_sec && isset($lasertag_sec['section_desc']) && $lasertag_sec['section_desc'] !== '') ? $lasertag_sec['section_desc'] : 'Experience our outdoor laser tag arena in Costineşti, where real-life gaming meets the pulse of summer, located in LUN.R Camping right next to Nibiru.';
$lt_eyebrow = ($lasertag_sec && isset($lasertag_sec['card_eyebrow']) && $lasertag_sec['card_eyebrow'] !== '') ? $lasertag_sec['card_eyebrow'] : 'OUTDOOR LASER TAG · COSTINEŞTI';
$lt_title   = ($lasertag_sec && isset($lasertag_sec['card_title']) && $lasertag_sec['card_title'] !== '') ? $lasertag_sec['card_title'] : 'Gather your squad';
$lt_lead    = ($lasertag_sec && isset($lasertag_sec['card_lead']) && $lasertag_sec['card_lead'] !== '') ? $lasertag_sec['card_lead'] : 'Book your slot in our open-air arena, pick a package and battle it out across multiple game modes';
$lt_btn     = ($lasertag_sec && isset($lasertag_sec['btn_text']) && $lasertag_sec['btn_text'] !== '') ? $lasertag_sec['btn_text'] : 'View More';
$lt_stats   = ($lasertag_sec && !empty($lasertag_sec['stats'])) ? $lasertag_sec['stats'] : null;

$dev_sub         = ($dev_sec && isset($dev_sec['subtitle']) && $dev_sec['subtitle'] !== '') ? $dev_sec['subtitle'] : 'Reshaping the Way We Learn';
$dev_r_title_1   = ($dev_sec && isset($dev_sec['right_title_1']) && $dev_sec['right_title_1'] !== '') ? $dev_sec['right_title_1'] : 'Dă-ți upgrade la soft skills!';
$dev_r_desc_1    = ($dev_sec && isset($dev_sec['right_desc_1']) && $dev_sec['right_desc_1'] !== '') ? $dev_sec['right_desc_1'] : 'Traninguri experiențiale, gamificate și livrate cu metode moderne potrivite pentru tineri și echipe care vor să treacă la următorul nivel.';
$dev_r_title_2   = ($dev_sec && isset($dev_sec['right_title_2']) && $dev_sec['right_title_2'] !== '') ? $dev_sec['right_title_2'] : (function_exists('get_field') ? get_field('right_title_2') : 'MAIN QUEST');
$dev_r_desc_2    = ($dev_sec && isset($dev_sec['right_desc_2']) && $dev_sec['right_desc_2'] !== '') ? $dev_sec['right_desc_2'] : (function_exists('get_field') ? get_field('right_desc_2') : 'Seria de traininguri principale, de o zi (8 ore) - un „must have” al abilităților și dezvoltării personale.');
$dev_root_title  = ($dev_sec && isset($dev_sec['root_title']) && $dev_sec['root_title'] !== '') ? $dev_sec['root_title'] : 'TRIAL';
$dev_root_desc   = ($dev_sec && isset($dev_sec['root_desc']) && $dev_sec['root_desc'] !== '') ? $dev_sec['root_desc'] : 'Descoperă seria de MAIN QUESTS gratuit, fără niciun angajament.';

$dev_cards       = ($dev_sec && !empty($dev_sec['cards'])) ? $dev_sec['cards'] : null;
$dev_branch0     = ($dev_sec && isset($dev_sec['branch0'])) ? $dev_sec['branch0'] : (function_exists('get_field') ? get_field('branch0') : null);
$dev_branch1     = ($dev_sec && isset($dev_sec['branch1'])) ? $dev_sec['branch1'] : (function_exists('get_field') ? get_field('branch1') : null);
$dev_branch2     = ($dev_sec && isset($dev_sec['branch2'])) ? $dev_sec['branch2'] : (function_exists('get_field') ? get_field('branch2') : null);

$irl_sub  = ($irl_sec && isset($irl_sec['subtitle']) && $irl_sec['subtitle'] !== '') ? $irl_sec['subtitle'] : 'Changing the Way We Play';
$irl_desc = ($irl_sec && isset($irl_sec['description']) && $irl_sec['description'] !== '') ? $irl_sec['description'] : 'Imaginează-ți un joc video scos din ecran și adus în lumea reală. Aducem jocurile video și atmosfera de film în realitate prin experiențe imersive, roluri, obiective, strategie și competiție. Intră într-o lume construită de la 0, ia decizii, colaborează, concurează și trăiește o experiență construită cu reguli clare, atmosferă și miză.';

$journeys_sub  = ($journeys_sec && isset($journeys_sec['subtitle']) && $journeys_sec['subtitle'] !== '') ? $journeys_sec['subtitle'] : 'Reshaping the Way We Travel';
$journeys_desc = ($journeys_sec && isset($journeys_sec['description']) && $journeys_sec['description'] !== '') ? $journeys_sec['description'] : 'Creăm universuri narative pentru experiențe educaționale, tabere și călătorii tematice. Construim povești, echipe, misiuni, provocări, artefacte, indicii și sisteme de joc care fac o drumeție, un team building sau o tabără să pară scris ca o poveste, fiecare element fiind integrat într-o singură viziune.';

function render_branch_nodes( $branch, $default_nodes ) {
    $nodes_to_render = array();

    if ( $branch && ! empty( $branch['nodes'] ) && is_array( $branch['nodes'] ) ) {
        $nodes_to_render = $branch['nodes'];
    } elseif ( $branch ) {
        for ( $i = 1; $i <= 10; $i++ ) {
            if ( isset( $branch['node_' . $i] ) && is_array( $branch['node_' . $i] ) ) {
                $nodes_to_render[] = $branch['node_' . $i];
            }
        }
    }

    if ( empty( $nodes_to_render ) ) {
        $nodes_to_render = $default_nodes;
    }

    foreach ( $nodes_to_render as $idx => $node ) {
        $node_num   = $idx + 1;
        $node_title = ( isset( $node['title'] ) && trim( $node['title'] ) !== '' ) ? trim( $node['title'] ) : '';
        $node_desc  = isset( $node['desc'] ) ? trim( $node['desc'] ) : '';
        ?>
        <div class="branch-node-container">
            <div class="branch-node">
                <span class="node-number"><?php echo $node_num; ?></span>
                <div class="node-hidden-content">
                    <?php if ( $node_title !== '' ) : ?>
                        <span class="node-hidden-title"><?php echo esc_html( $node_title ); ?></span>
                    <?php endif; ?>
                    <?php if ( $node_desc !== '' ) : ?>
                        <span class="node-hidden-desc"><?php echo esc_html( $node_desc ); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<main class="home-main">
    <h1 class="sr-only">Mind Shows — Experiențe Educaționale, Jocuri Imersive și Tabere Gamificate</h1>
    <section class="home-carousel-section">
        <div class="home-carousel-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/brandLogo.png" alt="MindShows Logo" class="brand-logo-img" width="155" height="100" />
            <div class="logo-delimiter"></div>
            <div class="logo-text">
                YOUR WAY TO<br>THE NEXT LEVEL
            </div>
        </div>
        <div class="home-carousel-track">
            
            <div class="home-carousel-slide active" data-index="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg-development.png');">
                <div class="slide-content">
                    <h2 class="slide-title">DEVELOPMENT</h2>
                    <div class="slide-details">
                        <p class="slide-description"><?php echo wp_kses_post($hero_desc_0); ?></p>
                        <div class="slide-action">
                            <?php render_activity_element( $dev_mode, $dev_text, $dev_link, 'btn-start-now', 'Coming Soon', home_url('/development') ); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="home-carousel-slide" data-index="1" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg-irlGaming.png');">
                <div class="slide-content">
                    <h2 class="slide-title">IRL GAMING</h2>
                    <div class="slide-details">
                        <p class="slide-description"><?php echo wp_kses_post($hero_desc_1); ?></p>
                        <div class="slide-action">
                            <?php render_activity_element( $irl_mode, $irl_text, $irl_link, 'btn-start-now', 'Coming Soon', home_url('/irl-gaming') ); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="home-carousel-slide" data-index="2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg-journeys.png');">
                <div class="slide-content">
                    <h2 class="slide-title">JOURNEYS</h2>
                    <div class="slide-details">
                        <p class="slide-description"><?php echo wp_kses_post($hero_desc_2); ?></p>
                        <div class="slide-action">
                            <?php render_activity_element( $journeys_mode, $journeys_text ? $journeys_text : 'Start Now', $journeys_link, 'btn-start-now', 'Start Now', home_url('/journeys') ); ?>
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
                <p class="value-text"><?php echo wp_kses_post($value_text); ?></p>
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
                    <h3 class="service-subtitle"><?php echo esc_html($svc_dev_sub); ?></h3>
                    <div class="service-hidden-content">
                        <p class="service-description"><?php echo wp_kses_post($svc_dev_desc); ?></p>
                        <?php render_activity_element( $dev_mode, $dev_text, $dev_link, 'service-btn', 'Coming Soon', home_url('/development') ); ?>
                    </div>
                </div>
            </article>

            <article class="service-card">
                <button class="service-close-btn" aria-label="Close" type="button">X</button>
                <div class="service-card-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/symbol-irlGaming.png');"></div>
                <div class="service-card-overlay"></div>
                <div class="service-card-content">
                    <h2 class="service-title">IRL Gaming</h2>
                    <h3 class="service-subtitle"><?php echo esc_html($svc_irl_sub); ?></h3>
                    <div class="service-hidden-content">
                        <p class="service-description"><?php echo wp_kses_post($svc_irl_desc); ?></p>
                        <?php render_activity_element( $irl_mode, $irl_text, $irl_link, 'service-btn', 'Coming Soon', home_url('/irl-gaming') ); ?>
                    </div>
                </div>
            </article>

            <article class="service-card">
                <button class="service-close-btn" aria-label="Close" type="button">X</button>
                <div class="service-card-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/symbol-journeys.png');"></div>
                <div class="service-card-overlay"></div>
                <div class="service-card-content">
                    <h2 class="service-title">Journeys</h2>
                    <h3 class="service-subtitle"><?php echo esc_html($svc_jrn_sub); ?></h3>
                    <div class="service-hidden-content">
                        <p class="service-description"><?php echo wp_kses_post($svc_jrn_desc); ?></p>
                        <?php render_activity_element( $journeys_mode, $journeys_text, $journeys_link, 'service-btn', 'View More', home_url('/journeys') ); ?>
                    </div>
                </div>
            </article>

        </div>
    </section>

    <?php
    $lasertag_url = home_url('/lasertag/');
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-lasertag.php',
        'number' => 1
    ));
    if (!empty($pages)) {
        $lasertag_url = get_permalink($pages[0]->ID);
    }
    ?>
    <section class="home-lasertag-section fade-up-element" data-screen-label="Laser Tag">
        <div class="lasertag-home-container">
            <h2 class="lasertag-home-title">LASER TAG</h2>
            <p class="lasertag-home-description"><?php echo esc_html($lt_desc); ?></p>
            <div class="lasertag-home-card">
                <div class="lasertag-home-card-bg"></div>
                <div class="lasertag-home-card-overlay"></div>
                <div class="lasertag-home-card-content">
                    <div class="lasertag-card-head">
                        <p class="lasertag-card-eyebrow">
                            <?php 
                            $eyebrow_parts = explode('·', $lt_eyebrow);
                            if (count($eyebrow_parts) == 2) {
                                echo '<span>' . esc_html(trim($eyebrow_parts[0])) . '</span><span class="lt-eyebrow-dot"> · </span><span>' . esc_html(trim($eyebrow_parts[1])) . '</span>';
                            } else {
                                echo esc_html($lt_eyebrow);
                            }
                            ?>
                        </p>
                        <h3 class="lasertag-home-card-title"><?php echo esc_html($lt_title); ?></h3>
                        <p class="lasertag-card-lead"><?php echo esc_html($lt_lead); ?></p>
                    </div>
                    <div class="lasertag-stats">
                        <?php if ($lt_stats && is_array($lt_stats)) : ?>
                            <?php foreach ($lt_stats as $stat) : ?>
                            <div class="lasertag-stat">
                                <span class="lasertag-stat-num"><?php echo esc_html(isset($stat['num']) ? $stat['num'] : ''); ?></span>
                                <span class="lasertag-stat-label"><?php echo esc_html(isset($stat['label']) ? $stat['label'] : ''); ?></span>
                            </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="lasertag-stat">
                                <span class="lasertag-stat-num">3</span>
                                <span class="lasertag-stat-label">packages to choose from</span>
                            </div>
                            <div class="lasertag-stat">
                                <span class="lasertag-stat-num">5+</span>
                                <span class="lasertag-stat-label">game modes</span>
                            </div>
                            <div class="lasertag-stat">
                                <span class="lasertag-stat-num">14</span>
                                <span class="lasertag-stat-label">players per battle max</span>
                            </div>
                            <div class="lasertag-stat">
                                <span class="lasertag-stat-num">1000</span>
                                <span class="lasertag-stat-label">sqm outdoor arena</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo esc_url($lasertag_url); ?>" class="lasertag-home-btn"><?php echo esc_html($lt_btn); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="home-development-section fade-up-element">
        <div class="development-left slide-right-element">
            <div class="development-bg-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bg-development1.svg" class="development-bg-image" alt="Development Graphic" loading="lazy">
            </div>
            <div class="development-left-content">
                <h2 class="development-title">DEVELOPMENT</h2>
                <p class="development-subtitle"><?php echo esc_html($dev_sub); ?></p>
            </div>
        </div>
        <div class="development-right">
            <div class="dev-right-content fade-up-element">
                <div class="dev-right-header">
                    <h3 class="dev-right-title"><?php echo esc_html($dev_r_title_1); ?></h3>
                    <p class="dev-right-description"><?php echo esc_html($dev_r_desc_1); ?></p>
                </div>
                
                <div class="dev-cards-container">
                    <?php if ($dev_cards && is_array($dev_cards)) : ?>
                        <?php foreach ($dev_cards as $card) : ?>
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
                                <h4 class="dev-card-title"><?php echo esc_html(isset($card['card_title']) ? $card['card_title'] : ''); ?></h4>
                                <p class="dev-card-desc"><?php echo esc_html(isset($card['card_desc']) ? $card['card_desc'] : ''); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else : ?>
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
                    <?php endif; ?>
                </div>

                <?php render_activity_element( $dev_mode, $dev_text, $dev_link, 'dev-btn', 'Coming Soon', home_url('/development') ); ?>
            </div>

            <div class="dev-tree-content fade-up-element">
                <div class="dev-right-header">
                    <h3 class="dev-right-title"><?php echo esc_html($dev_r_title_2); ?></h3>
                    <p class="dev-right-description"><?php echo esc_html($dev_r_desc_2); ?></p>
                </div>
                
                <div class="dev-tree-container">
                    <svg class="dev-tree-lines" width="100%" height="80" viewBox="0 0 510 80" preserveAspectRatio="none">
                        <line x1="255" y1="0" x2="74" y2="80" stroke="#3A3A3A" stroke-width="3" stroke-dasharray="6 6"/>
                        <line x1="255" y1="0" x2="255" y2="80" stroke="#3A3A3A" stroke-width="3" stroke-dasharray="6 6"/>
                        <line x1="255" y1="0" x2="436" y2="80" stroke="#3A3A3A" stroke-width="3" stroke-dasharray="6 6"/>
                    </svg>
                    
                    <div class="dev-tree-root">
                        <span class="root-title"><?php echo esc_html($dev_root_title); ?></span>
                        <div class="root-hidden-content">
                            <span class="root-hidden-subtitle"><?php echo esc_html($dev_root_title); ?></span>
                            <span class="root-hidden-desc"><?php echo esc_html($dev_root_desc); ?></span>
                        </div>
                    </div>
                    
                    <div class="dev-tree-branches">
                        <?php 
                        $b0_header = ($dev_branch0 && !empty($dev_branch0['title'])) ? $dev_branch0['title'] : 'DEZVOLTARE PERSONALĂ CONȘTIENTĂ';
                        $b0_defaults = array(
                            array( 'title' => 'Primul pas în dezvoltare', 'desc' => 'Autocunoaștere și principii de creștere' ),
                            array( 'title' => 'Dincolo de gânduri', 'desc' => 'Ce se întamplă, de fapt, în mintea noastră' ),
                            array( 'title' => 'Cu și despre emoții', 'desc' => 'Identificare și reglarea emoțională' ),
                            array( 'title' => 'Principii și valori', 'desc' => 'Identificarea și ierarhizarea valorilor de viață' ),
                        );
                        ?>
                        <div class="dev-tree-branch">
                            <div class="branch-header"><?php echo esc_html($b0_header); ?></div>
                            <div class="branch-nodes">
                                <?php render_branch_nodes( $dev_branch0, $b0_defaults ); ?>
                            </div>
                        </div>
                        
                        <?php 
                        $b1_header = ($dev_branch1 && !empty($dev_branch1['title'])) ? $dev_branch1['title'] : 'LEADERSHIP';
                        $b1_defaults = array(
                            array( 'title' => '', 'desc' => 'Ce este leadershipul și ce tip de lider vreau să devin?' ),
                            array( 'title' => '', 'desc' => 'Cum mă comport și cum vorbesc ca un lider?' ),
                            array( 'title' => '', 'desc' => 'Cum ajut și cum inspir oamenii ca un lider?' ),
                            array( 'title' => '', 'desc' => 'Când sunt lider și când sunt team player?' ),
                        );
                        ?>
                        <div class="dev-tree-branch">
                            <div class="branch-header"><?php echo esc_html($b1_header); ?></div>
                            <div class="branch-nodes">
                                <?php render_branch_nodes( $dev_branch1, $b1_defaults ); ?>
                            </div>
                        </div>

                        <?php 
                        $b2_header = ($dev_branch2 && !empty($dev_branch2['title'])) ? $dev_branch2['title'] : 'COMUNICARE';
                        $b2_defaults = array(
                            array( 'title' => 'Bazele comunicării', 'desc' => 'Tipuri de comunicare, factori și mijloace de comunicare' ),
                            array( 'title' => '', 'desc' => 'Tehnici pentru comunicarea eficientă' ),
                            array( 'title' => '', 'desc' => 'Perspective, asertivitate și gestionarea conflictelor' ),
                            array( 'title' => '', 'desc' => 'Comunicarea cu grupuri, public, audiență' ),
                        );
                        ?>
                        <div class="dev-tree-branch">
                            <div class="branch-header"><?php echo esc_html($b2_header); ?></div>
                            <div class="branch-nodes">
                                <?php render_branch_nodes( $dev_branch2, $b2_defaults ); ?>
                            </div>
                        </div>

                    </div>
                </div>

                <?php render_activity_element( $dev_mode, $dev_text, $dev_link, 'dev-btn', 'Coming Soon', home_url('/development') ); ?>
            </div>
        </div>
    </section>

    <section class="home-irlgaming-section fade-up-element">
        <div class="irlgaming-container">
            <h2 class="irlgaming-title">IRL GAMING</h2>
            <h3 class="irlgaming-subtitle"><?php echo esc_html($irl_sub); ?></h3>
            <p class="irlgaming-description"><?php echo esc_html($irl_desc); ?></p>
            <div class="irlgaming-placeholder">
                <?php render_activity_element( $irl_mode, $irl_text, $irl_link, 'irlgaming-btn-text', 'Coming Soon', home_url('/irl-gaming') ); ?>
            </div>
        </div>
    </section>

    <section class="home-journeys-section fade-up-element">
        <div class="journeys-home-container">
            <h2 class="journeys-home-title">JOURNEYS</h2>
            <h3 class="journeys-home-subtitle"><?php echo esc_html($journeys_sub); ?></h3>
            <p class="journeys-home-description"><?php echo esc_html($journeys_desc); ?></p>

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
                                <?php render_activity_element( $journeys_mode, $journeys_text, $card['permalink'], 'jhc-btn', 'View More', $card['permalink'] ); ?>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>

            </div>

            <?php render_activity_element( $journeys_mode, $journeys_text ? $journeys_text : 'View More', $journeys_link, 'journeys-home-btn', 'Află Mai Multe', home_url('/journeys') ); ?>

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
