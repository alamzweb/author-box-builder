<?php
namespace AuthorBoxBuilder\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Author_Box {
	private array $settings_cache;
	private bool $style_enqueued = false;

	public function __construct() {
		$settings_obj        = new Settings();
		$this->settings_cache = $settings_obj->get_options();
	}

	public function enqueue_frontend_styles(): void {
		wp_register_style( 'abb-frontend-styles', ABB_PLUGIN_URL . 'assets/css/frontend.css', [], ABB_VERSION );
	}

	public function append_to_content( string $content ): string {
		if ( ! is_singular() || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}

		if ( empty( $this->settings_cache['global_display'] ) ) {
			return $content;
		}

		$post_type = get_post_type();
		$display   = false;

		if ( 'post' === $post_type && ! empty( $this->settings_cache['display_posts'] ) ) {
			$display = true;
		} elseif ( 'page' === $post_type && ! empty( $this->settings_cache['display_pages'] ) ) {
			$display = true;
		} elseif ( 'post' !== $post_type && 'page' !== $post_type && in_array( $post_type, $this->settings_cache['display_cpts'], true ) ) {
			$display = true;
		}

		if ( $display ) {
			$author_id = get_the_author_meta( 'ID' );
			return $content . $this->render( $author_id );
		}

		return $content;
	}

	public function render( int $user_id ): string {
		if ( ! $user_id ) {
			return '';
		}

		if ( ! $this->style_enqueued ) {
			wp_enqueue_style( 'abb-frontend-styles' );
			$this->inject_dynamic_css();
			$this->style_enqueued = true;
		}

		$author_data = $this->get_author_profile_payload( $user_id );
		$options     = $this->settings_cache;

		ob_start();
		$template_path = ABB_PLUGIN_DIR . 'templates/author-box.php';
		if ( file_exists( $template_path ) ) {
			include $template_path;
		}
		return ob_get_clean();
	}

	private function get_author_profile_payload( int $user_id ): array {
		return [
			'avatar'      => get_avatar( $user_id, $this->settings_cache['avatar_size'] ),
			'name'        => get_the_author_meta( 'display_name', $user_id ),
			'bio'         => get_the_author_meta( 'description', $user_id ),
			'author_url'  => get_author_posts_url( $user_id ),
			'socials'     => array_filter( [
				'x'        => get_user_meta( $user_id, 'abb_twitter', true ),
				'github'   => get_user_meta( $user_id, 'abb_github', true ),
				'linkedin' => get_user_meta( $user_id, 'abb_linkedin', true ),
				'facebook' => get_user_meta( $user_id, 'abb_facebook', true ),
				'instagram'=> get_user_meta( $user_id, 'abb_instagram', true ),
				'website'  => get_user_meta( $user_id, 'abb_website', true ),
			] ),
		];
	}

	private function inject_dynamic_css(): void {
		$opt     = $this->settings_cache;
		$custom  = sprintf(
			'.abb-box-container { padding: %dpx; background-color: %s; color: %s; }',
			absint( $opt['padding'] ),
			sanitize_hex_color( $opt['background_color'] ),
			sanitize_hex_color( $opt['text_color'] )
		);
		$custom .= sprintf(
			'.abb-box-container a { color: %s; }',
			sanitize_hex_color( $opt['link_color'] )
		);
		$custom .= sprintf(
			'.abb-avatar-frame img { border-radius: %d%%; width: %dpx; height: auto; }',
			absint( $opt['border_radius'] ),
			absint( $opt['avatar_size'] )
		);
		wp_add_inline_style( 'abb-frontend-styles', $custom );
	}
}