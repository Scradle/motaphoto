<div class="img-hoverbox" 
     data-image-url="<?php echo esc_attr(get_field('photo')); ?>" 
     data-image-title="<?php echo esc_attr(get_field('titre')); ?>" 
     data-image-category="<?php 
         $categories = get_the_terms(get_the_ID(), 'categorie'); 
         if ($categories && !is_wp_error($categories)) {
             $categorie = array_shift($categories);
             echo esc_attr($categorie->name); 
         }
     ?>">
    <div class="img-hoverbox-veil"></div>     <!-- Pour assombrir l'écran -->
    <img class="img-icon-fullscreen" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Icon_fullscreen.png'); ?> " alt="icone de la lightbox"> <!-- Pour appeler la lightbox -->
    <a href="<?php echo esc_url(get_permalink()); ?>"><img class="img-icon-eye" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/Icon_eye.png'); ?> " alt="icone de la hoverbox"></a>  <!-- Pour aller sur la page de la photo --> 
    <!-- récupération des infos de la photos -->
    <?php $titre = get_field('titre'); echo '<div class="img-title">' . $titre . '</div>';?>
    <?php 
        $categories = get_the_terms(get_the_ID(), 'categorie'); 
        if ($categories && !is_wp_error($categories)) {
            $categorie = array_shift($categories);
            echo '<div class="img-category">' . $categorie->name . '</div>';
        }
    ?>   
</div>
