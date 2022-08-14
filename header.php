<?php
/**
 * Plantilla Header
 *
 * @package WordPress
 * @subpackage basic_one
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<?php
			wp_head();
			if(!has_site_icon()){
		?>
				<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<?php
			}
		?>
	</head>
	<body <?php body_class(); ?>>
	<?php
	versatile_body_open();

	if ( !function_exists( 'elementor_theme_do_location' ) || !elementor_theme_do_location( 'header' ) ) {
		get_template_part( 'templates/header' );
	}