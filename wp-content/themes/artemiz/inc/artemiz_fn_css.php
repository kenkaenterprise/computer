<?php

function artemiz_fn_inline_styles() {
	
	global $artemiz_fn_option; 
	
	
	
	wp_enqueue_style('artemiz_fn_inline', get_template_directory_uri().'/framework/css/inline.css', array(), '1.0', 'all');
	/************************** START styles **************************/
	$artemiz_fn_custom_css 		= "";
	
	
	$nav_font_family 			= 'Heebo';
	$nav_font_size 				= '20px';
	$nav_font_weight 			= '500';
	if(isset($artemiz_fn_option['nav_font'])){
		$nav_font_family 		= $artemiz_fn_option['nav_font']['font-family'];
		$nav_font_size 			= $artemiz_fn_option['nav_font']['font-size'];
		$nav_font_weight 		= $artemiz_fn_option['nav_font']['font-weight'];
	}
	$submenu_font_family 		= 'Quicksand';
	$submenu_font_size 			= '16px';
	$submenu_font_weight 		= '500';
	if(isset($artemiz_fn_option['submenu_font'])){
		$submenu_font_family 	= $artemiz_fn_option['submenu_font']['font-family'];
		$submenu_font_size 		= $artemiz_fn_option['submenu_font']['font-size'];
		$submenu_font_weight	= $artemiz_fn_option['submenu_font']['font-weight'];
	}
	$nav_mob_font_family 		= 'Heebo';
	$nav_mob_font_size 			= '18px';
	$nav_mob_font_weight 		= '500';
	if(isset($artemiz_fn_option['nav_mob_font'])){
		$nav_mob_font_family 	= $artemiz_fn_option['nav_mob_font']['font-family'];
		$nav_mob_font_size 		= $artemiz_fn_option['nav_mob_font']['font-size'];
		$nav_mob_font_weight	= $artemiz_fn_option['nav_mob_font']['font-weight'];
	}
	$body_font_family 			= 'Heebo';
	$body_font_size 			= '18px';
	$body_font_weight 			= '400';
	if(isset($artemiz_fn_option['body_font'])){
		$body_font_family 		= $artemiz_fn_option['body_font']['font-family'];
		$body_font_size 		= $artemiz_fn_option['body_font']['font-size'];
		$body_font_weight 		= $artemiz_fn_option['body_font']['font-weight'];
	}
	$input_font_family 			= 'Heebo';
	$input_font_size 			= '14px';
	$input_font_weight 			= '400';
	if(isset($artemiz_fn_option['input_font'])){
		$input_font_family 		= $artemiz_fn_option['input_font']['font-family'];
		$input_font_size 		= $artemiz_fn_option['input_font']['font-size'];
		$input_font_weight		= $artemiz_fn_option['input_font']['font-weight'];
	}
	$heading_font_family 		= 'Neuton';
	$heading_font_weight 		= '400';
	if(isset($artemiz_fn_option['heading_font'])){
		$heading_font_family 	= $artemiz_fn_option['heading_font']['font-family'];
		$heading_font_weight 	= $artemiz_fn_option['heading_font']['font-weight'];
	}
	$blockquote_font_family 	= 'Lora';
	$blockquote_font_size 		= '20px';
	$blockquote_font_weight 	= '400';
	if(isset($artemiz_fn_option['blockquote_font'])){
		$blockquote_font_family = $artemiz_fn_option['blockquote_font']['font-family'];
		$blockquote_font_size 	= $artemiz_fn_option['blockquote_font']['font-size'];
		$blockquote_font_weight = $artemiz_fn_option['blockquote_font']['font-weight'];
	}
	
	
	$artemiz_fn_custom_css .= "
		ul.nav__hor > li > a{
			font-family:'{$nav_font_family}', Rubik, Arial, Helvetica, sans-serif; 
			font-size:{$nav_font_size};  
			font-weight:{$nav_font_weight};  
		}
		
		.artemiz_fn_one_line ul.sub-menu li a{
			font-family:'{$submenu_font_family}', Rubik, Arial, Helvetica, sans-serif; 
			font-size:{$submenu_font_size};  
			font-weight:{$submenu_font_weight};  
		}
		
		.artemiz_fn_mobilemenu_wrap .vert_menu_list a{
			font-family:'{$nav_mob_font_family}', Montserrat, Arial, Helvetica, sans-serif; 
			font-size:{$nav_mob_font_size};  
			font-weight:{$nav_mob_font_weight};  
		}
		body{
			font-family:'{$body_font_family}', Roboto, Arial, Helvetica, sans-serif; 
			font-size:{$body_font_size};  
			font-weight:{$body_font_weight};  
		}
		
		.uneditable-input, input[type=number], input[type=email], input[type=url], input[type=search], input[type=tel], input[type=color], input[type=text], input[type=password], input[type=datetime], input[type=datetime-local], input[type=date], input[type=month], input[type=time], input[type=week], input, button, select, textarea{
			font-family: '{$input_font_family}', Roboto, Arial, Helvetica, sans-serif; 
			font-size:{$input_font_size}; 
			font-weight:{$input_font_weight};
		}
		
		
		h1,h2,h3,h4,h5,h6{
			font-family: '{$heading_font_family}', Rubik, Arial, Helvetica, sans-serif;
			font-weight:{$heading_font_weight};
		}
		blockquote{
			font-family: '{$blockquote_font_family}', Lora, Arial, Helvetica, sans-serif; 
			font-size:{$blockquote_font_size}; 
			font-weight:{$blockquote_font_weight};
		}
	";
	
	
	// Heading Color
	$heading_color		= '#1e1e1e';
	if(isset($artemiz_fn_option['heading_color'])){
		$heading_color 	= $artemiz_fn_option['heading_color'];
	}
	// Primary Color
	$primary_color		= '#f3b469';
	if(isset($artemiz_fn_option['primary_color'])){
		$primary_color 	= $artemiz_fn_option['primary_color'];
	}
	// Mobile Background Color
	$mob_nav_bg_color		= '#0f0f16';
	if(isset($artemiz_fn_option['mob_nav_bg_color'])){
		$mob_nav_bg_color 	= $artemiz_fn_option['mob_nav_bg_color'];
	}
	// Mobile Hamburger Color
	$mob_nav_hamb_color		= '#ccc';
	if(isset($artemiz_fn_option['mob_nav_hamb_color'])){
		$mob_nav_hamb_color = $artemiz_fn_option['mob_nav_hamb_color'];
	}
	// Mobile Dropdown Color
	$mob_nav_ddbg_color		= '#f3b469';
	if(isset($artemiz_fn_option['mob_nav_ddbg_color'])){
		$mob_nav_ddbg_color = $artemiz_fn_option['mob_nav_ddbg_color'];
	}
	// Dropdown Link Regular Color
	$mob_nav_ddlink_color		= '#000';
	if(isset($artemiz_fn_option['mob_nav_ddlink_color'])){
		$mob_nav_ddlink_color 	= $artemiz_fn_option['mob_nav_ddlink_color'];
	}
	// Dropdown Link Hover Color
	$mob_nav_ddlink_ha_color		= '#fff';
	if(isset($artemiz_fn_option['mob_nav_ddlink_ha_color'])){
		$mob_nav_ddlink_ha_color 	= $artemiz_fn_option['mob_nav_ddlink_ha_color'];
	}
	
	
	// Footer Colors
	$footer_bg_2 		= '#0b0e13';
	if(isset($artemiz_fn_option['footer_bg_2'])){
		$footer_bg_2 	= $artemiz_fn_option['footer_bg_2'];
	}
	$footer_bg_1 		= '#fff';
	if(isset($artemiz_fn_option['footer_bg_1'])){
		$footer_bg_1 	= $artemiz_fn_option['footer_bg_1'];
	}

	$artemiz_fn_custom_css .= "
		.widget_block a,
		.artemiz_fn_404 h3,
		.widget_recent_entries a, .widget_recent_comments .recentcomments > a,
		#opt-in-hound-opt-in-1 .opt-in-hound-opt-in-content-wrapper .opt-in-hound-opt-in-heading,
		.widget_block.widget_recent_entries a,
		.comment-author-link, .comment-author-link a,
		.artemiz_fn_widget_trending ul li .title_holder h3,
		.artemiz_fn_widget_about .afwa_title h3,
		.artemiz_fn_author_info h3 a,
		.artemiz_fn_comment h4.author a,
		.artemiz_fn_comment h4.author,
		.artemiz_fn_comment p.logged-in-as a,
		h1 > a, h2 > a, h3 > a, h4 > a, h5 > a, h6 > a,
		h1, h2, h3, h4, h5, h6{color: {$heading_color};}
		
		
		.artemiz_fn_sidebar .widget_nav_menu ul li.opened > a,
		.widget_nav_menu ul li a:hover,
		.widget_block.widget_recent_entries a:hover,
		.widget_block a:hover,
		.wp-block-search .wp-block-search__button:hover,
		a.artemiz_fn_like.liked,
		ul.artemiz_fn_postlist .read_holder p a,
		.artemiz_fn_comment h4.author a:hover,
		.artemiz_fn_author_info h3 a:hover,
		.artemiz_fn_related_posts .related_title_holder span:after,
		.artemiz_fn_nothing_found input[type='submit']:hover,
		.artemiz_fn_404 input[type='submit']:hover,
		.artemiz_fn_pagetitle h3 span,
		.artemiz_fn_pagetitle h3:after,
		.wid-title span:after{color: {$primary_color};}
		
		.widget_block.widget_tag_cloud a:hover,
		.widget_block.widget_meta a:hover,
		.artemiz_fn_widget_estimate .bfwe_inner,
		.artemiz_fn_widget_social ul li a:hover,
		.wp-calendar-nav a:hover,
		.wp-block-tag-cloud a:hover,
		.wp-block-search .wp-block-search__button,
		.artemiz_fn_sharebox ul a:hover,
		ul.artemiz_fn_postlist .post:hover .date_meta a:hover,
		ul.artemiz_fn_postlist .fn_post_item_1 .date_meta a:hover,
		.artemiz_fn_author_meta .date_meta a:hover,
		ul.artemiz_fn_postlist .read_holder p a span,
		ul.artemiz_fn_postlist .read_holder p a span:after,
		ul.artemiz_fn_postlist .read_holder p a span:before,
		.artemiz_fn_pagination li span,
		.artemiz_fn_pagination li a:hover,
		.artemiz_fn_social_footer_list ul li a:hover,
		.artemiz_fn_social_list ul li a:hover,
		.artemiz_fn_comment #cancel-comment-reply-link:hover,
		.artemiz_fn_comment .comment-text .fn_reply a:hover,
		.artemiz_fn_comment input[type=submit],
		.artemiz_fn_post_header .post_header_content .date_meta a:hover,
		.artemiz_fn_tags a:hover,
		.artemiz_fn_author_info .artemiz_fn_social_list ul li a:hover,
		.artemiz_fn_related_posts .date_meta a:hover,
		.artemiz_fn_searchpopup .search_closer.closed .s_btn,
		.artemiz_fn_searchpopup .search_closer:hover .s_btn,
		.artemiz_fn_nothing_found input[type='submit'],
		.artemiz_fn_404 input[type='submit']{background-color: {$primary_color};}
		
		.artemiz_fn_rightsidebar .opt-in-hound-opt-in-form-wrapper .opt-in-hound-opt-in-form-button button{background-color: {$primary_color} !important;}

		.artemiz_fn_rightsidebar .opt-in-hound-opt-in-form-wrapper .opt-in-hound-opt-in-form-button button:hover{color: {$primary_color} !important;}

		.artemiz_fn_widget_estimate .helper5,
		code, pre, blockquote,
		.artemiz_fn_widget_estimate .helper1{border-left-color: {$primary_color};}

		.artemiz_fn_widget_estimate .helper6,
		.artemiz_fn_widget_estimate .helper2{border-right-color: {$primary_color};}
		
		.artemiz_fn_related_posts .date_meta a:hover,
		ul.artemiz_fn_postlist .fn_post_item_1 .date_meta a:hover,
		.artemiz_fn_author_meta .date_meta a:hover,
		.artemiz_fn_post_header .post_header_content .date_meta a:hover,
		ul.artemiz_fn_postlist .post:hover .date_meta a:hover{border-color: {$primary_color};}
		
		
		
		.artemiz_fn_mobilemenu_wrap .logo_hamb{background-color: {$mob_nav_bg_color};}
		
		.hamburger .hamburger-inner::before,
		.hamburger .hamburger-inner::after,
		.hamburger .hamburger-inner{background-color: {$mob_nav_hamb_color};}
		
		
		.artemiz_fn_mobilemenu_wrap .mobilemenu{background-color: {$mob_nav_ddbg_color};}
		
		.artemiz_fn_mobilemenu_wrap .vert_menu_list li.menu-item-has-children > a:after{border-left-color: {$mob_nav_ddlink_color};}
		.artemiz_fn_mobilemenu_wrap .vert_menu_list a{color: {$mob_nav_ddlink_color};}
		
		.artemiz_fn_mobilemenu_wrap .vert_menu_list li.active.menu-item-has-children > a,
		.artemiz_fn_mobilemenu_wrap .vert_menu_list a:hover{color: {$mob_nav_ddlink_ha_color};}
		
		.artemiz_fn_mobilemenu_wrap .vert_menu_list li.menu-item-has-children:hover > a:after,
		.artemiz_fn_mobilemenu_wrap .vert_menu_list li.active.menu-item-has-children > a:after{border-left-color: {$mob_nav_ddlink_ha_color};}

	
		.artemiz_fn_footer .footer_instagram .follow,
		.artemiz_fn_footer .footer_instagram{background-color: {$footer_bg_1};}
		.artemiz_fn_footer .footer_bottom{background-color: {$footer_bg_2};}
		
		.artemiz_fn_footer .wp-block-archives a,
		.artemiz_fn_footer .widget_archive a,
		.artemiz_fn_footer .widget_categories a,
		.artemiz_fn_footer .widget_categories a{background-color: {$footer_bg_2};}
		";
	
	
	
	// since v1.2
	$author_info_responsive = true;
	if(isset($artemiz_fn_option['author_info_responsive'])){
		$author_info_responsive = $artemiz_fn_option['author_info_responsive'];
	}
	if(!$author_info_responsive){
		$artemiz_fn_custom_css .= "
			@media(max-width: 480px){.artemiz_fn_author_meta{display: none;}}
		";	
	}
	
	// since v1.2
	
	$fixedTotopBottomCoord			= 50;
	$fixedTotopRightCoord			= 50;
	if(isset($artemiz_fn_option['totop_fixed_coordinate']['margin-bottom'])){
		$fixedTotopBottomCoord 		= (int)$artemiz_fn_option['totop_fixed_coordinate']['margin-bottom'];
	}
	if(isset($artemiz_fn_option['totop_fixed_coordinate']['margin-right'])){
		$fixedTotopRightCoord 		= (int)$artemiz_fn_option['totop_fixed_coordinate']['margin-right'];
	}
	$artemiz_fn_custom_css .= "
		.artemiz_fn_totop{bottom: {$fixedTotopBottomCoord}px;right: {$fixedTotopBottomCoord}px;}
	";
	
	
	// since v2.0
	$podcast_border_radius = 3;
	if(isset($artemiz_fn_option['podcast_border_radius'])){
		$podcast_border_radius	= $artemiz_fn_option['podcast_border_radius'];
	}
	if(isset($_GET['br'])){
		$podcast_border_radius 	= $_GET['br'];
	}
	$artemiz_fn_custom_css .= "
		.artemiz_fn_podcast__list li.active .artemiz_fn_audio_button a:after,
		.artemiz_fn_podcast__list .artemiz_fn_audio_button a:hover:after,
		.artemiz_fn_podcast__list.fn_interactive .right_inner,
		.artemiz_fn_podcast__list .item{border-radius: {$podcast_border_radius}px;}
		.artemiz_fn_podcast__list .img_holder{border-top-right-radius: {$podcast_border_radius}px;border-bottom-right-radius: {$podcast_border_radius}px;}
	";
	/****************************** END styles *****************************/
	if(isset($artemiz_fn_option['custom_css'])){
		$artemiz_fn_custom_css .= "{$artemiz_fn_option['custom_css']}";	
	}

	wp_add_inline_style( 'artemiz_fn_inline', $artemiz_fn_custom_css );

			
}

?>