<?php
/**
 * Product Card Template Part
 *
 * @package Cotton_Textile
 */

$sku = get_post_meta(get_the_ID(), '_product_sku', true);
$categories = get_the_terms(get_the_ID(), 'product_category');
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
        <?php if ($sku) : ?>
            <p class="product-card-desc">
                <span style="color: var(--gold); font-weight: 500;">SKU:</span> <?php echo esc_html($sku); ?>
            </p>
        <?php endif; ?>
        <?php if ($categories && !is_wp_error($categories)) : ?>
            <p class="product-card-desc" style="margin-top: 0.25rem;">
                <span style="font-size: 0.75rem; background: var(--pearl); padding: 0.25rem 0.5rem; border-radius: 4px;">
                    <?php echo esc_html($categories[0]->name); ?>
                </span>
            </p>
        <?php endif; ?>
    </div>
</article>
