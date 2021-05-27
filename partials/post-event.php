<article class="post-grid" aria-label="<?php the_title(); ?>">
    <?php
    $event = get_field('event_date');
    $eventStart = $event['start_date'];
    $month = date("F", strtotime($eventStart));
    $day = date("jS", strtotime($eventStart));
    $year = date("Y", strtotime($eventStart));
    $time = date("h:i A", strtotime($eventStart));
    $date = $month . " " . $day . ", " . $year;
    $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    $date = get_the_date(); ?>
    <a href="<?php echo get_permalink(); ?>" class="info">
        <div class="lazy bg-image" data-src="<?php echo $backgroundImg[0]; ?>"></div>
    </a>
    <div>
        <h2><?php print the_title(); ?></h2>
        <div class="post-date"><?php echo $date; ?></div>
        <div class="excerpt">
            <?php the_excerpt(); ?>
        </div>
        <?php
        get_template_part(
            'partials/button',
            null,
            array(
                'text' => 'Read More',
                'url' => get_permalink(),
            )
        );
        ?>
    </div>
</article>
