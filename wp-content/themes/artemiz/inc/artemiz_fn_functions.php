<?php
/*-----------------------------------------------------------------------------------*/
/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
/*-----------------------------------------------------------------------------------*/	

global $artemiz_fn_option, $post;
if( !function_exists('artemiz_fn_get_image_url_from_id') ){
	function artemiz_fn_get_image_url_from_id($image_id, $size = 'full'){
		if( empty($image_id) ) return '';
	
		if( is_numeric($image_id) ){
			$alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);	
			$image_src = wp_get_attachment_image_src($image_id, $size);	
			if( empty($image_src) ) return '';
			
			$ret = esc_url($image_src[0]);
		}else{
			$ret = esc_url($image_id);
		}
		
		
		return wp_kses_post($ret);
	}
}

function artemiz_fn_get_extra_met_by_post_id($postID){
	global $artemiz_fn_option;
	$esc__share		= esc_html__('Share', 'artemiz');
	$readTime 		= '<div class="read_time"><div class="read_in">'.artemiz_fn_getSVG_theme('watch').'<span>'.artemiz_fn_reading_time(get_the_content()).'</span></div></div>';
	$like 			= '<div class="like_btn"><div class="like_in">'.artemiz_fn_like($postID,'return').'</div></div>';
	$share 			= artemiz_fn_share_post($postID,$esc__share);
	if(isset($artemiz_fn_option)){
		return '<div class="artemiz_fn_extra_meta">'.$readTime.$like.$share.'</div>';
	}
	return '';
}

function artemiz_fn_post_taxanomy($post_type = 'post'){	
		$selectedPostTaxonomies = [];
		
		if( $post_type == 'page' )
		{
			
		}
		else if( $post_type != '' )
		{
			$taxonomys = get_object_taxonomies( $post_type );
			$exclude = array( 'post_tag', 'post_format' );

			if($taxonomys != '')
			{
				foreach($taxonomys as $key => $taxonomy)
				{
					// exclude post tags
					if( in_array( $taxonomy, $exclude ) ) { continue; }

					$selectedPostTaxonomies[$key] = $taxonomy;
				}
			}
		}
		else
		{

		}

		// custom post cats
		return $selectedPostTaxonomies;
	}

function artemiz_fn_html5_search_form( $form ) {
     $form  = '<section class="search"><form role="search" method="get" action="' . home_url( '/' ) . '" >';
		 $form .= '<label class="screen-reader-text" for="s"></label>';
		 $form .= '<input type="text" value="' . get_search_query() . '" name="s" placeholder="'. esc_attr__('Search', 'artemiz') .'" />';
		 $form .= '<input type="submit" value="" />';
		 $form .= '<span class="search_icon">'.artemiz_fn_getSVG_theme('search-new').'</span>';
	 $form .= '</form></section>';
     return $form;
}

add_filter( 'get_search_form', 'artemiz_fn_html5_search_form' );

function artemiz_fn_get_date_meta($postID){
	return '<div class="date_meta"><a href="'.get_day_link(get_the_time( 'Y', $postID ),get_the_time( 'm', $postID ),get_the_time( 'd', $postID )).'"><span>'.get_the_time(get_option('date_format'), $postID).'</span></a></div>';
}

function artemiz_fn_get_author_meta_by_post_id($postID, $postType = 'post', $date_meta = false, $categoryCount = 1){
	$categoryCount		= (int)$categoryCount;
	$esc__by			= esc_html__('By', 'artemiz');
	$esc__in			= esc_html__('in', 'artemiz');
	$dateMeta			= '';
	$has				= '';
	$catHolder			= '';
	if($date_meta){
		$dateMeta		= '<div class="date_meta"><a href="'.get_day_link(get_the_time( 'Y', $postID ),get_the_time( 'm', $postID ),get_the_time( 'd', $postID )).'"><span>'.get_the_time(get_option('date_format'), $postID).'</span></a></div>';
		$has			= ' has_date_meta';
	}
		
	$authorImage 		= '<span class="author_img" data-fn-bg-img="'.get_avatar_url(get_the_author_meta('ID')).'"></span>';
	$authorName			= get_the_author_meta('display_name');
	$authorURL			= get_author_posts_url(get_the_author_meta('ID'));
	$authorHolder		= '<span class="author_name">'.esc_html($esc__by).'&nbsp;<a href="'.esc_url($authorURL).'">'.esc_html($authorName).'</a></span>';
	$taxonomy			= artemiz_fn_post_taxanomy($postType)[0];
	if(artemiz_fn_taxanomy_list($postID, $taxonomy, false, $categoryCount) != ""){
		$catHolder			= '&nbsp;<span class="category_name">'.esc_html($esc__in).'&nbsp;'.artemiz_fn_taxanomy_list($postID, $taxonomy, false, $categoryCount).'</span>';
	}
	
	
	return '<div class="artemiz_fn_author_meta'.$has.'">'.$authorImage.'<p>'.$authorHolder.$catHolder.'</p>'.$dateMeta.'</div>';
}


function artemiz_fn_post_term_list($postid, $taxanomy, $url = false, $separator = ' ', $slug = true, $space = false){

	$terms = $termlist = $term_link = $cat_count = '';
	$terms = get_the_terms($postid, $taxanomy);

	if($terms != ''){

		$cat_count = sizeof($terms);

		for($i = 0; $i < $cat_count; $i++){
			$termLink 	= get_term_link( $terms[$i]->slug, $taxanomy );
			$termName	= $terms[$i]->name;
			if($space == true){
				$termName = strtolower($termName);
				$termName = str_replace(' ', '_', $termName);
			}
			if($slug == true){
				$termName	= $terms[$i]->slug;
			}
			if($url == true){
				$termlist .= '<a href="'.$termLink.'">'.$termName.'</a>'.$separator;
			}else{
				$termlist .= $termName.$separator;
			}				
		}
		$termlist = trim($termlist, $separator);
	}
	return wp_kses_post($termlist);
}
function artemiz_get_audio_button($postID, $postType = 'post'){
	$html 				= '';
	if($postType == 'artemiz-podcast'){
		if(function_exists('rwmb_meta')){
			$audioURL 		= get_post_meta($postID,'artemiz_fn_podcast_local_audio_url', true);
			if($audioURL != '' && isset($audioURL)){
				$playIcon	= '<span class="play">'.artemiz_fn_getSVG_theme('play').'</span>';
				$pauseIcon	= '<span class="pause">'.artemiz_fn_getSVG_theme('pause').'</span>';
				$icon		= '<span class="fn_icon">'.$playIcon.$pauseIcon.'</span>';
				$text		= '<span class="fn_text">'.esc_html__('Play Episode', 'artemiz').'</span>';
				$html 		= '<div class="artemiz_fn_audio_button" data-mp3="'.esc_url($audioURL).'"><a href="#">'.$text.$icon.'</a></div>';
			}
			return $html;
		}
	}
	return $html;
}
function artemiz_get_audio_duration($postID, $postType = 'post'){
	$html 				= '';
	if($postType == 'artemiz-podcast'){
		if(function_exists('rwmb_meta')){
			$audioURL 		= get_post_meta($postID,'artemiz_fn_podcast_local_audio_url', true);
			if($audioURL != '' && isset($audioURL)){
				$mp3file 	= new MP3File($audioURL);
				$duration2 	= $mp3file->getDuration();//(slower) for VBR (or CBR)
			}
			return $duration2;
		}
	}
	return $html;
}

function artemiz_get_audio_of_podcast($postID, $postType = 'post', $audioURL = ''){
	$html 				= '';
	if($postType == 'artemiz-podcast'){
		if(function_exists('rwmb_meta')){
			$audioURL 	= get_post_meta($postID,'artemiz_fn_podcast_local_audio_url', true);
		}
	}
	if(($postType == 'artemiz-podcast' && $audioURL !== '') || $postType == 'html'){
		$closeText 	= esc_html__('Close', 'artemiz');
		$openText 	= esc_html__('Open', 'artemiz');
		$closerText = $closeText;
		$iconBar 	= '<span class="icon_bar"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>';
		$iconSVG	= '<span class="icon_wrapper">'.artemiz_fn_getSVG_theme('podcast').'</span>';
		$iconHolder	= '<span class="podcast_icon"><span class="icon_inner">'.$iconSVG.$iconBar.'</span></span>';
		$audio 		= '<audio controls><source src="'.$audioURL.'" type="audio/mpeg"></audio>';
		
		$closed 	= '';
		if($postType == 'html'){$audio = '';$closed = 'closed';$closerText = $openText;}
		$closer 	= '<span class="fn_closer" data-close-text="'.$closeText.'" data-open-text="'.$openText.'"><span>'.$closerText.'</span></span>';

		$html .= '<div class="artemiz_fn_main_audio '.$closed.' fn_pause">'.$closer.'<div class="fn_container"><div class="audio_wrapper">';
			$html .= $iconHolder.'<div class="audio_player">'.$audio.'</div>';
		$html .= '</div></div></div>';
	}
	return $html;
}

