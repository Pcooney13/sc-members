<?php
/**
 * Custom functions
 */
 
 // Change default uploads to "assets"
update_option('uploads_use_yearmonth_folders', 0);
update_option('upload_path', 'media');
 
// Register Secondary Nav
register_nav_menus(array(
  'secondary_navigation' => __('Secondary Navigation', 'roots'),
));

// Register Footer Nav
register_nav_menus(array(
  'footer_navigation' => __('Footer Navigation', 'roots'),
));

// Register Default Internal Nav
register_nav_menus(array(
  'internal_navigation' => __('Internal Navigation', 'roots'),
));

// Wordpress SEO Meta Box Position
add_filter( 'wpseo_metabox_prio', function() { return 'low'; }); 

// Options Pages
function my_acf_options_page_settings( $settings )
{
	$settings['title'] = 'Website Options';
	$settings['pages'] = array('Sidebar');
	return $settings;
}
add_filter('acf/options_page/settings', 'my_acf_options_page_settings');

// Remove Width & Height
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

function add_image_class($class){
	$class .= ' img-responsive';
	return $class;
}
add_filter('get_image_tag_class','add_image_class');

// Custom Excerpt function for Advanced Custom Fields
function custom_field_excerpt() {
	global $post;
	$text = get_field('bio'); //Replace 'your_field_name'
	if ( '' != $text ) {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$excerpt_length = 100; // Number of words
		$text = wp_trim_words( $text, $excerpt_length);
	}
	return apply_filters('the_excerpt', $text);
}

// Login logo
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
			width: 320px;
			height: 107px;
			background-size: auto auto !important;
			background-image: url(<?php bloginfo('url'); ?>/media/login_logo.png);
            padding-bottom: 15px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'The Schwartz Center for Compassionate Healthcare ';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//Giving Editors Access to Gravity Forms
function add_grav_forms(){
	$role = get_role('editor');
	$role->add_cap('gform_full_access');
}
add_action('admin_init','add_grav_forms');

//Remove Uber CSS Output
add_action( 'wp_loaded' , 'ubermenu_remove_CSS_output' );
function ubermenu_remove_CSS_output(){
 	remove_action( 'wp_head' , 'ubermenu_inject_custom_css' );
}

//Get Top Most Ancestor
if(!function_exists('get_post_top_ancestor_id')){
	function get_post_top_ancestor_id(){
		global $post;
		
		if($post->post_parent){
			$ancestors = array_reverse(get_post_ancestors($post->ID));
			return $ancestors[0];
		}
		
		return $post->ID;
	}
}

//Fix font-awesome in visual editor
function add_mce_markup( $initArray ) {
    $ext = 'i[id|name|class|style]';
    if ( isset( $initArray['extended_valid_elements'] ) ) {
        $initArray['extended_valid_elements'] .= ',' . $ext;
    } else {
        $initArray['extended_valid_elements'] = $ext;
    }
    return $initArray;
}
add_filter( 'tiny_mce_before_init', 'add_mce_markup' );

//Add superscript & subscript
function my_mce_buttons_2($buttons) {	
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';

	return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');

//Login Portal

function login_failed() {
    $login_page  = home_url( '/login/' );
    wp_redirect( $login_page . '?login=failed' );
    exit;
}
add_action( 'wp_login_failed', 'login_failed' );
 
function verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
    $login_page  = home_url( '/login/' );
    wp_redirect( $login_page . "?login=false" );
    exit;
}
add_action('wp_logout','logout_page');

//Add icon to logout link

add_filter('loginout','loginout_text_change');
function loginout_text_change($text) {
	$login_text_before = 'Log in';
	$login_text_after = '<i class="fa fa-key"></i> Log in';
	$logout_text_before = 'Log out';
	$logout_text_after = '<i class="fa fa-sign-out"></i> Log out';
	$text = str_replace($login_text_before, $login_text_after ,$text);
	$text = str_replace($logout_text_before, $logout_text_after ,$text);
	return $text;
}

//Add class to avatar

add_filter('get_avatar','change_avatar_css');
function change_avatar_css($class) {
	$class = str_replace("class='avatar", "class='img-circle", $class) ;
	return $class;
}

//Remove admin toolbar for roles below editor

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('edit_posts')) {
	  show_admin_bar(false);
	}
}

add_filter( 'avatar_defaults', 'new_default_avatar' );
function new_default_avatar ( $avatar_defaults ) {
	$new_avatar_url = get_bloginfo( 'template_directory' ) . '/assets/img/user-avatar-default.png';
	$avatar_defaults[$new_avatar_url] = 'Default User';
	return $avatar_defaults;
}

//fix for cookie error while login.
setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
if ( SITECOOKIEPATH != COOKIEPATH ) setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'General Settings',
		'menu_slug' 	=> 'general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Login Settings',
		'menu_title' 	=> 'Login Settings',
		'parent_slug' 	=> 'general-settings',
	));
	
}

