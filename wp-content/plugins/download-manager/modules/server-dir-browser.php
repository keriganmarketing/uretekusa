<?php
function wpdm_odir_tree(){
    if(!isset($_GET['task'])||$_GET['task']!='wpdm_odir_tree') return;
    if(!current_user_can('access_server_browser')) { echo "<ul><li>".__('Not Allowed!','wpdmpro')."</li></ul>"; die(); }
    $_POST['dir'] = isset($_POST['dir'])?urldecode($_POST['dir']):'';
    $root = '';
    if( file_exists($root . $_POST['dir']) ) {
        $files = scandir($root . $_POST['dir']);
        natcasesort($files);
        if( count($files) > 2 ) { /* The 2 accounts for . and .. */
            echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
            // All dirs
            foreach( $files as $file ) {
                if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($root . $_POST['dir'] . $file) ) {
                    echo "<li class=\"directory collapsed\"><a onclick=\"odirpath(this)\" class=\"odir\" href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
                }
            }
            echo "</ul>";
        }
    }
    die();
}

function wpdm_odir_grid(){
    if(!isset($_GET['task'])||$_GET['task']!='wpdm_odir_grid') return;
    if(!current_user_can('access_server_browser')) { echo "<ul><li>".__('Not Allowed!','wpdmpro')."</li></ul>"; die(); }
    $_REQUEST['dir'] = isset($_REQUEST['dir'])?urldecode($_REQUEST['dir']):'';
    $root = '';
    $_REQUEST['dir'] = rtrim($_REQUEST['dir'],'/').'/';
    //$_REQUEST['dir'] = realpath($_REQUEST['dir']);
    //echo $_REQUEST['dir'];
    if( file_exists($root . $_REQUEST['dir']) ) {
	    $files = scandir($root . $_REQUEST['dir']);
	    natcasesort($files);
	    if( count($files) > 2 ) { /* The 2 accounts for . and .. */
		    // All dirs
		    foreach( $files as $file ) {
			    if( $file != '.' && $file != '..' && is_dir($root . $_REQUEST['dir'] . $file) ) {
				    echo "<div class=\"col-md-4\"><a class='dir' onclick=\"explore('".$root . $_REQUEST['dir'] . $file."', this)\" class=\"odir\" href=\"#\" rel=\"" . htmlentities($_REQUEST['dir'] . $file) . "/\"><i class=\"fa fa-folder-open\"></i> &nbsp;" . htmlentities($file) . "</a></div>";
			    }
		    }
	    }
    }
    die();
}

function wpdm_dir_browser(){
    if(!isset($_GET['task'])||$_GET['task']!='wpdm_dir_browser') return;
    if(!current_user_can('access_server_browser')) { echo "<ul><li>".__('Not Allowed!','wpdmpro')."</li></ul>"; die(); }
        $root = get_option('_wpdm_file_browser_root',$_SERVER['DOCUMENT_ROOT']);
        $dirs = \WPDM\FileSystem::subDirs($root);
        ?>

        <style>

         .dirs .col-md-4{

         }

         .dirs .dir{
         border-radius: 3px;
         margin-bottom: 15px;
         margin-top: 15px;
         display: block;
             font-size: 11px;
             text-decoration: none;
             color: #444;
             font-family: 'Courier', monospace;
         }
         #dpath, #routs, #routs a{ font-family: 'Courier', monospace; }
        .dirs .fa{
            color: #00A99D;
        }
         .dirs .dir:hover{ text-decoration: none; }
            .dirs .col-md-4{
                border: 1px solid #eee;
                margin-left: -1px;
                margin-top: -1px;
            }
            #TB_ajaxContent{ min-width: calc(100% - 30px); height:100% !important; }
</style>
        <div class='w3eden'>
        <div class='row dirs'>
        <div class="col-md-12 selc"><br/>
            <div class="input-group"><input type="text" id="dpath" class="form-control">
                <div class="input-group-btn">
                    <button type="button" id="slctdir" class="btn btn-default">Insert</button>
                </div>
            </div>
            <br/>
            <div class="breadcrumb" id="routs" style="margin: 0 0 15px 0"><a href="#" onclick="return explore('<?php echo $root; ?>')">root$</a> / </div>
        </div>
        </div>
        <div class="dirs" style="padding: 15px">
        <div class="row" id="dirs-body">
        <?php
        foreach ($dirs as $dir) {
            $dirname = trim($dir, '/');
            $dirname = explode('/', $dirname);
            $dirname = end($dirname);
            ?>

            <div class="col-md-4">
            <a class="dir" href="#" onclick="return explore('<?php echo $dir; ?>', this)">
                <i class="fa fa-folder-open"></i> &nbsp;<?php echo $dirname; ?>
            </a>
            </div>

            <?php
        } ?>
    </div></div></div>
    <script>

            function explore(dir, a) {
                jQuery(a).find('.fa-folder-open').removeClass('fa-folder-open').addClass('fa-spin fa-spinner');
                dir = dir.replace(/\/+$/,'');
                jQuery('#dpath').val(dir);
                jQuery('#dirs-body').load('admin.php?task=wpdm_odir_grid&dir='+dir);
                var root = '<?php echo $root; ?>';
                var dirp = dir.replace(root, '');
                dirp = dirp.split('/');
                var path = '', proot = root.replace(/\/+$/,'');
                jQuery.each(dirp, function (i, d) {
                   var  name = d == ''?'root$ ':d;
                    path += "<a href='#' onclick=\"return explore('"+proot+'/'+d+"')\">"+name+"</a>/";
                    if(d != '')
                    proot = proot+'/'+d;

                });
                jQuery('#routs').html(path);
                return false;
            }

            jQuery('#slctdir').click(function(){
                jQuery('#srvdir').val(jQuery('#dpath').val());
                tb_remove();
            });

    </script>
    <?php
    die();
}

