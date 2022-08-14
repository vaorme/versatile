<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
?>
<header class="header">
	<div class="logo">
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		} elseif ($site_name) {
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo__link" title="<?php esc_attr_e( 'Home', 'versatile' ); ?>" rel="home">
				<?php echo esc_html( $site_name ); ?>
			</a>
			<p class="logo__description">
				<?php
				if ( $tagline ) {
					echo esc_html( $tagline );
				}
				?>
			</p>
		<?php } ?>
	</div>
	<div class="main">
		<div class="menu">
			<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
				<nav class="site-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</header>
