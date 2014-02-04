<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/
$settings=array(
/*********************GENERAL*******************************/
	'mcs_generalSeparator'=>array(
	),
	'mcs_mode' => array (
		'type' => 'selectbox',
		'values' => array (
			'horizontal' => 'Horizontal',
			'vertical' => 'Vertical',
			'fade' => 'Fade',
		),
		'default_value' => 'horizontal',
		'tooltip'=>'Type of transition between slides'
	),
	'mcs_speed' => array (
		'type' => 'input',
		'default_value' => 500,
		'tooltip'=>'Slide transition duration (in ms)'
	),
	'mcs_slideMargin'=>array(
		'type'=>'input',
		'default_value'=>0,
		'tooltip'=>'Margin between each slide'
	),
	'mcs_startSlide'=>array(
		'type'=>'input',
		'default_value'=>0,
		'tooltip'=>'Starting slide index'
	),
	'mcs_randomStart'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Start slider on a random slide'
	),
	'mcs_infiniteLoop'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'true',
		'tooltip'=>'Clicking "Next" while on the last slide will transition to the first slide and vice-versa'
	),
	'mcs_hideControlOnEnd'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'"Next" control will be hidden on last slide and vice-versa'
	),
	/*'mcs_useCSS'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'CSS Transitions',
			'false'=>'JS Transitions'
		),
		'default_value'=>'true'
	),*/
	'mcs_easing'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'linear'=>'Linear',
			'ease'=>'Ease',
			'ease-in'=>'Ease-In',
			'ease-out'=>'Ease-Out',
			'ease-in-out'=>'Ease-In-Out',
			
			'swing'=>'swing',
			'easeInQuad'=>'easeInQuad',
			'easeOutQuad'=>'easeOutQuad',
			'easeInOutQuad'=>'easeInOutQuad',
			'easeInCubic'=>'easeInCubic',
			'easeOutCubic'=>'easeOutCubic',
			'easeInOutCubic'=>'easeInOutCubic',
			'easeInQuart'=>'easeInQuart',
			'easeOutQuart'=>'easeOutQuart',
			'easeInOutQuart'=>'easeInOutQuart',
			'easeInQuint'=>'easeInQuint',
			'easeOutQuint'=>'easeOutQuint',
			'easeInOutQuint'=>'easeInOutQuint',
			'easeInSine'=>'easeInSine',
			'easeOutSine'=>'easeOutSine',
			'easeInOutSine'=>'easeInOutSine',
			'easeInExpo'=>'easeInExpo',
			'easeOutExpo'=>'easeOutExpo',
			'easeInOutExpo'=>'easeInOutExpo',
			'easeInCirc'=>'easeInCirc',
			'easeOutCirc'=>'easeOutCirc',
			'easeInOutCirc'=>'easeInOutCirc',
			'easeInElastic'=>'easeInElastic',
			'easeOutElastic'=>'easeOutElastic',
			'easeInOutElastic'=>'easeInOutElastic',
			'easeInBack'=>'easeInBack',
			'easeOutBack'=>'easeOutBack',
			'easeInOutBack'=>'easeInOutBack',
			'easeInBounce'=>'easeInBounce',
			'easeOutBounce'=>'easeOutBounce',
			'easeInOutBounce'=>'easeInOutBounce'						
		),
		'default_value'=>'linear',
		'tooltip'=>'Select easing'	
	),
	'mcs_captions'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Include image captions'
	),
	'mcs_ticker'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Use slider in ticker mode'
	),
	'mcs_tickerHover'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Ticker will pause when mouse hovers over slider'
	),
	'mcs_adaptiveHeight'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Dynamically adjust slider height based on each slide\'s height'
	),
	'mcs_adaptiveHeightSpeed'=>array(
		'type'=>'input',
		'default_value'=>500,
		'tooltip'=>'Slide height transition duration (in ms)'
	),
	'mcs_video'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'If any slides contain video, set this to true'
	),
	'mcs_responsive'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'true',
		'tooltip'=>'Enable or disable auto resize of the slider'
	),
	'mcs_preloadImages'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'all'=>'All',
			'visible'=>'Visible'
		),
		'default_value'=>'visible',
		'tooltip'=>'If "All", preloads all images before starting the slider. If "Visible", preloads only images in the initially visible slides before starting the slider'
	),
	'mcs_touchEnabled'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'true',
		'tooltip'=>'Slider will allow touch swipe transitions'
	),
	'mcs_swipeThreshold'=>array(
		'type'=>'input',
		'default_value'=>50,
		'tooltip'=>'Amount of pixels a touch swipe needs to exceed in order to execute a slide transition'
	),
	'mcs_oneToOneTouch'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'true',
		'tooltip'=>'Non-fade slides follow the finger as it swipes'
	),
	'mcs_preventDefaultSwipeX'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'true',
		'tooltip'=>'Touch screen will not move along the x-axis as the finger swipes'
	),
	'mcs_preventDefaultSwipeY'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Touch screen will not move along the y-axis as the finger swipes'
	),
	
