<?php
/**
 * Single Product Template
 *
 * @package Cotton_Textile
 */

get_header();

while (have_posts()) : the_post();

// Get product meta
$sku = get_post_meta(get_the_ID(), '_product_sku', true);
$material = get_post_meta(get_the_ID(), '_product_material', true);
$size = get_post_meta(get_the_ID(), '_product_size', true);
$weight = get_post_meta(get_the_ID(), '_product_weight', true);
$moq = get_post_meta(get_the_ID(), '_product_moq', true);

// Get gallery images
$gallery = cotton_textile_get_product_gallery();
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'product-gallery');

// Get categories
$categories = get_the_terms(get_the_ID(), 'product_category');
?>

<main id="main-content">

    <!-- Breadcrumb -->
    <div class="bg-pearl">
        <div class="container">
            <nav class="breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'cotton-textile'); ?></a>
                <span style="margin: 0 0.5rem; color: var(--silver);">/</span>
                <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"><?php _e('Products', 'cotton-textile'); ?></a>
                <?php if ($categories && !is_wp_error($categories)) : ?>
                    <span style="margin: 0 0.5rem; color: var(--silver);">/</span>
                    <a href="<?php echo esc_url(get_term_link($categories[0])); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                <?php endif; ?>
                <span style="margin: 0 0.5rem; color: var(--silver);">/</span>
                <span><?php the_title(); ?></span>
            </nav>
        </div>
    </div>

    <section class="product-single">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
                <?php // On large screens, make it 2 columns ?>
                <style>
                    @media (min-width: 1024px) {
                        .product-single .container > div {
                            grid-template-columns: 1fr 1fr !important;
                        }
                    }
                </style>

                <!-- Product Gallery -->
                <div class="product-gallery">
                    <div class="product-main-image" id="main-image-container">
                        <?php if ($featured_image) : ?>
                            <img id="main-image" src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php elseif (!empty($gallery)) : ?>
                            <img id="main-image" src="<?php echo esc_url($gallery[0]['url']); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; background: var(--pearl); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="font-size: 4rem; color: var(--silver);"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($gallery) || $featured_image) : ?>
                        <div class="product-thumbnails">
                            <?php if ($featured_image) : ?>
                                <div class="product-thumbnail active" data-image="<?php echo esc_url($featured_image); ?>">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'product-thumbnail')); ?>" alt="">
                                </div>
                            <?php endif; ?>
                            <?php foreach ($gallery as $image) : ?>
                                <div class="product-thumbnail" data-image="<?php echo esc_url($image['url']); ?>">
                                    <img src="<?php echo esc_url($image['thumbnail']); ?>" alt="">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <?php if ($categories && !is_wp_error($categories)) : ?>
                        <p style="color: var(--gold); font-weight: 500; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.75rem; margin-bottom: 0.5rem;">
                            <?php echo esc_html($categories[0]->name); ?>
                        </p>
                    <?php endif; ?>

                    <h1><?php the_title(); ?></h1>

                    <?php if ($sku) : ?>
                        <p style="color: var(--slate); margin-bottom: 1.5rem;">
                            <strong><?php _e('SKU:', 'cotton-textile'); ?></strong> <?php echo esc_html($sku); ?>
                        </p>
                    <?php endif; ?>

                    <div class="description">
                        <?php the_content(); ?>
                    </div>

                    <!-- Specifications -->
                    <?php if ($material || $size || $weight || $moq) : ?>
                        <div class="product-specs">
                            <h3><i class="fas fa-list-ul" style="color: var(--gold); margin-right: 0.5rem;"></i><?php _e('Specifications', 'cotton-textile'); ?></h3>
                            <ul>
                                <?php if ($material) : ?>
                                    <li>
                                        <span style="color: var(--slate);"><?php _e('Material', 'cotton-textile'); ?></span>
                                        <span style="font-weight: 500; color: var(--navy);"><?php echo esc_html($material); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if ($size) : ?>
                                    <li>
                                        <span style="color: var(--slate);"><?php _e('Size', 'cotton-textile'); ?></span>
                                        <span style="font-weight: 500; color: var(--navy);"><?php echo esc_html($size); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if ($weight) : ?>
                                    <li>
                                        <span style="color: var(--slate);"><?php _e('Weight', 'cotton-textile'); ?></span>
                                        <span style="font-weight: 500; color: var(--navy);"><?php echo esc_html($weight); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if ($moq) : ?>
                                    <li>
                                        <span style="color: var(--slate);"><?php _e('Minimum Order', 'cotton-textile'); ?></span>
                                        <span style="font-weight: 500; color: var(--navy);"><?php echo esc_html($moq); ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Features -->
                    <div style="margin-bottom: 2rem;">
                        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                            <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--pearl); padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem;">
                                <i class="fas fa-check-circle" style="color: var(--success);"></i>
                                <?php _e('100% Turkish Cotton', 'cotton-textile'); ?>
                            </span>
                            <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--pearl); padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem;">
                                <i class="fas fa-check-circle" style="color: var(--success);"></i>
                                <?php _e('OEKO-TEX Certified', 'cotton-textile'); ?>
                            </span>
                            <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--pearl); padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem;">
                                <i class="fas fa-check-circle" style="color: var(--success);"></i>
                                <?php _e('Quick Dry', 'cotton-textile'); ?>
                            </span>
                            <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: var(--pearl); padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem;">
                                <i class="fas fa-check-circle" style="color: var(--success);"></i>
                                <?php _e('Machine Washable', 'cotton-textile'); ?>
                            </span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                        <?php
                        $whatsapp_message = sprintf(
                            __('Hello, I am interested in the %s (SKU: %s). Can you provide more information?', 'cotton-textile'),
                            get_the_title(),
                            $sku ? $sku : 'N/A'
                        );
                        ?>
                        <a href="<?php echo esc_url(cotton_textile_get_whatsapp_link($whatsapp_message)); ?>" class="btn btn-primary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            <?php _e('Request Quote', 'cotton-textile'); ?>
                        </a>
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'info@theturkishcotton.com')); ?>?subject=<?php echo urlencode('Inquiry: ' . get_the_title()); ?>" class="btn btn-navy">
                            <i class="fas fa-envelope"></i>
                            <?php _e('Email Inquiry', 'cotton-textile'); ?>
                        </a>
                    </div>

                    <!-- Custom Knitting Notice -->
                    <div style="margin-top: 2rem; padding: 1.5rem; background: linear-gradient(135deg, rgba(184,134,11,0.1) 0%, rgba(184,134,11,0.05) 100%); border-radius: 0.5rem; border-left: 4px solid var(--gold);">
                        <div style="display: flex; align-items: flex-start; gap: 1rem;">
                            <i class="fas fa-pencil-ruler" style="color: var(--gold); font-size: 1.5rem; margin-top: 0.25rem;"></i>
                            <div>
                                <h4 style="margin: 0 0 0.5rem 0; font-size: 1rem;"><?php _e('Custom Knitting Available', 'cotton-textile'); ?></h4>
                                <p style="margin: 0; font-size: 0.875rem; color: var(--slate);">
                                    <?php _e('We offer custom colors, patterns, and branding options for bulk orders. Contact us to discuss your requirements.', 'cotton-textile'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Full Gallery Section -->
    <?php if (!empty($gallery) && count($gallery) > 4) : ?>
        <section class="section bg-white">
            <div class="container">
                <div class="section-header">
                    <h2><?php _e('Product Gallery', 'cotton-textile'); ?></h2>
                </div>
                <div class="gallery-grid">
                    <?php foreach ($gallery as $index => $image) : ?>
                        <div class="gallery-item" data-index="<?php echo $index; ?>">
                            <img src="<?php echo esc_url($image['thumbnail']); ?>" alt="" data-full="<?php echo esc_url($image['url']); ?>">
                            <div class="gallery-item-overlay">
                                <i class="fas fa-expand"></i>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Related Products -->
    <?php
    $related_args = array(
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'post__not_in'   => array(get_the_ID()),
        'orderby'        => 'rand',
    );

    if ($categories && !is_wp_error($categories)) {
        $related_args['tax_query'] = array(
            array(
                'taxonomy' => 'product_category',
                'field'    => 'term_id',
                'terms'    => $categories[0]->term_id,
            ),
        );
    }

    $related = new WP_Query($related_args);

    if ($related->have_posts()) :
    ?>
        <section class="section">
            <div class="container">
                <div class="section-header">
                    <h2><?php _e('Related Products', 'cotton-textile'); ?></h2>
                </div>
                <div class="products-grid">
                    <?php while ($related->have_posts()) : $related->the_post(); ?>
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
            </div>
        </section>
    <?php
        wp_reset_postdata();
    endif;
    ?>

</main>

<!-- Lightbox -->
<div id="lightbox" class="lightbox">
    <div class="lightbox-content">
        <button class="lightbox-close" aria-label="Close">&times;</button>
        <button class="lightbox-nav lightbox-prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
        <img id="lightbox-image" src="" alt="">
        <button class="lightbox-nav lightbox-next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail gallery
    const thumbnails = document.querySelectorAll('.product-thumbnail');
    const mainImage = document.getElementById('main-image');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            if (mainImage) {
                mainImage.src = this.dataset.image;
            }
        });
    });

    // Lightbox
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const galleryItems = document.querySelectorAll('.gallery-item');
    let currentIndex = 0;
    const images = [];

    galleryItems.forEach((item, index) => {
        const img = item.querySelector('img');
        images.push(img.dataset.full);

        item.addEventListener('click', function() {
            currentIndex = index;
            lightboxImage.src = images[currentIndex];
            lightbox.classList.add('active');
        });
    });

    document.querySelector('.lightbox-close').addEventListener('click', () => {
        lightbox.classList.remove('active');
    });

    document.querySelector('.lightbox-prev').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        lightboxImage.src = images[currentIndex];
    });

    document.querySelector('.lightbox-next').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        lightboxImage.src = images[currentIndex];
    });

    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            lightbox.classList.remove('active');
        }
    });
});
</script>

<?php endwhile; ?>

<?php get_footer(); ?>
