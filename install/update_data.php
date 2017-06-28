<?php

/**
 * @Project WORK SCHEDULES 4.X
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2016 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Jun 2016 23:45:51 GMT
 */

if (!defined('NV_IS_UPDATE'))
    die('Stop!!!');

$nv_update_config = array();

// Kieu nang cap 1: Update; 2: Upgrade
$nv_update_config['type'] = 1;

// ID goi cap nhat
$nv_update_config['packageID'] = 'NVUDWORKSCHEDULES4102';

// Cap nhat cho module nao, de trong neu la cap nhat NukeViet, ten thu muc module neu la cap nhat module
$nv_update_config['formodule'] = 'work-schedules';

// Thong tin phien ban, tac gia, ho tro
$nv_update_config['release_date'] = 1498674115;
$nv_update_config['author'] = 'PHAN TAN DUNG (phantandung92@gmail.com)';
$nv_update_config['support_website'] = 'https://github.com/hoaquynhtim99/work-schedules/tree/to-4.1.02';
$nv_update_config['to_version'] = '4.1.02';
$nv_update_config['allow_old_version'] = array('4.1.00', '4.1.01');

// 0:Nang cap bang tay, 1:Nang cap tu dong, 2:Nang cap nua tu dong
$nv_update_config['update_auto_type'] = 1;

$nv_update_config['lang'] = array();
$nv_update_config['lang']['vi'] = array();

// Tiếng Việt
$nv_update_config['lang']['vi']['nv_up_p1'] = 'Thiết lập chức năng cấu hình trường dữ liệu';
$nv_update_config['lang']['vi']['nv_up_p2'] = 'Xóa file thừa';
$nv_update_config['lang']['vi']['nv_up_p3'] = 'Thêm một số cấu hình';
$nv_update_config['lang']['vi']['nv_up_finish'] = 'Đánh dấu phiên bản mới';

$nv_update_config['tasklist'] = array();
$nv_update_config['tasklist'][] = array(
    'r' => '4.1.02',
    'rq' => 1,
    'l' => 'nv_up_p1',
    'f' => 'nv_up_p1'
);
$nv_update_config['tasklist'][] = array(
    'r' => '4.1.02',
    'rq' => 1,
    'l' => 'nv_up_p2',
    'f' => 'nv_up_p2'
);
$nv_update_config['tasklist'][] = array(
    'r' => '4.1.02',
    'rq' => 1,
    'l' => 'nv_up_p3',
    'f' => 'nv_up_p3'
);
$nv_update_config['tasklist'][] = array(
    'r' => '4.1.02',
    'rq' => 1,
    'l' => 'nv_up_finish',
    'f' => 'nv_up_finish'
);

// Danh sach cac function
/*
Chuan hoa tra ve:
array(
'status' =>
'complete' =>
'next' =>
'link' =>
'lang' =>
'message' =>
);
status: Trang thai tien trinh dang chay
- 0: That bai
- 1: Thanh cong
complete: Trang thai hoan thanh tat ca tien trinh
- 0: Chua hoan thanh tien trinh nay
- 1: Da hoan thanh tien trinh nay
next:
- 0: Tiep tuc ham nay voi "link"
- 1: Chuyen sang ham tiep theo
link:
- NO
- Url to next loading
lang:
- ALL: Tat ca ngon ngu
- NO: Khong co ngon ngu loi
- LangKey: Ngon ngu bi loi vi,en,fr ...
message:
- Any message
Duoc ho tro boi bien $nv_update_baseurl de load lai nhieu lan mot function
Kieu cap nhat module duoc ho tro boi bien $old_module_version
*/

$array_modlang_update = array();

// Lay danh sach ngon ngu
$result = $db->query("SELECT lang FROM " . $db_config['prefix'] . "_setup_language WHERE setup=1");
while (list($_tmp) = $result->fetch(PDO::FETCH_NUM)) {
    $array_modlang_update[$_tmp] = array("lang" => $_tmp, "mod" => array());

    // Get all module
    $result1 = $db->query("SELECT title, module_data FROM " . $db_config['prefix'] . "_" . $_tmp . "_modules WHERE module_file=" . $db->quote($nv_update_config['formodule']));
    while (list($_modt, $_modd) = $result1->fetch(PDO::FETCH_NUM)) {
        $array_modlang_update[$_tmp]['mod'][] = array("module_title" => $_modt, "module_data" => $_modd);
    }
}

/**
 * nv_up_p1()
 *
 * @return
 *
 */
