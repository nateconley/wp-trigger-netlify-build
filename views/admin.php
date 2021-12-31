<?php

printf( '<h1>%s</h1>', esc_html__( 'Trigger Netlify Build', 'wptnb' ) );

if ( defined( 'NETLIFY_BUILD' ) ) {
	printf(
		'<form id="wptnb-trigger">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="wptnb-trigger-title">%s</label></th>
						<td><input class="widefat" id="wptnb-trigger-title" type="text"></td>
						%s
					</tr>
					<tr>
						<td></td>
						<td>
							<div role="region" aria-live="assertive" class="notice notice-info"><p>%s</p></div>
							<div role="region" aria-live="assertive" class="notice notice-success"><p>%s</p></div>
							<div role="region" aria-live="assertive" class="notice notice-error"><p>%s</p></div>
							<input type="submit" value="%s" class="button button-hero button-primary">
							<span class="spinner is-active"></span>
						</td>
					</tr>
				</tbody>
			</table>
		</form>',
		esc_html__( 'Trigger title (optional)', 'wptnb' ),
		wp_nonce_field( 'wptnb_trigger_build', 'wptnb_nonce', true, false ),
		esc_html__( 'Loading &hellip;', 'wptnb' ),
		esc_html__( 'Build triggered!', 'wptnb' ),
		esc_html__( 'Something went wrong', 'wptnb' ),
		esc_attr__( 'Trigger Build', 'wptnb' )
	);
	echo '<hr>';
}

printf(
	'<h2>%s</h2>',
	esc_html__( 'Setup', 'wptnb' )
);

printf(
	'<ol>
		<li>%s</li>
		<li>%s</li>
		<li>%s</li>
		<li>%s</li>
	</ol>',
	sprintf(
		wp_kses(
			_x(
				'Follow the Netlify instructions to create a "Build hook" for your Netlify site: <a href="%1$s" target="_blank">%1$s</a>',
				'Placeholder is a url',
				'wptnb'
			),
			[
				'a' => [
					'href'   => [],
					'target' => [],
				],
			]
		),
		'https://docs.netlify.com/configure-builds/build-hooks/'
	),
	esc_html__( 'Copy the URL value', 'wptnb' ),
	sprintf(
		wp_kses(
			_x(
				'Open up your site\'s <code>%s</code> file',
				'Placeholder is a file name',
				'wptnb'
			),
			[
				'code' => [],
			]
		),
		'wp-config.php'
	),
	sprintf(
		wp_kses(
			_x(
				'Create a new constant called <code>%s</code>',
				'Placeholder is a static variable name',
				'wptnb'
			),
			[
				'code' => [],
			]
		),
		'NETLIFY_BUILD'
	),
);

echo '<code>define(\'NETLIFY_BUILD\', \'https://api.netlify.com/build_hooks/xxxxxxxxx\')</code>';
