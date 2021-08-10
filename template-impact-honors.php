<?php
/*
 * Template Name: Impact Honors Template
 * Description: Impact Honors Template
 */
?>
<h1 style="text-align: center; color:#4d85c5;"><strong><?php the_field('title'); ?></strong></h1>
<p style="text-align: center;"><?php the_field('subtext'); ?></p>

<?php
if (have_rows('honoree')):
    while (have_rows('honoree')) : the_row(); 

        $image = get_sub_field('image');
        $url = get_sub_field('video') . '#t=0.5';
        $logo = get_sub_field('logo'); ?>

        <div class="honoree-block">
            <?php if (!empty($logo)): ?>
                <p style="text-align: center;">
                    <img class="size-medium wp-image-8134 img-responsive aligncenter" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                </p>
            <?php endif; ?>
            <h5 style="text-align: center;"><strong><?php the_sub_field('name'); ?>, <?php the_sub_field('location'); ?></strong></h5>
            <h5 style="text-align: center;"><strong><?php the_sub_field('subtitle'); ?></strong></h5>
            
            <?php if (get_sub_field('video')): ?>
                <!-- <video style="position:relative" controls="controls" preload="metadata"> -->
                <video style="position:relative" controls="controls">
                    <source src="<?php echo $url; ?>" type="video/mp4">
                </video>
            <?php elseif (!empty($image)): ?>
                <img class="alignleft" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="479" height="319" />
            <?php endif; ?>
            <?php the_sub_field('description'); ?>
        </div>
        <hr style="padding-bottom:45px;"/>
    <?php endwhile;
endif; ?>

<a href="<?php the_field('link');?>">
    <?php the_field('link_text');?>
</a>  