/***********************PAGER*************************************/				

	'mcs_pagerSeparator'=>array(
	),				
	'mcs_pager'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'true',
		'tooltip'=>'A pager will be added'
	),
	'mcs_pagerType'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'full'=>'Full',
			'short'=>'Short'
		),
		'default_value'=>'full',
		'tooltip'=>'If "Full", a pager link will be generated for each slide. If "Short", a x/y pager will be used'
	),
	'mcs_pagerShortSeparator'=>array(
		'type'=>'input',
		'default_value'=>'/',
		'tooltip'=>'If pager type is "Short", pager will use this value as the separating character'
	),
	'mcs_pagerThumbs'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Enable to show thumbs pager'
	),
	
/**********************CONTROLS********************************/
	'mcs_controlsSeparator'=>array(
	),				
	'mcs_controls'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'true',
		'tooltip'=>'"Next" / "Prev" controls will be added'
	),
	'mcs_customControls'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Enable to show custom controls'
	),
	'mcs_nextText'=>array(
		'type'=>'input',
		'default_value'=>'Next',
		'tooltip'=>'Next control text'
	),
	'mcs_prevText'=>array(
		'type'=>'input',
		'default_value'=>'Previous',
		'tooltip'=>'Previous control text'
	),
	'mcs_autoControls'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'"Start" / "Stop" controls will be added'
	),
	'mcs_autoControlsCombine'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'When slideshow is playing only "Stop" control is displayed and vice-versa'
	),
	'mcs_customAutoControls'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Enable to show custom auto controls'
	),
	'mcs_startText'=>array(
		'type'=>'input',
		'default_value'=>'Start',
		'tooltip'=>'Start control text'
	),
	'mcs_stopText'=>array(
		'type'=>'input',
		'default_value'=>'Stop',
		'tooltip'=>'Stop control text'
	),
	
/***********************AUTO********************************/
	'mcs_autoSeparator'=>array(
	),
	'mcs_auto'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Slides will automatically transition'
	),
	'mcs_pause'=>array(
		'type'=>'input',
		'default_value'=>4000,
		'tooltip'=>'The amount of time (in ms) between each auto transition'
	),
	'mcs_autoStart'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'true',
		'tooltip'=>'Auto show starts playing on load. If disabled, slideshow will start when the "Start" control is clicked'
	),
	'mcs_autoDirection'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'next'=>'Next',
			'prev'=>'Previous'
		),
		'default_value'=>'next',
		'tooltip'=>'The direction of auto show slide transitions'
	),
	'mcs_autoHover'=>array(
		'type'=>'selectbox',
		'values'=>array(
			'true'=>'Enabled',
			'false'=>'Disabled'
		),
		'default_value'=>'false',
		'tooltip'=>'Auto show will pause when mouse hovers over slider'
	),
	'mcs_autoDelay'=>array(
		'type'=>'input',
		'default_value'=>0,
		'tooltip'=>'Time (in ms) auto show should wait before starting'
	),

