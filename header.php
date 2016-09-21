<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Simple_Blog
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <!-- <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"> -->

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'simpleblog'); ?></a>

        <?php if (has_header_image()) : ?> 
            <header class="site-header bg-image" style="background-image: url(<?php header_image(); ?>)">  
            <?php else: ?>
                <header class="site-header no-bg-image">          
                <?php endif; ?>

                <nav class="navbar navbar-default navbar-static-top">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                <span class="sr-only"><?php esc_html_e('Toggle Navigation', 'simpleblog'); ?></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div class="site-logo">
                                <?php if (has_custom_logo()) : ?> 
                                    <?php the_custom_logo(); ?>
                                <?php else : ?>
                                    <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <div class="site-firstletter">
                                            <?php $name = get_bloginfo('name', 'display'); ?>
                                            <?php echo substr($name, 0, 1); ?>
                                        </div>
                                    </a>    
                                <?php endif; ?>
                            </div><!-- site-logo -->
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="navbar-collapse-1">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'nav navbar-nav navbar-right',
                                'container' => false
                            ));
                            ?>
                        </div><!-- navbar-collapse -->
                    </div><!-- container -->
                </nav>

                <?php if (!is_single()) : ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="index-heading">
                                    <h1><?php bloginfo('name'); ?></h1>
                                    <h2><?php bloginfo('description'); ?></h2>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div><!-- container -->
                <?php endif; ?>
            </header>

            <!-- Main Content -->            
            <div class="container">
                <div class="row">
