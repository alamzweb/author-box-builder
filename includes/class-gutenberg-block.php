<?php
namespace AuthorBoxBuilder\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Gutenberg_Block {
	private Author_Box $author_box;

	public function __construct( Author_Box $author_box ) {
		$this->author_box = $author_box;
	}

	public function register_block(): void {
		wp_register_script(
			'abb-block-editor-script',
			ABB_PLUGIN_URL . 'assets/js/block.js',
			[ 'wp_blocks', 'wp_element', 'wp_editor', 'wp_components' ],
			ABB_VERSION
		);

		register_block_type( 'author-box-builder/render-block', [
			'editor_script'   => 'abb-block-editor-script',
			'attributes'      => [
				'selectedUser' => [
					'type'    => 'string',
					'default' => '',
				],
			],
			'render_callback' => [ $this, 'render_dynamic_block' ],
		] );
	}

	public function render_dynamic_block( array $attributes ): string {
		$user_id = ! empty( $attributes['selectedUser'] ) ? absint( $attributes['selectedUser'] ) : get_the_author_meta( 'ID' );

		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}

		return $this->author_box->render( $user_id );
	}
}