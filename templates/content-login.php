<div class="row">
    <div class="col-sm-8">
    	<div class="login-intro">
            <div class="content">
            	<?php while (have_posts()) : the_post(); ?>
            	<?php the_content(); ?>
                <?php endwhile; ?>
                <?php if(get_field('enable_modal', 'option')): ?>
                <div class="modal" id="welcome-modal" tabindex="-1" role="dialog" aria-labelledby="welcome-modal-Label">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="welcome-modal-label"><?php the_field('modal_title', 'option'); ?></h4>
                      </div>
                      <div class="modal-body">
                        <?php the_field('modal_content', 'option'); ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning nothanks" data-dismiss="modal">Please Don't Show This Again</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
    	<div class="login-box">
        	<h2>Member Log In</h2>
            <form name="loginform" id="loginform" action="<?php echo get_home_url(); ?>/wp-login.php" method="post">
                <div class="form-group"><input type="text" name="log" id="user_login" class="form-control" placeholder="Email Address" /></div>
                <div class="form-group"><input type="password" name="pwd" id="user_pass" class="form-control" placeholder="Password" /></div>
                <div class="checkbox"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label></div>
                <button class="btn btn-default" type="submit">Log In</button>
                <?php $redirect = htmlspecialchars($_GET['redirect_to']); ?>
                <?php if($redirect): ?>
                <input type="hidden" name="redirect_to" value="<?php echo $redirect; ?>" />
                <?php else: ?>
                <input type="hidden" name="redirect_to" value="<?php echo get_option('home'); ?>" />
                <?php endif; ?>
                
                <input type="hidden" name="testcookie" value="1" />
            </form>
    	</div>
        <?php 
			$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0; 
			if ( $login === "failed" ) {
			echo '<div class="form-group alert alert-danger" role="alert">Invalid username and/or password.</div>';
			} elseif ( $login === "empty" ) {
				echo '<div class="form-group alert alert-danger" role="alert">Username and/or Password is empty.</div>';
			} elseif ( $login === "false" ) {
				echo '<div class="form-group alert alert-danger" role="alert">You have been logged out.</div>';
			}
		?>
        <?php if(get_field('enable_login_instructions', 'option')): ?>
        <p class="instructions">First time users please <a href="#" data-toggle="modal" data-target="#instructions">click here</a>.</p>
        <div class="modal" id="instructions" tabindex="-1" role="dialog"  aria-labelledby="intstrucionsLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="intstrucionsLabel"><?php the_field('login_instructions_title', 'option'); ?></h4>
              </div>
              <div class="modal-body">
                <?php the_field('login_instructions', 'option'); ?>
              </div>
            </div>
          </div>
        </div>
        <?php else: ?>
        <p class="instructions">First time users please <a href="<?php bloginfo('url'); ?>/member-registration/">click here</a>.</p>
        <?php endif; ?>
        <p class="reset">Forgot your <a href="<?php bloginfo('url'); ?>/wp-login.php?action=lostpassword">username</a> or <a href="<?php bloginfo('url'); ?>/wp-login.php?action=lostpassword">password</a>?</p>
    </div>
</div>