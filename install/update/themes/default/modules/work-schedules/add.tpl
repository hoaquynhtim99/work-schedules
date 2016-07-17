<!-- BEGIN: main -->
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css"/>
<p class="text-right">
    <em>
        <span class="text-danger">(<i class="fa fa-asterisk"></i>)</span> 
        {LANG.ae_id_requires}
    </em>
</p>
<!-- BEGIN: error -->
<div class="message-box-wrapper red">
    <div class="message-box-title">{ERROR}</div>
</div>
<!-- END: error -->
<form method="post" action="{FORM_ACTION}" role="form" onsubmit="return add_validForm(this);" >
    <div class="nv-info margin-bottom" data-default="{INFO}">{INFO}</div>
    <div class="form-detail">
        <div class="form-group">
            <div>
                <label>{LANG.ae_day}<span class="fa-required text-danger">(<i class="fa fa-asterisk"></i>)</span></label>
                <input type="text" name="event_textday" value="{DATA.event_textday}" class="form-control required" placeholder="{LANG.ae_day_note}" maxlength="255" data-pattern="/^([0-9]{2,2})\/([0-9]{2,2})\/([0-9]{4,4})$/" onkeypress="validErrorHidden(this);" data-mess="{LANG.ae_error_day}">
            </div>
        </div>
        <div class="form-group">
            <div>
                <label>{LANG.ae_start}<span class="fa-required text-danger">(<i class="fa fa-asterisk"></i>)</span></label>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <select name="e_shour" class="form-control">
                            <!-- BEGIN: shour --><option value="{HOUR.key}"{HOUR.selected_s}>{HOUR.title}</option><!-- END: shour -->
                        </select>
                    </div>
                    <div class="col-md-12">
                        <select name="e_smin" class="form-control">
                            <!-- BEGIN: smin --><option value="{MIN.key}"{MIN.selected_s}>{MIN.title}</option><!-- END: smin -->
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label>{LANG.ae_end}</label>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <select name="e_ehour" class="form-control">
                            <!-- BEGIN: ehour --><option value="{HOUR.key}"{HOUR.selected_e}>{HOUR.title}</option><!-- END: ehour -->
                        </select>
                    </div>
                    <div class="col-md-12">
                        <select name="e_emin" class="form-control">
                            <!-- BEGIN: emin --><option value="{MIN.key}"{MIN.selected_e}>{MIN.title}</option><!-- END: emin -->
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div>
                <label>{LANG.ae_content}<span class="fa-required text-danger">(<i class="fa fa-asterisk"></i>)</span></label>
                <textarea class="form-control required" name="e_content" rows="5" onkeypress="validErrorHidden(this);" data-mess="">{DATA.e_content}</textarea>
            </div>
        </div>
        <!-- BEGIN: display_element -->
        <div class="form-group">
            <div>
                <label>{LANG.ae_element}<!-- BEGIN: require_element1 --><span class="fa-required text-danger">(<i class="fa fa-asterisk"></i>)</span><!-- END: require_element1 --></label>
                <textarea class="form-control<!-- BEGIN: require_element2 --> required<!-- END: require_element2 -->" name="e_element" rows="5" onkeypress="validErrorHidden(this);" data-mess="">{DATA.e_element}</textarea>
            </div>
        </div>
        <!-- END: display_element -->
        <!-- BEGIN: display_location -->
        <div class="form-group">
            <div>
                <label>{LANG.ae_location}<!-- BEGIN: require_location1 --><span class="fa-required text-danger">(<i class="fa fa-asterisk"></i>)</span><!-- END: require_location1 --></label>
                <input type="text" name="e_location" value="{DATA.e_location}" class="form-control<!-- BEGIN: require_location2 --> required<!-- END: require_location2 -->" maxlength="255" data-pattern="/^(.){3,}$/" onkeypress="validErrorHidden(this);" data-mess="">
            </div>
        </div>
        <!-- END: display_location -->
        <!-- BEGIN: display_host -->
        <div class="form-group">
            <div>
                <label>{LANG.ae_host}<!-- BEGIN: require_host1 --><span class="fa-required text-danger">(<i class="fa fa-asterisk"></i>)</span><!-- END: require_host1 --></label>
                <input type="text" name="e_host" value="{DATA.e_host}" class="form-control<!-- BEGIN: require_host2 --> required<!-- END: require_host2 -->" maxlength="255" data-pattern="/^(.){3,}$/" onkeypress="validErrorHidden(this);" data-mess="">
            </div>
        </div>
        <!-- END: display_host -->
        <!-- BEGIN: display_note -->
        <div class="form-group">
            <div>
                <label>{LANG.ae_note}<!-- BEGIN: require_note1 --><span class="fa-required text-danger">(<i class="fa fa-asterisk"></i>)</span><!-- END: require_note1 --></label>
                <textarea class="form-control<!-- BEGIN: require_note2 --> required<!-- END: require_note2 -->" name="e_note" rows="5" onkeypress="validErrorHidden(this);" data-mess="">{DATA.e_note}</textarea>
            </div>
        </div>
        <!-- END: display_note -->
        <!-- BEGIN: status -->
        <div class="form-group">
            <div>
                <label>{LANG.mana_status1}</label>
                <select name="status" class="form-control">
                    <!-- BEGIN: loop --><option value="{STATUS.key}"{STATUS.selected}>{STATUS.title}</option><!-- END: loop -->
                </select>
            </div>
        </div>
        <!-- END: status -->
        <!-- BEGIN: highlights -->
        <div class="form-group">
            <div>
                <label>{LANG.mana_highlights}</label>
                <select name="highlights" class="form-control">
                    <!-- BEGIN: loop --><option value="{HIGHLIGHTS.key}"{HIGHLIGHTS.selected}>{HIGHLIGHTS.title}</option><!-- END: loop -->
                </select>
            </div>
        </div>
        <!-- END: highlights -->
        <!-- BEGIN: captcha -->
        <div class="form-group">
            <div class="middle text-center clearfix">
                <img class="captchaImg display-inline-block" src="{SRC_CAPTCHA}" width="{GFX_WIDTH}" height="{GFX_HEIGHT}" alt="{N_CAPTCHA}" title="{N_CAPTCHA}" />
                <em class="icon-pointer icon-refresh margin-left margin-right" title="{CAPTCHA_REFRESH}" onclick="change_captcha('.rsec');"></em>
                <input type="text" style="width:100px;" class="rsec required form-control display-inline-block" name="nv_seccode" value="" maxlength="{GFX_MAXLENGTH}" placeholder="{GLANG.securitycode}" data-pattern="/^(.){{GFX_MAXLENGTH},{GFX_MAXLENGTH}}$/" onkeypress="validErrorHidden(this);" data-mess="{GLANG.securitycodeincorrect}" />
            </div>
        </div>
        <!-- END: captcha -->
        <div class="form-group">
            <div class="text-center">
                <input type="submit" name="submit" value="{GLANG.submit}" class="btn btn-warning">
            </div>
        </div>
    </div>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("[name='event_textday']").datepicker({
        dateFormat : "dd/mm/yy",
        showOtherMonths : true,
        selectOtherMonths : true,
        numberOfMonths : 2,
        <!-- BEGIN: disable_oldday -->minDate : 1<!-- END: disable_oldday -->
    });
});
</script>
<!-- END: main -->