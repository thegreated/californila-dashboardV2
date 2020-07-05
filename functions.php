<?php

add_action('wp_enqueue_scripts','parent_styles');
function parent_styles()
{

    wp_enqueue_style('parent-style', get_template_directory_uri().'/assets/css/argon.css?v=1.2.0','argon.css');
    wp_enqueue_style('all-min-style', get_template_directory_uri().'/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css','all.min.css');
    wp_enqueue_style('nuclee', get_template_directory_uri().'/assets/vendor/nucleo/css/nucleo.css','nucleo.css');
}

