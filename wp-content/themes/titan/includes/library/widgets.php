<?php
///----Blog widgets---

/// Recent Posts 
class Bunch_Recent_News extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Recent_News', /* Name */esc_html__('Titan Builder Recent News','titan'), array( 'description' => esc_html__('Show the recent news', 'titan' )) );
	}
 

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
        <!-- Recent News -->
        <div>
            <?php echo wp_kses_post($before_title.$title.$after_title); ?>
            <ul class="recent-post">
                <?php $query_string = 'posts_per_page='.$instance['number'];
				if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
				 
				
				$this->posts($query_string);
				?>
            </ul>
        </div>
        <!--End single sidebar-->
        
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recent News', 'titan');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'titan'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'titan'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
       
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'titan'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'titan'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($query_string)
	{
		$query = new WP_Query($query_string);
		if( $query->have_posts() ):?>
        
           	<!-- Recent News -->
            <?php while( $query->have_posts() ): $query->the_post(); ?>
            <li>
                <div class="img-holder">
                    <?php the_post_thumbnail('titan_80x80', array('class' => 'img-circle')); ?>
                    <div class="overlay-style-two">
                        <div class="box">
                            <div class="content">
                                <a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="title-holder">
                    <h5 class="post-title"><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h5>
                    <h6 class="post-date">
                        <i class="icon-calendar-with-spring-binder-and-date-blocks"></i>
                        <?php echo get_the_date('M d, Y'); ?>
                    </h6>
                </div>
            </li>
			<?php endwhile; ?>
            
        <?php endif;
		wp_reset_postdata();
    }
}

// Services Menu
class Bunch_Services_Menu extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Services_Menu', /* Name */esc_html__('Titan Builder Services Menu','titan'), array( 'description' => esc_html__('Show services menu in sidebar.', 'titan' )) );
	}
 

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		
		echo wp_kses_post($before_widget); ?>
		
        <!--Start single sidebar-->
        <div class="single-sidebar-box service-link-widget">
            <ul class="catergori-list">
            	<?php $args = array('post_type' => 'bunch_services', 'showposts'=>$instance['number']);
					if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'services_category','field' => 'id','terms' => (array)$instance['cat']));
					 
					$this->posts($args);
				?>
            </ul>
        </div>
        
        <?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'titan'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
       
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'titan'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'titan'), 'selected'=>$cat, 'taxonomy' => 'services_category', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($args)
	{
		$query = new WP_Query($args);
		if( $query->have_posts() ):
		while( $query->have_posts() ): $query->the_post();
		$services_meta = _WSH()->get_meta(); ?>
        <li><a href="<?php echo esc_url(titan_set($services_meta, 'ext_url')); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; endif;
		wp_reset_postdata();
    }
}

// Services Menu
class Bunch_Services_Menu2 extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Services_Menu2', /* Name */esc_html__('Titan Builder Services Footer','titan'), array( 'description' => esc_html__('Show services menu in sidebar.', 'titan' )) );
	}
 

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post($before_widget); ?>
		
        <!--Start single sidebar-->
        <div class="services-menu-footer">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
            <ul class="footer-list">
                <?php $args = array('post_type' => 'bunch_services', 'showposts'=>$instance['number']);
                    if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'services_category','field' => 'id','terms' => (array)$instance['cat']));
                     
                    $this->posts($args);
                ?>
            </ul>
        </div>
        
        <?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : 'Our Services';
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'titan'); ?></label>
            <input placeholder="<?php esc_html_e('Title', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'titan'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'titan'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'titan'), 'selected'=>$cat, 'taxonomy' => 'services_category', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($args)
	{
		$query = new WP_Query($args);
		if( $query->have_posts() ):
		while( $query->have_posts() ): $query->the_post();
		$services_meta = _WSH()->get_meta(); ?>
        <li><a href="<?php echo esc_url(titan_set($services_meta, 'ext_url')); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; endif;
		wp_reset_postdata();
    }
}