/**********************CAROUSEL***************************************/
	'mcs_carouselSeparator'=>array(
	),
	'mcs_minSlides'=>array(
		'type'=>'input',
		'default_value'=>1,
		'tooltip'=>'The minimum number of slides to be shown. Slides will be sized down if carousel becomes smaller than the original size'
	),
	'mcs_maxSlides'=>array(
		'type'=>'input',
		'default_value'=>1,
		'tooltip'=>'The maximum number of slides to be shown. Slides will be sized up if carousel becomes larger than the original size'
	),
	'mcs_moveSlides'=>array(
		'type'=>'input',
		'default_value'=>0,
		'tooltip'=>'The number of slides to move on transition. This value must be greater than minSlides, and less maxSlides. If zero (default), the number of fully-visible slides will be used'
	),
	'mcs_slideWidth'=>array(
		'type'=>'input',
		'default_value'=>0,
		'tooltip'=>'The width of each slide. This setting is required for all horizontal carousels'
	),
);

$schema['mcs_brand_scroller'] = array (
	'content' => array (
		'items' => array (
			'remove_indent' => true,
			'hide_label' => true,
			'type' => 'enum',
			'object' => 'brands',
			'items_function' => 'fn_get_selected_brands',
			'fillings' => array (
				'manually' => array (
					'picker' => 'addons/mcs_framework/pickers/brands/picker.tpl',
					'picker_params' => array (
						'type' => 'links',
					),
				),
			),
		),
	),
	'settings'=>array(
		'mcs_brand_scroller_button'=>array(
			'type'=>'checkbox',
			'default_value'=>'Y'
		),
		'mcs_brand_scroller_button_icon'=>array(
			'type'=>'input',
			'default_value'=>'icon-arrow-right6'
		)		
	),
    'templates' => array (
		'addons/mcs_framework/blocks/mcs_brand_scroller.tpl' => array(
			'settings'=>array(
				'mcs_mode' => array (
					'type' => 'selectbox',
					'values' => array (
						'horizontal' => 'Horizontal',
						'vertical' => 'Vertical',
						'fade' => 'Fade',
					),
					'default_value' => 'horizontal',
					'tooltip'=>'Type of transition between slides'
				),
				'mcs_speed' => array (
					'type' => 'input',
					'default_value' => 500,
					'tooltip'=>'Slide transition duration (in ms)'
				),
				'mcs_slideMargin'=>array(
					'type'=>'input',
					'default_value'=>0,
					'tooltip'=>'Margin between each slide'
				),
				'mcs_infiniteLoop'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'true',
					'tooltip'=>'Clicking "Next" while on the last slide will transition to the first slide and vice-versa'
				),
				'mcs_hideControlOnEnd'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'false',
					'tooltip'=>'"Next" control will be hidden on last slide and vice-versa'
				),
				'mcs_easing'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'linear'=>'Linear',
						'ease'=>'Ease',
						'ease-in'=>'Ease-In',
						'ease-out'=>'Ease-Out',
						'ease-in-out'=>'Ease-In-Out',
						
						'swing'=>'swing',
						'easeInQuad'=>'easeInQuad',
						'easeOutQuad'=>'easeOutQuad',
						'easeInOutQuad'=>'easeInOutQuad',
						'easeInCubic'=>'easeInCubic',
						'easeOutCubic'=>'easeOutCubic',
						'easeInOutCubic'=>'easeInOutCubic',
						'easeInQuart'=>'easeInQuart',
						'easeOutQuart'=>'easeOutQuart',
						'easeInOutQuart'=>'easeInOutQuart',
						'easeInQuint'=>'easeInQuint',
						'easeOutQuint'=>'easeOutQuint',
						'easeInOutQuint'=>'easeInOutQuint',
						'easeInSine'=>'easeInSine',
						'easeOutSine'=>'easeOutSine',
						'easeInOutSine'=>'easeInOutSine',
						'easeInExpo'=>'easeInExpo',
						'easeOutExpo'=>'easeOutExpo',
						'easeInOutExpo'=>'easeInOutExpo',
						'easeInCirc'=>'easeInCirc',
						'easeOutCirc'=>'easeOutCirc',
						'easeInOutCirc'=>'easeInOutCirc',
						'easeInElastic'=>'easeInElastic',
						'easeOutElastic'=>'easeOutElastic',
						'easeInOutElastic'=>'easeInOutElastic',
						'easeInBack'=>'easeInBack',
						'easeOutBack'=>'easeOutBack',
						'easeInOutBack'=>'easeInOutBack',
						'easeInBounce'=>'easeInBounce',
						'easeOutBounce'=>'easeOutBounce',
						'easeInOutBounce'=>'easeInOutBounce'						
					),
					'default_value'=>'linear',
					'tooltip'=>'Select easing'	
				),
				'mcs_ticker'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'false',
					'tooltip'=>'Use slider in ticker mode'
				),
				'mcs_tickerHover'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'false',
					'tooltip'=>'Ticker will pause when mouse hovers over slider'
				),
				'mcs_responsive'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'true',
					'tooltip'=>'Enable or disable auto resize of the slider'
				),				
				'mcs_pager'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'true',
					'tooltip'=>'A pager will be added'
				),				
				'mcs_controls'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'true',
					'tooltip'=>'"Next" / "Prev" controls will be added'
				),
				'mcs_customControls'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'false',
					'tooltip'=>'Enable to show custom controls'
				),
				'mcs_nextText'=>array(
					'type'=>'input',
					'default_value'=>'Next',
					'tooltip'=>'Next control text'
				),
				'mcs_prevText'=>array(
					'type'=>'input',
					'default_value'=>'Previous',
					'tooltip'=>'Previous control text'
				),
				'mcs_auto'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'false',
					'tooltip'=>'Slides will automatically transition'
				),
				'mcs_pause'=>array(
					'type'=>'input',
					'default_value'=>4000,
					'tooltip'=>'The amount of time (in ms) between each auto transition'
				),
				'mcs_autoStart'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'true',
					'tooltip'=>'Auto show starts playing on load. If disabled, slideshow will start when the "Start" control is clicked'
				),
				'mcs_autoDirection'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'next'=>'Next',
						'prev'=>'Previous'
					),
					'default_value'=>'next',
					'tooltip'=>'The direction of auto show slide transitions'
				),
				'mcs_autoHover'=>array(
					'type'=>'selectbox',
					'values'=>array(
						'true'=>'Enabled',
						'false'=>'Disabled'
					),
					'default_value'=>'false',
					'tooltip'=>'Auto show will pause when mouse hovers over slider'
				),
				'mcs_autoDelay'=>array(
					'type'=>'input',
					'default_value'=>0,
					'tooltip'=>'Time (in ms) auto show should wait before starting'
				),
				'mcs_minSlides'=>array(
					'type'=>'input',
					'default_value'=>1,
					'tooltip'=>'The minimum number of slides to be shown. Slides will be sized down if carousel becomes smaller than the original size'
				),
				'mcs_maxSlides'=>array(
					'type'=>'input',
					'default_value'=>1,
					'tooltip'=>'The maximum number of slides to be shown. Slides will be sized up if carousel becomes larger than the original size'
				),
				'mcs_moveSlides'=>array(
					'type'=>'input',
					'default_value'=>0,
					'tooltip'=>'The number of slides to move on transition. This value must be greater than minSlides, and less maxSlides. If zero (default), the number of fully-visible slides will be used'
				),
				'mcs_slideWidth'=>array(
					'type'=>'input',
					'default_value'=>0,
					'tooltip'=>'The width of each slide. This setting is required for all horizontal carousels'
				),
			)
		)
	),
    'wrappers' => 'blocks/wrappers',
);

