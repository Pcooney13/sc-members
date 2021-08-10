<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="page-header">
    	<h1><?php echo roots_title(); ?></h1>
        <?php if (function_exists('yoast_breadcrumb') && !get_post_meta($post->ID, 'menu_page', true)): ?>
        <div class="sub-head">
            <?php yoast_breadcrumb('<div id="breadcrumbs">','</div>'); ?>
             <div id="social"><?php do_action( 'addthis_widget', get_permalink(), get_the_title(), 'small_toolbox'); ?></div>
        </div>
        <?php endif; ?>
		<?php if (has_post_thumbnail()): ?>
        <?php 
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'page-banner');
            $url = $image['0']; 
        ?>
        <img src="<?php echo $url; ?>" class="img-responsive" alt="<?php echo roots_title(); ?>" />
        <?php endif; ?>
    </div>
    <?php if(in_category('staff')): //If is staff ?>
    	<div id="staff-bio">
    	<?php 
			$image = get_field('photo');
			if( !empty($image) ): 
				$url = $image['url'];
				$size = 'staff-photo';
				$thumb = $image['sizes'][ $size ];
				$position = get_field('position');
				if ($position == 'staff'):
					$title = get_field('title');
				else:
					$title = 'Regional Consultant (' . get_field('region') . ')';
				endif;
			?>
            <div id="photo">
            	<img class="img-responsive" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
                <a class="email" href="mailto:<?php the_field('email'); ?>"><i class="fa fa-envelope fa-lg"></i></a>
            </div>
			<?php endif; ?>
            <h3><?php echo $title; ?></h3>
            <?php the_field('bio'); ?>
        </div>
     <?php elseif(in_category('videos')): //If is video ?>
				<?php
                    $field = get_field_object('video_type');
                    $video_type = get_field('video_type');
                    if ($video_type == 'vimeo'):
                        $url = get_field('vimeo_link');
                        $url = str_replace("http:", "", $url);
                        $url = str_replace("https:", "", $url);
                        $url = str_replace("www.", "", $url);
                        $url = str_replace("vimeo.com", "", $url);
                        $url = str_replace("/", "", $url);
						$imgid = $url;
						$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
						echo $hash[0]['thumbnail_large'];  
                ?>
                <div class="entry-content-asset"><iframe src="//player.vimeo.com/video/<?php echo $url; ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
				<?php 
                    elseif ($video_type == 'youtube'):
                        $url = get_field('youtube_link');
                        $url = str_replace("http:", "", $url);
                        $url = str_replace("https:", "", $url);
                        $url = str_replace("www.", "", $url);
                        $url = str_replace("watch?v=", "", $url);
                        $url = str_replace("youtube.com", "", $url);
                        $url = str_replace("youtu.be", "", $url);
                        $url = str_replace("/", "", $url);
                ?>
                	<div class="entry-content-asset"><iframe src="//www.youtube.com/embed/<?php echo $url; ?>" frameborder="0" allowfullscreen></iframe></div>
					<?php else: $url = get_field('other'); ?>
                    <div id="video_other"><?php echo $url; ?></div>
                	<?php endif; ?>
                	
				<?php the_field('summary'); ?>
	<?php elseif(in_category('past-webinars')): //If is webinar ?>
    			
                <?php
                    $field = get_field_object('video_type');
                    $video_type = get_field('video_type');
                    if ($video_type == 'vimeo'):
                        $url = get_field('vimeo_link');
                        $url = str_replace("http:", "", $url);
                        $url = str_replace("https:", "", $url);
                        $url = str_replace("www.", "", $url);
                        $url = str_replace("vimeo.com", "", $url);
                        $url = str_replace("/", "", $url);
						$imgid = $url;
						$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
						echo $hash[0]['thumbnail_large'];  
                ?>
                <div class="entry-content-asset"><iframe src="//player.vimeo.com/video/<?php echo $url; ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
				<?php 
                    elseif ($video_type == 'youtube'):
                        $url = get_field('youtube_link');
                        $url = str_replace("http:", "", $url);
                        $url = str_replace("https:", "", $url);
                        $url = str_replace("www.", "", $url);
                        $url = str_replace("watch?v=", "", $url);
                        $url = str_replace("youtube.com", "", $url);
                        $url = str_replace("youtu.be", "", $url);
                        $url = str_replace("/", "", $url);
                ?>
                	<div class="entry-content-asset"><iframe src="//www.youtube.com/embed/<?php echo $url; ?>" frameborder="0" allowfullscreen></iframe></div>
					<?php else: $url = get_field('other'); ?>
                    <div id="video_other"><?php echo $url; ?></div>
                	<?php endif; ?>
                	
				<?php the_field('summary'); ?>
                
                <?php if( have_rows('additional_resources') ): ?>
                    <p><strong>Additional Resources</strong></p>
                    <ul>
    					<?php 
							while ( have_rows('additional_resources') ) : the_row(); 
							$format = get_sub_field('format');
							if($format == 'link'):
								$resource = get_sub_field('link');
							else:
								$resource = get_sub_field('file');
							endif;
						?>
                    	<li><a href="<?php echo $resource; ?>" target="_blank"><?php the_sub_field('title'); ?></a></li>
                    	<?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                
	<?php else: ?>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <?php endif; ?>
    <?php /* comments_template('/templates/comments.php'); */ ?>
  </article>
<?php endwhile; ?>
