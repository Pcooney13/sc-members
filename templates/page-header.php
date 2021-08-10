<div class="page-header">
	<?php if (has_post_thumbnail()): ?>
  	<?php 
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'page-banner');
		$url = $image['0']; 
	?>
    <img src="<?php echo $url; ?>" class="img-responsive" alt="<?php echo roots_title(); ?>" />
  	<?php endif; ?>
  	<h2><?php echo roots_title(); ?></h2>
    <?php if (function_exists('yoast_breadcrumb') && !get_post_meta($post->ID, 'menu_page', true)): ?>
    <div class="sub-head">
        <?php yoast_breadcrumb('<div id="breadcrumbs">','</div>'); ?>
        <div id="social"><?php do_action( 'addthis_widget', get_permalink(), get_the_title(), 'small_toolbox'); ?></div>
    </div>
	<?php endif; ?>
</div>