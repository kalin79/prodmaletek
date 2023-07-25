jQuery(function(){
  load();
  var data_fields =   [
      {"id": 1, "text": "Rol", type:'text', field : 'name'}
  ];

  $("#cmb-field").select2({
      "data": data_fields,
  });
  console.log("ab");
  CI.filter({
      controls: {field:'#cmb-field', operator:'#cmb-operator', value:'#text-value'},
      data: data_fields,
      default_filter: 'byField',
      elemnt_action: '#btn-add-filter',
      text_value: '#text-value',
      content_filters: '#content-filters',
      load: function() {
        load();
      }
  });
  
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
      nombre: {required: true},
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
    name:{required:true},
  }
  ModalCRUD.create({
      title: 'Rol',
      element: '.entity-create',
      form_element: '#form-rol-create',
      element_is_load : true,
      isLoadFromAjax : false,
      rules:rules,
      url: function(elemt){
          return $(elemt).attr('href');
      },
      initialized:function(){
      },
      afterSuccess : function(){
          load();
          
      }        
  });

    ModalCRUD.edit({
        title: 'Rol',
        element: '.edit-entity',

        /*title_customize: {
          title: 'Editar',
          title_confirm: 'Editar',
          title_confirmed: 'Editado',
      },*/
        element_is_load : true,
        form_element: '#form-rol-edit',
        isLoadFromAjax : true,
        rules:rules,
        url: function(element){
            return $(element).attr("href");
        },
        initialized:function(){
        },
        afterSuccess : function(){
            load();
        }
    });
    $(document).on('click', '.pagination li a', function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      load(url);
    });
  
  
});
    
  
  
   function eliminar($id,$url,$token){
       swal({
        title: "Eliminar Rol",
        text: "Estas seguro de eliminar este rol",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            
             $.ajax({
                url: $url,// "{{ url('/dashboard/role/delete') }}",
                method: 'post',
                data: {
                  id: $id,
                  _token: $token
                },
               beforeSend: function(){
                showLoading('Eliminando registro...');
              },
                success: function(dataJson){
                  if(dataJson.rpt === 1){
                    swal("Rol eliminado correctamente", {
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
                 
          
        } /*else {
          swal("Your imaginary file is safe!");
        }*/
      });
   }
  
   function activar($id,$url,$token){
      swal({
        title: "Activar Rol",
        text: "Estas seguro de activar este Rol?",
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
                    swal("Rol activado correctamente", {
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
                 
          
        } /*else {
          swal("Your imaginary file is safe!");
        }*/
      });
   }
  
    function desactivar($id,$url,$token){
      swal({
        title: "Desactivar Rol",
        text: "Estas seguro de desactivar este Rol",
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
                    swal("Rol desactivado correctamente", {
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
                 
          
        } /*else {
          swal("Your imaginary file is safe!");
        }*/
      });
   }
  function load (url = null)
  {        
      var filters = get_filters();
      var url = url ? url : url_role_load;
  
      $.get(url, filters ,function(data){
          $('#table-content').html(data);     
          
      });
  }