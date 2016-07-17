/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 1 - 31 - 2010 5 : 12
 */

function validErrorShow(a) {
    $(a).parent().parent().addClass("has-error");
    $("[data-mess]", $(a).parent().parent().parent()).not(".tooltip-current").tooltip("destroy");
    $(a).tooltip({
       container: "body",
        placement: "bottom",
        title: function() {
            return "" != $(a).attr("data-current-mess") ? $(a).attr("data-current-mess") : nv_required
        }
    });
    $(a).focus().tooltip("show");
    "DIV" == $(a).prop("tagName") && $("input", a)[0].focus()
}

function validCheck(a) {
    var c = $(a).attr("data-pattern"),
        d = $(a).val(),
        b = $(a).prop("tagName"),
        e = $(a).prop("type");
    if ("INPUT" == b && "email" == e) {
        if (!nv_mailfilter.test(d)) return !1
    } else if ("SELECT" == b) {
        if (!$("option:selected", a).length) return !1
    } else if ("DIV" == b && $(a).is(".radio-box")) {
        if (!$("[type=radio]:checked", a).length) return !1
    } else if ("DIV" == b && $(a).is(".check-box")) {
        if (!$("[type=checkbox]:checked", a).length) return !1
    } else if ("INPUT" == b || "TEXTAREA" == b) if ("undefined" == typeof c || "" == c) {
        if ("" == d) return !1
    } else if (a = c.match(/^\/(.*?)\/([gim]*)$/), !(a ? new RegExp(a[1], a[2]) : new RegExp(c)).test(d)) return !1;
    return !0
}

function validErrorHidden(a, b) {
    if (!b) b = 2;
    b = parseInt(b);
    var c = $(a),
        d = $(a);
    for (var i = 0; i < b; i++) {
        c = c.parent();
        if (i >= 2) d = d.parent()
    }
    d.tooltip("destroy");
    c.removeClass("has-error")
}

function formErrorHidden(a) {
    $(".has-error", a).removeClass("has-error");
    $("[data-mess]", a).tooltip("destroy")
}

function validReset(a) {
    var d = $(".nv-info", a).attr("data-default");
    if (!d) d = $(".nv-info-default", a).html();
    $(".nv-info", a).removeClass("error success").html(d);
    formErrorHidden(a);
    $("input,button,select,textarea", a).prop("disabled", !1);
    $(a)[0].reset()
}

function add_validForm(a) {
    $(".has-error", a).removeClass("has-error");
    var c = 0,
        b = [];
    $(a).find(".required").each(function() {
        "password" == $(a).prop("type") && $(this).val(trim(strip_tags($(this).val())));
        if (!validCheck(this)) return c++, $(".tooltip-current", a).removeClass("tooltip-current"), $(this).addClass("tooltip-current").attr("data-current-mess", $(this).attr("data-mess")), validErrorShow(this), !1
    });
    c || (b.type = $(a).prop("method"), b.url = $(a).prop("action"), b.data = $(a).serialize(), formErrorHidden(a), $(a).find("input,button,select,textarea").prop("disabled", !0), $.ajax({
        type: b.type,
        cache: !1,
        url: b.url,
        data: b.data,
        dataType: "json",
        success: function(d) {
            var b = $("[onclick*='change_captcha']", a);
            b && b.click();
            "error" == d.status ? ($("input,button,select,textarea", a).not("[type=submit]").prop("disabled", !1), $(".tooltip-current", a).removeClass("tooltip-current"), "" != d.input ? $(a).find("[name=" + d.input + "]").each(function() {
                $(this).addClass("tooltip-current").attr("data-current-mess", d.mess);
                validErrorShow(this)
            }) : $(".nv-info", a).html(d.mess).addClass("error").show(), setTimeout(function() {
                $("[type=submit]", a).prop("disabled", !1)
            }, 1E3)) : ($(".nv-info", a).html(d.mess + '<span class="load-bar"></span>').removeClass("error").addClass("success").show(), $(".form-detail", a).hide(), setTimeout(function() {
                window.location.href = "undefined" != typeof d.redirect && "" != d.redirect ? d.redirect : window.location.href
            }, 3E3))
        }
    }));
    return !1
}

function nv_main_action(oForm, msgnocheck) {
    var fa = oForm['idcheck[]'];
    var listid = '';
    if (fa.length) {
        for (var i = 0; i < fa.length; i++) {
            if (fa[i].checked) {
                listid = listid + fa[i].value + ',';
            }
        }
    } else {
        if (fa.checked) {
            listid = listid + fa.value + ',';
        }
    }

    if (listid != '') {
        var action = document.getElementById('action').value;
        if (action == 'delete') {
            if (confirm(nv_is_del_confirm[0])) {
                $.post(
                    nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=' + nv_func_name + '&nocache=' + new Date().getTime(), 
                    'delete=1&listid=' + listid, 
                    function(res) {
                        var r_split = res.split("_");
                        if (r_split[0] == 'OK') {
                            window.location.href = window.location.href;
                        } else {
                            alert(nv_is_del_confirm[2]);
                        }
                    }
                );
            }
        } else {
            $.post(
                nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=' + nv_func_name + '&nocache=' + new Date().getTime(), 
                'changestatus=1&action=' + action + '&listid=' + listid, 
                function(res) {
                    alert(res);
                    window.location.href = window.location.href;
                }
            );
        }
    } else {
        alert(msgnocheck);
    }
}

function nv_del_row( id ){
    if (confirm(nv_is_del_confirm[0])) {
        $.post(
            nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=' + nv_func_name + '&nocache=' + new Date().getTime(), 
            'delete=1&id=' + id, 
            function(res) {
                var r_split = res.split("_");
                if (r_split[0] == 'OK') {
                    window.location.href = window.location.href;
                } else {
                    alert(nv_is_del_confirm[2]);
                }
            }
        );
    }
}

$(document).ready(function(){
    $('#employ-fearch-form').submit(function(e){
        if( $(this).find('[name="q"]').val() == '' ){
            e.preventDefault();
            alert($(this).data('notice'));
        }else{
            return 1;
        }
    });    
    // Tooltip
    $('[data-toggle="tooltip-week"]').tooltip({container: 'body'});
    $('[data-toggle="tooltip-week"]').click(function() {
        var value = $(this).data('value');
        var mode = $(this).data('mode');
        $('.schedules-week').each(function(k, v) {
            if ($(this).text() == value) {
                window.location = $($('.schedules-week')[(mode == 'next') ? k + 1 : k - 1]).find('a').prop('href');
                return false;
            }
        });
        
    });
});