// Our Brochures
class Bunch_Brochures extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Brochures', /* Name */esc_html__('Titan Builder Our Brochures','titan'), array( 'description' => esc_html__('Show the info Our Brochures', 'titan' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);?>
      		
            <!--Our Brochures-->
            <div class="brochures">
                <?php echo wp_kses_post($before_title.$title.$after_title); ?>
                <ul class="brochures-lists">
                    <li class="active">
                        <a href="<?php echo esc_url($instance['pdf']); ?>"><span><?php esc_html_e('PDF', 'titan'); ?></span><?php esc_html_e('Our Brouchure.pdf', 'titan'); ?><i class="fa fa-download"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url($instance['txt']); ?>"><span><?php esc_html_e('TXT', 'titan'); ?></span><?php esc_html_e('Our Brouchure.txt', 'titan'); ?><i class="fa fa-download"></i></a>
                    </li>
                </ul>
            </div>
            
		<?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['pdf'] = $new_instance['pdf'];
		$instance['txt'] = $new_instance['txt'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Our Brochures', 'titan');
		$pdf = ( $instance ) ? esc_attr($instance['pdf']) : '#';
		$txt = ($instance) ? esc_attr($instance['txt']) : '#';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'titan'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('pdf')); ?>"><?php esc_html_e('PDF Link:', 'titan'); ?></label>
            <input placeholder="<?php esc_html_e('PDF link here', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('pdf')); ?>" name="<?php echo esc_attr($this->get_field_name('pdf')); ?>" type="text" value="<?php echo esc_attr($pdf); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('txt')); ?>"><?php esc_html_e('Work Doc Link:', 'titan'); ?></label>
            <input placeholder="<?php esc_html_e('Word link here', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('txt')); ?>" name="<?php echo esc_attr($this->get_field_name('txt')); ?>" type="text" value="<?php echo esc_attr($txt); ?>" />
        </p>
                
		<?php 
	}
	
}

///----footer widgets---
//About Us
class Bunch_About_Us extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_About_Us', /* Name */esc_html__('Titan Builder About Us','titan'), array( 'description' => esc_html__('Show the information about company', 'titan' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$options = _WSH()->option();
		echo wp_kses_post($before_widget);?>
      		
			<!--Footer Column-->
            <div class="logo-part">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo text-uppercase">
                    <img src="<?php echo esc_url($instance['logo_image']); ?>" alt="<?php esc_html_e('logo', 'titan'); ?>">
                </a>
            </div>
            <p class="footer-words"><?php echo wp_kses_post($instance['content']); ?></p>
            
            <?php if( $instance['show'] ): ?>
            <ul class="list-inline footer-social">
            	<?php $social_icons = titan_set( $options, 'social_media' );
				foreach( titan_set( $social_icons, 'social_media' ) as $social_icon ):
				if( isset( $social_icon['tocopy' ] ) ) continue; ?>
				<li><a href="<?php echo esc_url(titan_set( $social_icon, 'social_link')); ?>" target="_blank"><i class="fa <?php echo esc_attr(titan_set( $social_icon, 'social_icon')); ?>"></i></a></li>
				<?php endforeach; ?>
            </ul>
            <?php endif; ?>
            
		<?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['logo_image'] = $new_instance['logo_image'];
		$instance['content'] = $new_instance['content'];
		$instance['show'] = $new_instance['show'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$logo_image = ( $instance ) ? esc_attr($instance['logo_image']) : 'http://wp1.themexlab.com/newwp/titan/wp-content/themes/titan/images/logo/logo2.png';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$show = ($instance) ? esc_attr($instance['show']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('logo_image')); ?>"><?php esc_html_e('Logo Image:', 'titan'); ?></label>
            <input placeholder="<?php esc_html_e('logo link here', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('logo_image')); ?>" name="<?php echo esc_attr($this->get_field_name('logo_image')); ?>" type="text" value="<?php echo esc_attr($logo_image); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'titan'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show')); ?>"><?php esc_html_e('Show Social Icons:', 'titan'); ?></label>
   <?php $selected = ( $show ) ? ' checked="checked"' : ''; ?>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('show')); ?>"<?php echo esc_attr($selected); ?> name="<?php echo esc_attr($this->get_field_name('show')); ?>" type="checkbox" value="true" />
        </p>
                
		<?php 
	}
	
}

