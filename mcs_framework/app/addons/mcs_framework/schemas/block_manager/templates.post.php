<?php


$schema['addons/mcs_framework/blocks/categories/mcs_i_menu.tpl'] = array (
	'settings' => array (
		'dropdown_second_level_elements' => array (
			'type' => 'input',
			'default_value' => '12'
		),
		'dropdown_third_level_elements' => array (
			'type' => 'input',
			'default_value' => '6'
		),
		'mcs_top_menu_hide_third_level'=> array(
			'type'=>'checkbox',
			'default_value'=>'N'
		),
		'mcs_top_menu_show_images'=> array(
			'type'=>'checkbox',
			'default_value'=>'N'
		),
		'mcs_top_menu_category_image_width' => array (
			'type' => 'input',
			'default_value' => '120'
		),
		'mcs_top_menu_category_image_height' => array (
			'type' => 'input',
			'default_value' => '80'
		),
		'mcs_top_menu_responsive'=> array(
			'type'=>'checkbox',
			'default_value'=>'N'
		),
	),
	'fillings' => array('full_tree_cat', 'dynamic_tree_cat'),
	'params' => array (
		'plain' => false,
		'group_by_level' => true,
		'request' => array (
			'active_category_id' => '%CATEGORY_ID%',
		),
	)
);
$settings=array(
	'show_price' => array (
		'type' => 'checkbox',
		'default_value' => 'Y'
	),
	'hide_features' => array (
		'type' => 'checkbox',
		'default_value' => 'Y'
	),
	'hide_rating' => array (
		'type' => 'checkbox',
		'default_value' => 'Y'
	),
	'hide_points' => array (
		'type' => 'checkbox',
		'default_value' => 'Y'
	),
	'hide_add_to_wish' => array (
		'type' => 'checkbox',
		'default_value' => 'Y'
	),
	'hide_add_to_compare' => array (
		'type' => 'checkbox',
		'default_value' => 'Y'
	),
	'enable_quick_view' => array (
		'type' => 'checkbox',
		'default_value' => 'N'
	),
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
$schema['addons/mcs_framework/blocks/products/mcs_i_scroller.tpl'] = array (
	'settings'=>$settings,
	'bulk_modifier' => array (
		'fn_gather_additional_products_data' => array (
			'products' => '#this',
			'params' => array (
				'get_icon' => true,
				'get_detailed' => true,
				'get_options' => true,
			),
		),
	),
);
return $schema;