<section class="blog-posts">
    <div class="container">
        <h2>Recent Posts</h2>
        <div class="wrap">
            <?php
            $today = current_time('Y-m-d H:i:s');
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'ASC'
            );
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
                $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            ?>
                <a href="<?php echo get_permalink(); ?>" class="post" aria-label="<?php the_title(); ?>" style="background-image: url('<?php echo $backgroundImg[0]; ?>')">
                    <div class="details">
                        <h3><?php print the_title(); ?></h3>
                    </div>
                    <div class="post-meta">
                        <div class="post-date">
                            <?php the_time('F jS'); ?>, <?php the_time('Y'); ?></span>
                        </div>
                    </div>
                    <div class="post-description">
                        <p><?php echo get_the_excerpt(); ?></p>

                        <a class="read-more" href="<?php echo get_permalink(); ?>">
                            <span class="text">read more</span>
                            <span class="border"></span>
                        </a>
                    </div>
                </a>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>