$schema['banners']['templates']['addons/mcs_framework/blocks/mcs_bxslider.tpl'] = array('settings'=>$settings);


$schema['mcs_social'] = array (
	'content'=>array(
		'mcs_rss'=>array(
			'type'=>'input',
			'default_value'=>'http://news.google.com/?output=rss',
			'tooltip'=>'Enter your rss feed url here. Leave blank to disable.'
		),
		'mcs_twitter'=>array(
			'type'=>'input',
			'default_value'=>'http://www.twitter.com',
			'tooltip'=>'Enter your Twitter URL here. Leave blank to disable.'
		),
		'mcs_facebook'=>array(
			'type'=>'input',
			'default_value'=>'http://www.facebook.com',
			'tooltip'=>'Enter your Facebook Profile URL here. Leave blank to disable.'
		),
		'mcs_googleplus'=>array(
			'type'=>'input',
			'default_value'=>'https://plus.google.com',
			'tooltip'=>'Enter your Google+ Profile URL here. Leave blank to disable.'
		),
		'mcs_linkedin'=>array(
			'type'=>'input',
			'default_value'=>'http://www.linkedin.com/',
			'tooltip'=>'Enter your LinkedIn Profile URL here. Leave blank to disable.'
		),
		'mcs_dribbble'=>array(
			'type'=>'input',
			'default_value'=>'http://dribbble.com/',
			'tooltip'=>'Enter your Dribbble Profile URL here. Leave blank to disable.'
		),
		'mcs_tumblr'=>array(
			'type'=>'input',
			'default_value'=>'https://www.tumblr.com/',
			'tooltip'=>'Enter your Tumblr Profile URL here. Leave blank to disable.'
		),
		'mcs_instagram'=>array(
			'type'=>'input',
			'default_value'=>'http://instagram.com/',
			'tooltip'=>'Enter your Instagram Profile URL here. Leave blank to disable.'
		),
		'mcs_youtube'=>array(
			'type'=>'input',
			'default_value'=>'http://www.youtube.com/',
			'tooltip'=>'Enter your YouTube Profile URL here. Leave blank to disable.'
		),
		'mcs_pinterest'=>array(
			'type'=>'input',
			'default_value'=>'https://pinterest.com/',
			'tooltip'=>'Enter your Pinterest Profile URL here. Leave blank to disable.'
		),
		'mcs_email'=>array(
			'type'=>'input',
			'default_value'=>'info@example.com',
			'tooltip'=>'Enter your email address here. Leave blank to disable.'
		),
	),
    'templates' => array (
		'addons/mcs_framework/blocks/mcs_social_links.tpl' => array(
        	'settings' => array (
				'mcs_social_icons_alignment' => array (
					'type' => 'selectbox',
                    'values' => array (
                        'center' => 'Center',
                        'left' => 'Left',
                        'right' => 'Right',
						'vertical'=>'Vertical'
                    ),
                    'default_value' => 'center',
					'tooltip'=>'Select the preferred alignment of the icons'
                ),
                'mcs_social_icons_size' => array (
                    'type' => 'selectbox',
					'values'=>array(
						'icon-default'=>'Default size',
						'icon-large'=>'Large size',
						'icon-2x'=>'2x size',
						'icon-3x'=>'3x size',
						'icon-4x'=>'4x size'
					),
                    'default_value' =>'icon-default',
					'tooltip'=>'Select the preferred size of the icons'
                ),
				'mcs_social_icons_border'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option to enable a discrete border around the icons'
				),
				'mcs_social_icons_shadow'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option to enable a discrete shadow around the icons'
				),
				'mcs_social_icons_circle'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option for rounded icons'
				),
				'mcs_social_icons_color'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option for colored icons'
				),
				'mcs_social_icons_white'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option for dark background. Will be ignored if Enable color has been checked'
				)
			),
        ),
	),
    'wrappers' => 'blocks/wrappers',
);

return $schema;
