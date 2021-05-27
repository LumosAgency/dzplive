<?php get_header(); ?>
<?php $do_not_duplicate = array();
$hero = get_field('hero', 351);
if (have_posts()) : while (have_posts()) : the_post();
        $date = get_the_date();
        $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
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
                                <div class="image" style="background-image: url('<?php echo $backgroundImg[0]; ?>');">

                                </div>
                                <div class="table">
                                    <div class="row">
                                        <span class="label">Updated:</span>
                                        <?php echo $date; ?>
                                    </div>
                                    <?php get_template_part('partials/post', 'nav'); ?>
                                    <div class="row">
                                        <?php
                                        get_template_part(
                                            'partials/button',
                                            null,
                                            array(
                                                'text' => 'Subscribe on Youtube',
                                                'url' => 'https://www.youtube.com/channel/UCt6AlrfchGadHeVTJ6Dyo4Q',
                                                'external' => 'true',
                                            )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="description">
                                <div class="post-date">
                                    <?php the_date(); ?>
                                </div>
                                <?php the_content(); ?>
                                <div class="iframe-wrap">
                                    <?php the_field('media_link'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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