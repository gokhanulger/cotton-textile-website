<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Mobile Menu -->
<div id="mobile-menu" class="mobile-menu">
    <div class="mobile-menu-inner">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'mobile',
            'container'      => false,
            'fallback_cb'    => 'cotton_textile_mobile_menu_fallback',
        ));
        ?>
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I am interested in your products.')); ?>" class="btn btn-primary" style="width: 100%; justify-content: center;">
                <i class="fab fa-whatsapp"></i> WhatsApp Us
            </a>
        </div>
    </div>
</div>

<!-- Header -->
<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <div class="logo-icon">
                        <span>CT</span>
                    </div>
                    <div class="logo-text">
                        <span class="brand"><?php bloginfo('name'); ?></span>
                        <span class="tagline">Premium Turkish Textiles</span>
                    </div>
                <?php endif; ?>
            </a>

            <!-- Main Navigation -->
            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => 'cotton_textile_primary_menu_fallback',
                ));
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I am interested in your products.')); ?>" class="whatsapp-btn" target="_blank" rel="noopener">
                    <i class="fab fa-whatsapp"></i>
                    <span>WhatsApp Us</span>
                </a>
                <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</header>

<?php

/**
 * Primary Menu Fallback
 */
function cotton_textile_primary_menu_fallback() {
    ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo is_front_page() ? 'active' : ''; ?>">Home</a>
    <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Collections</a>
    <a href="<?php echo esc_url(home_url('/product-category/peshtemals/')); ?>">Peshtemals</a>
    <a href="<?php echo esc_url(home_url('/product-category/towels/')); ?>">Towels</a>
    <a href="<?php echo esc_url(home_url('/product-category/bathrobes/')); ?>">Bathrobes</a>
    <a href="<?php echo esc_url(home_url('/product-category/hotel-collection/')); ?>">Hotel Collection</a>
    <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a>
    <?php
}

/**
 * Mobile Menu Fallback
 */
function cotton_textile_mobile_menu_fallback() {
    ?>
    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
    <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">All Products</a>
    <a href="<?php echo esc_url(home_url('/product-category/peshtemals/')); ?>">Peshtemals</a>
    <a href="<?php echo esc_url(home_url('/product-category/towels/')); ?>">Towels</a>
    <a href="<?php echo esc_url(home_url('/product-category/bathrobes/')); ?>">Bathrobes</a>
    <a href="<?php echo esc_url(home_url('/product-category/hotel-collection/')); ?>">Hotel Collection</a>
    <a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a>
    <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a>
    <?php
}
?>
