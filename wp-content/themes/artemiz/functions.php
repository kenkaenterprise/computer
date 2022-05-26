<?php

	add_action( 'after_setup_theme', 'artemiz_fn_setup', 50 );

	function artemiz_fn_setup(){

		// REGISTER THEME MENU
		if(function_exists('register_nav_menus')){
			register_nav_menus(array('main_menu' 	=> esc_html__('Main Menu','artemiz')));
			register_nav_menus(array('mobile_menu' 	=> esc_html__('Mobile Menu','artemiz')));
			register_nav_menus(array('footer_menu' 	=> esc_html__('Footer Menu','artemiz')));
		}

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_action( 'wp_enqueue_scripts', 'artemiz_fn_scripts', 100 ); 
		add_action( 'wp_enqueue_scripts', 'artemiz_fn_styles', 100 );
		add_action( 'wp_enqueue_scripts', 'artemiz_fn_inline_styles', 150 );
		add_action( 'admin_enqueue_scripts', 'artemiz_fn_admin_scripts' );

		// Actions
		add_action( 'tgmpa_register', 'artemiz_fn_register_required_plugins' );

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 300, 300, true ); 								// Normal post thumbnails

		add_image_size( 'artemiz_fn_thumb-675-0', 675, 0, true);				// Portfolio Categories
		add_image_size( 'artemiz_fn_thumb-1400-0', 1400, 0, true);				// Portfolio Page
		add_image_size( 'artemiz_fn_thumb-1920-0', 1920, 0, true);				// Full Image

		//Load Translation Text Domain
		load_theme_textdomain( 'artemiz', get_template_directory() . '/languages' );





		// Firing Title Tag Function
		artemiz_fn_theme_slug_setup();

		add_filter(	'widget_tag_cloud_args', 'artemiz_fn_tag_cloud_args');

		if ( ! isset( $content_width ) ) $content_width = 1170;

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'wp_list_comments' );

		add_editor_style() ;

		// for ajax
		add_action( 'wp_ajax_nopriv_artemiz_fn_ajax_service_list', 'artemiz_fn_ajax_service_list' );
		add_action( 'wp_ajax_artemiz_fn_ajax_service_list', 'artemiz_fn_ajax_service_list' );

		// for ajax woocommerce
		add_action( 'wp_ajax_nopriv_artemiz_fn_remove_item_from_cart', 'artemiz_fn_remove_item_from_cart' );
		add_action( 'wp_ajax_artemiz_fn_remove_item_from_cart', 'artemiz_fn_remove_item_from_cart' );

		$my_theme 		= wp_get_theme( 'artemiz' );
		$version		= '1.0';
		if ( $my_theme->exists() ){
			$version 	= (string)$my_theme->get( 'Version' );
		}
		$version		= 'ver_'.$version;
		define('ARTEMIZ_VERSION', $version);
		define('ARTEMIZ_THEME_URL', get_template_directory_uri());
		/* ------------------------------------------------------------------------ */
		/*  Inlcudes
		/* ------------------------------------------------------------------------ */
		include_once( get_template_directory().'/inc/artemiz_fn_functions.php'); 				// Custom Functions
		include_once( get_template_directory().'/inc/artemiz_fn_googlefonts.php'); 				// Google Fonts Init
		include_once( get_template_directory().'/inc/artemiz_fn_css.php'); 						// Inline CSS
		include_once( get_template_directory().'/inc/artemiz_fn_sidebars.php'); 				// Widget Area
		include_once( get_template_directory().'/inc/artemiz_fn_like.php'); 					// Like Post
		include_once( get_template_directory().'/inc/artemiz_fn_pagination.php'); 				// Pagination


	}



add_action( 'show_user_profile', 'artemiz_fn_user_social_fields' );
add_action( 'edit_user_profile', 'artemiz_fn_user_social_fields' );

