<?php

class Fabrique_Import_Module extends Fabrique_Base_Module
{
	const API_IMPORT_DEMO = 'import/demo';
	const API_IMPORT_DEMO_STATUS = 'import/demo-status';

	public function get_name()
	{
		return 'import';
	}

	public function start()
	{
	}

	public function handle_api_action( $endpoint, $params )
	{
		$import_id = null;

		if ( isset( $params['import_id'] ) ) {
			$import_id = $params['import_id'];
		}

		switch ( $endpoint ) {
			case self::API_IMPORT_DEMO:
				$importer = $this->get_importer();

				if ( $import_id ) {
					return $importer->resume_import( $import_id );
				} else {
					return $importer->import_demo( $params['demo'] );
				}
			case self::API_IMPORT_DEMO_STATUS:
				return true;
			default:
				return false;
		}
	}

	protected function get_importer()
	{
		$options = apply_filters( 'fabrique_core_importer_options', array() );
		return new Fabrique_Importer( $options );
	}
}
