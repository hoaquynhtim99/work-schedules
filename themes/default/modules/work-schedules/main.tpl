<!-- BEGIN: main -->
<div class="schedule-list-tool clearfix">
    <!-- BEGIN: showweek -->
    <div class="pull-left">
        <div class="btn-group">
            <a type="button" class="btn btn-warning" data-toggle="tooltip-week" data-mode="prev" data-value="{LANG.week_stt} {CURRENT_WEEK.stt} ({CURRENT_WEEK.from} {LANG.to} {CURRENT_WEEK.to})" title="{LANG.week_prev}"><i class="fa fa-step-backward" aria-hidden="true"></i></a>
            <div class="btn-group" id="dropdown-selectweek">
                <a class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {LANG.week_stt} {CURRENT_WEEK.stt} ({CURRENT_WEEK.from} {LANG.to} {CURRENT_WEEK.to})
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- BEGIN: week -->
                    <li class="schedules-week<!-- BEGIN: current --> bg-warning<!-- END: current -->"><a href="{WEEK.link}">{LANG.week_stt} {WEEK.stt} ({WEEK.from} {LANG.to} {WEEK.to})</a></li>
                    <!-- END: week -->
                </ul>
            </div>
            <a type="button" class="btn btn-warning" data-toggle="tooltip-week" data-mode="next" data-value="{LANG.week_stt} {CURRENT_WEEK.stt} ({CURRENT_WEEK.from} {LANG.to} {CURRENT_WEEK.to})" title="{LANG.week_next}"><i class="fa fa-step-forward" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- END: showweek -->
    <div class="pull-right">
        <a class="btn btn-info btn-sm" href="{LINK_ADD}"><i class="fa fa-plus"></i> {LANG_ADD}</a>
        <a class="btn btn-info btn-sm" href="{LINK_MANAGER}"><i class="fa fa-briefcase"></i> {LANG.manager}<!-- BEGIN: numqueues --> (<strong>{NUMQUEUES}</strong>)<!-- END: numqueues --></a>
        <a class="btn btn-info btn-sm" rel="nofollow" title="{LANG.event_print}" href="{LINK_PRINT}"><i class="fa fa-print"></i></a>
        <a class="btn btn-info btn-sm" rel="nofollow" title="{LANG.event_download}" href="{LINK_DOWNLOAD}"><i class="fa fa-download"></i></a>
    </div>
</div>
<!-- BEGIN: empty -->
<div class="alert alert-warning">
    <div class="message-box-title"><i class="fa fa-exclamation-triangle"></i> {LANG.schedule_empty}</div>
    <div class="message-box-content">
        {LANG.schedule_empty_guide}
    </div>
</div>
<!-- END: empty -->
<!-- BEGIN: data -->
<table class="table table-bordered schedule-list mb20">
    <thead>
        <tr>
            <th class="text-center">{LANG.daytime}</th>
            <th class="text-center" style="white-space: nowrap;">{LANG.event_time}</th>
            <th class="text-center">{LANG.event_content}</th>
            <!-- BEGIN: display_element --><th class="text-center">{LANG.event_element}</th><!-- END: display_element -->
            <!-- BEGIN: display_location --><th class="text-center">{LANG.event_place}</th><!-- END: display_location -->
            <!-- BEGIN: display_host --><th class="text-center">{LANG.event_host}</th><!-- END: display_host -->
            <!-- BEGIN: display_note --><th class="text-center">{LANG.ae_note}</th><!-- END: display_note -->
        </tr>
    </thead>
    <tbody>
        <!-- BEGIN: loop -->
        <!-- BEGIN: week -->
        <tr>
            <th colspan="10" class="week-head">{LANG.week} {THISWEEK}</th>
        </tr>
        <!-- END: week -->
        <tr>
            <!-- BEGIN: first_col -->
            <td class="text-center middle"<!-- BEGIN: rowspan --> rowspan="{NUMROWS}"<!-- END: rowspan -->>
                {DAYOFWEEK}<br />
                {DAYTEXT}
            </td>
            <!-- END: first_col -->
            <td class="text-center middle{ROW.highlights}">
                <strong>{ROW.etime}</strong>
            </td>
            <td class="middle{ROW.highlights}">
                <!-- BEGIN: edit -->
                <div class="pull-right"><a href="{ROW.url_edit}"><i class="fa fa-edit"></i></a></div>
                <!-- END: edit -->
                {ROW.e_content}
            </td>
            <!-- BEGIN: display_element --><td class="middle{ROW.highlights}">{ROW.e_element}</td><!-- END: display_element -->
            <!-- BEGIN: display_location --><td class="middle{ROW.highlights}">{ROW.e_location}</td><!-- END: display_location -->
            <!-- BEGIN: display_host --><td class="middle{ROW.highlights}"><strong>{ROW.e_host}</strong></td><!-- END: display_host -->
            <!-- BEGIN: display_note --><td class="middle{ROW.highlights}">{ROW.e_note}</td><!-- END: display_note -->
        </tr>
        <!-- END: loop -->
    </tbody>
</table>
<div class="schedule-list-mobile">
    <!-- BEGIN: loop_mobile -->
    <!-- BEGIN: week -->
    <h2 class="week-head">{LANG.week} {THISWEEK}</h2>
    <!-- END: week -->
    <!-- BEGIN: title -->
    <h3 class="dayweek-head">{DAYOFWEEK} <em>({DAYTEXT})</em></h3>
    <!-- END: title -->
    <div class="panel panel-{ROW.panel_type}">
        <div class="panel-body bg-{ROW.panel_type}">
            <div><strong>{ROW.etime}</strong>:</div>
            {ROW.e_content}
            <!-- BEGIN: display_element -->
            <div class="gdl-divider gdl-border-x top margin-bottom margin-top"><div class="scroll-top"></div></div>
            <strong>{LANG.event_element}:</strong> {ROW.e_element}
            <!-- END: display_element -->
            <!-- BEGIN: display_location -->
            <div class="gdl-divider gdl-border-x top margin-bottom margin-top"><div class="scroll-top"></div></div>
            <strong>{LANG.event_place}:</strong> {ROW.e_location}
            <!-- END: display_location -->
            <!-- BEGIN: display_host -->
            <div class="gdl-divider gdl-border-x top margin-bottom margin-top"><div class="scroll-top"></div></div>
            <strong>{LANG.event_host}:</strong> <strong>{ROW.e_host}</strong>
            <!-- END: display_host -->
            <!-- BEGIN: display_note -->
            <div class="gdl-divider gdl-border-x top margin-bottom margin-top"><div class="scroll-top"></div></div>
            <strong>{LANG.ae_note}:</strong> <strong>{ROW.e_note}</strong>
            <!-- END: display_note -->
        </div>
    </div>
    <!-- END: loop_mobile -->
</div>
<!-- END: data -->
<!-- BEGIN: showweek_note -->
<div class="alert alert-info">
    <div class="message-box-title"><i class="fa fa-info-circle"></i> {LANG.event_note}</div>
    <div class="message-box-content">
        {LANG.event_note_detail}
    </div>
</div>
<!-- END: showweek_note -->
<!-- END: main -->