<?php

/**
 * Plugin Name: Trigger Netlify Build
 * Plugin URI: https://www.nateconley.com
 * Description: Triggers a Netlify Build with the click of a button from the WordPress admin.
 * Author: Nate Conley
 * Text Domain: wptnb
 */

/**
 * Create the admin page.
 *
 * @return void
 */
function wptnb_admin_page() {
	add_submenu_page(
		'index.php',
		__( 'Trigger Netlify Build', 'wptnb' ),
		__( 'Trigger Netlify Build', 'wptnb' ),
		'manage_options',
		'wptnb-trigger',
		'wptnb_page_view'
	);
}

add_action( 'admin_menu', 'wptnb_admin_page' );

/**
 * Output the view for the admin page.
 *
 * @return void
 */
function wptnb_page_view() {
	require_once plugin_dir_path( __FILE__ ) . 'views/admin.php';
}

/**
 * CSS and JS for admin page.
 *
 * @param  string $admin_hook The admin page hook.
 * @return void
 */
function wptnb_scripts( $admin_hook ) {

	if ( 'dashboard_page_wptnb-trigger' !== $admin_hook ) {
		return;
	}

	wp_enqueue_script(
		'wptnb-admin',
		plugin_dir_url( __FILE__ ) . 'assets/admin.js',
		[ 'jquery' ],
		'20211230.0657',
		true
	);

	wp_enqueue_style(
		'wptnb-admin',
		plugin_dir_url( __FILE__ ) . 'assets/admin.css',
		[],
		'20211230.0657',
		'all'
	);

}

add_action( 'admin_enqueue_scripts', 'wptnb_scripts', 10, 1 );

/**
 * Admin ajax endpoint to trigger a build.
 *
 * @return void
 */
function wptnb_trigger_build() {

	if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'wptnb_trigger_build' ) ) {
		wp_send_json_error( null, 401 );
	}

	$title = '';
	if ( isset( $_POST['title'] ) ) {
		$title = trim( sanitize_text_field( $_POST['title'] ) );
	}

	$endpoint = NETLIFY_BUILD;
	if ( '' !== $title ) {
		$endpoint = add_query_arg(
			[
				'trigger_title' => $title,
			],
			$endpoint
		);
	}

	$post = wp_remote_post( $endpoint );

	if ( is_wp_error( $post ) ) {
		wp_send_json_error( null, 500 );
	}

	wp_send_json_success();

}

add_action( 'wp_ajax_wptnb_trigger_build', 'wptnb_trigger_build' );
