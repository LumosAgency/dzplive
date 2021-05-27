<?php

/**
 * Template Name: Blog
 */
get_header();
$hero = get_field('hero', 351);
$our_title = get_the_title( get_option('page_for_posts', true) );
?>
<div id="single" class="page lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
    <div class="page-header">
    <h1><?php single_post_title(); ?></h1>
    </div>
    <div class="container">
        <?php
        $do_not_duplicate = array();
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'post',
            'posts_per_page'   => 5,
            'post__not_in' => $do_not_duplicate,
        );
        $loop = new WP_Query($args);
        $i = 1;
        if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
                <?php get_template_part('partials/blog', 'post'); ?>
            <?php $i++;
            endwhile;  ?>
            <?php
            custom_pagination($loop->max_num_pages, "", $paged);
            ?>
        <?php else : ?>
            <article>
                <h1>Sorry...</h1>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            </article>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>