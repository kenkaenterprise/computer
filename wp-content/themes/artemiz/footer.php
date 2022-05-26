<?php 
global $artemiz_fn_option;

$followDiv	= '';
if(isset($artemiz_fn_option['footer_instagram'])){
	$inst_switch	= $artemiz_fn_option['footer_instagram'];
	if($inst_switch == 'enable'){
		$followDiv	= '<div class="follow"><div class="following">'.artemiz_fn_getSVG_theme('instagram').'</div></div>';
	}
}

// text #1
$text1 			= esc_html__('Copyright &copy; 2020.', 'artemiz');
if(isset($artemiz_fn_option['footer_text_1'])){
	$text1 		= $artemiz_fn_option['footer_text_1'];
}
$text1__html	= '<p class="footer_text_1">'.$text1.'</p>';

// text #2
$text2 			= esc_html__('Developed by Frenify', 'artemiz');
if(isset($artemiz_fn_option['footer_text_2'])){
	$text2 		= $artemiz_fn_option['footer_text_2'];
}
$text2__html	= '<p class="footer_text_2">'.$text2.'</p>';

// menu

$menu__html		= '';
$footer_menu 	= array('theme_location'  => 'footer_menu','menu_class' => 'footer_nav', 'echo' => false);
if(has_nav_menu('footer_menu')){$menu__html = wp_nav_menu( $footer_menu );}

// top part
$social__html	= artemiz_fn_getSocialList('footer_');

$footer_widget_1 = $footer_widget_2 = $footer_widget_3 = '';
if( is_active_sidebar( 'footer-widget-1' )){ 
	ob_start();
	dynamic_sidebar('footer-widget-1');
	$footer_widget_1 = ob_get_contents();
	ob_end_clean();
}
if( is_active_sidebar( 'footer-widget-2' )){ 
	ob_start();
	dynamic_sidebar('footer-widget-2');
	$footer_widget_2 = ob_get_contents();
	ob_end_clean();
}
if( is_active_sidebar( 'footer-widget-3' )){ 
	ob_start();
	dynamic_sidebar('footer-widget-3');
	$footer_widget_3 = ob_get_contents();
	ob_end_clean();
}

// ********************************************************************************************
// get BOTTOM PART
// ********************************************************************************************

// bottom left
$bottomLeftStart	= '<div class="tt_left">';
$bottomLeft 		= '';
if(isset($artemiz_fn_option['footer_sorter']['left']) && !empty($artemiz_fn_option['footer_sorter']['left'])){
	foreach($artemiz_fn_option['footer_sorter']['left'] as $key => $value){
		switch($key){
			case 'social': 			$bottomLeft .= '<div class="left_item">'.$social__html.'</div>'; break;
			case 'text_1': 			$bottomLeft .= '<div class="left_item">'.$text1__html.'</div>'; break;
			case 'text_2': 			$bottomLeft .= '<div class="left_item">'.$text2__html.'</div>'; break;
			case 'menu': 			$bottomLeft .= '<div class="left_item">'.$menu__html.'</div>'; break;
			case 'footer-widget-1': $bottomLeft .= '<div class="left_item">'.$footer_widget_1.'</div>'; break;
			case 'footer-widget-2': $bottomLeft .= '<div class="left_item">'.$footer_widget_2.'</div>'; break;
			case 'footer-widget-3': $bottomLeft .= '<div class="left_item">'.$footer_widget_3.'</div>'; break;
		}
	}
}

$bottomLeftEnd 		= '</div>';

// bottom center
$bottomCenterStart	= '<div class="tt_center">';
$bottomCenter 		= '';
if(isset($artemiz_fn_option['footer_sorter']['center']) && !empty($artemiz_fn_option['footer_sorter']['center'])){
	foreach($artemiz_fn_option['footer_sorter']['center'] as $key => $value){
		switch($key){
			case 'social': 			$bottomCenter .= '<div class="center_item">'.$social__html.'</div>'; break;
			case 'text_1': 			$bottomCenter .= '<div class="center_item">'.$text1__html.'</div>'; break;
			case 'text_2': 			$bottomCenter .= '<div class="center_item">'.$text2__html.'</div>'; break;
			case 'menu': 			$bottomCenter .= '<div class="center_item">'.$menu__html.'</div>'; break;
			case 'footer-widget-1': $bottomCenter .= '<div class="center_item">'.$footer_widget_1.'</div>'; break;
			case 'footer-widget-2': $bottomCenter .= '<div class="center_item">'.$footer_widget_2.'</div>'; break;
			case 'footer-widget-3': $bottomCenter .= '<div class="center_item">'.$footer_widget_3.'</div>'; break;
		}
	}
}
$bottomCenterEnd 		= '</div>';

