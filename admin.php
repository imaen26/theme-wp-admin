<?php

/*
Plugin Name:  IDUAENAM Theme
Plugin URI: http://iduaenam.com
Description: My WordPress Admin Theme - version for WordPress 3.6.1
Author: Sukirman
Version: 1.0
Author URI: http://example.com
*/
/*-------------------------custom menu---------------------------*/
 function mytheme_admin_bar_render() {
 global $wp_admin_bar;
$wp_admin_bar->remove_menu('updates');
 $logouturl = get_bloginfo('url') . '/wp-login.php?action=logout';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'p_logout',
 'title' => __('Logout'),
 'href' => $logouturl
 ));
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
/*-------------------------*////////*---------------------------*/
function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', plugins_url('wp-admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');
/*-------------------------FOOTER ADMIN---------------------------*/
add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
function left_admin_footer_text_output($text) {
    $text = 'Theme design by <a href="http://iduaenam.com">iduaenam</a> | YM : imaen26 | P : 0857 1408 9922';
    return $text;
}
/*-------------------------admin bar---------------------------*/
function remove_admin_logo() {
echo '<style>#wp-admin-bar-wp-logo{ display: none; }
img.blavatar { display: none;}
#wpadminbar .quicklinks li div.blavatar {display:none;}</style>';
}
add_action('admin_head', 'remove_admin_logo');
/*-------------------------hide update---------------------------*/
 add_action('admin_menu','hide_update_message');
function hide_update_message()
{
remove_action( 'admin_notices', 'update_nag', 3 );
remove_filter( 'update_footer', 'core_update_footer' );
}
?>
<!--CUSTOM DASBOARD WELCOME-->
<?php
class rc_sweet_custom_dashboard {
	function __construct() {	
		add_action('admin_menu', array( &$this,'rc_scd_register_menu') );
		add_action('load-index.php', array( &$this,'rc_scd_redirect_dashboard') );
	} 
	function rc_scd_redirect_dashboard() {
	
		if( is_admin() ) {
			$screen = get_current_screen();
			
			if( $screen->base == 'dashboard' ) {

				wp_redirect( admin_url( 'index.php?page=custom-dashboard' ) );		
			}
		}
	}	
	function rc_scd_register_menu() {
		add_dashboard_page( 'Custom Dashboard', 'Custom Dashboard', 'read', 'custom-dashboard', array( &$this,'rc_scd_create_dashboard') );
	}
	function rc_scd_create_dashboard() {
		include_once( 'dashboard.php'  );
	}
}
$GLOBALS['sweet_custom_dashboard'] = new rc_sweet_custom_dashboard();
?>
<!--END CUSTOM DASBOARD WELCOME-->
<?php
if ( is_admin() ){
	global $wp_iduaenam_adminmenu;
	require_once(dirname(__FILE__).'/inc/core.php');
	add_action('admin_head', 'wp_iduaenam_adminmenu_head', 999); 
	add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'wp_iduaenam_adminmenu_plugin_actions', -10); 
	add_filter('ozh_adminmenu_icon_ozh_admin_menu', 'wp_iduaenam_adminmenu_customicon');
	add_filter('in_admin_header', 'wp_iduaenam_adminmenu', -9999);
}
?>
<?php
function remove_menus () {
global $menu;
	$restricted = array(__('Dashboard'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');
?>
