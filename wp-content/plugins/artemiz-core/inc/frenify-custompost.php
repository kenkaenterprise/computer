<?php



if( ! class_exists( 'ARTEMIZ_Frenify_Custom_Post' ) ) {
	class ARTEMIZ_Frenify_Custom_Post {

		function __construct() {
			// podcast
			add_action( 'init', array( $this, 'podcast_init' ) );
			add_action( 'init', array( $this, 'podcast_taxonomy_init' ) );
			
			
			// changing "Featured Image" text for custom post type
		}

		
		
		/********************************************************/
		/*  Podcast post registr
		/********************************************************/
		
		function podcast_init() {
			
			global $artemiz_fn_option;
			
			$podcast_slug = 'podcast';
			if(isset($artemiz_fn_option['podcast_slug']) && $artemiz_fn_option['podcast_slug'] != ''){
				$podcast_slug = $artemiz_fn_option['podcast_slug'];
			}
			$podcast_bread_title = esc_html__( 'Podcast Posts', 'frenify-core' );
			if(isset($artemiz_fn_option['podcast_bread_title']) && $artemiz_fn_option['podcast_bread_title'] != ''){
				$podcast_bread_title = $artemiz_fn_option['podcast_bread_title'];
			}
			
			
			
			// Labels for display service podcasts
			$labels = array(
				'name'					=> esc_html__( 'Podcast Posts', 'frenify-core' ),
				'singular_name'			=> esc_html__( 'Podcast Post', 'frenify-core' ),
				'menu_name'				=> esc_html__( 'Podcast Posts', 'frenify-core' ),
				'name_admin_bar' 		=> esc_html__( 'Podcast Posts', 'frenify-core' ),
				'add_new'				=> esc_html__( 'Add New', 'frenify-core' ),
				'add_new_item'			=> esc_html__( 'Add New Podcast Post', 'frenify-core' ),
				'edit_item' 			=> esc_html__( 'Edit Podcast Post', 'frenify-core' ),
				'new_item' 				=> esc_html__( 'New Podcast Post', 'frenify-core' ),
				'view_item' 			=> esc_html__( 'View Podcast Post', 'frenify-core' ),
				'search_items' 			=> esc_html__( 'Search Podcast Posts', 'frenify-core' ),
				'not_found' 			=> esc_html__( 'No Podcast posts found', 'frenify-core' ),
				'not_found_in_trash'	=> esc_html__( 'No Podcast posts found in trash', 'frenify-core' ),
				'all_items' 			=> esc_html__( 'Podcast Posts', 'frenify-core' )
			);
		
			// Arguments for service podcasts
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_in_nav_menus' 	=> true,
				'show_in_admin_bar' 	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_position'			=> 4,
				'menu_icon'				=> 'dashicons-portfolio', //XXS_PLUGIN_URI . 'assets/img/podcast-icon.png',
				'can_export'			=> true,
				'delete_with_user'		=> false,
				'hierarchical'			=> false,
				'has_archive'			=> true,
				'capability_type'		=> 'post',
				'rewrite'				=> array( 'slug' => $podcast_slug, 'with_front' => false ),
				'supports'				=> array( 'title', 'editor', 'thumbnail' )
			);
		
			// Register our podcast post type
			register_post_type( 'artemiz-podcast', $args );
		}
		
		function podcast_taxonomy_init() {
			
			global $artemiz_fn_option;
			
			$slug = 'podcast-cat';
			if(isset($artemiz_fn_option['podcast_cat_slug']) && $artemiz_fn_option['podcast_cat_slug'] != ''){
				$slug = $artemiz_fn_option['podcast_cat_slug'];
			}
		
			// Label for 'podcast category' taxonomy
			$labels = array(
				'name'							=> esc_html__( 'Podcast Categories', 'frenify-core' ),
				'singular_name'					=> esc_html__( 'Podcast Category', 'frenify-core' ),
				'menu_name'						=> esc_html__( 'Podcast Categories', 'frenify-core' ),
				'edit_item'						=> esc_html__( 'Edit Category', 'frenify-core' ),
				'update_item'					=> esc_html__( 'Update Category', 'frenify-core' ),
				'add_new_item'					=> esc_html__( 'Add New Category', 'frenify-core' ),
				'new_item_name'					=> esc_html__( 'New Category Name', 'frenify-core' ),
				'parent_item'					=> esc_html__( 'Parent Category', 'frenify-core' ),
				'parent_item_colon'				=> esc_html__( 'Parent Category:', 'frenify-core' ),
				'all_items'						=> esc_html__( 'All Categories', 'frenify-core' ),
				'search_items'					=> esc_html__( 'Search Categories', 'frenify-core' ),
				'popular_items'					=> esc_html__( 'Popular Categories', 'frenify-core' ),
				'separate_items_with_commas'	=> esc_html__( 'Separate Categoriess with commas', 'frenify-core' ),
				'add_or_remove_items'			=> esc_html__( 'Add or remove Categories', 'frenify-core' ),
				'choose_from_most_used'			=> esc_html__( 'Choose from the most used Categories', 'frenify-core' ),
				'not_found'						=> esc_html__( 'No Categories found', 'frenify-core' )
			);
		
			// Arguments for 'service category' taxonomy
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'show_ui' 			=> true,
				'show_in_nav_menus'	=> true,
				'show_admin_column'	=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true,
				'query_var'			=> true,
				'rewrite'			=> array( 'slug' => $slug, 'with_front' => false, 'hierarchical' => true )
			);
			
			// Register Taxanomy
			register_taxonomy( 'podcast_category', 'artemiz-podcast', $args );
			
			
		}
		
		
		
		
	
		
	}

	$artemiz_fn_custompost = new ARTEMIZ_Frenify_Custom_Post();
}