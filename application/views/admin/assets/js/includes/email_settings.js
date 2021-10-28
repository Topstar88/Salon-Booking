(function($) {
"use strict";
    $(document).ready(function(e) {
        const check = $('#smtp-status-check');
        const container = $('#smtp-settings-container');
        
        check.on('change', function(e) {
            container.toggleClass('d-none');
        })
    });
})(jQuery);