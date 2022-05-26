<?php 
	global $artemiz_fn_option, $post;
	
	$main_nav 	= array('theme_location'  => 'main_menu','menu_class' => 'artemiz_fn_main_nav nav__hor', 'echo' => false);
	

	$allLogos 	= artemiz_fn_getLogo();
	$lightLogo	= $allLogos[0];
	$darkLogo	= $allLogos[1];
	


	
	// get navigation width
	$navigationWidth			= 'full';
	if(isset($artemiz_fn_option['one_line_nav_width'])){
		$navigationWidth		= $artemiz_fn_option['one_line_nav_width'];
	}
	if(isset($_GET['width'])){$navigationWidth = $_GET['width'];}
	
	// get navigation padding left and right
	$paddingLeftRightSize		= 50;
	$paddingLeftRightUnit		= 'px';
	if(isset($artemiz_fn_option['one_line_left_right']['width']) && isset($artemiz_fn_option['one_line_left_right']['units'])){
		$paddingLeftRightSize	= (int)$artemiz_fn_option['one_line_left_right']['width'];
		$paddingLeftRightUnit	= $artemiz_fn_option['one_line_left_right']['units'];
	}
	if($navigationWidth == 'full'){
		if($paddingLeftRightUnit != 'px' && $paddingLeftRightUnit != '%'){$paddingLeftRightUnit = 'px';}
		$size					= $paddingLeftRightSize.$paddingLeftRightUnit;
		$paddingCSS				= '.artemiz_fn_one_line.full{padding-left:'.$size.';padding-right:'.$size.';}';
	}
	
	// get navigation position
	$navigationPos				= 'relative';
	if(isset($artemiz_fn_option['one_line_position'])){
		$navigationPos			= $artemiz_fn_option['one_line_position'];
	}
	if(function_exists('rwmb_meta')){
		$navigationPos 			= get_post_meta(get_the_ID(),'artemiz_fn_page_nav_position', true);
		if($navigationPos === 'default' && isset($artemiz_fn_option['one_line_position'])){
			$navigationPos 		= $artemiz_fn_option['one_line_position'];
		}
	}
	if(isset($artemiz_fn_option['one_line_position'])){
		if($navigationPos === 'undefined' || $navigationPos === ''){
			$navigationPos 		= $artemiz_fn_option['one_line_position'];
		}
	}
	
	// get navigation skin
	$navigationSkin				= artemiz_fn_getLinesNavSkin('one_line');
	if($navigationSkin != 'dark' && $navigationSkin != 'light' && $navigationPos != ''){$navigationPos = 'absolute';}



	if($navigationSkin == 'light' || $navigationSkin == 'translight' || $navigationSkin == 'nonedark' || $navigationSkin == ''){
		$defaultLogo 	= $lightLogo;
	}else{
		$defaultLogo 	= $darkLogo;
	}
	$logo				= '<div class="fn_logo"><a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($defaultLogo).'" alt="'.esc_attr__('Site Logo', 'artemiz').'" /></a></div>';
	$hiddenLogo			= '<div class="fn_logo" style="display:none;"><a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($defaultLogo).'" alt="'.esc_attr__('Site Logo', 'artemiz').'" /></a></div>';

	$socialList			= artemiz_fn_getSocialList('nav_');
	$search				= '<a href="#">'.artemiz_fn_getSVG_theme('search-new').'</a>';


	if(has_nav_menu('main_menu')){
		$menu 			= wp_nav_menu( $main_nav );
	}else{
		$menu 			= '<ul class="nav__hor"><li><a href="">'.esc_html__('No menu assigned', 'artemiz').'</a></li></ul>';
	}

	$middleLogo			= false;
	$menuCount			= 1;
	if(isset($artemiz_fn_option['one_line_middle_logo_in_nav'])){
		$middleLogo		= $artemiz_fn_option['one_line_middle_logo_in_nav'];
	}
	// ********************************************************************************************
	// DISABLED column
	// ********************************************************************************************
	if(isset($artemiz_fn_option['one_sorter']['disabled']) && !empty($artemiz_fn_option['one_sorter']['disabled'])){
		foreach($artemiz_fn_option['one_sorter']['disabled'] as $key => $value){
			if($key == 'menu'){$menuCount = 0;}
		}
	}
	
	if($middleLogo && $menuCount == 1){
		$logo			= $hiddenLogo;
	}

	
	if(isset($_GET['middle_logo'])){
		$middleLogo		= true;
		$logo			= $hiddenLogo;
	}
		
	// ********************************************************************************************
	// get LEFT
	// ********************************************************************************************

	$left 		= '<div class="tt_left">';
	if(isset($artemiz_fn_option['one_sorter']['left']) && !empty($artemiz_fn_option['one_sorter']['left'])){
		foreach($artemiz_fn_option['one_sorter']['left'] as $key => $value){
			if($key == 'social' && $socialList == ''){
				$key = '';
			}
			switch($key){
				case '': break;
				case 'menu': 			$left .= '<div class="tt_left_item tt_item_'.$key.'">'.$menu.'</div>'; break;
				case 'search': 			$left .= '<div class="tt_left_item tt_item_'.$key.'">'.$search.'</div>'; break;
				case 'social': 			$left .= '<div class="tt_left_item tt_item_'.$key.'">'.$socialList.'</div>'; break;
				case 'logo': 			$left .= '<div class="tt_left_item tt_item_'.$key.'">'.$logo.'</div>'; break;
			}
		}
	}
	$left 		.= '</div>';

	// ********************************************************************************************
	// get CENTER
	// ********************************************************************************************
	$center 	= '<div class="tt_center">';
	if(isset($artemiz_fn_option['one_sorter']['center']) && !empty($artemiz_fn_option['one_sorter']['center'])){
		foreach($artemiz_fn_option['one_sorter']['center'] as $key => $value){
			if($key == 'social' && $socialList == ''){
				$key = '';
			}
			switch($key){
				case '': break;
				case 'menu': 			$center .= '<div class="tt_center_item tt_item_'.$key.'">'.$menu.'</div>'; break;
				case 'search': 			$center .= '<div class="tt_center_item tt_item_'.$key.'">'.$search.'</div>'; break;
				case 'social': 			$center .= '<div class="tt_center_item tt_item_'.$key.'">'.$socialList.'</div>'; break;
				case 'logo': 			$center .= '<div class="tt_center_item tt_item_'.$key.'">'.$logo.'</div>'; break;
			}
		}
	}
	$center 		.= '</div>';

	// ********************************************************************************************
	// get RIGHT
	// ********************************************************************************************
	$right 		= '<div class="tt_right">';
	if(isset($artemiz_fn_option['one_sorter']['right']) && !empty($artemiz_fn_option['one_sorter']['right'])){
		foreach($artemiz_fn_option['one_sorter']['right'] as $key => $value){
			if($key == 'social' && $socialList == ''){
				$key = '';
			}
			switch($key){
				case '': break;
				case 'menu': 			$right .= '<div class="tt_right_item tt_item_'.$key.'">'.$menu.'</div>'; break;
				case 'search': 			$right .= '<div class="tt_right_item tt_item_'.$key.'">'.$search.'</div>'; break;
				case 'social': 			$right .= '<div class="tt_right_item tt_item_'.$key.'">'.$socialList.'</div>'; break;
				case 'logo': 			$right .= '<div class="tt_right_item tt_item_'.$key.'">'.$logo.'</div>'; break;
			}
		}
	}
	$right 		.= '</div>';
	
	$localNav	= $left.$center.$right;
	if(isset($globalNav)){
		if($globalNav != ""){
			$localNav = $globalNav;
		}
	}

	if(!isset($artemiz_fn_option)){
		$left 		= '<div class="tt_left"><div class="tt_left_item tt_item_logo">'.$logo.'</div></div>';
		$center 	= '<div class="tt_center"><div class="tt_center_item tt_item_menu">'.$menu.'</div></div>';
		$right 		= '<div class="tt_right"><div class="tt_right_item tt_item_search">'.$search.'</div></div>';
		$localNav	= $left.$center.$right;
	}
	
	$echoHTML			 = '<div class="artemiz_fn_one_line '.$navigationWidth.'" style="position:'.esc_attr($navigationPos).';" data-middle-logo="'.$middleLogo.'" data-position="'.esc_attr($navigationPos).'" data-skin="'.esc_attr($navigationSkin).'">';

		$echoHTML			.= '<div class="fn_container">';
			$echoHTML			.= '<div class="one_line_in">';
				$echoHTML			.= $localNav;
			$echoHTML			.= '</div>';
		$echoHTML			.= '</div>';

	
	
	
	
		
?>

<?php echo wp_kses_post($echoHTML); ?>



	<!-- SEARCH POPUP -->
	<div class="artemiz_fn_searchpopup">
		<div class="search_inner">
			<div class="fn_container">
				<div class="search_box">
					<form action="<?php echo esc_url(home_url('/')); ?>" method="get" >
						<input type="text" placeholder="<?php esc_attr_e('Search', 'artemiz');?>" name="s" autocomplete="off" />
						<input type="submit" class="pe-7s-search" value="" />
						<a href="#"><?php echo wp_kses_post(artemiz_fn_getSVG_theme('search-new'));?></a>
					</form>
				</div>
			</div>
			<div class="search_closer">
				<span class="s_text"><?php esc_html_e('Close', 'artemiz');?></span>
				<span class="s_btn"></span>
			</div>
		</div>
	</div>
	<!-- /SEARCH POPUP -->

</div>