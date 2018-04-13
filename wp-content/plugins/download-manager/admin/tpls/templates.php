

<div class="wrap w3eden">

<div class="panel panel-default" id="wpdm-wrapper-panel">
<div class="panel-heading">
<b><i class="fa fa-magic color-purple"></i> &nbsp; <?php echo __("Templates", "wpdmpro"); ?></b>
    <div class="pull-right">
<a href="edit.php?post_type=wpdmpro&page=templates&_type=page&task=NewTemplate" class="btn btn-sm btn-default"><i class="fa fa-file color-purple"></i> <?php echo __("Create Page Template", "wpdmpro"); ?></a> <a href="edit.php?post_type=wpdmpro&page=templates&_type=link&task=NewTemplate" class="btn btn-sm btn-default"><i class="fa fa-link color-green"></i> <?php echo __("Create Link Template", "wpdmpro"); ?></a>
    </div>
    <div style="clear: both"></div>
</div>
    <ul id="tabs" class="nav nav-tabs nav-wrapper-tabs" style="padding: 60px 10px 0 10px;background: #f5f5f5">
    <li <?php if(!isset($_GET['_type'])||$_GET['_type']=='link'){ ?>class="active"<?php } ?>><a href="edit.php?post_type=wpdmpro&page=templates&_type=link" id="basic"><?php _e('Link Templates','wpdmpro'); ?></a></li>
    <li <?php if(isset($_GET['_type'])&&$_GET['_type']=='page'){ ?>class="active"<?php } ?>><a href="edit.php?post_type=wpdmpro&page=templates&_type=page" id="basic"><?php _e('Page Templates','wpdmpro'); ?></a></li>
    <li <?php if(isset($_GET['_type'])&&$_GET['_type']=='email'){ ?>class="active"<?php } ?>><a href="edit.php?post_type=wpdmpro&page=templates&_type=email" id="basic"><?php _e('Email Templates','wpdmpro'); ?></a></li>
    </ul>
<div class="tab-content panel-body">
    <?php if(!isset($_GET['_type']) || $_GET['_type']!='email'){ ?>
<blockquote  class="alert alert-info" style="margin-bottom: 10px">
<?php echo __("Pre-designed templates can't be deleted or edited from this section. But you can clone any of them and edit as your own. If you seriously want to edit any pre-designed template you have to edit those directly edting php files at /download-manager/templates/ dir","wpdmpro"); ?>
</blockquote>
    <?php } ?>


