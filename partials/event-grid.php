<?php
$event = get_field('event_date');
$eventStart = $event['start_date'];
$month = date("F", strtotime($eventStart));
$day = date("jS", strtotime($eventStart));
$year = date("Y", strtotime($eventStart));
$time = date("h:i A", strtotime($eventStart));
$date = $month . " " . $day . ", " . $year;
$backgroundImg = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'custom-post-thumb');
$term = get_the_terms($post->ID, 'venues');
$address = get_field('map', $term[0]->taxonomy . '_' . $term[0]->term_id);
?>
<div class="post" class="post" aria-label="<?php the_title(); ?>">
    <a href="<?php echo get_permalink(); ?>" class="info">
        <div class="lazy bg-image" data-src="<?php echo $backgroundImg; ?>"></div>
        <div class="post-date"><?php echo $date; ?> </div>
        <div class="details">
            <span>
                <h4><?php print the_title(); ?></h4>
                <?php if ($term[0]) { ?><p><?php echo esc_attr($term[0]->name); ?> | <?php if ($address) { ?><?php echo $address['city'] ?>, <?php echo $address['state']; ?><?php } ?></p><?php } ?>
            </span>
        </div>
    </a>
    <a href="<?php the_field('tickets_url') ?>" class="read-more">
        <?php if (get_field('custom_ticket_text')) { ?>
            <span class="text"><?php the_field('custom_ticket_text'); ?></span>
        <?php } else { ?>
            <span class="text">Purchase Tickets</span>
        <?php } ?>
        <span class="border"></span>
    </a>
</div>