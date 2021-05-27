<?php

/**
 * Template Name: Events
 */
get_header();
$hero = get_field('hero', 351);
$our_title = get_the_title(get_option('page_for_posts', true));
?>
<div id="single" class="page events lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
    <div class="page-header">
        <h1><?php single_post_title(); ?></h1>
    </div>
    <?php
    get_template_part(
        'partials/events', 'list',
        array(
            'events' => 15,
            'paginate' => false,
            'loadmore' => true,
            'show_title' => false, 
        )
    );
    ?>
</div>
<?php get_footer(); ?>