<?php
/**
 * The main template file
 *
 * @package Cotton_Textile
 */

get_header();
?>

<main id="main-content">
    <?php if (have_posts()) : ?>

        <!-- Page Header -->
        <div class="page-header">
            <div class="container">
                <?php if (is_home() && !is_front_page()) : ?>
                    <h1><?php single_post_title(); ?></h1>
                <?php elseif (is_archive()) : ?>
                    <h1><?php the_archive_title(); ?></h1>
                    <?php the_archive_description('<p>', '</p>'); ?>
                <?php elseif (is_search()) : ?>
                    <h1><?php printf(__('Search Results for: %s', 'cotton-textile'), get_search_query()); ?></h1>
                <?php else : ?>
                    <h1><?php _e('Latest Posts', 'cotton-textile'); ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <section class="section">
            <div class="container">
                <div class="products-grid">
                    <?php while (have_posts()) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('product-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="product-card-image">
                                    <?php the_post_thumbnail('product-thumbnail'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="product-card-content">
                                <h2 class="product-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <?php if (has_excerpt()) : ?>
                                    <p class="product-card-desc"><?php echo get_the_excerpt(); ?></p>
                                <?php endif; ?>
                            </div>
                        </article>

                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination" style="margin-top: 3rem; display: flex; justify-content: center; gap: 0.5rem;">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i>',
                        'next_text' => '<i class="fas fa-chevron-right"></i>',
                    ));
                    ?>
                </div>
            </div>
        </section>

    <?php else : ?>

        <section class="section">
            <div class="container text-center">
                <div style="padding: 4rem 0;">
                    <i class="fas fa-search" style="font-size: 3rem; color: var(--silver); margin-bottom: 1rem;"></i>
                    <h2><?php _e('No Content Found', 'cotton-textile'); ?></h2>
                    <p style="color: var(--slate);"><?php _e('Sorry, no content matched your criteria.', 'cotton-textile'); ?></p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary" style="margin-top: 1.5rem;">
                        <?php _e('Return Home', 'cotton-textile'); ?>
                    </a>
                </div>
            </div>
        </section>

    <?php endif; ?>
</main>

<?php get_footer(); ?>
