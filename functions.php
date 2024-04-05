<?php

// Enregistrer les scripts et les styles

function theme_enqueue_scripts() {
    // Enregistrer les scripts
    wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0', true );   
    // Enregistrer les styles
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.0' );
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/css/custom-style.css', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );



//Enregistrer les menus wordpress

function register_my_menus() {
    register_nav_menus(
        array(
            'menu-principal' => __( 'Menu Principal' ),
            'menu-secondaire' => __( 'Menu Secondaire' ),
            // Ajoutez d'autres emplacements de menu si nécessaire
        )
    );
}
add_action( 'after_setup_theme', 'register_my_menus' );


// Récupérer les éléments du menu pour utiliser un lien du menu en bouton de modale

add_filter('nav_menu_link_attributes', 'add_open_modal_class_to_menu_link', 10, 3);
function add_open_modal_class_to_menu_link($atts, $item, $args) {
    // Trouver l'identifiant du lien dans le menu que vous souhaitez ouvrir la modale
    $link_id = 'menu-item-33';

    // Vérifier si l'élément de menu correspond à l'identifiant spécifié
    if ($item->ID == $link_id) {
        // Ajouter la classe 'open-modal' à l'attribut de classe du lien
        $atts['class'] .= ' open-modal';
    }
    return $atts;
}