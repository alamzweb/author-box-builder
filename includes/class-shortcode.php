<?php
namespace AuthorBoxBuilder\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Shortcode {
	private Author_Box $author_box;

	public function __construct( Author_Box $author_box ) {
		$this->author_box = $author_box;
	}

	public function render_shortcode( array|string $atts ): string {
		$parsed = shortcode_atts(
			[
				'user_id' => '',
			],
			$atts,
			'author_box'
		);

		$user_id = ! empty( $parsed['user_id'] ) ? absint( $parsed['user_id'] ) : get_the_author_meta( 'ID' );

		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}

		return $this->author_box->render( $user_id );
	}
}