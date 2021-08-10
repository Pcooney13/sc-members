<?php if(!is_page('login') && !is_user_logged_in() && !is_page('member-registration') && !get_field('membership_override')) auth_redirect(); ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="apple-touch-icon" sizes="57x57" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/apple-icon-57x57.png">
  	<link rel="apple-touch-icon" sizes="60x60" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/apple-icon-60x60.png">
  	<link rel="apple-touch-icon" sizes="72x72" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/apple-icon-72x72.png">
  	<link rel="apple-touch-icon" sizes="76x76" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/apple-icon-76x76.png">
  	<link rel="apple-touch-icon" sizes="114x114" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/apple-icon-114x114.png">
  	<link rel="apple-touch-icon" sizes="120x120" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/apple-icon-120x120.png">
  	<link rel="apple-touch-icon" sizes="144x144" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/apple-icon-144x144.png">
  	<link rel="apple-touch-icon" sizes="152x152" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/apple-icon-152x152.png">
  	<link rel="apple-touch-icon" sizes="180x180" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/apple-icon-180x180.png">
  	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/favicon-32x32.png">
  	<link rel="icon" type="image/png" sizes="96x96" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/favicon-96x96.png">
  	<link rel="icon" type="image/png" sizes="16x16" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/favicon-16x16.png">
  	<link rel="manifest" href="<?php get_template_directory_uri(); ?>/wp-content/themes/tsc/assets/images/favicons/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <?php wp_head(); ?>
  <!--[if lt IE 9]>
  <script src="<?php echo get_bloginfo('url'); ?>/js/html5.js"></script>
  <script src="<?php echo get_bloginfo('url'); ?>/js/respond.js"></script>
  <![endif]-->
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
</head>
				<?php 
					if (true) get_template_part('templates/important-notice'); 
				?>