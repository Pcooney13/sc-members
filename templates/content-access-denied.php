<style>
    .page-header {
        display:none!important;
    }
</style>

<div>
    <div class="video"><iframe src="<?php the_field('access_denied_video', 'options'); ?>" frameborder="0"></iframe></div>
    <div>
        <?php the_field('access_denied_text', 'options'); ?>
    </div>
</div>