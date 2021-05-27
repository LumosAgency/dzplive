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
                            <?php get_template_part('partials/post', 'blog'); ?>
                    <?php endwhile; endif; ?>
                </div>
                <aside>
                    <h2>Archives</h2>
                    <ul class="inner">
                        <?php wp_get_archives('post_type=podcast'); ?>
                    </ul>
                </aside>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>