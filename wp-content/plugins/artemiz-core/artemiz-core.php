<?php
/*
Plugin Name: Artemiz Core
Plugin URI: https://themeforest.net/item/artemiz-blog-podcast-wordpress-theme/28455063
Description: Artemiz Core Plugin for Artemiz Theme
Version: 2.0
Author: Frenify
Author URI: https://frenify.com/
*/

// since v2.0
define ('ARTEMIZ_PLUGIN_URL', plugin_dir_url(__FILE__));
define ('ARTEMIZ_PLUGIN_VERSION', '2.0');
define ('ARTEMIZ_TEXT_DOMAIN', 'artemiz-core' );

// since v2.0
// redirect to settings page after installation
register_setting('artemiz__options', 'artemiz__welcome_page', array('default' => 'no'));
function artemiz_fn_redirect() {
	if(get_option('artemiz__welcome_page', 'no') != 'yes'){
		update_option('artemiz__welcome_page','yes');
		wp_safe_redirect( admin_url( 'admin.php?page=artemiz' ) );
		exit;
	}
}
add_action( 'plugins_loaded', 'artemiz_fn_redirect' );
function artemiz_fn_reset( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
		update_option('artemiz__welcome_page','no');
    }
}
add_action( 'activated_plugin', 'artemiz_fn_reset' );
 
			
define ( 'ARTEMIZ_CORE_SHORTCODE_URL', ARTEMIZ_PLUGIN_URL . 'shortcode/');
define ( 'ARTEMIZ_PLACEHOLDERS_URL', ARTEMIZ_PLUGIN_URL . 'shortcode/assets/img/placeholders/');


// Custom Meta tags for Sharing

add_action('wp_head', 'artemiz_fn_open_graph_meta');

function artemiz_fn_open_graph_meta(){
	global $post, $artemiz_fn_option;
	
	// enable or disable via theme options
	if(isset($artemiz_fn_option['open_graph_meta']) && $artemiz_fn_option['open_graph_meta'] == 'enable'){
	
		$image = '';
		if(isset($post)){
			if (has_post_thumbnail( $post->ID ) ) {
				$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$image = esc_attr( $thumbnail_src[0] );
		}}?>

		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:type" content="article"/>
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:site_name" content="<?php echo esc_html(get_bloginfo( 'name' )); ?>" />
		<meta property="og:description" content="<?php echo artemiz_fn_excerpt(12); ?>" />

		<?php if ( $image != '' ) { ?>
			<meta property="og:image" content="<?php echo esc_url($image); ?>" />
		<?php }
	}
}
		add_action( 'init', 'translation' );
		// Load text domain
		function translation() 
		{
			load_plugin_textdomain( 'frenify-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}
/*----------------------------------------------------------------------------*
 * Plugins
 *----------------------------------------------------------------------------*/
	
	if (!class_exists('ReduxFramework') && file_exists(plugin_dir_path(__FILE__) . '/optionpanel/framework.php'))
    {
    	require_once ('optionpanel/framework.php');
 
    }
 
	if (!isset($redux_demo) && file_exists(plugin_dir_path(__FILE__) . '/opt/config.php'))
    {
    	require_once ('opt/config.php');
 
    }

    // Load Theme Options Panel

	include_once(plugin_dir_path( __FILE__ ) . 'shortcode/frel-core.php');


	include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-business-hours.php');		// Load Widgets
	include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-estimate.php');				// Load Widgets
	include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-brochure.php');				// Load Widgets
	include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-about.php');				// Load Widgets
	include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-social.php');				// Load Widgets
	include_once( plugin_dir_path( __FILE__ ) . 'inc/widgets/widget-trending-news.php');		// Load Widgets


	add_filter( 'plugin_row_meta', 'artemiz_core_fn_plugin_row_meta', 10, 2 );

 	function artemiz_core_fn_plugin_row_meta( $plugin_meta, $plugin_file ) {
		if ( 'artemiz-core/artemiz-core.php' === $plugin_file ) {
			$row_meta = [
				'docs' 		=> '<a href="https://frenify.com/envato/frenify/wp/artemiz/doc/" target="_blank">Docs</a>',
				'faq' 		=> '<a href="https://frenify.com/envato/frenify/wp/artemiz/doc/#faq" target="_blank">FAQs</a>',
				'changelog' => '<a href="https://frenify.com/envato/frenify/wp/artemiz/doc/#changelog" target="_blank">Changelog</a>',
			];

			$plugin_meta = array_merge( $plugin_meta, $row_meta );
		}

		return $plugin_meta;
	}


	add_action( 'plugins_loaded', 'artemiz_fn_plugin_setup' );
	function artemiz_fn_plugin_setup(){

		// Load Meta Boxes
		include_once(plugin_dir_path( __FILE__ ) . 'inc/meta-box/metabox-config.php');

		// Call to Custom Post types and Functions
		include_once(plugin_dir_path( __FILE__ ) . 'inc/frenify-custompost.php');
		
		// Call to Custom Functions
		include_once(plugin_dir_path( __FILE__ ) . 'inc/frenify_custom_functions.php');
		
		

		// Call to Demo Import
		// since v2.0
		include_once(plugin_dir_path( __FILE__ ) . 'inc/demoimport/one-click-demo-import.php');
		include_once(plugin_dir_path( __FILE__ ) . 'inc/demoimport/demo-list.php');
		
		
		// Call Settings
		// since v2.0
		include_once(plugin_dir_path( __FILE__ ) . 'inc/settings/settings.php');
	}
