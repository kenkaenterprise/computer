<?php
	get_header();

	$searchText = esc_html__('Search','artemiz');
?>
          	
<!-- ERROR PAGE -->
<div class="artemiz_fn_404">
	<div class="fn_container">
		<div class="error_wrap">
			<div class="error_box">
				<div class="title_holder">
					<span><?php echo wp_kses_post(artemiz_fn_getSVG_theme('error-404'));?></span>
					<h3><?php esc_html_e('Page Not Found', 'artemiz') ?></h3>
					<p><?php esc_html_e('Sorry, but the page you are looking for was moved, removed, renamed or might never existed...', 'artemiz') ?></p>
				</div>
				<div class="search_holder">
					<form action="<?php echo esc_url(home_url('/')); ?>" method="get" >
						<div><input type="text" placeholder="<?php echo esc_attr($searchText);?>" name="s" autocomplete="off" /></div>
						<div><input type="submit" class="pe-7s-search" value="<?php echo esc_attr($searchText);?>" /></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /ERROR PAGE -->

        
<?php get_footer(); ?>