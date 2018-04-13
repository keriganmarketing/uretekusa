<?php $args = fabrique_template_args( 'style-custom' ); ?>
<?php $args = fabrique_style_custom_options( $args ); ?>
<?php $fonts = $args['fonts']; ?>

<?php if ( !empty( $args['custom_fonts'] ) ) : ?>
	<?php $registered_custom_fonts = get_option( 'bp_custom_font' ); ?>
	<?php if ( !empty( $registered_custom_fonts ) ) : ?>
		<?php foreach ( $args['custom_fonts'] as $custom_font ) : ?>
			<?php $custom_font_family = $custom_font['family']; ?>
			<?php if ( isset( $registered_custom_fonts[$custom_font['family']] ) ) : ?>
				@font-face {
					font-family: <?php echo esc_attr( $custom_font_family ); ?>;
				<?php if ( isset( $custom_font['eot_url'] ) ) : ?>
					src: url('<?php echo esc_url( $registered_custom_fonts[$custom_font['family']]['eot_url'] ); ?>');
				<?php endif; ?>
					src: url('<?php echo esc_url( $registered_custom_fonts[$custom_font['family']]['url'] ); ?>');
				}
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>

<?php /*====Heading typography====*/?>
h1, h2, h3, h4, h5, h6 {
	<?php echo fabrique_s( $fonts[$args['heading_typography']], false ); ?>
}
<?php /*==========================*/?>

<?php /*=====Theme typography=====*/?>
<?php foreach ( $fonts as $key => $value ) : ?>
.fbq-<?php echo esc_attr( $key ); ?>-font {
	<?php echo fabrique_s( $value, false ); ?>
}
<?php endforeach; ?>
<?php /*==========================*/?>

<?php /*=Native Tag & Basic Class==*/?>
body {
	color: <?php echo esc_attr( $args['primary_text'] ); ?>;
	background-color: <?php echo esc_attr( $args['primary_background'] ); ?>;
}

.fbq-wrapper--parallax-footer .fbq-content {
	background-color: <?php echo esc_attr( $args['primary_background'] ); ?>;
}

