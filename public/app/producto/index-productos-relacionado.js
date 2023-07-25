
jQuery(function() {
    load();


    var customize_rules ={

        /* @validation states + elements
        ------------------------------------------- */
        ignore: [],
        errorClass: "state-error",
        validClass: "state-success",
        errorElement: "em",

        /*  rules
        ------------------------------------------ */
        rules : {
            //nombre: {required: true},
            //description: {required: true},
        },

        /* @validation error messages
        ---------------------------------------------- */
        messages: {
        },

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
            }
            else {
                error.insertAfter(element.parent());
                error.insertAfter(element.closest(".field"));
            }
        }
    };

    var rules = $.extend(true,{},customize_rules);
    rules.rules={
        noticia_relacionada_id:{required:true},
    }

    ModalCRUD.show({
        title: 'Productos',
        mode: 'lg',
        element: '.entity-create',
        form_element: '#form-noticia-relacionada-create',
        element_is_load : false,
        isLoadFromAjax : false,
        rules:rules,
        url: function(elemt){
            return $(elemt).attr('href');
        },
        initialized:function(){
            $(".modal-title").text('Listado de productos');
            load_product_list();

            var data_fields = [
                { "id": 1, "text": "Categoria", type: 'list', field: 'categoria_id', list: function() { return list_categorias() }, 'type_select2': true },
                { "id": 2, "text": "Producto", type: 'text', field: 'title_large' },

            ];

            list_categorias();
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
                    load_product_list();
                }
            });

            $('body').on('click', '.pagination li a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                load_product_list(url);
            })
        },
        afterSuccess : function(){
            load_product_list();

        }
    });
    ModalCRUD.edit({
        title: 'Noticia Relacionada',

        element: '.edit-entity',
        element_is_load : true,
        form_element: '#form-noticia-relacionada-edit',
        isLoadFromAjax : true,
        url: function(element){
            return $(element).attr("href");
        },
        initialized:function(){
        },
        afterSuccess : function(){
            load();
        }
    });



});
function list_categorias() {
    return get_list(url_categorias_list);
}


function eliminar($id,$url,$token){
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
                    url: $url,// "{{ url('/dashboard/role/delete') }}",
                    method: 'delete',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function(){
                        showLoading('Eliminando registro...');
                    },
                    success: function(dataJson){
                        if(dataJson.rpt === 1){
                            swal("Registro eliminado correctamente", {
                                icon: "success",
                            })
                                .then((result) => {
                                    if(result){
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function activar($id,$url,$token){
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
                    url: $url,// "{{ url('/dashboard/role/active') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function(){
                        showLoading('Activando registro...');
                    },
                    success: function(dataJson){
                        if(dataJson.rpt === 1){
                            swal("Activado correctamente", {
                                icon: "success",
                            })
                                .then((result) => {
                                    if(result){
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function desactivar($id,$url,$token){
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
                    url: $url,//"{{ url('/dashboard/role/desactive') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function(){
                        showLoading('Desactivando registro...');
                    },
                    success: function(dataJson){
                        if(dataJson.rpt === 1){
                            swal("Desactivado correctamente", {
                                icon: "success",
                            })
                                .then((result) => {
                                    if(result){
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}
function load (url = null)
{
    //var filters = get_filters();
    var url = url ? url : url_producto_relacionada_load;

    $.get(url, function(data){
        $('#table-content-relacionadas').html(data);

    });
}

function load_product_list (url = null)
{
    var filters = get_filters();
    var url = url ? url : url_producto_list_load;

    $.get(url, filters,function(data){
        $('#table-content-product').html(data);
        //init_functions();
    });
}

function relacionar(product_id,product_relation){
    var parameter = {product_id:product_id,product_relation_id:product_relation};
    var url = url ? url : url_save_relacionada;
    $.post(url, parameter,function(data){
        load();
        load_product_list();
    });
}


