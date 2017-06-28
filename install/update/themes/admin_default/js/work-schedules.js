/**
 * @Project WORK SCHEDULES 4.X
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2016 PHAN TAN DUNG. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 11 Jun 2016 23:45:51 GMT
 */

// Custom fields
var items = '';
function nv_choice_fields_additem(placeholder) {
    items++;
    var newitem = '<tr class="text-center">';
    newitem += '    <td>' + items + '</td>';
    newitem += '    <td><input class="form-control w200 validalphanumeric" type="text" value="" name="field_choice[' + items + ']" placeholder="' + placeholder + '"></td>';
    newitem += '    <td><input class="form-control w300" type="text" value="" name="field_choice_text[' + items + ']"></td>';
    newitem += '    <td><input type="radio" value="' + items + '" name="default_value_choice"></td>';
    newitem += '    </tr>';
    $('#choiceitems').append(newitem);
}

function nv_show_list_field() {
    $('#module_show_list').html('<div class="text-center well"><i class="fa fa-spin fa-spinner fa-2x"></i></div>');
    $('#module_show_list').load(script_name + '?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=fields&qlist=1&nocache=' + new Date().getTime());
    return;
}

function nv_chang_field(fid) {
    var nv_timer = nv_settimeout_disable('id_weight_' + fid, 5000);
    var new_vid = $('#id_weight_' + fid).val();
    $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=fields&nocache=' + new Date().getTime(), 'changeweight=1&fid=' + fid + '&new_vid=' + new_vid, function(res) {
        if (res != 'OK') {
            alert(nv_is_change_act_confirm[2]);
        }
        clearTimeout(nv_timer);
        nv_show_list_field();
    });
    return;
}

function nv_del_field(fid) {
    if (confirm(nv_is_del_confirm[0])) {
        $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=fields&nocache=' + new Date().getTime(), 'del=1&fid=' + fid, function(res) {
            if (res == 'OK') {
                nv_show_list_field();
            } else {
                alert(nv_is_del_confirm[2]);
            }
        });
    }
    return false;
}

function nv_edit_field(fid) {
    window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=fields&fid=' + fid;
}

function nv_load_current_date() {
    if ($("input[name=current_date]:checked").val() == 1) {
        $("input[name=default_date]").attr('disabled', 'disabled');
        $("input[name=default_date]").datepicker("destroy");
    } else {
        $("input[name=default_date]").datepicker({
            showOn : "both",
            dateFormat : "dd/mm/yy",
            changeMonth : true,
            changeYear : true,
            showOtherMonths : true,
            buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
            buttonImageOnly : true
        });
        $("input[name=default_date]").removeAttr("disabled");
        $("input[name=default_date]").focus();
    }
}

function nv_check_choicetypes(elemnet) {
    var choicetypes_val = $(elemnet).val();
    if (choicetypes_val == "field_choicetypes_text") {
        $("#choiceitems").show();
        $("#choicesql").hide();
    } else {
        $("#choiceitems").hide();
        $("#choicesql").show();
        nv_load_sqlchoice('module', '');
    }
}

$(document).ready(function() {
    // Custom field
    $("input[name=field_type]").click(function() {
        var field_type = $("input[name='field_type']:checked").val();
        $("#textfields").hide();
        $("#numberfields").hide();
        $("#datefields").hide();
        $("#choicetypes").hide();
        $("#choiceitems").hide();
        $("#choicesql").hide();
        $("#editorfields").hide();
        if (field_type == 'textbox' || field_type == 'textarea' || field_type == 'editor') {
            if (field_type == 'textbox') {
                $("#li_alphanumeric").show();
                $("#li_email").show();
                $("#li_url").show();
            } else {
                $("#li_alphanumeric").hide();
                $("#li_email").hide();
                $("#li_url").hide();
                if (field_type == 'editor') {
                    $("#editorfields").show();
                }
            }
            $("#textfields").show();
        } else if (field_type == 'number') {
            $("#numberfields").show();
        } else if (field_type == 'date') {
            $("#datefields").show();
        } else {
            $("#choicetypes").show();
            $("#textfields").hide();
            $("#numberfields").hide();
            $("#datefields").hide();
            nv_check_choicetypes("select[name=choicetypes]");
        }
    });
    $("input[name=required],input[name=show_register]").click(function() {
        if ($("input[name='required']:checked").val() == 1) {
            $("input[name=show_register]").prop("checked", true);
        }
    });
    $("input[name=match_type]").click(function() {
        $("input[name=match_regex]").attr('disabled', 'disabled');
        $("input[name=match_callback]").attr('disabled', 'disabled');
        var match_type = $("input[name='match_type']:checked").val();
        var max_length = $("input[name=max_length]").val();
        if (match_type == 'number') {
            if (max_length == 255) {
                $("input[name=max_length]").val(11);
            }
        } else if (max_length == 11) {
            $("input[name=max_length]").val(255);
        }
        if (match_type == 'regex') {
            $("input[name=match_regex]").removeAttr("disabled");
        } else if (match_type == 'callback') {
            $("input[name=match_callback]").removeAttr("disabled");
        }
    });

    $("input[name=current_date]").click(function() {
        nv_load_current_date();
    });
    $("select[name=choicetypes]").change(function() {
        nv_check_choicetypes(this);
    });
});
