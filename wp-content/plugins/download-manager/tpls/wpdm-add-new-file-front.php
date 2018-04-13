<?php
global $post;
if(!defined('ABSPATH')) die();

if(isset($pid))
$post = get_post($pid);
else {
$post = new stdClass();
$post->ID = 0;
$post->post_title = '';
$post->post_content = '';
}

if(isset($hide)) $hide = explode(',',$hide);
else $hide = array();
?>
<div class="w3eden">
 <link rel="stylesheet" type="text/css" href="<?php echo plugins_url('/download-manager/assets/css/chosen.css'); ?>" />
<style>
    .cat-panel ul,
    .cat-panel label,
    .cat-panel li{
        padding: 0;
        margin: 0;
        font-size: 9pt;
    }
    .cat-panel ul{
        margin-left: 20px;
    }
    .cat-panel > ul{
        padding-top: 10px;
    }
</style>
<div class="wpdm-front">
<form id="wpdm-pf" action="" method="post">
<div class="row">

    <div class="col-md-8">


<input type="hidden" id="act" name="act" value="<?php echo $task =='edit-package'?'_ep_wpdm':'_ap_wpdm'; ?>" />

<input type="hidden" name="id" id="id" value="<?php echo isset($pid)?$pid:0; ?>" />
<div class="form-group">
<input id="title" class="form-control input-lg"  placeholder="Enter title here" type="text" value="<?php echo isset($post->post_title)?$post->post_title:''; ?>" name="pack[post_title]" /><br/>
</div>
<div  class="form-group">
    <div class="panel panel-default" id="package-description">
        <div class="panel-heading"><strong><?php _e('Description', 'wpdmpro'); ?></strong></div>
<?php $cont = isset($post)?$post->post_content:''; wp_editor(stripslashes($cont),'post_content',array('textarea_name'=>'pack[post_content]', 'teeny' => 1, 'media_buttons' => 0)); ?>
    </div>
</div>

        <div class="panel panel-default" id="attached-files-section">
            <div class="panel-heading"><b><?php _e('Attached Files','wpdmpro'); ?></b></div>
            <div class="panel-body">
                <?php
                require_once wpdm_tpl_path('metaboxes/attached-files.php');
                ?>
            </div>
        </div>

            <div class="panel panel-default" <?php if(in_array('package-settings', $hide)) { ?>style="display: none"<?php }?> id="package-settings-section">
                <div class="panel-heading"><b><?php _e('Package Settings','wpdmpro'); ?></b></div>
                <div class="panel-body">
                    <?php
                    require_once wpdm_tpl_path("metaboxes/package-settings-front.php");
                    ?>
                </div>
            </div>

        <?php

            do_action("wpdm-package-form-left");
        ?>


