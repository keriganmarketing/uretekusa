<?php $args = fabrique_template_args( 'style-custom-blueprint' ); ?>
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

<?php /*====Design Typography====*/?>
.bp-space {
	<?php echo fabrique_s( $fonts[$args['style_typography']], false ); ?>
	font-size: <?php echo esc_attr( (int)$args['style_font_size'] ); ?>px;
<?php if ( !empty( $args['style_line_height'] ) ) : ?>
	line-height: <?php echo esc_attr( $args['style_line_height'] ); ?>;
<?php endif; ?>
}

.bp-space .fbq-box-content {
	font-size: <?php echo esc_attr( (int)$args['style_font_size'] ); ?>px;
<?php if ( !empty( $args['style_line_height'] ) ) : ?>
	line-height: <?php echo esc_attr( $args['style_line_height'] ); ?>;
<?php endif; ?>
}
<?php /*=========================*/?>

<?php /*====Heading typography====*/?>
#poststuff .bp-item-content h1,
#poststuff .bp-context-header h1 {
	<?php echo fabrique_s( $fonts[$args['heading_typography']], false ); ?>
	font-size: <?php echo esc_attr( $args['heading_size_h1'] ); ?>px;
}

#poststuff .bp-item-content h2,
#poststuff .bp-context-header h2 {
	<?php echo fabrique_s( $fonts[$args['heading_typography']], false ); ?>
	font-size: <?php echo esc_attr( $args['heading_size_h2'] ); ?>px;
}

#poststuff .bp-item-content h3,
#poststuff .bp-context-header h3 {
	<?php echo fabrique_s( $fonts[$args['heading_typography']], false ); ?>
	font-size: <?php echo esc_attr( $args['heading_size_h3'] ); ?>px;
}

#poststuff .bp-item-content h4,
#poststuff .bp-context-header h4 {
	<?php echo fabrique_s( $fonts[$args['heading_typography']], false ); ?>
	font-size: <?php echo esc_attr( $args['heading_size_h4'] ); ?>px;
}

#poststuff .bp-item-content h5 {
	<?php echo fabrique_s( $fonts[$args['heading_typography']], false ); ?>
	font-size: <?php echo esc_attr( $args['heading_size_h5'] ); ?>px;
}

#poststuff .bp-item-content h6 {
	<?php echo fabrique_s( $fonts[$args['heading_typography']], false ); ?>
	font-size: <?php echo esc_attr( $args['heading_size_h6'] ); ?>px;
}
<?php /*==========================*/?>

<?php /*=====Theme typography=====*/?>
<?php foreach ( $fonts as $key => $value ) : ?>
.fbq-<?php echo esc_attr( $key ); ?>-font,
#poststuff .bp-item-content .fbq-<?php echo esc_attr( $key ); ?>-font,
#poststuff .bp-context-header .fbq-<?php echo esc_attr( $key ); ?>-font {
	<?php echo fabrique_s( $value, false ); ?>
}
<?php endforeach; ?>
<?php /*==========================*/?>

<?php /*===Layout and Max-width===*/?>
.bp-context-region,
.bp-context {
	background-color: <?php echo esc_attr( $args['primary_background'] ); ?>;
}

<?php if ( 'boxed' === $args['site_layout'] ) : ?>
.bp--preview .bp-context {
	max-width: <?php echo esc_attr( $args['content_max_width'] ); ?>px;
	margin: 0 auto;
}

	<?php if ( 'default' !== $args['body_background_color'] ) : ?>
	.bp-context-region {
		background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['body_background_color'], $args ) ); ?>;
	}
	<?php else : ?>
	.bp-context-region {
		background-color: <?php echo esc_attr( $args['secondary_background'] ); ?>;
	}
	<?php endif; ?>

	<?php if ( !empty( $args['boxed_shadow'] ) ): ?>
	.bp--preview .bp-context {
		box-shadow: <?php echo esc_attr( $args['boxed_shadow'] ); ?>;
	}
	<?php endif; ?>