::selection {
	color: <?php echo esc_attr( $args['primary_brand_contrast'] ); ?>;
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

::-moz-selection {
	color: <?php echo esc_attr( $args['primary_brand_contrast'] ); ?>;
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

a,
a:hover.fbq-s-text-color,
a:hover.fbq-p-text-color,
.comment-form-rating p.stars a:before,
.comment-rating > span,
.comment-like-dislike a:visited {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

a:hover,
a:focus,
a:active,
a:hover.fbq-p-brand-color {
	color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}

a:focus.fbq-s-text-color {
	color: <?php echo esc_attr( $args['secondary_text'] ); ?>;
}

a:focus.fbq-p-text-color {
	color: <?php echo esc_attr( $args['primary_text'] ); ?>;
}

.btnx,
ins,
code,
kbd,
tt {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.btnx:hover,
.btnx:focus {
	color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => 'a:hover.fbq-p-bg-color',
	'property' => array(
		'color' => 'secondary_background'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => 'label',
	'property' => array(
		'color' => 'primary_text'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'pre',
		'cite',
		'mark',
		'h1','h2','h3','h4','h5','h6',
		'.fbq-text-bullet.decimal li:before'
	),
	'property' => array(
		'color' => 'secondary_text'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'code',
		'kbd',
		'tt',
		'pre'
	),
	'property' => array(
		'background-color' => 'secondary_background'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => 'pre',
	'property' => array(
		'border-color' => 'primary_border'
	)
) ) );
?>
<?php /*=========================*/?>

<?php /*===Main Color Selector===*/?>
.fbq-light-scheme,
.fbq-entry-light-scheme,
.fbq-slider-light-scheme {
	color: <?php echo esc_attr( $args['bp_color_3'] ); ?>;
}

.fbq-dark-scheme,
.fbq-entry-dark-scheme,
.fbq-slider-dark-scheme {
	color: <?php echo esc_attr( $args['bp_color_8'] ); ?>;
}

.fbq-p-brand-color {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-p-brand-bg,
.fbq-pagination .current:after {
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-p-brand-border,
.widget .fbq-menu.anchor .menu-item.current-menu-item > a {
	border-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-s-brand-color {
	color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}

.fbq-s-brand-bg {
	background-color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}

.fbq-s-brand-border {
	border-color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}

.fbq-p-brand-contrast-color {
	color: <?php echo esc_attr( $args['primary_brand_contrast'] ); ?>;
}

.fbq-s-brand-contrast-color {
	color: <?php echo esc_attr( $args['secondary_brand_contrast'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-text-contrast-color',
	'property' => array(
		'color' => 'primary_text_contrast'
	),
	'parent' => array( 'slider' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-contrast-color',
	'property' => array(
		'color' => 'secondary_text_contrast'
	),
	'parent' => array( 'slider' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-text-color',
	'property' => array(
		'color' => 'primary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-text-bg',
	'property' => array(
		'background-color' => 'primary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-color',
	'property' => array(
		'color' => 'secondary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-bg',
	'property' => array(
		'background-color' => 'secondary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-bg.fbq-overlay',
	'property' => array(
		'background-color' => 'secondary_text'
	),
	'opacity' => 0.9,
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-border',
	'property' => array(
		'border-color' => 'secondary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-bg-color',
	'property' => array(
		'color' => 'primary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-bg-bg',
	'property' => array(
		'background-color' => 'primary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-bg-border',
	'property' => array(
		'border-color' => 'primary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-bg-color',
	'property' => array(
		'color' => 'secondary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-bg-bg',
	'property' => array(
		'background-color' => 'secondary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-bg-border',
	'property' => array(
		'border-color' => 'secondary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-border-color',
	'property' => array(
		'color' => 'primary_border'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-border-bg',
	'property' => array(
		'background-color' => 'primary_border'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-border-border',
	'property' => array(
		'border-color' => 'primary_border'
	),
	'parent' => array( 'slider', 'entry', 'navbar-dropdown' ),
	'is_high_level' => true
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-overlay',
	'property' => array(
		'background-color' => 'primary_background'
	),
	'opacity' => 0.9,
	'parent' => array( 'slider', 'entry' )
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => 'a.fbq-p-brand-bg-hover:hover',
	'property' => array(
		'background-color' => 'primary_brand',
		'color' => 'primary_brand_contrast'
	),
	'parent' => array( 'slider', 'entry' )
) ) );
?>
<?php /*=========================*/?>

<?php /*=======Brand Button======*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-button--border.fbq-button-color--brand > .btnx',
		'.fbq-button--fill.fbq-button-hover--inverse > .btnx:hover'
	),
	'property' => array(
		'color' => 'primary_brand',
		'border-color' => 'primary_brand'
	),
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-button--border.fbq-button-hover--brand > .btnx:hover',
	'property' => array(
		'color' => 'secondary_brand',
		'border-color' => 'secondary_brand'
	),
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-form-group input[type=submit]',
		'.fbq-contactform--fill input[type=submit]',
		'.fbq-button--fill.fbq-button-color--brand > .btnx',
		'.fbq-button--border.fbq-button-hover--inverse > .btnx:hover'
	),
	'property' => array(
		'color' => 'primary_brand_contrast',
		'border-color' => 'primary_brand',
		'background-color' => 'primary_brand'
	),
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-form-group input[type=submit]:hover',
		'.fbq-contactform--fill input[type=submit]:hover',
		'.fbq-button--fill.fbq-button-hover--brand > .btnx:hover'
	),
	'property' => array(
		'color' => 'secondary_brand_contrast',
		'border-color' => 'secondary_brand',
		'background-color' => 'secondary_brand'
	),
	'parent' => 'slider'
) ) );
?>
<?php /*=========================*/?>

<?php /*=======Basic Button======*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-button-color--basic.fbq-button--border > .btnx',
		'.fbq-button-color--basic.fbq-button--fill.fbq-button-hover--inverse > .btnx:hover'
	),
	'property' => array(
		'color' => 'secondary_text',
		'border-color' => 'secondary_text'
	),
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-button-color--basic.fbq-button--fill > .btnx',
		'.fbq-button-color--basic.fbq-button--border.fbq-button-hover--inverse > .btnx:hover',
	),
	'property' => array(
		'color' => 'primary_brand',
		'border-color' => 'secondary_text',
		'background-color' => 'secondary_text'
	),
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-button-color--basic.fbq-button--border.fbq-button-hover--brand > .btnx:hover',
	'property' => array(
		'color' => 'primary_brand',
		'border-color' => 'primary_brand',
	),
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-button-color--basic.fbq-button--fill.fbq-button-hover--brand > .btnx:hover',
	'property' => array(
		'color' => 'primary_brand_contrast',
		'border-color' => 'primary_brand',
		'background-color' => 'primary_brand'
	),
	'parent' => 'slider'
) ) );
?>
<?php /*=========================*/?>

<?php /*=======Slick Dots======*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.slick-dots button',
	'property' => array(
		'background-color' => 'secondary_text'
	),
	'opacity' => 0.4,
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.slick-dots button:hover',
	'property' => array(
		'background-color' => 'secondary_text'
	),
	'opacity' => 0.7,
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.slick-dots .slick-active button',
	'property' => array(
		'background-color' => 'secondary_text'
	),
	'parent' => 'slider'
) ) );
?>
<?php /*=========================*/?>

<?php /*=====Tab & Accordion=====*/?>
.fbq-tab .fbq-tab-nav-list.active,
.fbq-accordion-panel.active .fbq-accordion-heading {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-accordion--fill .fbq-accordion-panel.active .fbq-accordion-heading {
	background-color: <?php echo esc_attr( $args['secondary_background'] ); ?> !important;
}

.fbq-tab--underline .fbq-tab-nav-list.active,
.fbq-accordion--border .fbq-accordion-panel.active .fbq-accordion-heading {
	border-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-tab--fullwidth .fbq-tab-nav-list.active {
	background-color: <?php echo esc_attr( $args['primary_background'] ); ?>;
}

.fbq-accordion--fill .fbq-accordion-panel.active .fbq-accordion-heading {
	background-color: <?php echo esc_attr( $args['secondary_background'] ); ?>;
}
<?php /*=========================*/?>

<?php /*=========Widgets=========*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.widget a',
		'.widget .tagcloud a',
		'.widget_calendar tbody',
		'.widget a .fbq-widget-meta',
		'.widget a .fbq-widget-category'
	),
	'property' => array(
		'color' => 'primary_text'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.widget.widget_calendar a',
		'.widget_calendar thead'
	),
	'property' => array(
		'color' => 'secondary_text'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.widget a:hover',
		'.fbq-menu.link a',
		'.widget.widget_calendar tfoot a',
		'.widget .fbq-widget-viewall',
		'.fbq-widget-feature a'
	),
	'property' => array(
		'color' => 'primary_brand'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-menu.link a:hover',
		'.widget .fbq-widget-viewall:hover',
		'.fbq-widget-feature a:hover'
	),
	'property' => array(
		'color' => 'secondary_brand'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.tagcloud a',
	'property' => array(
		'background-color' => 'secondary_background'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.tagcloud a:hover',
		'.widget_calendar #today'
	),
	'property' => array(
		'color' => 'primary_brand_contrast',
		'background-color' => 'primary_brand'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.widget_calendar caption',
	'property' => array(
		'border-color' => 'primary_border'
	)
) ) );
?>
<?php /*=========================*/?>

<?php /*==========Entry==========*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-entry-title a:hover',
		'.fbq-entry-meta a:hover',
		'.fbq-relatedpost .fbq-entry:hover .fbq-entry-title'
	),
	'property' => array(
		'color' => 'primary_brand'
	)
) ) );
?>

.fbq-entry .more-link {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-entry .more-link:hover {
	color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}
<?php /*=========================*/?>

<?php /*========Utilities========*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-carousel-arrow',
	'property' => array(
		'color' => 'secondary_text_contrast',
		'background-color' => 'secondary_text',
	),
	'opacity' => 0.7,
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-carousel-arrow.transparent',
	'property' => array(
		'color' => 'secondary_text'
	),
	'parent' => 'slider'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar',
		'.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar',
		'.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar'
	),
	'property' => array(
		'background-color' => 'primary_border',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-filter-list > .active',
		'.fbq-filter-list > a:focus'
	),
	'property' => array(
		'color' => 'secondary_text',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-filter-list > .active:after',
	'property' => array(
		'background-color' => 'secondary_text',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-button--fill .btnx .fbq-bounce',
		'.fbq-button--border.fbq-button-hover--inverse .btnx:hover .fbq-bounce'
	),
	'property' => array(
		'background-color' => 'primary_brand_contrast',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.with-border',
	'property' => array(
		'border-color' => 'primary_border',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.page-numbers',
	'property' => array(
		'color' => 'primary_text',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.page-numbers:hover',
		'.page-numbers.next',
		'.page-numbers.prev',
		'.page-numbers.current'
	),
	'property' => array(
		'color' => 'primary_brand',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.page-numbers.next:hover',
		'.page-numbers.prev:hover'
	),
	'property' => array(
		'color' => 'secondary_brand',
	)
) ) );
?>
<?php /*=========================*/?>

<?php /*=======Navbar Menu=======*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-navbar-brand',
		'.fbq-navbar-social .fbq-icon-normal',
	),
	'property' => array(
		'color' => 'secondary_text',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-navbar-social .fbq-icon-normal.fbq-icon-fill',
		'.fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square'
	),
	'property' => array(
		'background-color' => 'secondary_text',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-navbar-social .fbq-icon-normal.fbq-icon-fill',
		'.fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square'
	),
	'property' => array(
		'color' => 'secondary_text_contrast',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-menu a',
		'.fbq-extra-menu a'
	),
	'property' => array(
		'color' => 'primary_text',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.sub-menu a',
		'.fbq-cart-box'
	),
	'property' => array(
		'color' => 'primary_text',
	),
	'parent' => 'navbar-dropdown'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'strong',
		'.fbq-mega-menu-title a',
		'.fbq-cart-box a',
		'.mini_cart_item > *'
	),
	'property' => array(
		'color' => 'secondary_text',
	),
	'parent' => 'navbar-dropdown'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-menu a:hover',
		'.fbq-extra-menu a:hover',
		'.fbq-navbar-social .fbq-icon-hover',
		'.current-menu-item > a',
		'.current-menu-parent > a',
		'.current-menu-ancestor > a'
	),
	'property' => array(
		'color' => 'primary_brand',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-mega-menu-title a:hover',
	'property' => array(
		'color' => 'secondary_text'
	),
	'parent' => 'navbar-dropdown'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-topnav-menu .sub-menu a:hover',
	'property' => array(
		'color' => 'primary_brand',
	),
	'parent' => 'navbar-dropdown'
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-navbar-social .fbq-icon-hover.fbq-icon-fill',
		'.fbq-navbar-social .fbq-icon-hover.fbq-icon-fill-square'
	),
	'property' => array(
		'background-color' => 'primary_brand',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-navbar-social .fbq-icon-hover.fbq-icon-fill',
		'.fbq-navbar-social .fbq-icon-hover.fbq-icon-fill-square'
	),
	'property' => array(
		'color' => 'primary_brand_contrast',
	)
) ) );
?>

.fbq-highlight-border .fbq-topnav-menu > .menu-item > a:hover:after,
.fbq-highlight-border .fbq-fullnav-menu .menu-item:not(.menu-item-has-children) > a:hover:after,
.fbq-highlight-border .fbq-sidenav-menu .menu-item:not(.menu-item-has-children) > a:hover:after,
.fbq-highlight-fill .fbq-topnav-menu > .menu-item > a:hover,
.fbq-highlight-fill .fbq-fullnav-menu .menu-item > a:hover,
.fbq-highlight-fill .fbq-sidenav-menu .menu-item > a:hover {
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-highlight-fill .fbq-topnav-menu > .menu-item > a:hover,
.fbq-highlight-fill .fbq-fullnav-menu .menu-item > a:hover,
.fbq-highlight-fill .fbq-sidenav-menu .menu-item > a:hover {
	color: <?php echo esc_attr( $args['primary_brand_contrast'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-lines',
		'.fbq-lines:before',
		'.fbq-lines:after'
	),
	'property' => array(
		'background-color' => 'secondary_text',
	)
) ) );
?>
<?php /*=========================*/?>

<?php /*=======Single Post=======*/?>
.fbq-triangle-border.up {
	border-bottom-color: <?php echo esc_attr( $args['primary_border'] ); ?>;
}
.fbq-post-meta a:hover {
	color: <?php echo esc_attr( $args['secondary_text'] ); ?>;
}
<?php /*=========================*/?>

<?php /*======Page Pre-load======*/?>
.fbq-loading--fading-circle .fbq-circle:before {
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-loading--ring {
	border-top-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}
<?php /*=========================*/?>

<?php /*====Unsolvable Color=====*/?>
<?php if ( 'light' === $args['default_color_scheme'] ) : ?>
select {
	background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
}

.fbq-dark-scheme select {
	background-image: url("data:image/svg+xml;utf8,<svg fill='white' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
}

.fbq-light-scheme select {
	background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
}

.fbq-showmore-button .fbq-overlay {
	background: linear-gradient(to bottom, transparent 0%, <?php echo esc_attr( $args['bp_color_5'] ); ?> 60%);
}

.fbq-dark-scheme .fbq-showmore-button .fbq-overlay {
	background: linear-gradient(to bottom, transparent 0%, <?php echo esc_attr( $args['bp_color_10'] ); ?> 60%);
}

.fbq-light-scheme .fbq-showmore-button .fbq-overlay {
	background: linear-gradient(to bottom, transparent 0%, <?php echo esc_attr( $args['bp_color_5'] ); ?> 60%);
}

.fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.fbq-dark-scheme .fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
}

.fbq-light-scheme .fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.tagcloud a:hover {
	box-shadow: 0 2px 6px rgba(0,0,0, 0.05);
}

.fbq-dark-scheme .tagcloud a:hover {
	box-shadow: 0 2px 6px rgba(0,0,0, 0.3);
}

.fbq-light-scheme .tagcloud a:hover {
	box-shadow: 0 2px 6px rgba(0,0,0, 0.05);
}

.fbq-with-shadow {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.fbq-dark-scheme .fbq-with-shadow {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}

.fbq-light-scheme .fbq-with-shadow {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.fbq-with-hover-shadow:hover {
	box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
}

.fbq-dark-scheme .fbq-with-hover-shadow:hover {
	box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2);
}

.fbq-light-scheme .fbq-with-hover-shadow:hover {
	box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
}

.woocommerce input.button:hover,
.woocommerce input.button:focus {
	background-color: #eee;
	border-color: #eee;
}
<?php else : ?>
select {
	background-image: url("data:image/svg+xml;utf8,<svg fill='white' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
}

.fbq-light-scheme select {
	background-image: url("data:image/svg+xml;utf8,<svg fill='white' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
}

.fbq-dark-scheme select {
	background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
}

.fbq-showmore-button .fbq-overlay {
	background: linear-gradient(to bottom, transparent 0%, <?php echo esc_attr( $args['bp_color_10'] ); ?> 60%);
}

.fbq-light-scheme .fbq-showmore-button .fbq-overlay {
	background: linear-gradient(to bottom, transparent 0%, <?php echo esc_attr( $args['bp_color_5'] ); ?> 60%);
}

.fbq-dark-scheme .fbq-showmore-button .fbq-overlay {
	background: linear-gradient(to bottom, transparent 0%, <?php echo esc_attr( $args['bp_color_10'] ); ?> 60%);
}

.fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
}

.fbq-light-scheme .fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.fbq-dark-scheme .fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
}

.tagcloud a:hover {
	box-shadow: 0 2px 6px rgba(0,0,0, 0.3);
}

.fbq-light-scheme .tagcloud a:hover {
	box-shadow: 0 2px 6px rgba(0,0,0, 0.05);
}

.fbq-dark-scheme .tagcloud a:hover {
	box-shadow: 0 2px 6px rgba(0,0,0, 0.3);
}

.fbq-with-shadow {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}

.fbq-light-scheme .fbq-with-shadow {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.fbq-dark-scheme .fbq-with-shadow {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}

.fbq-with-hover-shadow:hover {
	box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2);
}

.fbq-light-scheme .fbq-with-hover-shadow:hover {
	box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
}

.fbq-dark-scheme .fbq-with-hover-shadow:hover {
	box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2);
}

.woocommerce input.button:hover,
.woocommerce input.button:focus {
	background-color: #111;
	border-color: #111;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*===WooCommerce Color=====*/?>
<?php if ( fabrique_is_woocommerce_activated() ) : ?>

<?php /*======Shop Dropdown======*/?>
.fbq-dropdown-menu li.active a {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-dropdown-menu li:hover a {
	color: <?php echo esc_attr( $args['primary_brand_contrast'] ); ?>;
}

.fbq-dropdown-menu li:hover {
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-dropdown-display:focus,
.fbq-dropdown-display:hover {
	color: <?php echo esc_attr( $args['primary_brand_contrast'] ); ?>;
	border-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}
<?php /*=========================*/?>

.woocommerce .woocommerce-breadcrumb,
.woocommerce .woocommerce-title,
.woocommerce table.shop_attributes th,
.woocommerce [itemprop="author"],
.woocommerce .group_table .label a,
.select2-container .select2-choice,
.woocommerce table.shop_table td,
.woocommerce table.cart .product-name a,
.woocommerce table.woocommerce-checkout-review-order-table td.product-name,
.woocommerce table.woocommerce-checkout-review-order-table td.product-total,
.woocommerce table.woocommerce-checkout-review-order-table .order-total th,
.woocommerce table.woocommerce-checkout-review-order-table .order-total td,
.woocommerce .cart-collaterals .cart_totals table .order-total th,
.woocommerce-page .cart-collaterals .cart_totals table .order-total th,
.woocommerce-account .myaccount_user,
.woocommerce-account fieldset {
	color: <?php echo esc_attr( $args['secondary_text'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.woocommerce-variation-price',
		'.woocommerce div.product .product_title',
		'.woocommerce div.product p.price',
		'.woocommerce div.product span.price',
		'.woocommerce div.product p.price ins',
		'.woocommerce div.product span.price ins',
		'.woocommerce input.button:hover',
		'.woocommerce input.button:focus'
	),
	'property' => array(
		'color' => 'secondary_text',
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.widget_shopping_cart .total',
		'.woocommerce.widget_shopping_cart .total',
		'.woocommerce .widget_shopping_cart .total',
	),
	'property' => array(
		'color' => 'secondary_text',
	),
	'parent' => 'navbar-dropdown'
) ) );
?>

.woocommerce .woocommerce-breadcrumb a,
.woocommerce .woocommerce-breadcrumb span,
.woocommerce table.shop_table th,
.woocommerce table.woocommerce-checkout-review-order-table td,
.woocommerce table.woocommerce-checkout-review-order-table .shipping td label {
	color: <?php echo esc_attr( $args['primary_text'] ); ?>;
}

.select2-results li:hover {
	color: <?php echo esc_attr( $args['primary_brand_contrast'] ); ?>;
}

.woocommerce .group_table .label a:hover,
.woocommerce .comment-form-rating p.stars a:before,
.woocommerce table.cart .product-name a:hover,
.woocommerce .addresses .edit {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.woocommerce .star-rating span',
	'property' => array(
		'color' => 'primary_brand',
	)
) ) );
?>

.woocommerce .addresses .edit:hover {
	color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}

.woocommerce-cart .wc-proceed-to-checkout a.checkout-button.alt,
.woocommerce #add_payment_method #payment .button,
.woocommerce .woocommerce-checkout #payment .button,
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button.alt:hover,
.woocommerce #add_payment_method #payment .button:hover,
.woocommerce .woocommerce-checkout #payment .button:hover,
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button.alt:focus,
.woocommerce #add_payment_method #payment .button:focus,
.woocommerce .woocommerce-checkout #payment .button:focus {
	color: <?php echo esc_attr( $args['secondary_text_contrast'] ); ?>;
	background-color: <?php echo esc_attr( $args['secondary_text'] ); ?>;
	border-color: <?php echo esc_attr( $args['secondary_text'] ); ?>;
}

.woocommerce .select2-results {
	background-color: <?php echo esc_attr( $args['primary_background'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle',
	'property' => array(
		'background-color' => 'primary_background',
	)
) ) );
?>

.woocommerce table.shop_attributes th,
.woocommerce table.shop_attributes td,
.woocommerce .cart-collaterals .cart_totals,
.woocommerce-page .cart-collaterals .cart_totals,
.woocommerce-checkout .col-2,
.woocommerce form.login,
.woocommerce form.register {
	background-color: <?php echo esc_attr( $args['secondary_background'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.woocommerce input.button',
		'.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content',
		'.woocommerce .addresses > div'
	),
	'property' => array(
		'background-color' => 'secondary_background',
	)
) ) );
?>

.woocommerce-error,
.woocommerce-info,
.woocommerce-message {
	background-color: transparent;
	border: 1px solid <?php echo esc_attr( $args['primary_border'] ); ?>;
}

.select2-results li:hover {
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.woocommerce .widget_price_filter .ui-slider .ui-slider-range',
	'property' => array(
		'background-color' => 'primary_brand',
	)
) ) );
?>

.woocommerce #reviews #comments ol.commentlist li,
.select2-container .select2-choice,
.select2-container-active .select2-choice,
.select2-search,
.select2-drop-active,
.woocommerce table.shop_table td,
.woocommerce-cart table.cart td.actions .coupon .input-text,
.woocommerce form.checkout_coupon,
.woocommerce form.login h3,
.woocommerce form.register h3,
.woocommerce .addresses header,
.woocommerce .cart-collaterals .cart_totals tr td,
.woocommerce .cart-collaterals .cart_totals tr th,
.woocommerce-page .cart-collaterals .cart_totals tr td,
.woocommerce-page .cart-collaterals .cart_totals tr th {
	border-color: <?php echo esc_attr( $args['primary_border'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.woocommerce input.button',
		'.widget_shopping_cart .total',
		'.woocommerce.widget_shopping_cart .total',
		'.woocommerce .widget_shopping_cart .total',
		'.woocommerce .widget_price_filter .ui-slider .ui-slider-handle'
	),
	'property' => array(
		'border-color' => 'primary_border',
	)
) ) );
?>

.variations-radio input[type="radio"]:checked + .variations-radio-option,
.woocommerce-cart table.cart td.actions .coupon .input-text:focus,
.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link.is-active {
	border-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

<?php /*===WooCommerce Button====*/?>
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce .added_to_cart:hover,
.woocommerce-account input.button:hover {
	color: <?php echo esc_attr( $args['button_text_hover_color'] ); ?>;
	background-color: <?php echo esc_attr( $args['button_background_hover_color'] ); ?>;
	border-color: <?php echo esc_attr( $args['button_border_hover_color'] ); ?>;
}

.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce .added_to_cart,
.woocommerce-account input.button {
	<?php echo fabrique_s( $fonts[$args['button_typography']], false ); ?>
	border-radius: <?php echo esc_attr( $args['button_radius'] ); ?>px;
	border-width: <?php echo esc_attr( $args['button_border'] ); ?>px;
	border-color: <?php echo esc_attr( $args['button_border_color'] ); ?>;
	color: <?php echo esc_attr( $args['button_text_color'] ); ?>;
	background-color: <?php echo esc_attr( $args['button_background_color'] ); ?>;
<?php if ( $args['button_uppercase'] ) : ?>
	text-transform: uppercase;
<?php else : ?>
	text-transform: none;
<?php endif; ?>
}

.woocommerce input.button {
	<?php echo fabrique_s( $fonts[$args['button_typography']], false ); ?>
	border-radius: <?php echo esc_attr( $args['button_radius'] ); ?>px;
	border-width: <?php echo esc_attr( $args['button_border'] ); ?>px;
<?php if ( $args['button_uppercase'] ) : ?>
	text-transform: uppercase;
<?php else : ?>
	text-transform: none;
<?php endif; ?>
}

.woocommerce #respond input#submit.alt.disabled,
.woocommerce #respond input#submit.alt.disabled:hover,
.woocommerce #respond input#submit.alt:disabled,
.woocommerce #respond input#submit.alt:disabled:hover,
.woocommerce #respond input#submit.alt:disabled[disabled],
.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
.woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover,
.woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover,
.woocommerce a.button.alt:disabled[disabled],
.woocommerce a.button.alt:disabled[disabled]:hover,
.woocommerce button.button.alt.disabled,
.woocommerce button.button.alt.disabled:hover,
.woocommerce button.button.alt:disabled,
.woocommerce button.button.alt:disabled:hover,
.woocommerce button.button.alt:disabled[disabled],
.woocommerce button.button.alt:disabled[disabled]:hover,
.woocommerce input.button.alt.disabled,
.woocommerce input.button.alt.disabled:hover,
.woocommerce input.button.alt:disabled,
.woocommerce input.button.alt:disabled:hover,
.woocommerce input.button.alt:disabled[disabled],
.woocommerce input.button.alt:disabled[disabled]:hover {
	color: <?php echo esc_attr( $args['button_text_color'] ); ?>;
	background-color: <?php echo esc_attr( $args['button_background_color'] ); ?>;
}
<?php /*=========================*/?>

<?php /*==Product Detail Width==*/?>
.woocommerce #content div.product div.summary,
.woocommerce div.product div.summary,
.woocommerce-page #content div.product div.summary,
.woocommerce-page div.product div.summary {
	width: <?php echo esc_attr( $args['product_detail_width'] - 2 ); ?>%;
}

.woocommerce #content div.product div.images,
.woocommerce div.product div.images,
.woocommerce-page #content div.product div.images,
.woocommerce-page div.product div.images {
	width: <?php echo esc_attr( 96 - $args['product_detail_width'] ); ?>%;
}

@media only screen and (max-width: 768px) {
	.woocommerce #content div.product div.summary,
	.woocommerce div.product div.summary,
	.woocommerce-page #content div.product div.summary,
	.woocommerce-page div.product div.summary,
	.woocommerce #content div.product div.images,
	.woocommerce div.product div.images,
	.woocommerce-page #content div.product div.images,
	.woocommerce-page div.product div.images {
		width: 100%;
	}
}
<?php /*=========================*/?>

<?php /*=== Shop spacing ===*/?>
.fbq-main > .fbq-shop .fbq-entries-content {
	margin-right: <?php echo esc_attr( -$args['shop_spacing']/2 ); ?>px;
	margin-left: <?php echo esc_attr( -$args['shop_spacing']/2 ); ?>px;
}
<?php /*=========================*/?>
<?php endif; //end WooCommerce activate condition ?>
<?php /*=========================*/?>

<?php /*=======Navbar Scheme=====*/?>
<?php
	$light_menu_color = $args['bp_color_4'];
	$light_menu_contrast_color = fabrique_contrast_color( $args['bp_color_4'] );
	$dark_menu_color = $args['bp_color_9'];
	$dark_menu_contrast_color = fabrique_contrast_color( $args['bp_color_9'] );

	if ( 'light' === $args['navbar_color_scheme'] ) {
		$navbar_menu_color = $light_menu_color;
	} elseif ( 'dark' === $args['navbar_color_scheme'] ) {
		$navbar_menu_color = $dark_menu_color;
	}
?>

.fbq-navbar-inner.fbq-light-scheme,
nav.fbq-navbar--alternate > .fbq-light-scheme {
	background-color: <?php echo esc_attr( $args['bp_color_5'] ); ?>;
	border-color: <?php echo esc_attr( $args['bp_color_7'] ); ?>;
}

.fbq-navbar-inner.fbq-dark-scheme,
nav.fbq-navbar--alternate > .fbq-dark-scheme {
	background-color: <?php echo esc_attr( $args['bp_color_10'] ); ?>;
	border-color: <?php echo esc_attr( $args['bp_color_12'] ); ?>;
}

nav.fbq-navbar--alternate .fbq-topnav-menu > .menu-item > a,
nav.fbq-navbar--alternate .fbq-extra-menu a,
nav.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-normal {
	color: <?php echo esc_attr( $navbar_menu_color ); ?>;
}

nav.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill,
nav.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square {
	background-color: <?php echo esc_attr( $navbar_menu_color ); ?>;
	color: <?php echo esc_attr( fabrique_contrast_color( $navbar_menu_color ) ); ?>;
}

nav.fbq-navbar--alternate .fbq-lines,
nav.fbq-navbar--alternate .fbq-lines:before,
nav.fbq-navbar--alternate .fbq-lines:after {
	background-color: <?php echo esc_attr( $navbar_menu_color ); ?>;
}
<?php /*=========================*/?>

<?php /*=======Navbar Light Scheme=====*/?>
.fbq-navbar--light .fbq-navbar-inner,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-navbar-inner {
	border-color: <?php echo esc_attr( $args['bp_color_7'] ); ?>;
}

.fbq-navbar--light:not(.fbq-navbar--alternate):not(.fbq-side-navbar) .fbq-navbar-logo--text,
.fbq-navbar--light .fbq-topnav-menu > .menu-item > a,
.fbq-navbar--light .fbq-extra-menu a,
.fbq-navbar--light .fbq-navbar-social .fbq-icon-normal,
.fbq-navbar--light .fbq-side-navbar-nav .fbq-navbar-logo--text,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-navbar-logo--text,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-topnav-menu > .menu-item > a,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-extra-menu a,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-navbar-social .fbq-icon-normal {
	color: <?php echo esc_attr( $light_menu_color ); ?>;
}

.fbq-navbar--light .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill,
.fbq-navbar--light .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square {
	background-color: <?php echo esc_attr( $light_menu_color ); ?>;
	color: <?php echo esc_attr( $light_menu_contrast_color ); ?>;
}

.fbq-navbar--light .fbq-lines,
.fbq-navbar--light .fbq-lines:before,
.fbq-navbar--light .fbq-lines:after,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-lines,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-lines:before,
.fbq-navbar--alternate.fbq-navbar--light.fixed-transparent .fbq-lines:after {
	background-color: <?php echo esc_attr( $light_menu_color ); ?>;
}
<?php /*=========================*/?>

<?php /*=======Navbar Dark Scheme=====*/?>
.fbq-navbar--dark .fbq-navbar-inner,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-navbar-inner {
	border-color: <?php echo esc_attr( $args['bp_color_12'] ); ?>;
}

.fbq-navbar--dark:not(.fbq-navbar--alternate):not(.fbq-side-navbar) .fbq-navbar-logo--text,
.fbq-navbar--dark .fbq-topnav-menu > .menu-item > a,
.fbq-navbar--dark .fbq-extra-menu a,
.fbq-navbar--dark .fbq-navbar-social .fbq-icon-normal,
.fbq-navbar--dark .fbq-side-navbar-nav .fbq-navbar-logo--text,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-navbar-logo--text,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-topnav-menu > .menu-item > a,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-extra-menu a,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-navbar-social .fbq-icon-normal {
	color: <?php echo esc_attr( $dark_menu_color ); ?>;
}

.fbq-navbar--dark .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill,
.fbq-navbar--dark .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square {
	background-color: <?php echo esc_attr( $dark_menu_color ); ?>;
	color: <?php echo esc_attr( $dark_menu_contrast_color ); ?>;
}

.fbq-navbar--dark .fbq-lines,
.fbq-navbar--dark .fbq-lines:before,
.fbq-navbar--dark .fbq-lines:after,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-lines,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-lines:before,
.fbq-navbar--alternate.fbq-navbar--dark.fixed-transparent .fbq-lines:after {
	background-color: <?php echo esc_attr( $dark_menu_color ); ?>;
}
<?php /*=========================*/?>

<?php /*=======Navbar Brand Scheme=====*/?>
.fbq-navbar--light .fbq-topnav-menu > .menu-item > a:hover,
.fbq-navbar--dark .fbq-topnav-menu > .menu-item > a:hover,
.fbq-navbar--light.fbq-navbar--alternate.fixed-transparent .fbq-topnav-menu > .menu-item > a:hover,
.fbq-navbar--dark.fbq-navbar--alternate.fixed-transparent .fbq-topnav-menu > .menu-item > a:hover {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}
<?php /*=========================*/?>

<?php /*=====Dropdown Scheme=====*/?>
.fbq-navbar-dropdown-light-scheme .sub-menu,
.fbq-navbar-dropdown-light-scheme .fbq-mega-menu-bg,
.fbq-navbar-dropdown-light-scheme .fbq-cart-box {
	background-color: <?php echo esc_attr( $args['bp_color_6'] ); ?>;
}

.fbq-navbar-dropdown-dark-scheme .sub-menu,
.fbq-navbar-dropdown-dark-scheme .fbq-mega-menu-bg,
.fbq-navbar-dropdown-dark-scheme .fbq-cart-box {
	background-color: <?php echo esc_attr( $args['bp_color_11'] ); ?>;
}
<?php /*=========================*/?>

<?php /*=======Topbar Scheme=====*/?>
<?php
	if ( 'light' === $args['topbar_color_scheme'] ) {
		$topbar_secondary_bg = $args['bp_color_6'];
		$topbar_primary_border = $args['bp_color_7'];
	} elseif ( 'dark' === $args['topbar_color_scheme'] ) {
		$topbar_secondary_bg = $args['bp_color_11'];
		$topbar_primary_border = $args['bp_color_12'];
	}
?>
.fbq-topbar {
	background-color: <?php echo esc_attr( $topbar_secondary_bg ); ?>;
	border-color: <?php echo esc_attr( $topbar_primary_border ); ?>;
}
<?php /*=========================*/?>

<?php /*==Header Widgets Scheme==*/?>
<?php
	if ( 'light' === $args['header_widget_color_scheme'] ) {
		$headerwidget_primary_bg = $args['bp_color_6'];
	} elseif ( 'dark' === $args['header_widget_color_scheme'] ) {
		$headerwidget_primary_bg = $args['bp_color_11'];
	}
?>
.fbq-header-widgets {
	background-color: <?php echo esc_attr( $headerwidget_primary_bg ); ?>;
}
<?php /*=========================*/?>

<?php /*=Offcanvas Cursor Image=*/?>
<?php if ( !empty( $args['navbar_offcanvas_cursor'] ) ) : ?>
.fbq-offcanvas-overlay {
	cursor: url('<?php echo esc_url( $args['navbar_offcanvas_cursor'] ); ?>'), crosshair;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=======Logo Width========*/?>
img.fbq-navbar-logo--image {
	max-width: <?php echo esc_attr( $args['logo_width'] ); ?>px;
}

.fbq-navbar--inline .fbq-navbar-body-inner:first-child {
	padding-right: <?php echo esc_attr( $args['logo_width'] / 2 + 40 ); ?>px;
}

.fbq-navbar--inline .fbq-navbar-body-inner:last-child {
	padding-left: <?php echo esc_attr( $args['logo_width'] / 2 + 40 ); ?>px;
}
<?php /*=========================*/?>

<?php /*=====Logo Typography=====*/?>
.fbq-navbar-brand {
	<?php echo fabrique_s( $fonts[$args['logo_typography']], false ); ?>
}
<?php /*=========================*/?>

<?php /*=====Logo Font Color=====*/?>
<?php if ( 'default' !== $args['logo_font_color'] ) : ?>
.fbq-navbar-brand > .fbq-navbar-logo--text {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['logo_font_color'], $args ) ); ?> !important;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*======Logo Font Size=====*/?>
.fbq-navbar-brand {
	font-size: <?php echo esc_attr( $args['logo_font_size'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*===Logo Letter Spacing===*/?>
<?php if ( '0' === $args['logo_letter_spacing'] ) : ?>
.fbq-navbar-brand {
	letter-spacing: 0;
}
<?php elseif ( !empty( $args['logo_letter_spacing'] ) ) : ?>
.fbq-navbar-brand {
	letter-spacing: <?php echo esc_attr( $args['logo_letter_spacing'] ); ?>em;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Fixed Navbar Logo Width=*/?>
.fbq-navbar-brand img.fbq-fixed-nav-logo {
	max-width: <?php echo esc_attr( $args['fixed_navbar_logo_width'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*=======Mobile Logo Width========*/?>
.fbq-navbar--mobile img.fbq-navbar-logo--image,
.fbq-navbar--mobile img.fbq-fixed-nav-logo {
	max-width: <?php echo esc_attr( $args['mobile_navbar_logo_width'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*=======Frame Color=======*/?>
<?php if ( 'default' !== $args['frame_color'] ) : ?>
.fbq-frame {
	background-color: <?php echo fabrique_customizer_get_color( $args['frame_color'], $args ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=======Frame Width=======*/?>
.fbq-layout--frame {
	padding: <?php echo esc_attr( $args['frame_width'] ); ?>px;
}

.fbq-layout--frame:not(.header-on-frame) .fbq-navbar--fixed {
	top: <?php echo esc_attr( $args['frame_width'] ); ?>px;
}

.fbq-frame--top,
.fbq-frame--bottom {
	height: <?php echo esc_attr( $args['frame_width'] ); ?>px;
}

.fbq-frame--left,
.fbq-frame--right {
	width: <?php echo esc_attr( $args['frame_width'] ); ?>px;
}

.fbq-layout--frame .fbq-side-navbar {
	top: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
	bottom: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
}

.fbq-layout--frame .fbq-side-navbar--left {
	left: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
}

.fbq-layout--frame .fbq-side-navbar--right {
	right: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
}

.fbq-layout--frame .fbq-navbar--fixed {
	right: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
	left: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
}

.fbq-layout--frame .fbq-collapsed-menu--offcanvas {
	top: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
	right: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
	bottom: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
}

.fbq-layout--frame .fbq-wrapper--parallax-footer .fbq-footer {
	padding-left: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
	padding-right: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
	margin-bottom: <?php echo esc_attr( (int)$args['frame_width'] ); ?>px;
}

.fbq-layout--frame.fbq-layout--sidenav-fixed .fbq-wrapper--parallax-footer .fbq-footer {
	max-width: 70%;
	max-width: calc( 100% - <?php echo esc_attr( 280 + $args['frame_width'] * 2 ); ?>px );
}

.fbq-layout--frame.fbq-layout--sidenav-full .fbq-wrapper--parallax-footer .fbq-footer {
	max-width: 87%;
	max-width: calc( 100% - <?php echo esc_attr( 80 + $args['frame_width'] * 2 ); ?>px );
}

.fbq-layout--frame.fbq-layout--sidenav-minimal .fbq-wrapper--parallax-footer .fbq-footer {
	max-width: 95%;
	max-width: calc( 100% - <?php echo esc_attr( $args['frame_width'] * 2 ); ?>px );
}
<?php /*=========================*/?>

<?php /*====Content Max Width====*/?>
.fbq-layout--wide .fbq-container,
.fbq-layout--frame .fbq-container {
	max-width: <?php echo esc_attr( (int)$args['content_max_width'] + 200 ); ?>px;
	max-width: calc( <?php echo esc_attr( $args['content_max_width'] . "px + " . $args['side_padding'] . "%" ); ?> );
}

.fbq-post-media .fbq-quote-text,
.fbq-layout--boxed .fbq-wrapper {
	max-width: <?php echo esc_attr( (int)$args['content_max_width'] ); ?>px;
}

<?php /*=======mega menu background======*/?>
@media only screen and (min-width: <?php echo esc_attr( (int)$args['content_max_width']*100/(100 - (int)$args['side_padding']) + 1 ); ?>px ) {
	.fbq-container .fbq-mega-menu-bg {
		margin-right: calc( <?php echo esc_attr( $args['content_max_width']/2 . "px" ); ?> - 50vw );
		margin-left: calc( <?php echo esc_attr( $args['content_max_width']/2 . "px" ); ?> - 50vw );
	}
}

@media only screen and (max-width: <?php echo esc_attr( (int)$args['content_max_width']*100/(100 - (int)$args['side_padding']) ); ?>px ) {
	.fbq-container .fbq-mega-menu-bg {
		margin-right: <?php echo esc_attr( -(int)$args['side_padding']/2 ); ?>vw;
		margin-left: <?php echo esc_attr( -(int)$args['side_padding']/2 ); ?>vw;
	}
}
<?php /*=========================*/?>

@media only screen and (min-width: <?php echo esc_attr( (int)$args['content_max_width'] ); ?>px ) {
	.fbq-layout--boxed .fbq-side-navbar--left {
		left: calc( 50% - <?php echo esc_attr( (int)$args['content_max_width'] / 2 ); ?>px );
	}

	.fbq-layout--boxed .fbq-side-navbar--right {
		right: calc( 50% - <?php echo esc_attr( (int)$args['content_max_width'] / 2 ); ?>px );
	}

	.fbq-layout--boxed .fbq-side-navbar--minimal.fbq-side-navbar--left .fbq-side-navbar-nav {
		left: calc( 50% - <?php echo esc_attr( (int)$args['content_max_width'] / 2 - 30 ); ?>px );
	}

	.fbq-layout--boxed .fbq-side-navbar--minimal.fbq-side-navbar--right .fbq-side-navbar-nav {
		right: calc( 50% - <?php echo esc_attr( (int)$args['content_max_width'] / 2 - 30 ); ?>px );
	}

	.fbq-layout--boxed .fbq-navbar--fixed {
		left: calc( 50% - <?php echo esc_attr( $args['content_max_width'] / 2 ); ?>px );
		max-width: <?php echo esc_attr( (int)$args['content_max_width'] ); ?>px;
	}

	.fbq-layout--boxed .fbq-wrapper--parallax-footer .fbq-footer {
		max-width: <?php echo esc_attr( (int)$args['content_max_width'] ); ?>px;
	}

	.fbq-layout--boxed.fbq-layout--sidenav-full .fbq-wrapper--parallax-footer .fbq-footer {
		max-width: <?php echo esc_attr( (int)$args['content_max_width'] - 80 ); ?>px;
	}

	.fbq-layout--boxed.fbq-layout--sidenav-fixed .fbq-wrapper--parallax-footer .fbq-footer {
		max-width: <?php echo esc_attr( (int)$args['content_max_width'] - 280 ); ?>px;
	}
}
<?php /*=========================*/?>

<?php /*=======Side Padding======*/?>
.fbq-container {
	padding-right: <?php echo esc_attr( (int)$args['side_padding'] / 2 ); ?>%;
	padding-left: <?php echo esc_attr( (int)$args['side_padding'] / 2 ); ?>%;
}
<?php /*=========================*/?>

<?php /*======Sidebar Width======*/?>
.fbq-main {
	width: <?php echo esc_attr( (100 - (int)$args['sidebar_width']) ); ?>%;
}

.fbq-sidebar {
	width: <?php echo esc_attr( (int)$args['sidebar_width'] ); ?>%;
}
<?php /*=========================*/?>

<?php /*===Sidebar Top Padding===*/?>
.fbq-sidebar,
.fbq-main.blueprint-inactive {
	padding-top: <?php echo esc_attr( $args['sidebar_top_padding'] ); ?>px;
	padding-bottom: <?php echo esc_attr( $args['sidebar_top_padding'] ); ?>px;
}

<?php if ( $args['product_sidebar'] ) : ?>
.fbq-main.fbq-single-product {
	padding-top: <?php echo esc_attr( $args['sidebar_top_padding'] ); ?>px;
	padding-bottom: <?php echo esc_attr( $args['sidebar_top_padding'] ); ?>px;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Sidebar Background Color*/?>
<?php if ( 'default' !== $args['sidebar_background_color'] ) : ?>
.fbq-sidebar > .fbq-sidebar-background {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['sidebar_background_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Content Background Color*/?>
<?php if ( 'default' !== $args['content_background_color'] ) : ?>
.fbq-wrapper {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['content_background_color'], $args ) ); ?>;
}

.fbq-wrapper--parallax-footer .fbq-content {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['content_background_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Content Background Image*/?>
<?php if ( !empty( $args['content_background_image'] ) ) : ?>
.fbq-wrapper,
.fbq-wrapper--parallax-footer .fbq-content {
	<?php echo fabrique_get_background_image( array(
		'url' => $args['content_background_image'],
		'size' => $args['content_background_size'],
		'position' => $args['content_background_position'],
		'repeat' => $args['content_background_repeat'],
		'fixed' => $args['content_background_attachment']
	) ); ?>
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Body Background Color==*/?>
<?php if ( 'default' !== $args['body_background_color'] ) : ?>
.fbq-layout--boxed {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['body_background_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Body Background Image==*/?>
<?php if ( !empty( $args['body_background_image'] ) ) : ?>
.fbq-layout--boxed {
	<?php echo fabrique_get_background_image( array(
		'url' => $args['body_background_image'],
		'size' => $args['body_background_size'],
		'position' => $args['body_background_position'],
		'repeat' => $args['body_background_repeat'],
		'fixed' => $args['body_background_attachment']
	) ); ?>
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=======Boxed Shadow======*/?>
<?php if ( !empty( $args['boxed_shadow'] ) ): ?>
.fbq-layout--boxed .fbq-wrapper {
	box-shadow: <?php echo esc_attr( $args['boxed_shadow'] ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Design Typography====*/?>
body {
	<?php echo fabrique_s( $fonts[$args['style_typography']], false ); ?>
	font-size: <?php echo esc_attr( (int)$args['style_font_size'] ); ?>px;
<?php if ( !empty( $args['style_line_height'] ) ) : ?>
	line-height: <?php echo esc_attr( $args['style_line_height'] ); ?>;
<?php endif; ?>
}

select,
textarea,
input,
.fbq-banner-content-inner,
.fbq-section-wrapper,
.fbq-box-content {
	font-size: <?php echo esc_attr( (int)$args['style_font_size'] ); ?>px;
	line-height: <?php echo esc_attr( $args['style_line_height'] ); ?>;
}

.fbq-modal-wrapper,
.fbq-interactive-content {
	line-height: <?php echo esc_attr( $args['style_line_height'] ); ?>;
}
<?php /*=========================*/?>

<?php /*=====Design Heading======*/?>
h1 {
	font-size: <?php echo esc_attr( $args['heading_size_h1'] ); ?>px;
}

h2 {
	font-size: <?php echo esc_attr( $args['heading_size_h2'] ); ?>px;
}

h3 {
	font-size: <?php echo esc_attr( $args['heading_size_h3'] ); ?>px;
}

h4 {
	font-size: <?php echo esc_attr( $args['heading_size_h4'] ); ?>px;
}

h5 {
	font-size: <?php echo esc_attr( $args['heading_size_h5'] ); ?>px;
}

h6 {
	font-size: <?php echo esc_attr( $args['heading_size_h6'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*=======Design Button=====*/?>
button,
input[type=button],
input[type=submit],
.btnx {
	<?php echo fabrique_s( $fonts[$args['button_typography']], false ); ?>
<?php if ( $args['button_uppercase'] ) : ?>
	text-transform: uppercase;
<?php else : ?>
	text-transform: none;
<?php endif; ?>
}

button,
input[type=button],
input[type=submit] {
	padding: <?php echo esc_attr( $args['button_padding'] ); ?>;
	border-radius: <?php echo esc_attr( $args['button_radius'] ); ?>px;
	border-width: <?php echo esc_attr( $args['button_border'] ); ?>px;
	color: <?php echo esc_attr( $args['button_text_color'] ); ?>;
	background-color: <?php echo esc_attr( $args['button_background_color'] ); ?>;
	border-color: <?php echo esc_attr( $args['button_border_color'] ); ?>;
}

.fbq-button > .btnx {
	border-radius: <?php echo esc_attr( $args['button_radius'] ); ?>px;
	border-width: <?php echo esc_attr( $args['button_border'] ); ?>px;
}

button:hover,
input[type=button]:hover,
input[type=submit]:hover,
button:focus,
input[type=button]:focus,
input[type=submit]:focus {
	color: <?php echo esc_attr( $args['button_text_hover_color'] ); ?>;
	background-color: <?php echo esc_attr( $args['button_background_hover_color'] ); ?>;
	border-color: <?php echo esc_attr( $args['button_border_hover_color'] ); ?>;
}
<?php /*=========================*/?>

<?php /*==========Preload========*/?>
<?php if ( 'default' !== $args['preload_background_color'] ) : ?>
.fbq-page-load {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['preload_background_color'], $args ) ); ?>;
}
<?php endif; ?>

.fbq-loading img {
	max-width: <?php echo esc_attr( $args['preload_logo_width'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*=Back To Top Background==*/?>
<?php if ( 'default' !== $args['back_to_top_background_color'] ) : ?>
.fbq-back-to-top-background {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['back_to_top_background_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Back To Top Arrow====*/?>
<?php if ( 'default' !== $args['back_to_top_arrow_color'] ) : ?>
.fbq-back-to-top {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['back_to_top_arrow_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*===Form Style===*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'select[disabled]',
		'select[readonly]',
		'select fieldset[disabled]',
		'textarea[disabled]',
		'textarea[readonly]',
		'textarea fieldset[disabled]',
		'input[disabled]',
		'input[readonly]',
		'input fieldset[disabled]'
	),
	'property' => array(
		'color' => 'secondary_text',
		'background-color' => 'secondary_background'
	),
	'opacity' => 0.5
) ) );
?>

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'input',
		'textarea',
		'select'
	),
	'property' => array(
		'color' => 'secondary_text',
		'border-color' => 'primary_border'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'input:focus',
		'textarea:focus',
		'select:focus',
		'.picker__input.picker__input--active'
	),
	'property' => array(
		'border-color' => 'primary_brand'
	)
) ) );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-contactform--fill input',
		'.fbq-contactform--fill textarea',
		'.fbq-contactform--fill select'
	),
	'property' => array(
		'background-color' => 'secondary_background'
	)
) ) );
?>
<?php /*=========================*/?>

<?php /*======Navbar Height======*/?>
<?php $content_padding_top = fabrique_get_header_height( $args['logo'] ); ?>
<?php $stacked_content_padding_top = fabrique_get_header_height( $args['logo'], 'top', 'stacked' ); ?>
<?php if ( $args['navbar_stacked_overlap'] ) : ?>
	<?php $stacked_content_padding_top = $stacked_content_padding_top - $args['navbar_stacked_lineheight']/2; ?>
<?php endif; ?>
<?php $sidenav_padding_top = ( $args['topbar'] ) ? ( $args['topbar_height'] ) : 0; ?>

.fbq-navbar--custom {
	height: <?php echo esc_attr( (int)$args['navbar_height'] ); ?>px;
	line-height: <?php echo esc_attr( (int)$args['navbar_height'] ); ?>px;
}

.fbq-content-wrapper,
.fbq-wrapper--header-transparent .fbq-content-wrapper > .fbq-page-title {
	padding-top: <?php echo esc_attr( $content_padding_top ); ?>px;
}

.fbq-layout--topnav-stacked .fbq-content-wrapper,
.fbq-layout--topnav-stacked .fbq-wrapper--header-transparent .fbq-content-wrapper > .fbq-page-title {
	padding-top: <?php echo esc_attr( $stacked_content_padding_top ); ?>px;
}

.fbq-layout--sidenav .fbq-content-wrapper,
.fbq-layout--sidenav .fbq-wrapper--header-transparent .fbq-content-wrapper > .fbq-page-title {
	padding-top: <?php echo esc_attr( $sidenav_padding_top ); ?>px;
}

.fbq-wrapper--header-transparent .fbq-post-featured--fullwidth .fbq-page-title {
	top: <?php echo esc_attr( $content_padding_top ); ?>px;
}

.fbq-layout--topnav-stacked .fbq-wrapper--header-transparent .fbq-post-featured--fullwidth .fbq-page-title {
	top: <?php echo esc_attr( $stacked_content_padding_top ); ?>px;
}

.fbq-layout--sidenav .fbq-wrapper--header-transparent .fbq-post-featured--fullwidth .fbq-page-title {
	top: <?php echo esc_attr( $sidenav_padding_top ); ?>px;
}
<?php /*=========================*/?>

<?php /*===Navbar Stacked Line Height====*/?>
.fbq-navbar--stacked .fbq-navbar-content,
.fbq-navbar--stacked.fbq-navbar--fixed .fbq-navbar-header {
	height: <?php echo esc_attr( (int)$args['navbar_stacked_lineheight'] ); ?>px;
	line-height: <?php echo esc_attr( (int)$args['navbar_stacked_lineheight'] ); ?>px;
}

.fbq-navbar--stacked.overlap .fbq-navbar-content {
	bottom: -<?php echo esc_attr( (int)$args['navbar_stacked_lineheight']/2 ); ?>px;
	margin-top: -<?php echo esc_attr( (int)$args['navbar_stacked_lineheight']/2 ); ?>px;
}

.fbq-navbar--stacked.overlap .fbq-navbar-search {
	padding-top: <?php echo esc_attr( 15 + (int)$args['navbar_stacked_lineheight']/2 ); ?>px;
}

.fbq-navbar--stacked.overlap .fbq-navbar-widget > .btnx {
	padding-right: <?php echo esc_attr( (int)$args['navbar_stacked_lineheight']*0.6 ); ?>px;
	padding-left: <?php echo esc_attr( (int)$args['navbar_stacked_lineheight']*0.6 ); ?>px;
}

@media only screen and (min-width: 961px) {
	.woocommerce.fbq-layout--topnav-stacked-overlap .woocommerce-breadcrumb,
	.fbq-layout--topnav-stacked-overlap .fbq-page-title--top .fbq-page-title-breadcrumb {
		padding-top: <?php echo esc_attr( 10 + (int)$args['navbar_stacked_lineheight']/2 ); ?>px;
	}
}
<?php /*=========================*/?>

<?php /*===Navbar Stacked Header Background Color====*/?>
<?php if ( 'default' !== $args['navbar_stacked_background_color'] ) : ?>
.fbq-navbar--stacked:not(.overlap) .fbq-navbar-content,
.fbq-navbar--stacked.overlap .fbq-navbar-content-inner,
.fbq-navbar--stacked + .fbq-navbar--mobile .fbq-navbar-inner {
	background-color: <?php echo fabrique_hex_to_rgba( $args['navbar_stacked_background_color'], $args['navbar_stacked_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*===Navbar Menu Border====*/?>
.fbq-navbar .fbq-navbar-inner,
.fbq-navbar--mobile .fbq-navbar-inner {
	border-bottom-width: <?php echo esc_attr( $args['navbar_menu_border_thickness'] ); ?>px;
}

.fbq-topnav-menu > li > .fbq-mega-menu,
.fbq-topnav-menu > li > .sub-menu {
	margin-top: <?php echo esc_attr( $args['navbar_menu_border_thickness'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*=Navbar Menu Border Color*/?>
<?php if ( 'default' !== $args['navbar_menu_border_color'] ) : ?>
.fbq-navbar .fbq-navbar-inner,
.fbq-navbar--mobile .fbq-navbar-inner {
	border-bottom-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_menu_border_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Navbar Logo Offset===*/?>
<?php if ( is_numeric( $args['navbar_logo_offset_top'] ) ) : ?>
.fbq-navbar:not(.fbq-navbar--alternate) .fbq-navbar-header {
	vertical-align: top;
	line-height: 1;
}

.fbq-navbar:not(.fbq-navbar--stacked):not(.fbq-navbar--alternate) .fbq-navbar-brand {
	margin-top: <?php echo esc_attr( (int)$args['navbar_logo_offset_top'] ); ?>px;
}
<?php endif; ?>

<?php if ( is_numeric( $args['navbar_stacked_logo_offset_top'] ) ) : ?>
.fbq-navbar--stacked:not(.fbq-navbar--alternate) .fbq-navbar-brand {
	margin-top: <?php echo esc_attr( (int)$args['navbar_stacked_logo_offset_top'] ); ?>px;
}
<?php endif; ?>

<?php if ( is_numeric( $args['sidenav_logo_offset_top'] ) ) : ?>
.fbq-side-navbar .fbq-navbar-header .fbq-navbar-brand {
	margin-top: <?php echo esc_attr( (int)$args['sidenav_logo_offset_top'] ); ?>px;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Navbar Menu Offset===*/?>
<?php if ( is_numeric( $args['navbar_menu_offset_top'] ) ) : ?>
.fbq-navbar:not(.fbq-navbar--stacked):not(.fbq-navbar--alternate) .fbq-topnav-menu > li > a,
.fbq-navbar:not(.fbq-navbar--stacked):not(.fbq-navbar--alternate) .fbq-extra-menu > li > a,
.fbq-navbar:not(.fbq-navbar--stacked):not(.fbq-navbar--alternate) .fbq-collapsed-button,
.fbq-navbar:not(.fbq-navbar--stacked):not(.fbq-navbar--alternate) .fbq-navbar-footer {
	padding-top: <?php echo esc_attr( (int)$args['navbar_menu_offset_top'] ); ?>px;
	line-height: 1;
}
<?php endif; ?>

<?php if ( is_numeric( $args['navbar_stacked_menu_offset_top'] ) ) : ?>
.fbq-navbar--stacked:not(.fbq-navbar--alternate) .fbq-navbar-brand {
	margin-bottom: <?php echo esc_attr( (int)$args['navbar_stacked_menu_offset_top'] ); ?>px;
}
<?php endif; ?>

<?php if ( is_numeric( $args['sidenav_menu_offset_top'] ) ) : ?>
.fbq-side-navbar .fbq-navbar-header .fbq-navbar-brand {
	margin-bottom: <?php echo esc_attr( (int)$args['sidenav_menu_offset_top'] ); ?>px;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*===Mega Menu Separator===*/?>
<?php if ( $args['mega_menu_separator'] ) : ?>
.fbq-topnav-menu .fbq-mega-menu-column {
	border-right-width: 1px;
	border-right-style: solid;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Navbar Background Color=*/?>
<?php if ( 'default' !== $args['navbar_background_color'] ) : ?>
.fbq-navbar .fbq-navbar-inner,
.fbq-navbar--mobile .fbq-navbar-inner {
	background-color: <?php echo fabrique_hex_to_rgba( $args['navbar_background_color'], $args['navbar_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Navbar Menu Color====*/?>
<?php if ( 'default' !== $args['navbar_menu_color'] ) : ?>
.fbq-navbar .fbq-topnav-menu > .menu-item > a,
.fbq-navbar .fbq-extra-menu a,
.fbq-navbar .fbq-navbar-social .fbq-icon-normal,
.fbq-navbar--mobile .fbq-navbar-social .fbq-icon-normal {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_menu_color'], $args ) ); ?>;
}

.fbq-navbar .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill,
.fbq-navbar .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square,
.fbq-navbar--mobile .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill,
.fbq-navbar--mobile .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_menu_color'], $args ) ); ?>;
	color: <?php echo esc_attr( fabrique_contrast_color( $args['navbar_menu_color'] ) ); ?>;
}

.fbq-navbar .fbq-lines,
.fbq-navbar .fbq-lines:before,
.fbq-navbar .fbq-lines:after,
.fbq-navbar--mobile .fbq-lines,
.fbq-navbar--mobile .fbq-lines:before,
.fbq-navbar--mobile .fbq-lines:after {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_menu_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Navbar Menu Active Color*/?>
.fbq-sidenav-menu .current-menu-parent .fbq-mega-menu-title a,
.fbq-fullnav-menu .current-menu-parent .fbq-mega-menu-title a,
.fbq-classicnav-menu .current-menu-parent .fbq-mega-menu-title a,
.fbq-navbar--light .fbq-topnav-menu > .current-menu-ancestor > a,
.fbq-navbar--light .fbq-topnav-menu > .current-menu-parent > a,
.fbq-navbar--light .fbq-topnav-menu > .current-menu-item > a,
.fbq-navbar--dark .fbq-topnav-menu > .current-menu-ancestor > a,
.fbq-navbar--dark .fbq-topnav-menu > .current-menu-parent > a,
.fbq-navbar--dark .fbq-topnav-menu > .current-menu-item > a {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

<?php if ( 'default' !== $args['navbar_menu_active_color'] ) : ?>
.fbq-navbar .fbq-topnav-menu > .current-menu-item > a,
.fbq-navbar .fbq-topnav-menu > .current-menu-parent > a,
.fbq-navbar .fbq-topnav-menu > .current-menu-ancestor > a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_menu_active_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Navbar Menu Hover Color*/?>
<?php if ( 'default' !== $args['navbar_menu_hover_color'] ) : ?>
.fbq-navbar .fbq-topnav-menu > .menu-item > a:hover,
.fbq-navbar .fbq-extra-menu a:hover,
.fbq-navbar .fbq-navbar-social .fbq-icon-hover,
.fbq-navbar--mobile .fbq-navbar-social .fbq-icon-hover {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_menu_hover_color'], $args ) ); ?>;
}

.fbq-navbar .fbq-navbar-social .fbq-icon-hover.fbq-icon-fill,
.fbq-navbar .fbq-navbar-social .fbq-icon-hover.fbq-icon-fill-square,
.fbq-navbar--mobile .fbq-navbar-social .fbq-icon-hover.fbq-icon-fill,
.fbq-navbar--mobile .fbq-navbar-social .fbq-icon-hover.fbq-icon-fill-square {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_menu_hover_color'], $args ) ); ?>;
	color: <?php echo esc_attr( fabrique_contrast_color( $args['navbar_menu_hover_color'] ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Navbar Menu Typography==*/?>
.fbq-topnav-menu .menu-item a {
	<?php echo fabrique_s( $fonts[$args['navbar_menu_typography']], false ); ?>
}
<?php /*=========================*/?>

<?php /*=Navbar Menu Uppercase==*/?>
<?php if ( $args['navbar_menu_uppercase'] ) : ?>
.fbq-topnav-menu > .menu-item > a {
	text-transform: uppercase;
}
<?php else : ?>
.fbq-topnav-menu > .menu-item > a {
	text-transform: none;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Navbar Menu Font Size==*/?>
.fbq-topnav-menu > .menu-item > a {
	font-size: <?php echo esc_attr( (int)$args['navbar_menu_font_size'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*==Navbar Menu Letter Spacing==*/?>
<?php if ( '0' === $args['navbar_menu_letter_spacing'] ) : ?>
.fbq-topnav-menu > .menu-item > a {
	letter-spacing: 0;
}
<?php elseif ( !empty( $args['navbar_menu_letter_spacing'] ) ) : ?>
.fbq-topnav-menu > .menu-item > a {
	letter-spacing: <?php echo esc_attr( $args['navbar_menu_letter_spacing'] ); ?>em;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Navbar Menu Separator==*/?>
<?php if ( 'none' !== $args['navbar_menu_separator'] ) : ?>
.fbq-topnav-menu > .menu-item > a:before,
.horizontal .fbq-fullnav-menu > .menu-item > a:before {
	content: "<?php echo esc_attr( $args['navbar_menu_separator'] ); ?>";
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Navbar Dropdown Menu Uppercase==*/?>
<?php if ( $args['dropdown_menu_uppercase'] ) : ?>
.fbq-topnav-menu .sub-menu {
	text-transform: uppercase;
}
<?php else : ?>
.fbq-topnav-menu .sub-menu {
	text-transform: none;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Navbar Dropdown Font Size==*/?>
.fbq-topnav-menu .sub-menu a,
.fbq-topnav-menu .fbq-mega-menu-title a {
	font-size: <?php echo esc_attr( (int)$args['dropdown_menu_font_size'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*==Navbar Dropdown Letter Spacing==*/?>
<?php if ( '0' === $args['dropdown_menu_letter_spacing'] ) : ?>
.fbq-topnav-menu .sub-menu a,
.fbq-topnav-menu .fbq-mega-menu-title a {
	letter-spacing: 0;
}
<?php elseif ( !empty( $args['dropdown_menu_letter_spacing'] ) ) : ?>
.fbq-topnav-menu .sub-menu a,
.fbq-topnav-menu .fbq-mega-menu-title a {
	letter-spacing: <?php echo esc_attr( $args['dropdown_menu_letter_spacing'] ); ?>em;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Navbar Dropdown Min Width==*/?>
.fbq-topnav-menu > li > .sub-menu,
.fbq-topnav-menu > li > .sub-menu .sub-menu {
	min-width: <?php echo esc_attr( (int)$args['dropdown_menu_min_width'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*==Navbar Dropdown Background Color==*/?>
<?php if ( 'default' !== $args['dropdown_background_color'] ) : ?>
.fbq-topnav-menu .sub-menu,
.fbq-topnav-menu .fbq-mega-menu-bg,
.fbq-topnav-menu .fbq-cart-box {
	background-color: <?php echo fabrique_hex_to_rgba( $args['dropdown_background_color'], $args['dropdown_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Navbar Dropdown Menu Color==*/?>
<?php if ( 'default' !== $args['dropdown_menu_color'] ) : ?>
.fbq-topnav-menu .sub-menu a,
.fbq-topnav-menu .fbq-cart-box a,
.fbq-topnav-menu .fbq-mega-menu-title a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['dropdown_menu_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Navbar Dropdown Menu Hover Color==*/?>
<?php if ( 'default' !== $args['dropdown_hover_color'] ) : ?>
.fbq-topnav-menu .sub-menu a:hover,
.fbq-topnav-menu .fbq-cart-box a:hover,
.fbq-topnav-menu .fbq-mega-menu-title a:hover {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['dropdown_hover_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Side Navbar Background Color=*/?>
<?php if ( 'default' !== $args['sidenav_background_color'] ) : ?>
.fbq-side-navbar .fbq-navbar-inner,
.fbq-collapsed-menu--offcanvas .fbq-collapsed-menu-inner {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['sidenav_background_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Side Navbar Background Image=*/?>
<?php if ( !empty( $args['navbar_background_image'] ) ) : ?>
.fbq-side-navbar .fbq-navbar-inner,
.fbq-collapsed-menu--offcanvas .fbq-collapsed-menu-inner {
	<?php echo fabrique_get_background_image( array(
		'url' => $args['sidenav_background_image'],
		'size' => $args['sidenav_background_size'],
		'position' => $args['sidenav_background_position'],
		'repeat' => $args['sidenav_background_repeat'],
		'fixed' => $args['sidenav_background_attachment']
	) ); ?>
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Side Navbar Menu Color====*/?>
<?php if ( 'default' !== $args['sidenav_menu_color'] ) : ?>
.fbq-sidenav-menu .menu-item a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['sidenav_menu_color'], $args ) ); ?>;
}

.fbq-side-navbar .fbq-lines,
.fbq-side-navbar .fbq-lines:before,
.fbq-side-navbar .fbq-lines:after {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['sidenav_menu_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Side Navbar Menu Active Color*/?>
<?php if ( 'default' !== $args['sidenav_menu_active_color'] ) : ?>
.fbq-sidenav-menu .current-menu-item > a,
.fbq-sidenav-menu .current-menu-parent > a,
.fbq-sidenav-menu .current-menu-ancestor > a,
.fbq-sidenav-menu .current-menu-parent .fbq-mega-menu-title a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['sidenav_menu_active_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Side Navbar Menu Hover Color*/?>
<?php if ( 'default' !== $args['sidenav_menu_hover_color'] ) : ?>
.fbq-sidenav-menu .menu-item a:hover {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['sidenav_menu_hover_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Side Navbar Menu Typography==*/?>
.fbq-sidenav-menu .menu-item a {
	<?php echo fabrique_s( $fonts[$args['sidenav_menu_typography']], false ); ?>
}
<?php /*=========================*/?>

<?php /*=Side Navbar Menu Uppercase==*/?>
<?php if ( $args['sidenav_menu_uppercase'] ) : ?>
.fbq-sidenav-menu .menu-item a {
	text-transform: uppercase;
}
<?php else : ?>
.fbq-sidenav-menu .menu-item a {
	text-transform: none;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Side Navbar Menu Font Size==*/?>
.fbq-sidenav-menu .menu-item a {
	font-size: <?php echo esc_attr( (int)$args['sidenav_menu_font_size'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*==Side Navbar Menu Letter Spacing==*/?>
<?php if ( '0' === $args['sidenav_menu_letter_spacing'] ) : ?>
.fbq-sidenav-menu .menu-item a {
	letter-spacing: 0;
}
<?php elseif ( !empty( $args['sidenav_menu_letter_spacing'] ) ) : ?>
.fbq-sidenav-menu .menu-item a {
	letter-spacing: <?php echo esc_attr( $args['sidenav_menu_letter_spacing'] ); ?>em;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Full Navbar Background Color=*/?>
<?php if ( 'default' !== $args['navbar_full_background_color'] ) : ?>
.fbq-collapsed-menu.fbq-collapsed-menu--full {
	background-color: <?php echo fabrique_hex_to_rgba( $args['navbar_full_background_color'] , $args['navbar_full_opacity'] / 100 ); ?>;
}
.fbq-collapsed-button--full.fbq-closed .fbq-lines:before,
.fbq-collapsed-button--full.fbq-closed .fbq-lines:after {
	background-color: <?php echo fabrique_contrast_color( $args['navbar_full_background_color'] ); ?> !important;
}
<?php endif; ?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-collapsed-button--full.fbq-closed .fbq-lines:before',
		'.fbq-collapsed-button--full.fbq-closed .fbq-lines:after'
	),
	'property' => array(
		'background-color' => 'primary_background_contrast'
	)
) ) );
?>
<?php /*=========================*/?>

<?php /*=Full Navbar Background Image=*/?>
<?php if ( !empty( $args['navbar_full_background_image'] ) ) : ?>
.fbq-collapsed-menu.fbq-collapsed-menu--full {
	<?php echo fabrique_get_background_image( array(
		'url' => $args['navbar_full_background_image'],
		'size' => $args['navbar_full_background_size'],
		'position' => $args['navbar_full_background_position'],
		'repeat' => $args['navbar_full_background_repeat']
	) ); ?>
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Full Navbar Menu Color====*/?>
<?php if ( 'default' !== $args['navbar_full_menu_color'] ) : ?>
.fbq-fullnav-menu .menu-item a  {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_full_menu_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Full Navbar Menu Active Color*/?>
<?php if ( 'default' !== $args['navbar_full_menu_active_color'] ) : ?>
.fbq-fullnav-menu .current-menu-item > a,
.fbq-fullnav-menu .current-menu-parent > a,
.fbq-fullnav-menu .current-menu-ancestor > a,
.fbq-fullnav-menu .current-menu-parent .fbq-mega-menu-title a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_full_menu_active_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Full Navbar Menu Hover Color*/?>
<?php if ( 'default' !== $args['navbar_full_menu_hover_color'] ) : ?>
.fbq-fullnav-menu .menu-item a:hover {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['navbar_full_menu_hover_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Full Navbar Menu Typography==*/?>
.fbq-fullnav-menu .menu-item a {
	<?php echo fabrique_s( $fonts[$args['navbar_full_menu_typography']], false ); ?>
}
<?php /*=========================*/?>

<?php /*==Full Navbar Menu Font Size==*/?>
.fbq-fullnav-menu .menu-item a {
	font-size: <?php echo esc_attr( (int)$args['navbar_full_menu_font_size'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*==Full Navbar Menu Letter Spacing==*/?>
<?php if ( '0' === $args['navbar_full_menu_letter_spacing'] ) : ?>
.fbq-fullnav-menu .menu-item a {
	letter-spacing: 0;
}
<?php elseif ( !empty( $args['navbar_full_menu_letter_spacing'] ) ) : ?>
.fbq-fullnav-menu .menu-item a {
	letter-spacing: <?php echo esc_attr( $args['navbar_full_menu_letter_spacing'] ); ?>em;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Mobile Navbar Menu Typography==*/?>
.fbq-navbar--mobile .menu-item a {
	<?php echo fabrique_s( $fonts[$args['mobile_navbar_menu_typography']], false ); ?>
}
<?php /*=========================*/?>

<?php /*=Mobile Navbar Menu Uppercase=*/?>
<?php if ( $args['mobile_navbar_menu_uppercase'] ) : ?>
.fbq-navbar--mobile .menu-item a {
	text-transform: uppercase;
}
<?php else : ?>
.fbq-navbar--mobile .menu-item a {
	text-transform: none;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Mobile Navbar Menu Font Size==*/?>
.fbq-navbar--mobile .menu-item a {
	font-size: <?php echo esc_attr( (int)$args['mobile_navbar_menu_font_size'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*==Mobile Navbar Menu Letter Spacing==*/?>
<?php if ( '0' === $args['mobile_navbar_menu_letter_spacing'] ) : ?>
.fbq-navbar--mobile .menu-item a {
	letter-spacing: 0;
}
<?php elseif ( !empty( $args['mobile_navbar_menu_letter_spacing'] ) ) : ?>
.fbq-navbar--mobile .menu-item a {
	letter-spacing: <?php echo esc_attr( $args['mobile_navbar_menu_letter_spacing'] ); ?>em;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Mobile Navbar Background Color=*/?>
<?php if ( 'default' !== $args['mobile_navbar_background_color'] ) : ?>
.fbq-collapsed-menu.fbq-collapsed-menu--classic {
	background-color: <?php echo fabrique_hex_to_rgba( $args['mobile_navbar_background_color'] , $args['mobile_navbar_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Mobile Navbar Background Image=*/?>
<?php if ( !empty( $args['mobile_navbar_background_image'] ) ) : ?>
.fbq-collapsed-menu.fbq-collapsed-menu--classic {
	<?php echo fabrique_get_background_image( array(
		'url' => $args['mobile_navbar_background_image'],
		'size' => $args['mobile_navbar_background_size'],
		'position' => $args['mobile_navbar_background_position'],
		'repeat' => $args['mobile_navbar_background_repeat']
	) ); ?>
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Mobile Navbar Menu Color====*/?>
<?php if ( 'default' !== $args['mobile_navbar_menu_color'] ) : ?>
.fbq-collapsed-menu--classic .menu-item a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['mobile_navbar_menu_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Mobile Navbar Menu Active Color*/?>
<?php if ( 'default' !== $args['mobile_navbar_menu_active_color'] ) : ?>
.fbq-collapsed-menu--classic .current-menu-item > a,
.fbq-collapsed-menu--classic .current-menu-parent > a,
.fbq-collapsed-menu--classic .current-menu-ancestor > a,
.fbq-collapsed-menu--classic .current-menu-parent .fbq-mega-menu-title a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['mobile_navbar_menu_active_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Mobile Navbar Menu Hover Color*/?>
<?php if ( 'default' !== $args['mobile_navbar_menu_hover_color'] ) : ?>
.fbq-collapsed-menu--classic .menu-item a:hover {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['mobile_navbar_menu_hover_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*===Fixed Navbar Height===*/?>
.fbq-navbar--alternate {
	height: <?php echo esc_attr( $args['fixed_navbar_height'] ); ?>px;
	line-height: <?php echo esc_attr( $args['fixed_navbar_height'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*===Fixed Navbar Border===*/?>
.fbq-navbar--alternate .fbq-navbar-inner {
	border-bottom-width: <?php echo esc_attr( $args['fixed_navbar_bottom_border_thickness'] ); ?>px;
}

.fbq-navbar--alternate .fbq-topnav-menu > li > .fbq-mega-menu {
	margin-top: <?php echo esc_attr( $args['fixed_navbar_bottom_border_thickness'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*Fixed Navbar Border Color*/?>
<?php if ( 'default' !== $args['fixed_navbar_bottom_border_color'] ) : ?>
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-inner {
	border-bottom-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['fixed_navbar_bottom_border_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Fixed Navbar Background Color==*/?>
<?php if ( 'default' !== $args['fixed_navbar_background_color'] ) : ?>
.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-inner {
	background-color: <?php echo fabrique_hex_to_rgba( $args['fixed_navbar_background_color'] , $args['fixed_navbar_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Fixed Navbar Menu Font Size==*/?>
.fbq-navbar--alternate .fbq-topnav-menu > .menu-item > a {
	font-size: <?php echo esc_attr( $args['fixed_navbar_menu_font_size'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*=Fixed Navbar Menu Color=*/?>
<?php if ( 'default' !== $args['fixed_navbar_menu_color'] ) : ?>
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-topnav-menu > .menu-item > a,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-extra-menu a,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-normal {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['fixed_navbar_menu_color'], $args ) ); ?>;
}

.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-normal.fbq-icon-fill-square {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['fixed_navbar_menu_color'], $args ) ); ?>;
	color: <?php echo esc_attr( fabrique_contrast_color( $args['fixed_navbar_menu_color'] ) ); ?>;
}

.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-lines,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-lines:before,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-lines:after {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['fixed_navbar_menu_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Fixed Navbar Menu Active Color=*/?>
<?php if ( 'default' !== $args['fixed_navbar_menu_active_color'] ) : ?>
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-topnav-menu > .current-menu-item > a,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-topnav-menu > .current-menu-parent > a,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-topnav-menu > .current-menu-ancestor > a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['fixed_navbar_menu_active_color'], $args ) ); ?>;
}
<?php else: ?>
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-topnav-menu > .current-menu-item > a,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-topnav-menu > .current-menu-parent > a,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-topnav-menu > .current-menu-ancestor > a {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Fixed Navbar Menu Hover Color=*/?>
<?php if ( 'default' !== $args['fixed_navbar_menu_hover_color'] ) : ?>
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-topnav-menu > .menu-item > a:hover,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-extra-menu a:hover,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-hover {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['fixed_navbar_menu_hover_color'], $args ) ); ?>;
}

.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-hover.fbq-icon-fill,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-hover.fbq-icon-fill-square {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['fixed_navbar_menu_hover_color'], $args ) ); ?>;
	color: <?php echo esc_attr( fabrique_contrast_color( $args['fixed_navbar_menu_hover_color'] ) ); ?>;
}
<?php else: ?>
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-topnav-menu > .menu-item > a:hover,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-extra-menu a:hover,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-hover {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-hover.fbq-icon-fill,
.fbq-navbar--top.fbq-navbar--fixed.fbq-navbar--alternate .fbq-navbar-social .fbq-icon-hover.fbq-icon-fill-square {
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
	color: <?php echo esc_attr( $args['primary_brand_contrast'] ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*======Topbar Height======*/?>
<?php
	$mobile_navbar_height = 60;
	$tablet_padding_top = (int)$args['topbar_height'] + $mobile_navbar_height;
	$mobile_topbar_height = (int)$args['topbar_height'] * (int)$args['topbar_column'];
	$mobile_padding_top = $mobile_topbar_height + $mobile_navbar_height;
?>
.fbq-topbar {
	height: <?php echo esc_attr( (int)$args['topbar_height'] ); ?>px;
	line-height: <?php echo esc_attr( (int)$args['topbar_height'] ); ?>px;
}

@media only screen and (min-width: 768px) and (max-width: 960px) {
	.fbq-layout-responsive .mobile-topbar-enable .fbq-content-wrapper,
	.fbq-layout-responsive.fbq-layout--topnav-stacked .mobile-topbar-enable .fbq-content-wrapper,
	.fbq-layout-responsive.fbq-layout--sidenav .mobile-topbar-enable .fbq-content-wrapper,
	.fbq-layout-responsive .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-content--no-header .fbq-content-wrapper,
	.fbq-layout-responsive .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-content-wrapper > .fbq-page-title,
	.fbq-layout-responsive.fbq-layout--topnav-stacked .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-content-wrapper > .fbq-page-title,
	.fbq-layout-responsive.fbq-layout--sidenav .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-content-wrapper > .fbq-page-title {
		padding-top: <?php echo esc_attr( $tablet_padding_top ); ?>px;
	}

	.fbq-layout-responsive .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-post-featured--fullwidth .fbq-page-title,
	.fbq-layout-responsive.fbq-layout--topnav-stacked .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-post-featured--fullwidth .fbq-page-title,
	.fbq-layout-responsive.fbq-layout--sidenav .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-post-featured--fullwidth .fbq-page-title {
		top: <?php echo esc_attr( $tablet_padding_top ); ?>px;
	}
}

@media only screen and (max-width: 767px) {
	.mobile-topbar-enable .fbq-topbar {
		height: <?php echo esc_attr( $mobile_topbar_height ); ?>px;
	}

	.fbq-layout-responsive .mobile-topbar-enable .fbq-content-wrapper,
	.fbq-layout-responsive.fbq-layout--topnav-stacked .mobile-topbar-enable .fbq-content-wrapper,
	.fbq-layout-responsive.fbq-layout--sidenav .mobile-topbar-enable .fbq-content-wrapper,
	.fbq-layout-responsive .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-content--no-header .fbq-content-wrapper,
	.fbq-layout-responsive .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-content-wrapper > .fbq-page-title,
	.fbq-layout-responsive.fbq-layout--topnav-stacked .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-content-wrapper > .fbq-page-title,
	.fbq-layout-responsive.fbq-layout--sidenav .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-content-wrapper > .fbq-page-title {
		padding-top: <?php echo esc_attr( $mobile_padding_top ); ?>px;
	}

	.fbq-layout-responsive .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-post-featured--fullwidth .fbq-page-title,
	.fbq-layout-responsive.fbq-layout--topnav-stacked .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-post-featured--fullwidth .fbq-page-title,
	.fbq-layout-responsive.fbq-layout--sidenav .fbq-wrapper--header-transparent.mobile-topbar-enable .fbq-post-featured--fullwidth .fbq-page-title {
		top: <?php echo esc_attr( $mobile_padding_top ); ?>px;
	}
}
<?php /*=========================*/?>

<?php /*=====Topbar Separator====*/?>
<?php if ( $args['topbar_separator'] ) : ?>
.fbq-topbar .fbq-topbar-column {
	border-right-width: 1px;
	border-right-style: solid;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*======Topbar Border======*/?>
.fbq-topbar {
	border-bottom-width: <?php echo esc_attr( $args['topbar_bottom_border_thickness'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*===Topbar Border Color===*/?>
<?php if ( 'default' !== $args['topbar_bottom_border_color'] ) : ?>
.fbq-topbar {
	border-bottom-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['topbar_bottom_border_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Topbar Background Color=*/?>
<?php if ( 'default' !== $args['topbar_background_color'] ) : ?>
.fbq-topbar {
	background-color: <?php echo fabrique_hex_to_rgba( $args['topbar_background_color'], $args['topbar_background_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Topbar Text Color====*/?>
<?php if ( 'default' !== $args['topbar_text_color'] ) : ?>
.fbq-topbar {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['topbar_text_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*====Topbar Link Color====*/?>
<?php if ( 'default' !== $args['topbar_link_color'] ) : ?>
.fbq-topbar .fbq-widgets a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['topbar_link_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Topbar Link Hover Color=*/?>
<?php if ( 'default' !== $args['topbar_link_hover_color'] ) : ?>
.fbq-topbar .fbq-widgets a:hover {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['topbar_link_hover_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Action Button on Fixed Nav==*/?>
<?php if ( !$args['fixed_nav_action_button'] ) : ?>
.fbq-navbar--fixed .fbq-navbar-widget {
	display: none;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*Header Widgets Max Height*/?>
<?php if ( !empty( $args['header_widget_max_height'] ) && is_numeric( $args['header_widget_max_height'] ) ) : ?>
.fbq-header-widgets {
	height: <?php echo esc_attr( $args['header_widget_max_height'] ); ?>px;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*Header Widgets Separator=*/?>
<?php if ( $args['header_widget_separator'] ) : ?>
.fbq-header-widgets .fbq-header-widgets-column {
	border-right-width: 1px;
	border-right-style: solid;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Action Button Border===*/?>
.fbq-navbar-widget.fbq-button > .btnx {
	border-radius: <?php echo esc_attr( $args['action_button_radius'] ); ?>px;
	border-width: <?php echo esc_attr( $args['action_button_border'] ); ?>px;
}
<?php /*=========================*/?>

<?php /*=Header Widgets Background Color=*/?>
<?php if ( 'default' !== $args['header_widget_background_color'] ) : ?>
.fbq-header-widgets {
	background-color: <?php echo fabrique_hex_to_rgba( $args['header_widget_background_color'], $args['header_widget_background_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Header Widgets Background Image=*/?>
<?php if ( !empty( $args['header_widget_background_image'] ) ) : ?>
.fbq-header-widgets {
	<?php echo fabrique_get_background_image( array(
		'url' => $args['header_widget_background_image'],
		'size' => $args['header_widget_background_size'],
		'position' => $args['header_widget_background_position'],
		'repeat' => $args['header_widget_background_repeat']
	) ); ?>
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Header Widgets Text Color=*/?>
<?php if ( 'default' !== $args['header_widget_text_color'] ) : ?>
.fbq-header-widgets {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['header_widget_text_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Header Widgets Link Color=*/?>
<?php if ( 'default' !== $args['header_widget_link_color'] ) : ?>
.fbq-header-widgets .fbq-widgets a {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['header_widget_link_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=Header Widgets Link Hover Color=*/?>
<?php if ( 'default' !== $args['header_widget_link_hover_color'] ) : ?>
.fbq-header-widgets .fbq-widgets a:hover {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['header_widget_link_hover_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Breadcrumb Text Color==*/?>
<?php if ( 'default' !== $args['breadcrumb_text_color'] ) : ?>
.fbq-page-title .fbq-page-title-breadcrumb {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['breadcrumb_text_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Breadcrumb Background Color==*/?>
<?php if ( 'default' !== $args['breadcrumb_background_color'] ) : ?>
.fbq-page-title > .fbq-page-title-breadcrumb {
	background-color: <?php echo fabrique_hex_to_rgba( $args['breadcrumb_background_color'], $args['breadcrumb_background_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Page Title Text Color==*/?>
<?php if ( 'default' !== $args['page_title_text_color'] ) : ?>
.fbq-page-title .fbq-page-title-content {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['page_title_text_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Page Title Background Color==*/?>
<?php if ( 'default' !== $args['page_title_background_color'] ) : ?>
.fbq-page-title .fbq-background-overlay {
	background-color: <?php echo fabrique_hex_to_rgba( $args['page_title_background_color'], $args['page_title_background_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Page Title Background Image==*/?>
<?php if ( !empty( $args['page_title_background_image'] ) ) : ?>
.fbq-page-title--default .fbq-background-inner {
	<?php echo fabrique_get_background_image( array(
		'url' => $args['page_title_background_image'],
		'size' => $args['page_title_background_size'],
		'position' => $args['page_title_background_position'],
		'repeat' => $args['page_title_background_repeat']
	) ); ?>
}
<?php endif; ?>
<?php /*=========================*/?>