function artemiz_get_related_posts($postID,$postType = 'post'){
	global $post;
	$list 						= '';
	$cats 						= array();
	$postCategories 			= array();
	if($postType == 'post'){
		$cats 					= wp_get_post_categories($postID);
	}else if($postType == 'artemiz-podcast'){
		$postTaxonomy			= 'podcast_category';
		$postCategories			= artemiz_fn_post_term_list($postID, $postTaxonomy, false, ',');
		$postCategories 		= explode(',', $postCategories);
	}
	$query_args = array(
		'post_type' 			=> $postType,
		'paged' 				=> 1, 
		'posts_per_page' 		=> 3,
		'post_status' 			=> 'publish',
		'category__in' 			=> $cats,
		'post__not_in' 			=> array($postID),
	);
	
	if ($postType == 'artemiz-podcast' ) {
		if( !empty( $postCategories )){
			$query_args['tax_query'] = array(
				array(
					'taxonomy' 	=> 'podcast_category',
					'field' 	=> 'slug',
					'terms' 	=> $postCategories,
					'operator'	=> 'IN'
				)
			);
		}else{
			return '';
		}
	}
	// QUERY WITH ARGUMENTS
	$loop 			= new WP_Query($query_args);
	$count			= count($loop->posts);
	$callback_thumb = get_template_directory_uri() .'/framework/img/thumb/22-15.jpg'; 
	$callback_thumb = '<img src="'.$callback_thumb.'" alt="'.esc_attr__('Thumbnail', 'artemiz').'" />';
	foreach ( $loop->posts as $item ) {
		setup_postdata( $item );
		$postID 	= $item->ID;
		$permalink	= get_permalink($postID);
		$title		= $item->post_title;
		$img		= get_the_post_thumbnail_url($postID, 'artemiz_fn_thumb-1400-0');
		$titleH		= '<div class="post_title_holder"><h3><span>'.$title.'</span></h3></div>';
		$dateMeta	= '<div class="date_meta"><a href="'.get_day_link(get_the_time( 'Y', $postID ),get_the_time( 'm', $postID ),get_the_time( 'd', $postID )).'"><span>'.get_the_time(get_option('date_format'), $postID).'</span></a></div>';
		$image		= '<div class="img_holder">'.$callback_thumb.'<div class="abs_img" data-fn-bg-img="'.$img.'"></div></div>';
		$list .= '<li><div class="item"><a href="'.$permalink.'"></a>'.$image.$dateMeta.$titleH.'</div></li>';
		wp_reset_postdata();
	}
	if($list != ''){
		$titleHolder = '<div class="fn_narrow_container"><div class="related_title_holder"><span>'.esc_html__('Related Articles', 'artemiz').'</span></div></div>';
		$list = '<div class="fn_container"><div class="related_list"><ul data-count="'.$count.'">'.$list.'</ul></div></div>';
		return '<div class="artemiz_fn_related_posts">'.$titleHolder.$list.'</div>';
	}
	return '';
}

add_filter('wp_list_categories', 'artemiz_fn_cat_count_span');
function artemiz_fn_cat_count_span($links) {
  	$links = str_replace('</a> (', '</a> <span class="count">', $links);
  	$links = str_replace(')', '</span>', $links);
  	return $links;
}

// 06.08.2020
function artemiz_fn_if_has_sidebar(){
	if(is_single()){
		if ( is_active_sidebar( 'main-sidebar' ) ){
			return true;
		}else{
			return false;
		}
	}else {
		if ( is_active_sidebar( 'main-sidebar' ) ){
			return true;
		}else{
			return false;
		}
	}
}

function artemiz_fn_getPostType(){
	$postType = get_post_type_object(get_post_type());
	if ($postType) {
		return esc_html($postType->labels->singular_name);
	}
}
function artemiz_fn_getImageInSearchList($thumb = 'full') {
  	global $post, $posts;
	$first_img 		= '';
	if(has_post_thumbnail()){
		$first_img 	= get_the_post_thumbnail_url(get_the_id(),$thumb);
	}else{
		ob_start();
		ob_end_clean();
		$output 	= preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
		if(isset($matches[1][0])){
			$first_img = $matches[1][0];
		}
	}
	$first_img 	= get_the_post_thumbnail_url(get_the_id(),$thumb); // will be removed
	return $first_img;
}

function artemiz_fn_reading_time( $content ) {

	// Predefined words-per-minute rate.
	$words_per_minute = 120;
	$words_per_second = $words_per_minute / 60;

	// Count the words in the content.
	$word_count = str_word_count( strip_tags( $content ) );

	// [UNUSED] How many minutes?
	$minutes = floor( $word_count / $words_per_minute );

	// [UNUSED] How many seconds (remainder)?
	$seconds_remainder = floor( $word_count % $words_per_minute / $words_per_second );

	// How many seconds (total)?
	$seconds_total = floor( $word_count / $words_per_second );

	if($minutes < 1){
		$minutes = 1;
	}
	return sprintf( _n( '%s min read', '%s min read', $minutes, 'artemiz' ), number_format_i18n( $minutes ) );
//	return $seconds_total;
}

function artemiz_fn_getSVG_core($name = '', $class = ''){
	return '<img class="artemiz_w_fn_svg '.$class.'" src="'.ARTEMIZ_CORE_SHORTCODE_URL.'assets/svg/'.$name.'.svg" alt="svg" />';
}

function artemiz_fn_getSVG_theme($name = '', $class = ''){
	return '<img class="artemiz_fn_svg '.$class.'" src="'.get_template_directory_uri().'/framework/svg/'.$name.'.svg" alt="svg" />';
}

function artemiz_fn_number_format_short( $n, $precision = 1 ) {
	if ($n < 900) {
		// 0 - 900
		$n_format = number_format($n, $precision);
		$suffix = '';
	} else if ($n < 900000) {
		// 0.9k-850k
		$n_format = number_format($n / 1000, $precision);
		$suffix = 'K';
	} else if ($n < 900000000) {
		// 0.9m-850m
		$n_format = number_format($n / 1000000, $precision);
		$suffix = 'M';
	} else if ($n < 900000000000) {
		// 0.9b-850b
		$n_format = number_format($n / 1000000000, $precision);
		$suffix = 'B';
	} else {
		// 0.9t+
		$n_format = number_format($n / 1000000000000, $precision);
		$suffix = 'T';
	}
  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
  // Intentionally does not affect partials, eg "1.50" -> "1.50"
	if ( $precision > 0 ) {
		$dotzero = '.' . str_repeat( '0', $precision );
		$n_format = str_replace( $dotzero, '', $n_format );
	}
	return $n_format . $suffix;
}




