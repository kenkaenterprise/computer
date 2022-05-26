<?php
/*
	Template Name: Podcast Page
*/
get_header();

global $post, $artemiz_fn_option;
$artemiz_fn_pagetitle = '';
$artemiz_fn_top_padding = '';
$artemiz_fn_bot_padding = '';
$artemiz_fn_page_spaces = '';
$podcast_layout 		= 'default';


if(function_exists('rwmb_meta')){
	$artemiz_fn_pagetitle 		= get_post_meta(get_the_ID(),'artemiz_fn_page_title', true);
	$podcast_layout 			= get_post_meta(get_the_ID(),'artemiz_fn_podcast_layout', true);
	$artemiz_fn_top_padding 	= get_post_meta(get_the_ID(),'artemiz_fn_page_padding_top', true);
	$artemiz_fn_bot_padding 	= get_post_meta(get_the_ID(),'artemiz_fn_page_padding_bottom', true);
	$pageLayout 				= get_post_meta(get_the_ID(),'artemiz_fn_page_portfolio_layout', true);
	
	$artemiz_fn_page_spaces	 	= 'style=';
	if($artemiz_fn_top_padding != ''){$artemiz_fn_page_spaces .= 'padding-top:'.$artemiz_fn_top_padding.'px;';}
	if($artemiz_fn_bot_padding != ''){$artemiz_fn_page_spaces .= 'padding-bottom:'.$artemiz_fn_bot_padding.'px;';}
	if($artemiz_fn_top_padding == '' && $artemiz_fn_bot_padding == ''){$artemiz_fn_page_spaces = '';}
	
}

// QUERY ARGUMENTS
if(isset($artemiz_fn_option['podcast_perpage'])){
	$perpage = $artemiz_fn_option['podcast_perpage'];
}else{
	$perpage = 6;
}

if(is_front_page()) { $paged = (get_query_var('page')) ? get_query_var('page') : 1;	} else { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
$query_args = array(
	'post_type' 			=> 'artemiz-podcast', 
	'paged' 				=> $paged, 
	'posts_per_page' 		=> $perpage,
	'post_status' 			=> 'publish',
);
// QUERY WITH ARGUMENTS
$loop = new WP_Query($query_args);


$viewMoreText = esc_html__('Continue Reading', 'artemiz');

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
echo artemiz_get_audio_of_podcast('','html');
$thumb 		= get_template_directory_uri() .'/framework/img/thumb/22-15.jpg'; 
$thumb 		= '<img src="'.$thumb.'" alt="'.esc_attr__('Thumbnail', 'artemiz').'" />';
$layout 	= 'grid';
if(isset($artemiz_fn_option['podcast_layout'])){
	$layout	= $artemiz_fn_option['podcast_layout'];
}
if($podcast_layout != 'default' && $podcast_layout !== '' & $podcast_layout != 'undefined'){
	$layout	= $podcast_layout;
}
if(isset($_GET['layout'])){
	$layout = $_GET['layout'];
}
$interactiveHTML = '';
?>
<div class="artemiz_fn_podcast_template">
		
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
		<!-- WITHOUT SIDEBAR -->
		<div class="artemiz_fn_nosidebar" <?php echo esc_attr($artemiz_fn_page_spaces); ?>>
			<!-- PORTFOLIO CONTENT -->
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="podcast_content">
				<?php the_content(); ?>
			</div>
			<?php endwhile; endif;?>
			<!-- PORTFOLIO /CONTENT -->
			
			<?php if($layout == 'grid'){ ?>
			<!-- Grid Layout -->
			<div class="artemiz_fn_podcast__grid">
				<ul class="fn_masonry">
					<?php 
						if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); 
						$postID		= get_the_id();
						$imageURL 	= get_the_post_thumbnail_url($postID,'full');
						$button 	= artemiz_get_audio_button($postID,'artemiz-podcast');
					?>
					<li class="fn_masonry_in">
						<div class="item">

							<a class="full_link" href="<?php the_permalink(); ?>"></a>
							<div class="img_holder">
								<?php echo wp_kses_post($thumb);?>
								<div class="abs_img" data-fn-bg-img="<?php echo esc_url($imageURL);?>"></div>
							</div>

							<?php echo wp_kses($button,'post'); ?>
							<div class="like_holder">
								<?php echo wp_kses(artemiz_fn_like($postID,'return'),'post'); ?>
							</div>
							<div class="title_holder">
								<p><?php artemiz_fn_taxanomy_list(get_the_id(),'podcast_category', true, 999, ', ');?></p>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
						</div>
					</li>
					<?php endwhile; endif;?>
				</ul>
			</div>
			<!-- /Grid Layout -->
			<?php }else if($layout == 'list'){ ?>
			<div class="artemiz_fn_podcast__list">
				<ul class="fn_masonry">
					<?php 
						if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); 
						$postID		= get_the_id();
						$imageURL 	= get_the_post_thumbnail_url($postID,'full');
						$button 	= artemiz_get_audio_button($postID,'artemiz-podcast');
					?>
					<li class="fn_masonry_in">
						<div class="item">
							<div class="img_holder">
								<?php echo wp_kses($button,'post'); ?>
								<div class="abs_img" data-fn-bg-img="<?php echo esc_url($imageURL);?>"></div>
							</div>
							<div class="title_holder">
								<p class="podcast__duration" data-min="<?php echo esc_attr__('min','artemiz');?>"><?php echo esc_html__('Duration','artemiz');?></p>
								<h3 class="podcast__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
							<div class="like_holder">
								<?php echo wp_kses(artemiz_fn_like($postID,'return'),'post'); ?>
							</div>
						</div>
					</li>
					<?php endwhile; endif;?>
				</ul>
			</div>
			<?php }else if($layout == 'interactive'){ ?>
			<div class="artemiz_fn_podcast__list fn_interactive">
				<div class="left_part">
					<ul>
					<?php 
						if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); 
						$postID		= get_the_id();
						$imageURL 	= get_the_post_thumbnail_url($postID,'full');
						$button 	= artemiz_get_audio_button($postID,'artemiz-podcast');
						$interactiveHTML .= '<div class="overlay" data-fn-bg-img="'.esc_url($imageURL).'"></div>'
					?>
						<li>
							<div class="item">
								<div class="img_holder">
									<?php echo wp_kses($button,'post'); ?>
									<div class="abs_img" data-fn-bg-img="<?php echo esc_url($imageURL);?>"></div>
								</div>
								<div class="title_holder">
									<p class="podcast__duration" data-min="<?php echo esc_attr__('min','artemiz');?>"><?php echo esc_html__('Duration','artemiz');?></p>
									<h3 class="podcast__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div>
								<div class="like_holder">
									<?php echo wp_kses(artemiz_fn_like($postID,'return'),'post'); ?>
								</div>
							</div>
						</li>
						<?php endwhile; endif;?>
					</ul>
				</div>
				<div class="right_part">
					<div class="right_inner">
						<?php echo wp_kses($interactiveHTML,'post');?>
					</div>
				</div>
			</div>
			<?php } ?>
			
			<?php artemiz_fn_pagination($loop->max_num_pages); wp_reset_postdata(); ?>
			
		</div>
		<!-- /WITHOUT SIDEBAR -->
		
	</div>
</div>

<?php } ?>

<?php get_footer(); ?>  