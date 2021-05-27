<div class="container">
<div class="podcasts">
    <h3>Recent Podcasts</h3>
    <div class="wrap">
        <?php
        $today = current_time('Y-m-d H:i:s');
        $args = array(
            'post_type'      => array('podcast'),
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'order'                  => 'DESC',
        );
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
        ?>
            <?php get_template_part(
                'partials/post',
                null,
                array(
                    'button' => 'Listen Now',
                    'excerpt' => false,
                )
            ); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>
    <?php
    get_template_part(
        'partials/button',
        null,
        array(
            'text' => 'Browse More Podcasts',
            'url' => '/podcast/',
            'class' => 'alt',
            'external' => false,
        )
    );
    ?>
</div>
</div>