<?php

// Registramos las ubicaciones para elementor

function theme_prefix_register_elementor_locations( $elementor_theme_manager ) {

	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
	$elementor_theme_manager->register_location( 'single' );
	$elementor_theme_manager->register_location( 'archive' );

}
add_action( 'elementor/theme/register_locations', 'theme_prefix_register_elementor_locations' );

// Agregamos elementos soportados al tema

function versatile_theme_support(){

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		Enable support for Post Thumbnails on posts and pages.
		@link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	// Logo support
	add_theme_support( 'custom-logo' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'versatile-fullscreen', 1980, 9999 );

	// Reisze imagen: TRUE corta la imagen
	add_image_size('featured-medium', 500, 500, true);
	
    // Reisze imagen: FALSE no corta la imagen
    add_image_size('featured-page', 600, 600, false);

	$GLOBALS['content_width'] = 1130;

	// Quitar Scaled Para imagenes grandes
	add_filter( 'big_image_size_threshold', '__return_false' );

	// SOPORTE title para el theme
	add_theme_support( 'title-tag' );

	// SOPORTE idiomas

	load_theme_textdomain('versatile', get_template_directory().'/languages');
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support woocommerce
	add_theme_support( 'woocommerce' ); 
}
add_action( 'after_setup_theme', 'versatile_theme_support' );


// Removemos elementos que no vamos a usar

function wp_cleaning() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_head', 'rel_canonical');
	remove_action('wp_head', 'rel_alternate');
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
	remove_action('wp_head', 'rest_output_link_wp_head');
	
	remove_action('rest_api_init', 'wp_oembed_register_route');
	remove_action('wp_print_styles', 'print_emoji_styles');
	
	remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
	remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
	
	add_filter('embed_oembed_discover', '__return_false');

	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	
	// Ocultar Admin Bar
	add_filter('show_admin_bar', '__return_false');
}
add_action('after_setup_theme', 'wp_cleaning');

// Removemos elementos de la admin-bar

function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the Wordpress logo
    $wp_admin_bar->remove_menu('about');            // Remove the about Wordpress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the Wordpress.org link
    $wp_admin_bar->remove_menu('documentation');    // Remove the Wordpress documentation link
    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
	$wp_admin_bar->remove_menu('search');         // Remove search link
	$wp_admin_bar->remove_menu('customize');         // Remove customize link
    // $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    // $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('new-content');      // Remove the content link
    // $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    // $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

/* 
    STYLES:
    añade nuevos estilos
*/

function versatile_setup_styles() {

	$theme_version = null;
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/theme.css', array(), $theme_version, false );
	wp_enqueue_style( 'owl', get_template_directory_uri() . '/owl.css', array(), $theme_version, false );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), $theme_version, false );

}
add_action( 'wp_enqueue_scripts', 'versatile_setup_styles' );

/* 
    MENU:
    Añade nuevas ubicaciones para el menu
*/

function versatile_setup_menus() {
	$locations = array(
		'principal'  => __( 'Principal', 'versatile' )
	);

	register_nav_menus( $locations );
}
add_action( 'init', 'versatile_setup_menus' );

/* 
    SCRIPTS:
    Añadimos scripts personalizados
*/
function versatile_setup_scripts() {

	$theme_version = null;
	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_deregister_script('jquery');

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), $theme_version, false );
	wp_script_add_data( 'jquery', 'async', false );

	wp_enqueue_script( 'theme', get_template_directory_uri() . '/assets/js/theme.js', array(), $theme_version, true );
	wp_script_add_data( 'theme', 'async', false);

	wp_enqueue_script( 'init', get_template_directory_uri() . '/init.js', array(), $theme_version, true );
	wp_script_add_data( 'init', 'async', false );

}
add_action( 'wp_enqueue_scripts', 'versatile_setup_scripts' );

// Comprobamos si tiene async/defer habilitado

