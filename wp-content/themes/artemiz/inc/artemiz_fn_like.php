<?php
/*
Name: ArtemizLike
Description: Custom Love Posts
Author: Frenify
Author URI: http://themeforest.net/user/frenify
*/


class ArtemizLike {
	
	 function __construct()   {	
        add_action('wp_ajax_artemiz_fn_like', array(&$this, 'ajax'));
		add_action('wp_ajax_nopriv_artemiz_fn_like', array(&$this, 'ajax'));
	}
	
	
	
	function ajax($postID) {
		
		//  -- update
		if( isset($_POST['ID']) ) {
			$postID 	= str_replace('artemiz_fn_like_', '', $_POST['ID']);
			$likeAction = '';
			if( isset($_POST['likeAction']) ) {
				$likeAction = $_POST['likeAction'];
			}
			echo wp_kses_post($this->like_post($postID, 'update', $likeAction));
		} 
		
		//  -- get
		else {
			$postID = str_replace('artemiz_fn_like_', '', $_POST['ID']);
			echo wp_kses_post($this->like_post($postID, 'get'));
		}
		
		exit;
	}
	
	
	function like_post($postID, $action = 'get', $likeAction = '') 
	{
		if(!is_numeric($postID)) return;
		if($likeAction == 'not-rated'){
			$likeCount = get_post_meta($postID, '_artemiz_fn_like', true);
			if( !isset($_COOKIE['artemiz_fn_like_'.$postID]) ){
				$likeCount++;
				update_post_meta($postID, '_artemiz_fn_like', $likeCount);
				setcookie('artemiz_fn_like_'. $postID, $postID, time()*20, '/');
			}
			$svgURL		= get_template_directory_uri().'/framework/svg/like-full.svg';
			$title 		= esc_html__('You already liked this!', 'artemiz');
			$countShort = artemiz_fn_number_format_short($likeCount);
		}else if($likeAction == 'liked'){
			unset($_COOKIE['artemiz_fn_like_'.$postID]); 
			setcookie('artemiz_fn_like_'.$postID, null, -1, '/');
			$likeCount = get_post_meta($postID, '_artemiz_fn_like', true);
			if(!$likeCount ){
				$likeCount = 0;
				add_post_meta($postID, '_artemiz_fn_like', $likeCount, true);
			}else{
				$likeCount--;
				update_post_meta($postID, '_artemiz_fn_like', $likeCount);
			}
			$svgURL		= get_template_directory_uri().'/framework/svg/like-empty.svg';
  			$title 		= esc_html__('Like this', 'artemiz');
			$countShort = artemiz_fn_number_format_short($likeCount);
		}else{
			$likeCount = get_post_meta($postID, '_artemiz_fn_like', true);
			if( !$likeCount ){
				$likeCount = 0;
				add_post_meta($postID, '_artemiz_fn_like', $likeCount, true);
			}

			$countShort = artemiz_fn_number_format_short($likeCount);
			return wp_kses_post('<span class="artemiz_fn_like_count like_count"><span>'. $countShort .'</span></span>');
		}
	 	$search = array(
			'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
			'/[^\S ]+\</s',  // strip whitespaces before tags, except space
			'/(\s)+/s'       // shorten multiple whitespace sequences
		);
		$replace = array(
			'>',
			'<',
			'\\1'
		);
		$buffy = preg_replace($search, $replace, $buffy);

		$buffyArray = array(
			'data'		=> $buffy,
			'count' 	=> $countShort,
			'like' 		=> $like,
			'action' 	=> $action,
			'svg' 		=> $svgURL,
			'title' 	=> $title,
		);
		
		if ( 'update' === $action ){
			die(json_encode($buffyArray));
		}
	}


	function add_like($postID) {
		global $post;

		$count = $this->like_post($postID);
  
  		$class = 'artemiz_fn_like not-rated';
  		$title = esc_html__('Like this', 'artemiz');
		
		$svgURL			= get_template_directory_uri().'/framework/svg/like-empty.svg';
		
		if( isset($_COOKIE['artemiz_fn_like_'. $postID]) ){
			$class 		= 'artemiz_fn_like liked';
			$title 		= esc_html__('You already liked this!', 'artemiz');
			$svgURL		= get_template_directory_uri().'/framework/svg/like-full.svg';
		}
		
		
		$svg	= '<img class="artemiz_w_fn_svg" src="'.$svgURL.'" alt="'.esc_attr__('svg', 'artemiz').'" />';
		
		return wp_kses_post('<a href="#" class="'. $class .'" id="artemiz_fn_like_'. $postID .'" title="'. $title .'">'.$svg.$count.'</a>');
	}
	
}


global $artemiz_fn_like;
$artemiz_fn_like = new ArtemizLike();

// main function 
function artemiz_fn_like($postID, $return = '') {
	global $artemiz_fn_like;
	
	if($return == 'return') {
		return wp_kses_post($artemiz_fn_like->add_like($postID)); 
	} else {
		echo wp_kses_post($artemiz_fn_like->add_like($postID)); 
	}
} 
?>