//Conditional Logic for Overrride Code
add_filter( 'gform_pre_render_1', 'set_conditional_logic' );
add_filter( 'gform_pre_validation_1', 'set_conditional_logic' );
add_filter( 'gform_pre_submission_filter_1', 'set_conditional_logic' );
add_filter( 'gform_admin_pre_render_1', 'set_conditional_logic' );
function set_conditional_logic( $form ) {
	$override = get_field('registration_override', 'option');
	$rules_array = array();
	if(have_rows('registration_override', 'option')):
		while (have_rows('registration_override', 'option')) : the_row();
			array_push($rules_array, array('fieldId' => 4, 'operator' => 'is', 'value' => get_sub_field('code')));
		endwhile;
		foreach ( $form['fields'] as &$field ) {
			if ( $field->id == 5 ) {
				$field->conditionalLogic = 
					array(
						'actionType' => 'hide',
						'logicType' => 'any',
						'rules' => $rules_array
					);
			}
		}
		
	endif;
    return $form;
}

//Check Registrtion Code
add_filter( 'gform_field_validation_1_4', 'custom_validation', 10, 4 );
function custom_validation( $result, $value, $form, $field ) {
	global $wpdb;
	$master = rgpost( 'input_5' );
	$override = get_field('registration_override', 'option');
	$key = array_search($value, array_column($override, 'code'));
	/*
	echo '<pre>';
	echo 'Value: ' . $value . "\n";
	echo 'Key: ' . $key . "\n";
	echo 'Code: ' . $override[$key]['code'] . "\n";
	echo 'Organization Name: ' . $override[$key]['organization'] . "\n";
	echo '</pre>';
	*/
	if( $result['is_valid'] && $value == $override[$key]['code'] ){
		$_POST['input_5'] = $override[$key]['code'];
		$_POST['input_6'] = $override[$key]['organization'];
		$result['is_valid'] = true;
	} elseif ( $result['is_valid'] && $value != $master ) {
        $result['is_valid'] = false;
        $result['message'] = 'The code does not match your organization. Please enter your organization code.';
    }
    return $result;
}

//Set the Organization Name
add_action('gform_pre_submission_1', 'set_user_organization_name');
function set_user_organization_name($form) {
	$code = rgpost( 'input_4' );
	$override = get_field('registration_override', 'option');
	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}
	/*Only run if there is no override */
	if (!in_array_r($code, $override)):
		$field_id = 5;
		$value = rgpost( 'input_' . $field_id );
		$field = GFFormsModel::get_field( $form, $field_id );
		$choice_label = GFFormsModel::get_choice_text( $field, $value );
		$_POST['input_6'] = $choice_label;
		return null;
	endif;
}

//Hide Labels Option Gravity Forms
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

//Update submit button for form
add_filter( 'gform_submit_button_3', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return '<button class="btn btn-default" type="submit"><i class="fa fa-envelope"></i></button>';
}

//Custom Registration Pages
add_action('wp', 'custom_maybe_activate_user', 9);
function custom_maybe_activate_user() {
    $template_path = STYLESHEETPATH . '/templates/activate.php';
    $is_activate_page = isset( $_GET['page'] ) && $_GET['page'] == 'gf_activation';
    
    if( ! file_exists( $template_path ) || ! $is_activate_page  )
        return;
    
    require_once( $template_path );
    
    exit();
}

// Generate Newsletter List from Constant Contact
require_once(TEMPLATEPATH . '/lib/simple_html_dom.php');
function generate_newsletter_archives($content = null) {
  	$out = '<table cellpadding="0" cellspacing="0" id="newsletter-archives"><tr><th>Resource</th><th>Date</th></tr><tbody>';
	$archive_page = str_get_html(wp_remote_retrieve_body(wp_remote_get('http://archive.constantcontact.com/fs196/1101157947295/archive/1122547457721.html')));
	$archive_table = $archive_page->find('table', 2);
	foreach($archive_table->find('li') as $archived_item) {
		foreach($archived_item->find('a') as $archived_link) {
			$issue_link = $archived_link->href . "\n\n";
			$issue_name = $archived_link->innertext . "\n\n";
		}
		foreach($archived_item->find('span') as $archived_item_date) {
			$issue_date = str_replace('(', '', $archived_item_date->innertext);
			$issue_date = str_replace(')', '', $issue_date) . "\n\n";
			$out .= '<tr><td><a href="'.trim($issue_link).'" target="_blank">'.trim($issue_name).'</a></td><td>'.trim($issue_date).'</td></tr>';
		}
	}
	$out .= '<tr><td colspan="2"></td></tr></tbody></table>';
	return $out;
}

// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Rounds Topics', 'Post Type General Name' ),
		'singular_name'         => _x( 'Rounds Topic', 'Post Type Singular Name' ),
		'menu_name'             => __( 'Rounds Topics', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Rounds Topic', 'text_domain' ),
		'labels'                => $labels,
		'taxonomies'            => array( 'rounds_topics' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
		'supports' => array('title')
	);
	register_post_type( 'scr_topics', $args );

}
add_action( 'init', 'custom_post_type', 0 );

// Rounds Topics Taxonomy
function scr_tax() {
	register_taxonomy(
        'rounds_topics',
		'scr_topics',
        array(
            'label' => __( 'Rounds Topics' ),
            'public' => true,
            'rewrite' => false,
			'show_admin_column' => true,
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'scr_tax' );

/**
 * Add columns to the wp-admin user's table
 *
 * @param array $args Associative array where key is wp_usermeta meta_keys or wp_users column names and the value is the display name
 * @return none;
 */
if(!function_exists(load_sortable_user_meta_columns)){
	add_action('admin_init', 'load_sortable_user_meta_columns');
	function load_sortable_user_meta_columns(){
		//THIS IS WHERE YOU ADD THE meta_key => display-title values
		$args = array('user_registered'=>'Date Registered', 'organization_code'=>'Organization Code', 'organization'=>'Organization');
		new sortable_user_meta_columns($args);
	}
}
if(!class_exists(sortable_user_meta_columns)):
class sortable_user_meta_columns{
	var $defaults = array('organization', 'organization_code', 'user_registered');
	function __construct($args){
		$this->args = $args;
		add_action('pre_user_query', array(&$this, 'query'));
		add_action('manage_users_custom_column',  array(&$this, 'content'), 10, 3);
		add_filter('manage_users_columns', array(&$this, 'columns'));
		add_filter( 'manage_users_sortable_columns', array(&$this, 'sortable') );
	}
	function query($query){
		$vars = $query->query_vars;
		if(in_array($vars['orderby'], $this->defaults)) return;
		$title = $this->args[$vars['orderby']];
		if(!empty($title)){
			   $query->query_from .= " LEFT JOIN wp_usermeta m ON (wp_users.ID = m.user_id  AND m.meta_key = '$vars[orderby]')";
			   $query->query_orderby = "ORDER BY m.meta_value ".$vars['order'];
		}
	}
	function columns($columns) {
		foreach($this->args as $key=>$value){
			$columns[$key] = $value;
		}
		return $columns;
	}
	function sortable($columns){
		foreach($this->args as $key=>$value){
			$columns[$key] = $key;
		}
		return $columns;
	}
	function content($value, $column_name, $user_id) {
		$user = get_userdata( $user_id );
		return $user->$column_name;
	}
}
endif;

//remove column "post" from user page
add_action('manage_users_columns','remove_user_posts_column');
function remove_user_posts_column($column_headers) {
    unset($column_headers['posts']);
	unset($column_headers['roles']);
    return $column_headers;
}

// Change Activation Email Content
add_filter('wpmu_signup_user_notification_email', 'my_custom_email_message', 10, 4);
function my_custom_email_message($message, $user, $user_email, $key) {
	$emailAddress = esc_html( '<a href="mailto:jgyamera@theschwartzcenter.org">jgyamera@theschwartzcenter.org</a>' );
	$message = sprintf(__(( "Thank you for registering for the Schwartz Center Member Community website! Please activate your account by clicking the following link:\n\n%s\n\nAfter you activate your account, you will receive a confirmation email with your login information. Activation is required in order to access the Member Community website.\n\nPlease contact Juanita Gyamera at jgyamera@theschwartzcenter.org with questions.\n\n" ),
	$user, $user_email, $key, $meta),site_url( "?page=gf_activation&key=$key" ));
	return sprintf($message);
}

add_filter( 'wpmu_signup_user_notification_subject', 'my_activation_subject', 10, 4 );
function my_activation_subject($subject, $user, $user_email, $key) {
	return 'Schwartz Center Member Community Website Registration – Activation Required';
}

// Change Login URL
add_filter( 'login_url', 'my_login_page', 10, 2 );
function my_login_page( $login_url, $redirect ) {
	if($redirect != ''){
    	return home_url( '/login/?redirect_to=' . $redirect );
	} else {
		return home_url( '/login/' );
	}
}

// Add User Organization info
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { 
	$the_user = wp_get_current_user();
	$allowed_roles = array('editor', 'administrator', 'admin');
?>
	<h3>Organization Info</h3>
	<table class="form-table">
		<tr>
			<td>
				<input type="text" name="organization_code" id="organization_code" value="<?php echo esc_attr( get_the_author_meta( 'organization_code', $user->ID ) ); ?>" class="regular-text"<?php if (!array_intersect($allowed_roles, $the_user->roles)) { echo ' disabled="disabled"'; } ?> /><br />
				<span class="description">Organization code.</span>
			</td>
            <td>
				<input type="text" name="organization" id="organization" value="<?php echo esc_attr( get_the_author_meta( 'organization', $user->ID ) ); ?>" class="regular-text"<?php if (!array_intersect($allowed_roles, $the_user->roles)) { echo ' disabled="disabled"'; } ?> /><br />
				<span class="description">Organization name.</span>
			</td>
		</tr>
	</table>
<?php }

// Save info if admin
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {
	$the_user = wp_get_current_user();
	$allowed_roles = array('editor', 'administrator', 'admin');
	if (!array_intersect($allowed_roles, $the_user->roles))
		return false;
	update_usermeta( $user_id, 'organization_code', $_POST['organization_code'] );
	update_usermeta( $user_id, 'organization', $_POST['organization'] );
}

//Remove Fields from User Profile
function modify_contact_methods($profile_fields) {
	unset($profile_fields['twitter']);
    unset($profile_fields['googleplus']);
    unset($profile_fields['facebook']);
	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

function remove_profile_fields() {
	if(!current_user_can('update_core')) {
?>
	<style type="text/css">
	.user-nickname-wrap,.user-display-name-wrap,.user-url-wrap,.user-description-wrap{ display: none; }
	</style>
<?php }
}
add_action('admin_head', 'remove_profile_fields');
 
//Add custom user fields to search to include Organization & Organization Code
add_action('pre_user_query','yoursite_pre_user_search');
function yoursite_pre_user_search($user_search) {
    global $wpdb;
    if (!isset($_GET['s'])) return;

    //Enter Your Meta Fields To Query
    $search_array = array("email", "first_name", "last_name", "organization_code", "organization");

    $user_search->query_from .= " INNER JOIN {$wpdb->usermeta} ON {$wpdb->users}.ID={$wpdb->usermeta}.user_id AND (";
    for($i=0;$i<count($search_array);$i++) {
        if ($i > 0) $user_search->query_from .= " OR ";
            $user_search->query_from .= "{$wpdb->usermeta}.meta_key='" . $search_array[$i] . "'";
        }
    $user_search->query_from .= ")";        
    $custom_where = $wpdb->prepare("{$wpdb->usermeta}.meta_value LIKE '%s'", "%" . $_GET['s'] . "%");
    $user_search->query_where = str_replace('WHERE 1=1 AND (', "WHERE 1=1 AND ({$custom_where} OR ",$user_search->query_where);    
}

//Custom password form
function roots_get_the_password_form($output) {
  $output = '';
  locate_template('/templates/passwordform.php', true, false);
  return $output;
}
add_filter('the_password_form', 'roots_get_the_password_form');

/*****
	Gravity Forms
	Facilitation Workshop Registration Form (ID 4)
	Flags entry if more than 3 users register with the same organization
*****/
//add_action('gform_pre_submission_4', 'check_for_max_registrants');
add_filter( 'gform_validation_4', 'check_for_max_registrants' );
function check_for_max_registrants($validation_result) {
    $form = $validation_result['form'];
    global $wpdb;
	$workshop = rgpost( 'input_1' );
	$organization = rgpost( 'input_46' );
	$form_id = 4;
	$search_criteria['field_filters'][] = array( 'key' => '1', 'value' => $workshop );
	$search_criteria['field_filters'][] = array( 'key' => '46', 'value' => $organization );
    $entries = GFAPI::get_entries( $form_id, $search_criteria );
	if (count($entries) >= 2 && !rgpost( 'input_48_1' )) {
		$_POST['input_47'] = 'True';
		$validation_result['is_valid'] = false;
		add_filter( 'gform_validation_message_4', 'change_message', 10, 2 );
		function change_message( $message, $form ) {
			return "<div class='validation_error'>Two individuals from your member organization have already registered for this educational program. You are welcome to attend for an additional fee of $295. If you would like to continue with registration, please confirm below. You will be contacted directly regarding an invoice.</div>";
		}
	} elseif(count($entries) >= 2 && rgpost( 'input_48_1' )){
		$_POST['input_47'] = 'True';
	} else {
		$_POST['input_47'] = 'False';
	}
	$validation_result['form'] = $form;
    return $validation_result;
	/* Debug *//*
	echo '<pre>';
	echo 'Count: ' . count($entries) . "\n\n";
	if(count($entries) > 0):
		$counter = 1;
		echo '<h3>Participants from ' . $organization . '</h3>' . "\n";
		foreach($entries as $entry):
			echo 'Participant ' . $counter . ': ' . $entry['3.3'] . ' ' . $entry['3.6'] . "\n\n";
		$counter++; endforeach;
	endif;
	echo '</pre>';
	*/
}