<table cellspacing="0" class="table table-hover">
    <thead>
    <tr>
    <th style="min-width: 400px"><?php echo __("Template Name", "wpdmpro"); ?></th>
    <th style="width: 250px;"><?php echo __("Template ID", "wpdmpro"); ?></th>
      <?php if(!isset($_GET['_type']) || $_GET['_type'] != 'email'){ ?>
    <th style="width: 150px"><?php echo __("Status", "wpdmpro"); ?></th>
        <?php } ?>
    <th style="width: 260px;text-align: right"><?php echo __("Actions", "wpdmpro"); ?></th>
    </tr>
    </thead>


    <tbody class="list:post" id="the-list">

    <?php 
    $ttype = isset($_GET['_type'])?$_GET['_type']:'link';
    if($ttype != 'email'){
        $ctpls = WPDM\admin\menus\Templates::Dropdown(array('data_type' => 'ARRAY', 'type' => $ttype));
        $ctemplates = maybe_unserialize(get_option("_fm_{$ttype}_templates",true));
    if(is_array($ctemplates))
        $ctemplates = array_keys($ctemplates);
    if(!is_array($ctemplates)) $ctemplates = array();
    $tplstatus = maybe_unserialize(get_option("_fm_{$ttype}_template_status"));

    foreach($ctpls as $ctpl => $title){
        $tplid = str_replace(".php","",$ctpl);
        $status = isset($tplstatus[$tplid])?$tplstatus[$tplid]:1;
    ?>
     
    <tr valign="top" class="author-self status-inherit" id="template-<?php echo $ttype; ?>-<?php echo $ctpl; ?>">
                <td class="column-icon media-icon" style="text-align: left;">                                     
                   <nobr><?php echo $title; ?></nobr>
                </td>
                <td>
                <input class="form-control input-sm input-tplid" type="text" readonly="readonly" onclick="this.select()" value="<?php echo $tplid; ?>" />
                </td>
        <td>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-<?php echo $status==1?'success active':'default'; ?> btn-sm btn-status <?php echo str_replace(".php","",$ctpl); ?>" data-value="1" data-id="<?php echo str_replace(".php","",$ctpl); ?>"><input type="radio" <?php checked($status,1); ?> name="<?php echo $ctpl; ?>-status" value="1"/><i class="fa fa-check"></i></label>
                <label class="btn btn-<?php echo $status==0?'danger active':'default'; ?> btn-sm btn-status <?php echo str_replace(".php","",$ctpl); ?>" data-value="0" data-id="<?php echo str_replace(".php","",$ctpl); ?>"><input type="radio" name="<?php echo $ctpl; ?>-status" <?php checked($status,0); ?> value="0"/><i class="fa fa-times"></i></label>
            </div>
        </td>
        <td style="text-align: right">
            <a data-toggle="modal" href="#" data-href="admin-ajax.php?action=template_preview&_type=<?php echo $ttype; ?>&template=<?php echo $ctpl; ?>" data-target="#preview-modal" rel="<?php echo $ctpl; ?>" class="template_preview btn btn-sm btn-success"><i class="fa fa-desktop"></i> Preview</a>
            <?php if(!in_array($ctpl, $ctemplates)){ ?>
            <a href="edit.php?post_type=wpdmpro&page=templates&_type=<?php echo $ttype; ?>&task=NewTemplate&clone=<?php echo $ctpl; ?>" class="btn btn-sm btn-primary"><i class="fa fa-copy"></i> <?php echo __("Clone", "wpdmpro"); ?></a>
            <?php } else { ?>
            <a href="edit.php?post_type=wpdmpro&page=templates&_type=<?php echo $ttype; ?>&task=EditTemplate&tplid=<?php echo $ctpl; ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> <?php echo __("Edit", "wpdmpro"); ?></a>
            <a data-ttype="<?php echo $ttype; ?>" data-tplid="<?php echo $ctpl; ?>" href="edit.php?post_type=wpdmpro&page=templates&_type=<?php echo $ttype; ?>&task=DeleteTemplate&tplid=<?php echo $ctpl; ?>" class="submitdelete delete-template btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> <?php echo __("Delete", "wpdmpro"); ?></a>
            <?php } ?>
        </td>
                
     
     </tr>
    <?php
    }} else {
        $templates = \WPDM\Email::templates();
    foreach($templates as $ctpl => $template){
        ?>
        <tr valign="top" class="author-self status-inherit" id="post-8">
            <td class="column-icon media-icon" style="text-align: left;">
                <?php echo $template['label']; ?> ( <?php _e('To:','wpdmpro'); ?> <?php echo ucfirst($template['for']); ?> )

            </td>
            <td>
                <?php echo $ctpl; ?>
            </td>
            <td style="text-align: right">

    <a href="edit.php?post_type=wpdmpro&page=templates&_type=email&task=EditEmailTemplate&id=<?php echo $ctpl; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> <?php echo __("Edit", "wpdmpro"); ?></a>

            </td>


        </tr>
    <?php
    }}
    ?>
    </tbody>
