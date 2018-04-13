<?php
/**
 * The Output of the Advanced Sidebar Page Widget
 *
 * @author Mat Lipe
 *
 * @since  7.0.0
 *
 * @example to edit, create a file named page_list.php and
 *          put in a folder in the your theme called 'advanced-sidebar-menu.
 *          Copy the contents of the file into that file and edit at will.
 *
 * @notice  Do not edit this file in its original location or it will break on upgrade
 */
$menu = Advanced_Sidebar_Menu_Menus_Page::get_current();
$list_pages = Advanced_Sidebar_Menu_List_Pages::factory( $menu );
$child_pages = $list_pages->get_child_pages( $menu->get_top_parent_id(), true );
$content = '';

$menu->title();

//Display parent page
if( $menu->include_parent() ){
	$content .= '<ul class="parent-sidebar-menu" >';
	$list_args = $list_pages->get_args( 'parent' );
	$content .= wp_list_pages( $list_args );
}

if( !empty( $child_pages ) ){
	$content .= '<ul class="child-sidebar-menu">';

	//Always display child pages
	if( $menu->display_all() ){
		$list_args = $list_pages->get_args( 'display-all' );
		$content .= wp_list_pages( $list_args );

	} else {
		//Child and grandchild pages
		$content .= $list_pages->list_pages();
	}

	$content .= '</ul><!-- End .child-sidebar-menu -->';

}
if( $menu->include_parent() ){
	$content .= '</li></ul><!-- End .parent-sidebar-menu -->';
}

return $content;