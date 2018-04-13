<?php
/**
 * User: shahnuralam
 * Date: 11/9/15
 * Time: 7:30 PM
 */

namespace WPDM\admin\menus;


class Categories
{

    function __construct(){
        add_action( 'wpdmcategory_add_form_fields', array($this,'MetaFields'), 10, 2 );
        add_action( 'wpdmcategory_edit_form_fields', array($this,'MetaFieldsEdit'), 10, 2 );

        add_action( 'edited_wpdmcategory', array($this,'SaveMetaData'), 10, 2 );
        add_action( 'create_wpdmcategory', array($this,'SaveMetaData'), 10, 2 );

        add_action( 'admin_init', array($this,'AdminInit') );


    }

    function AdminInit(){
        add_filter("manage_edit-wpdmcategory_columns", array($this,'CategoryIDColumnHead'));
        add_filter("manage_wpdmcategory_custom_column", array($this,'CategoryIDColumnData'), 10, 3);
    }


    function CategoryIDColumnHead($columns) {
        $columns['tag_ID'] = 'ID<style>#tag_ID, .tag_ID{ width: 70px !important; }</style>';
        return $columns;
    }

    function CategoryIDColumnData($c, $column_name, $term_id) {

        if ($column_name == 'tag_ID') {
            echo $term_id;
        }
    }

    function MetaFields() {
        ?>
        <div class="form-field">
            <label><?php _e( 'Category Image:', 'wpdmcategory' ); ?></label>
            <div class="button-group">
            <input type="text" id="catimurl" placeholder="<?php _e('Image URL','wpdmpro'); ?>" class="button" style="background: #ffffff" name="__wpdmcategory[icon]" value=""> <button data-uploader_button_text="Insert" data-uploader_title="Select Category Image" id="catim" type="button" class="button button-secondary">Insert From Media Library</button>
            </div>
            <script type="text/javascript">

                jQuery(document).ready(function() {

                    var file_frame;

                    jQuery('body').on('click', '#catim', function( event ){

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if ( file_frame ) {
                            file_frame.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame = wp.media.frames.file_frame = wp.media({
                            title: jQuery( this ).data( 'uploader_title' ),
                            button: {
                                text: jQuery( this ).data( 'uploader_button_text' )
                            },
                            multiple: false  // Set to true to allow multiple files to be selected
                        });

                        // When an image is selected, run a callback.
                        file_frame.on( 'select', function() {
                            // We set multiple to false so only get one image from the uploader
                            attachment = file_frame.state().get('selection').first().toJSON();
                            var imgurl = attachment.url;
                            jQuery('#catimurl').val(imgurl);

                        });

                        // Finally, open the modal
                        file_frame.open();
                        return false;
                    });





                    jQuery('.del_adp').click(function(){
                        if(confirm('Are you sure?')){
                            jQuery('#'+jQuery(this).attr('rel')).fadeOut().remove();
                        }

                    });

                });

            </script>
        </div>
        <div class="form-field">
            <label><?php _e( 'Access:', 'wpdmcategory' ); ?></label>
            <p class="description"><?php _e( 'Select the roles who should have access to the packages under this category','wpdmpro' ); ?></p>


            <label><input name="__wpdmcategory[access][]" type="checkbox" value="guest"> <?php echo __("All Visitors","wpdmpro"); ?></label>
            <?php
            global $wp_roles;
            $roles = array_reverse($wp_roles->role_names);
            foreach( $roles as $role => $name ) {





                ?>
                <label><input name="__wpdmcategory[access][]" type="checkbox" value="<?php echo $role; ?>"  > <?php echo $name; ?></label>
            <?php } ?>


        </div>

        <?php
    }

    function MetaFieldsEdit() {
        $MetaData = get_option( "__wpdmcategory" );
        $MetaData = maybe_unserialize($MetaData);
        ?>
        <tr class="form-field">
            <th><?php _e( 'Category Image:', 'wpdmcategory' ); ?></th>
            <td class="button-group">
                <input type="text" id="catimurl" placeholder="<?php _e('Image URL','wpdmpro'); ?>" class="button" style="background: #ffffff" name="__wpdmcategory[icon]" value="<?php echo isset($MetaData[$_GET['tag_ID']]['icon'])?$MetaData[$_GET['tag_ID']]['icon']:''; ?>"> <button data-uploader_button_text="Insert" data-uploader_title="Select Category Image" id="catim" type="button" class="button button-secondary">Insert From Media Library</button>

            <script type="text/javascript">

                jQuery(document).ready(function() {

                    var file_frame;

                    jQuery('body').on('click', '#catim', function( event ){

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if ( file_frame ) {
                            file_frame.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame = wp.media.frames.file_frame = wp.media({
                            title: jQuery( this ).data( 'uploader_title' ),
                            button: {
                                text: jQuery( this ).data( 'uploader_button_text' )
                            },
                            multiple: false  // Set to true to allow multiple files to be selected
                        });

                        // When an image is selected, run a callback.
                        file_frame.on( 'select', function() {
                            // We set multiple to false so only get one image from the uploader
                            attachment = file_frame.state().get('selection').first().toJSON();
                            var imgurl = attachment.url;
                            jQuery('#catimurl').val(imgurl);

                        });

                        // Finally, open the modal
                        file_frame.open();
                        return false;
                    });





                    jQuery('.del_adp').click(function(){
                        if(confirm('Are you sure?')){
                            jQuery('#'+jQuery(this).attr('rel')).fadeOut().remove();
                        }

                    });

                });

            </script>
            </td>
        </tr>
        <tr class="form-field">
            <th><label><?php _e( 'Access:', 'wpdmcategory' ); ?></label>
            </th>
            <td>
                <p class="description"><?php _e( 'Select the roles who should have access to the packages under this category','wpdmpro' ); ?></p>
                <ul>
                    <input name="__wpdmcategory[access][]" type="hidden" value="__wpdm__" />
                    <?php

                    $currentAccess = isset($MetaData[$_GET['tag_ID']])?$MetaData[$_GET['tag_ID']]['access']:array();

                    $selz = '';
                    if(  $currentAccess ) $selz = (in_array('guest',$currentAccess))?'checked=checked':'';
                    ?>

                    <li><label><input name="__wpdmcategory[access][]" type="checkbox" value="guest" <?php echo $selz  ?>><?php echo __("All Visitors","wpdmpro"); ?></label></li>
                    <?php
                    global $wp_roles;
                    $roles = array_reverse($wp_roles->role_names);
                    foreach( $roles as $role => $name ) {



                        if(  $currentAccess ) $sel = (in_array($role,$currentAccess))?'checked=checked':'';
                        else $sel = '';



                        ?>
                        <li><label><input name="__wpdmcategory[access][]" type="checkbox" value="<?php echo $role; ?>" <?php echo $sel  ?>> <?php echo $name; ?></label></li>
                    <?php } ?>
                </ul>
            </td>
        </tr>
        <?php
    }

    function SaveMetaData( $term_id ) {
        if ( isset( $_POST['__wpdmcategory'] ) ) {
            $MetaData = get_option( "__wpdmcategory" );
            $MetaData = maybe_unserialize($MetaData);
            $MetaData[$term_id] = $_POST['__wpdmcategory'];
            update_option( "__wpdmcategory", $MetaData );
        }
    }

}