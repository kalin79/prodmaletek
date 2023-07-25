var data_operation = [
    { "id": 'gte', "text": "Mayor igual a" },
    { "id": 'lte', "text": "Menor igual a" },
    { "id": 'gt', "text": "Mayor a" },
    { "id": 'lt', "text": "Menor a" },
    { "id": 'eq', "text": "Igual a" },
    { "id": 'neq', "text": "Diferente a" },
];

var data_text = [{ "id": 'like', "text": "contiene" },
    { "id": 'eq', "text": "igual a" },
    { "id": 'startswith', "text": "empieza con" },
    { "id": 'endswith', "text": "termina en" },
    { "id": 'notlike', "text": "no contiene" },
    { "id": 'neq', "text": "no es igual a" }
];

var data_text_igual = [
    { "id": 'eq', "text": "igual a" },
];


function form_list(element_group_filter) {
    $(element_group_filter + " .content-operator").hide();
    //$(element_group_filter + ".content-operator select").select2('val', null);
    $(element_group_filter + " .content-value").show();
    $(element_group_filter + ' .section-text').hide();
    $(element_group_filter + " .section-text input[type=text]").val('');
    $(element_group_filter + ' .section-list').show();

}

function form_text(element_group_filter) {
    $(element_group_filter + " .content-operator").show();
    $(element_group_filter + " .content-value").show();
    $(element_group_filter + ' .section-text').show();
    $(element_group_filter + ' .section-list').hide();
}

function form_number(element_group_filter) {
    $(element_group_filter + " .content-operator").show();
    $(element_group_filter + " .content-value").show();
    $(element_group_filter + ' .section-text').show();
    $(element_group_filter + ' .section-list').hide();
}

function form_date(element_group_filter) {
    $(element_group_filter + " .content-operator").show();
    $(element_group_filter + " .content-value").show();
    $(element_group_filter + ' .section-text').show();
    $(element_group_filter + ' .section-list').hide();
}

function get_filters(element_group) {

    var element_group = element_group || "body";

    var array_filter = [];
    var array_field = [];
    var array_value = [];
    var array_operator = [];

    $(element_group + " input[name='filter[]']").each(function(ind, value) {
        array_filter.push($(value).val());
    });

    $(element_group + " input[name='operator[]']").each(function(ind, value) {
        array_operator.push($(value).val());
    });

    $(element_group + " input[name='value[]']").each(function(ind, value) {
        array_value.push($(value).val());
    });

    $(element_group + " input[name='field[]']").each(function(ind, value) {
        array_field.push($(value).val());
    });

    var filters = { filters: { 'filter': array_filter, value: array_value, 'operator': array_operator, 'field': array_field } };

    return filters;
}


function get_list(url, field_id, field_text) {
    var field_id = field_id || 'id';
    var field_text = field_text || 'nombre';

    var data_list = [];

    $.ajax({
        url: url,
        type: 'get',
        async: false,
        success: function(values) {
            $.each(values, function(indx, value) {
                data_list.push({ "id": value[field_id], "text": value[field_text] });
            });
        }
    });

    return data_list;
}

