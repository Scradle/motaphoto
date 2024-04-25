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
        <?php
            // Récupération des données avec ACF
            $next_post = get_next_post();
            $prev_post = get_previous_post();

            // Si on arrive à la fin de la liste, retourner au début
            if (!$next_post) {
                $next_post = get_posts(array(
                    'numberposts' => 1,
                    'order' => 'ASC',
                    'post_type' => 'photo' 
                ))[0];
            }

            // Si on est au début de la liste, aller à la fin
            if (!$prev_post) {
                $last_post = get_posts(array(
                    'numberposts' => 1,
                    'order' => 'DESC',
                    'post_type' => 'photo' 
                ))[0];
                $prev_post = $last_post;
            }

            // Récupération de l'URL de l'image ACF pour le prochain post
            $next_post_image = get_field('photo', $next_post->ID); 

            // Récupération de l'URL de l'image ACF pour le post précédent
            $prev_post_image = get_field('photo', $prev_post->ID); 
        ?>
        <div class="thumbnails-navigation">
            <div class="thumbnail">
                <?php if ($next_post_image) : ?>
                    <img src="<?php echo esc_url($next_post_image); ?>" alt="Thumbnail">
                <?php endif; ?>
            </div>
            <div class="arrows">
                <a href="<?php echo get_permalink($prev_post->ID); ?>" class="prev-post">
                    <img class="left-arrow-nav" src="<?php echo get_template_directory_uri() . '/assets/images/Icon_left_arrow.png'; ?>" alt="flêche de navigation gauche">
                </a>
                <a href="<?php echo get_permalink($next_post->ID); ?>" class="next-post">
                    <img class="right-arrow-nav" src="<?php echo get_template_directory_uri() . '/assets/images/Icon_right_arrow.png'; ?>" alt="flêche de navigation droite">
                </a>
            </div>
        </div>
    </div>
</section>
<section class="single-suggestion">
    <h3>Vous aimerez aussi</h3>
    <div class="single-suggestion-imgs">
        <?php
        $current_post_id = get_the_ID(); // Récupère l'ID de l'article actuellement affiché
        $suggested_post_ids = array(); // Initialise un tableau pour stocker les ID des suggestions déjà récupérées

        $categorie = get_field('categorie');
        $format = get_field('format');
        $type = get_field('type');
        // Vérification si les termes de taxonomie existent
        if ($categorie && $format && $type) {
            // Recherche d'autres objets ayant les mêmes termes de taxonomie, excluant l'article actuel et les suggestions déjà récupérées
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
                'post__not_in' => array($current_post_id), // Exclure l'article actuellement affiché
                'posts_per_page' => 2, // Limiter le nombre de suggestions à 2
            );
            $related_posts_query = new WP_Query($args);
            // Affichage des suggestions
            if ($related_posts_query->have_posts()) {
                while ($related_posts_query->have_posts()) {
                    $related_posts_query->the_post();
                    $photo = get_field('photo');
                    if (!empty($photo)) {
                        $post_id = get_the_ID(); // Récupère l'ID de la suggestion actuelle
                        if (!in_array($post_id, $suggested_post_ids)) { // Vérifie si l'ID de la suggestion est déjà dans le tableau
                            // Ajoute l'ID de la suggestion au tableau des suggestions déjà récupérées
                            $suggested_post_ids[] = $post_id;
                            echo '<div class="single-suggestion-solo">';
                            echo '<div class="single-suggestion-img"><img src="' . $photo . '" alt="' . get_the_title() . '"></div>';
                            get_template_part('templates-parts/img-hoverbox'); // Intégration hoverbox
                            echo '</div>';
                        }
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