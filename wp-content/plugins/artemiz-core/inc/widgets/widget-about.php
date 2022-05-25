<?php

/**
 * Plugin Name: About Widget
 * Description: A widget that show information about someone with photo, name, job, some information, description and signature.
 * Version: 1.0
 * Author: Frenify
 * Author URI: http://themeforest.net/user/frenify
 *
 */


/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Artemiz_About extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		parent::__construct(
			'artemiz_about', // Base ID
			esc_html__( 'Frenify About', 'artemiz' ), // Name
			array( 'description' => esc_html__( 'Information about someone with photo, name, job, some information, description and signature.', 'artemiz' ), ) // Args
		);
		
		add_action( 'widgets_init', function() {
            register_widget( 'Artemiz_About' );
        });
	}
	

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		global $post;
		$fn_about_name			= '';
		$fn_about_job			= '';
		$fn_about_email			= '';
		$fn_about_content		= '';
		$fn_about_image			= '';
		$fn_about_signature		= '';
		
		/* Our variables from the widget settings. */
		if ( !empty( $instance[ 'fn_about_name' ] ) ) {
			$fn_about_name 		= $instance[ 'fn_about_name' ];
		}
		if ( !empty( $instance[ 'fn_about_job' ] ) ) {
			$fn_about_job 		= $instance[ 'fn_about_job' ];
		}
		if ( !empty( $instance[ 'fn_about_email' ] ) ) {
			$fn_about_email 	= $instance[ 'fn_about_email' ];
		}
		if ( !empty( $instance[ 'fn_about_content' ] ) ) {
			$fn_about_content 	= $instance[ 'fn_about_content' ];
		}
		if ( !empty( $instance[ 'fn_about_link_url' ] ) ) {
			$fn_about_link_url 	= $instance[ 'fn_about_link_url' ];
		}
		if ( !empty( $instance[ 'fn_about_image' ] ) ) {
			$fn_about_image 	= $instance[ 'fn_about_image' ];
		}
		if ( !empty( $instance[ 'fn_about_signature' ] ) ) {
			$fn_about_signature = $instance[ 'fn_about_signature' ];
		}
		
		/* Before widget (defined by themes). */
		echo wp_kses_post($before_widget);

		?>
           	<div class="artemiz_fn_widget_about">
				<div class="afwa_img">
					<img src="<?php echo esc_url($fn_about_image);?>" alt="" />
					<?php echo wp_kses_post(artemiz_fn_getSVG_theme('about-widget-1'));?>
					<div class="abs_img" data-fn-bg-img="<?php echo esc_url($fn_about_image);?>"></div>
				</div>
				<div class="afwa_title">
					<div class="title_left">
						<h3><?php echo esc_html($fn_about_name); ?></h3>
						<p><?php echo esc_html($fn_about_email); ?></p>
					</div>
					<div class="title_right">
						<p><?php echo esc_html($fn_about_job); ?></p>
					</div>
				</div>
				<div class="afwa_desc">
					<p><?php echo esc_html($fn_about_content); ?></p>
				</div>
				<div class="afwa_signature">
					<img src="<?php echo esc_url($fn_about_signature);?>" alt="" />
                </div>
            </div>
            
		<?php 
		/* After widget (defined by themes). */
		echo wp_kses_post($after_widget);
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = array();
 
        $instance['fn_about_name'] 		= ( !empty( $new_instance['fn_about_name'] ) ) ? strip_tags( $new_instance['fn_about_name'] ) : '';
        $instance['fn_about_job'] 		= ( !empty( $new_instance['fn_about_job'] ) ) ? strip_tags( $new_instance['fn_about_job'] ) : '';
        $instance['fn_about_email'] 	= ( !empty( $new_instance['fn_about_email'] ) ) ? strip_tags( $new_instance['fn_about_email'] ) : '';
        $instance['fn_about_content'] 	= ( !empty( $new_instance['fn_about_content'] ) ) ? strip_tags( $new_instance['fn_about_content'] ) : '';
        $instance['fn_about_image'] 	= ( !empty( $new_instance['fn_about_image'] ) ) ? strip_tags( $new_instance['fn_about_image'] ) : '';
        $instance['fn_about_signature'] = ( !empty( $new_instance['fn_about_signature'] ) ) ? strip_tags( $new_instance['fn_about_signature'] ) : '';
 
        return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		
		/* Set up some default widget settings. */
		
		$name 		= ! empty( $instance['fn_about_name'] ) ? $instance['fn_about_name'] : esc_html__('Josephina Sanchez', 'artemiz');
		$job 		= ! empty( $instance['fn_about_job'] ) ? $instance['fn_about_job'] : esc_html__('Photographer & Blogger', 'artemiz');
		$email 		= ! empty( $instance['fn_about_email'] ) ? $instance['fn_about_email'] : esc_html__('josanchez@gmail.com', 'artemiz');
		$content 	= ! empty( $instance['fn_about_content'] ) ? $instance['fn_about_content'] : esc_html__('I want your outer personal style to reflect the inner you. I understand the importance of creating an interior that gives a sense of solace from the outside world.', 'artemiz');
		$image 		= ! empty( $instance['fn_about_image'] ) ? $instance['fn_about_image'] : '';
		$signature	= ! empty( $instance['fn_about_signature'] ) ? $instance['fn_about_signature'] : '';
		
		
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'fn_about_image' )); ?>"><?php esc_html_e('Image', 'artemiz'); ?></label><br />
			<img src="<?php echo esc_url($image); ?>" class="widefat fn_img"  /><br />
			<input class="fn_widget_add_button" type="button" value="<?php esc_html_e('Add Photo', 'artemiz'); ?>" />
			<input type="hidden" class="fn_about_image artemiz_fn_width100" id="<?php echo esc_attr($this->get_field_id( 'fn_about_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fn_about_image' )); ?>" value="<?php echo esc_attr($image); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'fn_about_name' )); ?>"><?php esc_html_e('Name', 'artemiz'); ?></label><br />
			<input id="<?php echo esc_attr($this->get_field_id( 'fn_about_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fn_about_name' )); ?>" value="<?php echo esc_attr($name); ?>" class="artemiz_fn_width100" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'fn_about_job' )); ?>"><?php esc_html_e('Job', 'artemiz'); ?></label><br />
			<input id="<?php echo esc_attr($this->get_field_id( 'fn_about_job' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fn_about_job' )); ?>" value="<?php echo esc_attr($job); ?>" class="artemiz_fn_width100" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'fn_about_email' )); ?>"><?php esc_html_e('Email', 'artemiz'); ?></label><br />
			<input id="<?php echo esc_attr($this->get_field_id( 'fn_about_email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fn_about_email' )); ?>" value="<?php echo esc_attr($email); ?>" class="artemiz_fn_width100" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'fn_about_content' )); ?>"><?php esc_html_e('Description', 'artemiz'); ?></label><br />
			<textarea id="<?php echo esc_attr($this->get_field_id( 'fn_about_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fn_about_content' )); ?>" class="artemiz_fn_width100" rows="4" cols="4"><?php echo wp_kses_post($content); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'fn_about_signature' )); ?>"><?php esc_html_e('Signature', 'artemiz'); ?></label><br />
			<img src="<?php echo esc_url($signature); ?>" class="widefat fn_img"  /><br />
			<input class="fn_widget_add_button" type="button" value="<?php esc_html_e('Add Photo', 'artemiz'); ?>" />
			<input type="hidden" class="fn_about_signature artemiz_fn_width100" id="<?php echo esc_attr($this->get_field_id( 'fn_about_signature' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fn_about_signature' )); ?>" value="<?php echo esc_attr($signature); ?>"/>
		</p>

	<?php
	}
}

$my_widget = new Artemiz_About();