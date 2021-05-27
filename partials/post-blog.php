<article class="post-grid" aria-label="<?php the_title(); ?>">
    <?php
    $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    $bgfallback = get_bloginfo('template_url') . '/src/img/thumbnail.png';
    $date = get_the_date(); ?>
    <a href="<?php echo get_permalink(); ?>" class="info">
    <?php if ($backgroundImg){ ?>
        <div class="lazy bg-image" data-src="<?php echo $backgroundImg[0]; ?>"></div>
    <?php } else { ?>
        <div class="lazy bg-image" data-src="<?php echo $bgfallback; ?>"></div>
    <?php } ?>
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