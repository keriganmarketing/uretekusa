<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$tabs = fw_akg( 'tabs', $atts, array() );
$i = 1;
?>
<div class="tabs-area">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <?php $x = 1; foreach ( $tabs  as $tab ) {  ?>
        <li role="presentation" <?php if($i==1) { ?> class="active" <?php } ?>>
            <a href="#tab-<?php echo $i; ?>" aria-controls="tab-<?php echo $i; ?>" role="tab" data-toggle="tab"<?php if($i==1) { ?> aria-expanded="true"<?php } ?>>
                <?php echo esc_attr($tab['tab_title']); ?>
            </a>
        </li>
        <?php $i++;
              } ?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <?php $x=1; foreach ( $tabs  as $tab ) {  ?>

        <div role="tabpanel" class="tab-pane color-mid p-20 pb-5<?php $x==1 ? print ' active' :''; ?>" id="tab-<?php echo $x; ?>">
            <?php echo $tab["description"]; ?>
        </div>


        <?php $x++;
              } ?>
    </div>
</div>