<div id="lightbox" class="lightbox">
    <div  class="lightbox-veil"></div> <!-- Pour assombrir l'écran -->
    <div class="lightbox-content">
        <div class="lightbox-prev"> <!-- flêche gauche -->
            <img class="lightbox-left-arrow" src="<?php echo get_template_directory_uri() . './assets/images/Icon_left_arrow_lb.png'; ?> " alt="flêche pour photo précédente">
        </div>
        <div  class=lightbox-img> <!-- photo -->
            <div class="lightbox-img-div">
                <!-- rempli dynamiquement par js -->
            </div>
            <div class="lightbox-info">
                <!-- rempli dynamiquement par js -->
            </div>
        </div>
        <div class="lightbox-next"> <!-- flêche droite -->
            <img class="lightbox-right-arrow" src="<?php echo get_template_directory_uri() . './assets/images/Icon_right_arrow_lb.png'; ?> " alt="flêche pour photo suivante">
        </div>
        <button id="lightbox-toggle-cross" class="lightbox-toggle-cross"> <!-- croix  pour fermeture -->
            <span class="line1"></span>
            <span class="line2"></span>
        </button>
    </div>
</div>