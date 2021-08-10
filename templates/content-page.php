<?php 
  // Does current user have $full_site_access?
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

      the_field('restrict_members');

?>
<div class="row">
	<div class="col-sm-12">
        <?php if(get_the_content() != ''): ?>
            <div class="row">
		        <div class="col-sm-12">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ($full_site_access || is_page(11) || is_page(19881)) :?>
            <?php if (!$full_site_access) :?>
                <style>
                    .hidden-lower {
                        display:none!important;
                    }
                </style>
            <?php endif; ?>
            
            <?php if (get_post_meta($post->ID, 'menu_page', true)): $count=1; ?>
                <div class="row">
                <?php
			        $mypages = get_pages(array('child_of' => $post->ID, 'parent' => $post->ID,'sort_column' => 'menu_order', 'sort_order' => 'asc'));
			        foreach( $mypages as $page ):	
		            ?>
                    <div class="col-md-6">
            	        <div class="menu-block">
                            <div class="img-wrapper">
                    	        <a href="<?php echo get_page_link($page->ID); ?>">
                                <h3><?php echo $page->post_title; ?></h3>
                                <?php 
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'menu-thumb' ); 
                                    $thumb = $thumb['0'];
                                ?>
                                <img class="img-responsive" src="<?php echo $thumb; ?>" alt="<?php echo $page->post_title; ?>" title="<?php echo $page->post_title; ?>">
                                <span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-angle-right fa-stack-1x fa-inverse"></i></span>
                                <span class="gradient"></span>
                                </a>

                            </div>
                            <p><?php the_field('page_summary', $page->ID); ?></p>
            	        </div>
                    </div>
                <?php if($count % 2 === 0): ?>
		        </div>
                <div class="row">
		        <?php endif; ?>
		        <?php $count++; endforeach; ?>
                </div>
            <?php else: 
                // MAKE SURE USER IS ALLOWED TO SEE THIS
                $user_id = get_current_user_id();
                $user_meta = get_userdata($user_id);
                $user_roles = $user_meta->roles;
                // Checks if current user is on the list of priviledged users
                if (is_page(11) || is_page(19881) || in_array($user_roles[0], members_get_post_roles(20243), true)) : 
                    if( have_rows('custom_content') ):
                        while ( have_rows('custom_content') ) : the_row();
                ?>

                            <?php if( get_row_layout() == 'content_block' ): ?>
                            
                                <div class="row">
                                    <div class="col-sm-12">
                                    <?php the_sub_field('content'); ?>
                                    </div>
                                </div>
                            
                            <?php elseif( get_row_layout() == 'accordian_content' ): ?>
                            
                                <div class="accordian">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <?php if(have_rows('accordian_block')): $count = 0;
                                    while (have_rows('accordian_block')) : the_row(); ?>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <p class="panel-title">
                                                    <a data-toggle="collapse"<?php if($count != 0) echo ' class="collapsed"' ?> data-parent="#accordion" href="#collapse<?php echo $count; ?>">
                                                        <?php the_sub_field('title'); ?>
                                                    </a>
                                                </p>
                                            </div>
                                            <div id="collapse<?php echo $count; ?>" class="panel-collapse collapse <?php if($count != 0) { echo 'collapsed'; } else { echo 'in'; } ?>">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <?php the_sub_field('content'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php $count++;endwhile;endif; ?>
                                    </div>
                                </div>        

                            <?php endif; 
                        
                        endwhile;
                    endif;
                endif;?>
                
            <?php endif; ?>
        <?php else:
            $featured_posts = get_field('limited_page_menu');
            if( $featured_posts ): ?>
                <div class="row">
                    <?php foreach( $featured_posts as $featured_post ): 
                        $permalink = get_permalink( $featured_post->ID );
                        $title = get_the_title( $featured_post->ID );
                        $custom_field = get_field( 'field_name', $featured_post->ID );
                        ?>
                        <div class="col-md-6">
            	            <div class="menu-block">
                                <div class="img-wrapper">
                    	            <a href="<?php echo esc_url( $permalink ); ?>">
                                    <h3><?php echo esc_html( $title ); ?></h3>
                                    <?php 
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($featured_post->ID ), 'menu-thumb' ); 
                                        $thumb = $thumb['0'];
                                    ?>
                                    <img class="img-responsive" src="<?php echo $thumb; ?>" alt="<?php echo $featured_post->post_title; ?>" title="<?php echo $featured_post->post_title; ?>">
                                    <span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-angle-right fa-stack-1x fa-inverse"></i></span>
                                    <span class="gradient"></span>
                                    </a>

                                </div>
                                <p><?php the_field('page_summary', $featured_post->ID ); ?></p>
            	            </div>
                        </div>                        
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (get_field('member_content_access')) : ?>
            <?php while( have_rows('member_content_access') ) : the_row();
                $access = get_sub_field('who_can_view_this_content'); 
                
                if ($access == 'all') : ?>
                    <div style="padding-bottom:30px;"><?php the_sub_field('content') ?></div>
                <?php elseif ($access == 'full' && $full_site_access) : ?>
                    <div style="padding-bottom:30px;"><?php the_sub_field('content') ?></div>
                <?php elseif ($access == 'lower' && !$full_site_access) : ?>
                    <div style="padding-bottom:30px;"><?php the_sub_field('lower_content') ?></div>
                <?php endif; ?>                
                
                <?php the_sub_field('');?>
            <?php endwhile; ?>
        <?php endif; ?>
	</div>
</div>