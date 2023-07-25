var ModalCRUD = {
    create_element: '#new-entity',
    edit_element: '.edit-entity',
    show_element: '.show-entity',
    delete_element: '.delete-entity',
    delete_form: '#form-delete',
    params: '',
    kendo_content: '',

    create: function(options) {

        if (!options.element) {
            options.element = ModalCRUD.create_element
        }

        if (!options.kendo_content) {
            options.kendo_content = ModalCRUD.kendo_content
        }

        $(document).on("click", options.element, function(e) {
            e.preventDefault();
            var current_button = $(this)
            $(current_button).attr("disabled", true);
            $(current_button).addClass('not-active');

            var url = isFunction(options.url) ? options.url(current_button) : options.url;

            $.get(url, options.params).done(function(form_content) {
                    var title_prefix = options.title_prefix ? options.title_prefix.toUpperCase() : 'NUEVO';
                    var form_title = title_prefix + ' ' + options.title.toUpperCase();


                    if (options.params) {
                        if (isFunction(options.params.name)) {
                            var name = options.params.name(current_button);
                            form_title = form_title + ' - ' + name;
                        }
                    }

                    var form_submit = 'GUARDAR'
                    var form_selector = options.form_element ? options.form_element : '#form-create'

                    var confirm_message = '¿Está seguro de crear este registro de ' + options.title.toLowerCase() + '?'
                    var confirm_title = 'CREACIÓN DE ' + options.title.toUpperCase()
                    var success_message = 'El registro se creó correctamente.'

                    ModalForm(form_title, form_submit, form_content, form_selector, options, confirm_message, confirm_title, success_message, current_button)

                })
                .fail(function() {
                    $(current_button).removeAttr("disabled");
                });

        });

    },
    edit: function(options, init, afterSuccess) {
        if (!options.element) {
            options.element = ModalCRUD.edit_element
        }

        if (options.title_customize === undefined) {
            options.title_customize = { title: 'Edición', title_confirm: 'editar', title_confirmed: 'editó' };
        }

        var element = $(document);
        var element_event = options.element;

        if (options.isLoadFromAjax == false) {
            element = $(options.element);
            element_event = null;
        }

        element.on('click', element_event, function(e) {

            e.preventDefault();
            var current_button = $(this)
            $(current_button).attr("disabled", true);
            $(current_button).addClass('not-active');

            var parent = $(this).parent();
            if (parent.data('id') === undefined) {
                parent = $(this);
            }

            var id = $(parent).data('id')
            var entity_name = String($(parent).data('name'));

            if (options.params) {
                if (options.params.id) {
                    id = options.params.id;
                }

                if (options.params.name) {
                    entity_name = options.params.name(current_button);
                }
            }

            entity_name = entity_name ? entity_name.toUpperCase() : '';

            var url = isFunction(options.url) ? options.url(current_button) : options.url.replace(':ROW_ID', id);

            $.get(url, options.params).done(function(form_content) {

                if (options.full_form_title) {
                    var form_title = options.full_form_title
                    var confirm_message = options.full_confirm_message
                    var confirm_title = options.full_confirm_title

                    var success_message = options.full_success_message
                } else {
                    var form_title = options.title_customize.title.toUpperCase() + ' DE ' + options.title.toUpperCase() + ' "' + entity_name + '"'
                    var confirm_message = '¿Está seguro de ' + options.title_customize.title_confirm + ' el registro de ' + options.title + '?'
                    var confirm_title = options.title_customize.title + ' de ' + options.title

                    var success_message = 'El registro se ' + options.title_customize.title_confirmed + ' correctamente.'
                }

                var form_selector = options.form_element ? options.form_element : '#form-update'
                var form_submit = 'GUARDAR'

                ModalForm(form_title, form_submit, form_content, form_selector, options, confirm_message, confirm_title, success_message, current_button, afterSuccess)

            }).fail(function(jqXHR) {
                console.log("error" + jqXHR);
                AlertMessage.hideSpining('.confirm-dialog')
                $('.confirm-dialog').modal('hide')
                $(current_button).removeAttr("disabled");
                $(current_button).removeClass('not-active');

                if (jqXHR.status == 404) {
                    AlertMessage.printError('.side-body', 'El registro no existe o ha sido eliminado.')
                }

            });

        });

    },
    show: function(options) {

        if (!options.element) {
            options.element = ModalCRUD.show_element
        }

        if (!options.kendo_content) {
            options.kendo_content = ModalCRUD.kendo_content
        }

        var element = $(document);
        var element_event = options.element;

        if (options.isLoadFromAjax == false) {
            element = $(options.element);
            element_event = null;
        }

        element.on('click', element_event, function(e) {
            e.preventDefault();
            var current_button = $(this)

            $(current_button).addClass('not-active')
            $(current_button).attr('disabled', true)

            var parent = $(this).parent();
            if (parent.data('id') === undefined) {
                parent = $(this);
            }

            var id = $(parent).data('id')
            var entity_name = String($(parent).data('name'))

            if (options.params) {
                id = options.params.id;

                if (isFunction(options.params.name)) {
                    entity_name = options.params.name(current_button);
                }
            }

            var url = '';
            if (isFunction(options.url)) {
                url = options.url(current_button);
            } else {
                url = options.url.replace(':ROW_ID', id)
            }

            $.get(url, options.params).done(function(data) {
                $(current_button).removeClass('not-active')
                $(current_button).removeAttr('disabled')
                bootbox.dialog({
                    size: options.mode,
                    className: 'modal-primary',
                    closeButton: false,
                    message: data,
                    title: "DETALLE " + options.title.toUpperCase() + ': ' + entity_name,
                    buttons: {
                        default: {
                            label: "CERRAR",
                            className: "btn-secondary",
                            callback: function() {}
                        },
                    },
                    onEscape: function() {
                        if (!$('.loader-container').is('*')) {
                            $('.bootbox.modal').modal('hide');
                        } else {
                            return false;
                        }
                    }
                }).init(function() {
                    $(current_button).removeClass('not-active');
                    $(current_button).removeAttr('disabled');

                    if (options.initialized) {
                        options.initialized($(current_button));
                    }
                });
            }).fail(function(jqXHR) {

                AlertMessage.hideSpining('.confirm-dialog')
                $('.confirm-dialog').modal('hide')

                if (jqXHR.status == 404) {
                    AlertMessage.printError('.side-body', 'El registro no existe o ha sido eliminado.')
                }

            });

        });
    },
    delete: function(options, init, afterSuccess) {

        if (!options.element) {
            options.element = ModalCRUD.delete_element
        }

        if (!options.delete_form) {
            options.delete_form = ModalCRUD.delete_form
        }

        if (options.title_customize === undefined) {
            options.title_customize = { title: 'eliminación', title_confirm: 'eliminar', title_confirmed: 'eliminó' };
        }


        if (options.title === undefined || options.title == '') {
            options.title = '-';
        }

        if (options.hideModal === undefined) {
            options.hideModal = true
        }

        $(document).on('click', options.element, function(e) {
            e.preventDefault();
            var current_button = $(this)
            var parent = $(this).parent()

            var id = $(parent).data('id')
            var entity_name = String($(parent).data('name'))

            if (id === undefined) {
                id = $(this).data('id')
                entity_name = String($(this).data('name'))
            }

            if (options.params) {
                if (options.params.id) {
                    id = options.params.id;
                }

                if (options.params.name) {
                    entity_name = options.params.name(current_button);
                }
            }

            $(current_button).attr("disabled", true);
            $(current_button).addClass('not-active');

            bootbox.dialog({
                className: 'modal-danger',
                closeButton: false,
                //message: '¿Está seguro de '+options.title_customize.title_confirm.toLowerCase()+' el registro de '+ options.title.toLowerCase() + ' "' + entity_name + '"?',
                message: '¿Está seguro de ' + options.title_customize.title_confirm.toLowerCase() + ' el registro de <b>' + entity_name + '<b> ?',
                title: options.title_customize.title.toUpperCase() + " DE " + options.title.toUpperCase(),
                buttons: {
                    default: {
                        label: "NO",
                        className: "btn-secondary",
                        callback: function() {
                            // Example
                        }
                    },
                    main: {
                        label: "SÍ",
                        className: "btn-primary",
                        callback: function() {
                            tinyMCE.triggerSave();
                            var form = $(options.delete_form);
                            var url = form.attr('action').replace(':ROW_ID', id);
                            var data = form.serialize();

                            $.ajax({
                                url: url,
                                type: "post",
                                data: data,
                                dataType: 'json',
                                success: function(data) {
                                    if (options.hideModal) {
                                        $('.bootbox').modal('hide');
                                    }

                                    if (options.afterSuccess) {
                                        options.afterSuccess(data);
                                    } else if (afterSuccess) {
                                        afterSuccess();
                                    } else {
                                        refreshKendo(options.kendo_content)
                                    }

                                    var success_message = bootbox.dialog({
                                        className: 'modal-success',
                                        backdrop: true,
                                        message: 'El registro se ' + options.title_customize.title_confirmed.toLowerCase() + ' correctamente.',
                                        title: "ÉXITO",
                                    })

                                    if (options.hideModal) {
                                        hideModal(success_message, 3)
                                    }
                                },
                                error: function(jqXHR) {
                                    AlertMessage.hideSpining('.confirm-dialog')
                                    $('.confirm-dialog').modal('hide')

                                    if (jqXHR.status == 404) {
                                        AlertMessage.printError('.side-body', 'El registro no existe o ha sido eliminado.')
                                    }

                                    if (jqXHR.status == 422) {
                                        var message = jqXHR.responseJSON ? jqXHR.responseJSON : ''

                                        //                                            $('.bootbox').modal('hide');
                                        //                                            bootbox.dialog({
                                        //                                                className: 'modal-error',
                                        //                                                backdrop: true,
                                        //                                                message: message,
                                        //                                                title: "ERROR",
                                        //                                            })
                                        AlertMessage.printError('.side-body', message)
                                    }

                                    if (jqXHR.status == 500) {
                                        AlertMessage.printError('.side-body', 'Error interno del servidor')
                                    }
                                }
                            });
                        }
                    }
                },
                onEscape: function() {
                    if (!$('.loader-container').is('*')) {
                        $('.bootbox.modal').modal('hide');
                    } else {
                        return false;
                    }
                }
            }).init(function() {
                $(current_button).removeAttr("disabled");
                $(current_button).removeClass('not-active');

                if (options.initialized) {
                    options.initialized($(this));
                }
            });

        });
    }
};

