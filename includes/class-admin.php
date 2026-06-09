<?php
namespace AuthorBoxBuilder\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin {
	private Settings $settings;

	public function __class_construct( Settings $settings ) { // Compatibility for structural assignment
		$this->settings = $settings;
	}

	public function __construct( Settings $settings ) {
		$this->settings = $settings;
	}

	public function add_plugin_admin_menu(): void {
		add_menu_page(
			__( 'Author Box Builder', 'author-box-builder' ),
			__( 'Author Box Builder', 'author-box-builder' ),
			'manage_options',
			'author-box-builder',
			[ $this, 'render_dashboard_page' ],
			'dashicons-admin-users',
			85
		);

		add_submenu_page(
			'author-box-builder',
			__( 'Dashboard', 'author-box-builder' ),
			__( 'Dashboard', 'author-box-builder' ),
			'manage_options',
			'author-box-builder',
			[ $this, 'render_dashboard_page' ]
		);

		add_submenu_page(
			'author-box-builder',
			__( 'Settings', 'author-box-builder' ),
			__( 'Settings', 'author-box-builder' ),
			'manage_options',
			'author-box-builder-settings',
			[ $this, 'render_settings_page' ]
		);
	}

	public function render_dashboard_page(): void {
		?>
		<div class="wrap abb-admin-wrap">
			<h1><?php esc_html_e( 'Author Box Builder Dashboard', 'author-box-builder' ); ?></h1>
			<p><?php esc_html_e( 'Welcome! Configure options or use shortcodes/blocks to display customizable author cards.', 'author-box-builder' ); ?></p>
			<hr>
			<div class="card">
				<h2><?php esc_html_e( 'Quick Implementation Guide', 'author-box-builder' ); ?></h2>
				<p><strong><?php esc_html_e( 'Shortcode Option:', 'author-box-builder' ); ?></strong></p>
				<code>[author_box]</code>
				<p><strong><?php esc_html_e( 'Specific User Shortcode:', 'author-box-builder' ); ?></strong></p>
				<code>[author_box user_id="5"]</code>
				<p><strong><?php esc_html_e( 'Gutenberg Integration:', 'author-box-builder' ); ?></strong></p>
				<p><?php esc_html_e( 'Search for the "Author Box" block directly inside the site editor block inspector.', 'author-box-builder' ); ?></p>
			</div>
		</div>
		<?php
	}

	public function render_settings_page(): void {
		$options = $this->settings->get_options();
		$cpts    = get_post_types( [ 'public' => true, '_builtin' => false ], 'objects' );
		?>
		<div class="wrap abb-admin-wrap">
			<h1><?php esc_html_e( 'Author Box Configuration', 'author-box-builder' ); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'abb_settings_group' );
				?>
				<h2><?php esc_html_e( 'Display Settings', 'author-box-builder' ); ?></h2>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><?php esc_html_e( 'Enable Global Visibility', 'author-box-builder' ); ?></th>
						<td>
							<label>
								<input type="checkbox" name="abb_settings[global_display]" value="1" <?php checked( $options['global_display'], 1 ); ?> />
								<?php esc_html_e( 'Append layout conditionally underneath active structural templates.', 'author-box-builder' ); ?>
							</label>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Target Post Formats', 'author-box-builder' ); ?></th>
						<td>
							<label>
								<input type="checkbox" name="abb_settings[display_posts]" value="1" <?php checked( $options['display_posts'], 1 ); ?> />
								<?php esc_html_e( 'Standard Posts', 'author-box-builder' ); ?>
							</label><br>
							<label>
								<input type="checkbox" name="abb_settings[display_pages]" value="1" <?php checked( $options['display_pages'], 1 ); ?> />
								<?php esc_html_e( 'Standard Pages', 'author-box-builder' ); ?>
							</label>
						</td>
					</tr>
					<?php if ( ! empty( $cpts ) ) : ?>
					<tr>
						<th scope="row"><?php esc_html_e( 'Custom Post Types', 'author-box-builder' ); ?></th>
						<td>
							<?php foreach ( $cpts as $cpt ) : ?>
								<label>
									<input type="checkbox" name="abb_settings[display_cpts][]" value="<?php echo esc_attr( $cpt->name ); ?>" <?php checked( in_array( $cpt->name, $options['display_cpts'], true ) ); ?> />
									<?php echo esc_html( $cpt->label ); ?>
								</label><br>
							<?php endforeach; ?>
						</td>
					</tr>
					<?php endif; ?>
				</table>

