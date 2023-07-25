<!--CORE-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/metismenu"></script>

<script src="{{ asset('architec-ui/js/scripts-init/app.js')}}"></script>
<script src="{{ asset('architec-ui/js/scripts-init/demo.js')}}"></script>

<script src="{{ asset('architec-ui/js/scripts-init/scrollbar.js')}}"></script>
<script src="{{asset('architec-ui/js/vendors/carousel-slider.js')}}"></script>
<script src="{{ asset('architec-ui/js/scripts-init/carousel-slider.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@stack('scripts')

<!-- BEGIN: PAGE SCRIPTS -->

<script type="text/javascript">
    
    $(document).ready(function() {

            
     /** Status request ajax **/ 
     
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajaxSetup({
                statusCode : {
                    200: function() {
    //                      var top = 0;// $(".side-body:last").offset().top;
    //                       $("[type=submit]").removeAttr("disabled");  
    //                       $("body").scrollTop(top);
    //                        AlertMessage.removeCurrentAlerts();
                    }
                }
            });
            
            $.ajaxSetup({
                statusCode : {
                    401: function() {
                        
                        var top = 0;// $(".side-body:last").offset().top;
                        $("[type=submit]").removeAttr("disabled");
                        var from_alert= '.side-body:last';
                        if ($(".bootbox").length) {
                            from_alert= '.row-alert:last';
                            $(".modal-body").animate({ scrollTop: 0 }, "fast");
                        } else {
                            $(document).scrollTop(top); 
                        }
                        AlertMessage.printunauthorized(from_alert, 'El usuario no tiene permiso para realizar esta acción.');
                    }
                }
            });
            
            $.ajaxSetup({
                statusCode : {
                    403: function(data) {
                        var message = data.responseJSON == '' ? 'No tiene permitido realizar esta acción o ver parte de este conteanido.' : data.responseJSON;
                        AlertMessage.unauthorizedTpl('.side-body:last', message);
                        var top = 0;// $(".side-body:last").offset().top;
                        $("[type=submit]").removeAttr("disabled"); 
                        
                        if ($(".bootbox").length) {
                            $(".modal-body").animate({ scrollTop: 0 }, "fast");
                        } else {
                            $(document).scrollTop(top); 
                        }
                       
                    }
                }
            });
            $.ajaxSetup({
                statusCode : {
                    404: function(data) {
    //                        AlertMessage.print('.side-body:last', data.responseText);
                         AlertMessage.printInfo('.side-body:last', 'No se encontraron resultados.');
                        var top = 0;// $(".side-body:last").offset().top;
                        $("[type=submit]").removeAttr("disabled"); 
                        
                        if ($(".bootbox").length) {
                            $(".modal-body").animate({ scrollTop: 0 }, "fast");
                        } else {
                            $(document).scrollTop(top); 
                        }
                    }
                }
            });
            $.ajaxSetup({
                statusCode : {
                    422: function(data) {
                        AlertMessage.printError('.row-alert:last', data.responseJSON.errors);
                        var top = 0;// $(".side-body:last").offset().top;
                        $("[type=submit]").removeAttr("disabled"); 
                     
                        if ($(".bootbox").length) {
                            $(".modal-body").animate({ scrollTop: 0 }, "fast");
                        } else {
                            $(document).scrollTop(top); 
                        }
                    }
                }
            });
            $.ajaxSetup({
                statusCode : {
                    500: function(data) {
                        AlertMessage.print('.side-body:last', data.responseText);
                        var top = 0;// $(".side-body:last").offset().top;
                        $("[type=submit]").removeAttr("disabled"); 
                        
                        if ($(".bootbox").length) {
                            $(".modal-body").animate({ scrollTop: 0 }, "fast");
                        } else {
                            $(document).scrollTop(top); 
                        }
                    }
                }
            });
            
            $(document).on('click', '.modal-success', function (event) {
                bootbox.hideAll();
            });
     
        
           $.fn.modal.Constructor.prototype.enforceFocus = function() {}; 
    
    
    
            
    });
    const showLoading = function(title) {
        swal(title, {
            buttons: false
        });
    };
    </script>
    
    <!-- END: PAGE SCRIPTS -->
    