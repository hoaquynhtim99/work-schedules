<?php

/**
 * @Project WORK SCHEDULES 4.X
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2016 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Jun 2016 23:45:51 GMT
 */

if (!defined('NV_SYSTEM'))
    die('Stop!!!');

define('NV_MOD_WORK_SCHEDULES', true);

if (defined('NV_IS_SPADMIN')) {
    define('NV_IS_MANAGER_ADMIN', true);
} elseif (defined('NV_IS_USER') and !empty($module_info['admins']) and !empty($user_info['userid']) and in_array($user_info['userid'], explode(',', $module_info['admins']))) {
    define('NV_IS_MANAGER_ADMIN', true);
}

require NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
