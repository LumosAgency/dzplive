<div class="featured">
    <div class="banner"><span class="text">Featured</span></div>
    <div class="slide-wrap owl-carousel">
        <?php
        $today = current_time('Y-m-d H:i:s');
        $args = array(
            'post_type'      => array('event', 'podcast', 'post'),
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'name',
                    'terms' => 'featured',
                    'include_children' => false
                ),
            ),
            'order'                  => 'DESC',
        );
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
        ?>
            <?php get_template_part(
                'partials/post',
                null,
                array(
                    'button' => 'Read More',
                    'excerpt' => true,
                )
            ); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>
</div>
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $('.featured .slide-wrap.owl-carousel').owlCarousel({
                items: 1,
                margin: 0,
                loop: true,
                center: false,
                autoplay: true,
                nav: true,
                lazyLoad: true,
                lazyLoadEager: 10,
                autoplayHoverPause: true,
                responsiveClass: true,
                autoplayTimeout: 6000,
                dots: false,
            });
        });
    })(jQuery);
</script>