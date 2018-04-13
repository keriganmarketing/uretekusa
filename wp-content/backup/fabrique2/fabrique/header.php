<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php wp_head(); ?>
	</head>

	<?php get_template_part( 'templates/header-content' ); ?>