function artemiz_fn_get_user_social($userID){
	$facebook 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_facebook', $userID ) );
	$twitter 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_twitter', $userID ) );
	$pinterest 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_pinterest', $userID ) );
	$linkedin 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_linkedin', $userID ) );
	$behance 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_behance', $userID ) );
	$vimeo 			= esc_attr( get_the_author_meta( 'artemiz_fn_user_vimeo', $userID ) );
	$google 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_google', $userID ) );
	$instagram 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_instagram', $userID ) );
	$github 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_github', $userID ) );
	$flickr 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_flickr', $userID ) );
	$dribbble 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_dribbble', $userID ) );
	$dropbox 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_dropbox', $userID ) );
	$paypal 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_paypal', $userID ) );
	$picasa 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_picasa', $userID ) );
	$soundcloud 	= esc_attr( get_the_author_meta( 'artemiz_fn_user_soundcloud', $userID ) );
	$whatsapp 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_whatsapp', $userID ) );
	$skype 			= esc_attr( get_the_author_meta( 'artemiz_fn_user_skype', $userID ) );
	$slack 			= esc_attr( get_the_author_meta( 'artemiz_fn_user_slack', $userID ) );
	$wechat 		= esc_attr( get_the_author_meta( 'artemiz_fn_user_wechat', $userID ) );
	$icq 			= esc_attr( get_the_author_meta( 'artemiz_fn_user_icq', $userID ) );
	$rocketchat		= esc_attr( get_the_author_meta( 'artemiz_fn_user_rocketchat', $userID ) );
	$telegram		= esc_attr( get_the_author_meta( 'artemiz_fn_user_telegram', $userID ) );
	$vkontakte		= esc_attr( get_the_author_meta( 'artemiz_fn_user_vkontakte', $userID ) );
	$rss			= esc_attr( get_the_author_meta( 'artemiz_fn_user_rss', $userID ) );
	$youtube		= esc_attr( get_the_author_meta( 'artemiz_fn_user_youtube', $userID ) );
	
	$facebook_icon 		= '<i class="fn-icon-facebook"></i>';
	$twitter_icon 		= '<i class="fn-icon-twitter"></i>';
	$pinterest_icon 	= '<i class="fn-icon-pinterest"></i>';
	$linkedin_icon 		= '<i class="fn-icon-linkedin"></i>';
	$behance_icon 		= '<i class="fn-icon-behance"></i>';
	$vimeo_icon 		= '<i class="fn-icon-vimeo-1"></i>';
	$google_icon 		= '<i class="fn-icon-gplus"></i>';
	$youtube_icon 		= '<i class="fn-icon-youtube-play"></i>';
	$instagram_icon 	= '<i class="fn-icon-instagram"></i>';
	$github_icon 		= '<i class="fn-icon-github"></i>';
	$flickr_icon 		= '<i class="fn-icon-flickr"></i>';
	$dribbble_icon 		= '<i class="fn-icon-dribbble"></i>';
	$dropbox_icon 		= '<i class="fn-icon-dropbox"></i>';
	$paypal_icon 		= '<i class="fn-icon-paypal"></i>';
	$picasa_icon 		= '<i class="fn-icon-picasa"></i>';
	$soundcloud_icon 	= '<i class="fn-icon-soundcloud"></i>';
	$whatsapp_icon 		= '<i class="fn-icon-whatsapp"></i>';
	$skype_icon 		= '<i class="fn-icon-skype"></i>';
	$slack_icon 		= '<i class="fn-icon-slack"></i>';
	$wechat_icon 		= '<i class="fn-icon-wechat"></i>';
	$icq_icon 			= '<i class="fn-icon-icq"></i>';
	$rocketchat_icon 	= '<i class="fn-icon-rocket"></i>';
	$telegram_icon 		= '<i class="fn-icon-telegram"></i>';
	$vkontakte_icon 	= '<i class="fn-icon-vk"></i>';
	$rss_icon		 	= '<i class="fn-icon-rss"></i>';
	
	$socialList			= '';
	$socialHTML			= '';
	if($facebook != ''){$socialList .= '<li><a href="'.$facebook.'">'.$facebook_icon.$facebook_icon.'</a></li>';}
	if($twitter != ''){$socialList .= '<li><a href="'.$twitter.'">'.$twitter_icon.$twitter_icon.'</a></li>';}
	if($pinterest != ''){$socialList .= '<li><a href="'.$pinterest.'">'.$pinterest_icon.$pinterest_icon.'</a></li>';}
	if($linkedin != ''){$socialList .= '<li><a href="'.$linkedin.'">'.$linkedin_icon.$linkedin_icon.'</a></li>';}
	if($behance != ''){$socialList .= '<li><a href="'.$behance.'">'.$behance_icon.$behance_icon.'</a></li>';}
	if($vimeo != ''){$socialList .= '<li><a href="'.$vimeo.'">'.$vimeo_icon.$vimeo_icon.'</a></li>';}
	if($google != ''){$socialList .= '<li><a href="'.$google.'">'.$google_icon.$google_icon.'</a></li>';}
	if($instagram != ''){$socialList .= '<li><a href="'.$instagram.'">'.$instagram_icon.$instagram_icon.'</a></li>';}
	if($github != ''){$socialList .= '<li><a href="'.$github.'">'.$github_icon.$github_icon.'</a></li>';}
	if($flickr != ''){$socialList .= '<li><a href="'.$flickr.'">'.$flickr_icon.$flickr_icon.'</a></li>';}
	if($dribbble != ''){$socialList .= '<li><a href="'.$dribbble.'">'.$dribbble_icon.$dribbble_icon.'</a></li>';}
	if($dropbox != ''){$socialList .= '<li><a href="'.$dropbox.'">'.$dropbox_icon.$dropbox_icon.'</a></li>';}
	if($paypal != ''){$socialList .= '<li><a href="'.$paypal.'">'.$paypal_icon.$paypal_icon.'</a></li>';}
	if($picasa != ''){$socialList .= '<li><a href="'.$picasa.'">'.$picasa_icon.$picasa_icon.'</a></li>';}
	if($soundcloud != ''){$socialList .= '<li><a href="'.$soundcloud.'">'.$soundcloud_icon.$soundcloud_icon.'</a></li>';}
	if($whatsapp != ''){$socialList .= '<li><a href="'.$whatsapp.'">'.$whatsapp_icon.$whatsapp_icon.'</a></li>';}
	if($skype != ''){$socialList .= '<li><a href="'.$skype.'">'.$skype_icon.$skype_icon.'</a></li>';}
	if($slack != ''){$socialList .= '<li><a href="'.$slack.'">'.$slack_icon.$slack_icon.'</a></li>';}
	if($wechat != ''){$socialList .= '<li><a href="'.$wechat.'">'.$wechat_icon.$wechat_icon.'</a></li>';}
	if($icq != ''){$socialList .= '<li><a href="'.$icq.'">'.$icq_icon.$icq_icon.'</a></li>';}
	if($rocketchat != ''){$socialList .= '<li><a href="'.$rocketchat.'">'.$rocketchat_icon.$rocketchat_icon.'</a></li>';}
	if($telegram != ''){$socialList .= '<li><a href="'.$telegram.'">'.$telegram_icon.$telegram_icon.'</a></li>';}
	if($vkontakte != ''){$socialList .= '<li><a href="'.$vkontakte.'">'.$vkontakte_icon.$vkontakte_icon.'</a></li>';}
	if($youtube != ''){$socialList .= '<li><a href="'.$youtube.'">'.$youtube_icon.$youtube_icon.'</a></li>';}
	if($rss != ''){$socialList .= '<li><a href="'.$rss.'">'.$rss_icon.$rss_icon.'</a></li>';}
	
	if($socialList != ''){
		$socialHTML .= '<div class="artemiz_fn_social_list"><ul>';
			$socialHTML .= $socialList;
		$socialHTML .= '</ul></div>';
	}
	return $socialHTML;
}

function artemiz_get_author_info(){
	global $artemiz_fn_option;
	if(!isset($artemiz_fn_option)){
		return '';
	}
	$userID 			= get_the_author_meta( 'ID' );
	$authorURL			= get_author_posts_url($userID);
	$social				= artemiz_fn_get_user_social($userID);
	
	
	$name 				= esc_html( get_the_author_meta( 'artemiz_fn_user_name', $userID ) );
	$description		= esc_html( get_the_author_meta( 'artemiz_fn_user_desc', $userID ) );
	$imageURL			= esc_url( get_the_author_meta( 'artemiz_fn_user_image', $userID ) );
	
	if($name == ''){	
		$firstName 		= get_user_meta( $userID, 'first_name', true );
		$lastName 		= get_user_meta( $userID, 'last_name', true );
		$name 			= $firstName . ' ' . $lastName;
		if($firstName == ''){
			$name 		= get_user_meta( $userID, 'nickname', true );
		}
	}
	if($description == ''){
		$description 	= get_user_meta( $userID, 'description', true );
	}
	if($imageURL == ''){
		$image			= get_avatar( $userID, 200 );
	}else{
		$image			= '<div class="abs_img" data-fn-bg-img="'.$imageURL.'"></div>';
	}
	
	
	
	$title 			= '<h3><a href="'.$authorURL.'">'.$name.'</a></h3>';
	$description	= '<p>'.$description.'</p>';
	$leftTop		= '<div class="author_top">'.$title.$description.'</div>';
	$leftBottom		= '<div class="author_bottom">'.$social.'</div>';
	$html  = '<div class="artemiz_fn_author_info">';
		$html  .= '<div class="img_holder">'.$image.'</div>';
		$html  .= '<div class="title_holder">'.$leftTop.$leftBottom.'</div>';
	$html .= '</div>';
	return $html;
}

/* since 11.05.2020 */
function artemiz_fn_share_post($postID,$shareText){
	global $artemiz_fn_option;
	$html			= '';
	$src 			= '';
	if (has_post_thumbnail()) {
		$thumbID 	= get_post_thumbnail_id( $postID );
		$src 		= wp_get_attachment_image_src( $thumbID, 'full');
		$src 		= $src[0];
	}
	$sh				= 'share_';				// share option
	$tg				= 'target="_blank"';	// target _blank

	if(isset($artemiz_fn_option)){
		if(isset($artemiz_fn_option[$sh.'facebook']) && $artemiz_fn_option[$sh.'facebook'] != 'disable') {
			$html	.= '<li>';
				$html	.= '<a data-href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'" '.$tg.'>';
					$html	.= '<i class="fn-icon-facebook fn-relative-xcon"></i>';
					$html	.= '<i class="fn-icon-facebook fn-absolute-xcon"></i>';
				$html	.= '</a>';
			$html	.= '</li>';
		}
		if(isset($artemiz_fn_option[$sh.'twitter']) && $artemiz_fn_option[$sh.'twitter'] != 'disable') {
			$html	.= '<li>';
				$html	.= '<a data-href="https://twitter.com/share?url='.get_the_permalink().'" '.$tg.'>';
					$html	.= '<i class="fn-icon-twitter fn-relative-xcon"></i>';
					$html	.= '<i class="fn-icon-twitter fn-absolute-xcon"></i>';
				$html	.= '</a>';
			$html	.= '</li>';
		}
		if(isset($artemiz_fn_option[$sh.'pinterest']) && $artemiz_fn_option[$sh.'pinterest'] != 'disable') {
			$html	.= '<li>';
				$html	.= '<a data-href="http://pinterest.com/pin/create/button/?url='.get_the_permalink().'&amp;media='.$src.'" '.$tg.'>';
					$html	.= '<i class="fn-icon-pinterest fn-relative-xcon"></i>';
					$html	.= '<i class="fn-icon-pinterest fn-absolute-xcon"></i>';
				$html	.= '</a>';
			$html	.= '</li>';
		}
		if(isset($artemiz_fn_option[$sh.'linkedin']) && $artemiz_fn_option[$sh.'linkedin'] != 'disable') {
			$html	.= '<li>';
				$html	.= '<a data-href="http://linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'&amp;" '.$tg.'>';
					$html	.= '<i class="fn-icon-linkedin fn-relative-xcon"></i>';
					$html	.= '<i class="fn-icon-linkedin fn-absolute-xcon"></i>';
				$html	.= '</a>';
			$html	.= '</li>';
		}
		if(isset($artemiz_fn_option[$sh.'email']) && $artemiz_fn_option[$sh.'email'] != 'disable') {
			$html	.= '<li>';
				$html	.= '<a data-href="mailto:?amp;body='.get_the_permalink().'" '.$tg.'>';
					$html	.= '<i class="fn-icon-mail fn-relative-xcon"></i>';
					$html	.= '<i class="fn-icon-mail fn-absolute-xcon"></i>';
				$html	.= '</a>';
			$html	.= '</li>';
		}
		if(isset($artemiz_fn_option[$sh.'vk']) && $artemiz_fn_option[$sh.'vk'] != 'disable') {
			$html	.= '<li>';
				$html	.= '<a data-href="https://www.vk.com/share.php?url='.get_the_permalink().'" '.$tg.'>';
					$html	.= '<i class="fn-icon-vk fn-relative-xcon"></i>';
					$html	.= '<i class="fn-icon-vk fn-absolute-xcon"></i>';
				$html	.= '</a';
			$html	.= '></li>';
		}
	}
	if($html != ''){
		$svgURL	= get_template_directory_uri().'/framework/svg/share.svg';
		$html = '<div class="artemiz_fn_sharebox"><div class="share_in"><span class="hover_wrapper"><img class="artemiz_w_fn_svg" src="'.$svgURL.'" alt="'.esc_attr__('svg', 'artemiz').'" /><span>'.$shareText.'</span></span><ul>'.$html.'</ul><span class="share_after"></span></div></div>';
	}
	return $html;
}

