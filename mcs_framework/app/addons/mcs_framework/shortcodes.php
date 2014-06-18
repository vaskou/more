<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function ShortcodesParser(){
	
	$parser = new JBBCode\Parser();
	$parser->addCodeDefinition(new YouTubeSC());
	$parser->addCodeDefinition(new VimeoSC());
	$parser->addCodeDefinition(new GoogleMapSC());
	$parser->addCodeDefinition(new ButtonSC());
	$parser->addCodeDefinition(new LightboxSC());
	$parser->addCodeDefinition(new IconCallToActionSC());
	$parser->addCodeDefinition(new ImageCallToActionSC());
	//$parser->addCodeDefinition(new ContactFormSC());
	//$parser->addCodeDefinition(new LinkSC());
	
	return $parser;
}

/**************************************** YouTube *********************************************************/
class YouTubeSC extends JBBCode\CodeDefinition {

	public function __construct(){
		parent::__construct();
		$this->setTagName("youtube");
		$this->setUseOption(true);
	}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		if(!$options['id'])
			return;
		
		if($options['demo']=='true')
			return $out='[youtube=id=ugVAcQm1BY4&autoplay=0&controls=2&rel=0&showinfo=0][/youtube]';		
		
		$autoplay = ($options['autoplay'] ? $options['autoplay'] : '0');
		$controls = ($options['controls'] ? $options['controls'] : '0');
		$rel = ($options['rel'] ? $options['rel'] : '0');
		$showinfo = ($options['showinfo'] ? $options['showinfo'] : '0');
		
		$out='';
		$out.='<div class="sc video-container youtube '.$options['class'].'">';
		$out.='<iframe src="//www.youtube.com/embed/'.$options['id'].'?autoplay='.$autoplay.'&controls='.$controls.'&rel='.$rel.'&showinfo='.$showinfo.'" frameborder="0" allowfullscreen></iframe>';
		$out.='</div>';

		return $out;
	}
 
}

/**************************************** Vimeo *********************************************************/
class VimeoSC extends JBBCode\CodeDefinition {

	public function __construct(){
		parent::__construct();
		$this->setTagName("vimeo");
		$this->setUseOption(true);
	}
 
	public function asHtml(JBBCode\ElementNode $el){	
		
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		if(!$options['id'])
			return;
		
		if($options['demo']=='true')
			return $out='[vimeo=id=20563051&autoplay=0&title=0&byline=0&portrait=0&loop=1&color=ffffff][/vimeo]';
			
		$portrait = ($options['portrait'] ? $options['portrait'] : '0');
		$byline = ($options['byline'] ? $options['byline'] : '0');
		$title = ($options['title'] ? $options['title'] : '0');
		$autoplay = ($options['autoplay'] ? $options['autoplay'] : '0');
		$loop = ($options['loop'] ? $options['loop'] : '0');
		$color = ($options['color'] ? $options['color'] : '00adef');

		
		$out='';
		$out.='<div class="sc video-container vimeo '.$options['class'].'">';
		$out.='<iframe src="//player.vimeo.com/video/'.$options['id'].'?portrait='.$portrait.'&byline='.$byline.'&title='.$title.'&autoplay='.$autoplay.'&loop='.$loop.'&color='.$color.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		$out.='</div>';
	
		return $out;
	}
 
}

/**************************************** GoogleMaps *********************************************************/
class GoogleMapSC extends JBBCode\CodeDefinition {

	public function __construct(){
		parent::__construct();
		$this->setTagName("googlemap");
		$this->setUseOption(true);
	}
	
