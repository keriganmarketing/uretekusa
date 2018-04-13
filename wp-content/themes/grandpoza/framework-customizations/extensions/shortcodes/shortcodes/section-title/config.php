<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => esc_html__('Section Title', 'grandpoza'),
	'description'    => esc_html__('Page section title', 'grandpoza'),
    'popup_size'     => 'small',
    'title_template' => esc_html__('Section title : ', 'grandpoza').' {{- o.title }}',
	'tab'            => esc_html__('Content Elements', 'grandpoza'),
);