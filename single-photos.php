<?php
/*
Post  type: photo-template
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <section class="single-photo">
            <div class="single-photo-txt">
                <?php
                    $field_value = get_field('titre');
                    echo '<h1>' . $field_value . '</h1>';
                
                    $field = get_field_object('reference');
                    $field_value = get_field('reference');
                    echo '<p>' . $field['label'] . ' : ' . $field_value . '</p>';

                    $field = get_field_object('categorie');
                    // Récupérer l'identifiant du terme de taxonomie depuis le champ personnalisé ACF nommé "nom_du_champ_taxonomie"
                    $field_value = get_field('categorie');
                    $term = get_term($field_value);
                    echo '<p>' . $field['label'] . ' : ' . $term->name . '</p>';

                    $field = get_field_object('annee');
                    $field_value = get_field('annee');
                    echo '<p>' . $field['label'] . ' : ' . $field_value . '</p>';

                    $field = get_field_object('format');
                    $field_value = get_field('format');
                    $term = get_term($field_value);
                    echo '<p>' . $field['label'] . ' : ' . $term->name . '</p>';

                    $field = get_field_object('type');
                    $field_value = get_field('type');
                    $term = get_term($field_value);
                    echo '<p>' . $field['label'] . ' : ' . $term->name . '</p>';
                ?>
            </div>
            <div class="single-photo-img">
                <?php
                    $field_value = get_field('photo');
                    echo '<img src="' . $field_value . '" alt="Photo sélectionnée">';   
                ?>
            </div>
        </section><!-- single-photo --> 
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();