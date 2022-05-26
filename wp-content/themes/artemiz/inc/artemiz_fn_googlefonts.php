<?php
function artemiz_fn_fonts() {
	global $artemiz_fn_option;
	$customfont = '';
	
	$default = array(
					'arial',
					'verdana',
					'trebuchet',
					'georgia',
					'times',
					'tahoma',
					'helvetica');
	$bodyFont = $navFont = $submenuFont = $navMobFont = $headingFont = $blockquoteFont = $extraFont = '';
	if(isset($artemiz_fn_option['body_font']['font-family'])){$bodyFont = $artemiz_fn_option['body_font']['font-family'];}
	if(isset($artemiz_fn_option['nav_font']['font-family'])){$navFont = $artemiz_fn_option['nav_font']['font-family'];}
	if(isset($artemiz_fn_option['submenu_font']['font-family'])){$submenuFont = $artemiz_fn_option['submenu_font']['font-family'];}
	if(isset($artemiz_fn_option['nav_mob_font']['font-family'])){$navMobFont = $artemiz_fn_option['nav_mob_font']['font-family'];}
	if(isset($artemiz_fn_option['heading_font']['font-family'])){$headingFont = $artemiz_fn_option['heading_font']['font-family'];}
	if(isset($artemiz_fn_option['blockquote_font']['font-family'])){$blockquoteFont = $artemiz_fn_option['blockquote_font']['font-family'];}
	if(isset($artemiz_fn_option['extra_font']['font-family'])){$extraFont = $artemiz_fn_option['extra_font']['font-family'];}
	
	$googlefonts = array(
					$bodyFont,
					$navFont,
					$submenuFont,
					$navMobFont,
					$headingFont,
					$blockquoteFont,
					$extraFont
					);
				
	foreach($googlefonts as $getfonts) {
		
		if(!in_array($getfonts, $default) && $getfonts != '') {
			$customfont = $customfont . str_replace(' ', '+', $getfonts). ':400,400italic,500,500italic,600,600italic,700,700italic|';
		}
	}
	
	
	if($customfont != '' && isset($artemiz_fn_option)){
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'artemiz_fn_googlefonts', "$protocol://fonts.googleapis.com/css?family=" . substr_replace($customfont ,"",-1) . "&subset=latin,cyrillic,greek,vietnamese&display=swap" );
	}	
}
add_action( 'wp_enqueue_scripts', 'artemiz_fn_fonts' );
?>