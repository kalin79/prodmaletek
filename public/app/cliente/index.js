jQuery(function() {
    load();
    var data_fields = [

        { "id": 1, "text": "Socio", type: 'text', field: 'nombre' },
        { "id": 2, "text": "DNI", type: 'text', filter: 'byDocument', custom_operator: 'igual' },
        { "id": 3, "text": "Ingreso", type: 'list', field: 'ingreso', list: function() { return list_ingreso() }, 'type_select2': true },
    ];

    function list_ingreso() {
        return get_list(url_filter_ingreso_load);
    }
    $("#cmb-field").select2({
        theme: "bootstrap4",
        "data": data_fields,
    });

    CI.filter({
        controls: { field: '#cmb-field', operator: '#cmb-operator', value: '#text-value' },
        data: data_fields,
        default_filter: 'byField',
        elemnt_action: '#btn-add-filter',
        text_value: '#text-value',
        content_filters: '#content-filters',

        load: function() {
            load();
        }
    });

    var customize_rules = {

        /* @validation states + elements
        ------------------------------------------- */
        ignore: [],
        errorClass: "state-error",
        validClass: "state-success",
        errorElement: "em",

        /*  rules
        ------------------------------------------ */
        rules: {
            //nombre: {required: true},
            //description: {required: true},
        },

        /* @validation error messages
        ---------------------------------------------- */
        messages: {},

        /* @validation highlighting + error placement
        ---------------------------------------------------- */
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.field').addClass(errorClass).removeClass(validClass);
            $(element).parent().find('.select2 > .selection > .select2-selection').addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.field').removeClass(errorClass).addClass(validClass);
            $(element).parent().find('.select2 > .selection > .select2-selection').removeClass(errorClass).addClass(validClass);
        },
        errorPlacement: function(error, element) {
            if (element.is(":radio") || element.is(":checkbox")) {
                element.closest('.option-group').after(error);
            } else {
                error.insertAfter(element.parent());
                error.insertAfter(element.closest(".field"));
            }
        }
    };

    var rules = $.extend(true, {}, customize_rules);
    rules.rules = {
        file_excel: { required: true, extension: "xlsx" },

    }

    ModalCRUD.create({
        title: 'EXCEL',
        title_prefix: 'IMPORTAR',
        element: '.entity-import',
        form_element: '#form-import-excel',
        element_is_load: true,
        isLoadFromAjax: false,
        rules: rules,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {},
        afterSuccess: function() {
            load();

        }
    });

    var rules_delete = $.extend(true, {}, customize_rules);
    rules_delete.rules = {
        init_date: { required: true },
        end_date: { required: true },
    }
    ModalCRUD.edit({
        title: 'Socios',
        title_prefix: 'Eliminación',
        title_customize: { title: 'Eliminación', title_confirm: 'eliminar', title_confirmed: 'eliminó' },
        full_success_message: 'Los registros se eliminaron correctamente',
        element: '.delete-data',
        form_element: '#form-import-excel',
        element_is_load: true,
        isLoadFromAjax: false,
        rules: rules_delete,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {
            $(".modal-title").text('Eliminar Registros');
            $.fn.datepicker.languages['es-ES'] = {
                format: 'yyyy-mm-dd',
                days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                daysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                daysMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                weekStart: 1,
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
            };

            $('#init_date').datepicker({
                startDate: null,
                language: 'es-ES',
                autoHide: true,
                zIndex: 2048,
            });
            $('#end_date').datepicker({
                startDate: null,
                language: 'es-ES',
                autoHide: true,
                zIndex: 2048,
            });
        },
        afterSuccess: function() {
            load();
            /*swal("Registro eliminado correctamente", {
                    icon: "success",
                })
                .then((result) => {
                    if (result) {
                        load();
                    }
                });*/

        }
    });

    ModalCRUD.edit({
        title: 'Plan',

        element: '.edit-entity',
        element_is_load: true,
        form_element: '#form-plan-edit',
        isLoadFromAjax: true,
        url: function(element) {
            return $(element).attr("href");
        },
        initialized: function() {},
        afterSuccess: function() {
            load();
        }
    });

    ModalCRUD.show({
        title: 'Compras',
        mode: 'lg',
        element: '.entity-show',
        form_element: '#form-noticia-relacionada-create',
        element_is_load: false,
        isLoadFromAjax: true,
        rules: rules,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {
            //load_product_list();
        }
    });

    $(document).on('click', '.pagination li a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        load(url);
    })
});


function eliminar($id, $url, $token) {
    swal({
            title: "Eliminar registro",
            text: "Estas seguro de eliminar este registro",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, // "{{ url('/dashboard/role/delete') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Eliminando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Registro eliminado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function activar($id, $url, $token) {
    swal({
            title: "Activar registro",
            text: "Estas seguro de activar?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, // "{{ url('/dashboard/role/active') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Activando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Activado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function desactivar($id, $url, $token) {
    swal({
            title: "Desactivar registro",
            text: "Estas seguro de desactivar",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, //"{{ url('/dashboard/role/desactive') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Desactivando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Desactivado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function load(url = null) {
    var filters = get_filters();
    var url = url ? url : url_cliente_load;

    $.get(url, filters, function(data) {
        $('#table-content').html(data);
        //init_functions();
    });
}

function load_product_list(url = null) {
    var filters = get_filters();
    var url = url ? url : url_producto_list_load;

    $.get(url, filters, function(data) {
        $('#table-content-product').html(data);
        //init_functions();
    });
}