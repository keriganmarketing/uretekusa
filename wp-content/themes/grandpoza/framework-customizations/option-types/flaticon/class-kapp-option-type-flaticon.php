<?php if (!defined('FW')) die('Forbidden');

class Kapp_Option_Type_Flaticon extends FW_Option_Type
{
	/**
	 * Prevent enqueue same font style twice, in case it is used in multiple sets
	 * @var array
	 */
	private $enqueued_font_styles = array();

	public function get_type()
	{
		return 'flaticon';
	}

	/**
	 * @internal
	 */
	public function _get_backend_width_type()
	{
		return 'full';
	}

	/**
	 * @internal
	 * {@inheritdoc}
	 */
	protected function _enqueue_static($id, $option, $data)
	{
		wp_enqueue_style(
			'fw-option-type-'. $this->get_type() .'-backend',
			get_stylesheet_directory_uri()."/framework-customizations/option-types/flaticon/static/css/backend.css",
			fw()->manifest->get_version()
		);

		wp_enqueue_script(
			'fw-option-type-'. $this->get_type() .'-backend',
		get_stylesheet_directory_uri()."/framework-customizations/option-types/flaticon/static/js/backend.js",
			array('jquery', 'fw-events'),
			fw()->manifest->get_version()
		);

		$sets = $this->get_icons();

		wp_enqueue_style(
						"fw-option-type-{$this->get_type()}-flaticon",
						get_stylesheet_directory_uri()."/assets/fonts/flaticon/flaticon.css",
						array(),
						fw()->manifest->get_version()
					);
        wp_enqueue_style(
						"fw-option-type-{$this->get_type()}-linearicon",
						get_stylesheet_directory_uri()."/assets/fonts/linearicons/css/linearicons.css",
						array(),
						fw()->manifest->get_version()
					);
		return true;
	}

	/**
	 * @internal
	 */
	protected function _render($id, $option, $data)
	{
		$icons = $this->get_icons();
		$option['attr']['value'] = (string)$data['value'];

		return fw_render_view(dirname(__FILE__) . '/view.php', compact('id', 'option', 'data', 'icons'));
	}

	/**
	 * @internal
	 */
	protected function _get_value_from_input($option, $input_value)
	{
        if (is_null($input_value)) {
			return $option['value'];
		}
        $icons = $this->get_icons();

        if (array_key_exists( $input_value,$icons)) {
			$input_value = $option['value'];
		}

		return $input_value;
	}

	/**
	 * @internal
	 */
	protected function _get_defaults()
	{
		return array(
			'value' => '',
			'icons'   => '',
		);
	}

