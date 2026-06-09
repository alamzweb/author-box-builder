<?php
/**
 * Fired when the plugin is uninstalled.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete options
delete_option( 'abb_settings' );

// Delete user meta keys across all users
$social_meta_keys = [
	'abb_twitter',
	'abb_github',
	'abb_linkedin',
	'abb_facebook',
	'abb_instagram',
	'abb_website',
];

foreach ( $social_meta_keys as $key ) {
	delete_metadata( 'user', 0, $key, '', true );
}