	public function asHtml(JBBCode\ElementNode $el){	
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		if(!$options['lat']||!$options['lng'])
			return;
		
		if($options['demo']=='true')
			return $out='[googlemap=lat=40.7124618&lng=-74.0081018&zoom=15&type=TERRAIN&height=400&title=Google Map Shortcode&infowindow=Google Map shortcode by More CS-Cart Themes][/googlemap]';

		$zoom='15';
		if($options['zoom'])
			$zoom=$options['zoom'];
		
		$type='ROADMAP';
		if($options['type'])
			$type=$options['type'];

		$height='300';
		if($options['height'])
			$height=$options['height'];
			
		$unique = uniqid();
		$out  = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';
		$out .=	'<script>';
		$out .=	'	var latlng=new google.maps.LatLng('.$options['lat'].','.$options['lng'].');';
		$out .=	'	function initialize(){';
		$out .=	'		var mapProp = {';
		$out .=	'			center:latlng,';
		$out .=	'			zoom:'.$zoom.',';
		$out .=	'			zoomControl:true,';
		$out .=	'			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},';
		$out .=	'			navigationControl: true,';
		$out .=	'			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},';
		$out .=	'			panControl:true,';
		$out .=	'			mapTypeId:google.maps.MapTypeId.'.$type;
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
		$out .=	'<div id="google_map_sc_'.$unique.'" class="google-map '.$options['class'].'" style="width:100%;height:'.$height.'px;"></div>';

		return $out;
	}
}

/**************************************** Button *********************************************************/

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
		
		if($options['demo']=='true')
			return $out='[button=link='.$options['link'].'&amp;icon='.$options['icon'].'&amp;color='.$options['color'].'&amp;size='.$options['size'].']'.$content.'[/button]';

		$link=$options['link'];
		if(!$link)
			return;
		
		$background_color='';
		if($options['color']!='')
			$background_color='style="background-color:#'.$options['color'].'"';			
		
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
		if(!$content)
			$icon='<i class="icon-'.$options['icon'].'" style="margin-right: 0;"></i>';	
		
		$out='';
		$out.=	'<a href="'.$link.'" class="sc rotate css3-transition-all button '.$options['class'].' '.$display_block.' '.$options['size'].' '.$text_align.'" '.$background_color.'>';		
		$out.=	'<span>';
		$out.=	$icon;
		$out.=	$content;
		$out.=	'</span>';
		$out.=	'</a>';
		
		return $out;
	}
 
}

/**************************************** Icon Call To Action (iconcta) *********************************************************/
class IconCallToActionSC extends JBBCode\CodeDefinition {

	public function __construct(){
		parent::__construct();
		$this->setTagName("iconcta");
		$this->setUseOption(true);
	}
 
	public function asHtml(JBBCode\ElementNode $el){	

		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		foreach($el->getChildren() as $child)
            $content .= $child->getAsBBCode();
			
		if($options['demo']=='true')
			return $out='[iconcta=icon=popout&float=center&link=http://morecscart.com/&title=Title&iconsize=5&theme=dark]Call To Action Text[/iconcta]';
		
		$theme='light';
		if($options['theme']=='dark')
			$theme='dark';

		$link=$options['link'];
		$title=$options['title'];
		$text=$options['text'];
		$icon=$options['icon'];
		$iconsize=($options['iconsize'])?$options['iconsize']:'5';
		$border=($options['border'])?'border':'';
		
		$button_float=$options['float'];
		
		$text_align=($options['float']=='left')?'right':'left';
		if($options['float']=='center'||!$options['float'])
			$text_align='center';

		$out ='';
		$out .=	'<div class="sc cta icon rotate css3-transition-all '.$options['class'].' '.$theme.' '.$border.'">';
		$out .=	'<div class="inner" style="text-align:'.$text_align.'">';

		if($link!='') $out .=	'<a class="button" href="'.$link.'" style="float:'.$button_float.'">';
		if($icon!='') $out .=	'<i class="icon-'.$icon.'" style="font-size:'.$iconsize.'em"></i>';
		if($link!='') $out .=	'</a>';
		
		$out .=	'<div class="text">';
		
		if($link!='') $out .='<a href="'.$link.'">';
		
		$out .=	'<h3 style="text-align:'.$text_align.'">'.$title.'</h3>';
		
		if($link!='') $out .='</a>';
			
		$out .=	'<p style="text-align:'.$text_align.'">'.$content.'</p>';
		$out .=	'</div>';

		$out .=	'</div>';
		$out .=	'</div>';

		return $out;
	}
}

