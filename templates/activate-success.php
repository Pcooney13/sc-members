<?php

global $gw_activate_template;

extract( $gw_activate_template->result );

$url = is_multisite() ? get_blogaddress_by_id( (int) $blog_id ) : home_url('', 'http');
$user = new WP_User( (int) $user_id );

?>

<?php if ( $url != network_home_url('', 'http') ) : ?>
    <p class="view"><?php printf( __('<strong>You may now <a href="%1$s">log in</a> to the Schwartz Center Member Community website using your chosen username of %2$s.</strong><br><br>Please check your email inbox at %3$s for your password and login instructions. If you do not receive an email, please check your junk or spam folder. If you still do not receive an email within an hour, you can <a href="%4$s">reset your password</a>.'), $url, $user->user_login, $user->user_email, wp_lostpassword_url() ); ?></p>
<?php else: ?>
    <p class="view"><?php printf( __('<strong>You may now <a href="%1$s">log in</a> to the Schwartz Center Member Community website using your chosen username of %2$s.</strong><br><br>Please check your email inbox at %3$s for your password and login instructions. If you do not receive an email, please check your junk or spam folder. If you still do not receive an email within an hour, you can <a href="%4$s">reset your password</a>.'), $url, $user->user_login, $user->user_email, wp_lostpassword_url() ); ?></p>
<?php endif; ?>