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
		'default_value'=>'',
		'tooltip'=>'Next control text'
	),
	'mcs_prevText'=>array(
		'type'=>'input',
		'default_value'=>'',
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

/******************************** Brand Scroller ***************************************/
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
				'random' => array (
                    'params' => array (
                        'has_limit' => true,
                    )
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

/******************************** Banners ***************************************/
$schema['banners']['templates']['addons/mcs_framework/blocks/mcs_bxslider.tpl'] = array('settings'=>$settings);

/******************************** Social Icons ***************************************/
$schema['mcs_social'] = array (
	'content'=>array(
		'social_icons' => array (
			'type' => 'simple_text',
			'tooltip' => 'Enter [icon name,URL,label] separated with comma and 1 per line.'
		),
	),
    'templates' => array (
		'addons/mcs_framework/blocks/mcs_social_icons.tpl' => array(
        	'settings' => array (
				'text_pre'=>array(
					'type'=>'text',
					'default_value'=>'',
					'tooltip'=>'HTML before social icons.'
				),
				'text_post'=>array(
					'type'=>'text',
					'default_value'=>'',
					'tooltip'=>'HTML after social icons.'
				),
				'shape' => array (
                    'type' => 'selectbox',
                    'values' => array (
                        'square' => 'square',
                        'rounded' => 'rounded'
                    ),
                    'tooltip' => 'Select square or rounded icons.',
                    'default_value' => 'square'
                ),
				'rotate' => array (
                    'type' => 'checkbox',
                    'tooltip' => 'If enabled, a rotate effect will be applied on hover.',
                    'default_value' => 'Y'
                ),
				'tooltip' => array (
                    'type' => 'checkbox',
                    'tooltip' => 'If enabled, a tooltip with the icon label will be shown.',
                    'default_value' => 'Y'
                ),
				'color' => array (
                    'type' => 'selectbox',
                    'values' => array (
                        'color' => 'color',
                        'white' => 'white',
                        'black' => 'black'
                    ),
                    'default_value' => 'color'
                ),
				'colorhover' => array (
                    'type' => 'selectbox',
                    'values' => array (
                        'color' => 'color',
                        'white' => 'white',
                        'black' => 'black'
                    ),
                    'default_value' => 'color'
                ),
				'bg' => array (
                    'type' => 'selectbox',
                    'values' => array (
                        'color' => 'color',
                        'white' => 'white',
                        'black' => 'black',
                        'transparent' => 'transparent'
                    ),
                    'default_value' => 'transparent'
                ),
				'bghover' => array (
                    'type' => 'selectbox',
                    'values' => array (
                        'color' => 'color',
                        'white' => 'white',
                        'black' => 'black',
                        'transparent' => 'transparent'
                    ),
                    'default_value' => 'transparent'
                ),
				'size' => array (
                    'type' => 'input',
                    'default_value' => '64',
                    'tooltip' => 'Enter the icon size in pixels.'
                ),
				'border' => array (
                    'type' => 'input',
                    'default_value' => '0',
                    'tooltip' => 'Enter border size in pixels.'
                ),
				'padding' => array (
                    'type' => 'input',
                    'default_value' => '0',
                    'tooltip' => 'Enter the icon padding in pixels. It should be lower than the icon size.'
                )
			),
        ),
	),
    'wrappers' => 'blocks/wrappers',
);

/******************************** Payment Icons ***************************************/
$schema['mcs_payment_icons'] = array (
	'content'=>array(
		'payment_icons' => array (
			'type' => 'simple_text',
			'default_value' => '',
			'tooltip' => 'Enter the icons names, one per line (2checkout, amazon, americanexpress, chase, cirrus, delta, diners, directdebit, discover, ebay, etsy, eway, googlewallet, jcb, maestro, mastercard, moneybookers, paypal, sage, shopify, skrill, solo, switch, visa, visaelectron, westernunion, worldpay'
		),
	),
    'templates' => array (
        'addons/mcs_framework/blocks/mcs_payment_icons.tpl' => array(
            'settings' => array (
                'text_pre'=>array(
					'type'=>'text',
					'default_value'=>'',
					'tooltip'=>'HTML before payment icons.'
				),
				'text_post'=>array(
					'type'=>'text',
					'default_value'=>'',
					'tooltip'=>'HTML after payment icons.'
				),
				'color' => array (
                    'type' => 'selectbox',
                    'values' => array (
                        'color' => 'Colored',
                        'bw' => 'black_and_white'
                    ),
                    'default_value' => 'color'
                ),
				'hover' => array (
                    'type' => 'selectbox',
                    'values' => array (
					    'color' => 'Colored',
                        'bw' => 'black_and_white',
                        'blur' => 'Blur',
                        'rotate' => 'Rotate'
                    ),
                    'default_value' => 'color'
                ),
				'size' => array (
                    'type' => 'selectbox',
                    'values' => array (
                        '32' => '32x20',
                        '64' => '64x40'
                    ),
                    'default_value' => '64',
                    'tooltip' => 'Select the size in pixels'
                ),
				'alignment' => array (
                    'type' => 'selectbox',
                    'values' => array (
                        'center' => 'center',
                        'left' => 'left',
                        'right' => 'right'
                    ),
                    'default_value' => 'center',
                    'tooltip' => 'Select the icons alignment inside the block'
                )
            ),
        )
    ),
    'wrappers' => 'blocks/wrappers',
);

/******************************** Contact Block ***************************************/
$schema['mcs_contact_block'] = array (
    'templates' => array (
		'addons/mcs_framework/blocks/mcs_contact_block.tpl' => array(
        	'settings' => array (
				'mcs_contact_block_text_pre'=>array(
					'type'=>'text',
					'default_value'=>'',
					'tooltip'=>'HTML before contact information.'
				),
				'mcs_contact_block_text_post'=>array(
					'type'=>'text',
					'default_value'=>'',
					'tooltip'=>'HTML after contact information.'
				),
				'mcs_contact_block_alignment' => array (
					'type' => 'selectbox',
                    'values' => array (
                        'horizontal' => __('horizontal'),
                        'vertical' => __('vertical')
                    ),
                    'default_value' => 'horizontal',
					'tooltip'=>'Select the alignment of block content'
                ),
				'mcs_contact_block_text_alignment' => array (
					'type' => 'selectbox',
                    'values' => array (
                        'left' => __('left'),
                        'center' => 'center',
                        'right' => __('right')
                    ),
                    'default_value' => 'center',
					'tooltip'=>'Select the text alignment of block'
                ),
                'mcs_contact_block_icons_size' => array (
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
				'mcs_contact_block_text_color'=>array(
					'type'=>'input',
					'default_value'=>'#000000',
					'tooltip'=>'Text color or color code.'
				),
				'mcs_contact_block_link_color'=>array(
					'type'=>'input',
					'default_value'=>'#000000',
					'tooltip'=>'Links color or color code.'
				),
				'mcs_contact_block_link_hover_color'=>array(
					'type'=>'input',
					'default_value'=>'#cccccc',
					'tooltip'=>'Links hover color or color code.'
				),
				'mcs_contact_block_copyright'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show copyright sign'
				),
				'mcs_contact_block_start_year'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company start year'
				),
				'mcs_contact_block_name'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company name'
				),
				'mcs_contact_block_address'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company address'
				),
				'mcs_contact_block_address_link'=>array(
					'type'=>'input',
					'default_value'=>'',
					'tooltip'=>'Link to company address map, i.e. a link to a google map'
				),
				'mcs_contact_block_zipcode'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company zipcode'
				),
				'mcs_contact_block_city'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company city'
				),
				'mcs_contact_block_state'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company state'
				),
				'mcs_contact_block_country'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company country'
				),
				'mcs_contact_block_phone'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company phone'
				),
				'mcs_contact_block_phone_2'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company mobile'
				),
				'mcs_contact_block_fax'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company fax'
				),
				'mcs_contact_block_skype'=>array(
					'type'=>'input',
					'default_value'=>'',
					'tooltip'=>'Skype name'
				),
				'mcs_contact_block_website'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company website'
				),
				'mcs_contact_block_users_department'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company users department email'
				),
				'mcs_contact_block_site_administrator'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company administrator email'
				),
				'mcs_contact_block_orders_department'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company orders department email'
				),
				'mcs_contact_block_support_department'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company support department email'
				),
				'mcs_contact_block_newsletter_email'=>array(
					'type'=>'checkbox',
					'default_value'=>'Y',
					'tooltip'=>'Show company newsletter email'
				),
				'mcs_contact_block_form_link'=>array(
					'type'=>'input',
					'default_value'=>'',
					'tooltip'=>'Link to contact form page.'
				)
			),
        ),
	),
    'wrappers' => 'blocks/wrappers',
);

return $schema;
