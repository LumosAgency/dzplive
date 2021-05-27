<?php if (get_previous_post()) { ?>
    <div class="row">
    <span class="label">Previous:</span>
        <?php previous_post_link('%link', '%title'); ?>
    </div>
<?php } ?>
<?php if (get_next_post()) { ?>
    <div class="row">
    <span class="label">Up Next:</span>
        <?php next_post_link('%link', '%title'); ?>
    </div>
<?php } ?>