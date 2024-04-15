<?php
// Inclure l'en-tête du site
get_header();
?>

<?php
// Vérifier s'il y a des articles à afficher
if (have_posts()) :
    // Boucle WordPress standard pour afficher les articles
    while (have_posts()) :
        the_post();
        // Inclure le modèle de contenu de l'article
        get_template_part('template-parts/content', get_post_format());
    endwhile;
else :
    // Si aucun article n'est trouvé
    get_template_part('template-parts/content', 'none');
endif;
?>

<?php
// Inclure la barre latérale du site
get_sidebar();
// Inclure le pied de page du site
get_footer();
