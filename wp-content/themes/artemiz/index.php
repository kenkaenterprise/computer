<?php

get_header();

global $post, $artemiz_fn_option;
$artemiz_fn_pagetitle 		= '';
$artemiz_fn_top_padding 	= '';
$artemiz_fn_bot_padding 	= '';
$artemiz_fn_page_spaces 	= '';
$artemiz_fn_pagestyle 		= 'ws';

if(function_exists('rwmb_meta')){
	$artemiz_fn_pagetitle 			= get_post_meta(get_the_ID(),'artemiz_fn_page_title', true);
	$artemiz_fn_top_padding 		= get_post_meta(get_the_ID(),'artemiz_fn_page_padding_top', true);
	$artemiz_fn_bot_padding 		= get_post_meta(get_the_ID(),'artemiz_fn_page_padding_bottom', true);
	
	$artemiz_fn_page_spaces = 'style=';
	if($artemiz_fn_top_padding != ''){$artemiz_fn_page_spaces .= 'padding-top:'.$artemiz_fn_top_padding.'px;';}
	if($artemiz_fn_bot_padding != ''){$artemiz_fn_page_spaces .= 'padding-bottom:'.$artemiz_fn_bot_padding.'px;';}
	if($artemiz_fn_top_padding == '' && $artemiz_fn_bot_padding == ''){$artemiz_fn_page_spaces = '';}
	
}


if($artemiz_fn_pagestyle == 'ws' && !artemiz_fn_if_has_sidebar()){
	$artemiz_fn_pagestyle	= 'full';
}

// CHeck if page is password protected	
if(post_password_required($post)){
	echo '<div class="artemiz_fn_password_protected">
			<div class="fn_container">
				<div class="in">
					<div>
						<div class="message_holder">
							<h1>'.esc_html__('Protected','artemiz').'</h1>
							<h3>'.esc_html__('This page was protected','artemiz').'</h3>
							'.get_the_password_form().'
						</div>
					</div>
				</div>
		  	</div>
		  </div>';
}
else
{

$pageTitle	= esc_html__('Latest News', 'artemiz');
if($artemiz_fn_pagetitle !== 'disable'){ 
	if(isset($artemiz_fn_option['blog_single_title'])){
		$pageTitle = $artemiz_fn_option['blog_single_title'];
	}?>
<!-- PAGE TITLE -->
<div class="artemiz_fn_pagetitle index_page">
	<div class="fn_container">
		<div class="title_holder">
			<h3><?php echo esc_html($pageTitle);?><span class="dot">.</span></h3>
		</div>
	</div>
</div>
<!-- /PAGE TITLE -->
<?php } ?>
	
<div class="artemiz_fn_homepage">
	<div class="fn_container">
		<div class="artemiz_fn_homepage_in">

			<?php if($artemiz_fn_pagestyle == 'full'){ ?>

			<!-- WITHOUT SIDEBAR -->
			<div class="artemiz_fn_nosidebar" <?php echo esc_attr($artemiz_fn_page_spaces); ?>>
				<ul class="artemiz_fn_postlist artemiz_fn_masonry">
					<?php get_template_part( 'inc/templates/post-list-template' );?>
				</ul>
				<div class="clearfix"></div>
				<?php artemiz_fn_pagination(); ?>
			</div>
			<!-- /WITHOUT SIDEBAR -->

			<?php }else{ ?>

			<!-- WITH SIDEBAR -->
			<div class="artemiz_fn_hassidebar">
				<div class="artemiz_fn_leftsidebar" <?php echo esc_attr($artemiz_fn_page_spaces); ?>>
					<div class="sidebar_in">
						<ul class="artemiz_fn_postlist artemiz_fn_masonry">
							<?php get_template_part( 'inc/templates/post-list-template' );?>
						</ul>
						<div class="clearfix"></div>
						<?php artemiz_fn_pagination(); ?>
					</div>
				</div>

				<div class="artemiz_fn_rightsidebar" <?php echo esc_attr($artemiz_fn_page_spaces); ?>>
					<div class="sidebar_in">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
			<!-- /WITH SIDEBAR -->

			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>

<?php get_footer(); ?>  