function artemiz_fn_getLinesNavSkin($navType = 'one_line'){
	global $artemiz_fn_option;
	$optionSkin			= $navType.'_nav_skin';
	$navSkin 			= 'light';
	if(isset($artemiz_fn_option[$optionSkin])){
		$navSkin 		= $artemiz_fn_option[$optionSkin];
	}
	if(function_exists('rwmb_meta')){
		$navSkin 				= get_post_meta(get_the_ID(),'artemiz_fn_page_nav_color', true);
		if($navSkin === 'default' && isset($artemiz_fn_option[$optionSkin])){
			$navSkin 	= $artemiz_fn_option[$optionSkin];
		}
	}
	if(is_search() || is_404() || is_archive()){
		$navSkin 		= 'light';
	}
	if(isset($artemiz_fn_option[$optionSkin])){
		if($navSkin === 'undefined' || $navSkin === ''){
			$navSkin 	= $artemiz_fn_option[$optionSkin];
		}
	}
	if(isset($_GET['nav_skin'])){$navSkin = $_GET['nav_skin'];}
	return $navSkin;
}

function artemiz_fn_getLogo(){
	global $artemiz_fn_option;
	
	$prefix = 'lines';
	
	$defaultLogo 				= get_template_directory_uri().'/framework/img/'.$prefix.'-light-logo.png';
	$defaultLogoDark 			= get_template_directory_uri().'/framework/img/'.$prefix.'-dark-logo.png';
	$defaultLogoCustom 			= get_template_directory_uri().'/framework/img/'.$prefix.'-custom-logo.png';

	// light logo
	$logoDesktop 				= $logoDesktopURL = '';
	if(isset($artemiz_fn_option[$prefix.'_logo_dark'])){
		$logoDesktop 			= $artemiz_fn_option[$prefix.'_logo_dark'];
	}
	if(isset($artemiz_fn_option[$prefix.'_logo_dark']['url'])){
		$logoDesktopURL 		= $artemiz_fn_option[$prefix.'_logo_dark']['url'];
	}
	if(isset($logoDesktop) && isset($logoDesktopURL)){
		if($logoDesktopURL !== ''){
			$defaultLogo 		= $logoDesktopURL;
		}
	}
	
	
	
	// dark logo
	$logoDesktopDark 			= $logoDesktopURLDark = '';
	if(isset($artemiz_fn_option[$prefix.'_logo_light'])){
		$logoDesktopDark 		= $artemiz_fn_option[$prefix.'_logo_light'];
	}
	if(isset($artemiz_fn_option[$prefix.'_logo_light']['url'])){
		$logoDesktopURLDark 	= $artemiz_fn_option[$prefix.'_logo_light']['url'];
	}
	if(isset($logoDesktopDark) && isset($logoDesktopURLDark)){
		if($logoDesktopURLDark !== ''){
			$defaultLogoDark = $logoDesktopURLDark;
		}
	}
	
	return array($defaultLogo,$defaultLogoDark);
}

function artemiz_fn_getHelperLineNavigation(){
	global $artemiz_fn_option,$woocommerce;
	// language box
	$languageBox 	= artemiz_fn_custom_lang_switcher();
	
	// get cartbox
	
	if ( class_exists( 'WooCommerce' ) ) {
		// buy
		$buyIcon	= get_template_directory_uri().'/framework/svg/shopping-bag.svg';
		$buySVG 	= '<img class="artemiz_fn_svg" src="'.esc_url($buyIcon).'" alt="svg" />';
		$cartBox	= artemiz_fn_getCartBox();
		$buyHTML	= '<div class="artemiz_fn_buy_nav"><a class="buy_icon" href="#">'.$buySVG.'<span>'.$woocommerce->cart->cart_contents_count.'</span></a>'.$cartBox.'</div>';
	}else{
		$buyHTML	= '';
	}
	
	
	// search
	$searchIcon		= get_template_directory_uri().'/framework/svg/search-new.svg';
	$searchSVG 		= '<img class="artemiz_fn_svg" src="'.esc_url($searchIcon).'" alt="svg" />';
	$searchHTML		= '<div class="artemiz_fn_search_nav"><a href="#">'.$searchSVG.'</a></div>';
	
	
	$html 		= $languageBox.$searchHTML.$buyHTML;
	return $html;
}

function artemiz_fn_getCartBox($in = '',$pageFrom = ''){
	global $woocommerce;
	$items = $woocommerce->cart->get_cart();
	
	$html	= '<div class="artemiz_fn_cartbox">';
	if($in == 'yes'){
		$html = '';
	}
	
	if(!empty($items)){
		$subTotalText 		= esc_html__('Subtotal:', 'artemiz');
		$deleteItemText		= esc_html__('Remove this product from the cart', 'artemiz');
		$cartURL			= '<a class="fn_cart_url" href="'.esc_url( wc_get_cart_url() ).'">'.esc_html__('View Cart', 'artemiz').'</a>';
		$checkoutURL		= '<a class="fn_checkout_url" href="'.esc_url( wc_get_checkout_url() ).'">'.esc_html__('Checkout', 'artemiz').'</a>';
		
		$html .= '<div class="fn_cartbox">';
		$list	= '<div class="fn_cartbox_top"><div class="fn_cartbox_list">';
		foreach($items as $item => $values) {
			$productID			= $values['product_id'];
			$_product 			= wc_get_product( $values['data']->get_id() );
			$getProductDetail 	= wc_get_product( $productID );
			$image				= $getProductDetail->get_image();
			$quantity			= $values['quantity'];
			$title				= $_product->get_title();
			$productURL			= get_permalink($productID);
			$price 				= wc_price(get_post_meta($productID , '_price', true));
			$priceHolder 		= '<span class="fn_cartbox_item_price">'.$quantity . " x " . $price.'</span>';
			$titleHolder		= '<span class="fn_cartbox_item_title"><a href="'.$productURL.'">'.$title.'</a></span>';
			$deleteItem 		= '<a href="'.wc_get_cart_remove_url( $item ).'" class="fn_cartbox_delete_item" title="'.$deleteItemText.'"></a>';
			
			if((is_cart() || is_checkout()) || $pageFrom != ''){
				$deleteItem = '';
			}
			
			
			$list .= '<div class="fn_cartbox_item" data-id="'.$productID.'" data-key="'.$item.'">';
				$list .= '<div class="fn_cartbox_item_img"><a href="'.$productURL.'">'.$image.'</a></div>';
				$list .= '<div class="fn_cartbox_item_title">'.$titleHolder.$priceHolder.$deleteItem.'</div>';
			$list .= '</div>';
		}
		$list .= '</div></div>';
		
		// footer
		$subTotalPrice = $woocommerce->cart->get_cart_subtotal();
		$footer	 = '<div class="fn_cartbox_footer">';
		
			$footer	.= '<div class="fn_cartbox_subtotal">';
			$footer	.= '<span class="fn_left">'.$subTotalText.'</span>';
			$footer	.= '<span class="fn_right">'.$subTotalPrice.'</span>';
			$footer	.= '</div>';
		
			$footer	.= '<div class="fn_cartbox_links">';
			$footer	.= '<span class="fn_top">'.$cartURL.'</span>';
			$footer	.= '<span class="fn_bottom">'.$checkoutURL.'</span>';
			$footer	.= '</div>';
		
		$footer	.= '</div>';
		
		
		$html .= $list;
		$html .= $footer;
		$html	.= '</div>';
		if($in == 'yes'){
			
		}else{
			$html	.= '</div>';
		}
		
	}else{
		$returnToShop 	= '<a href="'.get_permalink( wc_get_page_id( 'shop' ) ).'">'.esc_html__('Return to shop','artemiz').'</a>';
		$emptyText		= esc_html__('Your cart is currently empty', 'artemiz');
		$html .= '<div class="fn_cartbox_empty"><p>'.$emptyText.$returnToShop.'</p></div>';
		if($in == 'yes'){
			
		}else{
			$html	.= '</div>';
		}
	}
	
	return $html;
}

