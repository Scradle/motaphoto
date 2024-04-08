<?php
/*
Template Name: home-template
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <section id="home-hero" class="home-hero">
            <img class="img-hero" src="<?php echo get_template_directory_uri() . './assets/images/img-hero.jpeg'; ?> " alt="image du hero">
            <h1>PHOTOGRAPHE EVENT</h1>
        </section>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();