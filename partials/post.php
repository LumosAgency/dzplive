<article>
    <div class="inner">
        <div class="post-image image">
            <?php $backgroundImg = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'custom-post-thumb'); ?>
            <a href="<?php echo get_permalink(); ?>" aria-label="<?php the_title(); ?>">
                <div class="lazy bg-image" data-src="<?php echo $backgroundImg; ?>"></div>
            </a>
        </div>
        <div class="post-detail">
            <div class="post-title">
                <h3>
                    <a href="<?php echo get_permalink(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a>
                </h3>
            </div>
            <?php if ($args['excerpt']) { ?>
                <div class="post-description">
                    <p><?php echo get_the_excerpt(); ?></p>
                </div>
            <?php } ?>
            <a class="read-more" href="<?php echo get_permalink(); ?>">
                <span class="text"> <?php echo $args['button']; ?></span>
                <span class="border"></span>
            </a>
        </div>
    </div>
</article>