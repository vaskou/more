<?php
use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function ShortcodesParser(){
	
	$parser = new JBBCode\Parser();
	$parser->addCodeDefinition(new YouTubeSC());
	$parser->addCodeDefinition(new VimeoSC());
	$parser->addCodeDefinition(new GoogleMapSC());
	$parser->addCodeDefinition(new CallToActionSC());
	$parser->addCodeDefinition(new ButtonSC());
	$parser->addCodeDefinition(new LightboxSC());
	$parser->addCodeDefinition(new LinkSC());
	$parser->addCodeDefinition(new IconCallToActionSC());
	$parser->addCodeDefinition(new ImageCallToActionSC());
	$parser->addCodeDefinition(new ContactFormSC());
	
	return $parser;
}

/**************************************** YouTube *********************************************************/

class YouTubeSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("youtube");
		$this->setUseOption(true);
	}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		$out='';
		$out.='<div class="sc video-container youtube">';
		$out.='<iframe src="//www.youtube.com/embed/'.$options['id'].'?autoplay='.$options['autoplay'].'&controls='.$options['controls'].'&rel='.$options['rel'].'&showinfo='.$options['showinfo'].'" frameborder="0" allowfullscreen></iframe>';
		$out.='</div>';
		
		return $out;
	}
 
}

/**************************************** Vimeo *********************************************************/
class VimeoSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("vimeo");
		$this->setUseOption(true);
	}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		$out='';
		$out.='<div class="sc video-container vimeo">';
		$out.='<iframe src="//player.vimeo.com/video/'.$options['id'].'?portrait='.$options['portrait'].'&byline='.$options['title'].'&title='.$options['title'].'&autoplay='.$options['autoplay'].'&loop='.$options['loop'].'&color='.$options['color'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		$out.='</div>';
		
		return $out;
	}
 
}

/**************************************** GoogleMaps *********************************************************/
class GoogleMapSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("googlemap");
		$this->setUseOption(true);
	
	}

	public function asHtml(JBBCode\ElementNode $el)
	{	
	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
			$unique = uniqid();
			$out  = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';
			$out .=	'<script>';
			$out .=	'	var latlng=new google.maps.LatLng('.$options['lat'].','.$options['lng'].');';
			$out .=	'	function initialize(){';
			$out .=	'		var mapProp = {';
			$out .=	'			center:latlng,';
			$out .=	'			zoom:'.$options['zoom'].',';
			$out .=	'			zoomControl:true,';
			$out .=	'			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},';
			$out .=	'			navigationControl: true,';
			$out .=	'			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},';
			$out .=	'			panControl:true,';
			$out .=	'			mapTypeId:google.maps.MapTypeId.'.$options['type'];
			$out .=	'	};';
			$out .=	'	var map=new google.maps.Map(document.getElementById("google_map_sc_'.$unique.'"),mapProp);';
			$out .=	'	var marker=new google.maps.Marker({';
			$out .=	'		position:latlng,';
			$out .=	'		map: map,';
			$out .=	'		title: "'.$options['title'].'"';
			$out .=	'	});';
			$out .=	'	marker.setMap(map);';
			$out .=	'	var infowindow = new google.maps.InfoWindow({';
			$out .=	'		content:"'.$options['infowindow'].'"';
			$out .=	'	});';
			$out .=	'	google.maps.event.addListener(marker, "click", function() {';
			$out .=	'		infowindow.open(map,marker);';
			$out .=	'	});';
			$out .=	'	}';
			$out .=	'	google.maps.event.addDomListener(window, "load", initialize);';
			$out .=	'</script>';
			$out .=	'<div id="google_map_sc_'.$unique.'" class="google-map" style="width:100%;height:'.$options['height'].'px;"></div>';
			
			return $out;

			}
 
}

/**************************************** Buttons *********************************************************/

class ButtonSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("button");
		$this->setUseOption(true);
		}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		foreach($el->getChildren() as $child)
            $content .= $child->getAsBBCode();
		
		$link=$options['link'];
		if(!$link||!$content)
			return;
		
		$background_color='';
		if($options['color']!='')
			$background_color='style="background-color:'.$options['color'].'"';			
		
		$display_block='';
		if($options['display']=='block')
			$display_block='display-block';
			
		$text_align='left';
		if($options['align']=='right')
			$text_align='right';
		if($options['align']=='center')
			$text_align='center';
			
		$icon='';
		if($options['icon']!='')
			$icon='<i class="icon-'.$options['icon'].'"></i>';	
		
		$out='';
		$out.=	'<a href="'.$link.'" class="sc rotate css3-transition-all button '.$display_block.' '.$options['size'].' '.$text_align.'" '.$background_color.'>';		
		$out.=	'<span>';
		$out.=	$icon;
		$out.=	$content;
		$out.=	'</span>';
		$out.=	'</a>';
		
		return $out;
	}
 
}

/**************************************** Icon Call To Action *********************************************************/

class IconCallToActionSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("iconcta");
		$this->setUseOption(true);
		}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		$alignment='center';
		if($options['alignment']=='left')
			$alignment='left';
		if($options['alignment']=='right')
			$alignment='right';
		
		$icon_size='5';
		if($options['icon_size']!='')
			$icon_size=$options['icon_size'];
			
			
		$icon='';
		if($options['icon']!='')
			$icon='<i class="icon-'.$options['icon'].' rotate" style="font-size:'.$icon_size.'em;"></i>';

		$title='';
		if($options['title']!='')
			$title='<h3><span>'.$options['title'].'</span></h3>';
		
		$text='';
		if($options['text']!='')
			$text='<p>'.$options['text'].'</p>';

		$link_type='href';
		if($options['link_type']=='mailto')
			$link_type='mailto';
		if($options['link_type']=='tel')
			$link_type='tel';			
		if($options['link_type']=='map')
			$link_type='map';	

			
		$out ='';
		$out .=	'<div class="sc iconcta '.$alignment.' ">';
		
		if($options['link']!=''&&$options['button']=='')
			$out .=	'<a '.$link_type.'="'.$options['link'].'">';
			
			$out .=	$icon;
			$out .=	$title;
			$out .=	$text;
		
		if($options['link']!=''&&$options['button']!='')
			$out .=	'<a '.$link_type.'="'.$options['link'].'">';
			$out .=	$options['button'];
			$out .=	'</a>';

			
		if($options['link']!=''&&$options['button']=='')
			$out .=	'</a>';
			
		$out .=	'</div>';
		
		return $out;
	}
 
}






















/**************************************** cta *********************************************************/
class CallToActionSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("cta");
		$this->setUseOption(true);
		}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		$theme=$options['theme'];
		$link=$options['link'];
		$title=$options['title'];
		$text=$options['text'];
		$buttontitle=$options['buttontitle'];
		$icon=$options['icon'];
		$iconsize=($options['iconsize']!='')?'style="font-size:'.$options['iconsize'].'em"':'';
		
		$button_float=$options['float'];
		$text_align=($options['float']=='left')?'right':'left';
		if($options['float']=='center')
			$text_align='center';
		
		$out ='';
		$out .=	'<div class="sc cta box '.$theme.'">';
		$out .=	'	<div class="inner" style="text-align:'.$text_align.'">';
			if($options['float']!='center'){
				$out .=	'		<a class="button" href="'.$link.'" style="float:'.$button_float.'">';
				$out .=	'			<span>';
				if($icon!='')
					$out .=	'			<i class="icon-'.$icon.'" '.$iconsize.'></i>';
					$out .=				$buttontitle.'</span>';
					$out .=	'		</a>';
			}
		$out .=	'		<div class="text">';
		$out .=	'			<h3 style="text-align:'.$text_align.'"><span>'.$title.'</span></h3>';
		$out .=	'			<p style="text-align:'.$text_align.'">'.$text.'</p>';
		$out .=	'		</div>';
			if($options['float']=='center'){
				$out .=	'		<a class="button" href="'.$link.'" style="float:'.$button_float.'">';
				$out .=	'			<span>';
				if($icon!='')
					$out .=	'			<i class="icon-'.$icon.'" '.$iconsize.'></i>';
					$out .=				$options['buttontitle'].'</span>';
					$out .=	'		</a>';	
			}
		$out .=	'	</div>';
		$out .=	'</div>';
		
		return $out;
	}
 
}


	


class LightboxSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("lightbox");
		$this->setUseOption(true);
		}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		foreach($el->getChildren() as $child)
            $content .= $child->getAsBBCode();
		
		$group='';
		if($options['group']!='')
			$group='['.$options['group'].']';

			

		$unique = uniqid();	
		$out='';
		$out.='<script type="text/javascript" src="js/tygh/previewers/prettyphoto.previewer.js"></script>';
		$out.='<a id="'.$unique.'" data-ca-image-id="'.$unique.'" rel="prettyPhoto[sdfsdfsdf]'.$group.'" href="'.$options['link'].'" class="cm-image-previewer cm-previewer previewer">';
		$out.='<img src="'.$options['thumb'].'" width='.$options['width'].' height='.$options['height'].'>';		
		$out.='</a>';
		return $out;
	}
 
}


class LinkSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("link");
		$this->setUseOption(true);
		}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		$link_href='';
		if($options['href']!='')
			$link_href='href="'.$options['href'].'"';

		$link_type='';
		if($options['type']=='button')
			$link_type='btn';

		$link_size='';
		if($options['size']!='')
			$link_size='btn-'.$options['size'];

			
		$link_block='';
		if($options['block']=='yes')
			$link_block='btn-block';
			
		$link_icon='';
		if($options['icon']!='')
			$link_icon='<i class="icon-'.$options['icon'].'"></i>';		
	
		$out='';
		$out.=	'<a '.$link_href.' class="'.$link_type.' '.$link_size.' '.$link_block.'" >';
		$out.=	$link_icon;
		$out.=	$options['text'];
		$out.=	'</a>';
		
		return $out;
	}
 
}
		
		
	
	
		
class ContactFormSC extends JBBCode\CodeDefinition {
		
	public function __construct()
	{
		parent::__construct();
		$this->setTagName("contactform");
		$this->setUseOption(true);
		}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	

	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);

		$out='';
		$out.=	'<div class="form-wrap form-wrap-default">';
		$out.=	'<form action="http://'.Registry::get('runtime.company_data.storefront').'/index.php" method="post" name="forms_form" enctype="multipart/form-data" class="cm-processed-form">';
		$out.=	'<input type="hidden" name="fake" value="1">';
		$out.=	'<input type="hidden" name="page_id" value="'.$options['page_id'].'">';
		$out.=	'<div class="control-group">';
        $out.=	'<label for="elm_2" class="cm-required cm-email ">'.__('email').'</label>';
		$out.=	'<input type="hidden" name="customer_email" value="2">';
		$out.=	'<input id="elm_2" class="input-text" size="50" type="text" name="form_values[2]" value="">';
		$out.=	'</div>';
        $out.=	'<div class="control-group">';
        $out.=	'<label for="elm_1" class="cm-required ">'.__('name').'</label>';
		$out.=	'<input id="elm_1" class="input-text" size="50" type="text" name="form_values[1]" value="">';
        $out.=	'</div>';
		$out.=	'<div class="control-group">';
		$out.=	'<label for="elm_3" class="cm-required ">'.__('message').'</label>';
		$out.=	'<textarea id="elm_3" class="input-textarea" name="form_values[3]" cols="67" rows="10"></textarea>';
		$out.=	'</div>';

		
		$out.=	'<div class="buttons-container">';
        
 
		$out.=	'<span class="button-submit button-wrap-left"><span class="button-submit button-wrap-right"><input type="submit" name="dispatch[pages.send_form]" value="'.__('submit').'"></span></span>';


		$out.=	'</div>';

		$out.=	'</form>';
		$out.=	'</div>';
		
		return $out;
	}
 
}



	

class ImageCallToActionSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("imagecta");
		$this->setUseOption(true);
		}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
		//http://designshack.net/articles/css/joshuajohnson-2/
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		$effect='grow';
		if($options['effect']!='')
			$effect=$options['effect'];		
			
		$link_type='href';
		if($options['link_type']=='mailto')
			$link_type='mailto';
		if($options['link_type']=='tel')
			$link_type='tel';			
		if($options['link_type']=='map')
			$link_type='map';	
			
		$out='';
		$out .=	'<div class="sc imagecta '.$effect.'">';
		
		if($options['link']!='')
			$out .=	'<a '.$link_type.'="'.$options['link'].'">';
			
			$out .=	'<img src="'.$options['src'].'" alt="">';
		
		if($options['link']!='')
			$out .=	'</a>';		
			
		$out .=	'</div>';
		
		if($options['src']!='')
			return $out;
		else
			return '';
	}
 
}