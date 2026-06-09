<?php
/**
 * Plugin Name:       Author Box Builder
 * Plugin URI:        https://sitecroftdev.vercel.app/plugins/author-box-builder
 * Description:       Create beautiful customizable author boxes with social links, avatars, biographies, and profile information.
 * Version:           1.0.0
 * Author:            Saad
 * Author URI:        https://sitecroftdev.vercel.app/
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       author-box-builder
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ABB_VERSION', '1.0.0' );
define( 'ABB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ABB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ABB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Autoload Internal Classes
require_all_plugin_classes();

function require_all_plugin_classes(): void {
	$files = [
		'class-plugin.php',
		'class-settings.php',
		'class-admin.php',
		'class-author-box.php',
		'class-shortcode.php',
		'class-gutenberg-block.php',
	];

	foreach ( $files as $file ) {
		$path = ABB_PLUGIN_DIR . 'includes/' . $file;
		if ( file_exists( $path ) ) {
			require_once $path;
		}
	}
}

// Initialize the plugin
function run_author_box_builder(): void {
	$plugin = new \AuthorBoxBuilder\Includes\Plugin();
	$plugin->run();
}
add_action( 'plugins_loaded', 'run_author_box_builder' );