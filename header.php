<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="masthead" class="site-header">
    <!-- header avec menu classique ou burger -->
    <div class="site-branding">
        <img class="logo" src="<?php echo THEME_URI . '/assets/images/logo.png'; ?> " alt="logo">
        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-principal',
                'menu_id'        => 'header-menu',
            ) );
            ?>
            <button id="menu-toggle" class="menu-toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
        </nav>
    </div>
    <!-- menu invoqué avec le burger-->
    <div id="mini-menu-modal" class="mini-menu-modal">
        <div class="site-header-mini">
            <div class="site-branding-mini">
                <img class="logo-mini" src="<?php echo THEME_URI . '/assets/images/logo.png'; ?> " alt="logo">
                <button id="menu-toggle-cross" class="menu-toggle-cross">
                    <span class="line1"></span>
                    <span class="line2"></span>
                </button>
            </div>
        </div>
        <nav id="mini-navigation" class="mini-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-principal',
                'menu_id'        => 'header-menu',
            ) );
            ?>
        </nav>
    </div>
</header> <!-- #masthead -->

<div id="content" class="site-content">