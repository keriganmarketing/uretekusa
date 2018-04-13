<?php
	$args = fabrique_core_template_args( 'admin_app' );

	// notice message
	$bp_admin_notice = get_transient( 'bp_admin_notice' );
	if ( false !== $bp_admin_notice ) {
		delete_transient( 'bp_admin_notice' );
	}
?>

<div id="bp-admin" data-app="dashboard">
	<div class="bp bp-admin-container">
		<div class="bp-admin-version"><?php echo esc_html( 'v ' ) . fabrique_core_version(); ?></div>
		<?php if ( false !== $bp_admin_notice ) : ?>
			<?php $type = ( 'success' === $bp_admin_notice['type'] ) ? 'success' : 'error'; ?>
			<div class="bp-admin-notice bp-<?php echo esc_attr( $type ); ?>">
				<span class="bp-admin-notice-title"><?php echo esc_html( $type ); ?> : </span>
				<span class="bp-admin-notice-message"><?php echo esc_html( $bp_admin_notice['message'] ); ?></span>
			</div>
		<?php endif; ?>
		<div class="bp-admin-content bp-admin-<?php esc_attr_e( $args['page'], 'fabrique-core' ); ?>">
			<ul class="bp-tab">
				<?php foreach ( $args['all_slug'] as $slug => $menu ) {
					$active = ( $slug == $args['page'] ) ? ' class="active"' : null;
					echo '<li' . $active . '><a href="' . menu_page_url( $slug, 0 ) . '"><i class="twf twf-' . $menu['icon']  . '"></i>' . esc_html__( $menu['name'], 'fabrique-core' ) . '</a></li>';
				} ?>
			</ul>
			<div class="bp-tab-content">
				<div class="bp-form">
					<?php $page_args = $args['all_slug'][$args['page']]; ?>
					<?php if ( isset( $page_args['template'] ) ) : ?>
						<?php fabrique_core_template( 'admin-' . $page_args['template'], $args ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
