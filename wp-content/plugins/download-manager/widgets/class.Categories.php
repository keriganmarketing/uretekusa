<?php

class WPDM_Categories extends WP_Widget {
    /** constructor */
    function __construct() {
        parent::__construct(false, 'WPDM Categories');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $parent = isset($instance['parent']) && $instance['parent'] >0 ?intval($instance['parent']):0;
        $style = isset($instance['style'])?esc_attr($instance['style']):'flat';
        ?>
        <?php echo $before_widget; ?>
        <?php if ( $title )
            echo $before_title . $title . $after_title;

        $args = array(
            'orderby'           => 'name',
            'order'             => 'ASC',
            'hide_empty'        => false,
            'exclude'           => array(),
            'exclude_tree'      => array(),
            'include'           => array(),
            'number'            => '',
            'fields'            => 'all',
            'slug'              => '',
            'parent'            => '',
            'hierarchical'      => ($style == 'flat'?false:true),
            'child_of'          => $parent,
            'childless'         => false,
            'get'               => '',
            'name__like'        => '',
            'description__like' => '',
            'pad_counts'        => false,
            'offset'            => '',
            'search'            => '',
            'cache_domain'      => 'core'
        );
        $terms = get_terms("wpdmcategory", $args);

        if($style == 'flat') {
            echo "<div class='w3eden'><div class='list-group'>";
            foreach ($terms as $term) {
                echo "<a href='" . get_term_link($term) . "'  class='list-group-item'><span class='badge'>{$term->count}</span>{$term->name}</a>\n";
            }

            echo "</div></div>\n";
        } else {

            function wpdm_categories_tree($parent = 0, $selected = array()){
                $categories = get_terms( 'wpdmcategory' , array('hide_empty'=>0,'parent'=>$parent));
                $checked = "";
                foreach($categories as $category){
                    if($selected){
                        foreach($selected as $ptype){
                            if($ptype->term_id==$category->term_id){$checked="checked='checked'";break;}else $checked="";
                        }
                    }
                    echo '<li><a href="'.get_term_link($category).'"> '.$category->name.' </a>';
                    $termchildren = get_term_children( $category->term_id, 'wpdmcategory' );
                    if($termchildren) {
                        echo "<ul>";
                        wpdm_categories_tree($category->term_id, $selected);
                        echo "</ul>";
                    }
                    echo "</li>";
                }
            }

            echo "<ul class='wpdm-categories'>";
            $cparent = $parent;
            if($cparent!==0){
                $cparent = get_term_by('slug', $cparent, 'wpdmcategory');
                $cparent = $cparent->term_id;
            }
            wpdm_categories_tree($cparent, $terms);
            echo "</ul>";
        }
        echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $title = isset($instance['title'])?esc_attr($instance['title']):"";
        $parent = isset($instance['parent'])?intval($instance['parent']):0;
        $style = isset($instance['style'])?esc_attr($instance['style']):'flat';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('parent'); ?>"><?php _e('Parent:'); ?></label><br/>
            <?php wpdm_dropdown_categories($this->get_field_name('parent'), $parent, $this->get_field_id('parent')); ?>
        </p>
        <p>
            <label><?php _e('Style:'); ?></label><br/>
            <label><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" <?php checked('flat', $style); ?> value="flat"> Flat List</label><br/>
            <label><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" <?php checked('tree', $style); ?> value="tree"> Hierarchy List</label><br/>
            <!-- label><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" <?php checked('dropdown', $style); ?> value="dropdown"> Dropdown List</label></br -->
        </p>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("WPDM_Categories");'));
