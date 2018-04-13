<?php $style_dir = fabrique_core_style_custom_dir(); ?>
<?php $style_custom_writable = Fabrique_Util::can_write_file( 'wp-admin/customize.php', $style_dir['path'] ); ?>

<div id="bp-customizer-manager">
	<div class="bp-row">
		<div class="bp-col-12">
			<div class="bp-admin-title"><?php esc_html_e( 'Customizer', 'fabrique-core' ); ?></div>
			<div class="bp-admin-subtitle"><?php esc_html_e( 'Customizer setting can be exported to a JSON file. You may use it for the backup purpose as well as sending out to anyone.' ); ?></div>
		</div>
	</div>
	<?php if ( !$style_custom_writable ) : ?>
		<div class="bp-row bp-customize-message">
			<div class="bp-col-12">
				<div class="bp-message-box unavailable">
					<div class="bp-message-title"><?php esc_html_e( 'Warning', 'fabrique-core' ); ?></div>
					<div class="bp-message-text">
						<?php esc_html_e( 'Please make sure you have permission to generate .css file' , 'fabrique-core' ); ?> :
						<?php esc_html( $style_dir['path'] ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="bp-divider"></div>
	<div class="bp-row">
		<div class="bp-col-7">
			<p>
				<?php esc_html_e( 'The following settings are included in the exported JSON file. You may use it for the cross-site import or for the backup. Please be aware that the current settings will be overwritten when you import the JSON file.', 'fabrique-core' ); ?>
			</p>
			<ul class="bp-feature-list">
				<li>
					<?php esc_html_e( 'Customizer setting', 'fabrique-core' ); ?>
				</li>
				<li>
					<?php esc_html_e( 'Post setting', 'fabrique-core' ); ?>
				</li>
			</ul>
			<p>
				<?php esc_html_e( 'Please note that all data on the site are not exported with this function. However, you may use Wordpress Export instead.', 'fabrique-core' ); ?>
			</p>
		</div>
		<div class="bp-col-5">
			<form class="bp-right" action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
				<div class="bp-square-button bp-square-button--fill">
					<button type="submit" class="bp-btn">
						<i class="fcon fcon-download"></i>
						<span class="bp-square-button-text"><?php esc_html_e( 'export', 'fabrique-core' ); ?></span>
					</button>
				</div>
				<input type="hidden" name="action" value="bp_customizer_export" />
				<?php wp_nonce_field( 'bp_customizer_export', 'bp_admin_nonce' ); ?>
			</form>
			<form class="bp-right"  action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post" enctype="multipart/form-data">
				<input class="js-import-file bp-admin-customizer-file" type="file" name="bp_import_file" />
				<div class="bp-square-button">
					<button type="submit" class="js-import-button bp-btn">
						<i class="fcon fcon-upload"></i>
						<span class="bp-square-button-text"><?php esc_html_e( 'import', 'fabrique-core' ); ?></span>
					</button>
				</div>
				<input type="hidden" name="action" value="bp_customizer_import" />
				<?php wp_nonce_field( 'bp_customizer_import', 'bp_admin_nonce' ); ?>
			</form>
		</div>
	</div>
	<div class="bp-divider bp-divider--full"></div>
	<div class="bp-row">
		<form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
			<div class="bp-col-12">
				<div class="bp-message-box">
					<div class="bp-message-title"><?php esc_html_e( 'Reset to Default', 'fabrique-core' ); ?></div>
					<div class="bp-message-text">
						<?php esc_html_e( 'You can revert all settings back to default by clicking on Reset button.' , 'fabrique-core' ); ?><br>
						<?php esc_html_e( 'Make sure you backup your settings before clicking Reset button.' , 'fabrique-core' ); ?>
						<?php esc_html_e( 'This action cannot be undone, please use it carefully.' , 'fabrique-core' ); ?>
					</div>
					<div class="bp-button bp-button--right">
						<input type="submit" class="bp-btn bp-btn--default bp-btn--reset js-reset-button" value="<?php esc_html_e( 'Reset', 'fabrique-core' ); ?>" />
					</div>
				</div>
			</div>
			<input type="hidden" name="action" value="bp_customizer_reset" />
			<?php wp_nonce_field( 'bp_customizer_reset_settings', 'bp_admin_nonce' ); ?>
		</form>
	</div>
</div>
