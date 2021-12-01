<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Martin Vaculik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/motion-ui@1.2.3/dist/motion-ui.min.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css" media="all" />

    <?php wp_head();?>

</head>

<body>
    <div class="show-for-large site-header" id="my-nav" style="z-index: 99; max-height: 100px">
        <a href="#">
            <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="">'; ?>
        </a>
        <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'menu-header'  ) ); ?>
    </div>
    <div class="hide-for-large site-header" id="my-nav-small" style="z-index: 90; ">
        <a href="#">
            <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="">'; ?>
        </a>
        <ul class="menu" style="justify-content: flex-end; flex-direction: column; margin-right: 10px;">
            <div class="container" onclick="menu(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </ul>
        <ul class="slides-menu"
            style="top: 75px; right: -150%; position: absolute; list-style: none; background-color: rgb(0, 0, 0); padding: 10px;">
            <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'menu-header'  ) ); ?>
        </ul>
    </div>
<!--
    <div id="site-header" style=" height: 800px; width: 100%; background-image: url('<?php header_image(); ?>);">
    <div class="grid-container full" style="height: 100%;">
        <div class="grid-y" style="height: 100%; width: 100%;">
            <div class="cell small-12 text-center align-center-middle" style="display: flex; dlex-direction: column;">
 <?php if ( is_active_sidebar( 'header-title' )  ) : ?>

        <div class="widget-area " role="complementary">

            <?php dynamic_sidebar( 'header-title' ); ?>

        </div>

        <?php endif; ?>
        </div>
        </div>
        
    </div>

       
    </div>-->

    <?php if ( is_active_sidebar( 'header-slider' )  ) : ?>

<div class="widget-area " role="complementary">

    <?php dynamic_sidebar( 'header-slider' ); ?>

</div>

<?php endif; ?>
    <div class="grid-container full">