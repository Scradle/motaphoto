<?php
// Theme paths
define('THEME_URI', get_template_directory_uri());
define('THEME_DIR', get_template_directory());

// Assets Version, if some trouble with the cache, update the version
$assets_version = wp_get_theme()['Version'];
define('ASSETS_VERSION', $assets_version);

// Enregistrer les scripts et les styles
function theme_enqueue_scripts() {
    // Enregistrer les scripts
    wp_enqueue_script( 'script', THEME_URI . '/assets/js/script.js', array(), ASSETS_VERSION, true );  
    wp_enqueue_script( 'ajax-script', THEME_URI . '/assets/js/ajax-script.js', array(), ASSETS_VERSION, true ); 
    //import tomSelect
    wp_enqueue_style( 'tomSelect-css', 'https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.8.2/slimselect.css');
    wp_enqueue_script( 'tomSelect-js', 'https://cdnjs.cloudflare.com/ajax/libs/slim-select/2.8.2/slimselect.min.js'); 

    wp_localize_script('script', 'script_params', [
		'ajaxurl' 					=> admin_url( 'admin-ajax.php' ),
	]); 
    wp_localize_script('script', 'photo_params', [
		'photo_params' 				=> 'reference',
	]); 
    // Enregistrer les styles
    wp_enqueue_style( 'style', THEME_URI."/style.css" , array(), ASSETS_VERSION );
    wp_enqueue_style( 'custom-style', THEME_URI . '/assets/css/custom-style.css', array(), ASSETS_VERSION );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

//Enregistrer les menus wordpress
function register_my_menus() {
    register_nav_menus(
        array(
            'menu-principal' => __( 'Menu Principal' ),
            'menu-secondaire' => __( 'Menu Secondaire' ),
            'mini-menu' => __( 'Mini  menu' ),
            // Ajoutez d'autres emplacements de menu si nécessaire
        )
    );
}
add_action( 'after_setup_theme', 'register_my_menus' );

// Ajoute la prise en charge des modèles de page personnalisés
add_theme_support('custom-page-templates');
add_theme_support('post-thumbnails');

// Désactiver Gutenberg pour un type de publication personnalisé
function disabled_gutenberg_cpt( $use_block_editor, $post_type ) {
    if ( 'photos' === $post_type ) {
        return false;
    }
    return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'disabled_gutenberg_cpt', 10, 2 );

/******************************************************************************************************************/

// Création d'un custom post type pour les photos
function create_custom_photo_post() {
    $labels = array(
        'name'               => _x( 'photos', 'post type general name', 'textdomain' ),
        'singular_name'      => _x( 'photo', 'post type singular name', 'textdomain' ),
        'menu_name'          => _x( 'Photos ', 'admin menu', 'textdomain' ),
        'name_admin_bar'     => _x( 'Photos ', 'add new on admin bar', 'textdomain' ),
        'add_new'            => _x( 'Ajouter', 'custom post', 'textdomain' ),
        'add_new_item'       => __( 'Ajouter une nouvelle Photo', 'textdomain' ),
        'new_item'           => __( 'Nouvelle Photo', 'textdomain' ),
        'edit_item'          => __( 'Editer une Photo', 'textdomain' ),
        'view_item'          => __( 'Voir  une Photo', 'textdomain' ),
        'all_items'          => __( 'Toutes les Photos', 'textdomain' ),
        'search_items'       => __( 'Rechercher dans les Photos', 'textdomain' ),
        'parent_item_colon'  => __( 'Parent de  la Photo:', 'textdomain' ),
        'not_found'          => __( 'Aucune Photo trouvée.', 'textdomain' ),
        'not_found_in_trash' => __( 'Aucune Photo trouvée dans la corbeille.', 'textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'photo' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'         => array( 'categorie', 'format' ,  'techno' ),
        'menu_icon'          => 'dashicons-format-image' // Icone du menu
    );

    register_post_type( 'photo', $args );
}
add_action( 'init', 'create_custom_photo_post' );

// Création des taxonomies
function create_categorie_taxonomy() {
    $args = array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => 'Catégories',
            'singular_name'     => 'Catégorie',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categorie' ),
    );
    register_taxonomy( 'categorie', 'photo', $args );
}
add_action( 'init', 'create_categorie_taxonomy' );

function create_format_taxonomy() {
    $args = array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => 'Formats',
            'singular_name'     => 'Format',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'format' ),
    );
    register_taxonomy( 'format', 'photo', $args );
}
add_action( 'init', 'create_format_taxonomy' );

