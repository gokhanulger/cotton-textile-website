<?php
/**
 * Template Functions
 *
 * @package Cotton_Textile
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom body classes
 */
function cotton_textile_body_classes($classes) {
    // Add page slug class
    if (is_singular()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }

    // Add class for pages with featured images
    if (is_singular() && has_post_thumbnail()) {
        $classes[] = 'has-post-thumbnail';
    }

    // Add class for product pages
    if (is_singular('product')) {
        $classes[] = 'single-product-page';
    }

    // Add class for product archives
    if (is_post_type_archive('product') || is_tax('product_category')) {
        $classes[] = 'product-archive-page';
    }

    return $classes;
}
add_filter('body_class', 'cotton_textile_body_classes');

/**
 * Custom excerpt length
 */
function cotton_textile_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'cotton_textile_excerpt_length');

/**
 * Custom excerpt more
 */
function cotton_textile_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'cotton_textile_excerpt_more');

/**
 * Modify archive title
 */
function cotton_textile_archive_title($title) {
    if (is_post_type_archive('product')) {
        $title = __('All Products', 'cotton-textile');
    } elseif (is_tax('product_category')) {
        $title = single_term_title('', false);
    }
    return $title;
}
add_filter('get_the_archive_title', 'cotton_textile_archive_title');

/**
 * Add custom image sizes to media library
 */
function cotton_textile_image_size_names($sizes) {
    return array_merge($sizes, array(
        'product-thumbnail' => __('Product Thumbnail', 'cotton-textile'),
        'product-large'     => __('Product Large', 'cotton-textile'),
        'collection-card'   => __('Collection Card', 'cotton-textile'),
    ));
}
add_filter('image_size_names_choose', 'cotton_textile_image_size_names');

/**
 * Products per page
 */
function cotton_textile_products_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('product') || is_tax('product_category')) {
            $query->set('posts_per_page', 12);
        }
    }
}
add_action('pre_get_posts', 'cotton_textile_products_per_page');

/**
 * Contact form shortcode (basic)
 */
function cotton_textile_contact_form_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => __('Get in Touch', 'cotton-textile'),
    ), $atts);

    ob_start();
    ?>
    <div class="contact-form">
        <h3 style="margin-bottom: 1.5rem;"><?php echo esc_html($atts['title']); ?></h3>

        <form id="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
            <input type="hidden" name="action" value="cotton_textile_contact">
            <?php wp_nonce_field('cotton_textile_contact', 'contact_nonce'); ?>

            <div class="form-group">
                <label for="contact_name"><?php _e('Your Name', 'cotton-textile'); ?> *</label>
                <input type="text" id="contact_name" name="contact_name" required>
            </div>

            <div class="form-group">
                <label for="contact_email"><?php _e('Your Email', 'cotton-textile'); ?> *</label>
                <input type="email" id="contact_email" name="contact_email" required>
            </div>

            <div class="form-group">
                <label for="contact_company"><?php _e('Company Name', 'cotton-textile'); ?></label>
                <input type="text" id="contact_company" name="contact_company">
            </div>

            <div class="form-group">
                <label for="contact_product"><?php _e('Product Interest', 'cotton-textile'); ?></label>
                <select id="contact_product" name="contact_product">
                    <option value=""><?php _e('Select a category...', 'cotton-textile'); ?></option>
                    <option value="peshtemals"><?php _e('Peshtemals', 'cotton-textile'); ?></option>
                    <option value="towels"><?php _e('Towels', 'cotton-textile'); ?></option>
                    <option value="bathrobes"><?php _e('Bathrobes', 'cotton-textile'); ?></option>
                    <option value="hotel"><?php _e('Hotel Collection', 'cotton-textile'); ?></option>
                    <option value="custom"><?php _e('Custom Order', 'cotton-textile'); ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="contact_message"><?php _e('Your Message', 'cotton-textile'); ?> *</label>
                <textarea id="contact_message" name="contact_message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fas fa-paper-plane"></i>
                <?php _e('Send Message', 'cotton-textile'); ?>
            </button>
        </form>

        <p style="margin-top: 1.5rem; font-size: 0.875rem; color: var(--slate); text-align: center;">
            <?php _e('Or contact us directly via', 'cotton-textile'); ?>
            <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link()); ?>" style="color: #25D366; font-weight: 500;">WhatsApp</a>
        </p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('contact_form', 'cotton_textile_contact_form_shortcode');

/**
 * Handle contact form submission
 */
function cotton_textile_handle_contact_form() {
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'cotton_textile_contact')) {
        wp_die(__('Security check failed', 'cotton-textile'));
    }

    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $company = sanitize_text_field($_POST['contact_company']);
    $product = sanitize_text_field($_POST['contact_product']);
    $message = sanitize_textarea_field($_POST['contact_message']);

    $to = get_theme_mod('contact_email', get_option('admin_email'));
    $subject = sprintf(__('New inquiry from %s', 'cotton-textile'), $name);

    $body = sprintf(
        "Name: %s\nEmail: %s\nCompany: %s\nProduct Interest: %s\n\nMessage:\n%s",
        $name,
        $email,
        $company ? $company : 'N/A',
        $product ? $product : 'N/A',
        $message
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_redirect(add_query_arg('contact', 'success', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
    }
    exit;
}
add_action('admin_post_cotton_textile_contact', 'cotton_textile_handle_contact_form');
add_action('admin_post_nopriv_cotton_textile_contact', 'cotton_textile_handle_contact_form');

/**
 * Products grid shortcode
 */
function cotton_textile_products_grid_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category' => '',
        'count'    => 8,
        'columns'  => 4,
    ), $atts);

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => intval($atts['count']),
    );

    if ($atts['category']) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_category',
                'field'    => 'slug',
                'terms'    => $atts['category'],
            ),
        );
    }

    $products = new WP_Query($args);

    ob_start();

    if ($products->have_posts()) :
    ?>
        <div class="products-grid" style="grid-template-columns: repeat(<?php echo intval($atts['columns']); ?>, 1fr);">
            <?php while ($products->have_posts()) : $products->the_post(); ?>
                <article class="product-card">
                    <a href="<?php the_permalink(); ?>" class="product-card-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('product-thumbnail'); ?>
                        <?php endif; ?>
                        <div class="product-card-overlay">
                            <span class="btn btn-primary"><?php _e('View Details', 'cotton-textile'); ?></span>
                        </div>
                    </a>
                    <div class="product-card-content">
                        <h3 class="product-card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php
        wp_reset_postdata();
    endif;

    return ob_get_clean();
}
add_shortcode('products', 'cotton_textile_products_grid_shortcode');

/**
 * WhatsApp button shortcode
 */
function cotton_textile_whatsapp_shortcode($atts) {
    $atts = shortcode_atts(array(
        'text'    => __('Contact Us on WhatsApp', 'cotton-textile'),
        'message' => __('Hello, I am interested in your products.', 'cotton-textile'),
    ), $atts);

    return sprintf(
        '<a href="%s" class="btn btn-primary" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> %s</a>',
        esc_url(cotton_textile_get_whatsapp_link($atts['message'])),
        esc_html($atts['text'])
    );
}
add_shortcode('whatsapp_button', 'cotton_textile_whatsapp_shortcode');
