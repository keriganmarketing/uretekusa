<?php
/**
 * Copyright (C) 2014-2018 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */
?>

<div class="ai1wm-container">
	<div class="ai1wm-row">
		<div class="ai1wm-left">
			<div class="ai1wm-holder">
				<h1><i class="ai1wm-icon-gear"></i> <?php _e( 'Google Drive Settings', AI1WMGE_PLUGIN_NAME ); ?></h1>
				<br />
				<br />

				<div class="ai1wm-field">
					<?php if ( $token ) : ?>
						<p id="ai1wmge-gdrive-details">
							<?php _e( 'Retrieving Google Drive account details..', AI1WMGE_PLUGIN_NAME ); ?>
						</p>

						<div id="ai1wmge-gdrive-progress">
							<div id="ai1wmge-gdrive-progress-bar"></div>
						</div>

						<p id="ai1wmge-gdrive-space"></p>

						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ai1wmge_gdrive_revoke' ) ); ?>">
							<button type="submit" class="ai1wm-button-red" name="ai1wmge_gdrive_logout" id="ai1wmge-gdrive-logout">
								<i class="ai1wm-icon-exit"></i>
								<?php _e( 'Sign Out from your Google Drive account', AI1WMGE_PLUGIN_NAME ); ?>
							</button>
						</form>

					<?php else : ?>

						<form method="post" action="<?php echo esc_url( AI1WMGE_GDRIVE_URL ); ?>">
							<input type="hidden" name="ai1wmge_client" id="ai1wmge-client" value="<?php echo network_admin_url( 'admin.php?page=site-migration-gdrive-settings' ); ?>" />
							<button type="submit" class="ai1wm-button-blue" name="ai1wmge_gdrive_link" id="ai1wmge-gdrive-link">
								<i class="ai1wm-icon-enter"></i>
								<?php _e( 'Link your Google Drive account', AI1WMGE_PLUGIN_NAME ); ?>
							</button>
						</form>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( $token ) : ?>
				<div id="ai1wmge-backups" class="ai1wm-holder" style="margin-top:22px;">
					<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php?action=ai1wmge_gdrive_settings' ) ); ?>">
						<h1><i class="ai1wm-icon-gear"></i> <?php _e( 'Google Drive Backups', AI1WMGE_PLUGIN_NAME ); ?></h1>
						<br />
						<br />

						<article class="ai1wmge-article">
							<h3><?php _e( 'Configure your backup plan', AI1WMGE_PLUGIN_NAME ); ?></h3>
							<ul id="ai1wmge-gdrive-cron">
								<li>
									<label for="ai1wmge-gdrive-cron-hourly">
										<input type="checkbox" name="ai1wmge_gdrive_cron[]" id="ai1wmge-gdrive-cron-hourly" value="hourly" <?php echo in_array( 'hourly', $gdrive_backup_schedules ) ? 'checked' : null; ?> />
										<?php _e( 'Every hour', AI1WMGE_PLUGIN_NAME ); ?>
									</label>
								</li>
								<li>
									<label for="ai1wmge-gdrive-cron-daily">
										<input type="checkbox" name="ai1wmge_gdrive_cron[]" id="ai1wmge-gdrive-cron-daily" value="daily" <?php echo in_array( 'daily', $gdrive_backup_schedules ) ? 'checked' : null; ?> />
										<?php _e( 'Every day', AI1WMGE_PLUGIN_NAME ); ?>
									</label>
								</li>
								<li>
									<label for="ai1wmge-gdrive-cron-weekly">
										<input type="checkbox" name="ai1wmge_gdrive_cron[]" id="ai1wmge-gdrive-cron-weekly" value="weekly" <?php echo in_array( 'weekly', $gdrive_backup_schedules ) ? 'checked' : null; ?> />
										<?php _e( 'Every week', AI1WMGE_PLUGIN_NAME ); ?>
									</label>
								</li>
								<li>
									<label for="ai1wmge-gdrive-cron-monthly">
										<input type="checkbox" name="ai1wmge_gdrive_cron[]" id="ai1wmge-gdrive-cron-monthly" value="monthly" <?php echo in_array( 'monthly', $gdrive_backup_schedules ) ? 'checked' : null; ?> />
										<?php _e( 'Every month', AI1WMGE_PLUGIN_NAME ); ?>
									</label>
								</li>
							</ul>

							<p>
								<?php _e( 'Last backup date:', AI1WMGE_PLUGIN_NAME ); ?>
								<strong>
									<?php echo $last_backup_date; ?>
								</strong>
							</p>

							<p>
								<?php _e( 'Next backup date:', AI1WMGE_PLUGIN_NAME ); ?>
								<strong>
									<?php echo $next_backup_date; ?>
								</strong>
							</p>

							<p>
								<label for="ai1wmge-gdrive-ssl">
									<input type="checkbox" name="ai1wmge_gdrive_ssl" id="ai1wmge-gdrive-ssl" value="1" <?php echo empty( $ssl ) ? 'checked' : null; ?> />
									<?php _e( 'Disable connecting to Google Drive via SSL (only if export is failing)', AI1WMGE_PLUGIN_NAME ); ?>
								</label>
							</p>
						</article>

						<article class="ai1wmge-article">
							<h3><?php _e( 'Notification settings', AI1WMGE_PLUGIN_NAME ); ?></h3>
							<p>
								<label for="ai1wmge-notification-toggle">
									<input type="checkbox" id="ai1wmge-notification-toggle" name="ai1wmge_notification_toggle" <?php echo $notify ? 'checked' : null; ?> />
									<?php _e( 'Send an email when a backup is complete.', AI1WMGE_PLUGIN_NAME ); ?>
								</label>
							</p>

							<p>
								<label for="ai1wmge-notification-email">
									<?php _e( 'Email address', AI1WMGE_PLUGIN_NAME ); ?>
									<br />
									<input class="ai1wmge-email" style="width: 15rem;" type="email" id="ai1wmge-notification-email" name="ai1wmge_notification_email" value="<?php echo $email; ?>" />
								</label>
							</p>
						</article>

						<article class="ai1wmge-article">
							<h3><?php _e( 'Retention settings', AI1WMGE_PLUGIN_NAME ); ?></h3>
							<p>
								<div class="ai1wm-field">
									<label for="ai1wmge-gdrive-backups">
										<?php _e( 'Keep the most recent', AI1WMGE_PLUGIN_NAME ); ?>
										<input style="width: 3em" type="number" min="0" name="ai1wmge_gdrive_backups" id="ai1wmge-gdrive-backups" value="<?php echo intval( $backups ); ?>" />
									</label>
									<?php _e( 'backups. <small>Default: <strong>0</strong> unlimited.</small>', AI1WMGE_PLUGIN_NAME ); ?>
								</div>

								<div class="ai1wm-field">
									<label for="ai1wmge-gdrive-total">
										<?php _e( 'Limit the total size of backups to', AI1WMGE_PLUGIN_NAME ); ?>
										<input style="width: 4em" type="number" min="0" name="ai1wmge_gdrive_total" id="ai1wmge-gdrive-total" value="<?php echo intval( $total ); ?>" />
									</label>
									<select style="margin-top: -2px" name="ai1wmge_gdrive_total_unit" id="ai1wmge-gdrive-total-unit">
										<option value="MB" <?php echo strpos( $total, 'MB' ) !== false ? 'selected="selected"' : null; ?>><?php _e( 'MB', AI1WMGE_PLUGIN_NAME ); ?></option>
										<option value="GB" <?php echo strpos( $total, 'GB' ) !== false ? 'selected="selected"' : null; ?>><?php _e( 'GB', AI1WMGE_PLUGIN_NAME ); ?></option>
									</select>
									<?php _e( '<small>Default: <strong>0</strong> unlimited.</small>', AI1WMGE_PLUGIN_NAME ); ?>
								</div>
							</p>
						</article>

						<p>
							<button type="submit" class="ai1wm-button-blue" name="ai1wmge_gdrive_update" id="ai1wmge-gdrive-update">
								<i class="ai1wm-icon-database"></i>
								<?php _e( 'Update', AI1WMGE_PLUGIN_NAME ); ?>
							</button>
						</p>
					</form>
				</div>
			<?php endif; ?>
		</div>
		<div class="ai1wm-right">
			<div class="ai1wm-sidebar">
				<div class="ai1wm-segment">
					<?php if ( ! AI1WM_DEBUG ) : ?>
						<?php include AI1WM_TEMPLATES_PATH . '/common/share-buttons.php'; ?>
					<?php endif; ?>

					<h2><?php _e( 'Leave Feedback', AI1WMGE_PLUGIN_NAME ); ?></h2>

					<?php include AI1WM_TEMPLATES_PATH . '/common/leave-feedback.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>
