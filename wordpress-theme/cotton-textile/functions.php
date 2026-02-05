<?php
/**
 * Cotton Textile Theme Functions
 *
 * @package Cotton_Textile
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme Constants
define('COTTON_TEXTILE_VERSION', '1.0.0');
define('COTTON_TEXTILE_DIR', get_template_directory());
define('COTTON_TEXTILE_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function cotton_textile_setup() {
    // Text Domain
    load_theme_textdomain('cotton-textile', COTTON_TEXTILE_DIR . '/languages');

    // Theme Support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');

    // Image Sizes
    add_image_size('product-thumbnail', 400, 400, true);
    add_image_size('product-large', 800, 800, true);
    add_image_size('product-gallery', 1200, 1200, false);
    add_image_size('collection-card', 600, 800, true);
    add_image_size('hero-image', 1920, 1080, true);

    // Register Menus
    register_nav_menus(array(
        'primary'   => __('Primary Menu', 'cotton-textile'),
        'footer'    => __('Footer Menu', 'cotton-textile'),
        'mobile'    => __('Mobile Menu', 'cotton-textile'),
    ));
}
add_action('after_setup_theme', 'cotton_textile_setup');

/**
 * Enqueue Styles and Scripts
 */
function cotton_textile_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'cotton-textile-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap',
        array(),
        null
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Main Stylesheet
    wp_enqueue_style(
        'cotton-textile-style',
        get_stylesheet_uri(),
        array('cotton-textile-fonts', 'font-awesome'),
        COTTON_TEXTILE_VERSION
    );

    // Main JavaScript
    wp_enqueue_script(
        'cotton-textile-script',
        COTTON_TEXTILE_URI . '/assets/js/main.js',
        array('jquery'),
        COTTON_TEXTILE_VERSION,
        true
    );

    // Localize Script
    wp_localize_script('cotton-textile-script', 'cottonTextile', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('cotton_textile_nonce'),
        'homeUrl' => home_url(),
    ));
}
add_action('wp_enqueue_scripts', 'cotton_textile_scripts');

/**
 * Register Custom Post Type: Products
 */
function cotton_textile_register_post_types() {
    // Products CPT
    $labels = array(
        'name'                  => _x('Products', 'Post type general name', 'cotton-textile'),
        'singular_name'         => _x('Product', 'Post type singular name', 'cotton-textile'),
        'menu_name'             => _x('Products', 'Admin Menu text', 'cotton-textile'),
        'add_new'               => __('Add New', 'cotton-textile'),
        'add_new_item'          => __('Add New Product', 'cotton-textile'),
        'edit_item'             => __('Edit Product', 'cotton-textile'),
        'new_item'              => __('New Product', 'cotton-textile'),
        'view_item'             => __('View Product', 'cotton-textile'),
        'search_items'          => __('Search Products', 'cotton-textile'),
        'not_found'             => __('No products found', 'cotton-textile'),
        'not_found_in_trash'    => __('No products found in Trash', 'cotton-textile'),
        'all_items'             => __('All Products', 'cotton-textile'),
        'featured_image'        => __('Product Image', 'cotton-textile'),
        'set_featured_image'    => __('Set product image', 'cotton-textile'),
        'remove_featured_image' => __('Remove product image', 'cotton-textile'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'products', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('product', $args);
}
add_action('init', 'cotton_textile_register_post_types');

/**
 * Register Custom Taxonomies
 */
function cotton_textile_register_taxonomies() {
    // Product Category Taxonomy
    $labels = array(
        'name'              => _x('Product Categories', 'taxonomy general name', 'cotton-textile'),
        'singular_name'     => _x('Product Category', 'taxonomy singular name', 'cotton-textile'),
        'search_items'      => __('Search Categories', 'cotton-textile'),
        'all_items'         => __('All Categories', 'cotton-textile'),
        'parent_item'       => __('Parent Category', 'cotton-textile'),
        'parent_item_colon' => __('Parent Category:', 'cotton-textile'),
        'edit_item'         => __('Edit Category', 'cotton-textile'),
        'update_item'       => __('Update Category', 'cotton-textile'),
        'add_new_item'      => __('Add New Category', 'cotton-textile'),
        'new_item_name'     => __('New Category Name', 'cotton-textile'),
        'menu_name'         => __('Categories', 'cotton-textile'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'product-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('product_category', array('product'), $args);

    // Create default categories on theme activation
    if (!term_exists('Peshtemals', 'product_category')) {
        wp_insert_term('Peshtemals', 'product_category', array(
            'slug' => 'peshtemals',
            'description' => 'Traditional Turkish towels'
        ));
    }
    if (!term_exists('Towels', 'product_category')) {
        wp_insert_term('Towels', 'product_category', array(
            'slug' => 'towels',
            'description' => 'Premium cotton towels'
        ));
    }
    if (!term_exists('Bathrobes', 'product_category')) {
        wp_insert_term('Bathrobes', 'product_category', array(
            'slug' => 'bathrobes',
            'description' => 'Luxury bathrobes'
        ));
    }
    if (!term_exists('Hotel Collection', 'product_category')) {
        wp_insert_term('Hotel Collection', 'product_category', array(
            'slug' => 'hotel-collection',
            'description' => 'Products for hotels and beaches'
        ));
    }
}
add_action('init', 'cotton_textile_register_taxonomies');

/**
 * Register Product Meta Fields
 */
function cotton_textile_register_meta() {
    // SKU
    register_post_meta('product', '_product_sku', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'description'  => 'Product SKU/Manufacturer Code',
    ));

    // Material
    register_post_meta('product', '_product_material', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'description'  => 'Product material composition',
    ));

    // Size
    register_post_meta('product', '_product_size', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'description'  => 'Product dimensions',
    ));

    // Weight
    register_post_meta('product', '_product_weight', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'description'  => 'Product weight (GSM)',
    ));

    // MOQ (Minimum Order Quantity)
    register_post_meta('product', '_product_moq', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'description'  => 'Minimum order quantity',
    ));

    // Gallery Images
    register_post_meta('product', '_product_gallery', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'description'  => 'Product gallery image IDs (comma separated)',
    ));
}
add_action('init', 'cotton_textile_register_meta');