var AlertMessage = {
    SUCCESS: 1,
    ERROR: 0,
    spinId: '32er32',
    print: function($elm, msg) {
        var out = '';
        if (typeof msg === "object") {
            var a = [];
            for (var i in msg) {
                a.push(msg[i]);
            }
            out = a.join("<br/>");
        } else {
            out = msg;
        }

        var tpl = AlertMessage.defaultTpl();
        var msg = tpl.replace("##msg##", "<br/>" + out);
        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    printError: function($elm, msg) {
        var out = '';
        if (typeof msg === "object") {
            //var a = [];
            for (var i in msg) {
                out += "<li>" + msg[i][0] + "</li>";
                // a.push("<li>"+msg[i][0]+"</li>");
            }
            // out = a.join();
        } else {
            out = msg;
        }
        var tpl = AlertMessage.errorTpl();
        var msg = tpl.replace("##msg##", out);

        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    printunauthorized: function($elm, msg) {
        var out = '';
        if (typeof msg === "object") {
            //var a = [];
            for (var i in msg) {
                out += "<li>" + msg[i][0] + "</li>";
                // a.push("<li>"+msg[i][0]+"</li>");
            }
            // out = a.join();
        } else {
            out = msg;
        }
        var tpl = AlertMessage.unauthorizedTpl();
        var msg = tpl.replace("##msg##", out);

        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    printSuccess: function($elm, msg) {
        var tpl = AlertMessage.successTpl();
        msg = tpl.replace("##msg##", msg);
        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    printInfo: function($elm, msg) {
        var tpl = AlertMessage.infoTpl();
        msg = tpl.replace("##msg##", msg);
        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    unauthorizedTpl: function() {
        return "<div class='col-12'>" +
            "<div class='alert alert-danger alert-dismissible fade show'>" +
            " <h4 class='alert-heading '><i class='icon fa fa-ban'></i>" +
            "<strong>Acceso no autorizado!</strong></h4>" +
            "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>" +
            "<ul style='padding-left:revert;list-style:disc;'> ##msg##</ul>" +
            "</div>" +
            "</div>"
    },
    errorTpl: function() {
        //        return "<div class='alert fresh-color alert-danger alert-dismissible' role='alert'>" +
        //                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
        //                        "<strong>Ha ocurrido un error!</strong> ##msg##" +
        //                "</div>"

        return "<div class='col-12'>" +
            "<div class='alert alert-danger alert-dismissible fade show'>" +
            " <h4 class='alert-heading'><i class='icon fa fa-ban'></i>" +
            "<strong>Datos ingresados no válidos.!</strong></h4>" +
            "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>" +
            "<ul style='padding-left:revert;list-style:disc;'> ##msg##</ul>" +
            "</div>" +
            "</div>"
    },
    successTpl: function() {
        //        return "<div class='alert fresh-color alert-success alert-dismissible' role='alert'>" +
        //                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
        //                        "<strong>Éxitfgho!</strong> ##msg##" +
        //                "</div>"
        return "<div class='alert alert alert-border-bottom alert-system bg-gradient alert-dismissable'>" +

            "<button class='btn btn-success btn-wth-icon btn-rounded icon-right btn-sm'>" +
            "<span class='btn-text'>Éxitsso!</span>" +
            "<span class='icon-label'><i class='fa fa-times'></i> </span></button>" +
            "<a href='#' class='alert-link'> ##msg## </a>" +
            "</div>"
    },
    infoTpl: function() {
        return "<div class='alert fresh-color alert-info alert-dismissible' role='alert'>" +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
            "<strong><span class='fa fa-info-circle fa-5' ><span></strong> ##msg##" +
            "</div>"
    },
    defaultTpl: function() {
        return "<div class='alert fresh-color alert-default  alert-dismissible' role='alert'>" +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
            " ##msg##" +
            "</div>"
    },
    //    spin: function () {
    //        return "<div id='32er32' class='loader-container text-center color-white'>" +
    //                    "<div><i class='fa fa-spinner fa-pulse fa-3x'></i></div>" +
    //                    "<div>Cargando</div>" +
    //                "</div>"
    //    },
    spin: function() {
        return "<div id='32er32'>" +
            "<div class='loader-container'>" +
            "<div class='loader-icon'>" +
            "<div class='loader-container-icon text-center'>" +
            "<i class='fa fa-spinner fa-pulse fa-3x'></i></div>" +
            "</div>" +
            //"<div>Cargando</div>" +
            "</div>" +
            "</div>";
    },
    showSpining: function(idElement) {

        if ($('.bootbox').length) {
            idElement = '.modal-content:last';
        }

        $(idElement).append(AlertMessage.spin());
        $(idElement).addClass('loader');
    },
    hideSpining: function(idElement) {
        $(idElement).find("#" + AlertMessage.spinId).remove();
    },
    removeCurrentAlerts: function() {
        $('body .alert').remove()
    },
};

function hideModal(element, seconds) {
    setTimeout(function() { $(element).modal('hide'); }, seconds * 1000);
}

function showMessage(e) {
    var grid = e.sender;
    if (grid.dataSource.total() == 0) {
        var colCount = grid.columns.length;
        $(e.sender.wrapper)
            .find('tbody')
            .append('<tr><td colspan="' + (colCount) + '" class="text-muted">No hay registros en la base de datos.</td></tr>');
    }
}

function refreshKendo(element) {
    if (!element) {
        element = '.content-kendo'
    }

    $(element).data('kendoGrid').dataSource.read();
}

function ignoreFields(fields) {
    $(fields).addClass('ignore')
}


function ModalForm(form_title, form_submit, form_content, form_selector, options, confirm_message, confirm_title, success_message, current_button, afterSuccess) {
    $(current_button).removeAttr("disabled");
    $(current_button).removeClass("not-active");
    var form_dialog = bootbox.dialog({

        size: options.mode,
        className: 'modal-primary modal-form',
        closeButton: false,
        message: form_content,
        title: form_title,
        buttons: {
            default: {
                label: "CERRAR",
                className: "btn-secondary",
                callback: function() {
                    // Example
                }
            },
            main: {
                label: '<i id="spinner" class="fa fa-spinner fa-pulse fa-1x" style="display:none"></i></div>GUARDAR',
                className: "btn-primary btn-save-info",
                callback: function() {
                    ignoreFields(options.ignore)


                    AlertMessage.removeCurrentAlerts();

                    var form = $(form_selector);

                    $(form).validate(options.rules);

                    var url = form.attr('action');

                    if (form.valid()) {
                        swal({
                                title: confirm_title,
                                text: confirm_message,
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    //AlertMessage.showSpining();
                                    $(".btn-save-info").attr('disabled', 'disabled');
                                    $("#spinner").show();
                                    var fields = new FormData(form[0]);
                                    $.ajax({
                                        url: url,
                                        type: "post",
                                        data: fields,
                                        dataType: 'json',
                                        contentType: false,
                                        processData: false,
                                        success: function(data) {
                                            $('.bootbox').modal('hide');

                                            if (options.afterSuccess) {
                                                options.afterSuccess(data);
                                            } else if (afterSuccess) {
                                                afterSuccess(data);
                                            } else {
                                                refreshKendo(options.kendo_content);
                                            }

                                            /*var success_dialog = bootbox.dialog({
                                                className: 'modal-success',
                                                backdrop: true,
                                                message: success_message,
                                                title: "ÉXITO",
                                            })*/
                                            swal(success_message, {
                                                    icon: "success",
                                                })
                                                .then((result) => {
                                                    /*if(result){
                                                     load();
                                                    }*/
                                                });
                                        },
                                        error: function(jqXHR) {
                                            $(".btn-save-info").removeAttr('disabled');
                                            $("#spinner").hide();
                                            //AlertMessage.hideSpining('.modal-content');
                                        }
                                    });
                                    return false;

                                } else {
                                    $(".btn-save-info").removeAttr('disabled');
                                    $("#spinner").hide();
                                }
                            });
                        /*var confirm_dialog = bootbox.dialog({
                            className: 'modal-primary confirm-dialog',
                            closeButton: false,
                            backdrop: true,
                            message: confirm_message,
                            title: confirm_title,
                            buttons: {
                                default: {
                                    label: "NO",
                                    className: "btn-default nos",
                                    callback: function(e) {

                                    }
                                },
                                main: {
                                    label: "SÍ",
                                    className: "btn-primary",
                                    callback: function() {

                                        AlertMessage.showSpining('.confirm-dialog')

                                        //var fields = $( form ).serialize();
                                        var fields = new FormData(form[0]);
                                        $.ajax({
                                            url: url,
                                            type: "post",
                                            data: fields,
                                            dataType: 'json',
                                            contentType: false,
                                            processData: false,
                                            success: function(data)
                                            {
                                                $('.bootbox').modal('hide');
                                                
                                                if (options.afterSuccess) {
                                                    options.afterSuccess(data);
                                                } else if(afterSuccess) {   
                                                    afterSuccess(data);
                                                } else { 
                                                    refreshKendo(options.kendo_content);
                                                }
                                                   
                                                var success_dialog = bootbox.dialog({
                                                    className: 'modal-success',
                                                    backdrop: true,
                                                    message: success_message,
                                                    title: "ÉXITO",
                                                })
                                                
                                                hideModal(success_dialog, 3)
                                            },
                                            error: function(jqXHR)
                                            {
                                                AlertMessage.hideSpining('.confirm-dialog');
                                                $('.confirm-dialog').modal('hide');
                                                

//                                                if (jqXHR.status == 422)
//                                                {
//                                                    var message = jqXHR.responseJSON ? jqXHR.responseJSON : ''
//                                                    AlertMessage.printError($('.modal-body', form_dialog), message)
//                                                }
//                                                else
//                                                {
//                                                    if (jqXHR.status == 404)
//                                                    {
//                                                        var message = jqXHR.responseJSON ? jqXHR.responseJSON : ''
//                                                        AlertMessage.printError($('.modal-body', form_dialog), message)
//                                                    }
//
//                                                    if (jqXHR.status == 500)
//                                                    {
//                                                        var message = 'Error interno de servidor'
//                                                        AlertMessage.printError($('.modal-body', form_dialog), message)
//                                                    }
//                                                }
                                            }
                                        });

                                        return false;
                                    }
                                }
                            }
                        }).init(function () {

                            form_dialog.addClass('push-back');

                        }).on('hidden.bs.modal', function (e) {

                            form_dialog.removeClass('push-back');

                            var modal = e.target

                            if ( $(modal).hasClass('confirm-dialog') )
                            {
                                var $body = $('body')
                                $body.addClass('modal-open')
                            }

                        }); */

                        return false;
                    } else {
                        $(".btn-save-info").removeAttr('disabled');
                        $("#spinner").hide();
                    }

                    return false;
                }
            }
        },
        onEscape: function() {
            if (!$('.loader-container').is('*')) {
                $('.bootbox.modal').modal('hide');
            } else {
                return false;
            }
        }
    }).init(function() {
        $(current_button).removeClass('not-active');
        $(current_button).removeAttr('disabled');

        if (options.initialized) {
            options.initialized(current_button);
        }

    }).on('hidden.bs.modal', function(e) {

        var modal = e.target

        if ($(modal).hasClass('modal-form')) {
            $(current_button).removeClass('not-active');
            $(current_button).removeAttr('disabled');
        }

    });
}

function isFunction(functionToCheck) {
    var getType = {};
    return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
}

function array_first(obj) {
    var elem = '';
    $.each(obj, function(indx, value) {
        elem = value;
        return false;
    });

    return elem;
}

function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

var number_format = function(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}