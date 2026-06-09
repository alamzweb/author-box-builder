<?php
namespace AuthorBoxBuilder\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Settings {
	private string $option_name = 'abb_settings';

	public function get_defaults(): array {
		return [
			'global_display'   => 0,
			'display_posts'    => 0,
			'display_pages'    => 0,
			'display_cpts'     => [],
			'layout'           => 'horizontal',
			'avatar_size'      => 96,
			'border_radius'    => 50,
			'padding'          => 20,
			'background_color' => '#ffffff',
			'text_color'       => '#333333',
			'link_color'       => '#0073aa',
		];
	}

	public function get_options(): array {
		$saved = get_option( $this->option_name, [] );
		return wp_parse_args( $saved, $this->get_defaults() );
	}

	public function register_settings(): void {
		register_setting(
			'abb_settings_group',
			$this->option_name,
			[
				'sanitize_callback' => [ $this, 'sanitize_settings' ],
				'default'           => $this->get_defaults(),
			]
		);
	}

	public function sanitize_settings( array $input ): array {
		$output   = $this->get_defaults();
		$defaults = $this->get_defaults();

		$output['global_display'] = isset( $input['global_display'] ) ? 1 : 0;
		$output['display_posts']  = isset( $input['display_posts'] ) ? 1 : 0;
		$output['display_pages']  = isset( $input['display_pages'] ) ? 1 : 0;
		
		if ( isset( $input['display_cpts'] ) && is_array( $input['display_cpts'] ) ) {
			$output['display_cpts'] = array_map( 'sanitize_text_field', $input['display_cpts'] );
		} else {
			$output['display_cpts'] = [];
		}

		if ( isset( $input['layout'] ) && in_array( $input['layout'], [ 'horizontal', 'vertical' ], true ) ) {
			$output['layout'] = $input['layout'];
		}

		$output['avatar_size']   = isset( $input['avatar_size'] ) ? absint( $input['avatar_size'] ) : $defaults['avatar_size'];
		$output['border_radius'] = isset( $input['border_radius'] ) ? absint( $input['border_radius'] ) : $defaults['border_radius'];
		$output['padding']       = isset( $input['padding'] ) ? absint( $input['padding'] ) : $defaults['padding'];

		$output['background_color'] = isset( $input['background_color'] ) ? sanitize_hex_color( $input['background_color'] ) : $defaults['background_color'];
		$output['text_color']       = isset( $input['text_color'] ) ? sanitize_hex_color( $input['text_color'] ) : $defaults['text_color'];
		$output['link_color']       = isset( $input['link_color'] ) ? sanitize_hex_color( $input['link_color'] ) : $defaults['link_color'];

		return $output;
	}
}