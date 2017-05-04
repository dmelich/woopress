<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'login_headerurl', 'imp_login_headerurl' );
/**
 * Makes the login screen's logo link to your homepage, instead of to WordPress.org.
 *
 * @since 2.0.0
 */
function imp_login_headerurl() {

	return home_url();

}

add_filter( 'login_headertitle', 'imp_login_headertitle' );
/**
 * Makes the login screen's logo title attribute your site title, instead of 'WordPress'.
 *
 * @since 2.0.0
 */
function imp_login_headertitle() {

	return get_bloginfo( 'name' );

}

//add_action( 'login_enqueue_scripts', 'imp_replace_login_logo' );
/**
 * Replaces the login screen's WordPress logo with the 'login-logo.png' in your child theme images folder.
 *
 * @since 2.0.0
 */
function imp_replace_login_logo() {

	?><style type="text/css">
		body.login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri() ?>/images/login-logo.svg);

			/* Adjust to the dimensions of your logo. WP Default: 84px 84px */
			background-size: 84px 84px;
			width: 84px;
			height: 84px;
		}
	</style>
	<?php

}

add_filter( 'wp_mail_from_name', 'imp_mail_from_name' );
/**
 * Makes WordPress-generated emails appear 'from' your WordPress site name, instead of from 'WordPress'.
 *
 * @since 2.0.0
 */
function imp_mail_from_name() {

	return get_option( 'blogname' );

}

// add_filter( 'wp_mail_from', 'imp_wp_mail_from' );
/**
 * Makes WordPress-generated emails appear 'from' your WordPress admin email address.
 *
 * Disabled by default, in case you don't want to reveal your admin email.
 *
 * @since 2.0.0
 */
function imp_wp_mail_from() {

	return get_option( 'admin_email' );

}

// add_filter( 'mandrill_payload', 'imp_force_mandrill_payload_to_html' );
/**
 * Mandrill sends all emails as HTML. Wrap all plaintext content in <p> tags.
 *
 * See: http://wordpress.org/support/topic/plaintext-emails-converted-to-html-remove-newlines
 *
 * @since 2.0.0
 */
function imp_force_mandrill_payload_to_html( $message ) {

	$message['html'] = wpautop($message['html']);

	return $message;

}

add_filter( 'retrieve_password_message', 'imp_cleanup_retrieve_password_message' );
/**
 * Remove the brackets from the retreive PW link, since they get hidden on HTML.
 *
 * @since 2.2.24
 */
function imp_cleanup_retrieve_password_message( $message ) {

	return preg_replace( '/<(.+?)>/', '$1', $message );

}

add_action( 'wp_before_admin_bar_render', 'imp_remove_wp_icon_from_admin_bar' );
/**
 * Removes the WP icon from the admin bar.
 *
 * See: http://wp-snippets.com/remove-wordpress-logo-admin-bar/
 *
 * @since 2.0.0
 */
function imp_remove_wp_icon_from_admin_bar() {

	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');

}

add_filter( 'admin_footer_text', 'imp_admin_footer_text' );
/**
 * Modify the admin footer text.
 *
 * See: http://wp-snippets.com/change-footer-text-in-wp-admin/
 *
 * @since 2.0.0
 */
function imp_admin_footer_text() {

	$text = __( 'Built by <a href="%s" target="_blank">David Melich</a>', CHILD_THEME_TEXT_DOMAIN );
	$text = sprintf(
		$text,
		'https://www.impressa.sk'
	);

	return $text;

}
