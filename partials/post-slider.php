<?php
$hero = get_field('hero');
if (is_home()) {
    $do_not_duplicate = $hero['featured_post']->ID;
} else {
    $do_not_duplicate = get_the_ID();
}
$args = array(
    'post_type' => 'post',
    'posts_per_page'   => 10,
    'post__not_in' => array($do_not_duplicate),
);
$loop = new WP_Query($args); ?>
<div class="container">
    <div class="recent-blogs">
        <h3>In the News</h3>
        <div class="owl-carousel">
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                <article>
                    <?php get_template_part('partials/partial', 'post'); ?>
                </article>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
        <?php
        get_template_part(
            'partials/button',
            null,
            array(
                'text' => 'Read More News',
                'url' => '/news/',
                'class' => 'alt',
                'external' => false,
            )
        );
        ?>
    </div>
</div>
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $('.recent-blogs .owl-carousel').owlCarousel({
                items: 1,
                margin: 8,
                loop: true,
                center: false,
                autoplay: true,
                nav: true,
                lazyLoad: true,
                lazyLoadEager: 10,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    640: {
                        items: 2,
                    },
                    800: {
                        items: 3,
                    },
                    1000: {
                        items: 5,
                        margin: 24,
                    }
                }
            });
        });
    })(jQuery);
</script>