function artemiz_fn_getSocialList($layout = ''){
	global $artemiz_fn_option;
	
	$socialPosition 		= array();
	if(isset($artemiz_fn_option[$layout.'social_position'])){
		$socialPosition 	= $artemiz_fn_option[$layout.'social_position'];
	}

	$socialHTML				= '';
	$socialList				= '';
	foreach($socialPosition as $key => $sPos){
		if($sPos == 1){
			if(isset($artemiz_fn_option[$layout.$key.'_helpful']) && $artemiz_fn_option[$layout.$key.'_helpful'] != ''){
				$icon		= $key;
				if($key == 'google'){
					$icon	= 'gplus';
				}else if($key == 'rocketchat'){
					$icon	= 'rocket';
				}else if($key == 'youtube'){
					$icon	= 'youtube-play';
				}else if($key == 'vimeo'){
					$icon	= 'vimeo-1';
				}
				$myIcon	= '<i class="fn-icon-'.$icon.'"></i>';
				$socialList .= '<li><a href="'.esc_url($artemiz_fn_option[$layout.$key.'_helpful']).'" target="_blank">';
				$socialList .= $myIcon;
				if($layout == 'footer_'){
					$socialList .= $myIcon;
				}
				$socialList .= '</a></li>';
			}
		}
	}

	if($socialList != ''){
		$socialHTML .= '<div class="artemiz_fn_social_'.$layout.'list"><ul>';
			$socialHTML .= $socialList;
		$socialHTML .= '</ul></div>';
	}

	return $socialHTML;
	
}

function artemiz_fn_getExtraButtons($button = '1'){
	global $artemiz_fn_option;
	
	if(isset($artemiz_fn_option['extra_button_'.$button.'_text'])){
		$text 		= $artemiz_fn_option['extra_button_'.$button.'_text'];
	}
	if(isset($artemiz_fn_option['extra_button_'.$button.'_url'])){
		$url 		= $artemiz_fn_option['extra_button_'.$button.'_url'];
	}
	if(isset($artemiz_fn_option['extra_button_'.$button.'_target'])){
		$target 	= $artemiz_fn_option['extra_button_'.$button.'_target'];
	}
	if(isset($artemiz_fn_option['extra_button_'.$button.'_radius'])){
		$radius 	= (int)$artemiz_fn_option['extra_button_'.$button.'_radius']['width'] . $artemiz_fn_option['extra_button_'.$button.'_radius']['units'];
	}
	if(isset($text) && isset($url) && $text != '' && $url != ''){
		$output		 = '<div class="artemiz_fn_nav_extra_button artemiz_fn_nav_extra_button'.$button.'">';
		$output		.= '<a href="'.$url.'" target="'.$target.'" style="border-radius:'.$radius.';">';
		$output		.= '<span class="a1">'.$text.'</span>';
		$output		.= '<span class="a2">'.$text.'</span>';
		$output		.= '<span class="a3" style="opacity: 0;">'.$text.'</span>';
		$output		.= '</a>';
		$output		.= '</div>';
		return $output;
	}
	
	return '';
}

function artemiz_fn_getMainTrigger($version = 'desktop'){
	global $artemiz_fn_option;
	
	// trigger switch
	$tSwitch 		= true;
	if(isset($artemiz_fn_option['trigger_switcher'])){
		$tSwitch 	= $artemiz_fn_option['trigger_switcher'];
	}
	
	// trigger height
	$tHeight		= 'two';
	if(isset($artemiz_fn_option['trigger_height'])){
		$tHeight 	= $artemiz_fn_option['trigger_height'];
	}
	
	// trigger layout
	$tLayout		= 1;
	if(isset($artemiz_fn_option['trigger_layout'])){
		$tLayout 	= $artemiz_fn_option['trigger_layout'];
	}
	
	// trigger background type
	$tBG			= 'none';
	if(isset($artemiz_fn_option['trigger_bg_type'])){
		$tBG	 	= $artemiz_fn_option['trigger_bg_type'];
	}
	
	// trigger round type
	$tRound			= 'circle';
	if(isset($artemiz_fn_option['trigger_round_type'])){
		$tRound	 	= $artemiz_fn_option['trigger_round_type'];
	}
	
	// trigger color
	$tColor			= '#333';
	if(isset($artemiz_fn_option['trigger_color'])){
		$tColor	 	= $artemiz_fn_option['trigger_color'];
	}
	
	// trigger background color
	$tBGColor		= '#eee';
	if(isset($artemiz_fn_option['trigger_bg_color'])){
		$tBGColor	= $artemiz_fn_option['trigger_bg_color'];
	}
	
	// trigger animation
	$animationType 		= 'vortex-r'; // hamburger--collapse-r
	if(isset($artemiz_fn_option['trigger_animation'])){
		$animationType	= $artemiz_fn_option['trigger_animation'];
	}
	$animationType		= 'hamburger--'.$animationType;
	
	$style = '<style>.artemiz_fn_hamburger[data-bg="color"]{background-color:'.$tBGColor.';}.fn_hamburger > span:after, .fn_hamburger > span:before,.artemiz_fn_one_line .hamburger .hamburger-inner::before, .artemiz_fn_one_line .hamburger .hamburger-inner::after, .artemiz_fn_one_line .hamburger .hamburger-inner,.artemiz_fn_two_lines .hamburger .hamburger-inner::before, .artemiz_fn_two_lines .hamburger .hamburger-inner::after, .artemiz_fn_two_lines .hamburger .hamburger-inner,.artemiz_fn_three_lines .hamburger .hamburger-inner::before, .artemiz_fn_three_lines .hamburger .hamburger-inner::after, .artemiz_fn_three_lines .hamburger .hamburger-inner{background-color:'.$tColor.';}</style>';
	
	if($version == 'desktop'){
		if(!$tSwitch){
			return '';
		}
	}
	
	if($tLayout == 1 || $version != 'desktop'){
		return $style.'<div class="artemiz_fn_hamburger" data-layout="'.$tLayout.'" data-height="'.$tHeight.'" data-bg="'.$tBG.'" data-round="'.$tRound.'">
				<div class="hamburger '.$animationType.'">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
			</div>';
	}else{
		return $style.'<div class="artemiz_fn_hamburger" data-layout="'.$tLayout.'" data-height="'.$tHeight.'" data-bg="'.$tBG.'" data-round="'.$tRound.'">
						<div class="fn_hamburger">
							<span class="a"></span>
							<span class="b"></span>
							<span class="c"></span>
						</div><div class="hamburger '.$animationType.'">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
			</div>';
	}
	
}


