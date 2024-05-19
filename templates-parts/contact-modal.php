<div id="contact-modal" class="contact-modal">
    <div  class="modal-veil"></div> <!-- Pour assombrir l'écran -->
    <div class="modal-content">
        <div class="contact-header-modal"> <!-- titre Contact -->
            <img class="contact-header" src="<?php echo get_template_directory_uri() . './assets/images/contact-header.png'; ?> " alt="titre de la modale de contact">
        </div>
        <div class="contact-form-modal">
		    <?php echo do_shortcode('[contact-form-7 id="ed934cd" title="Form-contact"]'); ?> <!-- insertion du formulaire de demande de renseignements -->
        </div>
    </div>
</div>