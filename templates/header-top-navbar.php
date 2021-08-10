
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

<header class="banner navbar navbar-default navbar-static-top" role="banner">
  	<div class="container">
    	<div class="navbar-header">
    		<a class="navbar-brand" href="<?php echo home_url(); ?>/"><img class="img-responsive" src="<?php bloginfo('url'); ?>/media/schwartz-logo-update.png" alt="<?php bloginfo('name'); ?>" /></a>
    	</div>
    
	    <?php if(!is_page('login') && is_user_logged_in()): $user_ID = get_current_user_id(); ?>
    
        	<div class="right-wrap">
             	<a class="profile" href="<?php bloginfo('url'); ?>/wp-admin/profile.php"><?php echo get_avatar(get_the_author_meta( 'ID', $user_ID ), 62, false, get_the_author_meta( 'display_name', $user_ID )); ?></a>
            	<div class="search-nav">
					<?php get_search_form(); ?>
                	<nav class="nav-sec" role="navigation">
                  		<ul class="menu" id="menu-secondary-navigation">
                      		<?php
                        		if (has_nav_menu('secondary_navigation')) :
                          			wp_nav_menu(array('theme_location' => 'secondary_navigation','items_wrap'=>'%3$s','container' => false));
                        		endif;
                      		?>
                      		<li class="menu-item"><?php wp_loginout(); ?></li>
                  		</ul>
                	</nav>
            	</div>
        	</div>
        
        	<h1><a href="<?php echo home_url(); ?>/">Member Community</a></h1>
        
			<!-- FULL ACCESS MENU-NAV -->	

        		<?php if ($full_site_access == true) : ?>

          			<?php if(function_exists('ubermenu')): ?>
              			<?php ubermenu( 'main' , array( 'theme_location' => 'primary_navigation') ); ?>
          			<?php else: ?>
              			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  			<span class="sr-only">Toggle navigation</span>
                  			<span class="icon-bar"></span>
                  			<span class="icon-bar"></span>
                  			<span class="icon-bar"></span>
                  			<label>Menu</label>
              			</button>
              			<nav class="collapse navbar-collapse" role="navigation">
                			<?php
                  				if (has_nav_menu('primary_navigation')) :
                    				wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
                  				endif;
                			?>
              			</nav>
          			<?php endif; ?>
							  
							  
				<!-- LIMITED ACCESS MENU-NAV -->
				<?php else: ?>


					<style>
						.hide-for-lower {
							display:none!important;
						}
					</style>

          			<?php if(function_exists('ubermenu')): ?>					  
						<?php ubermenu( 'main' , array( 'menu' => 34 ) ); ?>
          			<?php else: ?>
              			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  			<span class="sr-only">Toggle navigation</span>
                  			<span class="icon-bar"></span>
                  			<span class="icon-bar"></span>
                  			<span class="icon-bar"></span>
                  			<label>Menu</label>
              			</button>
              			<nav class="collapse navbar-collapse" role="navigation">
                			<?php
                  				if (has_nav_menu('primary_navigation')) :
                    				wp_nav_menu( array(  'theme_location' => 'my-custom-menu', 'menu_class' => 'nav navbar-nav' ) );
                  				endif;
                			?>
              			</nav>
          			<?php endif; ?>
        		<?php endif; ?>
        	

        <?php endif; ?>

	</div>
</header>