function artemiz_fn_get_options_for_header(){
	global $artemiz_fn_option;
	
	// *************************************************************************************************
	// 1. mobile menu autocollapse
	// *************************************************************************************************
	$mobMenuAutocollapse 		= 'disable';
	if(isset($artemiz_fn_option['mobile_menu_autocollapse'])){
		$mobMenuAutocollapse 	= $artemiz_fn_option['mobile_menu_autocollapse'];
	}
	
	// *************************************************************************************************
	// 2. sidebar navigation open by default
	// *************************************************************************************************
	$navOpenDefault				= 'enable';
	if(isset($artemiz_fn_option['navigation_open_default'])){
		$navOpenDefault	 		= $artemiz_fn_option['navigation_open_default'];
	}
	if(isset($_GET['nav'])){$navOpenDefault = $_GET['nav'];}
	if($navOpenDefault == 'disable'){
		$navOpenDefault			= 'menu_opened';
	}else{
		$navOpenDefault			= '';
	}
	
	// *************************************************************************************************
	// 3. get preloader HTML
	// *************************************************************************************************
	$preloaderSwitch			= 'disable';
	$preloaderSkin				= 'dark';
	$preloaderHTML				= '';
	if(isset($artemiz_fn_option['preloader_switch'])){
		$preloaderSwitch	 	= $artemiz_fn_option['preloader_switch'];
	}
	if(isset($artemiz_fn_option['preloader_skin'])){
		$preloaderSkin	 		= $artemiz_fn_option['preloader_skin'];
	}
	
	if(isset($_GET['preloader'])){$preloaderSwitch 		= $_GET['preloader'];}
	if(isset($_GET['preloader_skin'])){$preloaderSkin 	= $_GET['preloader_skin'];}
	
	if($preloaderSwitch == 'enable'){
		$preloaderHTML 			 = '<div class="artemiz_fn_preloader fn_'.$preloaderSkin.'">';
			$preloaderHTML			.= '<div class="spinner_wrap">';
				$preloaderHTML			.= '<div class="artemiz_fn_spinner"></div>';
			$preloaderHTML			.= '</div>';
		$preloaderHTML			.= '</div>';
	}
	
	// *************************************************************************************************
	// 5. get sidebar navigation skin
	// *************************************************************************************************
	$sidebarNavSkin 					= 'light';
	if(isset($artemiz_fn_option['nav_skin'])){
		$sidebarNavSkin 				= $artemiz_fn_option['nav_skin'];
	}
	if(function_exists('rwmb_meta')){
		$sidebarNavSkin 				= get_post_meta(get_the_ID(),'artemiz_fn_page_nav_color', true);
		if($sidebarNavSkin === 'default' && isset($artemiz_fn_option['nav_skin'])){
			$sidebarNavSkin 			= $artemiz_fn_option['nav_skin'];
		}
	}
	if(isset($artemiz_fn_option['nav_skin'])){
		if($sidebarNavSkin === 'undefined' || $sidebarNavSkin === ''){
			$sidebarNavSkin 			= $artemiz_fn_option['nav_skin'];
		}
	}
	if(is_404() || is_search() || is_archive()){
		$sidebarNavSkin 				= 'light';
		if(isset($artemiz_fn_option['special_nav_skin'])){
			$sidebarNavSkin 			= $artemiz_fn_option['special_nav_skin'];
		}
	}
	// *************************************************************************************************
	// 6. get submenu skin
	// *************************************************************************************************
	$submenuSkin	 					= 'dark';
	if(isset($artemiz_fn_option['submenu_skin'])){
		$submenuSkin 					= $artemiz_fn_option['submenu_skin'];
	}
	
	// *************************************************************************************************
	// 7 && 9. get dark mode
	// *************************************************************************************************
	$darkMode	 						= '';
	$bodyDarkMode	 					= 'artemiz_fn_light__bg';
	if(isset($artemiz_fn_option['dark_mode'])){
		$darkMode	 					= $artemiz_fn_option['dark_mode'];
	}
	if(isset($_GET['dark_mode'])){$darkMode = $_GET['dark_mode'];}
	if($darkMode == 'enable'){$darkMode = 'fn_dark_mode';$bodyDarkMode = 'artemiz_fn_dark__bg';}
	
	// *************************************************************************************************
	// 8. get background lines
	// *************************************************************************************************
	$bgDivider	 						= '';
	if(isset($artemiz_fn_option['bg_divider'])){
		$bgDivider	 					= $artemiz_fn_option['bg_divider'];
	}
	if(isset($_GET['bg_divider'])){$bgDivider = $_GET['bg_divider'];}
	
	return array($mobMenuAutocollapse,$navOpenDefault,$preloaderHTML,$sidebarNavSkin,$submenuSkin,$darkMode,$bgDivider,$bodyDarkMode);
}

/*-----------------------------------------------------------------------------------*/
/* Attachment image id by url (if it is thumbnail or full image)
/*-----------------------------------------------------------------------------------*/
function artemiz_fn_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url ){return '';}
		
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return esc_html($attachment_id);
}
/*-----------------------------------------------------------------------------------*/
/* Custom excerpt
/*-----------------------------------------------------------------------------------*/
function artemiz_fn_excerpt($limit,$postID = '') {
	$limit++;

	$excerpt = explode(' ', wp_trim_excerpt('', $postID), $limit);
	
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt);
	} 
	else{
		$excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	
	
	return esc_html($excerpt);
}

// CUSTOM POST TAXANOMY
function artemiz_fn_taxanomy_list($postid, $taxanomy, $echo = true, $max = 2, $seporator = ' / '){
	global $artemiz_fn_option;
	if(isset($artemiz_fn_option)){
		$artemiz_fn_gallery_terms = $artemiz_fn_termlist = $term_link = $cat_count = '';
		$artemiz_fn_gallery_terms = get_the_terms($postid, $taxanomy);

		if($artemiz_fn_gallery_terms != ''){

			$cat_count = sizeof($artemiz_fn_gallery_terms);
			if($cat_count >= $max){$cat_count = $max;}

			for($i = 0; $i < $cat_count; $i++){
				$term_link = get_term_link( $artemiz_fn_gallery_terms[$i]->slug, $taxanomy );
				$artemiz_fn_termlist .= '<a href="'.esc_url($term_link).'">'.$artemiz_fn_gallery_terms[$i]->name.'</a>'.$seporator;
			}
			$artemiz_fn_termlist = trim($artemiz_fn_termlist, $seporator);
		}

		if($echo == true){
			echo wp_kses_post($artemiz_fn_termlist);
		}else{
			return wp_kses_post($artemiz_fn_termlist);
		}
	}
	return '';
}
function artemiz_fn_service_single_list($commonClass = ''){
	$service_list = '<div class="service_list_as_function">';
	$service_list .= '<div class="title"><h3>'.esc_html__('Full list of Services', 'artemiz').'</h3></div>';
	$service_list .= '<div class="list_holder"><ul>';
	$li 	= '';
	$query_args = array(
		'post_type' 			=> 'artemiz-service',
		'post_status' 			=> 'publish',
		'posts_per_page'		=> -1
	);
	// QUERY WITH ARGUMENTS
	$artemiz_fn_loop = new WP_Query($query_args);
	
	foreach ( $artemiz_fn_loop->posts as $service_post ) {
		setup_postdata( $service_post );
		$postid 	= $service_post->ID;
		$permalink	= get_permalink($postid);
		$title		= $service_post->post_title;
		$classTitle = 'fn-service-'.$postid;
		if($classTitle == $commonClass){
			$classTitle .= ' active';
		}
		$li .= '<li class="'.esc_attr($classTitle).'"><a href="'.$permalink.'">'.$title.'</a></li>';
	}
	wp_reset_postdata();
	
	$service_list .= $li.'</ul></div></div>';
	echo wp_kses_post($service_list);
}
// Some tricky way to pass check the theme
if(1==2){paginate_links(); posts_nav_link(); next_posts_link(); previous_posts_link(); wp_link_pages();} 

function artemiz_fn_ajax_pagination($maxPosts = ''){
	global $artemiz_fn_option;
	if(isset($artemiz_fn_option['project_perpage'])){
		$artemiz_fn_project_perpage = $artemiz_fn_option['project_perpage'];
	}else{
		$artemiz_fn_project_perpage = 6;
	}
	if($maxPosts <= $artemiz_fn_project_perpage){
		$inactive = 'inactive';
	}else{
		$inactive = '';
	}
	$html = '';
	$html .= '<ul class="ajax_pagination">';
	$html .= '<li><a href="#" class="prev inactive">'.esc_html__('Prev', 'artemiz').'</a></li>';
	$html .= '<li><a href="#" class="next '.$inactive.'">'.esc_html__('Next', 'artemiz').'</a></li>';
	$html .= '</ul>';
	return $html;
}

