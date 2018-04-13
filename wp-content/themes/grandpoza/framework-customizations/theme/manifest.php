<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }
      $manifest = array();
      $manifest['id'] = 'scratch';
      $manifest['supported_extensions'] = array(
          'page-builder' => array(),
          'slider' => array(),
          'backups' => array(),
      );