/**************************************** Image Call To Action (imagecta) ************************************/
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
		foreach($el->getChildren() as $child)
            $content .= $child->getAsBBCode();

		if($options['demo']=='true')
			return $out='[imagecta=src=http://morecscart.com/images/companies/1/imagecta.jpg&link=http://morecscart.com]My Text goes here[/imagecta]';

		if(!$options['src']||$options['src']=='')
			return;

			$effect='scale';
		if($options['effect']!='')
			$effect=$options['effect'];		
		

		if($options['opacity']&&$options['opacity']!='')
			$opacity='style="opacity:'.$options['opacity'].';filter:alpha(opacity='.(intval($options['opacity'])*100).');"';
			
		if($options['maxwidth'])
			$maxwidth='style="max-width:'.$options['maxwidth'].'px"';

		$out='';
		
		$out .=	'<div class="sc cta image '.$options['class'].' '.$effect.'" '.$maxwidth.'>';
			
		if($options['link']!='')
			$out .=	'<a href="'.$options['link'].'">';
			
			$out .=	'<img src="'.$options['src'].'" alt="'.$content.'" title="'.$content.'">';
			
		if($content!=''){
			$out .=	'<div class="description" '.$opacity.'>';
			$out .=	'<p class="description_content">'.$content.'</p>';
			$out .=	'</div>';
		}
			
		if($options['link']!='')
			$out .=	'</a>';			
				
		$out .=	'</div>';
		
		$out .=	'<div style="clear:both"></div>';
		return $out;
	}
 
}

/**************************************** Lightbox Call To Action (lightbox) ************************************/
class LightboxSC extends JBBCode\CodeDefinition {

	public function __construct()
	{
		parent::__construct();
		$this->setTagName("lightbox");
		$this->setUseOption(true);
		}
 
	public function asHtml(JBBCode\ElementNode $el)
	{	
		//http://designshack.net/articles/css/joshuajohnson-2/
		parse_str(str_replace('amp;','&',$el->getAttribute()), $options);
		
		foreach($el->getChildren() as $child)
            $content .= $child->getAsBBCode();

		if($options['demo']=='true')
			return $out='[lightbox=src=http://morecscart.com/images/companies/1/imagecta.jpg&link=http://morecscart.com/?iframe=true&title=My lightbox title]My Text goes here[/lightbox]';

		if(!$options['src']||$options['src']==''||!$options['link']||$options['link']=='')
			return;

			
		$effect='scale';
		if($options['effect']!='')
			$effect=$options['effect'];		
	
		if($options['opacity']&&$options['opacity']!='')
			$opacity='style="opacity:'.$options['opacity'].';filter:alpha(opacity='.(intval($options['opacity'])*100).');"';
			
		if($options['maxwidth'])
			$maxwidth='style="max-width:'.$options['maxwidth'].'px"';

		
		$unique = uniqid();
		
		$out='';
		
		$out .=	'<div class="sc cta image '.$options['class'].' '.$effect.'" '.$maxwidth.'>';
		
		$out.='<script type="text/javascript" src="js/tygh/previewers/prettyphoto.previewer.js"></script>';

		$out .=	'<a id="'.$unique.'" data-ca-image-id="'.$unique.'" href="'.$options['link'].'" class="cm-image-previewer cm-previewer previewer">';
			
			$out .=	'<img src="'.$options['src'].'" alt="'.$options['title'].'" title="'.$options['title'].'">';
			
		if($content!=''){
			$out .=	'<div class="description" '.$opacity.'>';
			$out .=	'<p class="description_content">'.$content.'</p>';
			$out .=	'</div>';
		}
			
		$out .=	'</a>';			
				
		$out .=	'</div>';
		
		$out .=	'<div style="clear:both"></div>';
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
