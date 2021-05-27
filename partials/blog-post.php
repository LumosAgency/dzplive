<article class="post post-blog" aria-label="<?php the_title(); ?>">
    <?php
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