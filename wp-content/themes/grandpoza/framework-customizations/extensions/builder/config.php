<?php

$cfg['grid.columns'] = array(
	'1_6' => array(
		'title'          => '1/6',
		'backend_class'  => 'fw-col-sm-2',
		'frontend_class' => 'col-xs-12 fw-col-sm-2',
	),
    '7_12' => array(
		'title'          => '7/12',
		'backend_class'  => 'fw-col-sm-7',
		'frontend_class' => 'col-xs-12 col-md-7 col-sm-6',
	),
    '5_12' => array(
		'title'          => '5/12',
		'backend_class'  => 'fw-col-sm-5',
		'frontend_class' => 'col-xs-12 col-md-5 col-sm-6',
	),
	'1_5' => array(
		'title'          => '1/5',
		'backend_class'  => 'fw-col-sm-15',
		'frontend_class' => 'col-xs-12 col-sm-15',
	),
	'1_4' => array(
		'title'          => '1/4',
		'backend_class'  => 'fw-col-sm-3',
		'frontend_class' => 'col-sm-6 col-md-3',
	),
	'1_3' => array(
		'title'          => '1/3',
		'backend_class'  => 'fw-col-sm-4',
		'frontend_class' => 'fw-col-xs-12 col-md-4 col-sm-6',
	),
	'1_2' => array(
		'title'          => '1/2',
		'backend_class'  => 'fw-col-sm-6',
		'frontend_class' => 'fw-col-xs-12 col-md-6',
	),
	'2_3' => array(
		'title'          => '2/3',
		'backend_class'  => 'fw-col-sm-8',
		'frontend_class' => 'col-xs-12 col-sm-8',
	),
	'3_4' => array(
		'title'          => '3/4',
		'backend_class'  => 'fw-col-sm-9',
		'frontend_class' => 'col-xs-12 col-sm-9',
	),
	'1_1' => array(
		'title'          => '1/1',
		'backend_class'  => 'fw-col-sm-12',
		'frontend_class' => 'col-xs-12',
	),
);
/**
 * @since 1.2.0
 */
$cfg['grid.row.class'] = 'row row-tb-15';

/**
 * @deprecated since 1.2.0
 * if this is empty fw_ext_builder_get_item_width() will use $cfg['grid.columns']
 */
$cfg['default_item_widths'] = false;