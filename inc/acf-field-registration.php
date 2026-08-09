<?php
/**
 * Programmatic ACF Field Registration
 * Registers all field groups for Homepage, Journeys, and Laser Tag pages.
 */

if (!defined('ABSPATH')) exit;

function mindshows_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) return;

    // ═══════════════════════════════════════════════
    // FIELD GROUP 1: HOMEPAGE (front-page.php)
    // ═══════════════════════════════════════════════
    acf_add_local_field_group(array(
        'key' => 'group_fp_fields',
        'title' => 'Homepage Fields',
        'fields' => array(
            // ── Activity Buttons ──
            array(
                'key' => 'field_fp_activity_buttons',
                'label' => 'Activity Buttons',
                'name' => 'activity_buttons',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    // Development sub-group
                    array(
                        'key' => 'field_fp_act_development',
                        'label' => 'Development',
                        'name' => 'development',
                        'type' => 'group',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array('key' => 'field_fp_dev_mode', 'label' => 'Button Mode', 'name' => 'dev_button_mode', 'type' => 'select', 'choices' => array('button' => 'Button', 'span' => 'Span'), 'default_value' => 'span'),
                            array('key' => 'field_fp_dev_text', 'label' => 'Button Text', 'name' => 'dev_button_text', 'type' => 'text', 'default_value' => 'Coming Soon'),
                            array('key' => 'field_fp_dev_link', 'label' => 'Button Link', 'name' => 'dev_button_link', 'type' => 'text', 'default_value' => '/development'),
                        ),
                    ),
                    // IRL Gaming sub-group
                    array(
                        'key' => 'field_fp_act_irl',
                        'label' => 'IRL Gaming',
                        'name' => 'irl_gaming',
                        'type' => 'group',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array('key' => 'field_fp_irl_mode', 'label' => 'Button Mode', 'name' => 'irl_button_mode', 'type' => 'select', 'choices' => array('button' => 'Button', 'span' => 'Span'), 'default_value' => 'span'),
                            array('key' => 'field_fp_irl_text', 'label' => 'Button Text', 'name' => 'irl_button_text', 'type' => 'text', 'default_value' => 'Coming Soon'),
                            array('key' => 'field_fp_irl_link', 'label' => 'Button Link', 'name' => 'irl_button_link', 'type' => 'text', 'default_value' => '/irl-gaming'),
                        ),
                    ),
                    // Journeys sub-group
                    array(
                        'key' => 'field_fp_act_journeys',
                        'label' => 'Journeys',
                        'name' => 'journeys',
                        'type' => 'group',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array('key' => 'field_fp_jrn_mode', 'label' => 'Button Mode', 'name' => 'journeys_button_mode', 'type' => 'select', 'choices' => array('button' => 'Button', 'span' => 'Span'), 'default_value' => 'button'),
                            array('key' => 'field_fp_jrn_text', 'label' => 'Button Text', 'name' => 'journeys_button_text', 'type' => 'text', 'default_value' => 'View More'),
                            array('key' => 'field_fp_jrn_link', 'label' => 'Button Link', 'name' => 'journeys_button_link', 'type' => 'text', 'default_value' => '/journeys'),
                        ),
                    ),
                ),
            ),

            // ── Hero Section ──
            array(
                'key' => 'field_fp_hero_section',
                'label' => 'Hero Section',
                'name' => 'hero_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_fp_slide_0_desc', 'label' => 'Slide 0 Description', 'name' => 'slide_0_desc', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Dacă jocurile te-ar ajuta să te înțelegi mai bine? Și dacă abilitățiile pe care le dezvolți în jocuri ar fi utile în viața reală? Dezvoltare personală conștientă înseamnă exerciții, jocuri, sesiuni de debriefing, psihoeducație și activități practice menite să asigure un cadru ideal pentru autocunoaștere, conștientizare și dezvoltare.<br><strong>Potrivit pentru:</strong> școli, licee, tabere, organizații, grupuri de adolescenți, tineri și echipe.'),
                    array('key' => 'field_fp_slide_1_desc', 'label' => 'Slide 1 Description', 'name' => 'slide_1_desc', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Jocuri în realitate, create cu scenarii originale, roluri, obiective, decor, atmosferă și mecanici de joc adaptabile. IRL Gaming aduce jocurile video în realitate. Intră într-o echipă, ia decizii, negociază, concurează, colaborează și trăiește o poveste pe care nici nu vei știi cum să o povestești.<br><strong>Potrivit pentru:</strong> adolescenți, adulți tineri, tabere, festivaluri, activări de brand, evenimente și comunități.'),
                    array('key' => 'field_fp_slide_2_desc', 'label' => 'Slide 2 Description', 'name' => 'slide_2_desc', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Concepte, povești și sisteme gamificate pentru tabere, excursii, trasee, aventuri și experiențe tematice. Journeys transformă o călătorie într-o poveste scrisă cu atenție. Creăm concepte, jocuri și programe care sunt unite de o viziune și un obiectiv adaptabile grupului țintă.<br><strong>Potrivit pentru:</strong> copii și adolescenți, tabere, agenții de turism, școli, organizatori de evenimente, proiecte educaționale și parteneri.'),
                ),
            ),

            // ── Value Section ──
            array(
                'key' => 'field_fp_value_section',
                'label' => 'Value Section',
                'name' => 'value_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_fp_value_text', 'label' => 'Value Text', 'name' => 'value_text', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Organizăm <span class="value-highlight">experiențe educaționale</span>, <span class="value-highlight">traininguri interactive</span>, <span class="value-highlight">jocuri imersive</span> și <span class="value-highlight">concepte gamificate</span> pentru adolescenți, tineri, școli, tabere, branduri și organizații.'),
                ),
            ),

            // ── Services Section ──
            array(
                'key' => 'field_fp_services_section',
                'label' => 'Services Section',
                'name' => 'services_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_fp_svc_dev_sub', 'label' => 'Development Subtitle', 'name' => 'dev_subtitle', 'type' => 'text', 'default_value' => 'Changing the Way We Learn'),
                    array('key' => 'field_fp_svc_dev_desc', 'label' => 'Development Description', 'name' => 'dev_desc', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Dacă jocurile te-ar ajuta să te înțelegi mai bine? Și dacă abilitățiile pe care le dezvolți în jocuri ar fi utile în viața reală? Dezvoltare personală conștientă înseamnă exerciții, jocuri, sesiuni de debriefing, psihoeducație și activități practice menite să asigure un cadru ideal pentru autocunoaștere, conștientizare și dezvoltare.<br><strong>Potrivit pentru:</strong> școli, licee, tabere, organizații, grupuri de adolescenți, tineri și echipe.'),
                    array('key' => 'field_fp_svc_irl_sub', 'label' => 'IRL Gaming Subtitle', 'name' => 'irl_subtitle', 'type' => 'text', 'default_value' => 'Changing the Way We Play'),
                    array('key' => 'field_fp_svc_irl_desc', 'label' => 'IRL Gaming Description', 'name' => 'irl_desc', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Jocuri în realitate, create cu scenarii originale, roluri, obiective, decor, atmosferă și mecanici de joc adaptabile. IRL Gaming aduce jocurile video în realitate. Intră într-o echipă, ia decizii, negociază, concurează, colaborează și trăiește o poveste pe care nici nu vei știi cum să o povestești.<br><strong>Potrivit pentru:</strong> adolescenți, adulți tineri, tabere, festivaluri, activări de brand, evenimente și comunități.'),
                    array('key' => 'field_fp_svc_jrn_sub', 'label' => 'Journeys Subtitle', 'name' => 'journeys_subtitle', 'type' => 'text', 'default_value' => 'Changing the Way We Travel'),
                    array('key' => 'field_fp_svc_jrn_desc', 'label' => 'Journeys Description', 'name' => 'journeys_desc', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Concepte, povești și sisteme gamificate pentru tabere, excursii, trasee, aventuri și experiențe tematice. Journeys transformă o călătorie într-o poveste scrisă cu atenție. Creăm concepte, jocuri și programe care sunt unite de o viziune și un obiectiv adaptabile grupului țintă.<br><strong>Potrivit pentru:</strong> copii și adolescenți, tabere, agenții de turism, școli, organizatori de evenimente, proiecte educaționale și parteneri.'),
                ),
            ),

            // ── Laser Tag Section (Homepage) ──
            array(
                'key' => 'field_fp_lasertag_section',
                'label' => 'Laser Tag Section',
                'name' => 'lasertag_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_fp_lt_desc', 'label' => 'Section Description', 'name' => 'section_desc', 'type' => 'textarea', 'default_value' => 'Experience our outdoor laser tag arena in Costineşti, where real-life gaming meets the pulse of summer, located in LUN.R Camping right next to Nibiru.'),
                    array('key' => 'field_fp_lt_eyebrow', 'label' => 'Card Eyebrow', 'name' => 'card_eyebrow', 'type' => 'text', 'default_value' => 'OUTDOOR LASER TAG · COSTINEŞTI'),
                    array('key' => 'field_fp_lt_title', 'label' => 'Card Title', 'name' => 'card_title', 'type' => 'text', 'default_value' => 'Gather your squad'),
                    array('key' => 'field_fp_lt_lead', 'label' => 'Card Lead', 'name' => 'card_lead', 'type' => 'textarea', 'default_value' => 'Book your slot in our open-air arena, pick a package and battle it out across multiple game modes'),
                    array('key' => 'field_fp_lt_btn', 'label' => 'Button Text', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'View More'),
                    // Stats repeater
                    array(
                        'key' => 'field_fp_lt_stats',
                        'label' => 'Stats',
                        'name' => 'stats',
                        'type' => 'repeater',
                        'min' => 1,
                        'max' => 10,
                        'layout' => 'table',
                        'sub_fields' => array(
                            array('key' => 'field_fp_lt_stat_num', 'label' => 'Number', 'name' => 'num', 'type' => 'text'),
                            array('key' => 'field_fp_lt_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'),
                        ),
                    ),
                ),
            ),

            // ── Development Section ──
            array(
                'key' => 'field_fp_dev_section',
                'label' => 'Development Section',
                'name' => 'development_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_fp_dev_sub', 'label' => 'Subtitle', 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Reshaping the Way We Learn'),
                    array('key' => 'field_fp_dev_rt1', 'label' => 'Right Title 1', 'name' => 'right_title_1', 'type' => 'text', 'default_value' => 'Dă-ți upgrade la soft skills!'),
                    array('key' => 'field_fp_dev_rd1', 'label' => 'Right Description 1', 'name' => 'right_desc_1', 'type' => 'textarea', 'default_value' => 'Traninguri experiențiale, gamificate și livrate cu metode moderne potrivite pentru tineri și echipe care vor să treacă la următorul nivel.'),
                    array('key' => 'field_fp_dev_rt2', 'label' => 'Right Title 2', 'name' => 'right_title_2', 'type' => 'text', 'default_value' => 'MAIN QUEST'),
                    array('key' => 'field_fp_dev_rd2', 'label' => 'Right Description 2', 'name' => 'right_desc_2', 'type' => 'textarea', 'default_value' => 'Seria de traininguri principale, de o zi (8 ore) - un „must have" al abilităților și dezvoltării personale.'),
                    array('key' => 'field_fp_dev_root_t', 'label' => 'Root Title', 'name' => 'root_title', 'type' => 'text', 'default_value' => 'TRIAL'),
                    array('key' => 'field_fp_dev_root_d', 'label' => 'Root Description', 'name' => 'root_desc', 'type' => 'textarea', 'default_value' => 'Descoperă seria de MAIN QUESTS gratuit, fără niciun angajament.'),
                    // Cards repeater
                    array(
                        'key' => 'field_fp_dev_cards',
                        'label' => 'Cards',
                        'name' => 'cards',
                        'type' => 'repeater',
                        'min' => 1,
                        'max' => 10,
                        'layout' => 'block',
                        'sub_fields' => array(
                            array('key' => 'field_fp_dev_card_t', 'label' => 'Card Title', 'name' => 'card_title', 'type' => 'text'),
                            array('key' => 'field_fp_dev_card_d', 'label' => 'Card Description', 'name' => 'card_desc', 'type' => 'textarea'),
                        ),
                    ),
                    // Branch 0
                    array(
                        'key' => 'field_fp_dev_branch0',
                        'label' => 'Branch 0 - Dezvoltare Personală',
                        'name' => 'branch0',
                        'type' => 'group',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array('key' => 'field_fp_b0_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => 'DEZVOLTARE PERSONALĂ CONȘTIENTĂ'),
                            array(
                                'key' => 'field_fp_b0_nodes',
                                'label' => 'Nodes',
                                'name' => 'nodes',
                                'type' => 'repeater',
                                'min' => 1,
                                'max' => 10,
                                'layout' => 'table',
                                'sub_fields' => array(
                                    array('key' => 'field_fp_b0_node_t', 'label' => 'Title', 'name' => 'title', 'type' => 'text'),
                                    array('key' => 'field_fp_b0_node_d', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea'),
                                ),
                            ),
                        ),
                    ),
                    // Branch 1
                    array(
                        'key' => 'field_fp_dev_branch1',
                        'label' => 'Branch 1 - Leadership',
                        'name' => 'branch1',
                        'type' => 'group',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array('key' => 'field_fp_b1_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => 'LEADERSHIP'),
                            array(
                                'key' => 'field_fp_b1_nodes',
                                'label' => 'Nodes',
                                'name' => 'nodes',
                                'type' => 'repeater',
                                'min' => 1,
                                'max' => 10,
                                'layout' => 'table',
                                'sub_fields' => array(
                                    array('key' => 'field_fp_b1_node_t', 'label' => 'Title', 'name' => 'title', 'type' => 'text'),
                                    array('key' => 'field_fp_b1_node_d', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea'),
                                ),
                            ),
                        ),
                    ),
                    // Branch 2
                    array(
                        'key' => 'field_fp_dev_branch2',
                        'label' => 'Branch 2 - Comunicare',
                        'name' => 'branch2',
                        'type' => 'group',
                        'layout' => 'block',
                        'sub_fields' => array(
                            array('key' => 'field_fp_b2_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => 'COMUNICARE'),
                            array(
                                'key' => 'field_fp_b2_nodes',
                                'label' => 'Nodes',
                                'name' => 'nodes',
                                'type' => 'repeater',
                                'min' => 1,
                                'max' => 10,
                                'layout' => 'table',
                                'sub_fields' => array(
                                    array('key' => 'field_fp_b2_node_t', 'label' => 'Title', 'name' => 'title', 'type' => 'text'),
                                    array('key' => 'field_fp_b2_node_d', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea'),
                                ),
                            ),
                        ),
                    ),
                ),
            ),

            // ── IRL Gaming Section ──
            array(
                'key' => 'field_fp_irl_section',
                'label' => 'IRL Gaming Section',
                'name' => 'irl_gaming_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_fp_irl_sub', 'label' => 'Subtitle', 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Changing the Way We Play'),
                    array('key' => 'field_fp_irl_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'default_value' => 'Imaginează-ți un joc video scos din ecran și adus în lumea reală. Aducem jocurile video și atmosfera de film în realitate prin experiențe imersive, roluri, obiective, strategie și competiție. Intră într-o lume construită de la 0, ia decizii, colaborează, concurează și trăiește o experiență construită cu reguli clare, atmosferă și miză.'),
                ),
            ),

            // ── Journeys Section ──
            array(
                'key' => 'field_fp_journeys_section',
                'label' => 'Journeys Section',
                'name' => 'journeys_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_fp_jrn_sub', 'label' => 'Subtitle', 'name' => 'subtitle', 'type' => 'text', 'default_value' => 'Reshaping the Way We Travel'),
                    array('key' => 'field_fp_jrn_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'default_value' => 'Creăm universuri narative pentru experiențe educaționale, tabere și călătorii tematice. Construim povești, echipe, misiuni, provocări, artefacte, indicii și sisteme de joc care fac o drumeție, un team building sau o tabără să pară scris ca o poveste, fiecare element fiind integrat într-o singură viziune.'),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'front-page.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));

    // ═══════════════════════════════════════════════
    // FIELD GROUP 2: JOURNEYS PAGE (journeys.php)
    // ═══════════════════════════════════════════════
    acf_add_local_field_group(array(
        'key' => 'group_jrn_fields',
        'title' => 'Journeys Page Fields',
        'fields' => array(
            array('key' => 'field_jrn_hero_bg', 'label' => 'Hero Background Image', 'name' => 'journeys_hero_bg_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_jrn_hero_title', 'label' => 'Hero Title', 'name' => 'journeys_hero_title', 'type' => 'text', 'default_value' => 'JOURNEYS'),
            array('key' => 'field_jrn_hero_sub', 'label' => 'Hero Subtitle', 'name' => 'journeys_hero_subtitle', 'type' => 'text', 'default_value' => 'Redefinim felul in care calatorim'),
            array('key' => 'field_jrn_hero_desc', 'label' => 'Hero Description', 'name' => 'journeys_hero_description', 'type' => 'textarea', 'rows' => 4, 'default_value' => 'Prin excursii, taberele, retreaturi sau o escapadă la munte dedicate tinerilor. Construim experiențe gamificate, atent gândite și antrenante care facilitează atât explorarea, cât și descoperirea de sine și dezvoltarea personală. Nu doar ne plimbăm, ci trăim povești care ne cresc.'),
            array('key' => 'field_jrn_hero_btn_t', 'label' => 'Hero Button Text', 'name' => 'journeys_hero_button_text', 'type' => 'text', 'default_value' => 'Start Now'),
            array('key' => 'field_jrn_hero_btn_l', 'label' => 'Hero Button Link', 'name' => 'journeys_hero_button_link', 'type' => 'text', 'default_value' => '#lista-excursii'),
            array('key' => 'field_jrn_about_img', 'label' => 'About Image', 'name' => 'journeys_about_image', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_jrn_about_title', 'label' => 'About Title', 'name' => 'journeys_about_title', 'type' => 'text', 'default_value' => 'TABERE DE VARA'),
            array('key' => 'field_jrn_about_desc', 'label' => 'About Description', 'name' => 'journeys_about_description', 'type' => 'wysiwyg', 'media_upload' => 0, 'toolbar' => 'basic', 'default_value' => '<p>În spatele fiecărei tabere reușite se află o idee puternică. Noi suntem cei care o construiesc.</p><p>Mind Shows transformă taberele organizate de agențiile de turism în experiențe educaționale memorabile, prin concepte originale, scenarii imersive și design atent gândit. Creăm tematici care captivează, activități care dezvoltă și povești care leagă emoțional participanții de tot ceea ce trăiesc.</p>'),
            array('key' => 'field_jrn_list_title', 'label' => 'List Title', 'name' => 'journeys_list_title', 'type' => 'text', 'default_value' => 'TABERE DE VARA 2026'),
            array('key' => 'field_jrn_list_desc', 'label' => 'List Description', 'name' => 'journeys_list_description', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Povești unice create cu atenție de o echipă cu peste 10 ani de experiență în conceptualizarea și facilitarea de programe educaționale pentru tineri'),
            array('key' => 'field_jrn_card_btn', 'label' => 'Card Button Text', 'name' => 'journeys_card_button_text', 'type' => 'text', 'default_value' => 'Descopera'),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'journeys.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));

    // ═══════════════════════════════════════════════
    // FIELD GROUP 3: LASER TAG PAGE (page-lasertag.php)
    // ═══════════════════════════════════════════════
    // Helper to build keynote sub-groups
    $lt_kp_defaults = array(
        1 => array('Location', 'Costinești'),
        2 => array('Outdoor', 'Open-air arena'),
        3 => array('Arena size', '1,000 sqm'),
        4 => array('Players', 'Up to 14 players'),
        5 => array('Scenarios', 'Multiple game modes'),
    );
    $lt_kp_fields = array();
    foreach ($lt_kp_defaults as $n => $vals) {
        $lt_kp_fields[] = array(
            'key' => 'field_lt_kp' . $n,
            'label' => 'Keypoint ' . $n,
            'name' => 'kp' . $n,
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => array(
                array('key' => 'field_lt_kp' . $n . '_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => $vals[0]),
                array('key' => 'field_lt_kp' . $n . '_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text', 'default_value' => $vals[1]),
            ),
        );
    }

    // Helper to build mode sub-groups
    $lt_mode_defaults = array(
        1 => array('Battle Royale', 'Play solo, in pairs or in squads. Stay inside the shrinking safe zone and outlive everyone else.'),
        2 => array('Team vs Team', 'Work together, fight the enemy team and score more points before time runs out.'),
        3 => array('Last One Standing', 'Play solo or in squads, stay and be the last player standing.'),
        4 => array('Capture the Flag', 'Fight for the digital flag, protect your team and hold it longer than your opponents.'),
        5 => array('VIP Escort', 'One player becomes the VIP. Escort them safely across the arena while the enemy team tries to stop you.'),
        6 => array('And Many More', 'New scenarios and custom rules are added throughout the season, ask our game masters on the day.'),
    );
    $lt_mode_fields = array();
    foreach ($lt_mode_defaults as $n => $vals) {
        $lt_mode_fields[] = array(
            'key' => 'field_lt_mode' . $n,
            'label' => 'Mode ' . $n . ' - ' . $vals[0],
            'name' => 'mode' . $n,
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => array(
                array('key' => 'field_lt_mode' . $n . '_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => $vals[0]),
                array('key' => 'field_lt_mode' . $n . '_desc', 'label' => 'Description', 'name' => 'desc', 'type' => 'textarea', 'default_value' => $vals[1]),
            ),
        );
    }

    // Helper to build package sub-groups
    $lt_pkg_defaults = array(
        1 => array('rounds' => 1, 'tag' => 'A quick first mission.', 'price' => 39, 'unit' => 'LEI / player', 'badge' => '', 'benefits' => "1 laser tag round\nPerformance Paper included\nBriefing included\nAccess to the LUN.R Camping bar & lounge\nWater included\nRent or buy spare T-Shirt"),
        2 => array('rounds' => 2, 'tag' => 'More action. More strategy. More fun.', 'price' => 69, 'unit' => 'LEI / player', 'badge' => 'MOST POPULAR', 'benefits' => "2 laser tag rounds\n10-minute break between rounds\nPerformance Paper included\nBriefing included\nAccess to the LUN.R Camping bar & lounge\nWater included\nRent or buy spare T-Shirt"),
        3 => array('rounds' => 3, 'tag' => 'The full mission experience.', 'price' => 99, 'unit' => 'LEI / player', 'badge' => '', 'benefits' => "3 laser tag rounds\n10-minute break between rounds\nPerformance Paper included\nBriefing included\nAccess to the LUN.R Camping bar & lounge\nWater included\nRent or buy spare T-Shirt"),
    );
    $lt_pkg_fields = array();
    foreach ($lt_pkg_defaults as $n => $vals) {
        $lt_pkg_fields[] = array(
            'key' => 'field_lt_pkg' . $n,
            'label' => 'Package ' . $n,
            'name' => 'pkg' . $n,
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => array(
                array('key' => 'field_lt_pkg' . $n . '_rounds', 'label' => 'Rounds', 'name' => 'rounds', 'type' => 'number', 'min' => 1, 'default_value' => $vals['rounds']),
                array('key' => 'field_lt_pkg' . $n . '_tag', 'label' => 'Tag', 'name' => 'tag', 'type' => 'text', 'default_value' => $vals['tag']),
                array('key' => 'field_lt_pkg' . $n . '_price', 'label' => 'Price', 'name' => 'price', 'type' => 'number', 'default_value' => $vals['price']),
                array('key' => 'field_lt_pkg' . $n . '_unit', 'label' => 'Unit', 'name' => 'unit', 'type' => 'text', 'default_value' => $vals['unit']),
                array('key' => 'field_lt_pkg' . $n . '_badge', 'label' => 'Badge', 'name' => 'badge', 'type' => 'text', 'default_value' => $vals['badge']),
                array('key' => 'field_lt_pkg' . $n . '_benefits', 'label' => 'Benefits (one per line)', 'name' => 'benefits', 'type' => 'textarea', 'rows' => 8, 'default_value' => $vals['benefits']),
            ),
        );
    }

    // Helper to build discount panel sub-groups
    $lt_panel_defaults = array(
        1 => array('13%', 'For LUN.R Campers', 'Camping access bracelet required.'),
        2 => array('13%', 'Monday to Friday, 12-6 PM', 'Every Monday to Friday afternoon.'),
    );
    $lt_panel_fields = array();
    foreach ($lt_panel_defaults as $n => $vals) {
        $lt_panel_fields[] = array(
            'key' => 'field_lt_panel' . $n,
            'label' => 'Discount Panel ' . $n,
            'name' => 'panel' . $n,
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => array(
                array('key' => 'field_lt_panel' . $n . '_num', 'label' => 'Number', 'name' => 'num', 'type' => 'text', 'default_value' => $vals[0]),
                array('key' => 'field_lt_panel' . $n . '_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => $vals[1]),
                array('key' => 'field_lt_panel' . $n . '_note', 'label' => 'Note', 'name' => 'note', 'type' => 'text', 'default_value' => $vals[2]),
            ),
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_lt_fields',
        'title' => 'Laser Tag Page Fields',
        'fields' => array(
            // ── Hero Section ──
            array(
                'key' => 'field_lt_hero_section',
                'label' => 'Hero Section',
                'name' => 'lt_hero_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_lt_hero_bg', 'label' => 'Background Image', 'name' => 'bg_image', 'type' => 'image', 'return_format' => 'array'),
                    array('key' => 'field_lt_hero_eyebrow', 'label' => 'Eyebrow Text', 'name' => 'eyebrow', 'type' => 'text', 'default_value' => 'MIND SHOWS'),
                    array('key' => 'field_lt_hero_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => 'Laser Tag'),
                    array('key' => 'field_lt_hero_sub', 'label' => 'Subtitle', 'name' => 'subtitle', 'type' => 'textarea', 'default_value' => 'Experiece out outdoor las tag arena in Costinești, where real-life gaming modes meets the pulse of summer, located in LUN.R camping right next to Nibiru.'),
                    array('key' => 'field_lt_hero_btn1_t', 'label' => 'Primary Button Text', 'name' => 'btn_primary_text', 'type' => 'text', 'default_value' => 'Join the game now'),
                    array('key' => 'field_lt_hero_btn1_l', 'label' => 'Primary Button Link', 'name' => 'btn_primary_link', 'type' => 'text', 'default_value' => '#lt-booking'),
                    array('key' => 'field_lt_hero_btn2_t', 'label' => 'Outline Button Text', 'name' => 'btn_outline_text', 'type' => 'text', 'default_value' => 'Discover game modes'),
                    array('key' => 'field_lt_hero_btn2_l', 'label' => 'Outline Button Link', 'name' => 'btn_outline_link', 'type' => 'text', 'default_value' => '#lt-mission'),
                    array('key' => 'field_lt_hero_notice', 'label' => 'Notice Text', 'name' => 'notice_text', 'type' => 'textarea', 'default_value' => 'Limited time slots available. Booking in advance is recommended for groups.'),
                ),
            ),

            // ── Keynotes Section ──
            array(
                'key' => 'field_lt_keynotes_section',
                'label' => 'Keynotes Section',
                'name' => 'lt_keynotes_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => $lt_kp_fields,
            ),

            // ── About Section ──
            array(
                'key' => 'field_lt_about_section',
                'label' => 'About Section',
                'name' => 'lt_about_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_lt_about_day', 'label' => 'Day Image', 'name' => 'img_day', 'type' => 'image', 'return_format' => 'array'),
                    array('key' => 'field_lt_about_night', 'label' => 'Night Image', 'name' => 'img_night', 'type' => 'image', 'return_format' => 'array'),
                    array('key' => 'field_lt_about_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text', 'default_value' => 'Real-life shooter'),
                    array('key' => 'field_lt_about_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'More than a<br>regular activity'),
                    array('key' => 'field_lt_about_d1', 'label' => 'Paragraph 1', 'name' => 'desc_1', 'type' => 'textarea', 'default_value' => 'Join our outdoor laser tag experience in Costinești, created by Mind Shows for people who want more than a regular summer activity.'),
                    array('key' => 'field_lt_about_d2', 'label' => 'Paragraph 2', 'name' => 'desc_2', 'type' => 'textarea', 'default_value' => "By day, it's fast, social and full of summer energy. By night, it's intense, cinematic and built for adventure."),
                    array('key' => 'field_lt_about_badge', 'label' => 'Badge Text', 'name' => 'badge_text', 'type' => 'text', 'default_value' => 'BUILT FOR ADRENALINE. DESIGNED FOR TEAMWORK. MADE FOR SUMMER NIGHTS.'),
                ),
            ),

            // ── Mission Section ──
            array(
                'key' => 'field_lt_mission_section',
                'label' => 'Mission Section',
                'name' => 'lt_mission_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array_merge(
                    array(
                        array('key' => 'field_lt_mission_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text', 'default_value' => 'Game modes'),
                        array('key' => 'field_lt_mission_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => 'Choose your mission'),
                    ),
                    $lt_mode_fields,
                    array(
                        array('key' => 'field_lt_mission_summary', 'label' => 'Summary', 'name' => 'summary', 'type' => 'textarea', 'default_value' => 'Every game mode brings a different way to play, think and win with your squad. Change your strategy and try new game modes every round.'),
                    )
                ),
            ),

            // ── Packages Section ──
            array(
                'key' => 'field_lt_packages_section',
                'label' => 'Packages Section',
                'name' => 'lt_packages_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array_merge(
                    array(
                        array('key' => 'field_lt_pkg_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text', 'default_value' => 'Packages'),
                        array('key' => 'field_lt_pkg_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => 'Choose your game package'),
                        array('key' => 'field_lt_pkg_sub', 'label' => 'Subtitle', 'name' => 'subtitle', 'type' => 'textarea', 'default_value' => 'One round gets you into the game. More rounds unlock the full experience.'),
                        array('key' => 'field_lt_pkg_slot_dur', 'label' => 'Slot Duration (minutes)', 'name' => 'slot_duration_minutes', 'type' => 'number', 'min' => 1, 'default_value' => 30),
                        array('key' => 'field_lt_pkg_cta', 'label' => 'CTA Button Text', 'name' => 'cta_text', 'type' => 'text', 'default_value' => 'Join the game'),
                    ),
                    $lt_pkg_fields
                ),
            ),

            // ── Discounts Section ──
            array(
                'key' => 'field_lt_discounts_section',
                'label' => 'Discounts Section',
                'name' => 'lt_discounts_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array_merge(
                    array(
                        array('key' => 'field_lt_disc_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text', 'default_value' => 'Discounts'),
                        array('key' => 'field_lt_disc_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => 'Stack your savings'),
                        array('key' => 'field_lt_disc_subh', 'label' => 'Sub-heading', 'name' => 'sub_heading', 'type' => 'text', 'default_value' => 'Yep, the discounts stack!'),
                    ),
                    $lt_panel_fields
                ),
            ),

            // ── Booking Section ──
            array(
                'key' => 'field_lt_booking_section',
                'label' => 'Booking Section',
                'name' => 'lt_booking_section',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array('key' => 'field_lt_book_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text', 'default_value' => 'Book your session'),
                    array('key' => 'field_lt_book_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'default_value' => 'Reserve your spot'),
                    array('key' => 'field_lt_book_sub1', 'label' => 'Subtitle 1', 'name' => 'sub_1', 'type' => 'textarea', 'default_value' => "Choose your package, pick a date with open slots, select a time and tell us who's coming."),
                    array('key' => 'field_lt_book_sub2', 'label' => 'Subtitle 2', 'name' => 'sub_2', 'type' => 'textarea', 'default_value' => 'You can find us inside LUN.R Camping, the official camping of Beach, Please! and Nibiru, at Strada Emil Costinescu 67, Costinești.'),
                    array('key' => 'field_lt_book_dir_t', 'label' => 'Directions Text', 'name' => 'directions_text', 'type' => 'text', 'default_value' => 'Get directions'),
                    array('key' => 'field_lt_book_dir_l', 'label' => 'Directions Link', 'name' => 'directions_link', 'type' => 'text', 'default_value' => 'https://maps.app.goo.gl/8oh4P3cJqsfUxjD7A'),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-lasertag.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
}
