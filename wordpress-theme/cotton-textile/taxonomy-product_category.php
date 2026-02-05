<?php
/**
 * Product Category Archive Template
 *
 * @package Cotton_Textile
 */

get_header();

$current_term = get_queried_object();
$all_categories = get_terms(array(
    'taxonomy'   => 'product_category',
    'hide_empty' => true,
));

// Category specific icons
$category_icons = array(
    'peshtemals'       => 'fas fa-wind',
    'towels'           => 'fas fa-water',
    'bathrobes'        => 'fas fa-tshirt',
    'hotel-collection' => 'fas fa-hotel',
);

$current_icon = isset($category_icons[$current_term->slug]) ? $category_icons[$current_term->slug] : 'fas fa-box';
?>

<main id="main-content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <div style="width: 80px; height: 80px; background: rgba(184,134,11,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                    <i class="<?php echo esc_attr($current_icon); ?>" style="font-size: 2rem; color: var(--gold);"></i>
                </div>
                <h1><?php single_term_title(); ?></h1>
                <?php if ($current_term->description) : ?>
                    <p><?php echo esc_html($current_term->description); ?></p>
                <?php endif; ?>
                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: rgba(255,255,255,0.6);">
                    <?php printf(_n('%s Product', '%s Products', $current_term->count, 'cotton-textile'), $current_term->count); ?>
                </p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <!-- Category Filter -->
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 0.75rem; margin-bottom: 3rem;">
                <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"
                   class="btn btn-outline" style="border-color: var(--navy); color: var(--navy);">
                    <?php _e('All Products', 'cotton-textile'); ?>
                </a>
                <?php foreach ($all_categories as $category) : ?>
                    <a href="<?php echo esc_url(get_term_link($category)); ?>"
                       class="btn <?php echo ($current_term->term_id === $category->term_id) ? 'btn-primary' : 'btn-outline'; ?>"
                       style="<?php echo ($current_term->term_id === $category->term_id) ? '' : 'border-color: var(--navy); color: var(--navy);'; ?>">
                        <?php echo esc_html($category->name); ?>
                        <span style="background: rgba(255,255,255,0.2); padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; margin-left: 0.5rem;">
                            <?php echo $category->count; ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if (have_posts()) : ?>
                <div class="products-grid">
                    <?php while (have_posts()) : the_post(); ?>
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
                                ?>
                                <?php if ($sku) : ?>
                                    <p class="product-card-desc">
                                        <span style="color: var(--gold); font-weight: 500;">SKU:</span> <?php echo esc_html($sku); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div style="margin-top: 3rem; display: flex; justify-content: center;">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i> ' . __('Previous', 'cotton-textile'),
                        'next_text' => __('Next', 'cotton-textile') . ' <i class="fas fa-chevron-right"></i>',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="text-center" style="padding: 4rem 0;">
                    <i class="fas fa-box-open" style="font-size: 4rem; color: var(--silver); margin-bottom: 1rem;"></i>
                    <h2><?php _e('No Products Found', 'cotton-textile'); ?></h2>
                    <p style="color: var(--slate); margin-bottom: 2rem;">
                        <?php _e('No products in this category yet. Check back soon!', 'cotton-textile'); ?>
                    </p>
                    <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn btn-primary">
                        <?php _e('View All Products', 'cotton-textile'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Category Info -->
    <section class="section bg-white">
        <div class="container">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <?php if ($current_term->slug === 'peshtemals') : ?>
                    <h2><?php _e('About Our Peshtemals', 'cotton-textile'); ?></h2>
                    <p style="color: var(--slate);">
                        <?php _e('Peshtemals are traditional Turkish towels known for their lightweight, quick-drying properties. Handwoven from 100% Turkish cotton, they are perfect for the beach, spa, or home. Our peshtemals feature vibrant patterns and colors, combining traditional craftsmanship with modern design.', 'cotton-textile'); ?>
                    </p>
                <?php elseif ($current_term->slug === 'towels') : ?>
                    <h2><?php _e('About Our Towels', 'cotton-textile'); ?></h2>
                    <p style="color: var(--slate);">
                        <?php _e('Our premium Turkish towels are crafted from the finest long-staple cotton, offering exceptional softness and absorbency. Each towel is designed to last, becoming softer with every wash while maintaining its quality. Perfect for hotels, spas, and discerning customers.', 'cotton-textile'); ?>
                    </p>
                <?php elseif ($current_term->slug === 'bathrobes') : ?>
                    <h2><?php _e('About Our Bathrobes', 'cotton-textile'); ?></h2>
                    <p style="color: var(--slate);">
                        <?php _e('Our luxury bathrobes combine comfort with elegance. Made from premium Turkish cotton, they offer exceptional warmth and softness. Available in various styles including hooded robes, shawl collar robes, and kimono styles, perfect for hotels, spas, and retail.', 'cotton-textile'); ?>
                    </p>
                <?php elseif ($current_term->slug === 'hotel-collection') : ?>
                    <h2><?php _e('About Our Hotel Collection', 'cotton-textile'); ?></h2>
                    <p style="color: var(--slate);">
                        <?php _e('Our hotel collection is designed to meet the demanding standards of the hospitality industry. Featuring durable, high-quality textiles that withstand industrial laundering while maintaining their softness and appearance. Trusted by over 500 hotels worldwide.', 'cotton-textile'); ?>
                    </p>
                <?php else : ?>
                    <h2><?php single_term_title(); ?></h2>
                    <?php if ($current_term->description) : ?>
                        <p style="color: var(--slate);"><?php echo esc_html($current_term->description); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);">
        <div class="container text-center">
            <h2 style="color: var(--white);"><?php _e('Interested in Bulk Orders?', 'cotton-textile'); ?></h2>
            <p style="color: rgba(255,255,255,0.9); max-width: 600px; margin: 1rem auto 2rem;">
                <?php _e('We offer competitive pricing for wholesale and bulk orders. Contact us for a custom quote.', 'cotton-textile'); ?>
            </p>
            <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I am interested in bulk orders for ' . $current_term->name . '.')); ?>" class="btn btn-navy" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <?php _e('Get a Quote', 'cotton-textile'); ?>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
