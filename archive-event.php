<?php
get_header();
$hero = get_field('hero', 351);
$our_title = get_the_title(get_option('page_for_posts', true));
?>
<div id="single" class="page events lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
    <div class="page-header">
        <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
    </div>
    <section id="archive">
        <div class="container">
            <div class="grid">
                <div class="wrap">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
                            ?>
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
                    <?php endwhile; endif; ?>
                </div>
                <aside>
                    <h2>Archives</h2>
                    <ul class="inner">
                        <?php wp_get_archives('post_type=event'); ?>
                    </ul>
                </aside>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>