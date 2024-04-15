</div> <!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="site-info">
        <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-secondaire',
                'menu_id'        => 'footer-menu',
            ) );
        ?>
    </div> <!-- .site-info -->
    <?php get_template_part( 'templates-parts/contact-modal' ); ?> <!-- intégration modale de contact -->
</footer> <!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>