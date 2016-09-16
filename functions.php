<?php 

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {
	
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));

    // Version CSS file in a theme
    wp_enqueue_style( 'theme-styles', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
    if ( is_rtl() ) 
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
}

/*------------------------------------------------
        USER ROLE ON BODY TAG AS CSS CLASS
------------------------------------------------*/

if ( is_user_logged_in() ) {
    add_filter('body_class','add_role_to_body');
    add_filter('admin_body_class','add_role_to_body');
}
function add_role_to_body($classes) {
    $current_user = new WP_User(get_current_user_id());
    $user_role = array_shift($current_user->roles);
    if (is_admin()) {
        $classes .= 'role-'. $user_role;
    } else {
        $classes[] = 'role-'. $user_role;
    }
    return $classes;
}
/*-----------------------------------
        CUSTOM WIDGET AREAS
---------------------------------------*/

// UNREGISTER ORIGINAL


// REGISTER CUSTOM WIDGET AREAS
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'=> 'Forum Replies Sidebar',
		'id' => 'replies_sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s btc-sidebars-widget replies-widget">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="offscreen">',
		'after_title' => '</h2>',
	));
}
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'=> 'Forum Topics Sidebar',
		'id' => 'topics_sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s btc-sidebars-widget topics-widget">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="offscreen">',
		'after_title' => '</h2>',
	));
}
//Remove wp_enque from Parent function.php

function remove_starkers_styles() {

    //Remove desired parent styles
    wp_dequeue_style( 'main-styles');

}

add_action( 'wp_enqueue_scripts','remove_starkers_styles', 20 );


/*----------------------------------------
      Upload media button
------------------------------------------*/
add_filter( 'bbp_after_get_the_content_parse_args', 'bavotasan_bbpress_upload_media' );
/**
 * Allow upload media in bbPress
 *
 * This function is attached to the 'bbp_after_get_the_content_parse_args' filter hook.
 */
function bavotasan_bbpress_upload_media( $args ) {
	$args['media_buttons'] = true;

	return $args;
}

// CUSTOM BT DEFAULT AVATAR

add_filter( 'avatar_defaults', 'newgravatar' );
function newgravatar ($avatar_defaults) {
$myavatar = get_bloginfo('template_directory') . '/images/BT-avatar.png';
$avatar_defaults[$myavatar] = "BT Member";
return $avatar_defaults;
}

//CUSTOM USER CLASSES
add_filter( 'bbp_get_dynamic_roles', 'ntwb_bbpress_custom_role_names' );
  
function ntwb_bbpress_custom_role_names() {
    return array(
  
        // Keymaster
        bbp_get_keymaster_role() => array(
            'name'         => 'Biddy Key Master',
            'capabilities' => bbp_get_caps_for_role( bbp_get_keymaster_role() )
        ),
  
        // Moderator
        bbp_get_moderator_role() => array(
            'name'         => 'BT Community Moderator',
            'capabilities' => bbp_get_caps_for_role( bbp_get_moderator_role() )
        ),
  
        // Participant
        bbp_get_participant_role() => array(
            'name'         => 'BT Community Member',
            'capabilities' => bbp_get_caps_for_role( bbp_get_participant_role() )
        ),
  
        // Spectator
        bbp_get_spectator_role() => array(
            'name'         => 'BT Community Spectator',
            'capabilities' => bbp_get_caps_for_role( bbp_get_spectator_role() )
        ),
  
        // Blocked
        bbp_get_blocked_role() => array(
            'name'         => 'Blocked User',
            'capabilities' => bbp_get_caps_for_role( bbp_get_blocked_role() )
        )
    );
}

//Login, Log out, Register Link in Top Nav Bar

add_filter( 'wp_nav_menu_items', 'rkk_add_auth_links', 10 , 2 );
function rkk_add_auth_links( $items, $args ) {
 if ( is_user_logged_in() ) {
 $items .= '<li class="top-nav-login"><a href="'. wp_logout_url() .'">Log Out</a></li>';
 }
 elseif ( !is_user_logged_in() ) {
 $items .= '<li class="top-nav-login" ><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
 $items .= '<li class="top-nav-register"><a href="'. site_url('wp-login.php?action=register') .'">Register</a></li>';
 $items .= '<li class="top-nav-lost"><a href="'. site_url('wp-login.php?action=lostpassword') .'">Lost Password</a></li>';
 }
 return $items;
}

// Edit profile Link in top Nav

// Filter wp_nav_menu() to add profile link
add_filter( 'wp_nav_menu_items', 'my_nav_menu_profile_link' );
function my_nav_menu_profile_link($menu) {
    if (!is_user_logged_in())
        return $menu;
    else
        $current_user = wp_get_current_user();
        $user=$current_user->user_nicename ;
        $profilelink = '<li class="top-nav-myaccount"><a href="/forums/users/' . $user . '/">My Account</a></li>';
        $menu = $menu . $profilelink;
        return $menu;
  
}

// Forum Hot Topics 

function rk_top_five_view() {
bbp_register_view( 'top-five', __( '5 Most Popular Topics' ), array( 
    'meta_key' => '_bbp_reply_count',
    'posts_per_page' => '5' ,
    ' max_num_pages' => '1', 
    'orderby' => 'meta_value_num' ),
false );
}

add_action( 'bbp_register_views', 'rk_top_five_view' );

// Display username shortcode

add_shortcode( 'current-username' , 'ss_get_current_username' );
function ss_get_current_username(){
    $user = wp_get_current_user() -> display_name;
    return $user->display_name;
}

// show admin bar only for admins
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}
// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}


// Remove Private Label

add_filter('private_title_format', 'ntwb_remove_private_title');
function ntwb_remove_private_title($title) {
	return '%s';
}
// ENABLE VISUAL EDITOR BBPRESS

function bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
    $args['quicktags'] = false;
    return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'bbp_enable_visual_editor' );


/////Readers hub hook

function rhh_add_css(){
  echo '<link rel="stylesheet" href="'.get_stylesheet_directory_uri() . '/responsive.css'.'" type="text/css" media="all" />';
  }

add_action('rh/head', 'rhh_add_css');
