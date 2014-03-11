<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == 'view'&&fn_mcs_shortcodes()) {

	fn_mcs_add_controller_parser();

}