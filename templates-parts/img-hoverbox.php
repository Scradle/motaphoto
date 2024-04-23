<div class="img-hoverbox">
    <div class="img-hoverbox-veil"></div>
    <img class="img-icon-fullscreen" src="<?php echo get_template_directory_uri() . './assets/images/Icon_fullscreen.png'; ?> " alt="icone de la lightbox">
    <a href="<?php echo esc_url(get_permalink()); ?>"><img class="img-icon-eye" src="<?php echo get_template_directory_uri() . './assets/images/Icon_eye.png'; ?> " alt="icone de la hoverbox"></a>
    
    <?php $titre = get_field('titre'); echo '<div class="img-title">' . $titre . '</div>';?>
    <?php  $categorie = get_field('categorie'); echo '<div class="img-category">' . $categorie->name . '</div>';?>   
</div>