	private function get_icons()
	{
		return array(
              "flaticon"=> array(
                    'flaticon-adjusting-wrench-tool',
                    'flaticon-architecture-crane-tool',
                    'flaticon-architecture-draw-of-a-house-on-a-paper',
                    'flaticon-attention-signal-and-construction-worker',
                    'flaticon-ax',
                    'flaticon-barrow-with-construction-materials',
                    'flaticon-brick',
                    'flaticon-bricks',
                    'flaticon-bricks-wall-and-demolition-ball',
                    'flaticon-brush-with-fresh-painting',
                    'flaticon-construction-machine-equipment',
                    'flaticon-construction-tool-of-vehicle-with-big-shovel',
                    'flaticon-construction-tool-vehicle-with-crane-lifting-materials',
                    'flaticon-construction-vehicle',
                    'flaticon-construction-vehicle-for-concrete-transportation',
                    'flaticon-constructor',
                    'flaticon-constructor-with-hard-hat-and-stop-hexagonal-signal',
                    'flaticon-constructor-with-hard-hat-protection-on-his-head',
                    'flaticon-constructor-with-hat-and-a-gear',
                    'flaticon-crane-transporting-construction-material-for-a-building',
                    'flaticon-crane-transporting-container',
                    'flaticon-demolition-tool-transport-with-weight-ball',
                    'flaticon-drawing-architecture-project-of-a-house',
                    'flaticon-drawing-compass',
                    'flaticon-drill','flaticon-drill-tool-to-make-holes',
                    'flaticon-electrical-saw-wheel-cutting-tool',
                    'flaticon-exclamation-sign-in-triangular-signal',
                    'flaticon-factory-building',
                    'flaticon-folded-paper',
                    'flaticon-gear-shape',
                    'flaticon-hammer',
                    'flaticon-hammer-nailing-a-nail-in-a-wall',
                    'flaticon-hammer-tool-with-point',
                    'flaticon-hand-holding-a-hammer',
                    'flaticon-hand-holding-a-screwdriver-tool',
                    'flaticon-hand-holding-a-wrench',
                    'flaticon-hand-holding-an-ax-cutting-tool',
                    'flaticon-hand-of-a-painter-holding-paint-roller',
                    'flaticon-hexagonal-nut-tool',
                    'flaticon-hook-of-a-crane',
                    'flaticon-machine',
                    'flaticon-nut-and-bolt-tools-couple',
                    'flaticon-pail-cylindrical-shape-tool-for-construction-materials',
                    'flaticon-paint-brush',
                    'flaticon-paint-roll',
                    'flaticon-painting-in-a-pail',
                    'flaticon-painting-roller-tool-on-a-wall',
                    'flaticon-pipes-tubes-angle',
                    'flaticon-roof-holding-of-a-crane-on-prefabricated-house',
                    'flaticon-rounded-building-shape',
                    'flaticon-saw-tool-in-vertical-position',
                    'flaticon-sawing-cutting-tool',
                    'flaticon-screw-side-view',
                    'flaticon-screwdriver-tool',
                    'flaticon-shovel-agriculture-equipment-tool-in-vertical-position',
                    'flaticon-shovel-tool',
                    'flaticon-smog-factory-building-contamination',
                    'flaticon-stair',
                    'flaticon-street-barriers',
                    'flaticon-street-signal-barrier-with-stripes',
                    'flaticon-traffic-cone-signal-tool-for-traffic',
                    'flaticon-transport-with-arm-and-scoop',
                    'flaticon-triangular-shovel-with-liquid-concrete',
                    'flaticon-triangular-small-shovel-tool-for-construction',
                    'flaticon-truck-for-construction-materials-transport',
                    'flaticon-truck-transport-with-construction-materials',
                    'flaticon-truck-transporting-packages-on-frontal-blade',
                    'flaticon-two-gears',
                    'flaticon-two-screwing-tools',
                    'flaticon-wall-of-bricks','flaticon-wheelbarrow-side-view',
                    'flaticon-wheelbarrow-tool-for-transport-construction-materials-with-wheels',
                    'flaticon-worker-of-construction-working-with-a-shovel-beside-material-pile',
                    'flaticon-wrench-and-hammer-cross',
                    'flaticon-wrench-for-nuts',
                    'flaticon-wrench-in-a-hand',
                    'flaticon-wrench-with-adjusting-system-for-different-nuts-sizes'
                    ),

                "linearicon"=> array(
                    'lnr lnr-home ',
                    'lnr lnr-apartment ',
                    'lnr lnr-pencil ',
                    'lnr lnr-magic-wand ',
                    'lnr lnr-drop',
                    'lnr lnr-lighter ',
                    'lnr lnr-poop ',
                    'lnr lnr-sun ',
                    'lnr lnr-moon ',
                    'lnr lnr-cloud ',
                    'lnr lnr-cloud-upload ',
                    'lnr lnr-cloud-download ',
                    'lnr lnr-cloud-sync ',
                    'lnr lnr-cloud-check ',
                    'lnr lnr-database',
                    'lnr lnr-lock ',
                    'lnr lnr-cog ',
                    'lnr lnr-trash ',
                    'lnr lnr-dice ',
                    'lnr lnr-heart ',
                    'lnr lnr-star ',
                    'lnr lnr-star-half ',
                    'lnr lnr-star-empty ',
                    'lnr lnr-flag ',
                    'lnr lnr-envelope ',
                    'lnr lnr-paperclip ',
                    'lnr lnr-inbox ',
                    'lnr lnr-eye ',
                    'lnr lnr-printer ',
                    'lnr lnr-file-empty ',
                    'lnr lnr-file-add ',
                    'lnr lnr-enter ',
                    'lnr lnr-exit ',
                    'lnr lnr-graduation-hat ',
                    'lnr lnr-license ',
                    'lnr lnr-music-note ',
                    'lnr lnr-film-play ',
                    'lnr lnr-camera-video ',
                    'lnr lnr-camera ',
                    'lnr lnr-picture ',
                    'lnr lnr-book ',
                    'lnr lnr-bookmark ',
                    'lnr lnr-user ',
                    'lnr lnr-users ',
                    'lnr lnr-shirt ',
                    'lnr lnr-store ',
                    'lnr lnr-cart ',
                    'lnr lnr-tag ',
                    'lnr lnr-phone-handset ',
                    'lnr lnr-phone ',
                    'lnr lnr-pushpin ',
                    'lnr lnr-map-marker ',
                    'lnr lnr-map ',
                    'lnr lnr-location ',
                    'lnr lnr-calendar-full ',
                    'lnr lnr-keyboard ',
                    'lnr lnr-spell-check ',
                    'lnr lnr-screen ',
                    'lnr lnr-smartphone ',
                    'lnr lnr-tablet',
                    'lnr lnr-laptop ',
                    'lnr lnr-laptop-phone ',
                    'lnr lnr-power-switch ',
                    'lnr lnr-bubble ',
                    'lnr lnr-heart-pulse ',
                    'lnr lnr-construction ',
                    'lnr lnr-pie-chart ',
                    'lnr lnr-chart-bars ',
                    'lnr lnr-gift ',
                    'lnr lnr-diamond ',
                    'lnr lnr-linearicons ',
                    'lnr lnr-dinner ',
                    'lnr lnr-coffee-cup ',
                    'lnr lnr-leaf ',
                    'lnr lnr-paw ',
                    'lnr lnr-rocket ',
                    'lnr lnr-briefcase ',
                    'lnr lnr-bus ',
                    'lnr lnr-car ',
                    'lnr lnr-train ',
                    'lnr lnr-bicycle ',
                    'lnr lnr-wheelchair ',
                    'lnr lnr-select ',
                    'lnr lnr-earth ',
                    'lnr lnr-smile ',
                    'lnr lnr-sad ',
                    'lnr lnr-neutral ',
                    'lnr lnr-mustache ',
                    'lnr lnr-alarm ',
                    'lnr lnr-bullhorn ',
                    'lnr lnr-volume-high ',
                    'lnr lnr-volume-medium ',
                    'lnr lnr-volume-low ',
                    'lnr lnr-volume ',
                    'lnr lnr-mic ',
                    'lnr lnr-hourglass ',
                    'lnr lnr-undo ',
                    'lnr lnr-redo ',
                    'lnr lnr-sync ',
                    'lnr lnr-history ',
                    'lnr lnr-clock ',
                    'lnr lnr-download ',
                    'lnr lnr-upload ',
                    'lnr lnr-enter-down ',
                    'lnr lnr-exit-up ',
                    'lnr lnr-bug ',
                    'lnr lnr-code ',
                    'lnr lnr-link ',
                    'lnr lnr-unlink ',
                    'lnr lnr-thumbs-up ',
                    'lnr lnr-thumbs-down ',
                    'lnr lnr-magnifier ',
                    'lnr lnr-cross ',
                    'lnr lnr-menu ',
                    'lnr lnr-list ',
                    'lnr lnr-chevron-up ',
                    'lnr lnr-chevron-down ',
                    'lnr lnr-chevron-left ',
                    'lnr lnr-chevron-right ',
                    'lnr lnr-arrow-up ',
                    'lnr lnr-arrow-down ',
                    'lnr lnr-arrow-left ',
                    'lnr lnr-arrow-right ',
                    'lnr lnr-move ',
                    'lnr lnr-warning ',
                    'lnr lnr-question-circle ',
                    'lnr lnr-menu-circle ',
                    'lnr lnr-checkmark-circle ',
                    'lnr lnr-cross-circle ',
                    'lnr lnr-plus-circle ',
                    'lnr lnr-circle-minus ',
                    'lnr lnr-arrow-up-circle ',
                    'lnr lnr-arrow-down-circle ',
                    'lnr lnr-arrow-left-circle ',
                    'lnr lnr-arrow-right-circle ',
                    'lnr lnr-chevron-up-circle ',
                    'lnr lnr-chevron-down-circle ',
                    'lnr lnr-chevron-left-circle ',
                    'lnr lnr-chevron-right-circle ',
                    'lnr lnr-crop ',
                    'lnr lnr-frame-expand ',
                    'lnr lnr-frame-contract ',
                    'lnr lnr-layers ',
                    'lnr lnr-funnel ',
                    'lnr lnr-text-format ',
                    'lnr lnr-text-format-remove ',
                    'lnr lnr-text-size ',
                    'lnr lnr-bold ',
                    'lnr lnr-italic ',
                    'lnr lnr-underline ',
                    'lnr lnr-strikethrough ',
                    'lnr lnr-highlight ',
                    'lnr lnr-text-align-left ',
                    'lnr lnr-text-align-center ',
                    'lnr lnr-text-align-right ',
                    'lnr lnr-text-align-justify ',
                    'lnr lnr-line-spacing ',
                    'lnr lnr-indent-increase ',
                    'lnr lnr-indent-decrease ',
                    'lnr lnr-pilcrow ',
                    'lnr lnr-direction-ltr ',
                    'lnr lnr-direction-rtl ',
                    'lnr lnr-page-break ',
                    'lnr lnr-sort-alpha-asc ',
                    'lnr lnr-sort-amount-asc ',
                    'lnr lnr-hand ',
                    'lnr lnr-pointer-up ',
                    'lnr lnr-pointer-right ',
                    'lnr lnr-pointer-down ',
                    'lnr lnr-pointer-left ',
                )
            );
	}

}

FW_Option_Type::register('Kapp_Option_Type_Flaticon');