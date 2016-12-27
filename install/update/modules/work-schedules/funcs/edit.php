<?php

/**
 * @Project WORK SCHEDULES 4.X
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2016 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Jun 2016 23:45:51 GMT
 */

if (!defined('NV_MOD_EMPLOYMENT'))
    die('Stop!!!');

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
$base_url_rewrite = nv_url_rewrite($base_url, true);
$page_url_rewrite = $page ? nv_url_rewrite($base_url . '/page-' . $page, true) : $base_url_rewrite;
$request_uri = $_SERVER['REQUEST_URI'];

if (!($home or $request_uri == $base_url_rewrite or $request_uri == $page_url_rewrite or NV_MAIN_DOMAIN . $request_uri == $base_url_rewrite or NV_MAIN_DOMAIN . $request_uri == $page_url_rewrite) and !$is_search) {
    $redirect = '<meta http-equiv="Refresh" content="3;URL=' . $base_url_rewrite . '" />';
    nv_info_die($lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] . $redirect);
}

$db->sqlreset()->select('COUNT(*)')->from(NV_PREFIXLANG . '_' . $module_data . '_rows')->where('status = 1');

$num_items = $db->query($db->sql())->fetchColumn();

$db->select('id, title, alias, company, addtime')->order('id DESC')->limit($per_page)->offset(($page - 1) * $per_page);

$result = $db->query($db->sql());
$array = array();

while ($row = $result->fetch()) {
    $row['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $row['alias'] . $global_config['rewrite_exturl'];
    $row['code'] = sprintf($global_code, $row['id']);

    $array[] = $row;
}

if ($page > 1) {
    $page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $page;
}

$generate_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);
$contents = nv_main_theme($array, $generate_page, false, $num_items);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
