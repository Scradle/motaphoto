<?php
get_header();
?>

<section id="home-hero" class="home-hero">
    <img class="img-hero" src="<?php echo get_template_directory_uri() . './assets/images/img-hero.jpeg'; ?> " alt="image du hero">
    <h1>PHOTOGRAPHE EVENT</h1>
</section>
<section id= "single-gallery" class="single-gallery">
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
                <a href="<?php the_permalink(); ?>"><?php $photo = get_field('photo'); echo '<img src="' . $photo . '" alt="Photo '.get_the_title().'">' ?></a>
            </div>
        <?php
            endwhile;
            wp_reset_postdata(); // Réinitialiser les données du post
        else :
            echo 'Aucun article trouvé.';
        endif;
    ?>      
</section>
<div class="load-more">
    <button id="load-more-btn" class="load-more-btn">Charger plus</button>
</div>

<?php
get_footer();