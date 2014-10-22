<?php

use Tygh\Registry;
use Tygh\Storage;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$_SESSION['wishlist'] = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : array();
$wishlist = & $_SESSION['wishlist'];
$_SESSION['continue_url'] = isset($_SESSION['continue_url']) ? $_SESSION['continue_url'] : '';
$auth = & $_SESSION['auth'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($mode == 'delete' && !empty($_REQUEST['mcs_cart_id'])) {
		
		fn_mcs_delete_wishlist_product($wishlist, $_REQUEST['mcs_cart_id']);
	
		fn_save_cart_content($wishlist, $auth['user_id'], 'W');
	
		return true;//array(CONTROLLER_STATUS_OK, "product_features.view&variant_id=".$_REQUEST['variant_id']);
	
	}
}

function fn_mcs_delete_wishlist_product(&$wishlist, $wishlist_id)
{
    fn_set_hook('delete_wishlist_product', $wishlist, $wishlist_id);

    if (!empty($wishlist_id)) {
        unset($wishlist['products'][$wishlist_id]);
    }

    return true;
}