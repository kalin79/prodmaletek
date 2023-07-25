jQuery(function(){
    load();
    
   
    
    
  });
      
    
function load (url = null)
{        
    var filters = get_filters();
    var url = url ? url : url_permisos_load;

    $.get(url, filters ,function(data){
        $('#table-content').html(data);     
        $('.permiso_chk' ).on( 'click', function() {
            var page = $(this).data('id');
            var role = $(this).data('role');
            var checked;
            if( $(this).is(':checked') ){
                checked = true;
            } else {
                checked = false;
            }
            accessrequest( page,role ,checked)
        });
    });
}

function accessrequest( page,role ,checked) {

        var url = '/admin/access/register';
    $.ajax({
        url: url,//"{{ url('/dashboard/user/desactive') }}",
        method: 'post',
        data: {
            page: page,
            role: role,
            checked: checked
        },
        success: function(dataJson){
          if(dataJson.rpt === 1){
            swal("Usuario desactivado correctamente", {
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