</div>
<div class="col-md-4">

    <div class="panel panel-default" id="attach-file-section">
        <div class="panel-heading"><b><?php _e('Attach Files','wpdmpro'); ?></b></div>
        <div class="panel-body">
            <?php
            require_once wpdm_tpl_path("metaboxes/attach-file.php");
            ?>
        </div>
    </div>


    <div class="panel panel-default" id="categories-section">
        <div class="panel-heading"><b><?php _e('Categories','wpdmpro'); ?></b></div>
        <div class="panel-body cat-panel">
            <?php
            $term_list = wp_get_post_terms($post->ID, 'wpdmcategory', array("fields" => "all"));
            if(!function_exists('wpdm_categories_checkboxed_tree')) {
                function wpdm_categories_checkboxed_tree($parent = 0, $selected = array())
                {
                    $categories = get_terms('wpdmcategory', array('hide_empty' => 0, 'parent' => $parent));
                    $checked = "";
                    foreach ($categories as $category) {
                        if ($selected) {
                            foreach ($selected as $ptype) {
                                if ($ptype->term_id == $category->term_id) {
                                    $checked = "checked='checked'";
                                    break;
                                } else $checked = "";
                            }
                        }
                        echo '<li><label><input type="checkbox" ' . $checked . ' name="cats[]" value="' . $category->term_id . '"> ' . $category->name . ' </label>';
                        echo "<ul>";
                        wpdm_categories_checkboxed_tree($category->term_id, $selected);
                        echo "</ul>";
                        echo "</li>";
                    }
                }
            }

            echo "<ul class='ptypes'>";
            $cparent = isset($params['base_category'])?$params['base_category']:0;
            if($cparent!==0){
                $cparent = get_term_by('slug', $cparent, 'wpdmcategory');
                $cparent = $cparent->term_id;
                echo "<input type='hidden' value='{$cparent}' name='cats[]' />";
            }
            wpdm_categories_checkboxed_tree($cparent, $term_list);
            echo "</ul>";
            ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><b><?php _e('Main Preview Image','wpdmpro'); ?></b></div>

            <div id="img"><?php if(has_post_thumbnail((isset($pid)?$pid:0))):
                    $thumbnail_id = get_post_thumbnail_id((isset($pid)?$pid:0));
                    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id,'full', true);
                    ?>
                    <img src="<?php  echo $thumbnail_url[0]; ?>" alt="preview" /><input type="hidden" name="file[preview]" value="<?php  echo $thumbnail_url[0]; ?>" id="fpvw" />
                <?php else: ?>
                <div class="inside">
                    <a href="#" id="wpdm-featured-image">&nbsp;</a>
                    <input type="hidden" name="file[preview]" value="" id="fpvw" />
                    <div class="clear"></div>
                </div>
                <?php endif; ?>
            </div>
            <!-- <input type="file" name="preview" /> -->

        <?php if(has_post_thumbnail((isset($pid)?$pid:0))): ?>
            <div class="panel-footer"  id="rmvp">
                <a href="#" class="text-danger"><?php _e('Remove Featured Image','wpdmpro'); ?></a>
            </div>
        <?php endif; ?>
    </div>

<div class="panel panel-default">
<div class="panel-heading"><b><?php _e('Additional Preview Images','wpdmpro'); ?></b></div>
<div class="inside">

    <?php
    wpdm_additional_preview_images($post); ?>


 <div class="clear"></div>
</div>
</div>














<div class="panel panel-primary " id="form-action">
    <div class="panel-heading">
        <b>Actions</b>
    </div>
<div class="panel-body">

<label><input type="checkbox" <?php if(isset($post->post_status)) checked($post->post_status,'draft'); ?> value="draft" name="status"> <?php _e('Save as Draft','wpdmpro'); ?></label><br/><br/>


<button type="submit" accesskey="p" tabindex="5" id="publish" class="btn btn-success btn-block btn-lg" name="publish"><i class="fa fa-save" id="psp"></i> &nbsp;<?php echo $task=='edit-package'?__('Update Package','wpdmpro'):__('Create Package','wpdmpro'); ?></button>

</div>
</div>

</div>
</div>

</form>

</div>


