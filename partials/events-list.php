<section id="events" class="events">
    <div class="container">
        <?php if ($args['show_title']) { ?>
        <h2>Upcoming Events</h2>
        <?php } ?>
        <div class="event-list">
            <div class="wrap">
                <div id="events-list" class="list">
                    <?php
                    $today = current_time('Y-m-d H:i:s');
                    $do_not_duplicate = array();
                    $args = array(
                        'post_type'  => 'event',
                        'post_status' => 'publish',
                        'posts_per_page' => $args['events'],
                        'meta_query' => array(
                            array(
                                'key'       => 'event_date_start_date',
                                'value'     => $today,
                                'compare'   => '>=',
                                'type'      => 'DATE',
                            ),
                        ),
                        'orderby'                => 'meta_value',
                        'order'                  => 'ASC',
                        'paginate' => $args['paginate'],
                        'loadmore' => $args['loadmore'],
                    );
                    $loop = new WP_Query($args);
                    while ($loop->have_posts()) : $loop->the_post();
                        get_template_part('partials/event', 'grid');
                    endwhile; ?>
                </div>
                <?php
                if ($args['loadmore']) {
                    if ($loop->max_num_pages > 1) {
                        echo '<div class="misha_loadmore read-more alt">Load More Events</div>';
                    }
                }
                if ($args['paginate']) {
                    custom_pagination($loop->max_num_pages, "", $paged);
                }
                wp_reset_postdata(); ?>
            </div>
            <aside>
                <h2>Just Announced</h2>
                <ul class="inner">
                    <?php
                    $today = current_time('Y-m-d H:i:s');
                    $args = array(
                        'post_type'  => 'event',
                        'post_status' => 'publish',
                        'posts_per_page' => 10,
                        'meta_query' => array(
                            array(
                                'key'       => 'event_date_start_date',
                                'value'     => $today,
                                'compare'   => '>=',
                                'type'      => 'DATE',
                            ),
                        ),
                        'orderby'                => 'publish_date',
                        'order'                  => 'DESC',
                    );
                    $loop = new WP_Query($args);
                    while ($loop->have_posts()) : $loop->the_post();
                        $event = get_field('event_date');
                        $eventStart = $event['start_date'];
                        $month = date("m", strtotime($eventStart));
                        $day = date("j", strtotime($eventStart));
                        $year = date("Y", strtotime($eventStart));
                        $date = $month . "/" . $day . "/" . $year;
                        $venue = get_field('venue');
                        $term = get_the_terms($post->ID, 'venues');
                        $address = get_field('map', $term[0]->taxonomy . '_' . $term[0]->term_id);
                    ?>
                        <li>
                            <a href="<?php echo get_permalink(); ?>" class="event" aria-label="<?php the_title(); ?>">
                                <span class="title"><?php print the_title(); ?></span>
                                <?php echo $date;
                                if ($term[0]) { ?> - <?php if ($address) { ?><?php echo $address['city'] ?>, <?php echo $address['state']; ?><?php } ?><?php } ?>
                            </a>
                        </li>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </ul>
            </aside>
        </div>
    </div>
</section>