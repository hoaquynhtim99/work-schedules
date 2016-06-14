/**
 * @Project WORK SCHEDULES 4.X
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2016 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Jun 2016 23:45:51 GMT
 */

$(document).ready(function() {
    $('[data-click="field"]').change(function() {
        var field = $(this).data('field'), dis = $(this).is(':checked'), rval = $('[name="require_' + field + '"]').data('value');
        if (dis) {
            $('[name="require_' + field + '"]').prop('disabled', false).prop('checked', rval);
        } else {
            $('[name="require_' + field + '"]').prop('checked', false).prop('disabled', true);
        }
    });
    $('[data-click="field"]').change();
});
