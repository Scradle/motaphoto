<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="masthead" class="site-header">
    <div class="site-branding">
        <img class="logo" src="<?php echo get_template_directory_uri() . './assets/images/logo.png'; ?> " alt="logo">
        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-principal',
                'menu_id'        => 'header-menu',
            ) );
            
            ?>
        </nav><!-- #site-navigation -->
    </div>

</header><!-- #masthead -->

<div id="content" class="site-content">
