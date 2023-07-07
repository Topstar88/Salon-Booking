(function($) {
    "use strict";

    $(document).ready(function(e) {
        function compileList() {
            let pages = $('.page-sortable');
            let array = [];
            for(let i = 0; i < pages.length; i++) {
                array.push(pages[i].dataset.pl);
            }

            return array;
        };

        let plx = compileList();
        $('#sortable-list').sortable({
            opacity: 0.5,
            cursor: "move",
            stop: function(e) {
                plx = compileList();
                $.post(
                    base + layout + '/update_page_order',
                    {
                        order: JSON.stringify(plx),
                        ref: 'admin-panel',
                    },
                    function(data) {
                        if(data.success) {
                            console.log('Updated page order.');
                        }
                    },
                    'json'
                )
            } 
        });
    });
})(jQuery)