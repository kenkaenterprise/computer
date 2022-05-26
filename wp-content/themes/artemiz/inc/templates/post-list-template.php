<?php 
//global $artemiz_fn_option;
$key = 0;
$esc__by	= esc_html__('By', 'artemiz');
$esc__in	= esc_html__('in', 'artemiz');
$esc__cr	= esc_html__('Continue Reading', 'artemiz');
$list 		= '<li class="grid-sizer"></li>';
if(is_front_page()) {
	$artemiz_fn_paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
	$artemiz_fn_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}
if(!is_search() && !is_archive() && !is_home()){
	query_posts('posts_per_page=&paged='.esc_html($artemiz_fn_paged));
}
$list_layout		= 'full';
if (isset($args['post_type'])) {
	$list_layout 	= $args['list_layout'];
}
$from_page			= 'blog';
if (isset($args['from_page'])) {
	$from_page 		= $args['from_page'];
}
if (have_posts()) : while (have_posts()) : the_post();
	$key++;
	$postID 		= get_the_id();
	$permalink 		= get_the_permalink();
	$postClasses  	= 'class="'.implode(' ', get_post_class()).'"';

	

	if($list_layout == 'full'){
		$authorMeta 	= artemiz_fn_get_author_meta_by_post_id($postID, 'post', true);
		if($from_page == 'search'){
			$extraMeta 	= '';
		}else{
			$extraMeta	= artemiz_fn_get_extra_met_by_post_id($postID);
		}
			
		$thumbName 	= 'artemiz_fn_thumb-1400-0';
	}else{
		if($key == 1){
			$authorMeta = artemiz_fn_get_author_meta_by_post_id($postID, 'post', true);
			if($from_page == 'search'){
				$extraMeta 	= '';
			}else{
				$extraMeta	= artemiz_fn_get_extra_met_by_post_id($postID);
			}
			
			$thumbName 	= 'artemiz_fn_thumb-1400-0';
		}else{
			$authorMeta = artemiz_fn_get_author_meta_by_post_id($postID, 'post', false);
			$extraMeta	= '';
			$thumbName 	= 'artemiz_fn_thumb-675-0';
		}
	}
		

	$post_image 	= '<div class="post_img_holder"><a href="'.$permalink.'"></a>'.get_the_post_thumbnail($postID,$thumbName);
	if($list_layout != 'full'){
		if($key != 1){
			$post_image .= artemiz_fn_get_date_meta($postID); // add date meta
		}
	}
	$post_image 	.= '</div>';

	$post_title 	= '<div class="post_title"><h3><a href="'.$permalink.'">'.get_the_title().'</a></h3></div>';
	$post_desc 		= '<div class="excerpt_holder"><p>'.artemiz_fn_excerpt(45,$postID).'</p></div>';
	$post_read 		= '<div class="read_holder"><p><a href="'.$permalink.'">'.esc_html($esc__cr).'<span></span></a></p></div>';

	if($list_layout == 'full'){
		$key		= 1;
	}
	$post_header 	= '<li class="artemiz_fn_masonry_in fn_post_item_'.$key.'" id="post-'.$postID.'"><div '.$postClasses.'>';
	$post_footer 	= '</div></li>';

	

	$list .= $post_header;
	if($list_layout == 'full'){
		$list .= $authorMeta;
		$list .= $post_title;
		$list .= $post_image;
		$list .= $post_desc;
		$list .= $extraMeta; 
		$list .= $post_read;
	}else{
		if($key == 1){
			$list .= $authorMeta;
			$list .= $post_title;
			$list .= $post_image;
			$list .= $post_desc;
			$list .= $extraMeta; 
			$list .= $post_read;
		}else{
			$list .= $post_image;
			$list .= '<div class="post_title_holder">';
				$list .= $authorMeta;
				$list .= $post_title;
				$list .= $post_desc;
				$list .= $post_read;
			$list .= '</div>';
		}
	}
		
	$list .= $post_footer;


endwhile; endif;
echo wp_kses_post($list);
wp_reset_postdata();
?>