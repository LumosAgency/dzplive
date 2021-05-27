<div class="post" class="post" aria-label="<?php the_title(); ?>">
    <?php
    $backgroundImg = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'custom-post-thumb');
    $bgfallback = get_bloginfo('template_url') . '/src/img/thumbnail.png';
    $date = get_the_date(); ?>
    <a href="<?php echo get_permalink(); ?>" class="info">
        <?php if ($backgroundImg) { ?>
            <div class="lazy bg-image owl-lazy" data-src="<?php echo $backgroundImg; ?>"></div>
        <?php } else { ?>
            <div class="lazy bg-image owl-lazy" data-src="<?php echo $bgfallback; ?>"></div>
        <?php } ?>
        <div class="post-date"><?php echo $date; ?> </div>
        <div class="details">
            <span>
                <h4><?php print the_title(); ?></h4>
            </span>
        </div>
    </a>
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