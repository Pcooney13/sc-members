<?php 
	$user = wp_get_current_user(); 
	  
  	if (!empty($user->roles)) {
    	foreach($user->roles as $role) {
      		if ($role === 'reader') {
        		$full_site_access = false;
        		break;
      		} else {
        		$full_site_access = true;
      		}
    	}
  	}
?>

<!-- Page image -->
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


<style>
.material-block h4 {
    color: #fff; 
    background: #77B3D7; 
    padding: 10px 20px;
}
</style>

<div class="row">
	<div class="col-sm-12">
        <?php if(get_the_content() != ''): ?>
            <div class="row">
		        <div class="col-sm-12">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endif; ?>

<?php if ( have_rows('materials') ) : ?>

    <?php while( have_rows('materials') ) : the_row(); 
        
        if (get_sub_field('hide_from_lower-tier_members') == true  && $full_site_access == false ) :
            // do nothing
        else: ?>
            <div class="material-block">
                <h4 style=""><strong><?php the_sub_field('material_section_title');?></strong></h4>
                <?php the_sub_field('materials');?>
            </div>
        <?php endif;

    endwhile; ?>
<?php endif; ?>


	</div>
</div>