<script type="text/javascript" src="<?php echo plugins_url('/download-manager/assets/js/chosen.jquery.min.js'); ?>"></script>
      <script type="text/javascript">

          var ps = "", pss = "", allps = "";

      jQuery(function() {

        jQuery('.w3eden select').chosen();
        jQuery('span.infoicon').css({color:'transparent',width:'16px',height:'16px',cursor:'pointer'}).tooltip({placement:'right',html:true});
        jQuery('span.infoicon').tooltip({placement:'right'});
        jQuery('.nopro').click(function(){
            if(this.checked) jQuery('.wpdmlock').removeAttr('checked');
        });

        jQuery('.wpdmlock').click(function(){

            if(this.checked) {
            jQuery('#'+jQuery(this).attr('rel')).slideDown();
            jQuery('.nopro').removeAttr('checked');
            } else {
            jQuery('#'+jQuery(this).attr('rel')).slideUp();
            }
        });

       // jQuery( "#pdate" ).datepicker({dateFormat:'yy-mm-dd'});
       // jQuery( "#udate" ).datepicker({dateFormat:'yy-mm-dd'});

        jQuery('#wpdm-pf').submit(function(){
             try {
                var editor = tinymce.get('post_content');
                editor.save();
             }catch(e){}
             jQuery('#psp').removeClass('fa-save').addClass('fa-spinner fa-spin');
             jQuery('#publish').attr('disabled','disabled');
             jQuery('#wpdm-pf').ajaxSubmit({
                 //dataType: 'json',
                 beforeSubmit: function() { jQuery('#sving').fadeIn(); },
                 success: function(res) {  jQuery('#sving').fadeOut(); jQuery('#nxt').slideDown();
                     jQuery(".panel-file.panel-danger").remove();
                     if(res.result=='_ap_wpdm') {
                         <?php
                         $edit_url = $burl . '/edit-package/%d/';
                         if((isset($params['flaturl']) && $params['flaturl'] == 0) || !get_option('permalink_structure'))
                             $edit_url = $burl.$sap.'adb_page=edit-package/%d/'; ?>
                         var edit_url = '<?php echo $edit_url; ?>';
                         edit_url = edit_url.replace('%d', res.id);
                         location.href = edit_url;
                         jQuery('#wpdm-pf').prepend('<div class="alert alert-success" data-dismiss="alert"><?php _e("Package Created Successfully. Opening Edit Window ...", "wpdmpro"); ?></div>');
                     }
                     else {
                         jQuery('#psp').removeClass('fa-spinner fa-spin').addClass('fa-save');
                         jQuery('#publish').removeAttr('disabled');
                         jQuery('#wpdm-pf').prepend('<div class="alert alert-success" data-dismiss="alert"><?php _e("Package Updated Successfully", "wpdmpro"); ?></div>');
                     }
                 }


             });
             return false;
        });




          allps = jQuery('#pps_z').val();
          if(allps == undefined) allps = '';
          jQuery('#ps').val(allps.replace(/\]\[/g,"\n").replace(/[\]|\[]+/g,''));
          shuffle = function(){
              var sl = 'abcdefghijklmnopqrstuvwxyz';
              var cl = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
              var nm = '0123456789';
              var sc = '~!@#$%^&*()_';
              ps = "";
              pss = "";
              if(jQuery('#ls').attr('checked')=='checked') ps = sl;
              if(jQuery('#lc').attr('checked')=='checked') ps += cl;
              if(jQuery('#nm').attr('checked')=='checked') ps += nm;
              if(jQuery('#sc').attr('checked')=='checked') ps +=sc;
              var i=0;
              while ( i <= ps.length ) {
                  $max = ps.length-1;
                  $num = Math.floor(Math.random()*$max);
                  $temp = ps.substr($num, 1);
                  pss += $temp;
                  i++;
              }

              jQuery('#ps').val(pss);


          };
          jQuery('#gps').click(shuffle);

          jQuery('body').on('click', '#gpsc', function(){
              var allps = "";
              shuffle();
              for(k=0;k<jQuery('#pcnt').val();k++){
                  allps += "["+randomPassword(pss,jQuery('#ncp').val())+"]";

              }
              vallps = allps.replace(/\]\[/g,"\n").replace(/[\]|\[]+/g,'');
              jQuery('#ps').val(vallps);

          });

          jQuery('body').on('click', '#pins', function(){
              var aps;
              aps = jQuery('#ps').val();
              aps = aps.replace(/\n/g, "][");
              allps = "["+aps+"]";
              jQuery(jQuery(this).data('target')).val(allps);
              tb_remove();
          });






      });

      jQuery('#upload-main-preview').click(function() {
            tb_show('', '<?php echo admin_url('media-upload.php?type=image&TB_iframe=1&width=640&height=551'); ?>');
            window.send_to_editor = function(html) {
              var imgurl = jQuery('img',html).attr('src');
              jQuery('#img').html("<img src='"+imgurl+"' style='max-width:100%'/><input type='hidden' name='file[preview]' value='"+imgurl+"' >");
              tb_remove();
              };
            return false;
        });


      function randomPassword(chars, size) {

          //var size = 10;
          if(parseInt(size)==Number.NaN || size == "") size = 8;
          var i = 1;
          var ret = "";
          while ( i <= size ) {
              $max = chars.length-1;
              $num = Math.floor(Math.random()*$max);
              $temp = chars.substr($num, 1);
              ret += $temp;
              i++;
          }
          return ret;
      }



      </script>

</div>