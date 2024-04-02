<?php
get_header();
// Afficher le contenu de la page principale
while ( have_posts() ) :
    the_post();
    the_content();
endwhile;
get_footer();
