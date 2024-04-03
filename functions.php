<?php
// Enregistrer les scripts et les styles
function theme_enqueue_scripts() {
    // Enregistrer les scripts
    wp_enqueue_script( 'script', get_template_directory_uri() . 'assets/js/script.js', array(), '1.0', true );
    
    // Enregistrer les styles
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.0' );
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/css/custom-style.css', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
