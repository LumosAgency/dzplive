<section class="events">
    <div class="container">
        <h2>Just Announced</h2>
        <div class="wrap">
            <?php
            $args = array(
                'post_type'  => 'event',
                'post_status' => 'publish',
                'posts_per_page' => 12,
                'orderby'                => 'date',
                'order'                  => 'ASC'
            );
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
                $event = get_field('event_date');
                $eventStart = $event['start_date'];
                $month = date("F", strtotime($eventStart));
                $day = date("jS", strtotime($eventStart));
                $year = date("Y", strtotime($eventStart));
                $time = date("h:i A", strtotime($eventStart));
                $date = $month . " " . $day . ", " . $year;
                $venue = get_field('venue');
                $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            ?>
                <a href="<?php echo get_permalink(); ?>" class="event" aria-label="<?php the_title(); ?>">
                    <?php echo $date; ?> | <?php print the_title(); ?> <?php echo esc_html($venue->name); ?>
                </a>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>