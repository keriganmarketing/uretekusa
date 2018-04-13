<?php
namespace WPDM;


class ShortCodes
{

    function __construct()
    {


        // Total Package Count
        add_shortcode('wpdm_package_count', array($this, 'TotalPackages'));

        // Total Package Count
        add_shortcode('wpdm_download_count', array($this, 'TotalDownloads'));

        // Login/Register Form
        add_shortcode('wpdm_login_form', array($this, 'loginForm'));

         // Register form
        add_shortcode('wpdm_reg_form', array($this, 'registerForm'));

        // Edit Profile
        //add_shortcode('wpdm_edit_profile', array($this, 'EditProfile'));

        // Show all packages
        add_shortcode('wpdm_packages', array($this, 'Packages'));

        // Show a package by id
        add_shortcode('wpdm_package', array($this, 'Package'));

        // Show a category link
        add_shortcode('wpdm_category_link', array($this, 'categoryLink'));

        // Generate direct download link
        add_shortcode('wpdm_direct_link', array($this, 'directLink'));

        // Show all packages in a responsive table
        add_shortcode('wpdm_all_packages', array($this, 'allPackages'));
        add_shortcode('wpdm-all-packages', array($this, 'allPackages'));

        //Packages by tag
        add_shortcode("wpdm_tag", array($this, 'packagesByTag'));


        //Search downloads
        add_shortcode( 'wpdm_search_result', array($this, 'searchResult'));


        //User Favourites
        add_shortcode( 'wpdm_user_favourites', array($this, 'userFavourites'));

    }

    /**
     * @usage Short-code function for total download count
     * @param array $params
     * @return mixed
     */
    function TotalDownloads($params = array()){
        global $wpdb;
        $download_count = $wpdb->get_var("select sum(meta_value) from {$wpdb->prefix}postmeta where meta_key='__wpdm_download_count'");
        return $download_count;
    }

    /**
     * @usage Short-code function for total package count
     * @param array $params
     * @return mixed
     */
    function totalPackages($params = array()){
        $count_posts = wp_count_posts('wpdmpro');
        $status = isset($params['status'])?$params['status']:'publish';
        if($status=='draft') return $count_posts->draft;
        if($status=='pending') return $count_posts->pending;
        return $count_posts->publish;
    }

    /**
     * @usage Short-code callback function for login/register form
     * @return string
     */
    function loginForm($params = array()){
        if(isset($params) && is_array($params))
            extract($params);
        if(!isset($redirect)) $redirect = get_permalink(get_option('__wpdm_user_dashboard'));
        ob_start();
        include(wpdm_tpl_path('wpdm-login-form.php'));
        return ob_get_clean();
    }



    /**
     * @usage Edit profile
     * @return string
     */
    public function editProfile()
    {
        global $wpdb, $current_user, $wp_query;
        wp_reset_query();
        $currentAccess = maybe_unserialize(get_option('__wpdm_front_end_access', array()));

        if (!array_intersect($currentAccess, $current_user->roles) && is_user_logged_in())
            return \WPDM_Messages::Error(wpautop(stripslashes(get_option('__wpdm_front_end_access_blocked'))), -1);


        $id = wpdm_query_var('ID');

        ob_start();
        echo "<div class='w3eden'>";
        if (is_user_logged_in()) {
            include(wpdm_tpl_path('wpdm-edit-user-profile.php'));
        } else {
            include(wpdm_tpl_path('wpdm-login-form.php'));
        }
        echo "</div>";

        $data = ob_get_clean();
        return $data;
    }

    function registerForm($params = array()){
        if(!get_option('users_can_register')) return __('User registration is disabled', 'wpdmpro');
        if(isset($params['role'])) update_post_meta(get_the_ID(),'__wpdm_role', $params['role']);
        ob_start();
        $regparams = \WPDM_Crypt::Encrypt($params);

        include(wpdm_tpl_path('wpdm-reg-form.php'));

        $data = ob_get_clean();
        return $data;
    }

