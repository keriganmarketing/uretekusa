<?php $options = _WSH()->option();
	titan_bunch_global_variable();
	$icon_href = (titan_set( $options, 'site_favicon' )) ? titan_set( $options, 'site_favicon' ) : get_template_directory_uri().'/images/favicon.ico';
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ):?>
	<link rel="shortcut icon" href="<?php echo esc_url($icon_href);?>" type="image/x-icon">
	<link rel="icon" href="<?php echo esc_url($icon_href);?>" type="image/x-icon">
<?php endif;?>
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="boxed_wrapper">

	<!--Start Top bar area -->  
    <section class="top-bar-area">
        <div class="container">
            <div class="clearfix">
            	<?php if(titan_set($options, 'welcome_note')): ?>
                <div class="pull-left"><p><?php echo wp_kses_post(titan_set($options, 'welcome_note')); ?></p></div>
                <?php endif; if(titan_set($options, 'working_time')): ?>
                <div class="pull-right">
                    <p><i class="fa fa-clock-o"></i><?php echo wp_kses_post(titan_set($options, 'working_time')); ?></p>
                </div>
                <?php endif;?>
            </div>
        </div>
    </section>
    <!--End Top bar area --> 

	<?php $header = titan_set($options, 'header_style');
	  $header = (titan_set($_GET, 'header_style')) ? titan_set($_GET, 'header_style') : $header;
	  switch($header){
	  	case "header_v2":
			get_template_part('includes/modules/header_v2');
			break;
		default:
			get_template_part('includes/modules/header_v1');
		} 	
	?>
    