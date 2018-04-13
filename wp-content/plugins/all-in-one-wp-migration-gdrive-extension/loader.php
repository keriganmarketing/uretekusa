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

// include all the files that you want to load in here
require_once AI1WMGE_CONTROLLER_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-main-controller.php';

require_once AI1WMGE_CONTROLLER_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-export-controller.php';

require_once AI1WMGE_CONTROLLER_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-import-controller.php';

require_once AI1WMGE_CONTROLLER_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-settings-controller.php';

require_once AI1WMGE_EXPORT_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-export-gdrive.php';

require_once AI1WMGE_EXPORT_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-export-upload.php';

require_once AI1WMGE_EXPORT_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-export-retention.php';

require_once AI1WMGE_EXPORT_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-export-done.php';

require_once AI1WMGE_IMPORT_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-import-gdrive.php';

require_once AI1WMGE_IMPORT_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-import-download.php';

require_once AI1WMGE_IMPORT_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-import-settings.php';

require_once AI1WMGE_IMPORT_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-import-database.php';

require_once AI1WMGE_MODEL_PATH .
			DIRECTORY_SEPARATOR .
			'class-ai1wmge-settings.php';

require_once AI1WMGE_VENDOR_PATH .
			DIRECTORY_SEPARATOR .
			'gdrive-factory' .
			DIRECTORY_SEPARATOR .
			'gdrive-factory' .
			DIRECTORY_SEPARATOR .
			'lib' .
			DIRECTORY_SEPARATOR .
			'ServMaskGdriveClient.php';
