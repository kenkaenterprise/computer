<?php
function artemiz_fn_pagination($pages = '', $range = 1, $home = 0, $type = 3)
{  
	$currentPage 	= '';
	$showitems 		= ($range * 1) + 1;
	$output			= '';
	
	global $artemiz_fn_paged;
    
	if(get_query_var('paged')){
		$artemiz_fn_paged = get_query_var('paged');
	}elseif(get_query_var('page')) {
		$artemiz_fn_paged = get_query_var('page');
	}else {
		$artemiz_fn_paged = 1;
	}

	if($pages == ''){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages){$pages = 1;}
	}


     if(1 != $pages)
     {
		 $output .= '<div class="artemiz_fn_pagination fn_type_'.$type.'"><ul>';
		 if($artemiz_fn_paged > 1 && $showitems < $pages && $type == 1){
			 $output .= "<li><a href='".get_pagenum_link(1)."' title='".esc_attr__('first','artemiz')."'>&larr; </a></li>";
		 }
		 $list = '';
         for ($i=1; $i <= $pages; $i++)
         {
			 if (1 != $pages &&( !($i >= $artemiz_fn_paged+$range+1 || $i <= $artemiz_fn_paged-$range-1) || $pages <= $showitems ))
             {
				if($home == 1){
					if($artemiz_fn_paged == $i){
						$list .= "<li><span class='current'>".esc_html($i)."</span></li>";
					}else{
						$list .= "<li><a href='".esc_url(add_query_arg( 'page', $i))."' class='inactive' >".esc_html($i)."</a></li>";
					}
				}else{
					if($artemiz_fn_paged == $i){
						$list .= "<li class='active'><span class='current'>".esc_html($i)."</span></li>";
					}else{
						$list .= "<li><a href='".esc_url( get_pagenum_link($i))."' class='inactive' >".esc_html($i)."</a></li>";
					}
				}
				if($artemiz_fn_paged == $i){
					$currentPage = $i;
				}
			 }
         }
		 if($currentPage != 1 && $type != 1){
			$output .= "<li class='prev'><a href='".esc_url( get_pagenum_link($currentPage-1))."' class='inactive'>".esc_html__('Prev','artemiz')."<span></span></a></li>";
		 }
		 $output .= $list;
		 if($artemiz_fn_paged < $pages && $showitems < $pages && $type == 1){
			 $output .= "<li><a href='".esc_url( get_pagenum_link($pages))."' title='".esc_attr__('last','artemiz')."'>&rarr;</a></li>";
		 }
		 if($type == 1){
			 $output .= '<li class="view"><p>'.sprintf('%s %s %s %s',esc_html__('Viewing page', 'artemiz'), $currentPage, esc_html__('of', 'artemiz'), $pages).'</p></li>';
		 }
		 
		 if($currentPage < $pages && $type != 1){
			$output .= "<li class='next'><a href='".esc_url( get_pagenum_link($currentPage+1))."' class='inactive'>".esc_html__('Next','artemiz')."<span></span></a></li>";
		 }
		
         $output .= "</ul></div>\n";
     }
	
	echo wp_kses_post($output);
}



?>
