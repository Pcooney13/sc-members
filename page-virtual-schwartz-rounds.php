<?php get_template_part('templates/page', 'header'); ?>
<style>
    .virtual-schwartz-rounds p {
        line-height:1.5;
    }
    .virtual-schwartz-rounds .virtual-list,
    .virtual-schwartz-rounds .virtual-text-sections {
        padding-bottom:20px;
    }
    .virtual-schwartz-rounds .panel-heading {
        background-color:#77B3D7;
        color:white;
    }
    .virtual-schwartz-rounds ul {
        padding-left:30px;
    }
    .virtual-schwartz-rounds .virtual-list-item p {
        padding:0 0 0 15px;
    }
    .virtual-schwartz-rounds .virtual-list-item ul li > p {
        padding:0;
    }
    .virtual-schwartz-rounds .disclaimer {
        padding-top:30px;
        border-top:1px solid #ddd;
    }
</style>

<!-- Sections 1 & 2 -->
<div class="virtual-text-sections">
    <!-- Section 1 -->
    <div class="text-section">
        <h3 style="color:#3d85c6;"><?php the_field('section_title_1'); ?></h3>
        <?php $image = get_field('section_image_1');
        if( !empty( $image ) && get_field('show_image_2')): ?>
            <img style="float:<?php the_field('align_image_1'); ?>; max-width:350px; padding: 0 15px 15px 0;" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
        <?php the_field('section_text_1'); ?>
    </div>
    <!-- Section 2 -->
    <div class="text-section">
        <h3 style="color:#3d85c6;"><?php the_field('section_title_2'); ?></h3>
        <?php $image = get_field('section_image_2');
        if( !empty( $image ) && get_field('show_image_2')): ?>
            <img style="float:<?php the_field('align_image_2'); ?>; max-width:350px; padding: 0 15px 15px 0;" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
        <?php the_field('section_text_2'); ?>
    </div>
</div>

<!-- List Items -->
<div class="virtual-list">
    <?php if( have_rows('list_item') ): 
        $counter = 1; ?>
        <?php while ( have_rows('list_item') ) : the_row(); ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="panel-title"><a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapsey<?php echo $counter;?>"><?php the_sub_field('list_title'); ?></a></p>
                </div>
                <div id="collapsey<?php echo $counter;?>" class="panel-collapse collapse collapsed">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php the_sub_field('list'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $counter++; ?>
        <?php endwhile; ?>
    <?php endif;?>
</div>

<div class="disclaimer">
    <?php the_field('disclaimer'); ?>
</div>




        
 
