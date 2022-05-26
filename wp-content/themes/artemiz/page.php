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
	
	$artemiz_fn_page_spaces = 'style=';
	if($artemiz_fn_top_padding != ''){$artemiz_fn_page_spaces .= 'padding-top:'.$artemiz_fn_top_padding.'px;';}
	if($artemiz_fn_bot_padding != ''){$artemiz_fn_page_spaces .= 'padding-bottom:'.$artemiz_fn_bot_padding.'px;';}
	if($artemiz_fn_top_padding == '' && $artemiz_fn_bot_padding == ''){$artemiz_fn_page_spaces = '';}
	
	// page styles
	$artemiz_fn_pagestyle 			= get_post_meta(get_the_ID(),'artemiz_fn_page_style', true);
}

if($artemiz_fn_pagestyle == 'ws' && !artemiz_fn_if_has_sidebar()){
	$artemiz_fn_pagestyle			= 'full';
}

// CHeck if page is password protected	
if(post_password_required($post)){
	echo '<div class="artemiz_fn_password_protected">
		 	<div class="in">
				<div>
					<div class="message_holder">
						<h1>'.esc_html__('Protected','artemiz').'</h1>
						<h3>'.esc_html__('This page was protected','artemiz').'</h3>
						'.get_the_password_form().'
					</div>
				</div>
		  	</div>
		  </div>';
}
else
{

?>
<div class="artemiz_fn_page_template">
	
	<?php if($artemiz_fn_pagestyle == 'full' || $artemiz_fn_pagestyle == ''){ ?>
	<!-- WITHOUT SIDEBAR -->
	<div class="artemiz_fn_nosidebar">
			
			<?php if($artemiz_fn_pagetitle !== 'disable'){ ?>
				<!-- PAGE TITLE -->
				<div class="artemiz_fn_pagetitle">
					<div class="fn_container">
						<div class="title_holder">
							<h3><?php the_title(); ?><span class="dot">.</span></h3>
							<?php artemiz_fn_breadcrumbs();?>
						</div>
					</div>
				</div>
				<!-- /PAGE TITLE -->
			<?php } ?>
			
		<div class="fn_container">
			<div class="nosidebar_inner" <?php echo esc_attr($artemiz_fn_page_spaces); ?>>


				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php the_content(); ?>
					<div class="fn_link_pages">
						<?php wp_link_pages(
							array(
								'before'      => '<div class="artemiz_fn_pagelinks"><span class="title">' . __( 'Pages:', 'artemiz' ). '</span>',
								'after'       => '</div>',
								'link_before' => '<span class="number">',
								'link_after'  => '</span>',
							)
						); ?>
					</div>
					<?php if ( comments_open() || get_comments_number()){?>
					<!-- Comments -->
					<div class="artemiz_fn_comment" id="comments">
						<div class="comment_in">
							<?php comments_template(); ?>
						</div>
					</div>
					<!-- /Comments -->
					<?php } ?>

				<?php endwhile; endif; ?>

			</div>
			
		</div>
	</div>
	<!-- /WITHOUT SIDEBAR -->
	<?php }else{ ?>

	<!-- WITH SIDEBAR -->
	<div class="artemiz_fn_hassidebar">
		<div class="fn_container">
			<?php if($artemiz_fn_pagetitle !== 'disable'){ ?>
				<!-- PAGE TITLE -->
				<div class="artemiz_fn_pagetitle">
					<div class="title_holder">
						<h3><?php the_title(); ?></h3>
					</div>
					<?php artemiz_fn_breadcrumbs();?>
				</div>
				<!-- /PAGE TITLE -->
			<?php } ?>
			<div class="sidebar_inner">

				<div class="artemiz_fn_leftsidebar" <?php echo esc_attr($artemiz_fn_page_spaces); ?>>
					<div class="sidebar_in">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php the_content(); ?>

							<?php if ( comments_open() || get_comments_number()){?>
							<!-- Comments -->
							<div class="artemiz_fn_comment" id="comments">
								<div class="comment_in">
									<?php comments_template(); ?>
								</div>
							</div>
							<!-- /Comments -->
						<?php } ?>

						<?php endwhile; endif; ?>
					</div>
				</div>

				<div class="artemiz_fn_rightsidebar" <?php echo esc_attr($artemiz_fn_page_spaces); ?>>
					<div class="sidebar_in">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /WITH SIDEBAR -->

	<?php } ?>
</div>
<?php } ?>

<?php get_footer(); ?>  