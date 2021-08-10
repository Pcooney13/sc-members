<?php

global $gw_activate_template;

$result = $gw_activate_template->result;

// if the blog is already active or if the blog is taken, display respective messages
if ( $gw_activate_template->is_blog_already_active( $result ) || $gw_activate_template->is_blog_taken( $result ) ):
    $signup = $result->get_error_data();
    ?>

    <p class="lead-in">
        <?php
        if ( $signup->domain . $signup->path == '' ) {
            printf( __( '<strong>You may now <a href="%1$s">log in</a> to the Schwartz Center Member Community website using your chosen username of %2$s.</strong><br><br>Please check your email inbox at %3$s for your password and login instructions. If you do not receive an email, please check your junk or spam folder. If you still do not receive an email within an hour, you can <a href="%4$s">reset your password</a>.'), network_site_url( 'wp-login.php', 'login' ), $signup->user_login, $signup->user_email, wp_lostpassword_url() );
        } else {
            printf( __( '<strong>You may now log in to the Schwartz Center Member Community website using your chosen username of %3$s.</strong><br><br>Please check your email inbox at %4$s for your password and login instructions. If you do not receive an email, please check your junk or spam folder. If you still do not receive an email within an hour, you can <a href="%5$s">reset your password</a>.'), 'http://' . $signup->domain, $signup->domain, $signup->user_login, $signup->user_email, wp_lostpassword_url() );
        }
        ?>
    </p>

<?php else: ?>

    <h2><?php _e('An error occurred during the activation'); ?></h2>
    <p><?php echo $result->get_error_message(); ?></p>

<?php endif; ?>