<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( !function_exists( 'elementor_theme_do_location' ) || !elementor_theme_do_location( 'footer' ) ) {
	get_template_part( 'templates/footer' );
}

if(is_user_logged_in()){
?>
<div class="abar_admin_links">
	<a href="<?php echo get_site_url()."/wp-admin/"; ?>">
		<svg enable-background="new 0 0 128 128" id="Social_Icons" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<g id="_x32__stroke">
				<g id="Wordpress_1_">
					<rect clip-rule="evenodd" fill="none" fill-rule="evenodd" height="128" width="128"/>
					<path clip-rule="evenodd" d="M65.123,69.595l-19.205,55.797    c5.736,1.688,11.8,2.608,18.081,2.608c7.452,0,14.6-1.288,21.253-3.628c-0.168-0.276-0.328-0.564-0.456-0.88L65.123,69.595z     M120.16,33.294c0.276,2.04,0.432,4.224,0.432,6.58c0,6.492-1.216,13.792-4.868,22.924l-19.549,56.517    C115.204,108.223,128,87.606,128,63.998C128,52.87,125.156,42.41,120.16,33.294z M107.204,60.769    c0-7.912-2.844-13.388-5.276-17.648c-3.244-5.276-6.288-9.74-6.288-15.012c0-5.884,4.46-11.36,10.748-11.36    c0.284,0,0.552,0.036,0.828,0.052C95.832,6.368,80.659,0,63.999,0C41.638,0,21.969,11.472,10.525,28.844    c1.504,0.048,2.92,0.076,4.12,0.076c6.692,0,17.057-0.812,17.057-0.812c3.448-0.204,3.856,4.868,0.408,5.272    c0,0-3.468,0.408-7.324,0.612l23.305,69.321l14.008-42.005L52.13,33.992c-3.448-0.204-6.716-0.612-6.716-0.612    c-3.448-0.204-3.044-5.476,0.408-5.272c0,0,10.568,0.812,16.857,0.812c6.692,0,17.057-0.812,17.057-0.812    c3.452-0.204,3.856,4.868,0.408,5.272c0,0-3.472,0.408-7.324,0.612l23.129,68.793l6.388-21.328    C105.096,72.601,107.204,66.245,107.204,60.769z M0,63.997c0,25.332,14.72,47.225,36.069,57.597L5.54,37.952    C1.992,45.909,0,54.717,0,63.997z" fill="#00759D" fill-rule="evenodd" id="Wordpress"/>
				</g>
			</g>
		</svg>
	</a>
	<a href="<?php echo wp_logout_url( home_url( $wp->request ) ) ?>">
		<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M17 16L21 12M21 12L17 8M21 12L7 12M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8" stroke="#374151" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
	</a>
</div>
<?php
}
wp_footer();

?>

</body>
</html>
