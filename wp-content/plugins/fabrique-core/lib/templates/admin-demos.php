<?php
	if ( isset( $_GET['demo-flush']) ) {
		delete_option( 'bp_import_' . $_GET['demo-flush'] );
	}
 ?>

<div class="js-demo-intro bp-admin-demos-intro bp-row">
	<div class="bp-col-12">
		<div class="bp-admin-title"><?php esc_html_e( 'Import Demo', 'fabrique-core' ); ?></div>
		<div class="bp-admin-subtitle">
			<?php esc_html_e( 'Choose a demo to import to your site. This process may take a few minutes, please do not close this window.', 'fabrique-core' ); ?>
		</div>
		<div class="bp-row">
			<div class="bp-col-8">
				<div class="bp-box">
					<h3 class="bp-box-header"><?php esc_html_e( "Important Notes", 'fabrique-core' ); ?></h3>
					<ul class="bp-list">
						<li><?php esc_html_e( 'Please make sure that the requirements of the server on System Status is fullfilled.', 'fabrique-core' ); ?></li>
						<li><?php esc_html_e( 'Customize Settings will be overwritten by demo settings.', 'fabrique-core' ); ?></li>
						<li><?php esc_html_e( 'Plugin data i.e. Slider Revolution, and WP Google Map will not be imported', 'fabrique-core' ); ?></li>
						<li><?php esc_html_e( 'No existing posts, pages, images, custom post types will be deleted, and/or modified.', 'fabrique-core' ); ?></li>
					</ul>
				</div>
			</div>
			<div class="bp-col-4">
				<div class="bp-box">
					<?php $reports = fabrique_core_import_demo_status(); ?>
					<h3 class="bp-box-header"><?php esc_html_e( "Importer Status", 'fabrique-core' ); ?></h3>
					<ul class="bp-list bp-list--none">
						<li>
							<?php if ( !$reports['import_demo_status'] ) : ?>
								<?php esc_html_e( 'Importer might not work properly. Please checkout', 'fabrique-core' ); ?>
								<a target="_blank" href="<?php echo admin_url( 'admin.php?page=system-status' ) ?>"><?php esc_html_e( "System Status", 'fabrique-core' ); ?></a>
							<?php else : ?>
								<?php esc_html_e( 'Everything looks good.', 'fabrique-core' ); ?>
							<?php endif; ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="bp-demos" class="bp-admin-import-view"></div>
