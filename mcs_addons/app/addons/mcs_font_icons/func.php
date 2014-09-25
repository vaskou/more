<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_copy_font_files()
{
	$source_path=fn_get_theme_path('[repo]/[theme]/', 'C').'media/fonts';
	$dest_path= fn_get_theme_path('[themes]/[theme]/', 'C') . 'media/fonts';
	fn_copy($source_path, $dest_path);
}