<?php else : ?>
.bp--preview .bp-context .bp-block {
	max-width: <?php echo esc_attr( $args['content_max_width'] + 200 ); ?>px;
	max-width: calc( <?php echo esc_attr( $args['content_max_width'] . "px + " . (int)$args['side_padding'] . "%" ); ?> );
}
<?php endif; ?>
.bp--preview .bp-context .bp-block {
	padding-right: <?php echo esc_attr( $args['side_padding'] / 2 ); ?>%;
	padding-left: <?php echo esc_attr( $args['side_padding'] / 2 ); ?>%;
}
<?php /*==========================*/?>

<?php /*=====Layout Background====*/?>
<?php if ( 'default' !== $args['content_background_color'] ) : ?>
.bp-context {
	background-color: <?php echo esc_attr( fabrique_customizer_get_color( $args['content_background_color'], $args ) ); ?>;
}
<?php endif; ?>

<?php if ( !empty( $args['content_background_image'] ) ) : ?>
.bp--preview .bp-context {
	<?php echo fabrique_get_background_image( array(
		'url' => $args['content_background_image'],
		'size' => $args['content_background_size'],
		'position' => $args['content_background_position'],
		'repeat' => $args['content_background_repeat'],
		'fixed' => $args['content_background_attachment']
	) ); ?>
}
<?php endif; ?>
<?php /*==========================*/?>

<?php /*=======Theme Color========*/?>
.bp-context a,
.bp-context a:hover.fbq-s-text-color,
.bp-context a:hover.fbq-p-text-color {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.bp-context a:hover,
.bp-context a:focus,
.bp-context a:active,
.bp-context a:hover.fbq-p-brand-color {
	color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}

.bp-context-sections,
.bp-context-header {
	color: <?php echo esc_attr( $args['primary_text'] ); ?>;
}

.bp-context .bp-link,
.bp-context .bp-link:hover.fbq-s-text-color,
.bp-context .bp-link:hover.fbq-p-text-color {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.bp-context .bp-link:hover,
.bp-context .bp-link:focus,
.bp-context .bp-link:active,
.bp-context .bp-link:hover.fbq-p-brand-color {
	color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}

.bp-context .btnx {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.bp-context .btnx:hover,
.bp-context .btnx:focus {
	color: <?php echo esc_attr( $args['secondary_brand'] ); ?>;
}

<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.bp-link:hover.fbq-p-bg-color',
	'property' => array(
		'color' => 'secondary_background'
	)
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
	'property' => array(
		'color' => 'secondary_text'
	)
) ), true );
?>
<?php /*=========================*/?>

<?php /*===Main Color Selector===*/?>
#poststuff .bp-context .fbq-light-scheme,
#poststuff .bp-context .fbq-entry-light-scheme,
#poststuff .bp-context .fbq-slider-light-scheme {
	color: <?php echo esc_attr( $args['bp_color_3'] ); ?>;
}

#poststuff .bp-context .fbq-dark-scheme,
#poststuff .bp-context .fbq-entry-dark-scheme,
#poststuff .bp-context .fbq-slider-dark-scheme {
	color: <?php echo esc_attr( $args['bp_color_8'] ); ?>;
}

