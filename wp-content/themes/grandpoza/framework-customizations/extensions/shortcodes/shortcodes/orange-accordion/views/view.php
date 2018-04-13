<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

?>

<div class="panel-group  faqs-area collapse in" id="accordion1" aria-expanded="true" role="listbox">
    <?php $x=1; foreach ( fw_akg( 'tabs', $atts, array() ) as $tab ) {  ?>

    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a <?php if($x!=2) { ?> class="collapsed" <?php } ?> data-toggle="collapse" data-parent="#accordion1" href="#item<?php echo $x; ?>" <?php if($x==2) { ?> aria-expanded="true" <?php } ?>>
                    <?php echo esc_attr($tab["tab_title"]); ?>
                </a>
            </h4>
        </div>
        <div id="item<?php echo $x; ?>" class="panel-collapse collapse<?php $x==2 ? print ' in' :''; ?>">
            <div class="panel-body">
                <?php echo $tab["description"]; ?>
            </div>
        </div>
    </div>

    <?php $x++;
          } ?>
</div>