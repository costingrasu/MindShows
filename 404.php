<?php
/**
 * 404 Template - Automatically redirects all non-existing routes to Homepage
 */

wp_safe_redirect( home_url('/'), 301 );
exit;
