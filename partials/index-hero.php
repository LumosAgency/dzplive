<?php $hero = get_field('hero'); ?>
<section class="hero lazy" data-src="<?php echo $hero['background_image'] ?>">
    <div class="container">
        <div class="page-header">
            <h1><?php echo $hero['subtitle'] ?></h1>
        </div>
        <div class="hero-wrap">
        <?php get_template_part('partials/newsletter'); ?>
        <?php get_template_part('partials/post', 'featuredslider'); ?>
        </div>
    </div>
    <?php get_template_part('partials/podcast', 'three'); ?>
    <?php get_template_part('partials/post', 'slider'); ?>
</section>