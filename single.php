<?php get_header(); ?>
<?php $do_not_duplicate = array();
$hero = get_field('hero', 351);
if (have_posts()) : while (have_posts()) : the_post();
        $date = get_the_date();
        $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        $bgfallback = get_bloginfo('template_url') . '/src/img/thumbnail.png';
        $do_not_duplicate[] = $post->ID;
        ?>
        <div id="single" class="blog lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
            <div class="page-header">
                <h1><?php single_post_title(); ?></h1>
                <div class="share-wrap">
                    <?php get_template_part('partials/post', 'share'); ?>
                </div>
            </div>
            <article>
                <div class="container">
                    <div class="content">
                        <div class="inner">
                            <div class="details">
                                <div class="info">
                                    <?php if ($backgroundImg) { ?>
                                        <div class="lazy image" data-src="<?php echo $backgroundImg[0]; ?>"></div>
                                    <?php } else { ?>
                                        <div class="lazy image" data-src="<?php echo $bgfallback; ?>"></div>
                                    <?php } ?>
                                    <div class="table">
                                        <div class="row">
                                            <span class="label">Updated:</span>
                                            <?php echo $date; ?>
                                        </div>
                                        <?php get_template_part('partials/post', 'nav'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="description">
                                <div class="post-date">
                                    <?php the_date(); ?>
                                </div>
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($address) { ?>
                    <div id="map">
                        <div class="marker" data-lat="<?php echo esc_attr($address['lat']); ?>" data-lng="<?php echo esc_attr($address['lng']); ?>">
                            <div class="marker-inner">
                                <h3><?php echo esc_attr($term[0]->name); ?></h3>
                                <p><?php echo esc_attr($address['address']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </article>
        <?php
    endwhile;
    wp_reset_postdata();
else : ?>
        <article>
            <div class="container">
                <div class="content">
                    <h1>Sorry...</h1>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                </div>
            </div>
        </article>
    <?php endif; ?>
    <?php get_template_part('partials/post', 'slider'); ?>
        </div>
        <?php get_footer(); ?>