<?php
/*
Template Name: Home
*/
get_header(); ?>
<main>
<?php get_template_part('partials/index', 'hero'); ?>
<?php
    get_template_part(
        'partials/events', 'list',
        array(
            'events' => 6,
            'paginate' => false,
            'loadmore' => true,
            'show_title' => true, 
        )
    );
    ?>
<?php get_template_part('partials/social', 'feed'); ?>
</main>
<?php get_footer(); ?>