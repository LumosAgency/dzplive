<?php
get_header(); ?>
<?php $do_not_duplicate = array();
$hero = get_field('hero', 351);
$date = get_the_date();
if (have_posts()) : while (have_posts()) : the_post();
        $date = get_the_date();
        $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        $do_not_duplicate[] = $post->ID;
?>
        <div id="single" class="page lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
            <div class="page-header">
                <h1><?php the_title(); ?></h1>
            </div>
            <article>
                <div class="container">
                    <div class="content">
                        <div class="inner">
                            <div class="description">
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