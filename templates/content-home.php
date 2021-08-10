<?php while (have_posts()) : the_post(); ?>
    <div class="home-intro">
        <?php the_content(); ?>
    </div>
    <?php 
        if(have_rows('banner')): 
        $count = 0; 
        $slides = count(get_field('banner'));
    ?>
    <div id="#banner-wrap" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php for ($i = 0; $i < $slides; $i++): ?>
            <li data-target=".carousel" data-slide-to="<?php echo $i; ?>"<?php if($i == 0) echo ' class="active"'; ?>></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
        <?php while ( have_rows('banner') ) : the_row();
            if (get_sub_field('external_link')) { $link = get_sub_field('external_link'); $target="_blank"; } else { $link = get_sub_field('page_link'); $target="_self"; }
            $image = get_sub_field('image');
            $url = $image['url'];
            $size = 'page-banner';
            $banner = $image['sizes'][ $size ];
        ?>
        <div class="item<?php if($count == 0){ echo ' active'; } ?>">
            <a href="<?php echo $link; ?>" target="<?php echo $target; ?>"><img src="<?php echo $banner; ?>" alt="<?php the_sub_field('title'); ?>"></a>
            <div class="caption">
                <h2><?php the_sub_field('title'); ?></h2>
                <p><?php the_sub_field('text'); ?></p>
                <a class="more" href="<?php echo $link; ?>" target="<?php echo $target; ?>"><?php the_sub_field('link_text'); ?></a>
            </div> 
        </div>     
        <?php $count++;endwhile; ?>
        </div>
        <a class="left carousel-control" href=".carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href=".carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
    <?php endif; ?>
<?php endwhile; ?>
