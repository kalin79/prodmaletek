'use strict';

/* Config  functions. Required for
 * Settings Pane and misc functions */
var Init = function() {


  /* datetimepicker
    ------------------------------------------------------------------ */
    var datetimepicker = function() {
        if ($.fn.datetimepicker) {
            $(".dtp-default").datetimepicker({
                locale: 'en', 
                format: 'YYYY/MM/DD HH:mm', 
                useCurrent: false, //Important! See issue #1075
                widgetPositioning: {
                    vertical: 'bottom'
                }
            });
            
            $(".dp-default").datetimepicker({
                locale: 'en', 
                format: 'YYYY/MM/DD', 
                useCurrent: false, //Important! See issue #1075
                widgetPositioning: {
                    vertical: 'bottom'
                }
            });
        }    
    }

    
        return {
            config: function() {
                datetimepicker();
            }
        }
}();
