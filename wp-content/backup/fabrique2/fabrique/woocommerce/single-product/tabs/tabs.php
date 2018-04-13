<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) :
?>

	<div class="woocommerce-tabs wc-tabs-wrapper fbq-item fbq-tab js-item-tab fbq-tab--top fbq-tab--plain fbq-p-border-border">
		<ul class="fbq-tab-nav fbq-center-align fbq-container">
			<?php $i = 0; ?>
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<?php
					$nav_list_class = 'fbq-tab-nav-list ' . $key . '_tab';
					if ( 0 === array_search( $key, array_keys( $tabs ) ) ) {
						$nav_list_class .= ' active';
					}
				?>
				<li class="<?php echo esc_attr( $nav_list_class ); ?>" data-index="<?php echo esc_attr( $i + 1 ); ?>">
					<span class="fbq-tab-nav-title">
						<?php echo apply_filters( 'woocommerce_product_' . esc_attr( $key ) . '_tab_title', esc_html( $tab['title'] ), esc_attr( $key ) ); ?>
					</span>
				</li>
				<?php $i++; ?>
			<?php endforeach; ?>

		</ul>
		<div class="fbq-tab-body">
			<div class="fbq-tab-wrapper">
				<?php $j = 0; ?>
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<?php
						$content_class = 'fbq-tab-content';
						if ( 0 == $j ) {
							$content_class .= ' active';
						}
					?>
					<div class="<?php echo esc_attr( $content_class ); ?>" data-index="<?php echo esc_attr( $j + 1 ); ?>">
						<div class="fbq-tab-pane">
							<?php if ( 'woocommerce_product_description_tab' !== $tab['callback'] ) : ?>
								<div class="fbq-container">
									<?php call_user_func( $tab['callback'], $key, $tab ); ?>
								</div>
							<?php else : ?>
								<?php call_user_func( $tab['callback'], $key, $tab ); ?>
							<?php endif; ?>
						</div>
					</div><?php // .tab content ?>
					<?php $j++; ?>
				<?php endforeach; ?>
			</div><?php // .tab wrapper ?>
		</div><?php // .tab body ?>
	</div><?php // .close tab ?>

<?php endif; ?>
