<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }


fn_register_hooks(
    'render_blocks',
	'get_grids_post',
	'init_templater'
);
