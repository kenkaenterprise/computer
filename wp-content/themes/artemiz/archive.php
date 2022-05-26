<?php

get_header();

global $post, $artemiz_fn_option;

$currentAuthor 	= get_userdata(get_query_var('author'));
$artemiz_fn_pagestyle 		= 'ws';
if(!artemiz_fn_if_has_sidebar()){
	$artemiz_fn_pagestyle	= 'full';
}
?>
        
    
        <div class="artemiz-fn-content_archive">
			
			
			<div class="artemiz_fn_pagetitle">
				<div class="fn_container">
					<div class="title_holder">
						<h3>
						<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
						<?php /* If this is a category archive */ if (is_category()) { ?>
							<?php printf(esc_html__('All posts in %s', 'artemiz'), single_cat_title('',false)); ?>
						<?php /* If this is a tag archive */ } elseif( is_tax() ) { $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
							<?php printf(esc_html__('All posts in %s', 'artemiz'), $term->name ); ?>
						<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
							<?php printf(esc_html__('All posts tagged in %s', 'artemiz'), single_tag_title('',false)); ?>
						<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
							<?php esc_html_e('Archive for', 'artemiz') ?> <?php the_time(get_option('date_format')); ?>
						 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
							<?php esc_html_e('Archive for', 'artemiz') ?> <?php the_time('F, Y'); ?>
						<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
							<?php esc_html_e('Archive for', 'artemiz') ?> <?php the_time('Y'); ?>
						<?php /* If this is an author archive */ } elseif (is_author()) { ?>
							<?php esc_html_e('All posts by', 'artemiz') ?> <?php echo esc_html($currentAuthor->display_name); ?>
						<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
							<?php esc_html_e('Blog Archives', 'artemiz') ?>
						<?php }else if($post->post_type == 'artemiz-podcast'){?>
							<?php esc_html_e('Archive Podcast posts', 'artemiz') ?>
						<?php } ?>
						<span class="dot">.</span></h3>
					</div>
					<?php artemiz_fn_breadcrumbs();?>
				</div>
			</div>
			
			<div class="artemiz_fn_archive_page">
				<div class="fn_container">
					<div class="artemiz_fn_archive_page_in">
					
						<?php if($artemiz_fn_pagestyle == 'full'){ ?>

						<!-- WITHOUT SIDEBAR -->
						<div class="artemiz_fn_nosidebar">
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
							<div class="artemiz_fn_leftsidebar">
								<ul class="artemiz_fn_postlist artemiz_fn_masonry">
									<?php get_template_part( 'inc/templates/post-list-template' );?>
								</ul>
								<div class="clearfix"></div>
								<?php artemiz_fn_pagination(); ?>
							</div>

							<div class="artemiz_fn_rightsidebar">
								<?php get_sidebar(); ?>
							</div>
						</div>
						<!-- /WITH SIDEBAR -->

						<?php } ?>
						
					</div>
				</div>
			</div>
       
        </div>
		<!-- /MAIN CONTENT -->
        
<?php get_footer(); ?>   