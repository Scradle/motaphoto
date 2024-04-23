<?php
get_header();
?>

<section id="home-hero" class="home-hero">
    <img class="img-hero" src="<?php echo get_template_directory_uri() . './assets/images/img-hero.jpeg'; ?> " alt="image du hero">
    <h1>PHOTOGRAPHE EVENT</h1>
</section>
<section id="single-gallery" class="single-gallery">
    <div class="selects">
        <div class="selects-left">
            <select class="select-categories">
                <option value="" disabled selected hidden>Catégories</option>
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
            <select class="select-formats">
                <option value="" disabled selected hidden>Formats</option>
                <?php
                $formats = get_terms(array(
                    'taxonomy' => 'format',
                    'hide_empty' => false,
                ));
                foreach ($formats as $format) {
                    echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="selects-right">
            <select class="select-dates">
                <option value="" disabled selected hidden>Trier par</option>
                <option value="ASC">À partir des plus récentes</option>
                <option value="DESC">À partir des plus anciennes</option>
            </select>
        </div>
    </div>
    <div class="photo-gallery">
        <?php
        $args = array(
        'post_type' => 'photo', 
        'posts_per_page' => 8, // Pour afficher les posts
        'order' => 'ASC',  // afficher par ordre ascendant
        'orderby'=> 'date',
        );
        $custom_posts = new WP_Query($args);

        if ($custom_posts->have_posts()) :
            while ($custom_posts->have_posts()) : $custom_posts->the_post();
        ?>
        <div class= "img-gallery">
            <div class="img-gallery-solo">
                <?php $photo = get_field('photo'); echo '<img src="' . $photo . '" alt="Photo '.get_the_title().'">' ?>
            </div>
            <?php get_template_part( 'templates-parts/img-hoverbox' ); ?> <!-- intégration hoverbox -->
        </div>
        <?php
            endwhile;
            wp_reset_postdata(); // Réinitialiser les données du post
        else :
            echo 'Aucun article trouvé.';
        endif; 
        ?>
    </div>
</section>


<div class="load-more">
    <button id="load-more-btn" class="load-more-btn">Charger plus</button>
</div>

<?php
get_footer();