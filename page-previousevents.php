<?php

/**
 * Template Name: Previous Events
 */
get_header();
$hero = get_field('hero', 351);
$our_title = get_the_title(get_option('page_for_posts', true));
?>
<div id="single" class="page events lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
    <div class="page-header">
        <h1><?php single_post_title(); ?></h1>
    </div>
    <section id="archive">
        <div class="container">
            <div class="grid">
                <div class="wrap">
                    <?php
                    $do_not_duplicate = array();
                    $today = current_time('Y-m-d H:i:s');
                    $args = array(
                        'post_type'  => 'event',
                        'post_status' => 'publish',
                        'posts_per_page' => 5,
                        'post__not_in' => array($do_not_duplicate),
                        'meta_query' => array(
                            array(
                                'key'       => 'event_date_start_date',
                                'value'     => $today,
                                'compare'   => '<',
                                'type'      => 'DATE',
                            ),
                        ),
                        'orderby'                => 'meta_value',
                        'order'                  => 'DESC',
                        'paged' => $paged
                    );
                    $events = new WP_Query($args);
                    $i = 1;
                    if ($events->have_posts()) : while ($events->have_posts()) : $events->the_post();

                    ?>
                            <?php get_template_part('partials/post', 'event'); ?>
                    <?php $i++;
                        endwhile;
                    endif; ?>
                    <?php custom_pagination($events->max_num_pages, "", $paged); ?>
                </div>
                <aside>
                    <h2>Archives</h2>
                    <ul class="inner">
                        <?php wp_get_archives('post_type=event'); ?>
                    </ul>
                </aside>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>