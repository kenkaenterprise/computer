<?php

namespace Frel;

// Exit if accessed directly. 
if ( ! defined( 'ABSPATH' ) ) { exit; }


// Main Plugin Class
class Frel_Plugin
{
	
	
    // Constructor
    public function __construct()
    {
        $this->add_actions();
		
    }
    
    
	// Add Actions
    private function add_actions()
    {
        // Add New Elementor Categories
        add_action( 'elementor/init', array( $this, 'add_elementor_category' ), 999 );
        // Register Widget Scripts
        add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'register_widget_scripts' ) );
        // Register Widget Styles
        add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'register_widget_styles' ) );
        // Register New Widgets
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ), 10 );
		
		add_action( 'elementor/editor/before_enqueue_scripts', function() {
			wp_enqueue_style( 'frel_elementor', ARTEMIZ_PLUGIN_URL . 'assets/css/elementor.css', false, ARTEMIZ_PLUGIN_VERSION, 'all' );
		});
		
		// since v1.5
		add_action( 'wp_head', array( $this, 'register_theme_style' ) );
		
		add_action( 'admin_notices', array( $this, 'compare_core_and_theme' ), 999 );
    }
	
    
    public function register_theme_style()
    {
		wp_enqueue_style( 'artemiz_theme_style_from_plugin', ARTEMIZ_PLUGIN_URL . 'assets/css/theme-style.css', false, ARTEMIZ_PLUGIN_VERSION, 'all' );
    }
	
	public function compare_core_and_theme() {
		if(wp_get_theme()->get('Name') == 'Artemiz'){
			$my_theme 			= wp_get_theme( 'Artemiz' );
			if ( $my_theme->exists() ){
				$themeVersion 	= esc_html( $my_theme->get('Version') );
				$pluginVersion 	= ARTEMIZ_PLUGIN_VERSION;
				$artemizCore	= 'Artemiz Core';
				if(version_compare($themeVersion,  $pluginVersion) > 0){
					$class 		= 'notice notice-warning is-dismissible';
					$pluginsURI = get_dashboard_url().'plugins.php';
					$title		= '<br /><strong>Warning! Update "'.$artemizCore.'" plugin.</strong><br />';
					$pluginsURL = '<strong><a href="'.$pluginsURI.'">'.$pluginsURI.'</a></strong>';
					printf( '<div class="%ARTEMIZ_PLUGIN_VERSION$s">%5$s<p>Please, make sure that you have updated %6$s for Artemiz Theme. Because, you have installed <strong>%6$s</strong> version <u><strong>%2$s</strong></u>, but your <strong>Artemiz theme</strong> has version <u><strong>%3$s</strong></u><br /> Just disable and remove %6$s from your plugins %4$s and install required plugin. Otherwise, new shortcodes and innovations will not be possible with old version of the plugin.</p><br /></div>', esc_attr( $class ), esc_html( $pluginVersion ), esc_html( $themeVersion ), $pluginsURL, $title, $artemizCore );
				}
			}
		}
	}
	
    // Add New Categories to Elementor
    public function add_elementor_category()
    {
        \Elementor\Plugin::instance()->elements_manager->add_category( 'frel-elements', array(
            'title' => __( 'Frel Elements', 'frenify-core' ),
        ), 1 );
    }
    
    // Register Widget Scripts
    public function register_widget_scripts()
    {
		wp_enqueue_script( 'jquery.event.move', plugins_url( 'assets/js/jquery.event.move.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'jquery.twentytwenty', plugins_url( 'assets/js/jquery.twentytwenty.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'ripples', plugins_url( 'assets/js/ripples.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'glitch', plugins_url( 'assets/js/glitch.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'fullpage', plugins_url( 'assets/js/fullpage.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'fullpage.extensions.min', plugins_url( 'assets/js/fullpage.extensions.min.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'flickity', plugins_url( 'assets/js/flickity.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'particles', plugins_url( 'assets/js/particles.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'jarallax', plugins_url( 'assets/js/jarallax.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'typed', plugins_url( 'assets/js/typed.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'frel_accordion', plugins_url( 'assets/js/accordion.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'countto', plugins_url( 'assets/js/countto.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'waypoints', plugins_url( 'assets/js/waypoints.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'isotope', plugins_url( 'assets/js/isotope.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'frel_kenburnsy', plugins_url( 'assets/js/kenburnsy.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'swiper', plugins_url( 'assets/js/swiper.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'parallax', plugins_url( 'assets/js/parallax.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'frel_parallax', plugins_url( 'assets/js/frel_parallax.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'hover_3d', plugins_url( 'assets/js/jquery.hover3d.min.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'owl-carousel', plugins_url( 'assets/js/owl-carousel.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		
		
		wp_enqueue_script( 'frel_init', ARTEMIZ_PLUGIN_URL . 'assets/js/init.js', array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
		
		
		add_action( 'wp_footer', function() {
			wp_enqueue_script( 'frel_ajax', plugins_url( 'assets/js/ajax.js', __FILE__ ), array( 'jquery' ), true, ARTEMIZ_PLUGIN_VERSION, 'all' );
			wp_localize_script( 'frel_ajax', 'fn_ajax_object', array( 'fn_ajax_url' => admin_url( 'admin-ajax.php' )) );
		});
		
    }
	
    // Register Widget Styles
    public function register_widget_styles()
    {
		wp_enqueue_style( 'twenty-twenty', plugins_url( 'assets/css/twenty-twenty.css', __FILE__ ), false, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_style( 'fullpage', plugins_url( 'assets/css/fullpage.css', __FILE__ ), false, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_style( 'swiper', plugins_url( 'assets/css/swiper.css', __FILE__ ), false, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_style( 'owl-theme-default', plugins_url( 'assets/css/owl-theme-default.css', __FILE__ ), false, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_style( 'owl-carousel', plugins_url( 'assets/css/owl-carousel.css', __FILE__ ), false, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_style( 'magnific-popup', plugins_url( 'assets/css/magnific-popup.css', __FILE__ ), false, ARTEMIZ_PLUGIN_VERSION, 'all' );
		wp_enqueue_style( 'frel_style', ARTEMIZ_PLUGIN_URL . 'assets/css/style.css', false, ARTEMIZ_PLUGIN_VERSION, 'all' );
    }
    
	
    // Register New Widgets
    public function register_widgets()
    {
        $this->include_widgets();
		$this->include_widget_outputs();
		
		// since v2.3
		// register RAW widgets
//        $this->include_raw_widgets();
		
		// since v2.3
		// register DEPRECATED widgets 
        $this->include_deprecated_widgets(); // i class: frenifyicon-deprecated	
    }
    
	
	// since v2.3
    // Include DEPRECATED Widgets
    private function include_deprecated_widgets()
    {
		foreach(glob(plugin_dir_path( __FILE__ ) . '/widgets/deprecated/*.php' ) as $file ){
			$this->include_widget( $file );
		}
    }
	
	// since v2.3
    // Include RAW Widgets
    private function include_raw_widgets()
    {
		foreach(glob(plugin_dir_path( __FILE__ ) . '/widgets/raw/*.php' ) as $file ){
			$this->include_widget( $file );
		}
		
    }
	
	
    // Include Widgets
    private function include_widgets()
    {
		foreach(glob(plugin_dir_path( __FILE__ ) . '/widgets/*.php' ) as $file ){
			$this->include_widget( $file );
		}
		
    }
	
	
	// Include and Load Widget
    private function include_widget($file)
    {
		
		$base  = basename( str_replace( '.php', '', $file ) );
		$class = ucwords( str_replace( '-', ' ', $base ) );
		$class = str_replace( ' ', '_', $class );
		$class = sprintf( 'Frel\Widgets\%s', $class );
		
		require_once $file; // include widget php file
		
		if ( class_exists( $class ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class ); // load widget class
		}
		
    }
	
	
	// call to widget outputs
	private function include_widget_outputs()
    {
		foreach(glob(plugin_dir_path( __FILE__ ) . '/widgets/output/*.php' ) as $file ){
			require_once $file;
		}
    }
	
	

}