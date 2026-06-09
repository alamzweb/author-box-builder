<?php
namespace AuthorBoxBuilder\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin {
	public function run(): void {
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_dependencies(): void {
		add_action( 'init', [ $this, 'load_textdomain' ] );
	}

	public function load_textdomain(): void {
		load_plugin_textdomain(
			'author-box-builder',
			false,
			dirname( ABB_PLUGIN_BASENAME ) . '/languages/'
		);
	}

	private function define_admin_hooks(): void {
		if ( is_admin() ) {
			$settings = new Settings();
			$admin    = new Admin( $settings );
			
			add_action( 'admin_menu', [ $admin, 'add_plugin_admin_menu' ] );
			add_action( 'admin_init', [ $settings, 'register_settings' ] );
			add_action( 'admin_enqueue_scripts', [ $admin, 'enqueue_admin_assets' ] );
			add_action( 'show_user_profile', [ $admin, 'extend_user_profile_fields' ] );
			add_action( 'edit_user_profile', [ $admin, 'extend_user_profile_fields' ] );
			add_action( 'personal_options_update', [ $admin, 'save_user_profile_fields' ] );
			add_action( 'edit_user_profile_update', [ $admin, 'save_user_profile_fields' ] );
		}
	}

	private function define_public_hooks(): void {
		$author_box      = new Author_Box();
		$shortcode       = new Shortcode( $author_box );
		$gutenberg_block = new Gutenberg_Block( $author_box );

		add_filter( 'the_content', [ $author_box, 'append_to_content' ] );
		add_action( 'wp_enqueue_scripts', [ $author_box, 'enqueue_frontend_styles' ] );
		add_shortcode( 'author_box', [ $shortcode, 'render_shortcode' ] );
		add_action( 'init', [ $gutenberg_block, 'register_block' ] );
	}
}