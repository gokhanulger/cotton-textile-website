<?php
/**
 * Page Template
 *
 * @package Cotton_Textile
 */

get_header();
?>

<main id="main-content">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Page Header -->
        <div class="page-header">
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>

        <section class="section">
            <div class="container">
                <div style="max-width: 900px; margin: 0 auto;">
                    <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div style="margin-bottom: 2rem; border-radius: 1rem; overflow: hidden;">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content" style="font-size: 1.125rem; line-height: 1.8; color: var(--steel);">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('Pages:', 'cotton-textile'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>
                    </article>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