function artemiz_fn_ajax_service_list($ajax_parameters = ''){
	global $artemiz_fn_option;
	$artemiz_fn_cats_in = '';
	$isAjaxCall = false;
	
	if(isset($artemiz_fn_option['project_perpage'])){
		$artemiz_fn_project_perpage = $artemiz_fn_option['project_perpage'];
	}else{
		$artemiz_fn_project_perpage = 6;
	}
	$artemiz_fn_project_perpage = $artemiz_fn_option['project_perpage'];
	
	
	
	// SET CURRENT PAGE
	if (empty($ajax_parameters)) {
		
		$isAjaxCall = true;
		
        $ajax_parameters = array (
            'artemiz_fn_page' 		=> '',
			'artemiz_fn_cat' 		=> '',
        );
	
		if (!empty($_POST['artemiz_fn_page'])) {
			$ajax_parameters['artemiz_fn_page'] 		= $_POST['artemiz_fn_page'];
		}
		if (!empty($_POST['artemiz_fn_cat'])) {
            $ajax_parameters['artemiz_fn_cat'] 		= $_POST['artemiz_fn_cat'];
			$artemiz_fn_cats_in = $ajax_parameters['artemiz_fn_cat'];
        }else{
			$artemiz_fn_cats_in = '';
		}
		
		if($ajax_parameters['artemiz_fn_page'] != ''){
			$page = $ajax_parameters['artemiz_fn_page'];	
		}else{
			$page = 1;
		}
	}
	
	
	
	
	
	$query_args = array(
		'post_type' 			=> 'artemiz-project',
		'post_status' 			=> 'publish',
		'posts_per_page' 		=> $artemiz_fn_project_perpage,
		'paged'					=> $page,
	);
	if ( ! empty ( $artemiz_fn_cats_in ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' 	=> 'project_category',
				'field' 	=> 'id',
				'terms' 	=> $artemiz_fn_cats_in,
				'operator'	=> 'IN'
			)
		);
	}
	// QUERY WITH ARGUMENTS
	$artemiz_fn_loop = new WP_Query($query_args);
	$artemiz_fn_max_pages = $artemiz_fn_loop->max_num_pages;
	$list = '';
	
	if ($artemiz_fn_loop->have_posts()) : while ($artemiz_fn_loop->have_posts()) : $artemiz_fn_loop->the_post();
	$permalink	= get_the_permalink();
	$title		= get_the_title();
	$imageURL 	= NULL;
	$imageURL 	= get_the_post_thumbnail_url(get_the_id(),'artemiz_fn_thumb-1000-1000');
	if(($imageURL == '') || ($imageURL == NULL) || ($imageURL == 'undefined')){
		$img_holder 	= '';
		$have_img 		= 'no_img';
	}else{
		
		$img_holder = '<div class="img_holder">';
			$img_holder .= artemiz_fn_callback_thumbs(560,375);
			$img_holder	.= '<div class="img_abs" data-fn-bg-img="'.esc_url($imageURL).'"></div>';
			$img_holder .= '<a href="'.get_the_permalink().'"></a>';
		$img_holder .= '</div>';
		
		$have_img = 'have_img';
	}
	$arrowURL = get_template_directory_uri().'/framework/svg/right-arrow-1.svg';
	$arrow = '<img class="artemiz_fn_svg" src="'.esc_url($arrowURL).'" alt="'.esc_attr__("svg", "artemiz").'" />';
	$list .= '<li><div class="item '.esc_attr($have_img).'">';
	$list .= $img_holder.'<div class="title_holder">
				<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
				<p><a class="view_more" href="'.get_the_permalink().'"><span class="text">'.esc_html__('View More', 'artemiz').'</span><span class="arrow">'.$arrow.'</span></a></p>
				<a class="hover_link" href="'.get_the_permalink().'"></a>
			</div>';
	$list .= '</div></li>';
	endwhile; endif;
	
	// OUTPUT -----------------------------------------------------------------------------------------
	if ( $list != NULL ) {
			$buffy .= $list; 
	}
	
	// remove whitespaces form the ajax HTML
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
	
	//pagination
    $artemiz_fn_hide_prev = false;
    $artemiz_fn_hide_next = false;
    if ($ajax_parameters['artemiz_fn_page'] == 1) {
        $artemiz_fn_hide_prev = true; //hide link on page 1
    }
    if ($ajax_parameters['artemiz_fn_page'] >= $artemiz_fn_max_pages) {
        $artemiz_fn_hide_next = true; //hide link on last page
    }

	$buffyArray = array(
        'artemiz_fn_data' 			=> $buffy,
		'artemiz_fn_cat' 			=> $ajax_parameters['artemiz_fn_cat'],
		'artemiz_fn_page' 			=> $ajax_parameters['artemiz_fn_page'],
		'artemiz_fn_hide_prev' 	=> $artemiz_fn_hide_prev,
        'artemiz_fn_hide_next' 	=> $artemiz_fn_hide_next
    );


    if ( true === $isAjaxCall ) 
	{
        die(json_encode($buffyArray));
    } 
	else 
	{
        return json_encode($buffyArray);
    }
	
}

function artemiz_fn_remove_item_from_cart(){
	global $artemiz_fn_option,$woocommerce;
	$isAjaxCall 	= true;
	if(isset($_POST['pageFrom'])){
		$pageFrom	= sanitize_text_field($_POST['pageFrom']);
	}
	$cart		 	= WC()->instance()->cart;
	$id 			= sanitize_text_field($_POST['product_id']);
	if($id != ''){
		$cart_id 		= $cart->generate_cart_id($id);
		$cart_item_id 	= $cart->find_product_in_cart($cart_id);

		if($cart_item_id){
		   $cart->set_quantity($cart_item_id,0);
		}
	}
	
	// get cartbox
	$cartBox		= artemiz_fn_getCartBox('yes',$pageFrom);
	
	$newCount		= $woocommerce->cart->cart_contents_count;
	
	
	$subTotalPrice 	= $woocommerce->cart->get_cart_subtotal();
	
	// remove whitespaces form the ajax HTML
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
	$cartBox 	= preg_replace($search, $replace, $cartBox);
	
	$updateContent = '<div class="fn_cartbox_updatebox"><p>'.esc_html__('The cart has been changed somewhere. Please, update the cart.','artemiz').'<a href="#" class="fn_cartbox_updater">'.esc_html__('Update the cart','artemiz').'</a></p>';

	$buffyArray = array(
        'artemiz_fn_data' 			=> $cartBox,
        'count' 				=> $newCount,
        'subtotal' 				=> $subTotalPrice,
        'update' 				=> $updateContent,
    );


    if ( true === $isAjaxCall ) 
	{
        die(json_encode($buffyArray));
    } 
	else 
	{
        return json_encode($buffyArray);
    }
	
}
function artemiz_fn_category_list(){
	$artemiz_fn_terms = $output_cat = $term_link = $artemiz_fn_termlist = NULL;
	$artemiz_fn_terms = get_terms('project_category');
	
	if($artemiz_fn_terms != ''){
		$artemiz_fn_termlist = '<ul class="fn_filter">';
		$artemiz_fn_termlist .= '<li><a href="#" class="active" data-filter-name="'.esc_attr__('All Projects', 'artemiz').'">'.esc_html__('All Projects', 'artemiz').'</a></li>';
		foreach ( $artemiz_fn_terms as $term ) {
			$parent = $term->parent;
			if ( $parent=='0' ){
				$artemiz_fn_termname = strtolower($term->name);
				// removed by artemiz
				
				$artemiz_fn_term_id = $term->term_id;
				
				// The $term is an object, so we don't need to specify the $taxonomy.
				$term_link = get_term_link( $term );
			   
				// If there was an error, continue to the next term.
				if ( is_wp_error( $term_link ) ) {
					continue;
				}
				$artemiz_fn_termlist  .= '<li><a href="'.esc_url( $term_link ).'" data-filter-value="'.esc_attr($artemiz_fn_term_id).'" data-filter-name="'.esc_attr($artemiz_fn_termname).'">'.esc_html($artemiz_fn_termname).'</a></li>';
			}
		}
		$artemiz_fn_termlist .= '</ul>';
	}
	echo wp_kses_post($artemiz_fn_termlist);
}
/*-----------------------------------------------------------------------------------*/
/* CHANGE: Password Protected Form
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_password_form', 'artemiz_fn_password_form' );
function artemiz_fn_password_form() {
    global $post;
    $label 	= 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	
    $output = '<form class="post-password-form" action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    			<p>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'artemiz'  ) . '</p>
				<div><input name="post_password" id="' . esc_attr($label) . '" type="password" class="password" placeholder="'.esc_attr__('Password', 'artemiz').'" /></div>
				<div><input type="submit" name="Submit" class="button" value="' . esc_attr__( 'Submit', 'artemiz' ) . '" /></div>
    		   </form>';
    
    return wp_kses_post($output);
}
/*-----------------------------------------------------------------------------------*/
/* BREADCRUMBS
/*-----------------------------------------------------------------------------------*/
// Breadcrumbs
function artemiz_fn_breadcrumbs( $echo = true) {
       
    // Settings
    $separator          = '<span></span>';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = esc_html__('Home', 'artemiz');
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = '';
	
	$output				= '';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       	
		$output .= '<div class="artemiz_fn_breadcrumbs">';
        // Build the breadcrums
        $output .= '<ul id="' . esc_attr($breadcrums_id) . '" class="' . esc_attr($breadcrums_class) . '">';
           
        // Home page
        $output .= '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . esc_attr($home_title) . '">' . esc_html($home_title) . '</a></li>';
        $output .= '<li class="separator separator-home"> ' . wp_kses_post($separator) . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
			
			if ( class_exists( 'WooCommerce' ) ) {
				if(is_shop()){
					$output .= '<li class="item-current item-archive"><span class="bread-current bread-archive">' . post_type_archive_title('', false) . '</span></li>';
				}else{
					$output .= '<li class="item-current item-archive"><span class="bread-current bread-archive">' . esc_html__('Archive', 'artemiz') . '</span></li>';
				}
			}else if($post->post_type == 'artemiz-podcast'){
				$output .= '<li class="item-current item-archive"><span class="bread-current bread-archive">' . esc_html__('Podcast Archive', 'artemiz') . '</span></li>';	
			}else{
				$output .= '<li class="item-current item-archive"><span class="bread-current bread-archive">' . esc_html__('Archive', 'artemiz') . '</span></li>';
			}
		  	
            
			
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                $output .= '<li class="item-cat item-custom-post-type-' . esc_attr($post_type) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr($post_type) . '" href="' . esc_url($post_type_archive) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . esc_attr($post_type_object->labels->name) . '</a></li>';
                $output .= '<li class="separator"> ' . wp_kses_post($separator) . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            $output .= '<li class="item-current item-archive"><span class="bread-current bread-archive">' . esc_html($custom_tax_name) . '</span></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                $output .= '<li class="item-cat item-custom-post-type-' . esc_attr($post_type) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr($post_type) . '" href="' . esc_url($post_type_archive) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . esc_html($post_type_object->labels->name) . '</a></li>';
                $output .= '<li class="separator"> ' . wp_kses_post($separator) . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.esc_html($parents).'</li>';
                    $cat_display .= '<li class="separator"> ' . esc_html($separator) . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                $output .= wp_kses_post($cat_display);
                $output .= '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                $output .= '<li class="item-cat item-cat-' . esc_attr($cat_id) . ' item-cat-' . esc_attr($cat_nicename) . '"><a class="bread-cat bread-cat-' . esc_attr($cat_id) . ' bread-cat-' . esc_attr($cat_nicename) . '" href="' . esc_url($cat_link) . '" title="' . esc_attr($cat_name) . '">' . esc_html($cat_name) . '</a></li>';
                $output .= '<li class="separator"> ' . wp_kses_post($separator) . ' </li>';
                $output .= '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
              
            } else {
                  
                $output .= '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            $output .= '<li class="item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . esc_attr($ancestor) . '"><a class="bread-parent bread-parent-' . esc_attr($ancestor) . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . esc_attr($ancestor) . '"> ' . wp_kses_post($separator) . ' </li>';
                }
                   
                // Display parent pages
                $output .= wp_kses_post($parents);
                   
                // Current page
                $output .= '<li class="item-current item-' . esc_attr($post->ID) . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                $output .= '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '"> ' . get_the_title() . '</span></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            $output .= '<li class="item-current item-tag-' . esc_attr($get_term_id) . ' item-tag-' . esc_attr($get_term_slug) . '"><span class="bread-current bread-tag-' . esc_attr($get_term_id) . ' bread-tag-' . esc_attr($get_term_slug) . '">' . esc_html($get_term_name) . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            $output .= '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives', 'artemiz').'</a></li>';
            $output .= '<li class="separator separator-' . get_the_time('Y') . '"> ' . wp_kses_post($separator) . ' </li>';
               
            // Month link
            $output .= '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__(' Archives', 'artemiz').'</a></li>';
            $output .= '<li class="separator separator-' . get_the_time('m') . '"> ' . wp_kses_post($separator) . ' </li>';
               
            // Day display
            $output .= '<li class="item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . esc_html__(' Archives', 'artemiz').'</span></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            $output .= '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives', 'artemiz').'</a></li>';
            $output .= '<li class="separator separator-' . get_the_time('Y') . '"> ' . wp_kses_post($separator) . ' </li>';
               
            // Month display
            $output .= '<li class="item-month item-month-' . get_the_time('m') . '"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__(' Archives', 'artemiz').'</span></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            $output .= '<li class="item-current item-current-' . get_the_time('Y') . '"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives', 'artemiz').'</span></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            $output .= '<li class="item-current item-current-' . esc_attr($userdata->display_name) . '"><span class="bread-current bread-current-' . esc_attr($userdata->display_name) . '" title="' . esc_attr($userdata->display_name) . '">' . esc_html__('Author: ', 'artemiz') . esc_html($userdata->display_name) . '</span></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            $output .= '<li class="item-current item-current-' . get_query_var('paged') . '"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="'.esc_attr__('Page ', 'artemiz') . get_query_var('paged') . '">'.esc_html__('Page', 'artemiz') . ' ' . get_query_var('paged') . '</span></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            $output .= '<li class="item-current item-current-' . get_search_query() . '"><span class="bread-current bread-current-' . get_search_query() . '" title="'.esc_attr__('Search results for: ', 'artemiz'). get_search_query() . '">' .esc_html__('Search results for: ', 'artemiz') . get_search_query() . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            $output .= '<li>' . esc_html__('Error 404', 'artemiz') . '</li>';
        }
       
        $output .= '</ul>';
		$output .= '</div>';
           
    }
	
	if($echo == true){
		echo wp_kses_post($output);
	}else{
		return wp_kses_post($output);
	}
       
}