var CI = {
    filter: function(options) {
        var elemnt_field = $(options.controls.field)
        var elemnt_operator = $(options.controls.operator)
        var elemnt_value = '';
        var default_filter = options.default_filter ? options.default_filter : null;

        var elemnt_action = $(options.elemnt_action)
        var content_filters = $(options.content_filters)
        var data = options.data;
        var selected = null;

        var element_group_filter = options.group_filter ? options.group_filter : 'body';
        var element_cmb_value = options.cmb_value ? options.cmb_value : '#cmb-value';


        /*elemnt_field.select2({
            theme: "bootstrap4",
            "data": data,
        });*/

        elemnt_field.on('change', function() {
            elemnt_value = $(options.controls.value)
            if (elemnt_value.hasClass("dtp")) {
                elemnt_value.datepicker("destroy");;
            }
            var value = $(this).val();
            var row = $.grep(data, function(e) {
                return e.id == value;
            });

            var field_name = row[0].text;
            var field_type = row[0].type;
            var type_select2 = row[0].type_select2 ? row[0].type_select2 : null;
            var operator_igual_a = row[0].custom_operator ? row[0].custom_operator : null;
            if (field_type == 'list') {
                form_list(element_group_filter);
                var list = row[0].list();
                var html = "<option value=''>Seleccionar " + field_name + "</option>";

                $.each(list, function(index, value) {
                    option = "<option value=" + value.id + ">" + value.text + "</option>";
                    html = html + option;
                });
                elemnt_value = $(element_cmb_value);
                var name_select2 = element_cmb_value.replace("#", "");

                elemnt_value.html(html);

                if (type_select2) {
                    elemnt_value.select2({
                        theme: "bootstrap4",
                        allowClear: true,
                        placeholder: "Seleccionar " + field_name
                    });
                } else {
                    if ($('#select2-' + name_select2 + '-container').is('*')) {
                        elemnt_value.select2('destroy');
                    }
                }
                $("#cmb-value").select2({ theme: "bootstrap4", allowClear: true, placeholder: "Seleccionar " + field_name });

            } else if (field_type == 'text') {
                console.log("d")
                form_text(element_group_filter);
                elemnt_operator.not('option:first').html('');
                console.log(operator_igual_a);
                if (operator_igual_a) {
                    elemnt_operator.select2({ theme: "bootstrap4", data: data_text_igual });
                } else {
                    elemnt_operator.select2({ theme: "bootstrap4", data: data_text });

                }

            } else if (field_type == 'number') {
                form_number(element_group_filter);
                elemnt_operator.not('option:first').html('');
                elemnt_operator.select2({ theme: "bootstrap4", data: data_operation });
            } else if (field_type == 'date') {
                var format = row[0].format ? row[0].format : 'YYYY/MM/DD';
                elemnt_value.addClass('dtp');
                form_date(element_group_filter);
                elemnt_value.datepicker({
                    locale: 'en',
                    format: format,
                    useCurrent: false, //Important! See issue #1075
                    widgetPositioning: {
                        vertical: 'bottom'
                    }
                });
                elemnt_operator.not('option:first').html('');
                elemnt_operator.select2({ theme: "bootstrap4", data: data_operation });
            }
            elemnt_value.val('');
        });

        $(document).on('click', element_group_filter + " .close-filter", function() {
            $(this).parents('.tag-filter').remove();
            options.load();
        });

        elemnt_action.on('click', function() {
            var row = $.grep(data, function(e) {
                return e.id == elemnt_field.find('option:selected').val();
            });

            var field = row[0].field ? row[0].field : null;
            var filter = row[0].filter ? row[0].filter : default_filter;
            var field_type = row[0].type;
            var field_name = elemnt_field.find('option:selected').html().toUpperCase();
            var field_operator = '';
            var field_operator_id = null;

            if (field_type == 'list') {
                field_value_id = elemnt_value.find('option:selected').val();
                field_value = elemnt_value.find('option:selected').html();
            } else {
                field_value_id = elemnt_value.val();
                field_value = elemnt_value.val();
                field_operator_id = elemnt_operator.find('option:selected').val();
                field_operator = elemnt_operator.find('option:selected').html()
            }

            if ($('._' + filter).is('*') && field_type != 'number') {
                $('._' + filter).remove();
            }

            content_filters.after("<div class=' tag-filter' style='float: left;margin:2px !important'>\n\
                                            <input name='value[]' type='hidden' value='" + field_value_id + "'>   \n\
                                            <input name='filter[]' type='hidden' value=" + filter + ">   \n\
                                            <input name='operator[]' type='hidden' value=" + field_operator_id + "> \n\                                         <input name='field[]' type='hidden' value=" + field + ">   \n\
                                            <span class='badge badge-primary'>\n\
                                                <span class='label bg-system'> \n\
                                                <span class='field-name'>" + field_name + "</span> \n\
                                                <span> : </span> \n\
                                                <span class='field-operator'>" + field_operator + "</span> \n\
                                                <b><span class='field-value'>" + jsEscape(field_value) + "</span></b> \n\
                                                <i class='close-filter fa fa-times-circle' style='cursor:pointer'></i> \n\
                                                </span> \n\
                                            </span> \n\
                                        </div>");

            options.load();

        });


        data.forEach(function(name) {
            if (name.selected) {
                elemnt_field.select2('val', name.id);
            }
        });

    },
};

function jsEscape(str) {
    return String(str).replace(/[^\w. ]/gi, function(c) {
        return '\\u' + ('0000' + c.charCodeAt(0).toString(16)).slice(-4);
    });

}