/**
 * Add Meta Boxes for Products
 */
function cotton_textile_add_meta_boxes() {
    add_meta_box(
        'product_details',
        __('Product Details', 'cotton-textile'),
        'cotton_textile_product_details_callback',
        'product',
        'normal',
        'high'
    );

    add_meta_box(
        'product_gallery',
        __('Product Gallery', 'cotton-textile'),
        'cotton_textile_product_gallery_callback',
        'product',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'cotton_textile_add_meta_boxes');

/**
 * Product Details Meta Box Callback
 */
function cotton_textile_product_details_callback($post) {
    wp_nonce_field('cotton_textile_product_details', 'cotton_textile_product_details_nonce');

    $sku = get_post_meta($post->ID, '_product_sku', true);
    $material = get_post_meta($post->ID, '_product_material', true);
    $size = get_post_meta($post->ID, '_product_size', true);
    $weight = get_post_meta($post->ID, '_product_weight', true);
    $moq = get_post_meta($post->ID, '_product_moq', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="product_sku"><?php _e('SKU (Manufacturer Code)', 'cotton-textile'); ?></label></th>
            <td><input type="text" id="product_sku" name="product_sku" value="<?php echo esc_attr($sku); ?>" class="regular-text" placeholder="e.g., stone, sultan, vegas"></td>
        </tr>
        <tr>
            <th><label for="product_material"><?php _e('Material', 'cotton-textile'); ?></label></th>
            <td><input type="text" id="product_material" name="product_material" value="<?php echo esc_attr($material); ?>" class="regular-text" placeholder="e.g., 100% Turkish Cotton"></td>
        </tr>
        <tr>
            <th><label for="product_size"><?php _e('Size', 'cotton-textile'); ?></label></th>
            <td><input type="text" id="product_size" name="product_size" value="<?php echo esc_attr($size); ?>" class="regular-text" placeholder="e.g., 100 x 180 cm"></td>
        </tr>
        <tr>
            <th><label for="product_weight"><?php _e('Weight (GSM)', 'cotton-textile'); ?></label></th>
            <td><input type="text" id="product_weight" name="product_weight" value="<?php echo esc_attr($weight); ?>" class="regular-text" placeholder="e.g., 300-350 GSM"></td>
        </tr>
        <tr>
            <th><label for="product_moq"><?php _e('Minimum Order', 'cotton-textile'); ?></label></th>
            <td><input type="text" id="product_moq" name="product_moq" value="<?php echo esc_attr($moq); ?>" class="regular-text" placeholder="e.g., 100 pieces per color"></td>
        </tr>
    </table>
    <?php
}

/**
 * Product Gallery Meta Box Callback
 */
function cotton_textile_product_gallery_callback($post) {
    $gallery = get_post_meta($post->ID, '_product_gallery', true);
    $gallery_ids = $gallery ? explode(',', $gallery) : array();
    ?>
    <div id="product-gallery-container">
        <ul class="product-gallery-images" style="display: flex; flex-wrap: wrap; gap: 5px; margin: 0; padding: 0; list-style: none;">
            <?php
            foreach ($gallery_ids as $image_id) {
                $image = wp_get_attachment_image_src($image_id, 'thumbnail');
                if ($image) {
                    echo '<li data-id="' . esc_attr($image_id) . '" style="width: 60px; height: 60px; position: relative;">';
                    echo '<img src="' . esc_url($image[0]) . '" style="width: 100%; height: 100%; object-fit: cover;">';
                    echo '<button type="button" class="remove-gallery-image" style="position: absolute; top: -5px; right: -5px; background: #dc2626; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer; font-size: 12px;">&times;</button>';
                    echo '</li>';
                }
            }
            ?>
        </ul>
        <input type="hidden" id="product_gallery" name="product_gallery" value="<?php echo esc_attr($gallery); ?>">
        <button type="button" id="add-gallery-images" class="button" style="margin-top: 10px;"><?php _e('Add Gallery Images', 'cotton-textile'); ?></button>
    </div>
    <script>
    jQuery(document).ready(function($) {
        var galleryFrame;

        $('#add-gallery-images').on('click', function(e) {
            e.preventDefault();

            if (galleryFrame) {
                galleryFrame.open();
                return;
            }

            galleryFrame = wp.media({
                title: '<?php _e('Select Gallery Images', 'cotton-textile'); ?>',
                button: { text: '<?php _e('Add to Gallery', 'cotton-textile'); ?>' },
                multiple: true
            });

            galleryFrame.on('select', function() {
                var selection = galleryFrame.state().get('selection');
                var ids = $('#product_gallery').val() ? $('#product_gallery').val().split(',') : [];

                selection.each(function(attachment) {
                    if (ids.indexOf(attachment.id.toString()) === -1) {
                        ids.push(attachment.id);
                        var img = attachment.attributes.sizes.thumbnail ? attachment.attributes.sizes.thumbnail.url : attachment.attributes.url;
                        $('.product-gallery-images').append(
                            '<li data-id="' + attachment.id + '" style="width: 60px; height: 60px; position: relative;">' +
                            '<img src="' + img + '" style="width: 100%; height: 100%; object-fit: cover;">' +
                            '<button type="button" class="remove-gallery-image" style="position: absolute; top: -5px; right: -5px; background: #dc2626; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer; font-size: 12px;">&times;</button>' +
                            '</li>'
                        );
                    }
                });

                $('#product_gallery').val(ids.join(','));
            });

            galleryFrame.open();
        });

        $(document).on('click', '.remove-gallery-image', function() {
            var $li = $(this).parent();
            var id = $li.data('id');
            var ids = $('#product_gallery').val().split(',').filter(function(i) { return i != id; });
            $('#product_gallery').val(ids.join(','));
            $li.remove();
        });
    });
    </script>
    <?php
}

/**
 * Save Product Meta
 */
function cotton_textile_save_product_meta($post_id) {
    if (!isset($_POST['cotton_textile_product_details_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cotton_textile_product_details_nonce'], 'cotton_textile_product_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('product_sku', 'product_material', 'product_size', 'product_weight', 'product_moq', 'product_gallery');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_product', 'cotton_textile_save_product_meta');

/**
 * Register Sidebars/Widget Areas
 */
function cotton_textile_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget 1', 'cotton-textile'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here for footer column 1.', 'cotton-textile'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 2', 'cotton-textile'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here for footer column 2.', 'cotton-textile'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'cotton_textile_widgets_init');

/**
 * Customizer Settings
 */
function cotton_textile_customize_register($wp_customize) {
    // Contact Section
    $wp_customize->add_section('cotton_textile_contact', array(
        'title'    => __('Contact Information', 'cotton-textile'),
        'priority' => 30,
    ));

    // WhatsApp Number
    $wp_customize->add_setting('whatsapp_number', array(
        'default'           => '+90 535 412 49 10',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('whatsapp_number', array(
        'label'   => __('WhatsApp Number', 'cotton-textile'),
        'section' => 'cotton_textile_contact',
        'type'    => 'text',
    ));

    // Email
    $wp_customize->add_setting('contact_email', array(
        'default'           => 'info@theturkishcotton.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label'   => __('Contact Email', 'cotton-textile'),
        'section' => 'cotton_textile_contact',
        'type'    => 'email',
    ));

    // Address
    $wp_customize->add_setting('contact_address', array(
        'default'           => 'Denizli, Turkey',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label'   => __('Address', 'cotton-textile'),
        'section' => 'cotton_textile_contact',
        'type'    => 'textarea',
    ));

    // Social Media Section
    $wp_customize->add_section('cotton_textile_social', array(
        'title'    => __('Social Media', 'cotton-textile'),
        'priority' => 35,
    ));

    $social_networks = array('instagram', 'facebook', 'linkedin', 'pinterest');

    foreach ($social_networks as $network) {
        $wp_customize->add_setting('social_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('social_' . $network, array(
            'label'   => ucfirst($network) . ' URL',
            'section' => 'cotton_textile_social',
            'type'    => 'url',
        ));
    }

    // Hero Section
    $wp_customize->add_section('cotton_textile_hero', array(
        'title'    => __('Homepage Hero', 'cotton-textile'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Premium Turkish Textiles for Global Markets',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'cotton-textile'),
        'section' => 'cotton_textile_hero',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Handcrafted peshtemals, premium towels, and luxury bathrobes manufactured in the heart of Turkey.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'cotton-textile'),
        'section' => 'cotton_textile_hero',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_image', array(
        'label'     => __('Hero Background Image', 'cotton-textile'),
        'section'   => 'cotton_textile_hero',
        'mime_type' => 'image',
    )));
}
add_action('customize_register', 'cotton_textile_customize_register');

/**
 * Helper: Get WhatsApp Link
 */
function cotton_textile_get_whatsapp_link($message = '') {
    $number = get_theme_mod('whatsapp_number', '+90 535 412 49 10');
    $number = preg_replace('/[^0-9]/', '', $number);

    $link = 'https://wa.me/' . $number;

    if ($message) {
        $link .= '?text=' . urlencode($message);
    }

    return $link;
}

/**
 * Helper: Get Product Gallery Images
 */
function cotton_textile_get_product_gallery($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $gallery = get_post_meta($post_id, '_product_gallery', true);

    if (!$gallery) {
        return array();
    }

    $ids = explode(',', $gallery);
    $images = array();

    foreach ($ids as $id) {
        $image = wp_get_attachment_image_src($id, 'product-gallery');
        if ($image) {
            $images[] = array(
                'id'        => $id,
                'url'       => $image[0],
                'thumbnail' => wp_get_attachment_image_src($id, 'product-thumbnail')[0],
            );
        }
    }

    return $images;
}

/**
 * AJAX: Load More Products
 */
function cotton_textile_load_more_products() {
    check_ajax_referer('cotton_textile_nonce', 'nonce');

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 12,
        'paged'          => $page,
    );

    if ($category) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/product', 'card');
        }
        wp_reset_postdata();
    }

    die();
}
add_action('wp_ajax_load_more_products', 'cotton_textile_load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'cotton_textile_load_more_products');

/**
 * Admin: Enqueue Media Uploader
 */
function cotton_textile_admin_scripts($hook) {
    global $post;

    if ($hook == 'post-new.php' || $hook == 'post.php') {
        if ('product' === $post->post_type) {
            wp_enqueue_media();
        }
    }
}
add_action('admin_enqueue_scripts', 'cotton_textile_admin_scripts');

/**
 * Flush rewrite rules on theme activation
 */
function cotton_textile_activation() {
    cotton_textile_register_post_types();
    cotton_textile_register_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'cotton_textile_activation');

/**
 * Add admin columns for products
 */
function cotton_textile_product_columns($columns) {
    $new_columns = array();

    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns[$key] = $value;
            $new_columns['product_image'] = __('Image', 'cotton-textile');
            $new_columns['product_sku'] = __('SKU', 'cotton-textile');
        } else {
            $new_columns[$key] = $value;
        }
    }

    return $new_columns;
}
add_filter('manage_product_posts_columns', 'cotton_textile_product_columns');

function cotton_textile_product_column_content($column, $post_id) {
    switch ($column) {
        case 'product_image':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(50, 50));
            } else {
                echo '<span style="color: #999;">—</span>';
            }
            break;

        case 'product_sku':
            $sku = get_post_meta($post_id, '_product_sku', true);
            echo $sku ? '<code>' . esc_html($sku) . '</code>' : '<span style="color: #999;">—</span>';
            break;
    }
}
add_action('manage_product_posts_custom_column', 'cotton_textile_product_column_content', 10, 2);

/**
 * Include template files
 */
require_once COTTON_TEXTILE_DIR . '/inc/template-functions.php';