function create_type_taxonomy() {
    $args = array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => 'Types',
            'singular_name'     => 'Type',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'techno' ),
    );
    register_taxonomy( 'techno', 'photo', $args );
}
add_action( 'init', 'create_type_taxonomy' );

/**************************************************************************************************************/

// Déclaration de la variable $i au niveau global
global $i;
$i = 0;

// Fonction pour incrémenter $i et le retourner
function increment_i() {
    global $i;
    $i++;
    return $i;
}

/**************************************************************************************************************/

// // Obtenir le nombre total de photos disponibles sans utilisation d'un select
// function get_total_photo_count() {
//     $args = array(
//         'post_type' => 'photo',
//         'posts_per_page' => -1, // Récupérer tous les posts
//     );
    
//     $custom_query = new WP_Query($args);
//     $total_count = $custom_query->found_posts;
//     wp_send_json_success($total_count);
// }
// add_action('wp_ajax_get_total_photo_count', 'get_total_photo_count');
// add_action('wp_ajax_nopriv_get_total_photo_count', 'get_total_photo_count');

// // Enregistrer la fonction pour charger plus de photos via AJAX sans utilisation d'un select
// function load_more_photos() {
//     $args = array(
//         'post_type' => 'photo',
//         'posts_per_page' => 8,
//         'order' => 'ASC',
//         'orderby'=> 'date',
//         'offset' => $_POST['offset'],
//     );
    
//     $custom_posts = new WP_Query($args);

//     if ($custom_posts->have_posts()) :
//         while ($custom_posts->have_posts()) : $custom_posts->the_post();
//             $photo = get_field('photo');
//             echo '<div class="img-gallery">';
//             echo '<div class="img-gallery-solo"><img class="photo-div" src="' . $photo . '" alt="Photo ' . get_the_title() . '"></div>';
//             get_template_part( 'templates-parts/img-hoverbox' ); // intégration hoverbox 
//             echo '</div>';
//         endwhile;
//         wp_reset_postdata();
//     else :
//         echo "Toutes les photos ont été chargées.";
//     endif;

//     wp_die();
// }
// add_action('wp_ajax_load_more_photos', 'load_more_photos');
// add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

/***********************************************************************************************************************/

// Gestion des selects avec affichage des 8 prmières images  maximum
function custom_query_ajax() {
    if( isset($_POST['orderby']) && isset($_POST['category']) && isset($_POST['format']) ) {
        $orderby = $_POST['orderby'];
        $category = $_POST['category'];
        $format = $_POST['format'];

        if (empty($orderby)) {  // gère le  order by  d'origine
            $orderby = 'ASC';
        }

        //filter par date de parution 
        $args = array(
            'post_type' => 'photo', 
            'posts_per_page' => 8,
            'orderby'=> 'date',
            'order' => $orderby
        );

        // Filtrer par catégorie si sélectionnée
        if (!empty($category)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $category,
            );
        }

        // Filtrer par format si sélectionné
        if (!empty($format)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'format',
                'field'    => 'slug',
                'terms'    => $format,
            );
        }

        $custom_posts = new WP_Query($args);

        if ($custom_posts->have_posts()) {
            ob_start();
            while ($custom_posts->have_posts()) {
                $custom_posts->the_post();
                ?>
                <div class="img-gallery">
                    <div class="img-gallery-solo">
                        <?php $photo = get_field('photo'); ?>
                        <img class="photo-div" src="<?php echo $photo; ?>" alt="Photo <?php echo get_the_title(); ?>">
                    </div>
                    <?php get_template_part('templates-parts/img-hoverbox'); ?> <!-- intégration hoverbox -->
                </div>
                <?php
            }
            wp_reset_postdata();
            $gallery_content = ob_get_clean();
            echo $gallery_content;
        } else {
            echo 'Aucun article trouvé.';
        }
    }

    die();
}
add_action('wp_ajax_custom_query', 'custom_query_ajax');
add_action('wp_ajax_nopriv_custom_query', 'custom_query_ajax');
