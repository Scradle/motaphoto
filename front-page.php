<?php
get_header();
?>

<section id="home-hero" class="home-hero">
<img class="img-hero" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/img-hero.jpeg' ); ?>" alt="image du hero">
    <h1>PHOTOGRAPHE EVENT</h1>
</section>
<section id="single-gallery" class="single-gallery">
    <!-- ensemble des selects -->
    <div class="selects">
        <div class="selects-left">
            <select id="select-categories" class="select-categories" autocomplete="off">
                <option data-placeholder="true" label=" "></option>
                <option value="" selected hidden>&nbsp;</option>
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'categorie',
                    'hide_empty' => false,
                ));
                foreach ($categories as $category) {
                    echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                }
                ?>
            </select>
            <select id="select-formats" class="select-formats" autocomplete="off">
                <option data-placeholder="true" label=" "></option>
                <option value="" selected hidden>&nbsp;</option>
                <?php
                $formats = get_terms(array(
                    'taxonomy' => 'formate',
                    'hide_empty' => false,
                ));
                foreach ($formats as $format) {
                    echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="selects-right">
            <select id="select-dates" class="select-dates" autocomplete="off">
                <option data-placeholder="true" label=" "></option>
                <option value="" selected hidden>&nbsp;</option>
                <option value="acf_annee_ASC">À partir des plus anciennes</option>
                <option value="acf_annee_DESC">À partir des plus récentes</option>
            </select>
        </div>
    </div>
    <!-- div pour l'ensemble de la gallerie photo -->
    <div class="photo-gallery"> 
        <?php
        $args = array(
        'post_type' => 'photo', 
        'posts_per_page' => 8, // Pour afficher les 8 premiers posts
        'order' => 'ASC',  // afficher par ordre ascendant
        'orderby'=> 'date',
        );
        $custom_posts = new WP_Query($args);

        if ($custom_posts->have_posts()) :

            while ($custom_posts->have_posts()) : $custom_posts->the_post();
        ?>
        <div class= "img-gallery"> <!-- div pour une seule photo de  la gallerie --> 
            <div class="img-gallery-solo">
                <?php $photo = get_field('photo'); echo '<img class="photo-div" src="' . $photo . '" alt="Photo '.get_the_title().'">' ?>
            </div>
            <?php get_template_part( 'templates-parts/img-hoverbox' ); ?> <!-- intégration hoverbox -->
        </div>
        <?php
            endwhile;
            wp_reset_postdata(); // Réinitialiser les données du post
        else :
            echo 'Aucune photo trouvée.';
        endif; 
        ?>
    </div>
</section>
<!--  bouton  charger plus -->
<div class="load-more"> 
    <button id="load-more-btn" class="load-more-btn">Charger plus</button>
</div>

<?php
get_footer();