//Get in Touch
class Bunch_Get_in_Touch extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Bunch_Get_in_Touch', /* Name */esc_html__('Titan Builder Get in Touch','titan'), array( 'description' => esc_html__('Show the information about company', 'titan' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$options = _WSH()->option();
		echo wp_kses_post($before_widget);?>
      		
			<!--Footer Column-->
            <?php echo wp_kses_post($before_title.$title.$after_title); ?>
            
            <ul class="footer-info list-inline">
                <li><span class="flaticon-pin titan-icon"></span></li>
                <li>
                    <ul>
                        <li><span><?php echo wp_kses_post($instance['address']); ?></span></li>
                    </ul>
                </li>
            </ul>
            <ul class="footer-info list-inline">
                <li><span class="icon-technology titan-icon"></span></li>
                <li>
                    <ul>
                        <li><span><?php echo wp_kses_post($instance['phone1']); ?></span></li>
                        <li><span><?php echo wp_kses_post($instance['phone2']); ?></span></li>
                    </ul>
                </li>
            </ul>
            <ul class="footer-info list-inline">
                <li><span class="flaticon-mail titan-icon"></span></li>
                <li>
                    <ul>
                        <li><a href="mailto:<?php echo sanitize_email($instance['email1']); ?>"><?php echo sanitize_email($instance['email1']); ?></a></li>
                        <li><a href="mailto:<?php echo sanitize_email($instance['email2']); ?>"><?php echo sanitize_email($instance['email2']); ?></a></li>
                    </ul>
                </li>
            </ul>
            
		<?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['address'] = $new_instance['address'];
		$instance['phone1'] = $new_instance['phone1'];
		$instance['phone2'] = $new_instance['phone2'];
		$instance['email1'] = $new_instance['email1'];
		$instance['email2'] = $new_instance['email2'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : 'Get in Touch';
		$address = ( $instance ) ? esc_attr($instance['address']) : '05 Titan Builder, Downtown,<br/>Victoria, Australia';
		$phone1 = ( $instance ) ? esc_attr($instance['phone1']) : '+(10) 123 456 7966';
		$phone2 = ( $instance ) ? esc_attr($instance['phone2']) : '+(10) 123 456 7977';
		$email1 = ( $instance ) ? esc_attr($instance['email1']) : 'Info@Titan.Com';
		$email2 = ( $instance ) ? esc_attr($instance['email2']) : 'Support@Titan.Com';
	?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'titan'); ?></label>
            <input placeholder="<?php esc_html_e('Title', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address:', 'titan'); ?></label>
            <textarea placeholder="<?php esc_html_e('Address', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>"><?php echo wp_kses_post($address); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone1')); ?>"><?php esc_html_e('Phone:', 'titan'); ?></label>
            <input placeholder="<?php esc_html_e('Phone', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone1')); ?>" name="<?php echo esc_attr($this->get_field_name('phone1')); ?>" type="text" value="<?php echo esc_attr($phone1); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone2')); ?>"><?php esc_html_e('Phone:', 'titan'); ?></label>
            <input placeholder="<?php esc_html_e('Phone', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone2')); ?>" name="<?php echo esc_attr($this->get_field_name('phone2')); ?>" type="text" value="<?php echo esc_attr($phone2); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email1')); ?>"><?php esc_html_e('Email:', 'titan'); ?></label>
            <input placeholder="<?php esc_html_e('Email', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('email1')); ?>" name="<?php echo esc_attr($this->get_field_name('email1')); ?>" type="text" value="<?php echo esc_attr($email1); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email2')); ?>"><?php esc_html_e('Email:', 'titan'); ?></label>
            <input placeholder="<?php esc_html_e('Email', 'titan');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('email2')); ?>" name="<?php echo esc_attr($this->get_field_name('email2')); ?>" type="text" value="<?php echo esc_attr($email2); ?>" />
        </p>
                
		<?php 
	}
	
}
?>