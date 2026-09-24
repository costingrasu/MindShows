<?php

status_header(404);
nocache_headers();

$mindshows_front_id = (int) get_option('page_on_front');
if ($mindshows_front_id) {
    $GLOBALS['post'] = get_post($mindshows_front_id);
    setup_postdata($GLOBALS['post']);
}

require get_template_directory() . '/front-page.php';
