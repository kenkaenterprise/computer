<?php

get_header();

global $post, $artemiz_fn_option;

$nothingFound 		= esc_html__('Nothing Found','artemiz');
$searchText 		= esc_html__('Search','artemiz');
$nothingMatchedText = esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'artemiz');
?>
        
        
        
<!-- MAIN CONTENT -->
<section class="artemiz_fn_searchpage">

		
	<div class="artemiz_fn_searchlist">
			
		<div class="artemiz_fn_pagetitle">
			<div class="fn_container"> 
				<div class="title_holder">
					<h3><?php printf( esc_html__('Results For: "%s"', 'artemiz'), get_search_query() ); ?><span class="dot">.</span></h3>
				</div>
			</div>
		</div>
		<!-- /PAGE TITLE -->
			
		<div class="fn_container"> 
			<!-- WITH SIDEBAR -->
			<div class="artemiz_fn_hassidebar">
				<div class="artemiz_fn_leftsidebar">
					<div class="sidebar_in">
						<?php if(have_posts()){ ?>
						<ul class="artemiz_fn_postlist artemiz_fn_masonry">
							<?php get_template_part( 'inc/templates/post-list-template', '', array('from_page' => 'search')  );?>
						</ul>
						<div class="clearfix"></div>
						<?php artemiz_fn_pagination(); ?>
						<?php }else{ ?>
						<div class="artemiz_fn_nothing_found">
							<div class="desc">
								<span><?php echo wp_kses_post(artemiz_fn_getSVG_theme('search-new'));?></span>
								<h3><?php echo esc_html($nothingFound);?></h3>
								<p><?php echo esc_html($nothingMatchedText);?></p>
							</div>
							<div class="s_seach">
								<div class="s_search_in">
									<form action="<?php echo esc_url(home_url("/"));?>" method="get" >
										<input type="text"  placeholder="<?php echo esc_attr($searchText);?>..." class="ft" name="s"/>
										<input type="submit" value="<?php echo esc_attr($searchText);?>" class="fs">
									</form>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>

				<div class="artemiz_fn_rightsidebar">
					<div class="sidebar_in">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
			<!-- /WITH SIDEBAR -->
			
			
		</div>

	</div>    
</section>
<!-- /MAIN CONTENT -->
        
<?php get_footer('null'); ?>   