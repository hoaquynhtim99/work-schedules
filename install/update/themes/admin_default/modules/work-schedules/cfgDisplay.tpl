<!-- BEGIN: main -->
<form method="post" action="{FORM_ACTION}">
    <div class="panel panel-default">
        <table class="table">
            <thead>
                <tr>
                    <th>{LANG.cfgDisplay_field}</th>
                    <th>{LANG.cfgDisplay_display}</th>
                    <th>{LANG.cfgDisplay_require}</th>
                </tr>
            </thead>
            <tbody>
                <!-- BEGIN: field -->
                <tr>
                    <td>{FIELD_NAME}</td>
                    <td><input type="checkbox" data-click="field" data-field="{FIELD}" name="display_{FIELD}" value="1"{FIELD_DISPLAY}/></td>
                    <td><input type="checkbox" data-value="{FIELD_REQUIRE_VALUE}" name="require_{FIELD}" value="1"{FIELD_REQUIRE}/></td>
                </tr>
                <!-- END: field -->
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-xs-24">
            <div class="text-center">
                <input type="submit" name="submit" value="{LANG.save}" class="btn btn-block btn-success btn-lg"/>
            </div>
        </div>
    </div>
</form>
<!-- END: main -->