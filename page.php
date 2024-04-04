<?php
// Inclure l'en-tête du site
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Vérifier s'il y a des pages à afficher
        while (have_posts()) :
            the_post();
            // Afficher le contenu de la page
            the_content();
        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
// Inclure le pied de page du site
get_footer();
