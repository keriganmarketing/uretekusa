<?php
$tpl = \WPDM\Email::template($_GET['id']);
$info = \WPDM\Email::info($_GET['id']);
?><div class="wrap w3eden">
     <div class="panel panel-default" id="wpdm-wrapper-panel">
         <div class="panel-heading">
             <b><i class="fa fa-magic color-purple"></i> &nbsp; <?php echo __("Templates", "wpdmpro"); ?></b>
             <div class="pull-right">
                 <a href="edit.php?post_type=wpdmpro&page=templates&_type=page&task=NewTemplate" class="btn btn-sm btn-default <?php echo wpdm_query_var('_type')=='page'?'active':''; ?>"><i class="fa fa-file color-green"></i> <?php echo __("Create Page Template", "wpdmpro"); ?></a> <a href="edit.php?post_type=wpdmpro&page=templates&_type=link&task=NewTemplate" class="btn btn-sm btn-default <?php echo wpdm_query_var('_type')=='link'?'active':''; ?>"><i class="fa fa-link color-purple"></i> <?php echo __("Create Link Template", "wpdmpro"); ?></a>
             </div>
             <div style="clear: both"></div>
         </div>
         <ul id="tabs" class="nav nav-tabs nav-wrapper-tabs" style="padding: 60px 10px 0 10px;background: #f5f5f5">
             <li><a href="edit.php?post_type=wpdmpro&page=templates&_type=link" id="basic"><?php echo __("Link Templates", "wpdmpro"); ?></a></li>
             <li><a href="edit.php?post_type=wpdmpro&page=templates&_type=page" id="basic"><?php echo __("Page Templates", "wpdmpro"); ?></a></li>
             <li><a href="edit.php?post_type=wpdmpro&page=templates&_type=email" id="basic"><?php _e('Email Templates','wpdmpro'); ?></a></li>
             <li class="active"><a href="" id="basic"><?php echo __('Email Template Editor','wpdmpro'); ?></a></li>

         </ul>
         <div class="tab-content" style="padding-top: 15px;">



<div style="padding: 15px;">
<div class="row">
<div class="col-md-12">
    <div class="well" style="font-size: 11pt;font-weight: 600">
        <div class="pull-right">
            <?php echo sprintf(__('To: %s'), ucfirst($info['for'])); ?>
        </div>
        <?php echo sprintf(__('Editing: %s'), $info['label']); ?>
    </div>
    </div>
    </div>
    <div class="row">
<div class="col-md-8">
<form action="" method="post">


                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <input type="text" name="email_template[subject]" required="required" title="<?php echo __('Email Subject','wpdmpro'); ?>" placeholder="<?php echo __('Email Subject','wpdmpro'); ?>" x-moz-errormessage="<?php echo __('Email Subject','wpdmpro'); ?>" value="<?php echo $tpl['subject']; ?>" class="form-control input-lg">
                <ul class="nav nav-tabs" style="margin-top: 10px; ">
                    <li class="active"><a href="#code" data-toggle="tab"><?php echo __('Message','wpdmpro'); ?></a></li>
                    <li><a href="#preview" data-toggle="tab"><?php echo __('Preview','wpdmpro'); ?></a></li>
                </ul>
                <div class="tab-content tpleditor">
                    <div class="tab-pane active" id="code">

                        <?php wp_editor(stripslashes($tpl['message']),'content', array('textarea_name' => 'email_template[message]')); ?>
                    </div>
                    <div class="tab-pane" id="preview">
                        <i class="fa fa-spinner fa-spin"></i> Loading Preview...
                    </div>
                </div>
    <br/>
    <?php if($info['for'] == 'admin'){ ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <div class="input-group-addon" title="<?php echo __('To Email','wpdmpro'); ?>"><i class="fa fa-paper-plane-o"></i></div>
                                <input placeholder="<?php echo __('To Email','wpdmpro'); ?>" type="text" class="form-control input-lg" name="email_template[to_email]" value="<?php echo $tpl['to_email']; ?>">
                            </div>

                        </div>
                    </div>

                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo __('From Name','wpdmpro'); ?>
                                <input type="text" class="form-control" name="email_template[from_name]" value="<?php echo $tpl['from_name']; ?>">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo __('From Email','wpdmpro'); ?>
                                <input type="text" class="form-control" name="email_template[from_email]" value="<?php echo $tpl['from_email']; ?>">

                        </div>
                    </div>
                </div>


				
				
<br/>
    <div class="text-right"><button type="submit" value="" class="btn btn-primary btn-lg"><i class="fa fa-floppy-o"></i> <?php echo __('Save Changes','wpdmpro'); ?></button></div>

                 

				
				<br/>
				
				


</form>
 
          
</div>

     







<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo __('Template Variables','wpdmpro'); ?></div>

           <table id="template_tags" class="table" style="margin-top: -1px">
           <?php foreach (\WPDM\Email::tags() as $tag => $info){ ?>
           <tr><td><input type="text" readonly="readonly" class="form-control"  onclick="this.select()" value="<?php echo $tag; ?>" style="font-size:10px;width: 120px;text-align: center;"></td><td><?php echo $info['desc']; ?></td></tr>
           <?php } ?>

           </table>


        </div>
</div>
</div>
<script>

    jQuery.fn.extend({
        insertAtCaret: function(myValue){
            return this.each(function(i) {
                if (document.selection) {
                    //For browsers like Internet Explorer
                    this.focus();
                    var sel = document.selection.createRange();
                    sel.text = myValue;
                    this.focus();
                }
                else if (this.selectionStart || this.selectionStart == '0') {
                    //For browsers like Firefox and Webkit based
                    var startPos = this.selectionStart;
                    var endPos = this.selectionEnd;
                    var scrollTop = this.scrollTop;
                    this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
                    this.focus();
                    this.selectionStart = startPos + myValue.length;
                    this.selectionEnd = startPos + myValue.length;
                    this.scrollTop = scrollTop;
                } else {
                    this.value += myValue;
                    this.focus();
                }
            });
        }
    });

    jQuery(function(){
        jQuery('a[href="#preview"]').on('shown.bs.tab', function (e) {
            jQuery('#preview').html('<i class="fa fa-spinner fa-spin"></i> Loading Preview...');
            jQuery.post(ajaxurl,{action:'',template:jQuery('#templateeditor').val()},function(res){
                jQuery('#preview').html("<iframe style='width:100%;height:700px;border:0;' src='edit.php?action=email_template_preview&id=<?php echo $_GET['id']; ?>'></iframe>");
            });


        });

        jQuery('.dropdown-menu a').click(function(e){
            e.preventDefault();
            var tag = jQuery(this).attr('href').replace('#','');
            jQuery('#content').insertAtCaret(tag);
        });

        jQuery('#template_tags .form-control').on('select', function(){
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
            } catch (err) {
                console.log('Oops, unable to copy');
            }
        })
    });

</script>



<div style="clear: both"></div>


</div>
</div>
</div>
</div>


<style>
    #template_tags .form-control{
        background: #fafafa;
    }
    #wp-content-editor-tools{
        background: #ffffff;
    }
    .wp-editor-tabs{
        margin-top: 3px;
    }
</style>