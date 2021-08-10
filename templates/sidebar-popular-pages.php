<div class="block newsletter cf">
	<h3><?php the_field('newsletter_title'); ?></h3>
    <?php 
		$form_object = get_field('newsletter_form');
		gravity_form_enqueue_scripts($form_object['id'], true);
		gravity_form($form_object['id'], false, false, false, '', true, 1); 
	?>
</div>

<!-- Most Popular Pages -->
<div class="block popular">
	<h3>Most Popular Pages</h3>
	<?php 
		$posts = wp_most_popular_get_popular( array( 
			'limit' => 6, 
			'post_type' => 'page', 
			'range' => 'all_time', 
			'exclude' => '60' 
			) 
		);
		global $post;
		
		if ( count( $posts ) > 0 ): 

			echo '<ol>';
				foreach ( $posts as $post ):
				setup_postdata( $post ); ?>
					<?php if(get_the_id() != 60): ?>
						<li>
							<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
								<?php get_the_title() ? the_title() : the_ID(); ?>
							</a>
						</li>
					<?php endif; 
				endforeach; 
			echo '</ol>';
			
		endif;
		wp_reset_postdata();
	?>
</div>

<!-- Custom Blocks -->
<?php 
	if(get_field('content_block')):
	while(has_sub_field('content_block')):
?>
<div class="block<?php if(get_sub_field('no_padding')) echo ' no-padding'; ?>" style="background: <?php the_sub_field('background'); ?>">
	<?php if(get_sub_field('title')): ?><h3><?php the_sub_field('title'); ?></h3><?php endif; ?>
    <?php the_sub_field('content'); ?>
</div>
<?php endwhile; endif; ?>
 