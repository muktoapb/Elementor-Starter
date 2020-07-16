<?php
/**
 * Plugin Name: Mukto toolkit
 * Description: Custom Elementor extension.
 * Plugin URI:  https://mukto.info/
 * Version:     1.0.0
 * Author:      Mukto
 * Author URI:  https://mukto.info/
 * Text Domain: mukto-toolkit
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function mukto_elementor_addon_script() {
	wp_enqueue_style( 'style-css', plugin_dir_url( __FILE__ ) . 'style.css', array(), time(), 'all' );
	wp_enqueue_style( 'owl-carousel', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), time(), 'all' );


	wp_enqueue_script( 'owl-carousel', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), '1.0.0', true );

	wp_enqueue_script( 'custom-js', plugin_dir_url( __FILE__ ) . 'custom.js', array('jquery'), time(), true );
}
add_action( 'wp_enqueue_scripts', 'mukto_elementor_addon_script' );


final class Elementor_Test_Extension {

	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '5.6';
	private static $_instance = null;
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	
	public function i18n() {

		load_plugin_textdomain( 'mukto_elementor_addon' );

	}

	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		// add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );

		// Register category 
		function add_elementor_widget_categories( $elements_manager ) {

			$elements_manager->add_category(
				'mukto',
				[
					'title' => __( 'Mukto Toolkit', 'mukto-toolkit' ),
					'icon' => 'fa fa-plug',
				]
			);
		
		}
		add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );
	}

	
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'mukto_elementor_addon' ),
			'<strong>' . esc_html__( 'Mukto Elementor addon', 'mukto_elementor_addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mukto_elementor_addon' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mukto_elementor_addon' ),
			'<strong>' . esc_html__( 'Mukto Elementor addon', 'mukto_elementor_addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mukto_elementor_addon' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mukto_elementor_addon' ),
			'<strong>' . esc_html__( 'Mukto Elementor addon', 'mukto_elementor_addon' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'mukto_elementor_addon' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	

    /* 
    *===========================
    * widgh area
    ===============================
    */
	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/acoordian.php' );
		require_once( __DIR__ . '/widgets/slider.php' );
		require_once( __DIR__ . '/widgets/analytic.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mukto_acordian_wedget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mukto_slider_wedget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \mukto_analytic_wedget() );

	}


	// public function init_controls() {

	// 	// Include Control files
	// 	require_once( __DIR__ . '/controls/test-control.php' );

	// 	// Register control
	// 	\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );

	// }

}

Elementor_Test_Extension::instance();
