<?php
/**
 * Product Archive Template
 *
 * @package Cotton_Textile
 */

get_header();

// Get all categories for filtering
$categories = get_terms(array(
    'taxonomy'   => 'product_category',
    'hide_empty' => true,
));

// Current category filter
$current_category = get_query_var('product_category');
?>

<main id="main-content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><?php _e('Our Collections', 'cotton-textile'); ?></h1>
            <p><?php _e('Explore our complete range of premium Turkish textiles', 'cotton-textile'); ?></p>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <!-- Category Filter -->
            <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 0.75rem; margin-bottom: 3rem;">
                    <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"
                       class="btn <?php echo empty($current_category) ? 'btn-primary' : 'btn-outline'; ?>"
                       style="<?php echo empty($current_category) ? '' : 'border-color: var(--navy); color: var(--navy);'; ?>">
                        <?php _e('All Products', 'cotton-textile'); ?>
                    </a>
                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo esc_url(get_term_link($category)); ?>"
                           class="btn <?php echo ($current_category === $category->slug) ? 'btn-primary' : 'btn-outline'; ?>"
                           style="<?php echo ($current_category === $category->slug) ? '' : 'border-color: var(--navy); color: var(--navy);'; ?>">
                            <?php echo esc_html($category->name); ?>
                            <span style="background: rgba(255,255,255,0.2); padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; margin-left: 0.5rem;">
                                <?php echo $category->count; ?>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

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
                                $product_cats = get_the_terms(get_the_ID(), 'product_category');
                                ?>
                                <?php if ($sku) : ?>
                                    <p class="product-card-desc">
                                        <span style="color: var(--gold); font-weight: 500;">SKU:</span> <?php echo esc_html($sku); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($product_cats && !is_wp_error($product_cats)) : ?>
                                    <p class="product-card-desc" style="margin-top: 0.25rem;">
                                        <span style="font-size: 0.75rem; background: var(--pearl); padding: 0.25rem 0.5rem; border-radius: 4px;">
                                            <?php echo esc_html($product_cats[0]->name); ?>
                                        </span>
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
                        <?php _e('We haven\'t added any products yet. Check back soon!', 'cotton-textile'); ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <?php _e('Return Home', 'cotton-textile'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section section-dark">
        <div class="container text-center">
            <h2><?php _e('Can\'t Find What You\'re Looking For?', 'cotton-textile'); ?></h2>
            <p style="color: rgba(255,255,255,0.7); max-width: 600px; margin: 1rem auto 2rem;">
                <?php _e('We offer custom manufacturing services. Contact us to discuss your specific requirements.', 'cotton-textile'); ?>
            </p>
            <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link('Hello, I have a custom product inquiry.')); ?>" class="btn btn-primary" target="_blank">
                <i class="fab fa-whatsapp"></i>
                <?php _e('Contact Us', 'cotton-textile'); ?>
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
