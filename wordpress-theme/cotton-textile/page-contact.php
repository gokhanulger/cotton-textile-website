<?php
/**
 * Template Name: Contact Page
 *
 * @package Cotton_Textile
 */

get_header();
?>

<main id="main-content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <p><?php _e('Get in touch with our team for inquiries, quotes, and custom orders', 'cotton-textile'); ?></p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr; gap: 3rem;">
                <style>
                    @media (min-width: 1024px) {
                        .contact-grid {
                            grid-template-columns: 1fr 1fr !important;
                        }
                    }
                </style>

                <div class="contact-grid" style="display: grid; grid-template-columns: 1fr; gap: 3rem;">
                    <!-- Contact Form -->
                    <div>
                        <?php echo do_shortcode('[contact_form title="' . __('Send Us a Message', 'cotton-textile') . '"]'); ?>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <div class="contact-form" style="background: var(--navy); color: var(--white);">
                            <h3 style="color: var(--white); margin-bottom: 1.5rem;"><?php _e('Contact Information', 'cotton-textile'); ?></h3>

                            <div style="space-y: 1.5rem;">
                                <?php if (get_theme_mod('whatsapp_number')) : ?>
                                    <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem;">
                                        <div style="width: 48px; height: 48px; background: rgba(37,211,102,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fab fa-whatsapp" style="font-size: 1.5rem; color: #25D366;"></i>
                                        </div>
                                        <div>
                                            <h4 style="font-size: 1rem; color: var(--white); margin: 0 0 0.25rem 0;"><?php _e('WhatsApp', 'cotton-textile'); ?></h4>
                                            <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link()); ?>" style="color: rgba(255,255,255,0.8);">
                                                <?php echo esc_html(get_theme_mod('whatsapp_number')); ?>
                                            </a>
                                            <p style="font-size: 0.75rem; color: rgba(255,255,255,0.5); margin-top: 0.25rem;">
                                                <?php _e('Fastest response - Available 24/7', 'cotton-textile'); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (get_theme_mod('contact_email')) : ?>
                                    <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem;">
                                        <div style="width: 48px; height: 48px; background: rgba(184,134,11,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fas fa-envelope" style="font-size: 1.25rem; color: var(--gold);"></i>
                                        </div>
                                        <div>
                                            <h4 style="font-size: 1rem; color: var(--white); margin: 0 0 0.25rem 0;"><?php _e('Email', 'cotton-textile'); ?></h4>
                                            <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email')); ?>" style="color: rgba(255,255,255,0.8);">
                                                <?php echo esc_html(get_theme_mod('contact_email')); ?>
                                            </a>
                                            <p style="font-size: 0.75rem; color: rgba(255,255,255,0.5); margin-top: 0.25rem;">
                                                <?php _e('Response within 24 hours', 'cotton-textile'); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (get_theme_mod('contact_address')) : ?>
                                    <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem;">
                                        <div style="width: 48px; height: 48px; background: rgba(184,134,11,0.2); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fas fa-map-marker-alt" style="font-size: 1.25rem; color: var(--gold);"></i>
                                        </div>
                                        <div>
                                            <h4 style="font-size: 1rem; color: var(--white); margin: 0 0 0.25rem 0;"><?php _e('Address', 'cotton-textile'); ?></h4>
                                            <p style="color: rgba(255,255,255,0.8); margin: 0;">
                                                <?php echo nl2br(esc_html(get_theme_mod('contact_address'))); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Quick Actions -->
                            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
                                <h4 style="color: var(--white); font-size: 1rem; margin-bottom: 1rem;"><?php _e('Quick Actions', 'cotton-textile'); ?></h4>
                                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                    <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I would like to request a price list.')); ?>" class="btn btn-primary" target="_blank" style="justify-content: flex-start;">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        <?php _e('Request Price List', 'cotton-textile'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I would like to request samples.')); ?>" class="btn btn-outline" target="_blank" style="border-color: rgba(255,255,255,0.3); color: var(--white); justify-content: flex-start;">
                                        <i class="fas fa-box-open"></i>
                                        <?php _e('Request Samples', 'cotton-textile'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn btn-outline" style="border-color: rgba(255,255,255,0.3); color: var(--white); justify-content: flex-start;">
                                        <i class="fas fa-th-large"></i>
                                        <?php _e('View Catalog', 'cotton-textile'); ?>
                                    </a>
                                </div>
                            </div>

                            <!-- Business Hours -->
                            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
                                <h4 style="color: var(--white); font-size: 1rem; margin-bottom: 1rem;"><?php _e('Business Hours', 'cotton-textile'); ?></h4>
                                <div style="font-size: 0.875rem; color: rgba(255,255,255,0.8);">
                                    <p style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                        <span><?php _e('Monday - Friday', 'cotton-textile'); ?></span>
                                        <span>09:00 - 18:00</span>
                                    </p>
                                    <p style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                        <span><?php _e('Saturday', 'cotton-textile'); ?></span>
                                        <span>09:00 - 14:00</span>
                                    </p>
                                    <p style="display: flex; justify-content: space-between;">
                                        <span><?php _e('Sunday', 'cotton-textile'); ?></span>
                                        <span style="color: rgba(255,255,255,0.5);"><?php _e('Closed', 'cotton-textile'); ?></span>
                                    </p>
                                </div>
                                <p style="font-size: 0.75rem; color: rgba(255,255,255,0.5); margin-top: 1rem;">
                                    <?php _e('* WhatsApp messages are monitored outside business hours', 'cotton-textile'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (placeholder) -->
    <section class="section bg-white" style="padding: 0;">
        <div style="width: 100%; height: 400px; background: var(--pearl); display: flex; align-items: center; justify-content: center;">
            <div class="text-center">
                <i class="fas fa-map-marked-alt" style="font-size: 3rem; color: var(--silver); margin-bottom: 1rem;"></i>
                <p style="color: var(--slate);"><?php _e('Map placeholder - Add Google Maps embed here', 'cotton-textile'); ?></p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2><?php _e('Frequently Asked Questions', 'cotton-textile'); ?></h2>
            </div>

            <div style="max-width: 800px; margin: 0 auto;">
                <div style="border-bottom: 1px solid #E5E7EB; padding: 1.5rem 0;">
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.75rem;"><?php _e('What is the minimum order quantity?', 'cotton-textile'); ?></h3>
                    <p style="color: var(--slate);">
                        <?php _e('Our minimum order quantity varies by product type. Generally, it is 100 pieces per color for peshtemals and towels, and 50 pieces for bathrobes. Contact us for specific requirements.', 'cotton-textile'); ?>
                    </p>
                </div>

                <div style="border-bottom: 1px solid #E5E7EB; padding: 1.5rem 0;">
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.75rem;"><?php _e('Do you offer custom branding?', 'cotton-textile'); ?></h3>
                    <p style="color: var(--slate);">
                        <?php _e('Yes, we offer various customization options including custom colors, patterns, embroidery, woven labels, and hang tags. Our design team can help bring your vision to life.', 'cotton-textile'); ?>
                    </p>
                </div>

                <div style="border-bottom: 1px solid #E5E7EB; padding: 1.5rem 0;">
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.75rem;"><?php _e('What are your shipping options?', 'cotton-textile'); ?></h3>
                    <p style="color: var(--slate);">
                        <?php _e('We ship worldwide via air freight, sea freight, and express courier services. Shipping costs and transit times depend on the destination and order volume. We can provide FOB, CIF, or DDP pricing.', 'cotton-textile'); ?>
                    </p>
                </div>

                <div style="padding: 1.5rem 0;">
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.75rem;"><?php _e('Can I get samples before ordering?', 'cotton-textile'); ?></h3>
                    <p style="color: var(--slate);">
                        <?php _e('Yes, we provide samples for quality evaluation. Sample fees may apply depending on the product type and quantity. Contact us to request a sample kit.', 'cotton-textile'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
