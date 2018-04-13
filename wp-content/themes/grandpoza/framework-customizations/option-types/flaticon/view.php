<?php if (!defined('FW')) die('Forbidden');

/**
 * @var array $option
 * @var array $data
 * @var string $id
 * @var array $set
 */

?>
<div class="kapp-option-type-icon">

    <input <?php echo fw_attr_to_html($option['attr']) ?> type="hidden" />

    <div class="js-option-type-icon-container">
      
        <div class="option-type-icon-list js-option-type-icon-list">
            <?php
            
				foreach ($icons as $icon_set) {
					foreach($icon_set as $icon ){
                        $active = ($data['value'] == $icon) ? 'active' : '';
                        echo fw_html_tag('i', array(
                            'class' => "{$icon} js-option-type-flaticon-item {$active}",
                            'data-value' => $icon,
                        ), true);
                    }
				}
            ?>
        </div>

    </div>

</div>