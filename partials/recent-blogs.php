<div class="container">
        <div class="recent-blogs">
            <h3>In the News</h3>
            <div class="wrap">
                <?php
                $hero = get_field('hero');
                $today = current_time('Y-m-d H:i:s');
                $args = array(
                    'post_status' => 'publish',
                    'post__not_in' => array($hero['featured_post']->ID),
                    'posts_per_page' => 4,
                    'orderby' => 'publish_date',
                    'order' => 'DESC'
                );
                $loop = new WP_Query($args);
                while ($loop->have_posts()) : $loop->the_post();
                    $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                ?>
                    <a href="<?php echo get_permalink(); ?>" class="post" aria-label="<?php the_title(); ?>">
                        <div class="bg-image" data-src="<?php echo $backgroundImg[0]; ?>"></div>
                        <div class="post-date">
                            <?php the_time('F jS'); ?>, <?php the_time('Y'); ?>
                        </div>
                        <div class="details">
                            <h4><?php print the_title(); ?></h4>
                        </div>
                        <button class="read-more" href="<?php echo get_permalink(); ?>">
                            <span class="text">read more</span>
                            <span class="border"></span>
                        </button>
                    </a>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>