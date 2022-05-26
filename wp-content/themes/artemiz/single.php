<?php

get_header();

global $post, $artemiz_fn_option;
$artemiz_fn_pagetitle = '';
$artemiz_fn_pagestyle = 'ws';

if(function_exists('rwmb_meta')){
	$artemiz_fn_pagetitle 			= get_post_meta(get_the_ID(),'artemiz_fn_page_title', true);
	$artemiz_fn_pagestyle 			= get_post_meta(get_the_ID(),'artemiz_fn_page_style', true);
}
if($artemiz_fn_pagestyle == 'ws' && !artemiz_fn_if_has_sidebar()){
	$artemiz_fn_pagestyle			= 'full';
}

if($artemiz_fn_pagestyle == 'ws' && !artemiz_fn_if_has_sidebar()){
	$artemiz_fn_pagestyle	= 'full';
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
<div class="artemiz_fn_single_template">

	<?php if($artemiz_fn_pagestyle == 'full'){ ?>

	<!-- WITHOUT SIDEBAR -->
	<div class="artemiz_fn_nosidebar">
		<div class="inner">
			<div class="artemiz_fn_blog_single">
				<?php get_template_part( 'inc/templates/single-post-template' );?>
			</div>
		</div>
	</div>
	<!-- /WITHOUT SIDEBAR -->

	<?php }else{ ?>
	
	<!-- WITH SIDEBAR -->
	<div class="fn_container">
		<div class="artemiz_fn_hassidebar">

			<div class="artemiz_fn_leftsidebar">
				<div class="artemiz_fn_blog_single">
					<?php get_template_part( 'inc/templates/single-post-template' );?>
				</div>
			</div>

			<div class="artemiz_fn_rightsidebar">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<!-- /WITH SIDEBAR -->

	<?php } ?>
				
</div>
<?php } ?>

<?php get_footer(); ?>  