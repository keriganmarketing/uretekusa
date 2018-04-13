<?php
	$pages = get_pages();
	$maintenance_mode = get_option( 'bp_maintenance_mode' );
	$maintenance_page_id = get_option( 'bp_maintenance_page_id' );
	$four_o_four_page_id = get_option( 'bp_404_page_id' );
?>

<div class="bp-row">
	<div class="bp-col-12">
		<div class="bp-admin-title" ><?php esc_html_e( 'Getting Started', 'fabrique-core' ); ?></div>
		<div class="bp-admin-subtitle"><?php esc_html_e( 'Welcome to Fabrique Theme. The theme is now ready to use, however you are recommended to start by importing a demo.', 'fabrique-core' ); ?></div>
	</div>
</div>
<div class="bp-divider"></div>
<div class="bp-row">
	<div class="bp-col-7">
		<p>
			<?php esc_html_e( 'Please make sure that the following plugins are installed and activated.', 'fabrique-core' ); ?>
		</p>
		<ul class="bp-feature-list">
			<li>
				<strong><?php esc_html_e( 'Fabrique Core', 'fabrique-core' ); ?></strong>
				<?php esc_html_e( ' – do not deactivate this plugin.', 'fabrique-core' ); ?>
			</li>
			<li>
				<strong><?php esc_html_e( 'Envato Market', 'fabrique-core' ); ?></strong>
				<?php esc_html_e( ' – for theme update', 'fabrique-core' ); ?>
			</li>
			<li>
				<?php esc_html_e( 'WooCommerce – for Ecommerce website', 'fabrique-core' ); ?>
			</li>
			<li>
				<?php esc_html_e( 'Contact Form 7', 'fabrique-core' ); ?>
			</li>
			<li>
				<?php esc_html_e( 'WP Google Maps', 'fabrique-core' ); ?>
			</li>
		</ul>
		<p>
			<?php esc_html_e( 'If you have any trouble using the theme, our support team could help you. Please open a ticket on the support forum, we will walk you through the issue as soon as possible.', 'fabrique-core' ); ?>
		</p>
	</div>
	<div class="bp-col-5">
		<div class="bp-square-button bp-square-button--fill">
			<a href="https://twisttheme.ticksy.com" target="_blank" class="bp-btn">
				<i class="twf twf-et-pencil"></i>
				<span class="bp-square-button-text"><?php esc_html_e( 'open ticket', 'fabrique-core' ); ?></span>
			</a>
		</div>
		<div class="bp-square-button">
			<a href="http://www.twisttheme.com/docs/" target="_blank" class="bp-btn">
				<i class="twf twf-et-document"></i>
				<span class="bp-square-button-text"><?php esc_html_e( 'document', 'fabrique-core' ); ?></span>
			</a>
		</div>
	</div>
</div>
<div class="bp-divider"></div>
<div class="bp-message-box">
	<form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
		<div class="bp-form-group">
			<label class="bp-col-2 bp-control-label"><?php esc_html_e( 'Maintenance Mode', 'fabrique-core' ); ?></label>
			<div class="bp-col-2">
				<label class="bp-switch">
					<input type="checkbox" name="maintenance_mode" <?php checked( true, $maintenance_mode, true ); ?>>
					<span></span>
				</label>
			</div>
			<div class="bp-col-8 bp-admin-note"><?php esc_html_e( 'After turn this on, visitor will be redirected to selected Maintenance page.', 'fabrique-core' ); ?></div>
		</div>
		<div class="bp-form-group">
			<label class="bp-col-2 bp-control-label"><?php esc_html_e( 'Maintenance Page', 'fabrique-core' ); ?></label>
			<div class="bp-col-2">
				<div class="bp-select bp-select--full">
					<select class="js-maintenance-page bp-input" data-index="primary" name="maintenance_page_id">
						<option value="" disabled><?php echo esc_html( ' -- Choose a page -- ' ); ?></option>
						<?php if ( $pages ) : ?>
							<?php foreach( $pages as $page ) : ?>
								<option <?php selected( $maintenance_page_id, $page->ID, true ); ?> value="<?php echo esc_attr( $page->ID ); ?>">
									<?php echo esc_html( $page->post_title ); ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>
			</div>
			<div class="bp-col-8 bp-admin-note"><?php esc_html_e( 'Choose your Maintenance page.', 'fabrique-core' ); ?></div>
		</div>
		<div class="bp-form-group">
			<label class="bp-col-2 bp-control-label"><?php esc_html_e( 'Custom 404 Page', 'fabrique-core' ); ?></label>
			<div class="bp-col-2">
				<div class="bp-select bp-select--full">
					<select class="js-404-page bp-input" data-index="primary" name="404_page_id">
						<option <?php selected( $four_o_four_page_id, 'default', true ); ?> value="default"><?php echo esc_html( 'Default' ); ?></option>
						<?php if ( $pages ) : ?>
							<?php foreach( $pages as $page ) : ?>
								<option <?php selected( $four_o_four_page_id, $page->ID, true ); ?> value="<?php echo esc_attr( $page->ID ); ?>">
									<?php echo esc_html( $page->post_title ); ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>
			</div>
			<div class="bp-col-8 bp-admin-note"><?php esc_html_e( 'Choose your custom 404 page or leave this to use default.', 'fabrique-core' ); ?></div>
		</div>
		<div class="bp-form-group">
			<div class="bp-col-12">
				<input type="submit" class="bp-btn bp-btn--primary" value="Save" />
			</div>
			<input type="hidden" name="action" value="bp_admin" />
			<?php wp_nonce_field( 'bp_admin', 'bp_admin_nonce' ); ?>
		</div>
	</form>
</div>
