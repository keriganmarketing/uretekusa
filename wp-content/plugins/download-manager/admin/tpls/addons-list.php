
<script type="text/javascript" src="<?php echo includes_url();?>/js/jquery/jquery.form.min.js"></script>
<link rel="stylesheet" href="<?php echo plugins_url('/download-manager/assets/css/chosen.css'); ?>" />
<script language="JavaScript" src="<?php echo plugins_url('/download-manager/assets/js/chosen.jquery.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('/download-manager/bootstrap/css/bootstrap.css');?>" />

<style>

    .note{
        color: #888888;

    }
    input{
        padding: 7px;
    }
    #wphead{
        border-bottom:0px;
    }
    #screen-meta-links{
        display: none;
    }
    .wrap{
        margin: 0px;
        padding: 0px;
    }
    #wpbody{
        margin-left: -19px;
    }
    select{
        min-width: 150px;
    }

    .wpdm-loading {
        background: url('<?php  echo plugins_url('download-manager/images/wpdm-settings.png'); ?>') center center no-repeat;
        width: 16px;
        height: 16px;
        /*border-bottom: 2px solid #2a2dcb;*/
        /*border-left: 2px solid #ffffff;*/
        /*border-right: 2px solid #c30;*/
        /*border-top: 2px solid #3dd269;*/
        /*border-radius: 100%;*/

    }

    .w3eden .btn{
        border-radius: 0.2em !important;
    }
    .well{ box-shadow: none !important; background: #FFFFFF !important; } .btn{ border: 0 !important; }

    .w3eden .nav-pills a{
        background: #f5f5f5;
    }

    #addonmodal{ background: rgba(0,0,0,0.7); z-index: 9999; }

    #addonmodal .modal-dialog{
        margin-top: 100px;

    }

    .w3eden .form-control,
    .w3eden .nav-pills a{
        border-radius: 0.2em !important;
        box-shadow: none !important;
        font-size: 9pt !important;
    }

    .wpdm-spin{
        -webkit-animation: spin 2s infinite linear;
        -moz-animation: spin 2s infinite linear;
        -ms-animation: spin 2s infinite linear;
        -o-animation: spin 2s infinite linear;
        animation: spin 2s infinite linear;
    }

    @keyframes "spin" {
        from {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(359deg);
            -moz-transform: rotate(359deg);
            -o-transform: rotate(359deg);
            -ms-transform: rotate(359deg);
            transform: rotate(359deg);
        }

    }

    @-moz-keyframes spin {
        from {
            -moz-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        to {
            -moz-transform: rotate(359deg);
            transform: rotate(359deg);
        }

    }

    @-webkit-keyframes "spin" {
        from {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(359deg);
            transform: rotate(359deg);
        }

    }

    @-ms-keyframes "spin" {
        from {
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        to {
            -ms-transform: rotate(359deg);
            transform: rotate(359deg);
        }

    }

    @-o-keyframes "spin" {
        from {
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        to {
            -o-transform: rotate(359deg);
            transform: rotate(359deg);
        }

    }

    .panel-heading h3.h{
        font-size: 11pt;
        font-weight: 700;
        margin: 0;
        padding: 5px 10px;
        font-family: 'Open Sans';
    }

    .panel-heading .btn.btn-primary{
        margin-top: -4px;
        margin-right: -6px;
        border-radius: 3px;
        border:1px solid rgba(255,255,255,0.8);
        -webkit-transition: all 400ms ease-in-out;
        -moz-transition: all 400ms ease-in-out;
        -o-transition: all 400ms ease-in-out;
        transition: all 400ms ease-in-out;
    }

    .panel-heading .btn.btn-primary:hover{
        margin-top: -4px;
        margin-right: -6px;
        border-radius: 3px;
        border:1px solid rgba(255,255,255,1);

    }

    .alert-info {
        background-color: #DFECF7 !important;
        border-color: #B0D1EC !important;
    }

    ul.nav li a:active,
    ul.nav li a:focus,
    ul.nav li a{
        outline: none !important;
    }

    .w3eden .nav-pills li.active a,
    .btn-primary,
    .w3eden .panel-primary > .panel-heading{
        background-image: linear-gradient(to bottom, #2081D5 0px, #1B6CB2 100%) !important;
    }
    .w3eden .panel-default > .panel-heading {
        background-image: linear-gradient(to bottom, #F5F5F5 0px, #E1E1E1 100%);
        background-repeat: repeat-x;
    }

    #modalcontents .wrap h2{ display: none; }

    .list-group-item:hover{
        background: #fafafa;
    }
    .panel-default .panel-body{
        font-size: 9pt;
    }
    .panel-default .panel-footer{
        font-size: 8pt;
    }
    .addonlist.panel-default .panel-body a{
        white-space: nowrap;
        overflow: hidden;
        display: inline-block;
        max-width: 98%;
        text-overflow: ellipsis;
    }
    .list-group-item{
        border-radius: 3px !important;

    }
    .w3eden a:hover,
    .w3eden a{
        text-decoration: none !important;
    }
    #filter-mods a{
        font-size: 8pt;
        padding: 5px 15px;
    }
    .updated{
        display: none;
    }
</style>

<div class="wrap w3eden">

    <?php if(is_array($cats)){ ?>
    <div class="container-fluid">
        <div class="row" id="addonlist" style="margin-top: -15px">
            <div class="col-md-12"><div class="panel panel-default" style="margin-top: 30px">
                    <div class="panel-heading"><h3 style="font-size: 13pt;font-weight: 600;letter-spacing: 1px;line-height: 30px"><i class="fa fa-plug color-purple"></i> &nbsp;<?php _e('WPDM Add-Ons','download-manager'); ?></h3></div>
                    <div class="panel-body"><ul class="nav nav-pills" id="filter-mods"><li class="active"><a href="#all" rel="all">All Add-Ons</a></li>

                            <?php
                            foreach($cats as $cat){
                                echo "<li><a href='#' rel='{$cat->slug}'>{$cat->name}</a></li>";
                            }
                            ?>
                        </ul></div></div></div>

            <div row'>
            <?php foreach($data->post_extra as $package){
                ?>
                <div class="col-md-3 all <?php echo implode(" ", $package->cats); ?>">

                    <div class="addonlist panel panel-default">
                        <div class="panel-body">
                            <b><a target="_blank" title="<?php echo $package->title; ?>" class="ttip" href="<?php echo $package->link; ?>"><?php echo $package->title;?></a></b>


                        </div>
                        <div class="panel-footer text-right">
                            <?php if($package->price>0){ ?>
                                <a class="btn-purchase" data-toggle="modal" data-backdrop="true" data-target="#addonmodal" href="#" rel="<?php echo $package->ID; ?>" style="border: 0;border-radius: 2px;"><i class="fa fa-shopping-cart"></i> &nbsp;Buy Now <span class="label label-success" style="font-size: 8pt;padding: 1px 5px;margin-top: 1px"><?php echo $package->currency.$package->price; ?></span> </a>
                            <?php } else { ?>
                                <a class="btn-install" data-toggle="modal" rel="<?php echo $package->ID; ?>" data-backdrop="true" data-target="#addonmodal" href="#" style="border: 0;border-radius: 2px"><i class="fa fa-download"></i> &nbsp;Download & Install <span class="label label-danger" style="font-size: 8pt;padding: 1px 5px;margin-top: 1px">Free</span> </a>
                            <?php } ?>
                            <span class="note pull-left"><i class="fa fa-server" aria-hidden="true"></i> &nbsp;<?php echo $package->pinfo->version; ?></span>
                        </div>
                    </div>


                </div>
                <?php
            }
            ?>

        </div>
    </div>

</div>
<?php } else {
    unset($_SESSION['wpdm_addon_store_data']);
    unset($_SESSION['wpdm_addon_store_cats']);
    ?>

    <div class="alert alert-danger" style="margin: 20px"><?php _e('Failed to connect with server!','download-manager'); ?></div>

<?php } ?>
<div class="modal fade" id="addonmodal" tabindex="-1" role="dialog" aria-labelledby="addonmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add-On Installer</h4>
            </div>
            <div class="modal-body" id="modalcontents">
                <i class="fa fa-spinner fa-spin"></i> Please Wait...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <a type="button" id="prcbtn" target="_blank" href="https://www.wpdownloadmanager.com/cart/" class="btn btn-success" style="display: none" onclick="jQuery('#addonmodal').modal('hide')">Checkout</a>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    jQuery(function(){
        jQuery('.nav-pills a').click(function(){
            jQuery('#addonlist .all').fadeOut();
            jQuery('.'+this.rel).fadeIn();
            jQuery('#prcbtn').hide();
            jQuery('.nav-pills li').removeClass('active');
            jQuery(this).parent().addClass('active');
        });

        jQuery(".btn-install, .btn-purchase").click(function(){
            jQuery('#modalcontents').html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
        });
        jQuery('#addonmodal').on('shown.bs.modal', function (e) {
            if(jQuery(e.relatedTarget).hasClass('btn-install')){
                jQuery('.modal-dialog').css('width','500px');
                jQuery('.modal-footer .btn-danger').html('Close');
                jQuery('#modalcontents').css('padding','20px').css('background','#ffffff');
                jQuery.post(ajaxurl,{action:'wpdm-install-addon', addon: e.relatedTarget.rel}, function(res){
                    jQuery('#modalcontents').html(res.replace('Return to Plugin Installer',''));
                });
            }

            if(jQuery(e.relatedTarget).hasClass('btn-purchase')){
                jQuery('.modal-dialog').css('width','800px');
                jQuery('.modal-footer').css('margin',0);
                jQuery('.modal-footer .btn-danger').html('<i class="fa fa-spinner fa-spin"></i> Please Wait...');
                jQuery('#modalcontents').css('padding',0).css('background','#f2f2f2').html("<iframe onload=\"jQuery('.modal-footer .btn-danger').html('Continue Shopping...');jQuery('#prcbtn').show();\" style='width: 100%;padding-top: 20px; background: #f2f2f2;height: 300px;border: 0' src='https://www.wpdownloadmanager.com/?addtocart="+e.relatedTarget.rel+"'></iframe>");
            }
        })


    });
</script>

