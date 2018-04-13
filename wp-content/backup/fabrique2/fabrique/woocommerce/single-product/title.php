<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$post_id = get_the_ID();
$tags = get_the_terms( $post_id, 'product_tag' );
?>

<div class="fbq-single-product-title">
	<?php  the_title( '<h1 itemprop="name" class="product_title entry-title">', '</h1>' ); ?>
	<?php if ( $tags ) : ?>
		<?php foreach ( $tags as $tag ) : ?>
			<?php $tag_thumbnail = get_term_meta( $tag->term_id, 'thumbnail_id', true ); ?>
			<?php if ( !empty( $tag_thumbnail ) ) : ?>
				<div class="fbq-single-product-badge">
					<?php echo fabrique_template_media( array(
						'image_id' => (int)$tag_thumbnail,
						'image_size' => 'medium'
					) ); ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
