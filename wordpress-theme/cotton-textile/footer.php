<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-col">
                <div class="site-logo" style="margin-bottom: 1.5rem;">
                    <div class="logo-icon">
                        <span>CT</span>
                    </div>
                    <div class="logo-text">
                        <span class="brand"><?php bloginfo('name'); ?></span>
                        <span class="tagline">Premium Turkish Textiles</span>
                    </div>
                </div>
                <p style="font-size: 0.875rem; line-height: 1.7; margin-bottom: 1.5rem;">
                    Premium Turkish textile manufacturer specializing in peshtemals, towels, and bathrobes.
                    Serving hotels, resorts, and retailers worldwide since 1990.
                </p>
                <div class="social-links">
                    <?php if (get_theme_mod('social_instagram')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_instagram')); ?>" target="_blank" rel="noopener" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (get_theme_mod('social_facebook')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_facebook')); ?>" target="_blank" rel="noopener" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (get_theme_mod('social_linkedin')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_linkedin')); ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    <?php endif; ?>
                    <?php if (get_theme_mod('social_pinterest')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_pinterest')); ?>" target="_blank" rel="noopener" aria-label="Pinterest">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Collections Column -->
            <div class="footer-col">
                <h4><?php _e('Collections', 'cotton-textile'); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/product-category/peshtemals/')); ?>"><?php _e('Peshtemals', 'cotton-textile'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/product-category/towels/')); ?>"><?php _e('Towels', 'cotton-textile'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/product-category/bathrobes/')); ?>"><?php _e('Bathrobes', 'cotton-textile'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/product-category/hotel-collection/')); ?>"><?php _e('Hotel Collection', 'cotton-textile'); ?></a></li>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"><?php _e('All Products', 'cotton-textile'); ?></a></li>
                </ul>
            </div>

            <!-- Company Column -->
            <div class="footer-col">
                <h4><?php _e('Company', 'cotton-textile'); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>"><?php _e('About Us', 'cotton-textile'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/manufacturing/')); ?>"><?php _e('Manufacturing', 'cotton-textile'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/sustainability/')); ?>"><?php _e('Sustainability', 'cotton-textile'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/certifications/')); ?>"><?php _e('Certifications', 'cotton-textile'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php _e('Contact', 'cotton-textile'); ?></a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="footer-col">
                <h4><?php _e('Contact Us', 'cotton-textile'); ?></h4>
                <ul>
                    <?php if (get_theme_mod('contact_address')) : ?>
                    <li style="display: flex; gap: 0.75rem; align-items: flex-start;">
                        <i class="fas fa-map-marker-alt" style="color: var(--gold); margin-top: 0.25rem;"></i>
                        <span><?php echo nl2br(esc_html(get_theme_mod('contact_address'))); ?></span>
                    </li>
                    <?php endif; ?>
                    <?php if (get_theme_mod('whatsapp_number')) : ?>
                    <li style="display: flex; gap: 0.75rem; align-items: center;">
                        <i class="fab fa-whatsapp" style="color: var(--gold);"></i>
                        <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link()); ?>"><?php echo esc_html(get_theme_mod('whatsapp_number')); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (get_theme_mod('contact_email')) : ?>
                    <li style="display: flex; gap: 0.75rem; align-items: center;">
                        <i class="fas fa-envelope" style="color: var(--gold);"></i>
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email')); ?>"><?php echo esc_html(get_theme_mod('contact_email')); ?></a>
                    </li>
                    <?php endif; ?>
                </ul>

                <div style="margin-top: 1.5rem;">
                    <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I would like to request a quote.')); ?>" class="btn btn-primary">
                        <i class="fab fa-whatsapp"></i> <?php _e('Request Quote', 'cotton-textile'); ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'cotton-textile'); ?></p>
            <p style="margin-top: 0.5rem; font-size: 0.75rem; color: rgba(255,255,255,0.4);">
                <?php _e('Premium Turkish Textiles • Manufactured in Denizli, Turkey', 'cotton-textile'); ?>
            </p>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I am interested in your products.')); ?>"
   class="whatsapp-float"
   target="_blank"
   rel="noopener"
   aria-label="Contact us on WhatsApp"
   style="position: fixed; bottom: 24px; right: 24px; width: 60px; height: 60px; background-color: #25D366; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 999; transition: transform 0.3s, box-shadow 0.3s;">
    <i class="fab fa-whatsapp" style="font-size: 2rem; color: white;"></i>
</a>

<style>
.whatsapp-float:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
}
</style>

<?php wp_footer(); ?>
</body>
</html>
