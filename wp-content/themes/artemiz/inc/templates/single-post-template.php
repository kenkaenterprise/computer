<?php 

global $artemiz_fn_option;
$postType			= 'post';
if (isset($args['post_type'])) {
	$postType 		= $args['post_type'];
}
if (have_posts()) : while (have_posts()) : the_post();
	$postID 		= get_the_id();

	$extraMeta		= artemiz_fn_get_extra_met_by_post_id($postID);
	
	$authorMeta 	= artemiz_fn_get_author_meta_by_post_id($postID,$postType,true,999);


	$post_title 	= '<div class="post_title"><h3>'.get_the_title().'</h3></div>';


	$post_thumbnail_id 	= get_post_thumbnail_id( $postID );
	$src 				= wp_get_attachment_image_src( $post_thumbnail_id, 'full');
	$imageURL 			= '';
	$hasImage			= 0;
	if(isset($src[0])){
		$imageURL 		= $src[0];
	}
	if($imageURL != ''){
		$hasImage		= 1;
	}

	$getInfoAboutAuthor = artemiz_get_author_info();
	$getRelatedPosts 	= artemiz_get_related_posts($postID,$postType);
	$audio 				= artemiz_get_audio_of_podcast($postID,$postType);
?>

<!-- POST HEADER -->
<div class="artemiz_fn_post_header" data-image="<?php echo esc_attr($hasImage);?>">
	<div class="post_header_content">
		<div class="header_in">
			<?php echo wp_kses_post($authorMeta);?>
			<?php echo wp_kses_post($post_title);?>
		</div>
	</div>
	<div class="post_header_bg" data-fn-bg-img="<?php echo esc_url($imageURL);?>"></div>
</div>
<!-- /POST HEADER -->

<?php echo wp_kses_post($audio);?>

<!-- POST CONTENT -->
<div class="artemiz_fn_post_content">

	
	<div class="content_holder">
		<?php if(!isset($artemiz_fn_option) || $postType == 'artemiz-podcast'){ ?><div class="fn_container"><?php }?>
			<?php the_content(); ?>
		<?php if(!isset($artemiz_fn_option) || $postType == 'artemiz-podcast'){ ?></div><?php }?>
	</div>
	
	<?php wp_link_pages(
		array(
			'before'      => '<div class="fn_link_pages"><div class="fn_container"><div class="artemiz_fn_pagelinks"><span class="title">' . esc_html__( 'Pages:', 'artemiz' ). '</span>',
			'after'       => '</div></div></div>',
			'link_before' => '<span class="number">',
			'link_after'  => '</span>',
		)
	); ?>

	<?php if(has_tag()){?>
	<div class="artemiz_fn_tags">
		<div class="fn_narrow_container">
			<label><?php the_tags(esc_html_e('Tags:', 'artemiz').'</label>', ' '); ?>
		</div>
	</div>
	<?php } ?>
	
	<div class="fn_narrow_container">
		<?php echo wp_kses_post($extraMeta);?>
		<?php echo wp_kses_post($getInfoAboutAuthor);?>
	</div>
	<?php echo wp_kses_post($getRelatedPosts);?>
</div>
<!-- /POST CONTENT -->
	
<?php if ( comments_open() || get_comments_number()){?>
<!-- POST COMMENT -->
<div class="fn_container">
	<div class="artemiz_fn_comment" id="comments">
		<div class="comment_in">
			<?php comments_template(); ?>
		</div>
	</div>
</div>
<!-- /POST COMMENT -->
<?php } ?>
	
<?php endwhile; endif;wp_reset_postdata();?>