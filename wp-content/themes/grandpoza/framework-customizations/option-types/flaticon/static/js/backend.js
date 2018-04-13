/**
 * Option Type : flaticon
 */
jQuery(function ($) {
    'use strict';
    var optionTypeClass = '.kapp-option-type-icon';

	fwEvents.on('fw:options:init', function (data) {
	    console.log(data);
		var $options = data.$elements.find(optionTypeClass +':not(.initialized)');
	
		// handle click on an icon
		$options.find('.js-option-type-flaticon-item').on('click', function () {
			var $this = $(this);

			if ($this.hasClass('active')) {
				$this.removeClass('active');
				$this.closest(optionTypeClass).find('input').val('').trigger('change');
			} else {
				$this.addClass('active').siblings().removeClass('active');
				$this.closest(optionTypeClass).find('input').val($this.data('value')).trigger('change');
			}
		});

		$options.addClass('initialized');

	});

});