.fbq-p-brand-color {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-p-brand-bg {
	background-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-p-brand-border {
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
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-contrast-color',
	'property' => array(
		'color' => 'secondary_text_contrast'
	),
	'parent' => array( 'slider' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-text-color',
	'property' => array(
		'color' => 'primary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-text-bg',
	'property' => array(
		'background-color' => 'primary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-color',
	'property' => array(
		'color' => 'secondary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-bg',
	'property' => array(
		'background-color' => 'secondary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-bg.fbq-overlay',
	'property' => array(
		'background-color' => 'secondary_text'
	),
	'opacity' => 0.8,
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-text-border',
	'property' => array(
		'border-color' => 'secondary_text'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-bg-color',
	'property' => array(
		'color' => 'primary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-bg-bg',
	'property' => array(
		'background-color' => 'primary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-bg-border',
	'property' => array(
		'border-color' => 'primary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-bg-color',
	'property' => array(
		'color' => 'secondary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-bg-bg',
	'property' => array(
		'background-color' => 'secondary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-s-bg-border',
	'property' => array(
		'border-color' => 'secondary_background'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-border-color',
	'property' => array(
		'color' => 'primary_border'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-border-bg',
	'property' => array(
		'background-color' => 'primary_border'
	),
	'parent' => array( 'slider', 'entry' )
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-p-border-border',
	'property' => array(
		'border-color' => 'primary_border'
	),
	'parent' => array( 'slider', 'entry' ),
	'is_high_level' => true
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-overlay',
	'property' => array(
		'background-color' => 'primary_background'
	),
	'opacity' => 0.8,
	'parent' => array( 'slider', 'entry' )
) ), true );
?>

<?php /*=========================*/?>

<?php /*=======Brand Button======*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array( '.fbq-button--border > .btnx', '.fbq-button--fill.fbq-button-hover--inverse > .btnx:hover' ),
	'property' => array(
		'color' => 'primary_brand',
		'border-color' => 'primary_brand'
	),
	'parent' => 'slider'
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-button--border.fbq-button-hover--brand > .btnx:hover',
	'property' => array(
		'color' => 'secondary_brand',
		'border-color' => 'secondary_brand'
	),
	'parent' => 'slider'
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-form-group input[type=submit]',
		'.fbq-button--fill.fbq-button-color--brand > .btnx',
		'.fbq-button--border.fbq-button-hover--inverse > .btnx:hover'
	),
	'property' => array(
		'color' => 'primary_brand_contrast',
		'border-color' => 'primary_brand',
		'background-color' => 'primary_brand'
	),
	'parent' => 'slider'
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-form-group input[type=submit]:hover',
		'.fbq-button--fill.fbq-button-hover--brand > .btnx:hover'
	),
	'property' => array(
		'color' => 'secondary_brand_contrast',
		'border-color' => 'secondary_brand',
		'background-color' => 'secondary_brand'
	),
	'parent' => 'slider'
) ), true );
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
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-button-color--basic.fbq-button--fill > .btnx',
		'.fbq-button-color--basic.fbq-button--border.fbq-button-hover--inverse > .btnx:hover'
	),
	'property' => array(
		'color' => 'primary_brand',
		'border-color' => 'secondary_text',
		'background-color' => 'secondary_text'
	),
	'parent' => 'slider'
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-button-color--basic.fbq-button--border.fbq-button-hover--brand > .btnx:hover',
	'property' => array(
		'color' => 'primary_brand',
		'border-color' => 'primary_brand',
	),
	'parent' => 'slider'
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-button-color--basic.fbq-button--fill.fbq-button-hover--brand > .btnx:hover',
	'property' => array(
		'color' => 'primary_brand_contrast',
		'border-color' => 'primary_brand',
		'background-color' => 'primary_brand'
	),
	'parent' => 'slider'
) ), true );
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
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.slick-dots button:hover',
	'property' => array(
		'background-color' => 'secondary_text'
	),
	'opacity' => 0.7,
	'parent' => 'slider'
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.slick-dots .slick-active button',
	'property' => array(
		'background-color' => 'secondary_text'
	),
	'parent' => 'slider'
) ), true );
?>
<?php /*=========================*/?>

<?php /*=====Tab & Accordion=====*/?>
.fbq-tab .fbq-tab-nav-list.active,
.fbq-accordion-panel.active .fbq-accordion-heading {
	color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-tab--underline .fbq-tab-nav-list.active {
	border-color: <?php echo esc_attr( $args['primary_brand'] ); ?>;
}

.fbq-tab--fullwidth .fbq-tab-nav-list.active {
	background-color: <?php echo esc_attr( $args['primary_background'] ); ?>;
}

.fbq-accordion--fill .fbq-accordion-panel.active .fbq-accordion-heading {
	background-color: <?php echo esc_attr( $args['secondary_background'] ); ?>;
}
<?php /*=========================*/?>

<?php /*==========Entry==========*/?>
<?php
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-entry-flash span.onsale',
	'property' => array(
		'color' => 'secondary_text_contrast'
	)
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-entry-title a:hover',
		'.fbq-entry-meta a:hover',
		'.fbq-relatedpost .fbq-entry:hover .fbq-entry-title'
	),
	'property' => array(
		'color' => 'primary_brand'
	)
) ), true );
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
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-carousel-arrow.transparent',
	'property' => array(
		'color' => 'secondary_text'
	),
	'parent' => 'slider'
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.fbq-pagination .page-numbers',
	'property' => array(
		'color' => 'primary_text',
	)
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-pagination .page-numbers',
		'.fbq-filter-list > .active'
	),
	'property' => array(
		'color' => 'secondary_text',
	)
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.fbq-filter-list > .active:after',
		'.page-numbers.current:after'
	),
	'property' => array(
		'background-color' => 'secondary_text',
	)
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.with-border',
	'property' => array(
		'border-color' => 'primary_border',
	)
) ), true );

fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => '.page-numbers',
	'property' => array(
		'color' => 'primary_text',
	)
) ), true );
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
) ), true );
fabrique_sch_css( array_merge( $args['base_sch_args'], array(
	'selector' => array(
		'.page-numbers.next:hover',
		'.page-numbers.prev:hover'
	),
	'property' => array(
		'color' => 'secondary_brand',
	)
) ), true );
?>
<?php /*=========================*/?>

