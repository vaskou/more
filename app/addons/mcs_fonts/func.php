<?php

use Tygh\Registry;
use Tygh\Less;
use Tygh\Storage;
use Tygh\BlockManager\Layout;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_get_current_preset()
{	
	/*fn_get_presets($_REQUEST);*/
	
	$view = Registry::get('view');
	$current_preset = db_get_row('SELECT preset_id, name, data, is_default, theme FROM ?:theme_presets WHERE preset_id = ?i', Registry::get('runtime.layout.preset_id'));
	if (empty($current_preset['data'])) {
        $current_preset['data'] = array();
    } else {
        $current_preset['data'] = unserialize($current_preset['data']);
    }
	$view->assign('current_preset', $current_preset);
	 
}

function fn_get_presets($params, $lang_code = CART_LANGUAGE)
{
    $view = Registry::get('view');

    $view->assign('cse_logo_types', fn_get_logo_types());
    $view->assign('cse_logos', fn_get_logos(Registry::get('runtime.company_id')));

    $theme_name = Registry::get('runtime.layout.theme_name');

    if (!Registry::get('runtime.layout.preset_id')) {
        $default_preset_id = db_get_field('SELECT preset_id FROM ?:theme_presets WHERE is_default = 1 AND theme = ?s LIMIT 1', $theme_name);
        db_query('UPDATE ?:bm_layouts SET preset_id = ?i WHERE layout_id = ?i', $default_preset_id, Registry::get('runtime.layout.layout_id'));
        Registry::set('runtime.layout.preset_id', $default_preset_id);
    }

    // get current preset
    $current_preset = db_get_row('SELECT preset_id, name, data, is_default, theme FROM ?:theme_presets WHERE preset_id = ?i', Registry::get('runtime.layout.preset_id'));

    // get all presets
    $presets_list = db_get_array('SELECT preset_id, name, is_default FROM ?:theme_presets WHERE theme = ?s ORDER BY is_base DESC, is_default DESC, name ASC', $theme_name);

    // get uploaded images
    $images = Storage::instance('theme_media')->getList('images/custom');

    if (empty($current_preset['data'])) {
        $current_preset['data'] = array();
    } else {
        $current_preset['data'] = unserialize($current_preset['data']);
    }

    $path = fn_get_theme_path('[themes]/[theme]/presets/', 'C', Registry::get('runtime.company_id'));
    if (file_exists($path . 'schema.json')) {
        $schema = file_get_contents($path . 'schema.json');
        $schema = json_decode($schema);
        $schema = fn_object_to_array($schema);

    } else {
        $schema = array();
    }

    $sections = array(
        'te_general' => 'theme_editor.general',
        'te_logos' => 'theme_editor.logos',
        'te_colors' => 'theme_editor.colors',
        'te_fonts' => 'theme_editor.fonts',
        'te_backgrounds' => 'theme_editor.backgrounds'
    );

    foreach ($sections as $section_id => $section) {
        if ($section_id == 'te_logos') { // Logos is hardcoded section, no need to define it in schema
            continue;
        }
        $section_id = str_replace('te_', '', $section_id);
        if (!isset($schema[$section_id])) {
            unset($sections['te_' . $section_id]);
        }
    }

    if (empty($params['selected_section']) || !isset($sections[$params['selected_section']])) {
        reset($sections);
        $params['selected_section'] = key($sections);
    }

    $view->assign('selected_section', $params['selected_section']);
    $view->assign('te_sections', $sections);
    $view->assign('props_schema', $schema);
    $view->assign('current_preset', $current_preset);
    $view->assign('presets_list', $presets_list);
}


?>