function wpmp_dir_browser_metabox($post){
    ?>
    <div class="w3eden"><div class="input-group">
    <input class="form-control" type="text" id="srvdir" value="<?php echo get_post_meta($post->ID,'__wpdm_package_dir', true); ?>" name="file[package_dir]" />
            <div class="input-group-btn">
    <a href="admin.php?page=file-manager&task=wpdm_dir_browser" title="Server File Browser" class="thickbox btn btn-default"><i class="fa fa-folder-open"></i></a>
    </div>
</div> </div>



    <?php
}

function wpdm_get_files($dir, $recur = true){
    $dir = rtrim($dir,"/")."/";
    if($dir == '/' || $dir == '') return array();
    if(!is_dir($dir)) return array();
    $tmpfiles = file_exists($dir)?array_diff( scandir( $dir ), Array( ".", ".." ) ):array();
    $files = array();
    foreach($tmpfiles as $file){
        if( is_dir($dir.$file) && $recur == true) $files = array_merge($files,wpdm_get_files($dir.$file, true));
        else
        $files[\WPDM_Crypt::Encrypt($dir.$file)] = $dir.$file;
    }
    return $files;

}

function wpdm_fetch_dir(){
    if($_REQUEST['task']!='wpdm_fetch_dir') return;
    if(!current_user_can('access_server_browser')) return "<ul><li>".__('Not Allowed!','wpdmpro')."</li></ul>";
    if($_REQUEST['dir']=='')
    $dir = get_wpdm_meta((int)$_REQUEST['fid'],'package_dir');
    else
    $dir = $_REQUEST['dir'];
    $files = scandir($dir);
    array_shift($files);
    array_shift($files);
    ?>
    <thead>
    <tr>
    <th style="width: 50px;">Action</th>
    <th>Filename</th>
    <th>Title</th>
    <th style="width: 130px;">Password</th>
    </tr>
    </thead>
    <?php
    foreach($files as $file_index=>$file){
        if(!is_dir($dir.$file)){
        ?>
        <tr  class="cfile">
        <td>
        <input class="fa" type="hidden" value="<?php echo $file; ?>" name="files[]">
        <img align="left" rel="del" src="<?php echo plugins_url('download-manager/images/minus.png'); ?>">
        </td>
        <td><?php echo $dir.$file; ?></td>
        <td><input style="width:99%" type="text" name='wpdm_meta[fileinfo][<?php echo $dir.$file; ?>][title]' value="<?php echo $fileinfo[$dir.$file]['title'];?>"></td>
        <td><input size="10" type="text" id="indpass_<?php echo $file_index;?>" name='wpdm_meta[fileinfo][<?php echo $dir.$file; ?>][password]' value="<?php echo $fileinfo[$dir.$file]['password'];?>"> <img style="cursor: pointer;float: right;margin-top: -3px" class="genpass"  title='Generate Password' onclick="return generatepass('indpass_<?php echo $file_index;?>')" src="<?php echo plugins_url('download-manager/images/generate-pass.png'); ?>" alt="" /></td>
        </tr>
        <?php
    }}
    die();
}

if(is_admin()){

    add_action("init","wpdm_dir_browser");
    add_action("init","wpdm_odir_grid");
    add_action("init","wpdm_odir_tree");
    //add_action("init","wpdm_fetch_dir");
    add_action("add_new_file_sidebar","wpmp_dir_browser_metabox");
}
