<?php

/*
Plugin Name: My Admin Theme
Plugin URI: http://example.com/my-crazy-admin-theme
Description: My WordPress Admin Theme - Upload and Activate.
Author: Ms. WordPress
Version: 1.0
Author URI: http://example.com
*/

function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', plugins_url('wp-admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');

/*......................FOOTER ADMIN...........................*/
add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
function left_admin_footer_text_output($text) {
    $text = 'How much wood would a woodchuck chuck?';
    return $text;
}
 /*==
add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side
function right_admin_footer_text_output($text) {
    $text = 'That\'s purely hypothetical.';
    return $text;
}--*/
/*......................admin bar...........................*/
// hide administration page header logo and blavatar
function remove_admin_logo() {
echo '<style>#wp-admin-bar-wp-logo{ display: none; }
img.blavatar { display: none;}
#wpadminbar .quicklinks li div.blavatar {display:none;}</style>';

}
add_action('admin_head', 'remove_admin_logo');
/*......................HowDy remove...........................*/
function replace_howdy( $wp_admin_bar ) {
 $my_account=$wp_admin_bar->get_node('my-account');
 $newtitle = str_replace( 'Howdy,', 'Hello, welcome back!', $my_account->title );
 $wp_admin_bar->add_node( array(
 'id' => 'my-account',
 'title' => $newtitle,
 ) );
 }
 add_filter( 'admin_bar_menu', 'replace_howdy',25 );
 /*****hide update-------------------*/
 add_action('admin_menu','hide_update_message');
function hide_update_message()
{
remove_action( 'admin_notices', 'update_nag', 3 );
remove_filter( 'update_footer', 'core_update_footer' );
}
 /*-------------------------custom menu---------------*/
 function mytheme_admin_bar_render() {
 global $wp_admin_bar;
$wp_admin_bar->remove_menu('updates');
$generalurl = get_bloginfo('url') . '/wp-admin/options-general.php';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'general_product',
 'title' => __('General'),
 'href' => $generalurl
 ));
$profileurl = get_bloginfo('url') . '/login/?action=profile';
 $wp_admin_bar->add_menu(array(
 'parent' => 'general_product',
 'id' => 'p_profile',
 'title' => __('Your Profile'),
 'href' => $profileurl
 ));
$chguserurl = get_bloginfo('url') . '/wp-admin/users.php?page=change-email';
 $wp_admin_bar->add_menu(array(
 'parent' => 'general_product',
 'id' => 'p_user',
 'title' => __('Change Email'),
 'href' => $chguserurl
 ));
 $chgpassurl = get_bloginfo('url') . '/wp-admin/users.php?page=change-password';
 $wp_admin_bar->add_menu(array(
 'parent' => 'general_product',
 'id' => 'p_pass',
 'title' => __('Change Password'),
 'href' => $chgpassurl
 ));
 $producturl = get_bloginfo('url') . '/wp-admin/edit.php?post_type=product';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'efko_product',
 'title' => __('Products'),
 'href' => $producturl
 ));
 $productnewurl = get_bloginfo('url') . '/wp-admin/edit.php?post_type=product';
 $wp_admin_bar->add_menu(array(
 'parent' => 'efko_product',
 'id' => 'p_new',
 'title' => __('Add New'),
 'href' => $productnewurl
 ));
 $mediaurl = get_bloginfo('url') . '/wp-admin/upload.php';
 $wp_admin_bar->add_menu(array(
 'parent' => 'efko_product',
 'id' => 'media_images',
 'title' => __('Images'),
 'href' => $mediaurl
 ));
 $caturl = get_bloginfo('url') . '/wp-admin/edit-tags.php?taxonomy=product_category&post_type=product';
 $wp_admin_bar->add_menu(array(
 'parent' => 'efko_product',
 'id' => 'p_categories',
 'title' => __('Categories'),
 'href' => $caturl
 ));

 $tagsurl = get_bloginfo('url') . '/wp-admin/edit-tags.php?taxonomy=product_tag&post_type=product';
 $wp_admin_bar->add_menu(array(
 'parent' => 'efko_product',
 'id' => 'p_tags',
 'title' => __('Tags'),
 'href' => $tagsurl
 ));
 $usersurl = get_bloginfo('url') . '/wp-admin/users.php';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'efko_users',
 'title' => __('Users'),
 'href' => $usersurl
 ));
$addnewurl = get_bloginfo('url') . '/wp-admin/user-new.php';
 $wp_admin_bar->add_menu(array(
 'parent' => 'efko_users',
 'id' => 'p_add_new',
 'title' => __('Add New'),
 'href' => $addnewurl
 ));

 $ordersurl = get_bloginfo('url') . '/wp-admin/edit.php?post_type=product&page=marketpress-orders';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'manage_orders',
 'title' => __('Orders'),
 'href' => $ordersurl
 ));

 $msgsurl = get_bloginfo('url') . '/wp-admin/edit.php?post_type=product&page=marketpress&tab=messages';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'manage_msgs',
 'title' => __('Messages'),
 'href' => $msgsurl
 ));

 $commentsurl = get_bloginfo('url') . '/wp-admin/edit-comments.php';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'comments',
 'title' => __('Comments'),
 'href' => $commentsurl
 ));

 $settingsurl = get_bloginfo('url') . '/wp-admin/edit.php?post_type=product&page=marketpress';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'settings',
 'title' => __('Store Settings'),
 'href' => $settingsurl
 ));

 $couponsurl = get_bloginfo('url') . '/wp-admin/edit.php?post_type=product&page=marketpress&tab=coupons';
 $wp_admin_bar->add_menu(array(
 'parent' => 'settings',
 'id' => 'p_coupons',
 'title' => __('Coupons'),
 'href' => $couponsurl
 ));

 $paymentsurl = get_bloginfo('url') . '/wp-admin/edit.php?post_type=product&page=marketpress&tab=gateways';
 $wp_admin_bar->add_menu(array(
 'parent' => 'settings',
 'id' => 'payments',
 'title' => __('Payments'),
 'href' => $paymentsurl
 ));

 $shippingurl = get_bloginfo('url') . '/wp-admin/edit.php?post_type=product&page=marketpress&tab=shipping';
 $wp_admin_bar->add_menu(array(
 'parent' => 'settings',
 'id' => 'p_shipping',
 'title' => __('Shipping'),
 'href' => $shippingurl
 ));

 $logouturl = get_bloginfo('url') . '/login/?action=logout';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'p_logout',
 'title' => __('Logout'),
 'href' => $logouturl
 ));
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
 
?>