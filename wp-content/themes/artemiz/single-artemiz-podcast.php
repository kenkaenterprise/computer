<?php

get_header();

global $post, $artemiz_fn_option;
$artemiz_fn_pagetitle 		= '';
$artemiz_fn_top_padding 	= '';
$artemiz_fn_bot_padding 	= '';
$artemiz_fn_page_spaces 	= '';
$artemiz_fn_pagestyle 		= '';

if(function_exists('rwmb_meta')){
	$artemiz_fn_pagetitle 			= get_post_meta(get_the_ID(),'artemiz_fn_page_title', true);
	$artemiz_fn_top_padding 		= get_post_meta(get_the_ID(),'artemiz_fn_page_padding_top', true);
	$artemiz_fn_bot_padding 		= get_post_meta(get_the_ID(),'artemiz_fn_page_padding_bottom', true);
	
	$artemiz_fn_page_spaces 		= 'style=';
	if($artemiz_fn_top_padding != ''){$artemiz_fn_page_spaces .= 'padding-top:'.$artemiz_fn_top_padding.'px;';}
	if($artemiz_fn_bot_padding != ''){$artemiz_fn_page_spaces .= 'padding-bottom:'.$artemiz_fn_bot_padding.'px;';}
	if($artemiz_fn_top_padding == '' && $artemiz_fn_bot_padding == ''){$artemiz_fn_page_spaces = '';}
	
	// page styles
	$artemiz_fn_pagestyle 			= get_post_meta(get_the_ID(),'artemiz_fn_page_style', true);
}

if($artemiz_fn_pagestyle == 'ws' && !artemiz_fn_if_has_sidebar()){
	$artemiz_fn_pagestyle	= 'full';
}


// CHeck if page is password protected	
if(post_password_required($post)){
	echo '<div class="artemiz_fn_podcast_post_protected"><div class="container">';
	
	echo '<div class="artemiz_fn_pagetitle">
			<div class="title_holder">
				<h3>'.get_the_title().'</h3>
				'.artemiz_fn_breadcrumbs(false).'
			</div>
		</div>';
	echo '<div class="artemiz_fn_password_protected">
		 	<div>
				<div class="in">
					<div class="message_holder">
						'.get_the_password_form().'
					</div>
				</div>
		  	</div>
		  </div>';
	
	echo '</div></div>';
}
else
{
?>
<div class="artemiz_fn_podcast_single_template">

	
	<!-- WITHOUT SIDEBAR -->
	<div class="artemiz_fn_nosidebar" <?php echo esc_attr($artemiz_fn_page_spaces);?>>
		<div class="inner">
			<div class="artemiz_fn_podcast_single">
				<?php get_template_part( 'inc/templates/single-post-template', '', array('post_type' => 'artemiz-podcast') );?>
			</div>
		</div>
	</div>
	<!-- /WITHOUT SIDEBAR -->
				
</div>
<?php } ?>

<?php get_footer(); ?>  