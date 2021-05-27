<?php
get_header();
$hero = get_field('hero', 351);
$our_title = get_the_title(get_option('page_for_posts', true));
?>
<div id="single" class="page events lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
    <div class="page-header">
    <h1><?php the_title(); ?></h1>
    </div>
    <section id="archive">
        <div class="container">
            <div class="grid-1">
                <div class="wrap">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>