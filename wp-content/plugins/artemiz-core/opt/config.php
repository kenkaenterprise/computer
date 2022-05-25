<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "artemiz_fn_option";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'artemiz_fn_option',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'artemiz',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_frenify_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => false,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    
    Redux::setArgs( $opt_name, $args );


    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
	$adminURL = '<a href="'.admin_url('options-permalink.php').'">'.esc_html__('Here', 'redux-framework-demo').'</a>';	 
	$permalink_description = __('After changing this, go to following link and click save. '.$adminURL.'', 'redux-framework-demo');

	$langURL = '<a target="_blank" href="https://wpml.org/">'.esc_html__('WPML Multilingual CMS', 'redux-framework-demo').'</a>';	 
	$lang_desc = __('Please, install and set up following plugin: '.$langURL.'', 'redux-framework-demo');
    // -> START Basic Fields
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'General', 'redux-framework-demo' ),
        'id'    => 'general',
        'desc'  => esc_html__( '', 'redux-framework-demo' ),
        'icon'  => 'el el-globe',
		'fields' 	=> array(
			
			
			
			array(
				'id'		=> 'author_info_responsive',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Author Information on Mobile Devices', 'redux-framework-demo'),
				'subtitle'    => esc_html__('Enable or Disable Author information in blog/archive list on mobile devices', 'redux-framework-demo'),
				'on'		=> esc_html__('Enabled', 'redux-framework-demo'),
				'off'		=> esc_html__('Disabled', 'redux-framework-demo'),
				'default' 	=> true,
			),
			
			array(
				'id'		=> 'blog_single_title',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Page Title for Blog Single', 'redux-framework-demo'),
				'default'	=> esc_html__('Latest News', 'redux-framework-demo'),
			),
			
		)
			
	));
	Redux::setSection( $opt_name, array(
			'title' => esc_html__( 'Main Colors', 'redux-framework-demo' ),
			'id'    => 'main_color',
			'icon'  => 'el el-brush ',
			'fields' 	=> array(
			array(
				'id'		=> 'heading_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Heading Color', 'redux-framework-demo'),
				'default' 	=> '#1e1e1e',
				'validate' 	=> 'color',
			),
			array(
				'id'		=> 'primary_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Primary Color', 'redux-framework-demo'),
				'default' 	=> '#f3b469',
				'validate' 	=> 'color',
			),
		)
	));
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Logo', 'redux-framework-demo' ),
        'id'    => 'logo',
        'desc'  => esc_html__( '', 'redux-framework-demo' ),
        'icon'  => 'el el-puzzle',
		'fields' 	=> array(
			
			array(
				'id'			=> 'lines_logo_dark',
				'type' 			=> 'media',
				'url'       	=> true,
				'title' 		=> esc_html__('Logo for Dark Background', 'redux-framework-demo'),
				'subtitle'    	=> esc_html__('This logo will used for Dark Background of Navigations', 'redux-framework-demo'),
			),
		
			array(
				'id'			=> 'lines_logo_light',
				'type' 			=> 'media',
				'url'      	 	=> true,
				'title' 		=> esc_html__('Logo for Light Background', 'redux-framework-demo'),
				'subtitle'    	=> esc_html__('This logo will used for Light Background of Navigations', 'redux-framework-demo'),
			),

			array(
				'id'		=> 'mobile_logo',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Mobile Logo', 'redux-framework-demo'),
			),
		)
	));

	/****************************************************************************************************************************/
	/**************************************************** DESKTOP NAVIGATION ****************************************************/
	/****************************************************************************************************************************/
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Desktop Navigation', 'redux-framework-demo' ),
        'id'    => 'desktop_navigation',
        'icon'  => 'el el-laptop',
		'fields' 	=> array(
			array(
			   	'id' 		=> 'one_line_structure_start',
			   	'type' 		=> 'section',
				'title' 	=> esc_html__('Navigation Structure', 'redux-framework-demo'),
			   	'indent' 	=> true,
			),
			
			array(
				'id'      => 'one_sorter',
				'type'    => 'sorter',
				'title'   => esc_html__('Structure of the Navigation', 'redux-framework-demo'),
				'subtitle'    => esc_html__('Organize the navigation how you want to appear on your website. Drag and Drop elements from these columns, reorder them and drop to disable section to disable them.', 'redux-framework-demo'),
				'options' => array(
					'left'  => array(
						'logo'     			=> __('Logo', 'redux-framework-demo'),
					),
					'center' => array(
						'menu'				=> __('Menu', 'redux-framework-demo'),
					),
					'right' => array(
						'social'    	 	=> __('Social', 'redux-framework-demo'),
						'search'    	 	=> __('Search', 'redux-framework-demo'),
					),
					'disabled' => array(
					),
				),
			),
			array(
			   	'id' 		=> 'one_line_structure_end',
			   	'type' 		=> 'section',
			   	'indent' 	=> false
			),
			
			
			array(
			   	'id' 		=> 'one_line_options_start',
			   	'type' 		=> 'section',
			   	'title' 	=> esc_html__('Navigation Options', 'redux-framework-demo'),
			   	'indent' 	=> true,
			),
			
			array(
				'id'		=> 'one_line_middle_logo_in_nav',
				'type' 		=> 'switch',
				'title' 	=> esc_html__('Middle Logo in Navigation Menu', 'redux-framework-demo'),
				'subtitle'    => esc_html__('Please, make sure that "Menu" and "Logo" are not in "disabled" column to work this option.', 'redux-framework-demo'),
				'on'		=> esc_html__('Enabled', 'redux-framework-demo'),
				'off'		=> esc_html__('Disabled', 'redux-framework-demo'),
				'default' 	=> false,
			),
			
			array(
				'id'		=> 'one_line_nav_skin',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Global Navigation Skin', 'redux-framework-demo'),
				"default" 	=> 'light',
				'options' 	=> array(
								'dark'  		=> esc_html__('Dark', 'redux-framework-demo'),
								'light'  		=> esc_html__('Light', 'redux-framework-demo'),
								'nonedark'  	=> esc_html__('NoneDark', 'redux-framework-demo'),
								'nonelight'  	=> esc_html__('NoneLight', 'redux-framework-demo'),
								'transdark'  	=> esc_html__('TransDark', 'redux-framework-demo'),
								'translight'  	=> esc_html__('TransLight', 'redux-framework-demo'),
				),
			),
			
			array(
				'id'		=> 'one_line_nav_width',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Navigation Width', 'redux-framework-demo'),
				"default" 	=> 'full',
				'options' 	=> array(
								'full'  		=> esc_html__('Full', 'redux-framework-demo'),
								'contained'		=> esc_html__('Contained', 'redux-framework-demo'),
				),
				
			),
			array(
				'id'       	=> 'one_line_left_right',
				'type'     	=> 'dimensions',
				'units'    	=> array('px','%'),
				'title'    	=> esc_html__('Padding Left & Right', 'redux-framework-demo'),
				'height'	=> false,
				'default'  	=> array(
					'width'   => '50',
				),
				'required' 		=> array(
					array('one_line_nav_width','equals','full'),
				),
			),
			
			array(
				'id'		=> 'one_line_position',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Navigation Position', 'redux-framework-demo'),
				"default" 	=> 'relative',
				'options' 	=> array(
								'relative'  	=> esc_html__('Relative', 'redux-framework-demo'),
								'absolute'		=> esc_html__('Absolute', 'redux-framework-demo'),
				),
				
			),
			
			array(
			   	'id' 		=> 'one_line_options_end',
			   	'type' 		=> 'section',
			   	'indent' 	=> false,
			),
			
			array(
			   	'id' 		=> 'nav_social_section_start',
			   	'type' 		=> 'section',
				'title' 	=> esc_html__('Social Icons', 'redux-framework-demo'),
			   	'indent' 	=> true,
			),
			
			array(
				'id'       => 'nav_social_position',
				'type'     => 'sortable',
				'title'    => __('List positions / switcher', 'redux-framework-demo'),
				'subtitle' => __('Define and reorder these however you want.', 'redux-framework-demo'),
				'mode'     => 'checkbox',
				'options'  => array(
					'facebook'     		=> __('Facebook', 'redux-framework-demo'),
					'twitter'     		=> __('Twitter', 'redux-framework-demo'),
					'pinterest'     	=> __('Pinterest', 'redux-framework-demo'),
					'linkedin'     		=> __('Linkedin', 'redux-framework-demo'),
					'behance'     		=> __('Behance', 'redux-framework-demo'),
					'vimeo'      		=> __('Vimeo', 'redux-framework-demo'),
					'google'      		=> __('Google', 'redux-framework-demo'),
					'youtube'      		=> __('Youtube', 'redux-framework-demo'),
					'instagram'      	=> __('Instagram', 'redux-framework-demo'),
					'github'      		=> __('Github', 'redux-framework-demo'),
					'flickr'      		=> __('Flickr', 'redux-framework-demo'),
					'dribbble'      	=> __('Dribbble', 'redux-framework-demo'),
					'dropbox'	      	=> __('Dropbox', 'redux-framework-demo'),
					'paypal'	      	=> __('Paypal', 'redux-framework-demo'),
					'picasa'	      	=> __('Picasa', 'redux-framework-demo'),
					'soundcloud'      	=> __('SoundCloud', 'redux-framework-demo'),
					'whatsapp'	      	=> __('Whatsapp', 'redux-framework-demo'),
					'skype'	      		=> __('Skype', 'redux-framework-demo'),
					'slack'	      		=> __('Slack', 'redux-framework-demo'),
					'wechat'	      	=> __('WeChat', 'redux-framework-demo'),
					'icq'	     	 	=> __('ICQ', 'redux-framework-demo'),
					'rocketchat'   	 	=> __('RocketChat', 'redux-framework-demo'),
					'rocketchat'   	 	=> __('RocketChat', 'redux-framework-demo'),						
					'telegram'	      	=> __('Telegram', 'redux-framework-demo'),
					'vk'		      	=> __('Vkontakte', 'redux-framework-demo'),
					'rss'		      	=> __('RSS', 'redux-framework-demo'),
					'podcast'		    => __('Podcast', 'redux-framework-demo'),
					'qq'		   		=> __('QQ', 'redux-framework-demo'),
					'spotify'		   	=> __('Spotify', 'redux-framework-demo'),
					'flattr'		   	=> __('Flattr', 'redux-framework-demo'),
					'apple_music'		=> __('Apple Music', 'redux-framework-demo'),
				),
				// For checkbox mode
				'default' => array(
				),
			),
			array(
				'id'		=> 'nav_facebook_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Facebook URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_twitter_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Twitter URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_pinterest_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Pinterest URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_linkedin_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Linkedin URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_behance_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Behance URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_vimeo_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Vimeo URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_google_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Google URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_youtube_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Youtube URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_instagram_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Instagram URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_github_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Github URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_flickr_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Flickr URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_dribbble_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Dribbble URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_dropbox_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Dropbox URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_paypal_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Paypal URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_picasa_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Picasa URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_soundcloud_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Soundcloud URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_whatsapp_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Whatsapp URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_skype_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Skype URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_slack_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Slack URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_wechat_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Wechat URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_icq_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('ICQ URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_rocketchat_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Rocketchat URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_telegram_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Telegram URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_vk_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Vkontakte URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_rss_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('RSS URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_podcast_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Podcast URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_qq_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('QQ URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_spotify_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Spotify URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_flattr_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Flattr URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			array(
				'id'		=> 'nav_apple_music_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Apple Music URL', 'redux-framework-demo'),
				'default'	=> '#'
			),
			
			array(
			   	'id' 		=> 'nav_social_section_end',
			   	'type' 		=> 'section',
			   	'indent' 	=> false
			),
		)
    ));
	
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Mobile Navigation', 'redux-framework-demo' ),
        'id'    => 'mobile_navigation',
        'icon'  => 'el el-phone',
		'fields' 	=> array(
			
			array(
				'id'		=> 'mobile_menu_autocollapse',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Autocollapse Menu on Click', 'redux-framework-demo'),
				"default" 	=> 'disable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'),
								'disable'  		=> esc_html__('Disabled', 'redux-framework-demo')),
			),
			array(
				'id'		=> 'mobile_menu_open_default',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Menu Open Default', 'redux-framework-demo'),
				"default" 	=> 'disable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'),
								'disable'  		=> esc_html__('Disabled', 'redux-framework-demo')),
			),
			
			array(
			   	'id' 		=> 'mob_nav_skin_start',
			   	'type' 		=> 'section',
			   	'title' 	=> esc_html__('Colors', 'redux-framework-demo'),
			   	'indent' 	=> true,
			),
				array(
					'id'		=> 'mob_nav_bg_color',
					'type' 		=> 'color',
					'transparent' => false,
					'title' 	=> esc_html__('Background Color', 'redux-framework-demo'),
					'default' 	=> '#0f0f16',
					'validate' 	=> 'color',
				),
				array(
					'id'		=> 'mob_nav_hamb_color',
					'type' 		=> 'color',
					'transparent' => false,
					'title' 	=> esc_html__('Hamburger Color', 'redux-framework-demo'),
					'default' 	=> '#ccc',
					'validate' 	=> 'color',
				),
				array(
					'id'		=> 'mob_nav_ddbg_color',
					'type' 		=> 'color',
					'transparent' => false,
					'title' 	=> esc_html__('Dropdown Background Color', 'redux-framework-demo'),
					'default' 	=> '#f3b469',
					'validate' 	=> 'color',
				),
				array(
					'id'		=> 'mob_nav_ddlink_color',
					'type' 		=> 'color',
					'transparent' => false,
					'title' 	=> esc_html__('Dropdown Link Regular Color', 'redux-framework-demo'),
					'default' 	=> '#000',
					'validate' 	=> 'color',
				),
				array(
					'id'		=> 'mob_nav_ddlink_ha_color',
					'type' 		=> 'color',
					'transparent' => false,
					'title' 	=> esc_html__('Dropdown Link Hover & Active Color', 'redux-framework-demo'),
					'default' 	=> '#fff',
					'validate' 	=> 'color',
				),
			array(
				'id'     	=> 'nav_custom_skin_end',
				'type'   	=> 'section',
				'indent' 	=> false,
			),
		)

	));


	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Typography', 'redux-framework-demo' ),
        'id'    => 'typography',
        'desc'  => esc_html__( '', 'redux-framework-demo' ),
        'icon'  => 'el el-font',
		'fields' 	=> array(
			array(
				'id'		=> 'body_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Body Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the body font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' => false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '18px',
					'font-family' 	=> 'Heebo',
					'font-weight' 	=> '400',
				),
			),
			array(
				'id'		=> 'nav_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Desktop Navigation Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the navigation font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '20px',
					'font-family' 	=> 'Heebo',
					'font-weight' 	=> '500',
				),
			),
			array(
				'id'		=> 'submenu_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Desktop Submenu Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the submenu font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '16px',
					'font-family' 	=> 'Quicksand',
					'font-weight' 	=> '500',
				),
			),
			array(
				'id'		=> 'nav_mob_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Mobile Navigation Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the navigation font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '18px',
					'font-family' 	=> 'Heebo',
					'font-weight' 	=> '500',
				),
			),
		
			array(
				'id'		=> 'input_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Input Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the Input font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '14px',
					'font-family' 	=> 'Heebo',
					'font-weight' 	=> '400',
				),
			),
			array(
				'id'		=> 'blockquote_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Blockquote Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the blockquote font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '20px',
					'font-family' 	=> 'Lora',
					'font-weight' 	=> '400',
				),
			),
			array(
				'id'		=> 'heading_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Heading Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the heading font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'font-size' => false,
				'text-align' => false,
				'default' 	=> array(
					'font-family' 	=> 'Neuton',
					'font-weight' 	=> '400',
				),
			),
		)
    ));
	
Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Podcast', 'redux-framework-demo' ),
        'id'    => 'podcast',
        'desc'  => esc_html__( '', 'redux-framework-demo' ),
        'icon'  => 'el el-podcast',
		'fields' 	=> array(
			array(
				'id'		=> 'podcast_layout',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Podcast Layout', 'redux-framework-demo'),
				"default" 	=> 'grid',
				'options' 	=> array(
								'grid'  		=> esc_html__('Grid', 'redux-framework-demo'),
								'list'  		=> esc_html__('List', 'redux-framework-demo'),
								'interactive'	=> esc_html__('Interactive', 'redux-framework-demo'),
				),
			),
	
			array(
				'id' 		=> 'podcast_perpage',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Podcast Posts Per Page', 'redux-framework-demo'),
				"default" 	=> "6",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "30",
			),
			array(
				'id' 		=> 'podcast_border_radius',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Border Radius for list and interactive layouts', 'redux-framework-demo'),
				"default" 	=> "3",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "50",
			),
			array(
				'id' 		=> 'podcast_slug',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Podcast Slug', 'frenify-core'),
				'subtitle' 	=> $permalink_description,
				'default' 	=> 'mypodcast',
			),
		
			array(
				'id' 		=> 'podcast_cat_slug',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Podcast Category Slug', 'frenify-core'),
				'subtitle' 	=> $permalink_description,
				'default' 	=> 'mypodcast-cat',
			),
			array(
				'id'		=> 'podcast_archive_title',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Title for Podcast Archive', 'redux-framework-demo'),
				'default'	=> esc_html__('Podcast Archive', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'podcast_bread_title',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Title for Podcast Breadcrumbs', 'redux-framework-demo'),
				'default'	=> esc_html__('Podcast Archive', 'redux-framework-demo'),
			),
	)
));


