<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

require_once dirname(__FILE__). '/lib/jBBCode/Parser.php';
require_once dirname(__FILE__). '/shortcodes.php';

fn_register_hooks(
    'render_blocks',
	'get_grids_post'
);
