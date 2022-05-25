<?php
if ( defined( 'ABSPATH' ) && ! defined( 'RWMB_VER' ) ) {
	require_once dirname( __FILE__ ) . '/inc/loader.php';
	$loader = new RWMB_Loader();
	$loader->init();
}

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign

$prefix = 'artemiz_fn_';
global $meta_boxes, $artemiz_fn_option;
$meta_boxes = array();




$ffn_nav_heading 		= array('type'		=> 'custom-html');
$ffn_nav_skin 	 		= array('type'		=> 'custom-html');
$portfolioLayoutMeta 	= array('type'		=> 'custom-html');

if(isset($artemiz_fn_option['one_line_nav_skin'])){

	$ffn_nav_heading = array(
		'name'		=> esc_html__('Page Navigation', 'artemiz'),
		'type'		=> 'heading',
	);
	$ffn_nav_skin = array(
		'name'		=> esc_html__('Navigation Skin', 'artemiz'),
		'id'		=> $prefix . "page_nav_color",
		'type'		=> 'select',
		'options'	=> array(
			'default'  		=> esc_html__('Default (from theme options)', 'artemiz'),
			'dark'  		=> esc_html__('Dark', 'artemiz'),
			'light'  		=> esc_html__('Light', 'artemiz'),
			'nonedark'  	=> esc_html__('NoneDark', 'artemiz'),
			'nonelight'  	=> esc_html__('NoneLight', 'artemiz'),
			'transdark'  	=> esc_html__('TransDark', 'artemiz'),
			'translight'  	=> esc_html__('TransLight', 'artemiz'),
		),
		'multiple'	=> false,
		'std'		=> 'default'
	);
}




/* ----------------------------------------------------- */
//  Page Options
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'page_main_options',
	'title' => esc_html__('Page Options', 'artemiz'),
	'pages' => array( 'page' ),
	'context' => 'normal',	
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		
		$ffn_nav_heading,
		$ffn_nav_skin,
		$portfolioLayoutMeta,
		array(
			'name'		=> esc_html__('Page Style', 'artemiz'),
			'type'		=> 'heading',
		),
		array(
			'name'		=> esc_html__('Page Style', 'artemiz'),
			'id'		=> $prefix . "page_style",
			'type'		=> 'select',
			'options'	=> array(
				'full'		=> esc_html__('Without Sidebar', 'artemiz'),
				'ws'		=> esc_html__('With Sidebar', 'artemiz'),

			),
			'multiple'	=> false,
			'std'		=> array( 'full' )
		),
		array(
			'name'		=> esc_html__('Page Sidebar', 'artemiz'),
			'id'		=> $prefix . "page_sidebar",
			'type'		=> 'select',
			'options'	=> '',
			'multiple'	=> false,
		),
		array(
			'name'		=> esc_html__('Layout for podcast page', 'artemiz'),
			'id'		=> $prefix . "podcast_layout",
			'type'		=> 'select',
			'options'	=> array(
				'default'		=> esc_html__('From Theme Options', 'artemiz'),
				'grid'			=> esc_html__('Grid', 'artemiz'),
				'list'			=> esc_html__('List', 'artemiz'),
				'interactive'	=> esc_html__('Interactive', 'artemiz'),

			),
			'multiple'	=> false,
			'std'		=> array( 'full' )
		),
		array(
			'name'		=> esc_html__('Page Title', 'artemiz'),
			'type'		=> 'heading',
		),
		array(
			'name'		=> esc_html__('Page Title', 'artemiz'),
			'id'		=> $prefix . "page_title",
			'type'		=> 'select',
			'options'	=> array(
				'enable'	=> esc_html__('Enable', 'artemiz'),
				'disable'	=> esc_html__('Disable', 'artemiz'),

			),
			'multiple'	=> false,
			'std'		=> array( 'enable' )
		),
		array(
			'name'		=> esc_html__('Page Spacing', 'artemiz'),
			'type'		=> 'heading',
		),	

		array(
			'name'		=> esc_html__('Padding Top', 'artemiz'),
			'desc'		=> '',
			'id'		=> $prefix . "page_padding_top",
			'type'		=> 'text',
			'size'  	=> 2,
			'std'		=> 0
		),
		array(
			'name'		=> esc_html__('Padding Bottom', 'artemiz'),
			'desc'		=> '',
			'id'		=> $prefix . "page_padding_bottom",
			'type'		=> 'text',
			'size'  	=> 2,
			'std'		=> 100
		),
	)
);






// GET DEFAULT LAYOUT FROM GLOBAL OPTIONS

/* ----------------------------------------------------- */
//  Page Options for portfolio and service
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'pagecom',
	'title' => esc_html__('Page Options', 'artemiz'),
	'pages' => array( 'artemiz-podcast'),
	'context' => 'normal',
	'priority' => 'default',

	// List of meta fields
	'fields' => array(
		$ffn_nav_heading,
		$ffn_nav_skin,
		
		array(
			"name" 					=> esc_html__('Local Audio URL', 'artemiz'),
			"desc" 					=> esc_html__('Audio URL of the Podcast (only local).', 'artemiz'),
			'type'        			=> 'textarea',
			'id'          			=> $prefix. 'podcast_local_audio_url',
		),
		array(
			'name'		=> esc_html__('Page Spacing', 'artemiz'),
			'type'		=> 'heading',
		),	
		
		array(
			'name'		=> esc_html__('Page Padding Top', 'artemiz'),
			'desc'		=> '',
			'id'		=> $prefix . "page_padding_top",
			'type'		=> 'text',
			'std'		=> 0
		),
		array(
			'name'		=> esc_html__('Page Padding Bottom', 'artemiz'),
			'desc'		=> '',
			'id'		=> $prefix . "page_padding_bottom",
			'type'		=> 'text',
			'std'		=> 100
		),
		
	)
);



/* ----------------------------------------------------- */
//  Post Options
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'frenify-postoption',
	'title' => esc_html__('Post Options', 'artemiz'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		
		
		$ffn_nav_heading,
		$ffn_nav_skin,
		
		array(
			'name'		=> esc_html__('Choose page style', 'artemiz'),
			'id'		=> $prefix . "page_style",
			'type'		=> 'select',
			'options'	=> array(
				'full'		=> esc_html__('Without Sidebar', 'artemiz'),
				'ws'		=> esc_html__('With Sidebar', 'artemiz'),
				
			),
			'multiple'	=> false,
			'std'		=> array( 'full' )
		),
	)
);




/**************************************************************************/
/*********************								***********************/
/********************* 		META BOX REGISTERING 	***********************/
/*********************								***********************/
/**************************************************************************/

/**
 * Register meta boxes
 *
 * @return void
 */
function artemiz_fn_register_meta_boxes()
{
	global $meta_boxes;
	global $artemiz_fn_option;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'artemiz_fn_register_meta_boxes' );