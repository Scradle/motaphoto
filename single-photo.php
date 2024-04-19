<?php
get_header();
?>

<section class="single-photo">
    <div class="single-photo-txt">
        <?php //récupération ACF
            $titre = get_field('titre');
            echo '<h1>' . $titre . '</h1>';
            $reference = get_field('reference');
            echo '<p class="referenceValue">Référence : ' . $reference . '</p>';
            $categorie = get_field('categorie');
            echo '<p>Catégorie : ' . $categorie->name . '</p>';
            $format = get_field('format');
            echo '<p>Format : ' . $format->name . '</p>';
            $type = get_field('type');
            echo '<p>Type : ' . $type->name . '</p>';
            $annee = get_field('annee');
            echo '<p>Année : ' . $annee . '</p>';
            wp_localize_script('script', 'photo_params', [
                'reference' 					=> $reference,
            ]); 
        ?>
    </div>
    <div class="single-photo-img">
        <?php //récupération ACF
            $photo = get_field('photo');
            echo '<img src="' . $photo . '" alt="Photo sélectionnée">';   
        ?>
    </div>
</section> <!-- single-photo -->
<section class="single-contact">
    <div class="single-contact-left">
        <p>Cette photo vous intéresse  ?</p>
        <button class="single-contact-btn">
            <a href="#">Contact</a>
        </button>  
    </div>
    <div class="single-contact-right">
    </div>
</section>
<section class="single-suggestion">
    <h3>Vous aimerez aussi</h3>
    <div  class= "single-suggestion-imgs">
    <?php
        $categorie = get_field('categorie');
        $format = get_field('format');
        $type = get_field('type');
        // Vérification si les termes de taxonomie existent
        if ($categorie && $format && $type) {
            // Recherche d'autres objets ayant les mêmes termes de taxonomie
            $args = array(
                'post_type' => 'photo',
                'tax_query' => array(
                    'relation'  => 'OR',
                    [
                        'taxonomy' => 'categorie',
                        'field'    => 'name',
                        'terms'    => $categorie->name,
                    ],
                    [
                        'taxonomy' => 'format',
                        'field'    => 'name',
                        'terms'    => $format->name,
                    ],
                    [
                        'taxonomy' => 'techno',
                        'field'    => 'name',
                        'terms'    => $type->name,
                    ],
                ),
                'posts_per_page' => 2, // Limiter le nombre de suggestions à 2
            );
            $related_posts_query = new WP_Query($args);
            // Affichage des suggestions
            if ($related_posts_query->have_posts()) {
                
                while ($related_posts_query->have_posts()) {
                    $related_posts_query->the_post();
                    $image = get_field('photo');
                    if (!empty($image)) {
                        echo '<a href="#"><img src="' . $image . '" alt="' . $image . '"></a>';
                    }
                }
                wp_reset_postdata();
            } else {
                echo '<p>Aucune suggestion trouvée.</p>';
            }
        } else {
            echo '<p>Au moins un des termes de taxonomie spécifiés n\'existe pas.</p>';
        }
        ?>
    </div>
</section>

<?php
get_footer();