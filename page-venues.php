<?php

/**
 * Template Name: Venues
 */
get_header();
$hero = get_field('hero', 351);
$our_title = get_the_title(get_option('page_for_posts', true));
?>
<article id="single" class="page venues lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
    <div class="page-header">
        <h1><?php single_post_title(); ?></h1>
    </div>
    <div class="container">
        <div class="venue-list">
            <div class="wrap">
                <?php if (have_posts()) : while (have_posts()) : the_post();

                        $terms = get_terms('venues');

                        foreach ($terms as $term) {

                            // The $term is an object, so we don't need to specify the $taxonomy.
                            $term_link = get_term_link($term);
                            $thumb = get_field('thumbnail', $term->taxonomy . '_' . $term->term_id);
                            $address = get_field('map', $term->taxonomy . '_' . $term->term_id);
                            // If there was an error, continue to the next term.
                            if (is_wp_error($term_link)) {
                                continue;
                            }
                ?>
                            <div class="post" class="post" aria-label="<?php the_title(); ?>">
                                <a href="<?php echo $term_link; ?>" class="info">
                                    <div class="lazy bg-image" data-src="<?php echo $thumb; ?>"></div>
                                    <div class="details">
                                        <span>
                                            <h4><?php echo $term->name; ?></h4>
                                            <p><?php echo esc_html($address['city']) .', '.esc_html($address['state']); ?></p>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }

                        ?>

                    <?php endwhile;
                else : ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>
<?php get_footer(); ?>