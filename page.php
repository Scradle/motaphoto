<?php
// Inclure l'en-tête du site
get_header();
?>

<?php
// Vérifier s'il y a des pages à afficher
while (have_posts()) :
    the_post();
    // Afficher le contenu de la page
    the_content();
endwhile;
?>

<?php
// Inclure le pied de page du site
get_footer();
