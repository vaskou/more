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

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == 'product') {

	if (!empty($_REQUEST['product_id'])) {
        $pid = $_REQUEST['product_id'];
        $pdata = fn_sync_product($pid);
        if (!empty($pdata['product_id'])) {
            $pid = $pdata['product_id'];
            fn_set_notification('N', __('notice'), __('text_product_cloned'));
        }

        //return array(CONTROLLER_STATUS_REDIRECT, "products.update?product_id=$pid");
		//print_r($pdata);
    }
}
