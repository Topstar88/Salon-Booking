(function(WebFont, fonts) {
    'use strict';
    WebFont.load({
        google: {"families":["Lato:300,400,700,900"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: [fonts]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });   
})(WebFont, fonts);