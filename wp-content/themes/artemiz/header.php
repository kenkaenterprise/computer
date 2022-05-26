<!DOCTYPE html >
<html <?php language_attributes(); ?>>
<head>
<?php global $artemiz_fn_option, $post; ?>

<meta charset="<?php esc_attr(bloginfo( 'charset' )); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php wp_head(); ?>

</head>
<?php 
	$mobMenuAutocollapse = artemiz_fn_get_options_for_header()[0];
?>
<body <?php body_class();?>>
<?php wp_body_open(); ?>

	<!-- HTML starts here -->
	<div class="artemiz-fn-wrapper" data-like-url="<?php echo esc_url(get_template_directory_uri().'/framework/svg/like-full.svg');?>" data-mobile-autocollapse="<?php echo esc_attr($mobMenuAutocollapse); ?>">


		<!-- Header starts here -->
		<?php get_template_part( 'inc/templates/desktop-navigation' );?>
		<!-- Header ends here -->


		<!-- Mobile Menu starts here -->
		<?php get_template_part( 'inc/templates/mobile-navigation' );?>
		<!-- Mobile Menu ends here -->


		<!-- All website content starts here -->
		<div class="artemiz-fn-content">
			
			<!-- All content without footer starts here -->
			<div class="artemiz-fn-pages">