Redux::setSection( $opt_name, array(
        'title' => __( 'Share Options', 'redux-framework-demo' ),
        'id'    => 'sharebox',
        'icon'  => 'el el-share-alt',
		'fields' 	=> array(  
			array(
				'id' 		=> 'share_facebook',
				'type' 		=> 'button_set',
				'title' 	=> __('Facebook', 'redux-framework-demo'),
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
								'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')), 
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_twitter',
				'type' 		=> 'button_set',
				'title' 	=> __('Twitter', 'redux-framework-demo'),
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
								'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')), 
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_google',
				'type' 		=> 'button_set',
				'title' 	=> __('Google Plus', 'redux-framework-demo'),
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
								'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')), 
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_pinterest',
				'type' 		=> 'button_set',
				'title' 	=> __('Pinterest', 'redux-framework-demo'),
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
								'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_linkedin',
				'type' 		=> 'button_set',
				'title' 	=> __('Linkedin', 'redux-framework-demo'),
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
								'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),
				'default' 	=> 'disable'
			),
			array(
				'id' 		=> 'share_email',
				'type' 		=> 'button_set',
				'title' 	=> __('Email', 'redux-framework-demo'),
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
								'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),
				'default' 	=> 'disable'
			),
			array(
				'id' 		=> 'share_vk',
				'type' 		=> 'button_set',
				'title' 	=> __('Vkontakte', 'redux-framework-demo'),
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
								'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),
				'default' 	=> 'enable'
			),
		)
    ));
   Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Footer', 'redux-framework-demo' ),
        'id'    => 'footer',
        'desc'  => esc_html__( '', 'redux-framework-demo' ),
        'icon'  => 'el el-road',
		'fields' 	=> array(
			array(
				'id'		=> 'footer_switch',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Footer', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
								'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),			
			),
			
			array(
				'id'      => 'footer_sorter',
				'type'    => 'sorter',
				'title'   => esc_html__('Structure of the Footer', 'redux-framework-demo'),
				'subtitle'    => esc_html__('Organize the footer how you want to appear on your website. Drag and Drop elements from these columns, reorder them and drop to disable section to disable them.', 'redux-framework-demo'),
				'options' => array(
					'left'  => array(
						'text_1'     		=> __('Footer Text #1', 'redux-framework-demo'),
					),
					'center' => array(
						'menu'     			=> __('Footer Menu', 'redux-framework-demo'),
						'social'     		=> __('Social List', 'redux-framework-demo'),
					),
					'right' => array(
						'text_2'    	 	=> __('Footer Text #2', 'redux-framework-demo'),
					),
					'disabled' => array(
						'footer-widget-1'    	 		=> __('Footer Widget #1', 'redux-framework-demo'),
						'footer-widget-2'    	 		=> __('Footer Widget #2', 'redux-framework-demo'),
						'footer-widget-3'    	 		=> __('Footer Widget #3', 'redux-framework-demo'),
					),
				),
				'required' 		=> array(
					array('footer_switch','equals','enable'),
				),
			),
			array(
			   	'id' 		=> 'footer_instagram_section_start',
			   	'type' 		=> 'section',
				'title' 	=> esc_html__('Instagram Options', 'redux-framework-demo'),
			   	'indent' 	=> true,
				'required' 		=> array(
					array('footer_switch','equals','enable'),
				),
			),
			array(
				'id'		=> 'footer_instagram',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Section Switcher', 'redux-framework-demo'),
				"default" 	=> 'disable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
								'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),
			),
			array(
			   	'id' 		=> 'footer_instagram_section_end',
			   	'type' 		=> 'section',
			   	'indent' 	=> false,
			),
			array(
				'id' 		=> 'footer_text_1',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Footer Text #1', 'redux-framework-demo'),
				'default' 	=> wp_kses_post('Copyright © 2020.'),
				'required' 		=> array(
					array('footer_switch','equals','enable'),
				),
			),
			array(
				'id' 		=> 'footer_text_2',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Footer Text #2', 'redux-framework-demo'),
				'default' 	=> wp_kses_post('Developed by Frenify.'),
				'required' 		=> array(
					array('footer_switch','equals','enable'),
				),
			),
			array(
			   	'id' 		=> 'footer_design_section_start',
			   	'type' 		=> 'section',
				'title' 	=> esc_html__('Customization', 'redux-framework-demo'),
			   	'indent' 	=> true,
				'required' 		=> array(
					array('footer_switch','equals','enable'),
				),
			),
	   		array(
				'id'		=> 'footer_bg_1',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Top Section Background Color', 'redux-framework-demo'),
				'default' 	=> '#fff',
				'validate' 	=> 'color',
			),
	   		array(
				'id'		=> 'footer_bg_2',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Bottom Section Background Color', 'redux-framework-demo'),
				'default' 	=> '#0b0e13',
				'validate' 	=> 'color',
			),
			array(
			   	'id' 		=> 'footer_design_section_end',
			   	'type' 		=> 'section',
			   	'indent' 	=> false,
			),
			
			array(
			   	'id' 		=> 'footer_social_section_start',
			   	'type' 		=> 'section',
				'title' 	=> esc_html__('Footer Social Icons', 'redux-framework-demo'),
			   	'indent' 	=> true,
				'required' 		=> array(
					array('footer_switch','equals','enable'),
				),
			),
			
			array(
				'id'       => 'footer_social_position',
				'type'     => 'sortable',
				'title'    => __('List positions / switcher', 'redux-framework-demo'),
				'subtitle' => __('Define and reorder these however you want.', 'redux-framework-demo'),
				'mode'     => 'checkbox',
				'options'  => array(
					'facebook'     		=> __('Facebook', 'redux-framework-demo'),
					'twitter'     		=> __('Twitter', 'redux-framework-demo'),
					'pinterest'     	=> __('Pinterest', 'redux-framework-demo'),
					'linkedin'     		=> __('Linkedin', 'redux-framework-demo'),
					'behance'     		=> __('Behance', 'redux-framework-demo'),
					'vimeo'      		=> __('Vimeo', 'redux-framework-demo'),
					'google'      		=> __('Google', 'redux-framework-demo'),
					'youtube'      		=> __('Youtube', 'redux-framework-demo'),
					'instagram'      	=> __('Instagram', 'redux-framework-demo'),
					'github'      		=> __('Github', 'redux-framework-demo'),
					'flickr'      		=> __('Flickr', 'redux-framework-demo'),
					'dribbble'      	=> __('Dribbble', 'redux-framework-demo'),
					'dropbox'	      	=> __('Dropbox', 'redux-framework-demo'),
					'paypal'	      	=> __('Paypal', 'redux-framework-demo'),
					'picasa'	      	=> __('Picasa', 'redux-framework-demo'),
					'soundcloud'      	=> __('SoundCloud', 'redux-framework-demo'),
					'whatsapp'	      	=> __('Whatsapp', 'redux-framework-demo'),
					'skype'	      		=> __('Skype', 'redux-framework-demo'),
					'slack'	      		=> __('Slack', 'redux-framework-demo'),
					'wechat'	      	=> __('WeChat', 'redux-framework-demo'),
					'icq'	     	 	=> __('ICQ', 'redux-framework-demo'),
					'rocketchat'   	 	=> __('RocketChat', 'redux-framework-demo'),
					'rocketchat'   	 	=> __('RocketChat', 'redux-framework-demo'),						
					'telegram'	      	=> __('Telegram', 'redux-framework-demo'),
					'vk'		      	=> __('Vkontakte', 'redux-framework-demo'),
					'rss'		      	=> __('RSS', 'redux-framework-demo'),
					'podcast'		    => __('Podcast', 'redux-framework-demo'),
					'qq'		   		=> __('QQ', 'redux-framework-demo'),
					'spotify'		   	=> __('Spotify', 'redux-framework-demo'),
					'flattr'		   	=> __('Flattr', 'redux-framework-demo'),
					'apple_music'		=> __('Apple Music', 'redux-framework-demo'),
				),
				// For checkbox mode
				'default' => array(
				),
			),
			array(
				'id'		=> 'footer_facebook_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Facebook URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_twitter_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Twitter URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_pinterest_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Pinterest URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_linkedin_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Linkedin URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_behance_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Behance URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_vimeo_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Vimeo URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_google_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Google URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_youtube_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Youtube URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_instagram_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Instagram URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_github_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Github URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_flickr_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Flickr URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_dribbble_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Dribbble URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_dropbox_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Dropbox URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_paypal_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Paypal URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_picasa_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Picasa URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_soundcloud_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Soundcloud URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_whatsapp_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Whatsapp URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_skype_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Skype URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_slack_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Slack URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_wechat_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Wechat URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_icq_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('ICQ URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_rocketchat_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Rocketchat URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_telegram_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Telegram URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_vk_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Vkontakte URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_rss_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('RSS URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_podcast_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Podcast URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_qq_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('QQ URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_spotify_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Spotify URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_flattr_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Flattr URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
				'id'		=> 'footer_apple_music_helpful',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Apple Music URL', 'redux-framework-demo'),
	   			'default'	=> '#'
			),
			array(
			   	'id' 		=> 'footer_social_section_end',
			   	'type' 		=> 'section',
			   	'indent' 	=> false
			),
		),
	));
	
	
	

	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'To Top', 'redux-framework-demo' ),
        'id'    => 'totop',
        'icon'  => 'el el-arrow-up',
		'fields' 	=> array(
			
			array(
					'id'		=> 'totop_fixed_switch',
					'type' 		=> 'button_set',
					'title' 	=> esc_html__('Switcher', 'redux-framework-demo'),
					"default" 	=> 'disable',
					'options' 	=> array(
									'enable'  		=> esc_html__('Enabled', 'redux-framework-demo'), 
									'disable' 		=> esc_html__('Disabled', 'redux-framework-demo')),		
			),
			
			array(
				'id' 			=> 'totop_fixed_active_h',
				'type' 			=> 'slider',
				'title' 		=> esc_html__('Button appears after scrolling the page to this px', 'redux-framework-demo'),
				"default" 		=> "400",
				"min" 			=> "1",
				"step" 			=> "1",
				"max" 			=> "5000",
			),
			
			array(
				'id'             => 'totop_fixed_coordinate',
				'type'           => 'spacing',
				'mode'           => 'margin',
				'units'          => array('px'),
				'units_extended' => 'false',
				'top'			 => false,
				'left'			 => false,
				'title'          => __('Button Positioning', 'redux-framework-demo'),
				'default'           => array(
					'right'  		=> '50px', 
					'bottom'  		=> '50px', 
					'units'         => 'px', 
				)
			),
			
			array(
				'id'			=> 'totop_fixed_bgcolor',
				'type' 			=> 'color',
				'transparent' 	=> false,
				'title' 		=> esc_html__('Background Color', 'redux-framework-demo'),
				'default' 		=> '#444',
				'output'    	=> array('background-color' => 'a.artemiz_fn_totop'),
				'validate' 		=> 'color',
			),
			
			array(
				'id'			=> 'totop_fixed_iconcolor',
				'type' 			=> 'color',
				'transparent' 	=> false,
				'title' 		=> esc_html__('Icon Color', 'redux-framework-demo'),
				'default' 		=> '#fff',
				'output'    	=> array('border-bottom-color' => 'a.artemiz_fn_totop:after'),
				'validate' 		=> 'color',
			),
		)
		
	));
	
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Custom CSS', 'redux-framework-demo' ),
        'id'    => 'css',
        'desc'  => esc_html__( '', 'redux-framework-demo' ),
        'icon'  => 'el el-css',
		'fields' 	=> array(
			array(
				'id'       => 'custom_css',
				'type'     => 'ace_editor',
				'title'    => __('Custom CSS', 'redux-framework-demo'),
				'subtitle' => __('Paste your CSS code here.', 'redux-framework-demo'),
				'mode'     => 'css',
				'theme'    => 'monokai',
			),
		)
    )); 

    /*
     * <--- END SECTIONS
     */
