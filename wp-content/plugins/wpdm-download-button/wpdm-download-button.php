<?php
/*
Plugin Name: WPDM - Image Button
Description: Use the add-on to replace download link label with a nice button image
Plugin URI: http://www.wpdownloadmanager.com/
Author: Shaon
Version: 2.4.1
Author URI: http://www.wpdownloadmanager.com/
*/

if (defined('WPDM_Version')) {


    function wpdm_download_buttons()
    {
        global $current_user, $wpdb;
        if ((isset($_POST['wpdm_dlbtn']) || isset($_POST['wpdm_dlbtn_lt'])) && is_admin()) {
            update_option('wpdm_dlbtn', $_POST['wpdm_dlbtn']);
            update_option('wpdm_dlbtn_lt', $_POST['wpdm_dlbtn_lt']);
            _e('Saved Successfully!');
            die();
        }
        $data = scandir(dirname(__FILE__) . '/images/');
        array_shift($data);
        array_shift($data);
        ?>


        <div class="panel panel-default">
            <div class="panel-heading"><strong>Image Buton</strong></div>

            <input name='wpdm_dlbtn_lt' type="hidden" value=""/>
            <input name='wpdm_dlbtn' type="hidden" value=""/>
            <table id="allbtns" class="table table-striped">
                <thead>
                <tr>
                    <th style="max-width: 250px">Button</th>
                    <th>Link Template</th>
                    <th>Details Page</th>
                </tr>
                </thead>
                <tbody>
                <?php $zc = 0;
                foreach ($data as $btn) {
                    if ($btn == get_option('wpdm_dlbtn')) $class = 'activeb'; else $class = '';
                    $btnx = explode(".", $btn);
                    $btnx = end($btnx);
                    if (in_array($btnx, array('jpg', 'jpeg', 'gif', 'png')))
                        echo "<tr><td  style='max-width: 250px'><img style='max-width:95%;max-height: 70px' src='" . plugins_url('wpdm-download-button/images/' . $btn) . "' /></td><td><input  name='wpdm_dlbtn_lt' type='radio' " . (get_option('wpdm_dlbtn_lt') == $btn ? 'checked=checked' : '') . " value='$btn' id='blt" . (++$zc) . "' /></td><td><input name='wpdm_dlbtn' " . (get_option('wpdm_dlbtn') == $btn ? 'checked=checked' : '') . " type='radio' value='$btn' id='b" . (++$zc) . "' /></td></tr>";
                } ?>

                <tr>
                    <th colspan="3"><b>Bootstrap Buttons ( CSS )</b>
                    </td></tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-default">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-default' ? 'checked=checked' : ''); ?>
                               value='bs-default' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-default' ? 'checked=checked' : ''); ?>
                            value='bs-default' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-secondary">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-secondary' ? 'checked=checked' : ''); ?>
                               value='bs-secondary' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-secondary' ? 'checked=checked' : ''); ?>
                            value='bs-secondary' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-primary">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-primary' ? 'checked=checked' : ''); ?>
                               value='bs-primary' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-primary' ? 'checked=checked' : ''); ?>
                            value='bs-primary' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-inverse">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-inverse' ? 'checked=checked' : ''); ?>
                               value='bs-inverse' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-inverse' ? 'checked=checked' : ''); ?>
                            value='bs-inverse' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-info">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-info' ? 'checked=checked' : ''); ?>
                               value='bs-info' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-info' ? 'checked=checked' : ''); ?>
                            value='bs-info' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-warning">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-warning' ? 'checked=checked' : ''); ?>
                               value='bs-warning' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-warning' ? 'checked=checked' : ''); ?>
                            value='bs-warning' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-success">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-success' ? 'checked=checked' : ''); ?>
                               value='bs-success' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-success' ? 'checked=checked' : ''); ?>
                            value='bs-success' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-danger">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-danger' ? 'checked=checked' : ''); ?>
                               value='bs-danger' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-danger' ? 'checked=checked' : ''); ?>
                            value='bs-danger' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td colspan="3" style="font-weight: bold">
                        Large Buttons
                    </td>
                </tr>

                <tr>
                    <td>
                        <button type="button" class="btn btn-default btn-lg">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-default-lg' ? 'checked=checked' : ''); ?>
                               value='bs-default-lg' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-default-lg' ? 'checked=checked' : ''); ?>
                            value='bs-default-lg' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-secondary btn-lg">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-secondary-lg' ? 'checked=checked' : ''); ?>
                               value='bs-secondary-lg' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-secondary-lg' ? 'checked=checked' : ''); ?>
                            value='bs-secondary-lg' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>

                <tr>
                    <td>
                        <button type="button" class="btn btn-primary btn-lg">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-primary-lg' ? 'checked=checked' : ''); ?>
                               value='bs-primary-lg' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-primary-lg' ? 'checked=checked' : ''); ?>
                            value='bs-primary-lg' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-info btn-lg">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-info-lg' ? 'checked=checked' : ''); ?>
                               value='bs-info-lg' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-info-lg' ? 'checked=checked' : ''); ?>
                            value='bs-info-lg' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-warning btn-lg">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-warning-lg' ? 'checked=checked' : ''); ?>
                               value='bs-warning-lg' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-warning-lg' ? 'checked=checked' : ''); ?>
                            value='bs-warning-lg' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-success btn-lg">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-success-lg' ? 'checked=checked' : ''); ?>
                               value='bs-success-lg' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-success-lg' ? 'checked=checked' : ''); ?>
                            value='bs-success-lg' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-danger btn-lg">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-danger-lg' ? 'checked=checked' : ''); ?>
                               value='bs-danger-lg' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-danger-lg' ? 'checked=checked' : ''); ?>
                            value='bs-danger-lg' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-inverse btn-lg">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-inverse-lg' ? 'checked=checked' : ''); ?>
                               value='bs-inverse-lg' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-inverse-lg' ? 'checked=checked' : ''); ?>
                            value='bs-inverse-lg' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>

                <tr>
                    <td colspan="3" style="font-weight: bold">
                        Small Buttons
                    </td>
                </tr>

                <tr>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-primary-sm' ? 'checked=checked' : ''); ?>
                               value='bs-primary-sm' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-primary-sm' ? 'checked=checked' : ''); ?>
                            value='bs-primary-sm' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-info btn-sm">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-info-sm' ? 'checked=checked' : ''); ?>
                               value='bs-info-sm' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-info-sm' ? 'checked=checked' : ''); ?>
                            value='bs-info-sm' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-warning-sm' ? 'checked=checked' : ''); ?>
                               value='bs-warning-sm' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-warning-sm' ? 'checked=checked' : ''); ?>
                            value='bs-warning-sm' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-success btn-sm">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-success-sm' ? 'checked=checked' : ''); ?>
                               value='bs-success-sm' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-success-sm' ? 'checked=checked' : ''); ?>
                            value='bs-success-sm' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-danger-sm' ? 'checked=checked' : ''); ?>
                               value='bs-danger-sm' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-danger-sm' ? 'checked=checked' : ''); ?>
                            value='bs-danger-sm' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-inverse btn-sm">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-inverse-sm' ? 'checked=checked' : ''); ?>
                               value='bs-inverse-sm' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-inverse-sm' ? 'checked=checked' : ''); ?>
                            value='bs-inverse-sm' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>


                <tr>
                    <td><a href="#">Link Label</a></td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'linkonly' ? 'checked=checked' : ''); ?>
                               value='linkonly' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'linkonly' ? 'checked=checked' : ''); ?>
                            type='radio' value='linkonly' id='b<?php echo(++$zc); ?>'/></td>
                </tr>

                <tr>
                    <td colspan="3" style="font-weight: bold">
                        Very Small Buttons
                    </td>
                </tr>

                <tr>
                    <td>
                        <button type="button" class="btn btn-default btn-xs">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-default-xs' ? 'checked=checked' : ''); ?>
                               value='bs-default-xs' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-default-xs' ? 'checked=checked' : ''); ?>
                            value='bs-default-xs' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-secondary btn-xs">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-secondary-xs' ? 'checked=checked' : ''); ?>
                               value='bs-secondary-xs' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-secondary-xs' ? 'checked=checked' : ''); ?>
                            value='bs-secondary-xs' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>


                <tr>
                    <td>
                        <button type="button" class="btn btn-primary btn-xs">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-primary-xs' ? 'checked=checked' : ''); ?>
                               value='bs-primary-xs' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-primary-xs' ? 'checked=checked' : ''); ?>
                            value='bs-primary-xs' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-info btn-xs">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-info-xs' ? 'checked=checked' : ''); ?>
                               value='bs-info-xs' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-info-xs' ? 'checked=checked' : ''); ?>
                            value='bs-info-xs' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-warning btn-xs">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-warning-xs' ? 'checked=checked' : ''); ?>
                               value='bs-warning-xs' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-warning-xs' ? 'checked=checked' : ''); ?>
                            value='bs-warning-xs' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-success btn-xs">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-success-xs' ? 'checked=checked' : ''); ?>
                               value='bs-success-xs' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-success-xs' ? 'checked=checked' : ''); ?>
                            value='bs-success-xs' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-danger-xs' ? 'checked=checked' : ''); ?>
                               value='bs-danger-xs' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-danger-xs' ? 'checked=checked' : ''); ?>
                            value='bs-danger-xs' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>
                <tr>
                    <td>
                        <button type="button" class="btn btn-inverse btn-xs">Link Label</button>
                    </td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'bs-inverse-xs' ? 'checked=checked' : ''); ?>
                               value='bs-inverse-xs' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'bs-inverse-xs' ? 'checked=checked' : ''); ?>
                            value='bs-inverse-xs' type="radio" id='b<?php echo(++$zc); ?>'/></td>
                </tr>


                <tr>
                    <td><a href="#">Link Label</a></td>
                    <td><input name='wpdm_dlbtn_lt'
                               type='radio' <?php echo(get_option('wpdm_dlbtn_lt') == 'linkonly' ? 'checked=checked' : ''); ?>
                               value='linkonly' id='blt<?php echo(++$zc); ?>'/></td>
                    <td><input
                            name='wpdm_dlbtn' <?php echo(get_option('wpdm_dlbtn') == 'linkonly' ? 'checked=checked' : ''); ?>
                            type='radio' value='linkonly' id='b<?php echo(++$zc); ?>'/></td>
                </tr>

                </tbody>
            </table>


        </div>
        <div class="clear"></div>


        <div class="inside">


            <div id="plupload-upload-ui" class="hide-if-no-js">
                <div id="drag-drop-area">
                    <div class="drag-drop-inside">
                        <p class="drag-drop-info"><?php _e('Drop Button Images here'); ?></p>
                        <p><?php _ex('or', 'Uploader: Drop Button Images here - or - Select Images'); ?></p>
                        <p class="drag-drop-buttons"><input id="plupload-browse-button" type="button"
                                                            value="<?php esc_attr_e('Select Button Image'); ?>"
                                                            class="button"/></p>
                    </div>
                </div>
            </div>

            <?php

            $plupload_init = array(
                'runtimes' => 'html5,silverlight,flash,html4',
                'browse_button' => 'plupload-browse-button',
                'container' => 'plupload-upload-ui',
                'drop_element' => 'drag-drop-area',
                'file_data_name' => 'button-async-upload',
                'multiple_queues' => true,
                'max_file_size' => wp_max_upload_size() . 'b',
                'url' => admin_url('admin-ajax.php'),
                'flash_swf_url' => includes_url('js/plupload/plupload.flash.swf'),
                'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
                'filters' => array(array('title' => __('Allowed Files'), 'extensions' => '*')),
                'multipart' => true,
                'urlstream_upload' => true,

                // additional post data to send to our ajax hook
                'multipart_params' => array(
                    '_ajax_nonce' => wp_create_nonce('button-upload'),
                    'action' => 'button_upload',            // the ajax action name
                ),
            );

            // we should probably not apply this filter, plugins may expect wp's media uploader...
            $plupload_init = apply_filters('plupload_init', $plupload_init); ?>

            <script type="text/javascript">

                jQuery(document).ready(function ($) {

                    // create the uploader and pass the config from above
                    var uploader = new plupload.Uploader(<?php echo json_encode($plupload_init); ?>);

                    // checks if browser supports drag and drop upload, makes some css adjustments if necessary
                    uploader.bind('Init', function (up) {
                        var uploaddiv = jQuery('#plupload-upload-ui');

                        if (up.features.dragdrop) {
                            uploaddiv.addClass('drag-drop');
                            jQuery('#drag-drop-area')
                                .bind('dragover.wp-uploader', function () {
                                    uploaddiv.addClass('drag-over');
                                })
                                .bind('dragleave.wp-uploader, drop.wp-uploader', function () {
                                    uploaddiv.removeClass('drag-over');
                                });

                        } else {
                            uploaddiv.removeClass('drag-drop');
                            jQuery('#drag-drop-area').unbind('.wp-uploader');
                        }
                    });

                    uploader.init();

                    // a file was added in the queue
                    uploader.bind('FilesAdded', function (up, files) {
                        //var hundredmb = 100 * 1024 * 1024, max = parseInt(up.settings.max_file_size, 10);


                        plupload.each(files, function (file) {
                            jQuery('#filelist').append(
                                '<div class="file" id="' + file.id + '"><b>' +

                                file.name + '</b> (<span>' + plupload.formatSize(0) + '</span>/' + plupload.formatSize(file.size) + ') ' +
                                '<div class="progress progress-success progress-striped active"><div class="bar fileprogress"></div></div></div>');
                        });

                        up.refresh();
                        up.start();
                    });

                    uploader.bind('UploadProgress', function (up, file) {

                        jQuery('#' + file.id + " .fileprogress").width(file.percent + "%");
                        jQuery('#' + file.id + " span").html(plupload.formatSize(parseInt(file.size * file.percent / 100)));
                    });


                    // a file was uploaded
                    uploader.bind('FileUploaded', function (up, file, response) {

                        // this is your ajax response, update the DOM with it or something...
                        //console.log(response);
                        //response
                        jQuery('#' + file.id).remove();
                        var d = new Date();
                        var ID = d.getTime();
                        res = response.response;
                        var nm = res;
                        if (response.length > 20) nm = response.substring(0, 7) + '...' + response.substring(response.length - 10);
                        jQuery('#allbtns tbody tr:last-child').after("<tr><td><img src='<?php echo plugins_url('wpdm-download-button/images/'); ?>" + res + "' /></td><td><input  name='wpdm_dlbtn_lt' type='radio'  value='" + res + "'  /></td><td><input name='wpdm_dlbtn' type='radio' value='" + res + "' /></td></tr>");
                        //jQuery('#allbtns').append("<input class='btns' name='wpdm_dlbtn' type='radio' value='"+res+"' id='b"+ID+"' /><label class='btnsl {$class}' for='b"+ID+"'><img height='35px' src='<?php echo plugins_url('wpdm-download-button/images/'); ?>"+res+"' /></label>");


                    });

                });

            </script>
            <div id="filelist"></div>

            <div class="clear"></div>
        </div>


        <div class="clear"></div>

        <br><br>
        <input name='wpdm_dlbtn' type='radio' value=''/> No Image
        <div style="clear: both;"></div>
        <script language="JavaScript">
            <!--
            jQuery('.btnsl').live('click', function () {
                jQuery('.btnsl').removeClass('activeb');
                jQuery(this).addClass('activeb');
            });
            //-->
        </script>

        <?php
    }


    function wpdm_custom_download_button($package, $template = '')
    {
        $bsbtns = array(
            'bs-default' => 'btn btn-default',
            'bs-secondary' => 'btn btn-secondary',
            'bs-primary' => 'btn btn-primary',
            'bs-info' => 'btn btn-info',
            'bs-warning' => 'btn btn-warning',
            'bs-success' => 'btn btn-success',
            'bs-danger' => 'btn btn-danger',
            'bs-inverse' => 'btn btn-inverse',
            'bs-default-lg' => 'btn btn-default btn-lg',
            'bs-secondary-lg' => 'btn btn-secondary btn-lg',
            'bs-primary-lg' => 'btn btn-primary btn-lg',
            'bs-info-lg' => 'btn btn-info btn-lg',
            'bs-warning-lg' => 'btn btn-warning btn-lg',
            'bs-success-lg' => 'btn btn-success btn-lg',
            'bs-danger-lg' => 'btn btn-danger btn-lg',
            'bs-inverse-lg' => 'btn btn-inverse btn-lg',
            'bs-default-sm' => 'btn btn-default btn-sm',
            'bs-secondary-sm' => 'btn btn-secondary btn-sm',
            'bs-primary-sm' => 'btn btn-primary btn-sm',
            'bs-info-sm' => 'btn btn-info btn-sm',
            'bs-warning-sm' => 'btn btn-warning btn-sm',
            'bs-success-sm' => 'btn btn-success btn-sm',
            'bs-danger-sm' => 'btn btn-danger btn-sm',
            'bs-inverse-sm' => 'btn btn-inverse btn-sm',
            'bs-default-xs' => 'btn btn-default btn-xs',
            'bs-secondary-xs' => 'btn btn-secondary btn-xs',
            'bs-primary-xs' => 'btn btn-primary btn-xs',
            'bs-info-xs' => 'btn btn-info btn-xs',
            'bs-warning-xs' => 'btn btn-warning btn-xs',
            'bs-success-xs' => 'btn btn-success btn-xs',
            'bs-danger-xs' => 'btn btn-danger btn-xs',
            'bs-inverse-xs' => 'btn btn-inverse btn-xs',
            'linkonly' => ''
        );

        if (is_single() && get_post_type() == 'wpdmpro' && $package['ID'] == get_the_ID())
            $img = get_option('wpdm_dlbtn');
        else
            $img = get_option('wpdm_dlbtn_lt');
        if ($img == '') return $package;

        if (in_array($img, array_keys($bsbtns))) {
            $package['download_link'] = str_replace("[btnclass]", $bsbtns[$img], $package['download_link']);
            if(isset($package['download_link_extended']))
                $package['download_link_extended'] = str_replace("[btnclass]", $bsbtns[$img], $package['download_link_extended']);
            if(isset($package['download_link_popup']))
                $package['download_link_popup'] = str_replace("[btnclass]", $bsbtns[$img], $package['download_link_popup']);
        }

        return $package;
    }

    function wpdm_apply_image_button($label, $package)
    {

        if (strpos($label, "img src")) return $label;

        $bsbtns = array(
            'bs-default' => 'btn btn-default',
            'bs-secondary' => 'btn btn-secondary',
            'bs-primary' => 'btn btn-primary',
            'bs-info' => 'btn btn-info',
            'bs-warning' => 'btn btn-warning',
            'bs-success' => 'btn btn-success',
            'bs-danger' => 'btn btn-danger',
            'bs-inverse' => 'btn btn-inverse',
            'bs-default-lg' => 'btn btn-default btn-lg',
            'bs-secondary-lg' => 'btn btn-secondary btn-lg',
            'bs-primary-lg' => 'btn btn-primary btn-lg',
            'bs-info-lg' => 'btn btn-info btn-lg',
            'bs-warning-lg' => 'btn btn-warning btn-lg',
            'bs-success-lg' => 'btn btn-success btn-lg',
            'bs-danger-lg' => 'btn btn-danger btn-lg',
            'bs-inverse-lg' => 'btn btn-inverse btn-lg',
            'bs-default-sm' => 'btn btn-default btn-sm',
            'bs-secondary-sm' => 'btn btn-secondary btn-sm',
            'bs-primary-sm' => 'btn btn-primary btn-sm',
            'bs-info-sm' => 'btn btn-info btn-sm',
            'bs-warning-sm' => 'btn btn-warning btn-sm',
            'bs-success-sm' => 'btn btn-success btn-sm',
            'bs-danger-sm' => 'btn btn-danger btn-sm',
            'bs-inverse-sm' => 'btn btn-inverse btn-sm',
            'bs-default-xs' => 'btn btn-default btn-xs',
            'bs-secondary-xs' => 'btn btn-secondary btn-xs',
            'bs-primary-xs' => 'btn btn-primary btn-xs',
            'bs-info-xs' => 'btn btn-info btn-xs',
            'bs-warning-xs' => 'btn btn-warning btn-xs',
            'bs-success-xs' => 'btn btn-success btn-xs',
            'bs-danger-xs' => 'btn btn-danger btn-xs',
            'bs-inverse-xs' => 'btn btn-inverse btn-xs',
            'linkonly' => ''
        );

        if (is_single() && get_post_type() == 'wpdmpro' && $package['ID'] == get_the_ID())
            $img = get_option('wpdm_dlbtn');
        else
            $img = get_option('wpdm_dlbtn_lt');

        if (in_array($img, array_keys($bsbtns))) return $label;

        $imgrl = plugins_url('wpdm-download-button/images/' . $img);
        $ilabel = strip_tags($label);
        return $img ? "<img src=\"{$imgrl}\" alt=\"{$ilabel}\" />" : $label;
    }

    function wpdm_db_scripts()
    {
        wp_enqueue_script('plupload-all');
        wp_enqueue_style('plupload-all');
    }

    function wpdm_button_upload()
    {
        $tmpdata = explode(".", $_FILES['button-async-upload']['name']);
        $img = uniqid() . '.' . end($tmpdata);
        $imgext = explode(".", $img);
        $imgext = end($imgext);
        $imgext = strtolower($imgext);
        if (in_array($imgext, array("jpg", "jpeg", "png")) && current_user_can("manage_options"))
            move_uploaded_file($_FILES['button-async-upload']['tmp_name'], dirname(__FILE__) . '/images/' . $img);
        echo $img;
        die();
    }

    function wpdm_download_button_settings_tab($tabs)
    {

        $tabs['download-button'] = wpdm_create_settings_tab('download-button', 'Image Button', 'wpdm_download_buttons');
        return $tabs;

    }

    add_action('wpdm_button_image', 'wpdm_apply_image_button', 10, 2);
    add_action('wp_ajax_button_upload', 'wpdm_button_upload');
    add_action('admin_enqueue_scripts', 'wpdm_db_scripts');
    add_filter('wpdm_after_prepare_package_data', 'wpdm_custom_download_button', 999999);
    add_filter('wdm_before_fetch_template','wpdm_custom_download_button', 9999999, 2);
    add_filter('add_wpdm_settings_tab', 'wpdm_download_button_settings_tab');
}

