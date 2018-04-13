<div id="ai1wmge-import-modal" class="ai1wmge-modal ai1wm-not-visible">
	<div class="ai1wm-modal-content-middle">
		<span class="ai1wm-loader" v-if="files === false"></span>
		<div class="ai1wmge-file-browser" v-if="files !== false">
			<span class="ai1wmge-path">
				<i class="ai1wm-icon-folder"></i>
				<span id="ai1wmge-download-path">{{path}}</span>
			</span>
			<ul class="ai1wmge-file-list">
				<li v-repeat="files" v-on="click: browse(this)" class="ai1wmge-file-item">
					<span class="ai1wmge-filename">
						<i class="{{type | icon}}"></i>
						{{name}}
					</span>
					<span class="ai1wmge-filedate" v-if="type !== 'application/vnd.google-apps.folder'">{{date}}</span>
					<span class="ai1wmge-filesize" v-if="type !== 'application/vnd.google-apps.folder'">{{size}}</span>
				</li>
			</ul>
			<p class="ai1wmge-file-row" v-if="files.length === 0 && num_hidden_files === 0">
				<?php _e( 'No files or directories', AI1WMGE_PLUGIN_NAME ); ?>
			</p>
			<p class="ai1wmge-file-row" v-if="num_hidden_files === 1">
				{{num_hidden_files}}
				<?php _e( 'file is hidden', AI1WMGE_PLUGIN_NAME ); ?>
				<i class="ai1wm-icon-help ai1wm-tooltip">
					<span><?php _e( 'Only wpress backups and folders are visible', AI1WMGE_PLUGIN_NAME ); ?></span>
				</i>
			</p>
			<p class="ai1wmge-file-row" v-if="num_hidden_files > 1">
				{{num_hidden_files}}
				<?php _e( 'files are hidden', AI1WMGE_PLUGIN_NAME ); ?>
				<i class="ai1wm-icon-help ai1wm-tooltip">
					<span><?php _e( 'Only wpress backups and folders are visible', AI1WMGE_PLUGIN_NAME ); ?></span>
				</i>
			</p>
		</div>
	</div>

	<div class="ai1wm-modal-action">
		<p>
			<span class="ai1wmge-contact-gdrive" v-if="files === false">
				<?php _e( 'Connecting to Google Drive ...', AI1WMGE_PLUGIN_NAME ); ?>
			</span>
		</p>
		<p>
			<span id="ai1wmge-download-file" class="ai1wmge-selected-file" v-if="selected_filename" v-animation>
				<i class="ai1wm-icon-file-zip"></i>
				{{selected_filename}}
			</span>
		</p>
		<p>
			<button type="button" class="ai1wm-button-red" id="ai1wmge-import-file-cancel" v-on="click: cancel">
				<i class="ai1wm-icon-notification"></i>
				<?php _e( 'Cancel', AI1WMGE_PLUGIN_NAME ); ?>
			</button>
			<button type="button" class="ai1wm-button-green" id="ai1wmge-import-file" v-if="selected_filename" v-on="click: import">
				<i class="ai1wm-icon-publish"></i>
				<?php _e( 'Import', AI1WMGE_PLUGIN_NAME ); ?>
			</button>
		</p>
	</div>
</div>
