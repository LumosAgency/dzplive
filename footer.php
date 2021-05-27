</main>
<footer id="footer">
    <div class="container">
        <?php get_template_part('partials/social'); ?>
        <p>&copy; <?php echo date("Y"); ?> <?php echo get_bloginfo(); ?>. All Rights Reserved.</p>
    </div>
</footer>
<script type="text/javascript">
    (function($) {
        $('.lazy').lazyload();
        $('.toggle').click(function(){
            $(this).toggleClass('active');
            $('#main-menu').toggleClass('active');
        });
    })(jQuery);
</script>
<?php wp_footer(); ?>
</body>

</html>