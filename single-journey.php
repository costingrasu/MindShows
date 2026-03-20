<?php get_header(); ?>

<?php 
while ( have_posts() ) : the_post(); 
    $hero_logo = function_exists('get_field') ? get_field('hero_logo') : null;
    $font_choice = function_exists('get_field') ? get_field('hero_title_font') : "'Brother 1816', 'Outfit', sans-serif";
    if ( function_exists('get_field') ) {
        if ( get_field('custom_color_1') ) { $c1 = get_field('custom_color_1'); }
        if ( get_field('custom_color_2') ) { $c2 = get_field('custom_color_2'); }
        if ( get_field('custom_color_3') ) { $c3 = get_field('custom_color_3'); }
        if ( get_field('custom_color_4') ) { $c4 = get_field('custom_color_4'); }
        if ( get_field('custom_color_5') ) { $c5 = get_field('custom_color_5'); }
    }
    $hero_image = function_exists('get_field') ? get_field('hero_background_image') : null;
    $hero_image_url = $hero_image ? $hero_image['url'] : '';
    $hero_subtitle = function_exists('get_field') ? get_field('hero_subtitle') : '';
    $hero_description = function_exists('get_field') ? get_field('hero_description') : '';
    $hero_top_subtitle = function_exists('get_field') ? get_field('hero_top_subtitle') : '';

    $kp_icon = function_exists('get_field') ? get_field('keypoints_icon') : null;
    $raw_keypoints = [
        function_exists('get_field') ? get_field('kp_1') : null,
        function_exists('get_field') ? get_field('kp_2') : null,
        function_exists('get_field') ? get_field('kp_3') : null,
        function_exists('get_field') ? get_field('kp_4') : null,
    ];
    $kp_defaults = [
        ['title' => 'Title', 'description' => 'Description'],
        ['title' => 'Title', 'description' => 'Description'],
        ['title' => 'Title', 'description' => 'Description'],
        ['title' => 'Title', 'description' => 'Description'],
    ];
    $final_keypoints = [];
    foreach($raw_keypoints as $index => $kp_data) {
        if ($kp_data && !empty($kp_data['title'])) { $final_keypoints[] = $kp_data; } 
        else { $final_keypoints[] = $kp_defaults[$index]; }
    }

    $contact_title = function_exists('get_field') ? get_field('contact_title') : 'Title';
    
    $packages = [];
    for($i = 1; $i <= 3; $i++) {
        $grp = function_exists('get_field') ? get_field('package_' . $i) : null;
        
        $default_persons = $i; 
        $default_price = ($i * 1000) + 500;
        
        $bg_img_url = '';
        if ($grp && !empty($grp['bg_image'])) {
            if (is_array($grp['bg_image']) && isset($grp['bg_image']['url'])) {
                $bg_img_url = $grp['bg_image']['url'];
            } elseif (is_string($grp['bg_image'])) {
                $bg_img_url = $grp['bg_image'];
            } elseif (is_numeric($grp['bg_image'])) {
                $bg_img_url = wp_get_attachment_image_url($grp['bg_image'], 'full');
            }
        }
        
        $packages[] = [
            'id'       => $i,
            'persons'  => $grp ? $grp['persons'] : $default_persons,
            'benefits' => $grp ? $grp['benefits'] : '',
            'price'    => $grp ? $grp['price'] : $default_price,
            'bg_image' => $bg_img_url,
        ];
    }
    
    $cf7_shortcode = '[contact-form-7 id="27c1c4f" title="Journey Contact"]'; 

    $banner_desktop = function_exists('get_field') ? get_field('banner_image_desktop') : null;
    $banner_mobile  = function_exists('get_field') ? get_field('banner_image_mobile') : null;

    $bg_desktop_url = $banner_desktop ? $banner_desktop['url'] : '';
    $bg_mobile_url  = $banner_mobile ? $banner_mobile['url'] : $bg_desktop_url;

    $obiective_title_text = function_exists('get_field') ? get_field('obiective_section_title') : '';
    $display_obiective_title = $obiective_title_text ? $obiective_title_text : 'Title';
    $obiective_icon = function_exists('get_field') ? get_field('obiective_shared_icon') : null;
    $obiective_icon_url = $obiective_icon ? $obiective_icon['url'] : '';
    $obiective_text_bottom = function_exists('get_field') ? get_field('obiective_bottom_text') : 'Description';

    $obiective_items = [];
    for ($i = 1; $i <= 6; $i++) {
        $obj_data = function_exists('get_field') ? get_field('obiectiv_' . $i) : null;
        $obiective_items[] = [
            'title' => $obj_data ? $obj_data['title'] : 'Title',
            'desc'  => $obj_data ? $obj_data['description'] : 'Decription',
        ];
    }

    $unic_title_text = function_exists('get_field') ? get_field('unic_section_title') : '';
    $display_unic_title = $unic_title_text ? $unic_title_text : 'Title';

    $unic_cards = [];
    
    $fallback_images = [
        'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=800&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1615672965998-1e0892095cc1?q=80&w=800&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=800&auto=format&fit=crop'
    ];

    for ($i = 1; $i <= 3; $i++) {
        $card_data = function_exists('get_field') ? get_field('unic_card_' . $i) : null;
        
        $img_url = '';
        
        if ($card_data && !empty($card_data['image'])) {
            if (is_array($card_data['image']) && isset($card_data['image']['url'])) {
                $img_url = $card_data['image']['url'];
            } 

            elseif (is_string($card_data['image'])) {
                $img_url = $card_data['image'];
            } 

            elseif (is_numeric($card_data['image'])) {
                $img_url = wp_get_attachment_image_url($card_data['image'], 'full');
            }
        }
        

        if (empty($img_url)) {
            $img_url = $fallback_images[$i - 1];
        }

        $unic_cards[] = [
            'image' => $img_url, 
            'title' => ($card_data && !empty($card_data['title'])) ? $card_data['title'] : 'Title ' . $i,
            'desc'  => ($card_data && !empty($card_data['description'])) ? $card_data['description'] : 'Description',
        ];
    }

    $info_title = function_exists('get_field') ? get_field('info_section_title') : '';


    $info_rows = [];
    for ($i = 1; $i <= 2; $i++) {
        $row_data = function_exists('get_field') ? get_field('info_row_' . $i) : null;
        
        $img_url = '';
        if ($row_data && !empty($row_data['image'])) {
            if (is_array($row_data['image']) && isset($row_data['image']['url'])) {
                $img_url = $row_data['image']['url'];
            } elseif (is_string($row_data['image'])) {
                $img_url = $row_data['image'];
            } elseif (is_numeric($row_data['image'])) {
                $img_url = wp_get_attachment_image_url($row_data['image'], 'full');
            }
        }
        

        if (empty($img_url)) {
            $img_url = 'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=800&auto=format&fit=crop';
        }

        $info_rows[] = [
            'image' => $img_url, 
            'desc'  => ($row_data && !empty($row_data['description'])) ? $row_data['description'] : 'Decription',
        ];
    }

    $bucuram_title = function_exists('get_field') ? get_field('ne_bucuram_title') : '';
    

    $bucuram_tabs = [];
    for ($i = 1; $i <= 3; $i++) {
        $tab_data = function_exists('get_field') ? get_field('ne_bucuram_tab_' . $i) : null;
        
        $img_url = '';
        if ($tab_data && !empty($tab_data['image'])) {
            if (is_array($tab_data['image']) && isset($tab_data['image']['url'])) {
                $img_url = $tab_data['image']['url'];
            } elseif (is_string($tab_data['image'])) {
                $img_url = $tab_data['image'];
            } elseif (is_numeric($tab_data['image'])) {
                $img_url = wp_get_attachment_image_url($tab_data['image'], 'full');
            }
        }
        

        if (empty($img_url)) {
            $img_url = 'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=800&auto=format&fit=crop';
        }

        $bucuram_tabs[] = [
            'id'    => 'bucuram-tab-' . $i,
            'name'  => ($tab_data && !empty($tab_data['tab_name'])) ? $tab_data['tab_name'] : 'TAB ' . $i,
            'image' => $img_url,
            'desc'  => ($tab_data && !empty($tab_data['description'])) ? $tab_data['description'] : 'Description',
        ];
    }

    $oferta_title = function_exists('get_field') ? get_field('oferta_section_title') : '';
    

    $oferta_items = [];
    for ($i = 1; $i <= 7; $i++) {
        $item_data = function_exists('get_field') ? get_field('oferta_item_' . $i) : null;
        $oferta_items[] = [
            'title' => ($item_data && !empty($item_data['title'])) ? $item_data['title'] : 'Title',
            'desc'  => ($item_data && !empty($item_data['description'])) ? $item_data['description'] : 'Description',
        ];
    }

    $dispo_title = function_exists('get_field') ? get_field('disponibilitate_title') : 'Title';
    
    $dispo_image_data = function_exists('get_field') ? get_field('disponibilitate_image') : null;
    $dispo_img_url = 'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=800&auto=format&fit=crop';
    if ($dispo_image_data) {
        if (is_array($dispo_image_data) && isset($dispo_image_data['url'])) {
            $dispo_img_url = $dispo_image_data['url'];
        } elseif (is_string($dispo_image_data)) {
            $dispo_img_url = $dispo_image_data;
        } elseif (is_numeric($dispo_image_data)) {
            $dispo_img_url = wp_get_attachment_image_url($dispo_image_data, 'full');
        }
    }

    $raw_series_text = function_exists('get_field') ? get_field('camp_series_list') : '';
    $parsed_series = [];
    
    if($raw_series_text) {
        $lines = explode("\n", $raw_series_text);
        foreach($lines as $line) {
            $line = trim($line);
            if(empty($line)) continue;

            $parts = explode('|', $line);
            $name = trim($parts[0]);
            
            $occupied = 0;
            $total = 1;
            
            if(count($parts) > 1) {
                $capacity_str = trim($parts[1]);
                $cap_parts = explode('/', $capacity_str);
                if(count($cap_parts) == 2) {
                    $occupied = intval(trim($cap_parts[0]));
                    $total = intval(trim($cap_parts[1]));
                }
            }

            if($total <= 0) $total = 1; 
            $percent = ($occupied / $total) * 100;
            if($percent > 100) $percent = 100;

            if ($percent < 50) {
                $color = '#90FB8A';
            } elseif ($percent < 85) {
                $color = '#FBE18A';
            } elseif ($percent < 100) {
                $color = '#FF4F4F';
            } else {
                $color = '#6F7482';
            }

            $parsed_series[] = [
                'name'    => $name,
                'percent' => $percent,
                'color'   => $color
            ];
        }
    }

    $show_gallery = function_exists('get_field') ? get_field('show_gallery_section') : false;
    $gal_title = function_exists('get_field') ? get_field('gallery_title') : '';
    $gal_desc = function_exists('get_field') ? get_field('gallery_description') : '';
    $gal_images = function_exists('get_field') ? get_field('gallery_images') : null;

    $show_program = function_exists('get_field') ? get_field('show_program_section') : false;
    $prog_title = function_exists('get_field') ? get_field('program_title') : '';
    $prog_images = function_exists('get_field') ? get_field('program_images') : null;

    $show_excursii = function_exists('get_field') ? get_field('show_excursii_section') : false;
    $excursii_title = function_exists('get_field') ? get_field('excursii_title') : '';
    $excursii_main_image = function_exists('get_field') ? get_field('excursii_main_image') : null;
    $excursii_mobile_image = function_exists('get_field') ? get_field('excursii_mobile_image') : null;

    $excursii_cards = [];
    for ($i = 1; $i <= 3; $i++) {
        $card_data = function_exists('get_field') ? get_field('excursii_card_' . $i) : null;
        $img_url = '';
        
        if ($card_data && !empty($card_data['image'])) {
            if (is_array($card_data['image']) && isset($card_data['image']['url'])) {
                $img_url = $card_data['image']['url'];
            } elseif (is_string($card_data['image'])) {
                $img_url = $card_data['image'];
            } elseif (is_numeric($card_data['image'])) {
                $img_url = wp_get_attachment_image_url($card_data['image'], 'full');
            }
        }
        
        $excursii_cards[] = [
            'image' => $img_url,
            'title' => ($card_data && !empty($card_data['title'])) ? $card_data['title'] : '',
            'desc'  => ($card_data && !empty($card_data['description'])) ? $card_data['description'] : '',
        ];
    }