function artemiz_fn_user_social_fields( $user ) {
		$userID				= $user->ID;
		// icons
		$facebook_icon 		= '<i class="fn-icon-facebook"></i>';
		$twitter_icon 		= '<i class="fn-icon-twitter"></i>';
		$pinterest_icon 	= '<i class="fn-icon-pinterest"></i>';
		$linkedin_icon 		= '<i class="fn-icon-linkedin"></i>';
		$behance_icon 		= '<i class="fn-icon-behance"></i>';
		$vimeo_icon 		= '<i class="fn-icon-vimeo-1"></i>';
		$google_icon 		= '<i class="fn-icon-gplus"></i>';
		$youtube_icon 		= '<i class="fn-icon-youtube-play"></i>';
		$instagram_icon 	= '<i class="fn-icon-instagram"></i>';
		$github_icon 		= '<i class="fn-icon-github"></i>';
		$flickr_icon 		= '<i class="fn-icon-flickr"></i>';
		$dribbble_icon 		= '<i class="fn-icon-dribbble"></i>';
		$dropbox_icon 		= '<i class="fn-icon-dropbox"></i>';
		$paypal_icon 		= '<i class="fn-icon-paypal"></i>';
		$picasa_icon 		= '<i class="fn-icon-picasa"></i>';
		$soundcloud_icon 	= '<i class="fn-icon-soundcloud"></i>';
		$whatsapp_icon 		= '<i class="fn-icon-whatsapp"></i>';
		$skype_icon 		= '<i class="fn-icon-skype"></i>';
		$slack_icon 		= '<i class="fn-icon-slack"></i>';
		$wechat_icon 		= '<i class="fn-icon-wechat"></i>';
		$icq_icon 			= '<i class="fn-icon-icq"></i>';
		$rocketchat_icon 	= '<i class="fn-icon-rocket"></i>';
		$telegram_icon 		= '<i class="fn-icon-telegram"></i>';
		$vkontakte_icon 	= '<i class="fn-icon-vk"></i>';
		$rss_icon		 	= '<i class="fn-icon-rss"></i>';

?>
    <h3><?php esc_html_e("Artemiz extra profile information", "artemiz"); ?></h3>

    <table class="form-table">
		<tr>
			<th><label for="artemiz_fn_user_image"><?php esc_html_e("Image URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_image" id="artemiz_fn_user_image" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_image', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please insert your profile image URL (media URL or any website image URL)", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_name"><?php esc_html_e("Full Name", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_name" id="artemiz_fn_user_name" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_name', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your full name", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_desc"><?php esc_html_e("Information", 'artemiz'); ?></label></th>
			<td>
				<textarea name="artemiz_fn_user_desc" cols="30" rows="5" id="artemiz_fn_user_desc" class="regular-text"><?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_desc', $userID ) ); ?></textarea><br />
				<span class="description"><?php esc_html_e("Please enter some description name", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_facebook"><span><?php echo wp_kses_post($facebook_icon);?></span><?php esc_html_e("Facebook URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_facebook" id="artemiz_fn_user_facebook" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_facebook', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your facebook profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_twitter"><span><?php echo wp_kses_post($twitter_icon);?></span><?php esc_html_e("Twitter URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_twitter" id="artemiz_fn_user_twitter" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_twitter', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your twitter profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_pinterest"><span><?php echo wp_kses_post($pinterest_icon);?></span><?php esc_html_e("Pinterest URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_pinterest" id="artemiz_fn_user_pinterest" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_pinterest', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your pinterest profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_linkedin"><span><?php echo wp_kses_post($linkedin_icon);?></span><?php esc_html_e("Linkedin URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_linkedin" id="artemiz_fn_user_linkedin" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_linkedin', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your linkedin profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_behance"><span><?php echo wp_kses_post($behance_icon);?></span><?php esc_html_e("Behance URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_behance" id="artemiz_fn_user_behance" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_behance', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your linkedin profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_vimeo"><span><?php echo wp_kses_post($vimeo_icon);?></span><?php esc_html_e("Vimeo URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_vimeo" id="artemiz_fn_user_vimeo" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_vimeo', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your linkedin profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_google"><span><?php echo wp_kses_post($google_icon);?></span><?php esc_html_e("Google URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_google" id="artemiz_fn_user_google" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_google', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your google profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_youtube"><span><?php echo wp_kses_post($youtube_icon);?></span><?php esc_html_e("Youtube URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_youtube" id="artemiz_fn_user_youtube" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_youtube', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your youtube profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_instagram"><span><?php echo wp_kses_post($instagram_icon);?></span><?php esc_html_e("Instagram URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_instagram" id="artemiz_fn_user_instagram" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_instagram', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your instagram profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_github"><span><?php echo wp_kses_post($github_icon);?></span><?php esc_html_e("Github URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_github" id="artemiz_fn_user_github" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_github', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your github profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_flickr"><span><?php echo wp_kses_post($flickr_icon);?></span><?php esc_html_e("Flickr URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_flickr" id="artemiz_fn_user_flickr" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_flickr', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your flickr profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_dribbble"><span><?php echo wp_kses_post($dribbble_icon);?></span><?php esc_html_e("Dribbble URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_dribbble" id="artemiz_fn_user_dribbble" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_dribbble', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your dribbble profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_dropbox"><span><?php echo wp_kses_post($dropbox_icon);?></span><?php esc_html_e("Dropbox URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_dropbox" id="artemiz_fn_user_dropbox" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_dropbox', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your dropbox profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_paypal"><span><?php echo wp_kses_post($paypal_icon);?></span><?php esc_html_e("Paypal URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_paypal" id="artemiz_fn_user_paypal" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_paypal', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your paypal profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_picasa"><span><?php echo wp_kses_post($picasa_icon);?></span><?php esc_html_e("Picasa URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_picasa" id="artemiz_fn_user_picasa" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_picasa', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your picasa profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_soundcloud"><span><?php echo wp_kses_post($soundcloud_icon);?></span><?php esc_html_e("Soundcloud URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_soundcloud" id="artemiz_fn_user_soundcloud" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_soundcloud', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your soundcloud profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_whatsapp"><span><?php echo wp_kses_post($whatsapp_icon);?></span><?php esc_html_e("Whatsapp URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_whatsapp" id="artemiz_fn_user_whatsapp" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_whatsapp', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your whatsapp profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_skype"><span><?php echo wp_kses_post($skype_icon);?></span><?php esc_html_e("Skype URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_skype" id="artemiz_fn_user_skype" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_skype', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your skype profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_slack"><span><?php echo wp_kses_post($slack_icon);?></span><?php esc_html_e("Slack URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_slack" id="artemiz_fn_user_slack" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_slack', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your slack profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_wechat"><span><?php echo wp_kses_post($wechat_icon);?></span><?php esc_html_e("WeChat URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_wechat" id="artemiz_fn_user_wechat" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_wechat', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your wechat profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_icq"><span><?php echo wp_kses_post($icq_icon);?></span><?php esc_html_e("ICQ URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_icq" id="artemiz_fn_user_icq" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_icq', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your icq profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_rocketchat"><span><?php echo wp_kses_post($rocketchat_icon);?></span><?php esc_html_e("RocketChat URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_rocketchat" id="artemiz_fn_user_rocketchat" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_rocketchat', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your rocketchat profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_telegram"><span><?php echo wp_kses_post($telegram_icon);?></span><?php esc_html_e("Telegram URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_telegram" id="artemiz_fn_user_telegram" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_telegram', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your telegram profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_vkontakte"><span><?php echo wp_kses_post($vkontakte_icon);?></span><?php esc_html_e("Vkontakte URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_vkontakte" id="artemiz_fn_user_vkontakte" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_vkontakte', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your vkontakte profile address", 'artemiz'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="artemiz_fn_user_rss"><span><?php echo wp_kses_post($rss_icon);?></span><?php esc_html_e("RSS URL", 'artemiz'); ?></label></th>
			<td>
				<input type="text" name="artemiz_fn_user_rss" id="artemiz_fn_user_rss" value="<?php echo esc_attr( get_the_author_meta( 'artemiz_fn_user_rss', $userID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e("Please enter your rss profile address", 'artemiz'); ?></span>
			</td>
		</tr>
    </table>
<?php }


add_action( 'personal_options_update', 'artemiz_fn_user_social_fields_save' );
add_action( 'edit_user_profile_update', 'artemiz_fn_user_social_fields_save' );

function artemiz_fn_user_social_fields_save( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'artemiz_fn_user_image', 		$_POST['artemiz_fn_user_image'] );
    update_user_meta( $user_id, 'artemiz_fn_user_name', 		$_POST['artemiz_fn_user_name'] );
    update_user_meta( $user_id, 'artemiz_fn_user_desc', 		$_POST['artemiz_fn_user_desc'] );
    update_user_meta( $user_id, 'artemiz_fn_user_facebook', 	$_POST['artemiz_fn_user_facebook'] );
    update_user_meta( $user_id, 'artemiz_fn_user_twitter', 		$_POST['artemiz_fn_user_twitter'] );
    update_user_meta( $user_id, 'artemiz_fn_user_pinterest', 	$_POST['artemiz_fn_user_pinterest'] );
    update_user_meta( $user_id, 'artemiz_fn_user_linkedin', 	$_POST['artemiz_fn_user_linkedin'] );
    update_user_meta( $user_id, 'artemiz_fn_user_behance', 		$_POST['artemiz_fn_user_behance'] );
    update_user_meta( $user_id, 'artemiz_fn_user_vimeo', 		$_POST['artemiz_fn_user_vimeo'] );
    update_user_meta( $user_id, 'artemiz_fn_user_google', 		$_POST['artemiz_fn_user_google'] );
    update_user_meta( $user_id, 'artemiz_fn_user_youtube', 		$_POST['artemiz_fn_user_youtube'] );
    update_user_meta( $user_id, 'artemiz_fn_user_instagram', 	$_POST['artemiz_fn_user_instagram'] );
    update_user_meta( $user_id, 'artemiz_fn_user_github', 		$_POST['artemiz_fn_user_github'] );
    update_user_meta( $user_id, 'artemiz_fn_user_flickr', 		$_POST['artemiz_fn_user_flickr'] );
    update_user_meta( $user_id, 'artemiz_fn_user_dribbble', 	$_POST['artemiz_fn_user_dribbble'] );
    update_user_meta( $user_id, 'artemiz_fn_user_dropbox', 		$_POST['artemiz_fn_user_dropbox'] );
    update_user_meta( $user_id, 'artemiz_fn_user_paypal', 		$_POST['artemiz_fn_user_paypal'] );
    update_user_meta( $user_id, 'artemiz_fn_user_picasa', 		$_POST['artemiz_fn_user_picasa'] );
    update_user_meta( $user_id, 'artemiz_fn_user_soundcloud', 	$_POST['artemiz_fn_user_soundcloud'] );
    update_user_meta( $user_id, 'artemiz_fn_user_whatsapp', 	$_POST['artemiz_fn_user_whatsapp'] );
    update_user_meta( $user_id, 'artemiz_fn_user_skype', 		$_POST['artemiz_fn_user_skype'] );
    update_user_meta( $user_id, 'artemiz_fn_user_slack', 		$_POST['artemiz_fn_user_slack'] );
    update_user_meta( $user_id, 'artemiz_fn_user_wechat', 		$_POST['artemiz_fn_user_wechat'] );
    update_user_meta( $user_id, 'artemiz_fn_user_icq', 			$_POST['artemiz_fn_user_icq'] );
    update_user_meta( $user_id, 'artemiz_fn_user_rocketchat', 	$_POST['artemiz_fn_user_rocketchat'] );
    update_user_meta( $user_id, 'artemiz_fn_user_telegram', 	$_POST['artemiz_fn_user_telegram'] );
    update_user_meta( $user_id, 'artemiz_fn_user_vkontakte', 	$_POST['artemiz_fn_user_vkontakte'] );
    update_user_meta( $user_id, 'artemiz_fn_user_rss', 			$_POST['artemiz_fn_user_rss'] );
}




/* ----------------------------------------------------------------------------------- */
/*  ENQUEUE STYLES AND SCRIPTS
/* ----------------------------------------------------------------------------------- */
	function artemiz_fn_scripts() {
		wp_enqueue_script('modernizr-custom', get_template_directory_uri() . '/framework/js/modernizr.custom.js', array('jquery'), ARTEMIZ_VERSION, FALSE);
		wp_enqueue_script('isotope', get_template_directory_uri() . '/framework/js/isotope.js', array('jquery'), ARTEMIZ_VERSION, TRUE);
		wp_enqueue_script('mediaelement-and-player.min', get_template_directory_uri() . '/framework/js/mediaelement-and-player.min.js', array('jquery'), ARTEMIZ_VERSION, TRUE);
		wp_enqueue_script('artemiz-fn-maudio', get_template_directory_uri() . '/framework/js/maudio.js', array('jquery'), ARTEMIZ_VERSION, TRUE);
		wp_enqueue_script('artemiz-fn-init', get_template_directory_uri() . '/framework/js/init.js', array('jquery'), ARTEMIZ_VERSION, TRUE);
		wp_localize_script( 'artemiz-fn-init', 'fn_ajax_object', array( 'fn_ajax_url' => admin_url( 'admin-ajax.php' )) );
		
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	}
	
	function artemiz_fn_admin_scripts() {
		wp_enqueue_script('artemiz-fn-widget-upload', get_template_directory_uri() . '/framework/js/widget.upload.js', array('jquery'), ARTEMIZ_VERSION, FALSE);
		wp_enqueue_style('artemiz-fn-fontello', get_template_directory_uri().'/framework/css/fontello.css', array(), ARTEMIZ_VERSION, 'all');
		wp_enqueue_style('artemiz-fn-admin-style', get_template_directory_uri().'/framework/css/admin.style.css', array(), ARTEMIZ_VERSION, 'all');
	}

	function artemiz_fn_styles(){
		wp_enqueue_style('artemiz-fn-font-url', artemiz_fn_font_url(), array(), null );
		wp_enqueue_style('artemiz-fn-maudio', get_template_directory_uri().'/framework/css/maudio.css', array(), ARTEMIZ_VERSION, 'all');
		wp_enqueue_style('fontello', get_template_directory_uri().'/framework/css/fontello.css', array(), ARTEMIZ_VERSION, 'all');
		wp_enqueue_style('mediaelementplayer.min', get_template_directory_uri().'/framework/css/mediaelementplayer.min.css', array(), ARTEMIZ_VERSION, 'all');
		wp_enqueue_style('artemiz-fn-base', get_template_directory_uri().'/framework/css/base.css', array(), ARTEMIZ_VERSION, 'all');
		wp_enqueue_style('artemiz-fn-skeleton', get_template_directory_uri().'/framework/css/skeleton.css', array(), ARTEMIZ_VERSION, 'all');
		wp_enqueue_style('artemiz-fn-stylesheet', get_stylesheet_uri(), array(), ARTEMIZ_VERSION, 'all' ); // Main Stylesheet
	}





/* ----------------------------------------------------------------------------------- */
/*  Title tag: works WordPress v4.1 and above
/* ----------------------------------------------------------------------------------- */
	function artemiz_fn_theme_slug_setup() {
		add_theme_support( 'title-tag' );
	}
/* ----------------------------------------------------------------------------------- */
/*  Tagcloud widget
/* ----------------------------------------------------------------------------------- */
	
	function artemiz_fn_tag_cloud_args($args)
	{
		$my_args = array('smallest' => 14, 'largest' => 14, 'unit'=>'px', 'orderby'=>'count', 'order'=>'DESC' );
		$args = wp_parse_args( $args, $my_args );
		return $args;
	}

	
/*-----------------------------------------------------------------------------------*/
/*	TGM Plugin Activation
/*-----------------------------------------------------------------------------------*/

require_once get_template_directory().'/plugin/class-tgm-plugin-activation.php';

function artemiz_fn_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Artemiz Core', // The plugin name.
			'slug'               => 'artemiz-core', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugin/artemiz-core.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Redux Vendor Support', // The plugin name.
			'slug'               => 'redux-vendor-support-master', // The plugin slug (typically the folder name).
			'source'             => 'https://github.com/reduxframework/redux-vendor-support/archive/master.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => 'https://github.com/reduxframework/redux-vendor-support/archive/master.zip', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Elementor', // The plugin name.
			'slug'               => 'elementor', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Contact Form 7', // The plugin name.
			'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Categorify', // The plugin name.
			'slug'               => 'categorify', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Smash Balloon Instagram Feed', // The plugin name.
			'slug'               => 'instagram-feed', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'artemiz',          	 	 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}



?>