<?php /*====Unsolvable Color=====*/?>
<?php if ( 'light' === $args['default_color_scheme'] ) : ?>
.fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.fbq-dark-scheme .fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
}

.fbq-light-scheme .fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
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
<?php else : ?>
.fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
}

.fbq-light-scheme .fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.fbq-dark-scheme .fbq-pricing-item.highlighted {
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
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
<?php endif; ?>
<?php /*=========================*/?>

<?php /*=======Design Button=====*/?>
.bp-context .btnx {
	<?php echo fabrique_s( $fonts[$args['button_typography']], false ); ?>
<?php if ( $args['button_uppercase'] ) : ?>
	text-transform: uppercase;
<?php else : ?>
	text-transform: none;
<?php endif; ?>
}

.fbq-button > .btnx {
	border-radius: <?php echo esc_attr( $args['button_radius'] ); ?>px;
	border-width: <?php echo esc_attr( $args['button_border'] ); ?>px;
}

.fbq-entry-addtocart .btnx {
	color: <?php echo esc_attr( $args['button_text_color'] ); ?>;
	background-color: <?php echo esc_attr( $args['button_background_color'] ); ?>;
	border-color: <?php echo esc_attr( $args['button_border_color'] ); ?>;
}

.fbq-entry-addtocart .btnx:hover {
	color: <?php echo esc_attr( $args['button_text_hover_color'] ); ?>;
	background-color: <?php echo esc_attr( $args['button_background_hover_color'] ); ?>;
	border-color: <?php echo esc_attr( $args['button_border_hover_color'] ); ?>;
}
<?php /*=========================*/?>

<?php /*==Breadcrumb Text Color==*/?>
<?php if ( 'default' !== $args['breadcrumb_text_color'] ) : ?>
.bp-context .fbq-page-title .fbq-page-title-breadcrumb {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['breadcrumb_text_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Breadcrumb Background Color==*/?>
<?php if ( 'default' !== $args['breadcrumb_background_color'] ) : ?>
.bp-context .fbq-page-title > .fbq-page-title-breadcrumb {
	background-color: <?php echo fabrique_hex_to_rgba( $args['breadcrumb_background_color'], $args['breadcrumb_background_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Page Title Text Color==*/?>
<?php if ( 'default' !== $args['page_title_text_color'] ) : ?>
.bp-context .fbq-page-title .fbq-page-title-content {
	color: <?php echo esc_attr( fabrique_customizer_get_color( $args['page_title_text_color'], $args ) ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>

<?php /*==Page Title Background Color==*/?>
<?php if ( 'default' !== $args['page_title_background_color'] ) : ?>
.bp-context .fbq-page-title .fbq-background-overlay {
	background-color: <?php echo fabrique_hex_to_rgba( $args['page_title_background_color'], $args['page_title_background_opacity'] / 100 ); ?>;
}
<?php endif; ?>
<?php /*=========================*/?>
