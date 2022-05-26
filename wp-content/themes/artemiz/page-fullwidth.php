<?php
/*
	Template Name: Full Width Page
*/
get_header();

global $post, $artemiz_fn_option;
$artemiz_fn_pagetitle = '';
$artemiz_fn_top_padding = '';
$artemiz_fn_bot_padding = '';
$artemiz_fn_page_spaces = '';

if(function_exists('rwmb_meta')){
	$artemiz_fn_pagetitle 			= get_post_meta(get_the_ID(),'artemiz_fn_page_title', true);
	$artemiz_fn_top_padding 		= get_post_meta(get_the_ID(),'artemiz_fn_page_padding_top', true);
	$artemiz_fn_bot_padding 		= get_post_meta(get_the_ID(),'artemiz_fn_page_padding_bottom', true);
	
	$artemiz_fn_page_spaces = 'style=';
	if($artemiz_fn_top_padding != ''){$artemiz_fn_page_spaces .= 'padding-top:'.$artemiz_fn_top_padding.'px;';}
	if($artemiz_fn_bot_padding != ''){$artemiz_fn_page_spaces .= 'padding-bottom:'.$artemiz_fn_bot_padding.'px;';}
	if($artemiz_fn_top_padding == '' && $artemiz_fn_bot_padding == ''){$artemiz_fn_page_spaces = '';}
	
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
	<div class="artemiz_fn_full_page_template">
		<?php if($artemiz_fn_pagetitle !== 'disable'){ ?>
			<!-- PAGE TITLE -->
			<div class="artemiz_fn_pagetitle">
				<div class="container">
					<div class="title_holder">
						<h3><?php the_title(); ?><span class="dot">.</span></h3>
						<?php artemiz_fn_breadcrumbs();?>
					</div>
				</div>
			</div>
			<!-- /PAGE TITLE -->
		<?php } ?>


		<!-- ALL PAGES -->		
		<div class="artemiz_fn_full_page_in" <?php echo esc_attr($artemiz_fn_page_spaces); ?>>
			<!-- PAGE -->
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
			<!-- /PAGE -->
		</div>		
		<!-- /ALL PAGES -->
	</div>
<?php } ?>

<?php get_footer(); ?>  