?>

    <style>
        :root {
            --title-font: <?php echo $font_choice; ?>;
            --c1: <?php echo esc_attr($c1); ?>;
            --c2: <?php echo esc_attr($c2); ?>;
            --c3: <?php echo esc_attr($c3); ?>;
            --c4: <?php echo esc_attr($c4); ?>;
            --c5: <?php echo esc_attr($c5); ?>;
        }
    </style>

    <div class="journey-hero-wrapper">
        <div class="hero-title-component">
            <div class="hero-main-heading-row">
                <?php if( !empty($hero_logo) ): ?>
                    <div class="hero-logo-icon"><img src="<?php echo esc_url($hero_logo['url']); ?>" alt="Hero Logo" /></div>
                <?php endif; ?>
                <h1 class="hero-dynamic-title"><?php the_title(); ?></h1>
            </div>
            
            <?php if($hero_top_subtitle): ?>
                <h2 class="hero-top-subtitle"><?php echo esc_html($hero_top_subtitle); ?></h2>
            <?php endif; ?>
        </div>
        <?php if($hero_image_url): ?>
            <div class="hero-image-component" style="--hero-bg: url('<?php echo esc_url($hero_image_url); ?>');"></div>
        <?php endif; ?>
        <div class="hero-content-block">
            <?php if($hero_subtitle): ?><h2 class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></h2><?php endif; ?>
            <?php if($hero_description): ?><p class="hero-description"><?php echo wp_kses_post($hero_description); ?></p><?php endif; ?>
            <a href="#signup" class="hero-cta-btn">Pachete Disponibile</a>
        </div>
    </div>

    <div class="keypoints-section">
        <div class="keypoints-container">
            <?php $delay = 0; foreach($final_keypoints as $kp): $delay += 0.2; ?>
                <div class="keypoint-card" style="--anim-delay: <?php echo $delay; ?>s">
                    <div class="kp-icon">
                        <?php if($kp_icon): ?><img src="<?php echo esc_url($kp_icon['url']); ?>" alt="Icon"><?php else: ?>
                            <svg width="88" height="88" viewBox="0 0 88 88" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M44 0L56 32L88 44L56 56L44 88L32 56L0 44L32 32L44 0Z" fill="white"/><circle cx="44" cy="44" r="30" stroke="white" stroke-width="1"/></svg>
                        <?php endif; ?>
                    </div>
                    <h3 class="kp-title"><?php echo esc_html($kp['title']); ?></h3>
                    <p class="kp-desc"><?php echo wp_kses_post($kp['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if($bg_desktop_url): ?>
    <div class="journey-banner-wrapper">
        <img src="<?php echo esc_url($bg_desktop_url); ?>" alt="Journey Banner Desktop" class="banner-img-desktop" />
        
        <?php if($bg_mobile_url): ?>
            <img src="<?php echo esc_url($bg_mobile_url); ?>" alt="Journey Banner Mobile" class="banner-img-mobile" />
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="obiective-section">
        <h2 class="obiective-title"><?php echo esc_html($display_obiective_title); ?></h2>
        
        <div class="obiective-cards-container">
            <?php foreach ($obiective_items as $index => $obj): ?>
            <div class="obiectiv-card">
                <div class="obiectiv-header-visible">
                    <div class="obiectiv-icon">
                        <?php if ($obiective_icon_url): ?>
                            <img src="<?php echo esc_url($obiective_icon_url); ?>" alt="Obiectiv Icon">
                        <?php else: ?>
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 4V38M8 12L34 30M8 30L34 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <?php endif; ?>
                    </div>
                    
                    <div class="obiectiv-title-wrapper">
                        <h3 class="obiectiv-card-title"><?php echo esc_html($obj['title']); ?></h3>
                    </div>

                    <div class="obiectiv-expand-icon">
                        <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.707092 0.707032L8.70709 8.70703L16.7071 0.707031" stroke="#BDBDBD" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                
                <div class="obiectiv-body-hidden">
                    <p class="obiectiv-desc"><?php echo wp_kses_post($obj['desc']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php if($obiective_text_bottom): ?>
            <p class="obiective-bottom-text"><?php echo wp_kses_post($obiective_text_bottom); ?></p>
        <?php endif; ?>
    </div>

    <div class="unic-section">
        <h2 class="unic-title"><?php echo esc_html($display_unic_title); ?></h2>
        
        <div class="unic-cards-container">
            <?php foreach($unic_cards as $card): ?>
                <div class="unic-card">
                    <div class="unic-card-bg" style="background-image: linear-gradient(180deg, rgba(21, 20, 23, 0) 40%, #151417 96.69%), url('<?php echo esc_url($card['image']); ?>');"></div>
                    
                    <div class="unic-card-content">
                        <h3 class="unic-card-title"><?php echo esc_html($card['title']); ?></h3>
                        <p class="unic-card-desc"><?php echo wp_kses_post($card['desc']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ($show_gallery): ?>
    <div class="gallery-section">
        <?php if($gal_title): ?>
            <h2 class="gallery-title"><?php echo esc_html($gal_title); ?></h2>
        <?php endif; ?>
        
        <?php if($gal_desc): ?>
            <p class="gallery-desc"><?php echo wp_kses_post($gal_desc); ?></p>
        <?php endif; ?>

        <?php if($gal_images && is_array($gal_images)): ?>
        <div class="gallery-carousel-wrapper">
            <div class="gallery-track">
                <?php foreach( $gal_images as $index => $image ): ?>
                    <div class="gallery-slide" data-index="<?php echo $index; ?>">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="gallery-controls">
                <button class="gallery-nav-btn prev-btn" aria-label="Previous image">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="Arrow Left">
                        <path id="Vector 10" d="M16.5 3L7.5 12L16.5 21" stroke="#BDBDBD" stroke-width="2"/>
                        </g>
                    </svg>
                </button>
                <div class="gallery-dots">
                    <?php foreach( $gal_images as $index => $image ): ?>
                        <div class="gallery-dot" data-index="<?php echo $index; ?>"></div>
                    <?php endforeach; ?>
                </div>
                <button class="gallery-nav-btn next-btn" aria-label="Next image">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="Arrow Right">
                        <path id="Vector 10" d="M7.5 21L16.5 12L7.5 3" stroke="#BDBDBD" stroke-width="2"/>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="info-section">
        <?php if(!empty($info_title)): ?>
            <h2 class="info-section-title"><?php echo esc_html($info_title); ?></h2>
        <?php endif; ?>
        
        <div class="info-rows-container">
            <?php foreach($info_rows as $index => $row): 
                $row_layout_class = ($index === 0) ? 'info-row-reverse' : 'info-row-normal';
            ?>
                <div class="info-row <?php echo $row_layout_class; ?>">
                    
                    <div class="info-image">
                        <img src="<?php echo esc_url($row['image']); ?>" alt="Info Layout Image">
                    </div>
                    
                    <div class="info-text-content">
                        <p class="info-row-desc"><?php echo wp_kses_post($row['desc']); ?></p>
                    </div>
                    
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="bucuram-section">
        <?php if(!empty($bucuram_title)): ?>
            <h2 class="bucuram-title"><?php echo esc_html($bucuram_title); ?></h2>
        <?php endif; ?>

        <div class="bucuram-pills-wrapper">
            <?php foreach($bucuram_tabs as $index => $tab): ?>
                <div class="tab-pill <?php echo ($index === 0) ? 'active' : ''; ?>" data-target="<?php echo esc_attr($tab['id']); ?>">
                    <span class="pill-text"><?php echo esc_html($tab['name']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bucuram-content-container">
            <?php foreach($bucuram_tabs as $index => $tab): ?>
                <div class="bucuram-content-state <?php echo ($index === 0) ? 'active' : ''; ?>" id="<?php echo esc_attr($tab['id']); ?>">
                    <div class="bucuram-image">
                        <img src="<?php echo esc_url($tab['image']); ?>" alt="<?php echo esc_attr($tab['name']); ?>">
                    </div>
                    <p class="bucuram-desc"><?php echo wp_kses_post($tab['desc']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="oferta-section">
        <?php if(!empty($oferta_title)): ?>
            <h2 class="oferta-title"><?php echo esc_html($oferta_title); ?></h2>
        <?php endif; ?>

        <div class="oferta-container">
            <div class="oferta-grid">
                <?php for($i = 0; $i < 6; $i++): $item = $oferta_items[$i]; ?>
                    <div class="oferta-card">
                        <div class="oferta-header-visible">
                            <h3 class="oferta-card-title"><?php echo esc_html($item['title']); ?></h3>
                            <div class="oferta-expand-icon">
                                <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.707092 0.707032L8.70709 8.70703L16.7071 0.707031" stroke="#BDBDBD" stroke-width="2"/>
                                </svg>
                            </div>
                        </div>
                        <div class="oferta-body-hidden">
                            <p class="oferta-desc"><?php echo wp_kses_post($item['desc']); ?></p>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <?php $last_item = $oferta_items[6]; ?>
            <div class="oferta-card oferta-card-large">
                <div class="oferta-header-visible">
                    <h3 class="oferta-card-title"><?php echo esc_html($last_item['title']); ?></h3>
                    <div class="oferta-expand-icon">
                        <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.707092 0.707032L8.70709 8.70703L16.7071 0.707031" stroke="#BDBDBD" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                <div class="oferta-body-hidden">
                    <p class="oferta-desc"><?php echo wp_kses_post($last_item['desc']); ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php if ($show_excursii): ?>
    <div class="excursii-section">
        <?php if($excursii_title): ?>
            <h2 class="excursii-title"><?php echo esc_html($excursii_title); ?></h2>
        <?php endif; ?>
        
        <div class="excursii-content-wrapper">
            <?php if($excursii_main_image || $excursii_mobile_image): ?>
                <div class="excursii-main-img-wrapper">
                    
                    <?php if($excursii_main_image): 
                        $main_img_url = is_array($excursii_main_image) ? $excursii_main_image['url'] : (is_string($excursii_main_image) ? $excursii_main_image : wp_get_attachment_image_url($excursii_main_image, 'full'));
                    ?>
                        <img src="<?php echo esc_url($main_img_url); ?>" alt="Excursii Decor Desktop" class="excursii-main-img excursii-img-desktop" />
                    <?php endif; ?>
                    
                    <?php if($excursii_mobile_image): 
                        $mob_img_url = is_array($excursii_mobile_image) ? $excursii_mobile_image['url'] : (is_string($excursii_mobile_image) ? $excursii_mobile_image : wp_get_attachment_image_url($excursii_mobile_image, 'full'));
                    ?>
                        <img src="<?php echo esc_url($mob_img_url); ?>" alt="Excursii Decor Mobile" class="excursii-main-img excursii-img-mobile" />
                    <?php endif; ?>

                </div>
            <?php endif; ?>
            
            <div class="excursii-cards-container">
                <?php foreach($excursii_cards as $card): ?>
                    <div class="excursii-card">
                        <?php if($card['image']): ?>
                            <div class="excursii-card-img-wrapper">
                                <img src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <div class="excursii-card-text">
                            <?php if($card['title']): ?>
                                <h3 class="excursii-card-title"><?php echo esc_html($card['title']); ?></h3>
                            <?php endif; ?>
                            <?php if($card['desc']): ?>
                                <p class="excursii-card-desc"><?php echo wp_kses_post($card['desc']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($show_program): ?>
    <div class="program-section">
        <?php if($prog_title): ?>
            <h2 class="program-title"><?php echo esc_html($prog_title); ?></h2>
        <?php endif; ?>

        <?php if($prog_images && is_array($prog_images)): ?>
        <div class="program-carousel-wrapper">
            <div class="program-track">
                <?php foreach( $prog_images as $index => $image ): ?>
                    <div class="program-slide" data-index="<?php echo $index; ?>">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="program-controls">
                <button class="program-nav-btn prev-btn" aria-label="Previous image">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="Arrow Left">
                        <path id="Vector 10" d="M16.5 3L7.5 12L16.5 21" stroke="#BDBDBD" stroke-width="2"/>
                        </g>
                    </svg>
                </button>
                <div class="program-dots">
                    <?php foreach( $prog_images as $index => $image ): ?>
                        <div class="program-dot" data-index="<?php echo $index; ?>"></div>
                    <?php endforeach; ?>
                </div>
                <button class="program-nav-btn next-btn" aria-label="Next image">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="Arrow Right">
                        <path id="Vector 10" d="M7.5 21L16.5 12L7.5 3" stroke="#BDBDBD" stroke-width="2"/>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="dispo-section">
        <?php if(!empty($dispo_title)): ?>
            <h2 class="dispo-title"><?php echo esc_html($dispo_title); ?></h2>
        <?php endif; ?>

        <div class="dispo-container">
            <div class="dispo-image-wrapper">
                <img src="<?php echo esc_url($dispo_img_url); ?>" alt="Disponibilitate Image">
            </div>

            <div class="dispo-list-wrapper">
                <?php if(!empty($parsed_series)): ?>
                    <div class="dispo-items-list">
                        <?php foreach($parsed_series as $serie): ?>
                            <div class="dispo-item">
                                <div class="dispo-item-name"><?php echo esc_html($serie['name']); ?></div>
                                <div class="dispo-bar-track">
                                    <div class="dispo-bar-fill" style="width: <?php echo esc_attr($serie['percent']); ?>%; background-color: <?php echo esc_attr($serie['color']); ?>;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p style="color: #fff; text-align:center;">Nu sunt serii adăugate momentan.</p>
                <?php endif; ?>

                <div class="dispo-last-updated">
                    Lista Actualizata Ultima Oara pe <?php echo get_the_modified_date('d.m.Y, H:i'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-section-wrapper" id="signup">
        <div class="contact-inner">
            
            <h2 class="contact-title"><?php echo esc_html($contact_title); ?></h2>

            <div class="package-selector-pills">
                <?php foreach($packages as $index => $pkg): 
                    $count = intval($pkg['persons']);
                    $label = ($count === 1) ? 'PERSOANA' : 'PERSOANE'; 
                    $full_text = $count . ' ' . $label;
                    $active_class = ($index === 0) ? 'active' : '';
                ?>
                <div class="pkg-pill <?php echo $active_class; ?>" 
                     data-target="package-<?php echo $pkg['id']; ?>"
                     data-value="<?php echo esc_attr($full_text . ' - ' . $pkg['price'] . ' RON'); ?>">
                    <span class="pill-text"><?php echo $full_text; ?></span>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="contact-content-row">
                
                <div class="cards-wrapper-left">
                    <?php foreach($packages as $index => $pkg): 
                        $active_class = ($index === 0) ? 'active' : '';
                        $count = intval($pkg['persons']);
                        $label = ($count === 1) ? 'PERSOANA' : 'PERSOANE';
                        $display_title = $count . ' ' . $label; 
                    ?>
                    
                    <div class="package-info-card <?php echo $active_class; ?>" id="package-<?php echo $pkg['id']; ?>">
                        
                        <div class="card-bg-image" style="--card-bg: url('<?php echo esc_url($pkg['bg_image']); ?>');"></div>
                        
                        <div class="card-content-inner">
                            <h3 class="card-title"><?php echo esc_html($display_title); ?></h3>
                            
                            <div class="card-icons-row">
                                <?php for($p=0; $p < $count; $p++): ?>
                                    <svg width="25" height="29" viewBox="0 0 25 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <ellipse cx="12.5" cy="7.22222" rx="6.94444" ry="7.22222" fill="white"/>
                                        <path d="M1.65345 20.276C2.65534 17.6154 5.31907 16.1113 8.1621 16.1113H16.8379C19.6809 16.1113 22.3447 17.6154 23.3466 20.276C24.096 22.2663 24.8142 24.7707 24.9693 27.3341C25.0026 27.8853 24.5523 28.3336 24 28.3336H1C0.447716 28.3336 -0.00259643 27.8853 0.0307474 27.3341C0.185794 24.7707 0.903999 22.2663 1.65345 20.276Z" fill="white"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>

                            <div class="card-divider"></div>

                            <div class="card-benefits-list">
                                <?php 
                                if($pkg['benefits']):
                                    $lines = explode("\n", $pkg['benefits']);
                                    foreach($lines as $line):
                                        $line = trim($line);
                                        if(empty($line)) continue;
                                        
                                        $status = substr($line, 0, 1); 
                                        $text = substr($line, 1); 
                                ?>
                                    <div class="card-benefit-row">
                                        <div class="benefit-mark">
                                            <?php if($status == '1'): ?>
                                                <svg width="24" height="21" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.599995 13.9666L7.26666 18.9666L22.2667 0.633301" stroke="#C5C5C5" stroke-width="2"/>
                                                </svg>
                                            <?php else: ?>
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18.7071 0.707031L0.707106 18.707" stroke="#494949" stroke-width="2"/>
                                                    <path d="M18.7071 18.707L0.707106 0.70703" stroke="#494949" stroke-width="2"/>
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                        <span class="card-benefit-text"><?php echo wp_kses_post($text); ?></span>
                                    </div>
                                <?php endforeach; endif; ?>
                            </div>

                            <div class="card-divider"></div>

                            <div class="card-price">
                                <?php echo $pkg['price']; ?> RON/participant
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="contact-form-container">
                    <h3 class="form-section-title">INSCRIE-TE ACUM</h3>
                    
                    <?php 
                    $series_text = get_field('camp_series_list');
                    $series_array = array();
                    if($series_text) {
                        $lines = explode("\n", $series_text);
                        foreach($lines as $line) {
                            $line = trim($line);
                            if(!empty($line)) {
                                $series_array[] = $line;
                            }
                        }
                    }

                    $dropdown_packages = [];
                    foreach ($packages as $pkg) {
                        $count = intval($pkg['persons']);
                        $label = ($count === 1) ? 'PERSOANA' : 'PERSOANE';
                        $dropdown_packages[] = $count . ' ' . $label;
                    }
                    ?>
                    <div id="acf-package-data" data-packages='<?php echo esc_attr(json_encode($dropdown_packages)); ?>' style="display:none;"></div>
                    
                    <div id="acf-camp-series-data" data-series='<?php echo esc_attr(json_encode($series_array)); ?>' style="display:none;"></div>

                    <?php echo do_shortcode($cf7_shortcode); ?>
                </div>

            </div>
        </div>
    </div>

    <div class="container"><div class="content"><?php the_content(); ?></div></div>

<?php endwhile; ?>
<?php get_footer(); ?>