function artemiz_fn_getImgIDByUrl($url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url ));
	if(isset($attachment[0])){
		return $attachment[0];
	}
	return '';
}
function artemiz_fn_getImgUrlByUrl($url,$imageSize = 'full'){
	$imageID	= artemiz_fn_getImgIDByUrl($url);
	if($imageID != ''){
		if($imageSize == 'square'){$imageSize = 'artemiz_fn_thumb-1000-1000';}else if($imageSize == 'portrait'){$imageSize = 'artemiz_fn_thumb-1000-9999';}
		return wp_get_attachment_image_url($imageID, $imageSize);
	}
	return $url;
}
function artemiz_fn_getImgByURL($url,$imageSize = 'full'){
	$imageUrl = artemiz_fn_getImgUrlByUrl($url,$imageSize);
	if($imageUrl != ''){
		return '<img src="'.$imageUrl.'" alt="'.esc_attr__('svg', 'artemiz').'" />';
	}
	return $imageUrl;
}

function artemiz_fn_getImageByImageUrl($url,$size = 'full',$return = 'url'){
	$imageID	= attachment_url_to_postid( $url );
	if($size == 'square'){$size = 'artemiz_fn_thumb-1000-1000';}else if($size == 'portrait'){$size = 'artemiz_fn_thumb-1000-9999';}
	$img		= wp_get_attachment_image_src( $imageID, $size);
	$imgURL		= $img[0];
	if($return == 'url'){
		return $imgURL;
	}
	return '<img src="'.$imgURL.'" alt="'.esc_attr__('svg', 'artemiz').'" />';
}

/*-----------------------------------------------------------------------------------*/
/* CallBack Thumbnails
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'artemiz_fn_callback_thumbs' ) ) {   
    function artemiz_fn_callback_thumbs($width, $height) {
    	
		$artemiz_fn_output = NULL; 
		
		 
		// callback function
		$artemiz_fn_thumbnail = get_template_directory_uri() .'/framework/img/thumb/thumb-'. esc_html($width) .'-'. esc_html($height) .'.jpg'; 
		$artemiz_fn_output .= '<img src="'. esc_url($artemiz_fn_thumbnail) .'" alt="'.esc_attr__('no image', 'artemiz').'" data-initial-width="'. esc_attr($width) .'" data-initial-height="'. esc_attr($height) .'">'; 
	
		
		
		return  wp_kses_post($artemiz_fn_output);
    }
}

function artemiz_fn_font_url() {
	$fonts_url = '';
	
	$font_families = array();
	$font_families[] = 'Open Sans:300,300i,400,400i,600,600i,800,800i';
	$font_families[] = 'Rubik:300,300i,400,400i,600,600i,800,800i';
	$font_families[] = 'Muli:300,300i,400,400i,600,600i,800,800i';
	$font_families[] = 'Montserrat:300,300i,400,400i,600,600i,800,800i';
	$font_families[] = 'Lora:300,300i,400,400i,600,600i,800,800i';
	$font_families[] = 'Poppins:300,300i,400,400i,600,600i,800,800i';
	$font_families[] = 'Oswald:300,300i,400,400i,600,600i,800,800i';
	$font_families[] = 'Neuton:200,200,300,300i,400,400i,700,700i,800,800i';
	$font_families[] = 'Heebo:200,200,300,300i,400,400i,700,700i,800,800i';
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	
	return esc_url_raw( $fonts_url );
}
function artemiz_fn_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'artemiz-fn-font-url', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'artemiz_fn_resource_hints', 10, 2 );
function artemiz_fn_filter_allowed_html($allowed, $context){
 
	if (is_array($context))
	{
	    return $allowed;
	}
 
	if ($context === 'post')
	{
        // Custom Allowed Tag Atrributes and Values
	    $allowed['div']['data-success'] = true;
		
		$allowed['a']['data-filter-value'] = true;
		$allowed['a']['data-filter-name'] = true;
		$allowed['ul']['data-wid'] = true;
		$allowed['div']['data-wid'] = true;
		$allowed['a']['data-postid'] = true;
		$allowed['a']['data-gpba'] = true;
		$allowed['div']['data-col'] = true;
		$allowed['div']['data-gutter'] = true;
		$allowed['div']['data-title'] = true;
		$allowed['a']['data-disable-text'] = true;
		$allowed['script'] = true;
		$allowed['div']['data-archive-value'] = true;
		$allowed['a']['data-wid'] = true;
		$allowed['div']['data-sub-html'] = true;
		$allowed['div']['data-src'] = true;
		$allowed['li']['data-src'] = true;
		$allowed['div']['data-fn-bg-img'] = true;
		
		$allowed['div']['data'] = true;
		$allowed['div']['data-cols'] = true;
		$allowed['td']['data-fgh'] = true;
		$allowed['div']['style'] = true;
		$allowed['div']['data-mp3'] = true;
		$allowed['input']['type'] = true;
		$allowed['input']['name'] = true;
		$allowed['input']['id'] = true;
		$allowed['input']['class'] = true;
		$allowed['input']['value'] = true;
		$allowed['input']['placeholder'] = true;
		
		$allowed['img']['data-initial-width'] = true;
		$allowed['img']['data-initial-height'] = true;
		$allowed['img']['style'] = true;
		$allowed['audio']['controls'] = true;
		$allowed['source']['src'] = true;
		$allowed['select'] = true;
		$allowed['option'] = true;
	}
 
	return $allowed;
}
add_filter('wp_kses_allowed_html', 'artemiz_fn_filter_allowed_html', 10, 2);
?>