// bottom right
$bottomRightStart 	= '<div class="tt_right">';
$bottomRight 		= '';
if(isset($artemiz_fn_option['footer_sorter']['right']) && !empty($artemiz_fn_option['footer_sorter']['right'])){
	foreach($artemiz_fn_option['footer_sorter']['right'] as $key => $value){
		switch($key){
			case 'social': 			$bottomRight .= '<div class="left_item">'.$social__html.'</div>'; break;
			case 'text_1': 			$bottomRight .= '<div class="right_item">'.$text1__html.'</div>'; break;
			case 'text_2': 			$bottomRight .= '<div class="right_item">'.$text2__html.'</div>'; break;
			case 'menu': 			$bottomRight .= '<div class="right_item">'.$menu__html.'</div>'; break;
			case 'footer-widget-1': $bottomRight .= '<div class="right_item">'.$footer_widget_1.'</div>'; break;
			case 'footer-widget-2': $bottomRight .= '<div class="right_item">'.$footer_widget_2.'</div>'; break;
			case 'footer-widget-3': $bottomRight .= '<div class="right_item">'.$footer_widget_3.'</div>'; break;
		}
	}
}
$bottomRightEnd 	= '</div>';


$bottomPartHTML			 = '<div class="footer_bottom">';
	$bottomPartHTML			.= '<div class="fn_container">';
		$bottomPartHTML			.= '<div class="bottom_in">';
			if(isset($artemiz_fn_option)){
				$bottomPartHTML			.= $bottomLeftStart;
					$bottomPartHTML			.= $bottomLeft;
				$bottomPartHTML			.= $bottomLeftEnd;
				
				$bottomPartHTML			.= $bottomCenterStart;
					$bottomPartHTML			.= $bottomCenter;
				$bottomPartHTML			.= $bottomCenterEnd;
				
				$bottomPartHTML			.= $bottomRightStart;
					$bottomPartHTML			.= $bottomRight;
				$bottomPartHTML			.= $bottomRightEnd;
			}else{
				$bottomPartHTML			.= $bottomLeftStart;
					$bottomPartHTML .= '<div class="left_item">'.$text1__html.'</div>';
				$bottomPartHTML			.= $bottomLeftEnd;
				
				$bottomPartHTML			.= $bottomCenterStart;
				$bottomPartHTML			.= $bottomCenterEnd;
				
				$bottomPartHTML			.= $bottomRightStart;
					$bottomPartHTML .= '<div class="right_item">'.$text2__html.'</div>';
				$bottomPartHTML			.= $bottomRightEnd;
			}
			
		$bottomPartHTML			.= '</div>';
	$bottomPartHTML			.= '</div>';
$bottomPartHTML			.= '</div>';

$html = $bottomPartHTML;


// since v1.2
$totop_switch 			= '';
// fixed totop switch
if(isset($artemiz_fn_option['totop_fixed_switch'])){
	$totop_switch 		= $artemiz_fn_option['totop_fixed_switch'];
}
$totopScrollHeight 		= 400;
if(isset($artemiz_fn_option['totop_fixed_active_h'])){
	$totopScrollHeight 	= $artemiz_fn_option['totop_fixed_active_h'];
}

?>

			<!-- Footer starts here-->
			<footer class="artemiz_fn_footer">
				<?php if ( is_active_sidebar( 'footer-instagram-widget' )){ ?>
				<div class="footer_instagram">
					<?php echo wp_kses_post($followDiv);?>
					<?php dynamic_sidebar( 'footer-instagram-widget' ); ?>	
				</div>
				<?php } ?>
				
				<?php echo wp_kses($html,'post');?>
				
			</footer>
			<!-- Footer end here-->

		</div>
		<!-- All content without footer starts here -->			
			
	</div>
	<!-- All website content starts here -->

	<?php if($totop_switch == 'enable'){ ?>
	<a href="#" class="artemiz_fn_totop">
		<input type="hidden" value="<?php echo esc_attr($totopScrollHeight);?>" />
	</a>
	<?php } ?>

</div>
<!-- HTML ends here -->


<?php wp_footer(); ?>
</body>
</html>