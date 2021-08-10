<?php get_template_part('templates/head'); ?>

<?php 
  // Does current user have $full_site_access?
	$user = wp_get_current_user(); 
	  
  	if (!empty($user->roles)) {
    	foreach($user->roles as $role) {
      		if ($role === 'reader') {
        		$full_site_access = false;
        		break;
      		} else {
        		$full_site_access = true; ?>
            <style>
            .page-item-11 ul {
              display:none;
            }
            </style>
      		<?php }
    	}
  	}
?>

<body <?php body_class(); ?>>



  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

    <?php
        do_action('get_header');
        // Use Bootstrap's navbar if enabled in config.php
        if (current_theme_supports('bootstrap-top-navbar')) {
            get_template_part('templates/header-top-navbar');
        } else {
            get_template_part('templates/header');
        }
    ?>

    <div class="wrap container" role="document">
        <div class="content row">
      	    <?php if(roots_display_sidebar() && !is_front_page() && !is_search() && !is_page('contact-us')): ?>
                <!-- Limited Access - Custom sidebar -->
                <?php if(!$full_site_access && is_page(array(17, 20252, 20264, 1234))) :?>
                    
                    
                        <aside class="sidebar menu <?php echo roots_sidebar_class(); ?>" role="complementary">    
                
		                   <h3> Member Support</h3>
                            <ul class="int-menu">
                    	        <li class="page_item <?php if(get_the_ID() === 20252) {echo ' current_page_item'; } ?>"><a href="/members/educational-programming/online-learning/">Online Learning</a></li>
                                <li class="page_item <?php if(get_the_ID() === 20264) {echo ' current_page_item'; } ?>"><a href="/members/educational-programming/community-connections/">Community Connections</a></li>
                                <li class="page_item"><a target="_blank" href="https://www.theschwartzcenter.org/join/healthcare-membership/creative-ways-to-fund-your-schwartz-center-membership/">Funding Your Membership</a></li>
                                <li class="page_item <?php if(get_the_ID() === 1234) {echo ' current_page_item'; } ?>"><a href="/members/educational-programming/compassion-action-webinars/">Compassion in Action Webinars</a></li>
                            </ul>
                        
                        </aside>
     	            
                
                <!-- Full access - normal sidebar -->
                <?php else: ?>
		              <aside class="sidebar menu <?php echo roots_sidebar_class(); ?>" role="complementary">
                
	  	                <?php 
                            $topPage = get_post_top_ancestor_id();
	  	        	        if($post->post_parent || $topPage == get_the_ID()):
		        		        $children = wp_list_pages("title_li=&child_of=".$topPage."&echo=0");
		        	  	        $titlenamer = get_the_title($topPage);
		          	        endif; 
                        ?>
		                <?php if ($children) : ?>
                            <h3><?php echo $titlenamer; ?></h3>
                            <ul class="int-menu">
                                <?php echo $children; ?>
                            </ul>
                        <?php else: ?>
       	        	        <h3><?php echo $titlenamer; ?></h3>
                            <ul class="int-menu">
                    	        <li class="page_item current_page_item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            </ul>
     	                <?php endif; ?>
                        
                    </aside>
                
                <?php endif;?>
            <?php endif; ?>
      <main class="main <?php echo roots_main_class(); ?>" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
      <?php if (roots_display_sidebar()) : ?>
      	<?php if (is_front_page() || is_search() || is_page('contact-us')): ?>
        <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
          <?php include roots_sidebar_path(); ?>
        </aside><!-- /.sidebar -->
        <?php endif; ?>
      <?php endif; ?>
    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>
  
</body>
</html>
