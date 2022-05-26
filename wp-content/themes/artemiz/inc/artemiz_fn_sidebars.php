<?php

/* ------------------------------------------------------------------------ */
/* Define Sidebars */
/* ------------------------------------------------------------------------ */

add_action( 'widgets_init', 'artemiz_fn_widgets_init', 1000 );


function artemiz_fn_widgets_init() {
	if (function_exists('register_sidebar')) {
		
		global $artemiz_fn_option;
		
		if(isset($artemiz_fn_option['footer_instagram']) && isset($artemiz_fn_option['footer_switch']) && $artemiz_fn_option['footer_instagram'] === 'enable' && $artemiz_fn_option['footer_switch'] === 'enable'){
			/* ------------------------------------------------------------------------ */
			/* Footer Left Part Widget
			/* ------------------------------------------------------------------------ */
			
			register_sidebar(array(
				'name' => 'Footer Instagram Widget',
				'id'   => 'footer-instagram-widget',
				'description'   => esc_html__('This is widget for footer (instagram).', 'artemiz'),
				'before_widget' => '<div id="%1$s" class="widget_block clearfix %2$s"><div>',
				'after_widget'  => '</div></div>',
				'before_title'  => '<div class="wid-title"><span>',
				'after_title'   => '</span></div>'
			));

		}
		
		register_sidebar(array(
			'name' => 'Footer Widget #1',
			'id'   => 'footer-widget-1',
			'description'   => esc_html__('This is widget for footer columns.', 'artemiz'),
			'before_widget' => '<div id="%1$s" class="widget_block clearfix %2$s"><div>',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="wid-title"><span>',
			'after_title'   => '</span></div>'
		));
		
		register_sidebar(array(
			'name' => 'Footer Widget #2',
			'id'   => 'footer-widget-2',
			'description'   => esc_html__('This is widget for footer columns.', 'artemiz'),
			'before_widget' => '<div id="%1$s" class="widget_block clearfix %2$s"><div>',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="wid-title"><span>',
			'after_title'   => '</span></div>'
		));
		
		register_sidebar(array(
			'name' => 'Footer Widget #3',
			'id'   => 'footer-widget-3',
			'description'   => esc_html__('This is widget for footer columns.', 'artemiz'),
			'before_widget' => '<div id="%1$s" class="widget_block clearfix %2$s"><div>',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="wid-title"><span>',
			'after_title'   => '</span></div>'
		));
		
		
		/* ------------------------------------------------------------------------ */
		/* Sidebar Widgets
		/* ------------------------------------------------------------------------ */
		register_sidebar(array(
			'name' => 'Main Sidebar',
			'id'   => 'main-sidebar',
			'description'   => esc_html__('These are widgets for the sidebar.', 'artemiz'),
			'before_widget' => '<div id="%1$s" class="widget_block clear %2$s"><div>',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="wid-title"><span>',
			'after_title'   => '</span></div>'
		));
	}
}

    
?>