    /**
     * @param array $params
     * @return string
     */
    function Packages($params = array('items_per_page' => 10, 'title' => false, 'desc' => false, 'order_by' => 'date', 'order' => 'desc', 'paging' => false, 'toolbar' => 1, 'template' => '','cols'=>3, 'colspad'=>2, 'colsphone' => 1, 'tags' => '', 'categories' => '', 'year' => '', 'month' => '', 's' => ''))
    {

        //$params['order_by']  = isset($params['order_field']) && $params['order_field'] != '' && !isset($params['order_by'])?$params['order_field']:$params['order_by'];
        $scparams = $params;
        $defaults = array('author' => '', 'author_name' => '', 'items_per_page' => 10, 'title' => false, 'desc' => false, 'order_by' => 'date', 'order' => 'desc', 'paging' => false, 'toolbar' => 1, 'template' => 'link-template-panel','cols'=>3, 'colspad'=>2, 'colsphone' => 1);
        $params = shortcode_atts($defaults, $params, 'wpdm_packages' );

        if(is_array($params))
            extract($params);

        if(!isset($items_per_page) || $items_per_page < 1) $items_per_page = 10;

        $cwd_class = "col-md-".(int)(12/$cols);
        $cwdsm_class = "col-sm-".(int)(12/$colspad);
        $cwdxs_class = "col-xs-".(int)(12/$colsphone);

        if(isset($id)) {
            $id = trim($id, ", ");
            $cids = explode(",", $id);
        }

        global $wpdb, $current_user, $post, $wp_query;

        if(isset($order_by) && !isset($order_field)) $order_field = $order_by;
        $order_field = isset($order_field) ? $order_field : 'date';
        $order_field = isset($_GET['orderby']) ? $_GET['orderby'] : $order_field;
        $order = isset($order) ? $order : 'desc';
        $order = isset($_GET['order']) ? $_GET['order'] : $order;
        $cp = wpdm_query_var('cp','num');
        if(!$cp) $cp = 1;

        $params = array(
            'post_type' => 'wpdmpro',
            'paged' => $cp,
            'posts_per_page' => $items_per_page,
            'include_children' => false,
        );

        if(isset($scparams['s']) && $scparams['s'] != '') $params['s'] = $scparams['s'];
        if(isset($scparams['author']) && $scparams['author'] != '') $params['author'] = $scparams['author'];
        if(isset($scparams['author_name']) && $scparams['author_name'] != '') $params['author_name'] = $scparams['author_name'];
        if(isset($scparams['search']) && $scparams['search'] != '') $params['s'] = $scparams['search'];
        if(isset($scparams['tag']) && $scparams['tag'] != '') $params['tag'] = $scparams['tag'];
        if(isset($scparams['tag_id']) && $scparams['tag_id'] != '') $params['tag_id'] = $scparams['tag_id'];
        if(isset($scparams['tag__and']) && $scparams['tag__and'] != '') $params['tag__and'] = explode(",",$scparams['tag__and']);
        if(isset($scparams['tag__in']) && $scparams['tag__in'] != '') $params['tag__in'] = explode(",",$scparams['tag__in']);
        if(isset($scparams['tag__not_in']) && $scparams['tag__not_in'] != '') $params['tag__not_in'] = explode(",",$scparams['tag__not_in']);
        if(isset($scparams['tag_slug__and']) && $scparams['tag_slug__and'] != '') $params['tag_slug__and'] = explode(",",$scparams['tag_slug__and']);
        if(isset($scparams['tag_slug__in']) && $scparams['tag_slug__in'] != '') $params['tag_slug__in'] = explode(",",$scparams['tag_slug__in']);
        if(isset($scparams['categories']) && $scparams['categories'] != '') {
            $operator = isset($scparams['operator'])?$scparams['operator']:'OR';
            $params['tax_query'] = array(array(
                'taxonomy' => 'wpdmcategory',
                'field' => 'slug',
                'terms' => explode(",",$scparams['categories']),
                'include_children' => ( isset($scparams['include_children']) && $scparams['include_children'] != '' )?$scparams['include_children']: false,
                'operator' => $operator
            ));
        }


        if (get_option('_wpdm_hide_all', 0) == 1) {
            $params['meta_query'] = array(
                array(
                    'key' => '__wpdm_access',
                    'value' => '"guest"',
                    'compare' => 'LIKE'
                )
            );
            if(is_user_logged_in()){
                global $current_user;
                $params['meta_query'][] = array(
                    'key' => '__wpdm_access',
                    'value' => $current_user->roles[0],
                    'compare' => 'LIKE'
                );
                $params['meta_query']['relation'] = 'OR';
            }
        }

        if(isset($scparams['year']) ||isset($scparams['month']) || isset($scparams['day'])){
            $date_query = array();

            if(isset($scparams['day']) && $scparams['day'] == 'today') $scparams['day'] = date('d');
            if(isset($scparams['year']) && $scparams['year'] == 'this') $scparams['year'] = date('Y');
            if(isset($scparams['month']) && $scparams['month'] == 'this') $scparams['month'] = date('m');
            if(isset($scparams['week']) && $scparams['week'] == 'this') $scparams['week'] = date('W');

            if(isset($scparams['year']))  $date_query['year'] = $scparams['year'];
            if(isset($scparams['month']))  $date_query['month'] = $scparams['month'];
            if(isset($scparams['week']))  $date_query['week'] = $scparams['week'];
            if(isset($scparams['day']))  $date_query['day'] = $scparams['day'];
            $params['date_query'][] = $date_query;
        }

        $order_fields = array('__wpdm_download_count','__wpdm_view_count','__wpdm_package_size_b');
        if(!in_array( "__wpdm_".$order_field, $order_fields)) {
            $params['orderby'] = $order_field;
            $params['order'] = $order;
        } else {
            $params['orderby'] = 'meta_value_num';
            $params['meta_key'] = "__wpdm_".$order_field;
            $params['order'] = $order;
        }

        $params = apply_filters("wpdm_packages_query_params", $params);

        $packs = new \WP_Query($params);

        $total = $packs->found_posts;

        $pages = ceil($total / $items_per_page);
        $page = isset($_GET['cp']) ? $_GET['cp'] : 1;
        $start = ($page - 1) * $items_per_page;

        if (!isset($paging) || intval($paging) == 1) {
            $pag = new \WPDM\libs\Pagination();
            $pag->items($total);
            $pag->nextLabel(' &#9658; ');
            $pag->prevLabel(' &#9668; ');
            $pag->limit($items_per_page);
            $pag->currentPage($page);
        }

        $burl = get_permalink();
        $url = $_SERVER['REQUEST_URI']; //get_permalink();
        $url = strpos($url, '?') ? $url . '&' : $url . '?';
        $url = preg_replace("/[\&]*cp=[0-9]+[\&]*/", "", $url);
        $url = strpos($url, '?') ? $url . '&' : $url . '?';
        if (!isset($paging) || intval($paging) == 1)
            $pag->urlTemplate($url . "cp=[%PAGENO%]");


        $html = '';
        $templates = maybe_unserialize(get_option("_fm_link_templates", true));

        if(isset($template) && isset($templates[$template])) $template = $templates[$template]['content'];

        //global $post;
        while($packs->have_posts()) { $packs->the_post();

            $pack = (array)$post;
            $repeater = "<div class='{$cwd_class} {$cwdsm_class} {$cwdxs_class}'>".\WPDM\Package::fetchTemplate($template, $pack)."</div>";
            $html .=  $repeater;

        }
        wp_reset_query();

        $html = "<div class='row'>{$html}</div>";


        if (!isset($paging) || intval($paging) == 1)
            $pgn = "<div style='clear:both'></div>" . $pag->show() . "<div style='clear:both'></div>";
        else
            $pgn = "";
        global $post;

        $sap = get_option('permalink_structure') ? '?' : '&';
        $burl = $burl . $sap;
        if (isset($_GET['p']) && $_GET['p'] != '') $burl .= 'p=' . $_GET['p'] . '&';
        if (isset($_GET['src']) && $_GET['src'] != '') $burl .= 'src=' . $_GET['src'] . '&';
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'create_date';
        $order = ucfirst($order);

        $title = isset($title) && $title !=''?"<h3>$title</h3>":"";

        return "<div class='w3eden'>" . $title . $desc  . $html  . $pgn . "<div style='clear:both'></div></div>";
    }