				<h2><?php esc_html_e( 'Layout & Style configurations', 'author-box-builder' ); ?></h2>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><?php esc_html_e( 'Layout Engine Style', 'author-box-builder' ); ?></th>
						<td>
							<select name="abb_settings[layout]">
								<option value="horizontal" <?php selected( $options['layout'], 'horizontal' ); ?>><?php esc_html_e( 'Horizontal (Row Grid)', 'author-box-builder' ); ?></option>
								<option value="vertical" <?php selected( $options['layout'], 'vertical' ); ?>><?php esc_html_e( 'Vertical (Stacked Align)', 'author-box-builder' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Avatar Boundary Scale (px)', 'author-box-builder' ); ?></th>
						<td>
							<input type="number" min="30" max="250" name="abb_settings[avatar_size]" value="<?php echo esc_attr( $options['avatar_size'] ); ?>" />
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Radius Corner Styling (%)', 'author-box-builder' ); ?></th>
						<td>
							<input type="number" min="0" max="100" name="abb_settings[border_radius]" value="<?php echo esc_attr( $options['border_radius'] ); ?>" />
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Internal Grid Canvas Padding (px)', 'author-box-builder' ); ?></th>
						<td>
							<input type="number" min="0" max="100" name="abb_settings[padding]" value="<?php echo esc_attr( $options['padding'] ); ?>" />
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Background Color Palette', 'author-box-builder' ); ?></th>
						<td>
							<input type="color" name="abb_settings[background_color]" value="<?php echo esc_attr( $options['background_color'] ); ?>" />
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Primary Inline Text Color', 'author-box-builder' ); ?></th>
						<td>
							<input type="color" name="abb_settings[text_color]" value="<?php echo esc_attr( $options['text_color'] ); ?>" />
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Hyperlink Dynamic States Color', 'author-box-builder' ); ?></th>
						<td>
							<input type="color" name="abb_settings[link_color]" value="<?php echo esc_attr( $options['link_color'] ); ?>" />
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	public function enqueue_admin_assets( string $hook ): void {
		if ( 'author-box-builder_page_author-box-builder-settings' !== $hook && 'toplevel_page_author-box-builder' !== $hook ) {
			return;
		}
		wp_enqueue_style( 'abb-admin-styles', ABB_PLUGIN_URL . 'assets/css/admin.css', [], ABB_VERSION );
		wp_enqueue_script( 'abb-admin-scripts', ABB_PLUGIN_URL . 'assets/js/admin.js', [], ABB_VERSION, true );
	}

	public function extend_user_profile_fields( \WP_User $user ): void {
		?>
		<h3><?php esc_html_e( 'Author Box Builder - Custom Networks Networking Matrix', 'author-box-builder' ); ?></h3>
		<table class="form-table">
			<tr>
				<th><label for="abb_twitter"><?php esc_html_e( 'X (Twitter) URL Profile', 'author-box-builder' ); ?></label></th>
				<td>
					<input type="url" name="abb_twitter" id="abb_twitter" value="<?php echo esc_url( get_user_meta( $user->ID, 'abb_twitter', true ) ); ?>" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th><label for="abb_github"><?php esc_html_e( 'GitHub Developer Link', 'author-box-builder' ); ?></label></th>
				<td>
					<input type="url" name="abb_github" id="abb_github" value="<?php echo esc_url( get_user_meta( $user->ID, 'abb_github', true ) ); ?>" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th><label for="abb_linkedin"><?php esc_html_e( 'LinkedIn Directory Profile', 'author-box-builder' ); ?></label></th>
				<td>
					<input type="url" name="abb_linkedin" id="abb_linkedin" value="<?php echo esc_url( get_user_meta( $user->ID, 'abb_linkedin', true ) ); ?>" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th><label for="abb_facebook"><?php esc_html_e( 'Facebook Platform Profile Link', 'author-box-builder' ); ?></label></th>
				<td>
					<input type="url" name="abb_facebook" id="abb_facebook" value="<?php echo esc_url( get_user_meta( $user->ID, 'abb_facebook', true ) ); ?>" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th><label for="abb_instagram"><?php esc_html_e( 'Instagram Profile URL Link', 'author-box-builder' ); ?></label></th>
				<td>
					<input type="url" name="abb_instagram" id="abb_instagram" value="<?php echo esc_url( get_user_meta( $user->ID, 'abb_instagram', true ) ); ?>" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th><label for="abb_website"><?php esc_html_e( 'Custom Branding Website Hub', 'author-box-builder' ); ?></label></th>
				<td>
					<input type="url" name="abb_website" id="abb_website" value="<?php echo esc_url( get_user_meta( $user->ID, 'abb_website', true ) ); ?>" class="regular-text" />
				</td>
			</tr>
		</table>
		<?php
	}

	public function save_user_profile_fields( int $user_id ): bool {
		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

		$fields = [ 'abb_twitter', 'abb_github', 'abb_linkedin', 'abb_facebook', 'abb_instagram', 'abb_website' ];
		foreach ( $fields as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_user_meta( $user_id, $field, esc_url_raw( wp_unslash( $_POST[ $field ] ) ) );
			}
		}
		return true;
	}
}