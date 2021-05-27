<?php $featuredEvent = get_field('featured_event'); ?>
<?php if ($featuredEvent) { ?>
    <div class="container">
        <div class="featured-event">
            <?php
            $post_object = $featuredEvent;
            if ($post_object) :
                global $post;
                $post = $post_object;
                setup_postdata($post);
            ?>
                <div class="post-title">
                    <h3>
                        <a href="<?php echo get_permalink(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </h3>
                </div>
                <div class="inner">
                    <div class="post-image">
                        <?php $backgroundImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                        <a href="<?php echo get_permalink(); ?>" aria-label="<?php the_title(); ?>">
                            <div class="lazy bg-image" data-src="<?php echo $backgroundImg; ?>"></div>
                        </a>
                    </div>
                    <div class="post-detail">
                        <div class="post-description">
                            <p><?php echo get_the_excerpt(); ?></p>

                            <a class="read-more" href="<?php echo get_permalink(); ?>">
                                <span class="text">read more</span>
                                <span class="border"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>
<?php } ?>