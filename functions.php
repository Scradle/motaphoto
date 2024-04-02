<?php
// Enregistrer les scripts et les styles
function mon_theme_scripts() {
    // Enregistrer les scripts
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), '1.0', true );
    
    // Enregistrer les styles
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'mon_theme_scripts' );
