(function($){
  'use strict';
  
  $(document).ready(function(){
      
      $("#blogStatus").on("change",function(e) {
        var status = $(this).is(":checked");
        jQuery.ajax({
          type: "POST",
          data : {'bstatus': status},
          dataType: "json",
          url: base + adminblog + '/blogStatus',
          success: function(data) {
              if(data){
                  $('#statusChanged').fadeIn().delay('1000').fadeOut('slow');
              }
          }
        });
      });
  
  });
})(jQuery);