</table>



    <?php if($ttype == 'email'){ ?>
    <form method="post" id="emlstform">
        <div class="panel panel-default">
            <div class="panel-heading">Email Settings</div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php _e('Email Template', 'wpdmpro'); ?>
                            <select name="__wpdm_email_template" class="form-control" style="width: 200px" id="etmpl">
                                <?php
                                $eds = \WPDM\FileSystem::scanDir(WPDM_BASE_DIR.'email-templates');
                                $__wpdm_email_template = get_option('__wpdm_email_template', "default.html");
                                $__wpdm_email_setting = maybe_unserialize(get_option('__wpdm_email_setting'));
                                foreach ($eds as $file) {
                                    if(strstr($file, ".html")) {
                                        ?>
                                        <option value="<?php echo basename($file); ?>" <?php selected($__wpdm_email_template, basename($file)); ?> ><?php echo ucfirst(str_replace(".html", "", basename($file))); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php _e('Logo URL', 'wpdmpro'); ?>
                            <input type="text" name="__wpdm_email_setting[logo]" value="<?php echo isset($__wpdm_email_setting['logo'])?$__wpdm_email_setting['logo']:'';?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <?php _e('Banner/Background Image URL', 'wpdmpro'); ?>
                            <input type="text" name="__wpdm_email_setting[banner]" value="<?php echo isset($__wpdm_email_setting['banner'])?$__wpdm_email_setting['banner']:'';?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <?php _e('Footer Text', 'wpdmpro'); ?>
                            <input type="text" name="__wpdm_email_setting[footer_text]" value="<?php echo isset($__wpdm_email_setting['footer_text'])?$__wpdm_email_setting['footer_text']:'';?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <?php _e('Facebook Page URL', 'wpdmpro'); ?>
                            <input type="text" name="__wpdm_email_setting[facebook]" value="<?php echo isset($__wpdm_email_setting['facebook'])?$__wpdm_email_setting['facebook']:'';?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <?php _e('Twitter Profile URL', 'wpdmpro'); ?>
                            <input type="text" name="__wpdm_email_setting[twitter]" value="<?php echo isset($__wpdm_email_setting['twitter'])?$__wpdm_email_setting['twitter']:'';?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <?php _e('Youtube Profile URL', 'wpdmpro'); ?>
                            <input type="text" name="__wpdm_email_setting[youtube]" value="<?php echo isset($__wpdm_email_setting['youtube'])?$__wpdm_email_setting['youtube']:'';?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <iframe style="width: 100%;height: 500px;" id="preview" src="edit.php?action=email_template_preview&id=user-signup&etmpl=<?php echo $__wpdm_email_template; ?>">

                        </iframe>
                    </div>
                </div>

            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-primary" id="emsbtn" style="width: 150px;"><i class="fa fa-floppy-o"></i> <?php _e('Save Changes', 'wpdmpro'); ?></button>
            </div>
        </div>
    </form>
    <?php } ?>

    </div>
    </div>


    <div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="preview" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php _e('Template Preview','wpdmpro'); ?></h4>
                </div>
                <div class="modal-body" id="preview-area">

                </div>
                <div class="modal-footer text-left" style="text-align: left">
                    <div class='alert alert-info'><?php _e('This is a preview, original template color scheme may look little different, but structure will be same','wpdmpro'); ?></div>
                </div>
            </div>
        </div>
    </div>


<style>div.notice{ display: none; }</style>
<script>



    jQuery(function($){
        $('.template_preview').click(function(){
            $('#preview-area').html("<i class='fa fa-spin fa-spinner'></i> Loading Preview...").load($(this).attr('data-href'));
        });
        $('#etmpl').on('change', function () {
            $('#preview').attr('src', 'edit.php?action=email_template_preview&id=user-signup&etmpl='+$(this).val());
        });
        $('#emlstform').submit(function (e) {
            e.preventDefault();
            $('#emsbtn').html('<i class="fa fa-refresh fa-spin"></i> <?php _e('Saving...', 'wpdmpro'); ?>');
            $(this).ajaxSubmit({
                url: ajaxurl+"?action=wpdm_save_email_setting",
                success: function (res) {
                    $('#emsbtn').html('<i class="fa fa-floppy-o"></i> <?php _e('Save Changes', 'wpdmpro'); ?>');
                }
            });
        });

        $('.btn-status').on('click', function () {
            var v = $(this).data('value');
            var c = '.'+$(this).data('id');
            var $this = this;
            $.post(ajaxurl, {action: 'update_template_status', template: $(this).data('id'), type: '<?php echo $ttype; ?>', status: v}, function (res) {
                $(c).removeClass('btn-danger').removeClass('btn-success').addClass('btn-default');
                if(v==1)
                    $($this).addClass('btn-success').removeClass('btn-default');
                else
                    $($this).addClass('btn-danger').removeClass('btn-default');
            });


        });

        $('.delete-template').on('click', function (e) {
            if(!confirm('<?php _e("Are you sure?", "wpdmpro"); ?>')) return false;
            e.preventDefault();
            var rowid = '#template-'+$(this).data('ttype')+"-"+$(this).data('tplid');
            $(this).html('<i class="fa fa-times fa-spin"></i> Delete');
            $.get(ajaxurl, {action: 'wpdm_delete_template', ttype: $(this).data('ttype'), tplid: $(this).data('tplid')}, function (res) {
                $(rowid).remove();
            });
        });
    });

</script>
</div>


 