function nv_up_p1()
{
    global $nv_update_baseurl, $db, $db_config, $nv_Cache, $array_modlang_update;

    $return = array(
        'status' => 1,
        'complete' => 1,
        'next' => 1,
        'link' => 'NO',
        'lang' => 'NO',
        'message' => ''
    );

    foreach ($array_modlang_update as $lang => $array_mod) {
        foreach ($array_mod['mod'] as $module_info) {
            // Tạo bảng field
            try {
                $db->query("CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_info['module_data'] . "_field (
                 fid mediumint(8) NOT NULL AUTO_INCREMENT,
                 field varchar(25) NOT NULL,
                 weight int(10) unsigned NOT NULL DEFAULT '1',
                 field_type enum('number','date','textbox','textarea','editor','select','radio','checkbox','multiselect') NOT NULL DEFAULT 'textbox',
                 field_choices text NOT NULL,
                 sql_choices text NOT NULL,
                 match_type enum('none','alphanumeric','email','url','regex','callback') NOT NULL DEFAULT 'none',
                 match_regex varchar(250) NOT NULL DEFAULT '',
                 func_callback varchar(75) NOT NULL DEFAULT '',
                 min_length int(11) NOT NULL DEFAULT '0',
                 max_length bigint(20) unsigned NOT NULL DEFAULT '0',
                 required tinyint(3) unsigned NOT NULL DEFAULT '0',
                 show_addedit tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Hiển thị tại trang thêm sửa',
                 show_website tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Hiển thị cho người xem website',
                 show_manager tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Hiển thị ở trang quản lý',
                 class varchar(50) NOT NULL DEFAULT '',
                 language text NOT NULL,
                 default_value varchar(255) NOT NULL DEFAULT '',
                 PRIMARY KEY (fid),
                 UNIQUE KEY field (field)
                ) ENGINE=MyISAM;");
            } catch (PDOException $e) {
                trigger_error($e->getMessage());
            }

            // Dữ liệu mặc định của bảng field
            try {
                $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_info['module_data'] . "_field (
                    fid, field, weight, field_type, field_choices, sql_choices, match_type, match_regex, func_callback, min_length,
                    max_length, required, show_addedit, show_website, show_manager, class, language, default_value
                ) VALUES
                (1, 'e_content', 1, 'textarea', '', '', 'none', '', '', 0, 65536, 1, 1, 1, 1, '', 'a:1:{s:2:\"vi\";a:2:{i:0;s:10:\"Nội dung\";i:1;s:0:\"\";}}', ''),
                (2, 'e_element', 2, 'textarea', '', '', 'none', '', '', 0, 65536, 1, 1, 1, 0, '', 'a:1:{s:2:\"vi\";a:2:{i:0;s:13:\"Thành phần\";i:1;s:0:\"\";}}', ''),
                (3, 'e_location', 3, 'textbox', '', '', 'none', '', '', 0, 255, 1, 1, 1, 0, '', 'a:1:{s:2:\"vi\";a:2:{i:0;s:14:\"Địa điểm\";i:1;s:0:\"\";}}', ''),
                (4, 'e_host', 4, 'textbox', '', '', 'none', '', '', 0, 255, 1, 1, 1, 0, '', 'a:1:{s:2:\"vi\";a:2:{i:0;s:10:\"Chủ trì\";i:1;s:0:\"\";}}', ''),
                (5, 'e_note', 5, 'textarea', '', '', 'none', '', '', 0, 65536, 0, 0, 0, 0, '', 'a:1:{s:2:\"vi\";a:2:{i:0;s:8:\"Ghi chú\";i:1;s:0:\"\";}}', '');");
            } catch (PDOException $e) {
                trigger_error($e->getMessage());
            }

            try {
                // Lấy cấu hình cũ
                $sql = "SELECT * FROM " . NV_CONFIG_GLOBALTABLE . " WHERE lang='" . $lang . "' AND module='" . $module_info['module_title'] . "'";
                $result = $db->query($sql);
                $array_config = array();
                while ($row = $result->fetch()) {
                    $array_config[$row['config_name']] = $row['config_value'];
                }

                // Cập nhật field theo cấu hình cũ
                $array_keys = array('element', 'location', 'host', 'note');
                foreach ($array_keys as $key) {
                    $db->query("UPDATE " . $db_config['prefix'] . "_" . $lang . "_" . $module_info['module_data'] . "_field SET
                        required=" . (empty($array_config['require_' . $key]) ? 0 : 1) . ",
                        show_addedit=" . (empty($array_config['display_' . $key]) ? 0 : 1) . ",
                        show_website=" . (empty($array_config['display_' . $key]) ? 0 : 1) . "
                    WHERE field='e_" . $key . "'");
                }
            } catch (PDOException $e) {
                trigger_error($e->getMessage());
            }

            // Xóa cấu hình cũ
            try {
                $db->query("DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE lang='" . $lang . "' AND module='" . $module_info['module_title'] . "' AND config_name IN('display_element', 'display_location', 'display_host', 'display_note');");
                $db->query("DELETE FROM " . NV_CONFIG_GLOBALTABLE . " WHERE lang='" . $lang . "' AND module='" . $module_info['module_title'] . "' AND config_name IN('require_element', 'require_location', 'require_host', 'require_note');");
            } catch (PDOException $e) {
                trigger_error($e->getMessage());
            }

            // Di chuyển các cột
            try {
                $db->query("ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_info['module_data'] . "_rows CHANGE e_content e_content MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nội dung sự kiện' AFTER highlights;");
                $db->query("ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_info['module_data'] . "_rows CHANGE e_element e_element MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Thành phần' AFTER e_content;");
                $db->query("ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_info['module_data'] . "_rows CHANGE e_location e_location VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Địa điểm' AFTER e_element;");
                $db->query("ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_info['module_data'] . "_rows CHANGE e_host e_host VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Chủ trì' AFTER e_location;");
                $db->query("ALTER TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_info['module_data'] . "_rows CHANGE e_note e_note MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú' AFTER e_host;");
            } catch (PDOException $e) {
                trigger_error($e->getMessage());
            }
        }
    }

    return $return;
}

/**
 * nv_up_p2()
 *
 * @return
 *
 */
function nv_up_p2()
{
    $return = array(
        'status' => 1,
        'complete' => 1,
        'next' => 1,
        'link' => 'NO',
        'lang' => 'NO',
        'message' => ''
    );

    @nv_deletefile(NV_ROOTDIR . '/modules/work-schedules/funcs/edit.php');
    @nv_deletefile(NV_ROOTDIR . '/modules/work-schedules/admin/config-display.php');
    @nv_deletefile(NV_ROOTDIR . '/themes/admin_default/modules/work-schedules/cfgDisplay.tpl');

    return $return;
}

/**
 * nv_up_p3()
 *
 * @return
 *
 */
function nv_up_p3()
{
    global $nv_update_baseurl, $db, $db_config, $nv_Cache, $array_modlang_update;

    $return = array(
        'status' => 1,
        'complete' => 1,
        'next' => 1,
        'link' => 'NO',
        'lang' => 'NO',
        'message' => ''
    );


    foreach ($array_modlang_update as $lang => $array_mod) {
        foreach ($array_mod['mod'] as $module_info) {
            // Thêm một số cấu hình
            $sqls = array();
            $sqls[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_info['module_title'] . "', 'show_navweek', '1')";
            $sqls[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_info['module_title'] . "', 'show_textweek', '0')";
            $sqls[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_info['module_title'] . "', 'show_btntool', '1')";
            $sqls[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_info['module_title'] . "', 'html_infotop', '')";

            foreach ($sqls as $sql) {
                try {
                    $db->query($sql);
                } catch (PDOException $e) {
                    trigger_error($e->getMessage());
                }
            }
        }
    }

    return $return;
}

/**
 * nv_up_finish()
 *
 * @return
 *
 */
function nv_up_finish()
{
    global $nv_update_baseurl, $db, $db_config, $nv_Cache, $nv_update_config;

    $return = array(
        'status' => 1,
        'complete' => 1,
        'next' => 1,
        'link' => 'NO',
        'lang' => 'NO',
        'message' => ''
    );

    try {
        $num = $db->query("SELECT COUNT(*) FROM " . $db_config['prefix'] . "_setup_extensions WHERE basename='" . $nv_update_config['formodule'] . "' AND type='module'")->fetchColumn();
        $version = $nv_update_config['to_version'] . " " . $nv_update_config['release_date'];

        if (!$num) {
            $db->query("INSERT INTO " . $db_config['prefix'] . "_setup_extensions (
                id, type, title, is_sys, is_virtual, basename, table_prefix, version, addtime, author, note
            ) VALUES (
                324, 'module', 'work-schedules', 0, 1, 'work-schedules', 'work_schedules', '" . $version . "', " . NV_CURRENTTIME . ", 'PHAN TAN DUNG (phantandung92@gmail.com)',
                'Module lịch công tác tuần'
            )");
        } else {
            $db->query("UPDATE " . $db_config['prefix'] . "_setup_extensions SET
                id=324,
                version='" . $version . "',
                author='PHAN TAN DUNG (phantandung92@gmail.com)'
            WHERE basename='" . $nv_update_config['formodule'] . "' AND type='module'");
        }
    } catch (PDOException $e) {
        trigger_error($e->getMessage());
    }

    $nv_Cache->delAll();
    return $return;
}