    /**
     * @param array $params
     * @return array|null|WP_Post
     * @usage Shortcode callback function for [wpdm_search_result]
     */
    function searchResult( $params = array() ){
        global $wpdb;

        if(is_array($params))
            @extract($params);
        $template = isset($template) && $template != '' ? $template : 'link-template-calltoaction3';
        $items_per_page = isset($items_per_page) ? $items_per_page : 0;
        update_post_meta(get_the_ID(), "__wpdm_link_template", $template);
        update_post_meta(get_the_ID(), "__wpdm_items_per_page", $items_per_page);
        $strm = wpdm_query_var('q');
        $html = '';
        $cols = isset($cols)?$cols:1;
        if(($strm == '' && isset($init) && $init == 1) || $strm != '')
        $html = $this->Packages(array('items_per_page' => $items_per_page, 'template' => $template, 's' => $strm, 'paging' => false, 'toolbar' => 0,'cols'=>$cols));
        $html = "<form style='margin-bottom: 20px'><div class='input-group input-group-lg'><div class='input-group-addon no-radius'><i class='fa fa-search'></i></div><input type='text' name='q' value='".esc_attr(wpdm_query_var('q'))."' class='form-control input-lg no-radius' /></div></form>{$html}";
        return str_replace(array("\r","\n"),"",$html);
    }

