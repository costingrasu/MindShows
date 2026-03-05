<?php
$args = array(
    'post_type'      => 'journey',
    'posts_per_page' => 1,
    'post_status'    => 'publish'
);
$journey_query = new WP_Query($args);

if ( $journey_query->have_posts() ) {
    global $wp_query;
    $wp_query = $journey_query;
    
    require_once get_template_directory() . '/single-journey.php';
    
    wp_reset_postdata();
} else {
    get_header();
    echo '<div style="text-align:center; padding: 100px 20px; color: #fff;"><h2>Site în constructie. Nu exista niciun pachet adaugat.</h2></div>';
    get_footer();
}
?>