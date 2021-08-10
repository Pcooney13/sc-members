<?php if(get_field('newsletter_signup', 'option')): ?>
<div class="block newsletter cf"<?php if(get_field('newsletter-background')):?> style="background: <?php the_field('newsletter-background'); ?>"<?php endif; ?>>
	<h3><?php the_field('newsletter_title'); ?></h3>
    <?php 
		$form_object = get_field('newsletter_form');
		gravity_form_enqueue_scripts($form_object['id'], true);
		gravity_form($form_object['id'], false, false, false, '', true, 1); 
	?>
</div>
<?php endif; ?>

<!-- Most Popular Pages -->
<div class="block popular"<?php if(get_field('popular-background')):?> style="background: <?php the_field('popular-background'); ?>"<?php endif; ?>>
	<h3>Most Popular Pages</h3>
	<?php 
	$posts = get_field('popular_pages');
	if( $posts ): ?>
		<ol>
		<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
			<?php setup_postdata($post); ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endforeach; ?>
		</ol>
		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php endif; ?>
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
 