    /**
     * @usage Callback function for shortcode [wpdm_package id=PID]
     * @param mixed $params
     * @return mixed
     */
    function Package($params)
    {
        extract($params);

        if(!isset($id)) return '';
        $id = (int)$id;
        if(get_post_type($id) != 'wpdmpro') return '';
        $postlink = site_url('/');
        if (isset($pagetemplate) && $pagetemplate == 1) {
            $template = get_post_meta($id,'__wpdm_page_template', true);
            $wpdm_package['page_template'] = stripcslashes($template);
            $data = wpdm_fetch_template($template, $id, 'page');
            $siteurl = site_url('/');
            return  "<div class='w3eden'>{$data}</div>";
        }

        $template = isset($params['template'])?$params['template']:get_post_meta($id,'__wpdm_template', true);
        if($template == '') $template = 'link-template-calltoaction3.php';
        $html = "<div class='w3eden'>" . \WPDM\Package::fetchTemplate($template, $id, 'link') . "</div>";
        wp_reset_query();
        return $html;
    }


    /**
     * @usage Generate direct link to download
     * @param $params
     * @param string $content
     * @return string
     */
    function directLink($params, $content = "")
    {
        extract($params);
        global $wpdb;
        if(\WPDM\Package::isLocked($params['id']))
            $linkURL = get_permalink($params['id']);
        else
            $linkURL = "index.php?wpdmdl=".$params['id'];
        $target = isset($params['target'])?"target={$params['target']}":"";
        $class = isset($params['class'])?"target={$params['class']}":"";
        $id = isset($params['id'])?"target={$params['id']}":"";
        $linkLabel = isset($params['label']) && !empty($params['label'])?$params['label']:get_post_meta($params['id'], '__wpdm_link_label', true);
        $linkLabel = empty($linkLabel)?'Download '.get_the_title($params['id']):$linkLabel;
        return  "<a {$target} {$class} {$id} href='$linkURL'>$linkLabel</a>";

    }

    /**
     * @usage Short-code [wpdm_all_packages] to list all packages in tabular format
     * @param array $params
     * @return string
     */
    function allPackages($params = array())
    {
        global $wpdb, $current_user, $wp_query;
        $items = isset($params['items_per_page']) && $params['items_per_page'] > 0 ? $params['items_per_page'] : 20;
        if(isset($params['jstable']) && $params['jstable']==1) $items = 2000;
        $cp = isset($wp_query->query_vars['paged']) && $wp_query->query_vars['paged'] > 0 ? $wp_query->query_vars['paged'] : 1;
        $terms = isset($params['categories']) ? explode(",", $params['categories']) : array();
        if (isset($_GET['wpdmc'])) $terms = array(esc_attr($_GET['wpdmc']));
        $offset = ($cp - 1) * $items;
        $total_files = wp_count_posts('wpdmpro')->publish;
        if (count($terms) > 0) {
            $tax_query = array(array(
                'taxonomy' => 'wpdmcategory',
                'field' => 'slug',
                'terms' => $terms,
                'operator' => 'IN',
                'include_children' => false
            ));
        }
        if(isset($params['login']) && $params['login'] == 1 && !is_user_logged_in())
            return do_shortcode("[wpdm_login_form simple=1]");
        else {
            ob_start();
            include(wpdm_tpl_path("wpdm-all-downloads.php"));
            $data = ob_get_clean();
            return $data;
        }
    }

    /**
     * @usage Show packages by tag
     * @param $params
     * @return string
     */
    function packagesByTag($params)
    {
        $params['order_field'] = isset($params['order_by'])?$params['order_by']:'publish_date';
        $params['tag'] = 1;
        unset($params['order_by']);
        if (isset($params['item_per_page']) && !isset($params['items_per_page'])) $params['items_per_page'] = $params['item_per_page'];
        unset($params['item_per_page']);
        return wpdm_embed_category($params);

    }

    function categoryLink($params){

        $term = (array)get_term($params['id'], 'wpdmcategory');
        $icon = \WPDM\libs\CategoryHandler::icon($params['id']);
        $term['icon'] = $icon?"<img src='$icon' alt='{$term['name']}' />":"";
        $params['template'] = isset($params['template']) && $params['template'] != ''?$params['template']:'link-template-category-link.php';
        return \WPDM\Template::output($params['template'], $term);


    }



    function userFavourites($params = array()){
        global $wpdb, $current_user;
        if(!isset($params['user']) && !is_user_logged_in()) return $this->loginForm();
        ob_start();
        include wpdm_tpl_path('user-favourites.php');
        return ob_get_clean();
    }

}
