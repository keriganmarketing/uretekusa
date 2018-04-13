<?php
/**
 * User: shahnuralam
 * Date: 10/22/17
 * Time: 2:41 AM
 */
$res = $wpdb->get_results("select * from {$wpdb->prefix}ahm_social_conns where source = 'google' order by {$field} {$ord} limit $start, $limit",ARRAY_A);
$total = $wpdb->get_var("select count(*) as t from {$wpdb->prefix}ahm_social_conns");
?>
<form method="post" action="edit.php?post_type=wpdmpro&page=wpdm-subscribers&task=delete&lockOption=google" id="posts-filter" class="panel-body">


    <div class="clear"></div>


    <table id="subtbl" cellspacing="0" class="table table-striped">
        <thead>
        <tr>
            <th style="width: 50px" class="manage-column column-cb check-column text-center" id="cb" scope="col"><input type="checkbox"></th>
            <th style="" class="manage-column column-media" id="email" scope="col"><?php echo __('Email','wpdmpro'); ?></th>
            <th style="" class="manage-column column-media" id="email" scope="col"><?php echo __('Name','wpdmpro'); ?></th>
            <th style="" class="manage-column column-media" id="filename" scope="col"><?php echo __('Package Name','wpdmpro'); ?></th>
            <th style="" class="manage-column column-password" id="author" scope="col"><?php echo __('Date','wpdmpro'); ?></th>
            <th style="width: 100px" class="manage-column column-password" id="author" scope="col" ><?php echo __('Action','wpdmpro'); ?></th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th style="" class="manage-column column-cb check-column text-center" id="cb" scope="col"><input type="checkbox"></th>
            <th style="" class="manage-column column-media" id="email" scope="col"><?php echo __('Email','wpdmpro'); ?></th>
            <th style="" class="manage-column column-media" id="email" scope="col"><?php echo __('Name','wpdmpro'); ?></th>
            <th style="" class="manage-column column-media" id="filename" scope="col"><?php echo __('Package Name','wpdmpro'); ?></th>
            <th style="" class="manage-column column-password" id="author" scope="col"><?php echo __('Date','wpdmpro'); ?></th>
            <th style="" class="manage-column column-password" id="author" scope="col"><?php echo __('Action','wpdmpro'); ?></th>
        </tr>
        </tfoot>

        <tbody class="list:post" id="the-list">
        <?php foreach($res as $row) {

            ?>
            <tr valign="top" class="author-self status-inherit" id="post-<?php echo $row['id']; ?>">

                <th class="check-column text-center" style="padding: 5px 0px !important;" scope="row"><input type="checkbox" value="<?php echo $row['ID']; ?>" name="id[]"></th>
                <td scope="row"><?php echo $row['email']; ?></td>
                <td scope="row"><?php echo $row['name']; ?>
                </td>

                <td class="media column-media">
                    <a href='edit.php?post_type=wpdmpro&page=wpdm-subscribers&pid=<?php echo $row['pid']; ?>'><?php $p =  get_post($row['pid']); if(is_object($p) && $p->post_type =='wpdmpro') echo $p->post_title; else echo "Not Found or Deleted"; ?></a>
                </td>
                <td class="author column-author"><?php echo date("Y-m-d H:i",$row['timestamp']); ?></td>
                <td class="author column-author">
                    <?php
                    if ($row['processed']==0) echo "<a href='' class='btn btn-xs btn-default'>Export Contacts</a>";
                    if ($row['processed']==1) echo "<button type='button' disabled='disabled' class='btn btn-xs btn-success'>Exported</button>";
                    if ($row['processed']==2) echo "<button type='button' disabled='disabled' class='btn btn-xs btn-warning'>NA</button>";
                    ?>
                </td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php
    $cp = $_GET['paged']?(int)$_GET['paged']:1;
    $page_links = paginate_links( array(
        'base' => add_query_arg( 'paged', '%#%' ),
        'format' => '',
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'total' => ceil($total/$limit),
        'current' => $cp
    ));


    ?>

    <div class="well">
        <nobr>
            <input type="submit" class="btn btn-default btn-sm action submitdelete" id="doaction" value="<?php echo __('Delete Selected','wpdmpro'); ?>">
            <?php if(isset($_REQUEST['q'])) { ?>
                <input type="button" class="button-secondary action" onclick="location.href='admin.php?page=file-manager'" value="<?php echo __('Reset Search','wpdmpro'); ?>">
            <?php } ?>
        </nobr>
        <div class="pull-right">

            <?php  if ( $page_links ) { ?>
                <div class="tablenav-pages"><?php $page_links_text = sprintf( '<span class="displaying-num">' . __( 'Displaying %s&#8211;%s of %s' ) . '</span>%s',
                        number_format_i18n( ( $_GET['paged'] - 1 ) * $limit + 1 ),
                        number_format_i18n( min( $_GET['paged'] * $limit, $total ) ),
                        number_format_i18n( $total ),
                        $page_links
                    ); echo $page_links_text; ?></div>
            <?php }  ?>

        </div><div style="clear: both"></div>
    </div>




</form>
