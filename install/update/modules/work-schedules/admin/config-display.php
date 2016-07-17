<?php

/**
 * @Project WORK SCHEDULES 4.X
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2016 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Jun 2016 23:45:51 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

$page_title = $lang_module['cfgDisplay'];

$array_field = array('element', 'location', 'host', 'note');

if ($nv_Request->isset_request('submit', 'post')) {
    $array = array();
    
    foreach ($array_field as $field) {
        $array['display_' . $field] = $nv_Request->get_int('display_' . $field, 'post', 0);
        $array['require_' . $field] = $nv_Request->get_int('require_' . $field, 'post', 0);
        
        $array['display_' . $field] = $array['display_' . $field] ? 1 : 0;
        $array['require_' . $field] = $array['display_' . $field] ? ($array['require_' . $field] ? 1 : 0) : 0;
    
        $sql = 'UPDATE ' . NV_CONFIG_GLOBALTABLE . ' SET config_value=:config_value WHERE lang=' . $db->quote(NV_LANG_DATA) . ' AND module=' . $db->quote($module_name) . ' AND config_name=:config_name';
        $sth = $db->prepare($sql);
        $sth->bindParam(':config_value', $array['display_' . $field], PDO::PARAM_STR);
        $sth->bindValue(':config_name', 'display_' . $field, PDO::PARAM_STR);
        $sth->execute();
    
        $sql = 'UPDATE ' . NV_CONFIG_GLOBALTABLE . ' SET config_value=:config_value WHERE lang=' . $db->quote(NV_LANG_DATA) . ' AND module=' . $db->quote($module_name) . ' AND config_name=:config_name';
        $sth = $db->prepare($sql);
        $sth->bindParam(':config_value', $array['require_' . $field], PDO::PARAM_STR);
        $sth->bindValue(':config_name', 'require_' . $field, PDO::PARAM_STR);
        $sth->execute();
    }

    $nv_Cache->delMod('settings');
    Header('Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    die();
} else {
    $array = $module_config[$module_name];
}

$xtpl = new XTemplate('cfgDisplay.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('FORM_ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op);

foreach ($array_field as $field) {
    $xtpl->assign('FIELD', $field);
    $xtpl->assign('FIELD_NAME', $lang_module['e_' . $field]);
    $xtpl->assign('FIELD_DISPLAY', $array['display_' . $field] ? ' checked="checked"' : '');
    $xtpl->assign('FIELD_REQUIRE', $array['require_' . $field] ? ' checked="checked"' : '');
    $xtpl->assign('FIELD_REQUIRE_VALUE', $array['require_' . $field]);
    $xtpl->parse('main.field');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
