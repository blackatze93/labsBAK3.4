require ('noty/lib/noty.css');
require ('noty/lib/themes/sunset.css');

global.Noty = require ('noty');

Noty.overrideDefaults({
    layout   : 'topCenter',
    theme    : 'sunset',
    timeout     : 5000
});

global.notificacion = function(text, type) {
    new Noty({
        type        : type,
        text        : text
    }).show();
};