function my_script_loader_tag( $tag, $handle ) {

	// add an async attribute to the registered script.
	if ( wp_scripts()->get_data( $handle, 'async' ) ) {
		$tag = str_replace( '></', ' async></', $tag );
	}else if( wp_scripts()->get_data( $handle, 'defer' ) ){
		$tag = str_replace( '></', ' defer></', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'my_script_loader_tag', 10, 2 );

// Comprobamos si ocultamos el título de elementor

if ( ! function_exists( 'versatile_check_hide_title' ) ) {
	
	function versatile_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}

}
add_filter( 'versatile_page_title', 'versatile_check_hide_title' );


/**
 * Wrapper function to deal with backwards compatibility.
*/

if ( ! function_exists( 'versatile_body_open' ) ) {
	function versatile_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}

// Agregar menu en admin topbar
/*
add_action('admin_bar_menu', 'add_toolbar_items', 100);
function add_toolbar_items($admin_bar){
	$admin_bar->add_menu( array(
		'id'    => 'my-item',
		'title' => 'All tutorials', // Your menu title
		'href'  => 'https://know.local/', // URL
		'meta'  => array(
		 'target' => '_blank',
		),
	));

  	// Submenus
	$admin_bar->add_menu( array(
		'parent' => 'my-item',
		'title' => 'Remove admin menus', // Your submenu title
		'href'  => 'https://wpsimplehacks.com/how-to-remove-wordpress-admin-menu-items/', // URL
		'meta'  => array(
		'target' => '_blank',
		),
	));
		$admin_bar->add_menu( array(
		'parent' => 'my-item',
		'title' => 'Custom Admin Dashboard',
		'href'  => 'https://wpsimplehacks.com/how-to-create-custom-wordpress-admin-dashboard/',
		'meta'  => array(
		'target' => '_blank',
		),
	));  
	$admin_bar->add_menu( array(
		'parent' => 'my-item',
		'title' => 'Block Patterns',
		'href'  => 'https://wpsimplehacks.com/how-to-create-wordpress-block-patterns-and-reusable-blocks/',
		'meta'  => array(
		'target' => '_blank',
		),
	));
}*/


/**
	Creamos menu personalizado en wp-admin
**/
function wporg_settings_init() {
    // Register a new setting for "wporg" page.
    register_setting( 'wporg', 'wporg_options' );
 
    // Register a new section in the "wporg" page.
    add_settings_section(
        'wporg_section_developers',
        __( 'The Matrix has you.', 'wporg' ),
		'wporg_section_developers_callback',
        'wporg'
    );
 
    // Register a new field in the "wporg_section_developers" section, inside the "wporg" page.
    add_settings_field(
        'wporg_field_pill', // As of WP 4.6 this value is used only internally.
        // Use $args' label_for to populate the id inside the callback.
        __( 'Pill', 'wporg' ),
        'wporg_field_pill_cb',
        'wporg',
        'wporg_section_developers',
        array(
            'label_for'         => 'wporg_field_pill',
            'class'             => 'wporg_row',
            'wporg_custom_data' => 'custom',
        )
    );
}
add_action( 'admin_init', 'wporg_settings_init' );
 
 
/**
	:Callback
**/

function wporg_section_developers_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'wporg' ); ?></p>
    <?php
}
 
/**
	Creamos los campos
**/
function wporg_field_pill_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'wporg_options' );
    ?>
    <select
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
            name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
        <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'red pill', 'wporg' ); ?>
        </option>
        <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'blue pill', 'wporg' ); ?>
        </option>
    </select>
    <p class="description">
        <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
    </p>
    <p class="description">
        <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
    </p>
    <?php
}
 
/*
	:Añadimos un menu de alto nivel
*/
function wporg_options_page() {
    add_menu_page(
        'Opciones Versatile', // Nombre página
        'Versatile Theme', // Nombre menu
        'manage_options', // Capability
        'wporg', // Menu slug
        'wporg_options_page_html', // Callback
		'dashicons-chart-area', // Icono
		3 // Posición
    );
}
//add_action( 'admin_menu', 'wporg_options_page' );
 
 
/**
 * Top level menu callback function
 */
function wporg_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
 
    // add error/update messages
 
    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
    }
 
    // show error/update messages
    settings_errors( 'wporg_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg"
            settings_fields( 'wporg' );
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections( 'wporg' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

?>