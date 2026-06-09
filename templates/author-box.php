<?php
/**
 * Author Box Render Template View
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="abb-box-container abb-layout-<?php echo esc_attr( $options['layout'] ); ?>">
	<div class="abb-avatar-frame">
		<?php echo wp_kses_post( $author_data['avatar'] ); ?>
	</div>
	<div class="abb-info-frame">
		<h4 class="abb-author-name">
			<a href="<?php echo esc_url( $author_data['author_url'] ); ?>">
				<?php echo esc_html( $author_data['name'] ); ?>
			</a>
		</h4>
		<?php if ( ! empty( $author_data['bio'] ) ) : ?>
			<p class="abb-author-bio"><?php echo esc_html( $author_data['bio'] ); ?></p>
		<?php endif; ?>
		<?php if ( ! empty( $author_data['socials'] ) ) : ?>
			<div class="abb-social-matrix">
				<?php foreach ( $author_data['socials'] as $network => $url ) : ?>
					<a class="abb-social-icon-link abb-icon-<?php echo esc_attr( $network ); ?>" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
						<?php echo esc_html( ucfirst( $network ) ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>