<?php if ( $token ) : ?>
	<a href="#" id="ai1wm-export-gdrive"><?php _e( 'Google Drive', AI1WMGE_PLUGIN_NAME ); ?></a>
<?php else : ?>
	<a href="<?php echo network_admin_url( 'admin.php?page=site-migration-gdrive-settings' ); ?>"><?php _e( 'Google Drive', AI1WMGE_PLUGIN_NAME ); ?></a>
<?php endif; ?>
