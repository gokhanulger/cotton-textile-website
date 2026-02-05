<?php
/**
 * The front page template
 *
 * @package Cotton_Textile
 */

get_header();

// Get hero settings
$hero_title = get_theme_mod('hero_title', 'Premium Turkish Textiles for Global Markets');
$hero_subtitle = get_theme_mod('hero_subtitle', 'Handcrafted peshtemals, premium towels, and luxury bathrobes manufactured in the heart of Turkey.');
$hero_image_id = get_theme_mod('hero_image');
$hero_image_url = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'hero-image') : COTTON_TEXTILE_URI . '/assets/images/hero-bg.jpg';
?>

<main id="main-content">

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg" style="background-image: url('<?php echo esc_url($hero_image_url); ?>');"></div>
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fas fa-award"></i>
                    <span><?php _e('Trusted by 500+ Hotels & Resorts Worldwide', 'cotton-textile'); ?></span>
                </div>
                <h1><?php echo esc_html($hero_title); ?></h1>
                <p><?php echo esc_html($hero_subtitle); ?></p>
                <div class="hero-buttons">
                    <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn btn-primary">
                        <i class="fas fa-th-large"></i>
                        <?php _e('View Collections', 'cotton-textile'); ?>
                    </a>
                    <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I would like to request a quote for your products.')); ?>" class="btn btn-outline" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <?php _e('Request Quote', 'cotton-textile'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Collections Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2><?php _e('Our Collections', 'cotton-textile'); ?></h2>
                <p><?php _e('Explore our range of premium Turkish textiles, from traditional peshtemals to luxury hotel linens.', 'cotton-textile'); ?></p>
            </div>

            <div class="collections-grid">
                <?php
                $categories = get_terms(array(
                    'taxonomy'   => 'product_category',
                    'hide_empty' => false,
                    'number'     => 4,
                ));

                $category_images = array(
                    'peshtemals'       => 'peshtemal-collection.jpg',
                    'towels'           => 'towel-collection.jpg',
                    'bathrobes'        => 'bathrobe-collection.jpg',
                    'hotel-collection' => 'hotel-collection.jpg',
                );

                $category_icons = array(
                    'peshtemals'       => 'fas fa-wind',
                    'towels'           => 'fas fa-water',
                    'bathrobes'        => 'fas fa-tshirt',
                    'hotel-collection' => 'fas fa-hotel',
                );

                foreach ($categories as $category) :
                    $image = isset($category_images[$category->slug]) ? COTTON_TEXTILE_URI . '/assets/images/' . $category_images[$category->slug] : '';
                    $icon = isset($category_icons[$category->slug]) ? $category_icons[$category->slug] : 'fas fa-box';

                    // Try to get category image from term meta
                    $term_image_id = get_term_meta($category->term_id, 'category_image', true);
                    if ($term_image_id) {
                        $image = wp_get_attachment_image_url($term_image_id, 'collection-card');
                    }
                ?>
                    <a href="<?php echo esc_url(get_term_link($category)); ?>" class="collection-card">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>">
                        <?php else : ?>
                            <div style="background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%); width: 100%; height: 100%;"></div>
                        <?php endif; ?>
                        <div class="collection-card-content">
                            <i class="<?php echo esc_attr($icon); ?>" style="font-size: 2rem; color: var(--gold); margin-bottom: 0.5rem;"></i>
                            <h3><?php echo esc_html($category->name); ?></h3>
                            <p><?php echo esc_html($category->description); ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="section bg-white">
        <div class="container">
            <div class="section-header">
                <h2><?php _e('Featured Products', 'cotton-textile'); ?></h2>
                <p><?php _e('Discover our most popular items, loved by customers worldwide.', 'cotton-textile'); ?></p>
            </div>

            <div class="products-grid">
                <?php
                $featured_products = new WP_Query(array(
                    'post_type'      => 'product',
                    'posts_per_page' => 8,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));

                if ($featured_products->have_posts()) :
                    while ($featured_products->have_posts()) : $featured_products->the_post();
                ?>
                    <article class="product-card">
                        <a href="<?php the_permalink(); ?>" class="product-card-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('product-thumbnail'); ?>
                            <?php else : ?>
                                <div style="width: 100%; height: 100%; background: var(--pearl); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 3rem; color: var(--silver);"></i>
                                </div>
                            <?php endif; ?>
                            <div class="product-card-overlay">
                                <span class="btn btn-primary"><?php _e('View Details', 'cotton-textile'); ?></span>
                            </div>
                            <div class="knitting-overlay">
                                <i class="fas fa-pencil-ruler"></i>
                                <span><?php _e('We Offer Custom Knitting', 'cotton-textile'); ?></span>
                            </div>
                        </a>
                        <div class="product-card-content">
                            <h3 class="product-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <?php
                            $sku = get_post_meta(get_the_ID(), '_product_sku', true);
                            $material = get_post_meta(get_the_ID(), '_product_material', true);
                            ?>
                            <?php if ($sku) : ?>
                                <p class="product-card-desc">
                                    <span style="color: var(--gold); font-weight: 500;">SKU:</span> <?php echo esc_html($sku); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <div class="text-center" style="grid-column: 1 / -1; padding: 3rem;">
                        <p style="color: var(--slate);"><?php _e('No products found. Add some products to get started!', 'cotton-textile'); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="text-center" style="margin-top: 2rem;">
                <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn btn-navy">
                    <?php _e('View All Products', 'cotton-textile'); ?>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section section-dark">
        <div class="container">
            <div class="section-header">
                <h2><?php _e('Why Choose Us', 'cotton-textile'); ?></h2>
                <p style="color: rgba(255,255,255,0.7);"><?php _e('Three generations of textile expertise, serving global markets since 1990.', 'cotton-textile'); ?></p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 style="color: var(--white);"><?php _e('Premium Quality', 'cotton-textile'); ?></h3>
                    <p style="color: rgba(255,255,255,0.7);"><?php _e('100% Turkish cotton with OEKO-TEX certification for safety and quality.', 'cotton-textile'); ?></p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <h3 style="color: var(--white);"><?php _e('Own Manufacturing', 'cotton-textile'); ?></h3>
                    <p style="color: rgba(255,255,255,0.7);"><?php _e('Our own factory in Denizli ensures quality control from yarn to finished product.', 'cotton-textile'); ?></p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-pencil-ruler"></i>
                    </div>
                    <h3 style="color: var(--white);"><?php _e('Custom Designs', 'cotton-textile'); ?></h3>
                    <p style="color: rgba(255,255,255,0.7);"><?php _e('Custom colors, patterns, and branding options available for bulk orders.', 'cotton-textile'); ?></p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 style="color: var(--white);"><?php _e('Global Shipping', 'cotton-textile'); ?></h3>
                    <p style="color: rgba(255,255,255,0.7);"><?php _e('Worldwide delivery with competitive rates and reliable logistics partners.', 'cotton-textile'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);">
        <div class="container text-center">
            <h2 style="color: var(--white); margin-bottom: 1rem;"><?php _e('Ready to Start Your Order?', 'cotton-textile'); ?></h2>
            <p style="color: rgba(255,255,255,0.9); max-width: 600px; margin: 0 auto 2rem;"><?php _e('Contact us today to discuss your requirements. We offer competitive pricing for bulk orders and can accommodate custom designs.', 'cotton-textile'); ?></p>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
                <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I would like to inquire about bulk ordering.')); ?>" class="btn btn-navy" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <?php _e('WhatsApp Us', 'cotton-textile'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn" style="background: var(--white); color: var(--navy);">
                    <i class="fas fa-envelope"></i>
                    <?php _e('Send Inquiry', 'cotton-textile'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Certifications -->
    <section class="section bg-white">
        <div class="container">
            <div class="section-header">
                <h2><?php _e('Certifications & Standards', 'cotton-textile'); ?></h2>
                <p><?php _e('Our commitment to quality and sustainability is backed by international certifications.', 'cotton-textile'); ?></p>
            </div>

            <div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 3rem; opacity: 0.6;">
                <div style="text-align: center;">
                    <i class="fas fa-leaf" style="font-size: 2.5rem; color: var(--success);"></i>
                    <p style="margin-top: 0.5rem; font-weight: 600;">OEKO-TEX</p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-globe-europe" style="font-size: 2.5rem; color: var(--navy);"></i>
                    <p style="margin-top: 0.5rem; font-weight: 600;">ISO 9001</p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-seedling" style="font-size: 2.5rem; color: var(--success);"></i>
                    <p style="margin-top: 0.5rem; font-weight: 600;">Organic Cotton</p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-recycle" style="font-size: 2.5rem; color: var(--navy);"></i>
                    <p style="margin-top: 0.5rem; font-weight: 600;">GRS Certified</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
