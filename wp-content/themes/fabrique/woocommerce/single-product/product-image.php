<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$tn_position = fabrique_mod( 'product_thumbnail_position' );
$column = fabrique_mod( 'product_thumbnail_item' );
$column_class = '';
if ( 'left' !== $tn_position && 'right' !== $tn_position ) {
	$column_class .= ( 5 == $column ) ? ' fbq-col-1-5' : ' fbq-col-' . 12 / $column;
}

$image_action = fabrique_mod( 'product_image_action' );
if ( 'both' === $image_action ) {
	$action = 'zoom';
} else {
	$action = $image_action;
}

$thumbnail_ids = $product->get_gallery_image_ids();
$thumbnail_ids = !empty( $thumbnail_ids ) ? $thumbnail_ids : array( get_post_thumbnail_id() );
$image_number = count( $thumbnail_ids );
$content_class = ( $image_number > 1 ) ? 'fbq-gallery-content with-thumbnail' : 'fbq-gallery-content';
$thumbnail_set_ratio = fabrique_mod( 'product_thumbnail_ratio' );
?>

<div class="images fbq-product-gallery fbq-product-gallery--<?php echo esc_attr( $action ); ?> fbq-product-gallery--<?php echo esc_attr( $tn_position ); ?> fbq-gallery--carousel" data-style="carousel" data-action="<?php echo esc_attr( $image_action ); ?>">
	<div class="<?php echo esc_attr( $content_class ); ?>" data-adaptive_height="true">
		<?php if ( $image_number > 0 ): ?>
			<?php foreach ( $thumbnail_ids as $index => $thumbnail_id ) : ?>
				<div class="fbq-gallery-item" data-id="<?php echo esc_attr( $thumbnail_id ); ?>">
					<div class="fbq-gallery-body">
						<?php if ( 'zoom' === $image_action ) : ?>
							<div class="fbq-gallery-media">
								<?php
									$image = wp_get_attachment_image( $thumbnail_id, apply_filters( 'woocommerce_product_thumbnails_large_size', 'shop_single' ) );
									echo fabrique_escape_content( $image );
									echo fabrique_escape_content( $image );
								?>
							</div>
						<?php elseif ( 'both' === $image_action ) : ?>
							<?php $full_image_src = wp_get_attachment_image_src( $thumbnail_id, 'full' ); ?>
							<a class="fbq-gallery-media" data-index="<?php echo esc_attr( $index ); ?>" href="<?php echo esc_url( $full_image_src[0] ); ?>">
								<?php
									$image = wp_get_attachment_image( $thumbnail_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
									echo fabrique_escape_content( $image );
									echo fabrique_escape_content( $image );
								?>
							</a>
						<?php else : ?>
							<?php $full_image_src = wp_get_attachment_image_src( $thumbnail_id, 'full' ); ?>
							<a class="fbq-gallery-media" data-index="<?php echo esc_attr( $index ); ?>" href="<?php echo esc_url( $full_image_src[0] ); ?>">
								<?php echo wp_get_attachment_image( $thumbnail_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'fabrique' ) ), $post->ID ); ?>
		<?php endif; ?>

	</div>
	<?php if ( $image_number > 1 ) : ?>
		<div class="thumbnails columns-<?php echo esc_attr( $column ); ?> fbq-gallery-thumbnail fbq-gallery-thumbnail--<?php echo esc_attr( $tn_position ); ?>" data-thumbnail="<?php echo esc_attr( $column ); ?>">
			<?php foreach ( $thumbnail_ids as $thumbnail_id ) : ?>
				<div class="fbq-gallery-thumbnail-item<?php echo esc_attr( $column_class ); ?>">
					<?php
						$thumbnail_image = wp_get_attachment_image_src( $thumbnail_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
						$thumbnail_style_attr = '';
						if ( 'auto' !== $thumbnail_set_ratio ) {
							$thumbnail_image_ratio = ($thumbnail_image[2]/$thumbnail_image[1])*100;
							if ( $thumbnail_image_ratio < (int)$thumbnail_set_ratio ) {
								$thumbnail_style_attr .= 'height:100%;';
								$thumbnail_style_attr .= 'width:auto;';
							} else {
								$thumbnail_style_attr .= 'width:100%;';
								$thumbnail_style_attr .= 'height:auto;';
							}
							?><div class="fbq-gallery-thumbnail-item-inner" style="padding-bottom:<?php echo esc_attr( $thumbnail_set_ratio ); ?>%;">
								<?php echo wp_get_attachment_image( $thumbnail_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), false, array( 'style' => $thumbnail_style_attr ) ); ?>
							</div><?php
						} else {
							echo wp_get_attachment_image( $thumbnail_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
						}
					?>
				</div>
			<?php endforeach;?>
		</div>
	<?php endif; ?>
</div>
