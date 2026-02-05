<?php
/**
 * 404 Template
 *
 * @package Cotton_Textile
 */

get_header();
?>

<main id="main-content">

    <section class="section" style="min-height: 60vh; display: flex; align-items: center;">
        <div class="container text-center">
            <div style="font-size: 8rem; font-weight: 700; color: var(--gold); line-height: 1; margin-bottom: 1rem;">
                404
            </div>
            <h1 style="margin-bottom: 1rem;"><?php _e('Page Not Found', 'cotton-textile'); ?></h1>
            <p style="color: var(--slate); max-width: 500px; margin: 0 auto 2rem;">
                <?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'cotton-textile'); ?>
            </p>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    <?php _e('Go Home', 'cotton-textile'); ?>
                </a>
                <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn btn-navy">
                    <i class="fas fa-box"></i>
                    <?php _e('View Products', 'cotton-textile'); ?>
                </a>
                <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I need help finding something on your website.')); ?>" class="btn btn-outline" style="border-color: var(--navy); color: var(--navy);" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <?php _e('Contact Us', 'cotton-textile'); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
