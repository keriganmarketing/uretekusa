<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'fabrique' ) ) );

$post_id = $post->ID;
$bp_data = get_post_meta( $post_id, 'bp_data', true );
$blueprint_active = false;

if ( is_array( $bp_data ) && isset( $bp_data['builder'] ) && is_array( $bp_data['builder'] ) ) {
	$blueprint_active = $bp_data['builder']['active'];
}
?>

<?php if ( !$blueprint_active ) : ?>
	<div class="fbq-container">
		<?php if ( $heading ): ?>
		  <h2 class="fbq-product-description-title"><?php echo fabrique_escape_content( $heading ); ?></h2>
		<?php endif; ?>
		<?php the_content(); ?>
	</div>
<?php else : ?>
	<?php foreach ( $bp_data['sections'] as $s_index => $section ) : ?>
		<?php
			$section = fabrique_filter_section_content( $section );
			foreach ( $section as $section_content ) {
				$section_args = array(
					'section' => $section_content,
					'index' => $s_index
				);
				fabrique_template( 'section-content.php', $section_args );
				$s_index++;
			}
		?>
	<?php endforeach; ?>
<?php endif; ?>
