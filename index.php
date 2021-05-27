<?php

/**
 * Template Name: News Archive
 */
get_header();
$hero = get_field('hero', 351);
$our_title = get_the_title(get_option('page_for_posts', true));
?>
<div id="single" class="page lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
    <div class="page-header">
        <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
    </div>
    <section id="archive">
        <div class="container">
            <div class="grid">
                <div class="wrap">
                <?php
                    $do_not_duplicate = array();
                    $today = current_time('Y-m-d H:i:s');
                    $args = array(
                        'post_type'  => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 5,
                        'post__not_in' => array($do_not_duplicate),
                        'order' => 'DESC',
                        'paged' => $paged
                    );
                    $news = new WP_Query($args);
                    $i = 1;
                    if ($news->have_posts()) : while ($news->have_posts()) : $news->the_post();

                    ?>
                            <?php get_template_part('partials/post', 'blog'); ?>
                    <?php $i++;
                        endwhile;
                    endif; ?>
                    <?php custom_pagination($news->max_num_pages, "", $paged); ?>
                </div>
                <aside>
                    <h2>Archives</h2>
                    <ul class="inner">
                        <?php wp_get_archives('post_type=post'); ?>
                    </ul>
                </aside>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>