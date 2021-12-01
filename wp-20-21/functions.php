<?php

function ks_theme_support(){
    add_theme_support('tittle-tag');
}

add_action('after_setup_theme', 'ks_theme_support');


function ks_register_styles(){
    $ver = wp_get_theme()->get('Version');
    wp_enqueue_style('ks-theme-style', get_template_directory_uri().'/assets/css/style.css', array('zse-theme-bootstrap'), $ver, 'all');
    wp_enqueue_style('ks-theme-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1', 'all');
    wp_enqueue_style('ks-theme-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css', array(), '5.13.0', 'all');
}

add_action('wp_enqueue_scripts', 'ks_register_styles');

function ks_register_scripts(){
    wp_enqueue_script('ks-theme-main', get_template_directory_uri().'/assets/js/main.js', array(),'1.0' , 'all', true);
    wp_enqueue_script('ks-theme-jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array(), '3.4.1' , 'all', true);
    wp_enqueue_script('ks-theme-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array(), '4.4.1', 'all', true);
    wp_enqueue_script('ks-theme-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), '1.16.0', 'all', true);
}

add_action('wp_enqueue_scripts', 'ks_register_scripts');
?>